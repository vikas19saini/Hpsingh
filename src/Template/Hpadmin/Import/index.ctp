<?php ?>

<div class="main_user">
    <div class="user_section">
        <h2>All Imports <span><?= $this->Html->link(__('Import New'), ['action' => 'add'])?></span></h2>
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
                        <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </td>
                    <th>File</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allImports as $import):?>
                <tr>
                        <td class="check">
                            <input type="checkbox" name="itemId[]" value="<?= $import->id?>">
                        </td>
                        <td class="author">
                            <a target="_blank" href="<?= BASE . 'imports' . DS . $import->name?>">Download File</a>
                        </td>
                        <td class="author">
                            <?= $import->type?>
                        </td>
                        <td>
                            <?= $this->Number->toReadableSize($import->size)?>
                        </td>
                        <td>
                            <?= date_format($import->created, 'r')?>
                        </td>
                        <td>
                            <?= date_format($import->modified, 'r')?>
                        </td>
                        <td class="author">
                            <?= $this->Html->link('View logs', ['action' => 'view', $import->id])?>
                            | <?= $this->Form->postLink('Undo', ['action' => 'rollback', $import->id], ['confirm' => 'Are you sure, all products will be permanently deleted?'])?>
                            | <?= $this->Form->postLink('Delete', ['action' => 'delete', $import->id], ['confirm' => 'Are you sure?'])?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check">
                        <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </td>
                    <th>File</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Created</th>
                    <th>Modified</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
