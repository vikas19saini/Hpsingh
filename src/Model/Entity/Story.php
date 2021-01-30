<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Story Entity
 *
 * @property int $id
 * @property string $title
 * @property int $media_id
 * @property string $content
 * @property string $slug
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Media $media
 */
class Story extends Entity
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
        'title' => true,
        'media_id' => true,
        'content' => true,
        'slug' => true,
        'created' => true,
        'modified' => true,
        'media' => true
    ];
}
