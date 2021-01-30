<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="add_user active">
    <h2>Add New User</h2>
    <p>Create a brand new user and add them to this site.</p>
    <?= $this->Form->create($user)?>
        <div class="add_user_form">
        <div class="form-group">
            <?= $this->Form->control('name', ['label' => 'Name (required)', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('email', ['label' => 'Email Address (required)', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('phone', ['label' => 'Contact Number (required)', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('user_group', ['label' => 'Role', 'options' => ['adminiatrator' => 'Adinistrator', 'customer' => 'Customer']])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('password', ['label' => 'Password (required)', 'autocomplete' => 'off', 'type' => 'password', 'minlength' => '8'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('password_retype', ['label' => 'Re-enter Password (required)', 'autocomplete' => 'off', 'required' => 'true', 'type' => 'password', 'minlength' => '8'])?>
        </div>
        <div class="form-group_btn">
            <?= $this->Form->button(__('Add New User'))?>
        </div>
    </div>
    <?= $this->Form->end()?>
</div>
