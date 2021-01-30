<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<div class="user_section">
    <h2>Add Redirection</h2>
</div>
<div class="colors form large-9 medium-8 columns content">
    <?= $this->Form->create($redirection, ['class' => 'categories_left edit']) ?>
    <fieldset>
        <legend><?= __('Details') ?></legend>
        <div class="form-group">
            <?= $this->Form->control('old_url', ['label' => 'Redirection From'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('new_url', ['label' => 'Redirection To'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('type', ['label' => 'Redirection Type', 'options' => ['301' => 301, '302' => 302]])?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
