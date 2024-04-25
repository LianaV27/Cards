<?php
/**
 * Customizer Social Media Section
 *
 * @package Graceful
 */

/*
** Social Media =====
*/

	// Add social media section
	$wp_customize->add_section( 'graceful_social_media' , array(
		'title'		 => esc_html__( 'Social Media', 'graceful' ),
		'priority'	 => 33,
		'capability' => 'edit_theme_options'
	) );
	
	// Social Window
	$wp_customize->add_setting( 'graceful_options[social_media_window]', array(
		'default'	 => graceful_options('social_media_window'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[social_media_window]', array(
		'label'		=> esc_html__( 'Open Social Pages in New Window', 'graceful' ),
		'section'	=> 'graceful_social_media',
		'type'		=> 'checkbox',
		'priority'	=> 1
	) );

	// Social Icons Array
	$graceful_social_icons = array(
		'twitter' 				=> '&#xf099;',
		'twitter-square' 		=> '&#xf081;',
		'instagram' 			=> '&#xf16d;',
		'facebook' 				=> '&#xf09a;',
		'facebook-official'		=> '&#xf230;',
		'facebook-square' 		=> '&#xf082;',
		'pinterest' 			=> '&#xf0d2;',
		'pinterest-p' 			=> '&#xf231;',
		'pinterest-square'		=> '&#xf0d3;',
		'linkedin'				=> '&#xf0e1;',
		'linkedin-square' 		=> '&#xf08c;',
		'youtube-play' 			=> '&#xf16a;',
		'youtube' 				=> '&#xf167;',
		'youtube-square' 		=> '&#xf166;',
		'envelope' 				=> '&#xf0e0;',
		'envelope-o' 			=> '&#xf003;',
		'envelope-square ' 		=> '&#xf199;',
		'snapchat' 				=> '&#xf2ab;',
		'snapchat-ghost' 		=> '&#xf2ac;',
		'snapchat-square'		=> '&#xf2ad;',
		'behance' 				=> '&#xf1b4;',
		'behance-square'		=> '&#xf1b5;',
		'tumblr' 				=> '&#xf173;',
		'tumblr-square' 		=> '&#xf174;',
		'reddit' 				=> '&#xf1a1;',
		'reddit-alien' 			=> '&#xf281;',
		'reddit-square' 		=> '&#xf1a2;',
		'medium' 				=> '&#xf23a;',
		'dribbble' 				=> '&#xf17d;',
		'etsy' 					=> '&#xf2d7;',
		'skype' 				=> '&#xf17e;',
	);

	// Social Icon 1
	$wp_customize->add_setting( 'graceful_options[social_m_icon_1]', array(
		'default'	 => graceful_options('social_m_icon_1'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_icon_1]', array(
		'label'			=> esc_html__( 'Select Icon', 'graceful' ),
		'section'		=> 'graceful_social_media',
		'type'			=> 'select',
		'choices' 		=> $graceful_social_icons,
		'priority'		=> 3
	) );

	// Social Url 1
	$wp_customize->add_setting( 'graceful_options[social_m_url_1]', array(
		'default'	 => graceful_options('social_m_url_1'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_url_1]', array(
		'label'		=> esc_html__( 'Add Social Link', 'graceful' ),
		'section'	=> 'graceful_social_media',
		'type'		=> 'text',
		'priority'	=> 5,
		'input_attrs' => array(
            'placeholder' => esc_attr__( 'Complete Link', 'graceful' ),
        )
	) );


	// Social Icon 2
	$wp_customize->add_setting( 'graceful_options[social_m_icon_2]', array(
		'default'	 => graceful_options('social_m_icon_2'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_icon_2]', array(
		'label'			=> esc_html__( 'Select Icon', 'graceful' ),
		'section'		=> 'graceful_social_media',
		'type'			=> 'select',
		'choices' 		=> $graceful_social_icons,
		'priority'		=> 7
	) );

	// Social Url 2
	$wp_customize->add_setting( 'graceful_options[social_m_url_2]', array(
		'default'	 => graceful_options('social_m_url_2'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_url_2]', array(
		'label'		=> esc_html__( 'Add Social Link', 'graceful' ),
		'section'	=> 'graceful_social_media',
		'type'		=> 'text',
		'priority'	=> 9,
		'input_attrs' => array(
            'placeholder' => esc_attr__( 'Complete Link', 'graceful' ),
        )
	) );

	// Social Icon 3
	$wp_customize->add_setting( 'graceful_options[social_m_icon_3]', array(
		'default'	 => graceful_options('social_m_icon_3'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_icon_3]', array(
		'label'			=> esc_html__( 'Select Icon', 'graceful' ),
		'section'		=> 'graceful_social_media',
		'type'			=> 'select',
		'choices' 		=> $graceful_social_icons,
		'priority'		=> 11
	) );

	// Social Url 3
	$wp_customize->add_setting( 'graceful_options[social_m_url_3]', array(
		'default'	 => graceful_options('social_m_url_3'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_url_3]', array(
		'label'		=> esc_html__( 'Add Social Link', 'graceful' ),
		'section'	=> 'graceful_social_media',
		'type'		=> 'text',
		'priority'	=> 13,
		'input_attrs' => array(
            'placeholder' => esc_attr__( 'Complete Link', 'graceful' ),
        )
	) );

	// Social Icon 4
	$wp_customize->add_setting( 'graceful_options[social_m_icon_4]', array(
		'default'	 => graceful_options('social_m_icon_4'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_icon_4]', array(
		'label'			=> esc_html__( 'Select Icon', 'graceful' ),
		'section'		=> 'graceful_social_media',
		'type'			=> 'select',
		'choices' 		=> $graceful_social_icons,
		'priority'		=> 15
	) );

	// Social Url 4
	$wp_customize->add_setting( 'graceful_options[social_m_url_4]', array(
		'default'	 => graceful_options('social_m_url_4'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw'
	) );
	$wp_customize->add_control( 'graceful_options[social_m_url_4]', array(
		'label'		=> esc_html__( 'Add Social Link', 'graceful' ),
		'section'	=> 'graceful_social_media',
		'type'		=> 'text',
		'priority'	=> 17,
		'input_attrs' => array(
            'placeholder' => esc_attr__( 'Complete Link', 'graceful' ),
        )
	) );