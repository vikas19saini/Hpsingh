<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="add_user active">
    <h2>Add/Edit Currency</h2>
    <?= $this->Form->create($currency)?>
    <div class="add_user_form">
        <div class="form-group">
            <?= $this->Form->control('code', ['label' => 'Currency Code', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('symbol', ['label' => 'Currency Icon', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('value', ['label' => 'Currency Value', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('is_default', ['label' => 'Content', 'options' => ['yes' => 'Default', 'no' => 'Not Default']])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('country_code', ['label' => 'Country Code'])?>
        </div>
        <div class="form-group_btn">
            <?= $this->Form->button(__('Save'))?>
        </div>
    </div>
    <?= $this->Form->end()?>
</div>
