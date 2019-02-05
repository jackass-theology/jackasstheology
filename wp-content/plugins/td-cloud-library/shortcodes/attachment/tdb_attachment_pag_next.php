<?php

/**
 * Class tdb_attachment_img_pagination
 */

class tdb_attachment_pag_next extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @img_size */
				.$unique_block_class .tdb-attachment-pag {
					width: @img_size;
					height: @img_size;
				}
                /* @border_radius */
				.$unique_block_class .tdb-attachment-pag {
					border-radius: @border_radius;
				}
				
                /* @make_inline */
                .$unique_block_class {
                    display: inline-block;
                }
				
				/* @align_default */
				.td-theme-wrap .$unique_block_class .tdb-attachment-next {
					float: right;
				}   
				/* @align_left */
				.td-theme-wrap .$unique_block_class {
					text-align: left;
				}
				/* @align_center */
				.td-theme-wrap .$unique_block_class {
					text-align: center;
				}
				/* @align_right */
				.td-theme-wrap .$unique_block_class {
					text-align: right;
				}
				
				
				/* @overlay_color */
				.$unique_block_class .tdb-attachment-pag:after {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
				    background-color: @overlay_color;
				    pointer-events: none;
				}
				/* @overlay_gradient */
				.$unique_block_class .tdb-attachment-pag:after {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
				    @overlay_gradient
				    pointer-events: none;
				}
				/* @overlay_h */
				.$unique_block_class .tdb-attachment-pag:hover:after {
				    background-color: @overlay_h;
				}
				/* @overlay_h_gradient */
				.$unique_block_class .tdb-attachment-pag:hover:after {
				    @overlay_h_gradient
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // images size
        $img_size = $res_ctx->get_shortcode_att( 'img_size' );
        $res_ctx->load_settings_raw( 'img_size', $img_size );
        if( $img_size != '' ) {
            if( is_numeric( $img_size ) ) {
                $res_ctx->load_settings_raw( 'img_size', $img_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'img_size', '100px' );
        }

        // border radius
        $border_radius = $res_ctx->get_shortcode_att( 'border_radius' );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' && is_numeric( $border_radius ) ) {
            $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
        }

        // make inline
        $res_ctx->load_settings_raw( 'make_inline', $res_ctx->get_shortcode_att('make_inline') );

        // images align
        $content_align = $res_ctx->get_shortcode_att('img_align_horizontal');
        if( $content_align == 'layout-default' ) {
            $res_ctx->load_settings_raw( 'align_default', 1 );
        } else if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'align_left', 1 );
        }


        // overlay
        $res_ctx->load_color_settings( 'overlay', 'overlay_color', 'overlay_gradient', '', '' );
        // overlay hover
        $res_ctx->load_color_settings( 'overlay_h', 'overlay_h_color', 'overlay_h_gradient', '', '' );

    }


    // disable loop block features. This block does not use a loop and it doesn't need to run a query.
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts );

        global $tdb_state_attachment;
        $attachment_img_pag_data = $tdb_state_attachment->attachment_pag_next->__invoke( $atts );

        $buffy = '';

        $buffy .= '<div class="tdb-attachment-pag-block ' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<div class="tdb-attachment-pag tdb-attachment-next">' . $attachment_img_pag_data['next_image_link'] . '</div>';

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }



}