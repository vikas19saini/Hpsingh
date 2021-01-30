<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $tag = $this->Tags->newEntity();
        $tags = $this->paginate($this->Tags->getTagsWithProductCount($this->request->query('search')));
        $this->set(compact('tags', 'tag'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->request->allowMethod(['ajax']);
        $this->autoRender = false;

        $data = $this->request->getData();
        $this->loadComponent('Taxonomy');
        $tag = $this->Taxonomy->saveTags($data);

        if (!$tag) {
            echo json_encode(['status' => 0, 'message' => 'Tag already exist. Please, try again']);
            exit();
        }

        echo json_encode(['status' => 1, 'message' => 'Tag sucessfully created.']);
        exit();
    }

    public function saveTagsFromProductPage($name = null) {
        $this->autoRender = FALSE;
        $this->request->allowMethod(['ajax']);

        if (is_null($name)) {
            echo json_encode(['status' => 0]);
            exit();
        }

        $this->loadComponent('Taxonomy');

        $response = $this->Taxonomy->saveTags(['name' => $name]);

        if (!$response) {
            echo json_encode(['status' => 0]);
            exit();
        }

        echo json_encode(['status' => 1, 'data' => $response]);
        exit();
    }

    public function searchTags($term = null) {
        $this->viewBuilder()->setLayout(null);
        $this->request->allowMethod(['ajax']);

        $tags = $this->Tags->find('list', [
                    'contain' => [],
                    'conditions' => ['Tags.name LIKE' => '%' . $term . '%']
                ])->toArray();
        $this->set(compact('tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $tag = $this->Tags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag details has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag details could not be saved. Please, try again.'));
        }
        $this->set(compact('tag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function bulkAction($id = null) {
        $this->request->allowMethod(['post']);
        $action = $this->request->getData('action');
        if ($action == 'delete') {
            if ($this->Tags->deleteAll(['id IN' => $this->request->getData('itemId')])) {
                $this->Flash->success(__('Selected tag successfully deleted.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Selected tags could not be deleted. Please try again.'));
            return $this->redirect(['action' => 'index']);
        }
        return $this->redirect(['action' => 'index']);
    }

}
