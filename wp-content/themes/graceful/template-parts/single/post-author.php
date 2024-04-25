<?php
/**
 * Template part for Post Author Box below Single Post content
 *
 * @package Graceful
 */

$graceful_author_description = get_the_author_meta( 'description' );

if ( ! empty( $graceful_author_description ) ) : ?>

<div class="author-info">  
	<a class="author-avatar" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
	</a>

	<h4><?php the_author_posts_link(); ?></h4>
	
	<p><?php the_author_meta( 'description' ); ?></p>
</div>

<?php endif; ?>