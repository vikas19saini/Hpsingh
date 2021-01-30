<?php
error_reporting(0);
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color[]|\Cake\Collection\CollectionInterface $colors
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Colors
            <span><?= $this->Html->link(__('New Color'), ['action' => 'add']) ?></span>
        </h2>
    </div>
    <div class="bulk_category">
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['delete' => 'Delete'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <?= $this->Form->end()?>
        <span><?= count($colors)?> items</span>
    </div><br/>
    <div class="colors index large-9 medium-8 columns content">
        <table cellpadding="0" cellspacing="0" class="hptable">
            <thead>
                <tr>
                    <th scope="col" class="check">
                        <input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('color_code', ['title' => 'Color']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($colors as $color): ?>
                <tr>
                    <td class="check">
                        <input type="checkbox" name="itemId[]" value="<?= $color->id?>">
                    </td>
                    <td><?= h($color->name) ?></td>
                    <td style="background-color: <?= $color->color_code?>"><code><?= h($color->color_code) ?></code></td>
                    <td><?= h($color->created) ?></td>
                    <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $color->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $color->id], ['confirm' => __('Are you sure you want to delete # {0}?', $color->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col" class="check">
                        <input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('color_code', ['title' => 'Color']) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </tfoot>
        </table>
        <div class="paginator">
            <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
                <li><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></li>
            </ul>
            <p></p>
        </div>
    </div>
</div>
