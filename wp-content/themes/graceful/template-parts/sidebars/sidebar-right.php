<?php
/**
 * Template part for Right Sidebar
 *
 * @package Graceful
 */

if ( !graceful_options( 'basic_show_right_sidebar' ) ) {
	return;
}

if ( class_exists( 'WooCommerce' ) ) {
	if ( is_cart() || is_checkout() || is_account_page() ) 
		return;
}

?>

<div class="sidebar-right-wrap">
	<aside class="sidebar-right">
	    <?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
	        <?php dynamic_sidebar( 'sidebar-right' ); ?>
	    <?php else : ?>
	        <div class="sidebar-no-widgets">
	        	<?php esc_html_e( 'Add Widgets in Right Sidebar', 'graceful' ); ?>
        	</div>
	    <?php endif; ?>
	</aside>
</div>