<?php
/**
 * Graceful Chic Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Graceful Chic Blog
 */

// ----------------------------------------------------------------------------------
//	Register Front-End Styles And Scripts
// ----------------------------------------------------------------------------------

function graceful_chic_blog_enqueue_child_styles() {
 
    wp_enqueue_style( 'graceful-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'graceful-chic-blog-style', get_stylesheet_directory_uri() . '/style.css', array( 'graceful-style' ), wp_get_theme()->get('Version') );
}
add_action( 'wp_enqueue_scripts', 'graceful_chic_blog_enqueue_child_styles' );


// ----------------------------------------------------------------------------------
//  Register Top Navigation in Customizer
// ----------------------------------------------------------------------------------
function graceful_chic_blog_customize_register( $wp_customize ) {

    $wp_customize->add_panel(
        'layout_settings',
        array(
            'priority'   => 20,
            'capability' => 'edit_theme_options',
            'title'      => __( 'Top Navigaion', 'graceful-chic-blog' ),
        )
    );

    /** Top Navigation */
    // add Top Navigation section
    $wp_customize->add_section( 'graceful_top_navigation' , array(
        'title'      => esc_html__( 'Top Navigation', 'graceful-chic-blog' ),
        'priority'   => 23,
        'capability' => 'edit_theme_options'
    ) );

    // Top Navigation
    $wp_customize->add_setting( 'graceful_chic_blog_options[top_navigation_show]', array(
        'default'    => graceful_chic_blog_options('top_navigation_show'),
        'type'       => 'option',
        'transport'  => 'refresh',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'graceful_sanitize_checkboxes'
    ) );
    $wp_customize->add_control( 'graceful_chic_blog_options[top_navigation_show]', array(
        'label'     => esc_html__( 'Enable Top Navigation', 'graceful-chic-blog' ),
        'section'   => 'graceful_top_navigation',
        'type'      => 'checkbox',
        'priority'  => 1
    ) );

    // Top Navigation Background Color
    $wp_customize->add_setting( 'graceful_chic_blog_options[top_navigation_bg]', array(
        'default'    => graceful_chic_blog_options('top_navigation_bg'),
        'type'       => 'option',
        'transport'  => 'refresh',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graceful_chic_blog_options[top_navigation_bg]', array(
        'label'     => esc_html__( 'Top Navigation Background Color', 'graceful-chic-blog' ),
        'section'   => 'graceful_top_navigation',
        'priority'  => 3
    ) ) );

    $wp_customize->add_setting( 'graceful_chic_blog_options[main_navigation_bg]', array(
        'default'    => graceful_chic_blog_options('main_navigation_bg'),
        'type'       => 'option',
        'transport'  => 'refresh',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graceful_chic_blog_options[main_navigation_bg]', array(
        'label'     => esc_html__( 'Main Navigation Background Color', 'graceful-chic-blog' ),
        'section'   => 'graceful_main_navigation',
        'priority'  => 15
    ) ) );

    // Top Navigation Text Color
    $wp_customize->add_setting( 'graceful_chic_blog_options[top_navigation_text_color]', array(
        'default'    => graceful_chic_blog_options('top_navigation_text_color'),
        'type'       => 'option',
        'transport'  => 'refresh',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'graceful_chic_blog_options[top_navigation_text_color]', array(
        'label'     => esc_html__( 'Top Navigation Text Color', 'graceful-chic-blog' ),
        'section'   => 'graceful_top_navigation',
        'priority'  => 5
    ) ) );

}
add_action( 'customize_register', 'graceful_chic_blog_customize_register', 99 );


register_nav_menus(
    array(
        'top'  => esc_html__( 'Top Menu', 'graceful-chic-blog' ),
    )
);

function graceful_top_menu_fallback() {
    if ( current_user_can( 'edit_theme_options' ) ) {
        ?>
        <ul id="top-menu">
            <li>
                <a href="<?php echo esc_url( home_url( '/wp-admin/nav-menus.php') ) ?>">
                    <?php esc_html_e( 'Set-up Top Menu', 'graceful-chic-blog' ) ?>
                </a>
            </li>
        </ul>
        <?php
    }
}

function graceful_chic_blog_options( $controls ) {

    $graceful_chic_blog_defaults = array(
        'top_navigation_show' => false,
        'top_navigation_bg' => '#282828',
        'top_navigation_text_color' => '#ffffff',
        'main_navigation_bg' => '#282828',
        'blog_grid_excerpt_length' => '50',
    );

    // merge defaults and options
    $graceful_chic_blog_defaults = wp_parse_args( get_option( 'graceful_chic_blog_options' ), $graceful_chic_blog_defaults );

    // return control
    return $graceful_chic_blog_defaults[ $controls ];

}


// ----------------------------------------------------------------------------------
//  New Fonts
// ----------------------------------------------------------------------------------
function graceful_chic_blog_enqueue_assets()
{
    // Include the file.
    require_once get_theme_file_path('webfont-loader/wptt-webfont-loader.php');
    // Load the webfont.
    wp_enqueue_style(
        'minimalist-stories-fonts',
        wptt_get_webfont_url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=auto'),
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'graceful_chic_blog_enqueue_assets');