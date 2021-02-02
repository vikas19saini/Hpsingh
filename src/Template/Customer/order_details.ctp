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

                <div class="orders_area active">
                    <div class="orders_top">
                        <div>
                            <a href="<?= $this->Url->build(['action' => 'orders']) ?>">
                                <i class="fa fa-backward" aria-hidden="true"></i> ORDER NO: #<?= $order_details->id ?>
                            </a>
                        </div>
                        <div>
                            <p>Ordered On: <em><?= date_format($order_details->created, 'd M, Y') ?></em></p>
                        </div>
                        <div class="order_options">
                            <button>Status: <?= $order_details->order_status ?> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                            <div class="options">
                                <p onclick="customerOrderAction(this, 'send-invoice', <?= $order_details->id ?>)"><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Invoice</p>
                                <!--                                <p onclick="customerOrderAction(this, 'cancel-order', <?= $order_details->id ?>)"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Cancel Order</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr />
                        <div class="col-md-6">
                            <p><b>Billing Address:</b></p>
                            <p><?= $order_details->bname ?></p>
                            <p><?= $order_details->billing_address ?></p>
                            <p><?= $order_details->bphone ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><b>Shipping Address:</b></p>
                            <p><?= $order_details->sname ?></p>
                            <p><?= $order_details->shipping_address ?></p>
                            <p><?= $order_details->sphone ?></p>
                        </div>
                    </div>
                    <hr />
                    <div class="orders_mid">
                        <?php foreach ($order_details->products as $product) : ?>
                            <div class="order_view">
                                <div>
                                    <a href="<?= $this->Url->build(['_name' => 'product', $product->slug], true) ?>">
                                        <?php if (isset($product->featured_image)) : ?>
                                            <?= $this->Media->the_image('full', $product->featured_image->url, ['class' => 'img-responsive', 'alt' => $product->featured_image->alt, 'width' => '180px', 'height' => '137px']) ?>
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
                                    <p>Price: <price><?= empty($product->_joinData->sale_price) ? $this->Number->currency($product->_joinData->price, $order_details->currency_code) : $this->Number->currency($product->_joinData->sale_price, $order_details->currency_code) . ' <del>' . $this->Number->currency($product->_joinData->price, $order_details->currency_code) . '</del>' ?></price>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?= $this->Element('Order/track') ?>

                    <div class="orders_bottom">
                        <div>
                            <p>Total Amount:
                                <price><?= $this->Number->currency($order_details->grand_total, $order_details->currency_code) ?></price>
                            </p>
                            <div class="price_break">
                                <i class="fa fa-question-circle-o"></i>
                                <div class="tooltiptext">
                                    <table>
                                        <tr>
                                            <td>Total Amount: </td>
                                            <td>
                                                <price><?= $this->Number->currency($order_details->total_price, $order_details->currency_code) ?></price>
                                            </td>
                                        </tr>

                                        <?php if (!empty($order_details->discount)) : ?>
                                            <tr>
                                                <td>Discount: </td>
                                                <td>
                                                    <price><?= $this->Number->currency($order_details->discount, $order_details->currency_code) ?></price>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if (!empty($order_details->coupon_discount)) : ?>
                                            <tr>
                                                <td>Coupon Discount: </td>
                                                <td>
                                                    <price><?= $this->Number->currency($order_details->coupon_discount, $order_details->currency_code) ?></price>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if (!empty($order_details->tax_charges)) : ?>
                                            <tr>
                                                <td><?= strtoupper($order_details->tax_class) ?>: </td>
                                                <td>
                                                    <price><?= $this->Number->currency($order_details->tax_charges, $order_details->currency_code) ?></price>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if (!empty($order_details->shipping_charges)) : ?>
                                            <tr>
                                                <td>Shipping: </td>
                                                <td>
                                                    <price><?= $this->Number->currency($order_details->shipping_charges, $order_details->currency_code) ?></price>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php if ($order_details->payment_method === 'cod') : ?>
                                            <tr>
                                                <td>Cod Charges: </td>
                                                <td>
                                                    <price><?= $this->Number->currency($order_details->cod_charges, $order_details->currency_code) ?></price>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td>Total Due: </td>
                                            <td>
                                                <price><?= $this->Number->currency($order_details->grand_total, $order_details->currency_code) ?></price>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p>Payment Mode: <?= $order_details->payment_mode ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>