<?php

namespace App\View\Helper;

use Cake\View\Helper;

Class ProductHelper extends Helper {

    public $helpers = array('Html', 'Session', 'Number');

    public function the_price($regular = 0, $sale = '') {
        if (isset($sale) && !empty($sale)) {
            return '<del><i class="fa fa-inr" aria-hidden="true"></i>' . $this->Number->format($regular) . '</del><br/><ins><i class="fa fa-inr" aria-hidden="true"></i>' . $this->Number->format($sale) . '</ins>';
        }else{
            return '<i class="fa fa-inr" aria-hidden="true"></i>' . $this->Number->format($regular);
        }
    }
    
    public function categories($categories = []){
        $allCategories = '';
        if(isset($categories) && !empty($categories)){
            foreach ($categories as $category){
                $allCategories .= $category->name . ',';
            }
            return $allCategories;
        }else{
            return '<hr/>';
        }
    }
    
    public function tags($tags = []){
        $allTags = '';
        if(isset($tags) && !empty($tags)){
            foreach ($tags as $tag){
                $allTags .= $tag->name . ',';
            }
            return $allTags;
        }else{
            return '<hr/>';
        }
    }
    
    public function the_date($status, $date){
        return ucwords($status) . '@' . date_format($date, 'j M, Y h:i:s A');
    }
    
    public function displayReviewRating($rating){
        for($i = 0; $i < $rating; $i++){
            echo '<div class="product-star"><span class="dashicons dashicons-star-filled all-rating"></span></div>';
        }
    }
    
    public function price($product, $displayClass = 'yes', $qty = 0){
        $priceClass = ' / Mtr.';
        
        if(!empty($product->after_price)){
            $priceClass = ' / ' . $product->after_price;
        }
        
        if($displayClass === 'no'){
            $priceClass = '';
        }
        
        if(!empty($qty)){
            $price = $product->currency_regular_price * $qty;
            $sale_price = $product->currency_sale_price * $qty;
        }else{
            $price = $product->currency_regular_price;
            $sale_price = $product->currency_sale_price;
        }

        $defaultCurrency = $this->request->getSession()->read('Config.defaultCurrency');
        
        $html_ele = '<em><span></span>';
        
        if($product->sale_percent){
            $html_ele .= '<span>' . $this->Number->currency($sale_price, $defaultCurrency->code) . $priceClass . '</span> <span class="off">' . $this->Number->currency($price, $defaultCurrency->code) . $priceClass . '</span> <span class="offmsg">(' . $this->Number->precision($product->sale_percent, 0) . '% OFF)</span>';
        }else{
            $html_ele .= '<span>' . $this->Number->currency($price, $defaultCurrency->code) . $priceClass . '</span>';
        }
        
        $html_ele .= '</em>';
        
        return $html_ele;
    }

    public function convertPrice($price){
        $currency = $this->request->getSession()->read('Config.defaultCurrency');
        
        if (empty($price)) {
            return 0;
        }
        
        $price = $price * $currency->value;
        return $price;
    }
}
