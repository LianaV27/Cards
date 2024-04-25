<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Graceful
 */

?>

<?php
if ( graceful_options('basic_footer_width') === 'wrapped' ) {
    $graceful_footer_width = 'wrapped-content';
}
else {
    $graceful_footer_width = '';
}
if ( graceful_options('basic_footer_width') === 'contained' ) {
    $graceful_footer_wrap_width = 'wrapped-content';
}
else {
    $graceful_footer_wrap_width = '';
}
?>

		</div><!-- .main-content End -->
		</main><!-- #primary End -->

		<!-- Site Footer -->
		<footer id="site-footer" class="<?php echo esc_attr( $graceful_footer_width ); ?> clear-fix">
			<div class="site-footer-wrap <?php echo esc_attr( $graceful_footer_wrap_width ); ?>">
				<?php 
				if ( graceful_options( 'page_footer_columns' ) !== 'none' ) {
					get_template_part( 'template-parts/footer/footer', 'widget' ); 
				}
				get_template_part( 'template-parts/footer/footer', 'bottom' );
				?>
			</div><!-- .wrapped-content -->
		</footer><!-- #site-footer -->

		<?php
			// Sidebar Slide Menu Section
			get_template_part( 'template-parts/sidebars/sidebar', 'slidemenu' ); 
		?>
		
	</div><!-- #site-container -->

<?php wp_footer(); ?>

</body>
</html>