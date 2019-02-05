<?php
if (!function_exists('magazine_7_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since Magazine 7 1.0.0
     *
     */
    function magazine_7_banner_slider()
    {


        $global_content_layout = magazine_7_get_option('global_content_layout');

        $m7_enable_main_slider = magazine_7_get_option('show_main_news_section');
        $m7_slider_category = magazine_7_get_option('select_slider_news_category');
        $m7_number_of_slides = 5;


        $section_class = 'default-section-slider';
        $slider_mode = 'default-slider-mode';
        $thumb_size = 'magazine-7-slider-center';
        $container = 'container-full-width';

        if ($global_content_layout == 'default-content-layout') {

            $container = 'container';
        }


        $m7_featured_category = magazine_7_get_option('select_featured_news_category');
        $m7_number_of_featured_news = magazine_7_get_option('number_of_featured_news');

        ?>

        <section class="af-blocks">
            <?php if ($m7_enable_main_slider): ?>
                <div class="container-full-width af-main-banner <?php echo esc_attr($section_class); ?>">
                    <div class="main-slider <?php echo esc_attr($slider_mode); ?>">

                        <?php
                        $slider_posts = magazine_7_get_posts($m7_number_of_slides, $m7_slider_category);


                        if ($slider_posts->have_posts()) :
                            while ($slider_posts->have_posts()) : $slider_posts->the_post();
                                if (has_post_thumbnail()) {


                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $thumb_size);
                                    $url = $thumb['0'];
                                } else {
                                    $url = '';
                                }
                                global $post;

                                ?>
                                <figure class="slick-item">
                                    <div class="data-bg data-bg-hover data-bg-hover data-bg-slide"
                                         data-background="<?php echo esc_url($url); ?>">
                                        <a class="aft-slide-items" href="<?php the_permalink(); ?>"></a>
                                        <figcaption class="slider-figcaption slider-figcaption-1">
                                            <div class="figure-categories figure-categories-bg">

                                                <?php echo magazine_7_post_format($post->ID); ?>
                                                <?php magazine_7_post_categories(); ?>
                                            </div>
                                            <div class="title-heading">
                                                <h3 class="article-title slide-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                            </div>
                                            <div class="grid-item-metadata grid-item-metadata-1">
                                                <?php magazine_7_post_item_meta(); ?>
                                            </div>
                                        </figcaption>
                                    </div>
                                </figure>
                            <?php
                            endwhile;
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>


                </div>
            <?php endif; ?>


            <div class="<?php echo esc_attr($container); ?>">
                <?php

                $m7_enable_featured_news = magazine_7_get_option('show_featured_news_section');
                if ($m7_enable_featured_news):

                    $m7_featured_news_title = magazine_7_get_option('featured_news_section_title');
                    $m7_featured_news_subtitle = magazine_7_get_option('featured_news_section_subtitle');


                    ?>

                    <div class="af-main-banner-featured-posts">
                                <div class="widget-title-section">
                                    <?php if (!empty($m7_featured_news_title)): ?>
                                        <h2 class="section-title"><?php echo esc_html($m7_featured_news_title); ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($m7_featured_news_subtitle)): ?>
                                        <p class="section-subtitle"><?php echo esc_html($m7_featured_news_subtitle); ?></p>
                                    <?php endif; ?>
                                </div>

                        <div class="featured-posts-grid">
                            <div class="row">

                                <?php

                                $featured_posts = magazine_7_get_posts($m7_number_of_featured_news, $m7_featured_category);
                                if ($featured_posts->have_posts()) :
                                    while ($featured_posts->have_posts()) :
                                        $featured_posts->the_post();
                                        if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'magazine-7-medium-square');
                                            $url = $thumb['0'];
                                        } else {
                                            $url = '';
                                        }
                                        global $post;
                                        ?>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="spotlight-post" data-mh="banner-height">
                                                <figure class="featured-article">
                                                    <div class="featured-article-wrapper">
                                                        <div class="data-bg data-bg-hover data-bg-hover data-bg-featured"
                                                             data-background="<?php echo esc_url($url); ?>">
                                                            <a href="<?php the_permalink(); ?>"></a>
                                                        </div>
                                                    </div>
                                                </figure>
                                                <div class="figure-categories figure-categories-bg">
                                                    <?php echo magazine_7_post_format($post->ID); ?>
                                                    <?php magazine_7_post_categories(); ?>
                                                </div>
                                                <figcaption>

                                                    <div class="title-heading">
                                                        <h3 class="article-title article-title-1">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h3>
                                                    </div>
                                                    <div class="grid-item-metadata">
                                                        <?php magazine_7_post_item_meta(); ?>
                                                    </div>

                                                </figcaption>
                                            </div>
                                        </div>

                                    <?php endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('magazine_7_action_front_page', 'magazine_7_banner_slider', 40);