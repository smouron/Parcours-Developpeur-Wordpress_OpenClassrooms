( function( $ ) {
    var WidgetoewOffCanvassHandler = function( $scope, $ ) {

        var $btn = $scope.find( '.oew-off-canvas-button a' );

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

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-off-canvas.default', WidgetoewOffCanvassHandler );
    } );
} )( jQuery );