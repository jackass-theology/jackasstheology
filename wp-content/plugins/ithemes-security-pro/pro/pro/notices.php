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

class ITSEC_Admin_Notice_New_Feature implements ITSEC_Admin_Notice {

	public function get_id() {
		return 'release-6.1.0';
	}

	public function get_title() {
		return '';
	}

	public function get_message() {
		return esc_html__( 'New! Make WordPress Security Easy With Passwordless Logins', 'it-l10n-ithemes-security-pro' );
	}

	public function get_meta() {
		return array();
	}

	public function get_severity() {
		return self::S_INFO;
	}

	public function show_for_context( ITSEC_Admin_Notice_Context $context ) {
		return true;
	}

	public function get_actions() {
		return array(
			'blog' => new ITSEC_Admin_Notice_Action_Link(
				add_query_arg( 'itsec_view_release_post', '6.1.0', admin_url( 'index.php' ) ),
				esc_html__( 'See How It Works', 'it-l10n-ithemes-security-pro' ),
				ITSEC_Admin_Notice_Action::S_PRIMARY,
				function () {
					$this->handle_dismiss();

					wp_redirect( 'https://ithemes.com/new-wordpress-passwordless-login-ithemes-security' );
					die;
				}
			)
		);
	}

	private function handle_dismiss() {
		$dismissed   = $this->get_storage();
		$dismissed[] = $this->get_id();
		$this->save_storage( $dismissed );

		return null;
	}

	private function get_storage() {
		$dismissed = get_site_option( 'itsec_dismissed_notices', array() );

		if ( ! is_array( $dismissed ) ) {
			$dismissed = array();
		}

		return $dismissed;
	}

	private function save_storage( $storage ) {
		update_site_option( 'itsec_dismissed_notices', $storage );
	}
}

ITSEC_Lib_Admin_Notices::register( new ITSEC_Admin_Notice_Globally_Dismissible( new ITSEC_Admin_Notice_Managers_Only( new ITSEC_Admin_Notice_New_Feature() ) ) );
