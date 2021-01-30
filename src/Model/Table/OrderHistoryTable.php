<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderHistory Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\OrderHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderHistory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderHistoryTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('order_history');
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
                ->scalar('status')
                ->maxLength('status', 50)
                ->requirePresence('status', 'create')
                ->notEmpty('status');

        $validator
                ->scalar('notify_customer')
                ->maxLength('notify_customer', 3)
                ->requirePresence('notify_customer', 'create')
                ->notEmpty('notify_customer');

        $validator
                ->scalar('is_private')
                ->maxLength('is_private', 3)
                ->requirePresence('is_private', 'create')
                ->notEmpty('is_private');

        $validator
                ->scalar('comment')
                ->maxLength('comment', 225)
                ->allowEmpty('comment');

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

}
