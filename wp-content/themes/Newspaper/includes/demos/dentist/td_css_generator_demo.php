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
		.td-dentist .tdm-header-style-3 .sf-menu > li > a:hover,
		.td-dentist .tdm-header-style-3 .sf-menu > .sfHover > a,
		.td-dentist .tdm-header-style-3 .sf-menu > .current-menu-item > a,
		.td-dentist .tdm-header-style-3 .sf-menu > .current-menu-ancestor > a,
		.td-dentist .tdm-header-style-3 .sf-menu > .current-category-ancestor > a,
		.td-dentist .tdm-header-style-3 .td-header-top-menu-full .tdc-font-tdmp {
		    color: @theme_color !important;
		}
		
		.td-dentist .wpforms-form button[type=submit] {
			background-color: @theme_color !important;
		}
				
		.td-dentist .wpforms-form input[type=text],
		.td-dentist .wpforms-form input[type=number],
		.td-dentist .wpforms-form input[type=email],
		.td-dentist .wpforms-form textarea {
		   border-bottom-color: @theme_color !important;
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
