<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		// Page Content
		get_template_part( 'template-parts/page/pages', 'contents' );

		// Page Comments
		get_template_part( 'template-parts/single/post', 'comments' );
		?>
	</div>
	<!-- .content-wrap -->

	<?php
	// Right Sidebar
	get_template_part( 'template-parts/sidebars/sidebar', 'right' ); 
	?>

<?php
get_footer();