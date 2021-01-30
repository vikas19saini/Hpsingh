<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('hpadmin', function($routes) {
    $routes->plugin('AbandonedCart', ['path' => '/abandoned-cart'], function (RouteBuilder $routes) {
        $routes->connect('/', ['CartManager::index']);
        $routes->fallbacks(DashedRoute::class);
    });
});
