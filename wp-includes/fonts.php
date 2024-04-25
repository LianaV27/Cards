<?php
 function wp_print_font_faces( $fonts = array() ) { if ( empty( $fonts ) ) { $fonts = WP_Font_Face_Resolver::get_fonts_from_theme_json(); } if ( empty( $fonts ) ) { return; } $wp_font_face = new WP_Font_Face(); $wp_font_face->generate_and_print( $fonts ); } function wp_register_font_collection( string $slug, array $args ) { return WP_Font_Library::get_instance()->register_font_collection( $slug, $args ); } function wp_unregister_font_collection( string $slug ) { return WP_Font_Library::get_instance()->unregister_font_collection( $slug ); } function wp_get_font_dir() { return wp_font_dir( false ); } function wp_font_dir( $create_dir = true ) { add_filter( 'upload_dir', '_wp_filter_font_directory' ); $font_dir = wp_upload_dir( null, $create_dir, false ); remove_filter( 'upload_dir', '_wp_filter_font_directory' ); return $font_dir; } function _wp_filter_font_directory( $font_dir ) { if ( doing_filter( 'font_dir' ) ) { return $font_dir; } $font_dir = array( 'path' => untrailingslashit( $font_dir['basedir'] ) . '/fonts', 'url' => untrailingslashit( $font_dir['baseurl'] ) . '/fonts', 'subdir' => '', 'basedir' => untrailingslashit( $font_dir['basedir'] ) . '/fonts', 'baseurl' => untrailingslashit( $font_dir['baseurl'] ) . '/fonts', 'error' => false, ); return apply_filters( 'font_dir', $font_dir ); } function _wp_after_delete_font_family( $post_id, $post ) { if ( 'wp_font_family' !== $post->post_type ) { return; } $font_faces = get_children( array( 'post_parent' => $post_id, 'post_type' => 'wp_font_face', ) ); foreach ( $font_faces as $font_face ) { wp_delete_post( $font_face->ID, true ); } } function _wp_before_delete_font_face( $post_id, $post ) { if ( 'wp_font_face' !== $post->post_type ) { return; } $font_files = get_post_meta( $post_id, '_wp_font_face_file', false ); $font_dir = wp_get_font_dir()['path']; foreach ( $font_files as $font_file ) { wp_delete_file( $font_dir . '/' . $font_file ); } } function _wp_register_default_font_collections() { wp_register_font_collection( 'google-fonts', array( 'name' => _x( 'Google Fonts', 'font collection name' ), 'description' => __( 'Install from Google Fonts. Fonts are copied to and served from your site.' ), 'font_families' => 'https://s.w.org/images/fonts/wp-6.5/collections/google-fonts-with-preview.json', 'categories' => array( array( 'name' => _x( 'Sans Serif', 'font category' ), 'slug' => 'sans-serif', ), array( 'name' => _x( 'Display', 'font category' ), 'slug' => 'display', ), array( 'name' => _x( 'Serif', 'font category' ), 'slug' => 'serif', ), array( 'name' => _x( 'Handwriting', 'font category' ), 'slug' => 'handwriting', ), array( 'name' => _x( 'Monospace', 'font category' ), 'slug' => 'monospace', ), ), ) ); } 