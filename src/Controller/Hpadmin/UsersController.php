<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $role = $this->request->getQuery('role');
        $search = $this->request->getQuery('search');
        $filters = [];
        if (!empty($role) && isset($role)) {
            if ($role != 'all') {
                $filters = ['Users.user_group' => $role];
            }
        }
        if (isset($search) && !empty($search)) {
            $search = '%' . $search . '%';
            if (isset($filters) && !empty($filters)) {
                $filters['AND'] = ['OR' => [['Users.name LIKE' => $search], ['Users.email LIKE' => $search], ['Users.phone LIKE' => $search], ['Users.created LIKE' => $search]]];
            } else {
                $filters['OR'] = [['Users.name LIKE' => $search], ['Users.email LIKE' => $search], ['Users.phone LIKE' => $search], ['Users.created LIKE' => $search]];
            }
        }
        if (isset($filters) && !empty($filters)) {
            if (array_key_exists('AND', $filters)) {
                $andCondition = $filters['AND'];
                $andCondition['Users.deleted IS'] = NULL;
                $filters['AND'] = $andCondition;
            } else {
                $filters['AND'] = ['Users.deleted IS' => NULL];
            }
        } else {
            $filters['Users.deleted IS'] = NULL;
        }
        $this->paginate = [
            'contain' => [],
            'order' => ['created' => 'DESC'],
            'limit' => 100,
            'conditions' => $filters
        ];
        $users = $this->paginate($this->Users);
        $search = str_replace('%', '', $search);
        $this->set(compact('users', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            if ($this->request->getData('password') == $this->request->getData('password_retype')) {
                if (strlen($this->request->getData('password')) >= 8) {
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    $user->activation_key = str_shuffle('ABCDEFGadjdhjshDHGDHSwehuhuivh578784545787854wdccdc' . uniqid()); // to generate uniq email address verification key
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                } else {
                    $user->setError('password', 'Password should be at lease 8 character long.');
                }
            } else {
                $user->setError('password', 'These passwords do not match.');
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function bulk_action() {
        $this->request->allowMethod(['post', 'delete']);
        if ($this->request->is('post')) {

            $action = $this->request->getData('action');
            $userId = $this->request->getData('id');
            switch ($action) {
                case 'delete':
                    if ($this->Users->updateAll(['deleted' => date('Y-m-d H:i:s')], ['Users.id IN' => $userId])) {
                        $this->Flash->success(__('Selected users successfully deleted.'));
                    } else {
                        $this->Flash->error(__('Selected users could not be deleted please try again.'));
                    }
                    break;

                case 'disable_cod':
                    if ($this->Users->updateAll(['cod_enable' => 'no'], ['Users.id IN' => $userId])) {
                        $this->Flash->success(__('COD disabled for selected users.'));
                    } else {
                        $this->Flash->error(__('Oops, opertion couldn\'t be completed.'));
                    }
                    break;
                case 'enable_cod':
                    if ($this->Users->updateAll(['cod_enable' => 'yes'], ['Users.id IN' => $userId])) {
                        $this->Flash->success(__('COD enabled for selected users.'));
                    } else {
                        $this->Flash->error(__('Oops, opertion couldn\'t be completed.'));
                    }
                    break;
            }

            return $this->redirect(['action' => 'index']);
        }
    }

    public function login() {
        $this->viewBuilder()->setLayout('login');

        if (!is_null($this->Auth->user())) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $user = $this->Users->get($user['id'], [
                    'contain' => ['Countries'],
                ]);
                if ($user->activation_key == 'activated') {
                    $this->Auth->setUser($user);
                    if ($this->Auth->redirectUrl() === '/') {
                        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                    }
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->Flash->error(__('Your email address is not verified. Please, verify your email address and try again.'));
            }
            $this->Flash->error(__('Invalid credentials. Please, try again with correct credentials.'));
        }
        $this->set(compact('user'));
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function searchForUsers($term = '') {
        $this->request->allowMethod(['ajax']);
        $users = $this->Users->find('all', [
            'contain' => [],
            'conditions' => ['OR' => [['Users.email LIKE' => '%' . $term . '%'], ['Users.phone LIKE' => '%' . $term . '%'], ['Users.name LIKE' => '%' . $term . '%']]],
            'fields' => ['Users.id', 'Users.name', 'Users.email']
        ]);
        
        return $this->response->withType('json')->withStringBody(json_encode($users));
    }

}
