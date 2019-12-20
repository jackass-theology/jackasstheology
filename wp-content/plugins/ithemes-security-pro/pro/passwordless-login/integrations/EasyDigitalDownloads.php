<?php

namespace iThemesSecurity\PasswordlessLogin\Integrations;

use iThemesSecurity\PasswordlessLogin\Integration\Integration;

class EasyDigitalDownloads implements Integration {
	public function get_name() {
		return 'Easy Digital Downloads';
	}

	public function get_slug() {
		return 'edd';
	}

	public function run() {
		add_action( 'edd_login_fields_before', [ $this, 'render_passwordless_link' ] );
		add_action( 'edd_checkout_login_fields_before', [ $this, 'render_passwordless_link' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'include_script_on_checkout' ] );
	}

	public function render_passwordless_link() {
		$redirect_to = '';

		if ( wp_doing_ajax() && $_REQUEST['action'] === 'checkout_login' ) {
			$redirect_to = edd_get_checkout_uri();
		}
		?>
		<p><?php echo \ITSEC_Passwordless_Login_Utilities::render_modal_link( $redirect_to ); ?></p>
		<?php
	}

	public function include_script_on_checkout() {
		if ( edd_is_checkout() ) {
			\ITSEC_Passwordless_Login_Utilities::enqueue_modal_scripts();
		}
	}
}
