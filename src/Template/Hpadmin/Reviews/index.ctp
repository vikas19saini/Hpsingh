<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2><?= $heading?></h2>
    </div>
    <div class="user_bulk product-controls">
        <div class="bulk_user1">
            <p>
                <?php if($status == ''):?>
                <b><?= $this->Html->link('All(' . $all . ')', ['action' => 'index'])?></b> | 
                <?php else:?>
                <?= $this->Html->link('All(' . $all . ')', ['action' => 'index'])?> | 
                <?php endif;?>
                
                <?php if($status == 'pending'):?>
                <b><a href="<?= $this->Paginator->generateUrl(['status' => 'pending'])?>">Pending(<?= $pending?>)</a></b> | 
                <?php else:?>
                <a href="<?= $this->Paginator->generateUrl(['status' => 'pending'])?>">Pending(<?= $pending?>)</a> | 
                <?php endif;?>
                
                <?php if($status == 'approved'):?>
                <b><a href="<?= $this->Paginator->generateUrl(['status' => 'approved'])?>">Approved(<?= $approved ?>)</a></b>
                <?php else:?>
                <a href="<?= $this->Paginator->generateUrl(['status' => 'approved'])?>">Approved(<?= $approved ?>)</a>
                <?php endif;?>
            </p>
        </div>
        <div class="bulk_user3 product-options"><br/>
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['delete' => 'Delete', 'approved' => 'Approve', 'pending' => 'Unapprove'], ['empty' => 'Bulk Actions'])?>
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
                    <td class="check"><input id="selectAllItems" type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th class="author"><?= $this->Paginator->sort('user_id', '<b>Author</b>', ['escape' => false])?></th>
                    <th class="product"><?= $this->Paginator->sort('product_id', '<b>Product</b>', ['escape' => false])?></th>
                    <th class="comment"><b>Review</b></th>
                    <th><?= $this->Paginator->sort('rating', '<b>Rating</b>', ['escape' => false])?></th>
                    <th><?= $this->Paginator->sort('status', '<b>Status</b>', ['escape' => false])?></th>
                    <th><?= $this->Paginator->sort('created', '<b>Submitted On</b>', ['escape' => false])?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review):?>
                <tr <?= $review->status == 'pending' ? 'class="review-unapproved"' : ''?>>
                        <td class="check">
                            <input type="checkbox" name="itemId[]" value="<?= $review->id?>">
                        </td>
                        <td>
                            <a href="<?= $this->Paginator->generateUrl(['user' => $review->user->id])?>">
                                <?= $review->user->name?>
                            </a><br>
                            <ul class="review-action">
                                <?php if($review->status === 'pending'):?>
                                <li>
                                    <?= $this->Form->postLink(__('Approve'), ['action' => 'approve', $review->id]) ?>
                                </li>
                                <?php endif;?>
                                <?php if($review->status === 'approved'):?>
                                <li>
                                    <?= $this->Form->postLink(__('Unapprove'), ['action' => 'unapprove', $review->id]) ?>
                                </li>
                                <?php endif;?>
                                <li>
                                    | <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $review->id], ['confirm' => __('Are you sure you want to permanently delete # {0}?', $review->id)]) ?>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <a href="<?= $this->Paginator->generateUrl(['product' => $review->product->id])?>">
                                <?= $review->product->name?>
                            </a>
                        </td>
                        <td><?= $review->comment?></td>
                        <td>
                            <div class="product-rating">
                            <?php $this->Product->displayReviewRating($review->rating)?>
                            </div>
                        </td>
                        <td><?= ucfirst($review->status)?></td>
                        <td><?= date_format($review->created, 'j M, Y'), '<br/>At ', date_format($review->created, 'h:m A')?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th class="author"><?= $this->Paginator->sort('user_id', '<b>Author</b>', ['escape' => false])?></th>
                    <th class="product"><?= $this->Paginator->sort('product_id', '<b>Product</b>', ['escape' => false])?></th>
                    <th class="comment"><b>Review</b></th>
                    <th><?= $this->Paginator->sort('rating', '<b>Rating</b>', ['escape' => false])?></th>
                    <th><?= $this->Paginator->sort('status', '<b>Status</b>', ['escape' => false])?></th>
                    <th><?= $this->Paginator->sort('created', '<b>Submitted On</b>', ['escape' => false])?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
