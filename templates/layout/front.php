<!DOCTYPE html>
<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$cakeDescription = Configure::read('Client.name');
$url = Router::url('/', true);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="description" content="<?= $cakeDescription ?>">
        <meta name="author" content="Diônata Garcia">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <?php /* ==== Favicons ==== */ ?>
        <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- CSS here -->
        <?= $this->Html->css('../front-template/assets/css/bootstrap.min.css') ?>
        <?= $this->Html->css('../front-template/assets/css/owl.carousel.min.css') ?>
        <?= $this->Html->css('../front-template/assets/css/slicknav.css') ?>
        <?= $this->Html->css('../front-template/assets/css/flaticon.css') ?>
        <?= $this->Html->css('../front-template/assets/css/animate.min.css') ?>
        <?= $this->Html->css('../front-template/assets/css/magnific-popup.css') ?>
        <?= $this->Html->css('../front-template/assets/css/fontawesome-all.min.css') ?>
        <?= $this->Html->css('../front-template/assets/css/themify-icons.css') ?>
        <?= $this->Html->css('../plugins/fancybox-master/dist/jquery.fancybox.min.css') ?>
        <?= $this->Html->css('../front-template/assets/css/slick.css') ?>
        <?= $this->Html->css('../front-template/assets/css/nice-select.css') ?>
        <?= $this->Html->css('../front-template/assets/css/style.css') ?>

        <?= $this->Html->css('front/front-styles.css') ?>

        <title>
            <?= $cakeDescription ?>
        </title>

        <?= $this->Html->meta('icon') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
    </head>
    <body class="page-index" data-url="<?= $url ?>">
        <!--header-->
        <?= $this->element('front/template/header') ?>

        <!--render-->
        <div class="container-flash">
            <?= $this->Flash->render() ?>
        </div>

        <!--Main Content-->
        <main>
            <?= $this->fetch('content') ?>
        </main>
        <!-- End #main -->

        <!--footer-->
        <?= $this->element('front/template/footer') ?>

        <!-- All JS Custom Plugins Link Here here -->
        <?= $this->Html->script('../front-template/assets/js/vendor/modernizr-3.5.0.min.js') ?>
        <!-- Jquery, Popper, Bootstrap -->
        <?= $this->Html->script('../front-template/assets/js/vendor/jquery-1.12.4.min.js') ?>
        <?= $this->Html->script('../front-template/assets/js/popper.min.js') ?>
        <?= $this->Html->script('../front-template/assets/js/bootstrap.min.js') ?>
        <!-- Jquery Mobile Menu -->
        <?= $this->Html->script('../front-template/assets/js/jquery.slicknav.min.js') ?>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <?= $this->Html->script('../front-template/assets/js/owl.carousel.min.js') ?>
        <?= $this->Html->script('../front-template/assets/js/slick.min.js') ?>
        <!-- One Page, Animated-HeadLin -->
        <?= $this->Html->script('../front-template/assets/js/wow.min.js') ?>
        <?= $this->Html->script('../front-template/assets/js/animated.headline.js') ?>
        <?= $this->Html->script('../front-template/assets/js/jquery.magnific-popup.js') ?>

        <!-- Nice-select, sticky -->
        <?= $this->Html->script('../front-template/assets/js/jquery.nice-select.min.js') ?>
        <?= $this->Html->script('../front-template/assets/js/jquery.sticky.js') ?>

        <!-- contact js -->
        <?= $this->Html->script('../front-template/assets/js/contact.js') ?>
        <?= $this->Html->script('../front-template/assets/js/jquery.form.js') ?>
        <?= $this->Html->script('../front-template/assets/js/jquery.validate.min.js') ?>
        <?= $this->Html->script('../front-template/assets/js/mail-script.js') ?>
        <?= $this->Html->script('../front-template/assets/js/jquery.ajaxchimp.min.js') ?>
        <?= $this->Html->script('../plugins/fancybox-master/dist/jquery.fancybox.js') ?>

        <!-- Jquery Plugins, main Jquery -->
        <?= $this->Html->script('../front-template/assets/js/plugins.js') ?>
        <?= $this->Html->script('../front-template/assets/js/main.js') ?>
        <?= $this->Html->script('front/instafeed.min.js') ?>
        <?= $this->Html->script('front/front-scripts.js') ?>

        <?= $this->fetch('script') ?>

        <!-- Fetch Custom Scripts -->
        <?= $this->fetch('custom') ?>
    </body>

</html>
