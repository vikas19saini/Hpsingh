<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>All Sliders <span><?= $this->Html->link(__('Add New'), ['action' => 'add'])?></span> </h2>
    </div>
    <div class="user_bulk product-controls">
        <div class="bulk_user1">
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
                    <th class="author">Code</th>
                    <th class="product">Value</th>
                    <th class="comment"><b>Is Default</b></th>
                    <th class="author">Country Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currencies as $currency):?>
                <tr>
                        <td class="author">
                            <?= $currency->code?>
                        </td>
                        <td>
                            <?= $currency->value?>
                        </td>
                        <td>
                            <?= ucwords($currency->is_default)?>
                        </td>
                        <td>
                            <?= $currency->country_code?>
                        </td>
                        <td>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $currency->id])?>
                            <?= $this->Form->postLink('Delete', ['action' => 'delete', $currency->id], ['confirm' => 'Are you sure.'])?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="author">Code</th>
                    <th class="product">Value</th>
                    <th class="comment"><b>Is Default</b></th>
                    <th class="author">Country Code</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
