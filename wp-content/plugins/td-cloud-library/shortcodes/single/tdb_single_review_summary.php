<?php

/**
 * Class tdb_single_review_summary
 */

class tdb_single_review_summary extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @descr_color */
                .$unique_block_class .td-review-summary-content {
                    color: @descr_color;
                }
                /* @padding */
                .$unique_block_class .td-review td {
                    padding: @padding;
                }
                /* @all_border_size */
                .$unique_block_class td {
                    border-width: @all_border_size;
                    border-style: solid;
                }
                /* @all_border_color */
                .$unique_block_class td {
                    border-color: @all_border_color;
                }
                
                /* @meta_horiz_align_center */
				.$unique_block_class .td-review-summary-content {
				    text-align: center;
				}
                /* @meta_horiz_align_right */
				.$unique_block_class .td-review-summary-content {
				    text-align: right;
				}


				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_descr */
				.$unique_block_class .td-review-summary-content {
					@f_descr
				}   
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // description color
        $res_ctx->load_settings_raw( 'descr_color', $res_ctx->get_shortcode_att('descr_color') );

        // box padding
        $padding = $res_ctx->get_shortcode_att('padding');
        $res_ctx->load_settings_raw( 'padding', $padding );
        if( $padding != '' && is_numeric( $padding ) ) {
            $res_ctx->load_settings_raw( 'padding', $padding . 'px' );
        }

        // border width
        $all_border_size = $res_ctx->get_shortcode_att('all_border_size');
        $res_ctx->load_settings_raw( 'all_border_size', $all_border_size );
        if( $all_border_size != '' ) {
            if( is_numeric( $all_border_size ) ) {
                $res_ctx->load_settings_raw( 'all_border_size', $all_border_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'all_border_size', '1px' );
        }
        // border color
        $all_border_color = $res_ctx->get_shortcode_att('all_border_color');
        $res_ctx->load_settings_raw( 'all_border_color', '#ededed' );
        if( $all_border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $all_border_color );
        }

        // horizontal align
        $content_align = $res_ctx->get_shortcode_att('content_align_horiz');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_right', 1 );
        }




        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_descr' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_single;

        $post_review_summary_data = $tdb_state_single->post_review->__invoke();

        if( $this->get_att('block_template_id') != '' ) {
            $global_block_template_id = $this->get_att('block_template_id');
        } else {
            $global_block_template_id = td_options::get( 'tds_global_block_template', 'td_block_template_1' );
        }
        $td_css_cls_block_title = 'td-block-title';

        if ( $global_block_template_id === 'td_block_template_1' ) {
            $td_css_cls_block_title = 'block-title';
        }


        $buffy = ''; //output buffer

        // when no data - return empty on frontend
        if ( empty( $post_review_summary_data['review_description'] ) ) {
            return $buffy;
        }

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();

        //get the js for this block
        $buffy .= $this->get_block_js();

        $custom_title = $this->get_att( 'custom_title' );

        $buffy .= '<table class="td-review td-fix-index">';

            $buffy .= '<td class="tdb-review-summary">';
                if( $custom_title != '' ) {
                    $buffy .= '<div class="td-block-title-wrap">';
                    $buffy .= '<h4 class="' . $td_css_cls_block_title . '">';
                    $buffy .= '<span>' . $custom_title . '</span>';
                    $buffy .= '</h4>';
                    $buffy .= '</div>';
                }

                $buffy .= '<div class="td-review-summary-content">' . $post_review_summary_data['review_description'] . '</div>';
            $buffy .= '</td>';

        $buffy .= '</table>';

        $buffy .= '</div>';


        return $buffy;
    }





}