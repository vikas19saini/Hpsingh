<?php

namespace App\Controller;

use App\Controller\AppController;

class PaymentsController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['validatePayuPyments']);
        $this->Auth->allow(['confirm']);
    }

    public function initialize() {
        parent::initialize();
        $this->loadModel('Orders');
    }

    public function validatePpaypalPayment($order_id) {
        $this->loadComponent('Paypal');

        $capture_response = $this->Paypal->capturePayment($order_id);
        $order_request_response = $this->Paypal->getOrderDetails($order_id);

        if (!(is_object($order_request_response) && is_object($capture_response))) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Payment couldn\'t be verified, Please contact us.']));
        }

        if (property_exists($capture_response, 'error')) {
            if ($capture_response->error === 'INSTRUMENT_DECLINED') {
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'restart', 'message' => 'Payment method rejected']));
            }
        }

        $response = [];

        if (strcasecmp($capture_response->result->status, 'COMPLETED') !== 0) {
            $response = ['status' => 'error', 'message' => 'Payment couldn\'t be completed'];
        } else {
            if ($capture_response->result->purchase_units[0]->payments->captures[0]->amount->value === $order_request_response->result->purchase_units[0]->amount->value) {
                $response = ['status' => 'success', 'redirect_uri' => \Cake\Routing\Router::url(['controller' => 'Orders', 'action' => 'confirm', $capture_response->result->purchase_units[0]->payments->captures[0]->custom_id])];
            } else {
                $response = ['status' => 'error', 'message' => 'Payment couldn\'t be verified, Please contact us.'];
            }
        }

        // Save payment details
        $payment = $this->Payments->newEntity();
        $payment = $this->Payments->patchEntity($payment, [
            'order_id' => $capture_response->result->purchase_units[0]->payments->captures[0]->custom_id,
            'amount' => $capture_response->result->purchase_units[0]->payments->captures[0]->amount->value,
            'currency_code' => $capture_response->result->purchase_units[0]->payments->captures[0]->amount->currency_code,
            'transaction_no' => $capture_response->result->purchase_units[0]->payments->captures[0]->id,
            'payment_method' => 'paypal',
            'status' => $capture_response->result->status,
            'links' => json_encode($capture_response->result->purchase_units[0]->payments->captures[0]->links),
            'details' => json_encode($capture_response->result->payer),
        ]);

        $this->Payments->save($payment);
        return $this->response->withType('json')->withStringBody(json_encode($response));
    }

    public function paypalPaymentCancel($order_id) {
        $this->loadComponent('Paypal');

        $order_request_response = $this->Paypal->getOrderDetails($order_id);
        $this->Orders->updateStatus($order_request_response->result->purchase_units[0]->custom_id, 'failed', 'no', 'yes'); // Update order status to failed
        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Payment cancelled.']));
    }

    public function validatePayuPyments() {

        $this->loadComponent('Payu');

        $payment_status = $this->request->getQuery('status');

        if (empty($payment_status)) {
            $this->Flash->error('Oops, something went wrong if any amount deducted then please contact us.');
            return $this->redirect(['controller' => 'Cart', 'action' => 'checkout']);
        }

        extract($this->request->getData());

        switch ($payment_status) {
            case 'success':
                // If payment status is success
                try {
                    $order = $this->Orders->get($udf1);
                    if ($this->Payu->authorizePayment($this->request->getData())) {
                        $payment = $this->Payments->newEntity();
                        $payment = $this->Payments->patchEntity($payment, [
                            'order_id' => $udf1,
                            'amount' => $net_amount_debit,
                            'currency_code' => 'INR',
                            'transaction_no' => $txnid,
                            'payment_method' => 'Payu',
                            'status' => $status,
                            'details' => json_encode($this->request->getData()),
                        ]);
                        $this->Payments->save($payment);
                        $this->Orders->updateStatus($udf1, 'processing', 'no', 'yes'); // Update order status to failed
                        return $this->redirect(['controller' => 'orders', 'action' => 'confirm', $udf1]);
                    } else {
                        $this->Flash->error('Transaction tampered. Please try again or contact us.');
                    }
                } catch (\RuntimeException $e) {
                    $this->Flash->error('Order not found, please contact us.');
                }

                $this->Orders->updateStatus($udf1, 'failed', 'yes', 'yes');
                break;
            case 'fail':
                $this->Flash->error('The payment has been declined.');
                break;
            case 'cancel':
                $this->Flash->error('As per your request payment has been canceled.');
                break;
        }

        $this->Orders->updateStatus($udf1, 'failed', 'yes', 'yes');
        return $this->redirect(['controller' => 'Cart', 'action' => 'checkout']);
    }

}
