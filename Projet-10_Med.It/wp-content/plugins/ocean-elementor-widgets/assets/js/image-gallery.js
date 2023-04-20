( function( $ ) {

	var WidgetoewImageGalleryHandler = function( $scope, $ ) {

        $scope.find( '.oew-image-gallery' ).magnificPopup( {
	        delegate: 'a.oew-gallery-item-inner',
	        type: 'image',
	        mainClass: 'mfp-fade',
	        gallery: {
	            enabled: true,
	        },
	    } );

	    // Make sure scripts are loaded
        if ( $( 'body' ).hasClass( 'no-isotope' ) || undefined == $.fn.imagesLoaded || undefined == $.fn.isotope ) {
            return;
        }

        var $wrap = $scope.find( '.oew-image-gallery.oew-masonry' );
        
        if ( ! $( 'body' ).hasClass( 'no-isotope' )
        	|| undefined != $.fn.imagesLoaded
        	|| undefined != $.fn.isotope
        	|| $wrap.length != 0 ) {

	        $wrap.each( function() {

	            // Run only once images have been loaded
	            $wrap.imagesLoaded( function() {

	                // Create the isotope layout
	                $wrap.isotope( {
	                    itemSelector       : '.isotope-entry',
	                    transformsEnabled  : true,
	                    isOriginLeft       : oceanwpLocalize.isRTL ? false : true,
	                    transitionDuration : '0.0',
	                    layoutMode         : 'masonry'
	                } );

	            } );

	        } );

        }

	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-image-gallery.default', WidgetoewImageGalleryHandler );
	} );
} )( jQuery );