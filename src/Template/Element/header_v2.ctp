<?php ?>
<header class="header-v2">
    <div class="container">
        <div class="row">
            <div class="header_main">
                <div class="col-xs-2 col-sm-2">
                        <a href="<?= BASE?>">
                            <?= $this->Media->renderImage('img/logo.svg', ['class' => 'img_logo', 'alt' => 'hpsingh'])?>
                        </a>
                </div>
                <div class="col-xs-8 col-sm-8">                     
                    <div class="checkout_menu">
                        <ul class="nav nav-tabs">
                            <li class="step0 <?= $this->request->getParam('action') === 'display' ? 'active' : ''?>">
                               <span>Cart</span>
                            </li>
                            <li class="divider"></li>
                            <li class="step1 <?= $this->request->getParam('action') === 'checkout' ? 'active' : ''?>">
                               <span>SHIPPING</span>
                            </li>
                            <li class="divider"></li>
                            <li class="step2">                    
                               <span>BILLING</span>
                            </li>
                            <li class="divider"></li>
                            <li class="step3">
                               <span>PAYMENT</span>
                            </li>
                        </ul>
                        <div class="steps-mobile">
                            <span><?= $this->request->getParam('action') === 'display' ? 'Step 1/4' : 'Step 2/4'?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-2 col-sm-2">
                    <div class="shield">
                        <i class="fa fa-shield" aria-hidden="true"></i>
                        <label>100% Secure</label>                        
                    </div>
                </div>
            </div>  
        </div>
    </div>
</header>