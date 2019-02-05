<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magazine_7_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Main Sidebar', 'magazine-7'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets for main sidebar.', 'magazine-7'),
        'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Off-canvas Panel', 'magazine-7'),
        'id'            => 'express-off-canvas-panel',
        'description'   => esc_html__('Add widgets for off-canvas panel.', 'magazine-7'),
        'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));



    register_sidebar(array(
        'name' => esc_html__('Front-page Content Section', 'magazine-7'),
        'id' => 'home-content-widgets',
        'description' => esc_html__('Add widgets to front-page contents section.', 'magazine-7'),
        'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Front-page Sidebar Section', 'magazine-7'),
        'id' => 'home-sidebar-widgets',
        'description' => esc_html__('Add widgets to front-page sidebar section.', 'magazine-7'),
        'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title widget-title-1"><span>',
        'after_title' => '</span></h2>',
    ));


        register_sidebar(array(
            'name' => esc_html__('Footer First Section', 'magazine-7'),
            'id' => 'footer-first-widgets-section',
            'description' => esc_html__('Displays items on footer first column.', 'magazine-7'),
            'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title widget-title-1">',
            'after_title' => '</h2>',
        ));


            register_sidebar(array(
                'name' => esc_html__('Footer Second Section', 'magazine-7'),
                'id' => 'footer-second-widgets-section',
                'description' => esc_html__('Displays items on footer second column.', 'magazine-7'),
                'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title widget-title-1">',
                'after_title' => '</h2>',
            ));

            register_sidebar(array(
                'name' => esc_html__('Footer Third Section', 'magazine-7'),
                'id' => 'footer-third-widgets-section',
                'description' => esc_html__('Displays items on footer third column.', 'magazine-7'),
                'before_widget' => '<div id="%1$s" class="widget magazine-7-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title widget-title-1">',
                'after_title' => '</h2>',
            ));



}

add_action('widgets_init', 'magazine_7_widgets_init');