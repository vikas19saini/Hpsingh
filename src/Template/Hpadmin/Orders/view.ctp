<?php ?>

<div class="product_area">
    <div class="product_left">
        <div class="product_data">
            <div class="p_data" style="margin-top: 0px">Order #<?= $order->id?> Details</div>
            <div class="p_data_text">
                <div class="product_data_categories_view">
                    <div class="product_data_categories_list">
                        <div class="product_data_categories_shipping">
                            <div class="order-details">
                                <div class="inner-div">
                                    <h4>General</h4>
                                    <p><b>Order No:</b> #<?= $order->id?></p>
                                    <p><b>Created:</b> <?= date_format($order->created, 'D d M, Y h:i:s A')?></p>
                                    <p><b>Status:</b> <?= $order->order_status?></p>
                                    <p><b>Payment Method:</b> <?= $order->payment_mode?></p>
                                    <p><b>Shipping Method:</b> <?= $order->shipping_method?></p>
                                    <?php if(!empty($order->gst)):?>
                                        <p><b>GST Number:</b> <strong><?= strtoupper($order->gst)?></strong></p>
                                    <?php endif;?>
                                    <p><b>Customer:</b> <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index', '?' => ['search' => $order->user->email]])?>"><?= $order->user->name?></a></p>
                                </div>
                                <div class="inner-div">
                                    <div class="details">
                                        <h4>Billing <span class="dashicons dashicons-edit edit-addresses"></span></h4>
                                        <p><?= $order->bname?></p>
                                        <p><?= $order->billing_address?></p>
                                        <p><a href="tel:<?= $order->bphone?>"><?= $order->bphone?></a></p>
                                        <p>Email: <a href="mailto:<?= $order->email?>"><?= $order->email?></a></p>
                                        <p>Phone: <a href="tel:<?= $order->phone?>"><?= $order->phone?></a></p>
                                    </div>
                                    <div class="edit-address-form">
                                        <?= $this->Form->create($order, ['url' => ['action' => 'updateAddress', $order->id]])?>
                                        <?= $this->Form->control('bname', ['label' => 'Billing name']);?>
                                        <?= $this->Form->control('baddress', ['label' => 'Billing address', 'type' => 'textarea', 'style' => 'width:100%']);?>
                                        <?= $this->Form->control('bcity', ['label' => 'Billing city']);?>
                                        <?= $this->Form->control('bzone', ['label' => 'Billing state']);?>
                                        <?= $this->Form->control('bpostcode', ['label' => 'Billing postcode']);?>
                                        <?= $this->Form->control('bcountry', ['label' => 'Billing country']);?>
                                        <?= $this->Form->control('bphone', ['label' => 'Billing phone']);?>
                                        <button type="submit" class="update-edit">Update</button>
                                        <button type="button" class="cancel-edit">Cancel</button>
                                        <?= $this->Form->end()?>
                                    </div>
                                </div>
                                <div class="inner-div">
                                    <div class="details">
                                        <h4>Shipping <span class="dashicons dashicons-edit edit-addresses"></span></h4>
                                        <p><?= $order->sname?></p>
                                        <p><?= $order->shipping_address?></p>
                                        <p><a href="tel:<?= $order->sphone?>"><?= $order->sphone?></a></p>
                                    </div>
                                    <div class="edit-address-form">
                                        <?= $this->Form->create($order, ['url' => ['action' => 'updateAddress', $order->id]])?>
                                        <?= $this->Form->control('sname', ['label' => 'Shipping name']);?>
                                        <?= $this->Form->control('saddress', ['label' => 'Shipping address', 'type' => 'textarea', 'style' => 'width:100%']);?>
                                        <?= $this->Form->control('scity', ['label' => 'Shipping city']);?>
                                        <?= $this->Form->control('szone', ['label' => 'Shipping state']);?>
                                        <?= $this->Form->control('spostcode', ['label' => 'Shipping postcode']);?>
                                        <?= $this->Form->control('scountry', ['label' => 'Shipping country']);?>
                                        <?= $this->Form->control('sphone', ['label' => 'Shipping phone']);?>
                                        <button type="submit" class="update-edit">Update</button>
                                        <button type="button" class="cancel-edit">Cancel</button>
                                        <?= $this->Form->end()?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product_description">
            <div class="p_description">Order Summary</div>
            <div class="p_description_text">
                <table class="order_products">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order->products as $product):?>
                        <tr>
                            <td><?= $this->Media->the_image('thumbnail', $product->featured_image->url, ['width' => '100px'])?></td>
                            <td>
                                <a target="_blank" href="<?= $this->Url->build(['_name' => 'product', 'slug' => $product->slug])?>">
                                    <?= $product->_joinData->name?>
                                </a>
                            </td>
                            <td>
                                <?php if(empty($product->_joinData->sale_price)):?>
                                    <?= $this->Number->currency($product->_joinData->price / $order->currency_value, 'inr')?>
                                <?php else:?>
                                    <?= $this->Number->currency($product->_joinData->sale_price / $order->currency_value, 'inr')?><br/>
                                    <del><?= $this->Number->currency($product->_joinData->price / $order->currency_value, 'inr')?></del>
                                <?php endif;?>
                            </td>
                            <td>
                                <?= $product->_joinData->quantity?>
                            </td>
                            <td>
                                <?php if(empty($product->_joinData->sale_price)):?>
                                    <?= $this->Number->currency(($product->_joinData->price / $order->currency_value) * $product->_joinData->quantity, 'inr')?>
                                <?php else:?>
                                    <?= $this->Number->currency(($product->_joinData->sale_price / $order->currency_value) * $product->_joinData->quantity, 'inr')?>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="3"></td>
                            <td>Total</td>
                            <td><?= $this->Number->currency($order->total_price / $order->currency_value, 'inr')?></td>
                        </tr>
                        
                        <?php if(!empty($order->discount)):?>
                        <tr>
                            <td colspan="3"></td>
                            <td>Discount</td>
                            <td><?= $this->Number->currency($order->discount / $order->currency_value, 'inr')?></td>
                        </tr>
                        <?php endif;?>
                        
                        <?php if(!empty($order->coupon_discount)):?>
                        <tr>
                            <td colspan="3"></td>
                            <td>Coupon Discount 
                                <span class="applied-coupon">
                                    <a href="<?= $this->Url->build(['controller' => 'Coupons', 'action' => 'index', '?' => ['search' => $order->coupons[0]->_joinData->coupon_code]])?>">
                                        <?= $order->coupons[0]->_joinData->coupon_code?>
                                    </a>
                                </span>
                            </td>
                            <td><?= $this->Number->currency($order->coupon_discount / $order->currency_value, 'inr')?></td>
                        </tr>
                        <?php endif;?>
                        
                        <?php if(!empty($order->tax_charges)):?>
                        <tr>
                            <td colspan="3"></td>
                            <td><?= strtoupper($order->tax_class)?></td>
                            <td><?= $this->Number->currency($order->tax_charges / $order->currency_value, 'inr')?></td>
                        </tr>
                        <?php endif;?>
                        
                        <?php if(!empty($order->shipping_charges)):?>
                        <tr>
                            <td colspan="3"></td>
                            <td>Shipping Charges</td>
                            <td><?= $this->Number->currency($order->shipping_charges / $order->currency_value, 'inr')?></td>
                        </tr>
                        <?php endif;?>
                        <?php if($order->payment_method === 'cod'):?>
                        <tr>
                            <td colspan="3"></td>
                            <td>COD Charges</td>
                            <td><?= $this->Number->currency($order->cod_charges / $order->currency_value, 'inr')?></td>
                        </tr>
                        <?php endif;?>
                        
                        <tr class="total_amount">
                            <td colspan="3"></td>
                            <td>Total Amount</td>
                            <td><?= $this->Number->currency($order->grand_total / $order->currency_value, 'inr')?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="product_right">
        <div class="product_status">
            <h2>Order Actions</h2>
            <?= $this->Form->create(null, ['url' => ['action' => 'updateOrderStatus', $order->id]])?>
            <p>
                <?= $this->Form->select('status', ['Change Order Status To' => \Cake\Core\Configure::read('OrderStatus')], ['value' => $order->status])?>
            </p>
            <?= $this->Form->button('Save')?>
            <?= $this->Form->end()?>
        </div>
	<div class="product_status">
            <h2>Order Tracking Number</h2>
            <?= $this->Form->create(null, ['url' => ['action' => 'updateTrackingNumber', $order->id]])?>
            <p>
		<?= $this->Form->control('tracking_no', ['label' => false,'placeholder'=>"Tracking Number",'value' => $order->tracking_no])?>
	    </p>
            <?= $this->Form->button('Update')?>
            <?= $this->Form->end()?>
        </div>
        <div class="product_categories_right">
            <h2>Order Notes</h2>
            <div class="product_categories_check">
                <?php if(!empty($order->order_history)): foreach ($order->order_history as $history):?>
                <div class="order_note">
                    <div class="note_details">
                        <p>Status: <i><?= ucwords(str_replace('-', ' ', $history->status))?></i></p>
                        <p>Customer Notified: <i><?= ucwords($history->notify_customer)?></i></p>
                        <p>Is Private: <i><?= ucwords($history->is_private)?></i></p><hr/>
                        <p><?= $history->comment?></p>
                    </div>
                    <abbr><?= date_format($history->created, 'D d M, Y h:i:s A')?></abbr>
                </div>
                <?php endforeach; else:?>
                <div class="order_note">
                    <p>Note not found.</p>
                </div>
                <?php endif;?>
<!--                <div class="add_order_note">
                    <label>Add Note</label>
                    <?= $this->Form->create(null)?>
                    <?= $this->Form->control('comment', ['label' => false, 'type' => 'textarea'])?>
                    <label>Is Private Note</label>
                    <?= $this->Form->control('is_private', ['label' => false, 'options' => ['yes' => 'Private Note', 'no' => 'Note to Customer'], 'empty' => '-Select-'])?>
                    <label>Notify Customer</label>
                    <?= $this->Form->control('notify_customer', ['label' => false, 'options' => ['yes' => 'Send Notification to customer', 'no' => 'No Need to send Notification'], 'empty' => '-Select-'])?>
                    <button type="submit">Add Note</button>
                    <?= $this->Form->end()?>
                </div>-->
            </div>
        </div>
        <div class="product_categories_right">
            <h2>Payment Details</h2>
            <div class="product_categories_check"><br/>
                <?php if(!empty($order->payments)):?>
                    <?php foreach($order->payments as $payment):?>
                    <p><b>Amount: </b><?= $this->Number->currency($payment->amount / $order->currency_value, 'inr')?></b></p>
                    <p><b>ID: </b>#<?= $payment->transaction_no?></b></p>
                    <p><b>Payment Method: </b><?= ucwords($payment->payment_method)?></b></p>
                    <p><b>Status: </b><?= ucwords($payment->status)?></b></p>
                    <p><b>Created: </b><?= date_format($payment->created, 'D d M, Y h:i:s A')?></b></p>
                    <?php if(strtolower($payment->payment_method) === 'payu'): ?>
                    <div class="payment-details">
                    <?php $details = json_decode($payment->details); foreach($details as $key => $val):?>
                        <p><strong><?= ucwords($key)?></strong> : <?= $val?></p>
                    <?php endforeach;?>
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                <?php else: if($order->payment_method === 'cod'):?>
                    <p>Payment methd COD selected.</p>
                <?php else:?>
                    <p>Unable to fetch payment method.</p>
                <?php endif;endif;?>
            </div>
        </div>        
    </div>
</div>
<?= $this->Html->scriptStart(['block' => true])?>
$(document).on('click', '.edit-addresses', function(){
    $(this).parent('h4').parent('.details').css('display', 'none');
    $(this).parent('h4').parent('.details').next('.edit-address-form').css('display', 'block');
});
$(document).on('click', '.cancel-edit', function(){
    $(this).parent('form').parent('.edit-address-form').css('display', 'none');
    $(this).parent('form').parent('.edit-address-form').prev('.details').css('display', 'block');
});
<?= $this->Html->scriptEnd()?>