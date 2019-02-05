<?php
class tdm_block_column_content extends td_block {

	protected $shortcode_atts = array(); //the atts used for rendering the current block

    public function get_custom_css() {

        $compiled_css = '';

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $raw_css =
            "<style>

                /* @images_height */
                .$unique_block_class .tdm-image-holder {
                    padding-bottom: @images_height;
                }
                
                /* @descr_padding */
                .$unique_block_class .tdm-col-content-info {
                    padding: @descr_padding;
                }
                
                
                /* @description_color */
                .$unique_block_class .tdm-descr {
                    color: @description_color;
                }



				/* @f_descr */
				.$unique_block_class .tdm-descr {
					@f_descr
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

        // images height
        $res_ctx->load_settings_raw( 'images_height', $res_ctx->get_shortcode_att( 'images_height' ) );



        /*-- DESCRIPTION -- */
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_shortcode_att( 'description_color' ) );

        // description padding
        $descr_padding = $res_ctx->get_shortcode_att( 'descr_padding' );
        $res_ctx->load_settings_raw( 'descr_padding', $descr_padding );
        if( $descr_padding != '' && is_numeric( $descr_padding ) ) {
            $res_ctx->load_settings_raw( 'descr_padding', $descr_padding . 'px' );
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_descr' );

    }

    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_title' ),
                td_api_style::get_style_group_params( 'tds_button' ))
			, $atts);

	    $url = $this->get_shortcode_att( 'url' );
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );
	    $image1 = $this->get_shortcode_att( 'image1' );
	    $image2 = $this->get_shortcode_att( 'image2' );
        $title_text = $this->get_shortcode_att('title_text');
        $button_text = $this->get_shortcode_att('button_text');

        $additional_classes = array();
        $target = '';
        if ( '' !== $this->get_shortcode_att( 'open_in_new_window' ) ) {
            $target = ' target="_blank" ';
        }

        // content align horizontal
	    $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );
        if( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        $buffy = '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block css
		    $buffy .= $this->get_block_css();

		    //images html
            $buffy_images = '';
            if ( !empty( $image1 ) ) {
                $buffy_images .= '<div class="tdm-active-img" style="background-image: url(' . tdc_util::get_image_or_placeholder( $image1 ) . ')"></div>';
            }
            if ( !empty( $image2 ) ) {
                $buffy_images .= '<div class="tdm-hover-img" style="background-image: url(' . tdc_util::get_image_or_placeholder( $image2 ) . ')"></div>';
            }

            //title html
            $buffy_title = '';
            if ( !empty($title_text) ) {
                // Get tds_title
                $tds_title = $this->get_shortcode_att('tds_title');
                if (empty($tds_title)) {
                    $tds_title = td_util::get_option('tds_title', 'tds_title1');
                }
                $tds_title_instance = new $tds_title($this->shortcode_atts);
                $buffy_title .= $tds_title_instance->render();
            }

            //button html
            $buffy_button = '';
            if ( !empty($button_text) ) {
                // Get tds_button
                $tds_button = $this->get_shortcode_att('tds_button');
                if ( empty( $tds_button ) ) {
                    $tds_button = td_util::get_option( 'tds_button', 'tds_button1' );
                }
                $tds_button_instance = new $tds_button( $this->shortcode_atts );
                $buffy_button .= $tds_button_instance->render();
            }


            if ( !empty( $url ) ) {
                if ( !empty( $image1 ) || !empty( $image2 ) ) {
                    $buffy .= '<a href="' . $url . '" class="tdm-image-holder"' . $target . '>';
                        $buffy .= $buffy_images;
                    $buffy .= '</a>';
                }

                $buffy .= '<div class="tdm-col-content-info">';
                    $buffy .= '<a href="' . $url .'"' . $target. ' class="tdm-col-content-title-url">' . $buffy_title . '</a>';
            } else {
                if ( !empty( $image1 ) || !empty( $image2 ) ) {
                    $buffy .= '<div class="tdm-image-holder">';
                        $buffy .= $buffy_images;
                    $buffy .= '</div>';
                }

                $buffy .= '<div class="tdm-col-content-info">';
                    $buffy .= $buffy_title;
            }

                $buffy .= '<p class="tdm-descr td-fix-index">' . $description . '</p>';

                $buffy .= $buffy_button;
            $buffy .= '</div>';

        $buffy .= '</div>';


        return $buffy;
    }
}