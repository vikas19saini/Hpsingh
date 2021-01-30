<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Edit Tag: <i><?= $tag->name?></i></h2>
    </div>
    <div class="add_categories">
        <?= $this->Form->create($tag, ['class' => 'categories_left edit'])?>
            <div class="form-group">
                <?= $this->Form->control('name', ['autocomplete' => 'off'])?>
                <p class="specification">The name is how it appears on your site.</p>
            </div> 
            <div class="form-group">
                <?= $this->Form->control('slug', ['autocomplete' => 'off'])?>
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
                <?= $this->Form->button('Save Changes', ['type' => 'submit'])?>
            </div>
        <?= $this->Form->end()?>
    </div>
</div>
