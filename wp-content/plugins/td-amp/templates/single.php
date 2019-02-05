<?php
/**
 * Single view template.
 *
 */
?>

<?php require_once( 'html-start.php' ); ?>

<!-- header -->
<?php require_once( 'header.php' ); ?>

    <div class="td-container">

        <!-- header AD -->
    <?php echo td_ad_box_amp::render( array( 'spot_id' => 'tds_amp_header' )); ?>

    <?php td_global::load_single_post($this->post); ?>

    <?php

        if ( is_plugin_active( 'td-mobile-plugin/td-mobile-plugin.php' ) && class_exists('td_mobile_theme') && td_mobile_theme::is_mobile(true) ) {
            $td_mod_single = new td_module_single_mob($this->post);
        } else {
            $td_mod_single = new td_module_single($this->post);
        }

    ?>

        <!-- breadcrumbs -->
        <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs( $this->get( 'post_title' ) ); ?></div>

        <article id="post-<?php echo $this->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
            <header class="td-post-header">

                <?php require_once('categories.php'); ?>

                <?php echo $td_mod_single->get_title();?>

                <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                    <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle']; ?></p>
                <?php } ?>

                <div class="td-module-meta-info">
                    <?php echo $td_mod_single->get_author();?>
                    <?php echo $td_mod_single->get_date(false);?>
                    <?php echo $td_mod_single->get_comments();?>
                    <?php echo $td_mod_single->get_views();?>
                </div>
            </header>

            <!-- post featured video/image -->
            <?php require_once( 'featured-image.php' ); ?>

            <div class="td-post-content">

                <?php
                // post top socials
                echo $td_mod_single->get_social_sharing_top();
                // content top ad
                echo td_ad_box_amp::render( array( 'spot_id' => 'tds_amp_content_top' ));
                // post content
                echo $this->get( 'post_amp_content' ); // amphtml content
                // content bottom ad
                echo td_ad_box_amp::render( array( 'spot_id' => 'tds_amp_content_bottom' ));
                ?>
            </div>

            <footer class="td-post-footer">
                <?php echo $td_mod_single->get_review();?>
                <div class="td-post-source-tags">
                    <?php echo $td_mod_single->get_source_and_via();?>
                    <?php echo $td_mod_single->get_the_tags();?>
                </div>
                <?php echo $td_mod_single->get_social_sharing_bottom();?>
                <?php echo $td_mod_single->get_next_prev_posts();?>
                <?php echo $td_mod_single->get_item_scope_meta();?>
            </footer>

        </article>

        <!-- related articles -->
        <?php echo td_get_post_related_articles($this->post); ?>

        <!-- footer AD -->
        <?php echo td_ad_box_amp::render( array( 'spot_id' => 'tds_amp_footer_top' )); ?>

    </div>

<!-- comments -->
<?php require_once( 'comments.php' ); ?>

<!-- footer -->
<?php require_once( 'footer.php' ); ?>

<?php require_once( 'html-end.php' ); ?>