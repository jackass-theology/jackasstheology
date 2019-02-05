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
		.td-week .td-header-style-10 .sf-menu > li > a:hover,
		.td-week .td-header-style-10 .sf-menu > .sfHover > a,
		.td-week .td-header-style-10 .sf-menu > .current-menu-item > a,
		.td-week .td-header-style-10 .sf-menu > .current-menu-ancestor > a,
		.td-week .td-header-style-10 .sf-menu > .current-category-ancestor > a,
		.td-week .td_module_1 .td-module-image .td-post-category,
		.td-week .td_module_2 .td-module-image .td-post-category,
		.td-week .td_module_8 .td-post-category,
		.td-week .td_module_18 .td-post-category {
           color: @theme_color;
        }
    }
		
		
		
	    
	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	return $td_demo_css_compiler->compile_css();
}
