<?php ?>
<section class="footer_top">
    <div class="container">
        <div class="row">
            <div class="footer_top_main">
                <div class="footer_top1"><i class="icon icon-hpsinghon-time-delivery footer_top_icon"></i> <span>On-time Delivery</span>
                </div>
                <div class="footer_top1"><i class="icon icon-hpsinghsupport footer_top_icon"></i> <span>Support</span>
                </div>
                <div class="footer_top1"><i class="icon icon-hpsinghcustom-design footer_top_icon"></i> <span>Custom Design</span>
                </div>
                <div class="footer_top1"><i class="icon icon-hpsinghbulk-enquiry footer_top_icon"></i> <span>Bulk Enquiry</span>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="social_icon_footer social_icon_footer_mob" style="padding-bottom: 0px">
    <h2>KEEP IN TOUCH WITH US</h2>
    <ul>
        <li><a href="https://www.instagram.com/hpsinghfabrics/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        <li><a target="_blank" href="https://api.whatsapp.com/send?phone=<?= \Cake\Core\Configure::read('Store.supportWhatsapp') ?>"> <i class="fa fa-whatsapp"></i></a></li>
        <li><a href="http://www.facebook.com/hpfabrics" target="_blank"><i class="fa fa-facebook-f"></i></a></li>

    </ul>
</div>
<div class="social_icon_footer social_icon_footer_mob">
    <h2 style="margin-bottom: 5px">CERTIFICATIONS</h2>
    <ul>
        <li><img src="/img/c11.png" width="50px"></li>
        <li><img src="/img/c22.png" width="70px"></li>
    </ul>
</div>

<footer>
    <div class="container">
        <div class="row">

            <div class="footer_newsletter">
                <h2>SUBSCRIBE TO OUR NEWSLETTER</h2>
                <p>Enjoy our newsletter to stay updated with the latest news and special sales. <span>Enter your details here!</span>
                </p>
                <?= $this->Form->create(null, ['url' => ['controller' => 'Pages', 'action' => 'subscribe'], 'onsubmit' => 'subscribe(this, event)']) ?>
                <div class="subscribe">
                    <input type="text" placeholder="Name" name="name" required>
                    <span>
                        <input type="email" name="email" placeholder="E-mail address" required>
                    </span>
                </div>
                <button type="submit">SUBSCRIBE</button>
                <?= $this->Form->end() ?>

            </div>

            <div class="footer_menu">
                <div class="footer_menu1">
                    <h2>USEFUL LINKS</h2>
                    <ul>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'about-us']) ?>">About
                                Us</a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'contact-us']) ?>">Contact
                                Us</a>
                        </li>
                        <li><a href="<?= $this->Url->build(['_name' => 'stories']) ?>">Stories</a></li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'faq']) ?>">FAQ</a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'live-browsing']) ?>">
                                Live Browsing
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer_menu1">
                    <h2>OUR POLICY</h2>
                    <ul>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'terms-conditions']) ?>">Terms
                                & Conditions</a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'privacy-policy']) ?>">Privacy
                                Policy</a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'shipping']) ?>">Shipping
                                & Returns</a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'contact-us']) ?>">Help
                                & Support</a>
                        </li>
                    </ul>
                </div>
                <div class="footer_menu1">
                    <h2>CONTACT INFO</h2>
                    <p><b>Business Name:</b> H P Singh Private Limited<!-- <?= \Cake\Core\Configure::read('Store.address') ?> --></p>
            <p><b>Buisness Address:</b> 111, 82-83 Vaikunth House, Nehru Place, New Delhi -110019<!-- <?= \Cake\Core\Configure::read('Store.address') ?> --></p>
            <p><b>Phone:</b> <em>9810277756<!-- <?= \Cake\Core\Configure::read('Store.contact') ?> --></em></p>
            <p><b>Email:</b> <a href="mailto:accounts@hpsingh.com">accounts@hpsingh.com<!-- <?= \Cake\Core\Configure::read('Store.email') ?> --></a>
            </p>
                </div>
                <div class="footer_menu1">
                    <div class="social_icon_footer">
                        <ul>
                            <li><a href="https://www.instagram.com/hpsinghfabrics/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="https://api.whatsapp.com/send?phone=<?= \Cake\Core\Configure::read('Store.supportWhatsapp') ?>"><i class="fa fa-whatsapp"></i></a></li>
                            <li><a href="http://www.facebook.com/hpfabrics" target="_blank"><i class="fa fa-facebook-f"></i></a></li>

                        </ul>
                        <br />
                    </div>
                    <div class="social_icon_footer">
                        <h6 style="margin-bottom: 5px">CERTIFICATIONS</h6>
                        <ul>
                            <li><img src="/img/c11.png" width="50px"></li>
                            <li><img src="/img/c22.png" width="70px"></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="footer_search">
                <h2>MOST POPULAR SEARCH</h2>
                <ul>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'cotton']) ?>">Buy Cotton Fabrics</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'embroidery']) ?>">Buy Embroidery
                            Fabrics</a></li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'knits']) ?>">Buy Knits Fabrics</a></li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'prints']) ?>">Buy Printed Fabrics</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools']) ?>">Buy Silk Fabrics</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals']) ?>">Buy Rayon
                            Fabric</a></li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'scarves-and-stoles']) ?>">Buy Dupatta
                            Fabric</a></li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'autumn-winter']) ?>">Buy Winter
                            Fabrics</a></li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'trousers']) ?>">Buy Trouser Fabric</a>
                    </li>
                    <li><a href="<?= $this->Url->build(['_name' => 'category', 'lehengas']) ?>">Buy Lehenga Fabric</a>
                    </li>
                </ul>
            </div>
            <div class="copyright">
                &copy; <?= date('Y') ?> <?= \Cake\Core\Configure::read('Store.name') ?> | All rights reserved | Powered
                by Lamppost Designs
            </div>
        </div>
    </div>
</footer>


<div class="mobile_footer">
    <div class="footer_newsletter">
        <h2>SUBSCRIBE TO OUR NEWSLETTER</h2>
        <p>Enjoy our newsletter to stay updated with the latest news and special sales.
            <span>Enter your details here!</span>
        </p>
        <?= $this->Form->create(null, ['url' => ['controller' => 'Pages', 'action' => 'subscribe'], 'onsubmit' => 'subscribe(this, event)']) ?>
        <div class="subscribe">
            <input type="text" placeholder="Name" name="name" required>
            <span>
                <input type="email" name="email" placeholder="E-mail address" required>
            </span>
        </div>
        <button type="submit">SUBSCRIBE</button>
        <?= $this->Form->end() ?>
    </div>

    <div class="accordion">
        <h4 class="accordion-toggle">SHOPPING CATEGORIES</h4>
        <div class="accordion-content footer_menu1">
            <ul>
                <li><a href="<?= $this->Url->build(['_name' => 'category', 'cotton']) ?>">Cottons</a></li>
                <li><a href="<?= $this->Url->build(['_name' => 'category', 'linens']) ?>">Linens</a></li>
                <li><a href="<?= $this->Url->build(['_name' => 'category', 'embroidery']) ?>">Embroideries</a></li>
                <li><a href="<?= $this->Url->build(['_name' => 'category', 'knits']) ?>">Knits</a></li>
                <li><a href="<?= $this->Url->build(['_name' => 'category', 'prints']) ?>">Prints</a></li>
            </ul>
        </div>
        <h4 class="accordion-toggle">USEFUL LINKS</h4>
        <div class="accordion-content footer_menu1">
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'about-us']) ?>">About
                        Us</a></li>
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'contact-us']) ?>">Contact
                        Us</a>
                </li>
                <li><a href="<?= $this->Url->build(['_name' => 'stories']) ?>">Stories</a></li>
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'faq']) ?>">FAQ</a>
                </li>
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'live-browsing']) ?>">
                        Live Browsing
                    </a>
                </li>
            </ul>
        </div>
        <h4 class="accordion-toggle">OUR POLICY</h4>
        <div class="accordion-content footer_menu1">
            <ul>
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'terms-conditions']) ?>">Terms
                        & Conditions</a>
                </li>
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'privacy-policy']) ?>">Privacy
                        Policy</a>
                </li>
                <li><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'shipping']) ?>">Shipping
                        & Returns</a></li>
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'contact-us']) ?>">Help
                        & Support</a>
                </li>


            </ul>
        </div>
        <h4 class="accordion-toggle active">CONTACT INFO</h4>
        <div class="accordion-content footer_menu1" style="display:block">
            <p><b>Business Name:</b> H P Singh Private Limited<!-- <?= \Cake\Core\Configure::read('Store.address') ?> --></p>
            <p><b>Buisness Address:</b> 111, 82-83 Vaikunth House, Nehru Place, New Delhi -110019<!-- <?= \Cake\Core\Configure::read('Store.address') ?> --></p>
            <p><b>Phone:</b> <em>9810277756<!-- <?= \Cake\Core\Configure::read('Store.contact') ?> --></em></p>
            <p><b>Email:</b> <a href="mailto:accounts@hpsingh.com">accounts@hpsingh.com<!-- <?= \Cake\Core\Configure::read('Store.email') ?> --></a>
            </p>
        </div>
    </div>
    <div class="copyright">
        &copy; 2017 HP Singh | All rights reserved | Powered by Lamppost Designs
    </div>
</div>