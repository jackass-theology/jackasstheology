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
		.td-blog-fitness .td-header-style-10 .sf-menu > li > a:hover,
		.td-blog-fitness .td-header-style-10 .sf-menu > .sfHover > a,
		.td-blog-fitness .td-header-style-10 .sf-menu > .current-menu-item > a,
		.td-blog-fitness .td-header-style-10 .sf-menu > .current-menu-ancestor > a,
		.td-blog-fitness .td-header-style-10 .sf-menu > .current-category-ancestor > a,
		.td-blog-fitness .td_block_big_grid_fl_4.td-grid-style-4 .td_module_wrap:hover .td-module-title a,
		.td-blog-fitness .td_block_big_grid_fl_3.td-grid-style-4 .td_module_wrap:hover .td-module-title a,
		.td-blog-fitness .td_module_wrap:hover .td-module-title a {
			color: @theme_color;
		}

		.td-blog-fitness .td-theme-wrap .td_mega_menu_sub_cats .cur-sub-cat {
			background-color: @theme_color;
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