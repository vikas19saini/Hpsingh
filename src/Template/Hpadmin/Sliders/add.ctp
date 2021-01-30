<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="add_user active">
    <h2>Add New Slider</h2>
    <?= $this->Form->create($slider)?>
    <div class="add_user_form">
        <div class="form-group">
            <?= $this->Form->control('type', ['label' => 'Slider Position', 'autocomplete' => 'off', 'options' => ['homepage-main-slider' => 'Home Page Main Slider', 'mygrams' => 'Homepage Mygram', 'bulk-wholesale' => 'Bulk Wholesale', 'deals' => 'Deals', 'popup' => 'Popup Image']])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('sort', ['label' => 'Sort Order', 'autocomplete' => 'off'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('status', ['label' => 'Status', 'autocomplete' => 'off', 'options' => ['active' => 'Active', 'inactive' => 'Not Active']])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('content', ['label' => 'Content', 'type' => 'textarea', 'style' => 'width:100%'])?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('uri', ['label' => 'Link URL', 'style' => 'width:100%'])?>
        </div>
        <div class="form-group">
            <label>Slider Image</label>
            <div class="categoryThumbnail clearfix">
                <div id="selected-media">
                        <?php if(isset($slider->media->url)):?>
                    <div>
                            <?= $this->Media->the_image('thumbnail', $slider->media->url)?>
                        <span onclick="hpAdmin.removeMedia('<?= $slider->media_id?>', 'media_id', this)">&times;</span>
                    </div>
                        <?php else:?>
                        <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix'])?>
                        <?php endif;?>
                </div>
                <button type="button" onclick="hpAdmin.mediaChooser('media_id', 'selected-media')">Upload/Add Image</button>
            </div>
        </div>
        <div class="form-group">
            <label>Slider Mobile Image</label>
            <div class="categoryThumbnail clearfix">
                <div id="selected-mobile-media">
                        <?php if(isset($slider->mobile_media->url)):?>
                    <div>
                            <?= $this->Media->the_image('thumbnail', $slider->mobile_media->url)?>
                        <span onclick="hpAdmin.removeMedia('<?= $slider->mobile_media_id?>', 'mobile_media_id', this)">&times;</span>
                    </div>
                        <?php else:?>
                        <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix'])?>
                        <?php endif;?>
                </div>
                <button type="button" onclick="hpAdmin.mediaChooser('mobile_media_id', 'selected-mobile-media')">Upload/Add Image</button>
            </div>
        </div>
        <?= $this->Form->control('media_id', ['type' => 'text', 'style' => 'display:none', 'label' => false])?>
        <?= $this->Form->control('mobile_media_id', ['type' => 'text', 'style' => 'display:none', 'label' => false])?>
        <div class="form-group_btn">
            <?= $this->Form->button(__('Save'))?>
        </div>
    </div>
    <?= $this->Form->end()?>
</div>
