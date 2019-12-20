<?php

class ITSEC_Lib_Feature_Flags {

	/** @var bool */
	private static $loaded = false;

	/** @var array */
	private static $flags = array();

	/**
	 * Register a feature flag.
	 *
	 * @param string $name
	 * @param array  $args
	 */
	public static function register_flag( $name, $args = array() ) {
		self::$flags[ $name ] = wp_parse_args( $args, array(
			'rate'        => false,
			'remote'      => false,
			'title'       => '',
			'description' => '',
		) );
	}

	/**
	 * Get a list of all the available feature flags.
	 *
	 * @return array
	 */
	public static function get_available_flags() {
		self::load();

		$flags = array();

		foreach ( self::$flags as $flag => $_ ) {
			$flags[ $flag ] = self::get_flag_config( $flag );
		}

		return $flags;
	}

	/**
	 * Get a list of all the enabled feature flags.
	 *
	 * @return string[]
	 */
	public static function get_enabled() {
		$enabled = array();

		foreach ( self::get_available_flags() as $flag => $_ ) {
			if ( self::is_enabled( $flag ) ) {
				$enabled[] = $flag;
			}
		}

		return $enabled;
	}

	/**
	 * Check if a flag is enabled.
	 *
	 * @param string $flag
	 *
	 * @return bool
	 */
	public static function is_enabled( $flag ) {
		if ( ! $config = self::get_flag_config( $flag ) ) {
			return false;
		}

		if ( defined( 'ITSEC_FF_' . $flag ) ) {
			// A constant overrules everything.
			return (bool) constant( 'ITSEC_FF_' . $flag );
		}

		$flags = ITSEC_Modules::get_setting( 'global', 'feature_flags' );

		if ( ! empty( $flags[ $flag ]['enabled'] ) ) {
			// If the flag is set as enabled, then enable it.
			return true;
		}

		// If this is a gradual roll-out.
		if ( $rate = $config['rate'] ) {
			// If the flag has been manually disabled with `ITSEC_Lib_Feature_Flags::disable()`, then exclude them from the feature.
			if ( isset( $flags[ $flag ]['enabled'] ) && ! $flags[ $flag ]['enabled'] && ! isset( $flags[ $flag ]['rate'] ) ) {
				return false;
			}

			// If the rice haven't been rolled, or the rate has changed since the last run, roll the dice.
			if ( ! isset( $flags[ $flag ]['rate'] ) || $flags[ $flag ]['rate'] !== $rate ) {
				$enabled = mt_rand( 1, 100 ) <= $rate;

				$flags[ $flag ] = array(
					'enabled' => $enabled,
					'time'    => ITSEC_Core::get_current_time_gmt(),
					'rate'    => $rate,
				);

				ITSEC_Modules::set_setting( 'global', 'feature_flags', $flags );

				if ( $enabled ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Manually enable a feature flag.
	 *
	 * @param string $flag
	 */
	public static function enable( $flag ) {
		$flags = ITSEC_Modules::get_setting( 'global', 'feature_flags' );

		$flags[ $flag ] = array(
			'enabled' => true,
			'time'    => ITSEC_Core::get_current_time_gmt(),
		);

		ITSEC_Modules::set_setting( 'global', 'feature_flags', $flags );
	}

	/**
	 * Manually disable a feature flag.
	 *
	 * @param string $flag
	 */
	public static function disable( $flag ) {
		$flags = ITSEC_Modules::get_setting( 'global', 'feature_flags' );

		$flags[ $flag ] = array(
			'enabled' => false,
			'time'    => ITSEC_Core::get_current_time_gmt(),
		);

		ITSEC_Modules::set_setting( 'global', 'feature_flags', $flags );
	}

	/**
	 * Get the flag configuration.
	 *
	 * @param string $flag
	 *
	 * @return array|null
	 */
	public static function get_flag_config( $flag ) {
		self::load();


		if ( ! isset( self::$flags[ $flag ] ) ) {
			return null;
		}

		$config = self::$flags[ $flag ];

		if ( $config['remote'] && $remote = ITSEC_Lib_Remote_Messages::get_feature( $flag ) ) {
			$config = array_merge( $config, $remote );
		}

		return $config;
	}

	private static function load() {
		if ( ! self::$loaded ) {
			ITSEC_Modules::load_module_file( 'feature-flags.php', ':active' );
			self::$loaded = true;
		}
	}
}
