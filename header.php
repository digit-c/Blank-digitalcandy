<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
<!--         <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-194x194.png" sizes="194x194">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/manifest.json">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/safari-pinned-tab.svg" color="#fc391d">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/mstile-144x144.png">
		<meta name="theme-color" content="#fc391d">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
<?php $siteURL = get_site_url(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner">

					<!-- logo -->
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
							<img src="<?php echo get_template_directory_uri(); ?>/img/poplet-logo.svg" alt="POPLET Logo" class="logo-img">
						</a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<nav class="nav" role="navigation">
						<!-- <?php html5blank_nav(); ?> -->
										
				<?php 
				if ( is_user_logged_in() ) {
				    $user = wp_get_current_user();
						if ( in_array( 'subscriber', (array) $user->roles ) ) {
					    //User 1
					    // wp_nav_menu('menu=Menu user1');
				    						 wp_nav_menu(array(
				    					         'container' => false,                           // remove nav container
				    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				    					         'menu' => __( 'Menu user1', 'bonestheme' ),  	// nav name
				    					         'menu_class' => '',               // adding custom nav class
				    					         'theme_location' => 'main-nav',                 // where it's located in the theme
				    					         'before' => '',                                 // before the menu
				        			               'after' => '',                                  // after the menu
				        			               'link_before' => '',                            // before each link
				        			               'link_after' => '',                             // after each link
				        			               'depth' => 0,                                   // limit the depth of the nav
				        			               'items_wrap' => '<ul>%3$s<li class="right"><a href="'. wp_logout_url() .'">Logout</li><li class="right"><a href="'.$siteURL.'/dashboard/">Dashboard</a></li></ul>',
				    					         'fallback_cb' => ''                             // fallback function (if there is one)
										)); 
						}

						if ( in_array( 'contributor', (array) $user->roles ) ) {
						    //User 2
						    // wp_nav_menu('menu=Menu user2');
						    						 wp_nav_menu(array(
						    					         'container' => false,                           // remove nav container
						    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
						    					         'menu' => __( 'Menu user2', 'bonestheme' ),  	// nav name
						    					         'menu_class' => '',               // adding custom nav class
						    					         'theme_location' => 'main-nav',                 // where it's located in the theme
						    					         'before' => '',                                 // before the menu
						        			               'after' => '',
						        			               // after the menu
						        			               'link_before' => '',                            // before each link
						        			               'link_after' => '',                             // after each link
						        			               'depth' => 0,                                   // limit the depth of the nav
						        			               'items_wrap' => '<ul>%3$s<li class="right"><a href="'. wp_logout_url() .'">Logout</li><li class="right"><a href="'.$siteURL.'/dashboard/">Dashboard</a></li></ul>',
						    					         'fallback_cb' => ''                             // fallback function (if there is one)
												)); 
						}

						if ( in_array( 'administrator', (array) $user->roles ) ) {
						    //User 2
						    // wp_nav_menu('menu=Menu user2');
						    						 wp_nav_menu(array(
				    					         'container' => false,                           // remove nav container
				    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				    					         'menu' => __( 'Menu Admin', 'bonestheme' ),  // nav name
				    					         'menu_class' => '',               // adding custom nav class
				    					         'theme_location' => 'main-nav',                 // where it's located in the theme
				    					         'before' => '',                                 // before the menu
				        			               'after' => '',                                  // after the menu
				        			               'link_before' => '',                            // before each link
				        			               'link_after' => '',                             // after each link
				        			               'depth' => 0,                                   // limit the depth of the nav
				        			               'items_wrap' => '<ul>%3$s<li class="right"><a href="'. wp_logout_url() .'">Logout</li><li class="right"><a href="'.$siteURL.'/dashboard/">Dashboard</a></li></ul>',
				    					         'fallback_cb' => ''                             // fallback function (if there is one)
										));
						}
				} else {
				    	wp_nav_menu(array(
				    					         'container' => false,                           // remove nav container
				    					         'container_class' => 'menu cf',                 // class of container (should you choose to use it)
				    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
				    					         'menu_class' => '',               // adding custom nav class
				    					         'theme_location' => 'main-nav',                 // where it's located in the theme
				    					         'before' => '',                                 // before the menu
				        			               'after' => '',                                  // after the menu
				        			               'link_before' => '',                            // before each link
				        			               'link_after' => '',                             // after each link
				        			               'depth' => 0,                                   // limit the depth of the nav
				        			               'items_wrap' => '<ul>%3$s<li class="right"><a href="'.$siteURL.'/login/">Login</a></li></ul>',
				    					         'fallback_cb' => ''                             // fallback function (if there is one)
										));
				}


				?>
					</nav>
					<!-- /nav -->

			</header>
			<div id="red-border">
			<!-- /header -->
