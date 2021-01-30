<?php

$this->assign('css', $this->Html->css('admin/Chart.min'). $this->Html->css('admin/daterangepicker'));
   $this->assign('script', $this->Html->script('admin/Chart.bundle.min') . $this->Html->script('admin/moment.min') . $this->Html->script('admin/daterangepicker.min'));
?>
<div class="main_user">
    <div class="dashborad-row">
        <div class="dashborad-column full-width">
            <div class="box">
                <div class="head">
                    <span>Sales</span>
                    <div id="sales-date-selector" class="date-picker">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
                <div class="inside-content">
                    <div class="sales-data">
                        <div class="data">
                            <h1>00</h1>
                            <p>total revenue in this period</p>
                        </div>
                        <div class="data not-price">
                            <h1>00</h1>
                            <p>total no. of orders placed in this period</p>
                        </div>
                        <div class="data">
                            <h1>00</h1>
                            <p>shpping charges applied in this period</p>
                        </div>
                        <div class="data">
                            <h1>00</h1>
                            <p>total coupon discounts in this period</p>
                        </div>
                        <div class="data">
                            <h1>00</h1>
                            <p>total other discounts</p>
                        </div>
                    </div>
                    <canvas id="sales"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="dashborad-row">
        <div class="dashborad-column">
            <div class="box">
                <h2 class="head">At a Glance</h2>
                <div class="inside-content">
                    <ul>
                        <li>
                            <span class="dashicons dashicons-cart"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>"><?= $this->Number->format($all)?> Products</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-welcome-view-site"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null, '?' => ['status' => 'published']])?>"><?= $this->Number->format($published)?> Published Products</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-portfolio"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null, '?' => ['status' => 'drafts']])?>"><?= $this->Number->format($drafts)?> in Drafts</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-trash"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null, '?' => ['status' => 'trash']])?>"><?= $this->Number->format($trash)?> in Trash</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-format-gallery"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Media', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>"><?= $this->Number->format($allMedias)?> Images</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-clipboard"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null, '?' => ['porductsWithoutImages' => 'yes']])?>"><?= $this->Number->format($productsWithoutImages)?> Products Without Images</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-editor-ol"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>"><?= $this->Number->format($allCategories)?> Categories</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-editor-unlink"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>"><?= $this->Number->format($unlinkedCategories)?> Unlinked Categories</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-tag"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>"><?= $this->Number->format($allTags)?> Tags</a>
                        </li>
                        <li>
                            <span class="dashicons dashicons-editor-unlink"></span>
                            <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', 'prefix' => 'hpadmin', 'plugin' => null])?>"><?= $this->Number->format($unlinkedTags)?> Unlinked Tags</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box">
                <h2 class="head">Products out of stock (<?= iterator_count($productsOutOfStock)?>)</h2>
                <div class="inside-content overflow">
                    <table>
                        <thead>
                            <tr>
                                <td><span style="top:0px" class="dashicons dashicons-format-image"></span></td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Quantity</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($productsOutOfStock->isEmpty()):?>
                            <tr><td colspan="4">No product found</td></tr>
                            <?php endif;?>

                            <?php foreach($productsOutOfStock as $product):?>
                            <tr>
                                <td>
                                    <?php if(isset($product->featured_image->url) && !empty($product->featured_image->url)):?>
                                        <?= $this->Media->the_image('thumbnail', $product->featured_image->url, ['width' => '40px'])?>
                                    <?php else:?>
                                    <i style="top:0px" class="dashicons dashicons-format-image"></i>
                                    <?php endif;?>
                                </td>
                                <td><a href="<?= $this->Url->build(['controller' => 'products', 'action' => 'edit', $product->id])?>"><?= $product->name?></a></td>
                                <td><?= $this->Product->the_price($product->ragular_price, $product->sale_price)?></td>
                                <td><?= !empty($product->quantity) ? $product->quantity : '<hr/>'?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="dashborad-column">
            <div class="box">
                <div class="head">
                    <span>Orders</span>
                    <div id="orders" class="date-picker">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
                <div class="inside-content">
                    <canvas id="orders-pie-chart"></canvas>
                </div>
            </div>
            <div class="box">
                <div class="head">
                    <span>Top selling</span>
                    <div id="topselling" class="date-picker">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
                <div class="inside-content overflow">
                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Regular Price</td>
                                <td>Selling Price</td>
                                <td>Quantity</td>
                            </tr>
                        </thead>
                        <tbody id="top_selling_products_list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->scriptStart(['block' => true])?>

        $(document).ready(function(){
            getDashboardData(moment().subtract(29, 'days').format('YYYY-MM-D'), moment().format('YYYY-MM-D'), 'sales');
            getDashboardData(moment().subtract(29, 'days').format('YYYY-MM-D'), moment().format('YYYY-MM-D'), 'orders');
            getDashboardData(moment().subtract(29, 'days').format('YYYY-MM-D'), moment().format('YYYY-MM-D'), 'top_selling');
        });

        $(function() {
            function orders(start, end) {
                $('#orders span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                getDashboardData(start.format('YYYY-MM-D'), end.format('YYYY-MM-D'), 'orders');
            }

            $('#orders').daterangepicker({
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
            }, orders);
            
            function topselling(start, end) {
                $('#topselling span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                getDashboardData(start.format('YYYY-MM-D'), end.format('YYYY-MM-D'), 'top_selling');
            }
            
            $('#topselling').daterangepicker({
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
            }, topselling);
            
            function sales(start, end) {
                $('#sales-date-selector span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                getDashboardData(start.format('YYYY-MM-D'), end.format('YYYY-MM-D'), 'sales');
            }
            
            $('#sales-date-selector').daterangepicker({
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
            }, sales);
        });
<?= $this->Html->scriptEnd()?>