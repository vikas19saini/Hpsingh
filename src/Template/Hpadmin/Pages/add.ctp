<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="add_user active">
    <h2>Add/Edit Page</h2>
    <?= $this->Form->create($page)?>
    <div class="add_user_form">
        <div class="form-group">
            <?= $this->Form->control('slug', ['label' => 'Page Slug', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('meta_title', ['label' => 'Meta Title', 'autocomplete' => 'off', 'type' => 'textarea', 'style' => 'width:100%'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('meta_description', ['label' => 'Meta Description', 'autocomplete' => 'off', 'type' => 'textarea', 'style' => 'width:100%'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('meta_keywords', ['label' => 'Meta Keywords', 'type' => 'textarea', 'style' => 'width:100%'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('template', ['label' => 'Template', 'options' => $templates])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('is_home', ['label' => 'Is Home Page', 'options' => ['no' => 'Set as landing page', 'yes' => 'Set as home page']])?>
        </div>
        <div class="form-group_btn">
            <?= $this->Form->button(__('Save'))?>
        </div>
    </div>
    <?= $this->Form->end()?>
</div>
