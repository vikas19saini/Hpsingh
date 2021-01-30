<?php

$this->assign('bodyClass', 'shopping-cart-page');
    $this->assign('title', 'Order Confirmation - HpSingh');    
?>
<?= $this->Element('header')?>

<div class="mobile_hidden_vissible">
    <section class="order_page">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <h2>Order Confirmed</h2>
                <h4>Order No: #<?= $order->id?></h4>
                <p>Your order is currently being processed. You will receive an order confirmation email shortly with the expected delivery date for your item.</p>
                <a href="<?= $this->Url->build(["controller" => 'Customer', 'action' => 'orders', $order->id])?>">View Order details</a>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <hr/>
                <h4><b>Order Details</b></h4>
                <p><b>Payment method: </b><?= $order->payment_mode?></p>
                <p><b>Amount: </b><price><?= $this->Number->currency($order->grand_total, $order->currency_code)?></price></p>
            </div>
        </div>
        <div class="row caution">
        <p>
            <b>Note:</b> We do not demand your banking and credit card details verbally or telephonically. Please do not divulge your details to fraudsters and imposters falsely claiming to be calling on <?= Cake\Core\Configure::read('Store.name')?> behalf.
        </p>
        </div>
    </section>
</div>
<!-- Event snippet for Purchase conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-835074064/AEB2CJev7tQBEJDwmI4D',
      'transaction_id': ''
  });
</script>