<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' order is on-hold!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>On Hold</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>Your order <span style="color: #5172FC">(ID: <?= $order->id?>) </span> is currently on hold.</p>
            <div class="tank_T">
                <p>Thanks, <br>Team Hpsingh</p>
            </div>
        </div>
    </td>
</tr>