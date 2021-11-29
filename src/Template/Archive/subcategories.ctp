<?php

$this->assign('bodyClass', 'product-page');
$this->assign('title', empty($category->meta_title) ? $category->name : $category->meta_title);

$ogTitle = strip_tags(empty($category->meta_title) ? $category->name : $category->meta_title);
$ogDescription = strip_tags(empty($category->meta_description) ? $category->short_description : $category->meta_description);

$productMetaData = $this->Html->meta('description', $category->meta_description);
$productMetaData .= $this->Html->meta('keywords', $category->meta_keywords);

$productMetaData .= $this->Html->meta('og:title', $ogTitle);

$productMetaData .= $this->Html->meta('og:description', $ogDescription);

$ogImage = empty($category->banner_image) ? $this->Media->placeholderImage('url') : $this->Media->get_the_image_url('full', $category->banner_image->url);

$productMetaData .= $this->Html->meta('og:image', $ogImage);
$productMetaData .= $this->Html->meta('og:image:secure_url', $ogImage);

$productMetaData .= '<meta name="twitter:card" content="summary_large_image" />';
$productMetaData .= $this->Html->meta('twitter:title', $ogTitle);
$productMetaData .= $this->Html->meta('twitter:description', $ogDescription);
$productMetaData .= $this->Html->meta('twitter:image', $ogImage);

$this->assign('meta', $productMetaData);
?>

<?= $this->Element('header') ?>
<div class="mobile_hidden_vissible">
    <div class="cotton_content">
        <div class="container">
            <div class="row">
                <h2><?= $category->name ?></h2>
            </div>
        </div>
    </div>
    <div class="Sub-Category">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="Sub-Category_img">
                        <?php foreach ($subCategories as $single_sub_category) : ?>
                            <div class="sigle-subcategory">
                                <?php if (empty($single_sub_category->subcategory_image)) : ?>
                                    <?= $this->Html->image('image_placeholder.png', ['class' => 'img-responsive']) ?>
                                <?php else : ?>
                                    <?= $this->Media->the_image('full', $single_sub_category->subcategory_image->url, ['class' => 'img-responsive', 'alt' => $single_sub_category->subcategory_image->alt]) ?>
                                <?php endif; ?>
                                <div class="subcategory-link">
                                    <p><?= $single_sub_category->name ?></p>
                                    <?php if (empty($single_sub_category->url)) : ?>
                                        <?= $this->Cell('Category::getProductsCount', [$single_sub_category->id]) ?>
                                        <a href="<?= $this->Url->build(['_name' => 'category', $slug . '/' . $single_sub_category->slug]) ?>">SHOP NOW</a>
                                    <?php else : ?>
                                        <a href="<?= $single_sub_category->url ?>">SHOP NOW</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="cotton_content bttm_Tx">
        <div class="container">
            <div class="row">
                <p><?= $category->description ?></p>
            </div>
        </div>
    </div>

    <!-- footer area start -->
    <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>