<?php 
    $this->assign('bodyClass', 'myAccount-page');
    $this->assign('title', 'Profile - Hpsingh');
?>

<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">

<section class="myaccount">
   <div class="container">
      <div class="row">
          <?= $this->Element('customer/navigation')?>

            <!--- Profile -->
          <div class="profile_area active">
             <div class="edit_p1">
                <h2>Primary Information <button>EDIT PROFILE</button> </h2>
                <div class="profile_details">  
                  <div>First Name:</div>
                  <div><?= $Auth->name?></div>
                  <div>Mobile No.:</div>
                  <div><em><?= $Auth->phone?></em></div>
                  <div>Email Address:</div>
                  <div><?= $Auth->email?></div>
                  <div>Country</div>
                  <div><?= $Auth->country->name?></div>
                  <div>Customer Since</div>
                  <div><?= date_format($Auth->created, 'j M, Y')?></div>
                  <div>Password:</div>
                  <div><b>**************</b></div>
                </div>
                <button>CHANGE PASSWORD</button>
             </div>
            <div class="edit_p2">
                <h2>EDIT PROFILE</h2>
                <div class="profile_details">
                  <?= $this->Form->create($user)?>
                    <?= $this->Form->control('name', ['value' => $Auth->name, 'label' => false])?>
                    <?= $this->Form->control('email', ['value' => $Auth->email, 'label' => false, 'readonly'])?>
                    <?= $this->Form->control('phone', ['value' => $Auth->phone, 'label' => false])?>
                    <?= $this->Form->control('country_id', ['value' => $Auth->country->id, 'label' => false, 'options' => $countries])?>
                    <button type="submit" name="requested_form" value="update_info">SAVE</button>
                    <button type="button">CANCEL</button>
                  <?= $this->Form->end()?>
                </div>
             </div>  
             <div class="edit_p3">
                <h2>CHANGE PASSWORD</h2>
                <div class="profile_details">
                  <?= $this->Form->create(null)?>
                    <input type="password" placeholder="Enter current password" name="c_password">
                    <input type="password" placeholder="Enter new password" name="new_password">
                    <input type="password" placeholder="Confirm new password" name="confirm_new_password">
                    <button class="change_btn" type="submit" name="requested_form" value="change_password">CHANGE PASSWORD</button>
                    <button type="button">CANCEL</button>
                  <?= $this->Form->end()?>
                </div>
             </div>  
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
    $(".edit_p1>h2>button").click(function(){
      $(".edit_p1").addClass("active");
      $(".edit_p2").addClass("active");
    });
    $(".edit_p2 .profile_details form>button[type=button]").click(function(){
      $(".edit_p1").removeClass("active");
      $(".edit_p2").removeClass("active");
    });
    $(".edit_p1>button").click(function(){
      $(".edit_p1").addClass("active");
      $(".edit_p3").addClass("active");
    });
    $(".edit_p3 .profile_details form>button[type=button]").click(function(){
      $(".edit_p1").removeClass("active");
      $(".edit_p3").removeClass("active");
    });
});
<?php $this->Html->scriptEnd()?>