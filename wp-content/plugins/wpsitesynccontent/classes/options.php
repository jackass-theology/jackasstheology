<?php

// TODO: change all references to 'host' setting to 'target' for naming consistency

class SyncOptions
{
	const OPTION_NAME = 'spectrom_sync_settings';

	private static $_options = NULL;
	private static $_dirty = FALSE;

	// the following are allowed values for specific settings
	private static $_constraints = array(
		'match_mode' => array('title', 'title-slug', 'slug', 'slug-title', 'id'),
		'min_role' => array('author', 'editor', 'administrator'),
		'roles' => '|author|editor|administrator|',
		'report' => array('0', '1'),
	);
	const ROLE_DELIMITER = '|';

	/*
	 * Options are:
	 // TODO: rename to 'target'
	 * 'installed' = install date
	 * 'host' = Target site URL
	 * 'username' = Target site login username
	 * 'password' = Target site login password
	 * 'site_key' = Current site's site_key - a unique identifier for the site
	 * 'target_site_key' = Current Target's site key
	 * 'auth' = 1 for username/password authenticated; otherwise 0
	 * 'strict' = 1 for strict mode; otherwise 0
	 * 'salt' = salt value used for authentication
	 * 'remove' = remove settings/tables on plugin deactivation
	 * 'match_mode' = method for matching content on Target: 'title', 'slug', 'id'
	 * 'min_role' = minimum role required to be able to perform Sync operations #122
	 * 'roles' = Roles allowed to perform Sync operations
	 * 'report' = Enable reporting to serverpress.com
	 */

	/**
	 * Loads the options from the database and decodes the password
	 */
	private static function _load_options()
	{
		if (NULL !== self::$_options)
			return;
		self::$_options = get_option(self::OPTION_NAME, array());
//SyncDebug::log(__METHOD__.'():' . __LINE__ . ' options=' . var_export(self::$_options, TRUE));
		if (FALSE === self::$_options)
			self::$_options = array();

		// perform fixup / cleanup on option values...migrating from previous configuration settings
		$defaults = array(
			'installed' => '',
			'host' => '',
			'username' => '',
			'password' => '',
			'site_key' => '',
			'target_site_key' => '',
			'auth' => 0,
			'strict' => '1',
			'salt' => '',
			'remove' => '0',
			'match_mode' => 'title',
			'min_role' => 'author',
			'roles' => '|author|editor|administrator|',
			'report' => '0',
		);

		self::$_options = array_merge($defaults, self::$_options);
//SyncDebug::log(__METHOD__.'():' . __LINE__ . ' options=' . var_export(self::$_options, TRUE));

		// update the install date if it's empty
		if (empty(self::$_options['installed'])) {
			// use method in activation code to set install date
			include_once(dirname(dirname(__FILE__)) . '/install/activate.php');
			$activate = new SyncActivate();
			self::$_options['installed'] = $activate->get_install_date();
			self::$_dirty = TRUE;
		}

		// adjust settings for roles if missing (newly added setting not configured; use defaults) #166
		if (empty(self::$_options['roles']) || empty(self::$_options['min_role'])) {
			switch (self::$_options['min_role']) {
			case 'author':
			default:
				self::$_options['roles'] = '|author|editor|administrator|';
				break;
			case 'editor':
				self::$_options['rolse'] = '|editor|administrator|';
				break;
			case 'admin':
				self::$_options['roles'] = '|administrator|';
				break;
			}
//SyncDebug::log(__METHOD__.'():' . __LINE__ . ' roles are empty; setting to: ' . self::$_options['roles']);
			self::$_dirty = TRUE;
		}

		self::save_options();
	}

	/**
	 * Checks if option exists, whether or not there is a value stored for the option.
	 * @param string $name The name of the option to check.
	 * @return boolean TRUE if the option exists; otherwise FALSE.
	 */
	public static function has_option($name)
	{
		if (array_key_exists($name, self::$_options))
			return TRUE;
		return FALSE;
	}

	/**
	 * Retrieves a named setting option
	 * @param string $name The name of the setting option to retrieve
	 * @param mixed $default The default value to return if it's not found
	 * @return mixed The value of the named setting option if found; otherwise the default value
	 */
	public static function get($name, $default = '')
	{
		self::_load_options();
		if ('target' === $name)
			$name = 'host';
		if (isset(self::$_options[$name]))
			return self::$_options[$name];
		return $default;
	}

	/**
	 * Return the integer value of a settings option
	 * @param name $name The name of the setting option to retrieve
	 * @param int $default A default value for the option if it's not found
	 * @return int The integer value of the setting option
	 */
	public static function get_int($name, $default = 0)
	{
		return intval(self::get($name, $default));
	}

	/*
	 * Retrieve the array of all options
	 */
	public static function get_all()
	{
		self::_load_options();
		return self::$_options;
	}

	/**
	 * Returns an array describing known good values for each setting name
	 * @return type
	 */
	public static function get_constraints()
	{
		return self::$_constraints;
	}

	/**
	 * Checks to see if the site has a valid authentication to a Target site
	 * @return boolean TRUE if site is authorized; otherwise FALSE
	 */
	public static function is_auth()
	{
		self::_load_options();
		if (isset(self::$_options['auth']) && 1 === intval(self::$_options['auth']))
			return TRUE;
		return FALSE;
	}

	/**
	 * Use settings to determine if user has access to WPSiteSync features #122
	 * @return boolean TRUE if user is allowed, based on configuration and current role; otherwise FALSE
	 */
	public static function has_cap()
	{
		$min_role = self::get('min_role', 'author');
		$roles = self::get('roles', '');
		if (empty($roles)) {
			// if the roles are empty, adjust setting based on default roles from v1.4
//SyncDebug::log(__METHOD__.'():' . __LINE__ . ' roles are empty; min_role=' . var_export($min_role, TRUE));
			switch ($min_role) {
				case 'administrator':
				default:
					$roles = '|administrator|';
					break;
				case 'editor':
					$roles = '|editor|administrator|';
					break;
				case 'author':
					$roles = '|author|editor|administrator|';
					break;
			}
		}
		$current_user = wp_get_current_user();
		// check to see if current user's Role is in list of allowed roles #166
//SyncDebug::log(__METHOD__.'():' . __LINE__ . ' roles=' . var_export($roles, TRUE));
		foreach ($current_user->roles as $role)
			if (FALSE !== strpos($roles, self::ROLE_DELIMITER . $role . self::ROLE_DELIMITER)) {
//SyncDebug::log(__METHOD__.'():' . __LINE__ . ' found matching role "' . $role . '"');
				return TRUE;
			}
		return FALSE;
	}

	/**
	 * Updates the local copy of the option data. Will not update properties that are not already in option array.
	 * @param string $name The name of the Sync option to update
	 * @param mixed $value The value to store with the name
	 */
	public static function set($name, $value)
	{
		self::_load_options();

		// don't allow setting unknown property names
		if (isset(self::$_options[$name])) {
			if (isset(self::$_constraints[$name]) && !in_array($value, self::$_constraints)) {
				// current value is not a known good value for this property; abort
				return;
			}
			self::$_options[$name] = $value;
			self::$_dirty = TRUE;
		}
	}

	/**
	 * Saves the options data if it's been updated
	 */
	public static function save_options()
	{
		if (self::$_dirty) {
			// assume options already exist - they are created at install time
			update_option(self::OPTION_NAME, self::$_options);
			self::$_dirty = FALSE;
		}
	}
}

// EOF
