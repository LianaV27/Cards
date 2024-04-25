<?php
/**
 * Template part for Single Post Navigation at the bottom of the post to navigate to Next or Previous posts.
 *
 * @package Graceful
 */

// Get the Adjacent Posts
$graceful_previous_post = get_adjacent_post(false, '', false);
$graceful_next_post = get_adjacent_post(false, '', true);

?>

<!-- Previous -->
<div class="post-navigation-wrap">
<?php if ( ! empty( $graceful_previous_post ) ) : ?>
<a href="<?php echo esc_url( get_permalink($graceful_previous_post->ID) ); ?>" title="<?php echo esc_attr($graceful_previous_post->post_title); ?>" class="post-navigation previous-post">
<i class="fa fa-angle-left"></i>
<?php echo wp_kses_post( get_the_post_thumbnail($graceful_previous_post->ID, 'graceful-small-thumbnail') ); ?>
</a>
<?php endif; ?>

<!-- Next -->
<?php if ( ! empty( $graceful_next_post ) ) : ?>
<a href="<?php echo esc_url( get_permalink($graceful_next_post->ID) ); ?>" title="<?php echo esc_attr($graceful_next_post->post_title); ?>" class="post-navigation next-post">
	<?php echo wp_kses_post( get_the_post_thumbnail($graceful_next_post->ID, 'graceful-small-thumbnail') ); ?>
	<i class="fa fa-angle-right"></i>
</a>
<?php endif; ?>
</div><!-- Post Navigation Wrap -->