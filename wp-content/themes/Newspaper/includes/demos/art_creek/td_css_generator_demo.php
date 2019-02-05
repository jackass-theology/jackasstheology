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
	    .td-art-creek .td_module_wrap .td-post-category,
	    .td-art-creek .td_module_mega_menu .td-post-category,
	    .td-art-creek .td_module_related_posts .td-post-category,
	    .td-art-creek .td-art-creek-dark-row .td_module_wrap:hover .td-module-title a,
        .td-art-creek.single_template_13 .td-post-header .entry-category a {
            color: @theme_color;
        }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');

	return $td_demo_css_compiler->compile_css();
}
