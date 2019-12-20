<?php

class ITSEC_Passwordless_Login_Validator extends ITSEC_Validator {
	public function get_id() {
		return 'passwordless-login';
	}

	protected function sanitize_settings() {
		$this->set_previous_if_empty( array( '2fa_bypass_roles', '2fa_bypass', 'integrations' ) );
		$this->vars_to_skip_validate_matching_fields[] = 'integrations';

		$this->sanitize_setting( array_keys( $this->get_login_user_types() ), 'login', __( 'Enable Passwordless Login', 'it-l10n-ithemes-security-pro' ) );

		if ( $this->sanitize_setting( 'array', 'roles', __( 'Select Roles to Enable Passwordless Login', 'it-l10n-ithemes-security-pro' ) ) ) {
			$this->sanitize_setting( array_keys( $this->get_login_user_roles() ), 'roles', __( 'Select Roles to Enable Passwordless Login', 'it-l10n-ithemes-security-pro' ) );
		}

		$this->sanitize_setting( array_keys( $this->get_login_availability_types() ), 'availability', __( 'Passwordless Login Per-User Availability', 'it-l10n-ithemes-security-pro' ) );

		if ( ITSEC_Modules::is_active( 'two-factor' ) ) {
			$this->sanitize_setting(
				array_keys( $this->get_login_2fa_bypass_types() ),
				'2fa_bypass',
				__( 'Allow Two-Factor Bypass for Passwordless Login', 'it-l10n-ithemes-security-pro' ),
				true,
				true,
				__( 'Select an option for the Allow Two-Factor Bypass for Passwordless Login setting before saving the module’s settings.', 'it-l10n-ithemes-security-pro' )
			);

			if ( $this->sanitize_setting( 'array', '2fa_bypass_roles', __( 'Select Roles to Allow Two-Factor Bypass for Passwordless Login', 'it-l10n-ithemes-security-pro' ) ) ) {
				$this->sanitize_setting( array_keys( $this->get_login_user_roles() ), '2fa_bypass_roles', __( 'Select Roles to Allow Two-Factor Bypass for Passwordless Login', 'it-l10n-ithemes-security-pro' ) );
			}
		} else {
			$this->settings['2fa_bypass']       = $this->previous_settings['2fa_bypass'];
			$this->settings['2fa_bypass_roles'] = $this->previous_settings['2fa_bypass_roles'];
		}

		$this->sanitize_setting( array_keys( $this->get_flow_types() ), 'flow', __( 'Passwordless Login Flow', 'it-l10n-ithemes-security-pro' ) );

		if ( ! $this->sanitize_setting( 'array', 'integrations', __( 'Integrations', 'it-l10n-ithemes-security-pro' ) ) ) {
			return;
		}

		$integrations = $this->settings['integrations'];

		foreach ( $integrations as $slug => $settings ) {
			$settings = array_intersect_key( $settings, array_flip( array( 'enabled' ) ) );

			if ( 'false' === $settings['enabled'] ) {
				$settings['enabled'] = false;
			} elseif ( 'true' === $settings['enabled'] ) {
				$settings['enabled'] = true;
			} else {
				$settings['enabled'] = (bool) $settings['enabled'];
			}

			$this->settings['integrations'][ $slug ] = $settings;
		}
	}

	public function get_login_user_types() {
		return array(
			'all'            => esc_html__( 'All Users', 'it-l10n-ithemes-security-pro' ),
			'non_privileged' => esc_html__( 'Non-Privileged Users', 'it-l10n-ithemes-security-pro' ),
			'custom'         => esc_html__( 'Select Roles Manually', 'it-l10n-ithemes-security-pro' ),
		);
	}

	public function get_login_availability_types() {
		return array(
			'enabled'  => esc_html__( 'Enabled by Default', 'it-l10n-ithemes-security-pro' ),
			'disabled' => esc_html__( 'Disabled by Default', 'it-l10n-ithemes-security-pro' ),
		);
	}

	public function get_login_2fa_bypass_types() {
		return array(
			'all'            => esc_html__( 'All Users', 'it-l10n-ithemes-security-pro' ),
			'non_privileged' => esc_html__( 'Non-Privileged Users', 'it-l10n-ithemes-security-pro' ),
			'custom'         => esc_html__( 'Select Roles Manually', 'it-l10n-ithemes-security-pro' ),
			'none'           => esc_html__( 'No One', 'it-l10n-ithemes-security-pro' ),
		);
	}

	public function get_login_user_roles() {
		return wp_roles()->get_names();
	}

	public function get_flow_types() {
		return array(
			'method-first' => esc_html__( 'Method First', 'it-l10n-ithemes-security-pro' ),
			'user-first'   => esc_html__( 'Username First', 'it-l10n-ithemes-security-pro' )
		);
	}
}

ITSEC_Modules::register_validator( new ITSEC_Passwordless_Login_Validator() );
