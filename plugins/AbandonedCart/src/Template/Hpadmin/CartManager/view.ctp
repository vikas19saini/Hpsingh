<?php

?>
<div class="main_user">
    <div class="user_section">
        <h2>Products Of <i> User: <?= $user->name?></i></h2>
        <hr/>
    </div>

    <div class="user_details product_details">
        <table class="hptable">
            <thead>
                <tr>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($carts)): foreach ($carts as $cart): $product = $cart->product;?>
                <tr>
                    <td>
                        <a target="_blank" href="<?= $this->Url->build(['_name' => 'product', $product->slug])?>">
                            <img style="width:150px" src="<?= BASE . $product->featured_image->url?>">
                        </a>
                    </td>
                    <td>
                        <a target="_blank" href="<?= $this->Url->build(['_name' => 'product', $product->slug])?>">
                            <?= $product->name?>
                        </a>
                    </td>
                    <td><?= $cart->qty?></td>
                    <td><?= $this->Number->currency($product->price, 'INR')?></td>
                    <td><?= $this->Number->currency($product->price * $cart->qty, 'INR')?></td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                    <td colspan="4">No product found in cart.</td>
                </tr>
                <?php endif;?>
            </tbody>
            <tfoot>
                <tr>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
