( function( $ ) {

    var getElementSettings = function( $element ) {
        var elementSettings = {},
            modelCID        = $element.data( 'model-cid' );

        if ( elementorFrontend.isEditMode() && modelCID ) {
            var settings        = elementorFrontend.config.elements.data[ modelCID ],
                settingsKeys    = elementorFrontend.config.elements.keys[ settings.attributes.widgetType || settings.attributes.elType ];

            jQuery.each( settings.getActiveControls(), function( controlKey ) {
                if ( -1 !== settingsKeys.indexOf( controlKey ) ) {
                    elementSettings[ controlKey ] = settings.attributes[ controlKey ];
                }
            } );
        } else {
            elementSettings = $element.data( 'settings' ) || {};
        }

        return elementSettings;
    };

    var WidgetoewHotspotsHandler = function( $scope, $ ) {

        var $wrap = $scope.find( '.oew-hotspot-inner' );

        if ( ! $wrap.hasClass( 'oew-hotspot-tooltip' ) ) {
            return;
        }

        var elementSettings = getElementSettings( $scope ),
            fadeIn          = elementSettings.fade_in_time.size,
            fadeOut         = elementSettings.fade_out_time.size;

        $scope.find( '.oew-tooltip-n' ).powerTip( { placement: 'n', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-e' ).powerTip( { placement: 'e', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-s' ).powerTip( { placement: 's', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-w' ).powerTip( { placement: 'w', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-nw' ).powerTip( { placement: 'nw', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-ne' ).powerTip( { placement: 'ne', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-sw' ).powerTip( { placement: 'sw', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-se' ).powerTip( { placement: 'se', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-nw-alt' ).powerTip( { placement: 'nw-alt', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-ne-alt' ).powerTip( { placement: 'ne-alt', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-sw-alt' ).powerTip( { placement: 'sw-alt', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );
        $scope.find( '.oew-tooltip-se-alt' ).powerTip( { placement: 'se-alt', popupClass: 'oew-hotspot-powertip', fadeInTime: fadeIn, fadeOutTime: fadeOut } );

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-hotspots.default', WidgetoewHotspotsHandler );
    } );
} )( jQuery );