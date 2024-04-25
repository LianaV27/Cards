<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Graceful
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

	// Left Sidebar
	get_template_part( 'template-parts/sidebars/sidebar', 'left' );
	?>

	<!-- Content Wrapper -->
	<div class="content-wrap">
		<?php
		// Post Content
		get_template_part( 'template-parts/single/post', 'contents' );

		// Post Author
		if ( graceful_options( 'single_post_page_show_author_desc' ) ) {
			get_template_part( 'template-parts/single/post', 'author' );
		}

		// Post Navigation
		if ( graceful_options( 'single_post_page_show_author_nav' ) ) {
			get_template_part( 'template-parts/single/post', 'navigation' );
		}
	
		// Posts Related
		if ( graceful_options( 'single_post_page_related_orderby' ) !== 'none' ) {
			graceful_related_posts( graceful_options( 'single_post_page_related_title' ), graceful_options( 'single_post_page_related_orderby' ) );
		}

		// Post Comments
		if ( graceful_options( 'single_post_page_show_comments_area' ) ) {
			get_template_part( 'template-parts/single/post', 'comments' );
		}
		?>
	</div><!-- .content-wrap -->

	<?php // Right Sidebar
	get_template_part( 'template-parts/sidebars/sidebar', 'right' );
	?>

<?php
get_footer();