<?php

$this->assign('bodyClass', 'register-page');
    $this->assign('title', 'Hpsingh - Signup Verification');
?>

<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">
    <section class="sign_login">
       <?= $this->Html->image('login/login_bg.png', ['class' => 'img-responsive login_bg'])?>
       <?= $this->Html->image('login/login_bg2.png', ['class' => 'img-responsive login_bg'])?>
        <div class="container">
            <div class="row">
                <div class="login_area sign_area active">
                    <h2 style="margin-bottom: 0px;">Welcome to HP Singh Family</h2>
                    <p>Please enter your email address to verify.</p><br/>
                    <?= $this->Form->create(null)?>
                    <div class="form-group" style="width: 100%">
                      <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Registered email address'])?>
                    </div>
                    <div class="form-group register_btn">
                        <button type="submit">VERIFY</button>
                    </div>
                    <?= $this->Form->end()?>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
   <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>
