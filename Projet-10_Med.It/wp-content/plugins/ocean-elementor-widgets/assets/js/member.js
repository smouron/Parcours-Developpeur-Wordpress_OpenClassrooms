( function( $ ) {

    var WidgetoewMemberHandler = function( $scope, $ ) {

        var $wrap = $scope.find( '.oew-member-wrap' );

        if ( ! $scope.find( '.oew-member-icon' ).hasClass( 'oew-member-tooltip' ) ) {
            return;
        }

        $scope.find( '.oew-tooltip-n' ).powerTip( { placement: 'n', popupClass: 'oew-member-powertip', fadeInTime: 200, fadeOutTime: 100 } );
        $scope.find( '.oew-tooltip-s' ).powerTip( { placement: 's', popupClass: 'oew-member-powertip', fadeInTime: 200, fadeOutTime: 100 } );

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-member.default', WidgetoewMemberHandler );
    } );
} )( jQuery );