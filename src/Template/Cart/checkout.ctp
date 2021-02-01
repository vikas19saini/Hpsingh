<?php
$this->assign('bodyClass', 'shipping-page');
$this->assign('title', 'Checkout - HpSingh');
$this->assign('css', $this->Html->css('select2.min'));
$this->assign('script', '<script src="https://www.paypal.com/sdk/js?currency=' . $defaultCurrency->code . '&client-id=' . env('PAYPAL_CLIENT_ID') . '&disable-funding=credit,card"></script>' . $this->Html->script('select2.min'));
?>

<?php if (!$this->request->is('ajax')) : ?>
    <?= $this->Element('header_v2') ?>
    <style>
        .gst {
            padding: 20px;
        }

        .gst label {
            font-size: 13px;
            font-weight: normal;
            color: #000;
        }

        .gst input {
            width: 100%;
            height: 35px;
            padding: 0px 10px;
            font-size: 15px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
            font-family: monospace;
        }

        .gst input::placeholder {
            font-weight: normal;
            letter-spacing: 0px;
            text-transform: capitalize;
            font-size: 13px;
            font-family: inherit;
        }
    </style>
    <div class="mobile_hidden_vissible">
    <?php endif; ?>
    <div id="checkout">
        <?php if (!empty($this->request->getSession()->read('Cart.CartDetails.totalItems'))) : ?>
            <section class="all_shopping_area all_checkout_area">
                <div class="container">
                    <div class="row">
                        <div class="all_shopping_area_main">
                            <div class="shopping_left">
                                <div class="checkout_address">
                                    <section>
                                        <div class="checkout-steps-icon">
                                            <img src="data:image/png;base64,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">
                                        </div>
                                        <h2>
                                            Select your shipping address <span>Select a address from the saved addresses or add a new one.</span>
                                        </h2>

                                        <?php if (isset($selected_shipping_address)) : ?>
                                            <div class="selected_shipping_address checkout_address1 active">
                                                <p><?= $selected_shipping_address->name ?> <em class="addres_label"><?= strtoupper($selected_shipping_address->label) ?></em>
                                                </p>
                                                <p><span><?= $selected_shipping_address->formatted_address ?></span></p>
                                                <p>
                                                    <span>Mobile No: <em><?= $selected_shipping_address->phone ?></em></span>
                                                </p>
                                                <button type="button" class="change_shipping_address_button deliver_change_button">
                                                    CHANGE ADDRESS
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <div class="shipping_section <?= (!empty($shipping_address)) ? 'disabled' : '' ?>">

                                            <?php foreach ($savedaddresses as $oneadd) : ?>
                                                <div class="checkout_address1 <?= ((int)$shipping_address === $oneadd->id) ? 'active' : '' ?>">
                                                    <p> <?= $oneadd->name ?> <em class="addres_label"><?= strtoupper($oneadd->label) ?></em>
                                                    </p>
                                                    <div class="rename_delete">
                                                        <div class="dropdown">
                                                            <span data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                                                            <ul class="dropdown-menu">
                                                                <!--                                                    <li><span>Edit</span></li>-->
                                                                <li><span onclick="deleteAddress(<?= $oneadd->id ?>, this)">Delete</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <p><span><?= $oneadd->formatted_address ?></span></p>
                                                    <p><span>Mobile No: <em><?= $oneadd->phone ?></em></span></p>
                                                    <button class="deliver_change_button" onclick="selectAddress(<?= $oneadd->id ?>, 'shipping_address')">
                                                        DELIVER HERE
                                                    </button>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </section>
                                    <!-- Billing address start -->

                                    <?php if (!empty($shipping_address)) : ?>
                                        <section>
                                            <div class="checkout-steps-icon">
                                                <img src="data:image/png;base64,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">
                                            </div>
                                            <h2 class="biling_add">Select your billing address <span>Select a address from the saved addresses or add a new one.</span>
                                            </h2>
                                            <label class="custom-check">Same as shipping address
                                                <input id="set-billing-as-shipping" type="checkbox" <?= $shipping_address === $billing_address ? 'checked' : '' ?>>
                                                <span class="checkmark-checkbox"></span>
                                            </label>
                                            <?php if (isset($selected_billing_address) /* && ($shipping_address !== $billing_address) */) : ?>
                                                <div class="selected_shipping_address checkout_address1 active">
                                                    <p><?= $selected_billing_address->name ?> <em class="addres_label"><?= strtoupper($selected_billing_address->label) ?></em>
                                                    </p>
                                                    <p><span><?= $selected_billing_address->formatted_address ?></span>
                                                    </p>
                                                    <p><span>Mobile No: <em><?= $selected_billing_address->phone ?></em></span>
                                                    </p>
                                                    <button type="button" class="change_shipping_address_button deliver_change_button">
                                                        CHANGE ADDRESS
                                                    </button>
                                                </div>
                                            <?php endif; ?>

                                            <div class="shipping_section <?= (!empty($billing_address)) ? 'disabled' : '' ?>">
                                                <?php foreach ($savedaddresses as $oneadd) : ?>
                                                    <div class="checkout_address1 <?= ((int)$billing_address === $oneadd->id) ? 'active' : '' ?>">
                                                        <p> <?= $oneadd->name ?> <em class="addres_label"><?= strtoupper($oneadd->label) ?></em>
                                                        </p>
                                                        <div class="rename_delete">
                                                            <div class="dropdown">
                                                                <span data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                                                                <ul class="dropdown-menu">
                                                                    <!--                                                    <li><span>Edit</span></li>-->
                                                                    <li><span onclick="deleteAddress(<?= $oneadd->id ?>, this)">Delete</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <p><span><?= $oneadd->formatted_address ?></span></p>
                                                        <p><span>Mobile No: <em><?= $oneadd->phone ?></em></span></p>
                                                        <button class="deliver_change_button" onclick="selectAddress(<?= $oneadd->id ?>, 'billing_address')">
                                                            SELECT
                                                        </button>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </section>
                                    <?php endif; ?>
                                    <!-- Billing address end -->

                                    <!-- Add new address start -->
                                    <button class="checkout_btn checkout_btn1"><i class="fa fa-plus"></i> ADD NEW
                                        ADDRESS
                                    </button>
                                    <div class="add_address_area add_address_area1" id="add-new-address-checkout">
                                        <h2>ADD NEW ADDRESS</h2>
                                        <?= $this->Form->create($address, ['onsubmit' => 'addAddress(this, event)', 'url' => ['controller' => 'Customer', 'action' => 'addresses']]) ?>
                                        <?php $this->Form->unlockField('label');
                                        $this->Form->setTemplates(['inputContainer' => '{{content}}']) ?>
                                        <div class="add_address">
                                            <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Full name']) ?>
                                            <?= $this->Form->control('phone', ['label' => false, 'placeholder' => 'Mobile no']) ?>
                                            <?= $this->Form->control('postcode', ['label' => false, 'placeholder' => 'Pincode/Postcode']) ?>
                                            <?= $this->Form->control('country_id', ['label' => false, 'empty' => 'Select Country', 'options' => $countries]) ?>
                                            <?= $this->Form->control('zone_id', ['label' => false, 'empty' => 'Select State', 'options' => $zones]) ?>
                                            <?= $this->Form->control('city', ['label' => false, 'placeholder' => 'City']) ?>
                                            <?= $this->Form->control('address', ['label' => false, 'placeholder' => 'Complete address', 'value' => '']) ?>
                                            <div class="gender2">
                                                <span>Type of Address:</span>
                                                <input type="radio" name="label" value="office"> Office
                                                <input type="radio" name="label" value="home"> Home
                                                <input type="radio" name="label" value="other"> Other
                                            </div>
                                            <button type="submit">SAVE</button>
                                            <button type="button" id="cancel-add-address">CANCEL</button>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>

                                    <!-- Add new address end -->

                                    <!-- Payment method start-->
                                    <?php if (!empty($shipping_address) && !empty($billing_address)) : ?>
                                        <section class="payment-method">
                                            <div class="checkout-steps-icon">
                                                <img src="data:image/png;base64,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">
                                            </div>
                                            <h2 class="biling_add">Choose payment method <span>Choose your preferred payment method to complete purchase</span>
                                            </h2>
                                            <div class="gst">
                                                <label for="gst">Please enter the GST number if you would like to claim GST credit for your purchase</label>
                                                <input type="text" name="gst" placeholder="15 digits GST number">
                                            </div>
                                            <div class="add_address_area add_address_area1 active">
                                                <?php if (strtoupper($defaultCurrency->code) === 'INR') : ?>
                                                    <div class="payment_method" data-value="payu">
                                                        <label class="radio_container">
                                                            <i class="fa fa-credit-card"></i> Pay via credit/debit cards, wallets & UPI
                                                            <input type="radio" name="payment_method">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="payment_method" data-value="paypal">
                                                    <label class="radio_container">
                                                        <i class="fa fa-paypal"></i> Paypal
                                                        <input type="radio" name="payment_method">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>

                                                <!-- Enable COD if shipping country is india-->

                                                <?php if (isset($shippingZone) && !empty($shippingZone)) {
                                                    if (strtolower($shippingZone->cod) === 'yes') : if ((strtolower($this->request->getSession()->read('Cart.CartDetails.shippingDetails.Country')) === 'india') && ($Auth->cod_enable === 'yes')) : ?>
                                                            <div class="payment_method" data-value="cod">
                                                                <label class="radio_container">
                                                                    <i class="fa fa-money"></i> Pay on delivery
                                                                    <input type="radio" name="payment_method">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                <?php endif;
                                                    endif;
                                                }
                                                ?>

                                            </div>
                                        </section>
                                    <?php endif; ?>
                                    <!-- Payment method end-->
                                </div>
                            </div>

                            <?= $this->Element('cart/cart_details') ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <section class="empty-cart">
                <div class="empty-cart_main">
                    <?= $this->Html->image('empty_cart.jpg') ?>
                    <h2>Hey, it feels so light!</h2>
                    <p>There is nothing in your cart, Let's add some items</p>
                    <?= $this->Html->link('Add From Wishlist', ['controller' => 'wishlist', 'action' => 'index'], ['class' => 'empty-button']) ?>
                </div>
            </section>
        <?php endif; ?>

        <script>
            var checkout = {
                shipping_address: '<?= $shipping_address ?>',
                billing_address: '<?= $billing_address ?>',
                payment_method: '<?= $payment_method ?>',
            };

            <?php if (!empty($shipping_address)) : ?>
                $(document).on('change', '#set-billing-as-shipping', function() {
                    if ($(this).prop('checked')) {
                        selectAddress(<?= $shipping_address ?>, 'billing_address');
                    } else {
                        $(this).parent('p').next('div').removeClass('disabled');
                    }
                });
            <?php endif ?>

            <?php if ($this->request->is('ajax')) : ?>
                $('#country-id').select2({
                    width: '31%',
                    placeholder: 'Select Country',
                });
                $('#zone-id').select2({
                    width: '31%',
                    placeholder: 'Select State',
                });
            <?php endif; ?>
        </script>
    </div>

    <?php $this->Html->scriptStart(['block' => true]) ?>
    $(document).ready(function(){

    $(document).on('click', '.checkout_address button.checkout_btn1', function(){
    $("#add-new-address-checkout").addClass("active");
    $(this).addClass("active");
    $('html, body').animate({
    scrollTop: $("#add-new-address-checkout").offset().top - $('header')[0].offsetHeight
    }, 1000);
    });
    $(document).on('click', '#cancel-add-address', function(){
    $(this).parent('div').parent('form').parent('div').removeClass('active')
    $(this).parent('div').parent('form').parent('div').prev('button').removeClass("active");
    });
    $('#country-id').select2({
    width: '31%',
    placeholder: 'Select Country',
    });
    $('#zone-id').select2({
    width: '31%',
    placeholder: 'Select State',
    });
    });
    <?php $this->Html->scriptEnd() ?>