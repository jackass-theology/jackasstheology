<?php

/**
 * Returns posts.
 *
 * @since Magazine 7 1.0.0
 */
if(!function_exists('magazine_7_get_posts')):
    function magazine_7_get_posts($number_of_posts, $category = '0'){
        if(is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
    $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_of_posts),
            'paged' => $paged,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );


        if (absint($category) > 0) {
            $ins_args['cat'] = absint($category);
        }

        $all_posts = new WP_Query($ins_args);
        return $all_posts;
    }

endif;


/**
 * Returns all categories.
 *
 * @since Magazine 7 1.0.0
 */
if (!function_exists('magazine_7_get_terms')):
function magazine_7_get_terms( $category_id = 0, $taxonomy='category', $default='' ){
    $taxonomy = !empty($taxonomy) ? $taxonomy : 'category';

    if ( $category_id > 0 ) {
            $term = get_term_by('id', absint($category_id), $taxonomy );
            if($term)
                return esc_html($term->name);


    } else {
        $terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => true,
        ));


        if (isset($terms) && !empty($terms)) {
            foreach ($terms as $term) {
                if( $default != 'first' ){
                    $array['0'] = __('Select Category', 'magazine-7');
                }
                $array[$term->term_id] = esc_html($term->name);
            }

            return $array;
        }
    }
}
endif;

/**
 * Returns all categories.
 *
 * @since Magazine 7 1.0.0
 */
if (!function_exists('magazine_7_get_terms_link')):
function magazine_7_get_terms_link( $category_id = 0 ){

    if (absint($category_id) > 0) {
        return get_term_link(absint($category_id), 'category');
    } else {
        return get_post_type_archive_link('post');
    }
}
endif;

/**
 * Returns word count of the sentences.
 *
 * @since Magazine 7 1.0.0
 */
if (!function_exists('magazine_7_get_excerpt')):
    function magazine_7_get_excerpt($length = 25, $magazine_7_content = null, $post_id = 1) {
        $length          = absint($length);
        $source_content  = preg_replace('`\[[^\]]*\]`', '', $magazine_7_content);
        $trimmed_content = wp_trim_words($source_content, $length, '...');
        return $trimmed_content;
    }
endif;

/**
 * Returns no image url.
 *
 * @since Magazine 7 1.0.0
 */
if(!function_exists('magazine_7_no_image_url')):
    function magazine_7_no_image_url(){
        $url = get_template_directory_uri().'/assets/images/no-image.png';
        return $url;
    }

endif;

/**
 * Returns no image url.
 *
 * @since Magazine 7 1.0.0
 */
if(!function_exists('magazine_7_post_format')):
    function magazine_7_post_format($post_id){
        $post_format = get_post_format($post_id);
        switch ($post_format) {
            case "image":
                echo "<div class='m7-post-format'><i class='far fa-image'></i></div>";
                break;
            case "video":
                echo "<div class='m7-post-format'><i class='fas fa-film'></i></div>";

                break;
            case "gallery":
                echo "<div class='m7-post-format'><i class='far fa-images'></i></div>";
                break;
            default:
                echo "";
        }


    }

endif;



/**
 * Outputs the tab posts
 *
 * @since 1.0.0
 *
 * @param array $args  Post Arguments.
 */
if (!function_exists('magazine_7_render_posts')):
  function magazine_7_render_posts( $type, $show_excerpt, $excerpt_length, $number_of_posts, $category = '0' ){

    $args = array();
   
    switch ($type) {
        case 'popular':
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => absint($number_of_posts),
                'orderby' => 'comment_count',
            );
            break;

        case 'recent':
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => absint($number_of_posts),
                'orderby' => 'date',
            );
            break;

        case 'categorised':
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => absint($number_of_posts),
            );
            $category = isset($category) ? $category : '0';
            if (absint($category) > 0) {
                $args['cat'] = absint($category);
            }
            break;


        default:
            break;
    }

    if( !empty($args) && is_array($args) ){
        $all_posts = new WP_Query($args);
        if($all_posts->have_posts()):
            echo '<ul class="article-item article-list-item article-tabbed-list article-item-left">';
            while($all_posts->have_posts()): $all_posts->the_post();

                ?>
                <li class="full-item clearfix">
                    <div class="base-border">
                        <div class="align-items-center">
                            <?php
                            if(has_post_thumbnail()){
                                $url = get_the_post_thumbnail_url( get_the_ID(), 'magazine-7-medium-square' );
                                $col_class = 'col-six';
                            }else {
                                $url = '';
                                $col_class = 'col-ten';
                            }

                            global $post;
                            ?>
                            <?php if (!empty($url)): ?>
                                <div class="col col-four col-image">
                                    <div class="tab-article-image row">
                                        <a href="<?php the_permalink(); ?>" class="post-thumb">
                                            <img src="<?php echo esc_url($url); ?>"/>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="full-item-details col col-details <?php echo esc_attr($col_class); ?>">
                                <div class="row prime-row">
                                <div class="full-item-metadata primary-font">
                                    <div class="figure-categories figure-categories-bg">
                                        <?php echo magazine_7_post_format($post->ID); ?>
                                        <?php magazine_7_post_categories('/'); ?>
                                    </div>
                                </div>
                                <div class="full-item-content">
                                    <h3 class="article-title article-title-2">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <div class="grid-item-metadata">
                                        <?php echo ''; ?>
                                        <?php magazine_7_post_item_meta(); ?>

                                    </div>
                                    <?php

                                    if ($show_excerpt == 'true'): ?>
                                        <div class="full-item-discription">
                                            <div class="post-description">
                                                <?php if (absint($excerpt_length) > 0) : ?>
                                                    <?php
                                                    $excerpt = magazine_7_get_excerpt($excerpt_length, get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php
            endwhile;wp_reset_postdata();
            echo '</ul>';
        endif;
    }
}
endif;