<?php ?>

<div class="main_user">
    <div class="user_section">
        <h2>All Subscribers</h2>
    </div>
    <div class="user_bulk product-controls">
        <div class="bulk_user1">
        </div>
        <div class="bulk_user3 product-options"><br/>
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['delete' => 'Delete'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <?= $this->Form->end()?>
        </div>
        <div class="media_pagination">                
            <span><?= $this->Paginator->params()['count']?> Items</span>
                    <?= $this->Paginator->first('<button type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false])?>                
                    <?= $this->Paginator->prev('<button type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]);?>
            <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" min="1" type="text" max="<?= $this->Paginator->total()?>" value="<?= $this->Paginator->current()?>">
            <span>of <?= $this->Paginator->total();?></span>
                    <?= $this->Paginator->next('<button type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]);?>
                    <?= $this->Paginator->last('<button type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false])?>
        </div>
    </div>

    <div class="user_details product_details">
        <table class="hptable">
            <thead>
                <tr>
                    <td class="check">
                        <input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </td>
                    <th><?= $this->Paginator->sort('Name')?></th>
                    <th><?= $this->Paginator->sort('email')?></th>
                    <th><?= $this->Paginator->sort('created')?></th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscribers as $subscriber):?>
                <tr>
                        <td class="check">
                            <input type="checkbox" name="itemId[]" value="<?= $subscriber->id?>">
                        </td>
                        <td>
                            <?= $subscriber->name?>
                        </td>
                        <td>
                            <?= $subscriber->email?>
                        </td>
                        <td>
                            <?= date_format($subscriber->created, 'D d M, Y h:i:s A')?>
                        </td>
                        <td>
                            <?= $this->Form->postLink('Delete', ['action' => 'delete', $subscriber->id], ['confirm' => 'Want to delete "' . $subscriber->email . '" from list?'])?>
                        </td>
                    </tr>
                <?php endforeach;?>
                
                    <?php if($subscribers->isEmpty()):?>
                    <tr>
                        <td colspan="5">
                            No subscriers found!
                        </td>
                    </tr>
                    <?php endif;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th><?= $this->Paginator->sort('Name')?></th>
                    <th><?= $this->Paginator->sort('email')?></th>
                    <th><?= $this->Paginator->sort('created')?></th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
