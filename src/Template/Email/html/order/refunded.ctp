<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' refunded!');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>Refunded</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $order->name?>,</h4>
            <p>We are writing to confirm that your refund has been processed for your Order. It may take up to 7-10  business days for your bank to credit the refund amount to your account.</p>
            <p>If you need further assistance, contact us on <?= Cake\Core\Configure::read('Store.supportEmail')?> or call us at <a href="tel:<?= Cake\Core\Configure::read('Store.supportContact')?>"><?= Cake\Core\Configure::read('Store.supportContact')?></a></p>
            <div class="tank_T">
                <p>Thanks, <br>Team HpSingh</p>
            </div>
        </div>
    </td>
</tr>