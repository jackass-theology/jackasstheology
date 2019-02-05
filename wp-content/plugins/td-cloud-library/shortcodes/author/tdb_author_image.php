<?php


/**
 * Class tdb_author_name
 */

class tdb_author_image extends td_block {

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
                
                /* @image_width */
                .$unique_block_class .tdb-author-img {
                    width: @image_width;
                }
                /* @image_height */
                .$unique_block_class .tdb-author-img {
                    padding-bottom: @image_height;
                }
				/* @image_alignment */
				.$unique_block_class .tdb-author-img {
					background-position: center @image_alignment;
				}
                /* @image_radius */
                .$unique_block_class .tdb-author-img {
                    border-radius: @image_radius;
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

                /* @overlay_color */
				.$unique_block_class .tdb-author-img:after {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
					background-color: @overlay_color;
					z-index: 1;
				}
				/* @overlay_gradient */
				.$unique_block_class .tdb-author-img:after {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
					@overlay_gradient
					z-index: 1;
				}
				
				/* @all_border_width */
                .$unique_block_class .tdb-author-img {
                    border: @all_border_width @all_border_style @all_border_color;
                }
				
                /* @shadow */
                .$unique_block_class .tdb-author-img {
                    box-shadow: @shadow;
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

        // image width
        $image_width = $res_ctx->get_shortcode_att('image_width');
        $res_ctx->load_settings_raw( 'image_width', $image_width );
        if( $image_width != '' ) {
            if( is_numeric($image_width) ) {
                $res_ctx->load_settings_raw('image_width', $image_width . 'px');
            }
        } else {
            $res_ctx->load_settings_raw('image_width', '75px');
        }

        // image height
        $image_height = $res_ctx->get_shortcode_att('image_height');
        $res_ctx->load_settings_raw( 'image_height', $image_height );
        if( $image_height != '' ) {
            if( is_numeric($image_height) ) {
                $res_ctx->load_settings_raw( 'image_height', $image_height . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'image_height', '75px' );
        }

        //image alignment
        $res_ctx->load_settings_raw( 'image_alignment', $res_ctx->get_shortcode_att('image_alignment') . '%' );

        // image radius
        $image_radius = $res_ctx->get_shortcode_att('image_radius');
        $res_ctx->load_settings_raw( 'image_radius', $image_radius );
        if( $image_radius != '' &&is_numeric($image_radius) ) {
            $res_ctx->load_settings_raw('image_radius', $image_radius . 'px');
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

        // overlay color
        $res_ctx->load_color_settings( 'overlay', 'overlay_color', 'overlay_gradient', '', '' );

        // border width
        $border_width = $res_ctx->get_shortcode_att( 'all_border_width' );
        if( $border_width != '' ) {
            if( is_numeric( $border_width ) ) {
                $res_ctx->load_settings_raw( 'all_border_width', $border_width . 'px' );
            }
        }

        // border style
        $border_style = $res_ctx->get_shortcode_att( 'all_border_style' );
        $res_ctx->load_settings_raw( 'all_border_style', 'solid' );
        if( $border_style != '' ) {
            $res_ctx->load_settings_raw( 'all_border_style', $border_style );
        }

        // border color
        $border_color = $res_ctx->get_shortcode_att( 'all_border_color' );
        $res_ctx->load_settings_raw( 'all_border_color', '#eee' );
        if( $border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $border_color );
        }

        // shadow
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.08)', 'shadow' );

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
        $author_image_data = $tdb_state_author->image->__invoke( $atts );


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<div class="tdb-author-img" style="background-image: url(' . $author_image_data['image'] . ')"></div>';

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}