<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stories Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\Story get($primaryKey, $options = [])
 * @method \App\Model\Entity\Story newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Story[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Story|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Story|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Story patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Story[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Story findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoriesTable extends Table
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

        $this->setTable('stories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Media', [
            'foreignKey' => 'media_id'
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
            ->scalar('title')
            ->maxLength('title', 500)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('content')
            ->maxLength('content', 4294967295)
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 1000)
            ->allowEmpty('slug');

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
        $rules->add($rules->existsIn(['media_id'], 'Media'));

        return $rules;
    }
}
