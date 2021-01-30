<?php 
    $cod_charges = round(($this->request->getSession()->read('Cart.CartDetails.grantTotal') * Cake\Core\Configure::read('Store.codChargesInPercent')) / 100);
    $cod_charges = ($cod_charges < Cake\Core\Configure::read('Store.minCodAmount')) ? Cake\Core\Configure::read('Store.minCodAmount') : $cod_charges;
    
    $total_amount = $this->request->getSession()->read('Cart.CartDetails.grantTotal') + $cod_charges;
?>
<div class="payment_details">
    <p>A COD charge of <price><strong><?= $this->Number->currency($cod_charges, $defaultCurrency->code)?></strong></price> will be applicable. Total payable amount is <price><strong><?= $this->Number->currency($total_amount, $defaultCurrency->code)?></strong></price></p>
    <div class="g-recaptcha" data-sitekey="<?= env('GOOGLE_CAPTCHA_KEY')?>"></div>
    <button onclick="placeorder()">CONTINUE <?= $this->Number->currency($total_amount, $defaultCurrency->code)?></button>
    
    <script src="https://www.google.com/recaptcha/api.js">
        grecaptcha.ready(function() {
        grecaptcha.execute('<?= env('GOOGLE_CAPTCHA_KEY')?>', {action: 'homepage'}).then(function(token) {
        });
    });
    </script>
</div>
