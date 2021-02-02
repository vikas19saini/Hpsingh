<?php
$this->assign('bodyClass', 'myAccount-page');
$this->assign('title', 'Orders - Hpsingh');
?>

<?= $this->Element('header') ?>

<div class="mobile_hidden_vissible">

    <section class="myaccount">
        <div class="container">
            <div class="row">
                <?= $this->Element('customer/navigation') ?>
                <!--- ORDERS & RETURNS -->
                <?php if ($orders->count() > 0) : foreach ($orders as $order) : ?>
                        <div class="orders_area active">
                            <div class="orders_top">
                                <div>
                                    <a href="<?= $this->Url->build(['action' => 'orders', $order->id]) ?>">
                                        ORDER NO: #<?= $order->id ?>
                                    </a>
                                </div>
                                <div>
                                    <p>Ordered On: <em><?= date_format($order->created, 'd M, Y') ?></em></p>
                                </div>
                                <div>
                                    <p>Status: <?= $order->order_status ?></p>
                                </div>
                            </div>

                            <div class="orders_mid">
                                <?php foreach ($order->products as $product) : ?>
                                    <div class="order_view">
                                        <div>
                                            <a href="<?= $this->Url->build(['_name' => 'product', $product->slug], true) ?>">
                                                <?php if (isset($product->featured_image)) : ?>
                                                    <?= $this->Media->the_image('thumbnail', $product->featured_image->url, ['class' => 'img-responsive', 'alt' => $product->featured_image->alt, 'width' => '180px', 'height' => '137px']) ?>
                                                <?php else : ?>
                                                    <?= $this->Media->placeholderImage() ?>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        <div>
                                            <h2>
                                                <a href="<?= $this->Url->build(['_name' => 'product', $product->slug], true) ?>"><?= $product->_joinData->name ?></a>
                                            </h2>
                                            <p>Quantity: <?= $product->_joinData->quantity ?> Meters</p>
                                            <p>Price: <price><?= empty($product->_joinData->sale_price) ? $this->Number->currency($product->_joinData->price, $order->currency_code) : $this->Number->currency($product->_joinData->sale_price, $order->currency_code) . ' <del>' . $this->Number->currency($product->_joinData->price, $order->currency_code) . '</del>' ?></price>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="orders_bottom">
                                <div>
                                    <p>Total Amount: <price><?= $this->Number->currency($order->grand_total, $order->currency_code) ?></price>
                                    </p>
                                </div>
                                <div>
                                    <p>Payment Mode: <?= $order->payment_mode ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                else : ?>
                    <div class="orders_area active">
                        <p>No orders found</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>