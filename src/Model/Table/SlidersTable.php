<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sliders Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 * @property \App\Model\Table\MobileMediaTable|\Cake\ORM\Association\BelongsTo $MobileMedia
 *
 * @method \App\Model\Entity\Slider get($primaryKey, $options = [])
 * @method \App\Model\Entity\Slider newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Slider[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Slider|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Slider|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Slider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Slider[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Slider findOrCreate($search, callable $callback = null, $options = [])
 */
class SlidersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('sliders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Media', [
            'foreignKey' => 'media_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('MobileMedia', [
            'foreignKey' => 'mobile_media_id',
            'joinType' => 'LEFT',
            'className' => 'Media',
            'propertyName' => 'mobile_media'
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
                ->scalar('content')
                ->maxLength('content', 1000)
                ->allowEmpty('content');

        $validator
                ->scalar('type')
                ->maxLength('type', 50)
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        $validator
                ->integer('sort')
                ->allowEmpty('sort');

        $validator
                ->scalar('uri')
                ->maxLength('uri', 1000)
                ->allowEmpty('uri');

        $validator
                ->scalar('status')
                ->maxLength('status', 20)
                ->requirePresence('status', 'create')
                ->notEmpty('status');

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
        return $rules;
    }

    public function findHomePageSliders(Query $query, $options = []) {
        return $query->where(['Sliders.type' => 'homepage-main-slider'])
                        ->andWhere(['Sliders.status' => 'active'])
                        ->contain(['Media', 'MobileMedia'])
                        ->orderAsc('Sliders.sort');
    }

    public function findMygram(Query $query, $options) {
        return $query->where(['Sliders.type' => 'mygrams'])
                        ->andWhere(['Sliders.status' => 'active'])
                        ->contain(['Media'])
                        ->orderAsc('Sliders.sort');
    }
    public function findWholesale(Query $query, $options) {
        return $query->where(['Sliders.type' => 'bulk-wholesale'])
                        ->andWhere(['Sliders.status' => 'active'])
                        ->contain(['Media', 'MobileMedia'])
                        ->first();
    }
    public function findDeals(Query $query, $options) {
        return $query->where(['Sliders.type' => 'deals'])
                        ->andWhere(['Sliders.status' => 'active'])
                        ->contain(['Media'])
                        ->first();
    }

}
