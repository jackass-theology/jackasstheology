<?php
class tdm_block_list extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

    public function get_custom_css() {

        $compiled_css = '';

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $raw_css =
            "<style>
            
				/* @text_color */
				.$unique_block_class .tdm-list-text,
				.$unique_block_class .tdm-list-text a {
				    color: @text_color;
				}
				
				/* @icon_color */
				.$unique_block_class .tdm-list-item i {
				    color: @icon_color;
				}

				/* @hover_text_color */
				.$unique_block_class .tdm-list-item:hover .tdm-list-text,
				.$unique_block_class .tdm-list-item:hover a {
				    color: @hover_text_color;
				}

				/* @hover_icon_color */
				.$unique_block_class .tdm-list-item:hover i {
				    color: @hover_icon_color;
				}
				
				/* @icon_size */
				.$unique_block_class .tdm-list-item i {
				    font-size: @icon_size;
				}
				
				/* @icon_align */
				.$unique_block_class .tdm-list-item i {
				    top: @icon_align;
				}
				
				/* @icon_space */
				.$unique_block_class .tdm-list-item i {
				    margin-right: @icon_space;
				}



				/* @f_list */
				.$unique_block_class .tdm-list-item {
					@f_list
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->shortcode_atts);

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    /**
     * Callback pe media
     *
     * @param $responsive_context td_res_context
     * @param $atts
     */
    static function cssMedia( $res_ctx ) {

        /*-- TEXT -- */
        // text color
        $res_ctx->load_settings_raw( 'text_color', $res_ctx->get_shortcode_att( 'text_color' ) );

        // text hover color
        $res_ctx->load_settings_raw( 'hover_text_color', $res_ctx->get_shortcode_att( 'hover_text_color' ) );



        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att( 'icon_size' );
        $res_ctx->load_settings_raw( 'icon_size', $icon_size );
        if( $icon_size != '' && is_numeric( $icon_size ) ) {
            $res_ctx->load_settings_raw( 'icon_size', $icon_size . 'px' );
        }

        // icon_align
        $icon_align = $res_ctx->get_shortcode_att('icon_align');
        if ( $icon_align != 0 || !empty($icon_align) ) {
            $res_ctx->load_settings_raw( 'icon_align', $icon_align . 'px' );
        }

        // icon space
        $icon_space = $res_ctx->get_shortcode_att( 'icon_space' );
        $res_ctx->load_settings_raw( 'icon_space', $icon_space );
        if( $icon_space != '' ) {
            if ( is_numeric( $icon_space ) ) {
                $res_ctx->load_settings_raw( 'icon_space', $icon_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_space', '11px' );
        }

        // icon color
        $res_ctx->load_settings_raw( 'icon_color', $res_ctx->get_shortcode_att( 'icon_color' ) );

        // icon hover color
        $res_ctx->load_settings_raw( 'hover_icon_color', $res_ctx->get_shortcode_att( 'hover_icon_color' ) );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_list' );

    }



    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ))
			, $atts);

	    $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );
        $items = explode( "\n", rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'items' ) ) ) ) );
        $icon = $this->get_shortcode_att( 'tdicon' );

        $additional_classes = array();

        // content align horizontal
        if ( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }


        $buffy = '';

        $buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . ' tdm-list-with-icons" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();

        $buffy .= '<div class="tdm-col td-fix-index">';
            if ( ! empty( $items ) ) {
                $buffy .= '<ul class="tdm-list-items">';
                    foreach ($items as $item) {
                        $buffy .= '<li class="tdm-list-item">';
                            if ( !empty( $icon ) ) {
                                $buffy .= '<i class="' . $icon . '"></i>';
                            }
                            $buffy .= '<span class="tdm-list-text">' . $item . '</span>';
                        $buffy .= '</li>';
                    }
                $buffy .= '</ul>';
            }
        $buffy .= '</div>';
        $buffy .= '</div>';


        return $buffy;
    }
}