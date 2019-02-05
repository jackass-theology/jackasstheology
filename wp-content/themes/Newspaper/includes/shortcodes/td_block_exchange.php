<?php

class td_block_exchange extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @heading_color */
				.$unique_block_class .td-base-title {
					color: @heading_color;
				}
                /* @heading_bg_color */
				.$unique_block_class .td-exchange-header:before {
					background-color: @heading_bg_color;
					opacity: 1;
				}
				
				
				/* @currency_name_color */
				.$unique_block_class .td-rate-currency {
					color: @currency_name_color;
                }
				/* @currency_value_color */
				.$unique_block_class .td-exchange-value {
					color: @currency_value_color;
				}
				/* @currency_border_color */
				.$unique_block_class .td-rate,
				.$unique_block_class .td-column-2 .td-exchange-rates .td-rate:nth-child(3n + 1):before,
				.$unique_block_class .td-column-3  .td-exchange-rates .td-rate:nth-child(4n + 1):before {
					border-bottom-color: @currency_border_color;
				}
				


				/* @f_heading */
				.$unique_block_class .td-base-title {
					@f_heading
				}
				/* @f_curr */
				.$unique_block_class .td-rate-currency {
					@f_curr
				}
				/* @f_val */
				.$unique_block_class .td-exchange-value {
					@f_val
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- HEADING -- */
        // heading text color
        $res_ctx->load_settings_raw( 'heading_color', $res_ctx->get_shortcode_att('heading_color') );

        // heading background color
        $res_ctx->load_settings_raw( 'heading_bg_color', $res_ctx->get_shortcode_att('heading_bg_color') );



        /*-- CURRENCY -- */
        // currency name color
        $res_ctx->load_settings_raw( 'currency_name_color', $res_ctx->get_shortcode_att('currency_name_color') );

        // currency value color
        $res_ctx->load_settings_raw( 'currency_value_color', $res_ctx->get_shortcode_att('currency_value_color') );

        // currency border color
        $res_ctx->load_settings_raw( 'currency_border_color', $res_ctx->get_shortcode_att('currency_border_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_heading' );
        $res_ctx->load_font_settings( 'f_curr' );
        $res_ctx->load_font_settings( 'f_val' );

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

	        $buffy .= '<div id=' . $this->block_uid . ' class="td-exchange-wrap td_block_inner td-column-' . $td_column_number . '">';
                $buffy.= td_exchange::render_generic($atts);
            $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }


}