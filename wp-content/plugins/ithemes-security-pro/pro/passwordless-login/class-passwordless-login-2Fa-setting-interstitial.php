<?php

class ITSEC_Passwordless_Login_2fa_Setting_Interstitial extends ITSEC_Login_Interstitial {

	const SLUG = 'passwordless-login-2fa-setting';

	public function show_to_user( WP_User $user, $is_requested ) {
		return $is_requested || ITSEC_Passwordless_Login_Utilities::should_remind_user_about_2fa( $user );
	}

	public function is_completion_forced( ITSEC_Login_Interstitial_Session $session ) {
		return false;
	}

	public function pre_render( ITSEC_Login_Interstitial_Session $session ) {
		add_action( 'login_enqueue_scripts', static function () {
			wp_enqueue_style( 'itsec-passwordless-login', plugin_dir_url( __FILE__ ) . 'css/login.css' );
		} );
	}

	public function render( ITSEC_Login_Interstitial_Session $session, array $args ) {
		?>
		<div class="itsec-pwls-login-2fa-setting">
			<img class="itsec-pwls-login__logo" height="116" src="<?php echo esc_url( plugin_dir_url( __FILE__ ) . 'img/logo.svg' ); ?>" alt="">
			<h2><?php esc_html_e( 'Additional Security Measures' ) ?></h2>
			<p class="description">
				<?php esc_html_e( 'You can choose to enable or disable Two-factor when logging in with a magic link.', 'it-l10n-ithemes-security-pro' ); ?>
			</p>
			<p class="description">
				<?php esc_html_e( 'Two-factor is enabled by default adding additional security to your account, but is not required.', 'it-l10n-ithemes-security-pro' ); ?>
			</p>
			<button class="itsec-pwls-login__submit" type="submit" name="itsec_2fa" value="skip">
				<?php esc_html_e( 'Disable Two-Factor', 'it-l10n-ithemes-security-pro' ); ?>
			</button>
			<button class="itsec-pwls-login__submit" type="submit" name="itsec_2fa" value="use">
				<?php esc_html_e( 'Enable Two-Factor', 'it-l10n-ithemes-security-pro' ); ?>
			</button>
		</div>
		<?php
	}

	public function has_submit() {
		return true;
	}

	public function submit( ITSEC_Login_Interstitial_Session $session, array $data ) {
		switch ( empty( $data['itsec_2fa'] ) ? '' : $data['itsec_2fa'] ) {
			case 'skip':
				ITSEC_Passwordless_Login_Utilities::set_2fa_enabled_for_user( $session->get_user(), false );
				break;
			case 'use':
				ITSEC_Passwordless_Login_Utilities::set_2fa_enabled_for_user( $session->get_user(), true );
				break;
		}

		ITSEC_Passwordless_Login_Utilities::set_remind_user_about_2fa( $session->get_user(), false );
	}

	public function get_priority() {
		return 100;
	}
}
