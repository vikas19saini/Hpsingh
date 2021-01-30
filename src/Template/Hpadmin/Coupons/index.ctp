<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coupon[]|\Cake\Collection\CollectionInterface $coupons
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Coupons 
            <span><?= $this->Html->link(__('Add New'), ['action' => 'add'])?></span>
        </h2>
    </div>

    <div class="user_bulk product-controls">
        <div class="bulk_user1">
            <?= $this->Element('admin/filters')?>
        </div>
        <div class="bulk_user2 suggesions" id="product-suggesions">
            <form method="get">
                <input type="text" name="search" autocomplete="off">
                <button type="submit">Search Products</button>
            </form>
        </div>
        <div class="bulk_user3 product-options">
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['published' => 'Publish', 'drafts' => 'Move To Drafts', 'trash' => 'Move To Trash'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <?= $this->Form->end()?>
            <div class="filter-section">
                <button>Show All Types</button>
                <div class="filters">
                    <a href="<?= $this->Paginator->generateUrl(['coupon_type' => 'percent'])?>">Percentage discount</a>
                    <a href="<?= $this->Paginator->generateUrl(['coupon_type' => 'fixed_cart'])?>">Fixed cart discount</a>
                    <a href="<?= $this->Paginator->generateUrl(['coupon_type' => 'fixed_product'])?>">Fixed product discount</a>
                </div>
            </div>
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
                    <th><?= $this->Paginator->sort('code', ['text' => 'Coupon Code'])?></th>
                    <th>Description</th>
                    <th>Coupon Type</th>
                    <th>Usage</th>
                    <th><?= $this->Paginator->sort('value')?></th>
                    <th>Products ID's</th>
                    <th>Categories ID's</th>
                    <th>Expiry date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coupons as $coupon):?>
                <tr>
                    <td class="check">
                        <?= $this->Form->checkbox('itemId[]', ['hiddenField' => false, 'value' => $coupon->id])?>
                    </td>
                    <td class="hidden_links">
                        <?= !empty($coupon->code) ? $coupon->code : '&#9866;&#9866;'?>
                        <?php if($status == 'trash'):?>
                        <span><?= $this->Form->postLink(__('Restore'), ['action' => 'restore', $coupon->id]) ?> | 
                                    <?= $this->Form->postLink(__('Delete Permanently'), ['action' => 'delete_permanently', $coupon->id], ['confirm' => __('Are you sure you want to permanently delete # {0}?', $coupon->id)]) ?>
                        </span>
                        <?php else:?>
                        <span><?= $this->Html->link(__('Edit'), ['action' => 'edit', $coupon->id])?> | 
                                    <?= $this->Form->postLink(__('Trash'), ['action' => 'delete', $coupon->id], ['confirm' => __('Are you sure you want to trash # {0}?', $coupon->id)]) ?>
                        </span>
                        <?php endif;?>
                    </td>
                    <td class="author"><?= !empty($coupon->description) ? $coupon->description : '<hr/>'?></td>
                    <td><?= str_replace('_', ' ', $coupon->type)?></td>
                    <td>
                        <?= count($coupon->orders)?> / 
                        <?php if(isset($coupon->usage_limit) && !empty($coupon->usage_limit)):?>
                            <?= $coupon->usage_limit?>
                        <?php else:?>
                            &#8734;
                        <?php endif;?>
                    </td>
                    <td><?= $coupon->value?></td>
                    <td><?= !empty($coupon->products) ? $coupon->products : '<hr/>'?></td>
                    <td><?= !empty($coupon->categories) ? $coupon->categories : '<hr/>'?></td>
                    <td> <?= date_format($coupon->expiry_date, 'j M, Y')?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th><?= $this->Paginator->sort('code', ['text' => 'Coupon Code'])?></th>
                    <th>Description</th>
                    <th>Coupon Type</th>
                    <th>Usage</th>
                    <th><?= $this->Paginator->sort('value')?></th>
                    <th>Products ID's</th>
                    <th>Categories ID's</th>
                    <th>Expiry date</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
