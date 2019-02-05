<?php
/**
 * Created by ra.
 * Date: 3/31/2016
 */

class tdc_mapper {


	private static $mapped_shortcodes;

	private static $mapped_block_templates;

	private static $external_shortcodes = array();


	/**
	 * Mapper function - it registers a new shortcode in tagDiv Composer. Please note that you still have to manually register the shortcode
	 * in WordPress
	 * This does not use the 'map_in_visual_composer' attribute. We map anything that is sent here! the atribute is used in tdc_map.php
	 * @param $attributes
	 */
	static function map_shortcode($attributes) {
		// 'base' attribute is requiered! is used as a key. It's probably some kind of backwards compatibility in VC
		if (!isset($attributes['base'])) {
		    echo 'The base attribute is requiered for all the shortcodes';
		}

		if (isset(self::$mapped_shortcodes[$attributes['base']])) {
		    echo 'Shortcode ' . $attributes['base'] . ' already mapped, please use the update method to update it!';
		}

		self::$mapped_shortcodes[$attributes['base']] = $attributes;
	}


	/**
	 * Save the mapped block templates to the composer (each block mapping being changed according with its block template setting)
	 *
	 * @param $attibutes
	 */
	static function map_block_templates($attibutes) {
		self::$mapped_block_templates = $attibutes;
	}



	/**
	 * @param $base
	 * @return bool
	 */
	static function get_attributes($base) {
		if (isset(self::$mapped_shortcodes[$base])) {
			return self::$mapped_shortcodes[$base];
		}

		echo 'Shortcode with base ' . $base . ' is not mapped!';
		return false;
	}



	static function get_mapped_shortcodes() {
		return self::$mapped_shortcodes;
	}

	static function get_mapped_block_templates() {
		return self::$mapped_block_templates;
	}



	static function set_external_shortcodes( $external_shortcodes ) {
		self::$external_shortcodes = $external_shortcodes;
	}

	static function add_external_shortcodes( $external_shortcodes ) {
		self::$external_shortcodes = array_merge( self::$external_shortcodes, $external_shortcodes );
	}

	static function get_external_shortcodes() {
		return self::$external_shortcodes;
	}




	// @todo this should be removed
	static function _debug_get_all() {
		return self::$mapped_shortcodes;
	}
}
