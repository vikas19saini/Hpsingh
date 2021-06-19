<?php

namespace App\Controller;

use App\Controller\AppController;

class SearchController extends AppController
{

    public function query($query)
    {
        $this->request->allowMethod(['ajax']);
        $this->loadModel('Products');

        $suggesions = $this->Products->searchProducts($query);

        if (!$suggesions) {
            return $this->response->withType('html')->withStringBody('<div class="suggesions" id="search-suggesions"><p>NO SUGGESTIONS FOUND</p></div>');
        }

        $html = '<div class="suggesions" id="search-suggesions">';

        foreach ($suggesions as $key => $val) {

            if (!$val->isEmpty()) {
                $html .= '<p>' . strtoupper($key === 'tags' ? "suggestions" : $key) . '</p>';
            }

            foreach ($val as $suggesion) {

                if ($key === 'products') {
                    $url = \Cake\Routing\Router::url(['_name' => 'product', $suggesion->slug], true);
                } else if ($key === 'categories') {
                    $url = \Cake\Routing\Router::url(['_name' => 'category', $suggesion->slug], true);
                } else {
                    $url = \Cake\Routing\Router::url(['_name' => 'tag', $suggesion->slug], true);
                }

                $html .= "<a href = '$url'>" . ucwords($suggesion->name /* . " (<em>" . $suggesion->totalProducts . "</em>)" */) . '</a>';
            }
        }

        $html .= '</div>';



        return $this->response->withType('html')->withStringBody($html);
    }
}
