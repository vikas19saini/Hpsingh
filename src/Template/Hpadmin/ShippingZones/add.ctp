<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="add_user active">
    <h2>Add/Edit Shipping Zone Details</h2>
    <?= $this->Form->create($shippingZone)?>
    <div class="add_user_form">
        <div class="form-group">
            <?= $this->Form->control('postcode', ['label' => 'Postcode..', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('cod', ['label' => 'COD Available? ', 'options' => ['Yes' => 'Yes', 'No' => 'No']])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('availability', ['label' => 'Availability ', 'options' => ['Yes' => 'Yes', 'No' => 'No']])?>
        </div>
        <div class="form-group_btn">
            <?= $this->Form->button(__('Save'))?>
        </div>
    </div>
    <?= $this->Form->end()?>
</div>
