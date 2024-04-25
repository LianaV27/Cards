<?php
/**
 * Customizer Page Loading Animation Section
 *
 * @package Graceful
 */

/*
** Page Loading Animation =====
*/

	// add Loading Animation section
	$wp_customize->add_section( 'graceful_loading' , array(
		'title'		 => esc_html__( 'Page Loading Animation', 'graceful' ),
		'priority'	 => 45,
		'capability' => 'edit_theme_options'
	) );

	// Page Loading Animation
	$wp_customize->add_setting( 'graceful_options[loading_label]', array(
		'default'	 => graceful_options('loading_label'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[loading_label]', array(
		'label'		=> esc_html__( 'Enable Page Loading Animation', 'graceful' ),
		'section'	=> 'graceful_loading',
		'type'		=> 'checkbox',
		'priority'	=> 1
	) );