<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class OrdersController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Order');
        $this->Auth->deny(['customerAction']);
    }

    public function confirm($order_id)
    {
        $order = $this->Orders->get($order_id, [
            'contain' => ["products"]
        ]);
        $this->request->getSession()->delete('Cart');

        // Clear cart items from database
        $event = new Event('Controller.Cart.afterOrder', $this, ['user_id' => $order->user_id]);
        $this->getEventManager()->dispatch($event);
        // End
        $showAnalytics = true;
        $this->set(compact('order', 'showAnalytics'));
    }

    public function customerAction($order_id, $action)
    {
        $order = $this->Orders->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id'), 'id' => $order_id],
        ])->first();

        if (!$order) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Oops something went wrong, Please contact us.']));
        }

        switch ($action) {
            case "cancel-order":
                if ($order->status !== 'processing') {
                    return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Order could\'t be cancelled, Please contact us.']));
                }

                if ($this->Orders->updateStatus($order->id, 'cancelled', 'no', 'yes')) {
                    return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'message' => 'Your Order has been cancelled.']));
                }

                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Order could\'t be cancelled, Please contact us.']));
                break;
            case "send-invoice":
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'message' => 'Invoice has been sent.']));
                break;
        }
    }
}
