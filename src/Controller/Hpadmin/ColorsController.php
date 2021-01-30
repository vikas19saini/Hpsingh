<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Colors Controller
 *
 * @property \App\Model\Table\ColorsTable $Colors
 *
 * @method \App\Model\Entity\Color[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ColorsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $colors = $this->Colors->find('all');
        $colors = $this->paginate($colors);
        $this->set(compact('colors'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $color = $this->Colors->newEntity();
        if ($this->request->is('post')) {
            $color = $this->Colors->patchEntity($color, $this->request->getData());
            if ($this->Colors->save($color)) {
                $this->Flash->success(__('The color has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The color could not be saved. Please, try again.'));
        }
        $this->set(compact('color'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Color id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $color = $this->Colors->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $color = $this->Colors->patchEntity($color, $this->request->getData());
            if ($this->Colors->save($color)) {
                $this->Flash->success(__('The color has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The color could not be saved. Please, try again.'));
        }
        $this->set(compact('color'));
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Color id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $color = $this->Colors->get($id);
        if ($this->Colors->delete($color)) {
            $this->Flash->success(__('The color has been deleted.'));
        } else {
            $this->Flash->error(__('The color could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Colors->deleteAll(['Pages.id IN' => $Ids])) {
                $this->Flash->success('All selected colors has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected colors. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
