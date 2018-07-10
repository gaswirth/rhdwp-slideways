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

		<title><?php wp_title(); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<div id="loader">
			<div class="center">
				<img src="<?php echo home_url( '/wp-content/uploads/2016/03/loader.gif'); ?>" alt="Loading">
				<p>One moment, please...</p>
			</div>
		</div>

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

				<h1 id="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>

				<div id="rhd-nav-menu">
					<?php wp_nav_menu( $nav_args ); ?>
					<?php echo do_shortcode( '[rhd-social-icons facebook="https://www.facebook.com/aliewoldt" twitter="aliewoldt" instagram="aliewoldt" color1="#fff" color2="#fff" widget_id="1"]' ); ?>
				</div>

				<button id="hamburger" class="c-hamburger c-hamburger--htx">
					<span>Toggle nav</span>
				</button>
			</header>
			<main id="main" class="clearfix">
