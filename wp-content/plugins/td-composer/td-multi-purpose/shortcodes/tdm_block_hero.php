<?php
class tdm_block_hero extends td_block {

	protected $shortcode_atts = array(); //the atts used for rendering the current block

	public function get_custom_css() {

        $compiled_css = '';

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $raw_css =
            "<style>
                /* @block_width */
                .$unique_block_class .td-block-width {
                    max-width: @block_width;
                }
				
				/* @block_height */
                .$unique_block_class .td-block-row {
                    height: @block_height;
                }
                /* @block_height_perc */
                .$unique_block_class .td-block-row {
                    height: 0;
                    padding-bottom: @block_height_perc;
                }


				/* @background_color */
				body .$unique_block_class:after {
					background: @background_color;
				}

				/* @background */
				body .$unique_block_class:after {
					@background
				}


				/* @image */
				.$unique_block_class:before {
					content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
					background-image: url(@image);
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center center;
                    z-index: -1;
				}
				/* @image_repeat */
				.$unique_block_class:before {
					background-repeat: @image_repeat;
				}
				/* @image_size */ 
				.$unique_block_class:before {
					background-size: @image_size;
				}
				/* @image_alignment */
				.$unique_block_class:before {
					background-position: @image_alignment;
				}
				
				
                /* @description_color */
                body .$unique_block_class .tdm-descr {
                    color: @description_color;
                }
				
				
				/* @button_width */
                .$unique_block_class .tdm-btn {
                    min-width: @button_width;
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

        // block width
        $block_width = $res_ctx->get_shortcode_att( 'block_width' );
        $res_ctx->load_settings_raw( 'block_width', $block_width );
        if( $block_width != '' ) {
            if( is_numeric( $block_width ) ) {
                $res_ctx->load_settings_raw( 'block_width', $block_width . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'block_width', '1068px' );
        }

        // block height
        $block_height = $res_ctx->get_shortcode_att( 'block_height' );
        $res_ctx->load_settings_raw( 'block_height', $block_height );
        if( !empty( $block_height ) ) {
            if ( is_numeric( $block_height ) ) {
                $res_ctx->load_settings_raw( 'block_height', $block_height . 'px' );
            } else if ( strpos( $block_height, '%') == true ) {
                $res_ctx->load_settings_raw( 'block_height_perc', $block_height );
            }
        } else {
            $res_ctx->load_settings_raw( 'block_height', '600px' );
        }

        // overlay
        $res_ctx->load_color_settings( 'background', 'background_color', 'background', '', '' );



        /*-- IMAGE -- */
        // image
        $res_ctx->load_settings_raw( 'image',  tdc_util::get_image_or_placeholder($res_ctx->get_shortcode_att('image')));

        // image repeat
        $res_ctx->load_settings_raw( 'image_repeat',  $res_ctx->get_shortcode_att( 'image_repeat' ) );

        // image size
        $res_ctx->load_settings_raw( 'image_size',  $res_ctx->get_shortcode_att( 'image_size' ) );

        // image alignment
        $res_ctx->load_settings_raw( 'image_alignment',  $res_ctx->get_shortcode_att( 'image_alignment' ) );



        /*-- DESCRIPTION -- */
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_shortcode_att( 'description_color' ) );



        /*-- BUTTONS -- */
        // button width
        $button_width = $res_ctx->get_shortcode_att( 'button_width' );
        $res_ctx->load_settings_raw( 'button_width',  $button_width );
        if( $button_width != '' ) {
            if ( is_numeric( $button_width ) ) {
                $res_ctx->load_settings_raw( 'button_width',  $button_width . 'px' );
            }
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
                td_api_style::get_style_group_params( 'tds_button', '1' ),
                td_api_style::get_style_group_params( 'tds_button' ))
			, $atts);

        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );
		$block_full_height = $this->get_shortcode_att( 'block_full_height' );
        //$block_width = $this->get_shortcode_att('block_width');
        $content_align_horizontal = $this->get_shortcode_att('content_align_horizontal');
        $content_align_vertical = $this->get_shortcode_att('content_align_vertical');

        $button_text = $this->get_shortcode_att('button_text');
        $button_text2 = $this->get_shortcode_att('button_text-1');

		$additional_classes = array();


        // full height
        if ( '' !== $block_full_height ) {
            $block_full_height = 'tdm-full-height';
        }

        // content align horizontal
		if ( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        // text align vertical
		if ( ! empty($content_align_vertical ) ) {
            $additional_classes[] = 'tdm-' . $content_align_vertical;
        }


		$buffy = '';

		$buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . ' tdm_white_text ' . $block_full_height . ' tdm-mobile-full td-fix-index" ' . $this->get_block_html_atts() . '>';

		//get the block css
		$buffy .= $this->get_block_css();

        $buffy .= '<div class="td-block-width">';
            $buffy .= '<div class="td-block-row">';

                $buffy .= '<div class="td-block-span12 tdm-col">';
                    $buffy .= '<div class="tdm-text-wrap tdm-text-padding">';
                        $tds_title = $this->get_shortcode_att('tds_title');
                        if ( empty( $tds_title ) ) {
                            $tds_title = td_util::get_option( 'tds_title', 'tds_title1' );
                        }
                        $tds_title_instance = new $tds_title( $this->shortcode_atts );
                        $buffy .= $tds_title_instance->render();

                        $buffy .= '<p class="tdm-descr">' . $description . '</p>';

                        if ( !empty( $button_text ) || !empty( $button_text2 ) ) {
                            $buffy .= '<div class="tdm-buttons-wrap">';
                                if (!empty($button_text)) {
                                    // Get tds_button
                                    $tds_button = $this->get_shortcode_att('tds_button');
                                    if (empty($tds_button)) {
                                        $tds_button = td_util::get_option('tds_button', 'tds_button1');
                                    }
                                    $tds_button_instance = new $tds_button($this->shortcode_atts);
                                    $buffy .= $tds_button_instance->render();
                                }

                                if (!empty($button_text2)) {
                                    // Get tds_button
                                    $tds_button1 = $this->get_shortcode_att('tds_button-1');
                                    if (empty($tds_button1)) {
                                        $tds_button1 = td_util::get_option('tds_button', 'tds_button1');
                                    }
                                    $tds_button_instance1 = new $tds_button1($this->shortcode_atts, 1);
                                    $buffy .= $tds_button_instance1->render(1);
                                }
                            $buffy .= '</div>';
                        }
                    $buffy .= '</div>';
                $buffy .= '</div>';

            $buffy .= '</div>';
        $buffy .= '</div>';

		$buffy .= '</div>';

		return $buffy;
	}
}