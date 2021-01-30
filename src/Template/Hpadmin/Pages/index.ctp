<?php ?>

<div class="main_user">
    <div class="user_section">
        <h2>All Pages <span><?= $this->Html->link(__('Add New'), ['action' => 'add'])?></span> </h2>
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
                    <th>Slug</th>
                    <th>Template</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Meta Keywords</th>
                    <th>Is Home</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages as $page):?>
                <tr>
                        <td class="check">
                            <input type="checkbox" name="itemId[]" value="<?= $page->id?>">
                        </td>
                        <td>
                            <?= $page->slug?>
                        </td>
                        <td>
                            <?= str_replace('_', ' ', ucwords(explode('.', $page->template)[0]))?>
                        </td>
                        <td>
                            <?= empty($page->meta_title) ? '--' : $page->meta_title?>
                        </td>
                        <td>
                            <?= empty($page->meta_description) ? '--' : $page->meta_description?>
                        </td>
                        <td>
                            <?= empty($page->meta_keywords) ? '--' : $page->meta_keywords?>
                        </td>
                        <td>
                            <?= $page->is_home?>
                        </td>
                        <td>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $page->id])?>
                            | <?= $this->Html->link('View', ['_name' => 'pages', $page->slug], ['target' => '_blank'])?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>Slug</th>
                    <th>Template</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Meta Keywords</th>
                    <th>Is Home</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
