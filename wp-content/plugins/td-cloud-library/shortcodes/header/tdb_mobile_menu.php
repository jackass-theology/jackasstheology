<?php

/**
 * Class td_single_date
 */

class tdb_mobile_menu extends td_block {

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
                    text-align: center;
                }
                /* @align_horiz_right */
                .$unique_block_class .tdb-block-inner {
                    text-align: right;
                }
                
                /* @icon_size */
                .$unique_block_class #tdb-mobile-menu-button i {
                    font-size: @icon_size;
                }
                /* @icon_padding */
                .$unique_block_class #tdb-mobile-menu-button i {
                    width: @icon_padding;
					height: @icon_padding;
					line-height:  @icon_padding;
                }
                
                
                /* @icon_color */
                .$unique_block_class #tdb-mobile-menu-button {
                    color: @icon_color;
                }
                /* @icon_color_h */
                .$unique_block_class #tdb-mobile-menu-button:hover {
                    color: @icon_color_h;
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
        $res_ctx->load_settings_raw('icon_size', $icon_size . 'px');
        // icon padding
        $res_ctx->load_settings_raw('icon_padding', $icon_size * $res_ctx->get_shortcode_att('icon_padding') . 'px');



        /*-- COLORS -- */
        $res_ctx->load_settings_raw('icon_color', $res_ctx->get_shortcode_att('icon_color'));
        $res_ctx->load_settings_raw('icon_color_h', $res_ctx->get_shortcode_att('icon_color_h'));

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

            // icon
            $icon = $this->get_att('tdicon');
            if( $icon == '' ) {
                $icon = 'td-icon-mobile';
            }


            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<a id="tdb-mobile-menu-button" href="#"><i class="tdb-mobile-menu-icon ' . $icon . '"></i></a>';

            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

}