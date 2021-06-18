<?php

namespace App\Controller;

use App\Controller\AppController;
use League\ColorExtractor\Color;
use League\ColorExtractor\Palette;
use ourcodeworld\NameThatColor\ColorInterpreter;

class ArchiveController extends AppController
{

    private $filters;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadModel('Categories');

        $this->filters = $this->request->getQuery();
    }

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);

        $discounts = $this->Categories->Products->getDiscounts();

        $this->loadModel('Colors');
        $colors = $this->Colors->find('all');
        $this->set(compact('discounts', 'colors'));
    }

    public function category($args)
    {

        $slug = @explode('/', $args);
        $slug = end($slug);

        $category = $this->Categories->find('all', [
            'conditions' => ['slug' => $slug],
            'contain' => ['BannerMedia'],
        ])->first();

        if (!$category) {
            throw new \Cake\Http\Exception\NotFoundException();
        }


        $categoryPath = $this->Categories->find('path', [
            'for' => $category->id
        ]);

        $subCategories = $this->Categories->find('children', [
            'for' => $category->id,
            'contain' => ['SubcategoryMedia'],
        ]);

        $categoryIds = [$category->id];

        foreach ($subCategories as $subCategory) {
            array_push($categoryIds, $subCategory->id);
        }

        $products = $this->Categories->Products->find('InArchive', [
            'categories' => $categoryIds,
            'archiveType' => 'category',
            'find' => 'fair',
            'filters' => $this->filters,
        ]);

        $products = $this->paginate($products, ['limit' => 30]);

        $this->set(compact('category', 'categoryPath', 'subCategories', 'products', 'slug'));

        if ($this->request->is('ajax')) {
            $this->render('loadmore');
        } else {
            if ($category->layout === 'category') {
                $this->render('subcategories');
            }
        }
    }

    public function tag($slug = null)
    {
        if (is_null($slug)) {
            return $this->redirect(['_name' => 'home']);
        }

        $this->loadModel('Tags');

        $tag = $this->Tags->find('all', [
            'conditions' => ['slug' => $slug]
        ])->first();

        if (!$tag) {
            throw new \Cake\Http\Exception\GoneException('The webpage no longer exists');
        }

        $products = $this->Tags->Products->find('InArchive', [
            'filters' => $this->filters,
            'archiveType' => 'tag',
            'tag' => $slug,
            'find' => 'fair',
        ]);

        $products = $this->paginate($products, ['limit' => 30]);
        $category = $tag;
        $this->set(compact('category', 'products'));

        if ($this->request->is('ajax')) {
            $this->render('loadmore');
        } else {
            $this->render('category');
        }
    }

    public function search($search_term = null)
    {
        if (is_null($search_term)) {
            return $this->redirect(['_name' => 'home']);
        }

        $products = $this->Categories->Products->find('InArchive', [
            'filters' => $this->filters,
            'archiveType' => 'search',
            'search_term' => $search_term,
            'find' => 'fair',
        ]);

        $products = $this->paginate($products, ['limit' => 30]);
        $text = 'Search results for - ' . $search_term;
        $category = (object) ['meta_title' => $text, 'meta_description' => $text, 'meta_keywords' => $text, 'name' => $search_term];
        $this->set(compact('category', 'products', 'search_term'));

        if ($this->request->is('ajax')) {
            $this->render('loadmore');
        } else {
            $this->render('category');
        }
    }


    // Find products on discount..
    public function onSale()
    {
        $search_term = 'On Sale';
        $products = $this->Categories->Products->find('InArchive', [
            'filters' => $this->filters,
            'archiveType' => 'sale',
            'find' => 'fair',
        ]);
        $products = $this->paginate($products, ['limit' => 30]);
        $text = 'Products ' . $search_term . ' - ' . \Cake\Core\Configure::read('Store.name');
        $category = (object) ['meta_title' => $text, 'meta_description' => $text, 'meta_keywords' => $text, 'name' => $search_term];
        $this->set(compact('category', 'products', 'search_term'));

        if ($this->request->is('ajax')) {
            $this->render('loadmore');
        } else {
            $this->render('category');
        }
    }

    public function searchByImage()
    {
        if ($this->request->is('post')) {
            require APP . "lib/Colorinterpreter.php";
            $colorInterpreter = new ColorInterpreter();

            $ext = explode(".", $_FILES['reference']['name']);
            $ext = end($ext);

            if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                $this->Flash->error("Invalid image format! upload PNG or JPG format");
                return $this->redirect(['_name' => "home"]);
            }

            if ($_FILES['reference']['size'] > 1000000) {
                $this->Flash->error("Image size is too large max 1MB allowed");
                return $this->redirect(['_name' => "home"]);
            }

            $filName = WWW_ROOT . strtotime('now') . $_FILES['reference']['name'];
            if (move_uploaded_file($_FILES['reference']['tmp_name'], $filName)) {
                $palette = Palette::fromFilename($filName,  Color::fromHexToInt('#FFFFFF'));
                $colors = [];
                foreach ($palette->getMostUsedColors(2000) as $color) {
                    $colorInter = $colorInterpreter->name(Color::fromIntToHex($color));
                    array_push($colors, $colorInter['name']);
                }
            }

            if (!is_array($colors)) {
                $this->Flash->error("Invalid file!");
                return $this->redirect(['_name' => "home"]);
            }

            $colors = array_unique($colors);
            @unlink($filName);

            return $this->redirect(['action' => 'searchByImage', '?' => ['colors' => @implode(",", $colors), 'hideColorFilter' => 'yes']]);
        }


        $search_term = 'Search By Image';
        $products = $this->Categories->Products->find('InArchive', [
            'filters' => $this->filters,
            'archiveType' => 'imageSearch',
            'colors' => @explode(",", $this->filters['colors']),
            'find' => 'fair',
        ]);
        $products = $this->paginate($products, ['limit' => 30]);
        $text = 'Products By Image' . \Cake\Core\Configure::read('Store.name');
        $category = (object) ['meta_title' => $text, 'meta_description' => $text, 'meta_keywords' => $text, 'name' => "Products By Image"];
        $this->set(compact('category', 'products', 'search_term'));

        $this->render('category');
    }
}
