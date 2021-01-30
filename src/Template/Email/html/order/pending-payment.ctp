<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' complete payment!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Payment Pending</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>This is in regards to your Order on the <?= \Cake\Core\Configure::read('Store.name')?>, We have received your Order but are unable to obtain payment authorization.</p>
            <p>However, in the rare event that the amount is charged or blocked in your account, we will coordinate with the bank and have the money reversed to your account within 7-10 business days.</p>
            <div class="tank_T"><p>Thanks, <br>Team Hpsingh</p></div>

        </div>
        <div class="track_oder_bttn"><a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'orders', $order->id], true)?>" class="btn btn-primary">Track Order</a></div>
    </td>
</tr>