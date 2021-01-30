<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Mailer\MailerAwareTrait;

/**
 * Enquiries Model
 *
 * @method \App\Model\Entity\Enquiry get($primaryKey, $options = [])
 * @method \App\Model\Entity\Enquiry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Enquiry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Enquiry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enquiry|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enquiry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Enquiry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Enquiry findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnquiriesTable extends Table {

    use MailerAwareTrait;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('enquiries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', array(
            'reference' => [
                'fields' => ['dir' => 'image_dir'], 'keepFilesOnDelete' => false,
                'nameCallback' => function( $table, $entity, $data, $field, $settings ) {
                    return strtolower(uniqid() . '-' . $data['name']);
                }
            ],
        ));
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
                ->email('email')
                ->maxLength('phone', 225)
                ->notEmpty('email');

        $validator
                ->scalar('phone')
                ->maxLength('phone', 15)
                ->requirePresence('phone', 'create')
                ->notEmpty('phone');

        $validator
                ->scalar('req_type')
                ->maxLength('req_type', 50)
                ->notEmpty('req_type');

        $validator
                ->scalar('message')
                ->maxLength('message', 500)
                ->allowEmpty('message');

        $validator
                ->scalar('date')
                ->maxLength('date', 225)
                ->allowEmpty('date');

        $validator
                ->scalar('tool')
                ->maxLength('tool', 225)
                ->allowEmpty('tool');

        $validator
                ->allowEmpty('reference');

        $validator->setProvider('upload', \Josegonzalez\Upload\Validation\DefaultValidation::class);

        $validator->add('reference', 'fileBelowMaxSize', array(
            'rule' => ['isBelowMaxSize', 1000000],
            'message' => 'This image is too large (Maxsize 1MB)',
            'provider' => 'upload'
        ));

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

    public function afterSave($event, $entity, $options) {
        if ($entity->isNew()) {
            $this->getMailer('Enquiry')->send('contact', [$entity]); // Sending email
        }
    }

}
