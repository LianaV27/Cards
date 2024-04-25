<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Graceful
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
?>

<main id="primary" class="site-main">
	<div class="not-found">
		<h2><?php esc_html_e( 'Page not found!', 'graceful' ); ?></h2>
		<p>
		<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching?', 'graceful' ); ?>
		<?php get_search_form(); ?>
		</p>
	</div>
</main>

<?php
get_footer();