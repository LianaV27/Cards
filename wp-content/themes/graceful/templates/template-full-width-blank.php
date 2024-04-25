<?php
/**
 * Template Name: Full Width Blank Template
 * Template Post Type: page
 * 
 * The template for displaying Page without any Title, Post Thumbnail, Sidebar or Comments
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
		<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			if ( have_posts() ) :
				// Loop Start
				while ( have_posts() ) :
					the_post();
				?>
					<div class="post-page-content">
						<?php the_content(); ?>
					</div>
				<?php
				endwhile; // Loop End
			endif;
			?>
		</article>
	</div>
	<!-- .content-wrap -->

<?php
get_footer();