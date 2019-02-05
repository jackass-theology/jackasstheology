<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_menu_sub_active1 extends td_style {

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

        $unique_block_class = '.' . $this->unique_block_class;


		$raw_css =
			"<style>

				/* @sub_text_color_h */
				$unique_block_class .tdb-menu ul .tdb-normal-menu.current-menu-item > a,
				$unique_block_class .tdb-menu ul .tdb-normal-menu:hover > a,
				$unique_block_class .td-pulldown-filter-list li:hover a {
					color: @sub_text_color_h;
				}
				/* @sub_elem_bg_color_h */
				$unique_block_class .tdb-menu ul .tdb-normal-menu.current-menu-item > a,
				$unique_block_class .tdb-menu ul .tdb-normal-menu:hover > a,
				$unique_block_class .td-pulldown-filter-list li:hover a {
					background-color: @sub_elem_bg_color_h;
				}
				/* @sub_color_h */
				$unique_block_class .tdb-menu ul .tdb-normal-menu.current-menu-item > a i,
				$unique_block_class .tdb-menu ul .tdb-normal-menu:hover > a i {
					color: @sub_color_h;
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

        // colors
        $res_ctx->load_settings_raw( 'sub_text_color_h', $res_ctx->get_style_att( 'sub_text_color_h', __CLASS__ ) );
        $res_ctx->load_settings_raw( 'sub_elem_bg_color_h', $res_ctx->get_style_att( 'sub_elem_bg_color_h', __CLASS__ ) );
        $res_ctx->load_settings_raw( 'sub_color_h', $res_ctx->get_style_att( 'sub_color_h', __CLASS__ ) );

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