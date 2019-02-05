<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 8/22/2018
 * Time: 8:53 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class tdc_guttenberg {

    protected $is_gutenberg_editor_active = false;
    protected $show_on_this_post_type = false;
    protected $post_id = null;
    protected $post_type = null;

    public static function is_gutenberg() {
        return function_exists( 'the_gutenberg_project' );
    }

    public function tdc_enqueue_assets() {
        $this->is_gutenberg_editor_active = true;
        $this->post_id = get_the_ID();
        $this->post_type = get_post_type( $this->post_id );

        $show_on_post_types = array( 'page' );

        if ( $this->post_type and in_array( $this->post_type, $show_on_post_types ) ) {
            $this->show_on_this_post_type = true;
        }

        $tdc_settings = [
            'tdcEditLink' => tdc_util::get_edit_link( $this->post_id ),
        ];

        if ( TDC_DEPLOY_MODE == 'deploy' ) {
            wp_enqueue_script( 'js_files_for_gutenberg_editor', TDC_URL . '/assets/js/js_files_for_gutenberg_editor.min.js', array('jquery'), TD_COMPOSER, true );
            wp_localize_script( 'js_files_for_gutenberg_editor', 'tdcGutenbergSettings', $tdc_settings );
        } else {
            wp_enqueue_script( 'tdcGutenberg', TDC_URL . '/assets/js/tdcGutenberg.js', array('jquery'), TD_COMPOSER, true );
            wp_localize_script( 'tdcGutenberg', 'tdcGutenbergSettings', $tdc_settings );
        }
    }

    public function tdc_add_admin_switch_button() {
        if ( ! $this->is_gutenberg_editor_active or ! $this->show_on_this_post_type ) {
            return;
        }

        echo '
        <script id="tdc-gutenberg-button-switch" type="text/html">
            <div class="tdc-panel-button">
                <div class="tdc-panel-icon"></div>
                <div class="tdc-panel-link">
                    <a id="tdc-switch-button" href="' . tdc_util::get_edit_link( $this->post_id ) . '">TagDiv Composer</a>
                </div>
            </div>
        </script>';
    }

    public function __construct() {
        add_action( 'enqueue_block_editor_assets', [ $this, 'tdc_enqueue_assets' ] );
        add_action( 'admin_footer', [ $this, 'tdc_add_admin_switch_button' ] );
    }

}