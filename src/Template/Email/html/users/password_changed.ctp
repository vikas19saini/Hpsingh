<?php

$this->assign('title', \Cake\Core\Configure::read('Store.name') . ' account password changed.');

?>


<tr>
    <td>
        <div class="user_dtl">
            <h4 style="padding: 0 0 5px">Hi <?= $user->name?>,</h4>
            <p>This email confirms that your <b><?= Cake\Core\Configure::read('Store.name')?></b>, password has been successfully changed.
                           If you have any question or encounter any problems logging in, please contact us.</p>
            <div class="tank_T">
                <p>Thanks, <br>Team Hpsingh</p>
            </div>
        </div>
    </td>
</tr>