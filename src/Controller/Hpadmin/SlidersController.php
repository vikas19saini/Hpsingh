<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Sliders Controller
 *
 *
 * @method \App\Model\Entity\Slider[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SlidersController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $sliders = $this->Sliders->find('all', [
            'contain' => ['Media', 'MobileMedia'],
        ])->orderDesc('Sliders.id');
        $sliders = $this->paginate($sliders);
        $this->set(compact('sliders'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $slider = $this->Sliders->newEntity();
        if ($this->request->is('post')) {
            $slider = $this->Sliders->patchEntity($slider, $this->request->getData());
            if ($this->Sliders->save($slider)) {
                $this->Flash->success(__('The slider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slider could not be saved. Please, try again.'));
        }
        $this->set(compact('slider'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Slider id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $slider = $this->Sliders->get($id, [
            'contain' => ['Media', 'MobileMedia']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $slider = $this->Sliders->patchEntity($slider, $this->request->getData());
            if ($this->Sliders->save($slider)) {
                $this->Flash->success(__('The slider has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The slider could not be saved. Please, try again.'));
        }
        $this->set(compact('slider'));
        $this->render('add');
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);
        $Ids = @explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Sliders->deleteAll(['Sliders.id IN' => $Ids])) {
                $this->Flash->success('All selected Sliders are deleted.');
            } else {
                $this->Flash->error('Unable to delete selected Sliders. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
