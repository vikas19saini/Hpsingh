<?php ?>

<div class="left_menu left_menu2 <?= $this->request->getCookie('menu') === 'collapse' ? 'active' : ''?>">
    <ul>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">
                <i class="dashicons dashicons-dashboard"></i>
            </a> 
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-welcome-add-page"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Pages</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Pages</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'add', 'prefix' => 'hpadmin', 'plugin' => null])?>">Add New</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-cart"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Catalog</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Products</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Categories</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Tags', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Tags</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Colors', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Colors</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-list-view"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Orders</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Orders</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'processing', 'plugin' => null])?>">Processing</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'shipped', 'plugin' => null])?>">Shipped</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'completed', 'plugin' => null])?>">Completed</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'cancelled', 'plugin' => null])?>">Cancelled</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'refunded', 'plugin' => null])?>">Refunded</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'on-hold', 'plugin' => null])?>">On-Hold</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'index', 'prefix' => 'hpadmin', 'failed', 'plugin' => null])?>">Failed</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-comments"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Reviews</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Reviews', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Reviews</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-email"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Enquiries</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Enquiries', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Enquiries</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-media"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Media</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Media', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Media</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-users"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Users</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Users</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add', 'prefix' => 'hpadmin', 'plugin' => null])?>">Add New</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-share"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Marketing</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Coupons', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Coupons</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Subscribers', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Subscribers</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-site"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Localization</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Countries', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Countries</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Zones', 'action' => 'add', 'prefix' => 'hpadmin', 'plugin' => null])?>">Zones</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Currencies', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Currencies</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'ShippingZones', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">Shipping Zones</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-appearance"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Appearance</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Sliders', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">Sliders</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-welcome-write-blog"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Stories</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Stories', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Stories</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Stories', 'action' => 'add', 'prefix' => 'hpadmin', 'plugin' => null])?>">Add Story</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-generic"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Imports</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Import', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>">All Imports</a></li>
                </ul>
            </span>
        </li>
        <li><a href="javascript:void(0);"><i class="dashicons dashicons-admin-links"></i></a> 
            <span class="tooltiptext">
                <ul>
                    <li>Redirections</li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Redirection', 'action' => 'index', 'prefix' => 'hpadmin',  'plugin' => null])?>">All Redirections</a></li>
                </ul>
            </span>
        </li>
        <li class="collapse2"><a href="javascript:void(0);"><i class="dashicons dashicons-admin-collapse"></i></a></li>
    </ul>  
</div>