<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Media $media
 */
?>
<div class="media_gallery_section active">
    <div class="media_modal_content">
        <div class="media_gallery">
            <div class="media_gallery2">
                <span class="media_gallery_cls">&times;</span>
                <div class="media_gallery_header">
                    <h2>Insert Media</h2>
                    <ul>
                        <li class="m_upload">Upload Files</li>
                        <li class="m_library active">Media Library</li>
                    </ul>
                </div>
                <div class="media_gallery_mid">
                    <div class="media_upload">
                        <h2>Select files to upload <span>or</span></h2>
                        <div class="image-upload">
                            <label for="file-input">
                                <i class="" aria-hidden="true">Select files</i>
                            </label>
                            <input id="file-input" type="file" onchange="hpAdmin.uploadFiles('media-chooser')" multiple="true" >
                            <?= $this->Form->create(null, ['type' => 'file', 'id' => 'uploadFileForm', 'url' => ['action' => 'add']])?>
                                <?= $this->Form->control('media', ['type' => 'file', 'secure' => false, 'style' => 'display:none', 'label' => false])?>
                            <?= $this->Form->end()?>
                        </div>
                        <p>Maximum upload file size: 500 MB.</p>
                    </div>
                    <div class="main_media_library active"> 
                        <div class="media_library">
                            <div class="media_library_left">
                                <div class="media_search_filter">
                                    <?= $this->Form->select('', $allMediaFormats, ['empty' => 'All media items', 'id' => 'media-type-filter'])?>
                                    <?= $this->Form->select('', $allDates, ['empty' => 'All dates', 'id' => 'media-date-filter'])?>
                                </div> 
                                <?= $this->Media->renderImage('img/loader.GIF', ['id' => 'dataLoadingImge', 'style' => 'height:20px;width:20px;position:absolute;left:30%'])?>
                                <div class="media_search">
                                    <input type="text" placeholder="Search media items" id="media-search-filter">
                                </div>
                                <div class="view_all_media select-media-win" id="allMedialist" onscroll="hpAdmin.lodmoremedia()">
                                    <?= $this->Element('admin/media', ['medias' => $medias])?>
                                </div>
                            </div>
                            <div class="media_library_right" style="display: none">
                                <div class="popup_content1">
                                    <img id="selectedMedia" src="../img/image_placeholder.png" alt="media"> 
                                    <p><span><b>File name:</b></span> <span id="originalMediaFileName"></span></p>
                                    <p><span><b>File Type:</b></span> <span id="originalMediaFileType"></span></p>
                                    <p><span><b>Uploaded on:</b></span> <span id="originalMediaCreated"></span></p>
                                    <div class="clearfix"></div>
                                </div>
                                <?= $this->Form->create(null, ['url' => ['action' => 'edit'], 'id' => 'updateMediaForm'])?>
                                    <?= $this->Form->text('id', ['label' => false, 'style' => 'display:none'])?>
                                    <?= $this->Form->text('url', ['label' => false, 'style' => 'display:none'])?>
                                    <?= $this->Form->text('name', ['label' => false, 'style' => 'display:none'])?>
                                    <?= $this->Form->text('type', ['label' => false, 'style' => 'display:none'])?>
                                    <div class="popup_content1_mid">
                                        <div class="url_text">URL</div>
                                        <div class="url_details">
                                            <input id="originalMediaUrl" type="text" class="readonly">
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
                                    </div>
                                <?= $this->Form->end()?>
                                <div class="popup_content1_bottom">
                                    <p id="mediaUpdateStatus"></p>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="media_gallery_bottom">
                    <button type="button" onclick="hpAdmin.useMedia('<?= $inputFieldName?>', '<?= $replaceWith?>')">Use Media</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".media_gallery_header>ul>li").click(function () {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        });
        $(".media_gallery_cls").click(function () {
            $(".media_gallery_section").remove();
        });
        $(".m_upload").click(function () {
            $(".media_gallery_mid").addClass("active");
        });
        $(".m_library").click(function () {
            $(".media_gallery_mid").removeClass("active");
        });
        var id = [];
        $(document).on('click', 'input[name="mediaId[]"]', function(){
            var dataId = $(this).parent('label').parent('.media_check').attr('data-id')
            if($(this).is(':checked')){
                if(id.indexOf(dataId) == -1){
                    id.push($(this).parent('label').parent('.media_check').attr('data-id'));
                }
            }else{
                var indexNo = id.indexOf(dataId);
                if(id.indexOf(dataId) >= 0){
                    id.splice(indexNo, 1);
                }
            }
            var dataLength = Number(id.length) - 1;
            var name = []; var type = []; var url = []; var title = []; var caption = []; var alt = []; var created = []; var shortUrl = [];
            for(var i=0; i<=dataLength; i++){
                var current = id[i];
                name.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-filename'));
                type.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-filetype'));
                url.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-url'));
                title.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-title'));
                caption.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-caption'));
                alt.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-alt'));
                created.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-created'));
                shortUrl.push($("#allMedialist").find(`[data-id='${current}']`).attr('data-shorturl'));
            }
            if(type[dataLength].indexOf('video') != -1){
                var dataHtml = '<video controls="true" id="selectedMedia">';
                dataHtml += '<source src="'+ url[dataLength] +'" type="'+ type[dataLength] +'" />';
                dataHtml += '</video>';
                $("#selectedMedia").replaceWith(dataHtml);
            }else{
                var dataHtml = '<img src="'+ url[dataLength] +'" id="selectedMedia" />';
                $("#selectedMedia").replaceWith(dataHtml);
            }            
            $("#originalMediaFileName").text(name[dataLength]);
            $("#originalMediaFileType").text(type[dataLength]);
            $("#originalMediaCreated").text(created[dataLength]);
            $("#originalMediaUrl").val(url[dataLength]);
            $("#updateMediaForm").find('input[name=id]').val(id[dataLength]);
            $("#updateMediaForm").find('input[name=url]').val(shortUrl[dataLength]);
            $("#updateMediaForm").find('input[name=name]').val(name[dataLength]);
            $("#updateMediaForm").find('input[name=type]').val(type[dataLength]);
            $("#originalMediaTitle").val(title[dataLength]);
            $("#originalMediaCaption").val(caption[dataLength]);
            $("#originalMediaAlt").val(alt[dataLength]);
            if(dataLength >= 0){
                $('.media_library_right').css('display', 'block');
            }else{
                $('.media_library_right').css('display', 'none');
            }
        });
    });
</script>