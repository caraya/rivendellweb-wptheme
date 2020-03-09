<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rivendellweb
 */
// If footer-1 or footer-2 are not active then bail
// There is nothing to display
if 	( ( ! is_active_sidebar( 'footer-1' ) ) ||
			( ! is_active_sidebar( 'footer-2' ) ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area footer-widgets">
	<div class="footer-widgets-block-1">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
	<div class="footer-widgets-block-2">
		<?php dynamic_sidebar( 'footer-2' ); ?>
	</div>
</aside><!-- #secondary -->
