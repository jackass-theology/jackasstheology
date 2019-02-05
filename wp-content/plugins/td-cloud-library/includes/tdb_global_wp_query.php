<?php


class tdb_global_wp_query {


    /**
     * @var WP_Query
     */
    private static $wp_query_content;

    /**
     * @var WP_Query
     */
    private static $wp_query_template;



    private static $is_content_context = true;

    /**
     * @param $wp_query WP_Query
     */
    static function set_wp_query_content($wp_query) {
        self::$wp_query_content = $wp_query;
    }


    /**
     * @param $wp_query WP_Query
     */
    static function set_wp_query_template($wp_query) {
        self::$wp_query_template = $wp_query;
    }


    /**
     * load the ORIGINAL content context in wp. Please note that we can't rewind this one and it will always return the original wp_query used to create the single/archive etc page
     * JUST THE TIP: remember to rewind the posts if you want to use the_post if needed
     *
     * POSSIBLE PROBLEM: when you rewind the posts for a page 2... it's possible that the variables will be reinitialized with page 1.
     * Usually the rewind it's done in the footer... and the footer is the same for all the pages from pagination
     */
    static function wp_use_content_context() {
        global $wp_query;
        $wp_query = self::$wp_query_content;
        self::$is_content_context = true;
    }




    static function wp_use_template_context() {
        global $wp_query;
        $wp_query = self::$wp_query_template;
        self::$is_content_context = false;
    }


    static function set_is_content_context($is_content) {
        self::$is_content_context = $is_content;
    }


    /**
     * @return WP_Query
     */
    static function get_wp_query_content() {
        return self::$wp_query_content;
    }

    /**
     * @return WP_Query
     */
    static function get_wp_query_template() {
        return self::$wp_query_template;
    }



    static function wp_is_content_context() {
        return self::$is_content_context;
    }



}
