<?php
/**
 * Template part for displaying Footer Widgets area.
 *
 * @package Graceful
 */

?>

<?php

if ( ! is_active_sidebar( 'footer-widgets' ) ) {
	return;
}

?>
<!-- footer-widgets -->
<div class="footer-widgets clear-fix">
	<?php dynamic_sidebar( 'footer-widgets' ); ?>
</div>