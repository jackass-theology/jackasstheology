<?php
/**
 * Default theme options.
 *
 * @package Magazine 7
 */

if (!function_exists('magazine_7_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function magazine_7_get_default_theme_options() {

    $defaults = array();
    // Preloader options section
    $defaults['enable_site_preloader'] = 1;

    // Header options section
    $defaults['header_layout'] = 'header-layout-1';

    $defaults['show_top_header_section'] = 0;
    $defaults['top_header_background_color'] = "#353535";
    $defaults['top_header_text_color'] = "#ffffff";

    $defaults['show_top_menu'] = 0;
    $defaults['show_social_menu_section'] = 0;
    $defaults['show_date_section'] = 0;

    $defaults['disable_header_image_tint_overlay'] = 0;
    $defaults['show_offpanel_menu_section'] = 1;

    $defaults['banner_advertisement_section'] = '';
    $defaults['banner_advertisement_section_url'] = '';

    // breadcrumb options section
    $defaults['enable_breadcrumb'] = 1;
    $defaults['select_breadcrumb_mode'] = 'simple';

    // Frontpage Section.

    $defaults['show_trending_news_section'] = 1;
    $defaults['select_trending_news_category'] = 0;

    $defaults['show_main_news_section'] = 1;
    $defaults['select_slider_news_category'] = 0;
    $defaults['select_slider_mode'] = 'default';
    $defaults['number_of_slides'] = 5;


    $defaults['show_featured_news_section'] = 1;
    $defaults['featured_news_section_title'] = __('Featured Posts: This is the place at where your descriptive section title displays.', 'magazine-7');
    $defaults['featured_news_section_subtitle'] = __('Featured Posts Subtitle: This is the place at where your descriptive section subtitle displays.', 'magazine-7');
    $defaults['select_featured_news_category'] = 0;
    $defaults['number_of_featured_news'] = 4;

    $defaults['frontpage_content_alignment'] = 'align-content-left';

    //layout options
    $defaults['global_content_layout'] = 'default-content-layout';
    $defaults['global_content_alignment'] = 'align-content-left';
    $defaults['global_image_alignment'] = 'full-width-image';
    $defaults['global_excerpt_length'] = 20;
    $defaults['global_read_more_texts'] = __('Read more', 'magazine-7');

    $defaults['archive_layout'] = 'archive-layout-grid';
    $defaults['archive_image_alignment'] = 'archive-image-left';
    $defaults['archive_content_view'] = 'archive-content-excerpt';


    //Pagination.
    $defaults['site_pagination_type'] = 'default';


    // Footer.
    // Latest posts
    $defaults['frontpage_show_latest_posts'] = 1;
    $defaults['frontpage_latest_posts_section_title'] = __('Latest Posts: This is the place at where your descriptive section title displays.', 'magazine-7');
    $defaults['frontpage_latest_posts_section_subtitle'] = __('Latest Posts Subtitle: This is the place at where your descriptive section subtitle displays.', 'magazine-7');
    $defaults['frontpage_latest_posts_category'] = 0;
    $defaults['number_of_frontpage_latest_posts'] = 6;


    $defaults['footer_copyright_text'] = esc_html__('Copyright &copy; All rights reserved.', 'magazine-7');
    $defaults['hide_footer_menu_section']  = 0;
    $defaults['hide_footer_site_title_section']  = 0;
    $defaults['hide_footer_copyright_credits']  = 0;
    $defaults['number_of_footer_widget']  = 3;
    $defaults['footer_background_color']  = '#1f2125';
    $defaults['footer_texts_color']  = '#ffffff';
    $defaults['footer_credits_background_color']  = '#000000';
    $defaults['footer_credits_texts_color']  = '#ffffff';



    // font and color options
    $defaults['site_title_font_size']     = 100;
    $defaults['primary_color']     = '#959595';
    $defaults['secondary_color']     = '#ff3c36';
    $defaults['link_color']     = '#404040';
    $defaults['site_wide_title_color']     = '#000000';
    $defaults['slider_caption_bg_color']     = '#000000';
    $defaults['slider_caption_texts_color']     = '#ffffff';




    //font option

    $defaults['primary_font']      = 'Source+Sans+Pro:400,400i,700,700i';
    $defaults['secondary_font']    = 'Montserrat:400,700';
    $defaults['post_format_color']    = '#00BCD4';


    // Pass through filter.
    $defaults = apply_filters('magazine_7_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
