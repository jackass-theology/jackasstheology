<?php


/**
 * Add custom columns on wp-admin cpt list
 */
add_filter('manage_tdb_templates_posts_columns', function($columns) {
    $date = $columns['date'];
    unset($columns['date']);
    $columns['tdb_template_type'] = 'Template Type';
    $columns['tdb_used_on'] = 'Used On';
    $columns['date'] = $date;

    return $columns;
});


/**
 * Add custom data to the columns on wp-admin cpt list
 */
add_action('manage_tdb_templates_posts_custom_column' , function($column, $post_id) {

    $tdb_template_type = get_post_meta($post_id, 'tdb_template_type', true);

    switch( $column ) {

        case 'tdb_template_type':

            $args = array(
                'post_type'  => 'tdb_templates',
                'meta_key'   => 'tdb_template_type',
                'meta_value' => $tdb_template_type
            );

            $url = add_query_arg( $args, 'edit.php' );

            echo sprintf( '<a href="%s">%s</a>', esc_url( $url ), $tdb_template_type );

            break;

        case 'tdb_used_on':

            $items_to_display = array();
            $tdb_template_id = 'tdb_template_' . $post_id;

            /*
             * template types
             * 'single', 'category', 'author', 'search', 'date', 'tag', 'attachment', '404'
             */
            switch ( $tdb_template_type ) {

                case 'single':

                    // read the global single template
                    $tdb_single_template = td_util::get_option( 'td_default_site_post_template' );

                    // for global single post templates
                    if ( $tdb_template_id === $tdb_single_template ) {
                        $items_to_display[] = sprintf( '<a href="%s" title="Change this global ' . $tdb_template_type . ' post template from the theme panel." target="_blank">All Posts</a>', esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-post-settings/box=default_post_template_site_wide') ) );
                    }

                    // get all published posts
                    $posts = get_posts(
                        array(
                            'post_status' => 'publish',
                            'numberposts' => -1
                        )
                    );

                    // for individual single post templates
                    foreach ( $posts as $post ) {

                        // read the individual single post settings
                        $tdb_post_theme_settings = td_util::get_post_meta_array($post->ID, 'td_post_theme_settings');

                        if ( !empty( $tdb_post_theme_settings['td_post_template'] ) and $tdb_template_id === $tdb_post_theme_settings['td_post_template'] ) {
                            $items_to_display[] = sprintf(
                                '<a href="%s" title="Change this individual ' . $tdb_template_type . ' post template from the `Post Settings` section." target="_blank">%s</a>',
                                get_edit_post_link( $post->ID ),
                                $post->post_title
                            );
                        }
                    }

                    break;

                case 'category':

                    // read the global categories template
                    $tdb_category_template = td_options::get( 'tdb_category_template' );

                    // for global category templates
                    if ( $tdb_template_id === $tdb_category_template ) {
                        $items_to_display[] = sprintf( '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">All Categories</a>', esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-categories') ) );
                    }

                    // get all categories
                    $categories = get_categories(
                        array(
                            'hide_empty' => false
                        )
                    );

                    // for individual category templates
                    foreach ( $categories as $category ) {

                        // read the individual cat template
                        $tdb_individual_category_template = td_util::get_category_option( $category->cat_ID, 'tdb_category_template' );

                        if ( $tdb_template_id === $tdb_individual_category_template ) {
                            $items_to_display[] = sprintf(
                                '<a href="%s" title="Change this individual ' . $tdb_template_type . ' template from the theme panel." target="_blank">%s</a>',
                                esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-categories/box=category_individual_settings_cat_' . $category->cat_ID ) ),
                                $category->name
                            );
                        }
                    }

                    break;

                case 'author':

                    // read the global author template
                    $tdb_author_template = td_options::get( 'tdb_author_template' );

                    // for global author templates
                    if ( $tdb_template_id === $tdb_author_template ) {
                        $items_to_display[] = sprintf( '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">All Authors</a>', esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=author_template') ) );
                    }

                    // for individual author templates
                    foreach ( get_users() as $user ) {

                        // username
                        $username = '';
                        if ( $user->first_name && $user->last_name ) {
                            $username .= "$user->first_name $user->last_name";
                        } elseif ( $user->first_name ) {
                            $username .= $user->first_name;
                        } elseif ( $user->last_name ) {
                            $username .= $user->last_name;
                        } else {
                            $username .= $user->user_login;
                        }

                        // user templates
                        $tdb_author_templates = td_util::get_option('tdb_author_templates');

                        // read the individual author template
                        $tdb_individual_author_template = isset( $tdb_author_templates[$user->ID] ) ? $tdb_author_templates[$user->ID] : '';

                        if ( !empty( $tdb_individual_author_template ) and $tdb_template_id === $tdb_individual_author_template ) {
                            $items_to_display[] = sprintf(
                                '<a href="%s" title="Change this `' . $username . '` individual ' . $tdb_template_type . ' template from the theme panel."  target="_blank">%s</a>',
                                esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=author_template' ) ),
                                $username
                            );
                        }
                    }

                    break;

                case 'search':

                    // read the global search template
                    $tdb_search_template = td_options::get( 'tdb_search_template' );

                    if ( $tdb_template_id === $tdb_search_template ) {
                        $items_to_display[] = sprintf(
                            '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">Site</a>',
                            esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=search_template' ) )
                        );
                    }

                    break;

                case 'date':

                    // read the global date template
                    $tdb_date_template = td_options::get( 'tdb_date_template' );

                    if ( $tdb_template_id === $tdb_date_template ) {
                        $items_to_display[] = sprintf(
                            '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">Site</a>',
                            esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=archive_template' ) )
                        );
                    }

                    break;

                case 'tag':

                    // read the global tag template
                    $tdb_tag_template = td_options::get( 'tdb_tag_template' );

                    if ( $tdb_template_id === $tdb_tag_template ) {
                        $items_to_display[] = sprintf(
                            '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">Site</a>',
                            esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=tag_template' ) )
                        );
                    }

                    break;

                case 'attachment':

                    // read the global attachment template
                    $tdb_attachment_template = td_options::get( 'tdb_attachment_template' );

                    if ( $tdb_template_id === $tdb_attachment_template ) {
                        $items_to_display[] = sprintf(
                            '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">Site</a>',
                            esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=attachment_template' ) )
                        );
                    }

                    break;

                case '404':

                    // read the global 404 template
                    $tdb_404_template = td_options::get( 'tdb_404_template' );

                    if ( $tdb_template_id === $tdb_404_template ) {
                        $items_to_display[] = sprintf(
                            '<a href="%s" title="Change this global ' . $tdb_template_type . ' template from the theme panel." target="_blank">Site</a>',
                            esc_url( admin_url('admin.php?page=td_theme_panel#td-panel-template-settings/box=404_template' ) )
                        );
                    }

                    break;

            }

            // point to end of the array
            end( $items_to_display );

            // the last element of the array.
            $last_element = key( $items_to_display );

            if ( ! empty( $items_to_display ) ) {
                foreach ( $items_to_display as $item_index => $item ) {
                    if ( $item_index == $last_element ) {
                        echo $item;
                    } else {
                        echo $item . ', ';
                    }
                }
            } else {
                echo '—';
            }

            break;

    }

}, 10, 2 );


/**
 * add sorting support on wp-admin cpt list
 */
add_filter('manage_edit-tdb_templates_sortable_columns', function ( $columns ) {
    $columns['tdb_template_type'] = 'tdb_template_type';
    return $columns;
});

/**
 * add filter support on wp-admin cpt list
 */
add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts($post_type) {

    // only display these taxonomy filters on desired custom post_type listings
    if ( $post_type == 'tdb_templates' ) {

        // output html for templates type dropdown filter
        echo '<select name="template_type" id="template_type" class="postform">';
        echo "<option value=''>Show All Types</option>";

        $filters = array(
            'single',
            '404',
            'attachment',
            'author',
            'category',
            'date',
            'search',
            'tag'
        );

        foreach ( $filters as $template_type ) {

            $selected = isset($_GET['template_type'])? $_GET['template_type'] : null;
            $template_name = ucfirst($template_type);

            // output each select option line, check against the last $_GET to show the current option selected
            echo '<option value='. $template_type, $selected == $template_type ? ' selected="selected"' : '','>' . $template_name .'</option>';

        }

        echo "</select>";
    }
}

/**
 * change the links for each item on wp-admin cpt list
 */
add_filter('page_row_actions', function ($actions, $post) {
    global $current_screen;
    if (!empty($current_screen) && $current_screen->post_type != 'tdb_templates') {
        return $actions;
    }

    $tdb_template_type = get_post_meta($post->ID, 'tdb_template_type', true);

    // remove the default td-composer edit
    unset($actions['edit_tdc_composer']);

    $actions = array_merge(
        array(
            'edit_tdc_composer' => '<a href="' . admin_url( 'post.php?post_id=' . $post->ID . '&td_action=tdc&tdbTemplateType=' . $tdb_template_type . '&prev_url='  . rawurlencode(tdc_util::get_current_url() ) ) . '">Edit template</a>'
        ),
        $actions
    );

    $actions['duplicate'] = '<a data-post-id="' . $post->ID . '" data-template-type="' . $tdb_template_type . '" data-template-name="' . get_the_title( $post->ID ) . '" class="tdb-duplicate-template" href="#" title="Duplicate this template." >Duplicate</a><span class="tdb-working-prompt">Working...</span>';

    unset($actions['inline hide-if-no-js']); // hide quick edit

    return $actions;
}, 11, 2 );

