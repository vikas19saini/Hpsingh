<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Slider Entity
 *
 * @property int $id
 * @property int $media_id
 * @property int $mobile_media_id
 * @property string $content
 * @property string $type
 * @property int $sort
 * @property string $status
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\MobileMedia $mobile_media
 */
class Slider extends Entity
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
        'media_id' => true,
        'mobile_media_id' => true,
        'content' => true,
        'type' => true,
        'sort' => true,
        'uri' => true,
        'status' => true,
        'media' => true,
        'mobile_media' => true
    ];
}
