<?php
/**
 * Template part for displaying Footer Bottom area.
 *
 * @package Graceful
 */

?>

    <div class="footer-bottom-wrap">
        <!-- Scroll To Top -->
        <span class="scrolltop">
            <i class="fa fa fa-angle-up"></i>
        </span>
        
        <div class="footer-copyright">
            <?php
            $graceful_copyright = graceful_options( 'page_footer_copyright' );
            $graceful_copyright = str_replace( '$year', date_i18n( __('Y','graceful') ), $graceful_copyright );
            $graceful_copyright = str_replace( '$copy', '&copy;', $graceful_copyright );
            // some allowed HTML
            echo wp_kses_post( $graceful_copyright );
            ?>
        </div>
        
        <div class="footer-credits">
            <?php esc_html_e( 'Graceful Theme by ', 'graceful' ); ?>
            <a href="<?php echo esc_url( 'http://optimathemes.com/' ); ?>">
                <?php esc_html_e( 'Optima Themes', 'graceful' ); ?>
            </a>
        </div>
    </div>