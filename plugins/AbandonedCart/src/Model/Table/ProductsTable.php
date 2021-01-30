<?php
namespace AbandonedCart\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \AbandonedCart\Model\Table\ColorsToProductsTable|\Cake\ORM\Association\HasMany $ColorsToProducts
 * @property \AbandonedCart\Model\Table\ReviewsTable|\Cake\ORM\Association\HasMany $Reviews
 * @property \AbandonedCart\Model\Table\WishlistTable|\Cake\ORM\Association\HasMany $Wishlist
 * @property \AbandonedCart\Model\Table\CategoriesTable|\Cake\ORM\Association\BelongsToMany $Categories
 * @property \AbandonedCart\Model\Table\MediaTable|\Cake\ORM\Association\BelongsToMany $Media
 * @property \AbandonedCart\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsToMany $Orders
 * @property \AbandonedCart\Model\Table\TagsTable|\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \AbandonedCart\Model\Entity\Product get($primaryKey, $options = [])
 * @method \AbandonedCart\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \AbandonedCart\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \AbandonedCart\Model\Entity\Product|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AbandonedCart\Model\Entity\Product|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AbandonedCart\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AbandonedCart\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \AbandonedCart\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
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

        $this->hasMany('ColorsToProducts', [
            'foreignKey' => 'product_id',
            'className' => 'AbandonedCart.ColorsToProducts'
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'product_id',
            'className' => 'AbandonedCart.Reviews'
        ]);
        $this->hasMany('Wishlist', [
            'foreignKey' => 'product_id',
            'className' => 'AbandonedCart.Wishlist'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_products',
            'className' => 'AbandonedCart.Categories'
        ]);
        $this->belongsToMany('Media', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'media_id',
            'joinTable' => 'media_products',
            'className' => 'AbandonedCart.Media'
        ]);
        $this->belongsToMany('Orders', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'order_id',
            'joinTable' => 'orders_products',
            'className' => 'AbandonedCart.Orders'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'products_tags',
            'className' => 'AbandonedCart.Tags'
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
            ->numeric('ragular_price')
            ->requirePresence('ragular_price', 'create')
            ->notEmpty('ragular_price');

        $validator
            ->numeric('sale_price')
            ->allowEmpty('sale_price');

        $validator
            ->scalar('after_price')
            ->maxLength('after_price', 50)
            ->allowEmpty('after_price');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }
}
