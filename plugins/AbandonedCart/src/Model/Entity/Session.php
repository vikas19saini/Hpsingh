<?php

namespace AbandonedCart\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property string $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|resource $data
 * @property int $expires
 */
class Session extends Entity {

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
        'created' => true,
        'modified' => true,
        'data' => true,
        'expires' => true
    ];
    private $_session = [];

    function __construct(array $properties = array(), array $options = array()) {
        parent::__construct($properties, $options);
        $this->_getSessionData($properties['data']);
    }

    protected function _getEmailAddress() {

        if (!array_key_exists('Auth', $this->_session)) {
            return '';
        }

        return $this->_session['Auth']['User']->email;
    }

    protected function _getCustomerName() {
        if (!array_key_exists('Auth', $this->_session)) {
            return 'Visitor';
        }

        return $this->_session['Auth']['User']->name;
    }

    protected function _getCartTotal() {
        if (array_key_exists('Cart', $this->_session)) {
            if (count($this->_session['Cart']['Products']) <= 0) {
                return null;
            }
            return \Cake\I18n\Number::currency($this->_session['Cart']['CartDetails']['grantTotal'] * $this->_session['Config']['defaultCurrency']->value, 'INR');
        }

        return null;
    }

    protected function _getDefaultCurrency() {
        return $this->_session['Config']['defaultCurrency'];
    }
    
    protected function _getCartDetails(){
        return $this->_session['Cart']['CartDetails'];
    }

    protected function _getProducts() {
        if (array_key_exists('Cart', $this->_session)) {
            $products_in_cart = $this->_session['Cart']['Products'];

            if (count($products_in_cart) <= 0) {
                return [null, null];
            }

            $products_ids = array_map(function($product) {
                return $product['product_id'];
            }, $products_in_cart);

            $products_table = \Cake\ORM\TableRegistry::getTableLocator()->get('AbandonedCart.Products');
            $products = $products_table->find('all')->where(['id IN' => $products_ids])->contain(['Media']);

            return [$products_in_cart, $products];
        }
        return [null, null];
    }

    private function _getSessionData($encodedSessionData = '') {

        $encodedSessionData = stream_get_contents($encodedSessionData);

        if ('' === $encodedSessionData) {
            return [];
        }
        preg_match_all('/(^|;|\})(\w+)\|/i', $encodedSessionData, $matchesarray, PREG_OFFSET_CAPTURE);
        $decodedData = [];
        $lastOffset = null;
        $currentKey = '';
        foreach ($matchesarray[2] as $value) {
            $offset = $value[1];
            if (null !== $lastOffset) {
                $valueText = substr($encodedSessionData, $lastOffset, $offset - $lastOffset);
                /** @noinspection UnserializeExploitsInspection */
                $decodedData[$currentKey] = unserialize($valueText);
            }
            $currentKey = $value[0];
            $lastOffset = $offset + strlen($currentKey) + 1;
        }
        $valueText = substr($encodedSessionData, $lastOffset);
        /** @noinspection UnserializeExploitsInspection */
        $decodedData[$currentKey] = unserialize($valueText);
        $this->_session = $decodedData;
        return true;
    }

}
