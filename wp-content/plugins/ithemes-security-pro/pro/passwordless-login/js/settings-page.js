( function( $ ) {

	$( function() {
		triggerConditionalInputs( $( '#itsec-passwordless-login-login' ) );
		triggerConditionalInputs( $( '#itsec-passwordless-login-2fa_bypass' ) );
	} );

	$( document ).on(
		'change',
		'#itsec-passwordless-login-login, #itsec-passwordless-login-2fa_bypass',
		curryThis( triggerConditionalInputs ),
	);

	function triggerConditionalInputs( $input ) {
		var id = $input.attr( 'id' ),
			val = $input.val();

		if ( $input.is( 'select' ) ) {
			$( 'option', $input ).each( function() {
				var optVal = $( this ).val();

				var $showIf = $( '.' + id + '--show-if-' + optVal ),
					$hideIf = $( '.' + id + '--hide-if-' + optVal );

				if ( $input.css( 'display' ) === 'none' ) {
					$showIf.hide();
					$hideIf.hide();
				} else if ( optVal === val ) {
					$showIf.show();
					$hideIf.hide();
				} else {
					$showIf.hide();
					$hideIf.show();
				}

				$( ':input', $showIf ).each( curryThis( triggerConditionalInputs ) );
				$( ':input', $hideIf ).each( curryThis( triggerConditionalInputs ) );
			} );
		}
	}

	function curryThis( func ) {
		return function() {
			return func( $( this ) );
		};
	}
} )( jQuery );
