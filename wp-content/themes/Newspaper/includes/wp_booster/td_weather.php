<?php
/**
 * Created by ra.
 * Date: 9/28/2015
 */


class td_weather
{

	private static $caching_time = 10800;  // 3 hours
	//private static $owm_api_key = 'f5dc074e364b4d0bbaacbab0030031a3';

//	private static $owm_api_keys = array (
//		//'4d99fdabeab40f86485ab0cdefab561b',
//	);

	/**
	 * Used by all the shortcodes + widget to render the weather. The top bar has a separate function bellow
	 * @param $atts
	 * @param $block_uid
	 * @param $template string -> block_template | top_bar_template
	 * @return string
	 */
	static function render_generic($atts, $block_uid, $template = 'block_template')
	{

		if (empty($atts['w_key']) and empty($atts['w_location'])) {
			return td_util::get_block_error('Weather widget', "Configure this block/widget's settings to get weather");
		}

		if (empty($atts['w_location'])) {
			return td_util::get_block_error('Weather widget', "<strong>Location</strong> is empty. Configure this block/widget and enter a location and we will show the weather from that location :)");
		}

		if (empty($atts['w_key'])) {
			return td_util::get_block_error('Weather widget', "<strong>Api key</strong> is empty. Configure this block/widget and enter an api key :)");
		}


		$current_unit = 0; // 0 - metric
		$current_temp_label = 'C';
		$current_speed_label = 'kmh';

		if (!empty($atts['w_units'])) {
			$current_unit = 1; // imperial
			$current_temp_label = 'F';
			$current_speed_label = 'mph';
		}

		// prepare the data and do an api call
		$weather_data = array(
			'block_uid' => '',
			'location' => $atts['w_location'],
			'api_location' => '',  // the current location. It is updated by the wheater API
			'api_language' => '', //this is set down bellow
			'api_key' => $atts['w_key'],
			'today_icon' => '',
			'today_icon_text' => '',
			'today_temp' => array(
				0,  // metric
				0   // imperial
			),
			'today_humidity' => '',
			'today_wind_speed' => array(
				0, // metric
				0 // imperial
			),
			'today_min' => array(
				0, // metric
				0 // imperial
			),
			'today_max' => array(
				0, // metric
				0 // imperial
			),
			'today_clouds' => 0,
			'current_unit' => $current_unit,
			'forecast' => array()
		);


		// disable the cache for debugging
		// td_remote_cache::_disable_cache();
		$weather_data_status = self::get_weather_data($atts, $weather_data);

		// check if we have an error and return that
		if ($weather_data_status != 'api_fail_cache' and $weather_data_status != 'api' and $weather_data_status != 'cache') {
			return $weather_data_status;
		}

		// we have to patch the cached data - to make sure we have the REAL block_uid that is now on the page
		$weather_data['block_uid'] = $block_uid;


		// render the HTML
		$buffy = '<!-- td weather source: ' . $weather_data_status . ' -->';


		if ($template == 'block_template') {
			// renders the block template
			$buffy .= self::render_block_template($atts, $weather_data, $current_temp_label, $current_speed_label, $block_uid);
		} else if($template == 'tdb_weather_template') {
			// render the tdb weather template
			$buffy .= self::tdb_weather_template($atts, $weather_data, $current_temp_label);
		} else {
            // render the top menu template
            $buffy .= self::render_top_bar_template($atts, $weather_data, $current_temp_label);
        }


		// do not add any items to tdWeather if we're on the front end editor / ajax front end editor
		if (!td_util::tdc_is_live_editor_iframe() && !td_util::tdc_is_live_editor_ajax()) {
			// render the JS
			ob_start();
			?>
			<script>
				jQuery().ready(function () {
					tdWeather.addItem(<?php echo json_encode($weather_data) ?>);
				});
			</script>
			<?php
			//		$script_buffer = ob_get_clean();
			//		$js_script = "\n". td_util::remove_script_tag($script_buffer);
			td_js_buffer::add_to_footer("\n" . td_util::remove_script_tag(ob_get_clean()));
		}

		return $buffy;
	}


	/**
	 * renders the template that is used in the top bar of the site
	 * @param $atts - the atts that the block gets
	 * @param $weather_data - the precomputed weather data
	 * @param $current_temp_label - C/F
	 *
	 * @return string - HTML the rendered template
	 */
	private static function render_top_bar_template($atts, $weather_data, $current_temp_label)
	{
		$current_unit = $weather_data['current_unit'];
		ob_start();
		?>
		<div class="td-weather-top-widget" id="<?php echo $weather_data['block_uid'] ?>">
			<i class="td-icons <?php echo $weather_data['today_icon'] ?>"></i>
			<div class="td-weather-now" data-block-uid="<?php echo $weather_data['block_uid'] ?>">
				<span class="td-big-degrees"><?php echo $weather_data['today_temp'][$current_unit] ?></span>
				<span class="td-weather-unit"><?php echo $current_temp_label ?></span>
			</div>
			<div class="td-weather-header">
				<div class="td-weather-city"><?php echo $weather_data['api_location'] ?></div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}


    /**
     * renders the template that is used in the top bar of the site
     * @param $atts - the atts that the block gets
     * @param $weather_data - the precomputed weather data
     * @param $current_temp_label - C/F
     *
     * @return string - HTML the rendered template
     */
    private static function tdb_weather_template($atts, $weather_data, $current_temp_label)
    {
        $current_unit = $weather_data['current_unit'];
        ob_start();
        ?>
        <i class="td-icons <?php echo $weather_data['today_icon'] ?>"></i>
        <div class="tdb-weather-deg-wrap" data-block-uid="<?php echo $weather_data['block_uid'] ?>">
            <span class="tdb-weather-deg"><?php echo $weather_data['today_temp'][$current_unit] ?></span>
            <span class="tdb-weather-unit"><?php echo $current_temp_label ?></span>
        </div>
        <div class="tdb-weather-city"><?php echo $weather_data['api_location'] ?></div>
        <?php
        return ob_get_clean();
    }


	/**
	 * renders the template that is used on all weather blocks and widgets
	 * @param $atts - the atts that the block gets
	 * @param $weather_data - the precomputed weather data
	 * @param $current_temp_label - C/F
	 * @param $current_speed_label - mph/kmh
	 * @param $block_uid the unique id of the block
	 * @return string - HTML the rendered template
	 */
	private static function render_block_template($atts, $weather_data, $current_temp_label, $current_speed_label, $block_uid)
	{
		$current_unit = $weather_data['current_unit'];
		ob_start();
		?>

		<div class="td-weather-header">
			<div class="td-weather-city"><?php echo $weather_data['api_location'] ?></div>
			<div class="td-weather-condition"><?php echo $weather_data['today_icon_text'] ?></div>
			<i class="td-location-icon td-icons-location" data-block-uid="<?php echo $weather_data['block_uid'] ?>"></i>
		</div>

		<div class="td-weather-set-location">
			<form class="td-manual-location-form" action="#" data-block-uid="<?php echo $weather_data['block_uid'] ?>">
				<input id="<?php echo $weather_data['block_uid'] ?>" class="td-location-set-input" type="text"
					   name="location" value="">
				<label>enter location</label>
			</form>
		</div>

		<div class="td-weather-temperature">
			<div class="td-weather-temp-wrap">
				<div class="td-weather-animated-icon">
					<span
						class="td_animation_sprite-27-100-80-0-0-1 <?php echo $weather_data['today_icon'] ?> td-w-today-icon"
						data-td-block-uid="<?php echo $block_uid ?>"></span>
				</div>
				<div class="td-weather-now" data-block-uid="<?php echo $weather_data['block_uid'] ?>">
					<span class="td-big-degrees"><?php echo $weather_data['today_temp'][$current_unit] ?></span>
					<span class="td-circle">&deg;</span>
					<span class="td-weather-unit"><?php echo $current_temp_label; ?></span>
				</div>
				<div class="td-weather-lo-hi">
					<div class="td-weather-degrees-wrap">
						<i class="td-up-icon td-icons-arrows-up"></i>
						<span
							class="td-small-degrees td-w-high-temp"><?php echo $weather_data['today_max'][$current_unit] ?></span>
						<span class="td-circle">&deg;</span>
					</div>
					<div class="td-weather-degrees-wrap">
						<i class="td-down-icon td-icons-arrows-down"></i>
						<span
							class="td-small-degrees td-w-low-temp"><?php echo $weather_data['today_min'][$current_unit] ?></span>
						<span class="td-circle">&deg;</span>
					</div>
				</div>
			</div>
		</div>

		<div class="td-weather-info-wrap">
			<div class="td-weather-information">
				<div class="td-weather-section-1">
					<i class="td-icons-drop"></i>
					<span class="td-weather-parameter td-w-today-humidity"><?php echo $weather_data['today_humidity'] ?>
						%</span>
				</div>
				<div class="td-weather-section-2">
					<i class="td-icons-wind"></i>
					<span
						class="td-weather-parameter td-w-today-wind-speed"><?php echo $weather_data['today_wind_speed'][$current_unit] . $current_speed_label; ?></span>
				</div>
				<div class="td-weather-section-3">
					<i class="td-icons-cloud"></i>
					<span class="td-weather-parameter td-w-today-clouds"><?php echo $weather_data['today_clouds'] ?>
						%</span>
				</div>
			</div>


			<div class="td-weather-week">
				<?php
				$count = 0;
				foreach ($weather_data['forecast'] as $forecast_index => $day_forecast) {
					if ($count === 5) {
						break;
					}
					?>
					<div class="td-weather-days">
						<div class="td-day-<?php echo $forecast_index ?>"><?php echo $day_forecast['day_name'] ?></div>

						<div class="td-day-degrees">
							<span
								class="td-degrees-<?php echo $forecast_index ?>"><?php echo $day_forecast['day_temp'][$current_unit] ?></span>
							<span class="td-circle">&deg;</span>
						</div>
					</div>
					<?php
					$count++;
				}
				?>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}


	/**
	 * @param $atts
	 * @param $weather_data - the precomputed weather data
	 * @return bool|string
	 *  - bool:true - we have the $weather_data (from cache or from a real request)
	 *  - string - error message
	 */
	private static function get_weather_data($atts, &$weather_data)
	{
		if (empty($atts['w_language'])) {
			$atts['w_language'] = 'en';
			$sytem_locale = get_locale();
			$available_locales = array('en', 'es', 'sp', 'fr', 'it', 'de', 'pt', 'ro', 'pl', 'ru', 'uk', 'ua', 'fi', 'nl', 'bg', 'sv', 'se', 'ca', 'tr', 'hr', 'zh', 'zh_tw', 'zh_cn', 'hu');

			// CHECK FOR LOCALE
			if (in_array($sytem_locale, $available_locales)) {
				$atts['w_language'] = $sytem_locale;
			}
			// CHECK FOR LOCALE BY FIRST TWO DIGITS
			if (in_array(substr($sytem_locale, 0, 2), $available_locales)) {
				$atts['w_language'] = substr($sytem_locale, 0, 2);
			}
		}


		$cache_key = strtolower($atts['w_location'] . '_' . $atts['w_language'] . '_' . $weather_data['current_unit']);
		if (td_remote_cache::is_expired(__CLASS__, $cache_key) === true) {
			// cache is expired - do a request
			$today_api_data = self::owm_get_today_data($atts, $weather_data);
			$forecast_api_data = self::owm_get_five_days_data($atts, $weather_data);

			// check the api call response
			if ($today_api_data !== true or $forecast_api_data !== true) {
				// we have an error on one of the apis
				$weather_data = td_remote_cache::get(__CLASS__, $cache_key);
				if ($weather_data === false) {    // miss and io error... shit / die
					return self::error('Weather API error: ' . $today_api_data . ' ' . $forecast_api_data);
				}

				td_remote_cache::extend(__CLASS__, $cache_key, self::$caching_time);
				return 'api_fail_cache';
			}

			td_remote_cache::set(__CLASS__, $cache_key, $weather_data, self::$caching_time); //we have a reply and we set it
			return 'api';

		} else {
			// cache is valid
			$weather_data = td_remote_cache::get(__CLASS__, $cache_key);
			return 'cache';
		}

	}


	/**
	 * adds to the &$weather_data the information for today's forecast from OWM
	 * @param $atts - the shortcode atts
	 * @param $weather_data - BYREF weather data - this function will add to it
	 *
	 * @return bool|string
	 *   - true: if everything is ok
	 *   - string: the error message, if there was an error
	 */
	private static function owm_get_today_data($atts, &$weather_data) {

		if (is_numeric($atts['w_location'])) {
			$today_weather_url = 'https://api.openweathermap.org/data/2.5/weather?id=' . urlencode($atts['w_location']) . '&lang=' . $atts['w_language'] . '&units=metric&appid=' . $weather_data['api_key'];
		}
		else {
			$today_weather_url = 'https://api.openweathermap.org/data/2.5/weather?q=' . urlencode($atts['w_location']) . '&lang=' . $atts['w_language'] . '&units=metric&appid=' . $weather_data['api_key'];
		}
		//print("<pre>".print_r($today_weather_url,true)."</pre>");

		$json_api_response = td_remote_http::get_page($today_weather_url, __CLASS__);

		//print("<pre> json city weather API response: ".print_r($json_api_response,true)."</pre>");


		// fail
		if ($json_api_response === false) {
			td_log::log(__FILE__, __FUNCTION__, 'Api call failed', $today_weather_url);
			return 'Error getting remote data for today forecast. Please check your server configuration';
		}

		// try to decode the json
		$api_response = @json_decode($json_api_response, true);
		if ($api_response === null and json_last_error() !== JSON_ERROR_NONE) {
			td_log::log(__FILE__, __FUNCTION__, 'Error decoding the json', $api_response);
			return 'Error decoding the json from OpenWeatherMap';
		}

		if ($api_response['cod'] != 200) {
			if ($api_response['cod'] == 404) {
				return 'City not found'; // fix the incorect error message form the api :|
			}
			if (isset($api_response['message'])) {
				return $api_response['message'];
			}
			return 'OWM code != 200. No message provided';
		}

		//print_r($api_response);


		// set the language of the api
		$weather_data['api_language'] = $atts['w_language'];

		// current location
		if (isset($api_response['name'])) {
			$weather_data['api_location'] = $api_response['name'];
		}

		// min max current temperature
		if (isset($api_response['main']['temp'])) {
			$weather_data['today_temp'][0] = round($api_response['main']['temp'], 1);
			$weather_data['today_temp'][1] = self::celsius_to_fahrenheit($api_response['main']['temp']);
		}
		if (isset($api_response['main']['temp_min'])) {
			$weather_data['today_min'][0] = round($api_response['main']['temp_min'], 1);
			$weather_data['today_min'][1] = self::celsius_to_fahrenheit($api_response['main']['temp_min']);
		}
		if (isset($api_response['main']['temp_max'])) {
			$weather_data['today_max'][0] = round($api_response['main']['temp_max'], 1);
			$weather_data['today_max'][1] = self::celsius_to_fahrenheit($api_response['main']['temp_max']);
		}

		// humidity
		if (isset($api_response['main']['humidity'])) {
			$weather_data['today_humidity'] = round($api_response['main']['humidity']);
		}

		// wind speed and direction
		if (isset($api_response['wind']['speed'])) {
			$weather_data['today_wind_speed'][0] = round($api_response['wind']['speed'], 1);
			$weather_data['today_wind_speed'][1] = self::kmph_to_mph($api_response['wind']['speed']);
		}

		// forecast description
		if (isset($api_response['weather'][0]['description'])) {
			$weather_data['today_icon_text'] = $api_response['weather'][0]['description'];
		}

		// clouds
		if (isset($api_response['clouds']['all'])) {
			$weather_data['today_clouds'] = round($api_response['clouds']['all']);
		}

		// icon
		if (isset($api_response['weather'][0]['icon'])) {
			$icons = array(
				// day
				'01d' => 'clear-sky-d',
				'02d' => 'few-clouds-d',
				'03d' => 'scattered-clouds-d',
				'04d' => 'broken-clouds-d',
				'09d' => 'shower-rain-d',   // ploaie hardcore
				'10d' => 'rain-d',          // ploaie light
				'11d' => 'thunderstorm-d',
				'13d' => 'snow-d',
				'50d' => 'mist-d',

				//night
				'01n' => 'clear-sky-n',
				'02n' => 'few-clouds-n',
				'03n' => 'scattered-clouds-n',
				'04n' => 'broken-clouds-n',
				'09n' => 'shower-rain-n',   // ploaie hardcore
				'10n' => 'rain-n',          // ploaie light
				'11n' => 'thunderstorm-n',
				'13n' => 'snow-n',
				'50n' => 'mist-n',
			);

			$weather_data['today_icon'] = 'clear-sky-d'; // the default icon :) if we get an error or strange icons as a reply
			if (isset($icons[$api_response['weather'][0]['icon']])) {
				$weather_data['today_icon'] = $icons[$api_response['weather'][0]['icon']];
			}
		}  // end icon

		return true;  // return true if ~everything is ok
	}

	/**
	 * adds to the &$weather_data the information for the next 5 days
	 * @param $atts - the shortcode atts
	 * @param $weather_data - BYREF weather data - this function will add to it
	 *
	 * @return bool|string
	 *   - true: if everything is ok
	 *   - string: the error message, if there was an error
	 */
	private static function owm_get_five_days_data($atts, &$weather_data)
	{
		// request 7 days because the current day may be today in a different timezone
		if (is_numeric($atts['w_location'])) {
			$today_weather_url = 'https://api.openweathermap.org/data/2.5/forecast?id=' . urlencode($atts['w_location']) . '&lang=' . $atts['w_language'] . '&units=metric&cnt=35&appid=' . $weather_data['api_key'];
		}
		else {
			$today_weather_url = 'https://api.openweathermap.org/data/2.5/forecast?q=' . urlencode($atts['w_location']) . '&lang=' . $atts['w_language'] . '&units=metric&cnt=35&appid=' . $weather_data['api_key'];
		}
		//print("<pre>".print_r($today_weather_url,true)."</pre>");

		$json_api_response = td_remote_http::get_page($today_weather_url, __CLASS__);

		//print("<pre> json city forecast API response: ".print_r($json_api_response,true)."</pre>");


		// fail
		if ($json_api_response === false) {
			td_log::log(__FILE__, __FUNCTION__, 'Api call failed', $today_weather_url);
			return 'Error getting remote data for 5 days forecast. Please check your server configuration';
		}

		// try to decode the json
		$api_response = @json_decode($json_api_response, true);
		if ($api_response === null and json_last_error() !== JSON_ERROR_NONE) {
			td_log::log(__FILE__, __FUNCTION__, 'Error decoding the json', $api_response);
			return 'Error decoding the json from OpenWeatherMap';
		}

		// today in format like: 20150210
		//$today_date = date('Y-m-d', current_time('timestamp', 0));

		if (!empty($api_response['list']) and is_array($api_response['list'])) {
			$tmp_temps = array();

			foreach ($api_response['list'] as $index => $day_forecast) {

				if (
					!empty($day_forecast['dt'])
					and !empty($day_forecast['main']['temp'])
				) {// because the api return UTC time and we may have different timezones on the server. Avoid showing the same day twice

					$current_day = date('j', $day_forecast['dt']);

					if (!isset($tmp_temps[$current_day])) {
						$tmp_temps[$current_day]= array (
							'timestamp' => $day_forecast['dt'],
							'day_name' => date_i18n('D', $day_forecast['dt']),
							'day_temp' => array(
								round($day_forecast['main']['temp_max']),                              // metric
								round(self::celsius_to_fahrenheit($day_forecast['main']['temp_max']))  //imperial
							),
							'owm_day_index' => $index, // used in js to update only the displayed days when we do api calls from JS
						);
					} else {

						if ($tmp_temps[$current_day]['day_temp'][0] < round($day_forecast['main']['temp_max'])) {

							$tmp_temps[$current_day]['day_temp'][0] = round($day_forecast['main']['temp_max']);                               // metric
							$tmp_temps[$current_day]['day_temp'][1] = round(self::celsius_to_fahrenheit($day_forecast['main']['temp_max']));  //imperial
						}
					}
				}

			}

			$weather_data['forecast'] = array_values($tmp_temps);
			return true;
		}
		return false; // return true if ~everything is ok
	}


	/**
	 * convert celsius to fahrenheit + rounding (no decimals if result > 100 or one decimal if result < 100)
	 * @param $celsius_degrees
	 * @return float
	 */
	private static function celsius_to_fahrenheit($celsius_degrees)
	{
		$f_degrees = $celsius_degrees * 9 / 5 + 32;

		$rounded_val = round($f_degrees, 1);
		if ($rounded_val > 99.9) {  // if the value is bigger than 100, round it with no zecimals
			return round($f_degrees);
		}

		return $rounded_val;
	}


	/**
	 * rounding to .1
	 * @param $kmph
	 * @return float
	 */
	private static function kmph_to_mph($kmph)
	{
		return round($kmph * 0.621371192, 1);
	}


	/**
	 * Show an error if the user is logged in. It does not check for admin
	 * @param $msg
	 * @return string
	 */
	private static function error($msg)
	{
		if (is_user_logged_in()) {
			return $msg;
		}
		return '';
	}


}