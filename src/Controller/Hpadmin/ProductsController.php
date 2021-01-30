<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $status = $this->request->getQuery('status');

        if($this->request->getQuery('porductsWithoutImages') === "yes"){
            $products = $this->Products->porductsWithoutImages();
        }else{
            $products = $this->Products->getProductsAdmin($this->request->getQuery());
        }

        $products = $this->paginate($products, ['limit' => 100]);

        $allCategories = $this->Products->Categories->find('treeList', [
                    'keyPath' => 'id',
                    'valuePath' => 'name',
                    'spacer' => '&#9866;',
                ])->toArray();

        $all = $this->Products->find('all', ['conditions' => ['deleted IS' => NULL]])->count();
        $published = $this->Products->find('all', ['conditions' => ['deleted IS' => NULL, 'AND' => ['status' => 'published']]])->count();
        $drafts = $this->Products->find('all', ['conditions' => ['deleted IS' => NULL, 'AND' => ['status' => 'drafts']]])->count();
        $trash = $this->Products->find('all', ['conditions' => ['deleted IS NOT' => NULL]])->count();
        $this->set(compact('products', 'allCategories', 'status', 'all', 'published', 'drafts', 'trash'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $product = $this->Products->newEntity();
        $this->loadComponent('Taxonomy');
        $data['slug'] = $this->Taxonomy->generateAndValidateSlug('product', 'auto-generated-slug');
        $data['ragular_price'] = 0;
        $data['stock'] = 'in_stock';

        $product = $this->Products->patchEntity($product, $data);
        if ($this->Products->save($product)) {
            return $this->redirect(['action' => 'edit', $product->id]);
        }
        $this->Flash->error(__('The product could not be create.'));
        return $this->redirect(['action' => 'index']);
    }

    public function slug($name = null) {
        $this->autoRender = false;
        $this->loadComponent('Taxonomy');
        if (isset($name) && !empty($name)) {
            echo $this->Taxonomy->generateAndValidateSlug('product', $name);
            die();
        } else {
            echo $this->Taxonomy->generateAndValidateSlug('product', 'auto-generated-slug');
            die();
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $product = $this->Products->get($id, [
            'contain' => ['Media', 'Categories', 'Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productData = $this->request->getData();
            $productData['tags'] = ['_ids' => @explode(',', $productData['product-tags'])];
            if ($productData['featured-image'] != "") {
                $media = $productData['featured-image'] . ',' . $productData['thumbnails'];
            } else {
                $media = $productData['thumbnails'];
            }
            $media = @explode(',', $media);
            $productData['media'] = ['_ids' => $media];
            $product = $this->Products->patchEntity($product, $productData, ['associated' => ['Categories', 'Tags', 'Media._joinData']]);
            $mediaIds = array_map(function($media) {
                return is_object($media) ? $media->id : $media['id'];
            }, $product->media);
            if (isset($productData['featured-image']) && !empty($productData['featured-image'])) {
                $featuredMediaKey = array_search($productData['featured-image'], $mediaIds);
            } else {
                $featuredMediaKey = 0;
            }
            $noOfMedia = count($product->media);
            for ($i = 0; $i < $noOfMedia; $i++) {
                if ($i == $featuredMediaKey) {
                    $product->media[$i]['_joinData'] = new \Cake\ORM\Entity(['type' => 'featured']);
                } else {
                    $product->media[$i]['_joinData'] = new \Cake\ORM\Entity(['type' => 'thumbnail']);
                }
            }
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $allCategories = $this->Products->Categories->find('treeList', [
                    'keyPath' => 'id',
                    'valuePath' => 'name',
                    'spacer' => '&#9866;',
                ])->toArray();
        $review = $this->Products->Reviews->newEntity();
        $this->set(compact('product', 'allCategories', 'review'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        $data['deleted'] = date('Y-m-d h:i:s');
        $product = $this->Products->patchEntity($product, $data);
        if ($this->Products->save($product)) {
            $this->Flash->success(__('The product has been moved to trash.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);
        if ($this->request->is('post')) {
            $action = $this->request->getData('action');
            $productIds = @explode(',', $this->request->getData('actionIds'));
            switch ($action) {
                case 'trash':
                    if ($this->Products->updateAll(['deleted' => date('Y-m-d h:i:s')], ['Products.id IN' => $productIds])) {
                        $this->Flash->success('All selected products are moved to trash.');
                    } else {
                        $this->Flash->error('Unable to mark selected products as Trash. Please, try again');
                    }
                    break;
                case 'in_stock':
                    if ($this->Products->updateAll(['stock' => 'in_stock'], ['Products.id IN' => $productIds])) {
                        $this->Flash->success('All selected products are marked as "In Stock"');
                    } else {
                        $this->Flash->error('Unable to mark selected products as "In Stock". Please, try again');
                    }
                    break;
                case 'out_of_stock':
                    if ($this->Products->updateAll(['stock' => 'out_of_stock'], ['Products.id IN' => $productIds])) {
                        $this->Flash->success('All selected products are marked as "Out Of Stock"');
                    } else {
                        $this->Flash->error('Unable to mark selected products as "Out Of Stock". Please, try again');
                    }
                    break;
                case 'published':
                    if ($this->Products->updateAll(['deleted' => NULL], ['Products.id IN' => $productIds])) {
                        $this->Flash->success('All selected products are Published now');
                    } else {
                        $this->Flash->error('Unable to mark selected products as publish. Please, try again');
                    }
                    break;
                case 'drafts':
                    if ($this->Products->updateAll(['status' => 'drafts'], ['Products.id IN' => $productIds])) {
                        $this->Flash->success('All selected products are moved to Drfts');
                    } else {
                        $this->Flash->error('Unable to mark selected products as drafts. Please, try again');
                    }
                    break;
                case 'delete':
                    if ($this->Products->deleteAll(['Products.id IN' => $productIds])) {
                        $this->Flash->success('All selected products has been deleted.');
                    } else {
                        $this->Flash->error('Unable to delete selected products. Please, try again');
                    }
                    break;
                default :
                    return $this->redirect(['action' => 'index']);
            }
            return $this->redirect(['action' => 'index']);
        }
    }

    public function restore($id = null) {
        $this->request->allowMethod(['post']);
        $product = $this->Products->get($id);
        $product->deleted = NULL;
        if ($this->Products->save($product)) {
            $this->Flash->success('Product successfully restored.');
        } else {
            $this->Flash->error('Product can not be restored. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete_permanently($id = null) {
        $this->request->allowMethod(['post']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success('Product permanently deleted.');
        } else {
            $this->Flash->error('Product can not be delete. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function get_search_term($term = '', $includeInSugessions = 'all') {
        $this->request->allowMethod(['ajax']);
        $this->autoRender = false;
        $this->loadModel('Tags');
        $this->loadModel('Categories');
        $html = '<ul>';
        switch ($includeInSugessions) {
            case 'tags':
                $tags = $this->Tags->find('all', [
                    'conditions' => ['name LIKE' => '%' . $term . '%'],
                    'fields' => ['name', 'id']
                ]);
                foreach ($tags as $tag) {
                    if ($tag->name)
                        $html .= '<li data-id="' . $tag->id . '"><b>' . $tag->name . '</b><span>__Tag</span></li>';
                    else
                        $html .= '<li data-id="' . $tag->id . '">---<span>__Tag</span></li>';
                }
                break;
            case 'categories':
                $categories = $this->Categories->find('all', [
                    'conditions' => ['name LIKE' => '%' . $term . '%'],
                    'fields' => ['name', 'id']
                ]);
                foreach ($categories as $category) {
                    if ($category->name != '')
                        $html .= '<li data-id="' . $category->id . '"><b>' . $category->name . '</b><span>__Category</span></li>';
                    else
                        $html .= '<li data-id="' . $category->id . '">---<span>__Category</span></li>';
                }
                break;
            case 'products':
                $products = $this->Products->find('all', [
                    'conditions' => ['name LIKE' => '%' . $term . '%'],
                    'fields' => ['name', 'id']
                ]);
                foreach ($products as $product) {
                    if ($product->name != '')
                        $html .= '<li data-id="' . $product->id . '"><b>' . $product->name . '</b><span>__Product</span></li>';
                    else
                        $html .= '<li data-id="' . $product->id . '">---<span>__Product</span></li>';
                }
                break;
            default :
                $tags = $this->Tags->find('all', [
                    'conditions' => ['name LIKE' => '%' . $term . '%'],
                    'fields' => ['name', 'id']
                ]);
                $categories = $this->Categories->find('all', [
                    'conditions' => ['name LIKE' => '%' . $term . '%'],
                    'fields' => ['name', 'id']
                ]);
                $products = $this->Products->find('all', [
                    'conditions' => ['name LIKE' => '%' . $term . '%'],
                    'fields' => ['name', 'id']
                ]);
                foreach ($tags as $tags) {
                    if ($tags->name)
                        $html .= '<li><b>' . $tags->name . '</b><span>__Tag</span></li>';
                    else
                        $html .= '<li>---<span>__Tag</span></li>';
                }
                foreach ($categories as $category) {
                    if ($category->name != '')
                        $html .= '<li><b>' . $category->name . '</b><span>__Category</span></li>';
                    else
                        $html .= '<li>---<span>__Category</span></li>';
                }
                foreach ($products as $product) {
                    if ($product->name != '')
                        $html .= '<li><b>' . $product->name . '</b><span>__Product</span></li>';
                    else
                        $html .= '<li>---<span>__Product</span></li>';
                }
                break;
        }
        $html .= '</ul>';
        echo $html;
    }

}
