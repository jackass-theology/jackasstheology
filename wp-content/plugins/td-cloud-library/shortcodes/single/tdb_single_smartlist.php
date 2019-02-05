<?php

/**
 * post smart_lists block, used to show the post smart_lists
 */

class tdb_single_smartlist extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @title_color */
				.$unique_block_class .tdb-sml-current-item-title {
					color: @title_color;
				}
                /* @counter_color */
				.$unique_block_class .tdb-sml-current-item-nr span {
					color: @counter_color;
				}
                /* @counter_bg */
				.$unique_block_class .tdb-sml-current-item-nr span {
					background-color: @counter_bg;
				}
                /* @caption_color */
				.$unique_block_class .tdb-sml-caption {
					color: @caption_color;
				}
                /* @descr_color */
				.$unique_block_class .tdb-sml-description {
					color: @descr_color;
				}
                /* @nextprev_color */
				.$unique_block_class .td-smart-list-button {
					color: @nextprev_color;
				}
                /* @nextprev_bg */
				.$unique_block_class .td-smart-list-button {
					background-color: @nextprev_bg;
				}
                /* @nextprev_h_color */
				.$unique_block_class .td-smart-list-button:hover {
					color: @nextprev_h_color;
				}
                /* @nextprev_h_bg */
				.$unique_block_class .td-smart-list-button:hover {
					background-color: @nextprev_h_bg;
				}
                /* @ad_color */
				.$unique_block_class .td-adspot-title {
					color: @ad_color;
				}
				
				
				
				/* @f_title */
				.$unique_block_class .tdb-sml-current-item-title {
					@f_title
				}
				/* @f_counter */
				.$unique_block_class .tdb-sml-current-item-nr span {
					@f_counter
				}
				/* @f_caption */
				.$unique_block_class .wp-caption-text {
					@f_caption
				}
				/* @f_descr */
				.$unique_block_class .tdb-sml-description p {
					@f_descr
				}
				/* @f_nextprev */
				.$unique_block_class .tdb-smart-list-button {
					@f_nextprev
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- COLORS -- */
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_shortcode_att('title_color') );
        $res_ctx->load_settings_raw( 'counter_color', $res_ctx->get_shortcode_att('counter_color') );
        $res_ctx->load_settings_raw( 'counter_bg', $res_ctx->get_shortcode_att('counter_bg') );
        $res_ctx->load_settings_raw( 'caption_color', $res_ctx->get_shortcode_att('caption_color') );
        $res_ctx->load_settings_raw( 'descr_color', $res_ctx->get_shortcode_att('descr_color') );
        $res_ctx->load_settings_raw( 'nextprev_color', $res_ctx->get_shortcode_att('nextprev_color') );
        $res_ctx->load_settings_raw( 'nextprev_bg', $res_ctx->get_shortcode_att('nextprev_bg') );
        $res_ctx->load_settings_raw( 'nextprev_h_color', $res_ctx->get_shortcode_att('nextprev_h_color') );
        $res_ctx->load_settings_raw( 'nextprev_h_bg', $res_ctx->get_shortcode_att('nextprev_h_bg') );
        $res_ctx->load_settings_raw( 'ad_color', $res_ctx->get_shortcode_att('ad_color') );

        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title' );
        $res_ctx->load_font_settings( 'f_counter' );
        $res_ctx->load_settings_raw( 'counter_line_height', $res_ctx->get_shortcode_att('f_counter_font_line_height') );
        $res_ctx->load_font_settings( 'f_caption' );
        $res_ctx->load_font_settings( 'f_descr' );
        $res_ctx->load_font_settings( 'f_nextprev' );

    }

    function render($atts, $content = null) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_single;
        $post_smart_list_data = $tdb_state_single->post_smart_list->__invoke( $atts );


        $buffy = '';

        //if( $post_smart_list_data['smart_list_html'] != '' ) {
            $buffy .= '<div class="' . $this->get_block_classes() . ' td-post-content" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                $buffy .= $post_smart_list_data['smart_list_html'];
            $buffy .= '</div>';

            $buffy .= '</div>';
        //}


        return $buffy;
    }
}