<?php
/**
 *
 * loaded from theme's function.php
 */

/*
 * add theme panel amp settings
 */
add_action('td_global_after', 'td_on_global_after_amp');
function td_on_global_after_amp() {

    if (is_admin() && array_key_exists('theme_panel', td_global::$all_theme_panels_list) && array_key_exists('panels', td_global::$all_theme_panels_list['theme_panel'])) {

        $separator_panel = 'td-panel-separator-plugin';

        if (! in_array($separator_panel, td_global::$all_theme_panels_list['theme_panel']['panels'])) {
            td_global::$all_theme_panels_list['theme_panel']['panels'][$separator_panel] = array(
                'text' => 'PLUGINS\' SETTINGS',
                'type' => 'separator',
            );
        }

        td_global::$all_theme_panels_list['theme_panel']['panels']['td-amp-plugin'] = array(
            'text' => 'AMP',
            'ico_class' => 'td-ico-amp',
            'file' => plugin_dir_path(__FILE__) . '/panel/td_panel_settings.php',
            'type' => 'in_theme',
        );
    }
}

/*
 * add theme specific amp post components
 */
add_action( 'td_wp_booster_loaded', 'on_td_wp_booster_loaded' );
function on_td_wp_booster_loaded() {

    // add the amp related posts block to the api
    td_api_block::add( 'td_block_related_posts_amp',
        array(
            'map_in_visual_composer' => false,
            'map_in_td_composer' => false,
            "base" => "td_block_related_posts_amp",
            'name' => "AMP Related Posts Block",
            'file' => dirname( __FILE__ ) . '/shortcodes/td_block_related_posts_amp.php',
        )
    );

    require_once( dirname( __FILE__ ) . '/shortcodes/td_ad_box_amp.php' ); // amp theme ad support
    require_once( dirname( __FILE__ ) . '/shortcodes/td_block_related_posts_amp.php' ); // amp theme related articles block
    require_once( dirname( __FILE__ ) . '/shortcodes/td_block_video_youtube_amp.php' ); // amp youtube playlist block
    require_once( dirname( __FILE__ ) . '/shortcodes/td_block_video_vimeo_amp.php' ); // amp vimeo playlist block
    require_once( dirname( __FILE__ ) . '/modules/td_module_amp_1.php' ); // amp theme related articles module
    require_once( dirname( __FILE__ ) . '/smart_lists/td_smart_list_amp_1.php' ); // amp theme smart list
}

/*
 * set content max width
 */
add_filter( 'amp_content_max_width', 'td_content_max_width' );
function td_content_max_width() {
    return '780';
}

/*
 * prepare featured video for video posts
 */
add_action( 'amp_post_template_head', 'td_prepare_featured_video' );
function td_prepare_featured_video( $amp_template ) {

    $td_max_width = $amp_template->get( 'content_max_width' );
    $td_ratio = 0.5625;

    //if it's a video post...
    if ( get_post_format( $amp_template->post->ID ) == 'video' ) {
        $td_post_video = td_util::get_post_meta_array( $amp_template->post->ID, 'td_post_video' );

        if ( !empty( $td_post_video['td_video'] ) ) {

            $amp_content = new AMP_Content(
                $td_post_video['td_video'],
                array(
                    'AMP_YouTube_Embed_Handler' => array(),
                    'AMP_DailyMotion_Embed_Handler' => array(),
                    'AMP_Vimeo_Embed_Handler' => array(),
                    'AMP_Twitter_Embed_Handler' => array(
                        'width' => $td_max_width,
                        'height' => round( $td_max_width * $td_ratio )
                    ),
                    'AMP_Facebook_Embed_Handler' => array(
                        'width' => $td_max_width,
                        'height' => round( $td_max_width * $td_ratio )
                    )
                ),
                array(
                    'AMP_Style_Sanitizer' => array(),
                    'AMP_Video_Sanitizer' => array(),
                    'AMP_Iframe_Sanitizer' => array(
                        'add_placeholder' => true,
                    ),
                    'AMP_Tag_And_Attribute_Sanitizer' => array(),
                ),
                array(
                    'content_max_width' => $td_max_width,
                )
            );

            $amp_template->td_merge_data_for_key( 'amp_component_scripts', $amp_content->get_amp_scripts() );
            $amp_template->td_add_data( array(
                'featured_video' => $amp_content->get_amp_content(),
            ) );
        }
    }
    return;
}

/*
 * amp ad script load
 */
add_filter( 'amp_post_template_data', 'td_load_amp_ad_script');
function td_load_amp_ad_script( $data ) {

    if ( td_is_amp_ad_set() ) {
        if (!isset($data['amp_component_scripts']) ) {
            $data['amp_component_scripts'] = array();
        }

        $data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
    }

    return $data;
}

/*
 * amp anim script load
 */
add_filter( 'amp_post_template_data', 'td_amp_anim_script');
function td_amp_anim_script( $data ) {

    if (!isset($data['amp_component_scripts']) ) {
        $data['amp_component_scripts'] = array();
    }

    if (!isset($data['amp_component_scripts']['amp-anim']) ) {
        $data['amp_component_scripts']['amp-anim'] = 'https://cdn.ampproject.org/v0/amp-anim-0.1.js';
    }

    return $data;
}

/*
 * post content metadata fix
 */
add_filter( 'amp_post_template_metadata', 'td_amp_modify_json_metadata', 10, 2 ); // custom metadata
function td_amp_modify_json_metadata( $metadata, $post ) {

    $td_publisher_logo = td_util::get_option('tds_logo_upload');

    if( 'post'=== $post->post_type  ){

        $metadata['@type'] = 'Article';

        $metadata['publisher']['name'] = get_bloginfo( 'name' );

        $metadata['publisher']['logo'] = array(
            '@type' => 'ImageObject',
            'url' => $td_publisher_logo
        );
    }

    return $metadata;
}

/*
 * post content hooks
 */
add_action( 'pre_amp_render_post', 'td_ad_for_amp_add_content_filter' );
function td_ad_for_amp_add_content_filter() {
    add_filter( 'the_content', 'td_inline_ad_for_amp_content', 15);
    add_filter( 'the_content', 'td_smart_lists_for_amp_content', 16);
}

/**
 * this function hooks on post's content and adds the post inline ad
 * @param $content - the post content
 * @return string - the post's content with the inline ad
 */
function td_inline_ad_for_amp_content( $content ) {
    global $post;

    // first check for smart list, if we're on a smart list post do nothing
    $td_smart_list = td_util::get_post_meta_array($post->ID, 'td_post_theme_settings');
    if (!empty($td_smart_list['smart_list_template'])) {
        return $content;
    }

    $paragraph_id = td_util::get_option('tds_amp_content_inline_ad_paragraph');

    if ( empty( $paragraph_id ) ) {
        $paragraph_id = 0;
    }

    $ad = td_ad_box_amp::render( array( 'spot_id' => 'tds_amp_content_inline' ));

    $content = td_ad_for_amp_insert_after_paragraph($ad, $paragraph_id, $content);

    return $content;
}

/**
 * adds the inline ad code after paragraph in post content
 * @param $ad_code - the ad code to insert in post content
 * @param $paragraph_id - the after paragraph no
 * @param $content - the post content
 * @return string - the post content after ad insertion
 */
function td_ad_for_amp_insert_after_paragraph( $ad_code, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );

    $paragraphs_number = count($paragraphs) - 1;

    foreach ( $paragraphs as $index => $paragraph ) {
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }
        if ( $paragraph_id == $index + 1 and $paragraphs_number > $index + 1 ) {
            $paragraphs[$index] .= $ad_code;
        }
    }
    return implode( '', $paragraphs );
}

/**
 * theme smart list support
 * @param $content - the post content
 * @return mixed
 */
function td_smart_lists_for_amp_content( $content ) {
    global $post;

    $td_smart_list = td_util::get_post_meta_array($post->ID, 'td_post_theme_settings');
    if (!empty($td_smart_list['smart_list_template'])) {

        $td_smart_list_class = 'td_smart_list_amp_1';
        if (class_exists($td_smart_list_class)) {

            $td_smart_list_obj = new $td_smart_list_class();

            // prepare the settings for the smart list
            $smart_list_settings = array(
                'post_content' => $content,
                'counting_order_asc' => false,
                'td_smart_list_h' => 'h3',
                'extract_first_image' => true
            );

            if (!empty($td_smart_list['td_smart_list_order'])) {
                $smart_list_settings['counting_order_asc'] = true;
            }

            if (!empty($td_smart_list['td_smart_list_h'])) {
                $smart_list_settings['td_smart_list_h'] = $td_smart_list['td_smart_list_h'];
            }
            return $td_smart_list_obj->render_from_post_content($smart_list_settings);
        } else {
            // there was an error?
            td_util::error(__FILE__, 'Missing smart list: ' . $td_smart_list_class . '. Did you disabled a tagDiv plugin?');
        }
    }

    return $content;
}

/*
 * remove the amp analytics item from top-level admin menu
 */
add_filter( 'amp_options_menu_is_enabled', '__return_false' );

/*
 * remove the amp AMP template editor for the Customizer
 */
add_action( 'after_setup_theme', 'td_amp_remove_customizer', 9 );
function td_amp_remove_customizer() {
    remove_action( 'after_setup_theme', 'amp_init_customizer' );
}

/**
 * add action for panel settings 'page' post type support
 */
add_action( 'after_setup_theme', 'td_amp_after_setup_theme' );
function td_amp_after_setup_theme() {

    // add amp support for 'page' post type
    $td_amp_page_post_type = td_util::get_option( 'tds_amp_post_type_page' );

    if ( ! empty( $td_amp_page_post_type ) ) {
        add_post_type_support( 'page', AMP_QUERY_VAR );
    }

    $td_amp_post_post_type = td_util::get_option( 'tds_amp_post_type_post' );

    if ( empty( $td_amp_post_post_type ) ) {
        // this option must always be set to always have amp support form default 'post' post type
        td_util::update_option('tds_amp_post_type_post', 'post');
    }
}

/*
 * add theme amp analytics
 */
add_filter( 'amp_post_template_analytics', 'td_amp_analytics' );
function td_amp_analytics( $analytics ) {
    $td_analytics_json = td_util::get_option('td_amp_analytics');

    // Validate JSON configuration
    $is_valid_json = AMP_HTML_Utils::is_valid_json( stripslashes( $td_analytics_json ) );
    if ( ! $is_valid_json ) {
        return $analytics;
    }

    if ( empty( $td_analytics_json ) ) {
        return $analytics;
    }

    $analytics['td-google-analytics'] = array(
        'type'        => 'googleanalytics',
        'attributes'  => array(),
        'config_data' => json_decode( stripslashes( $td_analytics_json ) ),
    );

    return $analytics;
}

/*
 * add amp video playlist support
 */
add_action( 'wp', 'td_add_amp_video_playlist', 20 );
function td_add_amp_video_playlist() {
    $is_amp_endpoint = is_amp_endpoint();
    if ( $is_amp_endpoint ) {
        add_shortcode( 'td_block_video_youtube', 'td_block_video_amp' );
        add_shortcode( 'td_block_video_vimeo', 'td_block_video_amp' );
    }
}
function td_block_video_amp( $atts, $content, $tag ) {

    $td_block_video_amp_instance = $tag . '_amp';
    $video_playlist = new $td_block_video_amp_instance();

    return $video_playlist->render($atts, $content);
}

/*
 * utility functions
 */

/**
 * image sanitizer function
 * @param $html - the img html
 * @return mixed - sanitized img html
 */
function td_sanitize_image( $html ) {
    $sanitized_html = AMP_Content_Sanitizer::sanitize(
        $html,
        array( 'AMP_Img_Sanitizer' => array() )
    );

    return $sanitized_html[0];
}

/**
 * post related articles support
 * @param $post - the wp post object
 * @return mixed - related posts html
 */
function td_get_post_related_articles( $post ) {

    if (td_util::get_option('tds_similar_articles_type') == 'by_tag') {
        $td_related_ajax_filter_type = 'cur_post_same_tags';
    } else {
        $td_related_ajax_filter_type = 'cur_post_same_categories';
    }

    $tds_similar_articles_rows = td_util::get_option('tds_similar_articles_rows');
    if (empty($tds_similar_articles_rows)) {
        $tds_similar_articles_rows = 1;
    }

    $td_related_limit = 3 * $tds_similar_articles_rows;

    $td_block_args = array (
        'limit' => $td_related_limit,
        'ajax_pagination' => 'next_prev',
        'live_filter' => $td_related_ajax_filter_type,
        'td_ajax_filter_type' => 'td_custom_related'
    );

    $td_block_related = new td_block_related_posts_amp($post);

    return $td_block_related->render($td_block_args);
}

/**
 * checks if google adsense ads are set for display
 * @return bool
 */
function td_is_amp_ad_set() {
    $amp_ad_spots = array(
        'amp_header',
        'amp_footer_top',
        'amp_content_top',
        'amp_content_inline',
        'amp_content_bottom',
    );

    $is_amp_ad_spot_set = false;

    foreach ( $amp_ad_spots as $amp_ad_spot ) {

        $amp_ad_spot_type = td_util::get_option( 'tds_' . $amp_ad_spot . '_ad_type' );

        if ( $amp_ad_spot_type == 'google-adsense' ) {
            $amp_ad_spot_ga_pub_id  = td_util::get_option( 'tds_' . $amp_ad_spot . '_adsense_ad_publisher_id');
            $amp_ad_spot_ga_unit_id = td_util::get_option( 'tds_' . $amp_ad_spot . '_adsense_ad_unit_id');

            if ( !empty($amp_ad_spot_ga_pub_id) and !empty($amp_ad_spot_ga_unit_id) ) {
                $is_amp_ad_spot_set = true;
            }
        }
    }

    return $is_amp_ad_spot_set;

}