<?php
/**
 * Template part for Single Post Content
 *
 * @package Graceful
 */

$graceful_category_tag_allowed = array(
    'a' => array(
        'href' => array(),
        'rel' 		=> array()
    ),
    'div' => array(
        'class' => array()
    )
);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
	?>

	<div class="site-images">
		<?php the_post_thumbnail( 'graceful-full-thumbnail' ); ?>
	</div>

	<header class="post-header">
		<div class="post-header-inner">
			<?php
			$graceful_category_list = get_the_category_list('&nbsp;-&nbsp;');

			if (graceful_options('single_post_page_show_categories') && $graceful_category_list) :
			?>
				<div class="post-categories">
					<?php echo wp_kses($graceful_category_list, $graceful_category_tag_allowed); ?>
				</div>
			<?php endif; ?>

			<h1 class="post-title"><?php the_title(); ?></h1>

			<div class="post-meta clear-fix">
				<?php if (graceful_options('single_post_page_show_date')) : ?>
					<span class="post-date"><?php the_time(get_option('date_format')); ?></span>
				<?php endif; ?>

				<strong class="post-title-author">
					<?php if (graceful_options('single_post_page_show_author')) :
						esc_html_e(' - By', 'graceful');
						echo '&nbsp;';
						the_author_posts_link();
					endif; ?>
				</strong>
			</div>
		</div>
	</header>

	<div class="post-page-content">
		<?php
		the_content();
		$graceful_defaults = array(
			'before' => '<p class="site-pagination">' . esc_html__( 'Pages:', 'graceful' ),
			'after' => '</p>'
		);
		wp_link_pages( $graceful_defaults );
		?>
	</div>

	<footer class="post-footer">
		<?php
		$graceful_tag_list = get_the_tag_list( '<div class="post-tags">','','</div>');
		if ( graceful_options( 'single_post_page_show_tags' ) && $graceful_tag_list ) {
			echo wp_kses( $graceful_tag_list, $graceful_category_tag_allowed );
		}
		if ( graceful_options( 'single_post_page_show_comments' ) && comments_open() ) {
			comments_popup_link( esc_html__( 'No Comments', 'graceful' ), esc_html__( '1 Comment', 'graceful' ), '% ' . esc_html__( 'Comments', 'graceful' ), 'post-comments');
		}
		?>
	</footer>

	<?php
		endwhile;
	endif;
	?>
</article>