<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Zones Controller
 *
 * @property \App\Model\Table\ZonesTable $Zones
 *
 * @method \App\Model\Entity\Zone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $zone = $this->Zones->newEntity();
        $zones = $this->Zones->find('all', ['contain' => ['Countries']]);
        $zones = $this->paginate($zones);
        $countries = $this->Zones->Countries->find('list');

        $this->set(compact('zones', 'zone', 'countries'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        if ($this->request->is('post')) {
            $zone = $this->Zones->newEntity();
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            if ($this->Zones->save($zone)) {
                $this->Flash->success(__('The zone has been saved.'));                
            }else{
                $this->Flash->error(__('The zone could not be saved. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $zone = $this->Zones->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            if ($this->Zones->save($zone)) {
                $this->Flash->success(__('The zone has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zone could not be saved. Please, try again.'));
        }
        $zones = $this->Zones->find('all', ['contain' => ['Countries']]);
        $zones = $this->paginate($zones);
        $countries = $this->Zones->Countries->find('list');
        $this->set(compact('zone', 'countries', 'zones'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $zoneIds = $this->request->getData('itemId');
        if ($this->request->getData('action') == 'delete') {
            if ($this->Zones->deleteAll(['Zones.id IN' => $zoneIds])) {
                $this->Flash->success(__('The zone has been deleted.'));
            } else {
                $this->Flash->error(__('The zone could not be deleted. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

}
