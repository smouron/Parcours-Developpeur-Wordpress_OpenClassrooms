( function( $ ) {
    var WidgetoewNavBarHandler = function( $scope, $ ) {

        var $wrap = $scope.find( '.oew-navbar-wrap' ),
            $btn = $scope.find( '.oew-off-canvas-button' );

        if ( $wrap.hasClass( 'oew-has-off-canvas' ) ) {

            // Move the off canvas sidebar to the footer
            $( '.oew-off-canvas-wrap' ).appendTo( 'body' );

            $( $btn ).on( 'click', function( e ) {
                e.preventDefault();
                var $target = $( this ).attr( 'href' );

                // Open the off canvas sidebar
                $( $target ).toggleClass( 'show' );
            } );

            $( '.oew-off-canvas-close, .oew-off-canvas-overlay' ).on( 'click', function() {
                $( this ).closest( '.oew-off-canvas-wrap' ).removeClass( 'show' );
            } );

        }

        if ( $wrap.hasClass( 'oew-is-responsive' ) ) {

            $( '.oew-mobile-button' ).on( 'click', function( e ) {
                e.preventDefault();

                $j( '.oew-navbar-wrap.oew-is-responsive ul.oew-navbar' ).slideToggle( 500 );
                $j( this ).toggleClass( 'opened' );
            } );

        }

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-navbar.default', WidgetoewNavBarHandler );
    } );
} )( jQuery );