<?php 
    $this->assign('bodyClass', 'myAccount-page');
    $this->assign('title', 'My Account - Hpsingh');
?>

<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">

<section class="myaccount">
   <div class="container">
      <div class="row">
          <?= $this->Element('customer/navigation')?>         
        <!-- Coupon -->
         <div class="coupon_area active">
             <?php if(!$coupons->isEmpty()): foreach ($coupons as $coupon):?>
              <div class="coupen1">
                <div class="coupon_bg">
                    <h2>-
                        <?php
                            if($coupon->type === 'percent'){
                                echo $coupon->value, '%';
                            }else{
                                echo '<price>',$this->Number->currency($coupon->value * $defaultCurrency->value, $defaultCurrency->code),'</price>';
                            }
                        ?>
                    </h2>
                    <p><span>Coupon Code <b><?= $coupon->code?></b></span> <?= $coupon->description?> <span>Valid Till: <b><?= date_format($coupon->expiry_date, 'D d M, Y')?></b></span></p>
                </div>
              </div>
             <?php endforeach; else:?>
             <?php endif;?>
          </div>

      </div>
   </div>
</section>
<!-- footer area start -->
 <?= $this->Element('footer') ?>
<!-- footer area end -->
</div>