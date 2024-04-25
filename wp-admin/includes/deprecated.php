<?php
 function tinymce_include() { _deprecated_function( __FUNCTION__, '2.1.0', 'wp_editor()' ); wp_tiny_mce(); } function documentation_link() { _deprecated_function( __FUNCTION__, '2.5.0' ); } function wp_shrink_dimensions( $width, $height, $wmax = 128, $hmax = 96 ) { _deprecated_function( __FUNCTION__, '3.0.0', 'wp_constrain_dimensions()' ); return wp_constrain_dimensions( $width, $height, $wmax, $hmax ); } function get_udims( $width, $height ) { _deprecated_function( __FUNCTION__, '3.5.0', 'wp_constrain_dimensions()' ); return wp_constrain_dimensions( $width, $height, 128, 96 ); } function dropdown_categories( $default_category = 0, $category_parent = 0, $popular_ids = array() ) { _deprecated_function( __FUNCTION__, '2.6.0', 'wp_category_checklist()' ); global $post_ID; wp_category_checklist( $post_ID ); } function dropdown_link_categories( $default_link_category = 0 ) { _deprecated_function( __FUNCTION__, '2.6.0', 'wp_link_category_checklist()' ); global $link_id; wp_link_category_checklist( $link_id ); } function get_real_file_to_edit( $file ) { _deprecated_function( __FUNCTION__, '2.9.0' ); return WP_CONTENT_DIR . $file; } function wp_dropdown_cats( $current_cat = 0, $current_parent = 0, $category_parent = 0, $level = 0, $categories = 0 ) { _deprecated_function( __FUNCTION__, '3.0.0', 'wp_dropdown_categories()' ); if (!$categories ) $categories = get_categories( array('hide_empty' => 0) ); if ( $categories ) { foreach ( $categories as $category ) { if ( $current_cat != $category->term_id && $category_parent == $category->parent) { $pad = str_repeat( '&#8211; ', $level ); $category->name = esc_html( $category->name ); echo "\n\t<option value='$category->term_id'"; if ( $current_parent == $category->term_id ) echo " selected='selected'"; echo ">$pad$category->name</option>"; wp_dropdown_cats( $current_cat, $current_parent, $category->term_id, $level +1, $categories ); } } } else { return false; } } function add_option_update_handler( $option_group, $option_name, $sanitize_callback = '' ) { _deprecated_function( __FUNCTION__, '3.0.0', 'register_setting()' ); register_setting( $option_group, $option_name, $sanitize_callback ); } function remove_option_update_handler( $option_group, $option_name, $sanitize_callback = '' ) { _deprecated_function( __FUNCTION__, '3.0.0', 'unregister_setting()' ); unregister_setting( $option_group, $option_name, $sanitize_callback ); } function codepress_get_lang( $filename ) { _deprecated_function( __FUNCTION__, '3.0.0' ); } function codepress_footer_js() { _deprecated_function( __FUNCTION__, '3.0.0' ); } function use_codepress() { _deprecated_function( __FUNCTION__, '3.0.0' ); } function get_author_user_ids() { _deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' ); global $wpdb; if ( !is_multisite() ) $level_key = $wpdb->get_blog_prefix() . 'user_level'; else $level_key = $wpdb->get_blog_prefix() . 'capabilities'; return $wpdb->get_col( $wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value != '0'", $level_key) ); } function get_editable_authors( $user_id ) { _deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' ); global $wpdb; $editable = get_editable_user_ids( $user_id ); if ( !$editable ) { return false; } else { $editable = join(',', $editable); $authors = $wpdb->get_results( "SELECT * FROM $wpdb->users WHERE ID IN ($editable) ORDER BY display_name" ); } return apply_filters('get_editable_authors', $authors); } function get_editable_user_ids( $user_id, $exclude_zeros = true, $post_type = 'post' ) { _deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' ); global $wpdb; if ( ! $user = get_userdata( $user_id ) ) return array(); $post_type_obj = get_post_type_object($post_type); if ( ! $user->has_cap($post_type_obj->cap->edit_others_posts) ) { if ( $user->has_cap($post_type_obj->cap->edit_posts) || ! $exclude_zeros ) return array($user->ID); else return array(); } if ( !is_multisite() ) $level_key = $wpdb->get_blog_prefix() . 'user_level'; else $level_key = $wpdb->get_blog_prefix() . 'capabilities'; $query = $wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s", $level_key); if ( $exclude_zeros ) $query .= " AND meta_value != '0'"; return $wpdb->get_col( $query ); } function get_nonauthor_user_ids() { _deprecated_function( __FUNCTION__, '3.1.0', 'get_users()' ); global $wpdb; if ( !is_multisite() ) $level_key = $wpdb->get_blog_prefix() . 'user_level'; else $level_key = $wpdb->get_blog_prefix() . 'capabilities'; return $wpdb->get_col( $wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key = %s AND meta_value = '0'", $level_key) ); } if ( ! class_exists( 'WP_User_Search', false ) ) : class WP_User_Search { var $results; var $search_term; var $page; var $role; var $raw_page; var $users_per_page = 50; var $first_user; var $last_user; var $query_limit; var $query_orderby; var $query_from; var $query_where; var $total_users_for_query = 0; var $too_many_total_users = false; var $search_errors; var $paging_text; function __construct( $search_term = '', $page = '', $role = '' ) { _deprecated_class( 'WP_User_Search', '3.1.0', 'WP_User_Query' ); $this->search_term = wp_unslash( $search_term ); $this->raw_page = ( '' == $page ) ? false : (int) $page; $this->page = ( '' == $page ) ? 1 : (int) $page; $this->role = $role; $this->prepare_query(); $this->query(); $this->do_paging(); } public function WP_User_Search( $search_term = '', $page = '', $role = '' ) { _deprecated_constructor( 'WP_User_Search', '3.1.0', get_class( $this ) ); self::__construct( $search_term, $page, $role ); } public function prepare_query() { global $wpdb; $this->first_user = ($this->page - 1) * $this->users_per_page; $this->query_limit = $wpdb->prepare(" LIMIT %d, %d", $this->first_user, $this->users_per_page); $this->query_orderby = ' ORDER BY user_login'; $search_sql = ''; if ( $this->search_term ) { $searches = array(); $search_sql = 'AND ('; foreach ( array('user_login', 'user_nicename', 'user_email', 'user_url', 'display_name') as $col ) $searches[] = $wpdb->prepare( $col . ' LIKE %s', '%' . like_escape($this->search_term) . '%' ); $search_sql .= implode(' OR ', $searches); $search_sql .= ')'; } $this->query_from = " FROM $wpdb->users"; $this->query_where = " WHERE 1=1 $search_sql"; if ( $this->role ) { $this->query_from .= " INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id"; $this->query_where .= $wpdb->prepare(" AND $wpdb->usermeta.meta_key = '{$wpdb->prefix}capabilities' AND $wpdb->usermeta.meta_value LIKE %s", '%' . $this->role . '%'); } elseif ( is_multisite() ) { $level_key = $wpdb->prefix . 'capabilities'; $this->query_from .= ", $wpdb->usermeta"; $this->query_where .= " AND $wpdb->users.ID = $wpdb->usermeta.user_id AND meta_key = '{$level_key}'"; } do_action_ref_array( 'pre_user_search', array( &$this ) ); } public function query() { global $wpdb; $this->results = $wpdb->get_col("SELECT DISTINCT($wpdb->users.ID)" . $this->query_from . $this->query_where . $this->query_orderby . $this->query_limit); if ( $this->results ) $this->total_users_for_query = $wpdb->get_var("SELECT COUNT(DISTINCT($wpdb->users.ID))" . $this->query_from . $this->query_where); else $this->search_errors = new WP_Error('no_matching_users_found', __('No users found.')); } function prepare_vars_for_template_usage() {} public function do_paging() { if ( $this->total_users_for_query > $this->users_per_page ) { $args = array(); if ( ! empty($this->search_term) ) $args['usersearch'] = urlencode($this->search_term); if ( ! empty($this->role) ) $args['role'] = urlencode($this->role); $this->paging_text = paginate_links( array( 'total' => ceil($this->total_users_for_query / $this->users_per_page), 'current' => $this->page, 'base' => 'users.php?%_%', 'format' => 'userspage=%#%', 'add_args' => $args ) ); if ( $this->paging_text ) { $this->paging_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %1$s&#8211;%2$s of %3$s' ) . '</span>%s', number_format_i18n( ( $this->page - 1 ) * $this->users_per_page + 1 ), number_format_i18n( min( $this->page * $this->users_per_page, $this->total_users_for_query ) ), number_format_i18n( $this->total_users_for_query ), $this->paging_text ); } } } public function get_results() { return (array) $this->results; } function page_links() { echo $this->paging_text; } function results_are_paged() { if ( $this->paging_text ) return true; return false; } function is_search() { if ( $this->search_term ) return true; return false; } } endif; function get_others_unpublished_posts( $user_id, $type = 'any' ) { _deprecated_function( __FUNCTION__, '3.1.0' ); global $wpdb; $editable = get_editable_user_ids( $user_id ); if ( in_array($type, array('draft', 'pending')) ) $type_sql = " post_status = '$type' "; else $type_sql = " ( post_status = 'draft' OR post_status = 'pending' ) "; $dir = ( 'pending' == $type ) ? 'ASC' : 'DESC'; if ( !$editable ) { $other_unpubs = ''; } else { $editable = join(',', $editable); $other_unpubs = $wpdb->get_results( $wpdb->prepare("SELECT ID, post_title, post_author FROM $wpdb->posts WHERE post_type = 'post' AND $type_sql AND post_author IN ($editable) AND post_author != %d ORDER BY post_modified $dir", $user_id) ); } return apply_filters('get_others_drafts', $other_unpubs); } function get_others_drafts($user_id) { _deprecated_function( __FUNCTION__, '3.1.0' ); return get_others_unpublished_posts($user_id, 'draft'); } function get_others_pending($user_id) { _deprecated_function( __FUNCTION__, '3.1.0' ); return get_others_unpublished_posts($user_id, 'pending'); } function wp_dashboard_quick_press_output() { _deprecated_function( __FUNCTION__, '3.2.0', 'wp_dashboard_quick_press()' ); wp_dashboard_quick_press(); } function wp_tiny_mce( $teeny = false, $settings = false ) { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' ); static $num = 1; if ( ! class_exists( '_WP_Editors', false ) ) require_once ABSPATH . WPINC . '/class-wp-editor.php'; $editor_id = 'content' . $num++; $set = array( 'teeny' => $teeny, 'tinymce' => $settings ? $settings : true, 'quicktags' => false ); $set = _WP_Editors::parse_settings($editor_id, $set); _WP_Editors::editor_settings($editor_id, $set); } function wp_preload_dialogs() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' ); } function wp_print_editor_js() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' ); } function wp_quicktags() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_editor()' ); } function screen_layout( $screen ) { _deprecated_function( __FUNCTION__, '3.3.0', '$current_screen->render_screen_layout()' ); $current_screen = get_current_screen(); if ( ! $current_screen ) return ''; ob_start(); $current_screen->render_screen_layout(); return ob_get_clean(); } function screen_options( $screen ) { _deprecated_function( __FUNCTION__, '3.3.0', '$current_screen->render_per_page_options()' ); $current_screen = get_current_screen(); if ( ! $current_screen ) return ''; ob_start(); $current_screen->render_per_page_options(); return ob_get_clean(); } function screen_meta( $screen ) { $current_screen = get_current_screen(); $current_screen->render_screen_meta(); } function favorite_actions() { _deprecated_function( __FUNCTION__, '3.2.0', 'WP_Admin_Bar' ); } function media_upload_image() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' ); return wp_media_upload_handler(); } function media_upload_audio() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' ); return wp_media_upload_handler(); } function media_upload_video() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' ); return wp_media_upload_handler(); } function media_upload_file() { _deprecated_function( __FUNCTION__, '3.3.0', 'wp_media_upload_handler()' ); return wp_media_upload_handler(); } function type_url_form_image() { _deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('image')" ); return wp_media_insert_url_form( 'image' ); } function type_url_form_audio() { _deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('audio')" ); return wp_media_insert_url_form( 'audio' ); } function type_url_form_video() { _deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('video')" ); return wp_media_insert_url_form( 'video' ); } function type_url_form_file() { _deprecated_function( __FUNCTION__, '3.3.0', "wp_media_insert_url_form('file')" ); return wp_media_insert_url_form( 'file' ); } function add_contextual_help( $screen, $help ) { _deprecated_function( __FUNCTION__, '3.3.0', 'get_current_screen()->add_help_tab()' ); if ( is_string( $screen ) ) $screen = convert_to_screen( $screen ); WP_Screen::add_old_compat_help( $screen, $help ); } function get_allowed_themes() { _deprecated_function( __FUNCTION__, '3.4.0', "wp_get_themes( array( 'allowed' => true ) )" ); $themes = wp_get_themes( array( 'allowed' => true ) ); $wp_themes = array(); foreach ( $themes as $theme ) { $wp_themes[ $theme->get('Name') ] = $theme; } return $wp_themes; } function get_broken_themes() { _deprecated_function( __FUNCTION__, '3.4.0', "wp_get_themes( array( 'errors' => true )" ); $themes = wp_get_themes( array( 'errors' => true ) ); $broken = array(); foreach ( $themes as $theme ) { $name = $theme->get('Name'); $broken[ $name ] = array( 'Name' => $name, 'Title' => $name, 'Description' => $theme->errors()->get_error_message(), ); } return $broken; } function current_theme_info() { _deprecated_function( __FUNCTION__, '3.4.0', 'wp_get_theme()' ); return wp_get_theme(); } function _insert_into_post_button( $type ) { _deprecated_function( __FUNCTION__, '3.5.0' ); } function _media_button($title, $icon, $type, $id) { _deprecated_function( __FUNCTION__, '3.5.0' ); } function get_post_to_edit( $id ) { _deprecated_function( __FUNCTION__, '3.5.0', 'get_post()' ); return get_post( $id, OBJECT, 'edit' ); } function get_default_page_to_edit() { _deprecated_function( __FUNCTION__, '3.5.0', "get_default_post_to_edit( 'page' )" ); $page = get_default_post_to_edit(); $page->post_type = 'page'; return $page; } function wp_create_thumbnail( $file, $max_side, $deprecated = '' ) { _deprecated_function( __FUNCTION__, '3.5.0', 'image_resize()' ); return apply_filters( 'wp_create_thumbnail', image_resize( $file, $max_side, $max_side ) ); } function wp_nav_menu_locations_meta_box() { _deprecated_function( __FUNCTION__, '3.6.0' ); } function wp_update_core($current, $feedback = '') { _deprecated_function( __FUNCTION__, '3.7.0', 'new Core_Upgrader();' ); if ( !empty($feedback) ) add_filter('update_feedback', $feedback); require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; $upgrader = new Core_Upgrader(); return $upgrader->upgrade($current); } function wp_update_plugin($plugin, $feedback = '') { _deprecated_function( __FUNCTION__, '3.7.0', 'new Plugin_Upgrader();' ); if ( !empty($feedback) ) add_filter('update_feedback', $feedback); require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; $upgrader = new Plugin_Upgrader(); return $upgrader->upgrade($plugin); } function wp_update_theme($theme, $feedback = '') { _deprecated_function( __FUNCTION__, '3.7.0', 'new Theme_Upgrader();' ); if ( !empty($feedback) ) add_filter('update_feedback', $feedback); require ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; $upgrader = new Theme_Upgrader(); return $upgrader->upgrade($theme); } function the_attachment_links( $id = false ) { _deprecated_function( __FUNCTION__, '3.7.0' ); } function screen_icon() { _deprecated_function( __FUNCTION__, '3.8.0' ); echo get_screen_icon(); } function get_screen_icon() { _deprecated_function( __FUNCTION__, '3.8.0' ); return '<!-- Screen icons are no longer used as of WordPress 3.8. -->'; } function wp_dashboard_incoming_links_output() {} function wp_dashboard_secondary_output() {} function wp_dashboard_incoming_links() {} function wp_dashboard_incoming_links_control() {} function wp_dashboard_plugins() {} function wp_dashboard_primary_control() {} function wp_dashboard_recent_comments_control() {} function wp_dashboard_secondary() {} function wp_dashboard_secondary_control() {} function wp_dashboard_plugins_output( $rss, $args = array() ) { _deprecated_function( __FUNCTION__, '4.8.0' ); $popular = fetch_feed( $args['url']['popular'] ); if ( false === $plugin_slugs = get_transient( 'plugin_slugs' ) ) { $plugin_slugs = array_keys( get_plugins() ); set_transient( 'plugin_slugs', $plugin_slugs, DAY_IN_SECONDS ); } echo '<ul>'; foreach ( array( $popular ) as $feed ) { if ( is_wp_error( $feed ) || ! $feed->get_item_quantity() ) continue; $items = $feed->get_items(0, 5); while ( true ) { if ( 0 === count($items) ) continue 2; $item_key = array_rand($items); $item = $items[$item_key]; list($link, $frag) = explode( '#', $item->get_link() ); $link = esc_url($link); if ( preg_match( '|/([^/]+?)/?$|', $link, $matches ) ) $slug = $matches[1]; else { unset( $items[$item_key] ); continue; } reset( $plugin_slugs ); foreach ( $plugin_slugs as $plugin_slug ) { if ( str_starts_with( $plugin_slug, $slug ) ) { unset( $items[$item_key] ); continue 2; } } break; } while ( ( null !== $item_key = array_rand($items) ) && str_contains( $items[$item_key]->get_description(), 'Plugin Name:' ) ) unset($items[$item_key]); if ( !isset($items[$item_key]) ) continue; $raw_title = $item->get_title(); $ilink = wp_nonce_url('plugin-install.php?tab=plugin-information&plugin=' . $slug, 'install-plugin_' . $slug) . '&amp;TB_iframe=true&amp;width=600&amp;height=800'; echo '<li class="dashboard-news-plugin"><span>' . __( 'Popular Plugin' ) . ':</span> ' . esc_html( $raw_title ) . '&nbsp;<a href="' . $ilink . '" class="thickbox open-plugin-details-modal" aria-label="' . esc_attr( sprintf( _x( 'Install %s', 'plugin' ), $raw_title ) ) . '">(' . __( 'Install' ) . ')</a></li>'; $feed->__destruct(); unset( $feed ); } echo '</ul>'; } function _relocate_children( $old_ID, $new_ID ) { _deprecated_function( __FUNCTION__, '3.9.0' ); } function add_object_page( $page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '') { _deprecated_function( __FUNCTION__, '4.5.0', 'add_menu_page()' ); global $_wp_last_object_menu; $_wp_last_object_menu++; return add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $_wp_last_object_menu); } function add_utility_page( $page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '') { _deprecated_function( __FUNCTION__, '4.5.0', 'add_menu_page()' ); global $_wp_last_utility_menu; $_wp_last_utility_menu++; return add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_url, $_wp_last_utility_menu); } function post_form_autocomplete_off() { global $is_safari, $is_chrome; _deprecated_function( __FUNCTION__, '4.6.0' ); if ( $is_safari || $is_chrome ) { echo ' autocomplete="off"'; } } function options_permalink_add_js() { ?>
	<script type="text/javascript">
		jQuery( function() {
			jQuery('.permalink-structure input:radio').change(function() {
				if ( 'custom' == this.value )
					return;
				jQuery('#permalink_structure').val( this.value );
			});
			jQuery( '#permalink_structure' ).on( 'click input', function() {
				jQuery( '#custom_selection' ).prop( 'checked', true );
			});
		} );
	</script>
	<?php
} class WP_Privacy_Data_Export_Requests_Table extends WP_Privacy_Data_Export_Requests_List_Table { function __construct( $args ) { _deprecated_function( __CLASS__, '5.3.0', 'WP_Privacy_Data_Export_Requests_List_Table' ); if ( ! isset( $args['screen'] ) || $args['screen'] === 'export_personal_data' ) { $args['screen'] = 'export-personal-data'; } parent::__construct( $args ); } } class WP_Privacy_Data_Removal_Requests_Table extends WP_Privacy_Data_Removal_Requests_List_Table { function __construct( $args ) { _deprecated_function( __CLASS__, '5.3.0', 'WP_Privacy_Data_Removal_Requests_List_Table' ); if ( ! isset( $args['screen'] ) || $args['screen'] === 'remove_personal_data' ) { $args['screen'] = 'erase-personal-data'; } parent::__construct( $args ); } } function _wp_privacy_requests_screen_options() { _deprecated_function( __FUNCTION__, '5.3.0' ); } function image_attachment_fields_to_save( $post, $attachment ) { _deprecated_function( __FUNCTION__, '6.0.0' ); return $post; } 