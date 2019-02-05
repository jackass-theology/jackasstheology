<?php
/**
 * Created by ra.
 * Date: 7/19/2016
 */

class td_live_css_util {
	//generate unique_ids
	private static $unique_id_counter = 0;

	static function td_generate_unique_id() {
		self::$unique_id_counter++;
		return 'td_live_css_uid_' . self::$unique_id_counter . '_' . uniqid();
	}
}
