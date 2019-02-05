<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 17.06.2016
 * Time: 16:48
 */

class vc_empty_space extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'height' => '32px',
				'el_class' => '',
			), $atts, 'vc_empty_space' );

		$inline_css = ( (float) $atts['height'] >= 0.0 ) ? ' style="height: ' . esc_attr( $atts['height'] ) . '"' : '';



		$editing_class = '';
		$editing_text = '';
		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
			$editing_class = 'tdc-editing-vc_empty_space';
			$editing_text = '<div class="tdc-editing-text">Empty space</div>';
		}


		return '<div class="wpb_wrapper td_block_empty_space td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'], $editing_class ) ) . '" ' . $inline_css . '>' . $this->get_block_css() . $editing_text .  '</div>';
	}
}