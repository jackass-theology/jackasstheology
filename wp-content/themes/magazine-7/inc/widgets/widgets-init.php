<?php

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widgets-base.php';

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets-register-sidebars.php';

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets-common-functions.php';

/* Theme Widgets*/
require get_template_directory() . '/inc/widgets/widget-posts-carousel.php';
require get_template_directory() . '/inc/widgets/widget-posts-single-column.php';
require get_template_directory() . '/inc/widgets/widget-posts-double-column.php';
require get_template_directory() . '/inc/widgets/widget-posts-tabbed.php';
require get_template_directory() . '/inc/widgets/widget-social-contacts.php';
require get_template_directory() . '/inc/widgets/widget-author-info.php';
require get_template_directory() . '/inc/widgets/widget-products-list.php';


/* Register site widgets */
if ( ! function_exists( 'magazine_7_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function magazine_7_widgets() {

        register_widget( 'Magazine_7_Posts_Carousel' );
        register_widget( 'Magazine_7_Single_Col_Categorised_Posts' );
        register_widget( 'Magazine_7_Double_Col_Categorised_Posts' );
        register_widget( 'Magazine_7_Tabbed_Posts' );
        register_widget( 'Magazine_7_Social_Contacts' );
        register_widget( 'Magazine_7_author_info' );

        /**
         * Load WooCommerce compatibility file.
         */
        if ( class_exists( 'WooCommerce' ) ) {
            register_widget('Magazine_7_Products_List');
        }



    }
endif;
add_action( 'widgets_init', 'magazine_7_widgets' );
