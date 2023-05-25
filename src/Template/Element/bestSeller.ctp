<?php 

$bestSellers = [
    [
        'name' => 'Linen Fabrics',
        'img' => 'linen.jpg',
        'term' => 'linen',
        '_name' => 'search',
        'desc' => 'A natural fiber just like cotton, linen is derived from the flax plant. It is very strong, lightweight and breathable making it a popular choice in summers.'
    ],
    [
        'name' => 'Thread Embroidery',
        'img' => 'thread-Embroidery.jpg',
        '_name' => 'category',
        'term' => 'cotton/embroideries',
        'desc' => 'Thread embroideries which are created to bring so much beauty to the fabric. These will be perfect for your wardrobe with their trendy patterns and latest designs.',
    ],
    [
        'name' => 'Tussar',
        'img' => 'tussar.jpg',
        'desc' => 'Tussar silk fabric with a plain weave has a silk foundation. Tussar silk is woven into marvels that edify you while adding a contemporary touch. carefully constructed from tough tussar cloth. suitable for using to make dresses.',
        '_name'=> 'search',
        'term' => 'tussar'
    ],
    [
        'name' => 'Linen Embroidery',
        'img' => 'LinenEmbroidery.jpg',
        'desc' => 'Embroidered linen fabric is a plain weave linen-based fabric. Linen is a natural fibre famous for its silky lustre, smoothness, and high comfort value. Often used in the creation or design of gowns.',
        '_name'=> 'search',
        'term' => 'linen'
    ],
    [
        'name' => 'Kalamkari',
        'img' => 'kalamkari.jpg',
        'desc' => 'Kalamkari printed fabric is a cotton cambric plain weave fabric. Kalamkari painting is the greatest example of natural colour artwork. Kalamkari is a type of hand printing or block printing that is often done on cotton fabrics using only vegetable dyes or natural colours.',
        '_name'=> 'search',
        'term' => 'kalamkari'
    ],
    [
        'name' => 'Chanderi',
        'img' => 'chanderi.jpg',
        'desc' => 'It is a traditionally ethnic cloth known for its light weight and opulent beauty. Chanderi was named after a little village in Madhya Pradesh where ethnic weavers made traditional fabrics in silk and cotton with beautiful zari embellishments. Commonly used in the manufacture of clothes.',
        '_name'=> 'search',
        'term' => 'chanderi'
    ]
];

$sections = array_chunk($bestSellers, 3);

?>

    <section class="best_categories">
        <div class="container">
            <div class="row">
                <h2>Bestsellers<span></span></h2>
            </div>
            <div class="mob_hd">
                <div class="row">
                    <div class="col-md-7 col-xs-7 mob_pad_0">
                        <div id="sync1" class="owl-carousel owl-theme top_head_sec view_best_categories">
                            <?php foreach($sections[0] as $row):?>
                                <div class="item">
                                    <div class="best_categories_img ">
                                        <?= $this->Html->image($row['img'], ['class' => 'img-responsive']) ?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <div class="col-md-5 col-xs-5 mob_pad_0">
                        <div id="sync2" class="owl-carousel owl-theme bttm_inner">
                            <?php foreach($sections[0] as $row):?>
                                <div class="item">
                                    <div class="best_categories_content">
                                        <h2><?= $row['name'] ?></h2>
                                        <p><?= $row['desc']?></p>
                                        <a href="<?= $this->Url->build(['_name' => $row['_name'], $row['term']]) ?>">
                                            <button>SHOP NOW</button>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 col-xs-5 mob_pad_0">
                        <div id="sync4" class="owl-carousel owl-theme bttm_inner">
                            <?php foreach($sections[1] as $row):?>
                                <div class="item">
                                    <div class="best_categories_content">
                                        <h2><?= $row['name'] ?></h2>
                                        <p><?= $row['desc']?></p>
                                        <a href="<?= $this->Url->build(['_name' => $row['_name'], $row['term']]) ?>">
                                            <button>SHOP NOW</button>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="col-md-7 col-xs-7 mob_pad_0">
                        <div id="sync3" class="owl-carousel owl-theme bttm_inner">
                        <?php foreach($sections[1] as $row):?>
                                <div class="item">
                                    <div class="best_categories_img ">
                                        <?= $this->Html->image($row['img'], ['class' => 'img-responsive']) ?>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row on_mob_show">
                <div class="mob_pad_0">
                    <div class="owl-carousel all_product owl-theme bttm_inner">
                        <?php foreach($bestSellers as $row):?>
                            <div class="item">
                                <div class="dis_flx">
                                    <div class="best_categories_img">
                                        <?= $this->Html->image($row['img'], ['class' => 'img-responsive']) ?>
                                    </div>
                                    <div class="best_categories_content">
                                        <h2><?= $row['name']?></h2>
                                        <a href="<?= $this->Url->build(['_name' => $row['_name'], $row['term']]) ?>">
                                            <button>SHOP NOW</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>