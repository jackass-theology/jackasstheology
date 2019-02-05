<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 12.01.2018
 * Time: 11:24
 */

class td_css_res_compiler  {

	private $raw_css;
	private $callback;
	private $settings;

	private $responsive_context;

	function __construct( $raw_css ) {
		$this->raw_css = $raw_css;
	}

	/**
	 * @return td_res_context
	 */
	function get_responsive_context() {
		return $this->responsive_context;
	}

	function load_settings( $callback, $atts, $index_style = '' ) {

		if ( empty( $callback ) || empty( $atts ) ) {
			return;
		}

		$this->callback = $callback;

		$this->responsive_context = new td_res_context( $index_style );

		$settings = null;

//		echo '<pre>';
//		var_dump($atts);
//		echo '</pre>';
//		die;

		foreach ( $atts as $att_name => $att_value ) {

			if ( 'tdc_css' === $att_name ) {
				continue;
			}

			$responsive_values = null;

			// Detect base64 encoding
			if ( is_string( $att_value ) && base64_decode( $att_value, true ) && base64_encode( base64_decode( $att_value, true ) ) === $att_value && mb_detect_encoding( base64_decode( $att_value, true ) ) === mb_detect_encoding( $att_value ) ) {

				$decoded_values = base64_decode( $att_value, true );
				$values         = json_decode( $decoded_values, true );

				if( is_array( $values ) ) {
                    // The responsive encoded values have keys(all, landscape, portrait, )
                    $result_keys = array_intersect( array_keys( $values ), array_keys( td_global::$viewport_settings ) );
                    if ( ! empty( $result_keys ) ) {
                        $responsive_values = $values;
                    }
                }
			}

			if ( ! empty( $responsive_values ) ) {

				if ( is_array( $responsive_values ) ) {

					foreach ( $responsive_values as $media => $value ) {

						if ( ! isset( $settings ) ) {
							$settings = array();
						}

						if ( ! isset( $settings[ $media ] ) ) {
							$settings[ $media ] = array();
						}

						if ( array_key_exists( $media, td_global::$viewport_settings ) ) {
							$settings[ $media ][ $att_name ] = $value;
						}
					}
				}

				// mark att as responsive
				$this->responsive_context->set_responsive_att( $att_name );

			} else {

				if ( ! isset( $settings ) ) {
					$settings = array();
				}
				if ( ! isset( $settings['all'] ) ) {
					$settings['all'] = array();
				}
				$settings['all'][ $att_name ] = $att_value;
			}
		}

//		echo '<pre>';
//		var_dump($settings);
//		echo '</pre>';
//		die;

		// normalize
		if ( isset( $settings ) ) {

			// This keep the order: all, landscape, portrait, phone - and has all registered medias
			foreach ( td_global::$viewport_settings as $media1 => $media_settings1 ) {

				if ( ! isset( $settings[$media1] ) ) {
					$settings[$media1] = array();
				}

				if ( 'all' !== $media1 ) {

					$all_keys = array_diff_key( $settings['all'], $settings[ $media1 ] );

					if ( ! empty( $all_keys ) ) {
						foreach ( $all_keys as $key1 => $val1 ) {
							$settings[ $media1 ][ $key1 ] = $settings['all'][ $key1 ];
						}
					}
				}

				foreach ( td_global::$viewport_settings as $media2 => $media_settings2 ) {

					if ( $media1 === $media2 ) {
						continue;
					}

					if ( ! isset( $settings[$media2] ) ) {
						$settings[$media2] = array();
					}

					$diff_keys = array_diff_key ( $settings[$media2], $settings[$media1] );

					if ( ! empty( $diff_keys ) ) {
						foreach ( $diff_keys as $key2 => $val2 ) {
							$settings[ $media1 ][ $key2 ] = '';
						}
					}
				}
			}
		}

//		echo '<pre>';
//		var_dump(td_global::$viewport_settings);
//		echo '</pre>';
//		die;
//
//		echo '<pre>';
//		var_dump($settings);
//		echo '</pre>';
//		die;

		// apply callback
		if ( isset( $settings ) ) {
			foreach ( $settings as $media => $media_settings ) {
				$this->responsive_context->set_current_media( $media );
				$this->responsive_context->set_atts( $media_settings );

//				echo '<pre>';
//				var_dump($media);
//				var_dump($media_settings);
//				echo '</pre>';

				call_user_func( $this->callback, $this->responsive_context );
			}
		}
	    $settings = $this->responsive_context->get_settings();


		// simplify
		foreach ( $settings as $media => $media_settings ) {
			if ( 'all' === $media ) {
				continue;
			}
			foreach ( $media_settings as $key => $val ) {

				// Do not touch keys starting with 'all_' (they are maintained for each media to be used for combined css settings)
				if ( 0 !== strpos( $key, 'all_') && isset( $settings['all'][ $key ] ) && $settings['all'][ $key ] === $val ) {
					unset( $settings[ $media ][ $key ] );
				}
			}
			if ( empty( $settings[ $media ] ) ) {
				unset( $settings[ $media ] );
			}
		}

//		var_dump($settings);
//		die;

		// set settings to the current instance
		$this->settings = $settings;
	}

	/**
	 * @return string
	 */
	function compile_css() {

		$compiled_css = '';

		$fonts_to_load = $this->get_responsive_context()->get_fonts_to_load();

		if ( td_util::tdc_is_live_editor_ajax() && ! empty( $fonts_to_load ) ) {

			$td_options = td_options::get_all();

			foreach ( $fonts_to_load as $font_id => $font_family_name ) {

				if ( is_numeric( $font_id ) ) {
					$compiled_css .= '@import url("https://fonts.googleapis.com/css?family=' . $font_family_name . '");' . PHP_EOL;

				} else if ( 0 === strpos( $font_id, 'file_' ) ) {

					$font_file_link = $td_options['td_fonts_user_inserted']['font_' . $font_id];

					$compiled_css .= ' @font-face {' .
						'font-family:"' . $font_family_name . '";' .
						'src:local("' . $font_family_name . '"), url(' . $font_file_link . ') format("woff");}' . PHP_EOL;

				}
			}
		}

		// This keep the order: all, landscape, portrait, phone.
		foreach ( td_global::$viewport_settings as $media => $media_settings ) {

			if ( isset( $this->settings[ $media ] ) ) {

				$css_compiler = new td_css_compiler( $this->raw_css );

				foreach ( $this->settings[ $media ] as $param_name => $param_value ) {

					$css_compiler->load_setting_raw( $param_name, $param_value );
				}

				if ( 'all' === $media ) {
					$compiled_css .= $css_compiler->compile_css();
				} else {
					$compiled_css .= PHP_EOL . PHP_EOL . '/* ' . $media . ' */'. PHP_EOL . td_global::$viewport_settings[ $media ]['media_query'] . '{' . PHP_EOL;
					$compiled_css .= $css_compiler->compile_css() .  PHP_EOL;
					$compiled_css .= '}';
				}
			}
		}

		return $compiled_css;
	}
}



class td_res_context {

	private $settings;
	private $current_media;
	private $atts;

	public $index_style;

	// $atts not base64encoded
	private $responsive_atts = array();

	private $fonts_to_load = array();

	function __construct( $index_style = '' ) {
        $this->index_style = $index_style;
        $this->settings = array();
	}


	function set_settings( $settings ) {
		$this->settings = $settings;
	}
	function get_settings() {
		return $this->settings;
	}

	function set_current_media( $media ) {
		$this->current_media = $media;
	}
	function get_current_media() {
		return $this->current_media;
	}


    function get_current_settings() {
		return $this->settings[ $this->current_media ];
	}

	function load_settings_raw( $param_name, $param_value ) {
	    $this->settings[ $this->current_media ][ $param_name ] = $param_value;
    }


	function is( $current_media_id ) {
		return $current_media_id === $this->current_media;
	}


	function get_shortcode_att( $att_name ) {
		return $this->get_att( $att_name, '', $this->index_style );
	}


	function get_att_name( $att_name, $style_class = '', $index_style = '' ) {
		if ( ! empty( $style_class ) ) {
			$att_name = $style_class . '-' . $att_name;
		}
		if ( ! empty( $index_style ) ) {
			$att_name .= '-' . $index_style;
		}
		return $att_name;
	}


	function get_att( $att_name, $style_class = '', $index_style = '' ) {
		$atts = $this->get_atts();
		if ( empty( $atts ) ) {
			td_util::error(__FILE__, get_class($this) . '->get_att(' . $att_name . ') Internal error: The atts are not set yet(AKA: the render template method was called without atts)');
			die;
		}

		$key = $this->get_att_name( $att_name, $style_class, $index_style );

		if ( ! isset( $atts[ $key ] ) ) {
			var_dump( $atts );
			td_util::error(__FILE__, 'Internal error: The system tried to use an att that does not exists! class_name: ' . get_class($this) . '  Att name: "' . $att_name . '" as "' . $key . '"');
			die;
		}

		return $atts[ $key ];
	}


	function get_style_att( $att_name, $style_class ) {
        return $this->get_att( $att_name, $style_class, $this->index_style );
    }


    function set_atts( $atts ) {
		$this->atts = $atts;
	}
	function get_atts() {
        return $this->atts;
    }


	function get_fonts_to_load() {
		return $this->fonts_to_load;
	}


	function set_responsive_att( $att ) {
		$this->responsive_atts[] = $att;
	}

	function is_responsive_att( $att ) {
		return in_array( $att, $this->responsive_atts );
	}


	function load_font_settings( $param_name = '', $style_class = '' ) {
		$font_family_list = td_util::get_font_family_list( false );

		$font_settings = array(
			'font_family' => 'font-family',
			'font_size' => 'font-size',
			'font_line_height' => 'line-height',
			'font_style' => 'font-style',
			'font_weight' => 'font-weight',
			'font_transform' => 'text-transform',
			'font_spacing' => 'letter-spacing'
		);

		$param_value = '';

		foreach ( $font_settings as $font_param_name => $font_setting ) {

			$font_setting_name = $font_param_name;
			if ( ! empty( $param_name ) ) {
				$font_setting_name = $param_name . '_' . $font_setting_name;
			}

			if ( empty( $style_class ) ) {
				$font_setting_value = $this->get_shortcode_att( $font_setting_name );
			} else {
				$font_setting_value = $this->get_style_att( $font_setting_name, $style_class );
			}

			switch( $font_setting ) {
				case 'font-family':

					if ( '' !== $font_setting_value ) {

						if ( ! isset( $this->fonts_to_load[ $font_setting_value ] ) ) {
							$this->fonts_to_load[ $font_setting_value ] = $font_family_list[ $font_setting_value ];
						}
						$font_setting_value = $font_family_list[ $font_setting_value ];
					}
					break;

				case 'font-size':
				case 'letter-spacing':
					if ( is_numeric( $font_setting_value ) ) {
						$font_setting_value .= 'px';
					}
					break;
			}

			if ( '' !== $font_setting_value ) {
				//$this->load_settings_raw( $font_setting_name, $font_setting_value );
				$param_value .= $font_setting . ':' . $font_setting_value . ' !important;';
			}
		}

		$this->load_settings_raw( $param_name, $param_value );
	}


	function load_shadow_settings( $default_shadow_size, $default_shadow_offset_h, $default_shadow_offset_v, $default_shadow_spread, $default_shadow_color, $param_name = '', $style_class = '' ) {

		$param_value = '';

		$shadow_settings = array(
			'shadow_offset_horizontal',
			'shadow_offset_vertical',
			'shadow_size',
            'shadow_spread',
			'shadow_color',
		);

		foreach ( $shadow_settings as $shadow_param_name ) {
			$shadow_setting_name = $shadow_param_name;
			if ( ! empty( $param_name ) ) {
				$shadow_setting_name = $param_name . '_' . $shadow_setting_name;
			}

			if ( empty( $style_class ) ) {
				$shadow_setting_value = $this->get_shortcode_att( $shadow_setting_name );
			} else {
				$shadow_setting_value = $this->get_style_att( $shadow_setting_name, $style_class );
			}

			if ( 'shadow_size' === $shadow_param_name ) {
				if ( 0 === $shadow_setting_value || '0' === $shadow_setting_value ) {
					$this->load_settings_raw( $param_name, 'none' );
					return;
				}
				if ( '' === $shadow_setting_value ) {
					if ( 0 === $default_shadow_size ) {
						return;
					}

					$shadow_setting_value = $default_shadow_size;
				}

                if( $shadow_setting_value < 0 ) {
                    $param_value = 'inset' . $param_value;
                    $shadow_setting_value = abs($shadow_setting_value);
                }
			}

            if ( 'shadow_offset_horizontal' === $shadow_param_name && '' === $shadow_setting_value) {
                $shadow_setting_value = $default_shadow_offset_h;
            }
            if ( 'shadow_offset_vertical' === $shadow_param_name && '' === $shadow_setting_value ) {
                $shadow_setting_value = $default_shadow_offset_v;
            }
            if ( 'shadow_spread' === $shadow_param_name && '' === $shadow_setting_value ) {
                $shadow_setting_value = $default_shadow_spread;
            }
			if ( 'shadow_color' === $shadow_param_name && '' === $shadow_setting_value ) {
                $shadow_setting_value = $default_shadow_color;
			}

            if ( is_numeric( $shadow_setting_value ) ) {
                $shadow_setting_value .= 'px';
            }

			$param_value .= ' ' . $shadow_setting_value;
		}

		$this->load_settings_raw( $param_name, $param_value );
	}


	function load_color_settings( $shortcode_att_id, $color_id = '', $gradient_id = '', $gradient_color = '', $gradient_params = '', $style_class = '' ) {

		if ( empty( $style_class ) ) {
			$shortcode_att = $this->get_shortcode_att( $shortcode_att_id );
		} else {
			$shortcode_att = $this->get_style_att( $shortcode_att_id, $style_class );
		}

	    if ( ! empty( $shortcode_att ) ) {

		    if ( base64_decode( $shortcode_att, true ) && base64_encode( base64_decode( $shortcode_att, true ) ) === $shortcode_att && mb_detect_encoding( base64_decode( $shortcode_att, true ) ) === mb_detect_encoding( $shortcode_att ) ) {

		        $decoded_values = base64_decode( $shortcode_att, true );
				$att         = json_decode( $decoded_values, true );

			        if ( ! empty ( $gradient_id ) && ! empty ( $att['css'] ) ) {
		                $this->load_settings_raw( $gradient_id, $att['css'] );
				    if ( ! empty ( $gradient_color ) && ! empty( $att['color1'] ) ) {
					    $this->load_settings_raw( $gradient_color, $att['color1'] );
				    }
				    if ( ! empty ( $gradient_params ) && ! empty( $att['cssParams'] ) ) {
					    $this->load_settings_raw( $gradient_params, $att['cssParams'] );
				    }
			    }
		    } else {
			    if ( ! empty ( $color_id ) ) {
				    $this->load_settings_raw( $color_id, $shortcode_att );
			    }
		    }
	    }
	}
}
