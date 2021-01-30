<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property int $id
 * @property string $name
 * @property string $iso_code_2
 * @property string $iso_code_3
 *
 * @property \App\Model\Entity\Address[] $addresses
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Zone[] $zones
 */
class Country extends Entity
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
        'name' => true,
        'iso_code_2' => true,
        'iso_code_3' => true,
        'addresses' => true,
        'users' => true,
        'zones' => true
    ];
}
