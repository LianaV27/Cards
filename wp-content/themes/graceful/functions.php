<?php
/**
 * Graceful functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Graceful
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function graceful_setup() {

	// Lets WordPress manage the documents title for us
	add_theme_support( 'title-tag' );

	// Adding default post and comment RSS feeds links to head
	add_theme_support( 'automatic-feed-links' );

	// Making the theme available for translations
	load_theme_textdomain( 'graceful', get_template_directory() . '/languages' );

	// Set up the WordPress core custom header feature.
	add_theme_support(
		'custom-header',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1300,
				'height'             => 500,
				'flex-width'        => true,
				'flex-height'        => true,
			)
	);

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'       => 450,
			'height'      => 200,
			'flex-width'  => true,
			'flex-height' => false,
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
			array(
				'default-color' => '',
				'default-image' => '',
			)
	);

	// Theme uses wp_nav_menu() at two locations
	register_nav_menus(
		array(
			'main' 	=> esc_html__( 'Main Menu', 'graceful' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Theme Activation Notice
	global $pagenow;
	
	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'graceful_activation_notice' );
	}

	// Enables support for post-thumbnails on post and pages
	add_theme_support( 'post-thumbnails' );

	// Add Image Sizes
	graceful_add_image_sizes();

	// Disable block editor in widgets WP 5.8+
	remove_theme_support( 'widgets-block-editor' );

	// Add support for Editor Styles.
	add_theme_support( 'editor-styles' );

	 // Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
  	add_theme_support( 'responsive-embeds' );

  	// Add support for default Gutenberg block styles
  	add_theme_support( 'wp-block-styles' );

  	// WooCommerce theme support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'graceful_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function graceful_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'graceful_content_width', 960 );
}
add_action( 'after_setup_theme', 'graceful_content_width', 0 );


/**
**  Define theme specific image sizes.
*/
function graceful_add_image_sizes() {
	add_image_size( 'graceful-slider-full-thumbnail', 1024, 768, true );
	add_image_size( 'graceful-full-thumbnail', 1140, 0, true );
	add_image_size( 'graceful-column-thumbnail', 500, 330, true );
	add_image_size( 'graceful-small-thumbnail', 75, 75, true );
}


/**
**  Add a pingback url auto-discovery header for single posts, pages, or attachments.
*/
function graceful_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'graceful_pingback_header' );


/*
** Enqueue scripts and styles
*/
function graceful_scripts() {

	// Theme Stylesheet
	wp_enqueue_style( 'graceful-style', get_stylesheet_uri(), array(), _S_VERSION );

	// Theme Dynamic Inline Styles
	wp_add_inline_style( 'graceful-style', graceful_inline_dynamic_styles() );

	// RTL Stylesheet
	wp_style_add_data( 'graceful-style', 'rtl', 'replace' );

	// FontAwesome Icons
	wp_enqueue_style( 'graceful-fontawesome', get_theme_file_uri( '/assets/css/font-awesome.css' ) );

	// Google Fonts
	wp_enqueue_style( 'graceful-google-fonts', get_theme_file_uri( '/assets/css/google-fonts.css' ) );

	// WooCommerce
	wp_enqueue_style( 'graceful-woocommerce', get_theme_file_uri( '/assets/css/woocommerce.css' ) );

	// Enqueue Script
	wp_enqueue_script( 'graceful-main', get_theme_file_uri( '/assets/js/main.js' ), array( 'jquery' ), _S_VERSION, true );
	
}
add_action( 'wp_enqueue_scripts', 'graceful_scripts' );


/*
** Register widgets.
*/
function graceful_widgets_init() {
	
	register_sidebar( 
		array(
			'name'          => __( 'Sidebar Right', 'graceful' ),
			'id'            => 'sidebar-right',
			'description'   => __( 'Add widgets here, for right sidebar.', 'graceful' ),
			'before_widget' => '<section id="%1$s" class="graceful-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( 
		array(
			'name'          => __( 'Sidebar Left', 'graceful' ),
			'id'            => 'sidebar-left',
			'description'   => __( 'Add widgets here, for left sidebar.', 'graceful' ),
			'before_widget' => '<section id="%1$s" class="graceful-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( 
		array(
			'name'          => __( 'Sidebar Slide Menu', 'graceful' ),
			'id'            => 'sidebar-slide-menu',
			'description'   => __( 'Add widgets here, for slide menu sidebar.', 'graceful' ),
			'before_widget' => '<section id="%1$s" class="graceful-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( 
		array(
			'name'          => __( 'Footer Widgets', 'graceful' ),
			'id'            => 'footer-widgets',
			'description'   => __( 'Add widgets here, for the footer.', 'graceful' ),
			'before_widget' => '<section id="%1$s" class="graceful-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'graceful_widgets_init' );


/**
 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}


/*
**  Remove display_header_text setting in customizer
*/
function de_register( $wp_customize ) {
    $wp_customize->remove_control( 'display_header_text' );
}
add_action( 'customize_register', 'de_register', 11 );


/**
 * Template Functions
 */
require get_template_directory() . '/inc/template-functions.php';

/*
** Themes Customizer Options
*/
require get_template_directory() . '/inc/customizer/customizer.php';

/*
** Customizer Controlled Dynamic Inline Styles
*/
require get_template_directory() . '/inc/dynamic-styles.php';

/*
** About Graceful Theme Dashboard
*/
require get_template_directory() . '/inc/admin/about-theme.php';

/*
**  Extend Recent Posts Widget to show post thumbnails
*/
require get_template_directory() . '/inc/widgets/recent-posts.php';

/**
 * TGMPA
 */
require get_template_directory() . '/inc/tgmpa-recommended-plugins.php';