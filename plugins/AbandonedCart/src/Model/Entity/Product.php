<?php

namespace AbandonedCart\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $short_description
 * @property string $long_description
 * @property string $fabric_name
 * @property string $weave
 * @property string $weight
 * @property string $width
 * @property string $content
 * @property string $design_no
 * @property string $count
 * @property float $ragular_price
 * @property float $sale_price
 * @property string $after_price
 * @property string $stock
 * @property string $manage_stock
 * @property float $quantity
 * @property float $min_order_qty
 * @property float $max_order_qty
 * @property float $step
 * @property float $shipping_weight
 * @property float $shipping_length
 * @property float $shipping_width
 * @property float $shipping_height
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \AbandonedCart\Model\Entity\ColorsToProduct[] $colors_to_products
 * @property \AbandonedCart\Model\Entity\Review[] $reviews
 * @property \AbandonedCart\Model\Entity\Wishlist[] $wishlist
 * @property \AbandonedCart\Model\Entity\Category[] $categories
 * @property \AbandonedCart\Model\Entity\Media[] $media
 * @property \AbandonedCart\Model\Entity\Order[] $orders
 * @property \AbandonedCart\Model\Entity\Tag[] $tags
 */
class Product extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'slug' => true,
        'short_description' => true,
        'long_description' => true,
        'fabric_name' => true,
        'weave' => true,
        'weight' => true,
        'width' => true,
        'content' => true,
        'design_no' => true,
        'count' => true,
        'ragular_price' => true,
        'sale_price' => true,
        'after_price' => true,
        'stock' => true,
        'manage_stock' => true,
        'quantity' => true,
        'min_order_qty' => true,
        'max_order_qty' => true,
        'step' => true,
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
        'colors_to_products' => true,
        'reviews' => true,
        'wishlist' => true,
        'categories' => true,
        'media' => true,
        'orders' => true,
        'tags' => true
    ];

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

    protected function _getPrice() {

        if (!isset($this->_properties['ragular_price'])) {
            return 0;
        }

        if (!empty($this->_properties['sale_price'])) {
            return $this->_properties['sale_price'];
        }

        return $this->_properties['ragular_price'];
    }

}
