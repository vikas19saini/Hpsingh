<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <title><?= $this->fetch('title') ?></title>
        <link rel="manifest" href="/manifest.json">
        <link rel="canonical" href="<?= $this->Url->build(null, true) ?>"/>
        <meta property="og:locale" content="en_US"/>
        <?= $this->fetch('meta') ?>
        <meta property="og:url" content="<?= $this->Url->build(null, true) ?>"/>
        <meta property="og:type" content="website"/>
        <meta name="google-site-verification" content="4ekAlP1b9pSf-zGkuRHvItVRose7Yk4DV_jkfmJiQco" />
        <meta property="og:site_name" content="<?= Cake\Core\Configure::read('Store.name') ?>"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <?php if(!\Cake\Core\Configure::read('debug')):?>
            <link rel="stylesheet" href="/css/front/css/style.php">
            <?php else:?>
                 <?= $this->Html->css('front/css/bootstrap.min') ?>
        <?= $this->Html->css('front/css/animate.min') ?>
        <?= $this->Html->css('front/css/aos') ?>
        <?= $this->Html->css('front/css/header') ?>
        <?= $this->Html->css('front/css/footer') ?>
        <?= $this->Html->css('front/css/font') ?>
        <?= $this->Html->css('front/css/owl.carousel') ?>
        <?= $this->Html->css('front/css/style') ?>
        <?= $this->Html->css('front/css/responsive') ?>
            <?php endif;?>

        <?= $this->Html->script('front/lazysizes.min') ?>
        <?= $this->Html->meta('icon', BASE . 'img/favicon.ico', ['type' => 'icon']) ?>
        <?= $this->fetch('css') ?>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
            href="https://www.hpsingh.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <?php if(!\Cake\Core\Configure::read('debug')):?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-105800906-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-105800906-1');
        </script>
        <!-- Global site tag (gtag.js) - Google Ads: 835074064 -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=AW-835074064"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'AW-835074064');
		</script>
		<!-- Event snippet for Add to cart conversion page
		In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
		<script>
		function gtag_report_conversion(url) {
		  var callback = function () {
		    if (typeof(url) != 'undefined') {
		      window.location = url;
		    }
		  };
		  gtag('event', 'conversion', {
		      'send_to': 'AW-835074064/83ToCM247tQBEJDwmI4D',
		      'event_callback': callback
		  });
		  return false;
		}
		</script>
        <!-- Facebook Pixel Code -->
        <script>
            !function (f, b, e, v, n, t, s)
            {
                if (f.fbq)
                    return;
                n = f.fbq = function () {
                    n.callMethod ?
                            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq)
                    f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1954780331515974');
            fbq('track', 'PageView');
            fbq('track', 'ViewContent');
        </script>
        <noscript>
        <img height="1" width="1"
         src="https://www.facebook.com/tr?id=1954780331515974&ev=PageView
         &noscript=1"/>
    </noscript>
<?php endif;?>
    <!-- End Facebook Pixel Code -->
</head>
    <body class="<?= $this->fetch('bodyClass') ?>">
    <?= $this->fetch('content') ?>

    <?= $this->Html->script('front/jquery-1.12.0.min') ?>
    <?= $this->Html->script('front/bootstrap.min') ?>
    <?= $this->Html->script('front/wow') ?>
    <?= $this->Html->script('front/jarallax') ?>
    <?= $this->Html->script('front/aos') ?>
    <?= $this->Html->script('front/smoothScroll.min') ?>
    <?= $this->Html->script('front/owl.carousel') ?>
    <?= $this->Html->script('front/hpsingh') ?>
    <?= $this->Html->script('front/zoom.min') ?>
    <script type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            if (window.innerWidth <= 767) {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element_mobile');
            } else {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
        }
    </script>
    <script src="//code.tidio.co/1zwdxhovgpntyaotemgeo7s4meb0ydvu.js"></script>
    <?= $this->fetch('script') ?>
    <script>
        var HOST = "<?= BASE?>";
        var _csrfToken = "<?= $this->request->getParam('_csrfToken')?>";
    </script>
    <?= $this->Flash->render() ?>
    <!--<div class="landscape-mode">
        <div class="inner-landscape">
            <?/*= $this->Html->image('rotate.png') */?>
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

<?php if (!isset($_COOKIE['privacy-policy'])): ?>
    <div class="privacy-policy" style="display: none">
        <p>We use cookies to collect and analyze site performance and usage. Please visit our Cookie Policy to find out
            more. <span id="setcookies">I'm happy with this</span> <span><a
                    href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'staticPage', 'privacy-policy']) ?>">Learn more</a></span>
        </p>
    </div>
    <script>
        $("#setcookies").click(function () {
            document.cookie = "privacy-policy=accepted";
            $(this).parent('p').parent('.privacy-policy').remove();
        });
    </script>
<?php endif; ?>
</body>
</html>
