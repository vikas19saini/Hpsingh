<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

class SubscribersController extends AppController {

    public function index() {
        $subscribers = $this->paginate($this->Subscribers);

        $this->set(compact('subscribers'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $subscriber = $this->Subscribers->get($id);
        if ($this->Subscribers->delete($subscriber)) {
            $this->Flash->success(__('The subscriber has been deleted.'));
        } else {
            $this->Flash->error(__('The subscriber could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Subscribers->deleteAll(['Pages.id IN' => $Ids])) {
                $this->Flash->success('All selected subscribers has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected subscribers. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
