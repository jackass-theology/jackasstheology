<?php
/**
 * Implement theme metabox.
 *
 * @package Magazine 7
 */

if (!function_exists('magazine_7_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function magazine_7_add_theme_meta_box()
    {

        $screens = array('post', 'page');

        foreach ($screens as $screen) {
            add_meta_box(
                'magazine-7-theme-settings',
                esc_html__('Layout Options', 'magazine-7'),
                'magazine_7_render_layout_options_metabox',
                $screen,
                'side',
                'low'


            );
        }

    }

endif;

add_action('add_meta_boxes', 'magazine_7_add_theme_meta_box');

if (!function_exists('magazine_7_render_layout_options_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function magazine_7_render_layout_options_metabox($post, $metabox)
    {

        $post_id = $post->ID;

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'magazine_7_meta_box_nonce');
        // Fetch Options list.
        $content_layout = get_post_meta($post_id, 'magazine-7-meta-content-alignment', true);

        if (empty($content_layout)) {
            $content_layout = magazine_7_get_option('global_content_alignment');
        }


        ?>
        <div id="magazine-7-settings-metabox-container" class="magazine-7-settings-metabox-container">
            <div id="magazine-7-settings-metabox-tab-layout">
                <div class="magazine-7-row-content">
                    <!-- Select Field-->
                    <p>

                        <select name="magazine-7-meta-content-alignment" id="magazine-7-meta-content-alignment">

                            <option value="align-content-left" <?php selected('align-content-left', $content_layout); ?>>
                                <?php _e('Content - Primary Sidebar', 'magazine-7') ?>
                            </option>
                            <option value="align-content-right" <?php selected('align-content-right', $content_layout); ?>>
                                <?php _e('Primary Sidebar - Content', 'magazine-7') ?>
                            </option>
                            <option value="full-width-content" <?php selected('full-width-content', $content_layout); ?>>
                                <?php _e('Full width content', 'magazine-7') ?>
                            </option>
                        </select>
                    </p>

                </div><!-- .magazine-7-row-content -->
            </div><!-- #magazine-7-settings-metabox-tab-layout -->
        </div><!-- #magazine-7-settings-metabox-container -->

        <?php
    }

endif;


if (!function_exists('magazine_7_save_layout_options_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function magazine_7_save_layout_options_meta($post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['magazine_7_meta_box_nonce']) || !wp_verify_nonce($_POST['magazine_7_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if (empty($_POST['post_ID']) || $_POST['post_ID'] != $post_id) {
            return;
        }

        // Check permission.
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $content_layout = isset($_POST['magazine-7-meta-content-alignment']) ? $_POST['magazine-7-meta-content-alignment'] : '';
        if (!empty($content_layout)) {
            update_post_meta($post_id, 'magazine-7-meta-content-alignment', sanitize_text_field($content_layout));
        }

    }

endif;

add_action('save_post', 'magazine_7_save_layout_options_meta', 10, 2);


if (!function_exists('magazine_7_taxonomy_add_new_meta_field')) :
// Add term page
    function magazine_7_taxonomy_add_new_meta_field()
    {
        // this will add the custom meta field to the add new term page

        $cat_color = array(
            'category-color-1' => __('Category Color 1', 'magazine-7'),
            'category-color-2' => __('Category Color 2', 'magazine-7'),
            'category-color-3' => __('Category Color 3', 'magazine-7'),

        );
        ?>
        <div class="form-field">
            <label for="term_meta[color_class_term_meta]"><?php _e('Color Class', 'magazine-7'); ?></label>
            <select id="term_meta[color_class_term_meta]" name="term_meta[color_class_term_meta]">
                <?php foreach ($cat_color as $key => $value): ?>
                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php _e('Select category color class. You can set appropriate categories color on "Categories" section of the theme customizer.', 'magazine-7'); ?></p>
        </div>
        <?php
    }
endif;
add_action('category_add_form_fields', 'magazine_7_taxonomy_add_new_meta_field', 10, 2);


if (!function_exists('magazine_7_taxonomy_edit_meta_field')) :
// Edit term page
    function magazine_7_taxonomy_edit_meta_field($term)
    {

        // put the term ID into a variable
        $t_id = $term->term_id;

        // retrieve the existing value(s) for this meta field. This returns an array
        $term_meta = get_option("category_color_$t_id");

        ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="term_meta[color_class_term_meta]"><?php _e('Color Class', 'magazine-7'); ?></label></th>
            <td>
                <?php
                $cat_color = array(
                    'category-color-1' => __('Category Color 1', 'magazine-7'),
                    'category-color-2' => __('Category Color 2', 'magazine-7'),
                    'category-color-3' => __('Category Color 3', 'magazine-7'),

                );
                ?>
                <select id="term_meta[color_class_term_meta]" name="term_meta[color_class_term_meta]">
                    <?php foreach ($cat_color as $key => $value): ?>
                        <option value="<?php echo esc_attr($key); ?>"<?php selected($term_meta['color_class_term_meta'], $key); ?> ><?php echo esc_html($value); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="description"><?php _e('Select category color class. You can set appropriate categories color on "Categories" section of the theme customizer.', 'magazine-7'); ?></p>
            </td>
        </tr>
        <?php
    }
endif;
add_action('category_edit_form_fields', 'magazine_7_taxonomy_edit_meta_field', 10, 2);


if (!function_exists('save_taxonomy_color_class_meta')) :
// Save extra taxonomy fields callback function.
    function save_taxonomy_color_class_meta($term_id)
    {
        if (isset($_POST['term_meta'])) {
            $t_id = $term_id;
            $term_meta = get_option("category_color_$t_id");
            $cat_keys = array_keys($_POST['term_meta']);
            foreach ($cat_keys as $key) {
                if (isset ($_POST['term_meta'][$key])) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option("category_color_$t_id", $term_meta);
        }
    }

endif;
add_action('edited_category', 'save_taxonomy_color_class_meta', 10, 2);
add_action('create_category', 'save_taxonomy_color_class_meta', 10, 2);