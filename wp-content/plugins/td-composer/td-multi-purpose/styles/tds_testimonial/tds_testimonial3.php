<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_testimonial3 extends td_style {

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

                /* @image_size */ 
				.$unique_style_class .tdm-testimonial-image {
					width: @image_size;
					height: @image_size;
				}
				/* @image_space */
				.$unique_style_class .tdm-testimonial-image {
					margin-right: @image_space;
				}
				/* @image_border_radius */
				.$unique_style_class .tdm-testimonial-image {
					border-radius: @image_border_radius;
				}
				
				/* @name_color */
				.$unique_style_class .tdm-testimonial-name {
				    color: @name_color;
				}
				/* @title_color */
				body .$unique_style_class .tdm-testimonial-job {
				    color: @title_color;
				}
				/* @background_color */
				.$unique_style_class.tds-testimonial3 .tdm-testimonial-descr {
				    background-color: @background_color !important;
				}
				.$unique_style_class.tds-testimonial3 .tdm-testimonial-info:before {
                    border-color: @background_color transparent transparent transparent !important;
				}
				/* @description_color */
				body .$unique_style_class.tds-testimonial3 .tdm-testimonial-descr {
				    color: @description_color;
				}
				/* @desc_radius */
				.$unique_style_class .tdm-testimonial-descr {
				    border-radius: @desc_radius;
				}
				/* @arrow_size */
				.$unique_style_class.tds-testimonial3 .tdm-testimonial-info:before {
				    border-width: @arrow_size @arrow_size 0 @arrow_size;
				}
				/* @arrow_pos */
				.$unique_style_class.tds-testimonial3 .tdm-testimonial-info:before {
				    left: @arrow_pos;
				}



				/* @f_name */
				.$unique_style_class .tdm-title {
					@f_name
				}
				/* @f_job_title */
				.$unique_style_class .tdm-testimonial-job {
					@f_job_title
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

        /*-- IMAGE -- */
        // image size
        $image_size = $res_ctx->get_shortcode_att( 'image_size' );
        if( $image_size != '' ) {
            if ( is_numeric( $image_size ) ) {
                $res_ctx->load_settings_raw( 'image_size',  $image_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'image_size', '52px' );
        }

        // image space
        $image_space = $res_ctx->get_shortcode_att( 'image_space' );
        if( $image_space != '' ) {
            if ( is_numeric( $image_space ) ) {
                $res_ctx->load_settings_raw( 'image_space',  $image_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'image_space',  '15px' );
        }

        // image border radius
        $border_radius = $res_ctx->get_shortcode_att( 'image_border_radius' );
        $res_ctx->load_settings_raw( 'image_border_radius',  $border_radius );
        if( $border_radius != '' ) {
            if ( is_numeric( $border_radius ) ) {
                $res_ctx->load_settings_raw( 'image_border_radius',  $border_radius . 'px' );
            }
        }
        // arrow size
        $arrow_size = $res_ctx->get_style_att( 'arrow_size', __CLASS__ );
        $res_ctx->load_settings_raw( 'arrow_size',  $arrow_size );
        if( $arrow_size != '' ) {
            if ( is_numeric( $arrow_size ) ) {
                $res_ctx->load_settings_raw( 'arrow_size', $arrow_size . 'px' );
            }
        }
        // arrow pos
        $arrow_pos = $res_ctx->get_style_att( 'arrow_pos', __CLASS__ );
        $res_ctx->load_settings_raw( 'arrow_pos',  $arrow_pos );
        if( $arrow_pos != '' ) {
            if ( is_numeric( $arrow_pos ) ) {
                $res_ctx->load_settings_raw( 'arrow_pos', $arrow_pos . 'px' );
            }
        }

        // testimonial radius
        $res_ctx->load_settings_raw( 'desc_radius', $res_ctx->get_style_att( 'desc_radius', __CLASS__ ) );

        /*-- TEXT -- */
        // name color
        $res_ctx->load_settings_raw( 'name_color', $res_ctx->get_style_att( 'name_color', __CLASS__ ) );

        // job title color
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_style_att( 'title_color', __CLASS__ ) );

        // description color
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_style_att( 'description_color', __CLASS__ ) );

        // description background color
        $res_ctx->load_settings_raw( 'background_color', $res_ctx->get_style_att( 'background_color', __CLASS__ ) );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_name', __CLASS__ );
        $res_ctx->load_font_settings( 'f_job_title', __CLASS__ );
        $res_ctx->load_font_settings( 'f_descr', __CLASS__ );

    }

    function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_template = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $image = $this->get_shortcode_att( 'image' );
        $name = $this->get_shortcode_att( 'name' );
        $name_tag = $this->get_shortcode_att( 'name_tag' );
        $job_title = $this->get_shortcode_att( 'job_title' );
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );

        // name tag
        if ( empty($name_tag ) ) {
            $name_tag = 'h2';
        }

        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
        $buffy .= '<div class="tdm-testimonial-wrap td-fix-index ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . '">';
            $buffy .= '<i class="tdm-icon-font tdm-icon-quote-left"></i>';

            $buffy .= '<p class="tdm-descr tdm-testimonial-descr">' . $description . '</p>';

            $buffy .= '<div class="tdm-testimonial-info">';
                if ( ! empty( $image ) ) {
                    $buffy .= '<div class="tdm-testimonial-image" style="background-image: url(' . tdc_util::get_image_or_placeholder( $image ) . ');"></div>';
                }

                $buffy .= '<div class="tdm-testimonial-info2">';
                    $buffy .= '<' . $name_tag . ' class="tdm-title tdm-title-sm tdm-testimonial-name">' . $name . '</' . $name_tag . '>';
                    $buffy .= '<span class="tdm-testimonial-job">' . $job_title  . '</span>';
                $buffy .= '</div>';
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