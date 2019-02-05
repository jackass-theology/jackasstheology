<?php
/**
 * Template use to render on the front end for single posts
 * - we start with the content context
 * tdb_state_template has a wp-query already, we only get in this template if a template is set, otherwise we load the
 * theme default template
 */
get_header();
global $wp_query;

// save the content wp_query - mainly for the top black bar for now and to revert back to it at the end of the template
tdb_state_content::set_wp_query($wp_query);

// set the global wp_query as the template one
$wp_query = tdb_state_template::get_wp_query();

the_post();

// run the template
?>
<div class="td-main-content-wrap td-container-wrap">
    <div class="tdc-content-wrap">
        <?php the_content(); ?>
    </div>
</div>
<?php

$wp_query = tdb_state_content::get_wp_query();
$wp_query->rewind_posts();

if ( have_posts() ) {
    // runs only when we have posts to avoid "Undefined offset 0" notice type error
    the_post();
}


get_footer();
