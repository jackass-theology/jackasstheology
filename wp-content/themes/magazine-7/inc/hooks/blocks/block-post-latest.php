<?php
/**
 * List block part for displaying latest posts in footer.php
 *
 * @package Magazine 7
 */

$m7_latest_posts_title = magazine_7_get_option('frontpage_latest_posts_section_title');
$m7_latest_posts_subtitle = magazine_7_get_option('frontpage_latest_posts_section_subtitle');
$number_of_posts = 6;
$all_posts = magazine_7_get_posts($number_of_posts);
?>
<div class="af-main-banner-latest-posts">
    <div class="widget-title-section">
        <?php if (!empty($m7_latest_posts_title)): ?>
            <h2 class="section-title"><?php echo esc_html($m7_latest_posts_title); ?></h2>
        <?php endif; ?>
        <?php if (!empty($m7_latest_posts_subtitle)): ?>
            <p class="section-subtitle"><?php echo esc_html($m7_latest_posts_subtitle); ?></p>
        <?php endif; ?>
    </div>
    <div class="row">
    <?php
    if ($all_posts->have_posts()) :
        while ($all_posts->have_posts()) : $all_posts->the_post();
            if (has_post_thumbnail()) {
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'magazine-7-medium-square');
                $url = $thumb['0'];
            } else {
                $url = '';
            }
            global $post;

            ?>
            <div class="col-sm-4 latest-posts-grid" data-mh="latest-posts-grid">
                <div class="spotlight-post">
                    <figure class="categorised-article">
                        <div class="categorised-article-wrapper">
                            <div class="data-bg data-bg-hover data-bg-categorised"
                                 data-background="<?php echo esc_url($url); ?>">
                                <a href="<?php the_permalink(); ?>"></a>
                            </div>
                        </div>
                    </figure>

                    <figcaption>
                        <div class="figure-categories figure-categories-bg">
                            <?php echo magazine_7_post_format($post->ID); ?>
                            <?php magazine_7_post_categories('/'); ?>
                        </div>
                        <h3 class="article-title article-title-2">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="grid-item-metadata">
                            <?php magazine_7_post_item_meta(); ?>
                        </div>
                    </figcaption>
                </div>
            </div>
        <?php
        endwhile; ?>
    <?php
    endif;
    wp_reset_postdata();
    ?>
</div>
</div>
