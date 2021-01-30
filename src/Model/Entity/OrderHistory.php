<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderHistory Entity
 *
 * @property int $id
 * @property int $order_id
 * @property string $status
 * @property string $notify_customer
 * @property string $is_private
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Order $order
 */
class OrderHistory extends Entity
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
        'order_id' => true,
        'status' => true,
        'notify_customer' => true,
        'is_private' => true,
        'comment' => true,
        'created' => true,
        'order' => true
    ];
}
