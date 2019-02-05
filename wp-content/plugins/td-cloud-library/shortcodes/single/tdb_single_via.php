<?php

/**
 * Class td_single_via
 */

class tdb_single_via extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @add_space */
                .$unique_block_class span {
                    margin-right: @add_space;
                }
                /* @add_padding */
                .$unique_block_class span {
                    padding: @add_padding;
                }
                /* @add_color */
                .$unique_block_class span {
                    color: @add_color;
                }
                /* @add_bg */
                .$unique_block_class span {
                    background-color: @add_bg;
                }
                
                
                /* @via_padding */
                .$unique_block_class a {
                    padding: @via_padding;
                }
                /* @all_via_border */
                .$unique_block_class a {
                    border: @all_via_border solid @all_via_border_color;
                }
                /* @via_color */
                .$unique_block_class a {
                    color: @via_color;
                }
                /* @via_bg */
                .$unique_block_class a {
                    background-color: @via_bg;
                }
                /* @via_h_color */
                .$unique_block_class a:hover {
                    color: @via_h_color;
                }
                /* @via_h_bg */
                .$unique_block_class a:hover {
                    background-color: @via_h_bg;
                }
                /* @via_border_h_color */
                .$unique_block_class a:hover {
                    border-color: @via_border_h_color;
                }
				


				/* @f_add */
				.$unique_block_class span {
					@f_add
				}
				/* @f_via */
				.$unique_block_class a {
					@f_via
				}   
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- ADDITIONAL TEXT -- */
        // additional text space
        $add_space = $res_ctx->get_shortcode_att( 'add_space' );
        $res_ctx->load_settings_raw( 'add_space', '4px' );
        if( $add_space != '' && is_numeric( $add_space ) ) {
            $res_ctx->load_settings_raw( 'add_space', $add_space . 'px' );
        }

        // additional text padding
        $add_padding = $res_ctx->get_shortcode_att( 'add_padding' );
        $res_ctx->load_settings_raw( 'add_padding', $add_padding );
        if( $add_padding != '' && is_numeric( $add_padding )  ) {
            $res_ctx->load_settings_raw( 'add_padding', $add_padding . 'px' );
        } else {
            $res_ctx->load_settings_raw( 'add_padding', '2px 8px 3px' );
        }

        // additional text color
        $add_color = $res_ctx->get_shortcode_att('add_color');
        $res_ctx->load_settings_raw( 'add_color', '#fff' );
        if( $add_color != '' ) {
            $res_ctx->load_settings_raw( 'add_color', $add_color );
        }

        // additional text background
        $add_bg = $res_ctx->get_shortcode_att('add_bg');
        $res_ctx->load_settings_raw( 'add_bg', '#222' );
        if( $add_bg != '' ) {
            $res_ctx->load_settings_raw( 'add_bg', $add_bg );
        }



        /*-- SOURCE NAME -- */
        // source name text padding
        $source_padding = $res_ctx->get_shortcode_att( 'via_padding' );
        $res_ctx->load_settings_raw( 'via_padding', $source_padding );
        if( $source_padding != '' ) {
            if(is_numeric( $source_padding )  ) {
                $res_ctx->load_settings_raw( 'via_padding', $source_padding . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'via_padding', '1px 7px 2px' );
        }

        // source name border width
        $via_border = $res_ctx->get_shortcode_att( 'all_via_border' );
        $res_ctx->load_settings_raw( 'all_via_border', '1px' );
        if( $via_border != '' && is_numeric( $via_border ) ) {
            $res_ctx->load_settings_raw( 'all_via_border', $via_border . 'px' );
        }

        // source name color
        $via_color = $res_ctx->get_shortcode_att('via_color');
        $res_ctx->load_settings_raw( 'via_color', '#111' );
        if( $via_color != '' ) {
            $res_ctx->load_settings_raw( 'via_color', $via_color );
        }

        // source name background
        $res_ctx->load_settings_raw( 'via_bg', $res_ctx->get_shortcode_att('via_bg') );

        // source name border color
        $all_via_border_color = $res_ctx->get_shortcode_att('all_via_border_color');
        $res_ctx->load_settings_raw( 'all_via_border_color', '#ededed' );
        if( $all_via_border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_via_border_color', $all_via_border_color );
        }

        // source name hover color
        $res_ctx->load_settings_raw( 'via_h_color', $res_ctx->get_shortcode_att('via_h_color') );

        // source name hover background
        $res_ctx->load_settings_raw( 'via_h_bg', $res_ctx->get_shortcode_att('via_h_bg') );

        // source name border hover color
        $res_ctx->load_settings_raw( 'via_border_h_color', $res_ctx->get_shortcode_att('via_border_h_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_add' );
        $res_ctx->load_font_settings( 'f_via' );

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

        $post_via_data = $tdb_state_single->post_via->__invoke();
        $post_via_name = $post_via_data['via'];

        // additional text
        $add_text = $this->get_att( 'add_text' );

        // open source link in new window
        $open_in_new_window = '';
        if ( $this->get_att( 'open_in_new_window' ) ) {
            $open_in_new_window = 'target="_blank"';
        }


        $buffy = ''; //output buffer

        if( $post_via_name != '' ) {

            $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

                //get the block css
                $buffy .= $this->get_block_css();

                //get the js for this block
                $buffy .= $this->get_block_js();


                $buffy .= '<div class="tdb-block-inner td-fix-index">';
                    $buffy .= '<span>' . $add_text . '</span>';
                    $buffy .= '<a rel="nofollow" href="' . $post_via_data['via_url'] . '" ' . $open_in_new_window . ' >' . $post_via_name . '</a>';
                $buffy .= '</div>';

            $buffy .= '</div>';

        }

        return $buffy;
    }

}