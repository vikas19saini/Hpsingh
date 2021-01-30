<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Media $media
 */

$dataMsg['status'] = 1;
$dataHtml = '<div class="media_check" data-shorturl="'. $media->url .'" data-id="'. $media->id .'" data-alt="'. $media->alt .'" data-caption="' . $media->caption .'" data-title="'. $media->title .'" data-url="'. $this->Media->get_the_image_url('full', $media->url).'" data-filename="'. $media->name .'" data-filetype="'. $media->type .'" data-created="'. date_format($media->created, 'd M Y').'">';
$dataHtml .= $this->Media->the_image('thumbnail', $media->url);
$dataHtml .= '<label class="media_label">';
$dataHtml .= $this->Form->checkbox('mediaId[]', ['value' => $media->id, 'hiddenField' => FALSE]);
$dataHtml .= '<span class="checkmark"></span>';
$dataHtml .= '</label>';
$dataHtml .= '</div>';
$dataMsg['message'] = $dataHtml;
?>

<?= json_encode($dataMsg)?>