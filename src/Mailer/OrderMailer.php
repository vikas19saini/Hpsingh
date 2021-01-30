<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\Http\Client;

class OrderMailer extends Mailer
{

    static public $name = 'Order';

    public function confirm($order)
    {

        $this
            ->setTo($order->email)
            ->setSubject('Your ' . \Cake\Core\Configure::read('Store.name') . ' order has been received!')
            ->setTemplate('order/confirm')
            ->setEmailFormat('html')
            ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
            ->set(['order' => $order]);

        // Sending Sms to customer
        $this->sendSms($order);
    }

    public function statusUpdte($order)
    {
        $this
            ->setTo($order->email)
            ->setSubject('Your ' . \Cake\Core\Configure::read('Store.name') . ' order status updated to - ' . ucwords(str_replace('-', ' ', $order->status)))
            ->setTemplate('order/' . $order->status)
            ->setEmailFormat('html')
            ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
            ->set(['order' => $order]);

        // Sending Sms to customer
        $this->sendSms($order);
    }

    public function sendToAdmin($order)
    {
        // Sending notification to Admin
        $this
            ->setTo(\Cake\Core\Configure::read('Store.email'))
            ->setCc(\Cake\Core\Configure::read('Store.orderCcEmail'))
            ->setSubject('New ' . \Cake\Core\Configure::read('Store.name') . ' order received! ORDER ID #' . $order->id)
            ->setTemplate('order/admin/confirm')
            ->setEmailFormat('html')
            ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
            ->set(['order' => $order]);
        // Sending Sms to customer
    }

    public function sendSms($order)
    {

        if (strtolower($order->scountry) !== 'india') {
            return false;
        }

        $to = $order->bphone;
        $message = '';
        $order_status = ucwords(str_replace('-', ' ', $order->status));
        switch ($order->status) {
            case 'pending-payment':
                $message = "Hello $order->bname, status of your order #$order->id with Hpsingh has been changed to $order_status.";
                break;
            case 'failed':
                $message = "Hello $order->bname, status of your order #$order->id with Hpsingh has been changed to $order_status.";
                break;
            case 'processing':
                $message = "Hello $order->bname, thank you for placing your order #$order->id with Hpsingh.";
                break;
            case 'shipped':
                $message = \Cake\Core\Configure::read('Store.name') . ': status of order #' . $order->id . ' has been changed to ' . ucwords(str_replace('-', ' ', $order->status)) . '.';
                break;
            case 'completed':
                $message = "Hello $order->bname, your order #$order->id with Hpsingh has been dispatched and shall deliver to you shortly.";
                break;
            case 'on-hold':
                $message = "Hello $order->bname, your order #$order->id with Hpsingh has been put on hold, our team will contact you shortly with more details.";
                break;
            case 'cancelled':
                $message = "Hello $order->bname, your order #$order->id with Hpsingh has been cancelled due to some un-avoidable conditions. Sorry for the inconvenience caused.";
                break;
            case 'refunded':
                $message = "Hello $order->bname, status of your order #$order->id with Hpsingh has been changed to $order_status.";
                break;
        }

        $message = rawurlencode($message);

        $url = "https://www.smsalert.co.in/api/push.json?apikey= " . env('SMS_ALERT_KEY') . "&route=transactional&sender=" . env('SMS_ALERT_SENDER') . "&mobileno=$to&text=$message";

        try {
            $http = new Client();
            $response = $http->get($url);

            if ($response->isOk()) {
                return true;
            }

            return false;
        } catch (\RuntimeException $e) {
            return false;
        }
    }

}
