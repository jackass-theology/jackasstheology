<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_pricing3 extends td_style {

    private $unique_style_class;
    private $unique_block_class;
    private $atts = array();
    private $index_style;

    function __construct( $atts, $unique_block_class = '', $index_style = '') {
        $this->atts = $atts;
        $this->unique_block_class = $unique_block_class;
        $this->index_style = $index_style;
    }

    private function get_css() {

        $compiled_css = '';

        $unique_style_class = $this->unique_style_class;

        $unique_block_class = '';
        if ( !empty( $this->unique_block_class ) ) {
            $unique_block_class = '.' . $this->unique_block_class;
        }

        $raw_css =
            "<style>

				/* @price_color */
				.$unique_style_class .tdm-pricing-price {
				    color: @price_color;
				}
				/* @old_price_color */
				.$unique_style_class .tdm-pricing-price-old {
				    color: @old_price_color;
				}
				/* @ribbon_background_color */
				.$unique_style_class .tdm-pricing-ribbon {
				    background-color: @ribbon_background_color;
				}
				/* @ribbon_text_color */
				.$unique_style_class .tdm-pricing-ribbon {
				    color: @ribbon_text_color;
				}
				/* @description_color */
				.$unique_style_class .tdm-descr {
				    color: @description_color;
				}
				/* @features_color */
				.$unique_style_class .tdm-pricing-feature {
				    color: @features_color;
				}
				/* @icon_color */
				.$unique_style_class .tdm-pricing-feature i {
				    color: @icon_color;
				}
				/* @features_non_color */
				.$unique_style_class .tdm-pricing-feature.tdm-pricing-feature-non {
				    color: @features_non_color;
				}
				/* @icon_non_color */
				.$unique_style_class .tdm-pricing-feature.tdm-pricing-feature-non i {
				    color: @icon_non_color;
				}
				/* @icon_size */
				.$unique_style_class .tdm-pricing-feature i {
				    width: @icon_width;
				    font-size: @icon_size;
				}
				/* @icon_space */
				.$unique_style_class .tdm-pricing-feature i {
				    margin-right: @icon_space;
				}
				
				/* @border_size */
                $unique_block_class.tdm-pricing-featured:before {
				    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: @border_size;
                    background: #4db2ec;
                    z-index: 10;
				}
				/* @border_color_gradient */
				$unique_block_class.tdm-pricing-featured:before {
					@border_color_gradient
				}
				/* @border_color */
				$unique_block_class.tdm-pricing-featured:before {
					background: @border_color;
				}
			
				/* @shadow */
				$unique_block_class {
				    box-shadow: @shadow;
				}



				/* @f_price */
				.$unique_style_class .tdm-pricing-price-1 {
					@f_price
				}
				/* @f_old_price */
				.$unique_style_class .tdm-pricing-price-2 {
					@f_old_price
				}
				/* @f_currency */
				.$unique_style_class .tdm-pricing-currency-1 {
					@f_currency
				}
				/* @f_old_currency */
				.$unique_style_class .tdm-pricing-currency-2 {
					@f_old_currency
				}
				/* @f_period */
				.$unique_style_class .tdm-pricing-period {
					@f_period
				}
				/* @f_ribbon */
				.$unique_style_class .tdm-pricing-ribbon {
					@f_ribbon
				}
				/* @f_descr */
				.$unique_style_class .tdm-descr {
					@f_descr
				}
				/* @f_features */
				.$unique_style_class .tdm-pricing-feature {
					@f_features
				}
				

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts);

        $compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

    /**
     * Callback pe media
     *
     * @param $responsive_context td_res_context
     * @param $atts
     */
    static function cssMedia( $res_ctx ) {

        /*-- PRICE -- */
        // price color
        $res_ctx->load_settings_raw( 'price_color', $res_ctx->get_style_att( 'price_color', __CLASS__ ) );

        // old price color
        $res_ctx->load_settings_raw( 'old_price_color', $res_ctx->get_style_att( 'old_price_color', __CLASS__ ) );



        /*-- RIBBON -- */
        // ribbon text color
        $res_ctx->load_settings_raw( 'ribbon_text_color', $res_ctx->get_style_att( 'ribbon_text_color', __CLASS__ ) );

        // ribbon background color
        $res_ctx->load_settings_raw( 'ribbon_background_color', $res_ctx->get_style_att( 'ribbon_background_color', __CLASS__ ) );



        /*-- DESCRIPTION -- */
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_style_att( 'description_color', __CLASS__ ) );



        /*-- FEATURES -- */
        // features color
        $res_ctx->load_settings_raw( 'features_color', $res_ctx->get_style_att( 'features_color', __CLASS__ ) );

        // features non color
        $features_non_color = $res_ctx->get_style_att( 'features_non_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'features_non_color', '#c3c3c3' );
        if( $features_non_color != '' ) {
            $res_ctx->load_settings_raw( 'features_non_color', $features_non_color );
        }



        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att( 'icon_size' );
        $res_ctx->load_settings_raw( 'icon_size', $icon_size );
        $res_ctx->load_settings_raw( 'icon_width', $icon_size );
        if ( !empty( $icon_size ) ) {
            if ( is_numeric( $icon_size ) ) {
                $res_ctx->load_settings_raw( 'icon_size', $icon_size . 'px' );
                $res_ctx->load_settings_raw( 'icon_width', $icon_size . 'px' );
            }
        }

        // icon space
        $icon_space = $res_ctx->get_shortcode_att( 'icon_space' );
        if ( $icon_space != '' ) {
            if( is_numeric( $icon_space ) ) {
                $res_ctx->load_settings_raw( 'icon_space', $icon_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_space', '11px' );
        }

        // icon color
        $res_ctx->load_settings_raw( 'icon_color', $res_ctx->get_style_att( 'icon_color', __CLASS__ ) );

        // icon non color
        $icon_non_color = $res_ctx->get_style_att( 'icon_non_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'icon_non_color', '#c3c3c3' );
        if( $icon_non_color != '' ) {
            $res_ctx->load_settings_raw( 'icon_non_color', $icon_non_color );
        }



        /*-- SHADOW -- */
        $res_ctx->load_shadow_settings( 25, 0, 8, 0, 'rgba(0, 0, 0, 0.08)', 'shadow', __CLASS__ );



        /*-- BORDER -- */
        // featured border size
        $border_size = $res_ctx->get_style_att( 'border_size', __CLASS__ );
        if ( $border_size != '' ) {
            if( is_numeric( $border_size ) ) {
                $res_ctx->load_settings_raw( 'border_size', $border_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'border_size', '3px' );
        }

        // border color
        $res_ctx->load_color_settings( 'border_color', 'border_color', 'border_color_gradient', '', '', __CLASS__ );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_price', __CLASS__ );
        $res_ctx->load_font_settings( 'f_old_price', __CLASS__ );
        $res_ctx->load_font_settings( 'f_currency', __CLASS__ );
        $res_ctx->load_font_settings( 'f_old_currency', __CLASS__ );
        $res_ctx->load_font_settings( 'f_period', __CLASS__ );
        $res_ctx->load_font_settings( 'f_ribbon', __CLASS__ );
        $res_ctx->load_font_settings( 'f_descr', __CLASS__ );
        $res_ctx->load_font_settings( 'f_features', __CLASS__ );

    }

    function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_template = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $title_text = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'title_text' ) ) ) );
        $initial_price = $this->get_shortcode_att( 'initial_price' );
        $new_price = $this->get_shortcode_att( 'new_price' );
        $currency = $this->get_shortcode_att( 'currency' );
        $period = $this->get_shortcode_att( 'period' );
        $ribbon_text = $this->get_shortcode_att( 'ribbon_text' );
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );
        $button_position =  $this->get_shortcode_att( 'button_position' );
        $features = explode( "\n", rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'features' ) ) ) ) );
        $features_icon = $this->get_shortcode_att( 'features_tdicon' );
        $features_non_icon = $this->get_shortcode_att( 'features_non_tdicon' );
        $button_text = $this->get_shortcode_att( 'button_text' );

        $buffy_button = '';
        if ( ! empty( $button_text ) ) {
            // Get tds_button
            $tds_button = $this->get_shortcode_att('tds_button');
            if ( empty( $tds_button ) ) {
                $tds_button = td_util::get_option( 'tds_button', 'tds_button1' );
            }
            $tds_button_instance = new $tds_button( $this->atts );
            $buffy_button .= $tds_button_instance->render();
        }


        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="tdm-pricing-wrap ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . '">';
            if ( !empty($ribbon_text) ) {
                $buffy .= '<div class="tdm-pricing-ribbon-wrap">';
                    $buffy .= '<div class="tdm-pricing-ribbon">' . $ribbon_text . '</div>';
                $buffy .= '</div>';
            }

            $buffy .= '<div class="tdm-pricing-header">';
                if ( !empty( $title_text ) ) {
                    // Get tds_title
                    $tds_title = $this->get_shortcode_att('tds_title');
                    if ( empty( $tds_title ) ) {
                        $tds_title = td_util::get_option( 'tds_title', 'tds_title1' );
                    }
                    $tds_title_instance = new $tds_title( $this->atts );
                    $buffy .= $tds_title_instance->render();
                }

                if ( $initial_price != '' && $new_price == '') {
                    $buffy .= '<div class="tdm-pricing-price">';
                        $buffy .= '<span class="tdm-pricing-currency tdm-pricing-currency-1">' . $currency . '</span> <span class="tdm-pricing-price-1">' . $initial_price . '</span>';
                        $buffy .= '<span class="tdm-pricing-period"> ' . $period . '</span>';
                    $buffy .= '</div>';
                }

                if ( $initial_price != '' && $new_price != '' ) {
                    $buffy .= '<div class="tdm-pricing-price">';
                        $buffy .= '<span class="tdm-pricing-currency tdm-pricing-currency-1">' . $currency . '</span> <span class="tdm-pricing-price-1">' . $new_price . '</span>';
                        $buffy .= '<span class="tdm-pricing-price-old"><span class="tdm-pricing-currency-old tdm-pricing-currency-2">' . $currency . '</span> <span class="tdm-pricing-price-2">' . $initial_price . '</span></span>';
                        $buffy .= '<span class="tdm-pricing-period"> ' . $period . '</span>';
                    $buffy .= '</div>';
                }
            $buffy .= '</div>';

            if ( !empty( $description ) ) {
                $buffy .= '<div class="tdm-descr td-fix-index">' . $description . '</div>';
            }

            if ( $button_position == 'button_position_above' || $button_position == 'button_position_both') {
                $buffy .= $buffy_button;
            }

            if ( ! empty( $features ) ) {
                $buffy .= '<ul class="tdm-pricing-features td-fix-index">';
                foreach ($features as $feature) {
                    $pattern = '/^(x- )/';

                    $non_feature = '';
                    if ( preg_match($pattern, $feature) == 1 ) {
                        $non_feature = 'tdm-pricing-feature-non';
                        $feature = preg_replace ($pattern, '',  $feature);
                    }

                    $icon = '';
                    if ( $non_feature == '' ) {
                        if ( !empty( $features_icon ) ) {
                            $icon = '<i class="' . $features_icon . '"></i>';
                        }
                    } else {
                        if ( !empty( $features_non_icon ) ) {
                            $icon = '<i class="' . $features_non_icon . '"></i>';
                        }
                    }

                    $buffy .= '<li class="tdm-pricing-feature ' . $non_feature . '">';
                        $buffy .= $icon . $feature;
                    $buffy .= '</li>';
                }
                $buffy .= '</ul>';
            }

            if ( $button_position == '' || $button_position == 'button_position_both') {
                $buffy .= $buffy_button;
            }
        $buffy .= '</div>';

        return $buffy;
    }

    function get_style_att( $att_name ) {
        return $this->get_att( $att_name ,__CLASS__, $this->index_style );
    }

    function get_atts() {
        return $this->atts;
    }
}