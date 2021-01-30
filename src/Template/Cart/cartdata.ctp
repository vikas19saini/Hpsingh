<?php if(!empty($products)) :?>
   <section class="all_shopping_area">
      <div class="container">
         <div class="row">
            <div class="all_shopping_area_main">
               <div class="shopping_left">
                <div class="shopping_area">
                    <h2>Shopping Cart - <?= $this->request->getSession()->read('Cart.CartDetails.totalItems')?> items</h2>
                 </div>
               <?php foreach($products as $product) : $qty = $cart[$product->id]['qty'];?>
                <div class="main_shopping_left <?= !$product->in_stock ? 'out_of_stock' : ''?>">
                <div class="shopping_img">
                    <a href="<?= $this->Url->build(['_name' => 'product', $product->slug])?>">
                            <?= $this->Media->the_image('thumbnail', $product->featured_image->url, ['class' => 'img-responsive', 'alt' => $product->featured_image->alt, 'width' => '180px', 'height' => '137px'])?>
                        </a>
                </div>
                <div class="shopping_name">
                    <h3><a href="<?= $this->Url->build(['_name' => 'product', $product->slug])?>"><?= $product->name?></a></h3>

                    <?php if(!empty($product->design_no)):?>
                    <p class="design-no">Design No: <em><?= $product->design_no?></em></p>
                    <?php endif;?>

                    <p class="qty"> Qty
                        <select onchange="$('input[data-slug=<?= $product->slug?>]').attr('value', this.value);updateQuantity(<?= $product->id?>, this.value)">
                           <?php for($i = $product->min_order_qty; $i <= $product->max_order_qty; $i = number_format((float)$i + $product->step, 1)):?>
                           <option value="<?= $i?>" <?= (strval($i) === $qty) ? 'selected' : ''?>><?= $i?></option>
                           <?php endfor;?>
                        </select>
                    </p>
                    <?php if(!$product->in_stock):?>
                    <p class="shopping_price">OUT OF STOCK</p>
                    <?php else:?>
                    <p class="shopping_price">Price: <?= $this->Product->price($product, 'no', $qty)?></p>
                    <?php endif;?>

                    <a class="move-to-wishlist" href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'addFromCart', $product->slug])?>"><button>MOVE TO WHISHLIST</button></a>
                </div>
                <div class="shopping_count quantity-sec">
                        <button class="qty-minus" onclick="decQuantity(this);updateQuantity(<?= $product->id?>, $(this).next().val())"><i class="fa fa-minus" aria-hidden="true"></i></button>
                        <input id="cart-qty-input" type="number" onchange="updateQuantity(<?= $product->id?>, $(this).val())" data-slug="<?= $product->slug?>" class="qty" step="<?= $product->step?>" max="<?= $product->max_order_qty?>" min="<?= $product->min_order_qty?>" value="<?= $cart[$product->id]['qty']?>">
                        <button class="qty-plus" onclick="incQuantity(this);updateQuantity(<?= $product->id?>, $(this).prev().val())"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
                    <?php if(!$product->in_stock):?>
                    <div class="shopping_price">OUT OF STOCK</div>
                    <?php else:?>
                    <div class="shopping_price">
                        Price: <?= $this->Product->price($product, 'no', $cart[$product->id]['qty'])?>
                        <?php if(!empty($cart[$product->id]['coupon_discount'])):?>
                        <p class="applied-coupon">Coupon Discount: <price><?= $this->Number->currency($cart[$product->id]['coupon_discount'], $defaultCurrency->code)?></price></p>
                        <?php else:?>
                        <p class="applied-coupon"><?= $cart[$product->id]['coupon_message']?></p>
                        <?php endif;?>
                    </div>
                    <?php endif;?>
                <div class="shopping_close" onclick="removeFromCart(<?= $product->id?>)"><i class="icon icon-hpsinghdelete icon_main"></i></div>
                <div class="mobile_edit_remove">
                    <ul>
                        <li><a href="javascript:removeFromCart(<?= $product->id?>)">REMOVE</a></li>
                        <li><a class="move-to-wishlist" href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'addFromCart', $product->slug])?>">MOVE TO WISHLIST</a></li>
                    </ul>
                </div>
                </div>
                <?php endforeach;?>
               <p><a href="<?= $this->Url->build(['_name' => 'home'])?>"><i class="fa fa-long-arrow-left"></i> Continue Shopping </a></p>
               </div>
                <div class="continue-shopping">
                    <a href="<?= $this->Url->build(['_name' => 'home'])?>">
                        Continue Shopping <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </div>
               <?= $this->Element('cart/cart_details')?>
            </div>
         </div>
      </div>
   </section>
<?php else:?>
<section class="empty-cart">
    <div class="empty-cart_main">
        <?= $this->Html->image('empty_cart.jpg')?>
        <h2>Hey, it feels so light!</h2>
        <p>There is nothing in your cart, Let's add some items</p>
        <?= $this->Html->link('Add From Wishlist', ['controller' => 'wishlist', 'action' => 'index'], ['class' => 'empty-button'])?>
    </div>
</section>
<?php endif;?>
