<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Media[]|\Cake\Collection\CollectionInterface $media
 */
?>

    <div class="media_section">
        <h2>Media Library <span>Add New</span></h2>
    </div>
    
    <div class="error" id="errorDisplay">
        <span class="error_cls" id="displaySingleError">&times;</span>
    </div>
    
    <div class="media_upload">
        <h2>Select files to upload<span></span></h2>
        <div class="image-upload">
            <label for="file-input">
                <i class="" aria-hidden="true">Select files</i>
            </label>
            <input id="file-input" type="file" onchange="hpAdmin.uploadFiles()" multiple="true" >
        </div>
        <p>Maximum upload file size: 50 MB.</p>
        <span class="upload_cls">&times;</span>
    </div>
    <?= $this->Form->create(null, ['type' => 'file', 'id' => 'uploadFileForm', 'url' => ['action' => 'add']])?>
        <?= $this->Form->control('media', ['type' => 'file', 'secure' => false, 'style' => 'display:none', 'label' => false])?>
    <?= $this->Form->end()?>
    <?= $this->Form->create(null, ['type' => 'get'])?>
        <div class="media_filter">
            <div class="media_search_filter">
                <?= $this->Form->select('filterByMediaItems', $allMediaFormats, ['empty' => 'All media items'])?>
                <?= $this->Form->select('filterByDate', $allDates, ['empty' => 'All dates'])?>
                <?= $this->Form->button('Filter', ['type' => 'submit'])?>
            </div> 
            <!--<div class="media_search">
                <?= $this->Form->console('mediaSearch', ['label' => FALSE, 'placeholder' => 'Search media items'])?>
            </div>-->
        </div>
    <?= $this->Form->end()?>
    <?= $this->Form->create(null, ['url' => ['action' => 'mediaAction']])?>
        <div class="media_bulk">
            <div class="bulk_media">
                <label class="container">
                    <input type="checkbox" onclick="$('input[name*=\'mediaId\']').prop('checked', this.checked);">
                    <span class="checkmark1"></span>
                </label>
                <?= $this->Form->select('bulkActionType', ['none' => 'Bulk Actions', 'delete' => 'Delete Permanently'])?>
                <?= $this->Form->button('Apply', ['type' => 'submit', 'onclick' => 'return hpAdmin.isMediaSelected()'])?>
            </div>
            <div class="media_pagination">                
                <span><?= $this->Paginator->params()['count']?> Items</span>
                <?= $this->Paginator->first('<button type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false])?>                
                <?= $this->Paginator->prev('<button type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]);?>
                <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" min="1" type="text" value="<?= $this->Paginator->current()?>">
                <span>of <?= $this->Paginator->total();?></span>
                <?= $this->Paginator->next('<button type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]);?>
                <?= $this->Paginator->last('<button type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false])?>
            </div>
        </div>
        <div class="view_all_media" id="allMedialist">
            <?= $this->Form->checkbox('mediaId[]', ['hiddenField' => false, 'value' => -1, 'style' => 'display:none', 'secure' => FALSE])?>
            <?php foreach ($medias as $media):?>
            <div class="media_check" data-shorturl="<?= $media->url?>" data-id="<?= $media->id?>" data-alt="<?= $media->alt?>" data-caption="<?= $media->caption?>" data-title="<?= $media->title?>" data-url="<?= $this->Media->get_the_image_url('full', $media->url)?>" data-filename="<?= $media->name?>" data-filetype="<?= $media->type?>" data-created="<?= date_format($media->created, 'd M Y')?>">
                <?= $this->Media->the_image('thumbnail', $media->url)?>
                <label class="media_label">
                    <?= $this->Form->checkbox('mediaId[]', ['value' => $media->id, 'hiddenField' => false,])?>
                    <span class="checkmark"></span>
                </label>
            </div>
            <?php endforeach;?>
        </div>
    <?= $this->Form->end()?>

<div class="media_modal">
  <div class="media_modal_content">
    <h2>Attachment Details <span>&times;</span></h2>
    <div class="media_popup_area">
      <div class="media_popup_img">
          <img id="originalMediaImage">
          <video id="originalMediaVideo">
          </video>
      </div>
      <div class="media_popup_content">
          <div class="popup_content1">
              <p><span><b>File name:</b></span> <span id="originalMediaFileName"></span></p>
             <p><span><b>File Type:</b></span> <span id="originalMediaFileType"></span></p>
             <p><span><b>Uploaded on:</b></span> <span id="originalMediaCreated"></span></p>
          </div>
          <?= $this->Form->create(null, ['url' => ['action' => 'edit'], 'id' => 'updateMediaForm'])?>
            <?= $this->Form->text('id', ['label' => false, 'style' => 'display:none'])?>
            <?= $this->Form->text('url', ['label' => false, 'style' => 'display:none'])?>
            <?= $this->Form->text('name', ['label' => false, 'style' => 'display:none'])?>
            <?= $this->Form->text('type', ['label' => false, 'style' => 'display:none'])?>
            <div class="popup_content1_mid">
                <div class="url_text">URL</div>
                <div class="url_details">
                    <input class="readonly" id="originalMediaUrl" type="text" readonly="true">
                </div>
                <div class="url_text">Title</div>
                <div class="url_details">
                    <?= $this->Form->text('title', ['id' => 'originalMediaTitle', 'onblur' => 'hpAdmin.updateMediaDetails()'])?>
                </div>
                <div class="url_text">Caption</div>
                <div class="url_details">
                    <?= $this->Form->textarea('caption', ['id' => 'originalMediaCaption', 'row' => 5, 'onblur' => 'hpAdmin.updateMediaDetails()'])?>
                </div>
                <div class="url_text">Alt Text</div>
                <div class="url_details">
                    <?= $this->Form->text('alt', ['id' => 'originalMediaAlt', 'onblur' => 'hpAdmin.updateMediaDetails()'])?>
                </div>
                <div class="url_text">Uploaded By</div>
                <div class="url_details">Administrator</div>
                <div class="url_text">Uploaded To</div>
                <div class="url_details upload_product">Media Directory</div>
                <div class="url_text">Media ID</div>
                <div class="url_details upload_product" id="mediaId">Media Directory</div>
            </div>
          <?= $this->Form->end()?>
          <div class="popup_content1_bottom">
              <p id="mediaUpdateStatus"></p>
          </div>
      </div>
    </div>
  </div>
</div>

<?= $this->Html->scriptStart(['block' => true])?>
    $(document).ready(function () {
        $(".media_section>h2>span").click(function () {
            $(".media_upload").toggleClass("active");
        });
        $(".upload_cls").click(function () {
            $(".media_upload").removeClass("active");
        });
        $(".media_modal_content>h2>span").click(function () {
            $(".media_modal").removeClass("active");
        });
        $(document).on('click', ".media_check>img, .media_check>video", function () {
        var mediaUrl = $(this).parent('div').attr('data-url');
            var mediaType = $(this).parent('div').attr('data-filetype');
            if(mediaType.indexOf('video') != -1){
                $("#originalMediaImage").css('display', 'none');
                var htmlToReplace = '<video controls="true" id="originalMediaVideo">';
                    htmlToReplace += '<source src="' + mediaUrl + '" type="' + $(this).parent('div').attr('data-filetype') + '" />';
                    htmlToReplace += '</video>';
                $("#originalMediaVideo").replaceWith(htmlToReplace).css('display', 'block');
            }else{
                $("#originalMediaVideo").css('display', 'none');
                $("#originalMediaImage").attr('src', mediaUrl).css('display', 'block');
            }
            $("#originalMediaFileName").text($(this).parent('div').attr('data-filename'));
            $("#originalMediaFileType").text($(this).parent('div').attr('data-filetype'));
            $("#originalMediaCreated").text($(this).parent('div').attr('data-created'));
            $("#originalMediaUrl").val($(this).parent('div').attr('data-url'));
            $("#originalMediaTitle").val($(this).parent('div').attr('data-title'));
            $("#originalMediaCaption").val($(this).parent('div').attr('data-caption'));
            $("#originalMediaAlt").val($(this).parent('div').attr('data-alt'));
            $("#mediaId").text($(this).parent('div').attr('data-id'));
            $("#updateMediaForm").find('input[name=id]').val($(this).parent('div').attr('data-id'));
            $("#updateMediaForm").find('input[name=url]').val($(this).parent('div').attr('data-shorturl'));
            $("#updateMediaForm").find('input[name=name]').val($(this).parent('div').attr('data-filename'));
            $("#updateMediaForm").find('input[name=type]').val($(this).parent('div').attr('data-filetype'));
            $("#mediaUpdateStatus").text('');
            $(".media_modal").addClass("active");
        });
    });
<?= $this->Html->scriptEnd()?>