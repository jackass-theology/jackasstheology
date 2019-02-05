<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Magazine 7
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses magazine_7_header_style()
 */
function magazine_7_custom_header_setup()
{
    add_theme_support('custom-header', apply_filters('magazine_7_custom_header_args', array(
        'default-image' => '',
        'default-text-color' => '000000',
        'width' => 1900,
        'height' => 600,
        'flex-height' => true,
        'wp-head-callback' => 'magazine_7_header_style',
    )));
}

add_action('after_setup_theme', 'magazine_7_custom_header_setup');

if (!function_exists('magazine_7_header_style')) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see magazine_7_custom_header_setup().
     */
    function magazine_7_header_style()
    {
        $header_image_tint_overlay = magazine_7_get_option('disable_header_image_tint_overlay');

        $site_title_font_size = magazine_7_get_option('site_title_font_size');
        $header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
         */
//        if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
//            return;
//        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php

            if($header_image_tint_overlay):
                ?>
            body .masthead-banner.data-bg:before {
                background: rgba(0,0,0,0);
            }
            <?php
            endif;

            // Has the text been hidden?
            if ( ! display_header_text() ) :
            ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }

            <?php
                // If the user has set a custom color for the text use that.
                else :
            ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            .site-branding .site-title {
                font-size: <?php echo esc_attr( $site_title_font_size ); ?>px;
            }

            @media only screen and (max-width: 640px) {
                .site-branding .site-title {
                    font-size: 60px;

                }

            @media only screen and (max-width: 640px) {
                .site-branding .site-title {
                    font-size: 50px;

                }

            <?php endif; ?>


        </style>
        <?php
    }
endif;
