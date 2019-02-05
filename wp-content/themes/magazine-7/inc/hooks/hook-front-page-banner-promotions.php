<?php
if (!function_exists('magazine_7_banner_advertisement')):
    /**
     * Ticker Slider
     *
     * @since Magazine 7 1.0.0
     *
     */
    function magazine_7_banner_advertisement()
    {

        if (('' != magazine_7_get_option('banner_advertisement_section')) ) { ?>
            <div class="banner-promotions-wrapper">
                <?php if (('' != magazine_7_get_option('banner_advertisement_section'))):

                    $magazine_7_banner_advertisement = magazine_7_get_option('banner_advertisement_section');
                    $magazine_7_banner_advertisement = absint($magazine_7_banner_advertisement);
                    $magazine_7_banner_advertisement = wp_get_attachment_image($magazine_7_banner_advertisement, 'full');
                    $magazine_7_banner_advertisement_url = magazine_7_get_option('banner_advertisement_section_url');
                    $magazine_7_banner_advertisement_url = isset($magazine_7_banner_advertisement_url) ? esc_url($magazine_7_banner_advertisement_url) : '#';

                    ?>
                    <div class="container">
                        <a href="<?php echo esc_url($magazine_7_banner_advertisement_url); ?>" target="_blank">
                            <?php echo $magazine_7_banner_advertisement; ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
            <!-- Trending line END -->
            <?php
        }
    }
endif;

add_action('magazine_7_action_banner_advertisement', 'magazine_7_banner_advertisement', 10);