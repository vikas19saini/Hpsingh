<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Mailer\MailerAwareTrait;
use Cake\Utility\Security;
use \Cake\Http\Exception\NotFoundException;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

class CustomerController extends AppController
{

    use MailerAwareTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Users');
        $this->Security->setConfig('unlockedActions', ['subscribeForNotification']);
        $this->Auth->deny(['myAccount', 'profile', 'addresses', 'orders', 'coupons', 'deleteAddress', 'editAddress']);
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', ['verification', 'profile', 'deleteAddress']);
    }

    public function React()
    {
    }

    public function signup()
    {

        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $postData = $this->request->getData();

            if ($postData['password'] === $postData['re-password']) {
                $postData['user_group'] = 'customer';
                $otp_key = $this->__generate_otp_and_key();
                $postData['activation_key'] = json_encode($otp_key);
                $user = $this->Users->patchEntity($user, $postData);
                if ($this->Users->save($user)) {
                    $this->getMailer('Users')->send('sendOtp', [$user]);
                    $this->Flash->success("Successfully signup, Please verify your details.");
                    return $this->redirect(['action' => 'verification', $user->email, $otp_key['key']]);
                } else {
                    $this->Flash->error("Couldn't register please try again!");
                }
            } else {
                $this->Flash->error("Passwords doesn't match, Please try again!");
            }
        }

        $this->loadModel('Countries');
        $countries = $this->Countries->find('list');

        $this->set(compact('countries', 'user'));
    }

    public function login()
    {
        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $user = $this->Users->get($user['id'], [
                    'contain' => ['Countries']
                ]);
                if ($user->activation_key === 'activated') {
                    $this->Auth->setUser($user);

                    // Merging Cart Items After login
                    $this->loadComponent('Cart');
                    $this->Cart->mergeCart();

                    $currentTime = Time::now();
                    $currentTime = $currentTime->i18nFormat(\IntlDateFormatter::FULL);

                    $user = $this->Users->patchEntity($user, [
                        'login_device' => $this->request->getEnv('HTTP_USER_AGENT'),
                        'last_login' => $currentTime,
                    ]);
                    $this->Users->save($user);

                    return $this->redirect($this->Auth->redirectUrl());
                } elseif ($user->activation_key === 'suspend') {
                    $this->Flash->error(_('Your account is suspended. Contact us for more details.'));
                } else {
                    $user = $this->Users->get($user['id']);
                    $otp_key = $this->__generate_otp_and_key();
                    $user = $this->Users->patchEntity($user, ['activation_key' => json_encode($otp_key)]);
                    if ($this->Users->save($user)) {
                        $this->getMailer('Users')->send('sendOtp', [$user]);
                        $this->Flash->success("You email is not verified, An otp has been send to your email address to verify email address.");
                        return $this->redirect(['action' => 'verification', $user->email, $otp_key['key']]);
                    }
                }
            } else {
                $this->Flash->error(_('Invalid credentials, Please try again!'));
            }
        }

        $this->set(compact('user'));
    }

    public function myAccount()
    {
    }

    public function profile()
    {
        $user = $this->Users->newEntity();
        $countries = $this->Users->Countries->find('list');

        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $user = $this->Users->get($this->Auth->user('id'));

            // Handel update info request
            if ($postData['requested_form'] === 'update_info') {
                if ($postData['email'] === $user->email) {
                    $user = $this->Users->patchEntity($user, $postData);

                    if ($this->Users->save($user)) {
                        $user = $this->Users->get($user->id, [
                            'contain' => ['Countries']
                        ]);
                        $this->Auth->setUser($user);
                        $this->Flash->success("Details has been updated.");
                        return $this->redirect(['action' => 'profile']);
                    } else {
                        $this->Flash->error("Details couldn't be updated, Please try again!");
                    }
                } else {
                    $this->Flash->error("You can't change email address.");
                }
            }

            // Handel password change request
            if ($postData['requested_form'] === 'change_password') {
                if ((new DefaultPasswordHasher())->check($postData['c_password'], $user->password)) {
                    if ($postData['new_password'] === $postData['confirm_new_password']) {
                        $user = $this->Users->patchEntity($user, ['password' => $postData['new_password']]);
                        if ($this->Users->save($user)) {
                            $this->Flash->success('Password has been changed.');
                        } else {
                            $this->Flash->error("Password couldn't changed, " . json_encode($user->getError('password')));
                        }
                    } else {
                        $this->Flash->error("Passwords doesn't match, Please try again!");
                    }
                } else {
                    $this->Flash->error('Incorrect current password');
                }
            }
        }

        $this->set(compact('user', 'countries'));
    }

    public function addresses()
    {
        $address = $this->Users->Addresses->newEntity();

        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $postData['user_id'] = $this->Auth->user('id');
            $address = $this->Users->Addresses->patchEntity($address, $postData);

            if ($this->Users->Addresses->save($address)) {
                $this->Flash->success("Address has been saved.");
            } else {
                $this->Flash->error("Address has not been saved, Check form details carefully!");
            }
        }

        if ($this->request->is('ajax')) {
            $postData = $this->request->getData();
            $postData['user_id'] = $this->Auth->user('id');
            $address = $this->Users->Addresses->patchEntity($address, $postData);

            if ($this->Users->Addresses->save($address)) {
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'Address has been saved.']));
            } else {
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'Address has not been saved, Check form details carefully!']));
            }
        }

        $addresses = $this->Users->Addresses->find('all', [
            'contain' => ['Countries', 'Zones'],
            'conditions' => ['Addresses.user_id' => $this->Auth->user('id')],
        ]);

        $countries = $this->Users->Addresses->Countries->find('list');
        $zones = $this->Users->Addresses->Zones->find('list');

        $this->set(compact('address', 'countries', 'zones', 'addresses'));
    }

    public function editAddress($address_id)
    {
        $address = $this->Users->Addresses->get($address_id, [
            'contain' => ['Countries', 'Zones'],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $address = $this->Users->Addresses->patchEntity($address, $this->request->getData());

            if ($this->Users->Addresses->save($address)) {
                $this->Flash->success('Successfully updated');
                return $this->redirect(['action' => 'addresses']);
            } else {
                $this->Flash->error("Couldn't be saved, Please try again!");
            }
        }

        $countries = $this->Users->Addresses->Countries->find('list');
        $zones = $this->Users->Addresses->Zones->find('list');

        $this->set(compact('address', 'countries', 'zones'));
    }

    public function deleteAddress($address_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $address = $this->Users->Addresses->get($address_id);

        $response = [];

        if ($address->user_id === $this->Auth->user('id')) {
            if ($this->Users->Addresses->delete($address)) {
                $response = ['status' => 'success', 'message' => 'Address has been deleted.'];
            } else {
                $response = ['status' => 'error', 'message' => 'Address couldn\'t be deleted.'];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Address couldn\'t be deleted.'];
        }

        // Handel ajax request
        if ($this->request->is('delete')) {
            return $this->response->withType('json')->withStringBody(json_encode($response));
        }

        // handel post request
        if ($response['status'] === 'error') {
            $this->Flash->error($response['message']);
        } else {
            $this->Flash->success($response['message']);
        }

        return $this->redirect(['action' => 'addresses']);
    }

    public function orders($order_id = null)
    {
        $this->loadModel('Orders');

        if (empty($order_id)) {
            $orders = $this->Orders->find('all', [
                'contain' => ['Products', 'Products.Media'],
                'conditions' => ['Orders.user_id' => $this->Auth->user('id')],
                'order' => ['Orders.id' => 'DESC']
            ]);
            $this->set(compact('orders'));
        } else {
            $order_details = $this->Orders->get($order_id, [
                'contain' => ['Products', 'Products.Media'],
            ]);
            $this->set(compact('order_details'));
            $this->render('order_details');
        }
    }

    public function coupons()
    {
        $this->loadModel('Coupons');
        $coupons = $this->Coupons->getCustomerCoupons($this->Auth->user('email'));

        $this->set(compact('coupons'));
    }

    public function reverify()
    {
        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }

        if ($this->request->is('post')) {
            $user = $this->Users->find('all', [
                'conditions' => ['email' => $this->request->getData('email')],
            ])->first();

            if (!$user) {
                $this->Flash->error("Email address is not registered");
            } else {

                if (($user->activation_key !== 'suspend') && ($user->activation_key !== 'activated')) {
                    $otp_key = $this->__generate_otp_and_key();
                    $user = $this->Users->patchEntity($user, ['activation_key' => json_encode($otp_key)]);
                    if ($this->Users->save($user)) {
                        $this->getMailer('Users')->send('sendOtp', [$user]);
                        $this->Flash->success("An otp has been send to your email address.");
                        return $this->redirect(['action' => 'verification', $user->email, $otp_key['key']]);
                    } else {
                        $this->Flash->error("Couldn't verify please try again!");
                    }
                } else {
                    $this->Flash->error("Couldn't perform this action.");
                }
            }
        }
    }

    public function verification($email, $key)
    {

        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }

        if (empty($email) || empty($key)) {
            return $this->redirect(['_name' => 'home']);
        }

        $user = $this->Users->find('all', [
            'conditions' => ['email' => $email],
            'contain' => ['Countries']
        ])->first();

        if (!$user) {
            throw new NotFoundException('Email address not registered with us');
        }

        if ($user->activation_key === 'activated') {
            return $this->redirect(['_name' => 'home']);
        }

        if ($this->request->is('post')) {

            $otp_key = json_decode($user->activation_key, true);
            $postData = $this->request->getData();

            if ($postData['req_type'] === 'verify') {
                if ($otp_key['otp'] === $postData['otp'] && $otp_key['key'] === $key) {
                    $user = $this->Users->patchEntity($user, ['activation_key' => 'activated']);
                    if ($this->Users->save($user)) {
                        $this->Auth->setUser($user);
                        $this->Flash->success('Your account has been verified.');
                        return $this->redirect(['_name' => 'home']);
                    } else {
                        $this->Flash->error('Your account couldn\'t be verified, Please try again!');
                    }
                } else {
                    $this->Flash->error('Invalid OTP, Please try again');
                }
            }

            if ($postData['req_type'] === 'resend') {
                $otp_key = $this->__generate_otp_and_key();
                $user = $this->Users->patchEntity($user, ['activation_key' => json_encode($otp_key)]);
                if ($this->Users->save($user)) {
                    $this->getMailer('Users')->send('sendOtp', [$user]);
                    $this->Flash->success("An otp has been send to your email address.");
                    return $this->redirect(['action' => 'verification', $user->email, $otp_key['key']]);
                } else {
                    $this->Flash->error("Couldn't register please try again!");
                }
            }
        }
    }

    private function __generate_otp_and_key()
    {
        $str = '0123456789101112131415';
        $str = str_shuffle($str);
        $otp_key['otp'] = substr($str, 1, 6);
        $otp_key['key'] = Security::hash(Security::randomBytes(32), 'sha256', false);
        return $otp_key;
    }

    public function resetPassword()
    {
        $this->request->allowMethod(['post']);

        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }

        $email = $this->request->getData('email');

        $user = $this->Users->find('all', [
            'conditions' => ['email' => $email],
        ])->first();

        if (!$user) {
            $this->Flash->error('Email address not found!');
            return $this->redirect(['action' => 'login', '?' => ['tab' => 'forget']]);
        }

        if (isset($user->deleted)) {
            $this->Flash->error("Account deactivated, couldn't reset password.");
            return $this->redirect(['action' => 'login', '?' => ['tab' => 'forget']]);
        }

        $otp_key = $this->__generate_otp_and_key();
        $user = $this->Users->patchEntity($user, ['reset' => json_encode($otp_key)]);

        if ($this->Users->save($user)) {
            $this->getMailer('Users')->send('resetPassword', [$user]);
            $this->Flash->success('OTP sent to your email address!');
            return $this->redirect(['action' => 'createNewPassword', $user->email, $otp_key['key']]);
        } else {
            $this->Flash->error('Couldn\'t be reset, Please try again!');
            return $this->redirect(['action' => 'login', '?' => ['tab' => 'forget']]);
        }
    }

    public function createNewPassword($email, $key)
    {

        if (empty($email) || empty($key)) {
            return $this->redirect(['_name' => 'home']);
        }

        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }

        $user = $this->Users->find('all', [
            'conditions' => ['email' => $email],
            'contain' => ['Countries'],
        ])->first();

        if (!$user) {
            return $this->redirect(['_name' => 'home']);
        }

        if (isset($user->deleted)) {
            return $this->redirect(['_name' => 'home']);
        }

        if ($this->request->is('post')) {

            $otp_key = json_decode($user->reset, true);

            if ($otp_key['key'] !== $key) {
                return $this->redirect(['_name' => 'home']);
            }

            $postData = $this->request->getData();

            if ($otp_key['otp'] === $postData['otp']) {
                if ($postData['password'] === $postData['re-password']) {
                    $user = $this->Users->patchEntity($user, [
                        'reset' => NULL,
                        'password' => $postData['password'],
                    ]);

                    if ($this->Users->save($user)) {
                        $this->Auth->setUser($user);
                        $this->getMailer('Users')->send('confirmPasswordChanged', [$user]);
                        $this->Flash->success('Password has been changed!');
                        return $this->redirect(['_name' => 'home']);
                    } else {
                        $this->Flash->error('Passwords couldn\'t be changed!');
                    }
                } else {
                    $this->Flash->error('Passwords doesn\'t match.');
                }
            } else {
                $this->Flash->error('Incorrect OTP, Please try again!');
            }
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(['_name' => 'home']);
    }

    public function getStates($country_id)
    {
        $this->request->allowMethod(['ajax']);

        $this->loadModel('Zones');
        $zones = $this->Zones->find('list', [
            'conditions' => ['country_id' => $country_id],
        ]);

        return $this->response->withType('json')->withStringBody(json_encode($zones));
    }

    public function googleLogin()
    {
        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }
        $client = new \Google_Client();
        $client->setClientId("320168265137-pot5ekhg07ejob9e70or1l71ab93o2o7.apps.googleusercontent.com");
        $client->setClientSecret("FAc1BGDNfx3ceFXML4UE8SO4");
        $client->setRedirectUri(\Cake\Routing\Router::url(['action' => 'googleCallback'], true));
        $client->addScope('email');

        $client->addScope('profile');

        return $this->redirect($client->createAuthUrl());
    }

    public function googleCallback()
    {
        $client = new \Google_Client();
        $client->setClientId("320168265137-pot5ekhg07ejob9e70or1l71ab93o2o7.apps.googleusercontent.com");
        $client->setClientSecret("FAc1BGDNfx3ceFXML4UE8SO4");
        $client->setRedirectUri(\Cake\Routing\Router::url(['action' => 'googleCallback'], true));
        try {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (!isset($token["error"])) {
                $client->setAccessToken($token['access_token']);
                $google_oauth = new \Google_Service_Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();
                $email = $google_account_info->email;
                $name = trim($google_account_info->name);
                $getUserDetails = $this->Users->find('all', [
                    'conditions' => ['email' => $email]
                ])->contain([
                    'Countries'
                ])->first();
                if (!$getUserDetails) {
                    $otp_key = $this->__generate_otp_and_key();
                    $postData['name'] = $name;
                    $postData['email'] = $email;
                    $postData['password'] = $otp_key['otp'];
                    $postData['reset'] =    $otp_key['otp'];
                    $postData['country_id'] = 99;
                    $postData['user_group'] = 'customer';
                    $postData['activation_key'] = "activated";
                    $user = $this->Users->newEntity();
                    $user = $this->Users->patchEntity($user, $postData);

                    if ($this->Users->save($user)) {
                        $getUserDetails1 = $this->Users->find('all', [
                            'conditions' => ['email' => $email]
                        ])->contain([
                            'Countries'
                        ])->first();
                        $this->Auth->setUser($getUserDetails1);

                        // Merging Cart Items After login
                        $this->loadComponent('Cart');
                        $this->Cart->mergeCart();

                        $this->Flash->success("Login Successfully.");
                    } else {
                        $this->Flash->error("Couldn't register please try again!");
                    }
                }
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(_('Something went wrong, Please try again!'));
            }
        } catch (\InvalidArgumentException $e) {
            $this->Flash->error('Oops, something went wrong! please try again to login.');
            return $this->redirect(['_name' => 'home']);
        }
    }

    public function facebookLogin()
    {
        if (!is_null($this->Auth->user())) {
            return $this->redirect(['action' => 'myAccount']);
        }
        $fb = new \Facebook\Facebook([
            'app_id' => "234768901599615",
            'app_secret' => "8de47f7a2228ff41e915e08039d32744",
            'default_graph_version' => 'v3.2',
        ]);
        try {
            $helper = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl(\Cake\Routing\Router::url(['action' => 'facebookCallback'], true), ['email']);
            return $this->redirect($loginUrl);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            $this->Flash->error('Oops something went wrong please try again');
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            $this->Flash->error('Oops something went wrong please try again');
        }

        return $this->redirect(['_name' => 'home']);
    }

    public function facebookCallback()
    {
        $facebook = new \Facebook\Facebook([
            'app_id'      => "234768901599615",
            'app_secret'  => "8de47f7a2228ff41e915e08039d32744",
            'default_graph_version'  => 'v3.2'
        ]);

        $facebook_output = '';
        try {
            $facebook_helper = $facebook->getRedirectLoginHelper();
            $accessToken = $facebook_helper->getAccessToken();
            $facebook->setDefaultAccessToken($accessToken);
            $graph_response = $facebook->get("/me?fields=name,email", $accessToken);
            $facebook_user_info = $graph_response->getGraphUser();
            $email = $facebook_user_info['email'];
            $name = $facebook_user_info['name'];
            $getUserDetails = $this->Users->find('all', [
                'conditions' => ['email' => $email]
            ])->contain([
                'Countries'
            ])
                ->first();
            if (!$getUserDetails) {
                $otp_key = $this->__generate_otp_and_key();
                $postData['name'] = $name;
                $postData['email'] = $email;
                $postData['password'] = $otp_key['otp'];
                $postData['reset'] =    $otp_key['otp'];
                $postData['country_id'] = 99;
                $postData['user_group'] = 'customer';
                $postData['activation_key'] = "activated";
                $user = $this->Users->newEntity($postData);
                if ($this->Users->save($user)) {
                    $getUserDetails1 = $this->Users->find('all', [
                        'conditions' => ['email' => $email]
                    ])->contain([
                        'Countries'
                    ])
                        ->first();
                    $this->Auth->setUser($getUserDetails1);

                    // Merging Cart Items After login
                    $this->loadComponent('Cart');
                    $this->Cart->mergeCart();

                    $this->Flash->success("Login Successfully.");
                } else {
                    $this->Flash->error("Couldn't register please try again!");
                }
            }

            return $this->redirect($this->Auth->redirectUrl());
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            $this->Flash->error('Oops something went wrong please try again');
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            $this->Flash->error('Oops something went wrong please try again');
        }

        return $this->redirect(['_name' => 'home']);
    }
}
