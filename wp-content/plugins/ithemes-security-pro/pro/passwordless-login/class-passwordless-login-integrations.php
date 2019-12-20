<?php

use iThemesSecurity\PasswordlessLogin\Integration\Integration;

class ITSEC_Passwordless_Login_Integrations {

	private static $registrations = [];
	private static $integrations = [];

	/**
	 * Register an integration.
	 *
	 * @param string                      $slug        Integration slug.
	 * @param string|callable|Integration $integration Either a class name, a callable resolving to an Integration, or an Integration instance.
	 */
	public static function register( $slug, $integration ) {
		if ( $integration instanceof Integration ) {
			self::$registrations[ $slug ] = $integration;
		} elseif ( is_callable( $integration ) ) {
			self::$registrations[ $slug ] = $integration;
		} elseif ( is_string( $integration ) && class_exists( $integration ) && is_subclass_of( $integration, 'iThemesSecurity\PasswordlessLogin\Integration\Integration' ) ) {
			self::$registrations[ $slug ] = $integration;
		} else {
			throw new InvalidArgumentException( '$integration must be Either the class name, a callable resolving to an integration, or an integration instance.' );
		}
	}

	/**
	 * Run all the enabled integrations.
	 */
	public static function run() {
		$integrations = ITSEC_Modules::get_setting( 'passwordless-login', 'integrations' );

		foreach ( $integrations as $slug => $settings ) {
			if ( $settings['enabled'] ) {
				if ( $integration = self::get_integration( $slug ) ) {
					$integration->run();
				}
			}
		}
	}

	/**
	 * Get all the available integrations.
	 *
	 * @return Integration[]
	 */
	public static function get_integrations() {
		if ( count( self::$integrations ) !== count( self::$registrations ) ) {
			foreach ( self::$registrations as $slug => $registration ) {
				if ( ! isset( self::$integrations[ $slug ] ) ) {
					self::$integrations[ $slug ] = self::make_integration( $registration );
				}
			}
		}

		return self::$integrations;
	}

	/**
	 * Get the integration instance for a slug.
	 *
	 * @param string $slug
	 *
	 * @return Integration|null
	 */
	public static function get_integration( $slug ) {
		if ( isset( self::$integrations[ $slug ] ) ) {
			return self::$integrations[ $slug ];
		}

		if ( isset( self::$registrations[ $slug ] ) ) {
			return self::$integrations[ $slug ] = self::make_integration( self::$registrations[ $slug ] );
		}

		return null;
	}

	/**
	 * Make an integration from the registration.
	 *
	 * @param string $registration
	 *
	 * @return Integration
	 */
	private static function make_integration( $registration ) {
		if ( $registration instanceof Integration ) {
			return $registration;
		}

		if ( is_callable( $registration ) ) {
			$integration = $registration();

			if ( ! $integration instanceof Integration ) {
				throw new UnexpectedValueException( 'Registration did not return an Integration instance.' );
			}

			return $integration;
		}

		if ( is_string( $registration ) && class_exists( $registration ) && is_subclass_of( $registration, 'iThemesSecurity\PasswordlessLogin\Integration\Integration' ) ) {
			return new $registration;
		}

		throw new UnexpectedValueException( 'Invalid integration registration.' );
	}
}

require_once( __DIR__ . '/integrations/lib/Integration.php' );
