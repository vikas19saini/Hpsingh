<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' order received!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Order Placed</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>Your have  successfully  placed your order and is currently under processing. We shall notify once we  ship your order.</p>
            <div class="tank_T">
                <p>Thanks, <br>Team HpSingh</p>
            </div>
        </div>
    </td>
</tr>