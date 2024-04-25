<?php
/**
 * TGMPA
 *
 * @package Graceful
 */

// TGMPA Plugins path and directory
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

// Recommended plugins
function graceful_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'Woocommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
	);	

	$config = array(
		'id'           => 'graceful',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'graceful_register_required_plugins' );