<?php

/**
 * Class td_single_date
 */

class tdb_attachment_date extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @make_inline */
                .$unique_block_class {
                    display: inline-block;
                }
                /* @date_color */
				.$unique_block_class {
					color: @date_color;
				}
				/* @f_date */
				.$unique_block_class {
					@f_date
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // make inline
        $res_ctx->load_settings_raw( 'make_inline', $res_ctx->get_shortcode_att('make_inline') );

        /*-- COLORS -- */
        $res_ctx->load_settings_raw( 'date_color', $res_ctx->get_shortcode_att('date_color') );

        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_date' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_attachment;

        $attachment_date_data = $tdb_state_attachment->attachment_date->__invoke();

        $additional_text = $this->get_att( 'additional_text' );
        $time_ago        = $this->get_att( 'time_ago' );

        $display_date = $attachment_date_data['time'];

        if ( $time_ago == true and !empty( $attachment_date_data['human_time_diff'] ) ) {
            $display_date = $attachment_date_data['human_time_diff'] . ' ' . $additional_text;
        }

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . ' tdb-post-meta" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                $buffy .= '<time class="entry-date updated td-module-date" datetime="' . $attachment_date_data['date'] . '" >' . $display_date . '</time>';
            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

}