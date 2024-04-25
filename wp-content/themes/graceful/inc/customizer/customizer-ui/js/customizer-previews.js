/*
** Instantly update customizer settings in preview for live user-experience.
*/

(function( $ ) {


/*
** Page Header
*/

	gracefulLivePreview( 'title_tagline_logo_wide', function( val ) {
		$('.site-branding a').css( 'max-width', val +'px' );
	});


/*
** Colors
*/

	// Header
	wp.customize('header_textcolor', function(value) {
		value.bind(function(val) {
		$('.site-branding a').css('color', val);
		});
	});

	gracefulLivePreview( 'color_header_bg', function( val ) {
		$('.entry-header').css( 'background-color', val );
	});

	gracefulLivePreview( 'color_header_text_bg', function( val ) {
		$('.site-branding a').css( 'background-color', val );
	});

	// Brand Color
	gracefulLivePreview( 'color_content_accent', function( val ) {
		var selectors = '\
			#primary h1 a,\
			#primary .post-comments,\
			#primary .post-author a,\
			#primary .post-share a,\
		 	#primary .graceful-widget a,\
			#primary .related-posts h4 a,\
			#primary .author-info h4 a,\
			#primary .content-pagination a,\
			#primary .post-date,\
			#primary .post-author,\
			#primary .related-post-date,\
			#primary .comment-meta a,\
			#primary .author-share a,\
			#primary .graceful-slider-title a,\
			#primary .slider-categories a,\
			#primary .graceful-slider-read-more a\
		';

		$( '#primary a' ).not( selectors ).css( 'color', val );

		var css = '\
		.post-categories,\
		#top-navigation a:hover,\
		#top-navigation li.current-menu-item > a,\
		#top-navigation li.current-menu-ancestor > a,\
		#top-navigation .sub-menu li.current-menu-item > a,\
		#top-navigation .sub-menu li.current-menu-ancestor> a,\
		#main-navigation a:hover,\
		#main-navigation i:hover,\
		#main-navigation li.current-menu-item > a,\
		#main-navigation li.current-menu-ancestor > a,\
		#main-navigation .sub-menu li.current-menu-item > a,\
		#main-navigation .sub-menu li.current-menu-ancestor> a,\
		#site-footer a:hover,\
		.woocommerce .star-rating::before,\
		.woocommerce .star-rating span::before,\
		.woocommerce #primary ul.products li.product .button,\
		#primary .woocommerce ul.products li.product .button,\
		#primary .woocommerce-MyAccount-navigation-link.is-active a,\
		#primary .woocommerce-MyAccount-navigation-link a:hover,\
		.woocommerce #primary nav.woocommerce-pagination ul li a.prev:hover,\
		.woocommerce #primary nav.woocommerce-pagination ul li a.next:hover {\
		color: '+ val +' ;\
		}';


		css += '\
		.main-navigation-sidebar:hover span,\
		.ps-container > .ps-scrollbar-y-rail > .ps-scrollbar-y,\
		.post-navigation i:hover,\
		#primary .submit:hover,\
		#primary .content-pagination.numeric a:hover,\
		#primary .content-pagination.numeric span,\
		#primary .content-pagination.load-more a:hover,\
		#primary .graceful-subscribe-box input[type="submit"]:hover,\
		#primary .widget_wysija input[type="submit"]:hover,\
		#primary .post-password-form input[type="submit"]:hover,\
		#primary .wpcf7 [type="submit"]:hover,\
		p.demo_store,\
		.woocommerce-store-notice,\
		.woocommerce span.onsale,\
		#primary .woocommerce input.button:hover,\
		#primary .woocommerce a.button:hover,\
		#primary .woocommerce a.button.alt:hover,\
		#primary .woocommerce button.button.alt:hover,\
		#primary .woocommerce input.button.alt:hover,\
		#primary .woocommerce #respond input#submit.alt:hover,\
		.woocommerce #primary .woocommerce-message .button:hover,\
		.woocommerce #primary a.button.alt:hover,\
		.woocommerce #primary button.button.alt:hover,\
		.woocommerce #primary #respond input#submit:hover,\
		.woocommerce #primary .widget_price_filter .button:hover,\
		.woocommerce #primary .woocommerce-message .button:hover,\
		.woocommerce-page #primary .woocommerce-message .button:hover,\
		.woocommerce #primary nav.woocommerce-pagination ul li a:hover,\
		.woocommerce #primary nav.woocommerce-pagination ul li span.current {\
			background-color: '+ val +';\
		}';

		css += '\
		blockquote {\
			border-color: '+ val +';\
		}';

		css += '\
		::-moz-selection {\
			background: '+ val +';\
		}\
		::selection {\
			background: '+ val +';\
		}';

		css += '\
		#primary a:hover {\
			color: '+ gracefulHex2Rgba( val, 0.8 ) +';\
		}';	

		gracefulStyle( 'color_content_accent', css );
	});


/*
** Custom Functions
*/
	// Previewer
	function gracefulLivePreview( control, func ) {
		wp.customize( 'graceful_options['+ control +']', function( value ) {
			value.bind( function( val ) {
				func( val );
			} );
		} );
	}

	// convert hex color to rgba
	function gracefulHex2Rgba( hex, opacity ) {
		if ( typeof(hex) === 'undefined' ) {
		 return;
		}

		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( hex );
		var rgba = 'rgba( '+ parseInt( result[1], 16 ) +', '+ parseInt( result[2], 16 ) +', '+ parseInt( result[3], 16 ) +', '+ opacity +')';

		// return converted RGB
		return rgba;
	}

	// Style Tag
	function gracefulStyle( id, css ) {
		if ( $( '#'+ id ).length === 0 ) {
			$('head').append('<style id="'+ id +'"></style>')
		}

		$( '#'+ id ).text( css );
	}

	function gracefulStyle(id, css) {
		var styleTag = $( '#' + id );
		if ( styleTag.length === 0 ) {
		styleTag = $('<style>').attr( 'id', id );
		$( 'head' ).append( styleTag );
		}
		styleTag.text( css );
	}

} )( jQuery );
