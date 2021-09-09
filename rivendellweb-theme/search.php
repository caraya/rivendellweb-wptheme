<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package rivendellweb
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'rivendellweb' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_pagination(
				array(
					'show_all'           => false,
					'prev_text'          => rivendellweb_get_svg( array( 'icon' => 'arrow-left' ) ) . __( 'Newer', 'rivendellweb' ),
					'next_text'          => __( 'Older', 'rivendellweb' ) . rivendellweb_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="screen-reader-text">' . __( 'Page ', 'rivendellweb' ) . '</span>',
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<div class="search-logo">
	<a href="https://www.algolia.com/"><img src="https://res.cloudinary.com/dfh6ihzvj/image/upload/v1629179214/logo-algolia-nebula-blue-full_qmsx3e.svg" alt="Search powered by Algolia"></a>
</div>
<?php
get_sidebar();
get_footer();
