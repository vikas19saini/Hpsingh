<?php

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Category cell
 */
class CategoryCell extends Cell {

    protected $_validCellOptions = [];

    public function subCategories($category) {
        $this->loadModel('Categories');

        $subCategories = $this->Categories->find('children', ['for' => $category->id]);

        $this->set(compact('subCategories', 'category'));
    }

    public function subCategory($category) {
        $this->loadModel('Categories');

        $path = $this->Categories->find('path', [
            'for' => $category->id
        ]);

        $this->set(compact('path', 'category'));
    }

    public function hasSubCategories($category) {
        $this->loadModel('Categories');
        $subCategories = $this->Categories->find('children', ['for' => $category->id]);
        $this->set(compact('subCategories'));
    }

    public function getProductsCount($category_id) {
        $this->loadModel('Products');

        $products_count = $this->Products->find('all')
                        ->matching('Categories', function($q) use ($category_id) {
                            return $q->where(['Categories.id' => $category_id,'Products.status' => 'published', 'Products.deleted IS NULL','Products.ragular_price !=' => '0'
]);
                        })->distinct('Products.id');

        $products_count = $products_count->count();
        $this->set(compact('products_count'));
    }

}
