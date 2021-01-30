<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $parent
 * @property string $description
 * @property int $media_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Media $media
 */
class Category extends Entity
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
        'slug' => true,
        'url' => true,
        'parent' => true,
        'description' => true,
        'meta_title' => true,
        'meta_description' => true,
        'meta_keywords' => true,
        'media_id' => true,
        'created' => true,
        'modified' => true,
        'media' => true,
        'products' => true,
        'use_as' => true,
        'media_for_subcategory' => true,
        'banner' => true,
        'layout' => true,
    ];

    protected function _setSlug($slug){
        return strtolower($slug);
    }
}
