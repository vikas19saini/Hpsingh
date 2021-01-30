<?php

/* Template Name: Contact Page */

    $this->assign('bodyClass', 'contact_page');
    $this->assign('title', $page->meta_title);
    $this->assign('meta', $this->Html->meta('description', $page->meta_description) . $this->Html->meta('keywords', $page->meta_keywords));
?>
<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
    <section class="faq enquiry contact-form">
        <div class="container">
            <div class="row about_us">
                <h2>FAQs<span></span></h2>
                <div class="panel-group faq" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            <h4 class="panel-title">
                                <span>Is HpSingh A Fabric Manufacturers or Trader of fabrics?</span> <i class="glyphicon glyphicon-minus"></i>
                            </h4>
                            
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>We at Hpsingh have been traders of fabrics since the past 40 years and have a collection of over 25000+ fabrics from all categories of manmade and natural fibres available for sampling and production purposes catering to bulk and retail customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <h4 class="panel-title">
                                <span>Where all is Hp Singh Located in India?</span> <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                            
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>HpSingh Currently has its flagship store spread across 20000 Sq. feet area in Nehru Place located in South Delhi and aim to soon come at multiple locations across the country also <a href="http://www.hpsingh.com">hpsingh.com</a> has been designed to create a complete experience to shop all our fabrics online.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            <h4 class="panel-title">
                                <span>Can we get our own fabrics developed/printed?</span> <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                            
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Yes we can customize as per your needs but it solely depends on what kind of quantities you are looking to source infact at HPSingh we are known to cater to the Biggest of Brands, Boutique buyers and Designers along with our massive Clientle of Retail Customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                            <h4 class="panel-title">
                                <span>What all varieties of fabrics are available at HpSingh and Hpsingh.com?</span> <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                            
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>HpSingh store as well as Hpsingh.com are known for selling all categories of Fabrics both manmade and natural fibres at the store as well as on our web space.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                            <h4 class="panel-title">
                                <span>Can we also buy bulk quantities at HPSingh.com as well as at the store?</span> <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                            
                        </div>
                        <div id="collapse5" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Yes we are equipped at selling bulks on both <a href="http://www.hpsingh.com">hpsingh.com</a> and our stores.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                            <h4 class="panel-title">
                                What do we mean when we say bulk quantities? <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                           
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>When we say Bulk quantities we mean that you are looking to buy above 100 meters of fabrics from us.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                            <h4 class="panel-title">
                                Are bulk prices different then regular prices? <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Yes Bulk Prices are different than Regular prices however the difference is different in case of different fabrics.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                            <h4 class="panel-title">
                                How do we order bulk fabrics on hpsingh.com? <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                            
                        </div>
                        <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>On the homepage we have a sticker where you can mention the details of the fabrics along with the contact details and we shall help you with the same within 24 hours.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                            <h4 class="panel-title">
                                Why cant we return once bought? <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse9" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Since fabrics pieces are cut so it gets difficult for us to use them elsewhere so we humbly request you that once fabric orders are placed it would not be possible for us to return the same.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
 <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>