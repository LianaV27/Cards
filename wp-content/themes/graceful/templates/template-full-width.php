<?php
/**
 * Template Name: Full Width Template
 * Template Post Type: page
 * 
 * The template for displaying Page without any Sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Graceful
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
?>

	<!-- Content Wrapper -->
	<div class="content-wrap">
		<?php
		// Page Content
		get_template_part( 'template-parts/page/pages', 'contents' );

		// Page Comments
		get_template_part( 'template-parts/single/post', 'comments' );
		?>
	</div>
	<!-- .content-wrap -->

<?php
get_footer();