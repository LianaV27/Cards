<?php
/**
 * Template part for Site Pagination for Lists Posts
 *
 * @package Graceful
 */

$graceful_site_pages = $wp_query->max_num_pages;
$graceful_site_paged = get_query_var( 'paged' );
$graceful_new_range = 2;
$graceful_show_items = ( $graceful_new_range * 2 ) + 1;
$graceful_site_pagination = graceful_options( 'post_page_site_pagination' );

if ( empty( $graceful_site_paged ) ) {
	$graceful_site_paged = 1;
}

if ( ! $graceful_site_pages ) {
	$graceful_site_pages = 1;
}

if ( $graceful_site_pages == 1 ) {
	return;
}

// Check WooCommerce
if ( class_exists( 'WooCommerce' ) && is_shop() ) {
	$graceful_site_pagination = 'numeric';
}

?>

<nav class="content-pagination clear-fix <?php echo esc_attr( $graceful_site_pagination ); ?>"
	data-max-pages="<?php echo esc_attr( $wp_query->max_num_pages ); ?>"
	data-loading="<?php echo esc_attr( 'Loading...', 'graceful' ); ?>">

	<?php

	// Numaric Pagination
	if ( $graceful_site_pagination === 'numeric' ) {

		// Previous Page
		if ( $graceful_site_paged > 1 ) {
			?>
			<a href="<?php echo esc_url( get_pagenum_link( $graceful_site_paged - 1 ) ) ?>" class="numeric-prev-page">
				<i class="fa fa-long-arrow-left"></i>
			</a>
			<?php
		}

		// Site Pagination
		for ( $i = 1; $i <= $graceful_site_pages; $i++ ) {
			if ( 1 != $graceful_site_pages && ( !( $i >= $graceful_site_paged + $graceful_new_range + 1 || $i <= $graceful_site_paged - $graceful_new_range - 1 ) || $graceful_site_pages <= $graceful_show_items ) ) {
				if ( $graceful_site_paged == $i ) {
				?>
					<span class="numeric-current-page">
						<?php echo (int)( $i ) ?>
					</span>
				<?php
				} else {
				?>
					<a href="<?php echo esc_url( get_pagenum_link( $i ) ) ?>">
						<?php echo (int)( $i ) ?>
					</a>
				<?php
				}
			}
		}

		// Next Page
		if ( $graceful_site_paged < $graceful_site_pages ) {
			?>
			<a href="<?php echo esc_url( get_pagenum_link( $graceful_site_paged + 1 ) ) ?>" class="numeric-next-page">
				<i class="fa fa-long-arrow-right"></i>
			</a>
			<?php
		}

	// Pagination Default
	} elseif ( $graceful_site_pagination === 'default' ) {

		if ( get_next_posts_link() ) {
		?>
			<div class="previous-page">
				<?php next_posts_link( '<i class="fa fa-long-arrow-left"></i>&nbsp;' . esc_html__( 'Older Posts', 'graceful' ) ); ?>
			</div>
		<?php
		}

		if ( get_previous_posts_link() ) {
		?>
			<div class="next-page">
				<?php previous_posts_link( esc_html__( 'Newer Posts', 'graceful' ) . '&nbsp;<i class="fa fa-long-arrow-right"></i>' ); ?>
			</div>
		<?php
		}

	// Load More
	} else {
		next_posts_link( esc_html__( 'Load More', 'graceful' ) );
	}

	?>

</nav>
