<?php
/**
 * quick LESS compiler for development. Works only on windows for now, uses node + less.js
 * You can turn of this compile from @see td_deploy_mode.php - set TDC_USE_LESS to false
 * V2.0
 */

require_once 'external/td_node_less/td_less_compiler.php';

/**
 * The list of less files that need to be compiled. You can use your own compiler to compile the less files
 */
$td_less_files = array (
	'amp_main' => array (
		'source' => 'less/amp_main.less',
		'destination' => 'css/iframe_main.css'
	),
);


// from td_less_style.css.php
if (isset($_GET['part'])) {
	if (!empty($td_less_files[$_GET['part']])) {
		td_less_compiler::compile_and_import(
			$td_less_files[$_GET['part']]['source'],
			$td_less_files[$_GET['part']]['destination']
		);
	} else {
		echo "ERROR!!!!! NO ?=part registered in td_less_style.css.php with name: " . $_GET['part'];
	}
}



