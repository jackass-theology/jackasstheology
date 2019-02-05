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
		.td-craft-ideas .td-post-category,
		.td-craft-ideas .td_block_template_6 .td-related-title .td-cur-simple-item,
		.td-craft-ideas .td-header-style-10 .sf-menu > .current-menu-item > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > .current-menu-ancestor > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > .current-category-ancestor > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > li:hover > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > .sfHover > a {
   		    color: @theme_color;
   		}

   		/* @submenu_hover_color */
		.td-craft-ideas .td-header-style-10 .sf-menu > .current-menu-item > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > .current-menu-ancestor > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > .current-category-ancestor > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > li:hover > a,
	    .td-craft-ideas .td-header-style-10 .sf-menu > .sfHover > a,
	    .td-craft-ideas .td_module_mega_menu .td-post-category {
	    	color: @submenu_hover_color;
	    }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	return $td_demo_css_compiler->compile_css();
}
