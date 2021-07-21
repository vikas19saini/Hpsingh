<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Product extends Entity {

    protected $_accessible = [
        'name' => true,
        'slug' => true,
        'short_description' => true,
        'long_description' => true,
        'fabric_name' => true,
        'weave' => true,
        'width' => true,
        'content' => true,
        'design_no' => true,
        'count' => true,
        'ragular_price' => true,
        'sale_price' => true,
        'stock' => true,
        'manage_stock' => true,
        'quantity' => true,
        'shipping_weight' => true,
        'shipping_length' => true,
        'shipping_width' => true,
        'shipping_height' => true,
        'meta_title' => true,
        'meta_description' => true,
        'meta_keywords' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'media' => true,
        'tags' => true,
        'categories' => true,
        'min_order_qty' => true,
        'max_order_qty' => true,
        'step' => true,
        'weight' => true,
        'weight_feel_suitability' => true,
        'design_name_color' => true,
        'length' => true,
        'price_text' => true,
    ];

    protected $_virtual = ['price', 'currency_regular_price', 'currency_sale_price', 'sale_percent', 'featured_image', 'after_price'];

    protected function _getFeaturedImage() {
        $featuredMedia = '';
        if (isset($this->_properties['media']) && !empty($this->_properties['media'])) {
            foreach ($this->_properties['media'] as $media) {
                if ($media->_joinData->type == "featured") {
                    $featuredMedia = $media;
                }
            }
            if (isset($featuredMedia) && !empty($featuredMedia)) {
                return $featuredMedia;
            } else {
                return $this->_properties['media'][0];
            }
        }
    }

    protected function _getAfterPrice(){
        if(array_key_exists('price_text', $this->_properties)){
            if(stripos($this->_properties['price_text'], 'mtr') || stripos($this->_properties['price_text'], 'meter')){
                return 'Mtr';
            }

            if(stripos($this->_properties['price_text'], 'kg')){
                return 'Kg';
            }

            if(stripos($this->_properties['price_text'], 'piece')){
                return 'Piece';
            }

            if(stripos($this->_properties['price_text'], 'dupatta')){
                return 'Dupatta';
            }
        }

        return 'Mtr';
    }

    protected function _getProductThumbnail() {
        $thumbnilsMedia = [];
        if (isset($this->_properties['media']) && !empty($this->_properties['media'])) {
            foreach ($this->_properties['media'] as $media) {
                if ($media->_joinData->type == "thumbnail") {
                    array_push($thumbnilsMedia, $media);
                }
            }
            if (isset($thumbnilsMedia) && !empty($thumbnilsMedia)) {
                return $thumbnilsMedia;
            }
        }
    }

    protected function _getMinOrderQty($min_order_qty) {
        if (empty($min_order_qty))
            return 1;

        return $min_order_qty;
    }

    protected function _getMaxOrderQty($max_order_qty) {
        if (empty($max_order_qty))
            return 200;

        return $max_order_qty;
    }

    protected function _getStep($step) {
        if (empty($step))
            return 0.1;

        return $step;
    }

    protected function _getPrice() {
        $defaultCurrency = \Cake\Routing\Router::getRequest()->getSession()->read('Config.defaultCurrency');

        if (!isset($this->_properties['ragular_price'])) {
            return 0;
        }

        if (!empty($this->_properties['sale_price'])) {
            return $this->_properties['sale_price'] * $defaultCurrency->value;
        }

        return $this->_properties['ragular_price'] * $defaultCurrency->value;
    }

    protected function _getCurrencyRegularPrice() {
        $defaultCurrency = \Cake\Routing\Router::getRequest()->getSession()->read('Config.defaultCurrency');

        if (!isset($this->_properties['ragular_price'])) {
            return 0;
        }

        return $this->_properties['ragular_price'] * $defaultCurrency->value;
    }

    protected function _getCurrencySalePrice() {
        $defaultCurrency = \Cake\Routing\Router::getRequest()->getSession()->read('Config.defaultCurrency');
        if (!empty($this->_properties['sale_price'])) {
            return $this->_properties['sale_price'] * $defaultCurrency->value;
        } else {
            return 0;
        }
    }

    protected function _getSalePercent() {

        if (!empty($this->_properties['sale_price'])) {
            return (($this->_getCurrencyRegularPrice() - $this->_getCurrencySalePrice() ) / $this->_getCurrencyRegularPrice()) * 100;
        }
        return false;
    }

    protected function _getInStock() {

        if (trim($this->_properties['stock']) === 'out_of_stock') {
            return false;
        }

        if (trim($this->_properties['manage_stock']) === 'no') {
            return true;
        }

        if (empty($this->_properties['ragular_price'])) {
            return false;
        }

        if (empty($this->_properties['quantity'])) {
            return false;
        }

        return true;
    }

    protected function _getOnSale() {
        if (!empty($this->_properties['sale_price'])) {
            return true;
        }

        return false;
    }

    protected function _setSlug($slug) {
        return strtolower($slug);
    }

}
