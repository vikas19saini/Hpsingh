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
                    <?= $this->Form->create($contact, ['url' => ['controller' => 'pages', 'action' => 'save', $this->request->getParam('slug')], 'type' => 'file', 'onsubmit' => 'return validateForm()'])?>
                        
                        <div class="form-group">
                            <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Name', 'required'])?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('email', ['label' => false, 'placeholder' => 'Email address', 'required'])?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('phone', ['label' => false, 'placeholder' => 'Contact number', 'required'])?>
                        </div>
                        <div class="form-group check_cus custom_add">
                                <h2>Preffered Browsing Tool :</h2>
                                <label class="checkbox-inline">
                                    <input name="tool[]" type="checkbox" value="Whatsapp Video Call"><span>Whatsapp Video Call</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input name="tool[]" type="checkbox" value="Facetime"><span>Facetime</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input name="tool[]" type="checkbox" value="Google Duo"><span>Google Duo</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input name="tool[]" type="checkbox" value="Skype"><span>Skype</span> 
                                </label>
                                <label class="checkbox-inline">
                                    <input name="tool[]" type="checkbox" value="Google Hangout"><span>Google Hangout</span>
                                </label>
                            </div>
                    <div class="form-group custom_add">
                    <p>Preffered date:</p>
                    <?= $this->Form->text('date', ['label' => false, 'type' => 'date', 'id' => 'inner_wd', 'placeholder' => 'Contact number', 'required'])?>
                    </div>
                    <div class="form-group custom_add">
                    <p>Terms and conditions :</p>
                    <p><input type="checkbox" style="width: auto;" required> We hereby agree to get on a video call with hp singh agencies team members</p>
                    </div>
                            <div class="form-group file_upload">
                            <span>Upload Reference Pictures (Max Size 1MB)</span>
                            <label for="file-upload" class="custom-file-upload">
                                Upload Files
                            </label>
                            <?= $this->Form->control('reference', ['label' => false, 'type' => 'file', 'id' => 'file-upload'])?>
                            <div class="g-recaptcha" data-sitekey="<?= env('GOOGLE_CAPTCHA_KEY')?>"></div>
                        </div>
                        <div class="form-group btn_enquiry">
                            <button type="submit">SUBMIT</button>
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

    <script>
        function validateForm(){
            if($('input:checkbox:checked').length > 0){
                return true;
            }
            alert("Please choose Preffered Browsing Tool");
            return false;
        }
    </script>

<?php $this->Html->scriptStart(['block' => true])?>
<?php $this->Html->scriptEnd()?>