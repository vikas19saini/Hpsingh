<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\AddressesTable|\Cake\ORM\Association\HasMany $Addresses
 * @property |\Cake\ORM\Association\HasMany $Orders
 * @property |\Cake\ORM\Association\HasMany $OrdersCoupons
 * @property \App\Model\Table\ReviewsTable|\Cake\ORM\Association\HasMany $Reviews
 * @property \App\Model\Table\WishlistTable|\Cake\ORM\Association\HasMany $Wishlist
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Addresses', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('OrdersCoupons', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Reviews', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Wishlist', [
            'foreignKey' => 'user_id'
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Email address is already registered']);

        $validator
            ->scalar('name')
            ->maxLength('name', 225)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 15)
            ->add('phone', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Phone number is already registered']);

        $validator
            ->scalar('user_group')
            ->maxLength('user_group', 100)
            ->requirePresence('user_group', 'create')
            ->notEmpty('user_group');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('activation_key')
            ->requirePresence('activation_key', 'create')
            ->notEmpty('activation_key');

        $validator
            ->scalar('reset')
            ->maxLength('reset', 2000)
            ->allowEmpty('reset');

        $validator
            ->scalar('last_login')
            ->maxLength('last_login', 225)
            ->allowEmpty('last_login');

        $validator
            ->scalar('login_device')
            ->maxLength('login_device', 1000)
            ->allowEmpty('login_device');

        $validator
            ->scalar('cod_enable')
            ->allowEmpty('cod_enable');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['phone']));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
