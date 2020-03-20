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
	<?php rivendellweb_featured_image() ?>
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

	<div class="entry-content">


		<div class="entry-content">
			<?php
		/**
		 * We can change to the_excerpt() to use excerpts instead of
		 * full posts. This will automatically add continue reading
		 * if the post content is more than 200 characters long
		 *
		 * @link https://developer.wordpress.org/reference/functions/the_excerpt/
		 * @link https://developer.wordpress.org/reference/functions/the_content/
		 * @link https://developer.wordpress.org/reference/hooks/excerpt_more/
		 */

			$length_setting = get_theme_mod('length_setting');
			if ( 'excerpt' === $length_setting ) {
				the_excerpt();
			} else {
				the_content();
			}
			?>
		</div><!-- .entry-content -->


	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
