<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Media Controller
 *
 * @property \App\Model\Table\MediaTable $Media
 *
 * @method \App\Model\Entity\Media[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediaController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mediaFormat = $this->request->getQuery('filterByMediaItems');
        $mediaDates = $this->request->getQuery('filterByDate');
        if (isset($mediaFormat) && isset($mediaDates)) {
            $filters = array();
            if ($mediaFormat != 'none') {
                $filters = ['type' => $mediaFormat];
            }
            if ($mediaDates != 'none') {
                if (!empty($filters)) {
                    $filters['AND'] = ['created LIKE "' . $mediaDates . '%"'];
                } else {
                    $filters = ['created LIKE "' . $mediaDates . '%"'];
                }
            }
            $this->paginate = [
                'contain' => [],
                'conditions' => $filters,
                'order' => ['id' => 'DESC'],
                'limit' => 50
            ];
            $medias = $this->paginate($this->Media);
        } else {
            $this->paginate = [
                'contain' => [],
                'order' => ['id' => 'DESC'],
                'limit' => 50
            ];
            $medias = $this->paginate($this->Media);
        }
        $allMediaFormats = $this->Media->find('list', [
            'keyField' => 'type',
            'valueField' => 'type',
            'fields' => ['type']
        ])->distinct(['type'])->toArray();
        $allDates = $this->Media->find('list', [
            'keyField' => function ($e) {
                return date_format($e->created, "Y-m");
            },
            'valueField' => function ($e) {
                return date_format($e->created, "M Y");
            },
            'fields' => ['created']
        ])->distinct(['MONTH(created)', 'YEAR(created)'])->toArray();
        $this->set(compact('medias', 'allMediaFormats', 'allDates'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod('ajax');
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout(null);

            $this->loadModel('Media');
            $media = $this->Media->uploadAndSave();

            if ($media['status'] === 'success') {
                $media = $media['entity'];
                $this->set(compact('media'));
            } else {
                $this->autoRender = false;
                echo json_encode(['status' => 0, 'message' => $media['message']]);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $this->request->allowMethod(['ajax']);
        if ($this->request->is('ajax')) {
            $this->autoRender = FALSE;
            $mediaId = $this->request->getData('id');
            $media = $this->Media->get($mediaId, [
                'contain' => []
            ]);
            $media = $this->Media->patchEntity($media, $this->request->getData());
            if ($this->Media->save($media)) {
                echo json_encode(['status' => 1, 'message' => 'Media details updated successfully.']);
                exit();
            }
            echo json_encode(['status' => 0, 'message' => 'Media details could not be save. Please try again']);
            exit();
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function mediaAction()
    {
        $this->request->allowMethod(['post', 'delete']);
        $this->autoRender = FALSE;
        if ($this->request->getData('bulkActionType') == 'delete') {
            $mediaIds = $this->request->getData('mediaId');
            $allMedia = $this->Media->find('all', [
                'contain' => [],
                'conditions' => ['id IN' => $mediaIds]
            ])->all();
            if ($this->Media->deleteAll(['id IN' => $mediaIds])) {
                foreach ($allMedia as $singleMedia) {
                    @unlink(WWW_ROOT . str_replace('/', DS, $singleMedia->url));
                    @unlink(WWW_ROOT . str_replace('/', DS . 'Th_', $singleMedia->url));
                }
                $this->Flash->success(__('Selected medias successfully deleted.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to delete media. Please. try again'));
            return $this->redirect(['action' => 'index']);
        }
        return $this->redirect(['action' => 'index']);
    }

    public function mediaChooser($inputFieldName = 'mediaId', $replaceWith = null)
    {
        $this->request->allowMethod(['ajax']);
        $this->viewBuilder()->setLayout(null);
        $allMediaFormats = $this->Media->find('list', [
            'keyField' => 'type',
            'valueField' => 'type',
            'fields' => ['type']
        ])->distinct(['type'])->toArray();
        $allDates = $this->Media->find('list', [
            'keyField' => function ($e) {
                return date_format($e->created, "Y-m");
            },
            'valueField' => function ($e) {
                return date_format($e->created, "M Y");
            },
            'fields' => ['created']
        ])->distinct(['MONTH(created)', 'YEAR(created)'])->toArray();
        $this->paginate = [
            'contain' => [],
            'order' => ['id' => 'DESC'],
            'maxLimit' => 500,
            'limit' => 50
        ];
        $medias = $this->paginate($this->Media);
        $this->set(compact('inputFieldName', 'replaceWith', 'allMediaFormats', 'allDates', 'medias'));
    }

    public function loadmore($id = null, $type = null, $date = null, $search = null)
    {
        $this->request->allowMethod(['ajax']);
        $this->viewBuilder()->setLayout(null);
        $filters = [];
        $conditions = [];
        if (isset($type) && !empty($type) && $type != 'none') {
            $type = str_replace('-', '/', $type);
            array_push($filters, ['type' => $type]);
        }
        if (isset($date) && !empty($date) && $date != 'none') {
            array_push($filters, ['created LIKE "' . $date . '%"']);
        }
        if (isset($search) && !empty($search) && $search != 'none') {
            array_push($filters, ['name LIKE' => '%' . $search . '%']);
        }
        if (isset($id) && !empty($id) && $id != 'none') {
            $conditions = ['id <' => $id, 'AND' => $filters];
        } else {
            $conditions = ['id >' => $id, 'AND' => $filters];
        }
        $medias = $this->Media->find('all', [
            'contain' => [],
            'order' => ['id' => 'DESC'],
            'limit' => 50,
            'conditions' => $conditions,
        ]);
        $this->set(compact('medias'));
    }

    public function clean()
    {
        $this->loadModel('Products');
        $products = $this->Products->find('all', [
            'conditions' => ['deleted IS NOT' => null],
            'contain' => ['Media']
        ]);

        $removeFiles = 0;
        foreach ($products as $product) {
            $allMedia = $product->media;
            foreach ($allMedia as $singleMedia) {
                $removeFiles++;
                $this->Media->deleteAll(['id' => $singleMedia->id]);
                @unlink(WWW_ROOT . str_replace('/', DS, $singleMedia->url));
                @unlink(WWW_ROOT . str_replace('/', DS . 'Th_', $singleMedia->url));
            }
        }
        $this->Flash->success("Total $removeFiles files removed");
        return $this->redirect(['action' => "index"]);
    }
}
