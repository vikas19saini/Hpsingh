<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Http\Middleware\CsrfProtectionMiddleware;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/payu/confirm', function(RouteBuilder $routes) {
    $routes->connect('/', 'Payments::validatePayuPyments', ['_name' => 'payu_pyment_confirm']);
});

Router::scope('/', function (RouteBuilder $routes) {

    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');

    $routes->connect('/', 'Pages::home', ['_name' => 'home']);
    $routes->connect('/sitemap/*', 'Sitemap::xml', ['_name' => 'sitemap'])->setExtensions(['xml']);
    $routes->connect('/stories/*', 'Pages::blogs', ['_name' => 'stories']);
    $routes->connect('/:slug', 'Pages::staticPage', ['_name' => 'pages', 'pass' => ['slug']]);

    $routes->connect('/product/:slug', "Product::display", ['_name' => 'product', 'pass' => ['slug']]);
    $routes->connect('/product-category/**', "Archive::category", ['_name' => 'category']);
    $routes->connect('/product-tag/:slug', "Archive::tag", ['_name' => 'tag', 'pass' => ['slug']]);
    $routes->connect('/color/:name', "Color::display", ['_name' => 'color', 'pass' => ['name']]);
    $routes->connect('/on-sale', "Archive::onSale", ['_name' => 'sale']);
    $routes->connect('/search/search-by-image', "Archive::searchByImage", ['_name' => 'searchByImage']);
    $routes->connect('/search/:search_term', "Archive::search", ['_name' => 'search', 'pass' => ['search_term']]);

    $routes->connect('/wishlist', "Wishlist::display");

    Router::prefix('hpadmin', function($routes) {
        $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
        $routes->connect('/orders/:status', 'Orders::index', ['pass' => ['status']]);
        $routes->connect('/orders/bulkAction', 'Orders::bulkAction');
        $routes->connect('/orders/updateAddress', 'Orders::updateAddress');
        $routes->connect('/orders/updateOrderStatus', 'Orders::updateOrderStatus');
        $routes->connect('/orders/get_notification', 'Orders::getNotification');
        $routes->fallbacks('InflectedRoute');
    });

    Router::prefix('api', function (RouteBuilder $routes) {
        $routes->setExtensions(['json']);
        $routes->fallbacks('InflectedRoute');
    });

    $routes->fallbacks(DashedRoute::class);
});
