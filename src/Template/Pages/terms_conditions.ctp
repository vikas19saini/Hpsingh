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
                <h2>Terms & Conditions<span></span></h2>
                <div class="panel-group faq" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            <h4 class="panel-title">
                            1. What is this Document?<i class="glyphicon glyphicon-minus"></i>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>These terms of use, read together with the (i) Privacy Policy, (ii) Delivery Policy, and (v) Refund and Return Policy constitute a legal and binding agreement between you and HP Singh Agencies Pvt. Ltd., registered under various authorities, having its registered office at 111, Vaikunth 82-83, Nehru Place, New Delhi – 110 019 India.</p>
                                <p>The Agreement, inter alia, provides the terms that govern your access to use (i) HP SINGH’s website <a style="color:#ff9d3a" href="www.hpsingh.com">www.hpsingh.com</a>, and (ii) its mobile and tablet applications, (iii) HP Singh’s online fabric destination, which facilitates purchase of different  elegant and designer fabrics  range. (“Products”) through the Platforms, and (iv) the purchase of Products, and any other service that may be provided by HPSINGH.COM from time to time (collectively referred to as the (“Services”).</p>
                                <p>You hereby understand and agree that the Agreement forms a binding contract between HP Singh Agencies Pvt. Ltd. and anyone who accesses, browses, or purchases the Products , you hereby agree to be bound by the terms contained in the Agreement. If you do not agree to the terms contained in the Agreement, you are advised not to proceed with purchasing the Products or using the Services. The terms contained in the Agreement shall be accepted without modification. The use of the Services would constitute acceptance of the terms of the Agreement.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            <h4 class="panel-title">
                            2. Cancellation policy<i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>In case of cancellation of your order we request you to kindly drop us an email withing 24 hours of your order being placed on raghav@hpsingh.com with details of your order.</p>
                            </div>
                        </div>
                    </div>
                
                    <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            <h4 class="panel-title">
                                3. Terms and Conditions Applicable to Users<i class="glyphicon glyphicon-plus"></i>
                            </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Users must be 18 years of age or older to register, or visit or use the Services in any manner. By registering, visiting or using the Services, you hereby represent and warrant to HPSINGH.COM that you are 18 years of age or older, and that you have the right, authority and capacity to use the Services, and agree to abide by the Agreement. If a User is below 18 years of age, it is assumed that he/she is using/browsing the Platforms under the supervision of his/her parent or legal guardian and that such User’s parent or legal guardian has read and agrees to the terms of this Agreement, including terms of purchase of Products, on behalf of the minor User.</p>
                                <p>The contents of Services, information, text, graphics, images, logos, button icons, software code, interface, design and the collection, arrangement and assembly of the content on the Platforms or any of the other Services are the property of HPSINGH.COM, and are protected under copyright, trademark and other applicable laws. You shall not modify the Its Content or reproduce, display, publicly perform, distribute, reverse engineer or otherwise use the HPSINGH.COM Content in any way for any public or commercial purpose or for personal gain.</p>
                                <p>HPSINGH.COM authorizes you to view and access the HPSINGH.COM Content solely for identifying Products, carrying out purchases of Products and processing returns and refunds (Only in case of defect (Clause 3, 3.1, 3.2)). HPSINGH.COM, therefore, grants you a limited, revocable permission to access and use the Services.</p>
                                <p>Users may make purchases on the Platforms. For the purposes of identifying a User, HPSINGH.COM may, from time to time, collect certain personally identifiable information such as your first name and last name, email address, mobile phone number, postal address, other contact information, demographic profile, etc. Users may also register themselves on the Platforms. Registration on the Platforms is one-time and you are required to remember your username and password and keep the same confidential. In the event where you have misplaced your username and password details, you can retrieve and change the same using the “forgot username/password” option on the Platforms.</p>
                                <p>The User shall assume all risks, liabilities, and consequences if his/her account has been accessed illegally or without authorization through means such as hacking and if through such unauthorized access, a purchase of Products has been made through the Services. It is specifically clarified that payments of monies towards any Products purchased through the Services by unauthorized or illegal use of the User’s account shall entirely be borne by the User.</p>
                                <p>Display of Products for purchase on the Platforms is merely an invitation to offer. An order placed by a User for purchase of a Product constitutes an offer. All orders placed by Users on the Platforms are subject to the availability of such Product, HP Singh’s acceptance of the User’s offer and the User’s continued adherence to the terms of the Agreement.</p>
                                <p>You agree to maintain and promptly update all data provided by you and to keep it true, accurate, current and complete. If you provide any information that is untrue, inaccurate, not current, incomplete, or if HP Singh has reasonable grounds to suspect that the information provided by you is untrue, inaccurate, not current, incomplete, or not in accordance with the terms of the Agreement, HP Singh reserves the right to indefinitely suspend, terminate or block your access to the Platforms, and refuse to provide you with access to the Platforms in future.</p>
                                <p>You understand that on your registration as a User or on your purchase of Products on the Platforms, you may receive text messages and/or emails from HPSINGH.COM on your registered mobile number and/or email address. These messages and/or emails could relate inter alia to your registration, HPSINGH.COM acceptance or rejection of your offer to purchase a Product, payment information, Product dispatch information, information pertaining to other activities you carry out on the Platforms and information pertaining to the promotions that are undertaken by HPSINGH.COM from time to time. It is specifically clarified that a text message and/or an email confirming the receipt of your order is not an acceptance from HPSINGH.COM that the Product will be delivered. HP Singh acceptance to your offer to purchase shall occur and conclude only when the Products have been dispatched by HPSINGH.COM and a text message and/or email confirming such dispatch has been sent to you.</p>
                                <p>Any communication from HPSINGH.COM shall be sent only to your registered mobile number and/or email address or such other contact number or email address that you may designate, for any particular transaction. You shall be solely responsible to update your registered mobile number and/or email address on the Platforms in the event there is a change. Further, HPSINGH.COM may also send you notifications and reminders with respect to scheduled deliveries of the purchased Products. While HPSINGH.COM shall make every endeavour to share prompt reminders and notifications relating to the delivery of purchased Products with you, HPSINGH.COM shall not be held liable for any failure to send such notifications or reminders to you.</p>
                                <p>HPSINGH.COM may, at any time and without having to service any prior notice to you: (i) upgrade, update, change, modify, or improve the Services or a part of the Services in a manner it may deem fit, and (ii) change the contents of the Agreement in substance, or as to procedure or otherwise; in each case which will be applicable to all Users. You hereby agree that this is in the fairness of things given the nature of the business and its operations and you will abide by them. As such, you must keep yourself updated at all times and review the terms of the Agreement from time to time. Such changes shall be made applicable when they are posted. HPSINGH.COM may also alter or remove any content from the Platforms without notice.</p>
                                <p>While HPSINGH.COM shall make reasonable endeavours to maintain high standards of security and shall provide the Services by using reasonable efforts, HPSINGH.COM shall not be liable for any interruption that may be caused to your access or use of the Services.</p>
                                <p>Access to and registration on the Platforms is free of cost. Although unlikely, HPSINGH.COM may modify the Fee, Payment and Promotions Policy to include a fee on access and browsing of the Platforms, or for use of any new service introduced by HPSINGH.COM without serving prior notice on the Users.</p>
                                <p>The Services included on or otherwise made available to the Users through the Platforms are provided on an “as is” and “as available” basis without any representations or warranties, express or implied, except if otherwise specified in writing. HPSINGH.COM does not covenant or warrant that:</p>
                                <p>The Services will be made available at all times;</p>
                                <p>The HPSINGH.COM Content available on the Platforms is complete, true, accurate or non-misleading; and</p>
                                <p>The Products are of specified merchantability, merchantable quality and fit for use for a particular purpose.</p>
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


