<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magazine 7
 */

?>


<?php if (is_singular()) : ?>
    <div class="entry-content">
        <?php
        the_content(sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'magazine-7'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        )); ?>
        <?PHP if (is_single()): ?>
            <div class="post-item-metadata entry-meta">
                <?php magazine_7_post_item_tag(); ?>
            </div>
        <?php endif; ?>
        <?php
        the_post_navigation( array(
            'prev_text'                  => __( '<span class="em-post-navigation">Previous</span> %title', 'magazine-7' ),
            'next_text'                  => __( '<span class="em-post-navigation">Next</span> %title', 'magazine-7' ),
            'in_same_term'               => true,
            'taxonomy'                   => __( 'category', 'magazine-7' ),
            'screen_reader_text' => __( 'Continue Reading', 'magazine-7' ),
        ) );
        ?>
        <?php wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'magazine-7'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->


<?php else:
    $archive_class = magazine_7_get_option('archive_layout');

    if ($archive_class == 'archive-layout-grid'):
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-6 col-sm-6 col-md-6 latest-posts-grid'); ?>
                 data-mh="archive-layout-grid">
            <?php magazine_7_page_layout_blocks(); ?>
        </article>
    <?php else: ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('latest-posts-full col-sm-12'); ?>>
            <?php magazine_7_page_layout_blocks(); ?>
        </article>
    <?php endif; ?>
<?php endif; ?>
