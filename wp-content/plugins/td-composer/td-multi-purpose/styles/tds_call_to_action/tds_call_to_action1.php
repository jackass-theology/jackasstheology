<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_call_to_action1 extends td_style {

    private $unique_style_class;
    private $unique_block_class;
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

        $unique_block_class = '';
        if ( !empty( $this->unique_block_class ) ) {
            $unique_block_class = '.' . $this->unique_block_class;
        }

		$raw_css =
			"<style>
				
				/* @description_color */
				.$unique_style_class .tdm-descr {
				    color: @description_color;
				}
			
				/* @shadow */
				$unique_block_class {
				    box-shadow: @shadow;
				}



				/* @f_descr */
				.$unique_style_class .tdm-descr {
					@f_descr
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

        /*-- DESCRIPTION -- */
        // description color
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_style_att( 'description_color', __CLASS__ ) );



        /*-- SHADOW -- */
        $res_ctx->load_shadow_settings( 0, 0, 8, 0, 'rgba(0, 0, 0, 0.08)', 'shadow', __CLASS__ );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_descr', __CLASS__ );

    }

    function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_template = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $title = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'title_text' ) ) ) );
        $button_text = $this->get_shortcode_att( 'button_text' );
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );
        $flip_content = $this->get_shortcode_att( 'flip_content' );

        // info
        $buffy_info = '';
        $buffy_info .= '<div class="td-block-span9 tdm-col">';
            if ( ! empty( $title ) ) {
                // Get tds_title
                $tds_title = $this->get_shortcode_att('tds_title');
                if ( empty( $tds_title ) ) {
                    $tds_title = td_util::get_option( 'tds_title', 'tds_title1' );
                }
                $tds_title_instance = new $tds_title( $this->atts );
                $buffy_info .= $tds_title_instance->render();
            }
            if ( ! empty( $description ) ) {
                $buffy_info .= '<p class="tdm-descr">' . $description . '</p>';
            }
        $buffy_info .= '</div>';

        // button
        $buffy_btn = '';
        $buffy_btn .= '<div class="td-block-span3 tdm-col">';
        if ( ! empty( $button_text ) ) {
            // Get tds_button
            $tds_button = $this->get_shortcode_att('tds_button');
            if ( empty( $tds_button ) ) {
                $tds_button = td_util::get_option( 'tds_button', 'tds_button1' );
            }
            $tds_button_instance = new $tds_button( $this->atts );
            $buffy_btn .= $tds_button_instance->render();
        }
        $buffy_btn .= '</div>';

        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="td-block-width ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . '">';
            $buffy .= '<div class="td-block-row tdm-row td-fix-index">';
                if ( empty( $flip_content ) ) {
                    $buffy .= $buffy_info;
                    $buffy .= $buffy_btn;
                } else {
                    $buffy .= $buffy_btn;
                    $buffy .= $buffy_info;
                }
            $buffy .= '</div>';
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