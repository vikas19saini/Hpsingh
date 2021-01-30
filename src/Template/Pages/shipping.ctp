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
                <h2>Shipping & Returns<span></span></h2>
                <div class="panel-group faq" id="accordion">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse18">
                            <h4 class="panel-title">1. Refund and Return Policy </h4>
                            <div class=""><i class="glyphicon glyphicon-minus"></i></div>
                        </div>
                        <div id="collapse18" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>In keeping with HPSINGH.COM goal of ensuring User satisfaction, this return and refund Policy (“Return and Refund Policy”), together with the terms of use, sets out HPSINGH.COM procedures and policies in accepting Product returns, once a Product has been delivered to a User after purchase from the Platforms. Any return of Products by Users shall be governed by and subject to the terms and conditions set out under this Return and Refund Policy as:</p>
                                <p>Since we cut a specific length as per your need, so exchange/return in that case shall not possible for us.</p>
                                <p>Returns can be only in case of genuine defects and as long as the product is unused and not washed.</p>
                                <p>To initiate return one need to inform us within 48 hours of the order received, to inform us please write to us at info@HPSINGH.COM or fill our attached form for defects/returns.</p>
                                <p>Refund will be done through online mode in 6-7 working days.</p>
                                <P>Users are required to peruse and understand the terms of this Return and Refund Policy. If you do not agree to the terms contained in this Return and Refund Policy, you are advised not to accept the Terms of Use and may forthwith leave and stop using the Platforms. The terms contained in this Return and Refund Policy shall be accepted without modification and you agree to be bound by the terms contained herein by initiating a request for purchase of Product(s) on the Platforms.</P>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                            <h4 class="panel-title">
                                2. Shipping and Delivery Policy: <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>All orders will ship in 24 to 48 hours and deliver within 8 to 10 business days from the date of the order. Shipping price will included for the domestic purchase.</p>
                            </div>
                        </div>
                    </div>
                
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                            <h4 class="panel-title">
                                 4. Unlawful or Prohibited Use <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>You warrant to HPSINGH.COM that you will comply with all applicable laws, statutes, ordinances and regulations regarding the use of the Services and any other related activities. You further warrant that you will not use the Platforms in any way prohibited by terms contained in the Agreement or under applicable law.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                            <h4 class="panel-title">
                               5. Liability <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse7" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>You acknowledge and undertake that you are accessing the Services and purchasing the Products at your own risk and that you are using prudent judgment before placing an order for a Product or availing any Services through the Platforms. HPSINGH.COM shall, at no point, be held liable or responsible for any representations or warranties in relation to the Products. Refund of the price paid for the purchase of a Product or replacement thereof shall be governed by the Return and Refund Policy.</p>
                                <p>HPSINGH.COM does not provide or make any representation, warranty or guarantee, express or implied about the Platforms, Products or the Services, and all implied warranties under law or contract are to the maximum extent possible hereby disclaimed.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                            <h4 class="panel-title">
                                6. Severability <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>If any provision of the Agreement is determined to be invalid or unenforceable in whole or in part, such invalidity or unenforceability shall attach only to such provision and the remaining part of such provision and all other provisions of the Agreement shall continue to be in full force and effect.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                            <h4 class="panel-title">
                                7. Term and Termination <i class="glyphicon glyphicon-plus"></i>
                            </h4> 
                        </div>
                        <div id="collapse9" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>The Agreement will remain in full force and effect while you use any Service in any form or capacity.</p>
                                <p>HPSINGH.COM reserves the right to terminate its Services provided to you in the event of breach of any terms contained in the Agreement, misrepresentation of information, any unlawful activity or if HPSINGH.COM is unable to verify or authenticate any information you submit to it.</p>
                                <p>The User may terminate the Agreement at any time, provided that the User discontinues any further use of the Platforms or Services.</p>
                                <p>It is specifically clarified that any termination of the Agreement by a User shall not cancel the User’s obligation to pay for a Product purchased on the Platforms, or any other obligation which has accrued, or is unfulfilled and relates to the period, prior to termination.</p>
                                <p>Any provision of the Agreement which imposes an obligation or creates a right that by its nature will be valid after termination or expiration of the Agreement shall survive the termination or expiration of the Agreement.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                            <h4 class="panel-title">
                               8. Waiver <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse10" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>HPSINGH.COM failure to enforce any provision of the Agreement or respond to a breach by a User or User shall in no way imply a waiver of HPSINGH.COM right to subsequently enforce any provision of the terms of the Agreement or to act with respect to similar breaches by a User or User.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                            <h4 class="panel-title">
                               9. Notices <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse11" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>All notices and communications shall be in writing, in English and shall be deemed given if delivered personally or by commercial messenger or courier service, or mailed by registered or certified mail (return receipt requested) or sent by email, with due acknowledgment or complete transmission to the following address:</p>
                                <p><strong>Postal Address</strong>:<br> <strong>HP&nbsp; Singh Agencies Private Limited<br> </strong>111,<br> 82-83, Vaikunth Building<br> Nehru Place, New Delhi-110019<br>Delhi (India)<br> <strong>Email Address</strong>:&nbsp;<a href="mailto:customercare@ajio.com"><strong>info@hpsingh.com</strong></a></p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                            <h4 class="panel-title">
                               10. Interpretation <i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse12" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Headings, subheadings, titles, subtitles to clauses, sub-clauses and paragraphs are for information only and shall not form part of the operative provisions of the Agreement and shall be ignored in construing the same.</p>
                                <p>Words denoting the singular shall include the plural and words denoting any gender shall include all genders.</p>
                                <p>The words “include” and “including” are to be construed without limitation.</p>
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
