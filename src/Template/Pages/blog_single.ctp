<?php

/* Template Name: Contact Page */

    $this->assign('bodyClass', 'contact_page');
    $this->assign('title', $story->title);
    $this->assign('meta', $this->Html->meta('description', $story->title));
?>
<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
    <section>
        <div class="cotton_content">
            <div class="container">
                <div class="row">
                    <h2><?= $story->title?></h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                    <div class="blog_dice">
                        <?= $story->has('media') ? $this->Media->the_image('full', $story->media->url) : $this->Media->placeholderImage()?>
                        <div class="date_of">
                            <span><?= date_format($story->created, 'd')?></span>
                            <span><?= date_format($story->created, 'M')?></span>
                        </div>
                    </div>    
                    <div class="dis_fit">
                        <?= $story->content?>                        
                    </div>
                </div>
        </div>  
   
    <?= $this->Element('footer') ?>            
    </section>
