<?php
class tdm_block_client extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

    public function get_custom_css() {

        $compiled_css = '';

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $raw_css =
            "<style>

				/* @name_color */
				.$unique_block_class .tdm-client-name {
				    color: @name_color;
				}
				
				/* @initial_opacity */
				.$unique_block_class .tdm-client-image {
				    opacity: @initial_opacity;
				}
				/* @hover_opacity */
				.$unique_block_class:hover .tdm-client-image {
				    opacity: @hover_opacity;
				}
				
				/* @block_width */
				.$unique_block_class {
				    width: @block_width;
				}



				/* @f_title */
				.$unique_block_class .tdm-title {
					@f_title
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

        // block width
        $block_width = $res_ctx->get_shortcode_att( 'block_width' );
        $res_ctx->load_settings_raw( 'block_width',  $block_width );
        if( $block_width != '' ) {
            if ( is_numeric( $block_width ) ) {
                $res_ctx->load_settings_raw( 'block_width',  $block_width . 'px' );
            }
        }



        /*-- NAME -- */
        $res_ctx->load_settings_raw( 'name_color', $res_ctx->get_shortcode_att( 'name_color' ) );



        /*-- OPACITY -- */
        // initial opacity
        $res_ctx->load_settings_raw( 'initial_opacity', $res_ctx->get_shortcode_att( 'initial_opacity' ) );

        // hover opacity
        $res_ctx->load_settings_raw( 'hover_opacity', $res_ctx->get_shortcode_att( 'hover_opacity' ) );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title' );

    }

    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ))
			, $atts);

	    $image = $this->get_shortcode_att( 'image' );
	    $name = $this->get_shortcode_att( 'name' );
	    $name_tag = $this->get_shortcode_att( 'name_tag' );
        $url = $this->get_shortcode_att( 'url' );
        $display_inline = $this->get_shortcode_att( 'display_inline' );
	    $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );

        $additional_classes = array();

        // name tag
        if ( empty($name_tag ) ) {
            $name_tag = 'h3';
        }

        $target = '';
        if ( '' !== $this->get_shortcode_att( 'open_in_new_window' ) ) {
            $target = ' target="_blank" ';
        }

        // display inline
        if( !empty ( $display_inline ) ) {
            $additional_classes[] = 'tdm-inline-block';
        }

        // content align horizontal
        if ( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        $buffy = '';

        $buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //client html
            $buffy_client = '';
            if ( ! empty( $name ) ) {
                $buffy_client .= '<' . $name_tag . ' class="tdm-title tdm-title-xxsm tdm-client-name td-fix-index">' . $name . '</' . $name_tag . '>';
            }
            if ( ! empty( $image ) ) {
                $buffy_client .= '<img class="tdm-client-image td-fix-index" src="'. tdc_util::get_image_or_placeholder( $image ) . '">';
            }


            if ( !empty( $url ) ) {
                $buffy .= '<a href="' . $url . '" ' . $target . '>';
                    $buffy .= $buffy_client;
                $buffy .= '</a>';
            } else {
                $buffy .= $buffy_client;
            }

        $buffy .= '</div>';


        return $buffy;
    }
}