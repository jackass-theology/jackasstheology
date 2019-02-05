<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_menu_active1 extends td_style {

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
				
				/* @line_color_solid */
				$unique_block_class .tdb-menu > li > a:after,
				$unique_block_class .tdb-menu-items-dropdown .td-subcat-more:after {
					background-color: @line_color_solid;
				}
				/* @line_color_gradient */
				$unique_block_class .tdb-menu > li > a:after,
				$unique_block_class .tdb-menu-items-dropdown .td-subcat-more:after {
					@line_color_gradient
				}
				
				/* @line_width */
				$unique_block_class .tdb-menu > li.current-menu-item > a:after,
				$unique_block_class .tdb-menu > li.current-menu-ancestor > a:after,
				$unique_block_class .tdb-menu > li.current-category-ancestor > a:after,
				$unique_block_class .tdb-menu > li:hover > a:after,
				$unique_block_class .tdb-menu > li.tdb-hover > a:after,
				$unique_block_class .tdb-menu-items-dropdown:hover .td-subcat-more:after {
					width: @line_width;
				}
				/* @line_height */
				$unique_block_class .tdb-menu > li > a:after,
				$unique_block_class .tdb-menu-items-dropdown .td-subcat-more:after {
					height: @line_height;
				}
				/* @line_alignment */
				$unique_block_class .tdb-menu > li > a:after,
				$unique_block_class .tdb-menu-items-dropdown .td-subcat-more:after {
					bottom: @line_alignment;
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

        // line width
        $line_width = $res_ctx->get_style_att( 'line_width', __CLASS__ );
        $res_ctx->load_settings_raw( 'line_width', $line_width );
        if( $line_width != '' && is_numeric($line_width) ) {
            $res_ctx->load_settings_raw( 'line_width', $line_width . 'px' );
        }

        // line height
        $line_height = $res_ctx->get_style_att( 'line_height', __CLASS__ );
        if( $line_height != '' && is_numeric($line_height) ) {
            $res_ctx->load_settings_raw( 'line_height', $line_height . 'px' );
        }

        // line alignment
        $res_ctx->load_settings_raw( 'line_alignment', $res_ctx->get_style_att( 'line_alignment', __CLASS__ ) . 'px' );

        // line color
        $res_ctx->load_color_settings( 'line_color', 'line_color_solid', 'line_color_gradient', '', '', __CLASS__ );

    }

	function render( $index_style = '' ) {
		if ( ! empty( $index_style ) ) {
			$this->index_style = $index_style;
		}
        $this->unique_style_class = td_global::td_generate_unique_id();

		$buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

//        $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' ' . self::get_class_style(__CLASS__) . ' td-fix-index ' . $this->unique_style_class . '"><' . $title_tag . ' class="tdm-title ' . $title_size . '">' . $title_text . '</' . $title_tag . '></div>';

		return $buffy;
	}

	function get_style_att( $att_name ) {
		return $this->get_att( $att_name ,__CLASS__, $this->index_style );
	}

	function get_atts() {
		return $this->atts;
	}
}