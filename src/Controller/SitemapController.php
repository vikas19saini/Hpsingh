<?php

namespace App\Controller;

use App\Controller\AppController;

class SitemapController extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel('Categories');
    }

    public function xml($slug = null) {
        if ($slug === 'categories') {
            $categories = $this->Categories->find('all');
            $this->set(compact('categories'));
            $this->render('categories');
        }

        if ($slug === 'products') {
            $products = $this->Categories->Products->find('all');
            $this->set(compact('products'));
            $this->render('products');
        }

        if ($slug === 'tags') {
            $this->loadModel('Tags');
            $tags = $this->Tags->find('all');
            $this->set(compact('tags'));
            $this->render('tags');
        }
        
        if ($slug === 'stories') {
            $this->loadModel('Stories');
            $stories = $this->Stories->find('all');
            $this->set(compact('stories'));
            $this->render('stories');
        }
    }

}
