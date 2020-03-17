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
		the_content();

		?>
		<!-- Hide this if using the_content -->
		<!-- <div class="continue-reading">
		<?php
		// $read_more_link = sprintf( __( 'Continue reading %s', 'rivendellweb' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' );
		?>
			<a href="<?php // echo esc_url( get_permalink() ) ?>" rel="bookmark">
				<?php //echo $read_more_link ?>
			</a>
		<div> -->
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
