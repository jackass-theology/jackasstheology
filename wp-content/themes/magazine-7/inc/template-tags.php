<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Magazine 7
 */

if (!function_exists('magazine_7_post_categories')) :
    function magazine_7_post_categories($separator = '&nbsp')
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            global $post;


            $post_categories = get_the_category($post->ID);
            if ($post_categories) {
                $output = '<ul class="cat-links">';
                foreach ($post_categories as $post_category) {
                    $t_id = $post_category->term_id;
                    $color_id = "category_color_" . $t_id;

                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
                    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';

                    $output .='<li class="meta-category">
                             <a class="magazine-7-categories ' . esc_attr($color_class) . '" href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'magazine-7'), $post_category->name)) . '"> 
                                 ' . esc_html($post_category->name) . '
                             </a>
                        </li>';
                }
                $output .= '</ul>';
                echo $output;

            }
        }
    }
endif;

if (!function_exists('magazine_7_post_item_meta')) :

    function magazine_7_post_item_meta()
    {
        global $post;
        $author_id = $post->post_author;
        ?>

        <span class="author-links">

        <span class="item-metadata posts-author">
            <span class=""><?php _e('By', 'magazine-7'); ?></span>
            <a href="<?php echo esc_url(get_author_posts_url($author_id)) ?>">
                <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
            </a>
        </span>


            <span class="item-metadata posts-date">
            <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'magazine-7'); ?>
        </span>
        </span>
        <?php


    }
endif;


if (!function_exists('magazine_7_post_item_tag')) :

    function magazine_7_post_item_tag($view = 'default')
    {
        global $post;

        if ('post' === get_post_type()) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'magazine-7'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'magazine-7') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (is_single()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'magazine-7'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }

    }
endif;