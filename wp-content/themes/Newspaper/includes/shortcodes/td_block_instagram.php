<?php

class td_block_instagram extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @handle_color */
				.$unique_block_class .td-instagram-user a {
					color: @handle_color;
				}
				/* @followers_color */
				.$unique_block_class .td-instagram-followers {
					color: @followers_color;
				}
				
				
				/* @btn_color */
				.$unique_block_class .td-instagram-button {
					color: @btn_color;
				}
				/* @btn_border_color */
				.$unique_block_class .td-instagram-button {
					border-color: @btn_border_color;
				}



				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_handle */
				.$unique_block_class .td-instagram-user a {
					@f_handle
				}
				/* @f_followers */
				.$unique_block_class .td-instagram-followers {
					@f_followers
				}
				/* @f_btn_text */
				.$unique_block_class .td-instagram-button {
					@f_btn_text
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // heading text color
        $res_ctx->load_settings_raw( 'handle_color', $res_ctx->get_shortcode_att('handle_color') );

        // heading background color
        $res_ctx->load_settings_raw( 'followers_color', $res_ctx->get_shortcode_att('followers_color') );



        /*-- BUTTON -- */
        // currency name color
        $res_ctx->load_settings_raw( 'btn_color', $res_ctx->get_shortcode_att('btn_color') );

        // currency value color
        $res_ctx->load_settings_raw( 'btn_border_color', $res_ctx->get_shortcode_att('btn_border_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_handle' );
        $res_ctx->load_font_settings( 'f_followers' );
        $res_ctx->load_font_settings( 'f_btn_text' );

    }

	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}


    function render($atts, $content = null) {

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }

        $buffy = ''; //output buffer
        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title();
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            $buffy .= '<div id=' . $this->block_uid . ' class="td-instagram-wrap td_block_inner td-column-' . $td_column_number . '">';
                $buffy.= td_instagram::render_generic($atts);
            $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }
}