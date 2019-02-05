<?php
/**
 * Created by PhpStorm.
 * User: marius
 * Date: 1/26/2018
 * Time: 3:27 PM
 */

class td_config_helper {

	// fonts atts
	static function get_map_block_font_array( $param_name, $font_header = false, $font_title = '', $group = '', $index_style = '' ) {

		$params = td_fonts::get_block_font_params();

		array_unshift( $params, array(
				"param_name" => "font_settings",
				"type" => "font_settings",
				"value" => '',
				"class" => '',
			)
		);

		if ( ! empty( $font_title ) ) {
			array_unshift( $params, array(
					"param_name" => "font_title",
					"type" => "font_title",
					"value" => $font_title,
					"class" => '',
				)
			);
		}

		if ( $font_header ) {
			array_unshift( $params, array(
					"param_name" => "font_header",
					"type" => "font_header",
					"value" => '',
					"class" => '',
				)
			);
		}

		foreach ( $params as &$param ) {
			$param['param_name'] = $param_name . '_' . $param['param_name'];

			if ( ! empty( $group ) ) {
				$param['group'] = $group;
			}

			if ( ! empty( $index_style ) ) {
				$param['param_name'] .= '-' . $index_style;
			}
		}
		return $params;
	}


	static function get_map_block_shadow_array( $param_name, $shadow_title, $shadow_size, $shadow_offset_h, $shadow_offset_v, $group = '', $index_style = '', $shadow_spread = 0, $shadow_header = true ) {
		$params = array(
		    array(
                "param_name" => "shadow_size",
                "type" => "textfield-responsive",
                "value" => '',
                "heading" => '',
                'class' => 'tdc-shadow-contr-textfield',
                'description' => 'Change shadow size',
                'placeholder' => '',
            ),
            array(
                "param_name" => "shadow_offset_horizontal",
                "type" => "textfield-responsive",
                "value" => '',
                "heading" => '',
                'class' => 'tdc-shadow-contr-textfield',
                'description' => 'Change shadow horizontal offset',
                'placeholder' => '',
            ),
            array(
                "param_name" => "shadow_offset_vertical",
                "type" => "textfield-responsive",
                "value" => '',
                "heading" => '',
                'class' => 'tdc-shadow-contr-textfield',
                'description' => 'Change shadow vertical offset',
                'placeholder' => '',
            ),
            array(
                "param_name" => "shadow_spread",
                "type" => "textfield-responsive",
                "value" => '',
                "heading" => '',
                'class' => 'tdc-shadow-contr-textfield',
                'description' => 'Change shadow spread',
                'placeholder' => '',
            ),
            array(
                "param_name" => "shadow_color",
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "tdc-shadow-contr-color",
                "heading" => '',
                "value" => '',
                "description" => 'Change shadow color',
            ),
        );

        array_unshift( $params, array(
                "param_name" => "shadow_title",
                "type" => "shadow_title",
                "value" => $shadow_title,
                "class" => '',
            )
        );

        //echo $param_name . ': ' . $shadow_header . ';';

        if ( $shadow_header ) {
            array_unshift( $params, array(
                    "param_name" => "shadow_header",
                    "type" => "shadow_header",
                    "value" => '',
                    "class" => '',
                )
            );
        }

		foreach ( $params as &$param ) {

	        if( $param['param_name'] == 'shadow_size' ) {
                $param['placeholder'] = $shadow_size;
            } else if( $param['param_name'] == 'shadow_offset_horizontal' ) {
                $param['placeholder'] = $shadow_offset_h;
            } else if( $param['param_name'] == 'shadow_offset_vertical' ) {
                $param['placeholder'] = $shadow_offset_v;
            } else if( $param['param_name'] == 'shadow_spread' ) {
                $param['placeholder'] = $shadow_spread;
            }
            if ( ! empty( $group ) ) {
                $param['group'] = $group;
            }

	        $param['param_name'] = $param_name . '_' . $param['param_name'];

	        if ( ! empty( $index_style ) ) {
		        $param['param_name'] .= '-' . $index_style;
	        }

        }
        return $params;
	}


	// block general fonts
	static function block_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Block fonts',
					"value" => "",
					"class" => "",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'f_header', true, 'Block header', 'Style' ),
			self::get_map_block_font_array( 'f_ajax', false, 'Ajax categories', 'Style' ),
			self::get_map_block_font_array( 'f_more', false, 'Load more button', 'Style' )
		);
	}

	// module 1 fonts
	static function module_1_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 1 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm1f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm1f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm1f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module 2 fonts
	static function module_2_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 2 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm2f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm2f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm2f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm2f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module 3 fonts
	static function module_3_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 3 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm3f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm3f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm3f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module 4 fonts
	static function module_4_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 4 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm4f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm4f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm4f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm4f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module 5 fonts
	static function module_5_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 5 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm5f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm5f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm5f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm5f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module 6 fonts
	static function module_6_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 6 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm6f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm6f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm6f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module 7 fonts
	static function module_7_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 7 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm7f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm7f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm7f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module 8 fonts
	static function module_8_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 8 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm8f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm8f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm8f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module 9 fonts
	static function module_9_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 9 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm9f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm9f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm9f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module 10 fonts
	static function module_10_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 10 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm10f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm10f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm10f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm10f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module 11 fonts
	static function module_11_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 11 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm11f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm11f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm11f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm11f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'm11f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module 12 fonts
	static function module_12_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 12 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm12f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm12f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm12f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm12f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'm12f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module 13 fonts
	static function module_13_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 13 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm13f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm13f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm13f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm13f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module 14 fonts
	static function module_14_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 14 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm14f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm14f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm14f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm14f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'm14f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module 15 fonts
	static function module_15_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 15 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm15f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm15f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm15f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm15f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module 16 fonts
	static function module_16_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 16 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm16f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm16f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm16f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm16f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module 17 fonts
	static function module_17_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 17 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm17f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm17f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm17f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm17f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'm17f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module 18 fonts
	static function module_18_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 18 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm18f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm18f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm18f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm18f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'm18f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module 19 fonts
	static function module_19_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module 19 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'm19f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'm19f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'm19f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'm19f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'm19f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module mx1 fonts
	static function module_mx1_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX1 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx1f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx1f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx1f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx2 fonts
	static function module_mx2_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX2 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx2f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx2f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx2f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx3 fonts
	static function module_mx3_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX3 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx3f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx3f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx3f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx4 fonts
	static function module_mx4_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX4 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx4f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx4f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx5 fonts
	static function module_mx5_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX5 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx5f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx5f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx5f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx6 fonts
	static function module_mx6_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX6 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx6f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx6f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx7 fonts
	static function module_mx7_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX7 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx7f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx7f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx7f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'mx7f_ex', false, 'Article excerpt', 'Style' )
		);
	}

	// module mx8 fonts
	static function module_mx8_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX8 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx8f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx8f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx8f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx9 fonts
	static function module_mx9_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX9 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx9f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx9f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx9f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx10 fonts
	static function module_mx10_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX10 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx10f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx10f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx11 fonts
	static function module_mx11_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX11 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx11f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx11f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx12 fonts
	static function module_mx12_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX12 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx12f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx12f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx12f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx13 fonts
	static function module_mx13_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX13 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx13f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx13f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx14 fonts
	static function module_mx14_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX14 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx14f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx14f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx14f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx15 fonts
	static function module_mx15_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX15 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx15f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx15f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx15f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx16 fonts
	static function module_mx16_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX16 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx16f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx16f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx16f_meta', false, 'Article meta info', 'Style' ),
			self::get_map_block_font_array( 'mx16f_ex', false, 'Article excerpt', 'Style' ),
			self::get_map_block_font_array( 'mx16f_btn', false, 'Article read more button', 'Style' )
		);
	}

	// module mx17 fonts
	static function module_mx17_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX17 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx17f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx17f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx17f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx18 fonts
	static function module_mx18_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX18 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx18f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx18f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx18f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx19 fonts
	static function module_mx19_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX19 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx19f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx19f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx19f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx20 fonts
	static function module_mx20_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX20 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx20f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx20f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx20f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx21 fonts
	static function module_mx21_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX21 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx21f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx21f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx21f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx22 fonts
	static function module_mx22_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX22 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx22f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx22f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx22f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx23 fonts
	static function module_mx23_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX23 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx23f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx23f_cat', false, 'Article category tag', 'Style' ),
			self::get_map_block_font_array( 'mx23f_meta', false, 'Article meta info', 'Style' )
		);
	}

	// module mx24 fonts
	static function module_mx24_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX24 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx24f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx24f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx25 fonts
	static function module_mx25_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX25 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx25f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx25f_cat', false, 'Article category tag', 'Style' )
		);
	}

	// module mx26 fonts
	static function module_mx26_font() {
		return array_merge(
			array(
				array(
					"param_name" => "separator",
					"type" => "text_separator",
					'heading' => 'Module MX26 fonts',
					"value" => "",
					"class" => "tdc-separator-small",
					"group" => 'Style',
				)
			),
			self::get_map_block_font_array( 'mx26f_title', true, 'Article title', 'Style' ),
			self::get_map_block_font_array( 'mx26f_cat', false, 'Article category tag', 'Style' )
		);
	}

    // module slide fonts
    static function module_slide_font() {
        return array_merge(
            array(
                array(
                    "param_name" => "separator",
                    "type" => "text_separator",
                    'heading' => 'Module slide fonts',
                    "value" => "",
                    "class" => "tdc-separator-small",
                    "group" => 'Style',
                )
            ),
            self::get_map_block_font_array( 'msf_title', true, 'Article title', 'Style' ),
            self::get_map_block_font_array( 'msf_cat', false, 'Article category tag', 'Style' ),
            self::get_map_block_font_array( 'msf_meta', false, 'Article meta info', 'Style' )
        );
    }
}