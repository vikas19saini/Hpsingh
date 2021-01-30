<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\GoneException;

class ProductController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel('Products');
    }

    public function display($slug) {

        $product = $this->Products->find('BySlug', [
            'slug' => $slug,
            'find' => 'fair'
        ]);

        if (!$product) {
            throw new GoneException('This product is no longer exist.');
        }

        $categoryIds = [];
        if ($product->categories) {
            $categories = $product->categories;

            foreach ($categories as $category) {
                array_push($categoryIds, $category->id);
            }

            $maxCategoryDepth = $this->Products->Categories->find('all', [
                        'conditions' => ['id IN' => $categoryIds]
                    ])->orderDesc('level')->first();

            $categoryPath = $this->Products->Categories->find('path', [
                'for' => $maxCategoryDepth->id
            ]);
        } else {
            $categoryPath = null;
        }
        
        $recommendedProducts = $this->Products->find('Recommended', [
                    'find' => 'fair',
                    'hierarchy' => $categoryIds,
                ])->limit(50)->shuffle();

        $this->loadModel('Countries');
        $countries = $this->Countries->find('list', [
            'keyField' => 'iso_code_2',
            'valueField' => 'name'
        ]);

        $this->set(compact('product', 'recommendedProducts', 'categoryPath', 'countries'));
    }

    public function checkDelivery($postcode, $counry_code, $product_id) {
        $this->request->allowMethod(['ajax']);

        if (strtolower($counry_code) === 'in') {

            if (empty($postcode) || strlen($postcode) !== 6) {
                return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Please enter a valid pincode.']));
            }

            $this->loadModel('ShippingZones');

            $postcodes = $this->ShippingZones->find('all', [
                        'conditions' => ['postcode' => $postcode],
                    ])->first();

            if ($postcodes) {
                if (strtolower($postcodes->availability) === 'no') {
                    return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => 'Delivery not available at this location.']));
                }
            }

            $deliveryTime = new \Cake\I18n\Time('+5 days');
            $response = [
                'status' => 'success',
                'DeliveryDayOfWeek' => $deliveryTime->format('D'),
                'DeliveryDate' => $deliveryTime->nice(),
                'DeliveryChargesText' => 'Free',
                'cod' => true,
            ];

            return $this->response->withType('json')->withStringBody(json_encode($response));
        }


        $this->loadComponent('Fedex');
        $products = $this->Products->find('all', [
            'conditions' => ['id' => $product_id]
        ]);
        $address = (object) [
                    'postcode' => $postcode,
                    'country' => (object) [
                        'iso_code_2' => $counry_code
                    ]
        ];

        return $this->response->withType('json')->withStringBody(json_encode($this->Fedex->getEstimatedRate($address, $products)));
    }

}
