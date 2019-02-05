<?php
/**
 * Created by ra.
 * Date: 3/7/2016
 */




class tdc_util {
	private static $unique_id_counter = 0;


	static function generate_unique_id() {
		self::$unique_id_counter ++;
		return 'td_uid_' . self::$unique_id_counter . '_' . uniqid();
	}


	static function enqueue_js_files_array($js_files_array, $dependency_array = array(), $url = TDC_URL ) {

		$last_js_file_id = '';
		foreach ($js_files_array as $js_file_id => $js_file) {
			if ($last_js_file_id == '') {
				wp_enqueue_script($js_file_id, $url . $js_file, $dependency_array, TD_COMPOSER, true); //first, load it with jQuery dependency
			} else {
				wp_enqueue_script($js_file_id, $url . $js_file, array($last_js_file_id), TD_COMPOSER, true);  //not first - load with the last file dependency
			}
			$last_js_file_id = $js_file_id;
		}
	}





	/**
	 * Shows a soft error. The site will run as usual if possible. If the user is logged in and has 'switch_themes'
	 * privileges this will also output the caller file path
	 * @param $file - The file should be __FILE__
	 * @param $function - __FUNCTION__
	 * @param $message - the error message
	 * @param $more_data - it will be print_r if available
	 */
	static function error($file, $function, $message, $more_data = '') {
		if (is_user_logged_in() and current_user_can('switch_themes')){

			echo '<br><br>wp booster error:<br>';
			echo $message;

			echo '<br>' . $file . ' > ' . $function;
			if (!empty($more_data)) {
				echo '<br><br><pre>';
				echo 'more data:' . PHP_EOL;
				print_r($more_data);
				echo '</pre>';
			}
		};
	}




	static function get_get_val($_get_name) {
		if (isset($_GET[$_get_name])) {
			return esc_html($_GET[$_get_name]); // xss - no html in get
		}

		return false;
	}



    static function get_current_url() {
        return "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }


    /**
     * @updated on 25.5.2018 - allow the $atts['image'] to be either an ID or URL. This is done to allow the multi purpose shortcodes to load the default placeholder
     * image by URL, to avoid adding them to the media library just to get an ID
     * !WARNING: when it gets images by url, it does not return height and width for now...
     * @param $atts
     * @return array
     */
	static function get_image( $atts ) {
        $image_info = array(
            'url'    => '',
            'height' => '',
            'width'  => '',
            'title'  => get_the_title($atts['image']),
            'alt'    => get_post_meta($atts['image'], '_wp_attachment_image_alt', true)
        );

	    if (!is_numeric($atts['image'])) {
            $image_info['url'] = $atts['image'];
	        return $image_info;
        }

		$meta = wp_get_attachment_metadata( $atts['image'] );

//		var_dump($atts);
//		var_dump($meta);



		if ( is_array( $meta ) ) {
//			$image_info = array(
//				'url'    => wp_get_attachment_url( $atts['image'] ),
//				'height' => $meta['height'],
//				'width'  => $meta['width'],
//			);

			$image_info['url']    = wp_get_attachment_url( $atts['image'] );
            $image_info['height'] = $meta['height'];
            $image_info['width']  = $meta['width'];

			if ( isset( $atts['media_size_image_width'] ) && isset( $atts['media_size_image_height'] ) && ! empty( $meta['sizes'] ) && count( $meta['sizes'] ) ) {

				foreach ( $meta['sizes'] as $size_id => $size_settings ) {
					if ( $size_settings['width'] == $atts['media_size_image_width'] && $size_settings['height'] == $atts['media_size_image_height'] ) {

						$image_attributes = wp_get_attachment_image_src( $atts['image'], $size_id );
						if ( false !== $image_attributes ) {
//							$image_info['url']    = $image_attributes[0];
//							$image_info['width']  = $image_attributes[1];
//							$image_info['height'] = $image_attributes[2];
                            $image_info['url']    = $image_attributes[0];
                            $image_info['height'] = $image_attributes[1];
                            $image_info['width']  = $image_attributes[2];
						}
						break;
					}
				}
			}
		}

		return $image_info;
	}


	/**
	 * @param $obj
	 * @param $css_compiler
	 * @param $raw_css
	 * @param $param_name
	 * @param $param_value
	 */
	static function set_responsive_css( $obj, $css_compiler, $raw_css, $param_name, $param_value ) {

		if ( ! empty( $param_value ) ) {

			$plain_css = '';

			// Detect base64 encoding
			if ( base64_decode( $param_value, true ) && base64_encode( base64_decode( $param_value, true ) ) === $param_value && mb_detect_encoding( base64_decode( $param_value, true ) ) === mb_detect_encoding( $param_value ) ) {

				$decoded_values = base64_decode( $param_value, true );
				$values = json_decode( $decoded_values, true );

				foreach ( $values as $media => $value ) {

					if ( '' !== $value ) {

						$tdm_css_compiler_media = 'tdm_css_compiler_' . $media;

						if ( ! property_exists( $obj, $tdm_css_compiler_media ) ) {
							$obj->$tdm_css_compiler_media = new td_css_compiler( $raw_css );
						}

						if ( ! isset( $obj->media_array ) ) {
							$obj->media_array = array();
						}

						if ( ! isset( $obj->media_array[ $media ] ) ) {
							$obj->media_array[ $media ] = array();
						}

						if ( array_key_exists( $media, td_global::$viewport_settings ) ) {
							if ( is_numeric( $value ) ) {
								$value .= 'px';
							}
							$obj->media_array[ $media ][ $param_name ] = $value;
						}
					}
				}

			// Show value as it is!
			} else {

				// Concatenate '.px' to the numeric values
				if ( is_numeric( $param_value ) ) {
					$param_value .= 'px';
				}

				$plain_css .= $param_value;
			}


			// Compile css

			if ( ! empty( $plain_css ) ) {
				$css_compiler->load_setting_raw( $param_name, $plain_css );
			}
		}
	}




	/**
	 * @param $obj
	 * @param $css_compiler
	 * @param $raw_css
	 * @param $param_name
	 * @param $param_value
	 */
	static function set_responsive_font_css( $obj, $css_compiler, $raw_css, $param_name, $param_value ) {

		$font_family_list = td_util::get_font_family_list( false );

		if ( ! empty( $param_value ) && is_array( $param_value ) ) {

			$plain_css = '';

			foreach ( $param_value as $prop_name => $prop_value ) {

				if ( ! empty( $prop_value ) ) {

					if ( base64_decode( $prop_value, true ) && base64_encode( base64_decode( $prop_value, true ) ) === $prop_value && mb_detect_encoding( base64_decode( $prop_value, true ) ) === mb_detect_encoding( $prop_value ) ) {

						$decoded_values = base64_decode( $prop_value, true );
						$values = json_decode( $decoded_values, true );

						foreach ( $values as $media => $value ) {

							if ( '' !== $value ) {

								$tdm_css_compiler_media = 'tdm_css_compiler_' . $media;

								if ( ! property_exists( $obj, $tdm_css_compiler_media ) ) {
									$obj->$tdm_css_compiler_media = new td_css_compiler( $raw_css );
								}
								if ( ! isset( $obj->media_array ) ) {
									$obj->media_array = array();
								}

								if ( ! isset( $obj->media_array[ $media ] ) ) {
									$obj->media_array[ $media ] = array();
								}

								if ( array_key_exists( $media, td_global::$viewport_settings ) ) {

									switch ( $prop_name ) {
										case 'font-family': $value = $font_family_list[ $value ]; break;
										case 'font-size':
										case 'line-height':
										case 'letter-spacing':
											if ( is_numeric( $value ) ) {
												$value .= 'px';
											}
											break;
									}

									if ( ! isset( $obj->media_array[ $media ][ $param_name ] ) ) {
										$obj->media_array[ $media ][ $param_name ] = '';
									}

									$obj->media_array[ $media ][ $param_name ] .= $prop_name . ':' . $value . ';';
								}
							}
						}

					// Show value as it is!
					} else {

						// Concatenate '.px' to the numeric values
						switch ( $prop_name ) {
							case 'font-family': $prop_value = $font_family_list[ $prop_value ]; break;
							case 'font-size':
							case 'line-height':
							case 'letter-spacing':
								if ( is_numeric( $prop_value ) ) {
									$prop_value .= 'px';
								}
								break;
						}

						$plain_css .= $prop_name . ':' . $prop_value . ';';
					}
				}
			}



			// Compile css

			if ( ! empty( $plain_css ) ) {
				$css_compiler->load_setting_raw( $param_name, $plain_css );
			}
		}
	}




	/**
	 * @param $obj
	 * @param $css_compiler
	 * @param $raw_css
	 * @param $param_name
	 * @param $param_value
	 */
	static function set_responsive_shadow_css( $obj, $css_compiler, $raw_css, $param_name, $param_value ) {

		if ( ! empty( $param_value ) && is_array( $param_value ) ) {

			$plain_css = '';

			$shadow_offset_horizontal = $param_value[ 'shadow_offset_horizontal' ];
			if ( is_numeric( $shadow_offset_horizontal ) ) {
				$shadow_offset_horizontal .= 'px';
			}

			$shadow_offset_vertical = $param_value[ 'shadow_offset_vertical' ];
			if ( is_numeric( $shadow_offset_vertical ) ) {
				$shadow_offset_vertical .= 'px';
			}
			$shadow_size = $param_value[ 'shadow_size' ];
			$shadow_color = $param_value[ 'shadow_color' ];

			if ( base64_decode( $shadow_size, true ) && base64_encode( base64_decode( $shadow_size, true ) ) === $shadow_size && mb_detect_encoding( base64_decode( $shadow_size, true ) ) === mb_detect_encoding( $shadow_size ) ) {

				$shadow_size_decoded_values = base64_decode( $shadow_size, true );
				$shadow_size_values = json_decode( $shadow_size_decoded_values, true );

				foreach ( $shadow_size_values as $media => $value ) {

					if ( '' !== $value ) {

						$tdm_css_compiler_media = 'tdm_css_compiler_' . $media;

						if ( ! property_exists( $obj, $tdm_css_compiler_media ) ) {
							$obj->$tdm_css_compiler_media = new td_css_compiler( $raw_css );
						}
						if ( ! isset( $obj->media_array ) ) {
							$obj->media_array = array();
						}

						if ( ! isset( $obj->media_array[ $media ] ) ) {
							$obj->media_array[ $media ] = array();
						}

						if ( array_key_exists( $media, td_global::$viewport_settings ) ) {

							if ( ! isset( $obj->media_array[ $media ][ $param_name ] ) ) {
								$obj->media_array[ $media ][ $param_name ] = '';
							}

							if ( is_numeric( $value ) ) {
								$value .= 'px';
							}

							$obj->media_array[ $media ][ $param_name ] = $shadow_offset_horizontal . ' ' . $shadow_offset_vertical . ' ' . $value . ' ' . $shadow_color;
						}
					}
				}

			// Show value as it is!
			} else {

				// Concatenate '.px' to the numeric values
				if ( is_numeric( $shadow_size ) ) {
					$shadow_size .= 'px';
				}
				$plain_css = $shadow_offset_horizontal . ' ' . $shadow_offset_vertical . ' ' . $shadow_size . ' ' . $shadow_color;
			}


			// Compile css

			if ( ! empty( $plain_css ) ) {
				$css_compiler->load_setting_raw( $param_name, $plain_css );
			}
		}
	}




	/**
	 * @param $obj
	 *
	 * @return string
	 */
	static function get_responsive_css( $obj ) {

		$compiled_css = '';

//		echo '<pre>';
//		var_dump($obj->media_array);
//		echo '</pre>';


		// This keep the order: all, landscape, portrait, phone.
		foreach ( td_global::$viewport_settings as $media => $media_settings ) {

			$tdm_css_compiler_media = 'tdm_css_compiler_' . $media;

			if ( property_exists( $obj, $tdm_css_compiler_media ) ) {

				foreach ( $obj->media_array[ $media ] as $param_name => $param_value ) {

					$obj->$tdm_css_compiler_media->load_setting_raw( $param_name, $param_value );
				}

				if ( 'all' === $media ) {
					$compiled_css .= $obj->$tdm_css_compiler_media->compile_css();
				} else {
					$compiled_css .= PHP_EOL . PHP_EOL . td_global::$viewport_settings[ $media ]['media_query'] . '{' . PHP_EOL;
					$compiled_css .= $obj->$tdm_css_compiler_media->compile_css();
					$compiled_css .= '}';
				}
			}
		}

		return $compiled_css;
	}


	/**
	 * Get the fonts required by icons. The required fonts are detected by parsing the post content.
	 *
	 * @param string $post_id
	 *
	 * @return array
	 */
	static function get_required_icon_fonts_ids( $post_id ) {

		$font_list = array();

		$content = get_post( $post_id )->post_content;

		$matched_fonts = array();
		preg_match_all('/\s(\w*)?tdicon(\w*)?\=\\"([^\\"]+)\\"/mi', $content, $matched_fonts);

//		echo '<pre>';
//		var_dump( $content );
//		var_dump( $matched_fonts );
//		echo '</pre>';
//		die;

		if ( !empty($matched_fonts) && is_array($matched_fonts) && 4 === count($matched_fonts)) {
			foreach ( $matched_fonts[3] as $font_value ) {
				$css_classes = explode( ' ', $font_value );

				if ( count( $css_classes ) ) {
					foreach ( $css_classes as $css_class ) {
						foreach ( tdc_config::$font_settings as $font_id => &$font_setting ) {
							if ( isset( $font_setting['family_class'] ) && $css_class === 'tdc-font-' . $font_setting['family_class'] && ! isset( $font_list[$font_id] ) ) {
								$font_setting['load'] = true;
								$font_list[$font_id] = $font_setting;
							}
						}
					}
				}
			}
		}

//		var_dump($font_list);
//		die;


		// Find icons for styles

		$matched_styles = array();
		preg_match_all('/\stds_(\w*)\=\\"([^\\"]+)\\"/mi', $content, $matched_styles);

//		echo '<pre>';
//		var_dump( $matched_styles );
//		echo '</pre>';
//		die;

		if ( ! empty($matched_styles ) && is_array($matched_styles) && 3 === count( $matched_styles )) {
			foreach ($matched_styles[2] as $matched_style) {

				$matched_fonts = array();
				preg_match_all('/\s(' . $matched_style .  '-)?tdicon(\w*)\=\\"([^\\"]+)\\"/mi', $content, $matched_fonts);

//				echo '<pre>';
//				var_dump( $matched_fonts );
//				echo '</pre>';
//				die;

				if ( !empty($matched_fonts) && is_array($matched_fonts) && 4 === count($matched_fonts)) {
					foreach ( $matched_fonts[3] as $font_value ) {
						$css_classes = explode( ' ', $font_value );

						if ( count( $css_classes ) ) {
							foreach ( $css_classes as $css_class ) {
								foreach ( tdc_config::$font_settings as $font_id => &$font_setting ) {
									if ( isset( $font_setting['family_class'] ) && $css_class === 'tdc-font-' . $font_setting['family_class'] && ! isset( $font_list[$font_id] ) ) {
										$font_setting['load'] = true;
										$font_list[$font_id] = $font_setting;
									}
								}
							}
						}
					}
				}
			}
		}

		return $font_list;
	}



	/**
	 * Get the ids of fonts required in post content
	 *
	 * @param string $post_id
	 *
	 * @return array
	 */
	static function get_required_google_fonts_ids( $post_id = '' ) {

		$content = get_post( $post_id )->post_content;

		$matches = array();
		preg_match_all('/f_\w+_font_(\w+)\=\\"([^\\"]+)\\"/mi', $content, $matches);

//		echo '<pre>';
//		var_dump( $matches );
//		echo '</pre>';

		$font_list = array();

		if ( ! empty( $matches ) && is_array( $matches ) && 3 === count( $matches )) {

			foreach ( $matches[1] as $key => $font_param ) {

				if ( 'family' === $font_param ) {

					$font_value = $matches[2][$key];

					// Detect base64 encoding
					if ( base64_decode( $font_value, true ) && base64_encode( base64_decode( $font_value, true ) ) === $font_value && mb_detect_encoding( base64_decode( $font_value, true ) ) === mb_detect_encoding( $font_value ) ) {

						$decoded_values = base64_decode( $font_value, true );
						$values         = json_decode( $decoded_values, true );

						foreach ( $values as $media => $value ) {
							if ( is_numeric( $value ) ) {
								$font_list[] = $value;
							}
						}

					} else if ( is_numeric( $font_value ) ) {
						$font_list[] = $font_value;
					}
				}
			}
		}

		return array_unique( $font_list );
	}


    /**
     * try to load a placeholder image if it exists
     * @see tdc_config::$default_placeholder_images
     * @param $id_or_url
     * @return false|string
     */
	static function get_image_or_placeholder($id_or_url) {
	    if (is_numeric($id_or_url)) {
	        return wp_get_attachment_url( $id_or_url );
        }

	    return $id_or_url;
    }

    /**
     * gets the td composer edit page link
     * @param $post_id - the post id
     * @return mixed
     */
    static function get_edit_link( $post_id ) {

        $url = add_query_arg(
            [
                'post_id' => $post_id,
                'td_action' => 'tdc',
                'tdbTemplateType' => 'page',
                //'prev_url' => rawurlencode( get_edit_post_link( $post_id ) )
            ],
            admin_url( 'post.php' )
        );

        return $url;
    }
}