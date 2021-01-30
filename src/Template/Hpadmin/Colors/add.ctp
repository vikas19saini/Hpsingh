<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color $color
 */
?>
<div class="user_section">
    <h2>Add Color</h2>
</div>
<div class="colors form large-9 medium-8 columns content">
    <?= $this->Form->create($color, ['class' => 'categories_left edit']) ?>
    <fieldset>
        <legend><?= __('Color Details') ?></legend>
        <div class="form-group">
            <?= $this->Form->control('name')?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('color_code', ['type' => 'color'])?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
