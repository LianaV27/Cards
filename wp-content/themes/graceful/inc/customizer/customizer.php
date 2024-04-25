<?php
/**
 * Graceful Theme Customizer
 *
 * @package Graceful
 */

/*
** Register Theme Customizer
*/
function graceful_customize_register( $wp_customize ) {

	// Customizer Sanitization Functions
	require get_template_directory().'/inc/customizer/customizer-sanitization.php';

	// Theme Customizer Sections
	require get_template_directory().'/inc/customizer/theme-options/about.php';
	require get_template_directory().'/inc/customizer/theme-options/colors.php';
	require get_template_directory().'/inc/customizer/theme-options/basic-layouts.php';
	require get_template_directory().'/inc/customizer/theme-options/site-identity.php';
	require get_template_directory().'/inc/customizer/theme-options/navigation.php';
	require get_template_directory().'/inc/customizer/theme-options/post-slider.php';
	require get_template_directory().'/inc/customizer/theme-options/blogs-page.php';
	require get_template_directory().'/inc/customizer/theme-options/single-page.php';
	require get_template_directory().'/inc/customizer/theme-options/social-media.php';
	require get_template_directory().'/inc/customizer/theme-options/site-footer.php';
	require get_template_directory().'/inc/customizer/theme-options/loading-animation.php';
	
}
add_action( 'customize_register', 'graceful_customize_register' );


/*
** To preview changes instantly bind the js handlers
*/
function graceful_customize_preview_js() {
	wp_enqueue_script( 'graceful-customizer-previews', get_theme_file_uri( '/inc/customizer/customizer-ui/js/customizer-previews.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'graceful_customize_preview_js' );

/*
** Load logic dynamically for the customizers controls section.
*/
function graceful_panels_js() {
	wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/font-awesome.css' ) );
	wp_enqueue_style( 'graceful-customize-style', get_theme_file_uri( '/inc/customizer/customizer-ui/css/custom-ui.css' ) );
	wp_enqueue_script( 'graceful-customizer-controls', get_theme_file_uri( '/inc/customizer/customizer-ui/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'graceful_panels_js' );

// Load default values for customizer
require get_template_directory().'/inc/customizer/customizer-default.php';