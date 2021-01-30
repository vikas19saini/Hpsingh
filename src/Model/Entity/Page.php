<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Page Entity
 *
 * @property int $id
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $template
 * @property string $is_home
 * @property \Cake\I18n\FrozenTime $created
 */
class Page extends Entity
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
        'slug' => true,
        'meta_title' => true,
        'meta_description' => true,
        'meta_keywords' => true,
        'template' => true,
        'is_home' => true,
        'created' => true
    ];
}
