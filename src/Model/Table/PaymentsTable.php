<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payments Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\Payment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Payment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Payment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Payment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaymentsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
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
                ->numeric('amount')
                ->requirePresence('amount', 'create')
                ->notEmpty('amount');

        $validator
                ->scalar('currency_code')
                ->maxLength('currency_code', 3)
                ->requirePresence('currency_code', 'create')
                ->notEmpty('currency_code');

        $validator
                ->scalar('transaction_no')
                ->maxLength('transaction_no', 500)
                ->requirePresence('transaction_no', 'create')
                ->notEmpty('transaction_no');

        $validator
                ->scalar('payment_method')
                ->maxLength('payment_method', 20)
                ->requirePresence('payment_method', 'create')
                ->notEmpty('payment_method');

        $validator
                ->scalar('status')
                ->maxLength('status', 50)
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        $validator
                ->scalar('links')
                ->allowEmpty('links');

        $validator
                ->scalar('details')
                ->allowEmpty('details');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));

        return $rules;
    }

    public function afterSave($event, $entity, $options) {
        if ($entity->isNew()) {
            $orders = $this->_associations->get('Orders');
            switch ($entity->payment_method) {
                case 'paypal':
                    if (strcasecmp($entity->status, 'COMPLETED') !== 0) {
                        $orders->updateStatus($entity->order_id, 'failed'); // Update order status to failed
                    } else {
                        $orders->updateStatus($entity->order_id, 'processing', 'no', 'yes'); // Update order status to processing
                    }
                    break;
                case 'payu':
                    break;
            }
        }
    }

}
