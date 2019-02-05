<?php
/**
 * Recommended plugins
 *
 * @package Magazine 7
 */

if ( ! function_exists( 'magazine_7_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function magazine_7_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'WP Post Author', 'magazine-7' ),
                'slug'     => 'wp-post-author',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Woo Product Showcase', 'magazine-7' ),
                'slug'     => 'woo-product-showcase',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'magazine-7' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),           
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'magazine_7_recommended_plugins' );
