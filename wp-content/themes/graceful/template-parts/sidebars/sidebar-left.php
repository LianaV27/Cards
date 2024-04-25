<?php
/**
 * Template part for Left Sidebar
 *
 * @package Graceful
 */

if ( !graceful_options( 'basic_show_left_sidebar' ) ) {
	return;
}

if ( class_exists( 'WooCommerce' ) ) {
	if ( is_cart() || is_checkout() || is_account_page() ) 
		return;
}

?>

<div class="sidebar-left-wrap">
	<aside class="sidebar-left">
	    <?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
	        <?php dynamic_sidebar( 'sidebar-left' ); ?>
	    <?php else : ?>
	        <div class="sidebar-no-widgets">
	        	<?php esc_html_e( 'Add Widgets in Left Sidebar', 'graceful' ); ?>
	        </div>
	    <?php endif; ?>
	</aside>
</div>