<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_title2 extends td_style {

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
				.$unique_style_class .tdm-title {
					color: @title_color_solid;
				}
				/* @title_color_gradient */
				.$unique_style_class .tdm-title {
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
				
				/* @line_color_gradient */
				body .$unique_style_class .tdm-title-line:after {
					@line_color_gradient
				}
				/* @line_color */
				body .$unique_style_class .tdm-title-line:after {
					background: @line_color;
				}
				/* @hover_line_color_gradient */
				$unique_block_class_hover .tdm-title-line:after {
					@hover_line_color_gradient
				}
				/* @hover_line_color */
				$unique_block_class_hover .tdm-title-line:after {
					background: @hover_line_color;
				}
				/* @line_width */
				.$unique_style_class .tdm-title-line  {
					width: @line_width;
				}
				/* @hover_line_width */
				$unique_block_class_hover .tdm-title-line  {
					width: @hover_line_width;
				}
				/* @line_height */
				.$unique_style_class .tdm-title-line:after  {
					height: @line_height;
				}
				/* @line_space */
				.$unique_style_class .tdm-title-line  {
					height: @line_space;
				}
				/* @line_alignment */
				.$unique_style_class .tdm-title-line:after   {
					bottom: @line_alignment;
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



        /*-- LINE -- */
        // line width
        $td_line_width = $res_ctx->get_style_att( 'line_width', __CLASS__ );
        $res_ctx->load_settings_raw( 'line_width', $td_line_width );
        if( $td_line_width != '' ) {
            if( is_numeric( $td_line_width ) ) {
                $res_ctx->load_settings_raw( 'line_width', $td_line_width . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'line_width', '180px' );
        }

        // hover line width
        $td_hover_line_width = $res_ctx->get_style_att( 'hover_line_width', __CLASS__ );
        $res_ctx->load_settings_raw( 'hover_line_width', $td_hover_line_width );
        if( is_numeric( $td_hover_line_width ) ) {
            $res_ctx->load_settings_raw( 'hover_line_width', $td_hover_line_width . 'px' );
        }

        // line height
        $td_line_height = $res_ctx->get_style_att( 'line_height', __CLASS__ );
        $res_ctx->load_settings_raw( 'line_height', $td_line_height );
        if( $td_line_height != '' ) {
            if( is_numeric( $td_line_height ) ) {
                $res_ctx->load_settings_raw( 'line_height', $td_line_height . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'line_height', '2px' );
        }

        // line space
        $td_line_space = $res_ctx->get_style_att( 'line_space', __CLASS__ );
        $res_ctx->load_settings_raw( 'line_space', $td_line_space );
        if( $td_line_space != '' ) {
            if( is_numeric( $td_line_space ) ) {
                $res_ctx->load_settings_raw( 'line_space', $td_line_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'line_space', '49px' );
        }


        // line alignment
        $td_line_alignment = $res_ctx->get_style_att( 'line_alignment', __CLASS__ );
        if( is_numeric( $td_line_alignment ) ) {
            $res_ctx->load_settings_raw( 'line_alignment', $td_line_alignment . '%' );
        }

        // line color
        $res_ctx->load_color_settings( 'line_color', 'line_color', 'line_color_gradient', '', '', __CLASS__ );

        // hover line color
        $res_ctx->load_color_settings( 'hover_line_color', 'hover_line_color', 'hover_line_color_gradient', '', '', __CLASS__ );




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

        $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' ' . self::get_class_style(__CLASS__) . ' td-fix-index ' . $this->unique_style_class . '">';
            $buffy .= '<' . $title_tag . ' class="tdm-title ' . $title_size . '">' . $title_text . '</' . $title_tag . '>';
            $buffy .= '<div class="tdm-title-line"></div>';
        $buffy .= '</div>';


		return $buffy;
	}

	function get_style_att( $att_name ) {
		return $this->get_att( $att_name ,__CLASS__, $this->index_style );
	}

	function get_atts() {
		return $this->atts;
	}
}