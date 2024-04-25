
// customize_controls js

(function( $ ) {
	wp.customize.bind( 'ready', function() {
		
		// Show Categories only when 'by Post Category' is selected in Post Slider customizer option
	    var $select = $('#customize-control-graceful_options-post_slider_display select');
	    var $children = $('#customize-control-graceful_options-post_slider_category');

	    function toggleChildrenVisibility() {
	        $children.toggle($select.val() === 'category');
	    }

	    $select.on('change', toggleChildrenVisibility);
	    toggleChildrenVisibility(); // Initial check on page load
	
	}); 

})( jQuery );
