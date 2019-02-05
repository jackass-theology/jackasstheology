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
		.td-city .td-footer-wrapper .td-block-title > * {
            background-color: @theme_color !important;
        }

        .td-city .td-footer-wrapper .td-block-title > *:before {
            border-color: @theme_color transparent transparent transparent !important;
	    }
	    
	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('submenu_hover_color');

	return $td_demo_css_compiler->compile_css();
}
