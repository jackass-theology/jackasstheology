<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 11.05.2017
 * Time: 10:04
 */

class td_block_title extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @align_center */
				.$unique_block_class .td-block-title {
					text-align: center;
				}
				.$unique_block_class.td_block_template_4 .td-block-title > *:before {
				    right: 10px;
				}
				.$unique_block_class.td_block_template_8 .td-block-title > * {
					padding-left: 20px;
				}
				.$unique_block_class.td_block_template_9 .td-block-title:after {
					right: 0;
				}
				.$unique_block_class.td_block_template_13 .td-block-subtitle {
					left: 0;
					right: 0;
				}
				/* @align_right */
				.$unique_block_class .td-block-title {
					text-align: right;
				}
				.$unique_block_class.td_block_template_4 .td-block-title > *:before {
				    right: 10px;
				    left: auto;
				}
				.$unique_block_class.td_block_template_5 .td-block-title > * {
				    border-width: 0 4px 0 0;
				}
				.$unique_block_class.td_block_template_8 .td-block-title > * {
					padding-left: 20px;
					padding-right: 0;
				}
				.$unique_block_class.td_block_template_9 .td-block-title:after {
					right: 0;
					left: auto;
				}
				.$unique_block_class.td_block_template_12 .td-pulldown-category,
				.$unique_block_class.td_block_template_13 .td-pulldown-category {
					right: auto;
					left: 0;
				}
				.$unique_block_class.td_block_template_17 .td-block-title:after {
					right: 15px;
					left: auto;
				}
				/* @align_left */
				.$unique_block_class .td-block-title {
					text-align: left;
				}
				.$unique_block_class.td_block_template_17 .td-block-title:after {
					right: auto;
					left: 15px;
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );

        $content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'align_left', 1 );
        }
    }

	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}


    function render($atts, $content = null) {

	    if ( empty( $atts[ 'custom_title' ] ) ) {
            $atts[ 'custom_title' ] = 'Block title';
		}

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query


		$buffy = '';
        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            $buffy .= $this->get_block_title();
	        $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block

            $buffy .= '<div class="td_mod_wrap">';

	        $buffy .= '</div>';
        $buffy .= '</div>';

        return $buffy;
    }
}