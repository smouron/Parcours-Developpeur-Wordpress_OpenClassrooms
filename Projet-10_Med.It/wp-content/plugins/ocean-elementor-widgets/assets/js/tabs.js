( function( $ ) {
	var WidgetoewTabsHandler = function( $scope, $ ) {

		var $tabs 	= $scope.find( '.oew-tabs' ),
			$data 	= $tabs.data( 'settings' );

		if ( $tabs.hasClass( 'oew-has-active-item' ) ) {
			$tabs.find( '.oew-tab-title[data-tab="'+ $data['active_item'] +'"]' ).addClass( 'oew-active' );
			$tabs.find( '#oew-tab-content-'+ $data['active_item'] ).addClass( 'oew-active' );
		} else {
			$tabs.find( '.oew-tab-title[data-tab="1"]' ).addClass( 'oew-active' );
			$tabs.find( '#oew-tab-content-1' ).addClass( 'oew-active' );
		}

	    $tabs.find( '.oew-tab-title' ).on( 'click', function() {
			var $this 	= $( this ),
				$tab_id = $this.data( 'tab' );

			// Remove the active classes
			$scope.find( '.oew-tab-title' ).removeClass( 'oew-active' );
			$scope.find( '.oew-tab-content' ).removeClass( 'oew-active' );

			// Add the class in the normal and mobile title
			$scope.find( '.oew-tab-title[data-tab="'+ $tab_id + '"]' ).addClass( 'oew-active' );

			// Display the content
		    $this.parent().parent().find( '#oew-tab-content-' + $tab_id ).addClass( 'oew-active' );

		} );
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-tabs.default', WidgetoewTabsHandler );
	} );
} )( jQuery );