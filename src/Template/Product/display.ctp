<style>
    #productZoom .popup_section2 {
        background-color: #ded7cd94;
    }

    #productZoom .popup_section2_img img {
        border: 1px solid #fff;
    }

    #productZoom {
        padding-right: 0px !important;
    }

    @media screen and (max-width: 767px) {
        #productZoom .popup_section2 {
            background-color: transparent !important;
        }

        .product_details_left .product_d .marquee .owl-stage-outer .owl-stage .owl-item .item img.joda-class-css {
            height: auto !important;
        }
    }

    .joda-class-css {
        width: auto !important;
        margin: 0 auto !important;
    }
</style>
<?php

$this->assign('bodyClass', 'product_details-page');
$this->assign('title', empty($product->meta_title) ? $product->name : $product->meta_title);

$ogTitle = strip_tags(empty($product->meta_title) ? $product->name : $product->meta_title);
$ogDescription = strip_tags(empty($product->meta_description) ? $product->short_description : $product->meta_description);

$productMetaData = $this->Html->meta('description', $product->meta_description);
$productMetaData .= $this->Html->meta('keywords', $product->meta_keywords);
$productMetaData .= $this->Html->meta(['property' => 'og:title', 'content' => $ogTitle]);

$productMetaData .= $this->Html->meta(['property' => 'og:description', 'content' => $ogDescription]);

$ogImage = empty($product->media) ? $this->Media->placeholderImage('url') : $this->Media->get_the_image_url('full', $product->media[0]->url);

$productMetaData .= $this->Html->meta(['property' => 'og:image', 'content' => $ogImage]);
$productMetaData .= $this->Html->meta(['property' => 'og:image:secure_url', 'content' => $ogImage]);

$productMetaData .= $this->Html->meta(['itemprop' => 'name', 'content' => $ogTitle]);
$productMetaData .= $this->Html->meta(['itemprop' => 'url', 'content' => $this->Url->build(null, true)]);
$productMetaData .= $this->Html->meta(['itemprop' => 'image', 'content' => $ogImage]);

$productMetaData .= $this->Html->meta(['property' => 'product:brand', 'content' => "HpSingh"]);
$productMetaData .= $this->Html->meta(['property' => 'product:availability', 'content' =>  $product->in_stock ? "in stock" : "out of stock"]);
$productMetaData .= $this->Html->meta(['property' => 'product:condition', 'content' =>  "new"]);
$productMetaData .= $this->Html->meta(['property' => 'product:price:amount', 'content' =>  $product->ragular_price]);
$productMetaData .= $this->Html->meta(['property' => 'product:retailer_item_id', 'content' =>  $product->id]);
$productMetaData .= $this->Html->meta(['property' => 'product:price:currency', 'content' =>  "INR"]);
$productMetaData .= $this->Html->meta(['property' => 'product:category', 'content' =>  "47"]);
$productMetaData .= $this->Html->meta(['property' => 'product:category', 'content' =>  "Arts & Entertainment > Hobbies & Creative Arts > Arts & Crafts > Art & Crafting Materials > Textiles > Fabric"]);

$pathCate = [];
if (!empty($categoryPath)) {
    foreach ($categoryPath as $category) {
        array_push($pathCate, $category->name);
    }
}

$isJoda = in_array('Joda by HPSingh', $pathCate);

// for tag page
if ($this->request->getParam('action') === 'tag')
    array_push($pathCate, $category->name);

if ($this->request->getParam('action') === 'search')
    array_push($pathCate, $category->name);

$matirial = end($pathCate);
$productMetaData .= $this->Html->meta(['property' => 'product:material', 'content' =>  $matirial]);
$productMetaData .= $this->Html->meta(['property' => 'product:type', 'content' =>  implode(">", $pathCate)]);

$productMetaData .= '<meta name="twitter:card" content="summary_large_image" />';
$productMetaData .= $this->Html->meta('twitter:title', $ogTitle);
$productMetaData .= $this->Html->meta('twitter:description', $ogDescription);
$productMetaData .= $this->Html->meta('twitter:image', $ogImage);

$this->assign('meta', $productMetaData);
$jsonMetaData = [
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'productID' => $product->id,
    'name' => $ogTitle,
    'image' => $ogImage,
    'sku' => $product->design_no,
    'mpn' => $product->design_no,
    'description' => $ogDescription,
    'offers' => [
        '@type' => 'Offer',
        'priceCurrency' => 'INR',
        'availability' => $product->in_stock ? 'in stock' : 'out of stock',
        'price' => $product->ragular_price,
        'url' => $this->Url->build(null, true),
    ],
    "brand" => "HpSingh"
];
?>
<?= $this->Element('header') ?>
<script type="application/ld+json">
    <?= json_encode($jsonMetaData, JSON_UNESCAPED_SLASHES) ?>
</script>
<div class="mobile_hidden_vissible">

    <?= $this->Element('breadcrumb') ?>

    <section class="product_details">
        <div class="container">
            <div class="row">
                <div class="product_details_main">
                    <div class="product_details_left">
                        <?php $medias = $product->media; ?>
                        <div class="product_d">
                            <!--<div class="owl-carousel owl-theme marquee">
                                <?php $count = 0;
                                foreach ($medias as $media) : ?>
                                    <div class="item" data-img="<?= $this->Media->get_the_image_url('full', $media->url) ?>">
                                        <img src="/img/lazyload.gif" data-src="<?= $this->Media->get_the_image_url('full', $media->url) ?>" height="476px" width="700px" alt="<?= $product->featured_image->alt ?>" class="img-responsive lazyload productThumbs <?= $isJoda ? "joda-class-css" : "" ?>" data-toggle="modal" data-target="#productZoom" data-pos="<?= $count ?>">
                                        <?php // $this->Media->the_image('full', $media->url, ['class' => 'img-responsive productThumbs', 'alt' => $media->alt, 'height' => '476px', 'width' => '700px', 'data-toggle' => "modal", 'data-target' => '#productZoom', 'data-pos' => $count])
                                        ?>
                                    </div>
                                <?php $count++;
                                endforeach; ?>
                            </div>-->
							
							<div class="product-slide marquee">
                                <?php $count = 0;
                                foreach ($medias as $media) : ?>
                                    <div class="" data-img="<?= $this->Media->get_the_image_url('full', $media->url) ?>">
                                        <img src="/img/lazyload.gif" data-src="<?= $this->Media->get_the_image_url('full', $media->url) ?>" height="476px" width="700px" alt="<?= $product->featured_image->alt ?>" 
										class="img-responsive  lazyload productThumbs" data-toggle="modal" data-target="#productZoom" data-pos="<?= $count ?>" >
                                        <?php // $this->Media->the_image('full', $media->url, ['class' => 'img-responsive productThumbs', 'alt' => $media->alt, 'height' => '476px', 'width' => '700px', 'data-toggle' => "modal", 'data-target' => '#productZoom', 'data-pos' => $count])
                                        ?>
                                    </div>
                                <?php $count++;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="product_details_right">
                        <h2><?= $product->name ?></h2>
                        <hr />
                        <?= $this->Element('addtocart', ['product' => $product]) ?>
                        <p class="product_details_right_p5">Product Specification / Details</p>
                        <ul class="product_details_right_p6">
                            <?php if (!empty($product->fabric_name)) : ?>
                                <li>Fabric Name</li>
                                <li><?= $product->fabric_name ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->weave)) : ?>
                                <li>Weave</li>
                                <li><?= $product->weave ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->weight)) : ?>
                                <li>Weight</li>
                                <li><?= $product->weight ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->width)) : ?>
                                <li>Width</li>
                                <li><?= $product->width ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->length)) : ?>
                                <li>Length</li>
                                <li><?= $product->length ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->count)) : ?>
                                <li>Count</li>
                                <li><?= $product->count ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->content)) : ?>
                                <li>Content</li>
                                <li><?= $product->content ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->design_no)) : ?>
                                <li>Design No</li>
                                <li><?= $product->design_no ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->weight_feel_suitability)) : ?>
                                <li>Weight/Feel</li>
                                <li><?= $product->weight_feel_suitability ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->design_name_color)) : ?>
                                <li>Design Name/Color</li>
                                <li><?= $product->design_name_color ?></li>
                            <?php endif; ?>

                            <?php if (!empty($product->price_text)) : ?>
                                <li>Price</li>
                                <li><?= $product->price_text ?></li>
                            <?php endif; ?>
                        </ul>
                        <form class="delivery_option" onsubmit="return false;">
                            <h3>Check for delivery option</h3>
                            <p>
                                <input type="text" placeholder="Enter postcode" id="delivery-postcode" autocomplete="off" required>
                                <?= $this->Form->select('delivery-country-code', $countries, ['id' => 'delivery-country-code', 'value' => 'IN']) ?>
                                <?= $this->Form->hidden('delivery-product_id', ['value' => $product->id, 'id' => 'delivery-product_id']) ?>
                                <button type="submit" id="check-delivery">CHECK</button>
                            </p>
                            <div class="delivery-details-display"></div>
                        </form>
                        <div class="product_d3">
                            <?php if (!empty($product->long_description)) : ?>
                                <h2>Product Description</h2>
                                <p>
                                    <?= $product->long_description ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($product->short_description)) : ?>
                                <h2>Applications</h2>
                                <p>
                                    <?= $product->short_description ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="product-enquiry">
                            <h4>Need help with this product?</h4>
                            <div class="engroup">
                                <a target="_blank" href="tel:<?= \Cake\Core\Configure::read('Store.supportContact') ?>">
                                    <div>
                                        <i class="fa fa-mobile" aria-hidden="true"></i>
                                        <p>Give us a call</p>
                                        <span>Mon - Sat | 10 AM to 7 PM</span>
                                    </div>
                                </a>
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= \Cake\Core\Configure::read('Store.supportWhatsapp') ?>">
                                    <div>
                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                        <p>Chat with us on WhatsApp</p>
                                        <span>Mon - Sat | 10 AM to 7 PM</span>
                                    </div>
                                </a>
                                <a target="_blank" href="mailto:<?= \Cake\Core\Configure::read('Store.supportEmail') ?>">
                                    <div>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <p>Drop us an email</p>
                                        <span>We'll get back to you within 24 hours</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="arrived_store recommended_section">
        <div class="container-fluid">
            <div class="row">
                <h2>You May Also Like<span></span></h2>
                <div class="arrived_store_carousel">
                    <?= $this->Element('product', ['products' => $recommendedProducts]) ?>
                </div>

            </div>
        </div>
    </section>
    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>

<div class="modal fade" id="productZoom" role="dialog" style="overflow: hidden;max-width:980px;margin: 0 auto;padding-right: 0px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="popup_section1 zoom" id="large-image">
                <img src="" class="dynamic_img">
            </div>
        </div>
        <div class="popup_section2" style="overflow: hidden">
            <div class="close_popup" data-dismiss="modal"></div>
            <div class="popup_section2_img">
                <?php $count = 0;
                foreach ($medias as $media) : ?>
                    <?= $this->Media->the_image('full', $media->url, ['class' => 'img-responsive productBigThumbs', 'alt' => $media->alt, 'data-pos' => $count]) ?>
                <?php $count++;
                endforeach; ?>
            </div>
        </div>
    </div>

    <?php $this->Html->scriptStart(['block' => true]) ?>
		
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
		
		$('.product-slide').slick({
         slidesToShow: 1,
         infinite: true,
         fade: true,
         autoplay:true,
         dots:true,
         arrows: true,
         prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
         nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
        });
        responsive: [{
           breakpoint: 600,
           settings: {
             slidesToShow: 1,
             arrows:false,
             slidesToScroll:1,
             dots:true,
             
           }
         },
         {
            breakpoint: 400,
            settings: {
               arrows:false,
               dots:true,
               slidesToShow:1,
               slidesToScroll:1,
              

            }
         }]
	
		$(document).ready(function () {
			$(".marquee .slick-slide.slick-current.slick-active").click(function () {
			var dynamicImg = $(this).attr("data-img");
			$(".dynmaic_product").attr("src", dynamicImg);
			})
		});
		$(document).ready(function () {
			$(".popup_section2_img img").click(function () {
			var dynamicImg2 = $(this).attr("data-img");
			$(".dynamic_img").attr("src", dynamicImg2);
			});
		});
		$(".productThumbs").click(function () {
			var productThumbsPos = $(this).attr('data-pos');
			$(".dynamic_img").attr('src', $('.productBigThumbs[data-pos='+productThumbsPos+']').attr('src'));
			$(".productBigThumbs").removeClass('selected');
			$('.productBigThumbs[data-pos=' + productThumbsPos + ']').addClass('selected');
			$(".zoomImg").remove();
			$("#large-image").zoom();
		});
		$(".productBigThumbs").click(function () {
			var productBigThumbsPos = $(this).attr('data-pos');
			$(".dynamic_img").attr('src', $(this).attr('src'));
			$(".productBigThumbs").removeClass('selected');
			$(this).addClass('selected');
			$(".zoomImg").remove();
			$("#large-image").zoom();
		});
		$("#productZoom").on("show", function () {
			$("body").addClass("modal-open");
		}).on("hidden", function () {
			$("body").removeClass("modal-open")
		});
		
    <?php $this->Html->scriptEnd() ?>