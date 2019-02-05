<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 8/22/2018
 * Time: 8:53 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // exit if accessed directly.
}

function tdc_enqueue_assets() {
    if ( TD_DEPLOY_MODE == 'dev' ) {
        wp_enqueue_style('td-gut-editor', td_global::$get_template_directory_uri . '/td_less_style.css.php?part=gutenberg-editor', false, TD_THEME_VERSION, 'all' );
    } else {
        wp_enqueue_style('td-gut-editor', td_global::$get_template_directory_uri . '/gutenberg-editor.css', false, TD_THEME_VERSION, 'all' );
    }
}

add_action( 'enqueue_block_editor_assets', 'tdc_enqueue_assets' );