<?php

class ITSEC_Security_Check_Pro_Settings_Page extends ITSEC_Module_Settings_Page {

	public function __construct() {
		$this->id          = 'security-check-pro';
		$this->title       = __( 'Security Check Pro', 'it-l10n-ithemes-security-pro' );
		$this->description = __( 'Adds secure automatic IP detection and SSL server setup checks.', 'it-l10n-ithemes-security-pro' );
		$this->type        = 'advanced';
		$this->can_save    = false;

		parent::__construct();
	}

	protected function render_description( $form ) {
		echo '<p>';
		echo __( 'Adds secure automatic IP detection and SSL server setup checks.', 'it-l10n-ithemes-security-pro' );
		printf(
			__( 'This feature requires contacting an iThemes.com server. See our %1$sPrivacy Policy%2$s.', 'it-l10n-ithemes-security-pro' ),
			'<a href="https://ithemes.com/privacy-policy/">',
			'</a>'
		);
		echo '</p>';
	}

	protected function render_settings( $form ) {

	}
}


if ( ! ITSEC_Modules::is_always_active( 'security-check-pro' ) ) {
	new ITSEC_Security_Check_Pro_Settings_Page();
}
