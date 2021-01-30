<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

class CurrenciesController extends AppController {

    public function index() {
        $currencies = $this->paginate($this->Currencies);

        $this->set(compact('currencies'));
    }

    public function add() {
        $currency = $this->Currencies->newEntity();
        if ($this->request->is('post')) {
            $currency = $this->Currencies->patchEntity($currency, $this->request->getData());
            if ($this->Currencies->save($currency)) {
                $this->Flash->success(__('The currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The currency could not be saved. Please, try again.'));
        }
        $this->set(compact('currency'));
    }

    public function edit($id = null) {
        $currency = $this->Currencies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $currency = $this->Currencies->patchEntity($currency, $this->request->getData());
            if ($this->Currencies->save($currency)) {
                $this->Flash->success(__('The currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The currency could not be saved. Please, try again.'));
        }
        $this->set(compact('currency'));
        $this->render('add');
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $currency = $this->Currencies->get($id);
        if ($this->Currencies->delete($currency)) {
            $this->Flash->success(__('The currency has been deleted.'));
        } else {
            $this->Flash->error(__('The currency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
