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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'rivendellweb' ),
			'social' => esc_html__( 'Social', 'rivendellweb')
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'rivendellweb_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

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
		add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array( 'search', 'archive'),
			'footer-2' => array( 'latest posts'),
		),
		) );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'rivendellweb_setup' );

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
      'name'          => 'Header Widget Area',
      'id'            => 'header-widget-area',
      'description'   => 'Widgets shown in the header',
		),
		array(
      'name'          => 'Sidebar 1 widgets',
      'id'            => 'sidebar-1',
      'description'   => 'Widgets shown in the sidebar',
		),
		array(
      'name'          => 'Sidebar 2 widgets',
      'id'            => 'sidebar-2',
      'description'   => 'Widgets shown in the sidebar',
		),
    array(
      'name'          => 'Footer Widget Area 1',
      'id'            => 'footer-1',
      'description'   => 'Widgets shown in the first footer area',
    ),
    array(
      'name'          => 'Footer Widget Area 2',
      'id'            => 'footer-2',
      'description'   => 'Widgets shown in the second footer area',
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
    'after_title'   => '</h2>'
  );

  foreach( $my_sidebars as $sidebar ) {
    $args = wp_parse_args( $sidebar, $defaults );
    register_sidebar( $args );
  }
}
add_action( 'widgets_init', 'rivendellweb_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * TODO: Figure out a way to load local versions
 * if we're offline. Look at B5P way to load
 * jQuery for an example. Right now it fails on everything
 * if one script fails to load
 */
function rivendellweb_scripts() {
	wp_enqueue_style( 'rivendellweb-style', get_stylesheet_uri() );

	wp_enqueue_script( 'rivendellweb-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_localize_script( 'rivendellweb-navigation', 'rivendellwebScreenReaderText', array(
		'expand' => __( 'Expand child menu', 'rivendellweb'),
		'collapse' => __( 'Collapse child menu', 'rivendellweb'),
		) );

	wp_enqueue_script( 'rivendellweb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rivendellweb_scripts' );

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
if (file_exists( '/inc/icon-functions.php' )) {
	require get_parent_theme_file_path( '/inc/icon-functions.php' );
}
/**
 * Loads scripts and stylesheets
 *
 */
function rivendellweb_enqueue_local() {
	// Script and styles for Prism since no plugin seems to work
	wp_enqueue_script( 'prism_script',
			get_stylesheet_directory_uri() . '/js/prism.js' );
	wp_enqueue_style( 'prism_styles',
			get_stylesheet_directory_uri() . '/css/prism.css' );
	// Enqueue Fontface Observer
	wp_enqueue_script( 'ffo_script',
			get_stylesheet_directory_uri() . '/js/fontfaceobserver.js');
	// Note: The script that requires Fontface Observer is
	// inlined in the add_action(wp_footer) hook
}
add_action( 'wp_enqueue_scripts', 'rivendellweb_enqueue_local' );

/**
 * Adds defer attribute to scripts in $scripts_to_include
 *
 * We can either create a similar function to add async or
 * we can add both attributes to this function. Test your
 * code thoroughly when using async or defer. I had issues
 * with Fontface Observer loading later than the script it
 * was called from so it'd report an error
 *
 */
function rivendellweb_js_defer_attr($tag){
	// List scripts to work with
	$scripts_to_include = array( 'prism.js');

	foreach($scripts_to_include as $include_script){
			if(true == strpos($tag, $include_script ))
			// Add defer attribute
			return str_replace( ' src', ' defer src', $tag );
	}

	# Return original tag for all scripts not included
	return $tag;

}
add_filter( 'script_loader_tag', 'rivendellweb_js_defer_attr', 10 );

/**
 * Adds the FontFace Observer code to the footer of every page
*/
function rivendell_add_ffo(){
?>
  <script>
    const recursive = new FontFaceObserver('Recursive VF');
    let html = document.documentElement;
    Promise.all([
      recursive.load(),
    ]).then(() => {
			sessionStorage.fontsLoaded = true;
      console.log('Recursive has loaded.');
    }).catch((err) => {
			sessionStorage.fontsLoaded = false;
      console.log('Recursive failed to load', err);
    });

		// Add a class based on whether the font loaded successfully
		if (sessionStorage.fontsLoaded) {
			html.classList.add('fonts-loaded');
		} else {
			html.classList.add('fonts-failed');
		}

  </script>
</script>
<?php
};
add_action('wp_footer', 'rivendell_add_ffo');


