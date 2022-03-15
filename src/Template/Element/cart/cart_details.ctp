<?php ?>
<div class="shopping_right">
    <div class="place_order">
        <div class="option">
            <?php if ($this->request->getSession()->check('Cart.Coupon')) : ?>
                <div class="total-discount">
                    <div class="coupon-details">
                        <b><?= $this->request->getSession()->read('Cart.Coupon')->code ?></b>
                        <price>
                            Savings of <?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.couponDiscount'), $defaultCurrency->code) ?> on the bill
                        </price>
                    </div>
                    <span id="remove-coupon">Remove</span>
                </div>
            <?php else : ?>
                <?= $this->Form->create(null, ['url' => ['controller' => 'Cart', 'action' => 'applyCoupon'], 'id' => 'apply-coupon-form']) ?>
                <div class="coupon-app-fields">
                    <?= $this->Form->text('coupon_code', ['placeholder' => 'Enter coupon code...', 'autocomplete' => 'off', 'required', 'title' => 'Enter coupon code', "id" => "coupon_code"]) ?>
                    <button type="submit">APPLY COUPON</button>
                </div>
                <?= $this->Form->end() ?>
                <?php if (iterator_count($coupons) > 0) : ?>
                    <div class="couponsdisplay">
                        <p class="hed">Select a coupon code</p>
                        <div class="coupon-group">
                            <?php foreach ($coupons as $coupon) : ?>
                                <div class="coupon-one" onClick="$('#coupon_code').val('<?= $coupon->code ?>');$('#apply-coupon-form').submit();">
                                    <h3><input type="radio" name="coupon" /> <?= $coupon->code ?></h3>
                                    <p><?= $coupon->description ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div>
            <h3>PRICE DETAILS</h3>
            <p>Cart Total: <span><em><?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.cartTotal'), $defaultCurrency->code) ?></em></span></p>

            <?php if (!empty($this->request->getSession()->read('Cart.CartDetails.cartDiscount'))) : ?>
                <p>Cart Discount: <span class="dis"><em>- </i> <?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.cartDiscount'), $defaultCurrency->code) ?></em></span></p>
            <?php endif; ?>

            <?php if (!empty($this->request->getSession()->read('Cart.CartDetails.couponDiscount'))) : ?>
                <p>Coupon Discount: <span class="dis"><em>- <?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.couponDiscount'), $defaultCurrency->code) ?></em></span></p>
            <?php endif; ?>

            <?php if ($this->request->getSession()->check('Cart.CartDetails.shippingDetails')) : ?>
                <p>Delivery Charges:
                    <?php $shippingDetails = $this->request->getSession()->read('Cart.CartDetails.shippingDetails'); ?>
                    <a data-placement="bottom" onclick="return false" href="#" data-toggle="tooltip" title="Expected delivery time : <?= ucwords($shippingDetails['Details']['DeliveryDayOfWeek']), ' ', $shippingDetails['Details']['DeliveryDate'], ' @ ', $shippingDetails['Address'] ?>"><i class="fa fa-question-circle-o shipping-info"></i></a>
                    <span><em> <?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.shippingCharges'), $defaultCurrency->code, ['zero' => 'Free']) ?></em></span>
                </p>
            <?php endif; ?>
        </div>
        <div class="total_order">
            <p>Order Total: <span><em><?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.grantTotal'), $defaultCurrency->code) ?></em></span></p>
            <?php if ($this->request->getParam('action') !== 'checkout') : ?>
                <a href="<?= $this->Url->build(['action' => 'checkout']) ?>"><button>CHECKOUT <price>(<?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.grantTotal'), $defaultCurrency->code) ?>)</price></button></a>
            <?php endif; ?>
        </div>
        <span class="inc-price">*Prices are inclusive of all taxes</span>
    </div>
</div>