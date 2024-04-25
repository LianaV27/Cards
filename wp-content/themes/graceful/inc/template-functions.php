<?php
/**
 * Template Functions
 *
 * @package Graceful
 */


/*
** Page Layouts
*/
if ( ! function_exists( 'graceful_page_layout' ) ) :

		// Show Left and right sidebars if enabled in theme options.
		function graceful_page_layout() {
			
		    // Exit if the template is full width or blank
		    if ( is_page_template( 'templates/template-full-width.php' ) || is_page_template( 'templates/template-full-width-blank.php' ) ) {
		        return;
		    }

		    $has_left_sidebar  = graceful_options( 'basic_show_left_sidebar' );
		    $has_right_sidebar = graceful_options( 'basic_show_right_sidebar' );

		    if ( $has_left_sidebar && $has_right_sidebar ) {
		        // Both sidebars
		        return 'col1-leftrightsidebar';
		    } elseif ( $has_left_sidebar ) {
		        // Only left sidebar
		        return 'col1-leftsidebar';
		    } elseif ( $has_right_sidebar ) {
		        // Only right sidebar
		        return 'col1-rightsidebar';
		    }
		}

endif; // function_exists('graceful_page_layout')


/*
** Convert a Hexadecimal color to RGBA format.
*/
if ( ! function_exists( 'graceful_hex_to_rgba' ) ) :

	function graceful_hex_to_rgba($color, $opacity = 1) {
	  // Remove '#' from the string
	  $color = ltrim($color, '#');

	  // Split the color into individual components
	  $hex_components = str_split($color, 2);

	  // Convert HEX to RGB
	  $rgb = array_map('hexdec', $hex_components);

	  // Check if opacity value is within valid range
	  $opacity = max(0, min(1, $opacity));

	  // Convert RGB to RGBA
	  $rgba_output = 'rgba(' . implode(',', $rgb) . ', ' . $opacity . ')';

	  return $rgba_output;
}

endif; // function_exists('graceful_hex_to_rgba')


/*
** Custom Excerpts Length
*/
function graceful_excerpt_length( $link ) {

	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>', esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: ame of the current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'graceful' ), get_the_title( get_the_ID() ) )
	);

	return 3000;
}
add_filter( 'excerpt_length', 'graceful_excerpt_length', 999 );

function graceful_new_excerpt( $link ) {

	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>', esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of the current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'graceful' ), esc_html( get_the_title( get_the_ID() ) ) )
	);

	return '...';
}
add_filter( 'excerpt_more', 'graceful_new_excerpt' );

if ( ! function_exists( 'graceful_excerpt' ) ) :

	function graceful_excerpt( $limit = 50 ) {
	    echo '<p>'. esc_html( wp_trim_words( get_the_excerpt(), $limit) ) .'</p>';
	}

endif;


/*
** Related Posts Section
*/
if ( ! function_exists( 'graceful_related_posts' ) ) :
	
	function graceful_related_posts( $title, $orderby ) {
		global $post;

		$current_categories = get_the_category();

		if ( $current_categories ) {
			$first_category = $current_categories[0]->term_id;

			$args = array(
				'post_type' => 'post',
				'post__not_in' => array( $post->ID ),
				'orderby' => $orderby === 'random' ? 'rand' : 'date',
				'posts_per_page' => 3,
				'ignore_sticky_posts' => 1,
				'category__in' => array( $first_category ),
				'meta_query' => array(
					array(
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS',
					),
				),
			);

			$similar_posts = new WP_Query( $args );

			if ( $similar_posts->have_posts() ) {
				?>
				<div class="related-posts">
					<h3><?php echo esc_html( $title ); ?></h3>
					<?php
					while ( $similar_posts->have_posts() ) {
						$similar_posts->the_post();
						if ( has_post_thumbnail() ) {
							?>
							<section>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('graceful-column-thumbnail'); ?></a>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<span class="related-post-date"><?php echo esc_html( get_the_time( get_option( 'date_format' ) ) ); ?></span>
							</section>
							<?php
						}
					}
					?>
					<div class="clear-fix"></div>
				</div>
				<?php
			}

			wp_reset_postdata();
		}
	}
endif; // function_exists( 'graceful_related_posts' )

// Move Comments Form Field
function graceful_move_comment_form_fields( $fields ) {

	// unset/set
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter( 'comment_form_fields', 'graceful_move_comment_form_fields' );

/*
** Comment Form Section
*/

if ( ! function_exists( 'graceful_comments' ) ) :

	function graceful_comments( $comment, $args, $depth ) {

		if ( get_comment_type() == 'pingback' || get_comment_type() == 'trackback' ) : 
			?>
			
		<li class="pingback" id="comment-<?php comment_ID(); ?>">
			<article <?php comment_class('entry-comments'); ?> >
				<div class="comment-content">
					<h3 class="comment-author bypostauthor"><?php esc_html_e( 'Pingback:', 'graceful' ); ?></h3>	
					<div class="comment-meta">		
						<a class="comment-date" href="<?php echo esc_url( get_comment_link() ); ?> ">
							<?php comment_date( get_option( 'date_format' ) ); esc_html_e( '&nbsp;at&nbsp;', 'graceful' );
							comment_time( get_option( 'time_format' ) ); ?></a>
						<?php edit_comment_link( esc_html__( '[Edit]', 'graceful' ) ); ?>
						<div class="clear-fix"></div>
					</div>
					<div class="comment-text">			
						<?php comment_author_link(); ?>
					</div>
				</div>
			</article>

		<?php elseif ( get_comment_type() == 'comment' ) : ?>

		<li id="comment-<?php comment_ID(); ?>">
			
			<article <?php comment_class( 'entry-comments' ); ?> >					
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 75 ); ?>
				</div>
				<div class="comment-content">
					<h3 class="comment-author"><?php comment_author_link(); ?></h3>
					<div class="comment-meta">		
						<a class="comment-date" href="<?php echo esc_url( get_comment_link() ); ?>">
							<?php comment_date( get_option( 'date_format' ) ); esc_html_e( '&nbsp;at&nbsp;', 'graceful' ); 
							comment_time( get_option( 'time_format') ); ?></a>

							<?php
							edit_comment_link( esc_html__( '[Edit]', 'graceful' ) );
							comment_reply_link(
								array_merge(
									$args,
									array(
										'depth'      => $depth,
										'max_depth'  => $args['max_depth'],
									)
								)
							);
							?>
						
						<div class="clear-fix"></div>
					</div>

					<div class="comment-text">
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<p class="under-moderation"><?php esc_html_e( 'Your comment is under moderation.', 'graceful' ); ?></p>
						<?php endif; ?>
						<?php comment_text(); ?>
					</div>
				</div>
			</article>

		<?php endif;
	}
endif; // function_exists( 'graceful_comments' )


/*
** Social Media Links
*/
if ( ! function_exists( 'graceful_social_media' ) ) :

	function graceful_social_media( $social_class = '' ) {
	    $social_window = ( graceful_options( 'social_media_window' ) ) ? '_blank' : '_self';
	    $social_icons = array(
	        array(
	            'url' => graceful_options( 'social_m_url_1' ),
	            'icon' => graceful_options( 'social_m_icon_1' ),
	        ),
	        array(
	            'url' => graceful_options( 'social_m_url_2' ),
	            'icon' => graceful_options( 'social_m_icon_2' ),
	        ),
	        array(
	            'url' => graceful_options( 'social_m_url_3' ),
	            'icon' => graceful_options( 'social_m_icon_3' ),
	        ),
	        array(
	            'url' => graceful_options( 'social_m_url_4' ),
	            'icon' => graceful_options( 'social_m_icon_4' ),
	        ),
	    );
	    ?>

	    <div class="<?php echo esc_attr( $social_class ); ?>">
	        <?php foreach ( $social_icons as $social_icon ) : ?>
	            <?php if ( ! empty( $social_icon['url'] ) ) : ?>
	                <a href="<?php echo esc_url( $social_icon['url'] ); ?>" target="<?php echo esc_attr( $social_window ); ?>">
	                    <i class="fa fa-<?php echo esc_attr( $social_icon['icon'] ); ?>"></i>
	                </a>
	            <?php endif; ?>
	        <?php endforeach; ?>
	    </div>

    <?php
	} // graceful_social_media() end

endif; // function_exists('graceful_social_media') end


/*
** WooCommerce Functions
*/
function graceful_woocommerce_content_wrapper_start() {
    if ( graceful_options( 'basic_content_width' ) === 'wrapped' ) {
        $graceful_woocommerce_width = 'wrapped-content';
    } else {
        $graceful_woocommerce_width = '';
    }

    ?>
    <div class="main-content clear-fix<?php echo esc_attr( $graceful_woocommerce_width ); ?>">
        <div class="content-wrap">
    <?php
}

add_action( 'woocommerce_before_main_content', 'graceful_woocommerce_content_wrapper_start', 5 );

function graceful_woocommerce_content_wrapper_end() {
    ?>
        </div><!-- .content-wrap -->
    </div><!-- .main-content -->
    <?php
}

add_action( 'woocommerce_after_main_content', 'graceful_woocommerce_content_wrapper_end', 50 );

// Remove Sidebars
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Change product grids column
function graceful_woocommerce_shop_columns() {
    return 3;
}

add_filter( 'loop_shop_columns', 'graceful_woocommerce_shop_columns' );

// Change related product grids columns
function graceful_output_related_products( $args ) {
    $args['posts_per_page'] = 3;
    $args['columns']        = 3;
    return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'graceful_output_related_products' );

// Remove Breadcrumbs
function graceful_remove_woocommerce_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}

add_action( 'init', 'graceful_remove_woocommerce_breadcrumbs' );

// Shop Posts Per Page
function graceful_loop_shop_per_page() {
    return 9;
}

add_filter( 'loop_shop_per_page', 'graceful_loop_shop_per_page', 20 );

// Woocommerce Pagination
function graceful_woocommerce_pagination() {
    get_template_part( 'template-parts/sections/site', 'pagination' );
}

remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_pagination', 'graceful_woocommerce_pagination', 10 );


/*
**  Main Menu Fallback
*/
if ( ! function_exists( 'graceful_site_menu_fallback' ) ) :

	function graceful_site_menu_fallback() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			?>
			<ul id="site-menu">
				<li>
					<a href="<?php echo esc_url( home_url( '/wp-admin/nav-menus.php') ) ?>">
						<?php esc_html_e( 'Set-up Main Menu', 'graceful' ) ?>
					</a>
				</li>
			</ul>
			<?php
		}
	}

endif; // Main Menu Fallback


/**
** Notice after the Theme Activation
*/
if ( ! function_exists( 'graceful_activation_notice' ) ) :

	function graceful_activation_notice() {
	?>
		<div class="notice notice-success is-dismissible">
			<h3><?php esc_html_e( 'Congratulations!', 'graceful' ) ?></h3>
			<strong><?php esc_html_e( 'Graceful Theme ', 'graceful' ) ?></strong>
			<span><?php esc_html_e( 'is now installed and ready to use.', 'graceful' ) ?></span>
			<p><?php esc_html_e( 'Click below to see theme documentation, plugins to install and other details to get started.', 'graceful' ) ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=about-theme' ) ) ?>" class="button button-primary"><?php esc_html_e( 'Get Started with Graceful', 'graceful' ) ?></a></p>
		</div>
	<?php
	}

endif; // Notice Theme Activation