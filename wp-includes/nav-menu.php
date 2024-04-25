<?php
 function wp_get_nav_menu_object( $menu ) { $menu_obj = false; if ( is_object( $menu ) ) { $menu_obj = $menu; } if ( $menu && ! $menu_obj ) { $menu_obj = get_term( $menu, 'nav_menu' ); if ( ! $menu_obj ) { $menu_obj = get_term_by( 'slug', $menu, 'nav_menu' ); } if ( ! $menu_obj ) { $menu_obj = get_term_by( 'name', $menu, 'nav_menu' ); } } if ( ! $menu_obj || is_wp_error( $menu_obj ) ) { $menu_obj = false; } return apply_filters( 'wp_get_nav_menu_object', $menu_obj, $menu ); } function is_nav_menu( $menu ) { if ( ! $menu ) { return false; } $menu_obj = wp_get_nav_menu_object( $menu ); if ( $menu_obj && ! is_wp_error( $menu_obj ) && ! empty( $menu_obj->taxonomy ) && 'nav_menu' === $menu_obj->taxonomy ) { return true; } return false; } function register_nav_menus( $locations = array() ) { global $_wp_registered_nav_menus; add_theme_support( 'menus' ); foreach ( $locations as $key => $value ) { if ( is_int( $key ) ) { _doing_it_wrong( __FUNCTION__, __( 'Nav menu locations must be strings.' ), '5.3.0' ); break; } } $_wp_registered_nav_menus = array_merge( (array) $_wp_registered_nav_menus, $locations ); } function unregister_nav_menu( $location ) { global $_wp_registered_nav_menus; if ( is_array( $_wp_registered_nav_menus ) && isset( $_wp_registered_nav_menus[ $location ] ) ) { unset( $_wp_registered_nav_menus[ $location ] ); if ( empty( $_wp_registered_nav_menus ) ) { _remove_theme_support( 'menus' ); } return true; } return false; } function register_nav_menu( $location, $description ) { register_nav_menus( array( $location => $description ) ); } function get_registered_nav_menus() { global $_wp_registered_nav_menus; if ( isset( $_wp_registered_nav_menus ) ) { return $_wp_registered_nav_menus; } return array(); } function get_nav_menu_locations() { $locations = get_theme_mod( 'nav_menu_locations' ); return ( is_array( $locations ) ) ? $locations : array(); } function has_nav_menu( $location ) { $has_nav_menu = false; $registered_nav_menus = get_registered_nav_menus(); if ( isset( $registered_nav_menus[ $location ] ) ) { $locations = get_nav_menu_locations(); $has_nav_menu = ! empty( $locations[ $location ] ); } return apply_filters( 'has_nav_menu', $has_nav_menu, $location ); } function wp_get_nav_menu_name( $location ) { $menu_name = ''; $locations = get_nav_menu_locations(); if ( isset( $locations[ $location ] ) ) { $menu = wp_get_nav_menu_object( $locations[ $location ] ); if ( $menu && $menu->name ) { $menu_name = $menu->name; } } return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location ); } function is_nav_menu_item( $menu_item_id = 0 ) { return ( ! is_wp_error( $menu_item_id ) && ( 'nav_menu_item' === get_post_type( $menu_item_id ) ) ); } function wp_create_nav_menu( $menu_name ) { return wp_update_nav_menu_object( 0, array( 'menu-name' => $menu_name ) ); } function wp_delete_nav_menu( $menu ) { $menu = wp_get_nav_menu_object( $menu ); if ( ! $menu ) { return false; } $menu_objects = get_objects_in_term( $menu->term_id, 'nav_menu' ); if ( ! empty( $menu_objects ) ) { foreach ( $menu_objects as $item ) { wp_delete_post( $item ); } } $result = wp_delete_term( $menu->term_id, 'nav_menu' ); $locations = get_nav_menu_locations(); foreach ( $locations as $location => $menu_id ) { if ( $menu_id == $menu->term_id ) { $locations[ $location ] = 0; } } set_theme_mod( 'nav_menu_locations', $locations ); if ( $result && ! is_wp_error( $result ) ) { do_action( 'wp_delete_nav_menu', $menu->term_id ); } return $result; } function wp_update_nav_menu_object( $menu_id = 0, $menu_data = array() ) { $menu_id = (int) $menu_id; $_menu = wp_get_nav_menu_object( $menu_id ); $args = array( 'description' => ( isset( $menu_data['description'] ) ? $menu_data['description'] : '' ), 'name' => ( isset( $menu_data['menu-name'] ) ? $menu_data['menu-name'] : '' ), 'parent' => ( isset( $menu_data['parent'] ) ? (int) $menu_data['parent'] : 0 ), 'slug' => null, ); $_possible_existing = get_term_by( 'name', $menu_data['menu-name'], 'nav_menu' ); if ( $_possible_existing && ! is_wp_error( $_possible_existing ) && isset( $_possible_existing->term_id ) && $_possible_existing->term_id != $menu_id ) { return new WP_Error( 'menu_exists', sprintf( __( 'The menu name %s conflicts with another menu name. Please try another.' ), '<strong>' . esc_html( $menu_data['menu-name'] ) . '</strong>' ) ); } if ( ! $_menu || is_wp_error( $_menu ) ) { $menu_exists = get_term_by( 'name', $menu_data['menu-name'], 'nav_menu' ); if ( $menu_exists ) { return new WP_Error( 'menu_exists', sprintf( __( 'The menu name %s conflicts with another menu name. Please try another.' ), '<strong>' . esc_html( $menu_data['menu-name'] ) . '</strong>' ) ); } $_menu = wp_insert_term( $menu_data['menu-name'], 'nav_menu', $args ); if ( is_wp_error( $_menu ) ) { return $_menu; } do_action( 'wp_create_nav_menu', $_menu['term_id'], $menu_data ); return (int) $_menu['term_id']; } if ( ! $_menu || ! isset( $_menu->term_id ) ) { return 0; } $menu_id = (int) $_menu->term_id; $update_response = wp_update_term( $menu_id, 'nav_menu', $args ); if ( is_wp_error( $update_response ) ) { return $update_response; } $menu_id = (int) $update_response['term_id']; do_action( 'wp_update_nav_menu', $menu_id, $menu_data ); return $menu_id; } function wp_update_nav_menu_item( $menu_id = 0, $menu_item_db_id = 0, $menu_item_data = array(), $fire_after_hooks = true ) { $menu_id = (int) $menu_id; $menu_item_db_id = (int) $menu_item_db_id; if ( ! empty( $menu_item_db_id ) && ! is_nav_menu_item( $menu_item_db_id ) ) { return new WP_Error( 'update_nav_menu_item_failed', __( 'The given object ID is not that of a menu item.' ) ); } $menu = wp_get_nav_menu_object( $menu_id ); if ( ! $menu && 0 !== $menu_id ) { return new WP_Error( 'invalid_menu_id', __( 'Invalid menu ID.' ) ); } if ( is_wp_error( $menu ) ) { return $menu; } $defaults = array( 'menu-item-db-id' => $menu_item_db_id, 'menu-item-object-id' => 0, 'menu-item-object' => '', 'menu-item-parent-id' => 0, 'menu-item-position' => 0, 'menu-item-type' => 'custom', 'menu-item-title' => '', 'menu-item-url' => '', 'menu-item-description' => '', 'menu-item-attr-title' => '', 'menu-item-target' => '', 'menu-item-classes' => '', 'menu-item-xfn' => '', 'menu-item-status' => '', 'menu-item-post-date' => '', 'menu-item-post-date-gmt' => '', ); $args = wp_parse_args( $menu_item_data, $defaults ); if ( 0 == $menu_id ) { $args['menu-item-position'] = 1; } elseif ( 0 == (int) $args['menu-item-position'] ) { $menu_items = 0 == $menu_id ? array() : (array) wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'publish,draft' ) ); $last_item = array_pop( $menu_items ); $args['menu-item-position'] = ( $last_item && isset( $last_item->menu_order ) ) ? 1 + $last_item->menu_order : count( $menu_items ); } $original_parent = 0 < $menu_item_db_id ? get_post_field( 'post_parent', $menu_item_db_id ) : 0; if ( 'custom' === $args['menu-item-type'] ) { $args['menu-item-url'] = trim( $args['menu-item-url'] ); } else { $args['menu-item-url'] = ''; $original_title = ''; if ( 'taxonomy' === $args['menu-item-type'] ) { $original_parent = get_term_field( 'parent', $args['menu-item-object-id'], $args['menu-item-object'], 'raw' ); $original_title = get_term_field( 'name', $args['menu-item-object-id'], $args['menu-item-object'], 'raw' ); } elseif ( 'post_type' === $args['menu-item-type'] ) { $original_object = get_post( $args['menu-item-object-id'] ); $original_parent = (int) $original_object->post_parent; $original_title = $original_object->post_title; } elseif ( 'post_type_archive' === $args['menu-item-type'] ) { $original_object = get_post_type_object( $args['menu-item-object'] ); if ( $original_object ) { $original_title = $original_object->labels->archives; } } if ( wp_unslash( $args['menu-item-title'] ) === wp_specialchars_decode( $original_title ) ) { $args['menu-item-title'] = ''; } if ( '' === $args['menu-item-title'] && '' === $args['menu-item-description'] ) { $args['menu-item-description'] = ' '; } } $post = array( 'menu_order' => $args['menu-item-position'], 'ping_status' => 0, 'post_content' => $args['menu-item-description'], 'post_excerpt' => $args['menu-item-attr-title'], 'post_parent' => $original_parent, 'post_title' => $args['menu-item-title'], 'post_type' => 'nav_menu_item', ); $post_date = wp_resolve_post_date( $args['menu-item-post-date'], $args['menu-item-post-date-gmt'] ); if ( $post_date ) { $post['post_date'] = $post_date; } $update = 0 != $menu_item_db_id; if ( ! $update ) { $post['ID'] = 0; $post['post_status'] = 'publish' === $args['menu-item-status'] ? 'publish' : 'draft'; $menu_item_db_id = wp_insert_post( $post, true, $fire_after_hooks ); if ( ! $menu_item_db_id || is_wp_error( $menu_item_db_id ) ) { return $menu_item_db_id; } do_action( 'wp_add_nav_menu_item', $menu_id, $menu_item_db_id, $args ); } if ( $menu_id && ( ! $update || ! is_object_in_term( $menu_item_db_id, 'nav_menu', (int) $menu->term_id ) ) ) { $update_terms = wp_set_object_terms( $menu_item_db_id, array( $menu->term_id ), 'nav_menu' ); if ( is_wp_error( $update_terms ) ) { return $update_terms; } } if ( 'custom' === $args['menu-item-type'] ) { $args['menu-item-object-id'] = $menu_item_db_id; $args['menu-item-object'] = 'custom'; } $menu_item_db_id = (int) $menu_item_db_id; if ( (int) $args['menu-item-parent-id'] === $menu_item_db_id ) { $args['menu-item-parent-id'] = 0; } update_post_meta( $menu_item_db_id, '_menu_item_type', sanitize_key( $args['menu-item-type'] ) ); update_post_meta( $menu_item_db_id, '_menu_item_menu_item_parent', (string) ( (int) $args['menu-item-parent-id'] ) ); update_post_meta( $menu_item_db_id, '_menu_item_object_id', (string) ( (int) $args['menu-item-object-id'] ) ); update_post_meta( $menu_item_db_id, '_menu_item_object', sanitize_key( $args['menu-item-object'] ) ); update_post_meta( $menu_item_db_id, '_menu_item_target', sanitize_key( $args['menu-item-target'] ) ); $args['menu-item-classes'] = array_map( 'sanitize_html_class', explode( ' ', $args['menu-item-classes'] ) ); $args['menu-item-xfn'] = implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $args['menu-item-xfn'] ) ) ); update_post_meta( $menu_item_db_id, '_menu_item_classes', $args['menu-item-classes'] ); update_post_meta( $menu_item_db_id, '_menu_item_xfn', $args['menu-item-xfn'] ); update_post_meta( $menu_item_db_id, '_menu_item_url', sanitize_url( $args['menu-item-url'] ) ); if ( 0 == $menu_id ) { update_post_meta( $menu_item_db_id, '_menu_item_orphaned', (string) time() ); } elseif ( get_post_meta( $menu_item_db_id, '_menu_item_orphaned' ) ) { delete_post_meta( $menu_item_db_id, '_menu_item_orphaned' ); } if ( $update ) { $post['ID'] = $menu_item_db_id; $post['post_status'] = ( 'draft' === $args['menu-item-status'] ) ? 'draft' : 'publish'; $update_post = wp_update_post( $post, true ); if ( is_wp_error( $update_post ) ) { return $update_post; } } do_action( 'wp_update_nav_menu_item', $menu_id, $menu_item_db_id, $args ); return $menu_item_db_id; } function wp_get_nav_menus( $args = array() ) { $defaults = array( 'taxonomy' => 'nav_menu', 'hide_empty' => false, 'orderby' => 'name', ); $args = wp_parse_args( $args, $defaults ); return apply_filters( 'wp_get_nav_menus', get_terms( $args ), $args ); } function _is_valid_nav_menu_item( $item ) { return empty( $item->_invalid ); } function wp_get_nav_menu_items( $menu, $args = array() ) { $menu = wp_get_nav_menu_object( $menu ); if ( ! $menu ) { return false; } if ( ! taxonomy_exists( 'nav_menu' ) ) { return false; } $defaults = array( 'order' => 'ASC', 'orderby' => 'menu_order', 'post_type' => 'nav_menu_item', 'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true, 'update_menu_item_cache' => true, 'tax_query' => array( array( 'taxonomy' => 'nav_menu', 'field' => 'term_taxonomy_id', 'terms' => $menu->term_taxonomy_id, ), ), ); $args = wp_parse_args( $args, $defaults ); if ( $menu->count > 0 ) { $items = get_posts( $args ); } else { $items = array(); } $items = array_map( 'wp_setup_nav_menu_item', $items ); if ( ! is_admin() ) { $items = array_filter( $items, '_is_valid_nav_menu_item' ); } if ( ARRAY_A === $args['output'] ) { $items = wp_list_sort( $items, array( $args['output_key'] => 'ASC', ) ); $i = 1; foreach ( $items as $k => $item ) { $items[ $k ]->{$args['output_key']} = $i++; } } return apply_filters( 'wp_get_nav_menu_items', $items, $menu, $args ); } function update_menu_item_cache( $menu_items ) { $post_ids = array(); $term_ids = array(); foreach ( $menu_items as $menu_item ) { if ( 'nav_menu_item' !== $menu_item->post_type ) { continue; } $object_id = get_post_meta( $menu_item->ID, '_menu_item_object_id', true ); $type = get_post_meta( $menu_item->ID, '_menu_item_type', true ); if ( 'post_type' === $type ) { $post_ids[] = (int) $object_id; } elseif ( 'taxonomy' === $type ) { $term_ids[] = (int) $object_id; } } if ( ! empty( $post_ids ) ) { _prime_post_caches( $post_ids, false ); } if ( ! empty( $term_ids ) ) { _prime_term_caches( $term_ids ); } } function wp_setup_nav_menu_item( $menu_item ) { $pre_menu_item = apply_filters( 'pre_wp_setup_nav_menu_item', null, $menu_item ); if ( null !== $pre_menu_item ) { return $pre_menu_item; } if ( isset( $menu_item->post_type ) ) { if ( 'nav_menu_item' === $menu_item->post_type ) { $menu_item->db_id = (int) $menu_item->ID; $menu_item->menu_item_parent = ! isset( $menu_item->menu_item_parent ) ? get_post_meta( $menu_item->ID, '_menu_item_menu_item_parent', true ) : $menu_item->menu_item_parent; $menu_item->object_id = ! isset( $menu_item->object_id ) ? get_post_meta( $menu_item->ID, '_menu_item_object_id', true ) : $menu_item->object_id; $menu_item->object = ! isset( $menu_item->object ) ? get_post_meta( $menu_item->ID, '_menu_item_object', true ) : $menu_item->object; $menu_item->type = ! isset( $menu_item->type ) ? get_post_meta( $menu_item->ID, '_menu_item_type', true ) : $menu_item->type; if ( 'post_type' === $menu_item->type ) { $object = get_post_type_object( $menu_item->object ); if ( $object ) { $menu_item->type_label = $object->labels->singular_name; if ( function_exists( 'get_post_states' ) ) { $menu_post = get_post( $menu_item->object_id ); $post_states = get_post_states( $menu_post ); if ( $post_states ) { $menu_item->type_label = wp_strip_all_tags( implode( ', ', $post_states ) ); } } } else { $menu_item->type_label = $menu_item->object; $menu_item->_invalid = true; } if ( 'trash' === get_post_status( $menu_item->object_id ) ) { $menu_item->_invalid = true; } $original_object = get_post( $menu_item->object_id ); if ( $original_object ) { $menu_item->url = get_permalink( $original_object->ID ); $original_title = apply_filters( 'the_title', $original_object->post_title, $original_object->ID ); } else { $menu_item->url = ''; $original_title = ''; $menu_item->_invalid = true; } if ( '' === $original_title ) { $original_title = sprintf( __( '#%d (no title)' ), $menu_item->object_id ); } $menu_item->title = ( '' === $menu_item->post_title ) ? $original_title : $menu_item->post_title; } elseif ( 'post_type_archive' === $menu_item->type ) { $object = get_post_type_object( $menu_item->object ); if ( $object ) { $menu_item->title = ( '' === $menu_item->post_title ) ? $object->labels->archives : $menu_item->post_title; $post_type_description = $object->description; } else { $post_type_description = ''; $menu_item->_invalid = true; } $menu_item->type_label = __( 'Post Type Archive' ); $post_content = wp_trim_words( $menu_item->post_content, 200 ); $post_type_description = ( '' === $post_content ) ? $post_type_description : $post_content; $menu_item->url = get_post_type_archive_link( $menu_item->object ); } elseif ( 'taxonomy' === $menu_item->type ) { $object = get_taxonomy( $menu_item->object ); if ( $object ) { $menu_item->type_label = $object->labels->singular_name; } else { $menu_item->type_label = $menu_item->object; $menu_item->_invalid = true; } $original_object = get_term( (int) $menu_item->object_id, $menu_item->object ); if ( $original_object && ! is_wp_error( $original_object ) ) { $menu_item->url = get_term_link( (int) $menu_item->object_id, $menu_item->object ); $original_title = $original_object->name; } else { $menu_item->url = ''; $original_title = ''; $menu_item->_invalid = true; } if ( '' === $original_title ) { $original_title = sprintf( __( '#%d (no title)' ), $menu_item->object_id ); } $menu_item->title = ( '' === $menu_item->post_title ) ? $original_title : $menu_item->post_title; } else { $menu_item->type_label = __( 'Custom Link' ); $menu_item->title = $menu_item->post_title; $menu_item->url = ! isset( $menu_item->url ) ? get_post_meta( $menu_item->ID, '_menu_item_url', true ) : $menu_item->url; } $menu_item->target = ! isset( $menu_item->target ) ? get_post_meta( $menu_item->ID, '_menu_item_target', true ) : $menu_item->target; $menu_item->attr_title = ! isset( $menu_item->attr_title ) ? apply_filters( 'nav_menu_attr_title', $menu_item->post_excerpt ) : $menu_item->attr_title; if ( ! isset( $menu_item->description ) ) { $menu_item->description = apply_filters( 'nav_menu_description', wp_trim_words( $menu_item->post_content, 200 ) ); } $menu_item->classes = ! isset( $menu_item->classes ) ? (array) get_post_meta( $menu_item->ID, '_menu_item_classes', true ) : $menu_item->classes; $menu_item->xfn = ! isset( $menu_item->xfn ) ? get_post_meta( $menu_item->ID, '_menu_item_xfn', true ) : $menu_item->xfn; } else { $menu_item->db_id = 0; $menu_item->menu_item_parent = 0; $menu_item->object_id = (int) $menu_item->ID; $menu_item->type = 'post_type'; $object = get_post_type_object( $menu_item->post_type ); $menu_item->object = $object->name; $menu_item->type_label = $object->labels->singular_name; if ( '' === $menu_item->post_title ) { $menu_item->post_title = sprintf( __( '#%d (no title)' ), $menu_item->ID ); } $menu_item->title = $menu_item->post_title; $menu_item->url = get_permalink( $menu_item->ID ); $menu_item->target = ''; $menu_item->attr_title = apply_filters( 'nav_menu_attr_title', '' ); $menu_item->description = apply_filters( 'nav_menu_description', '' ); $menu_item->classes = array(); $menu_item->xfn = ''; } } elseif ( isset( $menu_item->taxonomy ) ) { $menu_item->ID = $menu_item->term_id; $menu_item->db_id = 0; $menu_item->menu_item_parent = 0; $menu_item->object_id = (int) $menu_item->term_id; $menu_item->post_parent = (int) $menu_item->parent; $menu_item->type = 'taxonomy'; $object = get_taxonomy( $menu_item->taxonomy ); $menu_item->object = $object->name; $menu_item->type_label = $object->labels->singular_name; $menu_item->title = $menu_item->name; $menu_item->url = get_term_link( $menu_item, $menu_item->taxonomy ); $menu_item->target = ''; $menu_item->attr_title = ''; $menu_item->description = get_term_field( 'description', $menu_item->term_id, $menu_item->taxonomy ); $menu_item->classes = array(); $menu_item->xfn = ''; } return apply_filters( 'wp_setup_nav_menu_item', $menu_item ); } function wp_get_associated_nav_menu_items( $object_id = 0, $object_type = 'post_type', $taxonomy = '' ) { $object_id = (int) $object_id; $menu_item_ids = array(); $query = new WP_Query(); $menu_items = $query->query( array( 'meta_key' => '_menu_item_object_id', 'meta_value' => $object_id, 'post_status' => 'any', 'post_type' => 'nav_menu_item', 'posts_per_page' => -1, ) ); foreach ( (array) $menu_items as $menu_item ) { if ( isset( $menu_item->ID ) && is_nav_menu_item( $menu_item->ID ) ) { $menu_item_type = get_post_meta( $menu_item->ID, '_menu_item_type', true ); if ( 'post_type' === $object_type && 'post_type' === $menu_item_type ) { $menu_item_ids[] = (int) $menu_item->ID; } elseif ( 'taxonomy' === $object_type && 'taxonomy' === $menu_item_type && get_post_meta( $menu_item->ID, '_menu_item_object', true ) == $taxonomy ) { $menu_item_ids[] = (int) $menu_item->ID; } } } return array_unique( $menu_item_ids ); } function _wp_delete_post_menu_item( $object_id ) { $object_id = (int) $object_id; $menu_item_ids = wp_get_associated_nav_menu_items( $object_id, 'post_type' ); foreach ( (array) $menu_item_ids as $menu_item_id ) { wp_delete_post( $menu_item_id, true ); } } function _wp_delete_tax_menu_item( $object_id, $tt_id, $taxonomy ) { $object_id = (int) $object_id; $menu_item_ids = wp_get_associated_nav_menu_items( $object_id, 'taxonomy', $taxonomy ); foreach ( (array) $menu_item_ids as $menu_item_id ) { wp_delete_post( $menu_item_id, true ); } } function _wp_auto_add_pages_to_menu( $new_status, $old_status, $post ) { if ( 'publish' !== $new_status || 'publish' === $old_status || 'page' !== $post->post_type ) { return; } if ( ! empty( $post->post_parent ) ) { return; } $auto_add = get_option( 'nav_menu_options' ); if ( empty( $auto_add ) || ! is_array( $auto_add ) || ! isset( $auto_add['auto_add'] ) ) { return; } $auto_add = $auto_add['auto_add']; if ( empty( $auto_add ) || ! is_array( $auto_add ) ) { return; } $args = array( 'menu-item-object-id' => $post->ID, 'menu-item-object' => $post->post_type, 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish', ); foreach ( $auto_add as $menu_id ) { $items = wp_get_nav_menu_items( $menu_id, array( 'post_status' => 'publish,draft' ) ); if ( ! is_array( $items ) ) { continue; } foreach ( $items as $item ) { if ( $post->ID == $item->object_id ) { continue 2; } } wp_update_nav_menu_item( $menu_id, 0, $args ); } } function _wp_delete_customize_changeset_dependent_auto_drafts( $post_id ) { $post = get_post( $post_id ); if ( ! $post || 'customize_changeset' !== $post->post_type ) { return; } $data = json_decode( $post->post_content, true ); if ( empty( $data['nav_menus_created_posts']['value'] ) ) { return; } remove_action( 'delete_post', '_wp_delete_customize_changeset_dependent_auto_drafts' ); foreach ( $data['nav_menus_created_posts']['value'] as $stub_post_id ) { if ( empty( $stub_post_id ) ) { continue; } if ( 'auto-draft' === get_post_status( $stub_post_id ) ) { wp_delete_post( $stub_post_id, true ); } elseif ( 'draft' === get_post_status( $stub_post_id ) ) { wp_trash_post( $stub_post_id ); delete_post_meta( $stub_post_id, '_customize_changeset_uuid' ); } } add_action( 'delete_post', '_wp_delete_customize_changeset_dependent_auto_drafts' ); } function _wp_menus_changed() { $old_nav_menu_locations = get_option( 'theme_switch_menu_locations', array() ); $new_nav_menu_locations = get_nav_menu_locations(); $mapped_nav_menu_locations = wp_map_nav_menu_locations( $new_nav_menu_locations, $old_nav_menu_locations ); set_theme_mod( 'nav_menu_locations', $mapped_nav_menu_locations ); delete_option( 'theme_switch_menu_locations' ); } function wp_map_nav_menu_locations( $new_nav_menu_locations, $old_nav_menu_locations ) { $registered_nav_menus = get_registered_nav_menus(); $new_nav_menu_locations = array_intersect_key( $new_nav_menu_locations, $registered_nav_menus ); if ( empty( $old_nav_menu_locations ) ) { return $new_nav_menu_locations; } if ( 1 === count( $old_nav_menu_locations ) && 1 === count( $registered_nav_menus ) ) { $new_nav_menu_locations[ key( $registered_nav_menus ) ] = array_pop( $old_nav_menu_locations ); return $new_nav_menu_locations; } $old_locations = array_keys( $old_nav_menu_locations ); foreach ( $registered_nav_menus as $location => $name ) { if ( in_array( $location, $old_locations, true ) ) { $new_nav_menu_locations[ $location ] = $old_nav_menu_locations[ $location ]; unset( $old_nav_menu_locations[ $location ] ); } } if ( empty( $old_nav_menu_locations ) ) { return $new_nav_menu_locations; } $common_slug_groups = array( array( 'primary', 'menu-1', 'main', 'header', 'navigation', 'top' ), array( 'secondary', 'menu-2', 'footer', 'subsidiary', 'bottom' ), array( 'social' ), ); foreach ( $common_slug_groups as $slug_group ) { foreach ( $slug_group as $slug ) { foreach ( $registered_nav_menus as $new_location => $name ) { if ( is_string( $new_location ) && false === stripos( $new_location, $slug ) && false === stripos( $slug, $new_location ) ) { continue; } elseif ( is_numeric( $new_location ) && $new_location !== $slug ) { continue; } foreach ( $old_nav_menu_locations as $location => $menu_id ) { foreach ( $slug_group as $slug ) { if ( is_string( $location ) && false === stripos( $location, $slug ) && false === stripos( $slug, $location ) ) { continue; } elseif ( is_numeric( $location ) && $location !== $slug ) { continue; } if ( ! empty( $old_nav_menu_locations[ $location ] ) ) { $new_nav_menu_locations[ $new_location ] = $old_nav_menu_locations[ $location ]; unset( $old_nav_menu_locations[ $location ] ); continue 3; } } } } } } return $new_nav_menu_locations; } function _wp_reset_invalid_menu_item_parent( $menu_item_data ) { if ( ! is_array( $menu_item_data ) ) { return $menu_item_data; } if ( ! empty( $menu_item_data['ID'] ) && ! empty( $menu_item_data['menu_item_parent'] ) && (int) $menu_item_data['ID'] === (int) $menu_item_data['menu_item_parent'] ) { $menu_item_data['menu_item_parent'] = 0; } return $menu_item_data; } 