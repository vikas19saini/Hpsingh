<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<div class="main_user">
    <form method="get">
        <div class="user_section">
            <h2>Tags <input name="search" placeholder="Search Tags">  </h2>        
        </div>
    </form>
    
        <div class="error" id="errorDisplay">
            <span class="error_cls" id="displaySingleError">&times;</span>
        </div>
    

    <div class="add_categories">
        <?= $this->Form->create($tag, ['url' => ['action' => 'add'], 'class' => 'categories_left', 'onsubmit' => 'hpAdmin.saveNewTag(this, event)'])?>
        <h2>Add New Tag</h2>
        <div class="form-group">
                <?= $this->Form->control('name', ['autocomplete' => 'off'])?>
            <p class="specification">The name is how it appears on your site.</p>
        </div> 
        <div class="form-group">
                <?= $this->Form->control('slug', ['autocomplete' => 'off', 'required' => false])?>
            <p class="specification">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
        </div>
        <div class="form-group">
                <?= $this->Form->control('description', ['autocomplete' => 'off'])?>
            <p class="specification">The description is not prominent by default;</p>
        </div>
        <div class="form-group">
                <?= $this->Form->control('meta_title', ['autocomplete' => 'off'])?>
            <p class="specification">The SEO title;</p>
        </div>
        <div class="form-group">
                <?= $this->Form->control('meta_description', ['autocomplete' => 'off'])?>
            <p class="specification">The SEO meta description;</p>
        </div>
        <div class="form-group">
                <?= $this->Form->control('meta_keywords', ['autocomplete' => 'off'])?>
            <p class="specification">The SEO meta keywords;</p>
        </div>
        <div class="form-group clearfix">
                <?= $this->Form->button('Add New Tag', ['type' => 'submit'])?>
        </div>
        <?= $this->Form->end()?>

        <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'class' => 'categories_right'])?>
        <div class="country-options">
            <div class="bulk_category">
                <?= $this->Form->select('action', ['none' => 'Bulk Actions', 'delete' => 'Delete'])?>
                <?= $this->Form->button('Apply', ['class' => 'user_btn2', 'type' => 'submit'])?>
            </div>

            <div class="media_pagination">                
                <span><?= $this->Paginator->params()['count']?> Items</span>
                        <?= $this->Paginator->first('<button title="First page" type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false])?>                
                        <?= $this->Paginator->prev('<button title="Previous page" type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]);?>
                <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" type="text" min="1" max="<?= $this->Paginator->total()?>" value="<?= $this->Paginator->current()?>">
                <span>of <?= $this->Paginator->total();?></span>
                        <?= $this->Paginator->next('<button title="Next page" type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]);?>
                        <?= $this->Paginator->last('<button title="Last page" type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false])?>
            </div>
        </div>
        <div class="category_details">
            <input type="checkbox" name="itemId[]" value="-1" style="display: none" checked="true">
            <table class="hptable">
                <thead>
                    <tr>
                        <td class="check">
                            <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                        </td>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Products</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($tags as $tag):?>
                    <tr>
                        <td><?= $this->Form->checkbox('itemId[]', ['hiddenField' => false, 'value' => $tag->id])?></td>
                        <td class="hidden_links">
                            <?= $tag->name?>
                            <span>ID: <?= $tag->id?> | <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tag->id])?></span>
                        </td>
                        <td><?= !empty($tag->description) ? $tag->description : '<hr/>'?></td>
                        <td><?= $tag->slug?></td>
                        <td><?= $tag->totalProducts?></td>
                    </tr>
                        <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                    <tr>
                        <td class="check">
                            <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                        </td>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th>Products</th>
                    </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?= $this->Form->end()?>
    </div>
</div>
