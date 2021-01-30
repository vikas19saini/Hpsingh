<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Verification Entity
 *
 * @property int $id
 * @property string $phone
 * @property string $email
 * @property int $otp
 * @property \Cake\I18n\FrozenTime $created
 */
class Verification extends Entity
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
        'phone' => true,
        'email' => true,
        'otp' => true,
        'created' => true
    ];
}
