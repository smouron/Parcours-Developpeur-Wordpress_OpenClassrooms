( function( $ ) {
	var WidgetoewSearchIconHandler = function( $scope, $ ) {

		var $search = $scope;

		// Drop Down
		if ( $search.find( '.oew-search-icon-dropdown' ).length ) {

			var	$icon 	= $search.find( '.oew-dropdown-link' ),
				$form 	= $search.find( '.oew-search-dropdown' );

			$icon.click( function( event ) {

				// Display search form
				$form.fadeToggle( 'fast' );

				// Active menu item
				$j( this ).parent().toggleClass( 'active' );

				// Focus
				$form.find( 'input.field' ).focus();

				// Return false
				return false;
			} );

			// Close on doc click
			$j( document ).on( 'click', function( event ) {
				if ( ! $j( event.target ).closest( '.oew-search-dropdown' ).length ) {
					$icon.parent().removeClass( 'active' );
					$form.fadeOut( 'fast' );
				}
			} );

		}

		// Overlay
		if ( $search.find( '.oew-search-icon-overlay' ).length ) {

			var $link 		= $search.find( 'a.oew-overlay-link' ),
				$close 		= $search.find( 'a.oew-search-overlay-close' ),
				$overlay 	= $search.find( '.oew-search-overlay' );

			if ( $link.length ) {

				$link.on( 'click', function( e ) {
					e.preventDefault();

					$overlay.addClass( 'active' );
					$overlay.fadeIn( 200 );

		            setTimeout( function() {
						$j( 'html' ).css( 'overflow', 'hidden' );
		            }, 400);

				} );

			}

			$close.on( 'click', function( e ) {
				e.preventDefault();

				$overlay.removeClass( 'active' );
				$overlay.fadeOut( 200 );

		        setTimeout( function() {
					$j( 'html' ).css( 'overflow', 'visible' );
		        }, 400);

			} );

			$link.on( 'click', function() {
				$overlay.find( 'input' ).focus();
			} );

	        // Move the modal to the footer
	        $overlay.appendTo( 'body' );

	        // Add class when the search input is not empty
			$overlay.find( 'form' ).each( function() {

				var form 		= $j( this ),
					listener	= form.find( 'input' ),
					$label 		= form.find( 'label' );

				if ( listener.val().length ) {
					form.addClass( 'search-filled' );
				}

				listener.on( 'keyup blur', function() {
					if ( listener.val().length > 0 ) {
					  form.addClass( 'search-filled' );
					} else {
					  form.removeClass( 'search-filled' );
					}
				} );

		    } );

		}

	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/oew-search-icon.default', WidgetoewSearchIconHandler );
	} );
} )( jQuery );