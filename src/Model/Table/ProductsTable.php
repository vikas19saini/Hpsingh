<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\MediaTable|\Cake\ORM\Association\BelongsTo $Media
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'tag_id',
        ]);
        $this->belongsToMany('Media', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'media_id',
        ]);
        $this->belongsToMany('Orders', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'order_id',
            'joinTable' => 'orders_products',
        ]);
        $this->hasMany('Reviews')
            ->setConditions(['status' => 'approved']);
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
            ->maxLength('name', 225)
            ->allowEmpty('name');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 225)
            ->requirePresence('slug', 'create')
            ->notEmpty('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('short_description')
            ->allowEmpty('short_description');

        $validator
            ->scalar('long_description')
            ->allowEmpty('long_description');

        $validator
            ->scalar('fabric_name')
            ->maxLength('fabric_name', 225)
            ->allowEmpty('fabric_name');

        $validator
            ->scalar('weave')
            ->maxLength('weave', 225)
            ->allowEmpty('weave');

        $validator
            ->scalar('weight')
            ->maxLength('weight', 225)
            ->allowEmpty('weight');

        $validator
            ->scalar('width')
            ->maxLength('width', 225)
            ->allowEmpty('width');

        $validator
            ->scalar('content')
            ->maxLength('content', 225)
            ->allowEmpty('content');

        $validator
            ->scalar('design_no')
            ->maxLength('design_no', 225)
            ->allowEmpty('design_no');

        $validator
            ->scalar('count')
            ->maxLength('count', 225)
            ->allowEmpty('count');

        $validator
            ->scalar('weight_feel_suitability')
            ->maxLength('weight_feel_suitability', 225)
            ->allowEmpty('weight_feel_suitability');

        $validator
            ->scalar('design_name_color')
            ->maxLength('design_name_color', 225)
            ->allowEmpty('design_name_color');

        $validator
            ->scalar('length')
            ->maxLength('length', 225)
            ->allowEmpty('length');

        $validator
            ->scalar('price_text')
            ->maxLength('price_text', 225)
            ->allowEmpty('price_text');

        $validator
            ->numeric('ragular_price')
            ->requirePresence('ragular_price', 'create')
            ->notEmpty('ragular_price');

        $validator
            ->numeric('sale_price')
            ->allowEmpty('sale_price');

        $validator
            ->scalar('stock')
            ->maxLength('stock', 225)
            ->requirePresence('stock', 'create')
            ->notEmpty('stock');

        $validator
            ->scalar('manage_stock')
            ->maxLength('manage_stock', 10)
            ->allowEmpty('manage_stock');

        $validator
            ->numeric('quantity')
            ->allowEmpty('quantity');

        $validator
            ->numeric('min_order_qty')
            ->allowEmpty('min_order_qty');

        $validator
            ->numeric('max_order_qty')
            ->allowEmpty('max_order_qty');

        $validator
            ->numeric('step')
            ->allowEmpty('step');

        $validator
            ->numeric('shipping_weight')
            ->allowEmpty('shipping_weight');

        $validator
            ->numeric('shipping_length')
            ->allowEmpty('shipping_length');

        $validator
            ->numeric('shipping_width')
            ->allowEmpty('shipping_width');

        $validator
            ->numeric('shipping_height')
            ->allowEmpty('shipping_height');

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

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmpty('status');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['slug']));
        return $rules;
    }

    public function findNewArrived(Query $query, $options = [])
    {

        return $query->orderDesc('Products.id')
            ->contain(['Media']);
    }

    public function findRecommended(Query $query, $options = [])
    {

        if (!empty($options['hierarchy'])) {
            return $query->matching('Categories', function ($q) use ($options) {
                return $q->where(['Categories.id IN' => $options['hierarchy']]);
            })->contain(['Media'])->distinct('Products.id');
        } else {
            return $query->contain(['Media'])->distinct('Products.id');
        }
    }

    public function findBySlug(Query $query, $options = [])
    {
        return $query->where(['Products.slug' => $options['slug']])
            ->contain(['Media', 'Categories'])
            ->first();
    }

    public function findOnSale(Query $query, $options = [])
    {
        return $query->contain(['Media'])->where(['Products.sale_price IS NOT NULL']);
    }

    public function findInArchive(Query $query, $options = [])
    {

        if (!empty($options['filters'])) {
            $filters = [];

            if (!empty($options['filters']['price'])) {
                $price_filter = explode(',', $options['filters']['price']);

                $filters['startPrice'] = (float)$price_filter[0];
                $filters['endPrice'] = (float)!empty($price_filter[1]) ? $price_filter[1] : 0;
            }

            if (!empty($options['filters']['color'])) {
                $filters['colorFilters'] = explode(',', $options['filters']['color']);
            }
        }

        $query = $query->contain(['Media']);

        // for categories
        if ($options['archiveType'] === 'category') {
            $query = $query->innerJoinWith('Categories', function ($q) use ($options) {
                return $q->where(['Categories.id IN' => $options['categories']]);
            });
        }

        // for tags
        if ($options['archiveType'] === 'tag') {
            $query = $query->innerJoinWith('Tags', function ($q) use ($options) {
                return $q->where(['Tags.slug' => $options['tag']]);
            });
        }

        // for search term
        if ($options['archiveType'] === 'search') {

            $query = $query
                ->leftJoinWith('Tags')
                ->where([
                    'OR' => [
                        "MATCH(Products.name, Products.design_name_color ,Products.slug, Products.short_description, Products.long_description, Products.fabric_name, Products.weave, Products.content) AGAINST (:query IN NATURAL LANGUAGE MODE)",
                        "MATCH(Tags.name, Tags.slug, Tags.description) AGAINST (:query IN NATURAL LANGUAGE MODE)",
                    ]
                ])->bind(':query', '"' . $options['search_term'] . '"', 'string');
        }

        if ($options['archiveType'] === 'sale') {
            $query = $query->where(['Products.sale_price IS NOT NULL'])->orderAsc('Products.stock');
        }

        if ($options['archiveType'] === "imageSearch") {
            $query = $query->where(['Products.design_name_color in' => $options['colors']])->orderAsc('Products.stock');
        }

        // Applying price filter
        if (!empty($filters['endPrice']) && !empty($filters['startPrice'])) {
            $query = $query->andWhere(['Products.ragular_price >=' => $filters['startPrice']])
                ->andWhere(['Products.ragular_price <=' => $filters['endPrice']]);
        } else {
            if (!empty($filters['startPrice'])) {
                $query = $query->andWhere(['Products.ragular_price >=' => $filters['startPrice']]);
            }
        }

        // Applying color filters
        if (!empty($filters['colorFilters'])) {
            $query = $query->where(["MATCH(Products.name, Products.design_name_color ,Products.slug, Products.short_description, Products.long_description, Products.fabric_name, Products.weave, Products.content) AGAINST (:color IN NATURAL LANGUAGE MODE)"])
                ->bind(':color', implode(' ', $filters['colorFilters']), 'string');
        }

        // Applying discount filters
        if (!empty($options['filters']['discount'])) {
            $query = $query->andWhere(['(SELECT ROUND(((ragular_price - sale_price) / ragular_price) * 100)) >=' => (int)$options['filters']['discount']])
                ->andWhere(['sale_price !=' => 0]);
        }

        // Applying stock filter
        if (!empty($options['filters']['stock'])) {
            if ($options['filters']['stock'] === 'in_stock') {
                $query = $query->andWhere([
                    'OR' => [
                        ['Products.quantity >' => 0],
                        ['Products.manage_stock' => 'no'],
                    ],
                    'Products.stock =' => 'in_stock',
                ]);
            }
        }

        return $query = $query->distinct('Products.slug');
    }

    public function findByIds(Query $query, $options = [])
    {

        return $query->orderDesc('Products.id')
            ->contain(['Media'])
            ->andWhere(['Products.id IN' => $options['ids']]);
    }

    // @return category ids products associated with.
    public function getProductsCategories($products_ids)
    {
        $products = $this->find('all', [
            'conditions' => ['Products.id IN' => $products_ids],
            'contain' => ['Categories' => function ($q) {
                return $q->select(['Categories.id']);
            }],
            'fields' => ['Products.id']
        ])->toArray();

        $product_categories = array_map(function ($product) {
            return array_map(function ($category) {
                return $category->id;
            }, $product->categories);
        }, $products);

        $product_categories = array_unique(array_merge(...$product_categories));
        return $product_categories;
    }

    public function searchProducts($query)
    {
        $products = $this->find('all', [
            'conditions' => [
                "MATCH(Products.name, Products.design_name_color ,Products.slug, Products.short_description, Products.long_description, Products.fabric_name, Products.weave, Products.content) AGAINST (:query IN NATURAL LANGUAGE MODE)",
            ],
            'find' => 'fair',
            'fields' => ['slug', 'name']
        ])->bind(':query', '"' . $query . '"', 'string');

        $tags = $this->_associations->get('Tags')->find()
            ->select(['Tags.slug', 'Tags.name'])
            ->select(function (\Cake\ORM\Query $query) {
                return [
                    'totalProducts' => $query->func()->count('Products.id')
                ];
            })
            ->leftJoinWith('Products')
            ->where(["OR" => [
                "Tags.name LIKE :query",
                "Tags.description LIKE :query"
            ]])
            ->bind(':query', "%" . $query . "%", 'string')
            ->group("Tags.id");

        $categories = $this->_associations->get('Categories')->find()
            ->select(['slug', 'name'])
            ->select(function (\Cake\ORM\Query $query) {
                return [
                    'totalProducts' => $query->func()->count('Products.id')
                ];
            })
            ->leftJoinWith('Products')
            ->where(["OR" => [
                "Categories.name LIKE :query",
                "Categories.description LIKE :query"
            ]])
            ->bind(':query', "%" . $query . "%", 'string')
            ->group("Categories.id");

        if ($products->isEmpty() && $categories->isEmpty() && $tags->isEmpty()) {
            return false;
        }

        return ['tags' => $tags, 'categories' => $categories, 'products' => $products];
    }

    public function getDiscounts()
    {
        $discounts = $this->find('all', [
            'conditions' => ['sale_price !=' => 0],
            'fields' => ['discount' => '((ragular_price - sale_price) / ragular_price) * 100'],
            'find' => 'fair',
        ])->distinct('discount');

        return $discounts;
    }

    public function beforeFind($event, $query, $options)
    {
        if (empty($options['find'])) {
            return $query;
        }

        if ($options['find'] === 'fair') {
            return $query->where([
                'Products.status' => 'published',
                'Products.deleted IS' => null,
                'Products.ragular_price !=' => 0,
            ])->orderDesc('Products.id');
        }

        return $query;
    }

    public function porductsWithoutImages()
    {
        ini_set('max_execution_time', 0);
        $subQuery = $this->find()->select('Products.id')
            ->matching('Media', function ($q) {
                return $q->where(['Media.id IS NOT NULL']);
            })->distinct('Products.id');

        $products = $this->find('all')->where(['Products.id NOT IN' => $subQuery, 'deleted IS' => null])
            ->distinct();

        return $products;
    }

    public function getProductsAdmin($options)
    {
        $query = $this->find('all')->contain(['Media', 'Categories', 'Tags'])
            ->leftJoinWith('Categories')
            ->leftJoinWith('Tags');

        if (array_key_exists('stock', $options)) {
            if (!empty($options['stock'])) {
                $query = $query->where(['Products.stock' => $options['stock']]);
            }
        }

        if (array_key_exists('status', $options)) {
            if (!empty($options['status'])) {
                if ($options['status'] === 'trash') {
                    $query = $query->where(['Products.deleted IS NOT' => NULL]);
                } else {
                    $query = $query->where(['Products.deleted IS' => NULL])->where(['Products.status' => $options['status']]);
                }
            }
        } else {
            $query = $query->where(['Products.deleted IS' => NULL]);
        }

        if (array_key_exists('search', $options)) {
            if (!empty($options['search'])) {
                $query = $query->where([
                    'OR' => [
                        "MATCH(Products.name, Products.design_name_color ,Products.slug, Products.short_description, Products.long_description, Products.fabric_name, Products.weave, Products.content) AGAINST (:query IN NATURAL LANGUAGE MODE)",
                        "MATCH(Categories.name, Categories.slug, Categories.description) AGAINST (:query IN NATURAL LANGUAGE MODE)",
                        "MATCH(Tags.name, Tags.slug, Tags.description) AGAINST (:query IN NATURAL LANGUAGE MODE)",
                    ]
                ])->bind(':query', '"' . $options['search'] . '"', 'string');
            }
        }

        if (array_key_exists('cat_id', $options)) {
            if (!empty($options['cat_id'])) {
                $query = $query->matching('Categories', function ($q) use ($options) {
                    return $q->where(['Categories.id' => $options['cat_id']]);
                });
            }
        }

        if (array_key_exists('sort', $options) && array_key_exists('direction', $options)) {
            if (!empty($options['sort']) && $options['direction']) {
                $sort[$options['sort']] = $options['direction'];
                $query = $query->order($sort);
            }
        } else {
            $query = $query->orderDesc('Products.created');
        }

        return $query->distinct('Products.id');
    }

    public function getOutOfStock()
    {
        $query = $this->find('all')
            ->contain(['Media'])
            ->where(function ($exp) {
                $queryExp = $exp->or_(['Products.quantity' => ''])
                    ->eq('Products.quantity', 0)
                    ->isNull('Products.quantity');
                $queryExp = $exp->add($queryExp)
                    ->eq('Products.manage_stock', 'yes');
                return $exp->or_(['Products.stock' => 'out_of_stock'])
                    ->add($queryExp);
            });

        return $query;
    }

    public function getTopSelling($start_date = null, $end_date = null, $excludeOutOfStock = "no")
    {
        $query = $this->find()->select($this)->select([
            'total_price' => 'SUM(OrdersProducts.price) DIV Orders.currency_value',
            'total_sale_price' => 'SUM(OrdersProducts.sale_price) DIV Orders.currency_value',
            'total_selling_quantity' => 'SUM(OrdersProducts.quantity)',
            'Products.name'
        ])
            /*  ->where([
            'Products.status' => 'published',
            'Products.deleted IS' => null,
            'Products.ragular_price !=' => 0,
        ]) */
            ->contain(['Media'])
            ->where(function ($exp) use ($start_date, $end_date) {
                return $exp->between('DATE(Orders.created)', $start_date, $end_date);
            })
            ->innerJoinWith('Orders')
            ->orderDesc('total_selling_quantity')
            ->distinct('Products.id')->limit(20);

        if ($excludeOutOfStock === "yes") {
            $query = $query->where(['Products.manage_stock' => 'no', 'stock' => 'in_stock', 'deleted IS' => null]);
        }
        return $query;
    }
}
