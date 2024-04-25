<?php
/**
 * The header for our theme
 *
 * This is the template that displays the <head> section, Header and Navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Graceful
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

	<?php
	if ( graceful_options( 'basic_header_width' ) === 'wrapped' ) {
	    $graceful_header_width = 'class=wrapped-content';
	} else {
	    $graceful_header_width = '';
	}
	if ( graceful_options( 'basic_content_width' ) === 'wrapped' ) {
	    $graceful_content_width = 'wrapped-content';
	} else {
	    $graceful_content_width = '';
	}
	?>

	<?php // Site Loading Animation
	get_template_part('template-parts/sections/site', 'loadinganim'); 
	?>

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'graceful' ); ?></a>	

	<div id="site-container">
		<div id="site-header" <?php echo esc_attr( $graceful_header_width ); ?>>
		<?php
		
		get_template_part( 'template-parts/header/site', 'header' );
		get_template_part( 'template-parts/header/main', 'navigation' );
		
		?>
		</div><!-- site-header close -->

		<!-- Page Content -->
		<main id="primary" class="site-main">
		<?php
			if ( is_home() && !is_paged() ) {
			    $graceful_post_slider_enabled = graceful_options('post_slider_label');

			    // Show Post Slider if enabled
			    if ( $graceful_post_slider_enabled ) {
			        get_template_part('template-parts/sections/post', 'slider');
			    }
			}
		?>
		<div class="main-content clear-fix <?php echo esc_attr( $graceful_content_width ); ?>" data-layout="<?php echo esc_attr( graceful_page_layout() ); ?>" data-sidebar-sticky="<?php echo esc_attr( graceful_options( 'basic_sidebar_sticky' ) ); ?>">
