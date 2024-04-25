<?php
/**
 * Customizer About Pro Panel
 *
 * @package Graceful
 */

	// Pro Version
	class Graceful_Pro extends WP_Customize_Control {
		public $type = 'pro_options';

		public function render_content() {
			echo '<span>Want more <strong>'. esc_html( $this->label ) .'</strong>?</span>';
				echo '<span class="dashicons dashicons-info"></span>';
				echo '<strong><i> '. esc_html__( 'Check Graceful PRO', 'graceful' ) .'</i><strong>';
		}
	}

	// Pro Version Links
	class Graceful_Pro_Links extends WP_Customize_Control {
		public $type = 'pro_links';

		public function render_content() {
			?>
			<ul>
				<li class="customize-control">
					<h3><?php esc_html_e( 'Pro Version', 'graceful' ); ?></h3>
					<p><strong><?php esc_html_e( 'Upgrade to pro version for more customization options and Premium Support.', 'graceful' ); ?></strong></p>
					<a href="<?php echo esc_url('http://optimathemes.com/themes/graceful-pro?ref=graceful-customizer-buypro'); ?>" target="_blank" class="button button-primary widefat"><?php esc_html_e( 'Check Graceful Pro', 'graceful' ); ?></a>
				</li>
				<li class="customize-control">
					<h3><?php esc_html_e( 'Documentation and Demo', 'graceful' ); ?></h3>
					<a href="<?php echo esc_url('http://optimathemes.com/themes/graceful/docs/?ref=graceful-customizer-docs/'); ?>" target="_blank"><?php esc_html_e( 'Check Documentation', 'graceful' ); ?></a>
				</li>
				<li class="customize-control">
					<a href="<?php echo esc_url('http://optimathemes.com/themes/graceful/demo-content/?ref=graceful-customizer-demo/'); ?>" target="_blank"><?php esc_html_e( 'Check Demo Content', 'graceful' ); ?></a>
				</li>
			</ul>
			<?php
		}
	}

	// Add Colors section
	$wp_customize->add_section( 'graceful_pro' , array(
		'title'		 => esc_html__( 'About Graceful', 'graceful' ),
		'priority'	 => 1,
		'capability' => 'edit_theme_options'
	) );

	// Pro Version
	$wp_customize->add_setting( 'pro_version_', array(
		'sanitize_callback' => 'graceful_sanitize_custom_controller'
	) );
	$wp_customize->add_control( new Graceful_Pro_Links ( $wp_customize,
			'pro_version_', array(
				'section'	=> 'graceful_pro',
				'type'		=> 'pro_links',
				'label' 	=> '',
				'priority'	=> 1
			)
		)
	);