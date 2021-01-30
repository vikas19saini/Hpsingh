<?php
    $this->assign('bodyClass', 'register-page');
    $this->assign('title', 'Hpsingh - Signup');
    $this->assign('css', $this->Html->css('select2.min') .
    '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />');
    $this->assign('script', $this->Html->script('select2.min') . '<script crossorigin src="https://unpkg.com/react@16/umd/react.development.js">
    </script><script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <script src="https://unpkg.com/axios@0.19.2/dist/axios.min.js"></script>
    <script src="https://unpkg.com/@material-ui/core@4.11.0/umd/material-ui.development.js"></script>'
     . $this->Html->script('front/Components.js', ['type' => 'text/babel']));
?>

<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">
   <section class="sign_login">
       <?= $this->Html->image('login/login_bg.png', ['class' => 'img-responsive login_bg'])?>
       <?= $this->Html->image('login/login_bg2.png', ['class' => 'img-responsive login_bg'])?>
      <div class="container">
         <div class="row">
            <div id="userForms"></div>
         </div>
      </div>
   </section>
   <!-- footer area start -->
   <?= $this->Element('footer') ?>
   <!-- footer area end -->
</div>



<?php $this->Html->scriptStart(['block' => true])?>
   $('#country-id').select2({
      width: '100%',
      padding: '6px',
      placeholder: 'Select Country',
   });
<?php $this->Html->scriptEnd()?>
