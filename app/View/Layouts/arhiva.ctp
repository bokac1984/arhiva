<!DOCTYPE html>
<!-- Template Name: Clip-One - Frontend | Build with Twitter Bootstrap 3 | Version: 1.5 | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>Arhiva - Transparency International BiH</title>
        <!-- start: META -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- start: HTML5SHIV FOR IE8 -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/html5shiv.js"></script>
        <![endif]-->
        <!-- end: HTML5SHIV FOR IE8 -->
        <?php echo $this->Html->charset(); ?>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min');
        echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min');
        echo $this->Html->css('/fonts/style');
        echo $this->Html->css('/plugins/animate.css/animate.min');
        echo $this->Html->css('main');
        echo $this->Html->css('main-responsive');
        echo $this->Html->css('theme_blue');
        ?>
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->      
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>  
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    </head>
    <!-- end: HEAD -->
    <body>
        <!-- start: HEADER -->
        <header>
            <!-- start: TOP BAR -->
            <div class="clearfix " id="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- start: TOP BAR CALL US -->
                            <div class="callus">
                                Vratite se na 
                                <a href="https://ti-bih.org">
                                    ti-bih.org
                                </a>
                            </div>
                            <!-- end: TOP BAR CALL US -->
                        </div>
                        <div class="col-sm-6">
                            <!-- start: TOP BAR SOCIAL ICONS -->
                            <div class="social-icons">
                                <ul>
                                    <li class="social-twitter tooltips" data-original-title="Twitter" data-placement="bottom">
                                        <a target="_blank" href="http://www.twitter.com">
                                            Twitter
                                        </a>
                                    </li>
                                    <li class="social-dribbble tooltips" data-original-title="Dribbble" data-placement="bottom">
                                        <a target="_blank" href="http://dribbble.com">
                                            Dribbble
                                        </a>
                                    </li>
                                    <li class="social-facebook tooltips" data-original-title="Facebook" data-placement="bottom">
                                        <a target="_blank" href="http://facebook.com">
                                            Facebook
                                        </a>
                                    </li>
                                    <li class="social-google tooltips" data-original-title="Google" data-placement="bottom">
                                        <a target="_blank" href="http://google.com">
                                            Google+
                                        </a>
                                    </li>
                                    <li class="social-linkedin tooltips" data-original-title="LinkedIn" data-placement="bottom">
                                        <a target="_blank" href="http://linkedin.com">
                                            LinkedIn
                                        </a>
                                    </li>
                                    <li class="social-youtube tooltips" data-original-title="YouTube" data-placement="bottom">
                                        <a target="_blank" href="http://youtube.com/">
                                            YouTube
                                        </a>
                                    </li>
                                    <li class="social-rss tooltips" data-original-title="RSS" data-placement="bottom">
                                        <a target="_blank" href="#" >
                                            RSS
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end: TOP BAR SOCIAL ICONS -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: TOP BAR -->
            <div role="navigation" class="navbar navbar-default navbar-fixed-top space-top">
                <!-- start: TOP NAVIGATION CONTAINER -->
                <div class="container">
                    <div class="navbar-header">
                        <!-- start: RESPONSIVE MENU TOGGLER -->
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- end: RESPONSIVE MENU TOGGLER -->
                        <!-- start: LOGO -->
                        <a class="navbar-brand" href="/">
                            Arhiva ti-bih
                        </a>
                        <!-- end: LOGO -->
                    </div>
                    <div class="navbar-collapse collapse">
                        <?php echo $this->element('menu'); ?>
                    </div>
                </div>
                <!-- end: TOP NAVIGATION CONTAINER -->
            </div>
        </header>
        <!-- end: HEADER -->
        <!-- start: MAIN CONTAINER -->
        <div class="main-container">
            <?php echo $this->Flash->render(); ?>

            <?php echo $this->fetch('content'); ?>
        </div>
        <!-- end: MAIN CONTAINER -->
        <!-- start: FOOTER -->
        <footer id="footer">
            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1">
                            <a class="logo" href="/">
                                Arhiva ti-bih
                            </a>
                        </div>
                        <div class="col-md-7">
                            <p>
                                &copy; Copyright <?php echo date("Y"); ?> by Transparency International BiH. Sva prava zadržana.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <nav id="sub-menu">
                                <ul>
                                    <li>
                                        <a href="/">
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/institutions">
                                            Institucije
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/contact">
                                            Contact
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a id="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>
        <!-- end: FOOTER -->
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script src="assets/plugins/html5shiv.js"></script>
        <script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="/plugins/jquery.transit/jquery.transit.js"></script>
        <script src="/plugins/hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script src="/plugins/jquery.appear/jquery.appear.js"></script>
        <script src="/plugins/blockUI/jquery.blockUI.js"></script>
        <script src="/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="/js/main.js"></script>
        <?php echo $this->fetch('scriptBottom'); ?>
        <!-- end: MAIN JAVASCRIPTS -->
        <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script src="/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
        <script src="/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script src="/plugins/flex-slider/jquery.flexslider.js"></script>
        <script src="/plugins/stellar.js/jquery.stellar.min.js"></script>
        <script src="/plugins/colorbox/jquery.colorbox-min.js"></script>
        <script src="/js/index.js"></script>
        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
            jQuery(document).ready(function () {
                Main.init();
                Index.init();
                $.stellar();
            });
        </script>
    </body>
</html>
