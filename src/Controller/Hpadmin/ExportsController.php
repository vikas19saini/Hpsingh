<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

class ExportsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
		$this->loadModel('Orders');
        $datas = $this->Orders->find("all", [
            'contain' => ['OrdersProducts'],
        ])
		->orderDesc('created')
		->limit(1000)->toArray();
		$dirPath = WWW_ROOT . 'analyticReport' . DS;

        if(!is_dir($dirPath)){
            mkdir($dirPath);
        }

        $fileName = "analyticReport-" . microtime() . ".csv";
        $fp = fopen($dirPath . $fileName, 'wb');

        fputcsv($fp, [
			'Order Number',
			'Product Number',
            'Product Name',
			'Price',
            'Quantity',
        ]);
		
		foreach ($datas as $data) {
            fputcsv($fp, [
                ($data['orders_products']['0']) ? $data['orders_products']['0']->order_id : '',
				($data['orders_products']['0']) ? $data['orders_products']['0']->product_id : '',
                ($data['orders_products']['0']) ? $data['orders_products']['0']->name : '',
				($data['orders_products']['0']) ? $data['orders_products']['0']->price : '',
                ($data['orders_products']['0']) ? $data['orders_products']['0']->quantity : '',
			]);
        }

        fclose($fp);
		
        return $this->redirect("https://www.hpsingh.com/analyticReport/" . $fileName);
    }

}
