<?php

final class ITSEC_Passwordless_Login_Settings extends ITSEC_Settings {
	public function get_id() {
		return 'passwordless-login';
	}

	public function get_defaults() {
		return array(
			'login'            => 'non_privileged',
			'roles'            => array(),
			'availability'     => 'enabled',
			'2fa_bypass'       => '',
			'2fa_bypass_roles' => array(),
			'flow'             => 'method-first',
			'integrations'     => array(),
		);
	}
}

ITSEC_Modules::register_settings( new ITSEC_Passwordless_Login_Settings() );
