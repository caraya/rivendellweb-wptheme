<?php
/**
 * Custom template tags for this theme
 *
 * Rather than write blocks of text I've broken the blocks
 * into individual functions so I can plug them into different
 * places and repeat them in different places if needed/wanted
 *
 * Eventually, some of the functionality here could be
 * replaced by core features.
 *
 * @package rivendellweb
 * @since 1.0
 */

if ( ! function_exists( 'rivendellweb_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function rivendellweb_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'Posted by: %s', 'post author', 'rivendellweb' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'rivendellweb_posted_on' ) ) :
	/**
	 * Prints posted_on data
	 */
	function rivendellweb_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'rivendellweb' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

// if ( ! function_exists( 'rivendellweb_last_update' ) ) :
// Outputs last update date
// function rivendellweb_last_update() {
// $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
// if ( get_the_time( 'U' ) <= get_the_modified_time( 'U' ) ) {
// $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
// }

// $time_string = sprintf( $time_string,
// esc_attr( get_the_date( DATE_W3C ) ),
// esc_html( get_the_date() ),
// esc_attr( get_the_modified_date( DATE_W3C ) ),
// esc_html( get_the_modified_date() )
// );

// $last_update = sprintf(
// * translators: %s: last update date. */
// esc_html_x( 'Last Updated: %s', 'Update date', 'rivendellweb' ),
// '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
// );

// echo '<span class="last-update">' . $last_update . '</span>'; // WPCS: XSS OK.

// }
// endif;

if ( ! function_exists( 'rivendellweb_show_categories' ) ) :
	/**
	 * Prints a list of categories as long as there is a category other than "uncategorized" attached to the post.
	 *
	 * If the categories don't show, please make sure that the are enabled in the customizer.
	 */
	function rivendellweb_show_categories( $post ) {
		$show_categories = true;
		$categories      = wp_get_post_categories( $post->ID );
		// We don't want to show the categories if there
		// is a single category and it is "uncategorized"
		if ( count( $categories ) == 1 && in_array( 1, $categories ) ) :
			$show_categories = false;
		endif;
		if ( has_category( null, $post->ID ) && $show_categories ) :
			echo __( '<span class="cat-links">' );
			echo __( 'Filed under ', 'rivendellweb' ) . get_the_category_list( ', ' );
			echo __( '</span>' );
		endif;
	}
endif;

if ( ! function_exists( 'rivendellweb_show_tags' ) ) :
	/**
	 * Shows tags if any have been added to the post
	 */
	function rivendellweb_show_tags() {
		// translators: used between list items, there is a space after the comma
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'rivendellweb' ) );
		if ( $tags_list ) {
			// translators: 1: list of tags.
			printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'rivendellweb' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'rivendellweb_featured_image' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * If the post is password protected, is a search page is an attachment or doesn't have a featured image / post thumbnail then bail, nothing to do here
	 */
	function rivendellweb_featured_image() {
		if (
			post_password_required() ||
			is_search() ||
			is_attachment() ||
			! has_post_thumbnail()
		) {
			return;
		}

		// If we're in a single post with a featured image
		// wrap it in an image without link.
		if ( is_single() && has_post_thumbnail() ) { ?>
			<figure class="post-thumbnail full-bleed">
				<?php the_post_thumbnail( 'rivendellweb-full-bleed' ); ?>
			</figure>
			<?php
		} elseif ( ! is_single() ) {
			// If we're in an archive page then
			// wrap it in an image with a link
			?>
			<figure class="post-thumbnail full-bleed">
				<a href="<?php esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php the_post_thumbnail(); ?>
				</a>
			</figure>
			<?php
		}
	}
endif;

if ( ! function_exists( 'rivendellweb_edit_post' ) ) :
	/**
	 * Adds edit post link
	 */
	function rivendellweb_edit_post() {
		edit_post_link(
			sprintf(
				wp_kses(
				// translators: %s: Name of current post.
				// Only visible to screen readers
					__( 'Edit <span class="screen-reader-text">%s</span>', 'rivendellweb' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/*
Entry metadata contains posted_by, posted_on and last_update and conditionally adds show_categories and show_tags
*/
if ( ! function_exists( 'rivendellweb_entry_metadata' ) ) :
	function rivendellweb_entry_metadata( $post ) {
		?>
		<div class="entry-meta">
			<ul class="entry-meta__content">
				<li class="entry-meta__item"><?php rivendellweb_posted_by(); ?></li>
				<li class="entry-meta__item"><?php rivendellweb_posted_on(); ?></li>
				<!-- <li class="entry-meta__item"><?php // rivendellweb_last_update(); ?></li> -->
				<li class="entry-meta__item"><?php rivendellweb_show_categories( $post ); ?></li>
				<li class="entry-meta__item"><?php rivendellweb_show_tags( $post ); ?></li>
			</ul>
		</div><!-- .entry-meta -->
		<?php
	}
endif;

// Right now the footer only has the edit post link.
if ( ! function_exists( 'rivendellweb_entry_footer' ) ) :
	/**
	 * Adds Footer functionality
	 */
	function rivendellweb_entry_footer() {
		// If we're showing a single page only then
		// show the edit post link
		if ( is_single() ) {
			rivendellweb_edit_post();
		}
	}
endif;



