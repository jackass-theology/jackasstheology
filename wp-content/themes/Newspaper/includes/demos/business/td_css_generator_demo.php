<?php

function td_css_demo_gen() {
	$td_demo_custom_css = "
	<style>
		/* @theme_color */
		.td-business .td_block_weather .td-weather-city,
		.td-business .td_module_mx1 .td-module-meta-info .td-post-category,
		.td-business .td-post-views *,
		.td-business .td-post-comments a,
		.td-business.home .td-business-home-row .td_block_15 .td_module_mx4 .td-module-image .td-post-category,
		.td-business.home .td-business-home-row .td_block_15 .td_module_mx4 .entry-title:hover a,
		.td-business.home .td-category-header .td-pulldown-category-filter-link:hover {
			color: @theme_color;
		}

		.td-business .td_module_19 .td-read-more a,
		.td-business .td-category-header .td-pulldown-filter-display-option,
		.td-business .td-category-header .td-pulldown-filter-list,
		.td-business.home .td-pb-article-list .td_module_1 .td-post-category,
		.td-business .td-header-style-1 .header-search-wrap .td-drop-down-search .btn,
		.td-business .td-category a {
			background-color: @theme_color;
		}

		/* @text_header_color */
		.td-business.home .td-business-home-row .td-business-demo-js-date-today {
			color: @text_header_color;
		}

		/* @footer_bottom_hover_color */
		.td-business .td-footer-template-3 .footer-text-wrap .footer-email-wrap a,
		.td-business .td-footer-template-3 .td_module_wrap:hover .entry-title a,
		.td-business .td-footer-template-3 .widget a:hover {
			color: @footer_bottom_hover_color;
		}

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('text_header_color');
	$td_demo_css_compiler->load_setting('footer_bottom_hover_color');

	return $td_demo_css_compiler->compile_css();
}
