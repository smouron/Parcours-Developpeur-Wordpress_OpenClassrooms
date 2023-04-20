( function( $ ) {
    var WidgetoewCircleProgressHandler = function( $scope, $ ) {

        var $circle = $scope.find( '.oew-circle-progress' );

        $circle.appear( function() {

            $( $circle ).asPieProgress( {
                namespace       : 'pieProgress',
                classes         : {
                    svg     : 'oew-circle-progress-svg',
                    number  : 'oew-circle-progress-number',
                    content : 'oew-circle-progress-content'
                }
            } );

            $( $circle ).asPieProgress( 'start' );

        } );

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-circle-progress.default', WidgetoewCircleProgressHandler );
    } );
} )( jQuery );