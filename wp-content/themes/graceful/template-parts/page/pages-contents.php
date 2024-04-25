<?php
/**
 * Template part for Page Content
 *
 * @package Graceful
 */

?>
<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( have_posts() ) :
		// Loop Start
		while ( have_posts() ) :
			the_post();
			if ( has_post_thumbnail() ) :
		?>
				<div class="site-images">
					<?php the_post_thumbnail( 'graceful-full-thumbnail' ); ?>
				</div>
		<?php
			endif;

			$graceful_title = get_the_title();
			if ( ! empty( $graceful_title ) ) :
		?>
				<header class="post-header">
					<h1 class="page-title"><?php echo esc_html( $graceful_title ); ?></h1>
				</header>
		<?php
			endif;
		?>
			<div class="post-page-content">
				<?php the_content(); ?>

				<?php
				// Site Pagination
				$graceful_defaults = array(
					'before' => '<p class="site-pagination">' . esc_html__( 'Pages:', 'graceful' ),
					'after'  => '</p>',
				);
				wp_link_pages( $graceful_defaults );
				?>
			</div>
		<?php
		endwhile; // Loop End
	endif;
	?>
</article>