<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property int $country_id
 * @property int $zone_id
 * @property string $city
 * @property string $postcode
 * @property string $label
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Zone $zone
 */
class Address extends Entity {

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
        'user_id' => true,
        'name' => true,
        'phone' => true,
        'address' => true,
        'country_id' => true,
        'zone_id' => true,
        'city' => true,
        'postcode' => true,
        'label' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'country' => true,
        'zone' => true
    ];
    protected $_virtual = ['formatted_address'];

    protected function _getFormattedAddress() {
        $formatted_address = [];

//        if(!empty($this->_properties['name'])){
//            array_push($formatted_address, $this->_properties['name']);
//        }

        if (!empty($this->_properties['address'])) {
            array_push($formatted_address, $this->_properties['address']);
        }

        if (!empty($this->_properties['city'])) {
            array_push($formatted_address, $this->_properties['city']);
        }

        if (!empty($this->_properties['zone_id'])) {
            if ($this->has('zone')) {
                array_push($formatted_address, $this->_properties['zone']->name);
            }
        }

        if (!empty($this->_properties['country_id'])) {
            if ($this->has('country')) {
                array_push($formatted_address, $this->_properties['country']->name);
            }
        }

        if (!empty($this->_properties['postcode'])) {
            array_push($formatted_address, $this->_properties['postcode']);
        }

        return implode(', ', $formatted_address);
    }

    protected function _getPhoneWithCode() {
        if ($this->has('country')) {
            return $this->_properties['country']->code . $this->_properties['phone'];
        }

        return $this->_properties['phone'];
    }

}
