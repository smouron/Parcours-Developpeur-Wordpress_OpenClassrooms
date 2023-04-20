( function( $ ) {

	var WidgetoewImageComparisonHandler = function( $scope, $ ) {

		var image 		= $scope.find( '.oew-image-comparison' ).eq(0),
            settings 	= image.data( 'settings' );
        
        image.twentytwenty( {
            default_offset_pct: 		settings.visible_ratio, 		// How much of the before image is visible when the page loads
		    orientation: 				settings.orientation, 			// Orientation of the before and after images ('horizontal' or 'vertical')
		    before_label: 				settings.before_label, 			// Set a custom before label
		    after_label: 				settings.after_label, 			// Set a custom after label
		    no_overlay: 				settings.no_overlay, 			// Do not show the overlay with before and after
		    move_slider_on_hover: 		settings.slider_on_hover, 		// Move slider on mouse hover?
		    move_with_handle_only: 		settings.slider_with_handle, 	// Allow a user to swipe anywhere on the image to control slider movement. 
		    click_to_move: 				settings.slider_with_click 		// Allow a user to click (or tap) anywhere on the image to move the slider to that location.
        } );

	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-image-comparison.default', WidgetoewImageComparisonHandler );
	} );
} )( jQuery );