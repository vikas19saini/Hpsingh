<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

class DashboardController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Products');
        $this->loadModel('Orders');
    }

    public function index()
    {
        $all = $this->Products->find('all', ['conditions' => ['deleted IS' => NULL]])->count();
        $published = $this->Products->find('all', ['conditions' => ['deleted IS' => NULL, 'AND' => ['status' => 'published']]])->count();
        $drafts = $this->Products->find('all', ['conditions' => ['deleted IS' => NULL, 'AND' => ['status' => 'drafts']]])->count();
        $trash = $this->Products->find('all', ['conditions' => ['deleted IS NOT' => NULL]])->count();
        $productsWithoutImages = $this->Products->porductsWithoutImages()->count();

        $allMedias = $this->Products->Media->find('all')->count();

        $allCategories = $this->Products->Categories->find('all')->count();
        $allTags = $this->Products->Tags->find('all')->count();

        $unlinkedCategories = $this->Products->Categories->unlinkedCategories()->count();
        $unlinkedTags = $this->Products->Tags->unlinkedTags()->count();

        $productsOutOfStock = $this->Products->getOutOfStock();
        $this->set(compact('all', 'published', 'drafts', 'trash', 'allMedias', 'productsWithoutImages', 'allCategories', 'allTags', 'unlinkedCategories', 'unlinkedTags', 'productsOutOfStock'));
    }

    public function getTopSelingProducts($start_date, $end_date)
    {
        $top_selling_products = $this->Products->getTopSelling($start_date, $end_date);
        return $this->response->withType('json')->withStringBody(json_encode($top_selling_products));
    }

    public function sales($start_date, $end_date)
    {
        $sales = $this->Products->Orders->sales($start_date, $end_date);
        return $this->response->withType('json')->withStringBody(json_encode($sales));
    }

    public function orders($start_date, $end_date)
    {
        $allOrders = $this->Orders->find('all')
            ->where(['DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $ordersInProcessing = $this->Orders->find('all')
            ->where(['status' => 'processing', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $ordersShipped = $this->Orders->find('all')
            ->where(['status' => 'shipped', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $ordersCompleted = $this->Orders->find('all')
            ->where(['status' => 'completed', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $ordersCancelled = $this->Orders->find('all')
            ->where(['status' => 'cancelled', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $orderRefunded = $this->Orders->find('all')
            ->where(['status' => 'refunded', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $ordersOnHold = $this->Orders->find('all')
            ->where(['status' => 'on-hold', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $ordersFaild = $this->Orders->find('all')
            ->where(['status' => 'failed', 'DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $todayOrders = $this->Orders->find('all')
            ->where(['DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', $start_date, 'date')
            ->bind(':end', $end_date, 'date')
            ->count();

        $yesterdayOrders = $this->Orders->find('all')
            ->where(['DATE(created) BETWEEN :start AND :end'])
            ->bind(':start', date('Y-m-d', strtotime("-1 days")), 'date')
            ->bind(':end', date('Y-m-d', strtotime("-1 days")), 'date')
            ->count();

        /*$yesterdayOrders = $this->Orders->find('all', [
                    'conditions' => ['DATE(created)' => date('Y-m-d', strtotime("-1 days"))]
                ])->count();*/

        return $this->response->withType('json')->withStringBody(json_encode(compact('allOrders', 'ordersInProcessing', 'ordersShipped', 'ordersCompleted', 'ordersCancelled', 'orderRefunded', 'ordersOnHold', 'ordersFaild', 'todayOrders', 'yesterdayOrders')));
    }

}
