<?php

    $this->assign('bodyClass', 'shopping-cart-page collection_page');
    $this->assign('title', 'Wishlist - HpSingh');
    
?>
<?= $this->Element('header')?>

<div class="mobile_hidden_vissible" id="wishlist">
   
   <!-- footer area start -->
   <?= $this->Element('footer')?>
   <!-- footer area end -->
</div>
<script>
    window.onload = function(){
        getWishlist();
    }
</script>