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
		.td-blog-beauty .td-header-style-11 .sf-menu > li > a:hover,
		.td-blog-beauty .td-header-style-11 .sf-menu > .sfHover > a,
		.td-blog-beauty .td-header-style-11 .sf-menu > .current-menu-item > a,
		.td-blog-beauty .td-header-style-11 .sf-menu > .current-menu-ancestor > a,
		.td-blog-beauty .td-header-style-11 .sf-menu > .current-category-ancestor > a,
		.td-blog-beauty .td-module-meta-info .td-post-category,
		.td-blog-beauty .td_block_5 .td-post-category {
   		    color: @theme_color;
   		}

		.td-blog-beauty #td-theme-settings .td-skin-buy a,
		.td-blog-beauty .td-grid-style-5 .td-post-category,
		.td-blog-beauty .td-read-more a:hover,
  		.td-blog-beauty .td-load-more-wrap a:hover {
   			background-color: @theme_color !important;
   		}

   		.td-blog-beauty .td-read-more a:hover,
  		.td-blog-beauty .td-load-more-wrap a:hover {
   			border-color: @theme_color;
   		}


	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	return $td_demo_css_compiler->compile_css();
}
