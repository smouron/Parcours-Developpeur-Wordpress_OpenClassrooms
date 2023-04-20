( function( $ ) {
    var WidgetoewInstagramHandler = function( $scope, $ ) {

        var $wrap = $scope.find( '.oew-instagram-item' );
        if ( $wrap.length === 0 ) {
            return;
        }

        var oewFitImage = function( $this ) {
            var $imageParent = $this.find( '.oew-instagram-image' ),
                $image       = $imageParent.find( 'img' ),
                image        = $image[0];

            if ( ! image ) {
                return;
            }

            var imageParentRatio = $imageParent.outerHeight() / $imageParent.outerWidth(),
                imageRatio       = image.naturalHeight / image.naturalWidth;

            $imageParent.toggleClass( 'oew-fit-height', imageRatio < imageParentRatio );
        };

        $wrap.each( function() {
            var $this   = $( this ),
                $image  = $this.find( '.oew-instagram-image img' );

            oewFitImage( $this );

            $image.on( 'load', function() {
                oewFitImage( $this );
            } );
        } );

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-instagram.default', WidgetoewInstagramHandler );
    } );
} )( jQuery );