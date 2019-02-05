<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 03.02.2017
 * Time: 16:06
 */

class vc_single_image extends td_block {

	public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
                /* @overlay */
				.$unique_block_class a:after {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
				    background-color: @overlay;
				}
				/* @overlay_gradient */
				.$unique_block_class a:after {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
				    @overlay_gradient
				}

				/* @effect_on */
				.$unique_block_class .td_single_image_bg {
					filter: @fe_brightness @fe_contrast @fe_grayscale @fe_hue_rotate @fe_saturate @fe_sepia @fe_blur;
				}
				/* @height */
				.$unique_block_class .td_single_image_bg {
					height: @height;
					padding-bottom: 0;
				}
				/* @padding */
				.$unique_block_class .td_single_image_bg {
					height: auto;
					padding-bottom: @padding;
				}
				/* @width */
				.$unique_block_class {
					width: @width;
				}
				/* @display_inline */
				.$unique_block_class {
					display: inline-block;
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

	    // overlay color
        $res_ctx->load_color_settings( 'overlay', 'overlay', 'overlay_gradient', '', '' );

	    // effects
	    $res_ctx->load_settings_raw('fe_brightness', '');
	    $res_ctx->load_settings_raw('fe_contrast', '');
	    $res_ctx->load_settings_raw('fe_grayscale', '');
	    $res_ctx->load_settings_raw('fe_hue_rotate', '');
	    $res_ctx->load_settings_raw('fe_saturate', '');
	    $res_ctx->load_settings_raw('fe_sepia', '');
	    $res_ctx->load_settings_raw('fe_blur', '');

	    $fe_brightness = $res_ctx->get_shortcode_att('fe_brightness');
	    if ($fe_brightness != '1') {
		    $res_ctx->load_settings_raw('fe_brightness', 'brightness(' . $fe_brightness . ')');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }
	    $fe_contrast = $res_ctx->get_shortcode_att('fe_contrast');
	    if ($fe_contrast != '1') {
		    $res_ctx->load_settings_raw('fe_contrast', 'contrast(' . $fe_contrast . ')');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }
	    $fe_grayscale = $res_ctx->get_shortcode_att('fe_grayscale');
	    if ($fe_grayscale != '0') {
		    $res_ctx->load_settings_raw('fe_grayscale', 'grayscale(' . $fe_grayscale . ')');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }
	    $fe_hue_rotate = $res_ctx->get_shortcode_att('fe_hue_rotate');
	    if ($fe_hue_rotate != '0') {
		    $res_ctx->load_settings_raw('fe_hue_rotate', 'hue-rotate(' . $fe_hue_rotate . 'deg)');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }
	    $fe_saturate = $res_ctx->get_shortcode_att('fe_saturate');
	    if ($fe_saturate != '1') {
		    $res_ctx->load_settings_raw('fe_saturate', 'saturate(' . $fe_saturate . ')');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }
	    $fe_sepia = $res_ctx->get_shortcode_att('fe_sepia');
	    if ($fe_sepia != '0') {
		    $res_ctx->load_settings_raw('fe_sepia', 'sepia(' . $fe_sepia . ')');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }
	    $fe_blur = $res_ctx->get_shortcode_att('fe_blur');
	    if ($fe_blur != '0') {
		    $res_ctx->load_settings_raw('fe_blur', 'blur(' . $fe_blur . 'px)');
		    $res_ctx->load_settings_raw('effect_on', 1);
	    }

	    // height
	    $height = $res_ctx->get_shortcode_att('height');
	    if( empty( $height )) {
		    $res_ctx->load_settings_raw('height', '400px');
	    } else {
		    if ( is_numeric($height) ) {
			    $res_ctx->load_settings_raw('height', $height . 'px');
		    } else if(strpos($height, '%') == true) {
			    $res_ctx->load_settings_raw('padding', $height);
		    } else {
			    $res_ctx->load_settings_raw('height', $height);
		    }
	    }

	    // width
	    $width = $res_ctx->get_shortcode_att('width');
	    if ( is_numeric($width) ) {
		    $res_ctx->load_settings_raw('width', $width . 'px');
	    } else {
		    $res_ctx->load_settings_raw('width', $width);
	    }

	    // display inline
	    $res_ctx->load_settings_raw('display_inline', $res_ctx->get_shortcode_att('display_inline'));

    }

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'image' => '',
				'image_width' => '',
				'image_height' => '',
				'image_url' => '#',
				'open_in_new_window' => '',
				'height' => '',
				'repeat' => '',
				'size' => '',
				'alignment' => '',
				'style' => '',
				'el_class' => '',
				'ga_event_action' => '',
				'ga_event_category' => '',
				'ga_event_label' => '',
				'fb_pixel_event_name' => '',
			), $atts, 'vc_single_image' );

		//$inline_css = ( (float) $atts['height'] >= 0.0 ) ? ' style="height: ' . esc_attr( $atts['height'] ) . '"' : '';

		$target = '';
		$no_custom_url = '';

		if ( '' !== $atts['open_in_new_window'] ) {
			$target = ' target="_blank" ';
		}

		if ( '#' == $atts[ 'image_url' ] ) {
			$no_custom_url = ' td-no-img-custom-url';
		}

		$image_size = ' background-size: cover;';
		if ( '' !== $atts['size'] ) {
			$image_size = ' background-size: ' . $atts['size'] . ';';
		}

		$image_repeat = ' background-repeat: no-repeat;';
		if ( '' !== $atts['repeat'] ) {
			$image_repeat = ' background-repeat: ' . $atts['repeat'] . ';';
		}

		$image_alignment = ' background-position: center center;';
		if ( '' !== $atts['alignment'] ) {
			$image_alignment = ' background-position: center ' . $atts['alignment'] . ';';
		}

		$editing_class = '';
		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$editing_class = 'tdc-editing-vc_single_image';
		}

		if ( !empty($atts['image']) ) {

			$image_info = tdc_util::get_image($atts);

            /**
             * Google Analytics tracking settings
             */
            $data_ga_event_cat = '';
            $data_ga_event_action = '';
            $data_ga_event_label = '';

            /**
             * FB Pixel tracking settings
             */
            $data_fb_event_name = '';
            $data_fb_event_cotent_name = '';

            if ( empty( $no_custom_url ) ) {

                // don't add tracking options in td composer
                if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
                    $ga_event_category = $this->get_att('ga_event_category');
                    if ( ! empty( $ga_event_category ) ) {
                        $data_ga_event_cat = ' data-ga-event-cat="' . $ga_event_category . '" ';
                    }

                    $ga_event_action = $this->get_att('ga_event_action');
                    if ( ! empty( $ga_event_action ) ) {
                        $data_ga_event_action = ' data-ga-event-action="' . $ga_event_action . '" ';
                    }

                    $ga_event_label = $this->get_att('ga_event_label');
                    if ( ! empty( $ga_event_label ) ) {
                        $data_ga_event_label = ' data-ga-event-label="' . $ga_event_label . '" ';
                    }
                }

                // don't add tracking options in td composer
                if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
                    $fb_event_name = $this->get_att('fb_pixel_event_name');
                    if ( ! empty( $fb_event_name ) ) {
                        $data_fb_event_name = ' data-fb-event-name="' . $fb_event_name . '" ';
                    }
                    $fb_event_content_name = $this->get_att('fb_pixel_event_content_name');
                    if ( ! empty( $fb_event_content_name ) ) {
                        $data_fb_event_cotent_name = ' data-fb-event-content-name="' . $fb_event_content_name . '" ';
                    }
                }

            }

			$buffer = '<div class="wpb_wrapper td_block_single_image td_block_wrap ' . $no_custom_url . ' ' . $this->get_block_classes( array(
					$atts['el_class'],
					$editing_class,
					'td-single-image-' . $atts['style']
				) ) . '">';
			$buffer .= '<a 
			class="td_single_image_bg" 
			style="background-image: url(\'' . $image_info['url'] . '\');' . $image_size . $image_repeat . $image_alignment . '" 
			href="' . esc_url( $atts['image_url'] ) . '" ' . $target . $data_ga_event_cat . $data_ga_event_action . $data_ga_event_label . $data_fb_event_name . $data_fb_event_cotent_name . ' 
			rel="bookmark"></a>';
			$buffer .= $this->get_block_css() . '</div>';

		} else {
			$info = '';
			if ( td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax() ) {
				$info = td_util::get_block_error('Single Image', 'Render failed - no image is selected' );
			}
			$buffer = '<div class="wpb_wrapper td_block_wrap td_block_single_image">' . $info . '</div>';
		}

		return  $buffer;
	}
}