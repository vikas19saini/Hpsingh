<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>


<?php if($this->request->getParam('prefix') === 'hpadmin'):?>

<div class="error error-flash success" style="display: block">
    <span class="error_cls removeMediaErrorsFlash">&times;</span>
    <p><span>Success!</span><?= $message ?></p>
</div>

<?php else:?>

<p class="effectBounceInDown flash-success"><span> <i class="fa fa-info-circle"></i></span> <span><?= $message?></span>

<script>
    setTimeout(function () {
        document.getElementsByClassName('effectBounceInDown')[0].remove();
    }, 5000);
</script>

<?php endif;?>