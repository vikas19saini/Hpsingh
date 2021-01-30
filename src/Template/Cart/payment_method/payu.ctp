<?php ?>
<div class="payment_details">
    <p>You'll be redirected to payment page, where you can pay via credit/debit card, E-wallet and UPI.</p>
    <button onclick="payu_checkout()">PAY <?= $this->Number->currency($this->request->getSession()->read('Cart.CartDetails.grantTotal'), $defaultCurrency->code) ?></button>
</div>
<script>
    function payu_checkout() {

        checkout.gst = $('input[name=gst]').val();
        
        if (checkout.gst !== "") {
            if (checkout.gst.length > 15 || checkout.gst.length < 15) {
                flashMessage({
                    status: "error",
                    message: "Invalid GST Number"
                });
                return false;
            }
        }

        $.ajax({
            url: HOST + "cart/placeorder",
            type: 'POST',
            data: checkout,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('input[name=_csrfToken]').val());
                addloader();
            },
            success: function(response) {
                if (response.status === 'error') {
                    removeLoader();
                    flashMessage(response);
                } else {
                    var payu_form = document.createElement('form');
                    payu_form.method = 'post';
                    payu_form.action = response.action;
                    payu_form.id = 'payu-payment-form';

                    $.each(response, function(key, val) {
                        var _ele = document.createElement('input');
                        _ele.type = 'hidden';
                        _ele.name = key;
                        _ele.value = val;
                        payu_form.appendChild(_ele);
                    });
                    $('body').append(payu_form);
                    $("#payu-payment-form").submit();
                }
            }
        });
    }
</script>