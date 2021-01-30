<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') . ' account reset');

?>

<tr>
    <td>
        <div class="user_dtl">
            <h4 style="padding: 0 0 5px">Hi <?= $user->name?>,</h4>
            <p>Seems like you forgot your password for <b><?= Cake\Core\Configure::read('Store.name')?></b>, if this is true use the following OTP to reset you password.
                           If you did not forgot your password you can safely ignore this email. Use the following OTP to reset your password.</p><br/>
            <p><strong><?= json_decode($user->reset, true)['otp']?></strong></p>
            <div class="tank_T">
                <p>Thanks, <br>Team Hpsingh</p>
            </div>
        </div>
    </td>
</tr>