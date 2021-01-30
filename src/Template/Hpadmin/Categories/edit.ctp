<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Edit Category: <i><?= $category->name ?></i></h2>
    </div>
    <div class="error" id="errorDisplay">
        <span class="error_cls" id="displaySingleError">&times;</span>
    </div>
    <div class="add_categories">
        <?= $this->Form->create($category, ['class' => 'categories_left edit']) ?>
        <div class="form-group">
            <?= $this->Form->control('name', ['autocomplete' => 'off']) ?>
            <p class="specification">The name is how it appears on your site.</p>
        </div>
        <div class="form-group">
            <?= $this->Form->control('slug', ['autocomplete' => 'off']) ?>
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
            <label>Icon Image</label>
            <div class="categoryThumbnail clearfix">
                <div id="selected-media">
                    <?php if (isset($category->media->url)): ?>
                        <div>
                            <?= $this->Media->the_image('thumbnail', $category->media->url) ?>
                            <span
                                onclick="hpAdmin.removeMedia('<?= $category->media_id ?>', 'media_id', this)">&times;</span>
                        </div>
                    <?php else: ?>
                        <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix']) ?>
                    <?php endif; ?>
                </div>
                <button type="button" onclick="hpAdmin.mediaChooser('media_id', 'selected-media')">Upload/Add Image
                </button>
            </div>
        </div>
        <div class="form-group">
            <label>Subcategory Image</label>
            <div class="categoryThumbnail clearfix">
                <div id="selected-subcategory-media">
                    <?php if (isset($category->subcategory_image->url)): ?>
                        <div>
                            <?= $this->Media->the_image('thumbnail', $category->subcategory_image->url) ?>
                            <span
                                onclick="hpAdmin.removeMedia('<?= $category->media_for_subcategory ?>', 'media_for_subcategory', this)">&times;</span>
                        </div>
                    <?php else: ?>
                        <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix']) ?>
                    <?php endif; ?>
                </div>
                <button type="button"
                        onclick="hpAdmin.mediaChooser('media_for_subcategory', 'selected-subcategory-media')">Upload/Add
                    Image
                </button>
            </div>
        </div>
        <div class="form-group">
            <label>Banner</label>
            <div class="categoryThumbnail clearfix">
                <div id="selected-media-banner">
                    <?php if (isset($category->banner_image->url)): ?>
                        <div>
                            <?= $this->Media->the_image('thumbnail', $category->banner_image->url) ?>
                            <span
                                onclick="hpAdmin.removeMedia('<?= $category->banner ?>', 'banner', this)">&times;</span>
                        </div>
                    <?php else: ?>
                        <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix']) ?>
                    <?php endif; ?>
                </div>
                <button type="button" onclick="hpAdmin.mediaChooser('banner', 'selected-media-banner')">Upload/Add
                    Image
                </button>
            </div>
        </div>
        <?= $this->Form->control('media_id', ['type' => 'text', 'style' => 'display:none', 'label' => false]) ?>
        <?= $this->Form->control('media_for_subcategory', ['type' => 'text', 'style' => 'display:none', 'label' => false]) ?>
        <?= $this->Form->control('banner', ['type' => 'text', 'style' => 'display:none', 'label' => false]) ?>
        <div class="form-group clearfix">
            <?= $this->Form->button('Save Changes', ['type' => 'submit']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
