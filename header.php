<?php
/**
 * RHD Base
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage rhd
 */
?>

<!DOCTYPE html>
	<!--[if lt IE 7]>   <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>     <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!--
									   _  _
                                      | || |
         ____  ___   _   _  ____    _ | || | _    ___   _   _   ___   ____
        / ___)/ _ \ | | | ||  _ \  / || || || \  / _ \ | | | | /___) / _  )
       | |   | |_| || |_| || | | |( (_| || | | || |_| || |_| ||___ |( (/ /
       |_|    \___/  \____||_| |_| \____||_| |_| \___/  \____|(___/  \____)

                                     _               _
                                    | |             (_)
                                  _ | |  ____   ___  _   ____  ____    ___
                                 / || | / _  ) /___)| | / _  ||  _ \  /___)
                                ( (_| |( (/ / |___ || |( ( | || | | ||___ |
                                 \____| \____)(___/ |_| \_|| ||_| |_|(___/
                                                       (_____|

		-->

		<title><?php wp_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<div id="page" class="hfeed site">
			<header id="masthead" class="full-bg">
				<?php
				$nav_args = array(
					'menu_location' => 'primary',
					'menu_id' => 'site-navigation',
					'container' => 'nav',
					'container_id' => 'site-navigation-container',
					'walker' => new RHD_Walker_Nav
				);
				?>
				
				<h1 id="site-title"><?php bloginfo( 'name' ); ?></h1>
				
				<?php wp_nav_menu( $nav_args ); ?>
				
				<button id="hamburger" class="c-hamburger c-hamburger--htx">
					<span>Toggle nav</span>
				</button>
			</header>
			<main id="main" class="clearfix">