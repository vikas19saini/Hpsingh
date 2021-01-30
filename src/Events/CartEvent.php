<?php

namespace App\Events;

use Cake\Event\EventListenerInterface;

class CartEvent implements EventListenerInterface {

    private $CartTable;

    public function implementedEvents() {
        return [
            'Component.Cart.afterAdd' => 'saveToCart',
            'Component.Cart.afterRemove' => 'removeFromCart',
            'Controller.Cart.afterOrder' => 'clearCart',
        ];
    }

    public function __construct() {
        $this->CartTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Cart');
    }

    public function saveToCart($event) {
        $product = $event->getData('product') + ['user_id' => $event->getData('user_id')];

        if ($this->CartTable->exists(['user_id' => $product['user_id'], 'product_id' => $product['product_id']])) {
            $this->CartTable->deleteAll(['user_id' => $product['user_id'], 'product_id' => $product['product_id']]);
        }

        $cartItem = $this->CartTable->newEntity($product);
        $this->CartTable->save($cartItem);
    }

    public function removeFromCart($event) {
        $this->CartTable->deleteAll(['user_id' => $event->getData('user_id'), 'product_id' => $event->getData('product_id')]);
    }

    public function clearCart($event) {
        $this->CartTable->deleteAll(['user_id' => $event->getData('user_id')]);
    }

}
