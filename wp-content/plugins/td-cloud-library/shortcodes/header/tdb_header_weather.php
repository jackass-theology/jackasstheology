<?php

/**
 * Class td_single_date
 */

class tdb_header_weather extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
                
                /* @inline */
                .$unique_block_class {
                    display: inline-block;
                }
                /* @float_right */
                .$unique_block_class {
                    float: right;
                }
                /* @align_horiz_center */
                .$unique_block_class .tdb-block-inner {
                    justify-content: center;
                }
                /* @align_horiz_right */
                .$unique_block_class .tdb-block-inner {
                    justify-content: flex-end;
                }
                
                /* @icon_size */
                .$unique_block_class .td-icons {
                    font-size: @icon_size;
                }
                /* @icon_space */
                .$unique_block_class .td-icons {
                    margin-right: @icon_space;
                }
                /* @icon_align */
                .$unique_block_class .td-icons {
                    top: @icon_align;
                }
                
                /* @temp_space */
                .$unique_block_class .tdb-weather-deg-wrap {
                    margin-right: @temp_space;
                }
                
                
                /* @icon_color */
                .$unique_block_class .td-icons {
                    color: @icon_color;
                }
                
                /* @temp_color */
                .$unique_block_class .tdb-weather-deg-wrap {
                    color: @temp_color;
                }
                /* @unit_color */
                .$unique_block_class .tdb-weather-unit {
                    color: @unit_color;
                }
                
                /* @loc_color */
                .$unique_block_class .tdb-weather-city {
                    color: @loc_color;
                }
                
                
                /* @f_temp */
                .$unique_block_class .tdb-weather-deg {
                    @f_temp
                }
                /* @f_unit */
                .$unique_block_class .tdb-weather-unit {
                    @f_unit
                }
                /* @f_loc */
                .$unique_block_class .tdb-weather-city {
                    @f_loc
                }
                
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // make inline
        $res_ctx->load_settings_raw('inline', $res_ctx->get_shortcode_att('inline'));
        // align to right
        $res_ctx->load_settings_raw('float_right', $res_ctx->get_shortcode_att('float_right'));
        // horizontal align
        $align_horiz = $res_ctx->get_shortcode_att('align_horiz');
        if( $align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw('align_horiz_center', 1);
        } else if( $align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw('align_horiz_right', 1);
        }



        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        $res_ctx->load_settings_raw('icon_size', $icon_size);
        if( $icon_size != '' && is_numeric($icon_size) ) {
            $res_ctx->load_settings_raw('icon_size', $icon_size . 'px');
        }
        // icon space
        $icon_space = $res_ctx->get_shortcode_att('icon_space');
        if( $icon_space != '' && is_numeric($icon_space) ) {
            $res_ctx->load_settings_raw('icon_space', $icon_space . 'px');
        }
        // icon align
        $res_ctx->load_settings_raw('icon_align', $res_ctx->get_shortcode_att('icon_align') . 'px');



        /*-- TEMPERATURE -- */
        // space
        $temp_space = $res_ctx->get_shortcode_att('temp_space');
        if( $temp_space != '' && is_numeric($temp_space) ) {
            $res_ctx->load_settings_raw('temp_space', $temp_space . 'px');
        }



        /*-- COLORS -- */
        $res_ctx->load_settings_raw('icon_color', $res_ctx->get_shortcode_att('icon_color'));
        $res_ctx->load_settings_raw('temp_color', $res_ctx->get_shortcode_att('temp_color'));
        $res_ctx->load_settings_raw('unit_color', $res_ctx->get_shortcode_att('unit_color'));
        $res_ctx->load_settings_raw('loc_color', $res_ctx->get_shortcode_att('loc_color'));



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_temp' );
        $res_ctx->load_font_settings( 'f_unit' );
        $res_ctx->load_font_settings( 'f_loc' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            $weather_atts = array();

            // api key
            $api_key = $this->get_att('api');
            $api_key_panel = td_util::get_option('tds_weather_key_top_menu');
            if( $api_key == '' ) {
                if( $api_key_panel != '' ) {
                    $weather_atts['w_key'] = $api_key_panel;
                }
            } else {
                $weather_atts['w_key'] = $api_key;
            }

            // location
            $location = $this->get_att('location');
            $location_panel = td_util::get_option('tds_weather_location_top_menu');
            if( $location == '' ) {
                if( $location_panel != '' ) {
                    $weather_atts['w_location'] = $location_panel;
                }
            } else {
                $weather_atts['w_location'] = $location;
            }

            // units
            $units = $this->get_att('units');
            $units_panel = td_util::get_option('tds_weather_units_top_menu');
            if( $units == '' ) {
                if( $units_panel != '' ) {
                    $weather_atts['w_units'] = $units_panel;
                }
            } else {
                $weather_atts['w_units'] = $units;
            }

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                // id we're on td composer
                if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
                    if( !isset( $weather_atts['w_key'] ) ) {
                        $buffy .= '<div class="tdb-weather-deg-wrap" data-block-uid="td_top_weather_uid">';
                            $buffy .= '<span class="tdb-weather-deg">4.2</span>';
                            $buffy .= '<span class="tdb-weather-unit">C</span>';
                        $buffy .= '</div>';
                        $buffy .= '<div class="tdb-weather-city">New York</div>';
                    } else {
                        $buffy .= td_weather::render_generic($weather_atts, 'tdb_header_weather_uid', 'tdb_weather_template');
                    }
                } else {
                    $buffy .= td_weather::render_generic($weather_atts, 'tdb_header_weather_uid', 'tdb_weather_template');
                }

            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

}