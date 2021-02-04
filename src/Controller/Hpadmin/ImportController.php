<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;
use \Box\Spout\Reader\ReaderFactory;
use \Box\Spout\Common\Type;

class ImportController extends AppController
{

    private $summary = [];
    private $totalRecords = 0;
    private $success = 0;
    private $error = 0;
    private $updated = 0;

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Products');
        $this->loadComponent('Taxonomy');
        $this->loadModel('ImportProducts');
        ini_set('max_execution_time', 0); // Set execution time to infinite
    }

    public function add()
    {

        if ($this->request->is('post')) {
            $response = $this->uploadAndSaveFile($_FILES['importFile']);

            if ($response['status'] === 'error') {
                $this->Flash->error($response['message']);
                return $this->redirect(['action' => 'add']);
            }

            return $this->redirect(['action' => 'add', '?' => ['import-id' => $response['entity']->id]]);
        }

        $import_id = $this->request->getQuery('import-id');

        if (!empty($import_id)) {
            $totalRecords = $this->ImportProducts->getRowCounts($import_id);

            if (!$totalRecords) {
                $this->Flash->error('Oops something went wrong please try again.');
                return $this->redirect(['action' => 'add']);
            }

            $this->set(compact('totalRecords'));
        }
    }

    // Upload file and save in database
    private function uploadAndSaveFile($file_details)
    {

        $file_extension = explode('.', $file_details['name']);
        $file_extension = end($file_extension);

        if (strtolower($file_extension) !== 'csv') {
            return ['status' => 'error', 'message' => 'Invalid file format'];
        }

        $file_name = hash('sha256', date('r')) . '.' . $file_extension;

        if (!is_dir(WWW_ROOT . 'imports')) {
            mkdir(WWW_ROOT . 'imports', 0755);
        }

        if (file_exists($file_name)) {
            $file_name = hash(sha256, $file_name) . '.' . $file_extension;
        }

        $destination_path = WWW_ROOT . 'imports' . DS . $file_name;

        if (!move_uploaded_file($file_details['tmp_name'], $destination_path)) {
            return ['status' => 'error', 'message' => 'File couldn\'t be uploaded, please try again!'];
        }

        $entity = $this->ImportProducts->newEntity();
        $entity = $this->ImportProducts->patchEntity($entity, [
            'name' => $file_name,
            'size' => $file_details['size'],
            'type' => $file_details['type'],
            'summary' => '',
            'import' => $this->request->getData('import'),
        ]);

        $this->addSummary('=> File uploaded and entry saved in database...');

        if ($this->ImportProducts->save($entity)) {
            return ['status' => 'success', 'entity' => $entity];
        } else {
            return ['status' => 'error', 'message' => "Couldn't be saved, please try again!"];
        }
    }

    public function run($import_id, $total, $processed)
    {

        $save_items_per_iteration = 10; // No of items save per iterations
        $start = $processed + 1;
        $end = $processed + $save_items_per_iteration;

        if ($end > $total) {
            $end = $total;
        }

        try {
            $entity = $this->ImportProducts->get($import_id);

            $response = $this->import_products($entity, $start, $end);

            $response = [
                'total' => $this->totalRecords,
                'success' => $this->success,
                'error' => $this->error,
                'status' => 'success',
                'summary' => $this->summary,
                'updated' => $this->updated,
                'url' => \Cake\Routing\Router::url(['action' => 'view', $response['entity']->id], true),
            ];

            return $this->response->withType('json')->withStringBody(json_encode($response));
        } catch (\RuntimeException $e) {
            return $this->response->withType('json')->withStringBody(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
        }
    }

    private function import_products($entity, $start, $end)
    {
        error_reporting(0);

        $reader = $this->createReader($entity);
        $reader->open(WWW_ROOT . 'imports/' . $entity->name);

        $headers = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            $count = 0;

            foreach ($sheet->getRowIterator() as $row) {
                if ($count === 0) {
                    $headers = $row;
                }

                if ($count >= $start && $count <= $end) {
                    $productDetails = array_combine($headers, $row);
                    $this->totalRecords += 1;
                    $this->saveProduct($productDetails);
                }
                $count++;
            }
        }

        $reader->close();

        $summary = empty($entity->summary) ? [] : json_decode($entity->summary);
        $summary = array_merge($summary, $this->summary);

        $entity = $this->ImportProducts->patchEntity($entity, [
            'summary' => json_encode($summary),
        ]);
        $this->ImportProducts->save($entity);
        return;
    }

    private function createReader($entity)
    {
        $file_ext = explode('.', $entity->name);
        $file_ext = end($file_ext);

        if (strtolower($file_ext) === 'csv') {
            $reader = ReaderFactory::create(Type::CSV);
        }

        if (strtolower($file_ext) === 'xlsx') {
            $reader = ReaderFactory::create(Type::XLSX);
        }

        return $reader;
    }

    private function saveProduct($productDetails)
    {

        $created_or_updated = 'create';

        $products_check = $this->Products->find('all', [
            'conditions' => ['name' => $productDetails['name']],
        ])->first();

        if ($products_check) {
            $entity = $products_check;
            $created_or_updated = 'update';
        } else {
            $entity = $this->Products->newEntity();
        }

        if (!empty($productDetails['categories'])) {
            $productDetails['categories'] = ['_ids' => $this->mapCategories($productDetails['categories'])];
            $this->addSummary('Categories assosiations created.');
        }

        if (!empty($productDetails['tags'])) {
            $productDetails['tags'] = ['_ids' => $this->mapTags($productDetails['tags'])];
            $this->addSummary('Tags assosiations created.');
        }

        if (!empty($productDetails['images'])) {
            $productDetails['media'] = $this->mapMedias($productDetails['images'], $productDetails['design_no']);
            $this->addSummary('Images assosiations created.');
        }

        if ($created_or_updated === 'create') {
            $productDetails['slug'] = $this->Taxonomy->generateAndValidateSlug('product', $productDetails['name']);
        }

        if (array_key_exists('short_description', $productDetails)) {
            $productDetails['short_description'] = strip_tags($productDetails['short_description']);
        }

        if (array_key_exists('long_description', $productDetails)) {
            $productDetails['long_description'] = strip_tags($productDetails['long_description']);
        }

        $entity = $this->Products->patchEntity($entity, $productDetails);

        if ($created_or_updated === 'update') {
            $productDetails['delete'] = null;
        }

        if ($this->Products->save($entity)) {
            $this->addSummary($productDetails['name'] . ' has been saved');
            if ($created_or_updated === 'create') {
                $this->success += 1;
            } else {
                $this->updated += 1;
            }
        } else {
            $this->addSummary($productDetails['name'] . ' Couldn\'t be saved. => ' . json_encode($entity->getErrors()));
            $this->error += 1;
        }

        return;
    }

    // Map product categories
    private function mapCategories($categories)
    {
        $this->loadModel('Categories');
        $category_ids = $this->Categories->getCategoryIds($categories);

        return $category_ids;
    }

    // Map product tags
    private function mapTags($tags)
    {
        $tags = explode(',', $tags);
        $this->loadComponent('Taxonomy');

        $tags = array_map(function ($tag) {
            return trim($tag);
        }, $tags);

        // Saving non existing tags
        foreach ($tags as $tag) {
            $this->Taxonomy->saveTags(['name' => $tag]);
        }

        $this->loadModel('Tags');

        $tags = $this->Tags->find('all', [
            'conditions' => ['name IN' => $tags],
            'fields' => ['id', 'name'],
        ])->toArray();

        $tag_ids = array_map(function ($tag) {
            return $tag->id;
        }, $tags);

        return $tag_ids;
    }

    // Map product medias
    private function mapMedias($medias, $design_no)
    {
        $medias = explode(',', $medias);

        $medias_array = array_map(function ($media) {
            return trim($media);
        }, $medias);

        $this->loadModel('Media');

        // If images not already uploaded then looking for images in imports/images and upload them.
        if (!empty($medias_array)) {
            $medias = [];

            foreach ($medias_array as $media_name) {

                $media_entity = $this->Media->moveMediaAndSave($media_name);

                if ($media_entity['status'] === 'error') {
                    $this->addSummary($media_name . '-' . $media_entity['message']);
                }

                if ($media_entity['status'] === 'success') {
                    array_push($medias, $media_entity['data']);
                }
            }
        }

        $count = 0;
        $mediaRelationships = [];

        foreach ($medias as $media) {
            if ($count === 0) {
                $type = 'featured';
            } else {
                $type = 'thumbnail';
            }

            $mediaRelationship = [
                'id' => $media->id,
                '_joinData' => [
                    'type' => $type
                ]
            ];
            $count++;
            array_push($mediaRelationships, $mediaRelationship);
        }

        return $mediaRelationships;
    }

    private function addSummary($message)
    {
        $summary = $this->summary;

        array_push($summary, date('r') . ' => ' . $message);
        $this->summary = $summary;
        return true;
    }

    public function view($id)
    {
        $import = $this->ImportProducts->get($id);
        $this->set(compact('import'));
    }

    public function index()
    {
        $allImports = $this->ImportProducts->find('all', [
            'order' => ['created' => 'DESC']
        ]);
        $allImports = $this->paginate($allImports);
        $this->set(compact('allImports'));
    }

    public function rollback($id = null)
    {
        error_reporting(0);
        $this->request->allowMethod(['post', 'delete']);
        $entity = $this->ImportProducts->get($id);
        $this->summary = unserialize($entity->summary);

        $reader = $this->createReader($entity);

        $reader->open(WWW_ROOT . 'imports/' . $entity->name);

        foreach ($reader->getSheetIterator() as $sheet) {
            $headers = [];
            $count = 0;

            foreach ($sheet->getRowIterator() as $row) {

                if ($count === 0) {
                    $headers = $row;
                } else {
                    $productDetails = array_combine($headers, $row);

                    if (array_key_exists('name', $productDetails)) {
                        $product = $this->Products->find('all', [
                            'conditions' => ['name' => $productDetails['name']]
                        ])->first();

                        if ($product) {
                            if ($this->Products->delete($product)) {
                                $this->addSummary($productDetails['name'] . ' has been delete');
                            } else {
                                $this->addSummary($productDetails['name'] . ' couldn\'t be deleted.');
                            }
                        } else {
                            $this->addSummary($productDetails['name'] . ' not found!');
                        }
                    }
                }
                $count++;
            }
        }

        $reader->close();

        $entity = $this->ImportProducts->patchEntity($entity, ['summary' => serialize($this->summary)]);
        $this->ImportProducts->save($entity);
        $this->Flash->success('Successfully rollback, please check logs for more details');
        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $import = $this->ImportProducts->get($id);

        if ($this->ImportProducts->delete($import)) {
            $this->Flash->success(__('The import details has been deleted.'));
        } else {
            $this->Flash->error(__('The import details could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function bulkAction()
    {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            $allDeleted = $this->ImportProducts->find('all', [
                'conditions' => ['id IN' => $Ids],
            ])->all();

            if ($this->ImportProducts->deleteAll(['id IN' => $Ids])) {
                $this->ImportProducts->deleteAllFiles($allDeleted);
                $this->Flash->success('All selected import details has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected import details. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }
}
