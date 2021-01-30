<?php

namespace AbandonedCart\Controller\Hpadmin;

use App\Controller\AppController as BaseController;

class CartManagerController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Cart');
    }

    public function index()
    {
        $carts = $this->Cart->getCartData($this->request->getQuery());
        $carts = $this->paginate($carts);
        $this->set(compact('carts'));
    }

    public function export(){
        $carts = $this->Cart->getCartData($this->request->getQuery());

        $dirPath = WWW_ROOT . 'abondedCarts' . DS;

        if(!is_dir($dirPath)){
            mkdir($dirPath);
        }

        $fileName = "abondedCart-" . microtime() . ".csv";
        $fp = fopen($dirPath . $fileName, 'wb');

        fputcsv($fp, [
            'Customer Name',
            'Email Address',
            'Contact Number',
            'Products',
            'Created'
        ]);

        foreach ($carts as $cart) {
            $products = [];

            $cartProducts = $this->Cart->find('all', [
                'conditions' => ['Cart.user_id' => $cart->user_id],
                'contain' => ['Products']
            ]);

            foreach ($cartProducts as $cartProduct) {
                array_push($products, $cartProduct->product->name);
            }

            fputcsv($fp, [
                $cart->user->name,
                $cart->user->email,
                $cart->user->phone,
                implode(' | ', $products),
                date_format($cart->created, "d M, Y")
            ]);
        }

        fclose($fp);
        return $this->redirect("https://www.hpsingh.com/abondedCarts/" . $fileName);
    }

    public function view($user_id = null)
    {

        try {
            $carts = $this->Cart->find('all', [
                'conditions' => ['Cart.user_id' => $user_id],
                'contain' => ['Products.Media', 'Users']
            ]);
            $this->loadModel('Users');
            $user = $this->Users->get($user_id);
            $this->set(compact('carts', 'user'));
        } catch (\RuntimeException $e) {
            $this->Flash->error($e->getMessage());
            return $this->redirect(['action' => 'index']);
        }
    }

    public function delete($cart_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        try {
            $session = $this->Cart->get($cart_id);
            if ($this->Cart->delete($cart_id)) {
                $this->Flash->success('Successfully deleted.');
            } else {
                $this->Flash->error("Couldn't be deleted, please try again!");
            }
        } catch (\RuntimeException $e) {
            $this->Flash->error($e->getMessage());
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction()
    {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Cart->deleteAll(['id IN' => $Ids])) {
                $this->Flash->success('All selected records has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected records. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
