( function( $ ) {
    var WidgetoewModalHandler = function( $scope, $ ) {

        var $btn    = $scope.find( '.oew-modal-button a' );

        // Move the modal to the footer
        $( '.oew-modal-wrap' ).appendTo( 'body' );

        $( $btn ).on( 'click', function( e ) {
            e.preventDefault();
            var $target = $( this ).attr( 'href' );

            var innerWidth = $( 'html' ).innerWidth();
            $( 'html' ).css( 'overflow', 'hidden' );
            var hiddenInnerWidth = $( 'html' ).innerWidth();
            $( 'html' ).css( 'margin-right', hiddenInnerWidth - innerWidth );

            // Open the modal
            $( $target ).fadeIn( 500 );
        } );

        $( '.oew-modal-close, .oew-modal-overlay' ).on( 'click', function() {
            $( 'html' ).css( {
                'overflow': '',
                'margin-right': '' 
            } );

            // Close the modal
            $( this ).closest( '.oew-modal-wrap' ).fadeOut( 500 );
        } );

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-modal.default', WidgetoewModalHandler );
    } );
} )( jQuery );