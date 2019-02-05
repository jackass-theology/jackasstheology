<?php
/**
 * Template use to view the template (When you click view on the template in wp-admin)
 * - we start with the template context and we don't have a content context
 */
get_header();
global $wp_query;


if ( have_posts() ) {

    tdb_state_template::set_wp_query($wp_query);

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
