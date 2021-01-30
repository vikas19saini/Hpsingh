<?php ?>
<!DOCTYPE html>
<html>
    <head>
    <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $this->fetch('title') ?></title>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta('icon',  BASE . 'img/favicon.ico', ['type' => 'icon'])?>
    <?= $this->Html->css('admin/menu.css') ?>
    <?= $this->Html->css('admin/style.css') ?>
    <?= $this->Html->css('admin/icon.css') ?>
    <?= $this->Html->css('add.css') ?>
    <?= $this->Html->css('select2.min')?>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <?= $this->fetch('css') ?>
    <script>
        const HPADMIN = '<?= BASE?>hpadmin/';
        const CONTROLLER = '<?= $this->request->getParam('controller')?>';
    </script>
    </head>
    <body>
    <?= $this->Element('admin/header')?>
        <div class="dashborad">
            <?= $this->Element('admin/menu')?>
            <?= $this->Element('admin/collapse-menu')?>
            <div class="right_content <?= $this->request->getCookie('menu') === 'collapse' ? 'active' : ''?>">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    <?= $this->Html->script('admin/jquery_file.js')?>
    <?= $this->Html->script('admin/custom.js')?>
    <?= $this->Html->script('admin/hp-script.js')?>
    <?= $this->Html->script('js.cookie.min')?>
    <?= $this->Html->script('select2.min')?>
    <?= $this->fetch('script') ?>
    </body>
</html>
