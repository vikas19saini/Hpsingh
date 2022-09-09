<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $this->fetch('title') ?></title>
    <link rel="manifest" href="/manifest.json">
    <link rel="canonical" href="<?= $this->Url->build(null, true) ?>" />
    <meta property="og:locale" content="en_US" />
    <?= $this->fetch('meta') ?>
    <meta property="og:url" content="<?= $this->Url->build(null, true) ?>" />
    <meta property="og:type" content="website" />
    <meta name="google-site-verification" content="4ekAlP1b9pSf-zGkuRHvItVRose7Yk4DV_jkfmJiQco" />
    <meta property="og:site_name" content="<?= Cake\Core\Configure::read('Store.name') ?>" />
    <meta name="facebook-domain-verification" content="qgq7761nxprq69rwas26z1utqrpzgr" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta name="google-signin-client_id" content="320168265137-pot5ekhg07ejob9e70or1l71ab93o2o7.apps.googleusercontent.com">

    <?php if (!\Cake\Core\Configure::read('debug')) : ?>
        <link rel="stylesheet" href="/css/front/css/style.php">
    <?php else : ?>
        <?= $this->Html->css('front/css/bootstrap.min') ?>
        <?= $this->Html->css('front/css/animate.min') ?>
        <?= $this->Html->css('front/css/aos') ?>
        <?= $this->Html->css('front/css/header') ?>
        <?= $this->Html->css('front/css/footer') ?>
        <?= $this->Html->css('front/css/font') ?>
        <!--<?= $this->Html->css('front/css/owl.carousel') ?>-->
		<?= $this->Html->css('front/css/slick') ?>
        <?= $this->Html->css('front/css/thems') ?>									
        <?= $this->Html->css('front/css/style') ?>
        <?= $this->Html->css('front/css/responsive') ?>
		<?= $this->Html->css('front/css/new-sliders-css') ?>

    <?php endif; ?>

    <?= $this->Html->script('front/lazysizes.min') ?>
    <?= $this->Html->meta('icon', BASE . 'img/favicon.ico', ['type' => 'icon']) ?>
    <?= $this->fetch('css') ?>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
            href="https://www.hpsingh.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <?php if (!\Cake\Core\Configure::read('debug')) : ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-105800906-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-105800906-1');
            gtag('config', 'AW-835074064');
            <?php if (isset($showAnalytics)) : ?>
                gtag('event', 'conversion', {
                    'send_to': 'AW-835074064/sUMuCIvM7PMBEJDwmI4D',
                    'value': '<?= $order->grand_total ?>',
                    'currency': 'INR'
                });
            <?php endif; ?>
        </script>
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-MW9RXHP');
        </script>
        <!-- End Google Tag Manager -->
    <?php endif; ?>
    <!-- End Facebook Pixel Code -->
</head>

<body class="<?= $this->fetch('bodyClass') ?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MW9RXHP" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?= $this->fetch('content') ?>

    <?= $this->Html->script('front/jquery-1.12.0.min') ?>
	<?= $this->Html->script('front/slick') ?>									  
    <?= $this->Html->script('front/bootstrap.min') ?>
    <?= $this->Html->script('front/wow') ?>
    <?= $this->Html->script('front/jarallax') ?>
    <?= $this->Html->script('front/aos') ?>
    <?= $this->Html->script('front/smoothScroll.min') ?>
    <!--<?= $this->Html->script('front/owl.carousel') ?>-->
    <?= $this->Html->script('front/hpsingh') ?>
    <?= $this->Html->script('front/zoom.min') ?>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            if (window.innerWidth <= 767) {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element_mobile');
            } else {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        }
    </script>
    <script src="//code.tidio.co/1zwdxhovgpntyaotemgeo7s4meb0ydvu.js"></script>
    <?= $this->fetch('script') ?>
    <script src="https://apis.google.com/js/platform.js?onload=onLoadGapi" async defer></script>
    <script>
        var HOST = "<?= BASE ?>";
        var _csrfToken = "<?= $this->request->getParam('_csrfToken') ?>";
    </script>
    <?= $this->Flash->render() ?>
    <!--<div class="landscape-mode">
        <div class="inner-landscape">
            <?/*= $this->Html->image('rotate.png') */ ?>
            <h4>Please rotate your device</h4>
            <p>We don't support landscape mode yet. Please go back to portrait mode for the best experience.</p>
        </div>
    </div>-->
    <!--<script>
        window.addEventListener("orientationchange", function () {
            if (screen.orientation.type === 'landscape-primary') {
                $(".landscape-mode").css('display', 'block');
            } else {
                $(".landscape-mode").css('display', 'none');
            }
        });
    </script>-->

    <?php if (!isset($_COOKIE['privacy-policy'])) : ?>
        <div class="privacy-policy" style="display: none">
            <p>We use cookies to collect and analyze site performance and usage. Please visit our Cookie Policy to find out
                more. <span id="setcookies">I'm happy with this</span> <span><a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'privacy-policy']) ?>">Learn more</a></span>
            </p>
        </div>
        <script>
            $("#setcookies").click(function() {
                document.cookie = "privacy-policy=accepted";
                $(this).parent('p').parent('.privacy-policy').remove();
            });
        </script>
    <?php endif; ?>
</body>

</html>