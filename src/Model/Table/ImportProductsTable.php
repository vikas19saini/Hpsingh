<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use \Box\Spout\Reader\ReaderFactory;
use \Box\Spout\Common\Type;

/**
 * ImportProducts Model
 *
 * @method \App\Model\Entity\ImportProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\ImportProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ImportProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ImportProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImportProduct|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImportProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ImportProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ImportProduct findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImportProductsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('import_products');
        $this->setDisplayField('name');
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
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('name')
                ->maxLength('name', 1000)
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->scalar('size')
                ->maxLength('size', 225)
                ->requirePresence('size', 'create')
                ->notEmpty('size');

        $validator
                ->scalar('type')
                ->maxLength('type', 225)
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        $validator
                ->scalar('import')
                ->maxLength('import', 225)
                ->requirePresence('import', 'create')
                ->notEmpty('import');

        $validator
                ->scalar('summary')
                ->allowEmpty('summary');

        return $validator;
    }

    public function afterDelete($event, $entity, $options) {
        $fileName = WWW_ROOT . 'imports' . DS . $entity->name;
        if (file_exists($fileName)) {
            unlink($fileName);
        }
    }

    public function deleteAllFiles($deletedImports) {
        foreach ($deletedImports as $import) {
            $fileName = WWW_ROOT . 'imports' . DS . $import->name;
            if (file_exists($fileName)) {
                unlink($fileName);
            }
        }
        return true;
    }

    public function getRowCounts($import_id) {

        try {
            $import = $this->get($import_id);

            $file_ext = explode('.', $import->name);
            $file_ext = end($file_ext);

            if (strtolower($file_ext) === 'csv') {
                $reader = ReaderFactory::create(Type::CSV);
            }

            $reader->open(WWW_ROOT . 'imports/' . $import->name);

            foreach ($reader->getSheetIterator() as $sheet) {
                $count = 0;

                foreach ($sheet->getRowIterator() as $row) {
                    $count++;
                }
            }

            return $count - 1;
        } catch (\RuntimeException $e) {
            return false;
        }
    }

}
