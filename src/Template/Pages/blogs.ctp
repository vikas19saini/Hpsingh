<?php

/* Template Name: Contact Page */

    $this->assign('bodyClass', 'contact_page');
    $this->assign('title', 'Stories - Hpsingh');
    $this->assign('meta', $this->Html->meta('description', 'Stories - Hpsingh'));
?>
<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
    <section>
        <div class="cotton_content">
            <div class="container">
                <div class="row">
                    <h2>STORIES</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach($stories as $story):?>
                <div class="main_blog flx_middle flx">
                    <div class="blog_img">
                        <?= $story->has('media') ? $this->Media->the_image('full', $story->media->url) : $this->Media->placeholderImage()?>
                        <div class="date_of">
                            <span><?= date_format($story->created, 'd')?></span>
                            <span><?= date_format($story->created, 'M')?></span>
                        </div>
                    </div>    
                    <div class="blog_tx">
                        <h4><?= $story->title?></h4>
                        <p>
                            <?php $pos = strpos($story->content, ' ', 150); echo strip_tags(substr($story->content, 0, $pos))?>
                        </p> 
                        <p><a href="<?= $this->Url->build(['_name' => 'stories', $story->slug])?>">READ MORE</a></p>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>        
    <?= $this->Element('footer') ?>            
    </section>
