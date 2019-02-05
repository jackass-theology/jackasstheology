<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_progress_bar3 extends td_style {

    private $unique_style_class;
    private $atts = array();
    private $index_style;

    function __construct( $atts, $index_style = '') {
        $this->atts = $atts;
        $this->index_style = $index_style;
    }

	private function get_css() {

        $compiled_css = '';

        $unique_style_class = $this->unique_style_class;

		$raw_css =
			"<style>

                /* @percentage_bar_width */
                @media (min-width: 1018px) {
                    .$unique_style_class.tds-progress-bar3 .tdm-progress-bar {
                        width: @percentage_bar_width;
                        padding-bottom: @percentage_bar_height;
                    }
                    .$unique_style_class.tds-progress-bar3 .tdm-progress-bar:before,
                    .$unique_style_class.tds-progress-bar3 .tdm-progress-bar:after {
                        width: @percentage_bar_width;
                        height: calc(~'@percentage_bar_width - 20px');
                    }
                }

				/* @percentage_bar_progress */
				.$unique_style_class .tdm-progress-bar:after {
				    transform: rotate(@percentage_bar_progress);
				    -webkit-transform: rotate(@percentage_bar_progress);
                    -moz-transform: rotate(@percentage_bar_progress);
                    -ms-transform: rotate(@percentage_bar_progress);
                    -o-transform: rotate(@percentage_bar_progress);
				}
				/* @title_color */
				.$unique_style_class .tdm-progress-title {
					color: @title_color;
				}
				/* @percentage_bar_color */
				body .$unique_style_class .tdm-progress-bar:after {
					border-color: @percentage_bar_color;
				}
				/* @percentage_bar_background_color */
				body .$unique_style_class .tdm-progress-bar:before {
					border-color: @percentage_bar_background_color;
				}
				/* @percentage_text_color */
				.$unique_style_class .tdm-progress-percentage {
					color: @percentage_text_color;
				}



				/* @f_title */
				.$unique_style_class .tdm-progress-title {
					@f_title
				}
				/* @f_percentage */
				.$unique_style_class .tdm-progress-percentage {
					@f_percentage
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
        // title color
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_style_att( 'title_color', __CLASS__ ) );

        // percentage text color
        $res_ctx->load_settings_raw( 'percentage_text_color', $res_ctx->get_style_att( 'percentage_text_color', __CLASS__ ) );



        /*-- PERCENTAGE BAR -- */
        // percentage bar fill
        $res_ctx->load_settings_raw( 'percentage_bar_progress', $res_ctx->get_shortcode_att( 'progress_percentage' ) * 1.8 .'deg' );

        // percentage bar height
        $percentage_bar_size = $res_ctx->get_style_att( 'percentage_bar_size', __CLASS__ );
        if( $percentage_bar_size != '' ) {
            if( is_numeric( $percentage_bar_size ) ) {
                $res_ctx->load_settings_raw( 'percentage_bar_width', $percentage_bar_size . 'px' );
                $res_ctx->load_settings_raw( 'percentage_bar_height', $percentage_bar_size / 2 . 'px' );
            }
        }

        // percentage bar color
        $res_ctx->load_settings_raw( 'percentage_bar_color', $res_ctx->get_style_att( 'percentage_bar_color', __CLASS__ ) );

        // percentage bar background color
        $res_ctx->load_settings_raw( 'percentage_bar_background_color', $res_ctx->get_style_att( 'percentage_bar_background_color', __CLASS__ ) );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title', __CLASS__ );
        $res_ctx->load_font_settings( 'f_percentage', __CLASS__ );

    }

    function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_template = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $title = $this->get_shortcode_att( 'progress_title' );
        $percentage = $this->get_shortcode_att( 'progress_percentage' );

        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
        $buffy .= '<div class="tdm-progress-wrap ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . '">';
            $buffy .= '<div class="tdm-progress-bar td-fix-index">';
                $buffy .= '<div class="tdm-progress-percentage">' . $percentage .'%</div>';
            $buffy .= '</div>';

            $buffy .= '<div class="tdm-progress-title td-fix-index">' . $title .'</div>';
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