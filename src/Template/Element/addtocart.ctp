<?php ?>
<p class="product_details_right_p2">
    <span><?= $this->Product->price($product)?></span>
</p>
<p class="product_details_right_p3">
    <i>Quantity:
        <b class="shopping_count">
        <button class="qty-minus" onclick="decQuantity(this)"><i class="fa fa-minus" aria-hidden="true"></i></button>
        <input type="number" data-slug="<?= $product->slug?>" class="qty" step="<?= $product->step?>" max="<?= $product->max_order_qty?>" min="<?= $product->min_order_qty?>" value="<?= $product->min_order_qty?>">
        <button class="qty-plus" onclick="incQuantity(this)"><i class="fa fa-plus" aria-hidden="true"></i></button>
        </b>
    </i>
    <?php if($product->in_stock):?>
    <span class="p_card" onclick="addToCart('<?= $product->slug?>', this)">ADD TO CART</span>
    <?php else:?>
    <span class="p_card">OUT OF STOCK</span>
    <?php endif;?>
    <span class="p_like">
    <a class="add-to-wishlist" href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'add', $product->slug])?>">
        <i class="fa fa-heart"></i>
    </a>
    </span>
</p>

<section class="mobile_btn">
    <?php if($product->in_stock):?>
    <button onclick="addToCart('<?= $product->slug?>', this)">ADD TO CART</button>
    <?php else:?>
    <button>OUT OF STOCK</button>
    <?php endif;?>
    <button><a class="add-to-wishlist" href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'add', $product->slug])?>">ADD TO WISHLIST</a></button>
</section>