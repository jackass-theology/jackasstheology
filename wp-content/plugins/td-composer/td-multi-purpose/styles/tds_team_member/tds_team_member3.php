<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_team_member3 extends td_style {

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

                /* @image_repeat */
				.$unique_style_class .tdm-member-image {
					background-repeat: @image_repeat;
				}
				/* @image_size */ 
				.$unique_style_class .tdm-member-image {
					background-size: @image_size;
				}
				/* @image_alignment */
				.$unique_style_class .td-member-image {
					background-position: @image_alignment;
				}
				/* @img_width */
				.$unique_style_class .tdm-member-image-wrap {
					width: @img_width;
				}
				/* @img_height */
				.$unique_style_class .tdm-member-image {
					padding-bottom: @img_height;
				}
				/* @img_space */
				.$unique_style_class .tdm-member-image-wrap {
					padding-right: @img_space;
				}
				/* @image_border_radius */
				.$unique_style_class .tdm-member-image {
					border-radius: @image_border_radius;
				}
				
				/* @name_color */
				.$unique_style_class .tdm-title {
				    color: @name_color;
				}
				/* @title_color */
				.$unique_style_class .tdm-member-title {
				    color: @title_color;
				}
				/* @description_color */
				.$unique_style_class .tdm-descr {
				    color: @description_color;
				}
				
				/* @social_icons_space */
				.$unique_style_class .tdm-social-wrapper {
				    margin-top: @social_icons_space;
				}



				/* @f_title */
				.$unique_style_class .tdm-title {
					@f_title
				}
				/* @f_job_title */
				.$unique_style_class .tdm-member-title {
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
        // image repeat
        $image_repeat = $res_ctx->get_shortcode_att( 'image_repeat' );
        $res_ctx->load_settings_raw( 'image_repeat', 'no-repeat' );
        if( $image_repeat != '' ) {
            $res_ctx->load_settings_raw( 'image_repeat', $image_repeat );
        }

        // image size
        $image_size = $res_ctx->get_shortcode_att( 'image_size' );
        $res_ctx->load_settings_raw( 'image_size', 'cover' );
        if( $image_size != '' ) {
            $res_ctx->load_settings_raw( 'image_size', $image_size );
        }

        // image alignment
        $image_alignment = $res_ctx->get_shortcode_att( 'image_alignment' );
        $res_ctx->load_settings_raw( 'image_alignment', 'center' );
        if( $image_alignment != '' ) {
            $res_ctx->load_settings_raw( 'image_alignment', $image_alignment );
        }

        // image width
        $image_width = $res_ctx->get_style_att( 'image_width', __CLASS__ );
        $res_ctx->load_settings_raw( 'img_width', $image_width );
        if( $image_width != '' ) {
            if( is_numeric( $image_width ) ) {
                $res_ctx->load_settings_raw( 'img_width', $image_width . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'img_width', '140px' );
        }

        // image height
        $res_ctx->load_settings_raw( 'img_height', $res_ctx->get_shortcode_att( 'img_height' ) );

        // image space
        $image_space = $res_ctx->get_style_att( 'image_space', __CLASS__ );
        $res_ctx->load_settings_raw( 'img_space', $image_space );
        if( $image_space != '' ) {
            if( is_numeric( $image_space ) ) {
                $res_ctx->load_settings_raw( 'img_space', $image_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'img_space', '28px' );
        }

        // image border radius
        $image_border_radius = $res_ctx->get_shortcode_att( 'image_border_radius' );
        $res_ctx->load_settings_raw( 'image_border_radius', $image_border_radius );
        if( $image_border_radius != '' ) {
            if( is_numeric( $image_border_radius ) ) {
                $res_ctx->load_settings_raw( 'image_border_radius', $image_border_radius . 'px' );
            }
        }



        /*-- TEXT -- */
        // name color
        $res_ctx->load_settings_raw( 'name_color', $res_ctx->get_style_att( 'name_color', __CLASS__ ) );

        // job title color
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_style_att( 'title_color', __CLASS__ ) );

        // description color
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_style_att( 'description_color', __CLASS__ ) );



        /*-- SOCIAL ICONS -- */
        // social icons space
        $social_icons_space = $res_ctx->get_shortcode_att( 'social_icons_space' );
        $res_ctx->load_settings_raw( 'social_icons_space', $social_icons_space );
        if( $social_icons_space != '' ) {
            if( is_numeric( $social_icons_space ) ) {
                $res_ctx->load_settings_raw( 'social_icons_space', $social_icons_space . 'px' );
            }
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title', __CLASS__ );
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
        $job_title = $this->get_shortcode_att( 'job_title' );
        $name_tag = $this->get_shortcode_att( 'name_tag' );
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );
        $vertical_align = 'tdm-team-' . $this->get_style_att( 'content_align_vertical' );

        // name tag
        if ( empty($name_tag ) ) {
            $name_tag = 'h2';
        }

        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="tdm-team-member-wrap ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . ' ' . $vertical_align . '">';
            if ( ! empty( $image ) ) {
                $buffy .= '<div class="tdm-member-image-wrap">';
                    $buffy .= '<div class="tdm-member-image td-fix-index" style="background-image: url(' . tdc_util::get_image_or_placeholder( $image ) . ');"></div>';
                $buffy .= '</div>';
            }

            $buffy .= '<div class="tdm-member-info td-fix-index">';
                $buffy .= '<' . $name_tag . ' class="tdm-title tdm-title-sm td-fix-index">' . $name . '</' . $name_tag . '>';
                $buffy .= '<span class="tdm-member-title td-fix-index">' . $job_title  . '</span>';

                $buffy .= '<p class="tdm-descr">' . $description . '</p>';

                // Get social_style_id
                $tds_social = $this->get_shortcode_att('tds_social');
                if ( empty( $tds_social ) ) {
                    $tds_social = td_util::get_option( 'tds_social', 'tds_social1');
                }
                $tds_social_instance = new $tds_social( $this->atts );
                $buffy .= $tds_social_instance->render();
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