<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $category = $this->Categories->newEntity();
        $parentCategories = $this->Categories->find('treeList', [
            'keyPath' => 'id',
            'valuePath' => 'name',
            'spacer' => '&#9866;',
        ]);
        
        $categories = [];
        foreach ($parentCategories as $key => $val) {
            $singleCategory = $this->Categories->get($key, [
                'contain' => ['Media', 'SubcategoryMedia']
            ]);
            $singleCategory->name = $val;
            array_push($categories, $singleCategory);
        }
        $this->set(compact('category', 'parentCategories', 'categories'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->request->allowMethod(['ajax']);
        $this->autoRender = false;
        $category = $this->Categories->newEntity();
        $data = $this->request->getData();
        $slug = $data['slug'];
        if (!empty($slug) && $slug != '') {
            $data['slug'] = $this->generateCategorySlug($data['slug']);
        } else {
            $data['slug'] = $this->generateCategorySlug($data['name']);
        }
        $category = $this->Categories->patchEntity($category, $data);
        if ($this->Categories->save($category)) {
            echo json_encode(['status' => 1, 'message' => 'Category sucessfully created.']);
        } else {
            $this->autoRender = false;
            echo json_encode(['status' => 0, 'message' => 'Category could not be saved. Please, try again']);
        }
    }

    private function generateCategorySlug($slug) {
        $slug = \Cake\Utility\Text::slug($slug);
        if ($this->Categories->exists(['slug' => $slug])) {
            $slug .= '1';
            return $this->generateCategorySlug($slug);
        } else {
            return $slug;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $category = $this->Categories->get($id, [
            'contain' => ['Media' => ['fields' => ['url']], 'SubcategoryMedia', 'BannerMedia']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category details has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category details could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->find('treeList', [
            'keyPath' => 'id',
            'valuePath' => 'name',
            'spacer' => '&#9866;',
            'conditions' => ['Categories.level <=' => $category->level, 'AND' => ['Categories.id !=' => $id]]
        ]);
        $this->set(compact('category', 'parentCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function bulkAction($id = null) {
        $this->request->allowMethod(['post']);
        $action = $this->request->getData('action');
        if ($action == 'delete') {
            if ($this->Categories->deleteAll(['id IN' => $this->request->getData('mediaId')])) {
                $this->Flash->success(__('Selected categories successfully deleted.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Selected categories could not be deleted. Please try again.'));
            return $this->redirect(['action' => 'index']);
        }
        return $this->redirect(['action' => 'index']);
    }

}
