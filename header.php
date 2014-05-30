<?php /**
 * The header template for Travel Planet theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @subpackage Travel Planet
 * @since Travel Planet 1.2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title( '|', true, 'left' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<div id="header">
			<div id="header-background">
				<div id="trvlplnt-header-top">
					<header class="trvlplnt-bloginfo-box alignleft" role="banner">
						<h1 id="site-header" class="trvlplnt-site-title wrap"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 id="site-description" class="wrap"><?php bloginfo( 'description' ) ?></h2>	
					</header><!-- .trvlplnt-bloginfo-box -->
					<nav id="trvlplnt-nav-menu" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav>
					<div class="clear">
					</div>
				</div><!-- #trvlplnt-header-top -->
			</div><!-- #header-background -->
			<div id="trvlplnt-header-string">
				<div class="trvlplnt-header-string-current">
					<div class="string alignleft">
						<h3 class="wrap capitalize"><?php echo the_title() ?></h3>
					</div>
					<div class="string alignright text-right">
						<div class="bread">
							<span class="wrap"><?php do_action( 'trvlplnt_set_breadcrumbs' ); ?></span>
						</div>
					</div><!-- .trvlplnt-header-string-current -->
					<div class="clear">
					</div>
				</div><!-- .trvlplnt-header-string-current -->
			</div><!-- #trvlplnt-header string -->
			<?php if ( is_front_page() ) : ?>
				<div id="trvlplnt-slider">
					<?php do_action( 'trvlplnt_set_slider' ); ?>
				</div><!-- #trvlplnt-slider -->
			<?php endif; ?>
		</div><!-- #header -->
		<section id="page">