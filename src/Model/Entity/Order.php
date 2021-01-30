<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $tracking_no
 * @property int $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $sname
 * @property string $sphone
 * @property string $saddress
 * @property string $scity
 * @property string $scountry
 * @property string $szone
 * @property string $spostcode
 * @property string $bname
 * @property string $bphone
 * @property string $baddress
 * @property string $bcity
 * @property string $bcountry
 * @property string $bzone
 * @property string $bpostcode
 * @property string $payment_method
 * @property string $shipping_method
 * @property string $status
 * @property string $currency_code
 * @property float $currency_value
 * @property float $total_price
 * @property float $discount
 * @property float $coupon_discount
 * @property float $sub_total
 * @property float $tax_charges
 * @property string $tax_class
 * @property float $shipping_charges
 * @property float $grand_total
 * @property string $customer_notified
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\OrderHistory[] $order_history
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\Coupon[] $coupons
 * @property \App\Model\Entity\Product[] $products
 */
class Order extends Entity
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
        'tracking_no' => true,
        'user_id' => true,
        'name' => true,
        'email' => true,
        'phone' => true,
        'sname' => true,
        'sphone' => true,
        'saddress' => true,
        'scity' => true,
        'scountry' => true,
        'szone' => true,
        'spostcode' => true,
        'bname' => true,
        'bphone' => true,
        'baddress' => true,
        'bcity' => true,
        'bcountry' => true,
        'bzone' => true,
        'bpostcode' => true,
        'payment_method' => true,
        'shipping_method' => true,
        'status' => true,
        'currency_code' => true,
        'currency_value' => true,
        'total_price' => true,
        'discount' => true,
        'coupon_discount' => true,
        'sub_total' => true,
        'tax_charges' => true,
        'tax_class' => true,
        'shipping_charges' => true,
        'cod_charges' => true,
        'grand_total' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'order_history' => true,
        'payments' => true,
        'coupons' => true,
        'products' => true,
        'gst' => true,
    ];
    
    protected function _getPaymentMode(){
        if($this->_properties['payment_method'] === 'cod'){
            return 'Cash/Pay on delivery';
        }
        
        return ucwords($this->_properties['payment_method']);
    }
    
    protected function _getOrderStatus(){
        if($this->_properties['status'] === 'completed'){
            return 'Delivered <em>(' . date_format($this->_properties['created'], 'd M, Y') . ')</em>';
        }
        
        return ucwords(str_replace('-', ' ', $this->_properties['status']));
    }
    
    protected function _getBillingAddress(){
        return $this->_properties['baddress'] . ' ' . $this->_properties['bcity'] . ', ' . $this->_properties['bzone'] . ', ' . $this->_properties['bpostcode'] . ', ' . $this->_properties['bcountry'];
    }
    
    protected function _getShippingAddress(){
        return $this->_properties['saddress'] . ' ' . $this->_properties['scity'] . ', ' . $this->_properties['szone'] . ', ' . $this->_properties['spostcode'] . ', ' . $this->_properties['scountry'];
    }
}
