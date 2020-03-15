<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package rivendellweb
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// If comments are open or we have at least one comment
			// load the comment template.
			// TODO: 	This definitely needs more testing
			if ( comments_open() || get_comments_number() ) :
				// Change the name inside comments_template
				// to use a custom comment template
				comments_template('/comments.php');
			endif;

			// add post navigation links
			the_post_navigation();
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar( 'sidebar1');
get_footer();
