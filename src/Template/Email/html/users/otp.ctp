<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') . ' account verification');

?>


<tr>
    <td>
        <div class="user_dtl">
            <h4 style="padding: 0 0 5px">Hi <?= $user->name?>,</h4>
            <p>Thank you for using <b><?= Cake\Core\Configure::read('Store.name')?></b>, if you haven't done so already, 
                please confirm that you want to use this email address in your <b><?= Cake\Core\Configure::read('Store.name')?></b> account.
                Once you verify you can being. Use the following OTP to verify you account.</p><br/>
            <p><strong><?= json_decode($user->activation_key, true)['otp']?></strong></p>
            <div class="tank_T">
                <p>Thanks, <br>Team Hpsingh</p>
            </div>
        </div>
    </td>
</tr>