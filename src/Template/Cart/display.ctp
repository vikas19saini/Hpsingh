<?php
    $this->assign('bodyClass', 'shopping-cart-page');
    $this->assign('title', 'Shopping Cart - HpSingh');    
?>
<?= $this->Element('header_v2')?>

<div class="mobile_hidden_vissible" id="cartProducts">   
</div>
<script>
    window.onload = function(){
        getProductsInCart();
    }
</script>