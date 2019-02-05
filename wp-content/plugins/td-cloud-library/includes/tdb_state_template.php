<?php


/**
 * Class tdb_state_template hold the template state (the template wp_query)
 * - used to save the template state (comunicate it between different hooks and the templates)
 * - also used in the top black bar
 */
class tdb_state_template {

    /**
     * @var WP_Query
     */
    private static $wp_query;
    private static $tdb_template_type;
    private static $tdb_template_loop_offset = 0;

    /**
     * save the initial template state.
     * @param $new_wp_query WP_Query
     */
    static function set_wp_query($new_wp_query) {
        self::$wp_query = $new_wp_query;

        self::$tdb_template_type = get_post_meta(self::$wp_query->post->ID, 'tdb_template_type', true);
    }


    /**
     * @return WP_Query
     */
    static function get_wp_query() {
         return self::$wp_query;
    }


    /**
     * @return bool
     */
    static function has_wp_query() {
        if (isset(self::$wp_query)) {
            return true;
        }

        return false;
    }


    /**
     * @return string - the template type
     */
    static function get_template_type() {

        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
            return tdb_util::get_get_val('tdbTemplateType');
        }

        return self::$tdb_template_type;
    }


    /**
     * @param $offset
     */
    static function set_template_loop_offset($offset) {
        self::$tdb_template_loop_offset = $offset;
    }

    /**
     * @return int
     */
    static function get_template_loop_offset() {
        return self::$tdb_template_loop_offset;
    }
}