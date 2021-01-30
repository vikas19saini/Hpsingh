<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Thumber\Utility\ThumbCreator;

/**
 * Media Model
 *
 * @method \App\Model\Entity\Media get($primaryKey, $options = [])
 * @method \App\Model\Entity\Media newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Media[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Media|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Media|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Media[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Media findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediaTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('media');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Product', [
            'foreignKey' => 'media_id',
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
                ->allowEmpty('name');

        $validator
                ->scalar('type')
                ->maxLength('type', 225)
                ->requirePresence('type', 'create')
                ->notEmpty('type');

        $validator
                ->scalar('url')
                ->maxLength('url', 225)
                ->requirePresence('url', 'create')
                ->notEmpty('url');

        $validator
                ->scalar('title')
                ->maxLength('title', 225)
                ->allowEmpty('title');

        $validator
                ->scalar('caption')
                ->maxLength('caption', 225)
                ->allowEmpty('caption');

        $validator
                ->scalar('alt')
                ->maxLength('alt', 225)
                ->allowEmpty('alt');

        return $validator;
    }

    public function uploadAndSave() {
        $entity = $this->newEntity();

        if ($_FILES['media']['tmp_name'] !== '') {
            $response = $this->uploadMedia();

            if ($response['status'] === 'error') {
                return $response;
            }

            $entity->set('name', $_FILES['media']['name']);
            $entity->set('type', $_FILES['media']['type']);
            $entity->set('url', $response['file_name']);

            if ($this->save($entity)) {
                return ['status' => 'success', 'entity' => $entity];
            }

            return ['status' => 'error', 'message' => "Couldn't saved, please try again"];
        }
    }

    private function uploadMedia() {
        $allowedMediaFormats = array('png', 'jpg', 'jpeg', 'mp4', 'svg');
        $allowedMediaSize = 50000000; // 50 MB


        if (!is_dir(UPLOADS)) {
            mkdir(UPLOADS);
        }

        $fileName = $this->validateAndGenerateFileName($_FILES['media']['name']);
        $file_ext = explode('.', $fileName);
        $file_ext = end($file_ext);

        if (!in_array(strtolower($file_ext), $allowedMediaFormats)) {
            return ['status' => 'error', 'message' => '<b>' . $_FILES['media']['name'] . '</b> this file format is not allowed, Allowed file formats are ' . implode(', ', $allowedMediaFormats)];
        }

        $mediaType = strtolower($_FILES['media']['type']);
        if ($_FILES['media']['size'] > $allowedMediaSize) {
            return ['status' => 'error', 'message' => 'File size is too large, you can upload upto 50MB'];
        }
        if (move_uploaded_file($_FILES['media']['tmp_name'], UPLOADS . $fileName)) {
            if (strpos($mediaType, 'image') !== false && strpos($mediaType, 'svg') === false) {
                $thumb = new ThumbCreator(UPLOADS . $fileName);
                $thumb->resize(350, 350, ['aspectRatio' => TRUE]);
                $thumb->save(['quality' => 100, 'target' => 'Th_' . $fileName]);
            }
            return ['status' => 'success', 'file_name' => 'media/' . $fileName];
        } else {
            return ['status' => 'error', 'message' => 'Unable to upload file. Please, try again!'];
        }
    }

    public function moveMediaAndSave($file_name) {
        if (empty($file_name)) {
            return ['status' => 'error', 'message' => 'Invalid media name.'];
        }

        $allowedMediaFormats = array('png', 'jpg', 'jpeg');
        $allowedMediaSize = 50000000; // 50 MB

        $extension = explode('.', $file_name);
        $extension = end($extension);

        if (!is_dir(UPLOADS)) {
            mkdir(UPLOADS);
        }

        if (!in_array(strtolower($extension), $allowedMediaFormats)) {
            return ['status' => 'error', 'message' => 'Invalid extension.'];
        }

        $source_path = WWW_ROOT . 'imports' . DS . 'images' . DS . $file_name;

        if (!file_exists($source_path)) {
            return ['status' => 'error', 'message' => 'The image does not exist in the source address'];
        }

        $file_info = new \Cake\Filesystem\File($source_path);

        if ($file_info->size() > $allowedMediaSize) {
            return ['status' => 'error', 'message' => 'Image is too large.'];
        }

        $destination_image_name = $this->validateAndGenerateFileName($file_name);
        $destination_path = UPLOADS . $destination_image_name;

        if ($file_info->copy($destination_path)) {
            $thumbnail = new ThumbCreator($destination_path);
            $thumbnail->resize(350, 350, ['aspectRatio' => true]);
            $thumbnail->save(['quality' => 100, 'target' => 'Th_' . $destination_image_name]);
        } else {
            return ['status' => 'error', 'message' => "Image could't be copy to destination directory."];
        }

        $image_entity = $this->newEntity();
        $image_entity = $this->patchEntity($image_entity, [
            'name' => $destination_image_name,
            'type' => $file_info->mime(),
            'url' => 'media/' . $destination_image_name,
        ]);

        if ($this->save($image_entity)) {
            return ['status' => 'success', 'data' => $image_entity];
        } else {
            return ['status' => 'error', 'message' => "Image details couldn't be saved"];
        }
    }

    private function validateAndGenerateFileName($fileName) {
        if (file_exists(UPLOADS . $fileName)) {
            $fileName = explode('.', $fileName);
            $ext = end($fileName);
            $fileName = $fileName[0] . '1';
            $fileName = $fileName . '.' . $ext;
            return $this->validateAndGenerateFileName($fileName);
        } else {
            return $fileName;
        }
    }

}
