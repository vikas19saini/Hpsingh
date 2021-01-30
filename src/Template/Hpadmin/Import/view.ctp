<?php

$logs = json_decode($import->summary);
?>

<div class="main_user">
    <div class="user_section">
        <h2>Log Details of <i><?= $import->name?></i></h2>
    </div>
    <div class="logs">
        <?php $count = 0; foreach ($logs as $log):?>
        <p><?= $count?>:) <?= $log?></p>
        <?php $count++; endforeach;?>
    </div>
</div>
