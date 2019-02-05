<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 13:55
 */

class vc_column_inner extends tdc_composer_block {

	function render($atts, $content = null) {
		parent::render($atts);

		$atts = shortcode_atts( array(
			'width' => '1/1'
		), $atts);


		// Set inner column width
		// For 'page_title_sidebar' template, modify the $atts['width']
		if ($atts['width'] === '1/1') {
			td_global::set_inner_column_width($atts['width']);
		} else {
			td_global::set_inner_column_width($atts['width']);
		}


		$td_pb_class = '';

		switch ($atts['width']) {
			case '1/1': //full
				$td_pb_class = 'td-pb-span12';
				break;
			case '2/3': //2 of 3
				$td_pb_class = 'td-pb-span8';
				break;
			case '1/3': // 1 of 3
				$td_pb_class = 'td-pb-span4';
				break;
			case '1/2': // 1 of 2
				$td_pb_class = 'td-pb-span6';
				break;
			case '1/4': // 1 of 4
				$td_pb_class = 'td-pb-span3';
				break;
			case '3/4': // 3 of 4
				$td_pb_class = 'td-pb-span9';
				break;
			case '7': // 7 of 12
				$td_pb_class = 'td-pb-span7';
				break;
			case '5': // 5 of 12
				$td_pb_class = 'td-pb-span5';
				break;
		}


		$buffy = '<div class="' . $this->get_block_classes(array('wpb_column', 'vc_column_container', 'tdc-inner-column', $td_pb_class)) . '">';

		// get_block_css is out of wpb_wrapper for FF
		$buffy .= $this->get_block_css();

			$buffy .= '<div class="vc_column-inner">'; // requiered to maintain vc compatibility
				$buffy .= '<div class="wpb_wrapper">';
					$buffy .= $this->do_shortcode($content);
				$buffy .= '</div>';
			$buffy .= '</div>';
		$buffy .= '</div>';


//		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
//			$buffy = '<div class="tdc-inner-column">' . $buffy . '</div>';
//		}

		return $buffy;
	}
}