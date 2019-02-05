<?php
/**
 * Created by ra.
 * Date: 9/2/2015
 * CSS generator for this specific demo
 */


function td_css_demo_gen() {
	$td_demo_custom_css = "
	<style>

		/* @theme_color */
		.td-voice .td_module_2 .td-module-comments a,
		.td-voice .td_module_8 .td-module-comments a,
		.td-voice .td_module_10 .td-module-comments a {
			background-color: @theme_color;
		}


		.td-voice .td_module_2 .td-module-comments a:after,
		.td-voice .td_module_8 .td-module-comments a:after,
		.td-voice .td_module_10 .td-module-comments a:after {
			border-color: @theme_color transparent transparent;
		}

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('module_17_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	//load the selection color
	$tds_theme_color = td_util::get_option('tds_theme_color');
	if (!empty($tds_theme_color)) {
		//the sliders text
		$td_demo_css_compiler->load_setting_raw('module_17_color', td_util::hex2rgba($tds_theme_color, 0.7));
	}

	return $td_demo_css_compiler->compile_css();
}