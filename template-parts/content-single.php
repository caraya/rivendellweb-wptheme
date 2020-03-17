<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rivendellweb
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			rivendellweb_entry_metadata( $post );
		endif; ?>
	</header><!-- .entry-header -->

	<?php
	// Displays an optional post thumbnail.
	//
	// Wraps the post thumbnail in an anchor element on index views,
	// or a figure element when on single views.
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() && has_post_thumbnail() ) {
	?>

			<figure class="post-thumbnail full-bleed">
				<?php
					the_post_thumbnail( 'rivendellweb-full-bleed' ); ?>
			</figure><!-- .post-thumbnail -->

		<?php } ?> <!-- if is_single -->

	<div class="entry-content">

		<?php the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rivendellweb' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rivendellweb' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php rivendellweb_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
