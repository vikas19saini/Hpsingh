<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Users mailer.
 */
class UsersMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Users';

    public function sendOtp($user){

        $this
                ->setTo($user->email)
                ->setSubject(\Cake\Core\Configure::read('Store.name') . ' account verification')
                ->setTemplate('users/otp')
                ->setEmailFormat('html')
                ->setLayout('user')
                ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
                ->set(['user' => $user]);
    }

    public function resetPassword($user){
        $this
                ->setTo($user->email)
                ->setSubject(\Cake\Core\Configure::read('Store.name') . ' password reset')
                ->setTemplate('users/reset')
                ->setEmailFormat('html')
                ->setLayout('user')
                ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
                ->set(['user' => $user]);
    }

    public function confirmPasswordChanged($user){
        $this
                ->setTo($user->email)
                ->setSubject(\Cake\Core\Configure::read('Store.name') . ' password reset confirmation')
                ->setTemplate('users/password_changed')
                ->setEmailFormat('html')
                ->setLayout('user')
                ->setFrom(\Cake\Core\Configure::read('Store.emailFrom'), \Cake\Core\Configure::read('Store.name'))
                ->set(['user' => $user]);
    }
}
