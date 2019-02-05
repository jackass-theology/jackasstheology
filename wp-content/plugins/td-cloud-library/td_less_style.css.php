<?php
/**
 * quick LESS compiler for development. Works only on windows for now, uses node + less.js
 * You can turn of this compile from @see td_deploy_mode.php - set TDC_USE_LESS to false
 * V2.0
 */

//
require_once 'includes/external/td_node_less/td_less_compiler.php';


/**
* The list of less files that need to be compiled. You can use your own compiler to compile the less files
 */
$td_less_files = array (

	// less file used in the iframe when the live editor is on
	'wp_admin_main' => array (
		'source' => 'assets/less_wp_admin/wp_admin_main.less',
		'destination' => 'assets/css/tdb_wp_admin.css'
	),

    'less_front' => array (
		'source' => 'assets/less_front/main.less',
		'destination' => 'assets/css/tdb_less_front.css'
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



