<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categories Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\Category get($primaryKey, $options = [])
 * @method \App\Model\Entity\Category newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Category[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Category|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Category[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Category findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Tree', [
            'parent' => 'parent', // Use this instead of parent_id
            'left' => 'tree_left', // Use this instead of lft
            'right' => 'tree_right', // Use this instead of rght
            'level' => 'level'
        ]);
        $this->setTable('categories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Media', [
            'foreignKey' => 'media_id'
        ]);

        $this->belongsTo('SubcategoryMedia', [
            'foreignKey' => 'media_for_subcategory',
            'className' => 'Media',
            'propertyName' => 'subcategory_image',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('BannerMedia', [
            'foreignKey' => 'banner',
            'className' => 'Media',
            'propertyName' => 'banner_image',
            'joinType' => 'LEFT',
        ]);

        $this->belongsToMany('Products', [
            'foreignKey' => 'category_id',
            'targetForeignKey' => 'product_id',
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
                ->notEmpty('name');

        $validator
                ->scalar('slug')
                ->maxLength('slug', 225)
                ->requirePresence('slug', 'create')
                ->notEmpty('slug')
                ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->scalar('use_as')
                ->maxLength('use_as', 20)
                ->requirePresence('use_as', 'create')
                ->notEmpty('use_as');

        $validator
                ->scalar('layout')
                ->maxLength('layout', 20)
                ->allowEmpty('layout');

        $validator
            ->scalar('url')
            ->maxLength('url', 100)
            ->allowEmpty('url');

        $validator
                ->integer('parent')
                ->allowEmpty('parent');

        $validator
                ->scalar('description')
                ->allowEmpty('description');

        $validator
                ->scalar('meta_title')
                ->allowEmpty('meta_title');

        $validator
                ->scalar('meta_description')
                ->allowEmpty('meta_description');

        $validator
                ->scalar('meta_keywords')
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
        //$rules->add($rules->existsIn(['media_id'], 'Media'));

        return $rules;
    }

    public function findAllParentCategories(Query $query, $options = []) {
        return $query->where(['Categories.use_as' => 'category'])
                        ->andWhere(['Categories.parent IS' => NULL])
                        ->contain(['Media']);
    }

    public function findAllWearing(Query $query, $options = []) {
        return $query->where(['Categories.use_as' => 'wearing'])
                        ->andWhere(['Categories.parent IS' => NULL])
                        ->contain(['Media']);
    }

    public function unlinkedCategories() {
        $subQuery = $this->find()->select('Categories.id')
                        ->matching('Products', function($q) {
                            return $q->where(['Products.id IS NOT NULL']);
                        })->distinct('Categories.id');

        $categories = $this->find('all')->where(['Categories.id NOT IN' => $subQuery])->distinct();

        return $categories;
    }

    public function getCategoryIds($categories) {
        $categories = explode('|', $categories);

        $categories = array_map(function($category) {
            $category = trim($category);

            if (stripos($category, '>')) {
                return $this->getCategoryByPath($category);
            }

            $s_category = $this->find('all')->where(['parent IS' => NULL, 'OR' => ['slug' => $category, 'name' => $category]])->first();

            if ($s_category) {
                return $s_category->id;
            }

            return null;
        }, $categories);

        $categories = array_filter($categories, function($val){
            if(!empty($val)){
                return $val;
            }
        });

        return $categories;
    }

    public function getCategoryByPath($category) {
        $category = explode('>', $category);

        $category = array_map(function($cat) {
            return trim($cat);
        }, $category);

        $category_id = null;

        for ($i = 0; $i < count($category); $i++) {
            if ($i === 0) {
                $parent_category = $this->find('all')->where(['parent IS' => NULL, 'OR' => ['slug' => $category[$i], 'name' => $category[$i]]])->first();

                if ($parent_category) {
                    $category_id = $parent_category->id;
                }
            } else {
                $child_category = $this->find('all')->where(['parent' => $category_id, 'OR' => ['slug' => $category[$i], 'name' => $category[$i]]])->first();

                if ($child_category) {
                    $category_id = $child_category->id;
                }
            }
        }

        return $category_id;
    }

}
