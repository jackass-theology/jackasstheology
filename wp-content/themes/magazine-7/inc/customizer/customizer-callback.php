<?php
/**
 * Customizer callback functions for active_callback.
 *
 * @package Magazine 7
 */

/*select page for slider*/
if ( ! function_exists( 'magazine_7_frontpage_content_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_frontpage_content_status( $control ) {

        if ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;


    /*select page for trending news*/
if ( ! function_exists( 'magazine_7_trending_news_section_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_trending_news_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_trending_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

    /*select page for slider*/
if ( ! function_exists( 'magazine_7_slider_section_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_slider_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_main_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;


/*select page for slider*/
if ( ! function_exists( 'magazine_7_featured_news_section_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_featured_news_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'show_featured_news_section' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

/*select page for slider*/
if ( ! function_exists( 'magazine_7_latest_news_section_status' ) ) :

    /**
     * Check if ticker section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_latest_news_section_status( $control ) {

        if ( true == $control->manager->get_setting( 'frontpage_show_latest_posts' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;




/*select page for slider*/
if ( ! function_exists( 'magazine_7_archive_image_status' ) ) :

    /**
     * Check if archive no image is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_archive_image_status( $control ) {

        if ( 'archive-layout-list' == $control->manager->get_setting( 'archive_layout' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;



/*select page for slider*/
if ( ! function_exists( 'magazine_7_mailchimp_subscriptions_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_mailchimp_subscriptions_status( $control ) {

        if ( true == $control->manager->get_setting( 'footer_show_mailchimp_subscriptions' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

    /*select page for slider*/
if ( ! function_exists( 'magazine_7_footer_instagram_posts_status' ) ) :

    /**
     * Check if slider section page/post is active.
     *
     * @since 1.0.0
     *
     * @param WP_Customize_Control $control WP_Customize_Control instance.
     *
     * @return bool Whether the control is active to the current preview.
     */
    function magazine_7_footer_instagram_posts_status( $control ) {

        if ( true == $control->manager->get_setting( 'footer_show_instagram_post_carousel' )->value() ) {
            return true;
        } else {
            return false;
        }

    }

endif;

