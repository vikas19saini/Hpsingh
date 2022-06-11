<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use \Cake\Mailer;
use \Cake\I18n\Date;

/**
 * Orders Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\OrderHistoryTable|\Cake\ORM\Association\HasMany $OrderHistory
 * @property \App\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\CouponsTable|\Cake\ORM\Association\BelongsToMany $Coupons
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
{

    use Mailer\MailerAwareTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('orders');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('OrderHistory', [
            'foreignKey' => 'order_id'
        ]);
        $this->hasMany('Payments', [
            'foreignKey' => 'order_id'
        ]);
        $this->belongsToMany('Coupons', [
            'foreignKey' => 'order_id',
            'targetForeignKey' => 'coupon_id',
            'joinTable' => 'orders_coupons'
        ]);
        $this->belongsToMany('Products', [
            'foreignKey' => 'order_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'orders_products',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('tracking_no')
            ->maxLength('tracking_no', 100)
            ->allowEmpty('tracking_no');

        $validator
            ->scalar('name')
            ->maxLength('name', 225)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 15)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('sname')
            ->maxLength('sname', 225)
            ->requirePresence('sname', 'create')
            ->notEmpty('sname');

        $validator
            ->scalar('sphone')
            ->maxLength('sphone', 15)
            ->requirePresence('sphone', 'create')
            ->notEmpty('sphone');

        $validator
            ->scalar('saddress')
            ->maxLength('saddress', 225)
            ->requirePresence('saddress', 'create')
            ->notEmpty('saddress');

        $validator
            ->scalar('scity')
            ->maxLength('scity', 100)
            ->requirePresence('scity', 'create')
            ->notEmpty('scity');

        $validator
            ->scalar('scountry')
            ->maxLength('scountry', 100)
            ->requirePresence('scountry', 'create')
            ->notEmpty('scountry');

        $validator
            ->scalar('szone')
            ->maxLength('szone', 100)
            ->requirePresence('szone', 'create')
            ->notEmpty('szone');

        $validator
            ->scalar('spostcode')
            ->maxLength('spostcode', 10)
            ->requirePresence('spostcode', 'create')
            ->notEmpty('spostcode');

        $validator
            ->scalar('bname')
            ->maxLength('bname', 225)
            ->requirePresence('bname', 'create')
            ->notEmpty('bname');

        $validator
            ->scalar('bphone')
            ->maxLength('bphone', 15)
            ->requirePresence('bphone', 'create')
            ->notEmpty('bphone');

        $validator
            ->scalar('baddress')
            ->maxLength('baddress', 225)
            ->requirePresence('baddress', 'create')
            ->notEmpty('baddress');

        $validator
            ->scalar('bcity')
            ->maxLength('bcity', 100)
            ->requirePresence('bcity', 'create')
            ->notEmpty('bcity');

        $validator
            ->scalar('bcountry')
            ->maxLength('bcountry', 100)
            ->requirePresence('bcountry', 'create')
            ->notEmpty('bcountry');

        $validator
            ->scalar('bzone')
            ->maxLength('bzone', 100)
            ->requirePresence('bzone', 'create')
            ->notEmpty('bzone');

        $validator
            ->scalar('bpostcode')
            ->maxLength('bpostcode', 10)
            ->requirePresence('bpostcode', 'create')
            ->notEmpty('bpostcode');

        $validator
            ->scalar('gst')
            ->maxLength('gst', 15)
            ->allowEmpty('gst');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 50)
            ->requirePresence('payment_method', 'create')
            ->notEmpty('payment_method');

        $validator
            ->scalar('shipping_method')
            ->maxLength('shipping_method', 50)
            ->allowEmpty('shipping_method');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('currency_code')
            ->maxLength('currency_code', 3)
            ->requirePresence('currency_code', 'create')
            ->notEmpty('currency_code');

        $validator
            ->numeric('currency_value')
            ->requirePresence('currency_value', 'create')
            ->notEmpty('currency_value');

        $validator
            ->numeric('total_price')
            ->requirePresence('total_price', 'create')
            ->notEmpty('total_price');

        $validator
            ->numeric('discount')
            ->allowEmpty('discount');

        $validator
            ->numeric('coupon_discount')
            ->allowEmpty('coupon_discount');

        $validator
            ->numeric('sub_total')
            ->requirePresence('sub_total', 'create')
            ->notEmpty('sub_total');

        $validator
            ->numeric('tax_charges')
            ->allowEmpty('tax_charges');

        $validator
            ->scalar('tax_class')
            ->maxLength('tax_class', 10)
            ->allowEmpty('tax_class');

        $validator
            ->numeric('shipping_charges')
            ->allowEmpty('shipping_charges');

        $validator
            ->numeric('cod_charges')
            ->allowEmpty('cod_charges');

        $validator
            ->numeric('grand_total')
            ->requirePresence('grand_total', 'create')
            ->notEmpty('grand_total');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function afterSave($event, $entity, $options)
    {

        if ($entity->isNew()) {
            if ($entity->payment_method === 'cod') {
                $this->__addOrderHistory([
                    'order_id' => $entity->id,
                    'status' => 'processing',
                    'notify_customer' => 'yes',
                    'is_private' => 'yes',
                    'comment' => 'The order has been saved.',
                ]);
            } else {
                $this->__addOrderHistory([
                    'order_id' => $entity->id,
                    'status' => 'pending-payment',
                    'notify_customer' => 'no',
                    'is_private' => 'yes',
                    'comment' => 'The order has been saved, waiting for payment confirmation.',
                ]);
            }

            $this->__dec_quantity($entity); // Update products quantity
        }

        if ($entity->status === 'processing') {
            $order = $this->get($entity->id, [
                'contain' => ['Products', 'Products.Media'],
            ]);

            $this->getMailer('Order')->send('confirm', [$order]);
            $this->getMailer('Order')->send('sendToAdmin', [$order]);
        }
    }

    // Increase product quantity
    private function __inc_quantity($order)
    {
        if (!$order->has('products')) {
            return false;
        }

        $products = [];

        foreach ($order->products as $product) {
            if ($product->manage_stock === 'yes') {
                $quantity = $product->quantity + $product->_joinData->quantity;
                $product->set('quantity', $quantity);
                array_push($products, $product);
            }
        }

        $products_model = $this->_associations->get('Products');
        $products_model->saveMany($products);
        return;
    }

    // Decrease product quantity
    private function __dec_quantity($order)
    {
        if (!$order->has('products')) {
            return false;
        }
        $products = [];

        foreach ($order->products as $product) {
            if ($product->manage_stock === 'yes' && !empty($product->quantity)) {
                $quantity = $product->quantity - $product->_joinData->quantity;
                $product->set('quantity', $quantity);
                array_push($products, $product);
            }
        }

        $products_model = $this->_associations->get('Products');
        $products_model->saveMany($products);
        return;
    }

    // Update order status and notify customer
    public function updateStatus($order_id, $status, $is_private = 'yes', $notify_customer = 'no')
    {
        try {
            $order = $this->get($order_id, [
                'contain' => ['Products', 'Products.Media'],
            ]);
        } catch (\RuntimeException $e) {
            return false;
        }

        if ($order->status === $status) {
            return false;
        }

        $this->query()->update()->set(['status' => $status])->where(['id' => $order_id])->execute();

        $this->__addOrderHistory([
            'order_id' => $order_id,
            'status' => $status,
            'notify_customer' => $notify_customer,
            'is_private' => $is_private,
            'comment' => 'Order status updated from ' . $order->status . ' to ' . $status,
        ]);

        if ($status === 'failed' || $status === 'cancelled') {
            $this->__inc_quantity($order);
        }

        if ($notify_customer === 'yes') {
            $order->set('status', $status);
            $this->getMailer('Order')->send('statusUpdte', [$order]);
        }

        if ($status === "processing") {
            $this->getMailer('Order')->send('sendToAdmin', [$order]);
        }

        return true;
    }

    private function __addOrderHistory($order_history_details)
    {
        $order_history = $this->_associations->get('OrderHistory');
        $order_history_entity = $order_history->newEntity();
        $order_history_entity = $order_history->patchEntity($order_history_entity, $order_history_details);
        $order_history->save($order_history_entity);
    }

    public function getFilteredOrders($filters, $status)
    {
        $query = $this->find('all');

        if (!empty($filters['start-date']) && !empty($filters['end-date'])) {

            $query = $query->where(function ($q) use ($filters) {
                $startDate = \Cake\I18n\Time::parse($filters['start-date']);
                $startDate = $startDate->i18nFormat('yyyy-MM-dd HH:mm:ss');
                $endDate = \Cake\I18n\Time::parse($filters['end-date']);
                $endDate = $endDate->i18nFormat('yyyy-MM-dd 23:59:59');
                return $q->between('Orders.created', $startDate, $endDate);
            });
        }

        if ($status !== 'all') {
            $query = $query->where(['Orders.status' => $status]);
        }

        if (array_key_exists('customer_id', $filters)) {
            $query = $query->where(['Orders.user_id' => $filters['customer_id']]);
        }

        return $query->orderDesc('Orders.created');
    }

    public function sales($start_date, $end_date)
    {
        $status_arr = ['completed', 'processing', 'shipped'];

        $query = $this->find('all')->select([
            'sale_amount' => 'SUM(grand_total) DIV currency_value',
            'orders_placed' => 'COUNT(*)',
            'shipping_charges' => 'SUM(shipping_charges) DIV currency_value',
            'coupon_discounts' => 'SUM(coupon_discount) DIV currency_value',
            'other_discounts' => 'SUM(discount) DIV currency_value',
            'created'
        ])
            ->where(['status IN' => $status_arr])
            ->where(function ($q) use ($start_date, $end_date) {
                return $q->between('DATE(created)', $start_date, $end_date);
            })
            ->group('DATE(created)')
            ->orderAsc('created')->toArray();

        $labels = array_map(function ($label) {
            return date_format($label->created, 'd M Y');
        }, $query);

        $sale_amount = array_map(function ($item) {
            return $item->sale_amount;
        }, $query);

        $orders_placed = array_map(function ($item) {
            return $item->orders_placed;
        }, $query);

        $shipping_charges = array_map(function ($item) {
            return $item->shipping_charges;
        }, $query);

        $coupon_discounts = array_map(function ($item) {
            return $item->coupon_discounts;
        }, $query);

        $other_discounts = array_map(function ($item) {
            return $item->other_discounts;
        }, $query);

        return compact('labels', 'sale_amount', 'orders_placed', 'shipping_charges', 'coupon_discounts', 'other_discounts');
    }
	
	public function updateTrackingNumber($order_id, $tracking_no) {
        if($this->query()->update()->set(['tracking_no' => $tracking_no])->where(['id' => $order_id])->execute()){
			return true;
		} else {
			return false;
		}
    }
}
