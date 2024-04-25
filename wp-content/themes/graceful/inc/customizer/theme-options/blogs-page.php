<?php
/**
 * Customizer Blogs Page Section
 *
 * @package Graceful
 */

/*
** Blogs Page =====
*/

	$wp_customize->add_section( 'graceful_post_page' , array(
		'title'		 => esc_html__( 'Blog List Page', 'graceful' ),
		'priority'	 => 29,
		'capability' => 'edit_theme_options'
	) );

	$post_description = array(
		'none' 		=> esc_html__( 'None', 'graceful' ),
		'excerpt' 	=> esc_html__( 'Post Excerpt', 'graceful' ),
		'content' 	=> esc_html__( 'Post Content', 'graceful' ),
	);

	// Post Description
	$wp_customize->add_setting( 'graceful_options[post_page_post_description]', array(
		'default'	 => graceful_options( 'post_page_post_description' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_post_description]', array(
		'label'			=> esc_html__( 'Post Description', 'graceful' ),
		'section'		=> 'graceful_post_page',
		'type'			=> 'select',
		'choices' 		=> $post_description,
		'priority'		=> 3
	) );

	$site_pagination = array(
		'default' 	=> esc_html__( 'Default', 'graceful' ),
		'numeric' 	=> esc_html__( 'Numeric', 'graceful' ),
	);

	// Site Pagination
	$wp_customize->add_setting( 'graceful_options[post_page_site_pagination]', array(
		'default'	 => graceful_options( 'post_page_site_pagination' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_site_pagination]', array(
		'label'			=> esc_html__( 'Site Pagination', 'graceful' ),
		'section'		=> 'graceful_post_page',
		'type'			=> 'select',
		'choices' 		=> $site_pagination,
		'priority'		=> 5
	) );

	// Show Categories
	$wp_customize->add_setting( 'graceful_options[post_page_show_categories]', array(
		'default'	 => graceful_options('post_page_show_categories'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_show_categories]', array(
		'label'		=> esc_html__( 'Show Categories', 'graceful' ),
		'section'	=> 'graceful_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 6
	) );


	// Show Date
	$wp_customize->add_setting( 'graceful_options[post_page_show_date]', array(
		'default'	 => graceful_options('post_page_show_date'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_show_date]', array(
		'label'		=> esc_html__( 'Show Date', 'graceful' ),
		'section'	=> 'graceful_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 7
	) );

	// Show Comments
	$wp_customize->add_setting( 'graceful_options[post_page_show_comments]', array(
		'default'	 => graceful_options('post_page_show_comments'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_show_comments]', array(
		'label'		=> esc_html__( 'Show Comments', 'graceful' ),
		'section'	=> 'graceful_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 9
	) );

	// Show Drop Caps
	$wp_customize->add_setting( 'graceful_options[post_page_show_dropcaps]', array(
		'default'	 => graceful_options('post_page_show_dropcaps'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_show_dropcaps]', array(
		'label'		=> esc_html__( 'Show Drop Caps', 'graceful' ),
		'section'	=> 'graceful_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 11
	) );

	// Show Author
	$wp_customize->add_setting( 'graceful_options[post_page_show_author]', array(
		'default'	 => graceful_options('post_page_show_author'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_show_author]', array(
		'label'		=> esc_html__( 'Show Author', 'graceful' ),
		'section'	=> 'graceful_post_page',
		'type'		=> 'checkbox',
		'priority'	=> 16
	) );

	$related_posts = array(
		'none' 		=> esc_html__( 'None', 'graceful' ),
		'related' 	=> esc_html__( 'Related', 'graceful' )
	);

	// Related Posts Orderby
	$wp_customize->add_setting( 'graceful_options[post_page_related_orderby]', array(
		'default'	 => graceful_options( 'post_page_related_orderby' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[post_page_related_orderby]', array(
		'label'			=> esc_html__( 'Related Posts Display', 'graceful' ),
		'section'		=> 'graceful_post_page',
		'type'			=> 'select',
		'choices' 		=> $related_posts,
		'priority'		=> 33
	) );

	// Pro Version
	$wp_customize->add_setting( 'pro_version_post_page', array(
		'sanitize_callback' => 'graceful_sanitize_custom_controller'
	) );
	$wp_customize->add_control( new Graceful_Pro ( $wp_customize,
			'pro_version_post_page', array(
				'section'	  => 'graceful_post_page',
				'type'		  => 'pro_options',
				'label' 	  => esc_html__( 'Options ', 'graceful' ),
				'priority'	  => 100
			)
		)
	);