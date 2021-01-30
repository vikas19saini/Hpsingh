<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FacebookFeed Model
 *
 * @method \App\Model\Entity\FacebookFeed get($primaryKey, $options = [])
 * @method \App\Model\Entity\FacebookFeed newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FacebookFeed[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FacebookFeed|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacebookFeed|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FacebookFeed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FacebookFeed[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FacebookFeed findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FacebookFeedTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('facebook_feed');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 500)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('upload_start')
            ->allowEmpty('upload_start');

        $validator
            ->dateTime('upload_end')
            ->allowEmpty('upload_end');

        return $validator;
    }
}
