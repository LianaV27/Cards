<?php
/**
 * Themes Customizer Controlled Dynamic Inline Styles
 *
 * @package Graceful
 */

function graceful_inline_dynamic_styles() {

	// Start output buffering
	ob_start();

	// Validate true or false
	function graceful_true_false( $option ) {
		return $option === true;
	}

	// Start of Internal CSS style

/* Layouts and Width
   ========================================================================== */
?>
		.wrapped-content {
			max-width: <?php echo (int)graceful_options( 'basic_site_width' ) ?>px;
		}
	<?php
	
	// Sidebar Width
	?>
		.sidebar-slide-menu {
			width: <?php echo ( (int)graceful_options( 'basic_sidebar_width' ) + 70 ) ?>px;
			left: -<?php echo ( (int)graceful_options( 'basic_sidebar_width' ) + 70 ) ?>px; 
			padding: 85px 35px 0px;
		}

		.sidebar-left, .sidebar-right {
			width: <?php echo ( (int)graceful_options( 'basic_sidebar_width' ) + (int)graceful_options( 'post_page_gutter_horz' ) ) ?>px;
		}

		[data-layout*="rightsidebar"] .content-wrap, [data-layout*="leftsidebar"] .content-wrap {
			width: calc(100% - <?php echo ( (int)graceful_options( 'basic_sidebar_width' ) + (int)graceful_options( 'post_page_gutter_horz' ) ) ?>px);
			width: -webkit-calc(100% - <?php echo ( (int)graceful_options( 'basic_sidebar_width' ) + (int)graceful_options( 'post_page_gutter_horz' ) ) ?>px);
		}

		[data-layout*="leftrightsidebar"] .content-wrap {
			width: calc(100% - <?php echo ( ( (int)graceful_options( 'basic_sidebar_width' ) + (int)graceful_options( 'post_page_gutter_horz' ) ) * 2 ) ?>px);
			width: -webkit-calc(100% - <?php echo ( ( (int)graceful_options( 'basic_sidebar_width' ) + (int)graceful_options( 'post_page_gutter_horz' ) ) * 2 ) ?>px);
		}

		[data-layout*="fullwidth"] .content-wrap {
			width: 100%;
		}


	<?php

	// Padding
	?>
	#top-navigation > div, #main-navigation > div, #graceful-post-slider.wrapped-content, #special-links, .main-content, .site-footer-wrap {
		padding-left: <?php echo (int)graceful_options( 'basic_content_padding' ); ?>px;
		padding-right: <?php echo (int)graceful_options( 'basic_content_padding' ); ?>px;
	}
	<?php


/* Colors
   ========================================================================== */

	if ( ! get_theme_mod( 'background_color' ) ) {
		?>
			body {
				background-color: #ffffff;
			}
	<?php
	}

	// Site Loading Animation Background
	?>
		.graceful-loading-wrap {
			background-color: <?php echo esc_html( graceful_options( 'color_loading_bg' ) ) ?>;
		}
	<?php

	// Header Text Background Color
	if ( graceful_options( 'color_show_header_text_bg' ) ) {
		?>
			.site-branding a {
			    background-color: <?php echo esc_html( graceful_options( 'color_header_text_bg' ) ) ?>;
			}
		<?php 
	} else {
		?>
			.site-branding a {
			    background-color: transparent !important;
			}
		<?php 
	}

	// Site Header
	$graceful_header_text_color = get_header_textcolor();
	?>
		.site-branding a {
			color: #<?php echo esc_html( $graceful_header_text_color ) ?>;
			background: <?php echo esc_html( graceful_options( 'color_header_text_bg' ) ) ?>;
		}

		.entry-header {
			background-color: <?php echo esc_html( graceful_options( 'color_header_bg' ) ) ?>;
		}
	<?php
	
	// Navigation
	?>

		#special-links h4 {
			background-color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_main_navigation_bg' ), 0.85 ) ) ?>;
			color: <?php echo esc_html( graceful_options( 'color_main_navigation_link' ) ) ?>;
		}

		#main-navigation a, #main-navigation i, #main-navigation #s {
			color: <?php echo esc_html( graceful_options( 'color_main_navigation_link' ) ) ?>;
		}

		.main-navigation-sidebar span, .sidebar-slide-menu-close-btn span {
			background-color: <?php echo esc_html( graceful_options( 'color_main_navigation_link' ) ) ?>;
		}

		#main-navigation a:hover, #main-navigation i:hover, #main-navigation li.current-menu-item > a, #main-navigation li.current-menu-ancestor > a, #main-navigation .sub-menu li.current-menu-item > a, #main-navigation .sub-menu li.current-menu-ancestor> a {
			color: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}

		.main-navigation-sidebar:hover span {
			background-color: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}

		#site-menu .sub-menu, #site-menu .sub-menu a {
			background-color: <?php echo esc_html( graceful_options( 'color_main_navigation_bg' ) ) ?>;
			border-color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_main_navigation_link' ), 0.1 ) ) ?>;
		}

		#main-navigation #s {
			background-color: <?php echo esc_html( graceful_options( 'color_main_navigation_bg' ) ) ?>;
		}

		#main-navigation #s::-webkit-input-placeholder { /* Chrome/Opera/Safari */
			color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_main_navigation_link' ), 0.7 ) ) ?>;
		}
		#main-navigation #s::-moz-placeholder { /* Firefox 19+ */
			color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_main_navigation_link' ), 0.7 ) ) ?>;
		}
		#main-navigation #s:-ms-input-placeholder { /* IE 10+ */
			color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_main_navigation_link' ), 0.7 ) ) ?>;
		}
		#main-navigation #s:-moz-placeholder { /* Firefox 18- */
			color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_main_navigation_link' ), 0.7 ) ) ?>;
		}
	<?php

	// Content
	?>
		/* Background Color */
		.sidebar-slide-menu, #special-links, .main-content, #graceful-post-slider, #primary select, #primary input, #primary textarea {
			background-color: <?php echo esc_html( graceful_options( 'color_content_bg' ) ) ?>;
		}

		/* Text Color */
		#primary, #primary select, #primary input, #primary textarea, #primary .post-author a, #primary .graceful-widget a, #primary .comment-author {
			color: <?php echo esc_html( graceful_options( 'color_content_text' ) ) ?>;
		}

		/* Title Color */
		#primary h1 a, #primary h1, #primary h2, #primary h3, #primary h4, #primary h5, #primary h6, .post-page-content > p:first-child:first-letter,
		#primary .author-info h4 a, #primary .related-posts h4 a, #primary .content-pagination .previous-page a, #primary .content-pagination .next-page a, blockquote, #primary .post-share a {
			color: <?php echo esc_html( graceful_options( 'color_content_title' ) ) ?>;
		}

		#primary h1 a:hover {
			color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_content_title' ) , 0.75 ) )?>;
		}
	
		/* Meta Tags */
		#primary .post-date, #primary .post-comments, #primary .post-author, #primary .related-post-date, #primary .comment-meta a, #primary .author-share a, #primary .post-tags a, #primary .tagcloud a, .widget_categories li, .widget_archive li, .ahse-subscribe-box p, .rpwwt-post-author, .rpwwt-post-categories, .rpwwt-post-date, .rpwwt-post-comments-number {
			color: <?php echo esc_html( graceful_options( 'color_content_meta' ) ) ?>;
		}

		#primary input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: <?php echo esc_html( graceful_options( 'color_content_meta' ) ) ?>;
		}
		#primary input::-moz-placeholder { /* Firefox 19+ */
		  color: <?php echo esc_html( graceful_options( 'color_content_meta' ) ) ?>;
		}
		#primary input:-ms-input-placeholder { /* IE 10+ */
		  color: <?php echo esc_html( graceful_options( 'color_content_meta' ) ) ?>;
		}
		#primary input:-moz-placeholder { /* Firefox 18- */
		  color: <?php echo esc_html( graceful_options( 'color_content_meta' ) ) ?>;
		}
		
	
		/* Brand Colors */
		aside a, #primary a, .post-categories {
			color: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}
		
		.ps-container > .ps-scrollbar-y-rail > .ps-scrollbar-y {
			background: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}

		#primary a:hover {
			color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_content_accent' ), 0.8 ) ) ?>;
		}

		blockquote {
			border-color: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}


		/* Selection Color */
		::-moz-selection {
			color: #ffffff;
			background: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}
		::selection {
			color: #ffffff;
			background: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}

		/* Border Colors */
		#primary .post-footer, #primary .author-info, #primary .entry-comments, #primary .graceful-widget li, #primary #wp-calendar, #primary #wp-calendar caption, #primary #wp-calendar tbody td, #primary .widget_nav_menu li a, #primary .tagcloud a, #primary select, #primary input, #primary textarea, .widget-title h2:before, .widget-title h2:after, .post-tags a, .gallery-caption, .wp-caption-text, table tr, table th, table td, pre {
			border-color: <?php echo esc_html( graceful_options( 'color_content_border' ) ) ?>;
		}

		/* Related-posts */
		#primary .related-posts {
		   border-bottom: 1px solid;
		   border-top: 1px solid;
		   padding: 27px 0 33px;
		   border-color: <?php echo esc_html( graceful_options( 'color_content_border' ) ) ?>;
		}
		 .related-posts h3 {
		   font-family: 'Montserrat', sans-serif;
		   font-size: 14px;
		   font-weight: 600;
		   letter-spacing: 2px;
		   line-height: 1;
		   margin-bottom: 19px;
		   text-align: center;
		   text-transform: uppercase;
		}
		 .related-posts h4 {
		   margin-top: 8px;
		}
		 .related-posts h4 a {
		   font-size: 18px;
		   letter-spacing: 0.5px;
		}
		 .related-posts section {
		   float: left;
		   margin-right: 23px;
		   width: calc((100% - (2 * 23px)) / 3);
		   width: -webkit-calc((100% - (2 * 23px)) / 3);
		}
		 .related-posts section:last-of-type {
		   margin-right: 0 !important;
		}
		 .related-posts section > a {
		   display: block;
		   height: 130px;
		   overflow: hidden;
		}
		 .related-post-date {
		   font-size: 11px;
		}
		hr {
			background-color: <?php echo esc_html( graceful_options( 'color_content_border' ) ) ?>;
		}

		/* Button Colors */
		.widget_search i, .widget_search #searchsubmit, .post-navigation i, #primary .submit, #primary .content-pagination.numeric a, #primary .content-pagination.load-more a, #primary .graceful-subscribe-box input[type="submit"], #primary .widget_wysija input[type="submit"], #primary .post-password-form input[type="submit"], #primary .wpcf7 [type="submit"] {
			color: <?php echo esc_html( graceful_options( 'color_button_text' ) ) ?>;
			background-color: <?php echo esc_html( graceful_options( 'color_button' ) ) ?>;
		}
		.post-navigation i:hover, #primary .submit:hover, #primary .content-pagination.numeric a:hover, #primary .content-pagination.numeric span, #primary .content-pagination.load-more a:hover, #primary .graceful-subscribe-box input[type="submit"]:hover, #primary .widget_wysija input[type="submit"]:hover, #primary .post-password-form input[type="submit"]:hover, #primary .wpcf7 [type="submit"]:hover {
			color: <?php echo esc_html( graceful_options( 'color_button_hover_text' ) ) ?>;
			background-color: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}


		/* Image Overlay Color */
		.image-overlay, #infinite-scrolling, #primary h4.image-overlay {
			color: <?php echo esc_html( graceful_options( 'color_overlay_text' ) ) ?>;
			background-color: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_overlay' ), 0.3 ) ) ?>;
		}

		.image-overlay a,
		.graceful-post-slider .prev-arrow, .graceful-post-slider .next-arrow, #primary .image-overlay a, #graceful-post-slider .slick-arrow, #graceful-post-slider .slider-dots {
			color: <?php echo esc_html( graceful_options( 'color_overlay_text' ) ) ?>;
		}

		.slide-caption {
			background: <?php echo esc_html( graceful_hex_to_rgba( graceful_options( 'color_overlay_text' ), 0.95 ) ) ?>;
		}

		#graceful-post-slider .slick-active {
			background: <?php echo esc_html( graceful_options( 'color_overlay_text' ) ) ?>;
		}
	<?php

	// Site Footer Color
	?>
		#site-footer, #site-footer select, #site-footer input, #site-footer textarea {
			background-color: <?php echo esc_html( graceful_options( 'color_footer_bg' ) ) ?>;
			color: <?php echo esc_html( graceful_options( 'color_footer_text' ) ) ?>;
		}

		#site-footer, #site-footer a, #site-footer select, #site-footer input, #site-footer textarea {
			color: <?php echo esc_html( graceful_options( 'color_footer_text' ) ) ?>;
		}

		#site-footer #s::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  color: <?php echo esc_html( graceful_options( 'color_footer_text' ) ) ?>;
		}
		#site-footer #s::-moz-placeholder { /* Firefox 19+ */
		  color: <?php echo esc_html( graceful_options( 'color_footer_text' ) ) ?>;
		}
		#site-footer #s:-ms-input-placeholder { /* IE 10+ */
		  color: <?php echo esc_html( graceful_options( 'color_footer_text' ) ) ?>;
		}
		#site-footer #s:-moz-placeholder { /* Firefox 18- */
		  color: <?php echo esc_html( graceful_options( 'color_footer_text' ) ) ?>;
		}

		/* Footer Title Color */
		#site-footer h1, #site-footer h2, #site-footer h3, #site-footer h4, #site-footer h5, #site-footer h6 {
			color: <?php echo esc_html( graceful_options( 'color_footer_title' ) ) ?>;
		}

		#site-footer a:hover {
			color: <?php echo esc_html( graceful_options( 'color_content_accent' ) ) ?>;
		}

		/* Footer Border Color*/
		#site-footer a, #site-footer .graceful-widget li, #site-footer #wp-calendar, #site-footer #wp-calendar caption, #site-footer #wp-calendar tbody td, #site-footer .widget_nav_menu li a, #site-footer select, #site-footer input, #site-footer textarea, #site-footer .widget-title h2:before, #site-footer .widget-title h2:after, .footer-widgets {
			border-color: <?php echo esc_html( graceful_options( 'color_footer_border' ) ) ?>;
		}

		#site-footer hr {
			background-color: <?php echo esc_html( graceful_options( 'color_footer_border' ) ) ?>;
		}
	<?php


/* Site Header
   ========================================================================== */
	// Header Background
	?>
		.entry-header {
			background-image:url(<?php echo esc_url( get_header_image() ) ?>);
		}
	<?php

	// Header Logo
	?>
		.logo-img {
			max-width: <?php echo (int)graceful_options( 'title_tagline_logo_wide' ) ?>px;
		}
	<?php


/* Navigation
   ========================================================================== */	
	
	?>
		#main-navigation {
			text-align: <?php echo esc_html( graceful_options( 'main_navigation_align' ) ) ?>;
		}
	<?php

	if ( graceful_options( 'main_navigation_align' ) === 'center' ) {
		?>
			.main-navigation-sidebar {
			  position: absolute;
			  top: 0px;
			  left: <?php echo esc_html( graceful_options( 'basic_content_padding' ) ) ?>px;
			  z-index: 1;
			}
						
			.main-navigation-search {
			  position: absolute;
			  top: 0px;
			  right: <?php echo esc_html( graceful_options( 'basic_content_padding' ) ) ?>px;
			  z-index: 2;
			}
		<?php
	} else {
		?>
			.main-navigation-sidebar {
			  float: left;
			  margin-right: 15px;
			}
						
			.main-navigation-search {
			 float: right;
			 margin-left: 15px;
			}

			.site-menu-wrapper {
				margin-right: 100px;
			}
		<?php
		if ( graceful_options( 'main_navigation_show_search' ) ) {
			?>
			.main-navigation-sidebar {
			  float: left;
			  margin-right: 15px;
			}
						
			.main-navigation-search {
			 float: right;
			 margin-left: 15px;
			}

			.site-menu-wrapper {
				margin-right: 110px;
			}
		<?php

		} else {
			?>
			.main-navigation-sidebar {
			  float: left;
			  margin-right: 15px;
			}
						
			.main-navigation-search {
			 float: right;
			 margin-left: 15px;
			}

			.site-menu-wrapper {
				margin-right: 80px;
			}

			#main-navigation .navigation-socials {
				right: 40px;
			}
		<?php

		}
	}


/* Post Slider
   ========================================================================== */	

	if ( graceful_options( 'main_navigation_position' ) === 'below' ) {
		?>
			#graceful-post-slider {
			  padding-top: 40px;
			}
		<?php
	}

	if ( graceful_options( 'post_slider_pagination' ) ) {
		?>
			#graceful-post-slider .owl-dots {
			  display: block;
			  padding: 20px 0 0 0;
			}
		<?php
	}

	if ( graceful_options( 'post_slider_navigation' ) ) {
		?>
			#graceful-post-slider .owl-nav button {
			  display: inline-block;
			}
			#graceful-post-slider .owl-nav {
			  background-color: #f3f3f3;
			  height: 80px;
			}
			#graceful-post-slider .owl-stage-outer:after {
				display: block;
			}
		<?php
	}
	


/* Blog Post Page
   ========================================================================== */	

	// Gutter
	?>	
		.content-column > li {
			margin-bottom: <?php echo (int)graceful_options( 'post_page_gutter_vert' ) ?>px;
		}
		[data-layout*="rightsidebar"] .sidebar-right {
			padding-left: <?php echo (int)graceful_options( 'post_page_gutter_horz' ) ?>px;
		}
		[data-layout*="leftsidebar"] .sidebar-left {
			padding-right: <?php echo (int)graceful_options( 'post_page_gutter_horz' ) ?>px;
		}
		[data-layout*="leftrightsidebar"] .sidebar-right {
			padding-left: <?php echo (int)graceful_options( 'post_page_gutter_horz' ) ?>px;
		}
		[data-layout*="leftrightsidebar"] .sidebar-left {
			padding-right: <?php echo (int)graceful_options( 'post_page_gutter_horz' ) ?>px;
		}
	<?php

	// Blog Post Page Dropcaps
	if ( graceful_true_false( graceful_options( 'post_page_show_dropcaps' ) ) && !is_single() && !is_page() ) {
		?>
			.post-page-content > p:first-child:first-letter { 
				font-family: 'Cormorant Garamond', 'Times', serif;
   			font-weight: 500;
				float: left;
				margin: 0px 12px 0 0;
				font-size: 60px;
				line-height: 50px;
				text-align: center;
			}
			@-moz-document url-prefix() {
				.post-page-content > p:first-child:first-letter {
				    margin-top: 10px !important;
				}
			}
		<?php
	}

	// Single Post Page Dropcaps
	if ( graceful_true_false( graceful_options( 'single_post_page_show_dropcaps' ) ) && is_single() ) {
		?>
			.post-page-content > p:first-child:first-letter { 
				font-family: 'Cormorant Garamond', 'Times', serif;
				font-weight: 500;
				float: left;
				margin: 0px 12px 0 0;
				font-size: 60px;
				line-height: 50px;
				text-align: center;
			}
			@-moz-document url-prefix() {
				.post-page-content > p:first-child:first-letter {
				    margin-top: 10px !important;
				}
			}
		<?php
	}



/* Site Footer
   ========================================================================== */	
	// Footer Widget
	if ( graceful_options( 'page_footer_columns' ) === 'three' ) {
		?>
			.footer-widgets > .graceful-widget {
				width: 30%;
				margin-right: 5%;
			}
			.footer-widgets > .graceful-widget:nth-child(3n+3) {
				margin-right: 0;
			}
			.footer-widgets > .graceful-widget:nth-child(3n+4) {
				clear: both;
			}
		<?php
	}

	if ( graceful_options( 'page_footer_columns' ) === 'four' ) {
		?>
			.footer-widgets > .graceful-widget {
				width: 22%;
				margin-right: 4%;
			}
			.footer-widgets > .graceful-widget:nth-child(4n+4) {
				margin-right: 0;
			}
			.footer-widgets > .graceful-widget:nth-child(4n+5) {
				clear: both;
			}
		<?php
	}



	// Footer Align 
	if ( graceful_options( 'page_footer_align' ) === 'center' ) {
		?>
			.footer-bottom-wrap {
				text-align: center;
			}
		<?php
	} elseif ( graceful_options( 'page_footer_align' ) === 'left-right' ) {
		?>
			.footer-copyright {
				float: left;
			}
			.footer-socials {
				float: right;
			}
		<?php
	} elseif ( graceful_options( 'page_footer_align' ) === 'right-left' ) {
		?>
			.footer-copyright {
				float: right;
			}
			.footer-socials {
				float: left;
			}
		<?php
	}



/* Site Loading Animation
  ========================================================================== */	
	$graceful_loading_anim_color = graceful_options( 'color_loading_anim' );
	?>
	.graceful-loading-wrap { height: 100%; left: 0; position: fixed; top: 0; width: 100%; z-index: 100000; }
	.graceful-loading-wrap > div { left: 50%; position: absolute; top: 50%; -webkit-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);	}
	.cssload-container{width:100%;height:36px;text-align:center}.cssload-speeding-wheel{width:36px;height:36px;margin:0 auto;border:2px solid 
		<?php echo esc_attr( $graceful_loading_anim_color) ?>;
	border-radius:50%;border-left-color:transparent;border-right-color:transparent;animation:cssload-spin 575ms infinite linear;-o-animation:cssload-spin 575ms infinite linear;-ms-animation:cssload-spin 575ms infinite linear;-webkit-animation:cssload-spin 575ms infinite linear;-moz-animation:cssload-spin 575ms infinite linear}@keyframes cssload-spin{100%{transform:rotate(360deg);transform:rotate(360deg)}}@-o-keyframes cssload-spin{100%{-o-transform:rotate(360deg);transform:rotate(360deg)}}@-ms-keyframes cssload-spin{100%{-ms-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes cssload-spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes cssload-spin{100%{-moz-transform:rotate(360deg);transform:rotate(360deg)}}
	
	
	<?php
	// End of Internal CSS style
	
	// End output buffering and remove extra whitespaces
	return preg_replace( '/\s+/', ' ', ob_get_clean() );
}