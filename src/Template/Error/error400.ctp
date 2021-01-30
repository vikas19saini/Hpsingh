<?php

use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'default';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
<p class="notice">
    <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
</p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
<strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
if (extension_loaded('xdebug')) :
    xdebug_print_function_stack();
endif;

$this->end();
endif;
?>

<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
   <?= $this->Element('breadcrumb')?>
    <section class="product_area">
        <div class="container">
            <div class="row">
                <div class="multipal_product">
                    <section class="empty-cart">
                            <div class="empty-cart_main">
                                <?= $this->Html->image('empty_cart.jpg')?>
                                <h2><b><?= h($message) ?></b></h2>
                                <p class="error">
                                    <strong><?= __d('cake', 'Error') ?>: </strong>
                                    <?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?>
                                </p>
                                <a href="javascript:window.history.back()" class="empty-button">GO BACK</a>
                            </div>
                        </section>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
   <?= $this->Element('footer')?>
    <!-- footer area end -->
</div>
