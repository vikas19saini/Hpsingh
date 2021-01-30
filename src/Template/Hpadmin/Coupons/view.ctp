<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coupon $coupon
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Coupon'), ['action' => 'edit', $coupon->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Coupon'), ['action' => 'delete', $coupon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coupon->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coupons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coupon'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coupons view large-9 medium-8 columns content">
    <h3><?= h($coupon->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($coupon->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($coupon->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($coupon->modified) ?></td>
        </tr>
    </table>
</div>
