<?php 

/* Template Name: Contact Page */

    $this->assign('bodyClass', 'contact_page');
    $this->assign('title', $page->meta_title);
    $this->assign('meta', $this->Html->meta('description', $page->meta_description) . $this->Html->meta('keywords', $page->meta_keywords));
?>
<?= $this->Element('header')?>
<div class="mobile_hidden_vissible">
    
    <section class="enquiry contact-form sub_TX">
        <div class="container">
            <div class="row">
                <h2><strong>Browse Our Store</strong></h2>
                <p>Register with us now and get your bookings done for the next live store browsing session ,<span> as we walk you through your favourite sections virtually.</span></p>
                <div class="enquiry_form custom_form">
                    <?= $this->Form->create($contact, ['url' => ['controller' => 'pages', 'action' => 'save', $this->request->getParam('slug')], 'type' => 'file'])?>
                        
                        <div class="form-group">
                            <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Name'])?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address'])?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('phone', ['label' => false, 'placeholder' => 'Contact number'])?>
                        </div>
                        <div class="form-group check_cus custom_add">
                                <h2>Preffered Browsing Tool :</h2>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value=""><span>Whatsapp Video Call</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value=""><span>Facetime</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value=""><span>Google Duo</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value=""><span>Skype</span> 
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value=""><span>Google Hangout</span>
                                </label>
                            </div>
                    <div class="form-group custom_add">
                    <p>Preffered date :</p>
                    <input type="date" id="inner_wd" name="">
                    </div>
                    <div class="form-group custom_add">
                    <p>Terms and conditions :</p>
                    <p>We hereby agree to get on a video call with hp singh agencies team members</p>
                    </div>
                            <div class="form-group file_upload">
                            <span>Upload Reference Pictures</span>
                            <label for="file-upload" class="custom-file-upload">
                                Upload Files
                            </label>
                            <?= $this->Form->control('reference', ['label' => false, 'type' => 'file', 'id' => 'file-upload'])?>
                            <div class="g-recaptcha" data-sitekey="<?= env('GOOGLE_CAPTCHA_KEY')?>"></div>
                        </div>
                        <div class="form-group btn_enquiry">
                            <button>SUBMIT</button>
                        </div>
                    <?= $this->Form->end()?>
                </div>
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
<?php $this->Html->scriptEnd()?>