<?php
/**
 * Created by ra on 9/22/2016.
 */


class td_options {

	/**
	 * @var bool flag used to hook the shutdown action only once
	 */
	private static $is_shutdown_hooked = false;

	/**
	 * @var null keep a local copy of all the settings
	 */
	static $td_options = NULL;


	/**
	 * get one td_option
	 * @param $option_name
	 * @param string $default_value - what you get if the option is empty or not set, default is EMPTY STRING ''
	 * @return string
	 */
	static function get($option_name, $default_value = '') {
		self::read_from_db();

		if (!empty(self::$td_options[$option_name])) {
			return self::$td_options[$option_name];
		} else {
			if (!empty($default_value)) {
				return $default_value;
			} else {
				return '';
			}
		}

	}


	/**
	 * Updates a string td_option
	 * @param $option_name string
	 * @param $new_value string
	 */
	static function update($option_name, $new_value) {
		self::$td_options[$option_name] = $new_value;
		self::schedule_save();
	}


    /**
     * Read an array from the options
     * @param $option_name
     * @param array $default_value - what you get if the setting is not set
     * @return array
     */
	static function get_array($option_name, $default_value = array()) {

	    // check the default value to be array
	    if (!is_array($default_value)) {
	        td_util::error(__FILE__, 'td_options::get_array - $default_value is not an array!', $default_value);
	        die;
        }

        self::read_from_db();

        // if we have a setting in the database and IT IS ARRAY
        if ( !empty(self::$td_options[$option_name]) && is_array(self::$td_options[$option_name]) ) {
            return self::$td_options[$option_name];
        }

        // log strings
        if (!empty(self::$td_options[$option_name]) && !is_array(self::$td_options[$option_name])) {
            td_log::log(__FILE__, __FUNCTION__, 'td_options::get_array - option is not an array!', self::$td_options[$option_name]);
        }

        // no setting or the setting is stored as a string
        return $default_value;
    }


    /**
     * Updates an array td_option
     * @param $option_name string
     * @param $new_value array
     */
    static function update_array($option_name, $new_value) {

        // check the $new_value value to be array
//        if (!is_array($new_value)) {
//            td_util::error(__FILE__, 'td_options::get_array - $default_value is not an array!', $new_value);
//            die;
//        }

        self::$td_options[$option_name] = $new_value;
        self::schedule_save();
    }



	/**
	 * @param $optionName
	 * @param $newValue
	 * @deprecated - do not use, it's used as a hack in td composer and we will remove it soon
	 */
	static function update_temp($optionName, $newValue) {
		self::$td_options[$optionName] = $newValue;
	}



	/**
	 * This method is used to port the OLD global reading and updating to this new class so we don't have to refactor all the code at once.
	 *  - schedule_save() must be called after modifying the reference
	 * @return mixed
	 */
	static function &get_all_by_ref() {
		self::read_from_db();
		return self::$td_options;
	}


	/**
	 * Used to read all the options.
	 * @return mixed
	 */
	static function get_all() {
		self::read_from_db();
		return self::$td_options;
	}


	/**
	 * read the setting from db only once
	 */
	static private function read_from_db() {
		if (is_null(self::$td_options)) {
			self::$td_options = get_option(TD_THEME_OPTIONS_NAME);
		}
	}

	/**
	 * Schedules a save on the shutdown hook. It's public because it's also used with @see td_options::get_all_by_ref()
	 */
	static function schedule_save() {

		// make sure that we hook only once
		if (self::$is_shutdown_hooked === false) {
			add_action('shutdown', array(__CLASS__, 'on_shutdown_save_options'));
			self::$is_shutdown_hooked = true;
		}
	}


	/**
	 * @internal
	 * save the options hook
	 */
	static function on_shutdown_save_options() {

		update_option( TD_THEME_OPTIONS_NAME, self::$td_options );
		//echo "SETTINGS SAVED";
	}

}