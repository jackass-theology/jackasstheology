<?php
if ( ! function_exists( 'magazine_7_front_page_widgets_section' ) ) :
    /**
     *
     * @since Magazine 7 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function magazine_7_front_page_widgets_section() {
        ?>
        <!-- Main Content section -->
        <?php

                $frontpage_layout = magazine_7_get_option('frontpage_content_alignment');

        ?>
        <?php if ( is_active_sidebar( 'home-content-widgets') || is_active_sidebar( 'home-sidebar-widgets') ) {  ?>
            <section class="section-block-upper">

                <div class="container">
                <div id="primary" class="content-area">

                    <main id="main" class="site-main">
                        <?php dynamic_sidebar('home-content-widgets'); ?>
                        <?php
                        if (1 == magazine_7_get_option('frontpage_show_latest_posts')) {
                            magazine_7_get_block('latest');
                        }
                        ?>
                    </main>
                </div>
                <?php if (is_active_sidebar( 'home-sidebar-widgets') && $frontpage_layout != 'full-width-content' ) { ?>
                <div id="secondary" class="sidebar-area">
                    <aside class="widget-area">
                        <div class="theiaStickySidebar">
                            <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                        </div>
                    </aside>
                </div>
                <?php } ?>
                </div>
            </section>
        <?php }
    }
endif;
add_action( 'magazine_7_front_page_section', 'magazine_7_front_page_widgets_section', 50 );