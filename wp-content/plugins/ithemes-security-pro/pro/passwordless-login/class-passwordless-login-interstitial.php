<?php

class ITSEC_Passwordless_Login_Interstitial extends ITSEC_Login_Interstitial {
	const SLUG = 'passwordless-login';
	const ASYNC_ACTION = 'passwordless-login-verify';

	public function show_to_user( WP_User $user, $is_requested ) {
		return $is_requested;
	}

	public function is_completion_forced( ITSEC_Login_Interstitial_Session $session ) {
		return true;
	}

	public function pre_render( ITSEC_Login_Interstitial_Session $session ) {
		ITSEC_Core::get_login_interstitial()->initialize_same_browser( $session );
	}

	/**
	 * @inheritDoc
	 */
	public function render( ITSEC_Login_Interstitial_Session $session, array $args ) {
		$fallback = wp_login_url();

		if ( ITSEC_Modules::get_setting( 'passwordless-login', 'flow' ) === ITSEC_Passwordless_Login::FLOW_METHOD_FIRST ) {
			$fallback  = add_query_arg( ITSEC_Passwordless_Login::HIDE, 1, $fallback );
		}
		?>

		<div class="itsec-pwls-login">
			<img class="itsec-pwls-login__logo" height="116" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/mail-sent.svg' ); ?>" alt="">
			<p class="itsec-pwls-login__title"><?php esc_html_e( 'Check your Email', 'it-l10n-ithemes-security-pro' ); ?></p>
			<p class="itsec-pwls-login__description"><?php esc_html_e( 'A magic link has been sent to your email.', 'it-l10n-ithemes-security-pro' ); ?></p>
			<p class="itsec-pwls-login__description"><?php esc_html_e( 'Click that link to login.', 'it-l10n-ithemes-security-pro' ) ?></p>

			<div class="itsec-pwls-login-fallback">
				<div class="itsec-pwls-login-fallback__or">
					<span><?php esc_html_e( 'Or', 'it-l10n-ithemes-security-pro' ) ?></span>
				</div>

				<p class="itsec-pwls-login-fallback__link-wrap">
					<a class="itsec-pwls-login-fallback__link" href="<?php echo esc_url( $fallback ); ?>">
						<?php esc_html_e( 'Login with username and password', 'it-l10n-ithemes-security-pro' ); ?>
					</a>
				</p>
			</div>
		</div>

		<?php
	}

	public function has_async_action() {
		return true;
	}

	public function handle_async_action( ITSEC_Login_Interstitial_Session $session, $action, array $args ) {
		if ( self::ASYNC_ACTION !== $action ) {
			return null;
		}

		ITSEC_Passwordless_Login_Utilities::record_use( $session->get_user() );
		ITSEC_Core::get_login_interstitial()->proceed_to_next( $session );

		return array(
			'message' => esc_html__( 'Login authorized. Please continue in your original browser.', 'it-l10n-ithemes-security-pro' ),
		);
	}

	public function has_submit() {
		return true;
	}

	public function submit( ITSEC_Login_Interstitial_Session $session, array $data ) {
		return new WP_Error( 'itsec-pwls-login-method-no-submit', __( 'You must click the link in your email to proceed.', 'it-l10n-ithemes-security-pro' ) );
	}

	public function get_priority() {
		return 0;
	}
}
