<?php ?>

<div class="left_menu <?= $this->request->getCookie('menu') === 'collapse' ? 'active' : ''?>">
    <ul>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-dashboard"></i> Dashboard
            </a>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-welcome-add-page"></i> Pages</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Pages</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'add', 'prefix' => 'hpadmin', 'plugin' => null])?>">Add New</a></li>
            </ul>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-cart"></i> Catalog</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Products</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Categories</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Tags', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Tags</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Colors', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Colors</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'CartManager', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => 'AbandonedCart'])?>">Abandoned Cart</a></li>
            </ul>
        </li>
        <li>
            <a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-list-view"></i> Orders</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">All Orders</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'processing'])?>">Processing</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'shipped'])?>">Shipped</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'completed'])?>">Completed</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'cancelled'])?>">Cancelled</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'refunded'])?>">Refunded</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'on-hold'])?>">On-Hold</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null, 'failed'])?>">Failed</a></li>
            </ul>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-admin-comments"></i> Reviews</a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Enquiries', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-email"></i> Enquiries</a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Media', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-admin-media"></i> Media
            </a>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-admin-users"></i> Users</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">All Users</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add', 'prefix' => 'hpadmin',  'plugin' => null])?>">Add New</a></li>
            </ul>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-share"></i> Marketing</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Coupons', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Coupons</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Subscribers', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Subscribers</a></li>
            </ul>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-admin-site"></i> Localization</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Countries', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Countries</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Zones', 'action' => 'add', 'prefix' => 'hpadmin',  'plugin' => null])?>">Zones</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Currencies', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Currencies</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'ShippingZones', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Shipping Zones</a></li>
            </ul>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-admin-appearance"></i> Appearance</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Sliders', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Sliders</a></li>
            </ul>
        </li>
        <li><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-welcome-write-blog"></i> Stories</a>
            <ul class="inner">
                <li><a href="<?= $this->Url->build(['controller' => 'Stories', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">All Stories</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Stories', 'action' => 'add', 'prefix' => 'hpadmin',  'plugin' => null])?>">Add Story</a></li>
            </ul>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Import', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-admin-generic"></i> Import
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Redirection', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-admin-links"></i> Redirections
            </a>
        </li>
        <li class="collapse"><a class="toggle" href="javascript:void(0);"><i class="dashicons dashicons-admin-collapse"></i>Collapse menu</a>
        </li>
    </ul>  
</div>