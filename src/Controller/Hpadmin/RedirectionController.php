<?php
namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Redirection Controller
 *
 * @property \App\Model\Table\RedirectionTable $Redirection
 *
 * @method \App\Model\Entity\Redirection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RedirectionController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $redirection = $this->paginate($this->Redirection);

        $this->set(compact('redirection'));
    }

    /**
     * View method
     *
     * @param string|null $id Redirection id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $redirection = $this->Redirection->get($id, [
            'contain' => []
        ]);

        $this->set('redirection', $redirection);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $redirection = $this->Redirection->newEntity();
        if ($this->request->is('post')) {
            $redirection = $this->Redirection->patchEntity($redirection, $this->request->getData());
            if ($this->Redirection->save($redirection)) {
                $this->Flash->success(__('The redirection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The redirection could not be saved. Please, try again.'));
        }
        $this->set(compact('redirection'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Redirection id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $redirection = $this->Redirection->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $redirection = $this->Redirection->patchEntity($redirection, $this->request->getData());
            if ($this->Redirection->save($redirection)) {
                $this->Flash->success(__('The redirection has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The redirection could not be saved. Please, try again.'));
        }
        $this->set(compact('redirection'));
        $this->render('add');
    }

    /**
     * Delete method
     *
     * @param string|null $id Redirection id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $redirection = $this->Redirection->get($id);
        if ($this->Redirection->delete($redirection)) {
            $this->Flash->success(__('The redirection has been deleted.'));
        } else {
            $this->Flash->error(__('The redirection could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function bulkAction() {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Redirection->deleteAll(['id IN' => $Ids])) {
                $this->Flash->success('All selected records has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected records. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }
}
