<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazine 7
 */

get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">

                        <?php
                        while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-content-wrap">
                                    <?php magazine_7_get_block('header'); ?>
                                    <?php

                                    get_template_part('template-parts/content', get_post_type());


                                    ?>
                                </div>
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template.
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;

                                if ('post' === get_post_type()) :
                                    magazine_7_get_block('related');
                                endif;
                                ?>
                            </article>
                        <?php

                        endwhile; // End of the loop.
                        ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
                <?php ?>
                <?php
                get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php
get_footer();
