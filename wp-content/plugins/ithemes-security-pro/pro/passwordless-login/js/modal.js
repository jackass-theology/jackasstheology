( function( $ ) {
	var DATA_KEY = 'itsec-pwls-login-modal-prompt';

	$( function() {
		$( document ).on( 'click', '.itsec-pwls-login-modal-prompt', function( e ) {
			e.preventDefault();

			var $this = $( this ),
				modal = $this.data( DATA_KEY );

			if ( !modal ) {
				modal = new PasswordlessModal( {
					loginUrl   : $this.data( 'interim' ),
					fallbackUrl: $this.attr( 'href' ),
				} );
				$this.data( DATA_KEY, modal );
			}

			modal.showIFrame();
		} );
	} );

	function PasswordlessModal( config ) {
		this.config = config;
		this.iFrame = null;
		this.isShowing = false;
		this.isLoaded = false;
		this.$el = null;
		this.instance = ++PasswordlessModal.count;
	}

	PasswordlessModal.count = 0;

	PasswordlessModal.prototype.$ = function( selector ) {
		this.$el || this.createContainer();

		return $( selector, this.$el );
	};

	PasswordlessModal.prototype.createContainer = function() {
		this.$el = $(
			'<div id="itsec-pwls-login-modal-' + this.instance + '" class="itsec-pwls-login-modal" style="display: none;">' +
			'<div class="itsec-pwls-login-modal__bg"></div>' +
			'<div class="itsec-pwls-login-modal__wrap">' +
			'<button class="itsec-pwls-login-modal__close">Close</button>' +
			'<div class="itsec-pwls-login-modal__frame-wrap"></div>' +
			'</div>' +
			'</div>',
		)
			.appendTo( 'body' );

		this.$el.on( 'click', '.itsec-pwls-login-modal__close', this.hide.bind( this ) );
	};

	PasswordlessModal.prototype.showIFrame = function() {
		this.$el || this.createContainer();

		if ( !this.iFrame ) {
			this.iFrame = $( '<iframe class="itsec-pwls-login-modal__frame" frameborder="0"/>' )
				.on( 'load', ( function() {
					var height,
						body;

					this.isLoaded = true;
					this.show();

					try {
						body = this.iFrame.contents().find( 'body' );
						height = body.height();
					} catch ( e ) {
						this.fallback();

						return;
					}

					if ( height ) {
						if ( body && body.hasClass( 'interim-login-success' ) ) {
							this.hide();
							window.location.reload();
						} else {
							this.$( '.itsec-pwls-login-modal__wrap' ).css( 'max-height', height + 50 + 'px' );
						}
					} else if ( !body || !body.length ) {
						this.fallback();
					}
				} ).bind( this ) )
				.attr( 'src', this.config.loginUrl )
				.appendTo( this.$( '.itsec-pwls-login-modal__frame-wrap' ) );

			this.iFrame.focus();
			// WebKit doesn't throw an error if the iframe fails to load because of
			// "X-Frame-Options: DENY" header.
			// Wait for 10 sec. and switch to the fallback text.
			setTimeout( ( function() {
				if ( !this.isLoaded ) {
					this.fallback();
				}
			} ).bind( this ), 10000 );
		} else {
			this.show();
		}
	};

	PasswordlessModal.prototype.hide = function() {
		this.$el.hide();
		this.isShowing = false;
		$( 'body' ).css( { overflow: '' } );
	};

	PasswordlessModal.prototype.show = function() {
		this.$el.show();
		this.isShowing = true;
		$( 'body' ).css( { overflow: 'hidden' } );
	};

	PasswordlessModal.prototype.fallback = function() {
		window.location = this.config.fallbackUrl;
	};
} )( jQuery );
