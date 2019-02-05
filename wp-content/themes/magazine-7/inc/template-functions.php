<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Magazine 7
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function magazine_7_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    global $post;

    $global_layout = magazine_7_get_option('global_content_alignment');
    $page_layout = $global_layout;
    $disable_class = '';
    $frontpage_content_status = magazine_7_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'magazine-7-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_layout;
        }
    }

    if (is_front_page() || is_home()) {
        $frontpage_layout = magazine_7_get_option('frontpage_content_alignment');

        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        } else {
            $page_layout = $global_layout;
        }

    }

    if($page_layout == 'align-content-right'){
        if(is_front_page()){
            if(is_page_template('tmpl-front-page.php')){
                if(is_active_sidebar('home-sidebar-widgets')){
                    $classes[] = 'align-content-right';
                }else{
                    $classes[] = 'full-width-content';
                }
            }else{
                if(is_active_sidebar('sidebar-1')){
                    $classes[] = 'align-content-right';
                }else{
                    $classes[] = 'full-width-content';
                }
            }
        }else{
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-right';
            }else{
                $classes[] = 'full-width-content';
            }
        }
    }elseif($page_layout == 'full-width-content'){
        $classes[] = 'full-width-content';
    }else{
        if(is_front_page()){
            if(is_page_template('tmpl-front-page.php')){
                if(is_active_sidebar('home-sidebar-widgets')){
                    $classes[] = 'align-content-left';
                }else{
                    $classes[] = 'full-width-content';
                }
            }else{
                if(is_active_sidebar('sidebar-1')){
                    $classes[] = 'align-content-left';
                }else{
                    $classes[] = 'full-width-content';
                }
            }

        }else{
            if (is_active_sidebar('sidebar-1')) {
                $classes[] = 'align-content-left';
            }else{
                $classes[] = 'full-width-content';
            }
        }
    }
    return $classes;


}

add_filter('body_class', 'magazine_7_body_classes');


/**
 * Returns no image url.
 *
 * @since  Magazine 7 1.0.0
 */
if (!function_exists('magazine_7_post_format')):
    function magazine_7_post_format($post_id)
    {
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                echo "<div class='em-post-format'><i class='far fa-image'></i></div>";
                break;
            case "video":
                echo "<div class='em-post-format'><i class='fas fa-film'></i></div>";

                break;
            case "gallery":
                echo "<div class='em-post-format'><i class='far fa-images'></i></div>";
                break;
            default:
                echo "";
        }


    }

endif;


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function magazine_7_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'magazine_7_pingback_header');


if (!function_exists('magazine_7_get_block')) :
    /**
     *
     * @since Magazine 7 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function magazine_7_get_block($block = 'grid')
    {

        get_template_part('inc/hooks/blocks/block-post', $block);

    }
endif;

if (!function_exists('magazine_7_archive_title')) :
    /**
     *
     * @since Magazine 7 1.0.0
     *
     * @param null
     * @return null
     *
     */

    function magazine_7_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

endif;
add_filter('get_the_archive_title', 'magazine_7_archive_title');

/* Display Breadcrumbs */
if (!function_exists('magazine_7_get_breadcrumb')) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function magazine_7_get_breadcrumb()
    {

        $enable_breadcrumbs = magazine_7_get_option('enable_breadcrumb');
        if (1 != $enable_breadcrumbs) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }


        if (!function_exists('breadcrumb_trail')) {

            /**
             * Load libraries.
             */

            require_once get_template_directory() . '/lib/breadcrumb-trail/breadcrumb-trail.php';
        }

        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        ); ?>


        <div class="em-breadcrumbs font-family-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php breadcrumb_trail($breadcrumb_args); ?>
                    </div>
                </div>
            </div>
        </div>


    <?php }

endif;
add_action('magazine_7_action_get_breadcrumb', 'magazine_7_get_breadcrumb');

/* Display Breadcrumbs */
if (!function_exists('magazine_7_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function magazine_7_excerpt_length($length)
    {
        return 15;
    }

endif;
add_filter('excerpt_length', 'magazine_7_excerpt_length', 999);


/* Display Breadcrumbs */
if (!function_exists('magazine_7_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function magazine_7_excerpt_more($more)
    {
        return '';
    }

endif;

add_filter('excerpt_more', 'magazine_7_excerpt_more');

// if (!is_admin()) {
//     function magazine_7_search_filter($query)
//     {
//         if ($query->is_search) {
//             $query->set('post_type', 'post');
//         }
//         return $query;
//     }

//     add_filter('pre_get_posts', 'magazine_7_search_filter');
// }

/* Display Pagination */
if (!function_exists('magazine_7_numeric_pagination')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function magazine_7_numeric_pagination()
    {

        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __( 'Previous', 'magazine-7' ),
            'next_text' => __( 'Next', 'magazine-7' ),
        ));
    }

endif;


//footer Link
define('MAGAZINE_7_CREDIT', 'https://afthemes.com/products/magazine-7');
if (!function_exists('magazine_7_credit')) {
    function magazine_7_credit()
    {
        return "<a href=" . esc_url(MAGAZINE_7_CREDIT) . " target='_blank'>Magazine 7</a>";
    }
}
