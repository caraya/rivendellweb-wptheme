<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rivendellweb
 */
// If neither sidebar-1 or sidebar-2 are active
// then bail, nothing for us to do here
if ( ( ! is_active_sidebar( 'sidebar-1' ) ) ||
		 ( ! is_active_sidebar( 'sidebar-2' ) ) ) {
	return;
}

// Otherwise add the sidebars
?>

<aside id="sidebar1" class="widget-area sidebar1">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- sidebar1 -->

<aside id="sidebar2" class="widget-area sidebar2">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- sidebar2 -->
