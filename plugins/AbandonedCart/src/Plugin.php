<?php

namespace AbandonedCart;

use Cake\Core\BasePlugin;

/**
 * Plugin for AbandonedCart
 */
class Plugin extends BasePlugin {

    public function middleware($middleware) {
        parent::middleware($middleware);
        return $middleware;
    }

}
