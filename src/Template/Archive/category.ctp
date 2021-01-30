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

$this->extend('display');
?>

<?php $this->start('filters') ?>

<div class="product_left">
    <div class="filter_multipal_close"><a href="javascript:void(0);">Close</a></div>

    <div class="accordion">

        <?php if (isset($subCategories)) : if (iterator_count($subCategories) > 0) : ?>
                <h4 class="accordion-toggle">More in <?= $category->name ?></h4>
                <div class="accordion-content">
                    <?php foreach ($subCategories as $subCategory) : ?>
                        <p><?= $this->Cell('Category::subCategory', [$subCategory]) ?></p>
                    <?php endforeach; ?>
                </div>
        <?php endif;
        endif; ?>


        <h4 class="accordion-toggle">Price Range</h4>
        <div class="accordion-content" <?= !empty($this->request->getQuery('price')) ? 'style="display:block"' : '' ?>>
            <?php if (!empty($this->request->getQuery('price'))) : ?>
                <p>
                    <a href="<?= $this->Paginator->generateUrl(['price' => '0', 'page' => null]) ?>"><i class="fa fa-times-circle" aria-hidden="true"></i> Clear All</a>
                </p>
            <?php endif; ?>
            <p class="<?= $this->request->getQuery('price') === '50,250' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '50,250', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(50), $defaultCurrency->code) ?> - <?= $this->Number->currency($this->Product->convertPrice(250), $defaultCurrency->code) ?></price>
                </a></p>
            <p class="<?= $this->request->getQuery('price') === '251,500' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '251,500', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(251), $defaultCurrency->code) ?> - <?= $this->Number->currency($this->Product->convertPrice(500), $defaultCurrency->code) ?></price>
                </a></p>
            <p class="<?= $this->request->getQuery('price') === '501,1000' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '501,1000', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(501), $defaultCurrency->code) ?> - <?= $this->Number->currency($this->Product->convertPrice(1000), $defaultCurrency->code) ?></price>
                </a></p>
            <p class="<?= $this->request->getQuery('price') === '1001,2000' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '1001,2000', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(1001), $defaultCurrency->code) ?> - <?= $this->Number->currency($this->Product->convertPrice(2000), $defaultCurrency->code) ?></price>
                </a></p>
            <p class="<?= $this->request->getQuery('price') === '2001,5000' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '2001,5000', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(2001), $defaultCurrency->code) ?> - <?= $this->Number->currency($this->Product->convertPrice(5000), $defaultCurrency->code) ?></price>
                </a></p>
            <p class="<?= $this->request->getQuery('price') === '5001,10000' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '5001,10000', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(5001), $defaultCurrency->code) ?> - <?= $this->Number->currency($this->Product->convertPrice(10000), $defaultCurrency->code) ?></price>
                </a></p>
            <p class="<?= $this->request->getQuery('price') === '10001' ? 'archive_filter_selected' : 'archive_filter' ?>"><a href="<?= $this->Paginator->generateUrl(['price' => '10001', 'page' => null]) ?>">
                    <price><?= $this->Number->currency($this->Product->convertPrice(10001), $defaultCurrency->code) ?> - Above
                </a></p>
        </div>

        <?php if ($this->request->getQuery('hideColorFilter') !== "yes") : ?>
            <?php
            if (isset($colors)) : if (iterator_count($colors) > 0) :
                    $colorFilter = $this->request->getQuery('color');
                    $colorFilterArr = [];
                    if (!empty($colorFilter)) {
                        $colorFilterArr = @explode(',', $colorFilter);
                    }
            ?>
                    <h4 class="accordion-toggle">Colors</h4>
                    <div class="accordion-content" <?= !empty($colorFilter) ? 'style="display:block"' : '' ?>>

                        <?php if (!empty($this->request->getQuery('color'))) : ?>
                            <p>
                                <a href="<?= $this->Paginator->generateUrl(['color' => '0']) ?>">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i> Clear All
                                </a>
                            </p>
                        <?php endif; ?>

                        <?php
                        foreach ($colors as $color) :
                            if (!empty($colorFilterArr)) {
                                $colorFilterSingle = (!in_array($color->name, $colorFilterArr)) ? array_merge($colorFilterArr, [$color->name]) : '';
                                $queryString = @implode(',', $colorFilterSingle);
                                $filterUrl = $this->Paginator->generateUrl(['color' => $queryString, 'page' => null]);
                            } else {
                                $filterUrl = $this->Paginator->generateUrl(['color' => $color->name, 'page' => null]);
                            }
                        ?>

                            <p class="<?= in_array($color->name, $colorFilterArr) ? 'archive_color_filter_selected' : 'archive_color_filter' ?>">
                                <a href="<?= $filterUrl ?>">
                                    <span class="color_filter" style="background:<?= $color->color_code ?>"></span>
                                    <price><?= $color->name ?></price>
                                </a>
                            </p>
                        <?php endforeach; ?>

                    </div>
        <?php endif;
            endif;
        endif; ?>

        <?php if (!$discounts->isEmpty()) : $discount_applied = $this->request->getQuery('discount'); ?>
            <h4 class="accordion-toggle">Discounts</h4>
            <div class="accordion-content" <?= !empty($discount_applied) ? 'style="display:block"' : '' ?>>
                <?php if (!empty($this->request->getQuery('discount'))) : ?>
                    <p>
                        <a href="<?= $this->Paginator->generateUrl(['discount' => '0', 'page' => null]) ?>">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> Clear All
                        </a>
                    </p>
                <?php endif; ?>
                <?php foreach ($discounts as $discount) : $discount_text = $this->Number->format($discount->discount, ['precision' => 0]); ?>
                    <p class="<?= ($discount_applied == $discount_text) ? 'archive_filter_selected' : 'archive_filter' ?>">
                        <a href="<?= $this->Paginator->generateUrl(['discount' => $discount_text, 'page' => null]) ?>">
                            <price><?= $discount_text ?>% and above</price>
                        </a>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <?php $availability = $this->request->getQuery('stock') ?>

        <h4 class="accordion-toggle">Availability</h4>
        <div class="accordion-content" <?= !empty($availability) ? 'style="display:block"' : '' ?>>

            <?php if (!empty($this->request->getQuery('stock'))) : ?>
                <p>
                    <a href="<?= $this->Paginator->generateUrl(['stock' => '0', 'page' => null]) ?>">
                        <i class="fa fa-times-circle" aria-hidden="true"></i> Clear All
                    </a>
                </p>
            <?php endif; ?>

            <p class="<?= ($availability == 'in_stock') ? 'archive_filter_selected' : 'archive_filter' ?>">
                <a href="<?= $this->Paginator->generateUrl(['stock' => 'in_stock', 'page' => null]) ?>">
                    <price>Only in stock</price>
                </a>
            </p>
            <p class="<?= ($availability == 'all') ? 'archive_filter_selected' : 'archive_filter' ?>">
                <a href="<?= $this->Paginator->generateUrl(['stock' => 'all', 'page' => null]) ?>">
                    <price>Include out of stock</price>
                </a>
            </p>
        </div>
    </div>
</div>

<?php $this->end() ?>

<?php $this->start('applied_filters') ?>
<div class="product_filter_left">
    <p><?= $category->name ?> <span><em>- <?= $this->Paginator->params()['count'] ?> Fabrics</em></span></p>
    <div class="filter_cls">
        <?php

        if (!empty($this->request->getQuery('price'))) {
            $price = @explode(',', $this->request->getQuery('price'));
            $from = $this->Product->convertPrice($price[0]);
            $to = !empty($price[1]) ? $this->Product->convertPrice($price[1]) : 'Above';
            echo '<span>Price', $from, '-', $to, '<span class="cls"> <a href="', $this->Paginator->generateUrl(['price' => '0']), '">&times;</a></span></span>';
        }

        $colorFilters = $this->request->getQuery('color');
        if (!empty($colorFilters)) {
            $colorFiltersArr = @explode(',', $colorFilters);
            if (count($colorFiltersArr) > 1) {
                foreach ($colorFiltersArr as $colorFilter) {
                    $colorFilterStr = array_diff($colorFiltersArr, [$colorFilter]);
                    $colorFilterStr = @implode(',', $colorFilterStr);
                    echo '<span>', $colorFilter, '<span class="cls"><a href="', $this->Paginator->generateUrl(['color' => $colorFilterStr, 'page' => null]), '">&times;</a></span></span>';
                }
            } else {
                echo '<span>', $colorFiltersArr[0], '<span class="cls"><a href="', $this->Paginator->generateUrl(['color' => 0, 'page' => null]), '">&times;</a></span></span>';
            }
        }

        if (!empty($this->request->getQuery('discount'))) {
            echo '<span>Discount ', $this->request->getQuery('discount'), '% & above<span class="cls"><a href="', $this->Paginator->generateUrl(['discount' => 0, 'page' => null]), '">&times;</a></span></span>';
        }

        if (!empty($this->request->getQuery('stock'))) {
            echo '<span>Include ', str_replace('_', ' ', $this->request->getQuery('stock')), ' products<span class="cls"><a href="', $this->Paginator->generateUrl(['stock' => 0, 'page' => null]), '">&times;</a></span></span>';
        }

        ?>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('sort') ?>

<div class="product_filter_right">
    <div class="dropdown">
        <button class="dropdown-toggle" data-toggle="dropdown">
            <?php
            if ($this->request->getQuery('sort') === 'ragular_price') {

                if ($this->request->getQuery('direction') === 'asc') {
                    echo 'Price Low To High';
                }

                if ($this->request->getQuery('direction') === 'desc') {
                    echo 'Price High To Low';
                }
            } else {
                echo 'Price Sort By';
            }
            ?>
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><?= $this->Paginator->sort('ragular_price', 'Price Low To High', ['direction' => 'asc']) ?></li>
            <li><?= $this->Paginator->sort('ragular_price', 'Price High To Low', ['direction' => 'desc']) ?></li>
        </ul>
    </div>
</div>

<?php $this->end() ?>