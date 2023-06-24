<?php
/**
 * rivendellweb functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rivendellweb
 */

if ( ! function_exists( 'rivendellweb_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rivendellweb_setup() {
		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on rivendellweb, use a find and replace
		* to change 'rivendellweb' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'rivendellweb', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		/*
		* Adds one or more image sizes for images.
		* Currently we add
		*  full-bleed = 2000px by 1500px
		*  index-img = 1000xp by 550px
		*
		* @link https://developer.wordpress.org/reference/functions/add_image_size/
		*/
		add_image_size( 'rivendellweb-full-bleed', 2000, 1500, true );
		add_image_size( 'rivendellweb-index-img', 1000, 550, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'header' => esc_html__( 'Header', 'rivendellweb' ),
				'social' => esc_html__( 'Social', 'rivendellweb' ),
			)
		);

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rivendellweb_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		/**
		 * Add theme support for selective refresh for widgets.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add theme support foor starter content
		 *
		 * @link
		 * @link https://github.com/xwp/wordpress-develop/blob/master/src/wp-content/themes/rivendellweb/functions.php#L117
		 */
		add_theme_support(
			'starter-content',
			array(
				'widgets' => array(
					'footer-1' => array( 'search', 'archive' ),
					'footer-2' => array( 'latest posts' ),
				),
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// GUTENBERG-RELATED THEME SUPPORT COMMANDS
		/**
		 * Add support for editor styles and enqueue the styles
		 */
		add_theme_support( 'editor-styles' );
		add_editor_style( '/editor-styles.css' );

		/**
		* Disable custom colors in Gutenberg
		* Uncomment the block to enable
		*/
		add_theme_support( 'disable-custom-colors' );

		/**
		* Disable the Gutenberg color palette
		* Uncomment the block to enable
		*/
		add_theme_support( 'editor-color-palette' );

		// /**
		//  * Add support for default block styles
		//  */
		// add_theme_support( 'wp-block-styles' );
		// /**
		//  * Add custom font sizes for Gutenberg
		//  */
		// add_theme_support(
		// 	'editor-font-sizes',
		// 	array(
		// 		array(
		// 			'name' => __( 'Small', 'rivendellweb-blocks' ),
		// 			'size' => 12,
		// 			'slug' => 'small',
		// 		),
		// 		array(
		// 			'name' => __( 'Regular', 'rivendellweb-blocks' ),
		// 			'size' => 16,
		// 			'slug' => 'regular',
		// 		),
		// 		array(
		// 			'name' => __( 'Large', 'rivendellweb-blocks' ),
		// 			'size' => 32,
		// 			'slug' => 'large',
		// 		),
		// 		array(
		// 			'name' => __( 'XLarge', 'rivendellweb-blocks' ),
		// 			'size' => 48,
		// 			'slug' => 'xlarge',
		// 		),
		// 	)
		// );

		// add_theme_support(
		// 	'editor-color-palette',
		// 	array(
		// 		array(
		// 			'name'  => __( 'White', 'rivendellweb' ),
		// 			'slug'  => 'white',
		// 			'color' => '#ffffff',
		// 		),
		// 		array(
		// 			'name'  => __( 'Black', 'rivendellweb' ),
		// 			'slut'  => 'black',
		// 			'color' => '#000000',
		// 		),
		// 		array(
		// 			'name'  => __( 'Magenta', 'rivendellweb' ),
		// 			'slug'  => 'magenta',
		// 			'color' => '#a156b4',
		// 		),
		// 		array(
		// 			'name'  => __( 'Light Magenta', 'rivendellweb' ),
		// 			'slug'  => 'light-magenta',
		// 			'color' => '#d0a5db',
		// 		),
		// 		array(
		// 			'name'  => __( 'Light gray', 'rivendellweb' ),
		// 			'slug'  => 'light-gray',
		// 			'color' => '#eee',
		// 		),
		// 		array(
		// 			'name'  => __( 'Dark Gray', 'rivendellweb' ),
		// 			'slug'  => 'dark-gray',
		// 			'color' => '#444',
		// 		),
		// 		array(
		// 			'name'  => __( 'Red', 'rivendellweb' ),
		// 			'slug'  => 'red',
		// 			'color' => '#f00',
		// 		),
		// 		array(
		// 			'name'  => __( 'Green', 'rivendellweb' ),
		// 			'slug'  => 'green',
		// 			'color' => '#0f0',
		// 		),
		// 		array(
		// 			'name'  => __( 'Blue', 'rivendellweb' ),
		// 			'slug'  => 'blue',
		// 			'color' => '#00f',
		// 		),
		// 	)
		// );
	}
endif;
add_action( 'after_setup_theme', 'rivendellweb_setup' );

/**
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */
function smartwp_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );
 wp_dequeue_style( 'wp-block-library-theme' );
 wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rivendellweb_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'rivendellweb_content_width', 960 );
}
add_action( 'after_setup_theme', 'rivendellweb_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @link https://kinsta.com/blog/wordpress-register-sidebar/
 */
function rivendellweb_widgets_init() {
	$my_sidebars = array(
		array(
			'name'        => 'Header Widget Area',
			'id'          => 'header-widget-area',
			'description' => 'Widgets shown in the header',
		),
		array(
			'name'        => 'Sidebar 1 widgets',
			'id'          => 'sidebar-1',
			'description' => 'Widgets shown in the sidebar',
		),
		array(
			'name'        => 'Sidebar 2 widgets',
			'id'          => 'sidebar-2',
			'description' => 'Widgets shown in the sidebar',
		),
		array(
			'name'        => 'Footer Widget Area 1',
			'id'          => 'footer-1',
			'description' => 'Widgets shown in the first footer area',
		),
		array(
			'name'        => 'Footer Widget Area 2',
			'id'          => 'footer-2',
			'description' => 'Widgets shown in the second footer area',
		),
	);

	$defaults = array(
		'name'          => 'Awesome Sidebar',
		'id'            => 'awesome-sidebar',
		'description'   => 'Widget collections appear in different places',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	);

	foreach ( $my_sidebars as $sidebar ) {
		$args = wp_parse_args( $sidebar, $defaults );
		register_sidebar( $args );
	}
}
add_action( 'widgets_init', 'rivendellweb_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * FontFaceObserver also enqueues an inline style to prevent
 * FontFaceObserver not defined  errors
 *
 * @link https://developer.wordpress.org/reference/functions/wp_add_inline_script/
 * @link https://make.wordpress.org/core/2016/03/08/enhanced-script-loader-in-wordpress-4-5/
 */
function rivendellweb_scripts() {
	wp_enqueue_style( 'rivendellweb-style', get_stylesheet_uri() );

	wp_enqueue_script( 'rivendellweb-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );

	wp_localize_script(
		'rivendellweb-navigation',
		'rivendellwebScreenReaderText',
		array(
			'expand'   => __( 'Expand child menu', 'rivendellweb' ),
			'collapse' => __( 'Collapse child menu', 'rivendellweb' ),
		)
	);

	wp_enqueue_script( 'rivendellweb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Script and styles for Prism since no plugin seems to work
	wp_enqueue_script(
		'prism_script',
		get_stylesheet_directory_uri() . '/js/prism.js',
		array(),
		'20151215',
		true
	);
	wp_enqueue_style(
		'prism_styles',
		get_stylesheet_directory_uri() . '/css/prism.css'
	);
	wp_enqueue_script( 'rivendellweb-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20200317', false );

	// Enqueues both ffo and the inline script needed to run it.
	// Not 100% sure this is working.
	wp_enqueue_script(
		'ffo_script',
		get_stylesheet_directory_uri() . '/js/fontfaceobserver.js',
		array(),
		'20151215',
		false
	);
	wp_add_inline_script(
		'ffo_script',
		'const recursive = new FontFaceObserver("Recursive VF"); let html = document.documentElement;
    Promise.all([recursive.load(),]).then(() => {
      sessionStorage.fontsLoaded = true;console.log("Recursive has loaded.");
    }).catch((err) => {sessionStorage.fontsLoaded = false; console.log("Recursive failed to load", err);
    });

    // Add a class based on whether the font loaded successfully
    if (sessionStorage.fontsLoaded) {html.classList.add("fonts-loaded");} else { html.classList.add("fonts-failed");}'
	);
}
add_action( 'wp_enqueue_scripts', 'rivendellweb_scripts' );

/**
 * Adds defer attribute to scripts in $scripts_to_include
 *
 * We can either create a similar function to add async. Test your
 * code thoroughly when using async or defer.
 *
 * @link https://developer.wordpress.org/reference/hooks/script_loader_tag/
 */
function rivendellweb_js_defer_attr( $tag ) {
	// List scripts to work with
	$scripts_to_include = array( 'prism.js' );

	foreach ( $scripts_to_include as $include_script ) {
		if ( true == strpos( $tag, $include_script ) ) {
			// replace src with defer src
			return str_replace( ' src', ' defer src', $tag );
		}
	}

	// Return original tag for all scripts not included
	return $tag;

}
add_filter( 'script_loader_tag', 'rivendellweb_js_defer_attr', 10 );


/**
 * Sets the length of the excerpt in archives and indexes.
 *
 * Note that there is no formatting applied to the
 * excertpt like there is with the content.
 * So all the prism highlighted code will be presented
 * as is (butt ugly).
 *
 * Consider this when deciding if you want to use excerpt or content
 *
 * We set the priority (second parameter) to 999 to make
 * sure that it runs last
 */
function rivendellweb_custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'rivendellweb_custom_excerpt_length', 999 );

/**
 * Changes the pointer to read more from an Ellipsis to a
 * link that also helps screen readers by pointing what
 * post the read more link is for.
 *
 * @link https://developer.wordpress.org/reference/hooks/excerpt_more/
 */
function rivendellweb_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'rivendellweb_excerpt_more' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function rivendellweb_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 900 <= $width ) {
		$sizes = '(min-width: 900px) 700px, 900px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ||
		is_active_sidebar( 'sidebar-2' ) ) {
		$sizes = '(min-width: 900px) 600px, 900px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'rivendellweb_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function rivendellweb_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100%', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'rivendellweb_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string   A source size value for use in a post thumbnail 'sizes' attribute.
 */
function rivendellweb_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( ! is_singular() ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 900px) 90vw, 800px';
		} else {
			$attr['sizes'] = '(max-width: 1000px) 90vw, 1000px';
		}
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'rivendellweb_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Filters the image HTML markup to send to the editor when inserting an image.
 * It adds native lazy loading for new images.
 *
 * It also disables native loading in core.
 *
 * @link https://wpseek.com/hook/wp_lazy_loading_enabled/
 * @link https://developer.wordpress.org/reference/hooks/image_send_to_editor/
 */
function html5_insert_image( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	$src    = wp_get_attachment_image_src( $id, $size, false );
	$html   = get_image_tag( $id, '', $title, $align, $size );
	$html5  = '<figure>';
	$html5 .= "  <img src='$url' alt='$alt' class='size-$size' loading='lazy' />";
	if ( $caption ) {
		$html5 .= "  <figcaption class='wp-caption-text'>$caption</figcaption>";
	}
	$html5 .= '</figure>';
	return $html5;
}
add_filter( 'wp_lazy_loading_enabled', '__return_true' );
add_filter( 'image_send_to_editor', 'html5_insert_image', 10, 9 );

/**
 * Removed JQuery-related functions as this is not the way
 * WordPress is supporting the migration
 *
 * @link https://wordpress.org/plugins/enable-jquery-migrate-helper/
 */

/**
 * Removes CSS for admin toolbar from the front end
 */
function rivendellweb_hide_admin_bar_from_front_end() {
	if ( is_blog_admin() ) {
		return true;
	}
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
	return false;
}
add_filter( 'show_admin_bar', 'rivendellweb_hide_admin_bar_from_front_end' );

/**
 * Shares category taxonomy with posts
 *
 * @return void
 */
function rivendellweb_add_category_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}

add_action( 'init', 'rivendellweb_add_category_to_pages' );

/**
 * Adds previous and next link to REST posts endpoint
 */
function rivendellweb_add_navlinks_to_post_rest( $response, $post, $request ) {
	global $post;
	// Get the next post.
	$next = get_adjacent_post( false, '', false );
	// Get the previous post.
	$previous = get_adjacent_post( false, '', true );
	// Format them and only send the data we need
	// or null, if there is no next/previous post
	$response->data['next']     = ( ( is_a( $next, 'WP_Post' ) ) && ( ! empty( $next ) ) ) ? array(
		'title' => get_the_title( $next->ID ),
		'link'  => get_the_permalink( $next->ID ),
	) : array(
		'title' => '',
		'link'  => '',
	);
	$response->data['previous'] = ( ( is_a( $previous, 'WP_Post' ) ) && ( ! empty( $previous ) ) ) ? array(
		'title' => get_the_title( $previous->ID ),
		'link'  => get_the_permalink( $previous->ID ),
	) : array(
		'title' => '',
		'link'  => '',
	);

	return $response;
}

add_filter( 'rest_prepare_post', 'rivendellweb_add_navlinks_to_post_rest', 10, 3 );

/*
  * Removes has-sidebar class from body
*/
function rivendellweb_remove_body_class( $classes ) {  
  $remove_classes = ['has-sidebar'];
  $classes = array_diff($classes, $remove_classes);
   
  return $classes;    
}
add_filter( 'body_class', 'rivendellweb_remove_body_class' );

/*
  * Adds no-sidebar class to body
*/
function rivendellweb_add_body_classes( $classes ) {
    $classes[] = 'no-sidebar';
    return $classes;
}
add_filter( 'body_class','rivendellweb_add_body_classes' );

