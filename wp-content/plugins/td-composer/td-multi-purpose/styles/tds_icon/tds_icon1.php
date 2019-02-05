<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_icon1 extends td_style {

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

                /* @transition */
				.$unique_style_class {
				    -webkit-transition: all 0.2s ease;
                    -moz-transition: all 0.2s ease;
                    -o-transition: all 0.2s ease;
                    transition: all 0.2s ease;
				} 
				.$unique_style_class:before {
				    -webkit-transition: all 0.2s ease;
                    -moz-transition: all 0.2s ease;
                    -o-transition: all 0.2s ease;
                    transition: all 0.2s ease;
				}

				/* @text_color_solid */
				.$unique_style_class:before {
					color: @text_color_solid;
				}
				/* @text_color_gradient */
				.$unique_style_class:before {
					@text_color_gradient
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
				}
				.td-md-is-ios .$unique_style_class:before {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_style_class:before,
				.td-md-is-ios .$unique_style_class:before {
				    background: none;
					color: @text_color_gradient_1;
				}
				/* @text_hover_color */
				body $unique_block_class_hover:before {
					color: @text_hover_color;
				}
				/* @text_hover_gradient */
				body $unique_block_class_hover:before {
					-webkit-text-fill-color: unset;
					background: transparent;
					transition: none;
				}

				/* @background_solid */
				.$unique_style_class {
					background-color: @background_solid;
				}
				/* @background_gradient */
				.$unique_style_class {
					@background_gradient
				}
				/* @background_hover_solid */
				.$unique_style_class:after {
					background-color: @background_hover_solid;
				}
				$unique_block_class_hover:after {
					opacity: 1;
				}
				/* @background_hover_gradient */
				.$unique_style_class:after {
					@background_hover_gradient
				}
				$unique_block_class_hover:after {
					opacity: 1;
				}







				/* @hover_color */
				$unique_block_class_hover:before {
				    color: @hover_color;
				}

				
				/* @shadow */
				.$unique_style_class {
				    box-shadow: @shadow;
				}
				/* @shadow_hover */
				$unique_block_class_hover {
				    box-shadow: @shadow_hover;
				}
				
			
				/* @all_border_size */
				.$unique_style_class {
				    border: @all_border_size @all_border_style @all_border_color;
				}
				/* @hover_border_color */
				$unique_block_class_hover {
				    border-color: @hover_border_color;
				}
				/* @border_radius */
				.$unique_style_class,
				.$unique_style_class:after {
				    border-radius: @border_radius;
				}
				/* @hover_border_radius */
				$unique_block_class_hover,
				$unique_block_class_hover:after {
				    border-radius: @hover_border_radius;
				}
                          
               
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts );

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

        // transition
        $res_ctx->load_settings_raw( 'transition', 1);



        /*-- BACKGROUND -- */
        $res_ctx->load_color_settings( 'bg_color', 'background_solid', 'background_gradient', '', '', __CLASS__ );

        // background hover
        $res_ctx->load_color_settings( 'hover_bg_color', 'background_hover_solid', 'background_hover_gradient', '', '', __CLASS__ );




        /*-- TEXT -- */
        // text color
        $res_ctx->load_color_settings( 'color', 'text_color_solid', 'text_color_gradient', 'text_color_gradient_1', '', __CLASS__ );

        // text hover color
        $hover_title_color = $res_ctx->get_style_att( 'hover_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'hover_color', $hover_title_color );
        if ( !empty ($hover_title_color ) ) {
            $res_ctx->load_settings_raw( 'text_hover_gradient', 1 );
        }



        /*-- SHADOW -- */
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.15)', 'shadow', __CLASS__ );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.15)', 'shadow_hover', __CLASS__ );



        /*-- BORDER -- */
        // border size
        $border_size = $res_ctx->get_style_att( 'all_border_size', __CLASS__ );
        $res_ctx->load_settings_raw( 'all_border_size', $border_size );
        if( $border_size != '' ) {
            if( is_numeric( $border_size ) ) {
                $res_ctx->load_settings_raw( 'all_border_size', $border_size . 'px' );
            }
        }

        // border style
        $border_style = $res_ctx->get_style_att( 'all_border_style', __CLASS__ );
        $res_ctx->load_settings_raw( 'all_border_style', 'solid' );
        if( !empty( $border_style ) ) {
            $res_ctx->load_settings_raw( 'all_border_style', $border_style );
        }

        // border color
        $border_color = $res_ctx->get_style_att( 'all_border_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'all_border_color', '#666' );
        if( $border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $border_color );
        }

        // border hover color
        $res_ctx->load_settings_raw( 'hover_border_color', $res_ctx->get_style_att( 'hover_border_color', __CLASS__ ) );

        // border radius
        $border_radius = $res_ctx->get_style_att( 'border_radius', __CLASS__ );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' && is_numeric( $border_radius ) ) {
            $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
        }

        // border hover radius
        $border_hover_radius = $res_ctx->get_style_att( 'hover_border_radius', __CLASS__ );
        $res_ctx->load_settings_raw( 'hover_border_radius', $border_hover_radius );
        if( $border_hover_radius != '' && is_numeric( $border_hover_radius ) ) {
            $res_ctx->load_settings_raw( 'hover_border_radius', $border_hover_radius .'px' );
        }

    }

    function render( $index_style = '' ) {

        if ( ! empty( $index_style ) ) {
            $this->index_style = $index_style;
        }
	    $this->unique_style_class = td_global::td_generate_unique_id();

	    $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
        $buffy .= '<i class="' . self::get_group_style( __CLASS__ ) . ' ' . $this->get_shortcode_att('tdicon_id') . ' ' . $this->unique_style_class . ' td-fix-index"></i>';

	    return $buffy;
	}

    function get_style_att( $att_name ) {
        return $this->get_att( $att_name ,__CLASS__, $this->index_style );
    }

    function get_atts() {
        return $this->atts;
    }
}