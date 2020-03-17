<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rivendellweb
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rivendellweb_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
		$classes[] = 'archive-view';
	}

	// Adds a class of no-sidebar neither sidebar-1
	// or sidebar-2 are active.
	//
	// This is where you can get creative with the test and
	// add different classes based on which sidebar is active
	// and style accordingly.
	if ( ( ! is_active_sidebar( 'sidebar-1' ) ) ||
		 	 ( ! is_active_sidebar( 'sidebar-2' ) ) ) {
		$classes[] = 'no-sidebar';
	} else {
		// Otherwise add the has-sidebar class
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'rivendellweb_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rivendellweb_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'rivendellweb_pingback_header' );
