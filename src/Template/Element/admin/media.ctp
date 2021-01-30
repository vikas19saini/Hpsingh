<?php ?>

<?php foreach ($medias as $media):?>
            <div class="media_check" data-shorturl="<?= $media->url?>" data-id="<?= $media->id?>" data-alt="<?= $media->alt?>" data-caption="<?= $media->caption?>" data-title="<?= $media->title?>" data-url="<?= $this->Media->get_the_image_url('full', $media->url)?>" data-filename="<?= $media->name?>" data-filetype="<?= $media->type?>" data-created="<?= date_format($media->created, 'd M Y')?>">
                <?= $this->Media->the_image('thumbnail', $media->url)?>
                <label class="media_label">
                    <?= $this->Form->checkbox('mediaId[]', ['value' => $media->id, 'hiddenField' => false,])?>
                    <span class="checkmark"></span>
                </label>
            </div>
<?php endforeach;?>