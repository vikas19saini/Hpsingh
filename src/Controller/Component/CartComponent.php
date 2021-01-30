<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Cart component
 */
class CartComponent extends Component
{

    protected $_defaultConfig = [];
    public $components = ['Auth', 'Flash', 'Fedex'];
    private $Products;
    private $Coupons;
    private $CartTable;

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->Products = \Cake\ORM\TableRegistry::getTableLocator()->get('Products');
        $this->Coupons = \Cake\ORM\TableRegistry::getTableLocator()->get('Coupons');
        $this->CartTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Cart');
    }

    public function add($product, $quantity = 1)
    {

        if (!$product->in_stock) {
            return ['status' => 'error', 'message' => 'Product is out of stock.'];
        }

        $qtyCheck = $this->__validateQuantity($product, $quantity);

        if ($qtyCheck['status'] === 'error') {
            return $qtyCheck;
        }

        $product_details = [
            'product_id' => $product->id,
            'qty' => $quantity,
            'regular_price' => $product->currency_regular_price,
            'price' => $product->price,
            'discount' => $product->on_sale ? $product->currency_regular_price - $product->currency_sale_price : 0,
            'coupon_discount' => 0,
            'coupon_message' => '',
            'total' => $product->price * $quantity,
        ];

        $this->request->getSession()->write('Cart.Products.' . $product->id, $product_details);
        $this->calculate_cart();

        if ($this->request->getSession()->check('Cart.Coupon')) {
            $this->applyCoupon($this->request->getSession()->read('Cart.Coupon'));
        }

        $this->triggerEvent('saveToCart', $product_details);

        return ['status' => 'success', 'message' => 'Added to cart.'];
    }

    public function remove($product_id)
    {
        if ($this->request->getSession()->check('Cart.Products.' . $product_id)) {
            $this->request->getSession()->delete('Cart.Products.' . $product_id);

            $this->calculate_cart();

            if ($this->request->getSession()->check('Cart.Coupon')) {
                $this->applyCoupon($this->request->getSession()->read('Cart.Coupon'));
            }

            $this->triggerEvent('removeFromCart', $product_id);

            return true;
        }

        return false;
    }

    private function __validateQuantity($product, $qty)
    {

        if (!empty($product->min_order_qty)) {
            if (!($qty >= $product->min_order_qty)) {
                return ['status' => 'error', 'message' => 'Minimum order quantity is : ' . $product->min_order_qty];
            }
        }

        if (!empty($product->max_order_qty)) {
            if (!($qty <= $product->max_order_qty)) {
                return ['status' => 'error', 'message' => 'Maximum order quantity is : ' . $product->max_order_qty];
            }
        }

        return ['status' => 'success'];
    }

    public function update($product_id, $quantity)
    {
        if ($this->request->getSession()->check('Cart.Products.' . $product_id)) {
            $product_details = $this->request->getSession()->read('Cart.Products.' . $product_id);

            try {
                $product = $this->Products->get($product_id);
            } catch (\RuntimeException $e) {
                return ['status' => 'error', 'message' => 'Product not found'];
            }

            $quantityCheck = $this->__validateQuantity($product, $quantity);

            if ($quantityCheck['status'] === 'error') {
                return $quantityCheck;
            }

            $product_details['qty'] = $quantity;
            $product_details['total'] = $product_details['price'] * $quantity;
            $this->request->getSession()->write('Cart.Products.' . $product_id, $product_details);

            $this->calculate_cart();

            if ($this->request->getSession()->check('Cart.Coupon')) {
                $this->applyCoupon($this->request->getSession()->read('Cart.Coupon'));
            }
        }
        return ['status' => 'success'];
    }

    public function calculate_cart()
    {
        if ($this->request->getSession()->check('Cart.Products')) {
            $cart_products = $this->request->getSession()->read('Cart.Products');

            $cart_details = [
                'totalItems' => count($cart_products),
                'cartTotal' => 0,
                'cartDiscount' => 0,
                'couponDiscount' => 0,
                'subTotal' => 0,
                'shippingCharges' => 0,
                'grantTotal' => 0
            ];

            foreach ($cart_products as $product) {
                $cart_details['cartTotal'] += $product['regular_price'] * $product['qty'];
                $cart_details['cartDiscount'] += $product['discount'] * $product['qty'];

                $cart_details['couponDiscount'] += $product['coupon_discount'];
            }

            $cart_details['subTotal'] = $cart_details['cartTotal'] - $cart_details['cartDiscount'] - $cart_details['couponDiscount'];

            if ($this->request->getSession()->check('Cart.CartDetails.shippingCharges')) {
                $cart_details['shippingCharges'] = $this->request->getSession()->read('Cart.CartDetails.shippingCharges');
            }

            $cart_details['grantTotal'] = $cart_details['subTotal'] + $cart_details['shippingCharges'];
        }

        $this->request->getSession()->write('Cart.CartDetails', $cart_details);
        return;
    }

    public function addShippingCost($address = null)
    {
        if (!is_object($address)) {
            return false;
        }

        $response = [];

        if (strtolower($address->country->name) === 'india') {

            $shippingZones = TableRegistry::getTableLocator()->get('ShippingZones');
            $postCode = $shippingZones->find('all', [
                'conditions' => ['postcode' => $address->postcode]
            ])->first();

            if (is_null($postCode)) {
                return $response = [
                    'status' => 'error',
                    'message' => 'Shipping is not available, Please contact us for more details.',
                ];
            }

            if (strtolower($postCode->availability) === 'no') {
                return $response = [
                    'status' => 'error',
                    'message' => 'Shipping is not available, Please contact us for more details.',
                ];
            }

            $this->request->getSession()->write('Cart.CartDetails.shippingCharges', 0);
            $deliveryDate = new \Cake\I18n\Time('+5 days');

            $response = [
                'status' => 'success',
                'ServiceType' => 'Smartship',
                'DeliveryDate' => $deliveryDate->nice(),
                'DeliveryDayOfWeek' => $deliveryDate->format('D'),
            ];
        } else {
            $product_ids = array_keys($this->request->getSession()->read('Cart.Products'));

            $products = $this->Products->find('all', [
                'conditions' => ['Products.id IN' => $product_ids],
            ])->toArray();

            $fedexResponse = $this->Fedex->getEstimatedRate($address, $products, $this->request->getSession()->read('Cart.Products'));

            if ($fedexResponse['status'] === 'success') {
                $this->request->getSession()->write('Cart.CartDetails.shippingCharges', $fedexResponse['DeliveryCharges']);
            }

            $response = $fedexResponse;
        }
        $this->calculate_cart();

        if ($response['status'] === 'success') {
            $shippingDetails = [
                'Address' => $address->formatted_address,
                'Details' => $response,
                'Country' => $address->country->name,
            ];
            $this->request->getSession()->write('Cart.CartDetails.shippingDetails', $shippingDetails);
        }
        return $response;
    }

    public function applyCoupon($coupon)
    {
        $cart_details = $this->request->getSession()->read('Cart.CartDetails');
        $cart_details['grantTotal'] += $cart_details['couponDiscount'];

        $coupon = $this->Coupons->getAndValidateCoupon($coupon, $this->Auth->user(), $cart_details);

        if ($coupon['status'] === 'error') {
            $this->removeCouponCode();
            return $coupon;
        }

        $coupon = $coupon['coupon'];
        $this->request->getSession()->write('Cart.Coupon', $coupon);

        $product_ids = array_keys($this->request->getSession()->read('Cart.Products'));

        $products = $this->Products->find('all', [
            'conditions' => ['Products.id IN' => $product_ids],
            'contain' => ['Categories' => function ($query) {
                return $query->select(['Categories.id']);
            }],
        ])->toArray();


        // For fixed coupon discount
        if ($coupon->type === 'fixed') {
            $discount_amount_fixed = $this->calculateFixedCouponAmount($products, $coupon, count($this->request->getSession()->read('Cart.Products')));

            foreach ($products as $product) {
                if ($this->validate_coupon_to_product($product, $coupon)) {
                    $product_price = $product->price * $this->request->getSession()->read('Cart.Products.' . $product->id . '.qty');
                    $diff = floor($product_price - $discount_amount_fixed);
                    if ($diff > 1) {
                        $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_discount', $discount_amount_fixed);
                        $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_message', 'Coupon applied');
                    } else {
                        $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_discount', 0);
                        $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_message', 'Not applicable');
                    }
                } else {
                    $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_discount', 0);
                    $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_message', 'Not applicable');
                }
            }
        }

        if ($coupon->type === 'percent') {
            foreach ($products as $product) {
                if ($this->validate_coupon_to_product($product, $coupon)) {
                    $product_details = $this->request->getSession()->read('Cart.Products.' . $product->id);
                    $discount_amount = $product_details['total'] * $coupon->value / 100;

                    $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_discount', $discount_amount);
                    $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_message', 'Coupon applied');
                } else {
                    $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_discount', 0);
                    $this->request->getSession()->write('Cart.Products.' . $product->id . '.coupon_message', 'Not applicable');
                }
            }
        }

        $this->calculate_cart();
        return ['status' => 'success'];
    }

    private function calculateFixedCouponAmount($products, $coupon, $total_products)
    {
        $applicable_products = 0;
        $amount = $coupon->coupon_currency_value / $total_products;
        foreach ($products as $product) {
            if ($this->validate_coupon_to_product($product, $coupon)) {
                $product_price = $product->price * $this->request->getSession()->read('Cart.Products.' . $product->id . '.qty');
                $diff = floor($product_price - $amount);
                if ($diff > 1) {
                    $applicable_products++;
                }
            }
        }

        if ($applicable_products === $total_products) {
            return $amount;
        } else {
            return $this->calculateFixedCouponAmount($products, $coupon, $applicable_products);
        }
    }

    private function validate_coupon_to_product($product, $coupon)
    {
        if ($coupon->exclude_sale_items) {
            if ($product->on_sale) {
                return false;
            }
        }

        // Include products
        if (!empty($coupon->products)) {
            $included_products = explode(',', $coupon->products);
            if (!in_array($product->id, $included_products)) {
                return false;
            }
        }

        // Exclude products
        if (!empty($coupon->exclude_products)) {
            $exclude_products = explode(',', $coupon->exclude_products);
            if (in_array($product->id, $exclude_products)) {
                return false;
            }
        }

        $categories_ids = array_map(function ($category) {
            return $category->id;
        }, $product->categories);

        // Include categoriess
        if (!empty($coupon->categories)) {
            $include_categories = explode(',', $coupon->categories);
            $array_intersact = array_intersect($categories_ids, $include_categories);
            if (empty($array_intersact)) {
                return false;
            }
        }

        // Exclude categories
        if (!empty($coupon->exclude_categories)) {
            $exclude_categories = explode(',', $coupon->exclude_categories);
            $array_diff = array_diff($categories_ids, $exclude_categories);
            if (empty($array_diff)) {
                return false;
            }
        }
        return true;
    }

    public function removeCouponCode()
    {
        $this->request->getSession()->delete('Cart.Coupon');
        $cart_products = $this->request->getSession()->read('Cart.Products');
        foreach ($cart_products as $cart_product) {
            $this->request->getSession()->write('Cart.Products.' . $cart_product['product_id'] . '.coupon_discount', 0);
            $this->request->getSession()->write('Cart.Products.' . $cart_product['product_id'] . '.coupon_message', '');
        }
        $this->calculate_cart();
        return;
    }

    public function resetShipping()
    {
        if ($this->request->getSession()->check('Cart.CartDetails.shippingCharges')) {
            $this->request->getSession()->delete('Cart.CartDetails.shippingCharges');
            $this->request->getSession()->delete('Cart.CartDetails.shippingDetails');
            $this->calculate_cart();
        }
        return true;
    }

    private function triggerEvent($eventName, $product_details = [])
    {
        // Trigger cart event to update cart table..
        if (!empty($this->Auth->user('id'))) {

            switch ($eventName) {
                case 'saveToCart':
                    $event = new Event('Component.Cart.afterAdd', $this, ['product' => $product_details, 'user_id' => $this->Auth->user('id')]);
                    $this->getController()->getEventManager()->dispatch($event);
                    break;
                case 'removeFromCart':
                    $event = new Event('Component.Cart.afterRemove', $this, ['product_id' => $product_details, 'user_id' => $this->Auth->user('id')]);
                    $this->getController()->getEventManager()->dispatch($event);
                    break;
            }
        }
    }

    // Merging cart after login
    public function mergeCart()
    {
        if ($this->request->getSession()->check('Cart.Products')) {
            $cartItems = $this->request->getSession()->read('Cart.Products');
            $cartItemsToSave = [];
            foreach ($cartItems as $key => $item) {
                if ($this->CartTable->exists(['user_id' => $this->Auth->user('id'), 'product_id' => $item['product_id']])) {
                    $this->CartTable->deleteAll(['user_id' => $this->Auth->user('id'), 'product_id' => $item['product_id']]);
                }

                array_push($cartItemsToSave, $item + ['user_id' => $this->Auth->user('id')]);
            }

            $cartItemsToSave = $this->CartTable->newEntities($cartItemsToSave);
            $this->CartTable->saveMany($cartItemsToSave);
        }

        $cartItems = $this->CartTable->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'contain' => ['Products' => ['fields' => ['id', 'ragular_price', 'sale_price', 'manage_stock', 'stock']]]
        ]);


        foreach ($cartItems as $item) {
            $this->add($item->product, $item->qty);
        }
    }

}
