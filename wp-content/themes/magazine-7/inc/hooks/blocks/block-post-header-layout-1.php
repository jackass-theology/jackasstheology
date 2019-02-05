<?php
/**
 * List block part for displaying header content in page.php
 *
 * @package Magazine 7
 */

?>
<div class="magazine-7-woocommerce-store-notice">
    <?php

    if( class_exists('WooCommerce') && is_woocommerce() ){
        woocommerce_demo_store();
    }

    ?>
</div>
<?php
if ((has_nav_menu('aft-top-nav')) || (has_nav_menu('aft-social-nav'))):
    ?>
    <div class="top-masthead">

        <div class="container">
            <div class="row">
                <?php
                $show_date = magazine_7_get_option('show_date_section');

                if (has_nav_menu('aft-top-nav') || ($show_date == true)): ?>
                    <div class="col-xs-12 col-sm-12 col-md-8 device-center">
                        <?php
                        if($show_date == true): ?>
                            <span class="topbar-date">
                                        <?php
                                        echo date_i18n('D. M jS, Y ', strtotime( date( "Y-m-d" )));
                                        ?>
                                    </span>

                        <?php endif; ?>

                        <?php if(has_nav_menu('aft-top-nav')){

                            wp_nav_menu(array(
                                'theme_location' => 'aft-top-nav',
                                'menu_id' => 'top-menu',
                                'depth' => 1,
                                'container' => 'div',
                                'container_class' => 'top-navigation'
                            ));
                        }

                        ?>
                    </div>
                <?php endif; ?>
                <?php
                $show_social_menu = magazine_7_get_option('show_social_menu_section');
                if (has_nav_menu( 'aft-social-nav' ) && $show_social_menu == true ): ?>
                    <div class="col-xs-12 col-sm-12 col-md-4 pull-right">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'aft-social-nav',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'menu_id' => 'social-menu',
                            'container' => 'div',
                            'container_class' => 'social-navigation'
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> <!--    Topbar Ends-->
<?php

endif;


?>
<header id="masthead" class="site-header">
    <?php
    $class = '';
    $background = '';
    if(has_header_image()){
        $class = 'data-bg';
        $background = get_header_image();
    }

    ?>
    <div class="masthead-banner <?php echo esc_attr($class); ?>" data-background="<?php echo esc_attr($background); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-branding">
                        <?php
                        the_custom_logo();
                        if (is_front_page() || is_home()) : ?>
                            <h1 class="site-title font-family-1">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </h1>
                        <?php else : ?>
                            <p class="site-title font-family-1">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            </p>
                        <?php endif; ?>

                        <?php
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <p class="site-description"><?php echo esc_html($description); ?></p>
                        <?php
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav id="site-navigation" class="main-navigation">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navigation-container">
                        <?php
                        $show_offcanvas = true;
                        if (is_active_sidebar('express-off-canvas-panel')): ?>
                            <span class="offcanvas">
                                     <a href="#offcanvasCollapse" class="offcanvas-nav">
                                           <div class="offcanvas-menu">
                                               <span class="mbtn-top"></span>
                                               <span class="mbtn-mid"></span>
                                               <span class="mbtn-bot"></span>
                                           </div>
                                       </a>
                                </span>
                        <?php endif; ?>

                        <div class="cart-search">
                            <?php if(class_exists('WooCommerce')): ?>
                                <div class="af-cart-wrapper dropdown">
                                    <?php magazine_7_woocommerce_header_cart(); ?>
                                </div>
                            <?php endif; ?>

                            <span class="af-search-click icon-search">
                                    <i class="fa fa-search"></i>
                            </span>

                        </div>
                        <span class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'magazine-7'); ?></span>
                                 <i class="ham"></i>
                            </span>

                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'aft-primary-nav',
                            'menu_id' => 'primary-menu',
                            'container' => 'div',
                            'container_class' => 'menu main-menu'
                        ));
                        ?>




                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<div id="af-search-wrap">
    <div class="af-search-box table-block">
        <div class="table-block-child v-center text-center">
            <?php get_search_form(); ?>
        </div>
    </div>
    <div class="af-search-close af-search-click">
        <span></span>
        <span></span>
    </div>
</div>

<?php if (is_front_page() || is_home() ) {
    do_action('magazine_7_action_banner_trending_posts');
    do_action('magazine_7_action_banner_advertisement');
    do_action('magazine_7_action_front_page');
}
?>





