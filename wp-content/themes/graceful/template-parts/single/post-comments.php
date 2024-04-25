<?php
/**
 * Template part for Single Post Comments
 *
 * @package Graceful
 */

// Load the comment template only if comments are open or if there is atleast one comment.
if ( comments_open() || get_comments_number() ) {
    ?>
	<div class="comments-area" id="comments">
        <?php comments_template( '', true ); ?>
    </div>
    <?php
}