<?php
error_reporting(0);
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Color[]|\Cake\Collection\CollectionInterface $colors
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>All Redirection
            <span><?= $this->Html->link(__('Map New Redirection'), ['action' => 'add']) ?></span>
        </h2>
    </div>
    <div class="bulk_category">
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['delete' => 'Delete'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <?= $this->Form->end()?>
        <span><?= count($redirection)?> items</span>
    </div><br/>
    <div class="colors index large-9 medium-8 columns content">
        <table cellpadding="0" cellspacing="0" class="hptable">
            <thead>
                <tr>
                    <th scope="col" class="check">
                        <input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </th>
                    <th scope="col">Old URL</th>
                    <th scope="col">New URL</th>
                    <th scope="col">Redirection Type</th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($redirection as $redirection_one): ?>
                <tr>
                    <td class="check">
                        <input type="checkbox" name="itemId[]" value="<?= $redirection_one->id?>">
                    </td>
                    <td><?=  $redirection_one->old_url?></td>
                    <td><?= $redirection_one->new_url?></td>
                    <td><?= $redirection_one->type ?></td>
                    <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $redirection_one->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $redirection_one->id], ['confirm' => __('Are you sure you want to delete # {0}?', $redirection_one->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col" class="check">
                        <input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </th>
                    <th scope="col">Old Url</th>
                    <th scope="col">New Url</th>
                    <th scope="col">Redirection Type</th>
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
