<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;
use \Box\Spout\Reader\ReaderFactory;
use \Box\Spout\Common\Type;


class OrdersController extends AppController {

    public function index($order_status = 'all') {
		$orders = $this->Orders->getFilteredOrders($this->request->getQuery(), $order_status);

        $orders = $this->paginate($orders);
        $this->set(compact('orders'));
    }

    public function view($order_id) {
        $order = $this->Orders->get($order_id, [
            'contain' => ['Products', 'Products.Media', 'Users', 'Coupons', 'Payments', 'OrderHistory' => ['sort' => ['created' => 'DESC']]],
        ]);

        $this->set(compact('order'));
    }

    public function completeOrder($order_id) {

        if (empty($order_id)) {
            return $this->redirect(['action' => 'index']);
        }

        $this->Orders->updateStatus($order_id, 'completed', 'no', 'yes');
        $this->Flash->success('Order no #' . $order_id . ' is completed');
        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);

        if ($this->request->is('post')) {

            if (empty($this->request->getData('action'))) {
                return $this->redirect(['action' => 'index']);
            }

            $order_ids = $this->request->getData('actionIds');

            $order_ids = explode(',', $order_ids);
            foreach ($order_ids as $order_id) {
                $this->Orders->updateStatus($order_id, $this->request->getData('action'), 'no', 'yes');
            }

            $this->Flash->success('Orders status has been updated');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function updateAddress($order_id) {
        if ($this->request->is('put')) {
            if ($this->Orders->updateAll($this->request->getData(), ['id' => $order_id])) {
                $this->Flash->success('Address has been updated.');
            } else {
                $this->Flash->error('Address couldn\'t be updated.');
            }
        }

        return $this->redirect(['action' => 'view', $order_id]);
    }

    public function updateOrderStatus($order_id) {
        $this->request->allowMethod(['post']);
        if ($this->request->is('post')) {
			if ($this->Orders->updateStatus($order_id, $this->request->getData('status'), 'no', 'yes')) {
                $this->Flash->success('Order status has been updated.');
            } else {
                $this->Flash->error('Order status couldn\'t be updated.');
            }
        }
        
        return $this->redirect(['action' => 'view', $order_id]);
    }
	
	public function uploadCsv(){
		if ($this->request->is('post')) {
			if($_FILES['file']['name']){
				$filename = explode('.', $_FILES['file']['name']);
				if($filename[1]=='csv'){
					$handle = fopen($_FILES['file']['tmp_name'], "r");
					while ($data = fgetcsv($handle)){
						$order_id = $data[0];
						$tracking_no = $data[1];
						$this->Orders->updateTrackingNumber( $order_id , $tracking_no );
						$this->Orders->updateStatus($order_id, 'shipped', 'no', 'yes');
					}
					fclose($handle);
					$this->Flash->success('File Upload Successfully');
				}else{
					$this->Flash->error('Please Choose only CSV Files');
				}
			}
		}
		//$this->render(FALSE);
		return $this->redirect(['action' => 'index']);
		
	}

	public function updateTrackingNumber($order_id){
		$this->request->allowMethod(['post']);
        if ($this->request->is('post')) {
			if ($this->Orders->updateTrackingNumber($order_id, $this->request->getData('tracking_no'))) {
			    $this->Flash->success('Order Tracking Number has been updated.');
            } else {
                $this->Flash->error('Order Tracking Number couldn\'t be updated.');
            }
        }
        
        return $this->redirect(['action' => 'view', $order_id]);
	}
	
	
}
