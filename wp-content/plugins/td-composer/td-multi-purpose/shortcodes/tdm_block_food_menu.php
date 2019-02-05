<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 07.09.2017
 * Time: 14:20
 */

class tdm_block_food_menu extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

	function render($atts, $content = null) {
		parent::render($atts);

		$this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
				td_api_style::get_style_group_params( 'tds_food_menu' ))
			, $atts);

		$additional_classes = array();

		$buffy = '';

		$buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';
            //get the block css
            $buffy .= $this->get_block_css();

            // Get food_menu
            $tds_food_menu = $this->get_shortcode_att('tds_food_menu');
            if ( empty( $tds_food_menu ) ) {
                $tds_food_menu = td_util::get_option( 'tds_food_menu', 'tds_food_menu1');
            }
            $tds_food_menu_instance = new $tds_food_menu( $this->shortcode_atts );
            $buffy .= $tds_food_menu_instance->render();

		$buffy .= '</div>';

		return $buffy;
	}
}