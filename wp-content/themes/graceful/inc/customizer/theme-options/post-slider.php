<?php
/**
 * Customizer Post Slider Section
 *
 * @package Graceful
 */

	// Add post slider section
	$wp_customize->add_section( 'graceful_post_slider' , array(
		'title'		 => esc_html__( 'Post Slider', 'graceful' ),
		'priority'	 => 25,
		'capability' => 'edit_theme_options'
	) );

	// Post Slider
	$wp_customize->add_setting( 'graceful_options[post_slider_label]', array(
		'default'	 => graceful_options('post_slider_label'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_slider_label]', array(
		'label'		=> esc_html__( 'Enable Post Slider', 'graceful' ),
		'section'	=> 'graceful_post_slider',
		'type'		=> 'checkbox',
		'priority'	=> 1
	) );

	$slider_display = array(
		'all' 		=> 'All Posts',
		'category' 	=> 'by Post Category'
	);
	 
	// Display Posts
	$wp_customize->add_setting( 'graceful_options[post_slider_display]', array(
		'default'	 => graceful_options( 'post_slider_display' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[post_slider_display]', array(
		'label'			=> esc_html__( 'Display Posts', 'graceful' ),
		'section'		=> 'graceful_post_slider',
		'type'			=> 'select',
		'choices' 		=> $slider_display,
		'priority'		=> 2
	) );

	$slider_cats = array();

	foreach ( get_categories() as $categories => $category ) {
	    $slider_cats[$category->term_id] = $category->name;
	}
	 
	// Category
	$wp_customize->add_setting( 'graceful_options[post_slider_category]', array(
		'default'	 => graceful_options( 'post_slider_category' ),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_select'
	) );
	$wp_customize->add_control( 'graceful_options[post_slider_category]', array(
		'label'			=> esc_html__( 'Select Category', 'graceful' ),
		'section'		=> 'graceful_post_slider',
		'type'			=> 'select',
		'choices' 		=> $slider_cats,
		'priority'		=> 3
	) );

	// Amount
	$wp_customize->add_setting( 'graceful_options[post_slider_amount]', array(
		'default'	 => graceful_options('post_slider_amount'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_numbers_absint'
	) );
	$wp_customize->add_control( 'graceful_options[post_slider_amount]', array(
		'label'			=> esc_html__( 'Number of Slides', 'graceful' ),
		'section'		=> 'graceful_post_slider',
		'type'			=> 'number',
		'input_attrs' 	=> array( 'step' => '1', 'max' => '5' ),
		'priority'		=> 10
	) );


	$slider_columns = array( 'step' => '1', 'min' => '1', 'max' => '4' );

	// Navigation
	$wp_customize->add_setting( 'graceful_options[post_slider_navigation]', array(
		'default'	 => graceful_options('post_slider_navigation'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_slider_navigation]', array(
		'label'		=> esc_html__( 'Show Navigation Arrows', 'graceful' ),
		'section'	=> 'graceful_post_slider',
		'type'		=> 'checkbox',
		'priority'	=> 25
	) );

	// Pagination
	$wp_customize->add_setting( 'graceful_options[post_slider_pagination]', array(
		'default'	 => graceful_options('post_slider_pagination'),
		'type'		 => 'option',
		'transport'	 => 'refresh',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'graceful_sanitize_checkboxes'
	) );
	$wp_customize->add_control( 'graceful_options[post_slider_pagination]', array(
		'label'		=> esc_html__( 'Show Pagination Dots', 'graceful' ),
		'section'	=> 'graceful_post_slider',
		'type'		=> 'checkbox',
		'priority'	=> 30
	) );


	// Post Slider Note
	class Graceful_Customize_Text_Note_Control extends WP_Customize_Control {
        public $type = 'text_note';
        public function render_content() {
            esc_html_e( 'Note: Only posts with featured image will appear in Posts Slider.', 'graceful' );
        }
    }

    $wp_customize->add_setting( 'graceful_text_note', array(
		'sanitize_callback' => 'graceful_sanitize_custom_controller'
	) );

	$wp_customize->add_control( new Graceful_Customize_Text_Note_Control( $wp_customize, 'graceful_text_note', array(
        'type'        => 'text_note', 
        'section'     => 'graceful_post_slider',
        'priority'    => 40, 
    ) ) );