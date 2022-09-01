<?php ?>
<!-- header area start -->
<div class="header_heading container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-6">
                <p>Free Shipping in India & Delivery Worldwide</p>
            </div>
            <div class="col-xs-6 col-sm-6 fst_top_sec">
                <div class="top_tx">
                    <p>
                        <a href="<?= $this->Url->build(['_name' => 'sale']) ?>" class="blink">Deals</a>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'bulk-enquiry']) ?>">Bulk
                            order</a>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'enquire-now']) ?>">Enquire
                            now</a>
                        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'trackOrder']) ?>">Track Order</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<header>
    <div class="container">
        <div class="row">
            <div class="header_main">
                <div class="col-xs-7 col-sm-2">
                    <a href="<?= BASE ?>">
                        <?= $this->Media->renderImage('img/logo.svg', ['class' => 'img_logo', 'alt' => 'hpsingh']) ?>
                    </a>
                    <div id="ChangeToggle">
                        <div class="logo" id="navbar-hamburger">
                            <span><i class="mobile_menu"></i></span>
                        </div>
                        <div id="navbar-close" class="hidden logo">
                            <span><img src="data:image/png;base64,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" alt=""></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-10">
                    <div class="search-bottom">
                        <ul>
                            <li>
                                <div class="dropdown">
                                    <span class="dropbtn">All Fabrics<i></i></span>
                                    <div class="dropdown-content">
                                        <div class="menu-item-list">
                                            <h4><a href="<?= $this->Url->build(['_name' => 'category', 'cotton']) ?>">Cottons</a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/cotton-blends']) ?>">Cottons
                                                        Blends</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/cotton-knits']) ?>">Cottons
                                                        Knits</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/dobby-and-jacquard']) ?>">Dobby
                                                        & Jacquard</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/ikats']) ?>">Ikats</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/embroideries']) ?>">Embroideries</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/indigo-denims-and-non-denims']) ?>">Indigo
                                                        / Denims & Non Denims</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/khadi-raw-cotton']) ?>">Handspun
                                                        / Raw Cottons</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/laces']) ?>">laces</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/lawns-and-voiles']) ?>">Lawns
                                                        & Voiles</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/solids']) ?>">Solids</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/prints-cotton']) ?>">Prints</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/weaves-textures']) ?>">Weaves
                                                        & Textures</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'cotton/yarn-dyeds-checks-and-stripes']) ?>">Yarn
                                                        dyeds / checks and stripes</a>
                                                </li>
                                            </ul>
                                            <h4>
                                                <a href="<?= $this->Url->build(['_name' => 'category', 'polyester-fabrics']) ?>">Poly
                                                    Blend Fabrics</a>
                                            </h4>
                                            <h4>
                                                <a href="<?= $this->Url->build(['_name' => 'category', 'scarves-and-stoles']) ?>">Scarves
                                                    and Dupattas</a>
                                            </h4>
                                        </div>
                                        <div class="menu-item-list">
                                            <h4><a href="<?= $this->Url->build(['_name' => 'category', 'linens']) ?>">Linens</a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'linens/100-linen']) ?>">100%
                                                        linen</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'linens/jute']) ?>">Jute</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'linens/linen-blends']) ?>">Linen
                                                        Blends</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'linens/linen-solids']) ?>">Linen
                                                        Solids</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'linens/linen-prints']) ?>">Linen
                                                        Prints</a>
                                                </li>
                                            </ul>
                                            <h4>
                                                <a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals']) ?>">Rayons/Modals</a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals/rayons-blends']) ?>">Rayons
                                                        Blends</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals/prints-rayon-modals']) ?>">Prints</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals/solids-and-dyeds']) ?>">Solids
                                                        And Dyeds</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals/textures-fabrics']) ?>">Textures
                                                        Fabrics</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'rayons-modals/tie-dye-shiburi-and-batik']) ?>">Tie
                                                        Dye Shiburi And Batik</a>
                                                </li>
                                            </ul>
                                            <h4>
                                                <a href="<?= $this->Url->build(['_name' => 'category', 'cut-pieces']) ?>">Cut
                                                    Pieces</a>
                                            </h4>
											<!--<h4 style="display: flex;">
												<a href="<?= $this->Url->build(['_name' => 'category', 'combination-sets']) ?>">Joda By HPSingh</a>
												<div class="new_bttn">New</div>
											</h4>-->
                                        </div>

                                        <div class="menu-item-list">
                                            <h4><a href="<?= $this->Url->build(['_name' => 'category', 'prints']) ?>">Prints</a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/chanderi']) ?>">Chanderi</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/cotton-prints']) ?>">Cottons</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/digitals']) ?>">Digitals</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/hand-blocks']) ?>">Hand
                                                        Blocks</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/knitted-prints']) ?>">Knitted
                                                        Prints</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/prints-linen']) ?>">Prints
                                                        Linen</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/poly-prints']) ?>">Poly
                                                        Prints</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/silk-prints']) ?>">Silk
                                                        Prints</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'prints/traditional-ethnics']) ?>">Traditional
                                                        Ethnics</a>
                                                </li>
                                            </ul>
                                            <h4><a href="<?= $this->Url->build(['_name' => 'category', 'knits']) ?>">Knits</a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'knits/cotton-knits-knits']) ?>">Cottons
                                                        knits</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'knits/knit-blends-wools']) ?>">Knit
                                                        blends / Wools</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'knits/poly-knits']) ?>">Poly
                                                        knits</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'knits/laces-and-nets']) ?>">Laces
                                                        and Nets</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'knits/printed-knits']) ?>">Printed
                                                        knits</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menu-item-list">
                                            <h4>
                                                <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools']) ?>">Silks/
                                                    Wools</a>
                                            </h4>
                                            <ul>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/blended-silk']) ?>">Blended
                                                        Silk</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/printed-silks']) ?>">Printed
                                                        Silks</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/ombres-solid-dyeds']) ?>">Ombres/Solid
                                                        Dyeds</a>
                                                </li>
                                                <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/silk-jacquards-and-brocades']) ?>">Silk
                                                        Jacquards And Brocades</a>
                                                </li>
                                                <!-- <li>
                                                    <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/textures-and-plain-weaves']) ?>">Textures
                                                        And Plain Weaves</a></li>
                                                <li> -->
                                                <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/woollen-textures']) ?>">Woollen
                                                    Textures</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/woollen-tweed']) ?>">Woollen
                                    Tweed</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/wool-felt']) ?>">Wool
                                    Felt</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'silks-wools/wool-prints']) ?>">Wool
                                    Prints</a>
                            </li>
                        </ul>
                        <h4>
                            <a href="<?= $this->Url->build(['_name' => 'category', 'embroidery']) ?>">Embroideries</a>
                        </h4>
                        <ul>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'embroidery/embroidery-work']) ?>">Embroideries
                                    Work</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'embroidery/chikan-work']) ?>">Chikan
                                    Work</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'embroidery/embroidered-laces']) ?>">Embroidered
                                    laces</a>
                            </li>
                        </ul>
                    </div>
                    <div class="menu-item-list">
                        <h4>What do you wanna make</h4>
                        <ul>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'top-kurtis']) ?>">Tops
                                    & Kurtis</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'lehengas']) ?>">Lehengas</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'shirts']) ?>">Shirts</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'skirts']) ?>">Skirts</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'suits-and-blazers']) ?>">Suits
                                    & Blazers</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'category', 'trousers']) ?>">Trousers</a>
                            </li>
                            <li><a href="<?= $this->Url->build(['_name' => 'search', 'bags']) ?>">Bags</a>
                            </li>
                            <li><a href="<?= $this->Url->build(['_name' => 'search', 'kaftan']) ?>">Kaftan</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'Scarves', '?' => ['direction' => 'asc', 'sort' => 'ragular_price']]) ?>">Scarves</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'home+furnishing']) ?>">Home
                                    Furnishing</a>
                            </li>
                        </ul>
                        <h4>Big Fat Weddings</h4>
                        <ul>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'embroideries']) ?>">Embroideries</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'embroidery+work']) ?>">Kurta</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'kurta']) ?>">Lehenga</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'lehenga']) ?>">Sherwani & Achkan</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'sherwani']) ?>">Suiting</a>
                            </li>
                            <li>
                                <a href="<?= $this->Url->build(['_name' => 'search', 'suiting']) ?>">Turban</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </li>
            <li class="search-products">
                <input type="text" name="query" value="<?= isset($search_term) ? $search_term : '' ?>" placeholder="Search for product by name, code, design nos, fabric name" id="search-products" autocomplete="off">
                <button title="Search by image" class="searchByImage" onclick="$('#moodboard').click()">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                </button>
                <button>
                    <i class="fa fa-search"></i>
                    <?= $this->Html->image('loading.gif') ?>
                </button>
            </li>
            <li class="mobile_visible" onclick="$('.mobile_search_window').addClass('active')">
                <a href="javascript:void(0);"><i class="fa fa-search search-icon"></i>
                </a>
            </li>
            <li class="header-fixed_visible translator">
                <div id="google_translate_element"></div>
            </li>
            <li class="mobile_hidden">
                <?php if (isset($Auth)) : ?>
                    <div class="dropdown">
                        <button class="myaccount" type="button" data-toggle="dropdown">My Account<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <?php if ($Auth->user_group === 'administrator') : ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'hpadmin']) ?>">Dashboard</a>
                                </li>
                                <li role="presentation" class="divider"></li>
                            <?php endif; ?>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'myAccount']) ?>">Overview</a>
                            </li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'profile']) ?>">Profile</a>
                            </li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'addresses']) ?>">Addresses</a>
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'orders']) ?>">Orders</a>
                            </li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'display']) ?>">Wishlist</a>
                            </li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'coupons']) ?>">Coupons</a>
                            </li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'contact-us']) ?>">Contact
                                    Us</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:logout()"><b>Logout</b></a>
                            </li>
                        </ul>
                    </div>
                <?php else : ?>
                    <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'login']) ?>">
                        <button class="myaccount" type="button">LOG IN</button>
                    </a>
                <?php endif; ?>
            </li>
            <li><a href="/wishlist"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyNTAgMjUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAyNTAgMjUwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGOUQzQTt9Cjwvc3R5bGU+CjxnIGlkPSJENjA1Z0gudGlmIj4KCTxnPgoJCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0yMzQsOTYuOWMtMC42LDE3LjYtNi40LDMzLjQtMTYuOCw0Ny41Yy0xMS4zLDE1LjMtMjQuOSwyOC4zLTM5LjQsNDAuNWMtMTYsMTMuNS0zMywyNS44LTUwLjYsMzcuMQoJCQljLTEuNCwwLjktMi40LDEuMS00LDAuMWMtMjcuMi0xNy42LTUzLjEtMzYuOS03NS41LTYwLjVjLTEwLjEtMTAuNy0xOS41LTIyLTI1LjMtMzUuOEM5LjMsOTQuOCwxNy42LDY0LjIsNDEuMyw0NS41CgkJCUM2NC43LDI3LjEsMTAwLDI3LjcsMTIyLjgsNDdjMS42LDEuNCwyLjYsMS42LDQuNCwwLjJjMzctMzAuMyw5NC45LTEzLjQsMTA1LjYsMzcuMkMyMzMuNiw4OC41LDIzNCw5Mi43LDIzNCw5Ni45eiBNODIuMiw0Ny45CgkJCWMtOS44LDAuMi0xNy44LDIuMi0yNS4xLDYuNGMtMjAuMywxMS41LTMxLjksMzYuOS0yMCw2NC44YzQuMSw5LjYsMTAuMiwxNy44LDE3LDI1LjZjMjAuMiwyMyw0NC4zLDQxLjQsNjkuNSw1OC42CgkJCWMxLjIsMC45LDIuMSwwLjcsMy4yLTAuMWMyNC43LTE2LjksNDguMy0zNC45LDY4LjQtNTcuM2MxMC4yLTExLjMsMTguNS0yMy42LDIxLjYtMzguOWM0LTE5LjYtNC4yLTQwLjEtMjEuMi01MS4xCgkJCWMtMTYuOS0xMC45LTQwLTEwLjEtNTUuOSwxLjljLTUuMSwzLjktOS4yLDguNy0xMy4yLDEzLjdjLTEuMSwxLjQtMS44LDEuNS0yLjksMGMtMS4yLTEuNy0yLjYtMy4yLTMuOS00LjgKCQkJQzEwOS43LDU0LjUsOTYuOCw0OC4yLDgyLjIsNDcuOXoiLz4KCTwvZz4KPC9nPgo8ZyBpZD0iRDYwNWdILnRpZl8xXyI+Cgk8Zz4KCQk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNTI1LDk2LjljLTAuNiwxNy42LTYuNCwzMy40LTE2LjgsNDcuNWMtMTEuMywxNS4zLTI0LjksMjguMy0zOS40LDQwLjVjLTE2LDEzLjUtMzMsMjUuOC01MC42LDM3LjEKCQkJYy0xLjQsMC45LTIuNCwxLjEtNCwwLjFjLTI3LjItMTcuNi01My4xLTM2LjktNzUuNS02MC41Yy0xMC4xLTEwLjctMTkuNS0yMi0yNS4zLTM1LjhjLTEzLjEtMzEuMS00LjgtNjEuNywxOC45LTgwLjQKCQkJYzIzLjQtMTguNSw1OC43LTE3LjgsODEuNSwxLjVjMS42LDEuNCwyLjYsMS42LDQuNCwwLjJjMzctMzAuMyw5NC45LTEzLjQsMTA1LjYsMzcuMkM1MjQuNiw4OC41LDUyNSw5Mi43LDUyNSw5Ni45eiBNMzczLjIsNDcuOQoJCQljLTkuOCwwLjItMTcuOCwyLjItMjUuMSw2LjRjLTIwLjMsMTEuNS0zMS45LDM2LjktMjAsNjQuOGM0LjEsOS42LDEwLjIsMTcuOCwxNywyNS42YzIwLjIsMjMsNDQuMyw0MS40LDY5LjUsNTguNgoJCQljMS4yLDAuOSwyLjEsMC43LDMuMi0wLjFjMjQuNy0xNi45LDQ4LjMtMzQuOSw2OC40LTU3LjNjMTAuMi0xMS4zLDE4LjUtMjMuNiwyMS42LTM4LjljNC0xOS42LTQuMi00MC4xLTIxLjItNTEuMQoJCQljLTE2LjktMTAuOS00MC0xMC4xLTU1LjksMS45Yy01LjEsMy45LTkuMiw4LjctMTMuMiwxMy43Yy0xLjEsMS40LTEuOCwxLjUtMi45LDBjLTEuMi0xLjctMi42LTMuMi0zLjktNC44CgkJCUM0MDAuNiw1NC41LDM4Ny43LDQ4LjIsMzczLjIsNDcuOXoiLz4KCQk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNNTAwLjgsOTUuN2MtMC4xLDUuMi0wLjYsOS4xLTEuOCwxMi44Yy0wLjksMi44LTIuNiw0LTQuOSwzLjRjLTIuNC0wLjYtMy41LTIuNi0yLjctNS41CgkJCWMyLjMtOC42LDEuOS0xNi45LTIuNC0yNC43Yy01LjctMTAuNi0xNC43LTE2LjQtMjYuNy0xNy41Yy0wLjctMC4xLTEuNS0wLjEtMi4yLTAuMmMtMi42LTAuNC00LjEtMi0zLjktNC4yCgkJCWMwLjEtMi4zLDEuOC0zLjcsNC40LTMuN2M1LjIsMCwxMC4zLDAuOSwxNSwzLjFDNDkxLjcsNjYuNSw0OTkuOSw3OS4zLDUwMC44LDk1Ljd6Ii8+Cgk8L2c+CjwvZz4KPC9zdmc+Cg=="></a>
            </li>
            <li class="bag_pad_0">
                <a href="<?= $this->Url->build(['controller' => 'Cart', 'action' => 'display']) ?>" style="position:relative">
                    <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDIxLjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAyNTAgMjUwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAyNTAgMjUwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6IzA1NTg2NDt9Cgkuc3Qxe2ZpbGw6I0ZGOUQzQTt9Cjwvc3R5bGU+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik00MjcuMywxMy40bC05LjktMTQ2LjZIMjg1bC05LjksMTQ2LjZoLTcuNHYxOS40aDYuMmgxNTQuN2g0LjZWMTMuNEg0MjcuM3ogTTM4Ny4zLTExNy45YzMuOCwwLDYuOCwzLDYuOCw2LjgKCXMtMyw2LjgtNi44LDYuOGMtMy44LDAtNi44LTMtNi44LTYuOEMzODAuNS0xMTQuOCwzODMuNS0xMTcuOSwzODcuMy0xMTcuOXogTTMxNS4yLTExNy45YzMuOCwwLDYuOCwzLDYuOCw2LjhzLTMsNi44LTYuOCw2LjgKCWMtMy44LDAtNi44LTMtNi44LTYuOEMzMDguNC0xMTQuOCwzMTEuNC0xMTcuOSwzMTUuMi0xMTcuOXoiLz4KPHBhdGggY2xhc3M9InN0MSIgZD0iTTMyNC44LTE0MC4yYzUuOC0xOCwxNS42LTMwLjEsMjYuNC0zMC4xYzEwLjgsMCwyMC42LDEyLjEsMjYuNCwzMC4xaDguNGMtNi44LTIyLjktMTkuNy0zOC0zNC44LTM4CglzLTI4LDE1LjItMzQuOCwzOEgzMjQuOHoiLz4KPGcgaWQ9IkNzdlRZZC50aWYiPgoJPGc+CgkJPHBhdGggY2xhc3M9InN0MCIgZD0iTTEyNS4xLDIyNi42Yy0yMy4yLDAtNDYuMy0wLjEtNjkuNSwwLjFjLTYuNywwLjEtOC45LTQuMi04LjMtOS42YzItMTguMywzLjYtMzYuNyw1LjMtNTUuMQoJCQljMS45LTIwLjMsMy45LTQwLjYsNS44LTYwLjljMC45LTguOSwxLjctMTcuOCwyLjUtMjYuN2MwLjUtNS43LDIuNy03LjgsOC41LTcuOWM1LjEtMC4xLDEwLjIsMCwxNS4yLTAuMmMxLjktMC4xLDIuNywwLjQsMi41LDIuNAoJCQljLTAuMiwyLjktMC4xLDUuNywwLDguNmMwLDEuNC0wLjQsMi40LTEuMiwzLjZjLTQuNSw2LjUtMy42LDE0LjgsMi4xLDE5LjhjNS44LDUuMSwxNC4yLDUuMSwyMCwwYzUuNy01LjEsNi42LTEzLjQsMi0xOS44CgkJCWMtMC44LTEuMS0xLjItMi4yLTEuMi0zLjZjMC4xLTMsMC4xLTYuMSwwLTkuMWMwLTEuNCwwLjQtMiwxLjktMmM4LjksMC4xLDE3LjksMC4xLDI2LjgsMGMxLjYsMCwxLjgsMC43LDEuOCwyCgkJCWMtMC4xLDMuMS0wLjEsNi4zLDAsOS40YzAsMS4yLTAuNSwyLjEtMS4yLDNjLTQuMiw1LjYtNC40LDEyLjMtMC42LDE3LjhjMy41LDUuMSw5LjksNy41LDE1LjgsNmM2LjMtMS42LDEwLjctNi43LDExLjMtMTMuNQoJCQljMC4zLTMtMC4zLTYtMi04LjRjLTEuNC0yLTEuNy00LTEuNi02LjJjMC4xLTIuNywwLjEtNS40LDAtOGMwLTEuMywwLjUtMS44LDEuOC0xLjhjNi41LDAsMTIuOS0wLjEsMTkuNCwwLjEKCQkJYzMuOSwwLjEsNi4yLDIuNiw2LjYsNi41YzMsMzEuMyw1LjksNjIuNiw4LjksOTMuOWMxLjYsMTYuMywzLjIsMzIuNyw0LjcsNDljMC4xLDEuMSwwLjIsMi4yLDAuMiwzLjNjMC4xLDQuNi0yLjUsNy4zLTcuMSw3LjMKCQkJYy0xNC44LDAtMjkuNSwwLTQ0LjMsMEMxNDIuNywyMjYuNiwxMzMuOSwyMjYuNiwxMjUuMSwyMjYuNnoiLz4KCQk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMTU0LjcsNjIuMWMwLDYuMywwLDEyLjUsMCwxOC44YzAsMS41LDAuMywyLjgsMS4zLDRjMi44LDMuNCwyLjMsOC4xLTAuOCwxMWMtMy4zLDMtOCwyLjktMTEuMi0wLjIKCQkJYy0zLTIuOS0zLjMtNy43LTAuNC0xMWMxLjEtMS4yLDEuNC0yLjQsMS40LTRjMC0xMS41LDAtMjMuMSwwLTM0LjZjMC0xMy4xLTkuMi0yMi42LTIxLjUtMjIuM2MtMTAuOSwwLjItMjAuMSw4LjktMjAuMywxOS44CgkJCWMtMC4zLDEyLjgtMC4xLDI1LjYtMC4yLDM4LjVjMCwxLjEsMC41LDEuOSwxLjEsMi43YzIuOSwzLjgsMi40LDguNi0wLjksMTEuNGMtMy4yLDIuNy04LjEsMi41LTExLjEtMC41Yy0zLTMuMS0zLjItNy45LTAuMi0xMS4zCgkJCWMxLTEuMSwxLjItMi4xLDEuMi0zLjRjMC0xMi4xLDAtMjQuMiwwLTM2LjJjMC4xLTE3LjEsMTMuOC0zMC44LDMwLjgtMzAuOGMxNywwLDMwLjgsMTMuNywzMC45LDMwLjgKCQkJQzE1NC43LDUwLjUsMTU0LjcsNTYuMywxNTQuNyw2Mi4xeiIvPgoJPC9nPgo8L2c+Cjwvc3ZnPgo=" alt="">
                    <div class="badge" id="cartItems"></div>
                </a>
            </li>

            </ul>
        </div>
    </div>
    </div>
    </div>
    </div>
</header>


<div class="mobile_header_menu">
    <ul>
        <li>
            <div class="accordion">
                <h4 class="accordion-toggle">My Accounts</h4>
                <div class="accordion-content mobile_click_accord">
                    <ul class="account-mobile">
                        <?php if (isset($Auth)) : ?>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'myAccount']) ?>">Overview</a>
                            </li>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'profile']) ?>">Profile</a>
                            </li>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'addresses']) ?>">Addresses</a>
                            </li>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'orders']) ?>">Orders</a>
                            </li>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Wishlist', 'action' => 'display']) ?>">Wishlist</a>
                            </li>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'coupons']) ?>">Coupons</a>
                            </li>
                            <li class="menu_item">
                                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'contact-us']) ?>">Contact
                                    Us</a>
                            </li>
                            <li class="menu_item">
                                <a href="javascript:logout()"><b>LOGOUT</b></a>
                            </li>
                        <?php else : ?>
                            <li class="mobile_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'login']) ?>">LOGIN</a>
                            </li>
                            <li class="mobile_item">
                                <a href="<?= $this->Url->build(['controller' => 'Customer', 'action' => 'signup']) ?>">REGISTER</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <div class="accordion">
                <h4 class="accordion-toggle">All Fabrics</h4>
                <div class="accordion-content mobile_click_accord">
                    <ul>
                        <?php foreach ($categories as $category) : ?>
                            <li class="mobile_item">
                                <a href="<?= (!empty($category->url)) ? $category->url : $this->Url->build(['_name' => 'category', $category->slug]) ?>"><?= ucwords($category->name) ?></a>
                                <?= $this->Cell('Category::hasSubCategories', [$category]) ?>
                                <div class="moblie_item_visible">
                                    <?= $this->Cell('Category::subCategories', [$category]) ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </li>
		<!--<li>
			<a href="<?= $this->Url->build(['_name' => 'category','combination-sets']) ?>">
				<h4>Joda By HPSingh <button type="button" class="new_bttn">New</button>
					<p>An extensive collection of ready-to-stitch indian ethnic co-ord fabrics, especially curated to look your best.</p>
				</h4>
			</a>
		</li>-->
        <li>
            <a href="<?= $this->Url->build(['_name' => 'sale']) ?>">
                <h4>Deals</h4>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'bulk-enquiry']) ?>">
                <h4>Bulks Order</h4>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'live-browsing']) ?>">
                <h4>Live Browsing</h4>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'enquire-now']) ?>">
                <h4>Enquire</h4>
            </a>
        </li>
        <li>
            <a href="<?= $this->Url->build(['_name' => 'stories']) ?>">
                <h4>Stories</h4>
            </a>
        </li>
		<li>
			<a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'trackOrder']) ?>">
				<h4>Track Order</h4>
			</a>
		</li>
        <li>
            <div id="google_translate_element_mobile"></div>
        </li>
    </ul>
</div>

<div class="mobile_search_window">
    <div class="mobile_serach_group">
        <a onclick="$('.mobile_search_window').removeClass('active')" class="_2ItTa6"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMCAwaDI0djI0SDB6Ii8+PHBhdGggZmlsbD0iIzc1NzU3NSIgZD0iTTIwIDExSDcuOGw1LjYtNS42TDEyIDRsLTggOCA4IDggMS40LTEuNEw3LjggMTNIMjB6Ii8+PC9nPjwvc3ZnPg=="></a>
        <div class="mobile_search">
            <input type="text" id="mobile-search-products" placeholder="Search for product by name, code, design nos, fabric name" autofocus>
            <span onclick="$('#moodboard').click()" class="recognition"><i class="fa fa-picture-o"></i></span>
        </div>
    </div>
    <div class="categories-list">
        <h3><span>What do you wanna make</span></h3>
        <?php foreach ($wearing as $wearingItem) : ?>
            <div class="category">
                <a href="<?= (!empty($wearingItem->url)) ? $wearingItem->url : $this->Url->build(['_name' => 'category', $wearingItem->slug]) ?>">
                    <?= $this->Media->the_image('full', $wearingItem->media->url, ['alt' => $wearingItem->media->alt, 'class' => 'img-responsive']) ?>
                    <p><?= strtoupper($wearingItem->name) ?></p>
                </a>
            </div>
        <?php endforeach; ?>
        <h3><span>Fabric Categories</span></h3>
        <?php foreach ($categories as $category) : ?>
            <div class="category">
                <a href="<?= (!empty($category->url)) ? $category->url : $this->Url->build(['_name' => 'category', $category->slug]) ?>">
                    <?= $this->Media->the_image('full', $category->media->url, ['alt' => $category->media->alt, 'class' => 'img-responsive,']) ?>
                    <p><?= strtoupper($category->name) ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->Form->create(null, ['url' => ['controller' => 'search', 'action' => 'searchByImage'], 'type' => 'file', 'style' => 'display:none', 'id' => 'searchByMoodboard']) ?>
<?= $this->Form->control('reference', ['label' => false, 'type' => 'file', 'id' => 'moodboard', 'onchange' => '$("#searchByMoodboard").submit()']) ?>
<?= $this->Form->end() ?>