<?php


class td_page_generator {

    /**
     * generate json-ld breadcrumbs
     */
    static function get_breadcrumbs_json_ld() {
        global $post;
        $breadcrumbs_array = array();

        //posts and custom posts
        if (is_single()) {

            // return if we are on a single post template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            $breadcrumbs_array = self::single_breadcrumbs_array(get_the_title($post->ID));
        }

        //author page
        if (is_author()) {

            // return if we are on a author page template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            $part_cur_auth_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            $breadcrumbs_array = self::author_breadcrumbs_array($part_cur_auth_obj, true);
        }

        //category page
        if (is_category()) {

            // return if we are on a category page template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            $primary_category_obj = td_global::$current_category_obj;
            $breadcrumbs_array = self::category_breadcrumbs_array($primary_category_obj);
        }

        //taxonomy
        if (is_tax()) {
            $current_term_obj = get_queried_object();
            $breadcrumbs_array = self::taxonomy_breadcrumbs_array($current_term_obj);
        }

        //tag
        if (is_tag()) {

            // return if we are on a tag page template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            $current_tag_name = single_tag_title( '', false );
            $breadcrumbs_array = self::tag_breadcrumbs_array($current_tag_name, true);
        }

        //date archive
        if (is_date()) {

            // return if we are on a date archive page template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            $breadcrumbs_array = self::archive_breadcrumbs_array();
        }

        //home
        if (is_home()) {
            $breadcrumbs_array = self::home_breadcrumbs_array(true);
        }

        //page
        if (!is_front_page() && is_page()) {
            $breadcrumbs_array = self::page_breadcrumbs_array(get_the_title());
        }

        //attachment
        if (is_attachment()) {

            // return if we are on a attachment page template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            if (!empty($post->post_parent) and !empty($post->post_title)) {
                $breadcrumbs_array = self::attachment_breadcrumbs_array($post->post_parent, $post->post_title);
            }
        }

        //search
        if (is_search()) {

            // return if we are on a search page template that uses a cloud template, we create json-ld script in the breadcrumbs shortcode
            if ( self::is_tdb_cloud_template() ) {
                return '';
            }

            $breadcrumbs_array = self::search_breadcrumbs_array();
        }



        //create json-ld script
        if (isset($breadcrumbs_array[0]['url'])) {
            $buffy = '';
            $breadcrumbs_count = count($breadcrumbs_array);

            //script start + item 1 + item 2
            $buffy .= PHP_EOL . '
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@type": "WebSite",
                    "@id": "' . esc_url(get_home_url()) . '/",
                    "name": "' . __td('Home', TD_THEME_NAME) . '"
                }
            },
            {
                "@type": "ListItem",
                "position": 2,
                    "item": {
                    "@type": "WebPage",
                    "@id": "' . $breadcrumbs_array[0]['url'] . '",
                    "name": "' . $breadcrumbs_array[0]['display_name'] . '"
                }
            }';

            if ( isset( $breadcrumbs_array[1]['url'] ) ) {

            //item 3
            $buffy .=  '
            ,{
                "@type": "ListItem",
                "position": 3,
                    "item": {
                    "@type": "WebPage",
                    "@id": "' . $breadcrumbs_array[1]['url'] . '",
                    "name": "' . $breadcrumbs_array[1]['display_name'] . '"                                
                }
            }';

            }

            if ( isset( $breadcrumbs_array[2]['url'] ) ) {

            //item 4
            $buffy .=  '
            ,{
                "@type": "ListItem",
                "position": 4,
                    "item": {
                    "@type": "WebPage",
                    "@id": "' . $breadcrumbs_array[2]['url'] . '",
                    "name": "' . $breadcrumbs_array[2]['display_name'] . '"                                
                }
            }';

            }

            //close script
            $buffy .= '    
        ]
    }
</script>' . PHP_EOL;

            //$buffy = preg_replace('/\s+/', ' ', $buffy);
            echo $buffy;
        }
    }

    /**
     * detect cloud templates
     * @return bool
     */
    private static function is_tdb_cloud_template() {

        /*
         * check first for the template state class,
         * this is set on td composer's 'tdc_init' hook so we need to make sure we have the td composer plugin active
         */
        if ( class_exists( 'tdb_state_template', false ) ) {
            // if the tdb templates cpt is registered and we have a cloud template set
            if ( td_global::is_tdb_registered() && tdb_state_template::has_wp_query() ) {
                return true;
            }
        }

        return false;
    }


    /**
     * get canonical url
     * @param null $post
     * @return bool|false|string
     */
    private static function td_get_canonical_url($post = null) {
        if (function_exists('wp_get_canonical_url')) {
            //@since 4.6.0
            return wp_get_canonical_url($post);
        }

        $post = get_post( $post );

        if ( ! $post ) {
            return false;
        }

        if ( 'publish' !== $post->post_status ) {
            return false;
        }

        $canonical_url = get_permalink( $post );

        // If a canonical is being generated for the current page, make sure it has pagination if needed.
        if ( $post->ID === get_queried_object_id() ) {
            $page = get_query_var( 'page', 0 );
            if ( $page >= 2 ) {
                if ( '' == get_option( 'permalink_structure' ) ) {
                    $canonical_url = add_query_arg( 'page', $page, $canonical_url );
                } else {
                    $canonical_url = trailingslashit( $canonical_url ) . user_trailingslashit( $page, 'single_paged' );
                }
            }

            $cpage = get_query_var( 'cpage', 0 );
            if ( $cpage ) {
                $canonical_url = get_comments_pagenum_link( $cpage );
            }
        }

        return $canonical_url;
    }



    /**
     * generate single post breadcrumbs array
     * @param $post_title
     * @return array|string
     */
    private static function single_breadcrumbs_array($post_title) {
        /**
         * check to see if we are on a custom post type page. If that's the case we will load the breadcrumbs
         * via @see td_page_generator::get_custom_post_type_breadcrumbs() - in this file
         */
        global $post;
        //wordpress default post types
        $wp_post_types = array('post', 'page', 'attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset');

        if (isset($post) && !in_array($post->post_type, $wp_post_types)) {
            //we have a custom post type
            return self::custom_post_type_breadcrumbs_array();
        }


        // get the breadcrumb for single posts - ! if we are on a custom post type, we don't get here !
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        $category_1_name = '';
        $category_1_url = '';
        $category_2_name = '';
        $category_2_url = '';

        $primary_category_id = td_global::get_primary_category_id();
        $primary_category_obj = get_category($primary_category_id);

        //print_r($primary_category_obj);
        if (!empty($primary_category_obj)) {
            if (!empty($primary_category_obj->name)) {
                $category_1_name = $primary_category_obj->name;
            } else {
                $category_1_name = '';
            }

            if (!empty($primary_category_obj->cat_ID)) {
                $category_1_url = get_category_link($primary_category_obj->cat_ID);
            }

            if (!empty($primary_category_obj->parent) and $primary_category_obj->parent != 0) {
                $parent_category_obj = get_category($primary_category_obj->parent);
                if (!empty($parent_category_obj)) {
                    $category_2_name = $parent_category_obj->name;
                    $category_2_url = get_category_link($parent_category_obj->cat_ID);
                }
            }
        }

        $breadcrumbs_array = array();
        if (!empty($category_1_name)) {

            //parent category (only if we have one and if the theme is set to show it)
            if (!empty($category_2_name) and td_util::get_option('tds_breadcrumbs_show_parent') != 'hide' ) {
                $breadcrumbs_array [] = array (
                    'title_attribute' => __td('View all posts in', TD_THEME_NAME) . ' ' . htmlspecialchars($category_2_name),
                    'url' => $category_2_url,
                    'display_name' => $category_2_name
                );


            }

            //child category
            $breadcrumbs_array [] = array (
                'title_attribute' => __td('View all posts in', TD_THEME_NAME) . ' ' . htmlspecialchars($category_1_name),
                'url' => $category_1_url,
                'display_name' => $category_1_name
            );

            //article title (only if the theme is set to show it)
            if (td_util::get_option('tds_breadcrumbs_show_article') != 'hide') {
                //child category
                $breadcrumbs_array [] = array (
                    'title_attribute' => $post_title,
                    'url' => self::td_get_canonical_url(),
                    'display_name' => td_util::excerpt($post_title, 13)
                );
            }
        }

        return $breadcrumbs_array;
    }



    /**
     * generate custom post type breadcrumbs array
     * @return array|string
     */
    private static function custom_post_type_breadcrumbs_array() {
        global $post;

        // use the global breadcrumb setting to show or hide them
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        // woocommerce - skip, it has it's own breadcrumbs
        if ($post->post_type == 'product') {
            return '';
        }

        $breadcrumbs_array = array();

        // get the taxonomy that was set for breadcrumbs
        $breadcrumbs_taxonomy = td_util::get_ctp_option($post->post_type, 'tds_breadcrumbs_taxonomy');

        // get terms (alphabetically)
        $terms = wp_get_post_terms($post->ID, $breadcrumbs_taxonomy);

        if (!empty($terms)) {

            // add the first term by default
            // this default will be overwritten ! - if in foreach we find a term that has a parent
            if (isset($terms[0])) {
                $first_term_url = get_term_link($terms[0], $breadcrumbs_taxonomy);
                if (!is_wp_error($first_term_url)) {
                    $breadcrumbs_array[0] = array(
                        'title_attribute' => '',
                        'url' => $first_term_url,
                        'display_name' => $terms[0]->name
                    );
                }
            }

            // start the search for terms that have parents BUT only if the global settings allow us
            if (td_util::get_option('tds_breadcrumbs_show_parent') != 'hide') {
                foreach ($terms as $term) {
                    // check if the term has a parent
                    if ($term->parent != 0) {
                        $parent_term_in_category_spot = get_term($term->parent, $breadcrumbs_taxonomy);

                        // add the parent
                        $parent_url = get_term_link($parent_term_in_category_spot, $breadcrumbs_taxonomy);
                        if (!is_wp_error($parent_url)) {
                            $breadcrumbs_array[0] = array(
                                'title_attribute' => '',
                                'url' => $parent_url,
                                'display_name' => $parent_term_in_category_spot->name
                            );
                        }

                        // add the child
                        $child_url = get_term_link($term, $breadcrumbs_taxonomy);
                        if (!is_wp_error($child_url)) {
                            $breadcrumbs_array [] = array(
                                'title_attribute' => '',
                                'url' => $child_url,
                                'display_name' => $term->name
                            );
                        }
                        break; //we found a parent > child
                    }
                } // end foreach
            }

        }


        //article title
        if (td_util::get_option('tds_breadcrumbs_show_article') != 'hide') {
            //child category
            $breadcrumbs_array [] = array (
                'title_attribute' => $post->post_title,
                'url' => self::td_get_canonical_url(),
                'display_name' => td_util::excerpt($post->post_title, 13)
            );
        }

        return $breadcrumbs_array;
    }


    /**
     * generate author breadcrumbs array
     * @param $part_cur_auth_obj
     * @param bool $skip_extra
     * @return array|string
     */
    private static function author_breadcrumbs_array($part_cur_auth_obj, $skip_extra = false) {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        if ($skip_extra === false) {
            //extra crumb
            $breadcrumbs_array [] = array (
                'title_attribute' => '',
                'url' => '',
                'display_name' => __td('Authors', TD_THEME_NAME)
            );
        }

        $breadcrumbs_array [] = array (
            'title_attribute' => '',
            'url' => get_author_posts_url($part_cur_auth_obj->ID),
            'display_name' => __td('Posts by', TD_THEME_NAME) . ' ' . $part_cur_auth_obj->display_name
        );

        return $breadcrumbs_array;
    }



    /**
     * generate category breadcrumbs array
     * @param $primary_category_obj
     * @return array|string
     */
    private static function category_breadcrumbs_array($primary_category_obj) {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        $category_1_name = '';
        $category_1_url = '';
        $category_2_name = '';
        $category_2_url = '';

        $breadcrumbs_array = array();

        //$primary_category_id = td_global::get_primary_category_id();
        //$primary_category_obj = get_category($primary_category_id);


        if (!empty($primary_category_obj)) {
            if (!empty($primary_category_obj->name)) {
                $category_1_name = $primary_category_obj->name;
                $category_1_url = get_category_link($primary_category_obj->term_id);
            } else {
                $category_1_name = '';
            }

            if (!empty($primary_category_obj->cat_ID)) {
                $category_1_url = get_category_link($primary_category_obj->cat_ID);
            }

            if (!empty($primary_category_obj->parent) and $primary_category_obj->parent != 0) {
                $parent_category_obj = get_category($primary_category_obj->parent);
                if (!empty($parent_category_obj)) {
                    $category_2_name = $parent_category_obj->name;
                    $category_2_url = get_category_link($parent_category_obj->cat_ID);
                }
            }
        }

        //print_r($primary_category_obj);

        if (!empty($category_1_name)) {
            //parent category
            if (!empty($category_2_name) and td_util::get_option('tds_breadcrumbs_show_parent') != 'hide' ) {
                $breadcrumbs_array [] = array (
                    'title_attribute' => __td('View all posts in', TD_THEME_NAME) . ' ' . htmlspecialchars($category_2_name),
                    'url' => $category_2_url,
                    'display_name' => $category_2_name
                );
            }



            //child category
            $breadcrumbs_array [] = array (
                'title_attribute' => '',
                'url' => $category_1_url,
                'display_name' => $category_1_name
            );

            //pagination
            $td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            if ($td_paged > 1) {
                $breadcrumbs_array [] = array (
                    'title_attribute' => '',
                    'url' => '',
                    'display_name' =>  __td('Page', TD_THEME_NAME) . ' ' . $td_paged
                );
            }
        }

        return $breadcrumbs_array;
    }



    /**
     * generate taxonomy breadcrumbs array
     * @return array
     */
    private static function taxonomy_breadcrumbs_array($current_term_obj) {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        // check to see if the taxonomy has a parent and add it (only if enabled via the theme panel)
        if (!empty($current_term_obj->parent) and td_util::get_option('tds_breadcrumbs_show_parent') != 'hide') {
            $current_term_parent_obj = get_term($current_term_obj->parent, $current_term_obj->taxonomy);
            $current_term_parent_url = get_term_link($current_term_parent_obj, $current_term_obj->taxonomy);
            if (!is_wp_error($current_term_parent_url)) {
                $breadcrumbs_array[] = array(
                    'title_attribute' => '',
                    'url' => $current_term_parent_url,
                    'display_name' => $current_term_parent_obj->name
                );
            }
        }

        // add the current taxonomy
        $breadcrumbs_array[] = array(
            'title_attribute' => '',
            'url' => get_term_link($current_term_obj, $current_term_obj->taxonomy),
            'display_name' => $current_term_obj->name
        );

        return $breadcrumbs_array;
    }



    /**
     * generate tag breadcrumbs array
     * @param $current_tag_name
     * @return array|string
     */
    private static function tag_breadcrumbs_array($current_tag_name, $skip_extra = false) {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        if ($skip_extra === false) {
            $breadcrumbs_array [] = array (
                'title_attribute' => '',
                'url' => '',
                'display_name' =>  __td('Tags', TD_THEME_NAME)
            );

        }

        $breadcrumbs_array [] = array (
            'title_attribute' => '',
            'url' => get_tag_link(get_queried_object()->term_id),
            'display_name' =>  ucfirst($current_tag_name)
        );

        return $breadcrumbs_array;
    }



    /**
     * generate archive breadcrumbs array
     * @return array|string
     */
    private static function archive_breadcrumbs_array() {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        $cur_archive_year = get_the_date('Y');
        $cur_archive_month = get_the_date('n');
        $cur_archive_day = get_the_date('j');

        $breadcrumbs_array [] = array (
            'title_attribute' => '',
            'url' => get_year_link($cur_archive_year),
            'display_name' =>  get_the_date('Y')
        );

        if (is_month() or is_day()) {
            $breadcrumbs_array [] = array (
                'title_attribute' => '',
                'url' => get_month_link($cur_archive_year, $cur_archive_month),
                'display_name' =>  get_the_date('F')
            );
        }

        if (is_day()) {
            $breadcrumbs_array [] = array (
                'title_attribute' => '',
                'url' => get_day_link($cur_archive_year, $cur_archive_month, $cur_archive_day),
                'display_name' =>  get_the_date('j')
            );
        }

        return $breadcrumbs_array;
    }



    /**
     * generate home breadcrumbs array
     * @return array|string
     */
    private static function home_breadcrumbs_array($skip_extra = false) {

        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        $breadcrumbs_array = array();

        if ($skip_extra === false) {
            if (td_util::get_home_url()) {
                $breadcrumbs_array [] = array (
                    'title_attribute' => __td('Blog', TD_THEME_NAME),
                    'url' => td_util::get_home_url(),
                    'display_name' =>  __td('Blog', TD_THEME_NAME)
                );
            } else {
                $breadcrumbs_array [] = array (
                    'title_attribute' => '',
                    'url' =>'',
                    'display_name' =>  __td('Blog', TD_THEME_NAME)
                );
            }
        }

        //pagination
        $td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ($td_paged > 1) {
            global $wp;
            $breadcrumbs_array [] = array (
                'title_attribute' => '',
                'url' => home_url($wp->request),
                'display_name' =>  __td('Page', TD_THEME_NAME) . ' ' . $td_paged
            );
        }

        return $breadcrumbs_array;
    }



    /**
     * generate page breadcrumbs array
     * @param $page_title
     * @return array|string
     */
    private static function page_breadcrumbs_array($page_title) {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }


        global $post;
        if( is_page() ) {
            $parents = get_post_ancestors ($post->ID);

            if (!empty($parents)) {
                $parents = array_reverse($parents);
                foreach ($parents as $parent_id) {
                    $breadcrumbs_array [] = array (
                        'title_attribute' => get_the_title($parent_id),
                        'url' => esc_url(get_permalink($parent_id)),
                        'display_name' =>  get_the_title($parent_id)
                    );
                }
            }
        }

        $breadcrumbs_array [] = array (
            'title_attribute' => '',
            'url' => get_permalink($post->ID),
            'display_name' =>  $page_title
        );

        return $breadcrumbs_array;
    }



    /**
     * generate attachment breadcrumbs array
     * @param $parent_id
     * @param $attachment_title
     * @return array|string
     */
    private static function attachment_breadcrumbs_array($parent_id, $attachment_title) {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        //show the attachment parent
        if ($parent_id != '') {
            $breadcrumbs_array [] = array (
                'title_attribute' => get_the_title($parent_id),
                'url' => esc_url(get_permalink($parent_id)),
                'display_name' =>  get_the_title($parent_id)
            );
        }

        $breadcrumbs_array [] = array (
            'title_attribute' => '',
            'url' => '',
            'display_name' =>  $attachment_title
        );

        return $breadcrumbs_array;
    }



    /**
     * generate search breadcrumbs array
     * @return array|string
     */
    private static function search_breadcrumbs_array() {
        if (td_util::get_option('tds_breadcrumbs_show') == 'hide') {
            return '';
        }

        $breadcrumbs_array [] = array (
            'title_attribute' => '',
            'url' => '',
            'display_name' =>  __td('Search', TD_THEME_NAME)
        );

        return $breadcrumbs_array;
    }


    /**
     * get the single breadcrumbs
     * @param $post_title
     * @return string
     */
    static function get_single_breadcrumbs($post_title) {
        //breadcrumbs array
        $breadcrumbs_array = self::single_breadcrumbs_array($post_title);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get author breadcrumbs
     * @param $part_cur_auth_obj
     * @return string
     */
    static function get_author_breadcrumbs($part_cur_auth_obj) {
        //breadcrumbs array
        $breadcrumbs_array = self::author_breadcrumbs_array($part_cur_auth_obj);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get the category breadcrumbs
     * @param $primary_category_obj
     * @return string
     */
    static function get_category_breadcrumbs($primary_category_obj) {
        //breadcrumbs array
        $breadcrumbs_array = self::category_breadcrumbs_array($primary_category_obj);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get the breadcrumbs for the taxonomy page. It will also add 1 parent taxonomy if it's available
     * @param $current_term_obj
     * @return string
     */
    static function get_taxonomy_breadcrumbs($current_term_obj) {
        //breadcrumbs array
        $breadcrumbs_array = self::taxonomy_breadcrumbs_array($current_term_obj);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get breadcrumbs for tag page
     * @param $current_tag_name
     * @return string
     */
    static function get_tag_breadcrumbs($current_tag_name) {
        //breadcrumbs array
        $breadcrumbs_array = self::tag_breadcrumbs_array($current_tag_name);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get archive breadcrumbs
     * @return string
     */
    static function get_archive_breadcrumbs() {
        //breadcrumbs array
        $breadcrumbs_array = self::archive_breadcrumbs_array();

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get home breadcrumbs
     * @return string
     */
    static function get_home_breadcrumbs() {
        //breadcrumbs array
        $breadcrumbs_array = self::home_breadcrumbs_array();

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get page breadcrumbs
     * @param $page_title
     * @return string
     */
    static function get_page_breadcrumbs($page_title) {
        //breadcrumbs array
        $breadcrumbs_array = self::page_breadcrumbs_array($page_title);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get attachment breadcrumbs
     * @param string $parent_id
     * @param string $attachment_title
     * @return string
     */
    static function get_attachment_breadcrumbs($parent_id = '', $attachment_title = '') {
        //breadcrumbs array
        $breadcrumbs_array = self::attachment_breadcrumbs_array($parent_id, $attachment_title);

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }



    /**
     * get search breadcrumbs
     * @return string
     */
    static function get_search_breadcrumbs() {
        //breadcrumbs array
        $breadcrumbs_array = self::search_breadcrumbs_array();

        //breadcrumbs html
        return self::get_breadcrumbs($breadcrumbs_array);
    }




    /**
     * WARNING: this function also runs in the page-pagebuilder-latest.php in a FAKE LOOP - this means that wordpress functions
     * like is_category DO NOT WORK AS EXPECTED when you use for example a category filter for the loop, is_category returns true
     */
    static function get_pagination() {
        global $wp_query;

        if ( td_global::$current_template == '404' ) {
            return;
        }


        // if we have infinite pagination, we will render it there
        if ( self::render_infinite_pagination() === true ) {
            return;
        }


        /**
         * use normal pagination
         */
        $pagenavi_options = self::pagenavi_init();

        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;



        // hack for category pages - pagination
        // we also have to check for page-pagebuilder-latest.php template because we are running there in a FAKE loop and if the category
        // filter is active for that loop, WordPress believes that we are on a category
        if(!is_admin() and td_global::$current_template != 'page-homepage-loop' and is_category()) {
	        $posts_shown_in_loop = td_api_category_top_posts_style::_helper_get_posts_shown_in_the_loop();

            $numposts = $wp_query->found_posts - $posts_shown_in_loop; // fix the pagination, we have x less posts because the rest are in the top posts loop
            $max_page = ceil($numposts / $posts_per_page);
        }


        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }

        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
        if($start_page <= 0) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        $larger_start_page_start = (self::td_round_number($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = self::td_round_number($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = self::td_round_number($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = self::td_round_number($end_page, 10) + ($larger_per_page);
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }

        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);

            echo '<div class="page-nav td-pb-padding-side">';
			
			previous_posts_link($pagenavi_options['prev_text']);
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">'.$first_page_text.'</a>';
                if(!empty($pagenavi_options['dotleft_text']) && ($start_page > 2)) {
                    echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }
//            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
//                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
//                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
//                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
//                }
//	            echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
//            }
            
            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            
//            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
//	            echo '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';
//                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
//                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
//                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
//                }
//            }
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text']) && ($end_page + 1 < $max_page)) {
                    echo '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';
                }

                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$last_page_text.'</a>';
            }
			next_posts_link($pagenavi_options['next_text'], $max_page);
			if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }

            echo '<div class="clearfix"></div>';
            echo '</div>';

        }


    }


    /**
     * renders the infinite pagination and also the load more. It returns true if it changes the pagination so that the
     * calling function knows to not render the 'normal' pagination
     * @return bool - override the pagination or not
     */
    static private function render_infinite_pagination() {
        global
            $wp_query,
            $loop_module_id,            // it's set by the template (category.php)
            $loop_sidebar_position;     // it's set by the template  -- || --

        /**
         * infinite loading pagination ONLY FOR CATEGORIES FOR NOW (19 aug 2015)
         */
        if(!is_admin() and td_global::$current_template != 'page-homepage-loop' and is_category() and !empty($wp_query)) {

            // the filter_by parameter is used on categories to filter them. The theme uses normal pagination when the filter is used for now.
            // if we want to use the filter + loop ajax, we have to send the atts for each filter. It can be done, but not now (19 aug 2015)
            if (isset($_GET['filter_by'])) {
                return false;
            }

            $pagination_style = '';

            // read the global settings
            $global_category_pagination_style = td_util::get_option('tds_category_pagination_style');
            if (!empty($global_category_pagination_style)) {
                $pagination_style = $global_category_pagination_style;
            }

            // read the per category settings
            $category_pagination_style = td_util::get_category_option(td_global::$current_category_obj->cat_ID, 'tdc_category_pagination_style');
            if (!empty($category_pagination_style)) {
                // overwrite the global pagination. For normal pagination we need to clean up the variable
                if ($category_pagination_style == 'normal') {
                    $pagination_style = '';
                } else {
                    $pagination_style = $category_pagination_style;
                }
            }

            // check to see if we need infinite loading pagination
            if ($pagination_style != '') {

                if ($wp_query->query_vars['paged'] >= $wp_query->max_num_pages) {
                    return true; // do not show any pagination because we do not have more pages
                }

                $ajax_pagination_infinite_stop = 0;
                if ($pagination_style == 'infinite_load_more') {
                    $ajax_pagination_infinite_stop = 3; // after how many pages do we show a load more button. set to 0 to use only load more
                }



                ob_start();
                ?>
                <script>
                    jQuery(window).ready(function() {
                        tdAjaxLoop.loopState.sidebarPosition = '<?php echo $loop_sidebar_position ?>';
                        tdAjaxLoop.loopState.moduleId = '<?php echo $loop_module_id ?>';
                        tdAjaxLoop.loopState.currentPage = 1;

	                    /*
	                        The max_num_pages and the currentPage are used to show the loading box element on page (and also a new request), and according to wp docs
	                        the max_num_pages = $found_posts / $posts_per_page, so we must consider the offset query var when $posts_per_page
	                        is different from -1 (-1 means to show all posts)

	                        !Important. For the moment, it's used only for categories.
	                     */

                        if ( -1 === <?php echo $wp_query->max_num_pages ?>) {
		                    tdAjaxLoop.loopState.max_num_pages = <?php echo $wp_query->max_num_pages ?>;
	                    } else {
		                    tdAjaxLoop.loopState.max_num_pages = <?php echo ceil(($wp_query->found_posts - $wp_query->query_vars['offset']) / $wp_query->query_vars['posts_per_page']); ?>;
	                    }

                        tdAjaxLoop.loopState.atts = {
                            'category_id':<?php echo $wp_query->query_vars['cat'] ?>

	                        <?php

								if (!empty($wp_query->query_vars['offset'])) {
									echo ',offset : ' . intval($wp_query->query_vars['offset']);
								}

                            ?>
                        };
                        tdAjaxLoop.loopState.ajax_pagination_infinite_stop = <?php echo $ajax_pagination_infinite_stop ?>;
                        tdAjaxLoop.init();
                    });
                </script>
                <?php
                $js = "\n". td_util::remove_script_tag(ob_get_clean());
                td_js_buffer::add_to_footer($js);
                ?>



                <div class="td-ajax-loop-infinite"></div>
                <div class="td-load-more-wrap td-load-more-infinite-wrap">
                    <a href="#" class="td_ajax_load_more" data-td_block_id=""> <?php echo __td('Load more', TD_THEME_NAME) ?>
                        <i class="td-icon-font td-icon-menu-down"></i>
                    </a>
                </div>
                <?php
                return true; // notice the calling function that we modified the pagination
            }
        }

        return false; // by default return false if we don't want to change the pagination
    }

    static function td_round_number($num, $tonearest) {
        return floor($num/$tonearest)*$tonearest;
    }


    //the default options
    static function pagenavi_init() {
        $pagenavi_options = array();
        $pagenavi_options['pages_text'] = __td('Page %CURRENT_PAGE% of %TOTAL_PAGES%', TD_THEME_NAME);
        $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
        $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
        $pagenavi_options['first_text'] = __td('1');
        $pagenavi_options['last_text'] = __td('%TOTAL_PAGES%');
        if (is_rtl()) {
            $pagenavi_options['next_text'] = '<i class="td-icon-menu-right"></i>';
            $pagenavi_options['prev_text'] = '<i class="td-icon-menu-left"></i>';
        } else {
            $pagenavi_options['next_text'] = '<i class="td-icon-menu-right"></i>';
            $pagenavi_options['prev_text'] = '<i class="td-icon-menu-left"></i>';
        }
        $pagenavi_options['dotright_text'] = __td('...');
        $pagenavi_options['dotleft_text'] = __td('...');


        $pagenavi_options['num_pages'] = 3;

        $pagenavi_options['always_show'] = 0;
        $pagenavi_options['num_larger_page_numbers'] = 3;
        $pagenavi_options['larger_page_numbers_multiple'] = 1000;

        return $pagenavi_options;
    }



    
    


    static function no_posts() {
        if (td_global::$custom_no_posts_message === false) {
            return '';
        } else {

            $buffy = '<div class="no-results td-pb-padding-side">';
            if (empty(td_global::$custom_no_posts_message)) {
                $buffy .= '<h2>' . __td('No posts to display', TD_THEME_NAME) . '</h2>';
            } else {
                $buffy .= '<h2>' . td_global::$custom_no_posts_message . '</h2>';
            }
            $buffy .= '</div>';
            return $buffy;
        }

    }



    /**
     * the breadcrumb generator
     * @param $breadcrumbs_array - breadcrumbs array
     * @return string
     */
    static function get_breadcrumbs($breadcrumbs_array) {
        global $post;

        if (empty($breadcrumbs_array)) {
            return '';
        }

        // add home breadcrumb if the theme is configured to show it
        if (td_util::get_option('tds_breadcrumbs_show_home') != 'hide') {
            array_unshift($breadcrumbs_array, array(
                'title_attribute' => '',
                'url' => esc_url(home_url( '/' )),
                'display_name' => __td('Home', TD_THEME_NAME)
            ));
        }

        $buffy = '';

        $buffy .= '<div class="entry-crumbs">';

        //check for home url, the name can be changed from translations
        //$home_url = get_home_url() . '/';
        //$count = 1;

        $array_elements = count($breadcrumbs_array);

        foreach ($breadcrumbs_array as $key => $breadcrumb) {

            if ($key == $array_elements - 1) {
                //last element should not display the url
                $breadcrumb['url'] = '';
            }

            if (empty($breadcrumb['url'])) {
                if ($key != 0) { //add separator only after first
                    $buffy .= ' <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> ';
                }
                //no link - breadcrumb
                $buffy .=  '<span class="td-bred-no-url-last">' . esc_html( $breadcrumb['display_name'] ) . '</span>';

            } else {
                if ($key != 0) { //add separator only after first
                    $buffy .= ' <i class="td-icon-right td-bread-sep"></i> ';
                }
                //normal links
                $buffy .= '<span><a title="' . esc_attr( $breadcrumb['title_attribute'] ) . '" class="entry-crumb" href="' . esc_url( $breadcrumb['url'] ) . '">' . esc_html( $breadcrumb['display_name'] ) . '</a></span>';
            }


//            if ($breadcrumb['url'] == $home_url) {
//                //home - breadcrumb
//                $buffy .=  '<span class="td-bred-first"><a href="' . $breadcrumb['url'] . '">';
//                $buffy .= $breadcrumb['display_name'];
//                $buffy .= '</a></span>';
//            } elseif (empty($breadcrumb['url'])) {
//                //add separator
//                if ($key != 0) {
//                    $buffy .= ' <i class="td-icon-right td-bread-sep td-bred-no-url-last"></i> ';
//                }
//
//                //no link - breadcrumb
//                $buffy .=  '<span class="td-bred-no-url-last">';
//                $buffy .= $breadcrumb['display_name'];
//                $buffy .= '</span>';
//            } else {
//                //add separator
//                if ($key != 0) {
//                    $buffy .= ' <i class="td-icon-right td-bread-sep"></i> ';
//                }
//
//                //normal breadcrumb
//                $buffy .= '<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
//                               <a title="' . $breadcrumb['title_attribute'] . '" class="entry-crumb" itemscope itemprop="item" itemtype="http://schema.org/Thing" href="' . $breadcrumb['url'] . '">
//                                  <span itemprop="name">' . $breadcrumb['display_name'] . '</span>';
//                $buffy .= '    </a>';
//                $buffy .= '    <meta itemprop="position" content = "' . $count . '">';
//                $buffy .= '</span>';
//
//                $count++;
//            }


        }
        $buffy .= '</div>';

        return $buffy;
    }


}