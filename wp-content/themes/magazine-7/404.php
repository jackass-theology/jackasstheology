<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Magazine 7
 */

get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">

                        <section class="error-404 not-found">
                            <header class="header-title-wrapper">
                                <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'magazine-7'); ?></h1>
                            </header><!-- .header-title-wrapper -->

                            <div class="page-content">
                                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'magazine-7'); ?></p>

                                <?php
                                get_search_form();
                                the_widget('WP_Widget_Recent_Posts');
                                ?>
                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->

            </div>
        </div>
    </div>
<?php


get_footer();
