<?php
$this->assign('bodyClass', 'Login-page');
$this->assign('title', 'Hpsingh - Login');
?>

<?= $this->Element('header') ?>

<div class="mobile_hidden_vissible">

    <section class="sign_login">
        <?= $this->Html->image('login/login_bg.png', ['class' => 'img-responsive login_bg']) ?>
        <?= $this->Html->image('login/login_bg2.png', ['class' => 'img-responsive login_bg']) ?>
        <div class="container">
            <div class="row">
                <div class="login_area <?= empty($this->request->getQuery('tab')) ? 'active' : '' ?>">
                    <h2>Welcome Back</h2>
                    <?= $this->Form->create($user) ?>
                    <div class="form-group">
                        <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address']) ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('password', ['label' => false, 'placeholder' => 'Password']) ?>
                    </div>
                    <div class="form-group">
                        <button type="submit">LOGIN</button>
                        <div class="sub_login_bttn">
                            <?= $this->Media->renderImage('img/google_icon.svg', ['alt' => ""]) ?><a class="login-btn" href="<?= $this->Url->build(['action' => 'googleLogin']) ?>">Google Login</a>
                            <?= $this->Media->renderImage('img/facebook_icon.svg', ['alt' => ""]) ?><a class="login-btn" href="<?= $this->Url->build(['action' => 'facebookLogin']) ?>">Facebook Login</a>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                    <p class="forgot_psd_btn"><a href="javascript:void(0);">Forgot Password?</a></p>
                    <p class="text-sign">Doesn't have an account? <a href="<?= $this->Url->build(['action' => 'signup']) ?>">Signup</a></p>
                    <p class="text-sign">Account is not verify? <a href="<?= $this->Url->build(['action' => 'reverify']) ?>">Resend Verification Code</a></p>
                </div>
                <div class="login_area forgot_psd <?= ($this->request->getQuery('tab') === 'forget') ? 'active' : '' ?>">
                    <h2>Forgot Your Password</h2>
                    <p class="forgot_text">Enter your registered e-mail address <span>to recover your password</span></p>
                    <?= $this->Form->create($user, ['url' => ['action' => 'resetPassword']]) ?>
                    <div class="form-group">
                        <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address', 'id' => 'forget-email']) ?>
                    </div>
                    <div class="form-group">
                        <button type="submit">RECOVER PASSWORD</button>
                    </div>
                    <?= $this->Form->end() ?>
                    <p class="text-sign">Doesn't have an account? <a href="<?= $this->Url->build(['action' => 'signup']) ?>">Signup</a></p>
                    <p class="text-sign">Account is not verify? <a href="<?= $this->Url->build(['action' => 'reverify']) ?>">Resend Verification Code</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>

<?php $this->Html->scriptStart(['block' => true]) ?>
$(document).ready(function(){
$(".forgot_psd_btn a").click(function(){
$(".login_area").removeClass('active');
$(".login_area.forgot_psd").addClass('active');
});
});
<?php $this->Html->scriptEnd() ?>