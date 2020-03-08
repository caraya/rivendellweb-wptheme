<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rivendellweb
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area footer-widgets">
	<?php dynamic_sidebar( 'footer-1' ); ?>
</aside><!-- #secondary -->
