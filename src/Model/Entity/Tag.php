<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tag Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Tag extends Entity
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
        'description' => true,
        'meta_title' => true,
        'meta_description' => true,
        'meta_keywords' => true,
        'created' => true,
        'modified' => true,
        'products' => true,
    ];
    
    protected function _setSlug($slug){
        return strtolower($slug);
    }
    
    protected function _setName($name){
        return trim($name);
    }
}
