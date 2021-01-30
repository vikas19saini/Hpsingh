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
                    <?= $this->Form->create($address, ['class' => 'add_address_area active'])?>
                    <?php $this->Form->unlockField('label'); $this->Form->setTemplates(['inputContainer' => '{{content}}'])?>
                    <h2>EDIT ADDRESS</h2>
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
                                <input type="radio" name="label" value="office" <?= ($address->label === 'office') ? 'checked' : ''?>> Office
                                <input type="radio" name="label" value="home" <?= ($address->label === 'home') ? 'checked' : ''?>> Home
                                <input type="radio" name="label" value="other" <?= ($address->label === 'other') ? 'checked' : ''?>> Other
                            </div>
                            <button type="submit">SAVE</button>
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
    $('#country-id').select2({
      width: '31%',
      placeholder: 'Select Country',
   });
   $('#zone-id').select2({
      width: '31%',
      placeholder: 'Select State',
   });
});
<?php $this->Html->scriptEnd()?>