<?php
/**
 * Recent Posts Widget to show post thumbnails
 *
 * @package Graceful
 */

// Class Graceful_Recent_Posts_Widget extends WP_Widget_Recent_Posts
class Graceful_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

    public function widget( $args, $instance ) {
        // Extract variables from $args array
        extract( $args );

        // Get the 'show_date' option from widget instance or set to false
        $graceful_show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        // Get the widget title and apply filters to it
        $graceful_title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base );

        // Get the number of posts to display and set default to 5 if not provided or invalid
        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

        // Query recent posts using WP_Query and apply filters to the arguments
        $graceful_rcnt = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        ) ) );

        // Define allowed HTML tags for widget output
        $graceful_allowed_htm = array(
            'section' => array(
                'class' => array(),
                'id'    => array(),
            ),
            'h2' => array()
        );

        // Output the widget content if there are recent posts
        if ( $graceful_rcnt->have_posts() ) {

            // Start the widget container
            echo wp_kses( $before_widget, $graceful_allowed_htm );

            // Output the widget title
            if ( $graceful_title ) {
                echo wp_kses( $before_title, $graceful_allowed_htm ) . esc_html( $graceful_title ) . wp_kses( $after_title, $graceful_allowed_htm );
            }
            ?>
            <ul>
            <?php while ( $graceful_rcnt->have_posts() ) :
                $graceful_rcnt->the_post();
                ?>
                <li class="graceful-recent-image-box">
                    <div class="graceful-small-image-box" style="background-image: url( '<?php the_post_thumbnail_url( 'graceful-small-thumbnail' ); ?>' );">
                    </div>
                <?php
                			// Display the date if 'show_date' option is enabled
                			if ( $graceful_show_date ) : ?>
                        <span><?php the_time( 'M d, Y' ); ?></span>
								<?php endif; 
								?>
                    		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; 
            ?>
            </ul>
            <?php 
            echo wp_kses( $after_widget, $graceful_allowed_htm );

            // Reset the post data to avoid conflicts with other queries
            wp_reset_postdata();
        }
    }
}

// Function to register the Graceful_Recent_Posts_Widget widget
function graceful_recent_widget_register() {
    unregister_widget( 'WP_Widget_Recent_Posts' );
    register_widget( 'Graceful_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'graceful_recent_widget_register' );