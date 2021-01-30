<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 *
 * @method \App\Model\Entity\Review[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReviewsController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Security->setConfig('unlockedActions', ['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $status = $this->request->getQuery('status');
        $product_id = $this->request->getQuery('product');
        $user_id = $this->request->getQuery('user');
        $conditions = $filters = [];
        if (isset($status) && !empty($status)) {
            $conditions['Reviews.status'] = $status;
        }
        if (isset($product_id) && !empty($product_id)) {
            array_push($filters, ['Reviews.product_id' => $product_id]);
        }
        if (isset($user_id) && !empty($user_id)) {
            array_push($filters, ['Reviews.user_id' => $user_id]);
        }
        $conditions['AND'] = $filters;

        $reviews = $tmpReview = $this->Reviews->find('all', [
            'contain' => ['Users', 'Products'],
            'conditions' => $conditions,
        ]);
        $reviews = $this->paginate($reviews, ['limit' => 500]);
        $tmpReview = $tmpReview->toArray();

        $all = $this->Reviews->find('all', [
                    'contain' => []
                ])->count();
        $pending = $this->Reviews->find('all', [
                    'contain' => [],
                    'conditions' => ['status' => 'pending']
                ])->count();
        $approved = $this->Reviews->find('all', [
                    'contain' => [],
                    'conditions' => ['status' => 'approved']
                ])->count();

        $heading = 'Review';
        if (isset($product_id) && !empty($product_id)) {
            if (isset($user_id) && !empty($user_id)) {
                $heading = 'All reviews of <i>"' . $tmpReview[0]->product->name . '" by "' . $tmpReview[0]->user->name . '"</i>';
            } else {
                $heading = 'All reviews of <i>"' . $tmpReview[0]->product->name . '"</i>';
            }
        } else {
            if (isset($user_id) && !empty($user_id)) {
                $heading = 'All reviews of <i>"' . $tmpReview[0]->user->name . '"</i>';
            }
        }
        unset($tmpReview);
        $this->set(compact('reviews', 'all', 'pending', 'approved', 'status', 'heading'));
    }

    public function add() {
        $this->request->allowMethod(['ajax']);
        $this->autoRender = false;
        $review = $this->Reviews->newEntity();
        $review = $this->Reviews->patchEntity($review, $this->request->getData());
        if ($this->Reviews->save($review)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $review = $this->Reviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $products = $this->Reviews->Products->find('list', ['limit' => 200]);
        $this->set(compact('review', 'users', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function approve($id = null) {
        $this->request->allowMethod(['post']);
        $review = $this->Reviews->get($id);
        $review = $this->Reviews->patchEntity($review, ['status' => 'approved']);
        if ($this->Reviews->save($review)) {
            $this->Flash->success(__('The review has been approved.'));
        } else {
            $this->Flash->error(__('The review could not be approved. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function unapprove($id = null) {
        $this->request->allowMethod(['post']);
        $review = $this->Reviews->get($id);
        $review = $this->Reviews->patchEntity($review, ['status' => 'pending']);
        if ($this->Reviews->save($review)) {
            $this->Flash->success(__('The review has been unapproved.'));
        } else {
            $this->Flash->error(__('The review could not be unapproved. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);
        $reviewIds = @explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Reviews->deleteAll(['Reviews.id IN' => $reviewIds])) {
                $this->Flash->success('All selected reviews are deleted.');
            } else {
                $this->Flash->error('Unable to delete selected reviews. Please, try again');
            }
        } elseif (!empty($action)) {
            if ($this->Reviews->updateAll(['Reviews.status' => $action], ['Reviews.id IN' => $reviewIds])) {
                $this->Flash->success('Status updated of selected reviews.');
            } else {
                $this->Flash->error('Unable to update status of selected reviews. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
