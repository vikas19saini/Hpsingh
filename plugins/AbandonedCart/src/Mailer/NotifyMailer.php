<?php

namespace AbandonedCart\Mailer;

use Cake\Mailer\Mailer;

/**
 * Notify mailer.
 */
class NotifyMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Notify';

    public function notifyCustomer($cartDetails = null)
    {
        $this
            ->setTo($cartDetails['email'])
            ->setSubject(\Cake\Core\Configure::read('Store.name') . ' Did you have checkout trouble?')
            ->setTemplate('AbandonedCart.notify')
            ->setLayout('AbandonedCart.cart')
            ->setEmailFormat('html')
            ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
            ->set(['cartDetails' => $cartDetails]);
    }
}
