<?php


/**
 * Class tdb_state_search
 * @property tdb_method title
 * @property tdb_method search_form
 * @property tdb_method search_breadcrumbs
 * @property tdb_method loop
 *
 */
class tdb_state_search extends tdb_state_base {

    private $search_wp_query = '';
    //private $search_query = '';

    /**
     * @param WP_Query $wp_query
     */
    function set_wp_query( $wp_query ) {

        parent::set_wp_query( $wp_query );

        $this->search_wp_query = $this->get_wp_query();
        //$this->search_query = esc_attr( apply_filters( 'get_search_query', $this->get_wp_query()->query_vars['s'] ) );
    }



    public function __construct() {


        // search page posts loop
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
            $dummy_data_array['search_query'] = '';

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();
            $data_array['limit'] = $limit;
            $data_array['loop_posts'] = array();

            $state_wp_query = $this->search_wp_query;

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

            global $wp_query, $tdb_state_search, $paged;
            $template_wp_query = $wp_query;

            $wp_query = $tdb_state_search->get_wp_query();
            $paged = intval( $state_wp_query->query_vars['paged'] );

            $data_array['loop_pagination']['previous_posts_link'] = get_previous_posts_link( $pagenavi_options['prev_text'] );
            $data_array['loop_pagination']['next_posts_link'] = get_next_posts_link( $pagenavi_options['next_text'], $max_page );
            $data_array['search_query'] = get_search_query();

            $wp_query = $template_wp_query;

            //$data_array['search_query'] = $this->search_query;

            return $data_array;
        };

        // search page title
        $this->title = function ( $atts ) {

            $dummy_data_array = array(
                'title' => 'Sample',
                'class' => 'tdb-search-title'
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();

            global $wp_query, $tdb_state_search;
            $template_wp_query = $wp_query;

            $wp_query = $tdb_state_search->get_wp_query();

            $data_array['title'] = get_search_query();

            $wp_query = $template_wp_query;

            $data_array['class'] = 'tdb-search-title';

//            $data_array = array(
//                'title' => $this->search_query,
//                'class' => 'tdb-search-title'
//            );

            return $data_array;
        };

        // search page breadcrumbs
        $this->search_breadcrumbs = function ( $atts ) {

            $s_custom_title = ( $atts['search_custom_title'] != '' ) ? $atts['search_custom_title'] : __td( 'Search', TD_THEME_NAME );
            $s_custom_link = ( $atts['search_custom_link'] != '' ) ? $atts['search_custom_link'] : '';
            $s_custom_title_att = ( $atts['search_custom_title_att'] != '' ) ? $atts['search_custom_title_att'] : '';

            $dummy_data_array = array(
                array(
                    'title_attribute' => $s_custom_title_att,
                    'url' => esc_url( $s_custom_link ),
                    'display_name' => $s_custom_title
                )
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $search_custom_title = ( $atts['search_custom_title'] != '' ) ? $atts['search_custom_title'] : __td( 'Search', TD_THEME_NAME );
            $search_custom_link = ( $atts['search_custom_link'] != '' ) ? $atts['search_custom_link'] : '';
            $search_custom_title_att = ( $atts['search_custom_title_att'] != '' ) ? $atts['search_custom_title_att'] : '';

            $data_array = array(
                array(
                    'title_attribute' => $search_custom_title_att,
                    'url' => esc_url( $search_custom_link ),
                    'display_name' => $search_custom_title
                )
            );

            return $data_array;

        };

        // search page form
        $this->search_form = function ( $atts ) {

            $dummy_data_array = array(
                'search_query' => '',
                'results_msg' => 0,
            );

            if ( !$this->has_wp_query() ) {
                return $dummy_data_array;
            }

            $data_array = array();

            global $wp_query, $tdb_state_search;
            $template_wp_query = $wp_query;

            $wp_query = $tdb_state_search->get_wp_query();

            $data_array['search_query'] = get_search_query();

            $wp_query = $template_wp_query;

            $data_array['results_msg'] = 1;

//            $data_array = array(
//                'search_query' => $this->search_query,
//                'results_msg' => 1,
//            );

            return $data_array;
        };




        parent::lock_state_definition();
    }

}