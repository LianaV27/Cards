<?php
/**
 * Customizer Site Identity Panel
 *
 * @package Graceful
 */

	// Logo Width
	$wp_customize->add_setting( 'graceful_options[title_tagline_logo_wide]', array(
		'default'	 => graceful_options('title_tagline_logo_wide'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_numbers_absint'
	) );
	$wp_customize->add_control( 'graceful_options[title_tagline_logo_wide]', array(
		'label'			=> esc_html__( 'Width', 'graceful' ),
		'section'		=> 'title_tagline',
		'type'			=> 'number',
		'input_attrs' 	=> array( 'step' => '10', 'max' => '500' ),
		'priority'		=> 8
	) );

	$wp_customize->get_control( 'custom_logo' )->transport = 'selective_refresh';