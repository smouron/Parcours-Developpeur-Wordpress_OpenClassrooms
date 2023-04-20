( function( $ ) {

	var WidgetoewToggleHandler = function( $scope ) {

		var $switch = $scope.find( '.oew-switch-container' ).eq(0),
			$label 	= $switch.find( '.oew-switch-label' );

		$label.click( function(e) {

			e.preventDefault();

			var switchOn = $switch.children( '.oew-switch-wrap' ).hasClass( 'oew-switch-on' );

			if (  false === switchOn ) {
				$( this ).closest( '.oew-switch-wrap' ).addClass( 'oew-switch-on' );
				$( this ).closest( '.oew-switch-container' ).find( '.oew-switch-secondary-wrap' ).addClass( 'show' );
				$( this ).closest( '.oew-switch-container' ).find( '.oew-switch-primary-wrap' ).addClass( 'hide' );

				oewProductSlider();

			} else {
				$( this ).closest( '.oew-switch-wrap' ).removeClass( 'oew-switch-on' );
				$( this ).closest( '.oew-switch-container' ).find( '.oew-switch-secondary-wrap' ).removeClass( 'show' );
				$( this ).closest( '.oew-switch-container' ).find( '.oew-switch-primary-wrap' ).removeClass( 'hide' );

				oewProductSlider();
			}

		} )

		// Re-run function
		var oewProductSlider = function() {
			if ( ! $( 'body' ).hasClass( 'no-carousel' )
				&& $scope.find( '.woo-entry-image.product-entry-slider' ).length) {
				setTimeout( function() {
					$scope.find( '.woo-entry-image.product-entry-slider' ).slick( 'unslick' );
					oceanwpInitCarousel();
				}, 200 );
			}
		}

	};

// Make sure we run this code under Elementor
$( window ).on( 'elementor/frontend/init', function() {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-toggle.default', WidgetoewToggleHandler );
} );


} )( jQuery );
