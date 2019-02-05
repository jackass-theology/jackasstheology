<?php

/**
 * Option Panel
 *
 * @package Magazine 7
 */

$default = magazine_7_get_default_theme_options();
/*theme option panel info*/
require get_template_directory().'/inc/customizer/frontpage-options.php';


// Add Theme Options Panel.
$wp_customize->add_panel('theme_option_panel',
	array(
		'title'      => esc_html__('Theme Options', 'magazine-7'),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);


// Preloader Section.
$wp_customize->add_section('site_preloader_settings',
    array(
        'title'      => esc_html__('Preloader Options', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - preloader.
$wp_customize->add_setting('enable_site_preloader',
    array(
        'default'           => $default['enable_site_preloader'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_site_preloader',
    array(
        'label'    => esc_html__('Enable preloader', 'magazine-7'),
        'section'  => 'site_preloader_settings',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);


/**
 * Header section
 *
 * @package Magazine 7
 */

// Frontpage Section.
$wp_customize->add_section('header_options_settings',
	array(
		'title'      => esc_html__('Header Options', 'magazine-7'),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);




// Setting - show_site_title_section.
$wp_customize->add_setting('show_date_section',
    array(
        'default'           => $default['show_date_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_date_section',
    array(
        'label'    => esc_html__('Show date on top header', 'magazine-7'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 10,
        //'active_callback' => 'magazine_7_top_header_status'
    )
);



// Setting - show_site_title_section.
$wp_customize->add_setting('show_social_menu_section',
    array(
        'default'           => $default['show_social_menu_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control('show_social_menu_section',
    array(
        'label'    => esc_html__('Show social menu on top header', 'magazine-7'),
        'section'  => 'header_options_settings',
        'type'     => 'checkbox',
        'priority' => 11,
        //'active_callback' => 'magazine_7_top_header_status'
    )
);


// Breadcrumb Section.
$wp_customize->add_section('site_breadcrumb_settings',
    array(
        'title'      => esc_html__('Breadcrumb Options', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

// Setting - breadcrumb.
$wp_customize->add_setting('enable_breadcrumb',
    array(
        'default'           => $default['enable_breadcrumb'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control('enable_breadcrumb',
    array(
        'label'    => esc_html__('Show breadcrumbs', 'magazine-7'),
        'section'  => 'site_breadcrumb_settings',
        'type'     => 'checkbox',
        'priority' => 10,
    )
);



/**
 * Layout options section
 *
 * @package Magazine 7
 */

// Layout Section.
$wp_customize->add_section('site_layout_settings',
    array(
        'title'      => esc_html__('Global Layout Settings', 'magazine-7'),
        'priority'   => 9,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);


// Setting - global content alignment of news.
$wp_customize->add_setting('global_content_alignment',
    array(
        'default'           => $default['global_content_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_select',
    )
);

$wp_customize->add_control( 'global_content_alignment',
    array(
        'label'       => esc_html__('Global Content alignment', 'magazine-7'),
        'description' => esc_html__('Select global content alignment', 'magazine-7'),
        'section'     => 'site_layout_settings',
        'type'        => 'select',
        'choices'               => array(
            'align-content-left' => esc_html__( 'Content - Primary sidebar', 'magazine-7' ),
            'align-content-right' => esc_html__( 'Primary sidebar - Content', 'magazine-7' ),
            'full-width-content' => esc_html__( 'Full width content', 'magazine-7' )
        ),
        'priority'    => 130,
    ));



/**
 * Archive options section
 *
 * @package Magazine 7
 */

// Archive Section.
$wp_customize->add_section('site_archive_settings',
    array(
        'title'      => esc_html__('Archive Settings', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);

 //Setting - archive content view of news.
$wp_customize->add_setting('archive_layout',
    array(
        'default'           => $default['archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_layout',
    array(
        'label'       => esc_html__('Archive layout', 'magazine-7'),
        'description' => esc_html__('Select layout for archive', 'magazine-7'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-layout-grid' => esc_html__( 'Grid', 'magazine-7' ),
            'archive-layout-full' => esc_html__( 'Full', 'magazine-7' ),


        ),
        'priority'    => 130,
    ));

// Setting - archive content view of news.
$wp_customize->add_setting('archive_image_alignment',
    array(
        'default'           => $default['archive_image_alignment'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_image_alignment',
    array(
        'label'       => esc_html__('Image alignment', 'magazine-7'),
        'description' => esc_html__('Select image alignment for archive', 'magazine-7'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-image-left' => esc_html__( 'Left', 'magazine-7' ),
            'archive-image-right' => esc_html__( 'Right', 'magazine-7' )
        ),
        'priority'    => 130,
        'active_callback' => 'magazine_7_archive_image_status'
    ));

 //Setting - archive content view of news.
$wp_customize->add_setting('archive_content_view',
    array(
        'default'           => $default['archive_content_view'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_select',
    )
);

$wp_customize->add_control( 'archive_content_view',
    array(
        'label'       => esc_html__('Content view', 'magazine-7'),
        'description' => esc_html__('Select content view for archive', 'magazine-7'),
        'section'     => 'site_archive_settings',
        'type'        => 'select',
        'choices'               => array(
            'archive-content-excerpt' => esc_html__( 'Post excerpt', 'magazine-7' ),
            'archive-content-full' => esc_html__( 'Full Content', 'magazine-7' ),
            'archive-content-none' => esc_html__( 'None', 'magazine-7' ),

        ),
        'priority'    => 130,
    ));






//========== footer section options ===============
// Footer Section.
$wp_customize->add_section('site_footer_settings',
    array(
        'title'      => esc_html__('Footer', 'magazine-7'),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
        'panel'      => 'theme_option_panel',
    )
);






// Setting - global content alignment of news.
$wp_customize->add_setting('footer_copyright_text',
    array(
        'default'           => $default['footer_copyright_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);

$wp_customize->add_control( 'footer_copyright_text',
    array(
        'label'    => __( 'Copyright Text', 'magazine-7' ),
        'section'  => 'site_footer_settings',
        'type'     => 'text',
        'priority' => 100,
    )
);



// Setting - global content alignment of news.
$wp_customize->add_setting('hide_footer_menu_section',
    array(
        'default'           => $default['hide_footer_menu_section'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'magazine_7_sanitize_checkbox',
    )
);

$wp_customize->add_control( 'hide_footer_menu_section',
    array(
        'label'    => __( 'Hide footer menu section', 'magazine-7' ),
        'section'  => 'site_footer_settings',
        'type'     => 'checkbox',
        'priority' => 100,
    )
);