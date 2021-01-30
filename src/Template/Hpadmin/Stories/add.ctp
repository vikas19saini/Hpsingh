<?php

$scripts = $this->Html->script('https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest');
$this->assign('script', $scripts);

?>

<div class="product_section">
    <h2>Add Story</h2>
</div>

<?= $this->Form->create($story) ?>
<?= $this->Form->control('media_id', ['type' => 'text', 'style' => 'display:none', 'label' => false])?>
<div class="product_area">
    <div class="product_left" style="flex-basis: 100%">
        <?= $this->Form->control('title', ['label' => false, 'class' => 'product_title', 'placeholder' => 'Story title'])?>
        <div class="product_data">
            <div class="p_data">Story</div>
            <div class="p_data_text">
                <?= $this->Form->control('content', ['label' => false, 'placeholder' => 'Story title'])?>
            </div><br>
            <div class="form-group">
                <label>Story Image</label>
                <div class="categoryThumbnail clearfix">
                    <div id="selected-media">
                        <?php if(isset($story->media->url)):?>
                        <div>
                            <?= $this->Media->the_image('thumbnail', $story->media->url)?>
                            <span onclick="hpAdmin.removeMedia('<?= $story->media_id?>', 'media_id', this)">&times;</span>
                        </div>
                        <?php else:?>
                        <?= $this->Media->renderImage('img/image_placeholder.png', ['class' => 'category-thumbnail-fix'])?>
                        <?php endif;?>
                    </div>
                    <button type="button" onclick="hpAdmin.mediaChooser('media_id', 'selected-media')">Upload/Add Image</button>
                    <button type="submit">Save Story</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>

<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script>
                        window.onload = function () {
                            CKEDITOR.replace('content');
                        }
</script>
