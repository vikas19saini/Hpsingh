<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class OrderComponent extends Component {

    protected $_defaultConfig = [];
    private $Orders, $Products, $OrderHistory;

    public function initialize(array $config) {
        parent::initialize($config);

        $this->Orders = \Cake\ORM\TableRegistry::getTableLocator()->get('Orders');
        $this->Products = \Cake\ORM\TableRegistry::getTableLocator()->get('Products');
    }

    public function update_product_quantity($order, $action) {
        if (!$order->has('products')) {
            return false;
        }

        $products = [];

        foreach ($order->products as $product) {

            if ($product->manage_stock === 'yes' && !empty($product->quantity)) {

                if ($action === '-') {
                    $quantity = $product->quantity - $product->_joinData->quantity;
                }

                if ($action === '+') {
                    $quantity = $product->quantity + $product->_joinData->quantity;
                }

                $product->set('quantity', $quantity);
                array_push($products, $product);
            }
        }

        if ($this->Products->saveMany($products)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStatus($order_id, $new_status) {
        try {
            $this->Orders->query()->update()->set(['status' => $new_status])->where(['id' => $order_id])->execute();
            $this->addOrderHistory([
                'order_id' => $order_id,
                'status' => $new_status,
                'notify_customer' => 'no',
                'is_private' => 'Status changed to ' . $new_status,
            ]);
        } catch (\RuntimeException $e) {
            return;
        }
    }

    public function addOrderHistory($params) {
        $this->OrderHistory = \Cake\ORM\TableRegistry::getTableLocator()->get('OrderHistory');
        $order_history = $this->OrderHistory->newEntity();
        $order_history = $this->OrderHistory->patchEntity($order_history, $params);
        $this->OrderHistory->save($order_history);
        return;
    }

}
