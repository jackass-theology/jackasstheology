<?php
/**
 * List block part for displaying page content in page.php
 *
 * @package Magazine 7
 */

?>
<header class="entry-header">
    <?php magazine_7_post_thumbnail(); ?>
    <?php 
    if(has_post_thumbnail()):
        if($aft_image_caption = get_post( get_post_thumbnail_id() )->post_excerpt): ?>
            <div class="aft-image-caption col-sm-12">
                <p>
                    <?php echo $aft_image_caption; ?>
                </p>
            </div>
    <?php 
        endif; 
    endif; 
    ?>
    <div class="header-details-wrapper">
        <div class="entry-header-details">
            <?php if ('post' === get_post_type()) : ?>
                <div class="figure-categories figure-categories-bg">
                    <?php echo magazine_7_post_format(get_the_ID()); ?>
                    <?php magazine_7_post_categories('/'); ?>
                </div>
            <?php endif; ?>
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            <?php magazine_7_post_item_meta(); ?>
            <?php if ('post' === get_post_type()) : ?>
            <?php if(has_excerpt()): ?>
                <div class="post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</header><!-- .entry-header -->