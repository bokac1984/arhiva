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
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <script src="assets/plugins/html5shiv.js"></script>
        <script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
        <!--<![endif]-->        
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
                            <div class="moj-meni">
                                <ul>
                                    <li>
                                        <?php
                                        if ($this->Session->read('Auth.User')) {
                                            if ($this->Session->read('Auth.User')) {
                                                echo '<div>Prijavljen kao: ' . $this->Session->read('Auth.User.username');
                                                echo '&nbsp' . $this->Html->link('Odjavi se', array(
                                                    'plugin' => 'null',
                                                    'controller' => 'users',
                                                    'action' => 'logout'
                                                        ), array(
                                                    'class' => 'item'
                                                        )
                                                );
                                                echo " </div>";
                                            }
                                        } else {
                                            echo $this->Html->link('Prijavi se', array('controller' => 'users', 'action' => 'login'), array('class' => 'item'));
                                        }
                                        ?>
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
            <section class="wrapper">
                <!-- start: BLOG POSTS AND COMMENTS CONTAINER -->
                <div class="container">            
                <?php echo $this->Flash->render(); ?>                           

                <?php echo $this->fetch('content'); ?>
                </div>
            </section>                    
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
                                        <a href="/ugovori-o-djelu-javnih-institucija">
                                            Ugovori o djelu
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/ugovori-o-nabavkama-javnih-preduzeca">
                                            Javne nabavke
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
        <?php //echo $this->element('sql_dump'); ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-86983386-1', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>
