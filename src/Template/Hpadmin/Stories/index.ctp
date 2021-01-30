<?php ?>

<div class="main_user">
    <div class="user_section">
        <h2>All Stories <span><?= $this->Html->link(__('Add New'), ['action' => 'add'])?></span> </h2>
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
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stories as $story):?>
                <tr>
                        <td class="check">
                            <input type="checkbox" name="itemId[]" value="<?= $story->id?>">
                        </td>
                        <td>
                            <?= $story->title?>
                        </td>
                        <td>
                            <?= $story->slug?>
                        </td>
                        <td>
                            <?= $story->has('media') ? $this->Media->the_image('thumbnail', $story->media->url) : '<i style="top:0px" class="dashicons dashicons-format-image"></i>'?>
                        </td>
                        <td>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $story->id])?>
                            | <?= $this->Html->link('Delete', ['action' => 'delete', $story->id], ['confirm' => 'Are you sure?'])?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
