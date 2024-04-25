<?php
/**
 * Customizer Navigation Panels
 *
 * @package Graceful
 */

	// add Main Navigation section
	$wp_customize->add_section( 'graceful_main_navigation' , array(
		'title'		 => esc_html__( 'Main Navigation', 'graceful' ),
		'priority'	 => 23,
		'capability' => 'edit_theme_options'
	) );

	// Main Navigation
	$wp_customize->add_setting( 'graceful_options[main_navigation_show]', array(
		'default'	 => graceful_options('main_navigation_show'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[main_navigation_show]', array(
		'label'		=> esc_html__( 'Enable Main Navigation', 'graceful' ),
		'section'	=> 'graceful_main_navigation',
		'type'		=> 'checkbox',
		'priority'	=> 1
	) );


	// Align	
	$main_navigation_align = array(
		'left' => esc_html__( 'Left', 'graceful' ),
		'center' => esc_html__( 'Center', 'graceful' ),
		'right' => esc_html__( 'Right', 'graceful' ),
	);

	$wp_customize->add_setting( 'graceful_options[main_navigation_align]', array(
		'default'	 => graceful_options('main_navigation_align'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[main_navigation_align]', array(
		'label'			=> esc_html__( 'Align', 'graceful' ),
		'section'		=> 'graceful_main_navigation',
		'type'			=> 'select',
		'choices' 		=> $main_navigation_align,
		'priority'		=> 7
	) );


	// Show Search Icon
	$wp_customize->add_setting( 'graceful_options[main_navigation_show_search]', array(
		'default'	 => graceful_options('main_navigation_show_search'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[main_navigation_show_search]', array(
		'label'		=> esc_html__( 'Show Search Icon', 'graceful' ),
		'section'	=> 'graceful_main_navigation',
		'type'		=> 'checkbox',
		'priority'	=> 13
	) );


	// Show Sidebar Icon
	$wp_customize->add_setting( 'graceful_options[main_navigation_show_sidebar]', array(
		'default'	 => graceful_options('main_navigation_show_sidebar'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[main_navigation_show_sidebar]', array(
		'label'		=> esc_html__( 'Show Sidebar Slide Menu', 'graceful' ),
		'section'	=> 'graceful_main_navigation',
		'type'		=> 'checkbox',
		'priority'	=> 15
	) );