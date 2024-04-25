<?php
/**
 * Customizer Single Post Page Section
 *
 * @package Graceful
 */


/*
** Single Post Page =====
*/

	// add Single Post Page section
	$wp_customize->add_section( 'graceful_single_post_page' , array(
		'title'		 => esc_html__( 'Single Post Page', 'graceful' ),
		'priority'	 => 31,
		'capability' => 'edit_theme_options'
	) );

	// Show Categories
	$wp_customize->add_setting( 'graceful_options[single_post_page_show_categories]', array(
		'default'	 => graceful_options('single_post_page_show_categories'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_show_categories]', array(
		'label'		=> esc_html__( 'Show Categories', 'graceful' ),
		'section'	=> 'graceful_single_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 5
	) );

	// Show Date
	$wp_customize->add_setting( 'graceful_options[single_post_page_show_date]', array(
		'default'	 => graceful_options('single_post_page_show_date'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_show_date]', array(
		'label'		=> esc_html__( 'Show Date', 'graceful' ),
		'section'	=> 'graceful_single_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 7
	) );

	// Show Comments
	$wp_customize->add_setting( 'graceful_options[single_post_page_show_comments]', array(
		'default'	 => graceful_options('single_post_page_show_comments'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_show_comments]', array(
		'label'		=> esc_html__( 'Show Comments', 'graceful' ),
		'section'	=> 'graceful_single_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 13
	) );

	// Show Drop Caps
	$wp_customize->add_setting( 'graceful_options[single_post_page_show_dropcaps]', array(
		'default'	 => graceful_options('single_post_page_show_dropcaps'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_show_dropcaps]', array(
		'label'		=> esc_html__( 'Show Drop Caps', 'graceful' ),
		'section'	=> 'graceful_single_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 14
	) );

	// Show Author
	$wp_customize->add_setting( 'graceful_options[single_post_page_show_author]', array(
		'default'	 => graceful_options('single_post_page_show_author'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_show_author]', array(
		'label'		=> esc_html__( 'Show Author', 'graceful' ),
		'section'	=> 'graceful_single_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 15
	) );

	// Show Author Description
	$wp_customize->add_setting( 'graceful_options[single_post_page_show_author_desc]', array(
		'default'	 => graceful_options('single_post_page_show_author_desc'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_show_author_desc]', array(
		'label'		=> esc_html__( 'Show Author Description', 'graceful' ),
		'section'	=> 'graceful_single_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 18
	) );

	// Related Posts Orderby
	$wp_customize->add_setting( 'graceful_options[single_post_page_related_orderby]', array(
		'default'	 => graceful_options( 'single_post_page_related_orderby' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[single_post_page_related_orderby]', array(
		'label'			=> esc_html__( 'Related Posts - Display', 'graceful' ),
		'section'		=> 'graceful_single_post_page',
		'type'			=> 'select',
		'choices' 		=> $related_posts,
		'priority'		=> 23
	) );