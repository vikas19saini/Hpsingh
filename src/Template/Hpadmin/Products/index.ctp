<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Products 
            <span><?= $this->Html->link(__('Add New'), ['action' => 'add'])?></span>
        </h2>
    </div>
    
    <!-- Displaying errors -->
    <div class="error" id="errorDisplay">
        <span class="error_cls" id="displaySingleError">×</span>
    </div>
    <!-- Displaying errors end -->

    <div class="user_bulk product-controls">
        <div class="bulk_user2 suggesions full-width" id="product-suggesions">
            <form method="get">
                <input type="text" name="search" autocomplete="off" value="<?= $this->request->getQuery('search')?>">
                <button type="submit">Search Products</button>
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
        <div class="bulk_user1">
            <?= $this->Element('admin/filters')?>
        </div>
        <div class="bulk_user3 product-options full-width">
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['trash' => 'Move To Trash', 'in_stock' => 'In Stock', 'out_of_stock' => 'Out of Stock', 'published' => 'Publish', 'drafts' => 'Move To Drafts', 'delete' => 'Delete Permanently'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <?= $this->Form->end()?>
            <form method="get">
                <?= $this->Form->control('cat_id', ['value' => $this->request->getQuery('cat_id'), 'empty' => 'Filter by category', 'options' => $allCategories, 'label' => false, 'escape' => false])?>
                <?= $this->Form->control('stock', ['value' => $this->request->getQuery('stock'), 'empty' => 'Filter by stock status', 'options' => ['in_stock' => 'In Stock', 'out_of_stock' => 'Out of Stock'], 'label' => false, 'escape' => false])?>
                <button type="submit">Filter</button>
            </form>
        </div>
    </div>

    <div class="user_details product_details">
        
        <table class="hptable">
            <thead>
                <tr>
                    <td class="check">
                        <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </td>
                    <th><span style="top: 0px" class="dashicons dashicons-format-image"></span></th>
                    <th><?= $this->Paginator->sort('name')?></th>
                    <th><?= $this->Paginator->sort('quantity')?></th>
                    <th>Stock</th>
                    <th><?= $this->Paginator->sort('ragular_price', ['text' => 'Price'])?></th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th><?= $this->Paginator->sort('created')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product):?>
                <tr>
                    <td><?= $this->Form->checkbox('itemId[]', ['hiddenField' => false, 'value' => $product->id])?></td>
                    <td>
                         <?php if(isset($product->featured_image->url) && !empty($product->featured_image->url)):?>
                            <?= $this->Media->the_image('thumbnail', $product->featured_image->url, ['width' => '40px'])?>
                        <?php else:?>
                        <i style="top:0px" class="dashicons dashicons-format-image"></i>
                        <?php endif;?>
                    </td>
                    <td class="hidden_links">
                        <?= !empty($product->name) ? $product->name : '<hr/>'?>
                        <?php if($status == 'trash'):?>
                        <span><b>ID:<?= $product->id?></b> | <?= $this->Form->postLink(__('Restore'), ['action' => 'restore', $product->id]) ?> | 
                                    <?= $this->Form->postLink(__('Delete Permanently'), ['action' => 'delete_permanently', $product->id], ['confirm' => __('Are you sure you want to permanently delete # {0}?', $product->id)]) ?>
                        </span>
                        <?php else:?>
                        <span><b>ID:<?= $product->id?></b> | <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id])?> | 
                                    <?php if($product->status === 'published'):?>
                                    <?= $this->Html->link(__('View'), ['_name' => 'product', $product->slug], ['target' => '_blank'])?> | 
                                    <?php endif;?>
                                    <?= $this->Form->postLink(__('Trash'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to trash # {0}?', $product->id)]) ?>
                        </span>
                        <?php endif;?>
                    </td>
                    <td><?= !empty($product->quantity) ? $product->quantity : '<hr/>'?></td>
                    <td><?= str_replace('_', ' ', $product->stock)?></td>
                    <td><?= $this->Product->the_price($product->ragular_price, $product->sale_price)?></td>
                    <td class="author"><?= $this->Product->categories($product->categories)?></td>
                    <td class="author"><?= $this->Product->tags($product->tags)?></td>
                    <td> <?= $this->Product->the_date($product->status, $product->created)?></td>
                </tr>
                <?php endforeach;?>
            </tbody>                
            <tfoot>
                <tr>
                    <td class="check">
                        <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </td>
                    <th><span style="top: 0px;" class="dashicons dashicons-format-image"></span></th>
                    <th><?= $this->Paginator->sort('name')?></th>
                    <th><?= $this->Paginator->sort('quantity')?></th>
                    <th>Stock</th>
                    <th><?= $this->Paginator->sort('ragular_price', ['text' => 'Price'])?></th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th><?= $this->Paginator->sort('created')?></th>
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

<script>
    window.onload = () => {
        $('select[name=cat_id]').select2({
            placeholder: 'Filter by category',
            allowClear: true,
        });
        $('select[name=stock]').select2({
            placeholder: 'Filter by stock status',
            allowClear: true,
        });
        $('select[name=action]').select2({
            placeholder: 'Bulk Actions',
            allowClear: true,
        });
    }
</script>