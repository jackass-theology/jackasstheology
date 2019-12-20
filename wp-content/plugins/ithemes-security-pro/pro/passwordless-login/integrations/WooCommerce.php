<?php

namespace iThemesSecurity\PasswordlessLogin\Integrations;

use iThemesSecurity\PasswordlessLogin\Integration\Integration;

class WooCommerce implements Integration {

	public function get_name() {
		return 'WooCommerce';
	}

	public function get_slug() {
		return 'wc';
	}

	public function run() {
		add_action( 'woocommerce_login_form_start', [ $this, 'render_passwordless_link' ] );
	}

	public function render_passwordless_link() {
		?>
		<p class="form-row">
			<?php echo \ITSEC_Passwordless_Login_Utilities::render_modal_link(); ?>
		</p>
		<?php
	}
}
