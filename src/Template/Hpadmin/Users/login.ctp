<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge"/>
        <link rel="shortcut icon" href="img/favicon.png" type=""/>
        <title> HP SINGH | Admin Login</title>
        <?= $this->Html->css('admin/menu.css') ?>
        <?= $this->Html->css('admin/style.css') ?>
        <?= $this->Html->css('admin/icon.css') ?>
        <?= $this->Html->css('add.css') ?>
    </head>
    <body class="login_page">
        <div class="admin_login_area">
            <div class="login_section">
                <?= $this->Flash->render()?>
                <?= $this->Media->renderImage('img/logo.png')?>
                <div class="login_form">
                    <?= $this->Form->create($user)?>
                        <div class="form-group">
                            <?= $this->Form->control('email', ['label' => 'Email Address'])?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('password', ['label' => 'Password', 'type' => 'password'])?>
                        </div>
                        <div class="form-group remember"> 
                            <span><?= $this->Form->button(__('Log In'))?></span>
                            <div class="clearfix"></div>
                        </div>
                    <?= $this->Form->end()?>
                </div>
                <p><a href="javascrip:void(0);">Lost your password?</a></p>
            </div>
        </div>
    </body>
</html>