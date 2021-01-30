<?php if(iterator_count($wishlist) > 0):?>
<section class="shopping_area">
      <div class="container">
         <div class="row">
             <br/>
            <h2>My Collection - <?= iterator_count($wishlist)?> items</h2>
         </div>
      </div>
   </section>
   <section class="all_shopping_area">
      <div class="container">
         <div class="row">
            <div class="all_shopping_area_main">
               <div class="shopping_left">
               <?php foreach($wishlist as $wishlistItem):?>
                  <div class="main_shopping_left">
                     <div class="shopping_img">
                        <a href="<?= $this->Url->build(['_name' => 'product', $wishlistItem->product->slug])?>">
                            <?= $this->Media->the_image('full', $wishlistItem->product->featured_image->url, ['class' => 'img-responsive', 'alt' => $wishlistItem->product->featured_image->alt, 'width' => '180px', 'height' => '137px'])?>
                        </a>
                     </div>
                     <div class="shopping_name">
                        <h3>
                           <a href="<?= $this->Url->build(['_name' => 'product', $wishlistItem->product->slug])?>">
                           <?= $wishlistItem->product->name?>
                           </a>
                        </h3>
                        <p>Design No: <em><?= $wishlistItem->product->design_no?></em></p>
                        <p class="qty">Qty: 
                           <select onchange="$('input[data-slug=<?= $wishlistItem->product->slug?>]').attr('value', this.value)">
                           <?php for($i = $wishlistItem->product->min_order_qty; $i <= $wishlistItem->product->max_order_qty; $i = number_format((float)$i + $wishlistItem->product->step, 1)):?>
                           <option value="<?= $i?>"><?= $i?></option>
                           <?php endfor;?>
                           </select>
                        </p>
                        <p class="shopping_price">Price: <?= $this->Product->price($wishlistItem->product)?></p>
                        <a href="javascript:moveToCart('<?= $wishlistItem->product->slug?>', <?= $wishlistItem->id?>);"><button>ADD TO CART</button></a>
                     </div>
                     <div class="shopping_count quantity-sec">
                        <button class="qty-minus" onclick="decQuantity(this)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                        <input type="number" data-slug="<?= $wishlistItem->product->slug?>" class="qty" step="<?= $wishlistItem->product->step?>" max="<?= $wishlistItem->product->max_order_qty?>" min="<?= $wishlistItem->product->min_order_qty?>" value="<?= $wishlistItem->product->min_order_qty?>">
                        <button class="qty-plus" onclick="incQuantity(this)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                     </div>
                     <div class="shopping_price">Price: <?= $this->Product->price($wishlistItem->product)?></div>
                     <div class="shopping_close" onclick="removeFromWishlist(<?= $wishlistItem->id?>)"><i class="icon icon-hpsinghdelete icon_main"></i></div>
                     <div class="mobile_edit_remove">
                        <ul>
                           <li><a href="javascript:removeFromWishlist(<?= $wishlistItem->id?>)">REMOVE</a></li>
                           <li><a href="javascript:moveToCart('<?= $wishlistItem->product->slug?>', <?= $wishlistItem->id?>);">ADD TO CART</a></li>
                        </ul>
                     </div>
                  </div>
               <?php endforeach;?>
               </div>
            </div>
         </div>
      </div>
   </section>
<?php else:?>
<section class="empty-cart">
    <div class="empty-cart_main">
         <?= $this->Html->image('empty_cart.jpg')?>
        <h2>Your wishlist is empty</h2>
        <p>Add items that you like to your wishlist. Review them anytime and easily move them to the bag.</p>
        <?= $this->Html->link('Continue shopping', ['_name' => 'home'], ['class' => 'empty-button'])?>
    </div>
</section>
<?php endif;?>