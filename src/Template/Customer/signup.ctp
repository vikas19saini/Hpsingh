<?php
$this->assign('bodyClass', 'register-page');
$this->assign('title', 'Hpsingh - Signup');
$this->assign('css', $this->Html->css('select2.min'));
$this->assign('script', $this->Html->script('select2.min'));
?>

<?= $this->Element('header') ?>

<div class="mobile_hidden_vissible">
   <section class="sign_login">
      <?= $this->Html->image('login/login_bg.png', ['class' => 'img-responsive login_bg']) ?>
      <?= $this->Html->image('login/login_bg2.png', ['class' => 'img-responsive login_bg']) ?>
      <div class="container">
         <div class="row">
            <div class="login_area sign_area active">
               <h2>Welcome to HP Singh Family</h2>
               <?= $this->Form->create($user) ?>
               <div class="form-group">
                  <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Full name']) ?>
               </div>
               <div class="form-group">
                  <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address']) ?>
               </div>
               <div class="form-group">
                  <?= $this->Form->control('password', ['label' => false, 'placeholder' => 'Password']) ?>
               </div>
               <div class="form-group">
                  <?= $this->Form->control('re-password', ['label' => false, 'type' => 'password', 'placeholder' => 'Confirm password', 'secure' => false]) ?>
               </div>
               <div class="form-group">
                  <?= $this->Form->control('phone', ['label' => false, 'placeholder' => 'Mobile No.']) ?>
               </div>
               <div class="form-group">
                  <?= $this->Form->control('country_id', ['label' => false, 'empty' => 'Select country']) ?>
               </div>
               <div class="form-group register_btn">
                  <button type="submit">REGISTER</button>
                  <div class="sub_login_bttn">
                     <a class="login-btn gLogin" href="<?= $this->Url->build(['action' => 'googleLogin']) ?>">Login With Google</a>
                     <a class="login-btn fLogin" href="<?= $this->Url->build(['action' => 'facebookLogin']) ?>">Login With Facebook</a>
                  </div>
               </div>
               <?= $this->Form->end() ?>
               <p class="text-sign">Already have an account? <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'login']) ?>">Login Now</a></p>
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
$('#country-id').select2({
width: '100%',
padding: '6px',
placeholder: 'Select Country',
});
<?php $this->Html->scriptEnd() ?>