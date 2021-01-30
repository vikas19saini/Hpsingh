<?php
    $this->assign('bodyClass', 'myAccount-page');
    $this->assign('title', 'Addresses - Hpsingh');
    $this->assign('css', $this->Html->css('select2.min'));
    $this->assign('script', $this->Html->script('select2.min'));
?>

<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">
    <section class="myaccount">
        <div class="container">
            <div class="row">
          <?= $this->Element('customer/navigation')?>
                <!--- Address -->
                <div class="address_area active">
                    <div class="save_address">
                        <h2>SAVED ADDRESSES <button type="button"><i class="fa fa-plus"></i> ADD NEW ADDRESS</button> </h2>
                        <?php if($addresses->count() > 0): foreach ($addresses as $oneadd):?>
                        <div class="address">
                            <p>MY ADDRESS <button type="button" class="<?= ($oneadd->label === 'home') ? 'add_home' : 'add_office'?>"><?= strtoupper($oneadd->label)?></button> </p>
                            <p><?= $oneadd->name?><?= $this->Form->postButton('REMOVE', ['action' => 'deleteAddress', $oneadd->id], ['confirm' => 'Are you sure'])?> </p>
                            <p><span><?= $oneadd->address?>, <?= $oneadd->city?> <em><?= $oneadd->postcode?></em> <?= $oneadd->zone->name?>, <?= $oneadd->country->name?> <br>Mobile: <em><?= $oneadd->phone?></em></span> <a href="<?= $this->Url->build(['action' => 'editAddress', $oneadd->id])?>">EDIT</a> </p>
                            <div class="mob_btn"><?= $this->Form->postButton('REMOVE', ['action' => 'deleteAddress', $oneadd->id], ['confirm' => 'Are you sure'])?> <button onclick="window.location.href='<?= $this->Url->build(['action' => 'editAddress', $oneadd->id], true)?>'">EDIT</button></div>
                        </div>
                        <?php endforeach;?>
                        <?php else:?>
                        <h2 style="text-align: center;margin-top: 5%"> NO ADDRESS FOUND</h2>
                        <?php endif;?>
                    </div>


                    <?= $this->Form->create($address, ['class' => 'add_address_area'])?>
                    <?php $this->Form->unlockField('label'); $this->Form->setTemplates(['inputContainer' => '{{content}}'])?>
                    <h2>ADD NEW ADDRESS <button type="button">SAVED ADDRESSES </button></h2>
                        <div class="add_address">                            
                            <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Full name'])?>
                            <?= $this->Form->control('phone', ['label' => false, 'placeholder' => 'Mobile no'])?>
                            <?= $this->Form->control('postcode', ['label' => false, 'placeholder' => 'Pincode/Postcode'])?>
                            <?= $this->Form->control('country_id', ['label' => false, 'empty' => 'Select Country', 'options' => $countries])?>
                            <?= $this->Form->control('zone_id', ['label' => false, 'empty' => 'Select State', 'options' => $zones])?>
                            <?= $this->Form->control('city', ['label' => false, 'placeholder' => 'City'])?>
                            <?= $this->Form->control('address', ['label' => false, 'placeholder' => 'Complete address', 'type' => 'text'])?>
                            <div class="gender2">
                                <span>Type of Address:</span>
                                <input type="radio" name="label" value="office"> Office
                                <input type="radio" name="label" value="home"> Home
                                <input type="radio" name="label" value="other"> Other
                            </div>
                            <button type="submit">SAVE</button>
                            <button type="button">CANCEL</button>
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
    $(".save_address>h2>button[type=button]").click(function(){
      $(".add_address_area").addClass("active");
      $(".save_address").addClass("active"); 
      $(".address_area").addClass("active2");
    });
    $(".add_address_area>h2>button[type=button], .add_address_area>.add_address>button[type=button]").click(function(){
      $(".add_address_area").removeClass("active");
      $(".save_address").removeClass("active");
      $(".address_area").removeClass("active2");
    });
    $('#country-id').select2({
      width: '33.33%',
      placeholder: 'Select Country',
   });
   $('#zone-id').select2({
      width: '33.33%',
      placeholder: 'Select State',
   });
});
<?php $this->Html->scriptEnd()?>