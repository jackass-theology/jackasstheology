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
        .td-old-fashioned .td-header-style-10 .sf-menu > .current-menu-item > a,
        .td-old-fashioned .td-header-style-10 .sf-menu > .current-menu-ancestor > a,
        .td-old-fashioned .td-header-style-10 .sf-menu > .current-category-ancestor > a,
        .td-old-fashioned .td-header-style-10 .sf-menu > li:hover > a,
        .td-old-fashioned .td-header-style-10 .sf-menu > .sfHover > a,
        .td-old-fashioned .td-post-template-2 .td_block_related_posts .td-related-title .td-cur-simple-item {
            color: @theme_color;
        }
        
        /* @site_background_color */
        .td-old-fashioned .td-container-wrap,
        .td-old-fashioned .post {
            background-color: @site_background_color;
        }
	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
    $td_demo_css_compiler->load_setting('site_background_color');

	return $td_demo_css_compiler->compile_css();
}
