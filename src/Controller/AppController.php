<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Security');
        $this->loadComponent('Geolocation');

        // Set admin layout
        if ($this->request->getParam('prefix') === 'hpadmin') {
            $this->viewBuilder()->setLayout('admin');
            $this->loadComponent('Auth', [
                'authorize' => ['Controller'],
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password',
                        ],
                    ],
                ],
                'loginAction' => ['controller' => 'Users', 'action' => 'login', 'prefix' => 'hpadmin', 'plugin' => null],
            ]);
            $this->loadModel('Reviews');
            $newReviews = $this->Reviews->find('all', [
                'contain' => [],
                'conditions' => ['status' => 'pending']
            ])->count();
            $this->set(compact('newReviews'));
        } else {
            // Check for redirection
            $this->loadModel('Redirection');

            $request_url = $this->request->getPath();

            $redirect_match = $this->Redirection->find('all', [
                'conditions' => ['old_url' => $request_url],
            ])->first();

            if ($redirect_match) {
                if ($redirect_match->old_url !== $redirect_match->new_url) {
                    return $this->redirect($redirect_match->new_url, $redirect_match->type);
                }
            }
            // Redirection end

            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ]
                    ],
                    'ADmad/HybridAuth.HybridAuth' => [
                        'fields' => [
                            'provider' => 'provider',
                            'openid_identifier' => 'openid_identifier',
                            'email' => 'email'
                        ],
                        'profileModel' => 'ADmad/HybridAuth.SocialProfiles',
                        'profileModelFkField' => 'user_id',
                        'userModel' => 'Users',
                        'hauth_return_to' => null
                    ]
                ],
                'loginAction' => ['controller' => 'Customer', 'action' => 'login', 'plugin' => false],
                'authError' => false
            ]);

            \Cake\Event\EventManager::instance()->on('HybridAuth.login', [$this, 'afterLogin']);
            \Cake\Event\EventManager::instance()->on('HybridAuth.newUser', [$this, 'createUser']);
            $this->Auth->allow();
        }
    }

    public function createUser(\Cake\Event\Event $event)
    {
        // Entity representing record in social_profiles table
        $profile = $event->getData()['profile'];
        $this->loadModel("Users");

        // Make sure here that all the required fields are actually present

        $postData['name'] = $profile->display_name;
        $postData['email'] = $profile->email;
        $postData['password'] = "default";
        $postData['country_id'] = 99;
        $postData['user_group'] = 'customer';
        $postData['activation_key'] = "activated";

        $user = $this->Users->newEntity();
        $user = $this->Users->patchEntity($user, $postData);
        $user = $this->Users->save($user);

        if (!$user) {
            throw new \RuntimeException('Unable to save new user');
        }

        $user = $this->Users->get($user->id, [
            'contain' => ['Countries']
        ]);

        $this->Auth->setUser($user);

        return $user;
    }

    public function afterLogin(\Cake\Event\Event $event)
    {
        $this->loadModel("Users");

        $user = $this->Users->get($this->Auth->user()['id'], [
            'contain' => ['Countries']
        ]);

        $this->Auth->setUser($user);

        return $user;
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->loadComponent('Auth');

        $user = $this->Auth->user();
        if (isset($user)) {
            $this->set('Auth', $user);
        }

        if ($this->request->getParam('prefix') !== 'hpadmin') {
            $this->loadModel('Categories');
            $categories = $this->Categories->find('AllParentCategories');
            $wearing = $this->Categories->find('AllWearing');
            $defaultCurrency = $this->request->getSession()->read('Config.defaultCurrency');
            $this->loadModel('Sliders');
            $popup = $this->Sliders->find('all', [
                'conditions' => ['Sliders.status' => 'active', 'Sliders.type' => 'popup'],
                'contain' => ['Media', 'MobileMedia']
            ])->first();
            $this->set(compact('categories', 'wearing', 'defaultCurrency', 'popup'));
        }
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['user_group']) && $user['user_group'] === 'administrator') {
            return true;
        }

        // Default deny
        return false;
    }
}
