<?php
/**
 * Template use to render on the front end for 404 pages
 * - we start with the content context
 * tdb_state_template has a wp-query already, we only get in this template if a template is set
 */
get_header();
global $wp_query;

    // set the global wp_query as the template one
    $wp_query = tdb_state_template::get_wp_query();

if ( have_posts() ) {

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

} else {

    /**
     * no posts to display. This function generates the __td('No posts to display').
     * the text can be overwritten by the template using the global @see td_global::$custom_no_posts_message
     */
    echo td_page_generator::no_posts();
}


get_footer();
