<?php
class tdm_block_fancy_text_image extends td_block {

	protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

    public function get_custom_css() {

        $compiled_css = '';

        $unique_block_class = $this->unique_block_class;

        $raw_css =
            "<style>

                /* @text1_color_solid */
				body .$unique_block_class .tdm-fancy-title1 {
					color: @text1_color_solid;
				}
				/* @text1_color_gradient */
				body .$unique_block_class .tdm-fancy-title1 {
					@text1_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_block_class .tdm-fancy-title1 {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdm-fancy-title1,
				.td-md-is-ios .$unique_block_class .tdm-fancy-title1 {
				    background: none;
					color: @text1_color_gradient_1;
				}
				/* @text2_color_solid */
				body .$unique_block_class .tdm-fancy-title2 {
					color: @text2_color_solid;
				}
				/* @text2_color_gradient */
				body .$unique_block_class .tdm-fancy-title2 {
					@text2_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_block_class .tdm-fancy-title2 {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdm-fancy-title2,
				.td-md-is-ios .$unique_block_class .tdm-fancy-title2 {
				    background: none;
					color: @text2_color_gradient_1;
				}
				/* @description_color */
				.$unique_block_class .tdm-descr {
				    color: @description_color;
				}

			    /* @icon_size */
				.$unique_block_class i {
				    font-size: @icon_size;
				    text-align: center;
				}
				/* @icon_spacing */
				.$unique_block_class i {
				    width: @icon_spacing;
				    height: @icon_spacing;
				    line-height: @icon_line_height;
				}
				/*@icon_display */
				.$unique_block_class {
				    display: table;
				}



				/* @f_title1 */
				.$unique_block_class .tdm-fancy-title1 {
					@f_title1
				}
				/* @f_title2 */
				.$unique_block_class .tdm-fancy-title2 {
					@f_title2
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

        /*-- DESCRIPTION -- */
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_shortcode_att( 'description_color' ) );



        /*-- TITLES -- */
        // Title 1 color
        $res_ctx->load_color_settings( 'text1_color', 'text1_color_solid', 'text1_color_gradient', 'text1_color_gradient_1', '' );
        $res_ctx->load_color_settings( 'text2_color', 'text2_color_solid', 'text2_color_gradient', 'text2_color_gradient_1', '' );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title1' );
        $res_ctx->load_font_settings( 'f_title2' );
        $res_ctx->load_font_settings( 'f_descr' );

    }

	function render($atts, $content = null) {
		parent::render($atts);

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $this->unique_block_class = $this->block_uid . '_rand';

		$this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_button' ))
			, $atts);

		$image = $this->get_shortcode_att( 'image' );
		$title1 = $this->get_shortcode_att( 'title1' );
		$title2 = $this->get_shortcode_att( 'title2' );
		$button_text = $this->get_shortcode_att( 'button_text' );
		$content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );
		$content_align_vertical = $this->get_shortcode_att( 'content_align_vertical' );
		$layout = $this->get_shortcode_att( 'layout' );
		$flip_content = $this->get_shortcode_att( 'flip_content' );
		$title_tag = $this->get_shortcode_att( 'title_tag' );
		$description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );

		$additional_classes = array();

        // fancy text
        $additional_classes[] = 'td_block_fancy_text';

        // layout
        if( ! empty( $layout ) ) {
            $additional_classes[] = 'tdm-' . $layout;
        }

        // flip_content
        if ( ! empty( $flip_content ) ) {
            $additional_classes[] = 'tdm-flip-' . $flip_content;
        }

        // content align horizontal
        if ( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        // text align vertical
        if ( ! empty( $content_align_vertical ) ) {
            $additional_classes[] = 'tdm-' . $content_align_vertical;
        }


		$buffy = '';
		$buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . ' tdm-mobile-full" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // image
            $buffy_image = '';
            $buffy_image .= '<div class="td-block-span5 tdm-col tdm-col-img">';
            if ( ! empty( $image ) ) {
                $buffy_image .= '<img class="tdm-image" src="' . tdc_util::get_image_or_placeholder($image) . '" alt="' . $title1 . '">';
            }
            $buffy_image .= '</div>';


            // text
            $buffy_text ='';
            $buffy_text .= '<div class="td-block-span7 tdm-col">';
                $buffy_text .= '<div class="tdm-text-wrap tdm-text-padding">';
                    $buffy_text .= '<' . $title_tag . ' class="tdm-fancy-title"><span class="tdm-fancy-title1">' . $title1 . '</span><span class="tdm-fancy-title2">' . $title2 . '</span></' . $title_tag . '>';
                    $buffy_text .= '<p class="tdm-descr">' . $description . '</p>';

                    if ( ! empty( $button_text ) ) {
                        $tds_button = $this->get_shortcode_att('tds_button');
                        if ( empty( $tds_button ) ) {
                            $tds_button = td_util::get_option( 'tds_button', 'tds_button1' );
                        }
                        $tds_button_instance = new $tds_button( $this->shortcode_atts );
                        $buffy_text .= $tds_button_instance->render();
                    }
                $buffy_text .= '</div>';
            $buffy_text .= '</div>';

            $buffy .= '<div class="td-block-width">';
                $buffy .= '<div class="td-block-row tdm-row td-fix-index">';
                    if ( empty( $flip_content) ) {
                        $buffy .= $buffy_image;
                        $buffy .= $buffy_text;
                    } else {
                        $buffy .= $buffy_text;
                        $buffy .= $buffy_image;
                    }
                $buffy .= '</div>';
            $buffy .= '</div>';

		$buffy .= '</div>';


		return $buffy;
	}
}