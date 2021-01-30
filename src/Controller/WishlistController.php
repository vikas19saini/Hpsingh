<?php
namespace App\Controller;

use App\Controller\AppController;

class WishlistController extends AppController{

    public function initialize(){
        parent::initialize();
        $this->Auth->deny(['add', 'addFromCart', 'display', 'getItems', 'remove']);

        $this->loadModel('Products');
    }

    public function display(){}

    public function add($slug){
        $this->request->allowMethod(['ajax']);

        $product = $this->Products->find('all', [
            'conditions' => ['slug' => $slug],
            'find' => 'fair'
        ])->first();

        if(!$product){
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Product not found!']));
        }

        $wishlist = $this->Wishlist->newEntity();

        $postData['user_id'] = $this->Auth->user('id');
        $postData['product_id'] = $product->id;

        $wishlist = $this->Wishlist->patchEntity($wishlist, $postData);

        if($this->Wishlist->save($wishlist)){
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'message' => 'Added to wishlist.']));
        }

        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Couldn\'t be Added to wishlist.']));
    }

    public function addFromCart($slug){
        $this->request->allowMethod(['ajax']);

        $product = $this->Products->find('all', [
            'conditions' => ['slug' => $slug],
            'find' => 'fair'
        ])->first();

        if(!$product){
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Product not found!']));
        }

        $wishlist = $this->Wishlist->newEntity();

        $postData['user_id'] = $this->Auth->user('id');
        $postData['product_id'] = $product->id;

        $wishlist = $this->Wishlist->patchEntity($wishlist, $postData);

        if($this->Wishlist->save($wishlist)){
            $this->loadComponent('Cart');
            $this->Cart->remove($product->id);
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'message' => 'Moved to wishlist']));
        }

        return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Couldn\'t be moved to wishlist.']));
    }

    public function getItems(){
        $this->request->allowMethod(['ajax']);

        $wishlist = $this->Wishlist->find('all', [
            'conditions' => ['Wishlist.user_id' => $this->Auth->user('id')],
            'contain' => ['Products.Media']
        ]);

        $this->set(compact('wishlist'));
    }

    public function remove($wid){
        $this->request->allowMethod(['ajax']);

        try{
            $wishlist = $this->Wishlist->get($wid);
            
            if($this->Wishlist->delete($wishlist)){
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'success', 'message' => 'Item removed.']));
            }

            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => "Couldn't be removed." ]));
        }catch(\RuntimeException $e){
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => "Not found in your wishlist!" ]));
        }
    }
}
