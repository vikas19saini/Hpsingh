<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Redirection Model
 *
 * @method \App\Model\Entity\Redirection get($primaryKey, $options = [])
 * @method \App\Model\Entity\Redirection newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Redirection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Redirection|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Redirection|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Redirection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Redirection[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Redirection findOrCreate($search, callable $callback = null, $options = [])
 */
class RedirectionTable extends Table
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

        $this->setTable('redirection');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('old_url')
            ->maxLength('old_url', 225)
            ->requirePresence('old_url', 'create')
            ->notEmpty('old_url');

        $validator
            ->scalar('new_url')
            ->maxLength('new_url', 225)
            ->requirePresence('new_url', 'create')
            ->notEmpty('new_url');

        $validator
            ->scalar('type')
            ->maxLength('type', 3)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }
}
