<?php
/**
 * The template for displaying home page.
 * Template Name: Front-page Template
 * @package Magazine 7
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

    /**
     * magazine_7_action_sidebar_section hook
     * @since Magazine 7 1.0.0
     *
     * @hooked magazine_7_front_page_section -  20
     * @sub_hooked magazine_7_front_page_section -  20
     */
    do_action('magazine_7_front_page_section');

}
get_footer();