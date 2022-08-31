<?php

/* Template Name: Home Page */

$this->assign('bodyClass', 'home-page');

if (isset($page)) {
    $this->assign('title', $page->meta_title);
    $this->assign('meta', $this->Html->meta('description', $page->meta_description) . $this->Html->meta('keywords', $page->meta_keywords));
}
?>
<?= $this->Element('header') ?>
<div class="mobile_hidden_vissible">
    <!--- home page banner -->
    <section class="banner_section">
        <div class="carousel-inner">
            <div class="home_banner">
                <?php foreach ($sliders as $slider) : ?>
                    <div class="item">
                        <a href="<?= $slider->uri ?>">
                            <?= $this->Media->the_image('full', $slider->media->url, ['alt' => $slider->media->alt,]) ?>
                            <?= $this->Media->the_image('full', $slider->mobile_media->url, ['alt' => $slider->mobile_media->alt, 'class' => 'mobile_banner']) ?>
                        </a>
                    </div>
                <?php endforeach; ?>
				
				
            </div>
        </div>
    </section>

    <section>
        <div class="banner_tab">
            <div class="container">
                <ul class="nav nav-pills">
                    <li class="fabric1 active"><a href="javascript:void(0);">FABRIC CATEGORIES</a></li>
                    <li class="fabric2"><a href="javascript:void(0);">WHAT DO YOU WANNA MAKE</a></li>
                    <hr />
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="tab-content">
                        <div class="fabric_icon active">
                            <div class="fabric_carousel wow fadeInRight">
                                <?php foreach ($categories as $category) : 
									if($category->media->url) { ?>
                                    <div class="item">
                                        <a href="<?= (!empty($category->url)) ? $category->url : $this->Url->build(['_name' => 'category', $category->slug]) ?>">
                                            <?= $this->Media->the_image('full', $category->media->url, ['alt' => $category->media->alt, 'class' => 'img-responsive,']) ?>
                                            <p><?= strtoupper($category->name) ?></p>
                                        </a>
                                    </div>
								<?php } endforeach; ?>
                            </div>
                        </div>
                        <div class="fabric_icon2">
                            <div class="fabric_tab2 fabric_carousel">
                                <?php foreach ($wearing as $wearingItem) : ?>
                                    <div class="item">
                                        <a href="<?= (!empty($wearingItem->url)) ? $wearingItem->url : $this->Url->build(['_name' => 'category', $wearingItem->slug]) ?>">
                                            <?= $this->Media->the_image('full', $wearingItem->media->url, ['alt' => $wearingItem->media->alt, 'class' => 'img-responsive']) ?>
                                            <p><?= strtoupper($wearingItem->name) ?></p>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="best_categories">
        <div class="container">
            <div class="row">
                <h2>Bestsellers<span></span></h2>
            </div>
            <div class="mob_hd">
                <div class="row">
                    <div class="col-md-7 col-xs-7 mob_pad_0">
                        <div class="slider slider-for top_head_sec view_best_categories">
                            <div class="best_categories_img ">
								<?= $this->Html->image('cotton-flex.jpg', ['class' => 'img-responsive']) ?>
							</div>
                            <div class="best_categories_img ">
								<?= $this->Html->image('duppata.png', ['class' => 'img-responsive']) ?>
							</div>
                            <div class="best_categories_img">
								<?= $this->Html->image('ikats.jpg', ['class' => 'img-responsive']) ?>
							</div>
							<div class="best_categories_img">
								<?= $this->Html->image('satins.jpg', ['class' => 'img-responsive']) ?>
							</div>
                        </div>
                    </div>

                    <div class="col-md-5 col-xs-5 mob_pad_0">
                        <div class="slider slider-nav bttm_inner">
                            <div class="best_categories_content">
								<h2>Cotton Flex</h2>
								<p>Flex cotton fabric is woven with pale and durable cotton and flex yarns. It can be used all over year round. Absolutely comfortable and durable fabrics can be used to designs ethnics, blouses, mens kurta, dresses, and more.</p>
								<a href="<?= $this->Url->build(['_name' => 'search', 'cotton+flex']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                            <div class="best_categories_content">
								<h2>Dupatta</h2>
								<p>Dupatta is a symbol of modesty, while that symbolism still continues, many today wear it as a decorative accessory. The dupatta is worn in many regional styles across the world.</p>
								<a href="<?= $this->Url->build(['_name' => 'category', 'scarves-and-stoles']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                            <div class="best_categories_content">
								<h2>Ikats</h2>
								<p>Ikats are created as patterns using resist dyeing techniques on yarns. This innovative technique, with its south east asian origins is defined regionally by geography and design language. Ikats are just one more of India's vast heritage of textiles.</p>
								<a href="<?= $this->Url->build(['_name' => 'search', 'ikats']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                            <div class="best_categories_content">
								<h2>Satins</h2>
								<p>Satin is actually a weave and not a natural fiber like silk. Fiber is the actual thread from which the material is made and weave is how you make it. Traditionally, satin will have both a glossy side and a dull side.</p>
								<a href="<?= $this->Url->build(['_name' => 'search', 'satin']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-xs-5 mob_pad_0">
                        <div class="slider-nav_1 bttm_inner">
                            <div class="best_categories_content">
								<h2>Linen Fabrics</h2>
								<p>A natural fiber just like cotton, linen is derived from the flax plant. It is very strong, lightweight and breathable making it a popular choice in summers.</p>
								<a href="<?= $this->Url->build(['_name' => 'search', 'linen']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                            <div class="best_categories_content">
								<h2>Thread Embroidery</h2>
								<p>Thread embroideries which are created to bring so much beauty to the fabric. These will be perfect for your wardrobe with their trendy patterns and latest designs.</p>
								<a href="<?= $this->Url->build(['_name' => 'category', 'cotton/embroideries']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                            <div class="best_categories_content">
								<h2>Tussar</h2>
								<p>Tussar is a fabric made only in India, its rich and textured look, makes it distinctive! Printed tussar is perfect for kurtas and sarees and even better to gift.</p>
								<a href="<?= $this->Url->build(['_name' => 'search', 'tussar']) ?>">
									<button>SHOP NOW</button>
								</a>
							</div>
                        </div>
                    </div>
                    <div class="col-md-7 col-xs-7 mob_pad_0">
                        <div class="bttm_inner slider-for_1">
							<div class="best_categories_img">
								<?= $this->Html->image('linen.jpg', ['class' => 'img-responsive']) ?>
							</div>
						
							<div class="best_categories_img">
								<?= $this->Html->image('thread-Embroidery.jpg', ['class' => 'img-responsive']) ?>
							</div>
						
							<div class="best_categories_img">
								<?= $this->Html->image('tussar.jpg', ['class' => 'img-responsive']) ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row on_mob_show">
                <div class="mob_pad_0">
                    <div class="all_product bttm_inner">
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('cotton-flex.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Cotton Flex</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'cotton+flex']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('duppata.png', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Dupatta</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'category', 'scarves-and-stoles']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('ikats.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Ikats</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'ikats']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('satins.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Satins</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'satin']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('soft-linens.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Soft Linens</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'linen']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('thread-Embroidery.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Thread Embroidery</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/embroideries']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="dis_flx">
                                <div class="best_categories_img">
                                    <?= $this->Html->image('tussar.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="best_categories_content">
                                    <h2>Tussar</h2>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'tussar']) ?>">
                                        <button>SHOP NOW</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="arrived_store recommended_section recommended_bttm">
        <div class="container-fluid">
            <div class="row">
                <h2>Recommended for you<span></span></h2>
                <div class="arrived_store_carousel">
                    <!--<?= $this->Element('product', ['products' => $bestSellers]) ?>-->
					<div class="item">
                        <div class="arrived_hover">
                           <a href="/product/printed-rayon-fabric-4398820"><img src="img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_4398820-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/printed-rayon-fabric-4398820">ADD TO WISHLIST</a></button><button><a href="/product/printed-rayon-fabric-4398820">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/printed-rayon-fabric-4398820">
                           <p><em>Printed Rayon Fabric-4398820</em><em><span></span><span>₹280.00 / Mtr</span></em></p>
                        </a>
                     </div>
                     <div class="item">
                        <div class="arrived_hover">
                           <a href="/product/cotton-lurex-butta-4665722"><img src="/img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_41128321-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/cotton-lurex-butta-4665722">ADD TO WISHLIST</a></button><button><a href="/product/cotton-lurex-butta-4665722">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/cotton-lurex-butta-4665722">
                           <p><em>Cotton Lurex Butta-4665722</em><em><span></span><span>₹220.00 / Mtr</span></em></p>
                        </a>
                     </div>
                     <div class="item">
                        <div class="arrived_hover">
                           <a href="/product/cotton-lurex-stripes-4706721"><img src="/img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_4706721-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/cotton-lurex-stripes-4706721">ADD TO WISHLIST</a></button><button><a href="/product/cotton-lurex-stripes-4706721">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/cotton-lurex-stripes-4706721">
                           <p><em>Cotton Lurex Stripes-4706721</em><em><span></span><span>₹140.00 / Mtr</span></em></p>
                        </a>
                     </div>
                     <div class="item">
                        <div class="arrived_hover">
                           <a href="/product/cotton-lurex-stripes-448921"><img src="/img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_448921-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/cotton-lurex-stripes-448921">ADD TO WISHLIST</a></button><button><a href="/product/cotton-lurex-stripes-448921">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/cotton-lurex-stripes-448921">
                           <p><em>Cotton Lurex Stripes-448921</em><em><span></span><span>₹100.00 / Mtr</span></em></p>
                        </a>
                     </div>
                </div>
            </div>
        </div>
    </section>


	<section class="arrived_store best_categories jodas_c desk_view">
               <div class="container">
                  <div class="row">
                     <h2>Joda By HPSingh<span></span></h2>
                  </div>
               <div class="jodas_b">
            <div class="mob_pad_0">
               <div class="top_head_sec view_best_categories">
                     <div class="best_categories_img ">
                       <?= $this->Html->image('joda_duppata.jpg', ['class' => 'img-responsive']) ?>
                   </div>
               </div>
            </div>
            <div class="mob_pad_0">
               <div class="bttm_inner">
                     <div class="best_categories_content">
                        <p>An extensive collection of ready-to-stitch Indian ethnic co-ord fabrics, especially curated to look your best.</p>
                        <a href="<?= $this->Url->build(['_name' => 'category','combination-sets']) ?>"><button>View Collection</button></a>
                     </div>
                  </div>
                  </div>
                  </div>  
         
         </div>
    </section>
									  
    <section class="home_about_section">
        <div class="container-fluid">
            <div class="row">
                <h2>All about home<span></span></h2>
                <div class="home_about wow fadeInUp">
                    <div class="home_about_left">
                        <h2>HOME FURNISHING</h2>
                        <p>Explore exquisite range of home furnishing fabrics. Choose from intricate designs ideal for
                            cushions, curtains, blinds, bed linen such as quilt covers, duvet covers, pillow covers,
                            upholstery and rugs. Browse extensive collection of designer fabrics like cotton, linen,
                            viscose, silk, jute, rayon, satin, wool, organza, wool & more.</p>
                        <a href="<?= $this->Url->build(['_name' => 'search', 'home+furnishing']) ?>">
                            <button>VIEW COLLECTION</button>
                        </a>
                    </div>
                    <div class="home_about_right">
                        <?= $this->Html->image('homef.jpg', ['class' => 'img-responsive']) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	<section class="best_categories jodas_c mob_view">
            <div class="container">
               <div class="row">
                  <h2>Joda By HPSingh<span></span></h2>
               </div>
            <div class="jodas_b">
         <div class="mob_pad_0">
            <div class="top_head_sec view_best_categories">
                  <div class="best_categories_img ">
                    <?= $this->Html->image('joda_duppata.jpg', ['class' => 'img-responsive']) ?>
                </div>
            </div>
         </div>
         <div class="mob_pad_0">
            <div class="bttm_inner">
                  <div class="best_categories_content">
                     <p>An extensive collection of ready-to-stitch Indian ethnic co-ord fabrics, especially curated to look your best.</p>
                     <a href="<?= $this->Url->build(['_name' => 'category','combination-sets']) ?>"><button>VIEW COLLECTION</button></a>
                  </div>
               </div>
               </div>
               </div>  
      
         <div class="jodas_p">
            <p>An extensive collection of ready-to-stitch Indian ethnic co-ord fabrics, especially curated to look your best.</p>
         
      </div>
      </div>
    </section>											   

    <?php if ($deals) : ?>
        <section class="deals">
            <div class="container">
                <div class="row">
                    <h2>Steal the Deals<span></span></h2>
                    <a class="wow fadeInUp" href="<?= $deals->uri ?>">
                        <?= $this->Media->the_image('full', $deals->media->url, ['alt' => $deals->media->alt, 'class' => 'img-responsive add1_img']) ?>
                    </a>
                    <button onclick="window.location.href = '<?= $deals->uri ?>'">Shop Now</button>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="root prints_sec">
        <div class="container">
            <div class="row">
                <h2>Our Favourite Print Fabrics <span></span></h2>
                <div class="prints_sec custom_bdr">
                    <ul class="nav nav-pills custom_bttm">
                        <li class="root_list1 active"><a href="javascript:void(0);">Floral</a></li>
                        <li class="root_list2"><a href="javascript:void(0);">Abstracts</a></li>
                        <li class="root_list3"><a href="javascript:void(0);">Stripes</a></li>
                        <li class="root_list4"><a href="javascript:void(0);">Watercolour Effects</a></li>
                        <li class="root_list5"><a href="javascript:void(0);">Conversationals</a></li>
                        <li class="root_list6"><a href="javascript:void(0);">Animal prints</a></li>
                        <hr>

                    </ul>
                </div>

                <div class="mobile_tab-content">
                    <div class="tab-content wow fadeInUp">
                        <div class="root1 active">
                            <div class="root_area">
                                <div class="root_img">
                                    <?= $this->Html->image('static/floral1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="prints_contant root_content">
                                    <h2>Florals</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Floral prints are a evergreen print available in different styles i.e.
                                                gardens, botanicals, chintz, retro etc.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'florals']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="root2">
                            <div class="root_area">
                                <div class="root_img">
                                    <?= $this->Html->image('static/abstract1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="prints_contant root_content">
                                    <h2>Abstracts</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Abstract print is art that does not attempt to represent an accurate
                                                depiction of a visual reality but instead use shapes,</p>
                                        </div>
                                        <div class="item">
                                            <p>colours, forms and gestural marks to achieve its effect.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'abstracts']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="root4">
                            <div class="root_area">
                                <div class="prints_contant root_img">
                                    <?= $this->Html->image('static/watercolor_effects1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="prints_contant root_content">
                                    <h2>Watercolour Effects</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Let the colours of nature in its true flair and patterns fill your
                                                wardrobe this season</p>
                                        </div>
                                        <div class="item">
                                            <p>As fabrics in water colour effects are all set to be the biggest summer
                                                trend</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'watercolour']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="root5">
                            <div class="prints_contant root_area">
                                <div class="root_img">
                                    <?= $this->Html->image('static/Conversationals1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="prints_contant root_content">
                                    <h2>Conversationals</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Conversational prints are classified as any print design with a
                                                recognizable</p>
                                        </div>
                                        <div class="item">
                                            <p>picture in it, such as cats, birds, stars or even pies!</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'conversationals']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="root3">
                            <div class="prints_contant root_area">
                                <div class="root_img">
                                    <?= $this->Html->image('static/stripe1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="prints_contant root_content">
                                    <h2>Stripes</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Striped pattern is a line or band printed on the fabric, it can be
                                                available in many forms i.e.</p>
                                        </div>
                                        <div class="item">
                                            <p>distorted stripes, multicolour stripes, etc.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'stripe']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="root6">
                            <div class="prints_contant root_area">
                                <div class="root_img">
                                    <?= $this->Html->image('static/animal1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                                <div class="prints_contant root_content">
                                    <h2>Animal Prints</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>An entire collection inspired with the most beautiful creations of our
                                                planet,</p>
                                        </div>
                                        <div class="item">
                                            <p>This summer feel special with each of our animal designs.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'animal']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


            <div class="mobile_root_visible">
                <div class="fabric_slider bttm_inner">
                    <div class="item">
                        <div class="mobile_root_visible1">
                            <a href="<?= $this->Url->build(['_name' => 'search', 'abstracts']) ?>">
                                <?= $this->Html->image('static/abstract2.jpg', ['class' => 'img-responsive']) ?>
                                <div>
                                    <h2>Abstract</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="mobile_root_visible1">
                            <a href="<?= $this->Url->build(['_name' => 'search', 'florals']) ?>">
                                <?= $this->Html->image('static/floral2.jpg', ['class' => 'img-responsive']) ?>
                                <div>
                                    <h2>Floral</h2>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="mobile_root_visible1">
                            <a href="<?= $this->Url->build(['_name' => 'search', 'stripe']) ?>">
                                <?= $this->Html->image('static/stripe2.jpg', ['class' => 'img-responsive']) ?>
                                <div>
                                    <h2>Stripes</h2>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="mobile_root_visible1">
                            <a href="<?= $this->Url->build(['_name' => 'search', 'animal']) ?>">
                                <?= $this->Html->image('static/animal2.jpg', ['class' => 'img-responsive']) ?>
                                <div>
                                    <h2>Animal Prints</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mobile_root_visible1 mobile_root_visible2 wow fadeInUp">
                    <a href="<?= $this->Url->build(['_name' => 'search', 'conversationals']) ?>">
                        <?= $this->Html->image('static/Conversationals2.jpg', ['class' => 'img-responsive']) ?>
                        <div>
                            <h2>Conversationals</h2>
                        </div>
                    </a>
                </div>
                <div class="mobile_root_visible1 mobile_root_visible2 wow fadeInUp">
                    <a href="<?= $this->Url->build(['_name' => 'search', 'watercolour']) ?>">
                        <?= $this->Html->image('static/watercolor_effects2.jpg', ['class' => 'img-responsive']) ?>
                        <div>
                            <h2>Watercolour effects</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <section class="arrived_store">
        <div class="container-fluid">
            <div class="row">
                <h2>Just arrived in store <span></span></h2>
                <div class="arrived_store_carousel">
                    <?= $this->Element('product', ['products' => $newArrived]) ?>
				</div>
			</div>
		</div>
    </section>


    <section class="root">
        <div class="container">
            <div class="row">
                <h2>From the Roots<span></span></h2>
                <div class="root_tab">
                    <ul class="nav nav-pills">
                        <li class="root_list1 active"><a href="javascript:void(0);">Kalamkari</a></li>
                        <li class="root_list2"><a href="javascript:void(0);">Ikats</a></li>
                        <li class="root_list3"><a href="javascript:void(0);">Ajrak</a></li>
                        <li class="root_list4"><a href="javascript:void(0);">Shibori</a></li>
                        <li class="root_list5"><a href="javascript:void(0);">Hand Block</a></li>
                        <li class="root_list6"><a href="javascript:void(0);">Handspun</a></li>
                        <li class="root_list7"><a href="javascript:void(0);">Cotton Indigo</a></li>
                        <hr />
                    </ul>
                </div>
                <div class="mobile_tab-content">
                    <div class="tab-content custom_rt wow fadeInUp">
                        <div class="root1 active">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Kalamkari</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Kalamkari is one of the most traditional art form of India. Our
                                                extraordinary hand painted and block printed fabrics.</p>
                                        </div>
                                        <div class="item">
                                            <p>Explore the trendiest designs of finest kalamkari cotton, silk, georgette
                                                and chanderi.</p>
                                        </div>
                                        <div class="item">
                                            <p>Pick your favourites from beautiful kalamkari floral, animal prints and
                                                freehand abstracts, use for making dupattas</p>
                                        </div>
                                        <div class="item">
                                            <p>saress, blouses. Kalamkari is definitely a must buy and worth all the
                                                money it demands!</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'kalamkari']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/kalamkari1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="root2">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Ikats</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Finest tye and dye fabric in India is available in distinctive patterns.
                                                From lovely summer dresses</p>
                                        </div>
                                        <div class="item">
                                            <p>t-shirts, skirts, sarees to home furnishings, our handpicked ikat fabric
                                                is highly recommended.</p>
                                        </div>
                                        <div class="item">
                                            <p> It’s a beautiful fabric for embroidering bags and pouches. Choose your
                                                desired pattern and weave some magic with unique collection of Ikat
                                                fabrics.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'ikats']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/ikat1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="root3">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Ajrak</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Inspired by Mughal and Sindhi culture, our online collection of Ajrak
                                                fabric is something to vouch for!</p>
                                        </div>
                                        <div class="item">
                                            <p>Be your own designer with vibrant Ajrak fabrics available in beautiful
                                                hand block prints and colors.</p>
                                        </div>
                                        <div class="item">
                                            <p>These prints are available in cotton, modal silk, gazi silk, brush print,
                                                mal mal and more. Ajrak printed bedsheets</p>
                                        </div>
                                        <div class="item">
                                            <p>furnishings, kurta sets and sarees are extremely popular.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'ajrak']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/ajrak1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="root4">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Shibori</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Explore from vast collection of Indie picks of Shibori fabric. Our
                                                impeccable designs on fabrics</p>
                                        </div>
                                        <div class="item">
                                            <p>like chiffon, rayon, cotton, chanderi can be used for clothing or home
                                                decorating.</p>
                                        </div>
                                        <div class="item">
                                            <p>Choose from finest block prints and colors like pink,indigo, grey and
                                                olive green.</p>
                                        </div>
                                        <div class="item">
                                            <p>Extend your summer bliss with amazing Shibori fabric collection.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'shibori']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/shibori1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="root5">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Hand Block</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Take your pick from our wide range of hand block printed fabrics with eye
                                                catching designs and exciting colors.</p>
                                        </div>
                                        <div class="item">
                                            <p>Indulge in some unconventional hand block summer prints like</p>
                                        </div>
                                        <div class="item">
                                            <p>sanganeri and bagru (Rajasthani block prints) or more complex prints such
                                                as stencils, wooden blocks, rollers, engraved plates.</p>
                                        </div>
                                        <div class="item">
                                            <p>Wide range of fabrics are available in hand block</p>
                                        </div>
                                        <div class="item">
                                            <p>prints - dabru, ajrakh, akola, kalamkari fabrics. Hand block printed
                                                fabrics we offer come with superior finish,</p>
                                        </div>
                                        <div class="item">
                                            <p>alluring colors and attractive patterns.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'hand+blocks']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/handblock1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>


                        <div class="root6">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Handspun</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>We offer finest hand-woven natural fiber cloth - Khadi. Our commendable
                                                range of fabrics is amazing.</p>
                                        </div>
                                        <div class="item">
                                            <p>Khadi remains cool in summer and warm during winters. Light & extremely
                                                comfortable</p>
                                        </div>
                                        <div class="item">
                                            <p>to wear, it is a truly environmental fabric. It is available in different
                                                colors and types like woolen khadi,</p>
                                        </div>
                                        <div class="item">
                                            <p>muslin khadi, silk and cotton khadi. Variety of apparels like</p>
                                        </div>
                                        <div class="item">
                                            <p>jackets, saris, vests, salwar kameez, kurta pajama and dupattas can be
                                                made from Khad fabric.</p>
                                        </div>
                                        <div class="item">
                                            <p>It has coarse texture and feel makes it highly likable by the masses.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'khadi']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/handspun1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="root7">
                            <div class="root_area">
                                <div class="root_content">
                                    <h2>Cotton Indigo</h2>
                                    <div class="story_carousel2">
                                        <div class="item">
                                            <p>Indigo is a beautiful rich colour that has been used throughout
                                                history.The beauty</p>
                                        </div>
                                        <div class="item">
                                            <p>of this colour and the use of it in traditional textiles across the globe
                                                has a certain allure.</p>
                                        </div>
                                        <div class="item">
                                            <p> It is in fact the only colour and dyeing process which can achieve the
                                                shaded yet deep</p>
                                        </div>
                                        <div class="item">
                                            <p>colour on natural fabric. Cotton indigo ,in all it's shaded glory lends
                                                itself to a variety of</p>
                                        </div>
                                        <div class="item">
                                            <p>silhouettes.It stands for the earthy individuality of its wearer or the
                                                rugged steadfastness of the fabric.It</p>
                                        </div>
                                        <div class="item">
                                            <p>is a fabric that endures and achieves another dimension after every
                                                wash,bringing to it a new look and quality for years to come.</p>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['_name' => 'search', 'cotton+indigo']) ?>">
                                        <button>VIEW COLLECTION</button>
                                    </a>
                                </div>
                                <div class="root_img">
                                    <?= $this->Html->image('static/indigo1.jpg', ['class' => 'img-responsive']) ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mobile_root_visible">
                    <div class="fabric_root bttm_inner wow fadeInUp">
                        <div class="item">
                            <div class="mobile_root_visible1">
                                <a href="<?= $this->Url->build(['_name' => 'search', 'kalamkari']) ?>">
                                    <?= $this->Html->image('static/kalamkari2.jpg', ['class' => 'img-responsive']) ?>
                                    <div>
                                        <h2>Kalamkari</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="mobile_root_visible1">
                                <a href="<?= $this->Url->build(['_name' => 'search', 'ikats']) ?>">
                                    <?= $this->Html->image('static/ikat2.jpg', ['class' => 'img-responsive']) ?>
                                    <div>
                                        <h2>Ikats</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="mobile_root_visible1">
                                <a href="<?= $this->Url->build(['_name' => 'search', 'ajrak']) ?>">
                                    <?= $this->Html->image('static/ajrak2.jpg', ['class' => 'img-responsive']) ?>
                                    <div>
                                        <h2>Ajrak</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="mobile_root_visible1">
                                <a href="<?= $this->Url->build(['_name' => 'search', 'shibori']) ?>">
                                    <?= $this->Html->image('static/shibori2.jpg', ['class' => 'img-responsive']) ?>
                                    <div>
                                        <h2>Shibori</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="mobile_root_visible1">
                                <a href="<?= $this->Url->build(['_name' => 'search', 'hand+blocks']) ?>">
                                    <?= $this->Html->image('static/handblock2.jpg', ['class' => 'img-responsive']) ?>
                                    <div>
                                        <h2>Hand Block</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
					<div class="d_flex">
						<div class="mobile_root_visible1 mobile_root_visible2 mrg_bttm wow fadeInUp">
							<a href="<?= $this->Url->build(['_name' => 'search', 'cotton+indigo']) ?>">
								<?= $this->Html->image('static/indigo2.jpg', ['class' => 'img-responsive']) ?>
								<div>
									<h2>Cotton Indigo</h2>
								</div>
							</a>
						</div>
						<div class="mobile_root_visible1 mobile_root_visible2 mrg_bttm wow fadeInUp">
							<a href="<?= $this->Url->build(['_name' => 'search', 'khadi']) ?>">
								<?= $this->Html->image('static/handspun2.jpg', ['class' => 'img-responsive']) ?>
								<div>
									<h2>Handspun</h2>
								</div>
							</a>
						</div>
					</div>
                </div>

            </div>

        </div>
    </section>

    <section class="deals special_mob">
        <div class="container">
            <div class="row">
                <h2>Weddings<span></span></h2>
                <a class="wow fadeInUp" href="/product-category/big-fat-wedding">
                    <img src="/img/weddings.jpg" alt="wedding" class='img-responsive add1_img'>
                </a>
                <div style="display: flex;margin-top: 8px;align-items: center;justify-content: space-between;">
                    <p style="display: inline-block;">The big fat Indian weddings</p>
                    <a class="btn" style="border-color: #777777;color: #777777;font-size: 13px !important;padding: 2px 15px;" href="/product-category/big-fat-wedding">Explore</a>
                </div>
            </div>
        </div>
    </section>

    <?php if ($deals) : ?>
        <section class="deals special_mob">
            <div class="container">
                <div class="row">
                    <h2>Steal the Deals<span></span></h2>
                    <a class="wow fadeInUp" href="<?= $deals->uri ?>">
                        <?= $this->Media->the_image('full', $deals->media->url, ['alt' => $deals->media->alt, 'class' => 'img-responsive add1_img']) ?>
                    </a>
                    <button onclick="window.location.href = '<?= $deals->uri ?>'">Shop Now</button>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <section class="seasons">
        <div class="container">
            <div class="row">
                <h2>Seasons <span></span></h2>
                <div class="view_seasons">
                    <div class="summer wow fadeInUp">
                        <div class="summer_hv">
                            <div class="summer_img">
                                <?= $this->Html->image('summer.jpg', ['class' => 'img-responsive']) ?>
                                <div class="summer_btn"><a href="<?= $this->Url->build(['_name' => 'category', 'spring-summer']) ?>">
                                        <button>SHOP NOW</button>
                                    </a></div>
                            </div>
                            <div class="summer_content">
                                <h2>Spring/Summer</h2>
                                <p>The most popular Spring Summer fabrics are cotton ( blends, different types of
                                    weaves),
                                    linens and other cotton based special fabrics.
                                    Choose from a wide range of premium quality fabrics, which are perfect for the
                                    season.
                                    Style your dresses and tops, kurtas and kameezes, shorts, beachwear and trousers
                                    with these trendy fabrics.</p>
                                <div class="summer_btn summer_btn2"><a href="<?= $this->Url->build(['_name' => 'category', 'spring-summer']) ?>">
                                        <button>SHOP NOW</button>
                                    </a></div>
                            </div>
                        </div>
                    </div>

                    <div class="summer summer2 wow fadeInUp">
                        <div class="summer_hv">
                            <div class="summer_img">
                                <?= $this->Html->image('winter.jpg', ['class' => 'img-responsive']) ?>
                                <div class="summer_btn"><a href="<?= $this->Url->build(['_name' => 'category', 'autumn-winter']) ?>">
                                        <button>SHOP NOW</button>
                                    </a></div>
                            </div>
                            <div class="summer_content">
                                <h2>Autumn/Winter</h2>
                                <p>Explore the wide range of wintry wonderful fabrics at HP Singh. Perfect for that
                                    jacket for the fall or those trousers for that bonfire party, you can find exactly
                                    what you are looking for in our Fall Winter Collection.</p>
                                <div class="summer_btn summer_btn2"><a href="<?= $this->Url->build(['_name' => 'category', 'autumn-winter']) ?>">
                                        <button>SHOP NOW</button>
                                    </a></div>
                            </div>
                        </div>

                        <!--                        <div class="summer_color">
                                                    <h2>Shop by Winter Colors</h2>
                                                    <div class="mobile_summer_color">
                                                        <div class="mobile_summer_color2">
                                                            <div class="summer_btn_right">
                                                                <img src="/../img/winter/1.png" alt="">
                                                                <a href="#"><button>SHOP NOW</button></a>
                                                            </div>
                                                            <div class="summer_btn_right">
                                                                <img src="/../img/winter/2.png" alt="">
                                                                <a href="#"><button>SHOP NOW</button></a>
                                                            </div>
                                                            <div class="summer_btn_right">
                                                                <img src="/../img/winter/3.png" alt="">
                                                                <a href="#"><button>SHOP NOW</button></a>
                                                            </div>


                                                        </div>

                                                    </div>
                                                </div> -->
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="product_add">
        <div class="container">
            <div class="row">
                <?= $this->Html->image('add.jpg', ['class' => 'img-responsive add_product']) ?>
            </div>
        </div>
    </section>

    <?php if ($wholeSales) : ?>
        <section class="bulk desk_s">
            <div class="container">
                <div class="row">
                    <h2>Bulk/Wholesale <span></span></h2>
                    <?= $this->Media->the_image('full', $wholeSales->media->url, ['alt' => $wholeSales->media->alt]) ?>
                    <button onclick="window.location.href = '<?= $wholeSales->uri ?>'">Enquire</button>
                </div>
            </div>
        </section>
        <section class="bulk mobile_s">
            <div class="container-fluid">
                <div class="row">
                    <h2>Bulk/Wholesale <span></span></h2>
                    <?= $this->Media->the_image('full', $wholeSales->mobile_media->url, ['alt' => $wholeSales->mobile_media->alt]) ?>
                    <button onclick="window.location.href = '<?= $wholeSales->uri ?>'">Enquire</button>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <section class="arrived_store recommended_section recommended_mob recommended_bttm">
        <div class="container-fluid">
            <div class="row">
                <h2>Recommended for you<span></span></h2>
                <div class="arrived_store_carousel">
                    <!--<?= $this->Element('product', ['products' => $bestSellers]) ?>-->
					<div class="item">
                        <div class="arrived_hover">
                           <a href="/product/printed-rayon-fabric-4398820"><img src="img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_4398820-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/printed-rayon-fabric-4398820">ADD TO WISHLIST</a></button><button><a href="/product/printed-rayon-fabric-4398820">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/printed-rayon-fabric-4398820">
                           <p><em>Printed Rayon Fabric-4398820</em><em><span></span><span>₹280.00 / Mtr</span></em></p>
                        </a>
                     </div>
                     <div class="item">
                        <div class="arrived_hover">
                           <a href="/product/cotton-lurex-butta-4665722"><img src="/img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_41128321-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/cotton-lurex-butta-4665722">ADD TO WISHLIST</a></button><button><a href="/product/cotton-lurex-butta-4665722">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/cotton-lurex-butta-4665722">
                           <p><em>Cotton Lurex Butta-4665722</em><em><span></span><span>₹220.00 / Mtr</span></em></p>
                        </a>
                     </div>
                     <div class="item">
                        <div class="arrived_hover">
                           <a href="/product/cotton-lurex-stripes-4706721"><img src="/img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_4706721-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/cotton-lurex-stripes-4706721">ADD TO WISHLIST</a></button><button><a href="/product/cotton-lurex-stripes-4706721">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/cotton-lurex-stripes-4706721">
                           <p><em>Cotton Lurex Stripes-4706721</em><em><span></span><span>₹140.00 / Mtr</span></em></p>
                        </a>
                     </div>
                     <div class="item">
                        <div class="arrived_hover">
                           <a href="/product/cotton-lurex-stripes-448921"><img src="/img/lazyload.gif" data-src="https://www.hpsingh.com/media/Th_448921-(4).jpg" height="320px" width="480px" alt="" class="img-responsive lazyload"></a>
                           <p><button><a class="add-to-wishlist" href="/wishlist/add/cotton-lurex-stripes-448921">ADD TO WISHLIST</a></button><button><a href="/product/cotton-lurex-stripes-448921">VIEW PRODUCT</a></button></p>
                        </div>
                        <a href="/product/cotton-lurex-stripes-448921">
                           <p><em>Cotton Lurex Stripes-448921</em><em><span></span><span>₹100.00 / Mtr</span></em></p>
                        </a>
                     </div>
                </div>
            </div>
        </div>
    </section>


    <?php if (!$mygrams->isEmpty()) : ?>
        <section class="bulk">
            <div class="container">
                <div class="row">
                    <h2>Instagram <span></span></h2>
                    <div class="story_carousel wow fadeInUp">
                        <?php foreach ($mygrams as $mygram) : ?>
                            <div class="item">
                                <a href="<?= !empty($mygram->uri) ? $mygram->uri : 'javascript:void()' ?>">
                                    <?= $this->Media->the_image('full', $mygram->media->url, ['class' => "img-responsive", 'alt' => $mygram->media->alt]) ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->


</div>

<?php if ($popup) : ?>
    <div id="myModal_on_load" class="modal fade hide" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close hide-modal" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup_img desk_view">
                        <?= $this->Media->the_image('full', $popup->media->url, ['alt' => $popup->media->alt,]) ?>
                    </div>
                    <div class="popup_img mob_view">
                        <?= $this->Media->the_image('full', $popup->mobile_media->url, ['alt' => $popup->mobile_media->alt]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://www.google.com/recaptcha/api.js">
    grecaptcha.ready(function() {
        grecaptcha.execute('6Le54KMUAAAAAKO5rtx7uNicw_zlKvoCbuAWjNgZ', {
            action: 'homepage'
        }).then(function(token) {});
    });
</script>

<?php $this->Html->scriptStart(['block' => true]) ?>

$('.fabric_slider, .fabric_root').slick({
           dots:false,
           infinite: true,
           loop:true,
           speed: 500,
           slidesToShow: 3,
           slidesToScroll: 3,
           autoplay:true,
           autoplaySpeed: 2000,
           arrows: true,

           responsive: [{
             breakpoint: 600,
             settings: {
               slidesToShow: 3,
               slidesToScroll:1
             }
           },
           {
              breakpoint: 400,
              settings: {
                 arrows: true,
                 dots:false,
                 slidesToShow:3,
                 slidesToScroll:1,
                

              }
           }]
       });

$(document).ready(function(){
	$('.home_banner, .story_carousel2').slick({
	  slidesToShow: 1,
	  fade: true,
	  autoplay:true,
	  dots:true,
	  prevArrow: false,
	nextArrow: false
	});
  });

$('.story_carousel').slick({
  centerMode: true,
   autoplay:false,
  centerPadding: '0',
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: false,
        centerPadding:false,
        slidesToShow: 1,
        
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode:false,
        centerPadding:false,
        slidesToShow: 1
      }
    }
  ]
});


$('.all_product').slick({
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 3,
        dots:true,
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerPadding: '0px',
        arrows: false,
        slidesToShow: 1,
        dots:true,
      }
    }
  ]
});

      $('.fabric_carousel, .fabric_tab2').slick({
           dots:false,
           infinite: true,
           loop:true,
           speed: 500,
           slidesToShow: 6,
           slidesToScroll: 6,
           autoplay:true,
           autoplaySpeed: 2000,
           arrows: true,

           responsive: [{
             breakpoint: 600,
             settings: {
               slidesToShow: 5,
               slidesToScroll: 5
             }
           },
           {
              breakpoint: 400,
              settings: {
                 arrows: true,
                 dots:false,
                 slidesToShow: 5,
                 slidesToScroll: 5,
                

              }
           }]
       });

    $('.slider-for').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   asNavFor: '.slider-nav'
 });
$('.slider-nav').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   asNavFor: '.slider-for',
   dots: false,
   arrows: true,
   nav:false,
   focusOnSelect: true,
   responsive: [
     {
       breakpoint: 400,
       settings: {
       slidesToShow: 1,
       centerMode: false,
       slidesToScroll: 1
       }
     },
   ]
   
 });

 $('a[data-slide]').click(function(e) {
   e.preventDefault();
   var slideno = $(this).data('slide');
   $('.slider-nav').slick('slickGoTo', slideno - 1);
 });


 $('.slider-for_1').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   arrows: false,
   fade: true,
   asNavFor: '.slider-nav_1'
 });
 $('.slider-nav_1').slick({
   slidesToShow: 1,
   slidesToScroll: 1,
   asNavFor: '.slider-for_1',
   dots: false,
   arrows: true,
   nav:false,
   focusOnSelect: true,
   responsive: [
     {
       breakpoint: 400,
       settings: {
       slidesToShow: 1,
       centerMode: false,
       slidesToScroll: 1
       }
     },
   ]
   
 });

 $('a[data-slide]').click(function(e) {
   e.preventDefault();
   var slideno = $(this).data('slide');
   $('.slider-nav_1').slick('slickGoTo', slideno - 1);
 });


 $('.arrived_store_carousel').slick({
           dots:false,
           infinite: true,
           loop:true,
           speed: 500,
           slidesToShow: 3,
           slidesToScroll: 3,
           autoplay:true,
           autoplaySpeed: 2000,
           arrows: true,

           responsive: [{
             breakpoint: 600,
             settings: {
               slidesToShow: 1,
               arrows:false,
               slidesToScroll:1,
               
             }
           },
           {
              breakpoint: 400,
              settings: {
                 arrows:false,
                 dots:false,
                 slidesToShow:1,
                 slidesToScroll:1,
                

              }
           }]
       });

$(document).ready(function () {
$(".banner_tab ul>li, .root ul>li").click(function () {
$(this).addClass('active');
$(this).siblings().removeClass('active');
});
});

$(document).ready(function () {
	$(".fabric1").click(function () {
	$(".fabric_icon").addClass('active');
	$(".fabric_icon2").removeClass('active');
	<!--$(".fabric_icon3").removeClass('active');-->
	});
	$(".fabric2").click(function () {
	$(".fabric_icon").removeClass('active');
	$(".fabric_icon2").addClass('active');
	<!--$(".fabric_icon3").removeClass('active');-->
	});
	
});


$(document).ready(function () {
$(".root_list1").click(function () {
$(".root1").addClass('active');
$(".root2, .root3, .root4, .root5, .root6, .root7, .root8").removeClass('active');
});
$(".root_list2").click(function () {
$(".root2").addClass('active');
$(".root1, .root3, .root4, .root5, .root6, .root7, .root8").removeClass('active');
});
$(".root_list3").click(function () {
$(".root3").addClass('active');
$(".root2, .root1, .root4, .root5, .root6, .root7, .root8").removeClass('active');
});
$(".root_list4").click(function () {
$(".root4").addClass('active');
$(".root2, .root3, .root1, .root5, .root6, .root7, .root8").removeClass('active');
});
$(".root_list5").click(function () {
$(".root5").addClass('active');
$(".root2, .root3, .root4, .root1, .root6, .root7, .root8").removeClass('active');
});
$(".root_list6").click(function () {
$(".root6").addClass('active');
$(".root2, .root3, .root4, .root5, .root1, .root7, .root8").removeClass('active');
});
$(".root_list7").click(function () {
$(".root7").addClass('active');
$(".root2, .root3, .root4, .root5, .root6, .root1, .root8").removeClass('active');
});

});


$('.moreless-button').click(function() {
$('.moretext').slideToggle();
if ($('.moreless-button').text() == "Read more") {
$(this).text("Read less")
} else {
$(this).text("Read more")
}
});

AOS.init({
duration: 1200,
})

new WOW().init();

$(".best_categories_content a").click(function(e){
e.stopPropagation();
});
<?php $this->Html->scriptEnd() ?>