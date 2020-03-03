<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rivendellweb
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'rivendellweb' ); ?></a>

	<?php if ( ( is_front_page() && is_home() ) || is_single() ) : ?>
		<figure class="header-image">
			<?php the_header_image_tag(); ?>
		</figure>
	<?php endif ?>
	<header id="masthead" class="site-header">
		<?php the_custom_logo();?>
		<div class="site-branding">
			<div class="site-branding__text">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				endif;
				$rivendellweb_description = get_bloginfo( 'description', 'display' );
				if ( $rivendellweb_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $rivendellweb_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div> <!-- .site-branding__text -->
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'rivendellweb' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'header',
				'menu_id'        => 'rivendellweb.menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
