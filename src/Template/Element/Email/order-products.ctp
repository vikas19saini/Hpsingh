<?php foreach ($order->products as $product): ?>

    <tr>
        <td align="center">
            <table cellpadding="5" border="0" cellspacing="0" style="border-collapse:collapse" class="bttm_br">
                <tr>
                    <td width="25%" valign="bottom"><p class="on_img">
                            <a href="<?= $this->Url->build(['_name' => 'product', $product->slug], true) ?>">
                                <img
                                    src="<?= $this->Media->get_the_image_url('thumbnail', $product->featured_image->url) ?>">
                            </a>
                        </p></td>
                    <td width="50%" style="vertical-align: top;padding: 18px 10px;">
                        <div class="img_tx">
                            <p>
                                <a style="color:#353535"
                                   href="<?= $this->Url->build(['_name' => 'product', $product->slug], true) ?>">
                                    <?= $product->_joinData->name ?>
                                </a>
                            </p>
                        </div>
                        <table>
                            <tr>
                                <td width="200px">
                                    <div class="img_tx"><p>Qty</p></div>
                                </td>
                                <td width="200px">
                                    <div class="img_tx"><p>
                                        <p><?= $product->_joinData->quantity ?></p></p></div>
                                </td>
                            </tr>

                        </table>
                    </td>
                    <td width="25%" style="vertical-align: top;padding: 18px 0px;">
                        <div class="img_tx">
                            <p><?php
                                if (!empty($product->_joinData->sale_price)) {
                                    echo $this->Number->currency($product->_joinData->sale_price * $product->_joinData->quantity, $order->currency_code), ' <del>', $this->Number->currency($product->_joinData->price * $product->_joinData->quantity, $order->currency_code), '</del>';
                                } else {
                                    echo $this->Number->currency($product->_joinData->price * $product->_joinData->quantity, $order->currency_code);
                                }
                                ?></p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<?php endforeach; ?>

<tr>
    <td>
        <table class="bttm_br">

            <tr>
                <td width="75%">
                    <div class="img_tx"><p style="padding-left:30px">Total Amount:</p></div>
                </td>
                <td width="25%">
                    <div class="img_tx"><p
                            style="padding: 18px 0px;"><?= $this->Number->currency($order->total_price, $order->currency_code) ?></p>
                    </div>
                </td>
            </tr>
            <?php if (!empty($order->discount)): ?>
                <tr>
                    <td width="75%">
                        <div class="img_tx"><p style="padding-left:30px">Discount:</p></div>
                    </td>
                    <td width="25%">
                        <div class="img_tx"><p
                                style="padding: 18px 0px;"><?= $this->Number->currency($order->discount, $order->currency_code) ?></p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($order->coupon_discount)): ?>
                <tr>
                    <td width="75%">
                        <div class="img_tx"><p style="padding-left:30px">Coupon Discount:</p></div>
                    </td>
                    <td width="25%">
                        <div class="img_tx"><p
                                style="padding: 18px 0px;"><?= $this->Number->currency($order->coupon_discount, $order->currency_code) ?></p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($order->tax_charges)): ?>
                <tr>
                    <td width="75%">
                        <div class="img_tx"><p style="padding-left:30px"><?= $order->tax_class ?></p></div>
                    </td>
                    <td width="25%">
                        <div class="img_tx"><p
                                style="padding: 18px 0px;"><?= $this->Number->currency($order->tax_charges, $order->currency_code) ?></p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($order->shipping_charges)): ?>
                <tr>
                    <td width="75%">
                        <div class="img_tx"><p style="padding-left:30px">Shipping Charges</p></div>
                    </td>
                    <td width="25%">
                        <div class="img_tx"><p
                                style="padding: 18px 0px;"><?= $this->Number->currency($order->shipping_charges, $order->currency_code) ?></p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if ($order->payment_method === 'cod'): ?>
                <tr>
                    <td width="75%">
                        <div class="img_tx"><p style="padding-left:30px">COD Charges</p></div>
                    </td>
                    <td width="25%">
                        <div class="img_tx"><p
                                style="padding: 18px 0px;"><?= $this->Number->currency($order->cod_charges, $order->currency_code) ?></p>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </td>

</tr><!-- end tr -->

<tr>
    <td>
        <table class="bttm_br" width="100%">
            <tr>
                <td width="75%">
                    <div class="img_tx"><p style="padding-left:30px">Total Due Amount</p></div>
                </td>
                <td width="25%">
                    <div class="img_tx"><p
                            style="padding: 18px 0px;"><?= $this->Number->currency($order->grand_total, $order->currency_code) ?></p>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
