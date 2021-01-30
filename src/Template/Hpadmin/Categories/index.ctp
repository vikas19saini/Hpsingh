<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Categories</h2>
    </div>
    <div class="error" id="errorDisplay">
        <span class="error_cls" id="displaySingleError">&times;</span>
    </div>
    <div class="add_categories">
        <?= $this->Form->create($category, ['url' => ['action' => 'add'], 'class' => 'categories_left', 'onsubmit' => 'hpAdmin.saveNewCategory(this, event)']) ?>
        <h2>Add New Category</h2>
        <div class="form-group">
            <?= $this->Form->control('name', ['autocomplete' => 'off']) ?>
            <p class="specification">The name is how it appears on your site.</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('slug', ['autocomplete' => 'off', 'required' => false]) ?>
            <p class="specification">The “slug” is the URL-friendly version of the name. It is usually all lowercase and
                contains only letters, numbers, and hyphens.</p>
        </div>

        <div class="form-group">
            <?= $this->Form->control('url', ['autocomplete' => 'off', 'required' => false]) ?>
            <p class="specification">Enter the url if you want to link this category with different url.</p>
        </div>

        <div class="form-group">
            <?= $this->Form->control('parent', ['options' => $parentCategories, 'empty' => 'None', 'escape' => false]) ?>
            <p class="specification">Assign a parent term to create a hierarchy. The term Jazz, for example, would be
                the parent of Bebop and Big Band.</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('description', ['autocomplete' => 'off']) ?>
            <p class="specification">The description is not prominent by default;</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('meta_title', ['autocomplete' => 'off']) ?>
            <p class="specification">The SEO title;</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('meta_description', ['autocomplete' => 'off']) ?>
            <p class="specification">The SEO meta description;</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('meta_keywords', ['autocomplete' => 'off']) ?>
            <p class="specification">The SEO meta keywords;</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('use_as', ['options' => ['category' => 'Fabric Category', 'wearing' => 'Wearing Category']]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('layout', ['options' => ['product' => 'Display products', 'category' => 'Display categories']]) ?>
        </div>
        <div class="form-group">
            <label>Thumbnail</label>
            <div class="categoryThumbnail clearfix">
                <div id="select-media">
                    <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix']) ?>
                </div>
                <button type="button" onclick="hpAdmin.mediaChooser('media_id', 'select-media')">Upload/Add Image
                </button>
            </div>
        </div>
        <div class="form-group">
            <label>Subcategory Image</label>
            <div class="categoryThumbnail clearfix">
                <div id="select-subcategory-media">
                    <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix']) ?>
                </div>
                <button type="button"
                        onclick="hpAdmin.mediaChooser('media_for_subcategory', 'select-subcategory-media')">Upload/Add
                    Image
                </button>
            </div>
        </div>
        <div class="form-group">
            <label>Banner</label>
            <div class="categoryThumbnail clearfix">
                <div id="select-media-banner">
                    <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix']) ?>
                </div>
                <button type="button" onclick="hpAdmin.mediaChooser('banner', 'select-media-banner')">Upload/Add Image
                </button>
            </div>
        </div>
        <?= $this->Form->control('media_id', ['value' => -1, 'type' => 'text', 'style' => 'display:none', 'label' => false]) ?>
        <?= $this->Form->control('media_for_subcategory', ['value' => -1, 'type' => 'text', 'style' => 'display:none', 'label' => false]) ?>
        <?= $this->Form->control('banner', ['value' => -1, 'type' => 'text', 'style' => 'display:none', 'label' => false]) ?>
        <div class="form-group clearfix">
            <?= $this->Form->button('Save', ['type' => 'submit']) ?>
        </div>
        <?= $this->Form->end() ?>
        <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'class' => 'categories_right']) ?>
        <!--<div class="category_search">
            <input type="text" name="search">
            <button>Search Categories</button>
        </div>-->
        <div class="bulk_category">
            <?= $this->Form->select('action', ['none' => 'Bulk Actions', 'delete' => 'Delete']) ?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2', 'type' => 'submit']) ?>
            <span><?= count($categories) ?> items</span>
        </div>
        <div class="category_details">
            <input type="checkbox" name="mediaId[]" value="-1" style="display: none" checked="true">
            <table class="hptable">
                <thead>
                <tr>
                    <td class="check">
                        <input type="checkbox" onclick="$('input[name*=\'mediaId\']').prop('checked', this.checked);">
                    </td>
                    <th><i class="dashicons dashicons-format-image" style="top: 0px"></i></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Count</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $this->Form->checkbox('mediaId[]', ['hiddenField' => false, 'value' => $category->id]) ?></td>
                        <td>
                            <?php if (isset($category->media->url)): ?>
                                <?= $this->Media->the_image('thumbnail', $category->media->url) ?>
                            <?php elseif (isset($category->subcategory_image->url)): ?>
                                <?= $this->Media->the_image('thumbnail', $category->subcategory_image->url) ?>
                            <?php else: ?>
                                <i class="dashicons dashicons-format-image" style="top: 0px"></i>
                            <?php endif; ?>
                        </td>
                        <td class="hidden_links">
                            <?= $category->name ?>
                            <span>ID: <?= $category->id ?> | <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id]) ?></span>
                        </td>
                        <td><?= !empty($category->description) ? $category->description : '<hr/>' ?></td>
                        <td><?= $category->slug ?></td>
                        <td><?= str_replace('Products', '', $this->Cell('Category::getProductsCount', [$category->id])) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                <tr>
                    <td class="check">
                        <input type="checkbox" onclick="$('input[name*=\'mediaId\']').prop('checked', this.checked);">
                    </td>
                    <th><i class="dashicons dashicons-format-image" style="top: 0px"></i></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Count</th>
                </tr>
                </tr>
                </tfoot>
            </table>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
