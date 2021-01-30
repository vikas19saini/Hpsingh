<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Enquiries Controller
 *
 * @property \App\Model\Table\EnquiriesTable $Enquiries
 *
 * @method \App\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $enquiries = $this->Enquiries->find('all', [
            'order' => ['created' => 'DESC']
        ]);

        $enquiries = $this->paginate($enquiries);
        
        $this->set(compact('enquiries'));
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Enquiries->deleteAll(['Pages.id IN' => $Ids])) {
                $this->Flash->success('All selected enquiries has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected enquiries. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
