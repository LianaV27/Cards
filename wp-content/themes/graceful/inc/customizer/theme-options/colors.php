<?php
/**
 * Customizer Colors Section
 *
 * @package Graceful
 */

/*
** Colors Option Panel =====
*/
	$wp_customize->add_section( 'graceful_color' , array(
		'title'		 => esc_html__( 'Colors', 'graceful' ),
		'priority'	 => 1,
		'capability' => 'edit_theme_options'
	) );

	// Brand Colors
	$wp_customize->add_setting( 'graceful_options[color_content_accent]', array(
		'default'	 => '#010101',
		'type'		 => 'option',
		'transport'	 => 'postMessage',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graceful_options[color_content_accent]', array(
		'label' 	=> esc_html__( 'Brand Color', 'graceful' ),
		'section' 	=> 'graceful_color',
		'priority'	=> 3
	) ) );


	$wp_customize->get_control( 'header_textcolor' )->section = 'graceful_color';
	$wp_customize->get_control( 'header_textcolor' )->priority = 6;
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	// Header Text Background
	$wp_customize->add_setting( 'graceful_options[color_header_text_bg]', array(
		'default'	 => graceful_options('color_header_text_bg'),
		'type'		 => 'option',
		'transport'	 => 'postMessage',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graceful_options[color_header_text_bg]', array(
		'label' 	=> esc_html__( 'Header Text Background Color', 'graceful' ),
		'section' 	=> 'graceful_color',
		'priority'	=> 9
	) ) );

	// Enable show Header Text Bg Color
	$wp_customize->add_setting( 'graceful_options[color_show_header_text_bg]', array(
		'default'	 => graceful_options('color_show_header_text_bg'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[color_show_header_text_bg]', array(
		'label'		=> esc_html__( 'Show Header Text Background Color', 'graceful' ),
		'section'	=> 'graceful_color',
		'type'		=> 'checkbox',
		'priority'	=> 9
	) );

	// Header Background
	$wp_customize->add_setting( 'graceful_options[color_header_bg]', array(
		'default'	 => graceful_options('color_header_bg'),
		'type'		 => 'option',
		'transport'	 => 'postMessage',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graceful_options[color_header_bg]', array(
		'label' 	=> esc_html__( 'Header Background Color', 'graceful' ),
		'section' 	=> 'graceful_color',
		'priority'	=> 9
	) ) );
	
	
	// Body Background
	$wp_customize->get_control( 'background_color' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_color' )->priority = 12;
	$wp_customize->get_control( 'background_color' )->label = 'Body Background Color';

	$wp_customize->get_control( 'background_attachment' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_attachment' )->priority = 27;

	$wp_customize->get_control( 'background_image' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_image' )->priority = 15;

	$wp_customize->get_control( 'background_size' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_size' )->priority = 23;

	$wp_customize->get_control( 'background_preset' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_preset' )->priority = 18;

	$wp_customize->get_control( 'background_position' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_position' )->priority = 21;

	$wp_customize->get_control( 'background_repeat' )->section = 'graceful_color';
	$wp_customize->get_control( 'background_repeat' )->priority = 25;