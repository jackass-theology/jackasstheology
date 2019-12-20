<?php

namespace iThemesSecurity\PasswordlessLogin\Integrations;

use iThemesSecurity\PasswordlessLogin\Integration\Integration;

class LifterLMS implements Integration {

	public function get_name() {
		return 'LifterLMS';
	}

	public function get_slug() {
		return 'lifter-lms';
	}

	public function run() {
		add_filter( 'lifterlms_person_login_fields', [ $this, 'include_passwordless_login_prompt_in_login_fields' ], 20 );
	}

	/**
	 * Include a field for the passwordless login prompt in the LLMS login fields list.
	 *
	 * We mark our field as first in the list of fields.
	 *
	 * @param array $fields
	 *
	 * @return array
	 */
	public function include_passwordless_login_prompt_in_login_fields( $fields ) {
		array_unshift( $fields, [
			'columns'     => 12,
			'id'          => 'itsec_llms_passwordless_prompt',
			'type'        => 'html',
			'description' => \ITSEC_Passwordless_Login_Utilities::render_modal_link(),
		] );

		return $fields;
	}
}
