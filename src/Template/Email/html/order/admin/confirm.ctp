<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' order received!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Order Placed</h2>
            <h4 style="padding: 0 0 5px"><strong>New order received!</strong></h4>
            <p>You have received an order from <?= $order->name?>.</p>
            <p>Their order is as follows: <a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'view', 'prefix' => 'hpadmin', $order->id], true)?>">#<?= $order->id?></a></p>
            <p style="margin-top: 10px;margin-bottom: 10px">
                <strong>Shipping Address:</strong> <?= $order->shipping_address?>
            </p>
            <p>
                <strong>Billing Address:</strong> <?= $order->billing_address?>
            </p>
            <p style="margin-top: 10px;margin-bottom: 10px">
                <strong>Contact Details:</strong> <?= $order->email?>, <?= $order->phone?>
            </p>
			<?php if(!empty($order->gst)):?>
			<p style="margin-top: 10px;margin-bottom: 10px">
                <strong>GST No:</strong> <?= $order->gst?>
            </p>
			<?php endif;?>
        </div>
    </td>
</tr>