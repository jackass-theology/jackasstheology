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
        .td-church .td-header-style-7 .sf-menu > li.current-menu-item > a,
        .td-church .td-header-style-7 .sf-menu > li > a:hover,
        .td-church .td-donation-btn:hover,
        .td-church .td-post-template-13 .td_block_related_posts .td-related-title .td-cur-simple-item {
            color: @theme_color;
        }
        .td-church .td-donation-btn {
            background-color: @theme_color;
        }
        .td-church .footer-social-wrap .td-icon-font:hover:after,
        .td-church .td-donation-btn {
            border-color: @theme_color;
        }
	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);


	$td_demo_css_compiler->load_setting('theme_color');

	return $td_demo_css_compiler->compile_css();
}
