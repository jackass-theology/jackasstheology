( function( $, config ) {
	$( window ).on( 'load', function() {
		$( '#user_pass' ).removeAttr( 'disabled' );
	} );

	$( function() {
		var $loginForm = $( '#loginform' ),
			$body = $( 'body' );

		$body.removeClass( 'no-js' );

		$( document ).on( 'click', '.itsec-pwls-login-fallback__link-wrap--type-wp a', function( e ) {
			e.preventDefault();
			$body.removeClass( 'itsec-pwls-login--show' ).addClass( 'itsec-pwls-login--hide' );
			$loginForm.attr( 'action', config.passwordAction );
			$( '#user_pass' ).removeAttr( 'disabled' );
		} );

		$( document ).on( 'click', '.itsec-pwls-login-fallback__link-wrap--type-ml a', function( e ) {
			e.preventDefault();
			$body.removeClass( 'itsec-pwls-login--hide' ).addClass( 'itsec-pwls-login--show' );
			$loginForm.attr( 'action', config.magicAction );
		} );

		if ( config.flow === 'method-first' ) {
			$( '.itsec-pwls-login-fallback' ).insertAfter( '.submit' );
			$( document ).on( 'click', '.itsec-pwls-login__link', function( e ) {
				e.preventDefault();
				$loginForm.attr( 'action', config.magicAction );
				$body.addClass( 'itsec-pwls-login-form' );
				$( '.itsec-pwls-login-wrap' ).html( $( '#tmpl-itsec-pwls-login-prompt-form' ).html() );
			} );

			if ( window.location.search.indexOf( 'itsec-pwls-modal=1' ) !== -1 ) {
				$( '.itsec-pwls-login__link' ).click();
			}
		} else {
			$loginForm.hide();
			$loginForm.before( $( '#tmpl-itsec-pwls-login-user-form' ).html() );

			var $userForm = $( '#itsec-pwls-login-user-form' ).on( 'submit', function( e ) {
				e.preventDefault();

				var $btn = $( '#itsec-pwls-login-user-form__continue' ).attr( 'disabled', true );

				$.post(
					config.ajaxUrl,
					{
						action: config.ajaxAction,
						log   : $( '#itsec-pwls-login-user-form__username' ).val(),
					},
					function( response ) {
						if ( !response.success ) {
							alert( response.data.message || 'Unknown error. Please try again later.' );

							return;
						}

						if ( config.wpVersion >= 5.3 ) {
							// WordPress 5.3+ removed the wrapping <label><input /></label>
							$( '#user_login' ).parent().remove();
						} else {
							$( '#user_login' ).parent().parent().remove();
						}

						$( 'input[name="itsec_pwls_login_user_first"]' ).remove();
						$( '#wp-submit' ).val( config.i18n.login );

						$body.removeClass( 'itsec-pwls-login--no-user' ).addClass( 'itsec-pwls-login--has-user' );
						$userForm.hide();
						$loginForm.show();
						$loginForm.prepend( response.data.html );

						$( '.itsec-pwls-login-fallback' ).insertAfter( '.submit' );

						if ( response.data.methods.indexOf( 'magic' ) !== -1 ) {
							$body.addClass( 'itsec-pwls-login--show itsec-pwls-login--is-available' );
							$loginForm.attr( 'action', config.magicAction );
						} else {
							$( '#user_pass' ).removeAttr( 'disabled' );
						}
					} )
					.always( function() {
						$btn.attr( 'disabled', false );
					} );
			} );
		}
	} );
} )( jQuery, window[ 'ITSECMagicLogin' ] );
