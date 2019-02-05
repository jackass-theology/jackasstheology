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
	    .td-sound-radar .td_block_template_6 .td-block-title span:before,
        .td-sound-radar .td_block_template_6 .td-block-title span:after,
        .td-sound-radar .td-page-title:before,
        .td-sound-radar .td-page-title:after {
          color: @theme_color;
        }
	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);


	$td_demo_css_compiler->load_setting('theme_color');

	return $td_demo_css_compiler->compile_css();
}
