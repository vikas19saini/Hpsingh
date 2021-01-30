<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\Utility\Security;
use Cake\I18n\Time;

/**
 * Customers Controller
 *
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);

        $this->Security->setConfig('unlockedActions', ['validateCustomerAndSendOtp', 'verifyCustomer']);
    }

        public function validateCustomerAndSendOtp(){

            $this->request->allowMethod(['post']);

            $this->loadModel("Verifications");
            $this->loadModel("Users");
            $data = $this->request->getData();

            $this->Verifications->deleteAll(['phone' => $data['phone']]);

            $otp = $this->__generate_otp_and_key();

            $verification = $this->Verifications->newEntity();
            $verification = $this->Verifications->patchEntity($verification, [
                "otp" => $otp['otp'],
                "phone" => $data["phone"]
            ]);

            $user = $this->Users->find('all', [
                'conditions' => ['phone' => $data['phone']]
            ])->first();

            if($this->Verifications->save($verification)){
                $this->set([
                    'response' => ['statusCode' => 1, "message" => 'OTP Sent', 'isRegistered' => isset($user) ? 1 : 0],
                    '_serialize' => ['response']
                ]);
            }else{
                $this->response->statusCode(409);
                $this->set([
                    'response' => ['statusCode' => 2, "message" => "OTP Couldn't be Sent"],
                    '_serialize' => ['response']
                ]);
            }
        }

        public function verifyCustomer(){
            $this->request->allowMethod(['post']);
            $postData = $this->request->getData();

            $this->loadModel("Verifications");
            $this->loadModel("Users");

            $user = null;

            if(isset($postData['password'])){

                $this->Auth->config('authenticate', [
                        'Form' => [
                            'fields' => ['username' => 'phone', 'password' => 'password']
                    ]
                ]);

                $user = $this->Auth->identify();

                if(!$user){
                    return $this->response->withType('json')->withStringBody(json_encode(['statusCode' => 0, 'message' => 'Invalid credentials, Please try again!']));
                }

                $user = $this->Users->get($user['id'], [
                    'contain' => ['Countries']
                ]);

                if($user->activation_key === 'suspend'){
                    return $this->response->withType('json')->withStringBody(json_encode(['statusCode' => 0, 'message' => 'Your account is suspended. Contact us for more details.']));
                }

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

                return $this->response->withType('json')->withStringBody(json_encode(['statusCode' => 1, 'message' => 'Logged In', 'redirectNow' => 1]));
            }

            if(isset($postData['otp'])){

                $verification = $this->Verifications->find('all', [
                    'conditions' => ['phone' => $postData['phone'], 'otp' => $postData['otp']]
                ])->first();

                if(empty($verification)){
                    return $this->response->withType('json')->withStringBody(json_encode(['statusCode' => 0, 'message' => 'Incorrect OTP']));
                }

                $user = $this->Users->find('all', [
                    'contain' => ['Countries'],
                    'conditions' => ['phone' => $postData['phone']]
                ])->first();

                if(empty($user)){
                    return $this->response->withType('json')->withStringBody(json_encode(['statusCode' => 2, 'message' => 'User not registered']));
                }

                $this->Auth->setUser($user);
                return $this->response->withType('json')->withStringBody(json_encode(['statusCode' => 1, 'message' => 'Logged In', 'redirectNow' => 1]));


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
}
