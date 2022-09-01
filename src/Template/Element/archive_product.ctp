<?php ?>

<?php foreach ($products as $product) : ?>
	<?php if(isset($category->slug) && !empty($category->slug)){ ?>
		<div class="view_product <?= (($category->slug == 'combination-sets') ? 'joda_product' : '')?>">
	<?php } else {?>
		<div class="view_product">
	<?php }?>
        <?php if (!$product->in_stock) : ?>
            <label class="stock-msg">Out of stock</label>
        <?php endif; ?>
        <div class="multipal_product_img">
            <a target="_blank" href="<?= $this->Url->build(['_name' => 'product', $product->slug]) ?>">
                <?php if (!empty($product->featured_image)) : ?>
                    <img src="/img/lazyload.gif" data-src="<?= $this->Media->get_the_image_url('thumbnail', $product->featured_image->url) ?>" height="320px" width="480px" alt="<?= $product->featured_image->alt ?>" class="img-responsive lazyload">
                    <?php // $this->Media->the_image('full', $product->featured_image->url, ['class' => 'img-responsive', 'alt' => $product->featured_image->alt, 'height' => '320px', 'width' => '480px'])
                    ?>
                <?php else : ?>
                    <?= $this->Media->imagePlaceholder() ?>
                <?php endif; ?>
            </a>
            <p>
                <button><a class="add-to-wishlist" href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'add', $product->slug]) ?>">ADD TO WISHLIST</a></button><button><a href="<?= $this->Url->build(['_name' => 'product', $product->slug]) ?>">VIEW PRODUCT</a></button>
            </p>
        </div>
        <a href="<?= $this->Url->build(['_name' => 'product', $product->slug]) ?>">
            <p><em><?= ucfirst($product->name) ?></em>
                <?= $this->Product->price($product) ?>
            </p>
        </a>
    </div>
<?php endforeach; ?>