<?php ?>

<div class="main_user">
    <div class="user_section">
        <h2>All Shipping Zones
            <span><?= $this->Html->link(__('Add New'), ['action' => 'add'])?></span>
            <span class="import">Import</span>
        </h2>
    </div>

    <!-- Displaying errors -->
    <div class="error" id="errorDisplay">
        <span class="error_cls" id="displaySingleError">×</span>
    </div>
    <!-- Displaying errors end -->

    <div class="media_upload">
        <?= $this->Form->create(null, ['url' => ['controller' => 'ShippingZones', 'action' => 'import'], 'type' => 'file', 'id' => 'import-form', 'onsubmit' => 'hpAdmin.importPostcodes(this, event)'])?>
        <div class="import_section">
            <h2>Upload file to import postcodes</h2>
            <label class="label">
                <?= $this->Form->checkbox('import-type', ['value' => 'append', 'style' => 'top:5px'])?> Append postcodes to current list.
            </label>
        </div>
        <div class="image-upload">
            <label for="file-input">
                <i aria-hidden="true">Choose File</i>
            </label>
            <?= $this->Form->file('postcodeFile', ['id' => 'file-input', 'onchange' => "$('#import-form').submit()"])?>
        </div>
        <span class="upload_cls">&times;</span>
        <?= $this->Form->end()?>
    </div>

    <div class="user_bulk product-controls">
        <div class="bulk_user2 suggesions full-width">
            <form method="get">
                <input type="text" name="search" autocomplete="off" value="<?= $this->request->getQuery('search')?>">
                <button type="submit">Search Postcode</button>
            </form>
        </div>
        <div class="media_pagination full-width">
            <span><?= $this->Paginator->params()['count']?> Items</span>
                    <?= $this->Paginator->first('<button type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false])?>
                    <?= $this->Paginator->prev('<button type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]);?>
            <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" min="1" type="text" max="<?= $this->Paginator->total()?>" value="<?= $this->Paginator->current()?>">
            <span>of <?= $this->Paginator->total();?></span>
                    <?= $this->Paginator->next('<button type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]);?>
                    <?= $this->Paginator->last('<button type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false])?>
        </div>
        <div class="bulk_user3 product-options"><br/>
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['delete' => 'Delete'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <a style="border: 1px solid #a9aeb3;background: #f7f7f7;padding: 2px 10px;" href="<?= $this->Url->build(['action' => 'deleteAll'])?>" type="button" onclick="return confirm('Are you sure, You want to delete all postcodes.')">Delete All</a>
            <?= $this->Form->end()?>
        </div>
    </div>

    <div class="user_details product_details">
        <table class="hptable">
            <thead>
                <tr>
                    <td class="check">
                        <input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </td>
                    <th>Postcode</th>
                    <th>COD Available</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shippingZones as $zone):?>
                <tr>
                    <td class="check">
                        <input type="checkbox" name="itemId[]" value="<?= $zone->id?>">
                    </td>
                    <td>
                            <?= $zone->postcode?>
                    </td>
                    <td>
                        <?= strtoupper($zone->cod)?>
                    </td>
                    <td>
                            <?= strtoupper($zone->availability)?>
                    </td>
                    <td>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $zone->id])?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>Postcode</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?= $this->Html->scriptStart(['block' => true])?>
$(document).ready(function () {
$(".import").click(function () {
$(".media_upload").toggleClass("active");
});
$(".upload_cls").click(function () {
$(".media_upload").removeClass("active");
});
});
<?= $this->Html->scriptEnd()?>
