<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 2/21/2017
 * Time: 2:18 PM
 */
class td_block_pinterest extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @username_color */
				.$unique_block_class .td-pinterest-header .td-pinterest-user-meta .td-pinterest-user {
					color: @username_color;
				}
                /* @board_color */
				.$unique_block_class .td-pinterest-header .td-pinterest-user-meta .td-pinterest-board {
					color: @board_color;
				}
                /* @followers_color */
				.$unique_block_class .td-pinterest-followers {
					color: @followers_color;
				}
				


				/* @f_user */
				.$unique_block_class .td-pinterest-header .td-pinterest-user-meta .td-pinterest-user {
					@f_user
				}
				/* @f_board */
				.$unique_block_class .td-pinterest-header .td-pinterest-user-meta .td-pinterest-board {
					@f_board
				}
				/* @f_followers */
				.$unique_block_class .td-pinterest-followers {
					@f_followers
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // username color
        $res_ctx->load_settings_raw( 'username_color', $res_ctx->get_shortcode_att('username_color') );

        // board name color
        $res_ctx->load_settings_raw( 'board_color', $res_ctx->get_shortcode_att('board_color') );

        // followers count color
        $res_ctx->load_settings_raw( 'followers_color', $res_ctx->get_shortcode_att('followers_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_user' );
        $res_ctx->load_font_settings( 'f_board' );
        $res_ctx->load_font_settings( 'f_followers' );

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
	    
        $buffy .= '<div id=' . $this->block_uid . ' class="td-pinterest-wrap td_block_inner td-column-' . $td_column_number . '">';
        $buffy.= td_pinterest::render_generic($atts);
        $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }
}