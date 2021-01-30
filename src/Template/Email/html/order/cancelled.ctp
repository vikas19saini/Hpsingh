<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' order cancelled!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Cancelled</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>As per your request your order <span style="color: #5172FC">(ID: <?= $order->id?>) </span> has been cancelled.</p>
            <p>We look forward to serving you again soon.</p>
            <div class="tank_T">
                <p>Thanks, <br>Team Hpsingh</p>
            </div>
        </div>
    </td>
</tr>

