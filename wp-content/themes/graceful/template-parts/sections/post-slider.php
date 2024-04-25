<?php
/**
 * Template part for Post Slider
 *
 * @package Graceful
 */

if (graceful_options('basic_slider_width') === 'wrapped') {
    $graceful_slider_width = 'wrapped-content';
} else {
    $graceful_slider_width = '';
}
?>

<div id="graceful-post-slider" class="owl-carousel owl-theme <?php echo esc_attr( $graceful_slider_width ); ?>">
	<?php 

	// Query Args
	$args = array(
		'post_type'             => array( 'post', 'page' ),
		'orderby'               => graceful_options( 'post_slider_orderby' ),
		'order'                 => 'DESC',
		'posts_per_page'        => graceful_options( 'post_slider_amount' ),
		'ignore_sticky_posts'   => 1,
		'meta_query'            => array( 
			array(
				'key'       => '_thumbnail_id',
				'compare'   => 'EXISTS',
			),
		),
	);

	if ( graceful_options( 'post_slider_display' ) === 'category' ) {
		$args['cat'] = graceful_options( 'post_slider_category' );
	} 

	if ( graceful_options( 'post_slider_display' ) === 'metabox' ) {
		$args['meta_query'] = array( 
			'relation'      => 'AND',
			array(
				'key'       => 'show_in_post_slider',
				'value'     => 'yes',
				'compare'   => 'EXISTS',
			),
			array(
				'key'       => '_thumbnail_id',
				'compare'   => 'EXISTS',
			),
		);
	}

	$graceful_slider_query = new WP_Query( $args );

	// Set tabindex for accessibility
	$graceful_counter = 1;

	// Loop Start
	if ( $graceful_slider_query->have_posts() ) :
		while ( $graceful_slider_query->have_posts() ) : $graceful_slider_query->the_post();
			if ( $graceful_counter >= 1 ) {
				$graceful_counter--;
			}
			?>
			<div class="slide-item" style="background-image:url('<?php the_post_thumbnail_url( 'graceful-slider-full-thumbnail' ); ?>')">
				<div class="graceful-wrap-container image-overlay">
					<div class="graceful-wrap-outer">
						<div class="graceful-wrap-inner">
							<div class="graceful-slider-info">
								<h2 class="graceful-slider-title">
									<a href="<?php echo esc_url( get_permalink() ); ?>" tabindex="<?php echo esc_attr( $graceful_counter ); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="graceful-slider-read-more">
									<a href="<?php echo esc_url( get_permalink() ); ?>" tabindex="<?php echo esc_attr( $graceful_counter ); ?>"><?php esc_html_e( 'Read More', 'graceful' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		endwhile; // Loop end
	endif;
	wp_reset_postdata();
	?>
</div>