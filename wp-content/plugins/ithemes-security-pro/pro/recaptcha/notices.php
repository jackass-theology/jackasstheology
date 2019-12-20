<?php

if ( ! ITSEC_Modules::get_setting( 'recaptcha', 'validated' ) && ITSEC_Modules::get_setting( 'recaptcha', 'last_error' ) ) {
	ITSEC_Lib_Admin_Notices::register(
		new ITSEC_Admin_Notice_Managers_Only(
			new ITSEC_Admin_Notice_Callback( 'recaptcha-error', 'itsec_recaptcha_get_last_error_notice', null , ITSEC_Admin_Notice::S_ERROR )
		)
	);
}

function itsec_recaptcha_get_last_error_notice() {
	return sprintf(
		esc_html__( 'The reCAPTCHA settings for iThemes Security are invalid. %1$s Bots will not be blocked until %2$sthe reCAPTCHA settings%3$s are set properly.', 'it-l10n-ithemes-security-pro' ),
		esc_html( ITSEC_Modules::get_setting( 'recaptcha', 'last_error' ) ),
		'<a href="' . esc_url( ITSEC_Core::get_settings_module_url( 'recaptcha' ) ) . '" data-module-link="recaptcha">',
		'</a>'
	);
}
