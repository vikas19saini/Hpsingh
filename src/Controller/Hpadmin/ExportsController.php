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
            foreach($data['orders_products'] as $dproduct){
				fputcsv($fp, [
                $dproduct->order_id,
				$dproduct->product_id,
                $dproduct->name,
				$dproduct->price,
                $dproduct->quantity,
			]);
			}
        }

        fclose($fp);
		
        return $this->redirect("https://www.hpsingh.com/analyticReport/" . $fileName);
    }

}
