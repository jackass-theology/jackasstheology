<?php


/**
 * Class tdb_state_content - hold the content wp-query. Please note that we also keep the content wp_query in the various other states
 * but this is used for template files and top black bar.
 * Avoid using this in shortcodes! Use the appropriate state global (tdb_state_single)
 */
class tdb_state_content {

    /**
     * @var WP_Query
     */
    private static $wp_query;


    /**
     * @param $new_wp_query WP_Query
     */
    static function set_wp_query($new_wp_query) {
        self::$wp_query = $new_wp_query;
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
}