<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $order_id
 * @property float $amount
 * @property string $currency_code
 * @property string $transaction_no
 * @property string $payment_method
 * @property string $status
 * @property string $links
 * @property string $details
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Order $order
 */
class Payment extends Entity
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
        'amount' => true,
        'currency_code' => true,
        'transaction_no' => true,
        'payment_method' => true,
        'status' => true,
        'links' => true,
        'details' => true,
        'created' => true,
        'order' => true
    ];
}
