<?php
/**
 * Template use to render on the front end for single posts
 * - we start with the content context
 * tdb_state_template has a wp-query already, we only get in this template if a template is set, otherwise we load the
 * theme default template
 */
get_header();
global $wp_query, $tdb_state_single;

if ( have_posts() ) {

    // save the content wp_query - mainly for the top black bar for now and to revert back to it at the end of the template
    tdb_state_content::set_wp_query($wp_query);

    $post_item_scope = '';
    $post_item_scope_meta = '';

    td_global::load_single_post( $post );

    if (!tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe()) {

        // increment the views counter
        td_page_views::update_page_views($post->ID);

        // get the post item scope
        $post_item_scope = $tdb_state_single->post_item_scope->__invoke();

        // get the post item scope meta
        $post_item_scope_meta = $tdb_state_single->post_item_scope_meta->__invoke();

    }

    $wp_query = tdb_state_template::get_wp_query(); // set the global wp_query as the template one

    while ( have_posts() ) : the_post();

        ?>
        <div class="td-main-content-wrap td-container-wrap">
            <div class="tdc-content-wrap">
                <article id="post-<?php the_ID() ?>" <?php post_class(); ?> <?php echo $post_item_scope ?> >

                    <?php the_content(); ?>
                    <?php echo $post_item_scope_meta ?>

                </article>
            </div>
        </div>
        <?php

    endwhile;

    // revert the content wp_query
    $wp_query = tdb_state_content::get_wp_query();
    $wp_query->rewind_posts();
    the_post();

} else {

    /**
     * no posts to display. This function generates the __td('No posts to display').
     * the text can be overwritten by the template using the global @see td_global::$custom_no_posts_message
     */
    echo td_page_generator::no_posts(); //@todo trebuie facut ceva intern
}


get_footer();
