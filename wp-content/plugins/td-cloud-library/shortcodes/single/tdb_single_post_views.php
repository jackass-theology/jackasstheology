<?php

/**
 * Class td_single_post_views
 */

class tdb_single_post_views extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @add_text_space_right */
                .$unique_block_class .tdb-add-text {
                    margin-right: @add_text_space_right;
                }
                /* @add_text_space_left */
                .$unique_block_class .tdb-add-text {
                    margin-left: @add_text_space_left;
                }
                /* @float_right */
                .$unique_block_class {
                    float: right;
                }
                /* @make_inline */
                .$unique_block_class {
                    display: inline-block;
                }
                /* @icon_size */
                .$unique_block_class i {
                    font-size: @icon_size;
                }
                /* @icon_space */
                .$unique_block_class i {
                    margin-right: @icon_space;
                }
                /* @views_color */
				.$unique_block_class {
					color: @views_color;
				}
                /* @icon_color */
				.$unique_block_class i {
					color: @icon_color;
				}
				/* @f_views */
				.$unique_block_class {
					@f_views
				}
				/* @icon_align */
				.$unique_block_class i {
					position: relative;
					top: @icon_align;
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // additional text space
        $add_text_pos = $res_ctx->get_shortcode_att( 'add_text_pos' );
        $add_text_space = $res_ctx->get_shortcode_att( 'add_text_space' );
        if( $add_text_pos == '' ) {
            if( $add_text_space != '' && is_numeric( $add_text_space ) ) {
                $res_ctx->load_settings_raw( 'add_text_space_right', $add_text_space . 'px' );
            }
        } else {
            if( $add_text_space != '' && is_numeric( $add_text_space ) ) {
                $res_ctx->load_settings_raw( 'add_text_space_left', $add_text_space . 'px' );
            }
        }

	    // icon_align
	    $icon_align = $res_ctx->get_shortcode_att('icon_align');
	    if ( $icon_align != 0 || !empty($icon_align) ) {
		    $res_ctx->load_settings_raw( 'icon_align', $icon_align . 'px' );
	    }

        // float right
        $res_ctx->load_settings_raw( 'float_right', $res_ctx->get_shortcode_att('float_right') );
        $res_ctx->load_settings_raw( 'make_inline', $res_ctx->get_shortcode_att('make_inline') );

        /*-- VIEWS ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        $res_ctx->load_settings_raw( 'icon_size', $icon_size );
        if( $icon_size != '' ) {
            if( is_numeric( $icon_size ) ) {
                $res_ctx->load_settings_raw( 'icon_size', $icon_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_size', '14px' );
        }

        // icon space
        $icon_space = $res_ctx->get_shortcode_att('icon_space');
        $res_ctx->load_settings_raw( 'icon_space', $icon_space );
        if( $icon_space != '' ) {
            if( is_numeric( $icon_space ) ) {
                $res_ctx->load_settings_raw( 'icon_space', $icon_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_space', '5px' );
        }

        /*-- COLORS -- */
        $res_ctx->load_settings_raw( 'views_color', $res_ctx->get_shortcode_att('views_color') );
        $res_ctx->load_settings_raw( 'icon_color', $res_ctx->get_shortcode_att('icon_color') );

        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_views' );

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

        $post_views_data = $tdb_state_single->post_views->__invoke();

        // additional text
        $add_text = '<span class="tdb-add-text">' . $this->get_att( 'add_text' ) . '</span>';
        $add_text_pos = $this->get_att( 'add_text_pos' );

        // views icon
        $views_icon = $this->get_att( 'tdicon' );


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . ' tdb-post-meta" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                if( $views_icon != '' ) {
                    $buffy .= '<i class="' . $views_icon . '"></i>';
                }

                if( $add_text != '' && $add_text_pos == '' ) {
                    $buffy .= $add_text;
                }

                // WP-Post Views Counter
                if ( isset( $post_views_data['wp_post_views_nr'] ) and $this->get_att( 'views_type' ) === 'wp-post-plugin' ) {
                    $buffy .= '<span>' . $post_views_data['wp_post_views_nr'] . '</span>';

                    // Default Theme Views Counter
                } else {
                    $buffy .= '<span class="td-nr-views-' . $post_views_data['post_id'] . '">' . $post_views_data['theme_post_views_nr'] .'</span>';
                }

                if( $add_text != '' && $add_text_pos == 'after' ) {
                    $buffy .= $add_text;
                }
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}