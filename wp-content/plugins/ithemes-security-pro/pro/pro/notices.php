<?php

if ( ! ITSEC_Core::is_licensed() ) {
	ITSEC_Lib_Admin_Notices::register(
		new ITSEC_Admin_Notice_Managers_Only(
			new ITSEC_Admin_Notice_Remind_Me(
				new ITSEC_Admin_Notice_Callback( 'unlicensed', 'itsec_pro_unlicensed_notice_message', 'itsec_pro_unlicensed_notice_title', ITSEC_Admin_Notice::S_SUCCESS ),
				MONTH_IN_SECONDS
			)
		)
	);
}

function itsec_pro_unlicensed_notice_title() {
	return esc_html__( 'iThemes Security Pro is not licensed.', 'it-l10n-ithemes-security-pro' );
}

function itsec_pro_unlicensed_notice_message() {
	if ( is_multisite() && is_network_admin() ) {
		$url = network_admin_url( 'settings.php' ) . '?page=ithemes-licensing';
	} else {
		$url = admin_url( 'options-general.php' ) . '?page=ithemes-licensing';
	}

	return sprintf( esc_html__( 'To receive updates, iThemes Security Pro will need to be licensed. The iThemes Licensing page can be found in the %1$sSettings menu%2$s.', 'it-l10n-ithemes-security-pro' ), '<a href="' . $url . '">', '</a>' );
}
