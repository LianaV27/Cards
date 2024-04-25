<?php
/**
 * Template part for Page Header which displays Logo, Title, Description.
 *
 * @package Graceful
 */

?>
	<div class="entry-header">
		<div class="graceful-wrap-outer">
		<div class="graceful-wrap-inner">
			<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php
				$graceful_custom_logo_id = get_theme_mod( 'custom_logo' );
				$graceful_custom_logo = wp_get_attachment_image_src( $graceful_custom_logo_id, 'full' );
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr( bloginfo( 'name' ) ); ?>" class="logo-img">
					<img src="<?php echo esc_url( $graceful_custom_logo[0] ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>">
				</a>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'title' ); ?></a>
			<?php endif; ?>

			<?php if ( display_header_text() ) : ?>
				<br>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
			</div>
		</div>
		</div>
	</div>