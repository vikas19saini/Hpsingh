<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class TaxonomyComponent extends Component {

    private $Taxonomy;
    protected $_defaultConfig = [];

    public function saveTags($tag_data = []) {
        $tagTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Tags');

        if ($tagTable->exists(['name' => $tag_data['name']])) {
            return false;
        }

        if (array_key_exists('slug', $tag_data)) {

            if (empty($tag_data['slug'])) {
                $tag_data['slug'] = $this->generateAndValidateSlug('tag', $tag_data['name']);
            } else {
                $tag_data['slug'] = $this->generateAndValidateSlug('tag', $tag_data['slug']);
            }
        }else{
            $tag_data['slug'] = $this->generateAndValidateSlug('tag', $tag_data['name']);
        }

        $tag = $tagTable->newEntity();
        $tag = $tagTable->patchEntity($tag, $tag_data);

        if ($tagTable->save($tag)) {
            return $tag;
        }else{
            $this->log($tag->getErrors());
        }

        return false;
    }

    public function generateAndValidateSlug($taxonomy_type, $name) {
        $slug = strtolower(\Cake\Utility\Text::slug($name));

        if ($taxonomy_type === 'tag') {
            $this->Taxonomy = \Cake\ORM\TableRegistry::getTableLocator()->get('Tags');
        } else if ($taxonomy_type === 'product') {
            $this->Taxonomy = \Cake\ORM\TableRegistry::getTableLocator()->get('Products');
        }

        if ($this->Taxonomy->exists(['slug' => $slug])) {
            $slug .= '1';
            return $this->generateAndValidateSlug($taxonomy_type, $slug);
        } else {
            return $slug;
        }
    }

}
