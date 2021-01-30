<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' Payment failed');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Payment failed</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>Kindly note that your payment for Order ID: <?= $order->id?> was unsuccessful. You can now click on complete payment button to successfully place your order</p>
            <div class="tank_T">
                <p>Thanks, <br>Team HpSingh</p>
            </div>
        </div>
    </td>
</tr>