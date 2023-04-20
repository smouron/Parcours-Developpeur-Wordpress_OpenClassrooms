( function( $ ) {
    var WidgetoewCountdownHandler = function( $scope, $ ) {

        var $countdown  = $scope.find( '.oew-countdown-wrap' ),
            $date       = new Date( $countdown.data( 'date' ) * 1000 ),
            $timeInterval,
            $elements    = {
                $daysSpan       : $scope.find( '.oew-countdown-days' ),
                $hoursSpan      : $scope.find( '.oew-countdown-hours' ),
                $minutesSpan    : $scope.find( '.oew-countdown-minutes' ),
                $secondsSpan    : $scope.find( '.oew-countdown-seconds' )
            };

        var getTime = function() {
            var $timeRemaining   = $date - new Date(),
                $seconds         = Math.floor( ( $timeRemaining / 1000 ) % 60 ),
                $minutes         = Math.floor( ( $timeRemaining / 1000 / 60 ) % 60 ),
                $hours           = Math.floor( ( $timeRemaining / ( 1000 * 60 * 60 ) ) % 24 ),
                $days            = Math.floor( $timeRemaining / ( 1000 * 60 * 60 * 24 ) );

            if ( $days < 0 || $hours < 0 || $minutes < 0 ) {
                seconds = $minutes = $hours = $days = 0;
            }

            return {
                total: $timeRemaining,
                parts: {
                    days: $days,
                    hours: $hours,
                    minutes: $minutes,
                    seconds: $seconds
                }
            };
        };

        var updateClock = function() {
            $.each( getTime().parts, function( timePart ) {
                var $element = $elements[ '$' + timePart + 'Span' ],
                    $partValue = this.toString();

                if ( 1 === $partValue.length ) {
                    $partValue = 0 + $partValue;
                }

                if ( $element.length ) {
                    $element.text( $partValue );
                }
            } );

            if ( getTime().total <= 0 ) {
                clearInterval( $timeInterval );
            }
        };

        var initializeClock = function() {
            updateClock();

            $timeInterval = setInterval( updateClock, 1000 );
        };

        initializeClock();

    };
    
    // Make sure we run this code under Elementor
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-countdown.default', WidgetoewCountdownHandler );
    } );
} )( jQuery );