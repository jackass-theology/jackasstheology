<?php


/**
 * Class tdb_author_name
 */

class tdb_author_comments_count extends td_block {

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
               
                /* @border_radius */
                .$unique_block_class .tdb-author-count {
                    border-radius: @border_radius;
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

                /* @count_color */
                .$unique_block_class .tdb-author-count {
                    color: @count_color;
                }
                /* @count_bg_color */
                .$unique_block_class .tdb-author-count {
                    background-color: @count_bg_color;
                }
                /* @count_padding */
                .$unique_block_class .tdb-author-count {
                    padding: @count_padding;
                }
                
                
                
                /* @f_count */
				.$unique_block_class .tdb-author-count {
					@f_count
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

        // counter padding
        $count_padding = $res_ctx->get_shortcode_att( 'count_padding' );
        $res_ctx->load_settings_raw( 'count_padding', $count_padding );
        if( $count_padding != '' ) {
            if( is_numeric( $count_padding ) ) {
                $res_ctx->load_settings_raw( 'count_padding', $count_padding . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'count_padding', '5px 10px 4px 10px' );
        }

        // border radius
        $border_radius = $res_ctx->get_shortcode_att( 'border_radius' );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' && is_numeric( $border_radius )  ) {
            $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
        }

        // content align
        $content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'align_left', 1 );
        }

        // counter text color
        $res_ctx->load_settings_raw( 'count_color', $res_ctx->get_shortcode_att( 'count_color' ) );

        // counter bg color
        $res_ctx->load_settings_raw( 'count_bg_color', $res_ctx->get_shortcode_att( 'count_bg_color' ) );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_count' );

    }


    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_author;
        $author_comments_count_data = $tdb_state_author->comments_count->__invoke( $atts );


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . ' tdb-author-counters" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy.= '<div class="tdb-author-count">' . $author_comments_count_data['comments-count'] . ' '  . __td('COMMENTS', TD_THEME_NAME) . '</div>';

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}