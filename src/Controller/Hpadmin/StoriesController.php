<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Stories Controller
 *
 * @property \App\Model\Table\StoriesTable $Stories
 *
 * @method \App\Model\Entity\Story[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StoriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->paginate = [
            'contain' => ['Media'],
            'order' => ['Stories.id' => 'Desc']
        ];
        $stories = $this->paginate($this->Stories);

        $this->set(compact('stories'));
    }

    /**
     * View method
     *
     * @param string|null $id Story id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $story = $this->Stories->get($id, [
            'contain' => ['Media']
        ]);

        $this->set('story', $story);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $story = $this->Stories->newEntity();
        if ($this->request->is('post')) {
            $story = $this->Stories->patchEntity($story, $this->request->getData() + ['slug' => strtolower(\Cake\Utility\Text::slug($this->request->getData('title')))]);
            if ($this->Stories->save($story)) {
                $this->Flash->success(__('The story has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The story could not be saved. Please, try again.'));
        }
        $this->set(compact('story'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Story id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $story = $this->Stories->get($id, [
            'contain' => ['Media']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $story = $this->Stories->patchEntity($story, $this->request->getData() + ['slug' => strtolower(\Cake\Utility\Text::slug($this->request->getData('title')))]);
            if ($this->Stories->save($story)) {
                $this->Flash->success(__('The story has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The story could not be saved. Please, try again.'));
        }
        $this->set(compact('story'));
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Story id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $story = $this->Stories->get($id);
        if ($this->Stories->delete($story)) {
            $this->Flash->success(__('The story has been deleted.'));
        } else {
            $this->Flash->error(__('The story could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Stories->deleteAll(['Stories.id IN' => $Ids])) {
                $this->Flash->success('All selected stories has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected stories. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
