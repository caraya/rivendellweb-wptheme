<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rivendellweb
 */

if ( ( ! is_active_sidebar( 'sidebar-1' ) ) ||
		 ( ! is_active_sidebar( 'sidebar-2' ) ) ) {
	return;
}
?>

<?php if ( is_single() || is_front_page() || is_home() ) : ?>
	<aside id="sidebar1" class="widget-area sidebar1">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- sidebar1 -->

	<aside id="sidebar2" class="widget-area sidebar2">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- sidebar2 -->
<?php endif; ?>
