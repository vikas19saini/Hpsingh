<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Currency Entity
 *
 * @property int $id
 * @property string $code
 * @property string $symbol
 * @property float $value
 * @property string $is_default
 * @property string $country_code
 */
class Currency extends Entity
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
        'code' => true,
        'symbol' => true,
        'value' => true,
        'is_default' => true,
        'country_code' => true
    ];
}
