<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coupons Model
 *
 * @method \App\Model\Entity\Coupon get($primaryKey, $options = [])
 * @method \App\Model\Entity\Coupon newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Coupon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Coupon|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Coupon|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Coupon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Coupon[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Coupon findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CouponsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('coupons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
       
        
        $this->belongsToMany('Orders', [
            'foreignKey' => 'coupon_id',
            'targetForeignKey' => 'order_id',
            'joinTable' => 'orders_coupons'
        ]);
        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('type')
                ->maxLength('type', 225)
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        $validator
                ->scalar('code')
                ->maxLength('code', 225)
                ->requirePresence('code', 'create')
                ->notEmpty('code')
                ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Coupon code can not be duplicate.']);

        $validator
                ->scalar('description')
                ->maxLength('description', 225)
                ->allowEmpty('description');

        $validator
                ->numeric('value')
                ->requirePresence('value', 'create')
                ->notEmpty('value');

        $validator
                ->date('expiry_date')
                ->requirePresence('expiry_date', 'create')
                ->notEmpty('expiry_date');

        $validator
                ->numeric('minimum_spend')
                ->allowEmpty('minimum_spend');

        $validator
                ->numeric('maximum_spend')
                ->allowEmpty('maximum_spend');

        $validator
                ->boolean('individual_only')
                ->allowEmpty('individual_only');

        $validator
                ->boolean('exclude_sale_items')
                ->allowEmpty('exclude_sale_items');

        $validator
                ->scalar('products')
                ->allowEmpty('products');

        $validator
                ->scalar('exclude_products')
                ->allowEmpty('exclude_products');

        $validator
                ->scalar('categories')
                ->allowEmpty('categories');

        $validator
                ->scalar('exclude_categories')
                ->allowEmpty('exclude_categories');

        $validator
                ->scalar('users')
                ->allowEmpty('users');

        $validator
                ->integer('usage_limit')
                ->allowEmpty('usage_limit');

        $validator
                ->integer('limit_per_user')
                ->allowEmpty('limit_per_user');

        $validator
                ->scalar('status')
                ->maxLength('status', 20)
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        $validator
                ->dateTime('deleted')
                ->allowEmpty('deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['code']));

        return $rules;
    }

    public function getCustomerCoupons($customer_email_address) {
        if (empty($customer_email_address)) {
            return false;
        }

        return $this->find('all')->where(['deleted IS' => NULL, 'status' => 'published', 'users LIKE' => '%' . $customer_email_address . '%']);
    }

    public function getAllCoupons($query_args) {
        $query = $this->find('all')
                ->contain('Orders');

        if (array_key_exists('status', $query_args)) {
            if ($query_args['status'] === 'trash') {
                $query = $query->where(['Coupons.deleted IS NOT' => NULL]);
            } else {
                $query = $query->where(['Coupons.deleted IS' => NULL])
                        ->where(['Coupons.status' => $query_args['status']]);
            }
        } else {
            $query = $query->where(['Coupons.deleted IS' => NULL]);
        }


        if (array_key_exists('coupon_type', $query_args)) {
            $query = $query->where(['Coupons.type' => $query_args['coupon_type']]);
        }

        if (array_key_exists('search', $query_args)) {
            $query = $query->where(['Coupons.code LIKE' => '%' . $query_args['search'] . '%']);
        }

        if (array_key_exists('sort', $query_args) && array_key_exists('direction', $query_args)) {
            if (!empty($query_args['sort']) && $query_args['direction']) {
                $sort[$query_args['sort']] = $query_args['direction'];
                $query = $query->order($sort);
            }
        } else {
            $query = $query->orderDesc('Coupons.created');
        }

        //sqld($query);
        return $query;
    }

    // Get and validate coupon by code
    public function getAndValidateCoupon($coupon_code, $userDetails, $cart_details) {
        if (empty($coupon_code)) {
            return false;
        }

        if (is_object($coupon_code)) {
            $coupon = $coupon_code;
        } else {
            $coupon = $this->find('all', [
                        'conditions' => [
                            'code' => $coupon_code,
                            'deleted IS' => NULL,
                            'status' => 'published',
                            'expiry_date >=' => date('Y-m-d'),
                            'value >' => 0,
                        ],
                    ])->first();
        }

        if (!$coupon) {
            return ['status' => 'error', 'message' => 'Invalid coupon code.'];
        }

        // Return false, if coupon exceed the usage limit
        if (!empty($coupon->usage_limit)) {
            $coupon_orders = \Cake\ORM\TableRegistry::getTableLocator()->get('OrdersCoupons');
            $coupon_used_count = $coupon_orders->find('all', [
                        'conditions' => ['coupon_id' => $coupon->id]
                    ])->count();

            if ($coupon_used_count >= $coupon->usage_limit) {
                return ['status' => 'error', 'message' => 'Coupon code expired'];
            }
        }

        if (!empty($coupon->limit_per_user)) {
            $coupon_orders = \Cake\ORM\TableRegistry::getTableLocator()->get('OrdersCoupons');
            $coupon_used_count = $coupon_orders->find('all', [
                        'conditions' => ['coupon_id' => $coupon->id, 'user_id' => $userDetails->id]
                    ])->count();

            if ($coupon_used_count >= $coupon->limit_per_user) {
                return ['status' => 'error', 'message' => 'Usage limit exceeded.'];
            }
        }

        if (!empty($coupon->users)) {
            if (is_null($userDetails)) {
                return ['status' => 'error', 'message' => 'Not applicable'];
            }

            $coupon_to_users = explode(',', $coupon->users);
            if (!in_array(strtolower($userDetails->email), array_map('strtolower', $coupon_to_users))) {
                return ['status' => 'error', 'message' => 'Not applicable'];
            }
        }

        if (!empty($coupon->minimum_spend_currency)) {
            if ($cart_details['grantTotal'] < $coupon->minimum_spend_currency) {
                return ['status' => 'error', 'message' => 'Not applicable, Minimum purchase amount ' . number_format($coupon->minimum_spend_currency, 2)];
            }
        }

        if (!empty($coupon->maximum_spend_currency)) {
            if ($cart_details['grantTotal'] > $coupon->maximum_spend_currency) {
                return ['status' => 'error', 'message' => 'Not applicable, Maximum purchase amount ' . number_format($coupon->maximum_spend_currency, 2)];
            }
        }

        return ['status' => 'success', 'coupon' => $coupon];
    }

}
