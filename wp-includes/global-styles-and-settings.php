<?php
 function wp_get_global_settings( $path = array(), $context = array() ) { if ( ! empty( $context['block_name'] ) ) { $new_path = array( 'blocks', $context['block_name'] ); foreach ( $path as $subpath ) { $new_path[] = $subpath; } $path = $new_path; } $origin = 'custom'; if ( ! wp_theme_has_theme_json() || ( isset( $context['origin'] ) && 'base' === $context['origin'] ) ) { $origin = 'theme'; } $cache_group = 'theme_json'; $cache_key = 'wp_get_global_settings_' . $origin; $can_use_cached = ! wp_is_development_mode( 'theme' ); $settings = false; if ( $can_use_cached ) { $settings = wp_cache_get( $cache_key, $cache_group ); } if ( false === $settings ) { $settings = WP_Theme_JSON_Resolver::get_merged_data( $origin )->get_settings(); if ( $can_use_cached ) { wp_cache_set( $cache_key, $settings, $cache_group ); } } return _wp_array_get( $settings, $path, $settings ); } function wp_get_global_styles( $path = array(), $context = array() ) { if ( ! empty( $context['block_name'] ) ) { $path = array_merge( array( 'blocks', $context['block_name'] ), $path ); } $origin = 'custom'; if ( isset( $context['origin'] ) && 'base' === $context['origin'] ) { $origin = 'theme'; } $resolve_variables = isset( $context['transforms'] ) && is_array( $context['transforms'] ) && in_array( 'resolve-variables', $context['transforms'], true ); $merged_data = WP_Theme_JSON_Resolver::get_merged_data( $origin ); if ( $resolve_variables ) { $merged_data = WP_Theme_JSON::resolve_variables( $merged_data ); } $styles = $merged_data->get_raw_data()['styles']; return _wp_array_get( $styles, $path, $styles ); } function wp_get_global_stylesheet( $types = array() ) { $can_use_cached = empty( $types ) && ! wp_is_development_mode( 'theme' ); $cache_group = 'theme_json'; $cache_key = 'wp_get_global_stylesheet'; if ( $can_use_cached ) { $cached = wp_cache_get( $cache_key, $cache_group ); if ( $cached ) { return $cached; } } $tree = WP_Theme_JSON_Resolver::get_merged_data(); $supports_theme_json = wp_theme_has_theme_json(); if ( empty( $types ) && ! $supports_theme_json ) { $types = array( 'variables', 'presets', 'base-layout-styles' ); } elseif ( empty( $types ) ) { $types = array( 'variables', 'styles', 'presets' ); } $styles_variables = ''; if ( in_array( 'variables', $types, true ) ) { $origins = array( 'default', 'theme', 'custom' ); $styles_variables = $tree->get_stylesheet( array( 'variables' ), $origins ); $types = array_diff( $types, array( 'variables' ) ); } $styles_rest = ''; if ( ! empty( $types ) ) { $origins = array( 'default', 'theme', 'custom' ); if ( ! $supports_theme_json && ( current_theme_supports( 'appearance-tools' ) || current_theme_supports( 'border' ) ) && current_theme_supports( 'editor-color-palette' ) ) { $origins = array( 'default', 'theme' ); } elseif ( ! $supports_theme_json ) { $origins = array( 'default' ); } $styles_rest = $tree->get_stylesheet( $types, $origins ); } $stylesheet = $styles_variables . $styles_rest; if ( $can_use_cached ) { wp_cache_set( $cache_key, $stylesheet, $cache_group ); } return $stylesheet; } function wp_get_global_styles_custom_css() { if ( ! wp_theme_has_theme_json() ) { return ''; } $can_use_cached = ! wp_is_development_mode( 'theme' ); $cache_key = 'wp_get_global_styles_custom_css'; $cache_group = 'theme_json'; if ( $can_use_cached ) { $cached = wp_cache_get( $cache_key, $cache_group ); if ( $cached ) { return $cached; } } $tree = WP_Theme_JSON_Resolver::get_merged_data(); $stylesheet = $tree->get_custom_css(); if ( $can_use_cached ) { wp_cache_set( $cache_key, $stylesheet, $cache_group ); } return $stylesheet; } function wp_add_global_styles_for_blocks() { global $wp_styles; $tree = WP_Theme_JSON_Resolver::get_merged_data(); $block_nodes = $tree->get_styles_block_nodes(); foreach ( $block_nodes as $metadata ) { $block_css = $tree->get_styles_for_block( $metadata ); if ( ! wp_should_load_separate_core_block_assets() ) { wp_add_inline_style( 'global-styles', $block_css ); continue; } $stylesheet_handle = 'global-styles'; if ( isset( $metadata['name'] ) ) { if ( str_starts_with( $metadata['name'], 'core/' ) ) { $block_name = str_replace( 'core/', '', $metadata['name'] ); $block_handle = 'wp-block-' . $block_name; if ( in_array( $block_handle, $wp_styles->queue ) ) { wp_add_inline_style( $stylesheet_handle, $block_css ); } } else { wp_add_inline_style( $stylesheet_handle, $block_css ); } } if ( ! isset( $metadata['name'] ) && ! empty( $metadata['path'] ) ) { $block_name = wp_get_block_name_from_theme_json_path( $metadata['path'] ); if ( $block_name ) { if ( str_starts_with( $block_name, 'core/' ) ) { $block_name = str_replace( 'core/', '', $block_name ); $block_handle = 'wp-block-' . $block_name; if ( in_array( $block_handle, $wp_styles->queue ) ) { wp_add_inline_style( $stylesheet_handle, $block_css ); } } else { wp_add_inline_style( $stylesheet_handle, $block_css ); } } } } } function wp_get_block_name_from_theme_json_path( $path ) { if ( count( $path ) >= 3 && 'styles' === $path[0] && 'blocks' === $path[1] && str_contains( $path[2], '/' ) ) { return $path[2]; } $result = array_values( array_filter( $path, static function ( $item ) { if ( str_contains( $item, 'core/' ) ) { return true; } return false; } ) ); if ( isset( $result[0] ) ) { return $result[0]; } return ''; } function wp_theme_has_theme_json() { static $theme_has_support = array(); $stylesheet = get_stylesheet(); if ( isset( $theme_has_support[ $stylesheet ] ) && ! wp_is_development_mode( 'theme' ) ) { return $theme_has_support[ $stylesheet ]; } $stylesheet_directory = get_stylesheet_directory(); $template_directory = get_template_directory(); if ( $stylesheet_directory !== $template_directory && file_exists( $stylesheet_directory . '/theme.json' ) ) { $path = $stylesheet_directory . '/theme.json'; } else { $path = $template_directory . '/theme.json'; } $path = apply_filters( 'theme_file_path', $path, 'theme.json' ); $theme_has_support[ $stylesheet ] = file_exists( $path ); return $theme_has_support[ $stylesheet ]; } function wp_clean_theme_json_cache() { wp_cache_delete( 'wp_get_global_stylesheet', 'theme_json' ); wp_cache_delete( 'wp_get_global_styles_svg_filters', 'theme_json' ); wp_cache_delete( 'wp_get_global_settings_custom', 'theme_json' ); wp_cache_delete( 'wp_get_global_settings_theme', 'theme_json' ); wp_cache_delete( 'wp_get_global_styles_custom_css', 'theme_json' ); wp_cache_delete( 'wp_get_theme_data_template_parts', 'theme_json' ); WP_Theme_JSON_Resolver::clean_cached_data(); } function wp_get_theme_directory_pattern_slugs() { return WP_Theme_JSON_Resolver::get_theme_data( array(), array( 'with_supports' => false ) )->get_patterns(); } function wp_get_theme_data_custom_templates() { return WP_Theme_JSON_Resolver::get_theme_data( array(), array( 'with_supports' => false ) )->get_custom_templates(); } function wp_get_theme_data_template_parts() { $cache_group = 'theme_json'; $cache_key = 'wp_get_theme_data_template_parts'; $can_use_cached = ! wp_is_development_mode( 'theme' ); $metadata = false; if ( $can_use_cached ) { $metadata = wp_cache_get( $cache_key, $cache_group ); if ( false !== $metadata ) { return $metadata; } } if ( false === $metadata ) { $metadata = WP_Theme_JSON_Resolver::get_theme_data( array(), array( 'with_supports' => false ) )->get_template_parts(); if ( $can_use_cached ) { wp_cache_set( $cache_key, $metadata, $cache_group ); } } return $metadata; } function wp_get_block_css_selector( $block_type, $target = 'root', $fallback = false ) { if ( empty( $target ) ) { return null; } $has_selectors = ! empty( $block_type->selectors ); $root_selector = null; if ( $has_selectors && isset( $block_type->selectors['root'] ) ) { $root_selector = $block_type->selectors['root']; } elseif ( isset( $block_type->supports['__experimentalSelector'] ) && is_string( $block_type->supports['__experimentalSelector'] ) ) { $root_selector = $block_type->supports['__experimentalSelector']; } else { $block_name = str_replace( '/', '-', str_replace( 'core/', '', $block_type->name ) ); $root_selector = ".wp-block-{$block_name}"; } if ( 'root' === $target ) { return $root_selector; } if ( is_string( $target ) ) { $target = explode( '.', $target ); } if ( 1 === count( $target ) ) { $fallback_selector = $fallback ? $root_selector : null; if ( $has_selectors ) { $path = array( current( $target ), 'root' ); $feature_selector = _wp_array_get( $block_type->selectors, $path, null ); if ( $feature_selector ) { return $feature_selector; } $feature_selector = _wp_array_get( $block_type->selectors, $target, null ); return is_string( $feature_selector ) ? $feature_selector : $fallback_selector; } $path = array( current( $target ), '__experimentalSelector' ); $feature_selector = _wp_array_get( $block_type->supports, $path, null ); if ( null === $feature_selector ) { return $fallback_selector; } return WP_Theme_JSON::scope_selector( $root_selector, $feature_selector ); } $subfeature_selector = null; if ( $has_selectors ) { $subfeature_selector = _wp_array_get( $block_type->selectors, $target, null ); } if ( $subfeature_selector ) { return $subfeature_selector; } if ( $fallback ) { return wp_get_block_css_selector( $block_type, $target[0], $fallback ); } return null; } 