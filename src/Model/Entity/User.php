<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $user_group
 * @property string $password
 * @property string $activation_key
 * @property int $country_id
 * @property string $reset
 * @property string $cod_enable
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Review[] $reviews
 * @property \App\Model\Entity\Wishlist[] $wishlist
 * @property \App\Model\Entity\Address[] $addresses
 */
class User extends Entity
{

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
        'email' => true,
        'name' => true,
        'phone' => true,
        'user_group' => true,
        'password' => true,
        'activation_key' => true,
        'country_id' => true,
        'reset' => true,
        'cod_enable' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'country' => true,
        'reviews' => true,
        'wishlist' => true,
        'addresses' => true,
        'last_login' => true,
        'login_device' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
}
