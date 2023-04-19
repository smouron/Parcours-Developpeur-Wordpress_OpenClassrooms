(function ($) {
    'use strict';

	let OEWLoginForm = function( $scope, settings ) {
		this.node       = $scope;
		this.id			= settings.id;
		this.messages	= settings.messages;
		this.settings 	= settings;

		this._init();
	};

	OEWLoginForm.prototype = {
		settings: {},


		_init: function() {


			if ( this.node.find( '#oew-form-' + this.id ).length > 0 ) {
				this.node.find( '#oew-form-' + this.id ).on( 'submit', $.proxy( this._loginFormSubmit, this ) );
			}

		},


		_loginFormSubmit: function(e) {
			e.preventDefault();

			var theForm 		= $(e.target),
				username 		= theForm.find( 'input[name="log"]' ),
				password 		= theForm.find( 'input[name="pwd"]' ),
				remember 		= theForm.find( 'input[name="rememberme"]' ),
				redirect 		= theForm.find( 'input[name="redirect_to"]' ),
				self 			= this;

			username.parent().find( '.oew-lf-error' ).remove();
			password.parent().find( '.oew-lf-error' ).remove();

			// Validate username.
			if ( '' === username.val().trim() ) {
				$('<span class="oew-lf-error">').insertAfter( username ).html( this.messages.empty_username );
				return;
			}

			// Validate password.
			if ( '' === password.val() ) {
				$('<span class="oew-lf-error">').insertAfter( password ).html( this.messages.empty_password );
				return;
			}

			var formData = new FormData( theForm[0] );

			formData.append( 'action', 'oewe_lf_process_login' );
			formData.append( 'page_url', this.settings.page_url );
			formData.append( 'username', username.val() );
			formData.append( 'password', password.val() );

			if ( redirect.length > 0 && '' !== redirect.val() ) {
				formData.append( 'redirect', redirect.val() );
			}

			if ( remember.length > 0 && remember.is(':checked') ) {
				formData.append( 'remember', '1' );
			}

			this._ajax( formData, function( response ) {
				if ( ! response.success ) {
					theForm.find( '.oew-lf-error' ).remove();
					$('<span class="oew-lf-error">').prependTo( theForm ).html( response.data );
				} else {
					if ( response.data.redirect_url ) {
						var hostUrl = location.protocol + '//' + location.host;
						var redirectUrl = '';

						if ( '' === response.data.redirect_url.split( hostUrl )[0] ) {
							redirectUrl = response.data.redirect_url.split( hostUrl )[1];
						} else {
							redirectUrl = response.data.redirect_url.split( hostUrl )[0];
						}

						if ( redirectUrl === location.href.split( hostUrl )[1] ) {
							window.location.reload();
						} else {
							window.location.href = response.data.redirect_url;
						}
					} else {
						window.location.reload();
					}
				}
			} );
		},

		_getNonce: function() {
			return this.node.find( '.oew-login-form input[name="oewe-lf-login-nonce"]' ).val();
		},

		_ajax: function( data, callback ) {
			var ajaxArgs = {
				type: 'POST',
				url: oewLogin.ajax_url,
				data: data,
				dataType: 'json',
				success: function( response ) {
					if ( 'function' === typeof callback ) {
						callback( response );
					}
				},
				error: function(xhr, desc) {
					console.log(desc);
				}
			};

			if ( 'undefined' === typeof data.provider ) {
				ajaxArgs.processData = false,
				ajaxArgs.contentType = false;
			}

			$.ajax( ajaxArgs );
		},
	};


	var LoginHandler = function( $scope, $ ) {
		var login_form       = $scope.find('.oew-form'),
			login_form_wrap  = $scope.find('.oew-login-form-wrap'),
			page_url         = login_form_wrap.data('page-url');
		
		if ( $(login_form).length > 0 ) {
			new OEWLoginForm($scope, {
				id: $scope.data('id'),
				messages: {
					empty_username: oewLogin.empty_username,
					empty_password: oewLogin.empty_password,
				},
				page_url: page_url,
			});
		}
	}


	jQuery(window).on("elementor/frontend/init", function () {
		var addHandler = function addHandler($element) {
		  elementorFrontend.elementsHandler.addHandler(className, {
			$element: $element
		  });
		};
		elementorFrontend.hooks.addAction('frontend/element_ready/oew-login.default', LoginHandler);	
	  });	
})(jQuery);