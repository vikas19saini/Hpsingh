<?php

namespace App\Controller\Hpadmin;

use App\Controller\AppController;

class PagesController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $templates = [];
        $dir = APP . 'Template' . DS . 'Pages';
        if (is_dir($dir)) {
            $templates = array_slice(scandir($dir), 2);
            $keys = $templates;

            $templates = array_map(function($template) {
                return str_replace('_', ' ', ucwords(explode('.', $template)[0]));
            }, $templates);
            
            $keys = array_map(function($key) {
                return explode('.', $key)[0];
            }, $keys);

            $templates = array_combine($keys, $templates);
        }
        $this->set(compact('templates'));
    }

    public function index() {
        $pages = $this->paginate($this->Pages);

        $this->set(compact('pages'));
    }

    public function add() {
        $page = $this->Pages->newEntity();
        if ($this->request->is('post')) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
        
        $this->set(compact('page'));
    }

    public function edit($id = null) {
        $page = $this->Pages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
        $this->set(compact('page'));
        $this->render('add');
    }

    public function bulkAction() {
        $this->request->allowMethod(['post']);

        $Ids = explode(',', $this->request->getData('actionIds'));
        $action = $this->request->getData('action');
        if ($action === 'delete' && !empty($action)) {
            if ($this->Pages->deleteAll(['Pages.id IN' => $Ids])) {
                $this->Flash->success('All selected pages has been deleted.');
            } else {
                $this->Flash->error('Unable to delete selected pages. Please, try again');
            }
        }
        $this->redirect(['action' => 'index']);
    }

}
