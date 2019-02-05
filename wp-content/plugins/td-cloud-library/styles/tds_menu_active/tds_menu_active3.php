<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_menu_active3 extends td_style {

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
        $unique_block_class = '.' . $this->unique_block_class;


		$raw_css =
			"<style>

				/* @text_color_h */
				$unique_block_class .tdb-menu > li.current-menu-item > a,
				$unique_block_class .tdb-menu > li.current-menu-ancestor > a,
				$unique_block_class .tdb-menu > li.current-category-ancestor > a,
				$unique_block_class .tdb-menu > li:hover > a,
				$unique_block_class .tdb-menu > li.tdb-hover > a,
				$unique_block_class .tdb-menu-items-dropdown:hover .td-subcat-more {
					color: @text_color_h;
				}
				
				/* @main_sub_color_h */
				$unique_block_class .tdb-menu > li.current-menu-item > a .tdb-sub-menu-icon,
				$unique_block_class .tdb-menu > li.current-menu-ancestor > a .tdb-sub-menu-icon,
				$unique_block_class .tdb-menu > li.current-category-ancestor > a .tdb-sub-menu-icon,
				$unique_block_class .tdb-menu > li:hover > a .tdb-sub-menu-icon,
				$unique_block_class .tdb-menu > li.tdb-hover > a .tdb-sub-menu-icon,
				$unique_block_class .tdb-menu-items-dropdown:hover .td-subcat-more .tdb-menu-more-icon {
					color: @main_sub_color_h;
				}
				
				/* @bg_color */
				$unique_block_class .tdb-menu > li > a:after,
				$unique_block_class .tdb-menu-items-dropdown .td-subcat-more:after {
					background-color: @bg_color;
				}
				
				/* @border_radius */
				$unique_block_class .tdb-menu > li > a:after,
				$unique_block_class .tdb-menu-items-dropdown .td-subcat-more:after {
				    border-radius: @border_radius;
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

        // text hover color
        $res_ctx->load_settings_raw( 'text_color_h', $res_ctx->get_style_att( 'text_color_h', __CLASS__ ) );

        // sub menu icon hover color
        $res_ctx->load_settings_raw( 'main_sub_color_h', $res_ctx->get_style_att( 'main_sub_color_h', __CLASS__ ) );

        // background color
        $res_ctx->load_settings_raw( 'bg_color', $res_ctx->get_style_att( 'bg_color', __CLASS__ ) );

        // border radius
        $border_radius = $res_ctx->get_style_att( 'border_radius', __CLASS__ );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' && is_numeric( $border_radius ) ) {
            $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
        }

    }

	function render( $index_style = '' ) {
		if ( ! empty( $index_style ) ) {
			$this->index_style = $index_style;
		}
        $this->unique_style_class = td_global::td_generate_unique_id();

		$buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

		return $buffy;
	}

	function get_style_att( $att_name ) {
		return $this->get_att( $att_name ,__CLASS__, $this->index_style );
	}

	function get_atts() {
		return $this->atts;
	}
}