<?php
/**
 * Customizer Sanitization Callbacks
 *
 * @package Graceful
 */

	// Sanitize Checkbox
	function graceful_sanitize_checkboxes( $input ) {
		return $input ? true : false;
	}
	
	// Sanitize Select
	function graceful_sanitize_select( $input, $setting ) {
		
		// check for slug
		$input = sanitize_key( $input );
		
		// get all select options
		$options = $setting->manager->get_control( $setting->id )->choices;
		
		// return default if not valid
		return ( array_key_exists( $input, $options ) ? $input : $setting->default );
	}

	// Sanitize number absint
	function graceful_sanitize_numbers_absint( $number, $setting ) {

		// ensure $number is an absolute integer
		$number = absint( $number );

		// return default if not integer
		return ( $number ? $number : $setting->default );

	}

	// Sanitize textarea
	function graceful_sanitize_textareas( $input ) {

		$allowedtags = array(
			'a' => array(
				'href' 		=> array(),
				'title' 	=> array(),
				'_blank'	=> array()
			),
			'img' => array(
				'src' 		=> array(),
				'alt' 		=> array(),
				'width'		=> array(),
				'height'	=> array(),
				'style'		=> array(),
				'class'		=> array(),
				'id'		=> array()
			),
			'br' 	 => array(),
			'em' 	 => array(),
			'strong' => array()
		);

		// return filtered html
		return wp_kses( $input, $allowedtags );

	}

	// Sanitize Custom Controls
	function graceful_sanitize_custom_controller( $input ) {
		return $input;
	}