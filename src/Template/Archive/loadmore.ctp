<?= $this->Element('archive_product') ?>

<div class="product_btn" id="nextPage" style="display:none">
    <?php 
    $this->Paginator->setTemplates([
        'nextActive' => '<button onclick="loadMore(\'{{url}}\')">{{text}}</button>',
    ]);
    ?>
    <?= $this->Paginator->next('LOAD MORE PRODUCTS', ['escape' => false]); ?>
</div> 