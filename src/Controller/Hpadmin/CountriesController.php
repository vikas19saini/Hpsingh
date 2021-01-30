<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 *
 * @method \App\Model\Entity\Country[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CountriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $countries = $this->Countries->find('all', [
            'contain' => ['Zones' => function($query) {
                    return $query->select(['Zones.country_id', 'total' => $query->func()->count('Zones.country_id')])->group(['Zones.country_id']);
                }],
        ]);
        $countries = $this->paginate($countries);
        $country = $this->Countries->newEntity();
        $this->set(compact('countries', 'country'));
    }

    public function add() {
        $this->request->allowMethod(['post']);
        if ($this->request->is('post')) {
            $country = $this->Countries->newEntity();
            $country = $this->Countries->patchEntity($country, $this->request->getData());
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('A new country has been saved.'));
            } else {
                $this->Flash->success(__('A new country could not be saved. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $country = $this->Countries->get($id);
        $countries = $this->Countries->find('all', [
            'contain' => ['Zones' => function($query) {
                    return $query->select(['Zones.country_id', 'total' => $query->func()->count('Zones.country_id')])->group(['Zones.country_id']);
                }],
        ]);
        $countries = $this->paginate($countries);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->getData());
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The country could not be saved. Please, try again.'));
        }
        $this->set(compact('country', 'countries'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $countryIds = $this->request->getData('itemId');
        if ($this->request->getData('action') == 'delete') {
            if ($this->Countries->deleteAll(['Countries.id IN' => $countryIds])) {
                $this->Flash->success(__('The country has been deleted.'));
            } else {
                $this->Flash->error(__('The country could not be deleted. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

}
