<?php


/**
 * Class tdb_author_name
 */

class tdb_author_socials extends td_block {

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

                /* @icons_size */
				.$unique_block_class .tdb-social-item i {
					font-size: @icons_size;
					vertical-align: middle;
				}
				.$unique_block_class .tdb-social-item i.td-icon-twitter,
				.$unique_block_class .tdb-social-item i.td-icon-linkedin,
				.$unique_block_class .tdb-social-item i.td-icon-pinterest,
				.$unique_block_class .tdb-social-item i.td-icon-blogger,
				.$unique_block_class .tdb-social-item i.td-icon-vimeo {
					font-size: @icons_size_fix;
				}
				/* @icons_padding */
				.$unique_block_class .tdb-social-item {
					min-width: @icons_padding;
					height: @icons_padding;
				}
				.$unique_block_class .tdb-social-item i {
					line-height: @icons_padding;
				}
				/* @icons_margin_right */
				.$unique_block_class .tdb-social-item {
				    margin: @icons_margin_top_bottom @icons_margin_right @icons_margin_top_bottom 0;
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
				
				/* @icons_color */
				.$unique_block_class .tdb-social-item i {
					color: @icons_color;
				}
				/* @icons_h_color */
				.$unique_block_class .tdb-social-item:hover i {
					color: @icons_h_color;
				}
				/* @icons_bg */
				.$unique_block_class .tdb-social-item {
					background-color: @icons_bg;
				}
				/* @icons_h_bg */
				.$unique_block_class .tdb-social-item:hover {
					background-color: @icons_h_bg;
				}
				
				/* @icons_border_radius */
				.$unique_block_class .tdb-social-item {
					border-radius: @icons_border_radius;
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

        // icons size
        $icons_size = $res_ctx->get_shortcode_att( 'icons_size' );
        $res_ctx->load_settings_raw( 'icons_size',  $icons_size . 'px' );
        $res_ctx->load_settings_raw(  'icons_size_fix', $icons_size * 0.8  . 'px');

        // icons padding
        $res_ctx->load_settings_raw( 'icons_padding', $icons_size * $res_ctx->get_shortcode_att( 'icons_padding' ) . 'px' );

        // icons spacing
        $icons_spacing = $res_ctx->get_shortcode_att( 'icons_spacing' );
        if( $icons_spacing != '' ) {
            if ( is_numeric( $icons_spacing ) ) {
                $res_ctx->load_settings_raw( 'icons_margin_right',  $icons_spacing . 'px' );
                $res_ctx->load_settings_raw( 'icons_margin_top_bottom',  $icons_spacing / 2 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icons_margin_right', '14px' );
            $res_ctx->load_settings_raw( 'icons_margin_top_bottom', '7px' );
        }

        //icons border radius
        $icons_border_radius = $res_ctx->get_shortcode_att( 'icons_border_radius' );
        $res_ctx->load_settings_raw( 'icons_border_radius', $icons_border_radius );
        if( $icons_border_radius != '' && is_numeric( $icons_border_radius ) ) {
            $res_ctx->load_settings_raw( 'icons_border_radius', $icons_border_radius . 'px' );
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

        // icons color
        $res_ctx->load_settings_raw( 'icons_color', $res_ctx->get_shortcode_att( 'icons_color' ) );

        // icons background color
        $res_ctx->load_settings_raw( 'icons_bg', $res_ctx->get_shortcode_att( 'icons_bg' ) );

        // icons hover color
        $res_ctx->load_settings_raw( 'icons_h_color', $res_ctx->get_shortcode_att( 'icons_h_color' ) );

        // icons background hover color
        $res_ctx->load_settings_raw( 'icons_h_bg', $res_ctx->get_shortcode_att( 'icons_h_bg' ) );

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
        $author_socials_data = $tdb_state_author->socials->__invoke( $atts );


        $buffy = ''; //output buffer

	    // when no data - return empty on frontend
	    if ( empty($author_socials_data['social_icons'])) {
		    return $buffy;
	    }

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<div class="tdb-author-socials">';
                    if ( !empty( $author_socials_data['social_icons'] ) ) {
                        foreach ( $author_socials_data['social_icons'] as $author_socials_data ) {
                            $buffy .= '<a href="' . $author_socials_data['social_link'] . '" target="_blank" title="' . $author_socials_data['social_id'] . '" class="tdb-social-item">';
                                $buffy .= '<i class="td-icon-font td-icon-' . $author_socials_data['social_id'] . '"></i>';
                            $buffy .= '</a>';
                        }
                    }
                $buffy .= '</div>';

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}