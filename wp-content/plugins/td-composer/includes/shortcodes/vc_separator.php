<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 06.02.2017
 * Time: 11:23
 */

class vc_separator extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'color' => '#EBEBEB',
				'align' => 'center',
				'style' => 'solid',
				'border_width' => '1',
				'el_width' => '100',

				'el_class' => '',
			), $atts, 'vc_separator' );

		$editing_class = '';
		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$editing_class = 'tdc-editing-vc_separator';
		}

		$buffer = '<div class="wpb_wrapper td_block_separator td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'], $editing_class ) ) . ' td_separator_' . $atts['style'] . ' td_separator_' . $atts['align'] . '">';

        if ( $atts['style'] === 'shadow' ) {

	        $css_box_shadow = 'box-shadow:0 10px 10px ' . $atts['border_width'] . 'px;';

		    $buffer .= '<span style="color:' . $atts['color'] . ';width:' . $atts['el_width'] . '%;">';
			$buffer .= '<span style="-moz-' . $css_box_shadow . ';-webkit-' . $css_box_shadow . '' . $css_box_shadow. '"></span>';
			$buffer .= '</span>';
        } else {
			$buffer .= '<span style="border-color:' . $atts['color'] . ';border-width:' . $atts['border_width'] . 'px;width:' . $atts['el_width'] . '%;"></span>';
		}

		$buffer .= $this->get_block_css() . '</div>';

		return  $buffer;
	}
}