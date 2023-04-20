( function( $ ) {
	var WidgetoewAccordionHandler = function( $scope, $ ) {

		var $accordion 	= $scope.find( '.oew-accordion' ),
			$data 		= $accordion.data( 'settings' );

		if ( $accordion.hasClass( 'oew-has-active-item' ) ) {
			$accordion.find( '.oew-accordion-item:nth-child('+ $data['active_item'] +')' ).addClass( 'oew-active' ).find( '.oew-accordion-content' ).slideDown( 200 );
		}

	    $accordion.find( '.oew-accordion-title' ).on( 'click', function() {
			var $this 	= $( this ),
				$parent =  $this.parent(),
				$next 	=  $this.next();
			
		    if ( 'true' == $data['multiple'] ) {
		    	$parent.toggleClass( 'oew-active' ).find( '.oew-accordion-content' ).slideToggle( 200 );
			} else {
		    	if ( $parent.hasClass( 'oew-active' ) ) {
		    		$parent.removeClass( 'oew-active' )
		    		$next.slideUp( 200 );
		    	} else {
			        $parent.parent().find( '.oew-accordion-item' ).removeClass( 'oew-active' );
			        $parent.parent().find( '.oew-accordion-content' ).slideUp( 200 );

		    		$parent.toggleClass( 'oew-active' );
		    		$next.slideToggle( 200 );
		    	}
			}

		} );
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-accordion.default', WidgetoewAccordionHandler );
	} );
} )( jQuery );