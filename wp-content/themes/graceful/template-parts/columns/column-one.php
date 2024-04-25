<?php
/**
 * Template part for displaying Posts in One Column
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Graceful
 */

$graceful_category_tags_allowed = array(
    'a' => array(
        'href' => array(),
        'rel' 		=> array()
    ),
    'div' => array(
        'class' => array()
    )
);
?>
<div class="content-wrap">
	<?php if ( is_search() ) : ?>
	<h1>
		<?php
		printf(
			/* translators: %s: search query */
			esc_html__( 'Search Results for: %s', 'graceful' ),
			'<span>' . esc_html( get_search_query() ) . '</span>'
		);
		?>
	</h1>
	<?php endif; ?>
	<ul class="content-column">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<li>
				<article id="post-<?php the_ID(); ?>" <?php post_class('content-post'); ?>>
					<div class="site-images">
						<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php echo esc_url( get_permalink() ); ?>">
							<?php the_post_thumbnail('graceful-full-thumbnail'); ?>
						</a>
						<?php } ?>
					</div>

					<header class="post-header">
						<div class="post-header-inner">
							<?php
							$graceful_category_list = get_the_category_list( '&nbsp;-&nbsp;' );

							if ( graceful_options( 'post_page_show_categories' ) && $graceful_category_list ) :
								?>
								<div class="post-categories">
									<?php echo wp_kses( $graceful_category_list, $graceful_category_tags_allowed ); ?>
								</div>
							<?php endif; ?>

							<h2 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="post-meta clear-fix">
								<?php if ( graceful_options( 'post_page_show_date' ) ) : ?>
									<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
								<?php endif; ?>

								<strong class="post-title-author">
									<?php if ( graceful_options( 'post_page_show_author' ) ) :
										esc_html_e( ' - By', 'graceful' );
										echo '&nbsp;';
										the_author_posts_link();
									endif; ?>
								</strong>
							</div>
						</div>
					</header>

					<?php if ( graceful_options( 'post_page_post_description' ) !== 'none' ) : ?>
						<div class="post-page-content">
							<?php
							if ( graceful_options( 'post_page_post_description' ) === 'content' ) {
								the_content('');
							} elseif ( graceful_options( 'post_page_post_description' ) === 'excerpt' ) {
								$excerpt_length = substr( graceful_page_layout(), 0, 4 ) === 'col1' ?
									graceful_options( 'post_page_excerpt_length' ) :
									graceful_options( 'post_page_grid_excerpt_length' );
									echo esc_html( graceful_excerpt( $excerpt_length ) );
							}
							?>
						</div>
					<?php endif; ?>

					<footer class="post-footer">
					<?php if ( graceful_options( 'post_page_show_more' ) ) : ?>
						<div class="continue-read">
							<a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Continue Reading', 'graceful' ); ?></a>
						</div>
					<?php endif; ?>
					</footer>

					<?php
					if ( substr( graceful_page_layout(), 0, 4 ) === 'col1' && graceful_options( 'post_page_related_orderby' ) !== 'none' ) :
						// Display related posts in column 1 layout
						graceful_related_posts( graceful_options( 'post_page_related_title' ), graceful_options( 'post_page_related_orderby' ) );
					endif;
					?>

				</article>
			</li>

		<?php endwhile; else: ?>
			<div class="no-result-found">
				<h3><?php esc_html_e( 'Nothing Found!', 'graceful' ); ?></h3>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'graceful' ); ?></p>
				<div class="graceful-widget widget_search">
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; //have_posts ?>
	</ul>
	<?php get_template_part( 'template-parts/sections/site', 'pagination' ); ?>
</div><!-- content-wrap -->