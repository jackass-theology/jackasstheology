<?php

/**
 * Class td_single_subtitle
 */
class tdb_single_subtitle extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @sub_color */
				.$unique_block_class p {
					color: @sub_color;
				}
				/* @sub_color_gradient */
				.$unique_block_class p {
					@sub_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_block_class p {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class p,
				.td-md-is-ios .$unique_block_class p {
				    background: none;
					color: @sub_color_gradient_1;
				}
				/* @align_center */
				.td-theme-wrap .$unique_block_class {
					text-align: center;
				}
				/* @align_right */
				.td-theme-wrap .$unique_block_class {
					text-align: right;
				}	
				/* @align_left */
				.td-theme-wrap .$unique_block_class {
					text-align: left;
				}
				/* @f_sub */
				.$unique_block_class p {
					@f_sub
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // subtitle color
        $res_ctx->load_color_settings( 'sub_color', 'sub_color', 'sub_color_gradient', 'sub_color_gradient_1', '' );

	    // content align
	    $content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
	    if ( $content_align == 'content-horiz-center' ) {
		    $res_ctx->load_settings_raw( 'align_center', 1 );
	    } else if ( $content_align == 'content-horiz-right' ) {
		    $res_ctx->load_settings_raw( 'align_right', 1 );
	    } else if ( $content_align == 'content-horiz-left' ) {
		    $res_ctx->load_settings_raw( 'align_left', 1 );
	    }

        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_sub' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_single;
        $post_subtitle_data = $tdb_state_single->post_subtitle->__invoke();

        $additional_classes = array();

        $buffy = ''; //output buffer

	    // when no data - return empty on frontend
	    if ( empty($post_subtitle_data['post_subtitle'])) {
	    	return $buffy;
	    }

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes)  . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                $buffy .= '<p>' . $post_subtitle_data['post_subtitle'] . '</p>';
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }
}