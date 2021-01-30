<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') .' Did you have checkout trouble?');
?>

<tr>
    <td>
        <div class="user_dtl">
            <h2>OOPS Seems You Have Forgotten Something...</h2>
            <h4 style="padding: 0 0 5px">Hi <?= $cartDetails['name']?>,</h4>
            <p>We see some items in your cart.</p>
            <p>Head to your cart right away to complete your order before stocks run out.</p>
            <div class="tank_T"><p>Thanks, <br>Team HPSINGH</p></div>
        </div>
        <div class="track_oder_bttn">
            <a href="<?= \Cake\Core\Configure::read('Store.url') . $this->Url->build(['controller' => 'Cart', 'action' => 'display', 'plugin' => false], true)?>" class="btn btn-primary">Proceed To Cart</a>
        </div>
    </td>
</tr>