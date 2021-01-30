<?php 

/* Template Name: Contact Page */

    $this->assign('bodyClass', 'contact_page');
    $this->assign('title', $page->meta_title);
    $this->assign('meta', $this->Html->meta('description', $page->meta_description) . $this->Html->meta('keywords', $page->meta_keywords));
?>
<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
    
    <section class="enquiry contact-form">
        <div class="container">
            <div class="row about_us">
                <h2>ABOUT US<span></span></h2>
                <p>We at H.P. Singh over the past 40 years have been leading fabrics suppliers to thousands of our customers worldwide.</p>
                <p>Our collections of elegant and designer fabrics represent the Indian tradition in its true form. We, at H.P. Singh Agencies, 
                    are an acclaimed supplier of various types of man-made fabrics, designer drapery fabrics, designer upholstery fabrics, natural 
                    fibers and numerous blends of linen with cotton, viscose, elastic, silk, polyester and other blended fibers. We are known in the 
                    market for high quality and variety of unmatched designs and styling of the products.</p>
                <p>Combining outstanding quality and value, we have excelled in providing quality products & services at competitive prices. The 
                    company is run by a bunch of enthusiasts who share a vision about the company’s progress and are dedicated towards manufacturing/trading 
                    quality products.</p>
                <p>We have a team of highly qualified textile engineers and designers who are well versed in the nuances of a pattern, weave, fiber, look, 
                    composition look and wear-ability. Our in-house design and development works in close co-ordination with both national and international 
                    designers to create products that are comparable to the best in the world.</p>
                <p>Our commitment to quality starts with the raw material input and continues till the final product takes shapes. Our fabrics are made to high 
                    quality standards with proper dimensional stability, colour fastness, shrinkage control and uniform dyeing.</p>
                <p>It is only the quality that has kept the company ahead of its competitors, so the company is checking the quality of its products at each stage 
                    of manufacture. We also have the expertise and capability to execute bulk orders and customized orders as per the buyer’s specifications.</p>
            </div>
        </div>
    </section>
<!-- footer area start -->
 <?= $this->Element('footer') ?>
<!-- footer area end -->
</div>