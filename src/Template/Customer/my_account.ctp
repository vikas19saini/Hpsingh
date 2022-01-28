<?php

$this->assign('bodyClass', 'myAccount-page');
$this->assign('title', 'My Account - Hpsingh');
?>

<?= $this->Element('header') ?>

<div class="mobile_hidden_vissible">

    <section class="myaccount">
        <div class="container">
            <div class="row">
                <?= $this->Element('customer/navigation') ?>

                <!--- overview -->
                <div class="overview_area active">
                    <h2>Welcome <?= $Auth->name ?> </h2>
                    <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                    <a href="javascript:logout()">LOGOUT</a>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>