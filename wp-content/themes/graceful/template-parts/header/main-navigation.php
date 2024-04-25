<?php
/**
 * Template part for Main Navigation and Search
 *
 * @package Graceful
 */


if ( graceful_options( 'main_navigation_show' ) ) : ?>
<div id="main-navigation" class="clear-fix" data-fixed="<?php echo esc_attr( graceful_options( 'main_navigation_fixed' ) ); ?>">
	<div <?php echo esc_attr( graceful_options( 'basic_header_width' ) ) === 'contained' ? 'class="wrapped-content"': ''; ?>>
		<div class="navigation-search-overlay">
		</div>
		
		<?php 
		// Left Sidebar Slide Menu
		if ( graceful_options( 'main_navigation_show_sidebar' ) ) : ?>
		<button class="left-menu-toggle-btn">
			<div class="left-menu-icon">
				<span class="icon-line-top"></span>
				<span class="icon-line-mid"></span>
				<span class="icon-line-bot"></span>
			</div>
		</button>
		<?php endif; ?>

		<!-- Menu -->
		<button class="responsive-menu-btn">
			<i class="fa fa-chevron-down"></i>
			<i class="fa fa-times" style="display: none;"></i>
		</button>

		<?php // Navigation Menus
		wp_nav_menu( array(
			'theme_location' 	=> 'main',
			'menu_id'        	=> 'site-menu',
			'menu_class' 		=> '',
			'container' 	 	=> 'nav',
			'container_class'	=> 'site-menu-wrapper',
			'fallback_cb' 		=> 'graceful_site_menu_fallback'
		) );

		wp_nav_menu( array(
			'theme_location' 	=> 'main',
			'menu_id'        	=> 'responsive-menu',
			'menu_class' 		=> '',
			'container' 	 	=> 'nav',
			'container_class'	=> 'responsive-menu-wrapper',
			'fallback_cb' 		=> false
		) );

		?>

		<?php
		// Social Icons in the main navigation
		if ( graceful_options( 'navigation_show_socials' ) ) {	
			graceful_social_media( 'navigation-socials' );
		}

		?>
		
		<!-- Search in main navigation -->		
		<?php if ( graceful_options( 'main_navigation_show_search' ) ) : ?>
		<div class="main-navigation-search">
			<button class="navigation-search-button open-graceful-search">
				<i class="fa fa-search"></i>
				<i class="fa fa-times"></i>
			</button>
			<div class="graceful-search" role="graceful-search" aria-labelledby="graceful-search-title" aria-describedby="graceful-search-description" aria-hidden="true">
				<?php get_search_form(); ?>
				<button type="button" aria-label="Close Navigation" class="close-graceful-search"> <i class="fa fa-times"></i> </button>
			</div>
			<div class="graceful-search-overlay" tabindex="-1" aria-hidden="true"></div>
		</div>
		<?php endif; ?>

	</div>
</div><!-- #main-navigation -->
<?php 
endif;