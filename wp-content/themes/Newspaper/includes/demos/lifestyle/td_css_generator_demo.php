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
	.td-lifestyle .td-header-style-1 .sf-menu > li > a:hover,
	.td-lifestyle .td-header-style-1 .sf-menu > .sfHover > a,
	.td-lifestyle .td-header-style-1 .sf-menu > .current-menu-item > a,
	.td-lifestyle .td-header-style-1 .sf-menu > .current-menu-ancestor > a,
	.td-lifestyle .td-header-style-1 .sf-menu > .current-category-ancestor > a,
	.td-lifestyle .td-social-style3 .td_social_type .td_social_button a:hover {
		color: @theme_color;
	}

	.td-lifestyle .td_block_template_8 .td-block-title:after,
	.td-lifestyle .td-module-comments a,
	.td-lifestyle.td_category_template_7 .td-category-header .td-page-title:after,
	.td-lifestyle .td-social-style3 .td_social_type:hover .td-sp {
		background-color: @theme_color;
	}

	.td-lifestyle .td-module-comments a:after {
		border-color: @theme_color transparent transparent transparent;
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
