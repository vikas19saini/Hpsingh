<?php $this->Paginator->setTemplates(['nextActive' => '<button onclick="loadMore(\'{{url}}\')">{{text}}</button>']); ?>

<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
   <?= $this->Element('breadcrumb')?>
    <section class="product_area">
        <div class="container">
            <div class="row">
                <div class="multipal_product">
                    <?= $this->fetch('filters')?>

                   <?php if(!$products->isEmpty()):?>
                    <div class="product_right">
                        <div class="product_filter">
                            <?= $this->fetch('applied_filters')?>
                            <?= $this->fetch('sort')?>
                        </div>
                        <div class="product_right_img" id="archiveProducts">
                            <?= $this->Element('archive_product')?>
                        </div>
                        <div class="product_btn" id="currentPage">
                            <?= $this->Paginator->next('LOAD MORE PRODUCTS', ['escape' => false]);?>
                        </div>
                    </div>
                    <?php else:?>
                    <div class="product_right">
                        <section class="empty-cart">
                            <div class="empty-cart_main">
                                <?= $this->Html->image('empty_cart.jpg')?>
                                <h2>We couldn't find any matches!</h2>
                                <a href="javascript:window.history.back()" class="empty-button">GO BACK</a>
                            </div>
                        </section>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </section>
    <section class="mobile_btn filter_multipal">
        <button class="filter1">FILTER</button>
        <button  class="filter2">SORT</button>
    </section>
    <section class="sort_mob">
        <div class="sort_content">
            <h2>Sort By</h2>
            <ul>
                <li><?= $this->Paginator->sort('ragular_price', 'Price Low To High', ['direction' => 'asc'])?></li>
                <li><?= $this->Paginator->sort('ragular_price', 'Price High To Low', ['direction' => 'desc'])?></li>
            </ul>
        </div>
        <div class="sort_multipal_close"><a href="javascript:void(0)">Close</a></div>
    </section>
    
    <!-- footer area start -->
   <?= $this->Element('footer')?>
    <!-- footer area end -->
</div>

<?php $this->Html->scriptStart(['block' => true])?>
$(document).ready(function() {
    $(".filter_multipal .filter1").click(function() {
        $(".product_area .product_left").toggleClass('active');
    });
    $(".filter_multipal_close>a").click(function() {
        $(".product_area .product_left").removeClass('active');
    });
    $(".filter_multipal .filter2").click(function() {
        $(".sort_mob").toggleClass('active');
    });
    $(".sort_multipal_close>a").click(function() {
        $(".sort_mob").removeClass('active');
    });
});    
<?php $this->Html->scriptEnd()?>