<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_title_over_image1 extends td_style {

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

		$raw_css =
			"<style>
                .td-md-is-ios .$unique_style_class .tdm-title {
                     -webkit-text-fill-color: initial;
                 }
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
				
				html[class*='ie'] .$unique_style_class .tdm-title,
				.td-md-is-ios .$unique_style_class .tdm-title {
				    background: none;
					color: @title_color_gradient_1;
				}
				/* @hover_title_color */
				body .$unique_style_class:hover .tdm-title {
					color: @hover_title_color;
				}
				/* @hover_gradient */
				body .$unique_style_class:hover .tdm-title {
					-webkit-text-fill-color: initial;
					background: transparent;
					transition: none;
				}
				
				/* @subtitle_color */
				body .$unique_style_class .tdm-title-sub {
					color: @subtitle_color;
				}
				
				/* @subtitle_space */
				.$unique_style_class .tdm-title-sub {
					margin-top: @subtitle_space;
				}

                /* @image */
				.$unique_style_class:before {
				    content: '';
				    position: absolute;
				    top: 0;
				    left: 0;
				    width: 100%;
				    height: 100%;
                    background-image: url(@image);
                    z-index: -1;
				}
				/* @image_repeat */
				.$unique_style_class:before {
					background-repeat: @image_repeat;
				}
				/* @image_size */ 
				.$unique_style_class:before {
					background-size: @image_size;
				}
				/* @image_alignment */
				.$unique_style_class:before {
					background-position: @image_alignment;
				}
				/* @image_opacity */
				.$unique_style_class:before {
					opacity: @image_opacity;
				}

				/* @block_height */
				.$unique_style_class {
					padding-bottom: @block_height;
				}
				
				/* @background_color */
				.$unique_style_class {
				    background-color: @background_color;
				}
				/* @background_color_gradient */
				.$unique_style_class {
				    @background_color_gradient
				}
				
				/* @overlay_color */
				.$unique_style_class .tdm-title-over-image-overlay:before {
				    background-color: @overlay_color;
				}
				/* @overlay_color_gradient */
				.$unique_style_class .tdm-title-over-image-overlay:before {
				    @overlay_color_gradient
				}
				/* @overlay_hover_color */
				.$unique_style_class:hover .tdm-title-over-image-overlay:before {
				    opacity: 0;
				}
				.$unique_style_class .tdm-title-over-image-overlay:after {
				    background-color: @overlay_hover_color;
				}
				/* @overlay_hover_color_gradient */
				.$unique_style_class .tdm-title-over-image-overlay:after {
				    @overlay_hover_color_gradient
				}
				.$unique_style_class:hover .tdm-title-over-image-overlay:before {
				    opacity: 0;
				}
				
				/* @show_title */
				.$unique_style_class .tdm-title-over-image-info {
				    opacity: 0;
				}
				.$unique_style_class:hover .tdm-title-over-image-info {
				    opacity: 1;
				}
				
				
				
				/* @f_title */
				.$unique_style_class .tdm-title {
				    @f_title
				}
				/* @f_subtitle */
				.$unique_style_class .tdm-title-sub {
				    @f_subtitle
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts, $this->index_style );

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

        // block height
        $block_height = $res_ctx->get_shortcode_att( 'block_height' );
        $res_ctx->load_settings_raw( 'hover_title_color', $block_height );
        if ( $block_height != '' ) {
            if( $block_height ) {
                $res_ctx->load_settings_raw( 'block_height', $block_height . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'block_height', '400px' );
        }



        /*-- BACKGROUND -- */
        // background color
        $res_ctx->load_color_settings( 'background_color', 'background_color', 'background_color_gradient', '', '', __CLASS__ );



        /*-- OVERLAY -- */
        // overlay color
        $res_ctx->load_color_settings( 'overlay_color', 'overlay_color', 'overlay_color_gradient', '', '', __CLASS__ );

        // overlay hover color
        $res_ctx->load_color_settings( 'overlay_hover_color', 'overlay_hover_color', 'overlay_hover_color_gradient', '', '', __CLASS__ );



        /*-- IMAGE -- */
        // image
        $res_ctx->load_settings_raw( 'image', tdc_util::get_image_or_placeholder( $res_ctx->get_shortcode_att('image') ) );

        // image repeat
        $image_repeat = $res_ctx->get_shortcode_att('image_repeat');
        $res_ctx->load_settings_raw( 'image_repeat', 'no-repeat' );
        if( $image_repeat != '' ) {
            $res_ctx->load_settings_raw( 'image_repeat', $image_repeat );
        }

        // image size
        $image_size = $res_ctx->get_shortcode_att('image_size');
        $res_ctx->load_settings_raw( 'image_size', 'cover' );
        if( $image_size != '' ) {
            $res_ctx->load_settings_raw( 'image_size', $image_size );
        }

        // image alignment
        $image_alignment = $res_ctx->get_shortcode_att('image_alignment');
        $res_ctx->load_settings_raw( 'image_alignment', 'center' );
        if( $image_alignment != '' ) {
            $res_ctx->load_settings_raw( 'image_alignment', $image_alignment );
        }

        // image opacity
        $res_ctx->load_settings_raw( 'image_opacity', $res_ctx->get_shortcode_att( 'image_opacity' ) );



        /*-- TITLE -- */
        // title color
        $res_ctx->load_color_settings( 'title_color', 'title_color_solid', 'title_color_gradient', 'title_color_gradient_1', '', __CLASS__ );

        // title hover color
        $hover_title_color = $res_ctx->get_style_att( 'hover_title_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'hover_title_color', $hover_title_color );
        if ( !empty ( $hover_title_color ) ) {
            $res_ctx->load_settings_raw( 'hover_gradient', 1 );
        }



        /*-- SUBTITLE -- */
        // subtitle color
        $res_ctx->load_settings_raw( 'subtitle_color', $res_ctx->get_style_att( 'subtitle_color', __CLASS__ ) );

        // subtitle space
        $subtitle_space = $res_ctx->get_style_att( 'subtitle_space', __CLASS__ );
        if( $subtitle_space != '' ) {
            if ( is_numeric( $subtitle_space ) ) {
                $res_ctx->load_settings_raw( 'subtitle_space',  $subtitle_space . 'px' );
            }
        }


        // show title only on hover
        $res_ctx->load_settings_raw( 'show_title',  $res_ctx->get_shortcode_att( 'show_title' ) );


        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title', __CLASS__ );
        $res_ctx->load_font_settings( 'f_subtitle', __CLASS__ );

    }

	function render( $index_style = '' ) {
		if ( ! empty( $index_style ) ) {
			$this->index_style = $index_style;
		}
        $this->unique_style_class = td_global::td_generate_unique_id();
        $title_text = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att('title_text') ) ) );
        $title_size = $this->get_shortcode_att('title_size');
        $subtitle_text = $this->get_shortcode_att('subtitle_text');
        $overlay_color = $this->get_style_att('overlay_color');
        $overlay_hover_color = $this->get_style_att('overlay_hover_color');
        $url = $this->get_shortcode_att('url');

        // Open in new window
        $open_in_new_window = $this->get_shortcode_att( 'open_in_new_window' );
        $target_blank = '';
        if  ( !empty( $open_in_new_window ) ) {
            $target_blank = ' target="_blank" ';
        }


		$buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
        $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . ' td-fix-index">';

            $buffy .= '<div class="tdm-title-over-image-info-wrap">';
                $buffy .= '<div class="tdm-title-over-image-info">';
                    if( !empty( $title_text ) ) {
                        $buffy .= '<h3 class="tdm-title ' . $title_size . '">' . $title_text . '</h3>';
                    }

                    if( !empty( $subtitle_text ) ) {
                        $buffy .= '<div class="tdm-title-sub">' . $subtitle_text . '</div>';
                    }
                $buffy .= '</div>';
            $buffy .= '</div>';

            if( !empty( $overlay_color ) || !empty( $overlay_hover_color ) ) {
                $buffy .= '<div class="tdm-title-over-image-overlay"></div>';
            }

            if( !empty( $url ) ) {
                $buffy .= '<a class="tdm-title-over-image-link" href="' . $url . '"' . $target_blank . '></a>';
            }

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