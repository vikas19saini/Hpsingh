<?php

namespace AbandonedCart\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sessions Model
 *
 * @method \AbandonedCart\Model\Entity\Session get($primaryKey, $options = [])
 * @method \AbandonedCart\Model\Entity\Session newEntity($data = null, array $options = [])
 * @method \AbandonedCart\Model\Entity\Session[] newEntities(array $data, array $options = [])
 * @method \AbandonedCart\Model\Entity\Session|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AbandonedCart\Model\Entity\Session|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AbandonedCart\Model\Entity\Session patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AbandonedCart\Model\Entity\Session[] patchEntities($entities, array $data, array $options = [])
 * @method \AbandonedCart\Model\Entity\Session findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SessionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('sessions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->scalar('id')
                ->maxLength('id', 40)
                ->allowEmpty('id', 'create');

        $validator
                ->allowEmpty('data');

        $validator
                ->integer('expires')
                ->allowEmpty('expires');

        return $validator;
    }

    public function findAbonded($query, $options) {
        $query = $this->find('all');
        if (!empty($options['start-date']) && !empty($options['end-date'])) {
            if ($options['start-date'] === $options['end-date']) {
                $query = $query->where(['created LIKE' => $options['start-date'] . '%']);
            } else {
                $query = $query->where(function($q) use ($options) {
                    $startDate = \Cake\I18n\Time::parse($options['start-date']);
                    $startDate = $startDate->i18nFormat('yyyy-MM-dd HH:mm:ss');
                    $endDate = \Cake\I18n\Time::parse($options['end-date']);
                    $endDate = $endDate->i18nFormat('yyyy-MM-dd 23:59:59');
                    return $q->between('created', $startDate, $endDate);
                });
            }
        }
        return $query->orderDesc('created');
    }

}
