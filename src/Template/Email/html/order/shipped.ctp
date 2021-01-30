<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' order shipped!');

?>
<tr>
    <td>
        <div class="user_dtl">
            <h2>Coming Soon</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>Your order <span style="color: #5172FC">(ID: <?= $order->id?>) </span>has been shipped successfully from our warehouse and shall be with you soon. We are glad to serve you and hope to bring you more of these shopping experiences.</p>
            <p>We look forward to serving you again soon.</p>
            <div class="tank_T"><p>Thanks, <br>Team Hpsingh</p></div>

        </div>
        <div class="track_oder_bttn"><a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'orders', $order->id], true)?>" class="btn btn-primary">Track Order</a></div>
    </td>
</tr>