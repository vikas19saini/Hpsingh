<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Client;

class CartController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Products');
        $this->Security->setConfig('unlockedActions', ['add', 'checkout', 'placeorder']);
        $this->loadComponent('Product');
        $this->loadComponent('Cart');
        $this->Auth->deny(['checkout', 'getPaymentMethod', 'placeorder']);
    }

    public function add()
    {
        $this->request->allowMethod(['ajax']);

        $product = $this->Products->find('BySlug', ['slug' => $this->request->getData('slug'), 'find' => 'fair']);

        if (!$product) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Product not found!']));
        }

        return $this->response->withType('json')->withStringBody(json_encode($this->Cart->add($product, $this->request->getData('qty'))));
    }

    public function getCartItems()
    {
        $this->request->allowMethod(['ajax']);
        $this->__getItemsInCart();
        return $this->response->withType('json')->withStringBody(json_encode($this->request->getSession()->read('Cart.CartDetails')));
    }

    public function display()
    {
        $this->Cart->resetShipping();
    }

    public function getCartProducts()
    {

        $this->request->allowMethod(['ajax']);
        $products = $this->__getItemsInCart();
        $cart = $this->request->getSession()->read('Cart.Products');

        $this->loadModel("Coupons");
        $coupons = $this->Coupons->find('all', [
            'conditions' => [
                'deleted IS' => NULL,
                'status' => 'published',
                'expiry_date >=' => date('Y-m-d'),
                'value >' => 0,
                'user_id' => ''
            ],
        ])->orderDesc('id')->limit(2);

        $this->set(compact('products', 'cart', 'coupons'));
        $this->render('cartdata');
    }

    public function removeFromCart($product_id)
    {

        if ($this->Cart->remove($product_id)) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success']));
        }

        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error']));
    }

    private function __getItemsInCart()
    {
        if ($this->request->getSession()->check('Cart.Products')) {
            $itemsInCart = $this->request->getSession()->read('Cart.Products');
            $itemsInCart = array_keys($itemsInCart);

            if (!empty($itemsInCart)) {
                $products = $this->Products->find('ByIds', ['ids' => $itemsInCart, 'find' => 'fair'])->toArray();

                // Remove product from cart if product is delted
                $productIds = array_column($products, 'id');
                $diffIds = array_diff($itemsInCart, $productIds);

                if (!empty($diffIds)) {
                    foreach ($diffIds as $pId) {
                        $this->Cart->remove($pId);
                    }
                }
            } else {
                $products = [];
            }

            return $products;
        }
    }

    public function updateQuantity($product_id, $quantity)
    {
        $this->request->allowMethod(['ajax']);
        $response = $this->Cart->update($product_id, $quantity);
        return $this->response->withType('json')->withStringBody(json_encode($response));
    }

    public function checkout()
    {

        $cartItems = $this->__getItemsInCart();

        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                if (!$item->in_stock) {
                    $this->Flash->error('Some products in your cart are currently out of stock');
                    return $this->redirect(['action' => 'display']);
                }
            }
        }

        $this->loadModel('Addresses');
        $address = $this->Addresses->newEntity();

        $savedaddresses = $this->Addresses->find('all', [
            'conditions' => ['Addresses.user_id' => $this->Auth->user('id')],
            'contain' => ['Countries', 'Zones'],
        ])->toArray();

        // Handel requests come from checkout page when customer choose addresses and payment method
        $shipping_address = $billing_address = $payment_method = 0;
        if ($this->request->is('ajax')) {
            $postData = $this->request->getData();
            @extract($postData);

            if ($postData['request_type'] === 'shipping_address') {
                $shipping_address = $selected_address;
                $billing_address = $selected_address;
            }

            if ($postData['request_type'] === 'billing_address') {
                $billing_address = $selected_address;
            }

            // Shipping address
            if (!empty($shipping_address)) {
                $arr_key = array_search((int)$shipping_address, array_column($savedaddresses, 'id'));
                $selected_shipping_address = $savedaddresses[$arr_key];

                //Calculating shipping cost
                $response = $this->__calculateShippingRate($selected_shipping_address);

                if ($response['status'] === 'error') {
                    return $this->response->withType('json')->withStringBody(json_encode($response));
                }

                $this->loadModel('ShippingZones');
                $shippingZone = $this->ShippingZones->find('all', [
                    'conditions' => ['postcode' => $selected_shipping_address->postcode]
                ])->first();
                $this->set('selected_shipping_address', $selected_shipping_address);
                $this->set('shippingZone', $shippingZone);
            }


            // Billing address
            if (!empty($billing_address)) {
                $arr_key = array_search((int)$billing_address, array_column($savedaddresses, 'id'));
                $selected_billing_address = $savedaddresses[$arr_key];
                $this->set('selected_billing_address', $selected_billing_address);
            }
        }

        //end ---

        $countries = $this->Addresses->Countries->find('list');
        $zones = $this->Addresses->Zones->find('list');

        $this->loadModel("Coupons");
        $coupons = $this->Coupons->find('all', [
            'conditions' => [
                'deleted IS' => NULL,
                'status' => 'published',
                'expiry_date >=' => date('Y-m-d'),
                'value >' => 0,
            ],
        ])->orderDesc('id')->limit(2);

        $this->set(compact('address', 'countries', 'zones', 'savedaddresses', 'shipping_address', 'billing_address', 'payment_method', 'coupons'));
    }

    private function __calculateShippingRate($address)
    {
        return $this->Cart->addShippingCost($address);
    }

    public function getPaymentMethod($payment_method)
    {
        $this->request->allowMethod(['ajax']);
        $this->render('payment_method/' . $payment_method);
    }

    public function placeorder()
    {
        $this->request->allowMethod(['ajax', 'post']);

        // Validating stock status
        $item_status = $this->__validate_cart();

        if (!empty($item_status)) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => count($item_status) . ' items in your cart are out of stock']));
        }

        extract($this->request->getData());

        // Validating captcha
        /* if ($payment_method === 'cod') {
            $http = new Client();
            $response = $http->get("https://www.google.com/recaptcha/api/siteverify?secret= " . env('GOOGLE_CAPTCHA_SECRET') . "&response=$g_recaptcha_response&remoteip=" . $this->request->clientIp());

            if ($response->isOk()) {
                $response = $response->json;
                if (!$response['success']) {
                    return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Captcha couldn\'t be verified.']));
                }
            } else {
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Captcha couldn\'t be verified.']));
            }
        } */
        // Validating captcha end

        if (!isset($gst)) {
            $gst = "Not provided";
        }

        $order = $this->__saveOrder($shipping_address, $billing_address, $payment_method, $gst);

        if ($order['status'] === 'error') {
            return $this->response->withType('json')->withStringBody(json_encode($order));
        }

        if ($payment_method === 'paypal') {
            $this->loadComponent('Paypal');
            $request = $this->Paypal->createOrder($order['order_details']);
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'request' => $request], JSON_NUMERIC_CHECK));
        }

        if ($payment_method === 'payu') {
            $this->loadComponent('Payu');
            $payu = $this->Payu->generateFormData($order['order_details']);
            return $this->response->withType('json')->withStringBody(json_encode($payu));
        }

        return $this->response->withType('json')->withStringBody(json_encode($order + ['redirect_uri' => \Cake\Routing\Router::url(['controller' => 'Orders', 'action' => 'confirm', $order['order_id']], true)]));
    }

    // To validate stock availability of added products in cart
    private function __validate_cart()
    {
        $cart_items = $this->__getItemsInCart();
        $status = [];

        foreach ($cart_items as $item) {
            if (!$item->in_stock) {
                array_push($status, $item->name . ' - Out of stock');
            }
        }

        return $status;
    }

    // Saving new order in database
    private function __saveOrder($billing_address_id, $shipping_address_id, $payment_method, $gst)
    {
        $this->loadModel('Orders');
        $this->loadModel('Addresses');

        try {
            $saddress = $this->Addresses->get($shipping_address_id, [
                'contain' => ['Countries', 'Zones']
            ]);
            $baddress = $this->Addresses->get($billing_address_id, [
                'contain' => ['Countries', 'Zones']
            ]);
        } catch (\RuntimeException $e) {
            return ['status' => 'error', 'message' => 'Address not found!'];
        }

        $currency = $this->getRequest()->getSession()->read('Config.defaultCurrency');

        $cod_amount = 0;
        if ($payment_method === 'cod') {
            $cod_amount = round(($this->request->getSession()->read('Cart.CartDetails.grantTotal') * \Cake\Core\Configure::read('Store.codChargesInPercent')) / 100);
            $cod_amount = ($cod_amount < \Cake\Core\Configure::read('Store.minCodAmount')) ? \Cake\Core\Configure::read('Store.minCodAmount') : $cod_amount;
        }

        $order = [
            'user_id' => $this->Auth->user('id'),
            'name' => $baddress->name,
            'email' => $this->Auth->user('email'),
            'phone' => $baddress->phone_with_code,
            // Shipping details
            'sname' => $saddress->name,
            'sphone' => $saddress->phone_with_code,
            'saddress' => $saddress->address,
            'scity' => $saddress->city,
            'scountry' => $saddress->country->name,
            'szone' => $saddress->zone->name,
            'spostcode' => $saddress->postcode,
            // Billing details
            'bname' => $baddress->name,
            'bphone' => $baddress->phone_with_code,
            'baddress' => $baddress->address,
            'bcity' => $baddress->city,
            'bcountry' => $baddress->country->name,
            'bzone' => $baddress->zone->name,
            'bpostcode' => $baddress->postcode,
            // Order details
            'payment_method' => $payment_method,
            'shipping_method' => $this->request->getSession()->read('Cart.CartDetails.shippingDetails.Details.ServiceType'),
            'status' => $payment_method === 'cod' ? 'processing' : 'pending-payment',
            'currency_code' => $currency->code,
            'currency_value' => $currency->value,
            'total_price' => $this->request->getSession()->read('Cart.CartDetails.cartTotal'),
            'discount' => $this->request->getSession()->read('Cart.CartDetails.cartDiscount'),
            'coupon_discount' => $this->request->getSession()->read('Cart.CartDetails.couponDiscount'),
            'sub_total' => $this->request->getSession()->read('Cart.CartDetails.subTotal'),
            'tax_charges' => 0,
            'tax_class' => 'GST',
            'shipping_charges' => $this->request->getSession()->read('Cart.CartDetails.shippingCharges'),
            'cod_charges' => $cod_amount,
            'grand_total' => $this->request->getSession()->read('Cart.CartDetails.grantTotal') + $cod_amount,
            'customer_notified' => 'no',
            'gst' => $gst
        ];

        $order['products'] = $this->__map_products_with_order();


        if ($this->request->getSession()->check('Cart.Coupon')) {
            $coupon = $this->request->getSession()->read('Cart.Coupon');
            $order['coupons'] = [
                [
                    'id' => $coupon->id,
                    '_joinData' => [
                        'coupon_code' => $coupon->code,
                        'type' => $coupon->type,
                        'discount' => $coupon->value,
                        'user_id' => $this->Auth->user('id'),
                    ],
                ]
            ];
        }

        $order_entity = $this->Orders->newEntity();
        $order = $this->Orders->patchEntity($order_entity, $order);

        if ($this->Orders->save($order)) {
            return ['status' => 'success', 'order_id' => $order->id, 'order_details' => $order];
        }

        return ['status' => 'error', 'message' => 'Order couldn\'t be saved.'];
    }

    private function __map_products_with_order()
    {
        $products = [];
        $products_in_cart = $this->__getItemsInCart();

        $cart = $this->request->getSession()->read('Cart.Products');

        foreach ($products_in_cart as $product_in_cart) {
            $product = [
                'id' => $product_in_cart->id,
                '_joinData' => [
                    'name' => $product_in_cart->name,
                    'price' => $product_in_cart->currency_regular_price,
                    'sale_price' => $product_in_cart->currency_sale_price,
                    'quantity' => $cart[$product_in_cart->id]['qty'],
                ],
            ];

            array_push($products, $product);
        }

        return $products;
    }

    public function applyCoupon()
    {
        $this->request->allowMethod(['ajax']);

        $coupon = $this->Cart->applyCoupon($this->request->getData('coupon_code'));

        if ($coupon['status'] === 'success') {
            $this->Cart->calculate_cart();
        }

        return $this->response->withType('json')->withStringBody(json_encode($coupon));
    }

    public function removeCoupon()
    {
        $this->Cart->removeCouponCode();
        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success']));
    }
}
