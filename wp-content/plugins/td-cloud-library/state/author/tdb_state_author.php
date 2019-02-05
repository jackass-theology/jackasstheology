<?php


/**
 * Class tdb_state_author
 * @property tdb_method title
 * @property tdb_method image
 * @property tdb_method posts_count
 * @property tdb_method comments_count
 * @property tdb_method url
 * @property tdb_method description
 * @property tdb_method socials
 * @property tdb_method box
 * @property tdb_method author_breadcrumbs
 * @property tdb_method loop
 *
 */
class tdb_state_author extends tdb_state_base {

    private $author_obj = '';

    /**
     * @param WP_Query $wp_query
     */
    function set_wp_query($wp_query) {

        parent::set_wp_query($wp_query);

        $author_wp_query = $this->get_wp_query();

        if ( isset( $author_wp_query->query['author_name'] ) ) {
	        $this->author_obj = get_user_by( 'slug', $author_wp_query->query['author_name'] );
        } else if ( isset( $author_wp_query->query['author'] ) ) {
        	$this->author_obj = get_user_by( 'id', $author_wp_query->query['author'] );
        } else {
            $this->author_obj = get_userdata( '1' );
        }


        /*
             *
             * author object
             *
             * stdClass Object
                    (
                        [ID] => 1
                        [user_login] => admin
                        [user_pass] => $P$Bi9O35X5jtX3Xh2JDWHqeY/Z3glj1W0
                        [user_nicename] => admin
                        [user_email] => ctl@yahoo.com
                        [user_url] =>
                        [user_registered] => 2018-03-27 07:20:59
                        [user_activation_key] =>
                        [user_status] => 0
                        [display_name] => admin
                    )
             *
             *
             * */

    }



    public function __construct() {

        // author posts loop
        $this->loop = function ( $atts ) {

            // pagination options
            $pagenavi_options = array(
                'pages_text'    => __td( 'Page %CURRENT_PAGE% of %TOTAL_PAGES%', TD_THEME_NAME ),
                'current_text'  => '%PAGE_NUMBER%',
                'page_text'     => '%PAGE_NUMBER%',
                'first_text'    => __td( '1' ),
                'last_text'     => __td( '%TOTAL_PAGES%' ),
                'next_text'     => '<i class="td-icon-menu-right"></i>',
                'prev_text'     => '<i class="td-icon-menu-left"></i>',
                'dotright_text' => __td( '...' ),
                'dotleft_text'  => __td( '...' ),
                'num_pages'     => 3,
                'always_show'   => true
            );

            // pagination defaults
            $pagination_defaults = array(
                'pagenavi_options' => $pagenavi_options,
                'paged' => 1,
                'max_page' => 3,
                'start_page' => 1,
                'end_page' => 3,
                'pages_to_show' => 3,
                'previous_posts_link' => '<a href="#"><i class="td-icon-menu-left"></i></a>',
                'next_posts_link' => '<a href="#"><i class="td-icon-menu-right"></i></a>'
            );

            // posts limit - by default get the global wp loop posts limit setting
            $limit = get_option( 'posts_per_page' );
            if ( isset( $atts['limit'] ) ) {
                $limit = $atts['limit'];
            }

            // posts offset
            $offset = 0;
            if ( isset( $atts['offset'] ) ) {
                $offset = $atts['offset'];
            }

            $dummy_data_array = array(
                'loop_posts' => array(),
                'limit'      => $limit,
                'offset'     => $offset
            );

            for ( $i = $offset; $i < $limit + $offset; $i++ ) {
                $dummy_data_array['loop_posts'][$i] = array(
                    'post_id' => '-' . $i, // negative post_id to avoid conflict with existent posts
                    'post_type' => 'sample',
                    'post_link' => '#',
                    'post_title' => 'Sample post title ' . $i,
                    'post_title_attribute' => esc_attr( 'Sample post title ' . $i ),
                    'post_excerpt' => 'Sample post no ' . $i .  ' excerpt.',
                    'post_content' => 'Sample post no ' . $i .  ' content.',
                    'post_date_unix' =>  get_the_time( 'U' ),
                    'post_date' => date( get_option( 'date_format' ), time() ),
                    'post_author_url' => '#',
                    'post_author_name' => 'Author name',
                    'post_author_email' => get_the_author_meta( 'email', 1 ),
                    'post_comments_no' => '11',
                    'post_comments_link' => '#',
                    'post_theme_settings' => array(
                        'td_primary_cat' => '1'
                    ),
                );
            }

            $dummy_data_array['loop_pagination'] = $pagination_defaults;
            $dummy_data_array['author_id'] = '';

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();
            $data_array['limit'] = $limit;

            $state_wp_query = $this->get_wp_query();

            foreach ( $state_wp_query->posts as $post ) {
                $data_array['loop_posts'][$post->ID] = array(
                    'post_id' => $post->ID,
                    'post_type' => get_post_type( $post->ID ),
                    'has_post_thumbnail' => has_post_thumbnail( $post->ID ),
                    'post_thumbnail_id' => get_post_thumbnail_id( $post->ID ),
                    'post_link' => esc_url( get_permalink( $post->ID ) ),
                    'post_title' => get_the_title( $post->ID ),
                    'post_title_attribute' => esc_attr( strip_tags( get_the_title( $post->ID ) ) ),
                    'post_excerpt' => $post->post_excerpt,
                    'post_content' => $post->post_content,
                    'post_date_unix' =>  get_the_time( 'U', $post->ID ),
                    'post_date' => get_the_time( get_option( 'date_format' ), $post->ID ),
                    'post_author_url' => get_author_posts_url( $post->post_author ),
                    'post_author_name' => get_the_author_meta( 'display_name', $post->post_author ),
                    'post_author_email' => get_the_author_meta( 'email', $post->post_author ),
                    'post_comments_no' => get_comments_number( $post->ID ),
                    'post_comments_link' => get_comments_link( $post->ID ),
                    'post_theme_settings' => td_util::get_post_meta_array( $post->ID, 'td_post_theme_settings' ),
                );
            }

            $data_array['loop_pagination'] = $pagination_defaults;

            $paged = intval( $state_wp_query->query_vars['paged'] );

            if ( $paged === 0 ) {
                $paged = 1;
            }

            $max_page = $state_wp_query->max_num_pages;

            $pages_to_show         = intval( $pagenavi_options['num_pages'] );
            $pages_to_show_minus_1 = $pages_to_show - 1;
            $half_page_start       = floor($pages_to_show_minus_1/2 );
            $half_page_end         = ceil($pages_to_show_minus_1/2 );
            $start_page            = $paged - $half_page_start;

            if( $start_page <= 0 ) {
                $start_page = 1;
            }

            $end_page = $paged + $half_page_end;
            if( ( $end_page - $start_page ) != $pages_to_show_minus_1 ) {
                $end_page = $start_page + $pages_to_show_minus_1;
            }

            if( $end_page > $max_page ) {
                $start_page = $max_page - $pages_to_show_minus_1;
                $end_page = $max_page;
            }

            if( $start_page <= 0 ) {
                $start_page = 1;
            }

            $data_array['loop_pagination']['paged'] = $paged;
            $data_array['loop_pagination']['max_page'] = $max_page;
            $data_array['loop_pagination']['start_page'] = $start_page;
            $data_array['loop_pagination']['end_page'] = $end_page;
            $data_array['loop_pagination']['pages_to_show'] = $pages_to_show;

            global $wp_query, $tdb_state_author, $paged;
            $template_wp_query = $wp_query;

            $wp_query = $tdb_state_author->get_wp_query();
            $paged = intval( $state_wp_query->query_vars['paged'] );

            $data_array['loop_pagination']['previous_posts_link'] = get_previous_posts_link( $pagenavi_options['prev_text'] );
            $data_array['loop_pagination']['next_posts_link'] = get_next_posts_link( $pagenavi_options['next_text'], $max_page );

            $wp_query = $template_wp_query;

            // author id
            $data_array['author_id'] = $this->author_obj->ID;

            return $data_array;
        };


        // author name/page title
        $this->title = function ( $atts ) {
            $dummy_data_array = array(
                'title' => 'Sample author name',
                'class' => 'tdb-author-title'
            );
            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array(
                'title' => $this->author_obj->display_name,
                'class' => 'tdb-author-title'
            );

            return $data_array;
        };


        // author image
        $this->image = function ( $atts ) {
            $dummy_data_array = array(
                'image' => get_avatar_url( get_the_author_meta( 'email', 1 ), array("size" => 800) )
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $td_avatar = get_avatar( $this->author_obj->user_email, 800 );

            if ( false !== $td_avatar ) {

                preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $td_avatar, $matches, PREG_SET_ORDER);
                $td_avatar_image_src = !empty($matches) ? $matches [0] [1] : "";

                return $data_array = array(
                    'image' => $td_avatar_image_src
                );
            }

            return $dummy_data_array;
        };


        // author posts count
        $this->posts_count = function ( $atts ) {
            $dummy_data_array = array(
                'posts-count' => count_user_posts( 1 )
            );
            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array(
                'posts-count'    => count_user_posts( $this->author_obj->ID )
            );

            return $data_array;
        };


        // author comments count
        $this->comments_count = function ( $atts ) {
            $dummy_data_array = array(
                'comments-count' => get_comments( array( 'type' => '', 'user_id' => 1, 'count'   => true ) )
            );
            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $comments_count = get_comments(
                array(
                    'type'    => '',
                    'user_id' => $this->author_obj->ID,
                    'count'   => true
                )
            );

            $data_array = array(
                'comments-count' => $comments_count
            );

            return $data_array;
        };


        // author url
        $this->url = function ( $atts ) {
            $dummy_data_array = array(
                'url' => 'www.sample-website.com'
            );
            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

	        if ( empty( $this->author_obj->user_url ) ) {
		        if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
			        return $dummy_data_array;
		        }
	        }

            $data_array = array(
                'url' => esc_url( $this->author_obj->user_url )
            );

            return $data_array;
        };


        // author description
        $this->description = function ( $atts ) {
            $dummy_data_array = array(
                'description' => 'Sample author description'
            );
            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

	        if ( empty( $this->author_obj->description ) ) {
		        if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
			        return $dummy_data_array;
		        }
	        }

            $data_array = array(
                'description' => $this->author_obj->description
            );

            return $data_array;
        };


        // author socials
        $this->socials = function ( $atts ) {
            $dummy_data_array = array(
                'social_icons'   => array(
                    array(
                        'social_id' => 'twitter',
                        'social_link' => '#'
                    ),
                    array(
                        'social_id' => 'pinterest',
                        'social_link' => '#'
                    ),
                    array(
                        'social_id' => 'facebook',
                        'social_link' => '#'
                    ),
                    array(
                        'social_id' => 'googleplus',
                        'social_link' => '#'
                    )
                ),
            );
            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

	        $data_array = array(
                'social_icons'   => array()
            );

            foreach ( td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name ) {
                $author_meta = get_user_meta( $this->author_obj->ID, $td_social_id, true );

                if ( !empty( $author_meta ) ) {

                    //the theme can use the twitter id instead of the full url. This avoids problems with yoast plugin
                    if ( $td_social_id == 'twitter' ) {
                        if( filter_var( $author_meta, FILTER_VALIDATE_URL ) ){

                        } else {
                            $author_meta = str_replace('@', '', $author_meta );
                            $author_meta = 'http://twitter.com/' . $author_meta;
                        }
                    }

                    if ( $td_social_id == 'mail-1' and strpos( $author_meta, '@' ) !== false and strpos( strtolower( $author_meta ), 'mailto:' ) === false ) {
                        $author_meta = 'mailto:' . $author_meta;
                    }

                    $data_array['social_icons'][] = array(
                        'social_id' => $td_social_id,
                        'social_link' => $author_meta
                    );
                }
            }

	        if ( empty( $data_array['social_icons'] ) ) {
		        if ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) {
			        return $dummy_data_array;
		        }
	        }

            return $data_array;
        };


        // author box
        $this->box = function ( $atts ) {

            $dummy_data_array = array(
                'avatar'         => get_avatar( get_the_author_meta( 'email', 1 ), '96' ),
                'posts-count'    => count_user_posts( 1 ),
                'comments-count' => get_comments( array( 'type' => '', 'user_id' => 1, 'count'   => true ) ),
                'url'            => 'www.sample-website.com',
                'description'    => 'Sample author description',
                'social_icons'   => array(
                    array(
                        'social_id' => 'twitter',
                        'social_link' => '#'
                    ),
                    array(
                        'social_id' => 'pinterest',
                        'social_link' => '#'
                    ),
                    array(
                        'social_id' => 'facebook',
                        'social_link' => '#'
                    ),
                    array(
                        'social_id' => 'googleplus',
                        'social_link' => '#'
                    )
                ),
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $comments_count = get_comments(
                array(
                    'type'    => '',
                    'user_id' => $this->author_obj->ID,
                    'count'   => true
                )
            );

            $data_array = array(
                'avatar'         => get_avatar( $this->author_obj->user_email, '96' ),
                'posts-count'    => count_user_posts( $this->author_obj->ID ),
                'comments-count' => $comments_count,
                'url'            => esc_url( $this->author_obj->user_url ),
                'description'    => $this->author_obj->description,
                'social_icons'   => array()
            );

            foreach ( td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name ) {
                $author_meta = get_user_meta( $this->author_obj->ID, $td_social_id, true );

                if ( !empty( $author_meta ) ) {

                    //the theme can use the twitter id instead of the full url. This avoids problems with yoast plugin
                    if ( $td_social_id == 'twitter' ) {
                        if( filter_var( $author_meta, FILTER_VALIDATE_URL ) ){

                        } else {
                            $author_meta = str_replace('@', '', $author_meta );
                            $author_meta = 'http://twitter.com/' . $author_meta;
                        }
                    }

                    if ( $td_social_id == 'mail-1' and strpos( $author_meta, '@' ) !== false and strpos( strtolower( $author_meta ), 'mailto:' ) === false ) {
                        $author_meta = 'mailto:' . $author_meta;
                    }

                    $data_array['social_icons'][] = array(
                        'social_id' => $td_social_id,
                        'social_link' => $author_meta
                    );
                }
            }

            return $data_array;
        };

        // author page breadcrumbs
        $this->author_breadcrumbs = function ( $atts ) {

            $a_custom_title = ( $atts['author_custom_title'] != '' ) ? $atts['author_custom_title'] : __td( 'Authors', TD_THEME_NAME );
            $a_custom_title_att = ( $atts['author_custom_title_att'] != '' ) ? $atts['author_custom_title_att'] : '';
            $a_custom_link = ( $atts['author_custom_link'] != '' ) ? $atts['author_custom_link'] : '';

            $by_a_custom_title = ( $atts['by_author_custom_title'] != '' ) ? $atts['by_author_custom_title'] : __td( 'Posts by', TD_THEME_NAME ) . ' John Doe';
            $by_a_custom_title_att = ( $atts['by_author_custom_title_att'] != '' ) ? $atts['by_author_custom_title_att'] : '';
            $by_a_custom_link = ( $atts['by_author_custom_link'] != '' ) ? $atts['by_author_custom_link'] : '';

            $dummy_data_array = array(
                array(
                    'title_attribute' => $a_custom_title_att,
                    'url' => esc_url( $a_custom_link ),
                    'display_name' => $a_custom_title
                ),
                array(
                    'title_attribute' => $by_a_custom_title_att,
                    'url' => esc_url( $by_a_custom_link ),
                    'display_name' => $by_a_custom_title
                )
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();

            $author_custom_title = ( $atts['author_custom_title'] != '' ) ? $atts['author_custom_title'] : __td( 'Authors', TD_THEME_NAME );
            $author_custom_link = ( $atts['author_custom_link'] != '' ) ? $atts['author_custom_link'] : '';
            $author_custom_title_att = ( $atts['author_custom_title_att'] != '' ) ? $atts['author_custom_title_att'] : '';

            $data_array[] = array (
                'title_attribute' => $author_custom_title_att,
                'url' => esc_url( $author_custom_link ),
                'display_name' => $author_custom_title
            );

            $by_author_custom_title = ( $atts['by_author_custom_title'] != '' ) ? $atts['by_author_custom_title'] : __td( 'Posts by', TD_THEME_NAME ) . ' ' . $this->author_obj->display_name;
            $by_author_custom_link = ( $atts['by_author_custom_link'] != '' ) ? $atts['by_author_custom_link'] : get_author_posts_url( $this->author_obj->ID );
            $by_author_custom_title_att = ( $atts['by_author_custom_title_att'] != '' ) ? $atts['by_author_custom_title_att'] : '';

            $data_array[] = array (
                'title_attribute' => $by_author_custom_title_att,
                'url' => esc_url( $by_author_custom_link ),
                'display_name' => $by_author_custom_title
            );

            return $data_array;

        };




        parent::lock_state_definition();
    }

}