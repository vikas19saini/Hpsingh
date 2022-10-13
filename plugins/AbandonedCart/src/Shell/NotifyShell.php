<?php

namespace AbandonedCart\Shell;

use Cake\Console\Shell;
use Cake\Mailer;

/**
 * Notify shell command.
 */
class NotifyShell extends Shell
{

    use Mailer\MailerAwareTrait;

    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('AbandonedCart.Sessions');

        /* $start_date = (new \DateTime('-1 hours'))->format('Y-m-d H:i:s');
        $end_date = (new \DateTime())->format('Y-m-d H:i:s');

        $sessions = $this->Sessions->find('all', [
            'conditions' => function ($q) use ($start_date, $end_date) {
                return $q->between('created', $start_date, $end_date);
            },
        ]); */

        $sessions = $this->Sessions->find('all', [
            'conditions' => ['notified !=' => 1]
        ]);


        foreach ($sessions as $session) {
            print_r($session);
            if (!empty($session->cart_total)) {
                $cartDetails = [
                    'products' => $session->products,
                    'name' => $session->customer_name,
                    'email' => $session->email_address,
                    'cartPriceBreakdown' => $session->cart_details,
                    'currency' => $session->default_currency,
                ];

                if (!empty($cartDetails['email'])) {
                    $this->getMailer('AbandonedCart.Notify')->send('notifyCustomer', [$cartDetails]);
                }
            }

            $sessionUpdate = $this->Session->patchEntity($session, ['notified' => 1]);
            $this->Sessions->save($sessionUpdate);
        }
    }
}
