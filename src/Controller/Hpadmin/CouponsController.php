<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Coupons Controller
 *
 * @property \App\Model\Table\CouponsTable $Coupons
 *
 * @method \App\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CouponsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $status = $this->request->getQuery('status');
   
        $coupons = $this->Coupons->getAllCoupons($this->request->getQuery());

        $coupons = $this->paginate($coupons);
        $drafts = $this->Coupons->find('all', [
                    'conditions' => ['Coupons.status' => 'drafts']
                ])->count();
        $published = $this->Coupons->find('all', [
                    'conditions' => ['Coupons.status' => 'published']
                ])->count();
        $trash = $this->Coupons->find('all', [
                    'conditions' => ['Coupons.deleted IS NOT' => NULL]
                ])->count();
        $all = $this->Coupons->find('all')->count();
        $this->set(compact('coupons', 'drafts', 'published', 'all', 'trash', 'status'));
    }

    /**
     * View method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $coupon = $this->Coupons->get($id, [
            'contain' => []
        ]);

        $this->set('coupon', $coupon);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $coupon = $this->Coupons->newEntity();
        if ($this->request->is('post')) {
            $couponData = $this->request->getData();
            $couponData['products'] = @implode(',', $couponData['products']);
            $couponData['exclude_products'] = @implode(',', $couponData['exclude_products']);
            $couponData['categories'] = @implode(',', $couponData['categories']);
            $couponData['exclude_categories'] = @implode(',', $couponData['exclude_categories']);
            $coupon = $this->Coupons->patchEntity($coupon, $couponData);
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->set(compact('coupon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $coupon = $this->Coupons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $couponData = $this->request->getData();
            $couponData['products'] = @implode(',', $couponData['products']);
            $couponData['exclude_products'] = @implode(',', $couponData['exclude_products']);
            $couponData['categories'] = @implode(',', $couponData['categories']);
            $couponData['exclude_categories'] = @implode(',', $couponData['exclude_categories']);
            $coupon = $this->Coupons->patchEntity($coupon, $couponData);
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->loadModel('Products');
        $includeProducts = $this->Products->find('all', [
                    'conditions' => ['Products.id IN' => @explode(',', $coupon->products)],
                ])->toArray();
        $excludedProducts = $this->Products->find('all', [
                    'conditions' => ['Products.id IN' => @explode(',', $coupon->exclude_products)],
                ])->toArray();
        $this->loadModel('Categories');
        $includeCategories = $this->Categories->find('all', [
                    'conditions' => ['Categories.id IN' => @explode(',', $coupon->categories)],
                    'fields' => ['id', 'name']
                ])->toArray();
        $excludeCategories = $this->Categories->find('all', [
                    'conditions' => ['Categories.id IN' => @explode(',', $coupon->exclude_categories)],
                    'fields' => ['id', 'name']
                ])->toArray();
        $this->set(compact('coupon', 'includeProducts', 'excludedProducts', 'includeCategories', 'excludeCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->Coupons->get($id);
        $data['deleted'] = date('Y-m-d h:i:s');
        $coupon = $this->Coupons->patchEntity($coupon, $data);
        if ($this->Coupons->save($coupon)) {
            $this->Flash->success(__('The coupon has been moved to trash.'));
        } else {
            $this->Flash->error(__('The coupon could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function restore($id = null) {
        $this->request->allowMethod(['post']);
        $product = $this->Coupons->get($id);
        $product->deleted = NULL;
        if ($this->Coupons->save($product)) {
            $this->Flash->success('Coupon successfully restored.');
        } else {
            $this->Flash->error('Coupon can not be restored. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete_permanently($id = null) {
        $this->request->allowMethod(['post']);
        $product = $this->Coupons->get($id);
        if ($this->Coupons->delete($product)) {
            $this->Flash->success('Coupon permanently deleted.');
        } else {
            $this->Flash->error('Coupon can not be delete. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);
        if ($this->request->is('post')) {
            $action = $this->request->getData('action');
            $productIds = @explode(',', $this->request->getData('actionIds'));
            switch ($action) {
                case 'trash':
                    if ($this->Coupons->updateAll(['deleted' => date('Y-m-d h:i:s')], ['Coupons.id IN' => $productIds])) {
                        $this->Flash->success('All selected coupons are moved to trash.');
                    } else {
                        $this->Flash->error('Unable to mark selected coupons as Trash. Please, try again');
                    }
                    break;
                case 'published':
                    if ($this->Coupons->updateAll(['status' => 'published'], ['Coupons.id IN' => $productIds])) {
                        $this->Flash->success('All selected coupons are Published now');
                    } else {
                        $this->Flash->error('Unable to mark selected coupons as publish. Please, try again');
                    }
                    break;
                case 'drafts':
                    if ($this->Coupons->updateAll(['status' => 'drafts'], ['Coupons.id IN' => $productIds])) {
                        $this->Flash->success('All selected coupons are moved to Drfts');
                    } else {
                        $this->Flash->error('Unable to mark selected coupons as drafts. Please, try again');
                    }
                    break;
                default :
                    return $this->redirect(['action' => 'index']);
            }
            return $this->redirect(['action' => 'index']);
        }
    }

}
