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
		.td-blog-coffee .td-header-style-7 .sf-menu > li > a:hover,
		.td-blog-coffee .td-header-style-7 .sf-menu > .sfHover > a,
		.td-blog-coffee .td-header-style-7 .sf-menu > .current-menu-item > a,
		.td-blog-coffee .td-header-style-7 .sf-menu > .current-menu-ancestor > a,
		.td-blog-coffee .td-header-style-7 .sf-menu > .current-category-ancestor > a {
   		    color: @theme_color;
   		}


	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	return $td_demo_css_compiler->compile_css();
}
