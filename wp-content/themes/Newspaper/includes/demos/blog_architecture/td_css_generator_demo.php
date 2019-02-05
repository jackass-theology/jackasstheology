<?php

function td_css_demo_gen() {
	$td_demo_custom_css = "
	<style>
		/* @theme_color */
		.td-blog-architecture .td_block_21.td-column-1.td_block_template_6 .td-block-title span:after,
		.td-blog-architecture .td_block_template_6 .td-block-title span:after {
			background: @theme_color;
		}

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');

	return $td_demo_css_compiler->compile_css();
}
