<?php




class tdb_state_loader {


    /**
     * This is used for composer iframe and composer ajax calls to set the state.
     *  - The global wp_query is the template's
     *  - We have to get the content by making a new wp_query
     */
    static function on_tdc_loaded_load_state() {
        if (tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe()) {

            global $tdb_state_single_page, $tdb_state_single, $tdb_state_category, $tdb_state_author, $tdb_state_search, $tdb_state_date, $tdb_state_tag, $tdb_state_attachment;

            // get the content id and content type
            $tdbLoadDataFromId = tdb_util::get_get_val('tdbLoadDataFromId');
            $tdbTemplateType = tdb_util::get_get_val('tdbTemplateType');

            // try to load the content, if we fail to load it, we will ship the default state... ? @todo ?
            if ( $tdbLoadDataFromId !== false && $tdbTemplateType !== false ) {
                switch ($tdbTemplateType) {
                    case 'single':
                        // get the content wp_query
                        $wp_query_content = new WP_Query( array(
                                'page_id' => $tdbLoadDataFromId,
                                'post_type' => 'post'
                            )
                        );
                        $tdb_state_single->set_wp_query($wp_query_content);
                    break;

                    case 'attachment':
                        // get the content wp_query
                        $wp_query_content = new WP_Query( array(
                                'page_id' => $tdbLoadDataFromId,
                                'post_type' => 'attachment'
                            )
                        );
                        $tdb_state_attachment->set_wp_query($wp_query_content);
                    break;

                    case 'category':

                        $template_id = '';
                        $tem_content = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            $current_category_obj = get_category( $tdbLoadDataFromId );
                            $current_category_id = $current_category_obj->cat_ID;

                            // read the individual cat template
                            $tdb_individual_category_template = td_util::get_category_option( $current_category_id, 'tdb_category_template' );

                            // read the global template
                            $tdb_category_template = td_options::get( 'tdb_category_template' );

                            // if we find an individual template..
                            if ( !empty( $tdb_individual_category_template ) && td_global::is_tdb_template( $tdb_individual_category_template, true ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_individual_category_template );
                            } else {
                                // if we don't find an individual template go for a global one
                                if ( td_global::is_tdb_template( $tdb_category_template ) ) {
                                    $template_id = td_global::tdb_get_template_id( $tdb_category_template );
                                }
                            }

                            // if we don't have a template do not build the query
                            if ( !empty( $template_id ) ) {

                                // load the tdb template
                                $wp_query_template = new WP_Query( array(
                                        'p' => $template_id,
                                        'post_type' => 'tdb_templates',
                                    )
                                );
                            }

                            if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                                $tem_content = $wp_query_template->post->post_content;
                            }
                        }

                        $args = array(
                            'cat' => $tdbLoadDataFromId,
                            'posts_per_page' => tdb_util::get_shortcode_att($tem_content, 'tdb_loop', 'limit'),
                            'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' ),
                        );

                        // exclude or include certain posts or pages from your posts loop
                        $posts_not_in = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__not_in' );
                        $posts_in     = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__in' );

                        if ( !empty($posts_in) && is_array($posts_in) ) {
                            $args['post__in'] = $posts_in;
                            $args['orderby'] = 'post__in';
                        }

                        if ( !empty($posts_not_in) && is_array($posts_not_in) ) {
                            $args['post__not_in'] = $posts_not_in;
                        }

                        // get the cat wp_query
                        $wp_query_content = new WP_Query( $args );

                        $tdb_state_category->set_wp_query( $wp_query_content );
                    break;

                    case 'author':

                        $template_id = '';
                        $tem_content = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tdb_author_template = td_options::get( 'tdb_author_template' );
                            if ( td_global::is_tdb_template( $tdb_author_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_author_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                                $tem_content = $wp_query_template->post->post_content;
                            }
                        }

                        $args = array(
                            'author' => $tdbLoadDataFromId,
                            'posts_per_page' => tdb_util::get_shortcode_att($tem_content, 'tdb_loop', 'limit'),
                            'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' ),
                        );

                        // exclude or include certain posts or pages from your posts loop
                        $posts_not_in = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__not_in' );
                        $posts_in     = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__in' );

                        if ( !empty($posts_in) && is_array($posts_in) ) {
                            $args['post__in'] = $posts_in;
                            $args['orderby'] = 'post__in';
                        }

                        if ( !empty($posts_not_in) && is_array($posts_not_in) ) {
                            $args['post__not_in'] = $posts_not_in;
                        }

                        // get the author wp_query
                        $wp_query_content = new WP_Query( $args );

                        $tdb_state_author->set_wp_query($wp_query_content);
                    break;

                    case 'search':

                        /**
                         *  the search query is made based on query strings not an id
                         *  @todo this may need a different implementation where we can pass multiple query args or the paged arg
                         */

                        $template_id = '';
                        $tem_content = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tdb_search_template = td_options::get( 'tdb_search_template' );
                            if ( td_global::is_tdb_template( $tdb_search_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_search_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                                $tem_content = $wp_query_template->post->post_content;
                            }
                        }

                        $args = array(
                            's' => $tdbLoadDataFromId,
                            'posts_per_page' => tdb_util::get_shortcode_att($tem_content, 'tdb_loop', 'limit'),
                            'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' ),
                        );

                        // exclude or include certain posts or pages from your posts loop
                        $posts_not_in = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__not_in' );
                        $posts_in     = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__in' );

                        if ( !empty($posts_in) && is_array($posts_in) ) {
                            $args['post__in'] = $posts_in;
                            $args['orderby'] = 'post__in';
                        }

                        if ( !empty($posts_not_in) && is_array($posts_not_in) ) {
                            $args['post__not_in'] = $posts_not_in;
                        }

                        // get the search wp_query
                        $wp_query_content = new WP_Query( $args );

                        $tdb_state_search->set_wp_query($wp_query_content);
                    break;

                    case 'date':

                        /**
                         * the date query may need all year/month/day args while through the "$tdbLoadDataFromId" var we can pass just an id
                         * @todo this needs a different implementation where we can pass multiple query args
                         *  we may also need this for paginated(paged) pages, when loading content from page no 2,3,4...
                         */

                        $template_id = '';
                        $tem_content = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tdb_date_template = td_options::get( 'tdb_date_template' );
                            if ( td_global::is_tdb_template( $tdb_date_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_date_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                                $tem_content = $wp_query_template->post->post_content;
                            }
                        }

                        $args = array(
                            'year' => $tdbLoadDataFromId,
                            'posts_per_page' => tdb_util::get_shortcode_att($tem_content, 'tdb_loop', 'limit'),
                            'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' ),
                        );

                        // exclude or include certain posts or pages from your posts loop
                        $posts_not_in = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__not_in' );
                        $posts_in     = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__in' );

                        if ( !empty($posts_in) && is_array($posts_in) ) {
                            $args['post__in'] = $posts_in;
                            $args['orderby'] = 'post__in';
                        }

                        if ( !empty($posts_not_in) && is_array($posts_not_in) ) {
                            $args['post__not_in'] = $posts_not_in;
                        }

                        // get the date wp_query
                        $wp_query_content = new WP_Query( $args );

                        $tdb_state_date->set_wp_query($wp_query_content);
                    break;

                    case 'tag':

                        $template_id = '';
                        $tem_content = '';

                        if ( tdc_state::is_live_editor_ajax() ) {
                            $tem_content = stripcslashes( $_POST['shortcode'] );
                        } else {

                            // read the template
                            $tdb_tag_template = td_options::get( 'tdb_tag_template' );
                            if ( td_global::is_tdb_template( $tdb_tag_template ) ) {
                                $template_id = td_global::tdb_get_template_id( $tdb_tag_template );
                            }

                            // load the tdb template
                            $wp_query_template = new WP_Query( array(
                                    'p' => $template_id,
                                    'post_type' => 'tdb_templates',
                                )
                            );

                            if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                                $tem_content = $wp_query_template->post->post_content;
                            }
                        }

                        $tag = get_tag( $tdbLoadDataFromId, OBJECT );

                        $args = array(
                            'tag' => $tag->slug,
                            'posts_per_page' => tdb_util::get_shortcode_att($tem_content, 'tdb_loop', 'limit'),
                            'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' ),
                        );

                        // exclude or include certain posts or pages from your posts loop
                        $posts_not_in = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__not_in' );
                        $posts_in     = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__in' );

                        if ( !empty($posts_in) && is_array($posts_in) ) {
                            $args['post__in'] = $posts_in;
                            $args['orderby'] = 'post__in';
                        }

                        if ( !empty($posts_not_in) && is_array($posts_not_in) ) {
                            $args['post__not_in'] = $posts_not_in;
                        }

                        // get the tag wp_query
                        $wp_query_content = new WP_Query( $args );

                        $tdb_state_tag->set_wp_query($wp_query_content);
                    break;
                }
            }

            // get the page id
            $post_id = tdb_util::get_get_val('post_id');

            if ( $tdbTemplateType === 'page' && $post_id !== false  ) {

                $tem_content = '';

                if ( tdc_state::is_live_editor_ajax() ) {
                    $tem_content = stripcslashes($_POST['shortcode']);
                } else {

                    // load the tdb template
                    $wp_query_template = new WP_Query( array(
                            'p' => $post_id,
                            'post_type' => 'page',
                        )
                    );

                    // do not set the template content if we don't find the template
                    if ( !empty( $wp_query_template ) && $wp_query_template->have_posts() ) {
                        $tem_content = $wp_query_template->post->post_content;
                    }
                }

                $args = array(
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'post_status' => 'publish',
                    'posts_per_page' => tdb_util::get_shortcode_att($tem_content, 'tdb_loop', 'limit'),
                    'offset' => tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','offset' ),
                    'paged' => 1,
                );

                // exclude or include certain posts or pages from your posts loop
                $posts_not_in = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__not_in' );
                $posts_in     = self::parse_shortcode_att( tdb_util::get_shortcode_att( $tem_content, 'tdb_loop','post_ids' ), 'post__in' );

                if ( !empty($posts_in) && is_array($posts_in) ) {
                    $args['post__in'] = $posts_in;
                    $args['orderby'] = 'post__in';
                }

                if ( !empty($posts_not_in) && is_array($posts_not_in) ) {
                    $args['post__not_in'] = $posts_not_in;
                }

                $wp_query_content = new WP_Query( $args );

                $tdb_state_single_page->set_wp_query( $wp_query_content );

            }
        }
    }



    /**
     * Here we build the state for the single template when is accessed on the front end,
     *  - we have to do it on this hook because we want to use the wordpress wp_query from it's main query.
     *  - Why we use two hooks to store the state: when td-composer is editing a single template, the main query is the template's query
     *      so we have to make a new query, unlike here where we already have the global wp_query available
     *
     */
    static function on_template_redirect_load_state() {

        global $wp_query, $tdb_state_single_page, $tdb_state_single, $tdb_state_category, $tdb_state_author, $tdb_state_search, $tdb_state_date, $tdb_state_tag, $tdb_state_attachment;

        // we are on the front end on a post
        if ( is_singular( array( 'post' ) ) ) {
            $tdb_state_single->set_wp_query($wp_query);
        }

        // we are on the front end on a page
        if ( is_singular( array( 'page' ) ) ) {
            $tdb_state_single_page->set_wp_query($wp_query);
        }

        // we are on the front end on an attachment page
        if ( is_singular( array( 'attachment' ) ) ) {
            $tdb_state_attachment->set_wp_query($wp_query);
        }

        // if we are on the front end on a 404 page load the page state
        if ( is_404() ) {
            $tdb_state_single_page->set_wp_query($wp_query);
        }

        // we are on the front end on a category page
        if ( is_category() ) {
            $tdb_state_category->set_wp_query($wp_query);
        }

        // we are on the front end on a author page
         if ( is_author() ) {
            $tdb_state_author->set_wp_query($wp_query);
        }

        // we are on the front end on a search page
         if ( is_search() ) {
            $tdb_state_search->set_wp_query($wp_query);
        }

        // we are on the front end on a date archive page
         if ( is_date() ) {
             $tdb_state_date->set_wp_query($wp_query);
        }

        // we are on the front end on a tag page
         if ( is_tag() ) {
             $tdb_state_tag->set_wp_query($wp_query);
        }
    }

    /**
     *
     *  IN: the shortcode att value and the wp query param name
     *  OUT: the wp query param value
     *
     * @param $shortcode_att - the shortcode attribute value
     * @param $wp_query_param - the wp_query param type
     *
     * @return mixed - a wp query compatible parameter value
     */
    static function parse_shortcode_att( $shortcode_att, $wp_query_param ) {

        switch ($wp_query_param) {
            case 'post__not_in':

                $post_ids = $shortcode_att;
                $posts_not_in = array();

                if ( !empty($post_ids) ) {
                    // split posts ids string
                    $post_ids_array = explode(',', $post_ids);

                    // split ids
                    foreach ($post_ids_array as $post_id) {
                        $post_id = trim($post_id);

                        // check if the ID is actually a number
                        if (is_numeric($post_id)) {

                            if (intval($post_id) < 0) {
                                $posts_not_in[] = str_replace('-', '', $post_id);
                            }
                        }
                    }
                }

                return $posts_not_in;

                break;
            case 'post__in':

                $post_ids = $shortcode_att;
                $posts_in = array();

                if ( !empty($post_ids) ) {
                    // split posts ids string
                    $post_ids_array = explode(',', $post_ids);

                    // split ids
                    foreach ($post_ids_array as $post_id) {
                        $post_id = trim($post_id);

                        // check if the ID is actually a number
                        if (is_numeric($post_id)) {
                            if (intval($post_id) > 0) {
                                $posts_in[] = $post_id;
                            }
                        }
                    }
                }

                return $posts_in;

                break;
        }

        return '';
    }
}