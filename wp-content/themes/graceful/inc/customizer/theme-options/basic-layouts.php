<?php
/**
 * Customizer Basic Layouts Panel
 *
 * @package Graceful
 */

	$boxed_width = array(
		'full' 		=> esc_html__( 'Full', 'graceful' ),
		'contained' => esc_html__( 'Contained', 'graceful' ),
		'wrapped' 	=> esc_html__( 'Boxed', 'graceful' ),
	);

	// Header Width
	$wp_customize->add_setting( 'graceful_options[basic_header_width]', array(
		'default'	 => graceful_options( 'basic_header_width' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[basic_header_width]', array(
		'label'			=> esc_html__( 'Header Width', 'graceful' ),
		'section'		=> 'graceful_basic',
		'type'			=> 'select',
		'choices' 		=> $boxed_width,
		'priority'		=> 25
	) );

	$boxed_width_slider = array(
		'full' => esc_html__( 'Full', 'graceful' ),
		'wrapped' => esc_html__( 'Boxed', 'graceful' ),
	);

	// Slider Width
	$wp_customize->add_setting( 'graceful_options[basic_slider_width]', array(
		'default'	 => graceful_options( 'basic_slider_width' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[basic_slider_width]', array(
		'label'			=> esc_html__( 'Post Slider Width', 'graceful' ),
		'section'		=> 'graceful_basic',
		'type'			=> 'select',
		'choices' 		=> $boxed_width_slider,
		'priority'		=> 27
	) );

	// Content Width
	$wp_customize->add_setting( 'graceful_options[basic_content_width]', array(
		'default'	 => graceful_options( 'basic_content_width' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[basic_content_width]', array(
		'label'			=> esc_html__( 'Content Width', 'graceful' ),
		'section'		=> 'graceful_basic',
		'type'			=> 'select',
		'choices' 		=> $boxed_width_slider,
		'priority'		=> 29
	) );

	// Single Content Width
	$wp_customize->add_setting( 'graceful_options[basic_single_width]', array(
		'default'	 => graceful_options( 'basic_single_width' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[basic_single_width]', array(
		'label'			=> esc_html__( 'Single Content Width', 'graceful' ),
		'section'		=> 'graceful_basic',
		'type'			=> 'select',
		'choices' 		=> $boxed_width_slider,
		'priority'		=> 31
	) );

	// Footer Width
	$wp_customize->add_setting( 'graceful_options[basic_footer_width]', array(
		'default'	 => graceful_options( 'basic_footer_width' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[basic_footer_width]', array(
		'label'			=> esc_html__( 'Footer Width', 'graceful' ),
		'section'		=> 'graceful_basic',
		'type'			=> 'select',
		'choices' 		=> $boxed_width,
		'priority'		=> 33
	) );

	// Add Basic Layouts section
	$wp_customize->add_section( 'graceful_basic' , array(
		'title'		 => esc_html__( 'Basic Layouts', 'graceful' ),
		'priority'	 => 3,
		'capability' => 'edit_theme_options'
	) );

	// Sidebar Width
	$wp_customize->add_setting( 'graceful_options[basic_sidebar_width]', array(
		'default'	 => graceful_options('basic_sidebar_width'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_numbers_absint'
	) );
	$wp_customize->add_control( 'graceful_options[basic_sidebar_width]', array(
		'label'			=> esc_html__( 'Sidebar Width', 'graceful' ),
		'section'		=> 'graceful_basic',
		'type'			=> 'number',
		'input_attrs' 	=> array( 'step' => '1', 'max' => '350', 'min' => '200' ),
		'priority'		=> 35
	) );

	// Sticky Sidebar
	$wp_customize->add_setting( 'graceful_options[basic_sidebar_sticky]', array(
		'default'	 => graceful_options('basic_sidebar_sticky'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[basic_sidebar_sticky]', array(
		'label'		=> esc_html__( 'Enable Sticky Sidebar', 'graceful' ),
		'section'	=> 'graceful_basic',
		'type'		=> 'checkbox',
		'priority'	=> 37
	) );


	// Show Left Sidebar
	$wp_customize->add_setting( 'graceful_options[basic_show_left_sidebar]', array(
		'default'	 => graceful_options('basic_show_left_sidebar'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[basic_show_left_sidebar]', array(
		'label'		=> esc_html__( 'Show Left Sidebar', 'graceful' ),
		'section'	=> 'graceful_basic',
		'type'		=> 'checkbox',
		'priority'	=> 39
	) );


	// Show Right Sidebar
	$wp_customize->add_setting( 'graceful_options[basic_show_right_sidebar]', array(
		'default'	 => graceful_options('basic_show_right_sidebar'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[basic_show_right_sidebar]', array(
		'label'		=> esc_html__( 'Show Right Sidebar', 'graceful' ),
		'section'	=> 'graceful_basic',
		'type'		=> 'checkbox',
		'priority'	=> 41
	) );