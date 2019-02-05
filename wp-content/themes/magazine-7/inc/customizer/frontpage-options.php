<?php

/**
 * Option Panel
 *
 * @package Magazine 7
 */

$default = magazine_7_get_default_theme_options();

/**
 * Frontpage options section
 *
 * @package Magazine 7
 */


// Add Frontpage Options Panel.
$wp_customize->add_panel('frontpage_option_panel',
    array(
        'title'      => esc_html__('Frontpage Options', 'magazine-7'),
        'priority'   => 199,
        'capability' => 'edit_theme_options',
    )
);


// Trending Posts Section.
$wp_customize->add_section('frontpage_trending_news_settings',
    array(
        'title'      => esc_html__('Trending Posts', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);

$wp_customize->add_setting('show_trending_news_section',
    array(
        'default'           => $default['show_trending_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_trending_news_section',
    array(
        'label'    => esc_html__('Enable Trending Posts Section', 'magazine-7'),
        'section'  => 'frontpage_trending_news_settings',
        'type'     => 'checkbox',
        'priority' => 22,

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_trending_news_category',
    array(
        'default'           => $default['select_trending_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Magazine_7_Dropdown_Taxonomies_Control($wp_customize, 'select_trending_news_category',
    array(
        'label'       => esc_html__('Trending Posts Category', 'magazine-7'),
        'description' => esc_html__('Select category to be shown on trending posts ', 'magazine-7'),
        'section'     => 'frontpage_trending_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => 'magazine_7_trending_news_section_status'
    )));




// Advertisement Section.
$wp_customize->add_section('frontpage_advertisement_settings',
    array(
        'title'      => esc_html__('Advertisement', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);



// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default'           => $default['banner_advertisement_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label'       => esc_html__('Banner Section Advertisement', 'magazine-7'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'magazine-7'), 1170, 90),
            'section'     => 'frontpage_advertisement_settings',
            'width' => 1170,
            'height' => 90,
            'flex_width' => true,
            'flex_height' => true,
            'priority'    => 120,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default'           => $default['banner_advertisement_section_url'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label'    => esc_html__('URL Link', 'magazine-7'),
        'section'  => 'frontpage_advertisement_settings',
        'type'     => 'text',
        'priority' => 130,
    )
);

/**
 * Main Banner Slider Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_main_banner_slider_settings',
    array(
        'title'      => esc_html__('Main Banner Slider Section', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('show_main_news_section',
    array(
        'default'           => $default['show_main_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_main_news_section',
    array(
        'label'    => esc_html__('Enable Main Banner Slider', 'magazine-7'),
        'section'  => 'frontpage_main_banner_slider_settings',
        'type'     => 'checkbox',
        'priority' => 22,

    )
);

// Setting - drop down category for slider.
$wp_customize->add_setting('select_slider_news_category',
    array(
        'default'           => $default['select_slider_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);


$wp_customize->add_control(new Magazine_7_Dropdown_Taxonomies_Control($wp_customize, 'select_slider_news_category',
    array(
        'label'       => esc_html__('Slider Posts Category', 'magazine-7'),
        'description' => esc_html__('Select category to be shown on slider ', 'magazine-7'),
        'section'     => 'frontpage_main_banner_slider_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 23,
        'active_callback' => 'magazine_7_slider_section_status'
    )));

/**
 * Featured News Section
 * */

// Main banner Sider Section.
$wp_customize->add_section('frontpage_featured_news_settings',
    array(
        'title'      => esc_html__('Featured Posts Section', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);

// Setting - show_featured_news_section.
$wp_customize->add_setting('show_featured_news_section',
    array(
        'default'           => $default['show_featured_news_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_featured_news_section',
    array(
        'label'    => esc_html__('Enable Featured New Section', 'magazine-7'),
        'section'  => 'frontpage_featured_news_settings',
        'type'     => 'checkbox',
        'priority' => 24,

    )
);



// Setting - featured_news_section_title.
$wp_customize->add_setting('featured_news_section_title',
    array(
        'default'           => $default['featured_news_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('featured_news_section_title',
    array(
        'label'    => esc_html__('Featured Posts Section Title', 'magazine-7'),
        'section'  => 'frontpage_featured_news_settings',
        'type'     => 'text',
        'priority' => 24,
        'active_callback' => 'magazine_7_featured_news_section_status'

    )
);

// Setting - featured_news_section_title.
$wp_customize->add_setting('featured_news_section_subtitle',
    array(
        'default'           => $default['featured_news_section_subtitle'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('featured_news_section_subtitle',
    array(
        'label'    => esc_html__('Featured Posts Section Subtitle', 'magazine-7'),
        'section'  => 'frontpage_featured_news_settings',
        'type'     => 'text',
        'priority' => 24,
        'active_callback' => 'magazine_7_featured_news_section_status'

    )
);

// Setting - featured news category.
$wp_customize->add_setting('select_featured_news_category',
    array(
        'default'           => $default['select_featured_news_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);

$wp_customize->add_control(new Magazine_7_Dropdown_Taxonomies_Control($wp_customize, 'select_featured_news_category',
    array(
        'label'       => esc_html__('Featured Posts Category', 'magazine-7'),
        'description' => esc_html__('Select category to be shown on featured section ', 'magazine-7'),
        'section'     => 'frontpage_featured_news_settings',
        'type'        => 'dropdown-taxonomies',
        'taxonomy'    => 'category',
        'priority'    => 24,
        'active_callback' => 'magazine_7_featured_news_section_status'
    )));

// Frontpage Layout Section.
$wp_customize->add_section('frontpage_layout_settings',
    array(
        'title'      => esc_html__('Frontpage Layout Settings', 'magazine-7'),
        'priority'   => 10,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);


// Setting - show_main_news_section.
$wp_customize->add_setting('frontpage_content_alignment',
    array(
        'default'           => $default['frontpage_content_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_select',
    )
);

$wp_customize->add_control( 'frontpage_content_alignment',
    array(
        'label'       => esc_html__('Frontpage Content alignment', 'magazine-7'),
        'description' => esc_html__('Select frontpage content alignment', 'magazine-7'),
        'section'     => 'frontpage_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Home Content - Home Sidebar', 'magazine-7' ),
            'align-content-right' => esc_html__( 'Home Sidebar - Home Content', 'magazine-7' ),
            'full-width-content' => esc_html__( 'Only Home Content', 'magazine-7' )
        ),
        'priority'    => 10,
    ));

//========== footer latest blog carousel options ===============

// Footer Section.
$wp_customize->add_section('frontpage_latest_posts_settings',
    array(
        'title'      => esc_html__('Latest Posts Options', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'frontpage_option_panel',
    )
);
// Setting - latest blog carousel.
$wp_customize->add_setting('frontpage_show_latest_posts',
    array(
        'default'           => $default['frontpage_show_latest_posts'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'frontpage_show_latest_posts',
    array(
        'label'    => __( 'Show Latest Posts Section on Frontpage', 'magazine-7' ),
        'section'  => 'frontpage_latest_posts_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);


// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_title',
    array(
        'default'           => $default['frontpage_latest_posts_section_title'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_latest_posts_section_title',
    array(
        'label'    => esc_html__('Latest Posts Section Title', 'magazine-7'),
        'section'  => 'frontpage_latest_posts_settings',
        'type'     => 'text',
        'priority' => 100,
        'active_callback' => 'magazine_7_latest_news_section_status'

    )
);

// Setting - featured_news_section_title.
$wp_customize->add_setting('frontpage_latest_posts_section_subtitle',
    array(
        'default'           => $default['frontpage_latest_posts_section_subtitle'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('frontpage_latest_posts_section_subtitle',
    array(
        'label'    => esc_html__('Featured Posts Section Subtitle', 'magazine-7'),
        'section'  => 'frontpage_latest_posts_settings',
        'type'     => 'text',
        'priority' => 100,
        'active_callback' => 'magazine_7_latest_news_section_status'

    )
);