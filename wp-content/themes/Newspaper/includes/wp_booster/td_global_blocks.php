<?php
/**
 * td_global_blocks.php
 * no td_util loaded, no access to settings
 */


class td_global_blocks {
    private static $global_instances = array();
    private static $global_id_lazy_instances = array();

    /**
     * @param $block_instance
     * @deprecated Use add_id instead of it. It's maintained just for plugin compatibility
     */
    static function add_instance($block_instance) {
    }

    /**
     * @param $block_id string keeps a reference of the block for lazy instance
     */
    static function add_lazy_shortcode($block_id) {
        self::$global_id_lazy_instances[] = $block_id;
        add_shortcode($block_id, array('td_global_blocks', 'proxy_function'));
    }

    static function proxy_function($atts, $content, $tag) {
        $block_html = self::get_instance($tag)->render((array)$atts, $content);
        return $block_html;
    }

    static function get_instance($block_id) {
        if (isset(self::$global_instances[$block_id])) {
            return self::$global_instances[$block_id];
        } else if (in_array($block_id, self::$global_id_lazy_instances)) {
            $new_instance = new $block_id();
            self::$global_instances[$block_id] = $new_instance;
            return $new_instance;
        } else {
            /**
             * return a fake new instance of td_block - so that we have the render() method for decoupling - when the blocks are deleted :)  @todo wtf?
             */
            return new td_block();
        }
    }


    /**
     * map all the blocks in the pagebuilder
     */
    static function td_vc_map_all() {
        //print_r(td_block_api::get_all()); die;

        foreach (td_api_block::get_all() as $block_settings) {
            // shortcodes that have no $block_settings['map_in_visual_composer'] are maped!
            // shrotcodes that have $block_settings['map_in_visual_composer'] !== false are maped
            if (isset($block_settings['map_in_visual_composer']) and $block_settings['map_in_visual_composer'] !== false) {

	            $new_block_params = array();

	            // Throw out from vc mapping, the elements that broke vc admin modals
	            if ( isset( $block_settings['params'] ) ) {
		            foreach( $block_settings['params'] as $param ) {
			            if ( ( isset($param['group']) && 'Style' === $param['group'] ) ||
			                strpos( $param['type'], 'responsive') !== false ||
			                strpos( $param['type'], 'font') !== false ||
			                strpos( $param['type'], 'separator') !== false ||
			                strpos( $param['type'], 'clearfix') !== false ) {
							continue;
			            }
			            $new_block_params[] = $param;
		            }
	            }

	            $block_settings['params'] = $new_block_params;

                vc_map($block_settings);
            }
        }
    }


    static function debug_get_all_instances() {
        return self::$global_instances;
    }

    static function debug_get_all_id_lazy_instances() {
        return self::$global_id_lazy_instances;
    }


    /**
     * @deprecated PLEASE REMOVE. The full atts are already on the base class with default values
     * @param $class_name
     * @return array
     */
	static function get_mapped_atts( $class_name ) {

		$mapped_atts = array();
		$api_block_settings = td_api_block::get_all();
		// not all blocks have params - td_block_mega_menu does not have them
		if (!isset($api_block_settings[ $class_name ]['params'])) {
		    return array();
        }
		$mapped_params = $api_block_settings[ $class_name ]['params'];

		foreach ( $mapped_params as $mapped_param ) {
			$value = $mapped_param['value'];
			if ( is_array( $value ) ) {
				foreach ( $value as $key => $val ) {
					$value = $val;
					break;
				}
			}
			$mapped_atts[$mapped_param['param_name']] = $value;
		}
		return $mapped_atts;
	}
}