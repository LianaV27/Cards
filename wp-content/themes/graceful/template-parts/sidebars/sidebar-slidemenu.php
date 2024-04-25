<?php
/**
 * Template part for Sidebar Slide Menu
 *
 * @package Graceful
 */

if ( ! graceful_options( 'main_navigation_show_sidebar' ) ) {
	return;
}

?>
<div class="sidebar-slide-overlay image-overlay"></div>
<div class="header-left-menu-wrapper">
    <div class="header-left-menu">
        <div class="header-left-menu-wrap">
        	<button class="left-menu-close">
            	<i class="fa fa-times" aria-hidden="true"></i>
            </button> 
            <aside>
                <?php if ( is_active_sidebar( 'sidebar-slide-menu' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-slide-menu' ); ?>
                <?php else : ?>
                    <div class="sidebar-no-widgets">
                        <?php esc_html_e( 'Add Widgets to Sidebar Slide Menu section in Widgets', 'graceful' ); ?>
                    </div>
                <?php endif; ?>
			</aside>
			<button class="left-menu-close-bottom">
            	Close
            </button>
        </div>
    </div>
</div>