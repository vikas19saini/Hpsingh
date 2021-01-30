<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Coupon Entity
 *
 * @property int $id
 * @property string $type
 * @property string $code
 * @property string $description
 * @property float $value
 * @property \Cake\I18n\FrozenDate $expiry_date
 * @property float $minimum_spend
 * @property float $maximum_spend
 * @property bool $individual_only
 * @property bool $exclude_sale_items
 * @property string $products
 * @property string $exclude_products
 * @property string $categories
 * @property string $exclude_categories
 * @property string $users
 * @property int $usage_limit
 * @property int $limit_per_user
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Coupon extends Entity {

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
        'type' => true,
        'code' => true,
        'description' => true,
        'value' => true,
        'expiry_date' => true,
        'minimum_spend' => true,
        'maximum_spend' => true,
        'individual_only' => true,
        'exclude_sale_items' => true,
        'products' => true,
        'exclude_products' => true,
        'categories' => true,
        'exclude_categories' => true,
        'users' => true,
        'usage_limit' => true,
        'limit_per_user' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
    ];

    protected function _getMinimumSpendCurrency() {
        if (Router::getRequest()->getSession()->check('Config.defaultCurrency')) {
            $defaultCurrency = Router::getRequest()->getSession()->read('Config.defaultCurrency');
            return $this->_properties['minimum_spend'] * $defaultCurrency->value;
        }

        return $this->_properties['minimum_spend'];
    }

    protected function _getMaximumSpendCurrency() {
        if (Router::getRequest()->getSession()->check('Config.defaultCurrency')) {
            $defaultCurrency = Router::getRequest()->getSession()->read('Config.defaultCurrency');
            return $this->_properties['maximum_spend'] * $defaultCurrency->value;
        }

        return $this->_properties['maximum_spend'];
    }
    
    protected function _getCouponCurrencyValue(){
        if (Router::getRequest()->getSession()->check('Config.defaultCurrency')) {
            $defaultCurrency = Router::getRequest()->getSession()->read('Config.defaultCurrency');
            return $this->_properties['value'] * $defaultCurrency->value;
        }

        return $this->_properties['value'];
    }
}
