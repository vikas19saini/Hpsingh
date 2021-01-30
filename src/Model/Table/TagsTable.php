<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tags Model
 *
 * @method \App\Model\Entity\Tag get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tag|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tag findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TagsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('tags');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Products', [
            'targetForeignKey' => 'product_id',
            'foreignKey' => 'tag_id',
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
                ->scalar('name')
                ->maxLength('name', 225)
                ->requirePresence('name', 'create')
                ->notEmpty('name')
                ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Tag name could not be duplicate.']);

        $validator
                ->scalar('slug')
                ->maxLength('slug', 225)
                ->requirePresence('slug', 'create')
                ->notEmpty('slug')
                ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->scalar('description')
                ->allowEmpty('description');

        $validator
                ->scalar('meta_title')
                ->maxLength('meta_title', 225)
                ->allowEmpty('meta_title');

        $validator
                ->scalar('meta_description')
                ->maxLength('meta_description', 225)
                ->allowEmpty('meta_description');

        $validator
                ->scalar('meta_keywords')
                ->maxLength('meta_keywords', 225)
                ->allowEmpty('meta_keywords');

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
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }

    public function unlinkedTags() {
        $subQuery = $this->find()->select('Tags.id')
                        ->matching('Products', function($q) {
                            return $q->where(['Products.id IS NOT NULL']);
                        })->distinct('Tags.id');

        $tags = $this->find('all')->where(['Tags.id NOT IN' => $subQuery])->distinct();

        return $tags;
    }

    public function getTagsWithProductCount($searchTerm)
    {
        $tags = $this->find()
        ->select($this)
        ->select(function (\Cake\ORM\Query $query) {
            return [
                'totalProducts' => $query->func()->count('Products.id')
            ];
        })
        ->leftJoinWith('Products')
        ->group("Tags.id");

        if(!empty($searchTerm)){
            $tags = $tags->where(["OR" => [
                "Tags.name LIKE :query",
                "Tags.description LIKE :query",
                "Tags.slug LIKE :query"
            ]])
            ->bind(':query', "%" . $searchTerm . "%", 'string');
        }

        return $tags;
    }
}
