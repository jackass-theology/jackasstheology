<?php

final class ITSEC_Magic_Links_Settings_Page extends ITSEC_Module_Settings_Page {

	public function __construct() {
		$this->id          = 'magic-links';
		$this->title       = __( 'Magic Links', 'it-l10n-ithemes-security-pro' );
		$this->description = __( 'Bypass lockouts using a Magic Link.', 'it-l10n-ithemes-security-pro' );
		$this->pro         = true;

		parent::__construct();
	}

	protected function render_description( $form ) {
		echo '<p>';
		esc_html_e( 'The Magic Links bypass lockout option allows you to login while your username or IP is locked out.', 'it-l10n-ithemes-security-pro' );
		echo '</p>';
	}

	/**
	 * @param ITSEC_Form $form
	 */
	protected function render_settings( $form ) {
		?>
		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="itsec-magic-links-lockout_bypass">
						<?php esc_html_e( 'Enable Lockout Bypass', 'it-l10n-ithemes-security-pro' ) ?>
					</label>
				</th>
				<td>
					<?php $form->add_checkbox( 'lockout_bypass' ); ?>
					<p class="description">
						<?php esc_html_e( 'Send an email to bypass a lockout.', 'it-l10n-ithemes-security-pro' ); ?>
					</p>
				</td>
			</tr>
		</table>
		<?php
	}
}

new ITSEC_Magic_Links_Settings_Page();
