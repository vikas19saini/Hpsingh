<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' order delivered!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Delivered</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>We have successfully delivered your shipment. Thank you again for choosing us for your fabrics requirements.</p>
            <p>We look forward to serving you again soon.</p>
            <div class="tank_T">
                <p>Thanks, <br>Team Hpsingh</p>
            </div>
        </div>
    </td>
</tr>