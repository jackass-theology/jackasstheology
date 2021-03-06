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
	    .td-restro .td-restro-sub-footer-menu .current-menu-item > a,
        .td-restro .td-restro-sub-footer-menu .current-menu-ancestor > a,
        .td-restro .td-restro-sub-footer-menu .current-category-ancestor > a,
        .td-restro .td-restro-sub-footer-menu li > a:hover {
          color: @theme_color;
        }
	    .td-restro .td_ajax_load_more {
            background-color: @theme_color;
        }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');

	return $td_demo_css_compiler->compile_css();
}
