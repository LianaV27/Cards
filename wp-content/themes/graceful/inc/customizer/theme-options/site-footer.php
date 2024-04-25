<?php
/**
 * Customizer Site Footer Section
 *
 * @package Graceful
 */


/*
** Site Footer =====
*/

	// add site footer section
	$wp_customize->add_section( 'graceful_page_footer' , array(
		'title'		 => esc_html__( 'Site Footer', 'graceful' ),
		'priority'	 => 35,
		'capability' => 'edit_theme_options'
	) );

	$copyright_desc = 'Enter <strong>$year</strong> to show the current year and <strong>$copy</strong> to show copyright symbol.<br><br>Example: $copy $year Graceful Theme';

	// Copyright
	$wp_customize->add_setting( 'graceful_options[page_footer_copyright]', array(
		'default'	 => graceful_options('page_footer_copyright'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_textareas'
	) );
	$wp_customize->add_control( 'graceful_options[page_footer_copyright]', array(
		'label'			=> esc_html__( 'Copyright', 'graceful' ),
		'description'	=> wp_kses_post($copyright_desc),
		'section'		=> 'graceful_page_footer',
		'type'			=> 'textarea',
		'priority'		=> 3
	) );


	// Pro Version
	$wp_customize->add_setting( 'pro_version_page_footer', array(
		'sanitize_callback' => 'graceful_sanitize_custom_controller'
	) );
	$wp_customize->add_control( new Graceful_Pro ( $wp_customize,
			'pro_version_page_footer', array(
				'section'	  => 'graceful_page_footer',
				'type'		  => 'pro_options',
				'label' 	  => esc_html__( 'Options', 'graceful' ),
				'priority'	  => 100
			)
		)
	);