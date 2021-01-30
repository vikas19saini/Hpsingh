<?php 
    $this->assign('bodyClass', 'Login-page');
    $this->assign('title', 'Hpsingh - Login');
?>

<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">

<section class="sign_login">
   <?= $this->Html->image('login/login_bg.png', ['class' => 'img-responsive login_bg'])?>
   <?= $this->Html->image('login/login_bg2.png', ['class' => 'img-responsive login_bg'])?>
   <div class="container">
      <div class="row">
         <div class="login_area active">
             <h2>Create your new password</h2>
             <?= $this->Form->create(null)?>
                <div class="form-group">
                    <?= $this->Form->control('otp', ['label' => false, 'placeholder' => '6 digit OTP'])?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('password', ['label' => false, 'placeholder' => 'Password atleast 8 char long'])?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('re-password', ['label' => false, 'placeholder' => 'Confirm password', 'type' => 'password'])?>
                </div>
                <div class="form-group">
                    <button type="submit">RESET</button>
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

<?php $this->Html->scriptStart(['block' => true])?>
$(document).ready(function(){
  $(".forgot_psd_btn a").click(function(){
      $(".login_area").removeClass('active');
      $(".login_area.forgot_psd").addClass('active');
  });
});
<?php $this->Html->scriptEnd()?>