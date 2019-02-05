<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 25.01.2018
 * Time: 15:30
 */

abstract class td_style {

	protected abstract function get_style_att( $att_name );

	protected abstract function render( $index_style = '' );

	protected function get_shortcode_att( $att_name, $index_style = '' ) {
		return $this->get_att( $att_name, '', $index_style );
	}

	protected function get_att_name( $att_name, $style_class = '', $index_style = '' ) {
		if ( ! empty( $style_class ) ) {
			$att_name = $style_class . '-' . $att_name;
		}
		if ( ! empty( $index_style ) ) {
			$att_name .= '-' . $index_style;
		}
		return $att_name;
	}

	protected function get_att( $att_name, $style_class = '', $index_style = '' ) {
		$atts = $this->get_atts();
		if ( empty( $atts ) ) {
			td_util::error(__FILE__, get_class($this) . '->get_att(' . $att_name . ') Internal error: The atts are not set yet(AKA: the render template method was called without atts)');
			die;
		}

		$key = $this->get_att_name( $att_name, $style_class, $index_style );

		if ( ! isset( $atts[ $key ] ) ) {
			var_dump( $atts );
			td_util::error(__FILE__, 'Internal error: The system tried to use an att that does not exists! class_name: ' . get_class($this) . '  Att name: "' . $att_name . '" as "' . $key . '"');
			die;
		}

		return $atts[ $key ];
	}

	protected static function get_class_style( $class ) {
		return str_replace( '_', '-', $class );
	}

	protected static function get_group_style( $class ) {
		$styles = td_api_style::get_all();
		return str_replace( '_', '-', $styles[$class]['group'] );
	}
}