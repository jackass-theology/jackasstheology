<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_title1 extends td_style {

	private $unique_block_class;
    private $unique_style_class;
	private $atts = array();
	private $index_style;

	function __construct( $atts, $unique_block_class = '', $index_style = '') {
		$this->atts = $atts;
		$this->unique_block_class = $unique_block_class;
		$this->index_style = $index_style;
	}

	private function get_css() {

        $compiled_css = '';

        $unique_style_class = $this->unique_style_class;

		$unique_block_class_hover = '.' . $unique_style_class . ':hover';
		if ( ! empty( $this->unique_block_class ) ) {
			$unique_block_class_hover = '.' . $this->unique_block_class . ':hover .' . $unique_style_class;
		}

		$raw_css =
			"<style>

				/* @title_color_solid */
				body .$unique_style_class .tdm-title {
					color: @title_color_solid;
				}
				/* @title_color_gradient */
				body .$unique_style_class .tdm-title {
					@title_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_style_class .tdm-title {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_style_class .tdm-title,
				.td-md-is-ios .$unique_style_class .tdm-title {
				    background: none;
					color: @title_color_gradient_1;
				}

				/* @hover_title_color */
				body $unique_block_class_hover .tdm-title {
					color: @hover_title_color;
				}
				$unique_block_class_hover .tdm-title {
					cursor: default;
				}
				/* @hover_gradient */
				body $unique_block_class_hover .tdm-title {
					-webkit-text-fill-color: unset;
					background: transparent;
					transition: none;
				}



				/* @f_title */
				.$unique_style_class .tdm-title {
					@f_title
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts);

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
        $res_ctx->load_color_settings( 'title_color', 'title_color_solid', 'title_color_gradient', 'title_color_gradient_1', '', __CLASS__ );

        // text hover color
        $hover_title_color = $res_ctx->get_style_att( 'hover_title_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'hover_title_color', $hover_title_color );
        if ( !empty ($hover_title_color ) ) {
            $res_ctx->load_settings_raw( 'hover_gradient', 1 );
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title', __CLASS__ );

    }

	function render( $index_style = '' ) {
		if ( ! empty( $index_style ) ) {
			$this->index_style = $index_style;
		}
        $this->unique_style_class = td_global::td_generate_unique_id();

		$title_tag = $this->get_shortcode_att( 'title_tag' );
		$title_size = $this->get_shortcode_att( 'title_size' );
		$title_text = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'title_text' ) ) ) );

		$buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' ' . self::get_class_style(__CLASS__) . ' td-fix-index ' . $this->unique_style_class . '"><' . $title_tag . ' class="tdm-title ' . $title_size . '">' . $title_text . '</' . $title_tag . '></div>';


		return $buffy;
	}

	function get_style_att( $att_name ) {
		return $this->get_att( $att_name ,__CLASS__, $this->index_style );
	}

	function get_atts() {
		return $this->atts;
	}
}