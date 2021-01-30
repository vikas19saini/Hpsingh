<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Redirection Entity
 *
 * @property int $id
 * @property string $old_url
 * @property string $new_url
 * @property string $type
 */
class Redirection extends Entity
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
        'old_url' => true,
        'new_url' => true,
        'type' => true
    ];
}
