<?php ?>

<div class="main_user">
    <div class="user_section">
        <h2>All Enquiries </h2>
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
            <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" type="text" min="1" max="<?= $this->Paginator->total()?>" value="<?= $this->Paginator->current()?>">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Regarding/Qty</th>
                    <th>Preffered Browsing Tool</th>
                    <th>Preffered Date</th>
                    <th>Message</th>
                    <th>Reference</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enquiries as $enquiry):?>
                <tr>
                        <td class="check">
                            <input type="checkbox" name="itemId[]" value="<?= $enquiry->id?>">
                        </td>
                        <td>
                            <?= $enquiry->name?>
                        </td>
                        <td>
                            <?= $enquiry->email?>
                        </td>
                        <td>
                            <?= $enquiry->phone?>
                        </td>
                        <td>
                            <?= $enquiry->req_type?>
                        </td>
                        <td>
                            <?= $enquiry->tool?>
                        </td>
                        <td>
                            <?= $enquiry->date?>
                        </td>
                        <td>
                            <?= $enquiry->message?>
                        </td>
                        <td>
                            <?php if(empty($enquiry->reference)):?>
                            <span class="dashicons dashicons-format-image"></span>
                            <?php else:?>
                            <a target="_blank" href="<?= BASE . 'files/Enquiries/reference/' . $enquiry->reference?>">
                                <img src="<?= BASE . 'files/Enquiries/reference/' . $enquiry->reference?>" width="50px">
                            </a>
                            <?php endif;?>
                        </td>
                        <td>
                            <?= date_format($enquiry->created, 'D d M, Y h:i:s A')?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Regarding/Qty</th>
                    <th>Preffered Browsing Tool</th>
                    <th>Preffered Date</th>
                    <th>Message</th>
                    <th>Reference</th>
                    <th>Created</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
