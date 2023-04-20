( function( $ ) {
	var WidgetoewWooSliderHandler = function( $scope, $ ) {
	    if ( $( 'body' ).hasClass( 'no-carousel' ) ) {
			return;
		}

		var $slider = $scope.find( '.oew-woo-slider' );

		if ( $slider.length > 0 ) {

			var $selector 	= $slider.find( 'ul.products' ),
				$options 	= JSON.parse( $slider.attr('data-settings') );

			$selector.slick( $options );

		}
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-woo-slider.default', WidgetoewWooSliderHandler );
	} );
} )( jQuery );