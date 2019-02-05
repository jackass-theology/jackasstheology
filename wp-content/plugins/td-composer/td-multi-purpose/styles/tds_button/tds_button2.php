<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:39
 */

class tds_button2 extends td_style {

    private $unique_style_class;
    private $atts = array();
    private $index_style;

    function __construct( $atts, $index_style = '') {
        $this->atts = $atts;
        $this->index_style = $index_style;
    }

    private function get_css() {

        $compiled_css = '';

        $unique_style_class = $this->unique_style_class;

		$raw_css =
			"<style>

                /* @button_width */
                .$unique_style_class {
                    min-width: @button_width;
                }
				/* @button_icon_size */
				.$unique_style_class i {
					font-size: @button_icon_size;
				}
				/* @icon_left_margin */
				body .$unique_style_class i:last-child {
					margin-left: @icon_left_margin;
				}
				/* @icon_right_margin */
				body .$unique_style_class i:first-child {
					margin-right: @icon_right_margin;
				}

				/* @text_color_solid */
				body .$unique_style_class .tdm-btn-text,
				body .$unique_style_class i {
					color: @text_color_solid;
				}
				/* @text_color_gradient */
				.$unique_style_class .tdm-btn-text,
				.$unique_style_class i {
					@text_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_style_class .tdm-btn-text,
				.td-md-is-ios .$unique_style_class i {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_style_class .tdm-btn-text,
				html[class*='ie'] .$unique_style_class i,
				.td-md-is-ios .$unique_style_class .tdm-btn-text,
				.td-md-is-ios .$unique_style_class i {
				    background: none;
					color: @text_color_gradient_1;
				}
				/* @text_hover_color */
				body .$unique_style_class:hover .tdm-btn-text,
				body .$unique_style_class:hover i {
					color: @text_hover_color;
				}
				/* @text_hover_gradient */
				body .$unique_style_class:hover .tdm-btn-text,
				body .$unique_style_class:hover i {
					-webkit-text-fill-color: unset;
					background: transparent;
					transition: none;
				}

				/* @icon_color_solid */
				body .$unique_style_class i {
					color: @icon_color_solid;
				    -webkit-text-fill-color: unset;
    				background: transparent;
				}
				/* @icon_color_gradient */
				body .$unique_style_class i {
					@icon_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_style_class i {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_style_class i,
				.td-md-is-ios .$unique_style_class i {
				    background: none;
					color: @icon_color_gradient_1;
				}

				/* @icon_hover_color */
				body .$unique_style_class:hover i {
					color: @icon_hover_color;
				}
				/* @icon_hover_gradient */
				body .$unique_style_class:hover i {
					-webkit-text-fill-color: unset;
					background: transparent;
					transition: none;
				}


				/* @border_color_solid */
				body .$unique_style_class:before {
					border-color: @border_color_solid;
				}
				/* @border_color_params */
				.$unique_style_class:before {
				    border-image: linear-gradient(@border_color_params);
				    border-image: -webkit-linear-gradient(@border_color_params);
				    border-image-slice: 1;
				    transition: none;
				}
				.$unique_style_class:hover:before {
				    border-image: linear-gradient(@border_hover_color, @border_hover_color);
				    border-image: -webkit-linear-gradient(@border_hover_color, @border_hover_color);
				    border-image-slice: 1;
				    transition: none;
				}
				/* @border_hover_color */
				body .$unique_style_class:hover:before {
					border-color: @border_hover_color;
				}

				/* @border_size */
				.$unique_style_class:before {
					border-width: @border_size;
				}
				/* @border_style */
				.$unique_style_class:before {
					border-style: @border_style;
				}
				/* @border_radius */
				.$unique_style_class,
				.$unique_style_class:before {
					border-radius: @border_radius;
				}



				/* @f_btn_text */
				.$unique_style_class {
					@f_btn_text
				}
				/* @f_btn_text_line_height */
				.$unique_style_class {
					height: auto;
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts, $this->index_style );

        $compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

    /**
     * Callback pe media
     *
     * @param $res_ctx td_res_context
     */
    static function cssMedia( $res_ctx ) {

        // button width
        $button_width = $res_ctx->get_shortcode_att( 'button_width' );
        $res_ctx->load_settings_raw( 'button_width', $button_width );
        if( $button_width != '' ) {
            if( is_numeric( $button_width ) ) {
                $res_ctx->load_settings_raw( 'button_width', $button_width . 'px' );
            }
        }



        /*-- TEXT -- */
        // text color
        $res_ctx->load_color_settings( 'text_color', 'text_color_solid', 'text_color_gradient', 'text_color_gradient_1', '', __CLASS__ );

        // text hover color
        $text_hover_color = $res_ctx->get_style_att( 'text_hover_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'text_hover_color', $text_hover_color);
        if ( !empty ($text_hover_color ) ) {
            $res_ctx->load_settings_raw( 'text_hover_gradient', 1 );
        }



        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('button_icon_size' );
        $res_ctx->load_settings_raw( 'button_icon_size', $icon_size );
        if( $icon_size != '' ) {
            if( is_numeric( $icon_size ) ) {
                $res_ctx->load_settings_raw( 'button_icon_size', $icon_size . 'px' );
            }
        }

        // icon space
        $button_icon = $res_ctx->get_shortcode_att('button_tdicon' );
        if ( !empty ( $button_icon ) ) {
            $icon_space = $res_ctx->get_shortcode_att( 'button_icon_space' );

            if ( $res_ctx->get_shortcode_att( 'button_icon_position' ) === '') {
                if ( is_numeric( $icon_space ) ) {
                    $res_ctx->load_settings_raw( 'icon_left_margin', $icon_space . 'px' );
                } else {
                    $res_ctx->load_settings_raw( 'icon_left_margin', $icon_space );
                }
            } else {
                if ( is_numeric( $icon_space ) ) {
                    $res_ctx->load_settings_raw( 'icon_right_margin', $icon_space . 'px' );
                } else {
                    $res_ctx->load_settings_raw( 'icon_right_margin', $icon_space );
                }
            }
        }

        // icon color
        $res_ctx->load_color_settings( 'icon_color', 'icon_color_solid', 'icon_color_gradient', 'icon_color_gradient_1', '', __CLASS__ );

        // icon hover color
        $icon_hover_color = $res_ctx->get_style_att( 'icon_hover_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'icon_hover_color', $icon_hover_color);
        if ( !empty ($icon_hover_color ) ) {
            $res_ctx->load_settings_raw( 'icon_hover_gradient', 1 );
        }



        /*-- BORDER -- */
        // border size
        $border_size = $res_ctx->get_style_att( 'border_size', __CLASS__ );
        $res_ctx->load_settings_raw( 'border_size', $border_size );
        if( $border_size != '' ) {
            if( is_numeric( $border_size ) ) {
                $res_ctx->load_settings_raw( 'border_size', $border_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'border_size', '2px' );
        }

        // border style
        $border_style = $res_ctx->get_style_att( 'border_style', __CLASS__ );
        $res_ctx->load_settings_raw( 'border_style', 'solid' );
        if( !empty( $border_style ) ) {
            $res_ctx->load_settings_raw( 'border_style', $border_style );
        }

        // border color
        $res_ctx->load_color_settings( 'border_color', 'border_color_solid', 'border_color_gradient', 'border_color_gradient_1', 'border_color_params', __CLASS__ );

        // border hover color
        $border_hover_color = $res_ctx->get_style_att( 'border_hover_color', __CLASS__ );
        if ( !empty( $border_hover_color ) ) {
            $res_ctx->load_settings_raw( 'border_hover_color', $border_hover_color);
        }

        // border radius
        $border_radius = $res_ctx->get_style_att( 'border_radius', __CLASS__ );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' ) {
            if( is_numeric( $border_radius ) ) {
                $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
            }
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_btn_text', __CLASS__ );
        $res_ctx->load_settings_raw( 'f_btn_text_line_height', $res_ctx->get_style_att( 'f_btn_text_font_line_height', __CLASS__ ) );

    }

    function render( $index_style = '' ) {

        if ( ! empty( $index_style ) ) {
            $this->index_style = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $icon = $this->get_shortcode_att('button_tdicon', $this->index_style);
        $icon_position = $this->get_shortcode_att('button_icon_position', $this->index_style);

        $target = '';
        if ( '' !== $this->get_shortcode_att('button_open_in_new_window', $this->index_style)) {
            $target = ' target="_blank" ';
        }

	    $button_url = $this->get_shortcode_att('button_url', $this->index_style);
	    if ( '' == $button_url) {
		    $button_url = '#';
	    }

        $buffy_icon = '';
        if ( !empty( $icon ) ) {
            $buffy_icon .= '<i class="' . $icon . '"></i>';
        }

        /**
         * Google Analytics tracking settings
         */
        $data_ga_event_cat = '';
        $data_ga_event_action = '';
        $data_ga_event_label = '';

        // don't add tracking options in td composer
        if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
            $ga_event_category = $this->get_shortcode_att('ga_event_category');
            if ( ! empty( $ga_event_category ) ) {
                $data_ga_event_cat = ' data-ga-event-cat="' . $ga_event_category . '" ';
            }

            $ga_event_action = $this->get_shortcode_att('ga_event_action');
            if ( ! empty( $ga_event_action ) ) {
                $data_ga_event_action = ' data-ga-event-action="' . $ga_event_action . '" ';
            }

            $ga_event_label = $this->get_shortcode_att('ga_event_label');
            if ( ! empty( $ga_event_label ) ) {
                $data_ga_event_label = ' data-ga-event-label="' . $ga_event_label . '" ';
            }
        }

        /**
         * FB Pixel tracking settings
         */
        $data_fb_event_name = '';
        $data_fb_event_cotent_name = '';

        // don't add tracking options in td composer
        if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
            $fb_event_name = $this->get_shortcode_att('fb_pixel_event_name');
            if ( ! empty( $fb_event_name ) ) {
                $data_fb_event_name = ' data-fb-event-name="' . $fb_event_name . '" ';
            }
            $fb_event_content_name = $this->get_shortcode_att('fb_pixel_event_content_name');
            if ( ! empty( $fb_event_content_name ) ) {
                $data_fb_event_cotent_name = ' data-fb-event-content-name="' . $fb_event_content_name . '" ';
            }
        }

        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
        $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' td-fix-index">';
            $buffy .= '<a href="' . $button_url . '" class="' . self::get_class_style(__CLASS__) . ' tdm-btn ' . $this->get_shortcode_att('button_size', $this->index_style) . ' ' . $this->unique_style_class . '" ' . $target . $data_ga_event_cat . $data_ga_event_action . $data_ga_event_label . $data_fb_event_name . $data_fb_event_cotent_name . '>';
                if ( $icon_position == 'icon-before' ) {
                    $buffy .= $buffy_icon;
                }

                $buffy .= '<span class="tdm-btn-text">' . $this->get_shortcode_att('button_text', $this->index_style) . '</span>';

                if ( $icon_position == '' ) {
                    $buffy .= $buffy_icon;
                }
            $buffy .= '</a>';
        $buffy .= '</div>';

		return $buffy;
	}

    function get_style_att( $att_name ) {
	    return $this->get_att( $att_name, __CLASS__, $this->index_style );
    }

    function get_atts() {
        return $this->atts;
    }
}