<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;
use \Box\Spout\Reader\ReaderFactory;
use \Box\Spout\Common\Type;

/**
 * ShippingZones Controller
 *
 * @property \App\Model\Table\ShippingZonesTable $ShippingZones
 *
 * @method \App\Model\Entity\ShippingZone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShippingZonesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        if(!empty($this->request->getQuery('search'))){
            $shippingZones = $this->paginate($this->ShippingZones->find('all', [
                'conditions' => ['postcode' => $this->request->getQuery('search')]
            ]));            
        }else{
            $shippingZones = $this->paginate($this->ShippingZones);    
        }        

        $this->set(compact('shippingZones'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shippingZone = $this->ShippingZones->newEntity();
        if ($this->request->is('post')) {
            $shippingZone = $this->ShippingZones->patchEntity($shippingZone, $this->request->getData());
            if ($this->ShippingZones->save($shippingZone)) {
                $this->Flash->success(__('The shipping zone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping zone could not be saved. Please, try again.'));
        }
        $this->set(compact('shippingZone'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shipping Zone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shippingZone = $this->ShippingZones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shippingZone = $this->ShippingZones->patchEntity($shippingZone, $this->request->getData());
            if ($this->ShippingZones->save($shippingZone)) {
                $this->Flash->success(__('The shipping zone has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipping zone could not be saved. Please, try again.'));
        }
        $this->set(compact('shippingZone'));
        $this->render('add');
    }

    public function bulkAction()
    {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->ShippingZones->deleteAll(['ShippingZones.id IN' => $Ids])) {
                $this->Flash->success('All selected records has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected records. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

    public function deleteAll(){
        $this->ShippingZones->deleteAll(['id !=' => '-1']);
        $this->redirect(['action' => 'index']);
    }

    public function import()
    {
        $this->request->allowMethod(['post']);
        error_reporting(0);
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        ini_set('max_input_vars', 0);
        $file_details = $_FILES['postcodeFile'];

        $file_extension = explode('.', $file_details['name']);
        $file_extension = end($file_extension);

        if (strtolower($file_extension) !== 'csv' && strtolower($file_extension) !== 'xlsx') {
            return $this->response->withType('json')->withStringBody(['status' => 'error', 'message' => 'Invalid file format']);
        }

        $file_name = hash('sha256', date('r')) . '.' . $file_extension;

        if (!is_dir(WWW_ROOT . 'imports')) {
            mkdir(WWW_ROOT . 'imports', 0755);
        }

        if (file_exists($file_name)) {
            $file_name = hash(sha256, $file_name) . '.' . $file_extension;
        }

        $destination_path = WWW_ROOT . 'imports/' . $file_name;

        if (!move_uploaded_file($file_details['tmp_name'], $destination_path)) {
            return $this->response->withType('json')->withStringBody(['status' => 'error', 'message' => 'File couldn\'t be uploaded, please try again!']);
        }

        if (strtolower($file_extension) === 'csv') {
            $reader = ReaderFactory::create(Type::CSV);
        }

        if (strtolower($file_extension) === 'xlsx') {
            $reader = ReaderFactory::create(Type::XLSX);
        }

        $reader->open($destination_path);

        $allPostCodesToImport = [];
        $count = 0;
        foreach ($reader->getSheetIterator() as $sheet) {
            $headers = [];

            foreach ($sheet->getRowIterator() as $row) {

                if ($count === 0) {
                    $headers = $row;
                } else {
                    $productDetails = array_combine($headers, $row);
                    array_push($allPostCodesToImport, $productDetails);
                }
                $count++;
            }
        }

        $reader->close();
        unlink($destination_path);

        if (!$this->request->getData('import-type')) {
            $this->ShippingZones->deleteAll(['id !=' => -1]);
        }

        $postcodeEntity = $this->ShippingZones->newEntity();
        $postcodeEntity = $this->ShippingZones->patchEntities($postcodeEntity, $allPostCodesToImport);

        
        if ($this->ShippingZones->saveMany($postcodeEntity)) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'total' => $count - 1]));
        }

        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Could not be imported, Please check for duplicate values']));
    }

}
