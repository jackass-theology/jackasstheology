<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magazine 7
 */
$archive_class = magazine_7_get_option('archive_layout');
if ($archive_class == 'archive-layout-grid'):
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-6 col-sm-6 col-md-6 archive-layout-grid'); ?> data-mh="archive-layout-grid">
        <?php magazine_7_page_layout_blocks(); ?>
    </article>
<?php else: ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12'); ?>>
        <?php magazine_7_page_layout_blocks(); ?>
    </article>
<?php endif; ?>

