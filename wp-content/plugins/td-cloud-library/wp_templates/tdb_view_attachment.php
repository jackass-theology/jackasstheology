<?php
/**
 * Template use to render on the front end for attachment pages
 * - we start with the content context
 * tdb_state_template has a wp-query already, we only get in this template if a template is set, otherwise we load the
 * theme default template
 */
get_header();
global $wp_query;

if ( have_posts() ) {

    // save the content wp_query - mainly for the top black bar for now and to revert back to it at the end of the template
    tdb_state_content::set_wp_query($wp_query);

    $wp_query = tdb_state_template::get_wp_query(); // set the global wp_query as the template one

    while ( have_posts() ) : the_post();

        // run the template
        ?>
        <div class="td-main-content-wrap td-container-wrap">
            <div class="tdc-content-wrap">
                <?php the_content(); ?>
            </div>
        </div>
        <?php

    endwhile; //end loop

    $wp_query = tdb_state_content::get_wp_query();
    $wp_query->rewind_posts();
    the_post();

} else {

    /**
     * no posts to display. This function generates the __td('No posts to display').
     * the text can be overwritten by the template using the global @see td_global::$custom_no_posts_message
     */
    echo td_page_generator::no_posts();
}


get_footer();
