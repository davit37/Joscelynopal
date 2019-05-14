<html lang="end">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        $web_title = 'Joscelyn Opal';
        if ($title != '') {
            $web_title = $title . ' - ' . $web_title;
        }
        ?>
        <title><?php echo $web_title ?></title>

        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url("assets/favicon/apple-icon-57x57.png") ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url("assets/favicon/apple-icon-60x60.png") ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url("assets/favicon/apple-icon-72x72.png") ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/favicon/apple-icon-76x76.png") ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url("assets/favicon/apple-icon-114x114.png") ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url("assets/favicon/apple-icon-120x120.png") ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url("assets/favicon/apple-icon-144x144.png") ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url("assets/favicon/apple-icon-152x152.png") ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("assets/favicon/apple-icon-180x180.png") ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url("assets/favicon/android-icon-192x192.png") ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("assets/favicon/favicon-32x32.png") ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url("assets/favicon/favicon-96x96.png") ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/favicon/favicon-16x16.png") ?>">
        <link rel="manifest" href="<?php echo base_url("assets/favicon/manifest.json") ?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url("assets/favicon/ms-icon-144x144.png") ?>">
        <meta name="theme-color" content="#ffffff">

        <!-- Main Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css').'?'.md5(date('c'));?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/override.css').'?'.md5(date('c'));?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/media-query.css').'?'.md5(date('c'));?>">

        <!-- CSS RS STYLE-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style_rs.css'); ?>" media="screen" />

        <!-- Video JS -->
        <link href="<?php echo base_url('assets/css/video-js.css'); ?>" rel="stylesheet" type="text/css">

        <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/rs-plugin/css/settings.css'); ?>" media="screen" />

        <!-- Main JS -->
        <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script> 
        
        <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
        <script type="text/javascript" src="<?php echo base_url('assets/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>

        <!-- Video JS -->
        <script src="<?php echo base_url('assets/js/video.js'); ?>"></script>
        <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
        <script>
            videojs.options.flash.swf = "<?php echo base_url('assets/js/video-js.swf'); ?>";
        </script>

        <!-- RESPONSIVE NAV -->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive-nav.css'); ?>">
        <script src="<?php echo base_url('assets/js/responsive-nav.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/matchheight/jquery.matchHeight.min.js'); ?>"></script>
        <!-- <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-49774903-7', 'auto');
	  ga('send', 'pageview');
	
	</script> -->
    </head>
    <body>
        <?php
        //Menu
        if ($this->uri->segment(1) != FALSE) {
            $this->load->view('section/menu');
            ?>

            <div class="container">
                <!-- Logo -->
                <?php $this->load->view('section/logo') ?>


            </div>

        <?php } ?>

        <div class="container">
            <?php
            if ($this->uri->segment(1) != FALSE) {
                //Shop Menu
                $this->load->view('section/shop_menu');

                //Main Menu
                $this->load->view('section/main_menu');
            }

            //Content
            $this->load->view($load_view);
            ?>
        </div>

        <?php
        //Footer
        if ($this->uri->segment(1) != FALSE) {
            $this->load->view('section/footer');
        }
        ?>

    </body>
</html>