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
		.td-retro .td-post-category,
		.td-retro .td-footer-instagram-container .td-instagram-user a,
		.td-retro .td_block_template_2 .td-related-title .td-cur-simple-item,
		.td-retro .td-header-style-11 .sf-menu > .current-menu-item > a,
	    .td-retro .td-header-style-11 .sf-menu > .current-menu-ancestor > a,
	    .td-retro .td-header-style-11 .sf-menu > .current-category-ancestor > a,
	    .td-retro .td-header-style-11 .sf-menu > li:hover > a,
	    .td-retro .td-header-style-11 .sf-menu > .sfHover > a {
   		    color: @theme_color;
   		}

   		.td-retro .page-nav .current {
   			border-color: @theme_color;
   		}

   		/* @submenu_hover_color */
		.td-retro .td-header-style-11 .sf-menu > .current-menu-item > a,
	    .td-retro .td-header-style-11 .sf-menu > .current-menu-ancestor > a,
	    .td-retro .td-header-style-11 .sf-menu > .current-category-ancestor > a,
	    .td-retro .td-header-style-11 .sf-menu > li:hover > a,
	    .td-retro .td-header-style-11 .sf-menu > .sfHover > a {
	    	color: @submenu_hover_color;
	    }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	return $td_demo_css_compiler->compile_css();
}
