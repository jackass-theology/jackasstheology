<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_food_menu1 extends td_style {

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

                /* @title_color */
				.$unique_style_class .tdm-title {
					color: @title_color;
				}
				/* @price_color */
				.$unique_style_class .tdm-food-menu-price {
					color: @price_color;
				}
				/* @description_color */
				body .$unique_style_class .tdm-descr {
				    color: @description_color;
				}
				/* @image_size */
				.$unique_style_class .tdm-food-menu-image {
					width: @image_size;
					height: @image_size;
				}
				.$unique_style_class .tdm-food-menu-image-wrap {
				    padding-right: @image_space;
				    display: table-cell;
					width: @image_size;
				}
				/* @image_border_radius */
				.$unique_style_class .tdm-food-menu-image {
					border-radius: @image_border_radius;
				}
				/* @content_align_vertical */
				.$unique_style_class .tdm-food-menu-details {
					vertical-align: @content_align_vertical;
				}


                /* @f_title */
				.$unique_style_class .tdm-title {
					@f_title
				}
				/* @f_price */
				.$unique_style_class .tdm-food-menu-price {
					@f_price
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

        $res_ctx->load_settings_raw( 'content_align_vertical', $res_ctx->get_shortcode_att( 'content_align_vertical' ) );



        /*-- TEXT -- */
        // title color
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_style_att( 'title_color', __CLASS__ ) );

        // price color
        $res_ctx->load_settings_raw( 'price_color', $res_ctx->get_style_att( 'price_color', __CLASS__ ) );

        // description color
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_style_att( 'description_color', __CLASS__ ) );



        /*-- IMAGE -- */
        // image size
        $image_size = $res_ctx->get_shortcode_att( 'image_size' );
        $res_ctx->load_settings_raw( 'image_size', $image_size );
        if( $image_size != '' ) {
            if( is_numeric( $image_size ) ) {
                $res_ctx->load_settings_raw( 'image_size', $image_size . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'image_size', '75px' );
        }

        // image space
        $image_space = $res_ctx->get_shortcode_att( 'image_space' );
        $res_ctx->load_settings_raw( 'image_space', $image_space );
        if( $image_space != '' ) {
            if( is_numeric( $image_space ) ) {
                $res_ctx->load_settings_raw( 'image_space', $image_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'image_space', '22px' );
        }



        /*-- BORDER -- */
        // border radius
        $border_radius = $res_ctx->get_shortcode_att( 'image_border_radius' );
        $res_ctx->load_settings_raw( 'image_border_radius', $border_radius );
        if( $border_radius != '' ) {
            if( is_numeric( $border_radius ) ) {
                $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'border_radius', '50%' );
        }



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title', __CLASS__ );
        $res_ctx->load_font_settings( 'f_price', __CLASS__ );
        $res_ctx->load_font_settings( 'f_descr', __CLASS__ );

    }

	function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_template = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $title_text = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'title_text' ) ) ) );
        $title_tag = $this->get_shortcode_att( 'title_tag' );
        $price = $this->get_shortcode_att( 'price' );
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description' ) ) ) );
        $image = $this->get_shortcode_att( 'image' );

		$buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="tdm-food-menu-wrap ' . $this->unique_style_class . ' td-fix-index">';
            if ( !empty( $image ) ) {
                $buffy .= '<div class="tdm-food-menu-image-wrap">';
                    $buffy .= '<div class="tdm-food-menu-image" style="background-image: url(' . tdc_util::get_image_or_placeholder( $image ) . ');"></div>';
                $buffy .= '</div>';
            }

            $buffy .= '<div class="tdm-food-menu-details">';
                $buffy .= '<div class="tdm-food-menu-title-wrap">';
                    $buffy .= '<' . $title_tag . ' class="tdm-title tdm-title-sm">' . $title_text . '</' . $title_tag . '>';

                    $buffy .= '<div class="tdm-food-menu-price"><span class="tdm-food-menu-currency"></span>' . $price . '</div>';
                $buffy .= '</div>';

                $buffy .= '<div class="tdm-descr">' . $description . '</div>';
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