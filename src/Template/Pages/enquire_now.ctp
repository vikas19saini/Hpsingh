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
            <div class="row">
                <!--                <h2>CONTACT US</h2>-->
                <p>Need help? Have a question about an order, or about getting in touch? We're always happy to hear from you.</p>
                <ul>
                    <li class="contact_form_btn active">For Enquiries</li>
                    <li class="contact_details_btn">CONTACT DETAILS</li>
                </ul>
                <div class="enquiry_form active">

                    <?= $this->Form->create($contact, ['url' => ['controller' => 'pages', 'action' => 'save', $this->request->getParam('slug')], 'type' => 'file'])?>
                    <?= $this->Form->hidden('req_type', ['value' => 'Other'])?>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                            <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Name'])?>
                            </div>
                            <div class="form-group">
                            <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address'])?>
                            </div>
                            <div class="form-group" style="width:96%">
                            <?= $this->Form->control('phone', ['label' => false, 'placeholder' => 'Contact number'])?>
                            </div>
                            <div class="form-group msg_enquiry">
                            <?= $this->Form->control('message', ['label' => false, 'type' => 'textarea', 'placeholder' => 'Details..'])?>
                            </div>
                            <div class="form-group custom_upp file_upload">
                                <span>Upload Reference Pictures</span>
                                <label for="file-upload" class="custom-file-upload">
                                    Upload Files
                                </label>
                            <?= $this->Form->control('reference', ['label' => false, 'type' => 'file', 'id' => 'file-upload'])?>
                                <div class="g-recaptcha" data-sitekey="<?= env('GOOGLE_CAPTCHA_KEY')?>"></div>
                            </div>
                            <div class="form-group custom_bttn enquer_bttn">
                                <button>SUBMIT</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?= $this->Element('contact_details')?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end()?>
                <?= $this->Element('contact_map')?>
            </div>
        </div>
    </section>
    <!-- footer area start -->
 <?= $this->Element('footer') ?>
    <!-- footer area end -->
</div>

 <script src="https://www.google.com/recaptcha/api.js">
        grecaptcha.ready(function() {
        grecaptcha.execute('<?= env('GOOGLE_CAPTCHA_KEY')?>', {action: 'homepage'}).then(function(token) {
        });
    });
    </script>

<?php $this->Html->scriptStart(['block' => true])?>

$(document).ready(function(){
$(".contact_form_btn").click(function(){
$(this).addClass("active");
$(".contact_details_btn").removeClass("active");
$(".enquiry_form").addClass("active");
$(".contact_details").removeClass("active");
});
$(".contact_details_btn").click(function(){
$(this).addClass("active");
$(".contact_form_btn").removeClass("active");
$(".contact_details").addClass("active");
$(".enquiry_form").removeClass("active");
});
});  
<?php $this->Html->scriptEnd()?>