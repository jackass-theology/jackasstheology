<?php
/*
Plugin Name: tagDiv Multi-Purpose
Plugin URI: http://tagdiv.com
Description: Design and build awesome landing pages to grow your website.
Author: tagDiv
Version: 2.0
Author URI: http://tagdiv.com
*/



add_action('tdc_init', 'on_tdc_init_multipurpose');
function on_tdc_init_multipurpose() {
	new td_api_multi_purpose();
}

class td_api_multi_purpose {
    var $plugin_url = '';
    var $plugin_path = '';

	var $group_params = array();

	static $typography_settings_list;

 	function __construct() {

	    $this->plugin_url = plugins_url('', __FILE__); // path used for elements like images, css, etc which are available on end user
        $this->plugin_path = dirname(__FILE__); // used for internal (server side) files

	    add_action( 'tdc_loaded', array($this, 'tdm_on_register_shortcodes' ) ); // hook used to add or modify items via Api

	    add_action( 'admin_enqueue_scripts', array('td_api_multi_purpose', 'tdm_plugin_wpadmin_css' ) ); // hook used to add custom css for wp-admin area
        add_action( 'wp_enqueue_scripts', array('td_api_multi_purpose', 'tdm_plugin_frontend_css' ) ); // hook used to add custom css used on frontend area
		add_action( 'wp_head', array('td_api_multi_purpose', 'tdm_on_wp_head' ), 200 ); // 200 to be after 'wp_head' hook of tagDiv composer and theme
		add_filter( 'tdc_template_shortcodes', array( 'td_api_multi_purpose', 'tdm_template_shortcodes' ), 10, 1 );

		add_filter( 'body_class', array( 'td_api_multi_purpose', 'tdm_on_body_class' ) );
    }

	function get_group_params( $group, $index_style = '' ) {
		if ( ! empty( $index_style ) ) {
			$group_params = array();
			foreach ( $this->group_params[ $group ] as $param ) {
				$param['param_name'] .= '-' . $index_style;
				$group_params[] = $param;
			}
			return $group_params;
		}
		return $this->group_params[ $group ];
	}






    // Add template
	static function tdm_template_shortcodes( $template_shortcodes ) {
//		$template_shortcodes['template_2'] = array(
//			'name' => 'Template 2',
//			'content' => base64_encode('[vc_row full_width="stretch_row_content td-stretch-content"][vc_column width="1/2"][/vc_column][vc_column width="1/2"][/vc_column][/vc_row][vc_row][vc_column width="1/4"][/vc_column][vc_column width="1/4"][vc_row_inner][vc_column_inner width="1/2"][td_block_2][/vc_column_inner][vc_column_inner width="1/2"][td_block_1][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/4"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]'),
//		);
		return $template_shortcodes;
	}

	static function tdm_on_body_class($classes) {

		if ( '' !== td_options::get( 'tdm_menu_active' ) ) {
			$classes[] = td_options::get( 'tdm_menu_active' );
		}
		return $classes;
	}

    static function tdm_plugin_wpadmin_css() {
        wp_enqueue_style('td-plugin-multi-purpose', plugins_url('', __FILE__) . '/style-admin.css', false, TD_COMPOSER); // backend css (admin_enqueue_scripts)
    }

    static function tdm_plugin_frontend_css() {
        wp_enqueue_style('td-plugin-multi-purpose', plugins_url('', __FILE__) . '/style.css', false, TD_COMPOSER); // frontend css (wp_enqueue_scripts)
    }

	static function tdm_on_wp_head() {

		$raw_css =
			"<style>

                /* @theme_color */
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .sfHover > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > li > a:hover,
                .tdm_block_column_content:hover .tdm-col-content-title-url .tdm-title,
                .tds-button2 .tdm-btn-text,
                .tds-button2 i,
                .tds-button5:hover .tdm-btn-text,
                .tds-button5:hover i,
                .tds-button6 .tdm-btn-text,
                .tds-button6 i,
                .tdm_block_list .tdm-list-item i,
                .tdm_block_pricing .tdm-pricing-feature i,
                .tdm-social-item i {
                  color: @theme_color;
                }
                .tdm-menu-active-style5 .td-header-menu-wrap .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style5 .td-header-menu-wrap .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style5 .td-header-menu-wrap .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style5 .td-header-menu-wrap .sf-menu > li > a:hover,
                .tdm-menu-active-style5 .td-header-menu-wrap .sf-menu > .sfHover > a,
                .tds-button1,
                .tds-button6:after,
                .tds-title2 .tdm-title-line:after,
                .tds-title3 .tdm-title-line:after,
                .tdm_block_pricing.tdm-pricing-featured:before,
                .tdm_block_pricing.tds_pricing2_block.tdm-pricing-featured .tdm-pricing-header,
                .tds-progress-bar1 .tdm-progress-bar:after,
                .tds-progress-bar2 .tdm-progress-bar:after,
                .tds-social3 .tdm-social-item {
                  background-color: @theme_color;
                }
                .tdm-menu-active-style4 .tdm-header .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style4 .tdm-header .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style4 .tdm-header .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style4 .tdm-header .sf-menu > li > a:hover,
                .tdm-menu-active-style4 .tdm-header .sf-menu > .sfHover > a,
                .tds-button2:before,
                .tds-button6:before,
                .tds-progress-bar3 .tdm-progress-bar:after {
                  border-color: @theme_color;
                }
                .tdm-btn-style1 {
					background-color: @theme_color;
				}
				.tdm-btn-style2:before {
				    border-color: @theme_color;
				}
				.tdm-btn-style2 {
				    color: @theme_color;
				}
				.tdm-btn-style3 {
				    -webkit-box-shadow: 0 2px 16px @theme_color;
                    -moz-box-shadow: 0 2px 16px @theme_color;
                    box-shadow: 0 2px 16px @theme_color;
				}
				.tdm-btn-style3:hover {
				    -webkit-box-shadow: 0 4px 26px @theme_color;
                    -moz-box-shadow: 0 4px 26px @theme_color;
                    box-shadow: 0 4px 26px @theme_color;
				}
				
				/* @top_menu_color */
                .tdm-header-style-1.td-header-wrap .td-header-top-menu-full,
                .tdm-header-style-1.td-header-wrap .top-header-menu .sub-menu,
                .tdm-header-style-2.td-header-wrap .td-header-top-menu-full,
                .tdm-header-style-2.td-header-wrap .top-header-menu .sub-menu,
                .tdm-header-style-3.td-header-wrap .td-header-top-menu-full,
                .tdm-header-style-3.td-header-wrap .top-header-menu .sub-menu{
                    background-color: @top_menu_color;
                }
				
				/* @submenu_hover_color */
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > li > a:hover,
                .tdm-menu-active-style3 .tdm-header.td-header-wrap .sf-menu > .sfHover > a {
                  color: @submenu_hover_color;
                }
                .tdm-menu-active-style4 .tdm-header .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style4 .tdm-header .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style4 .tdm-header .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style4 .tdm-header .sf-menu > li > a:hover,
                .tdm-menu-active-style4 .tdm-header .sf-menu > .sfHover > a {
                  border-color: @submenu_hover_color;
                }
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap .sf-menu > li > a:hover,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap .sf-menu > .sfHover > a {
                  background-color: @submenu_hover_color;
                }
				
				/* @sticky_submenu_hover_color */
                .tdm-menu-active-style3 .tdm-header .td-affix .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style3 .tdm-header .td-affix .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style3 .tdm-header .td-affix .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style3 .tdm-header .td-affix .sf-menu > li > a:hover,
                .tdm-menu-active-style3 .tdm-header .td-affix .sf-menu > .sfHover > a {
                  color: @sticky_submenu_hover_color;
                }
                .tdm-menu-active-style4 .tdm-header .td-affix .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style4 .tdm-header .td-affix .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style4 .tdm-header .td-affix .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style4 .tdm-header .td-affix .sf-menu > li > a:hover,
                .tdm-menu-active-style4 .tdm-header .td-affix .sf-menu > .sfHover > a {
                  border-color: @sticky_submenu_hover_color;
                }
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap.td-affix .sf-menu > .current-menu-item > a,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap.td-affix .sf-menu > .current-menu-ancestor > a,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap.td-affix .sf-menu > .current-category-ancestor > a,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap.td-affix .sf-menu > li > a:hover,
                .tdm-menu-active-style5 .tdm-header .td-header-menu-wrap.td-affix .sf-menu > .sfHover > a {
                  background-color: @sticky_submenu_hover_color;
                }


                /* @tdm_menu_btn1_base_color */
				.tdm-menu-btn1 .tds-button1,
				.tdm-menu-btn1 .tds-button6:after {
					background-color: @tdm_menu_btn1_base_color;
				}
				.tdm-menu-btn1 .tds-button2:before,
				.tdm-menu-btn1 .tds-button6:before {
				    border-color: @tdm_menu_btn1_base_color;
				}
				.tdm-menu-btn1 .tds-button2,
				.tdm-menu-btn1 .tds-button2 i {
				    color: @tdm_menu_btn1_base_color;
				}
				.tdm-menu-btn1 .tds-button3 {
				    -webkit-box-shadow: 0 2px 16px @tdm_menu_btn1_base_color;
                    -moz-box-shadow: 0 2px 16px @tdm_menu_btn1_base_color;
                    box-shadow: 0 2px 16px @tdm_menu_btn1_base_color;
				}
				.tdm-menu-btn1 .tds-button3:hover {
				    -webkit-box-shadow: 0 4px 26px @tdm_menu_btn1_base_color;
                    -moz-box-shadow: 0 4px 26px @tdm_menu_btn1_base_color;
                    box-shadow: 0 4px 26px @tdm_menu_btn1_base_color;
				}
				
				/* @tdm_menu_btn1_text_color */
				.tdm-menu-btn1 .tds-button1 .tdm-btn-text,
				.tdm-menu-btn1 .tds-button1 i,
				.tdm-menu-btn1 .tds-button2 .tdm-btn-text,
				.tdm-menu-btn1 .tds-button2 i,
				.tdm-menu-btn1 .tds-button3 .tdm-btn-text,
				.tdm-menu-btn1 .tds-button3 i,
				.tdm-menu-btn1 .tds-button4 .tdm-btn .tdm-btn-text,
				.tdm-menu-btn1 .tds-button4 .tdm-btn i,
				.tdm-menu-btn1 .tds-button5 .tdm-btn-text,
				.tdm-menu-btn1 .tds-button5 i,
				.tdm-menu-btn1 .tds-button6 .tdm-btn-text,
				.tdm-menu-btn1 .tds-button6 i {
					color: @tdm_menu_btn1_text_color;
				}
				
				/* @tdm_menu_btn1_base_hover_color */
				.tdm-menu-btn1 .tds-button1:before,
				.tdm-menu-btn1 .tds-button4 .tdm-button-b {
					background-color: @tdm_menu_btn1_base_hover_color;
				}
				.tdm-menu-btn1 .tds-button2:hover:before,
                .tdm-menu-btn1 .tds-button6:hover:before{
				    border-color: @tdm_menu_btn1_base_hover_color;
				}
				.tdm-menu-btn1 .tdm-btn-style:hover {
				    color: @tdm_menu_btn1_base_hover_color;
				}
				.tdm-menu-btn1 .tds-button3:hover {
				    -webkit-box-shadow: 0 4px 26px @tdm_menu_btn1_base_hover_color;
                    -moz-box-shadow: 0 4px 26px @tdm_menu_btn1_base_hover_color;
                    box-shadow: 0 4px 26px @tdm_menu_btn1_base_hover_color;
				}
				
				/* @tdm_menu_btn1_text_hover_color */
				.tdm-menu-btn1 .tds-button1:hover .tdm-btn-text,
				.tdm-menu-btn1 .tds-button1:hover i,
                .tdm-menu-btn1 .tds-button2:hover .tdm-btn-text,
                .tdm-menu-btn1 .tds-button2:hover i,
                .tdm-menu-btn1 .tds-button3:hover .tdm-btn-text,
                .tdm-menu-btn1 .tds-button3:hover i,
				.tdm-menu-btn1 .tds-button4 .tdm-button-b .tdm-btn-text,
				.tdm-menu-btn1 .tds-button4 .tdm-button-b i,
				.tdm-menu-btn1 .tds-button5:hover .tdm-btn-text,
				.tdm-menu-btn1 .tds-button5:hover i,
				.tdm-menu-btn1 .tds-button6:hover .tdm-btn-text,
				.tdm-menu-btn1 .tds-button6:hover i  {
					color: @tdm_menu_btn1_text_hover_color;
				}

                
                /* @tdm_menu_btn2_base_color */
				.tdm-menu-btn2 .tds-button1,
				.tdm-menu-btn2 .tds-button6:after {
					background-color: @tdm_menu_btn2_base_color;
				}
				.tdm-menu-btn2 .tds-button2:before,
				.tdm-menu-btn2 .tds-button6:before {
				    border-color: @tdm_menu_btn2_base_color;
				}
				.tdm-menu-btn2 .tds-button2,
				.tdm-menu-btn2 .tds-button2 i {
				    color: @tdm_menu_btn2_base_color;
				}
				.tdm-menu-btn2 .tds-button3 {
				    -webkit-box-shadow: 0 2px 16px @tdm_menu_btn2_base_color;
                    -moz-box-shadow: 0 2px 16px @tdm_menu_btn2_base_color;
                    box-shadow: 0 2px 16px @tdm_menu_btn2_base_color;
				}
				.tdm-menu-btn2 .tds-button3:hover {
				    -webkit-box-shadow: 0 4px 26px @tdm_menu_btn2_base_color;
                    -moz-box-shadow: 0 4px 26px @tdm_menu_btn2_base_color;
                    box-shadow: 0 4px 26px @tdm_menu_btn2_base_color;
				}
				
				/* @tdm_menu_btn2_text_color */
				.tdm-menu-btn2 .tds-button1 .tdm-btn-text,
				.tdm-menu-btn2 .tds-button1 i,
				.tdm-menu-btn2 .tds-button2 .tdm-btn-text,
				.tdm-menu-btn2 .tds-button2 i,
				.tdm-menu-btn2 .tds-button3 .tdm-btn-text,
				.tdm-menu-btn2 .tds-button3 i,
				.tdm-menu-btn2 .tds-button4 .tdm-btn .tdm-btn-text,
				.tdm-menu-btn2 .tds-button4 .tdm-btn i,
				.tdm-menu-btn2 .tds-button5 .tdm-btn-text,
				.tdm-menu-btn2 .tds-button5 i,
				.tdm-menu-btn2 .tds-button6 .tdm-btn-text,
				.tdm-menu-btn2 .tds-button6 i {
					color: @tdm_menu_btn2_text_color;
				}
				
				/* @tdm_menu_btn2_base_hover_color */
				.tdm-menu-btn2 .tds-button1:before,
				.tdm-menu-btn2 .tds-button4 .tdm-button-b {
					background-color: @tdm_menu_btn2_base_hover_color;
				}
				.tdm-menu-btn2 .tds-button2:hover:before,
                .tdm-menu-btn2 .tds-button6:hover:before{
				    border-color: @tdm_menu_btn2_base_hover_color;
				}
				.tdm-menu-btn2 .tdm-btn-style:hover {
				    color: @tdm_menu_btn1_base_hover_color;
				}
				.tdm-menu-btn2 .tds-button3:hover {
				    -webkit-box-shadow: 0 4px 26px @tdm_menu_btn2_base_hover_color;
                    -moz-box-shadow: 0 4px 26px @tdm_menu_btn2_base_hover_color;
                    box-shadow: 0 4px 26px @tdm_menu_btn2_base_hover_color;
				}
				
				/* @tdm_menu_btn2_text_hover_color */
				.tdm-menu-btn2 .tds-button1:hover .tdm-btn-text,
				.tdm-menu-btn2 .tds-button1:hover i,
                .tdm-menu-btn2 .tds-button2:hover .tdm-btn-text,
                .tdm-menu-btn2 .tds-button2:hover i,
                .tdm-menu-btn2 .tds-button3:hover .tdm-btn-text,
                .tdm-menu-btn2 .tds-button3:hover i,
				.tdm-menu-btn2 .tds-button4 .tdm-button-b .tdm-btn-text,
				.tdm-menu-btn2 .tds-button4 .tdm-button-b i,
				.tdm-menu-btn2 .tds-button5:hover .tdm-btn-text,
				.tdm-menu-btn2 .tds-button5:hover i,
				.tdm-menu-btn2 .tds-button6:hover .tdm-btn-text,
				.tdm-menu-btn2 .tds-button6:hover i  {
					color: @tdm_menu_btn2_text_hover_color;
				}
				
				
				
				/* @title_xxsmall_font */
				.tdm-title-xxsm {
				    @title_xxsmall_font
				}
				/* @title_xsmall_font */
				.tdm-title-xsm {
				    @title_xsmall_font
				}
				/* @title_small_font */
				.tdm-title-sm {
				    @title_small_font
				}
				/* @title_medium_font */
				.tdm-title-md {
				    @title_medium_font
				}
				/* @title_big_font */
				.tdm-title-bg {
				    @title_big_font
				}
				/* @title_sub_font */
				.tds-title3 .tdm-title-sub,
				.tds-title-over-image1 .tdm-title-sub {
				    @title_sub_font
				}
				/* @client_title_font */
				.tdm_block_client .tdm-client-name {
				    @client_title_font
				}
				/* @food_menu_title_font */
				.tdm_block_food_menu .tdm-title {
				    @food_menu_title_font
				}
				/* @fancy_text_title_font */
				.td_block_fancy_text .tdm-fancy-title {
				    @fancy_text_title_font
				}
				/* @counter_title_font */
				.tdm-counter-wrap .tdm-counter-title {
				    @food_menu_title_font
				}
				/* @progress_bar_title_font */
				.tdm_block_progress_bar .tdm-progress-wrap .tdm-progress-title {
				    @progress_bar_title_font
				}
				/* @team_member_title_font */
				.tdm_block_team_member .tdm-title {
				    @team_member_title_font
				}
				/* @testimonial_title_font */
				.tdm_block_testimonial .tdm-testimonial-name {
				    @testimonial_title_font
				}
				
				/* @call_to_action_description_font */
				.tdm_block_call_to_action .tdm-descr {
				    @call_to_action_description_font
				}
				/* @column_content_description_font */
				.tdm_block_column_content .tdm-descr {
				    @column_content_description_font
				}
				/* @fancy_text_image_description_font */
				.tdm_block_fancy_text_image .tdm-descr {
				    @fancy_text_image_description_font
				}
				/* @food_menu_description_font */
				.tdm_block_food_menu .tdm-descr {
				    @food_menu_description_font
				}
				/* @hero_description_font */
				.tdm_block_hero .tdm-descr {
				    @hero_description_font
				}
				/* @icon_box_description_font */
				.tdm_block_icon_box .tdm-descr {
				    @icon_box_description_font
				}
				/* @image_info_description_font */
				.tdm_block_image_info_box .tdm-image-description p {
				    @image_info_description_font
				}
				/* @inline_text_description_font */
				.tdm_block.tdm_block_inline_text .tdm-descr {
				    @inline_text_description_font
				}
				/* @pricing_table_description_font */
				.tdm_block_pricing .tdm-descr {
				    @pricing_table_description_font
				}
				/* @team_member_description_font */
				.tdm_block_team_member .tdm-member-info .tdm-descr {
				    @team_member_description_font
				}
				/* @testimonial_description_font */
				.tdm_block_testimonial .tdm-testimonial-descr {
				    @testimonial_description_font
				}
				/* @text_image_description_font */
				.tdm_block_text_image .tdm-descr {
				    @counter_title_font
				}
				/* @text_list_description_font */
				.tdm_block_list .tdm-list-items {
				    @text_list_description_font
				}
				
				/* @button_small_font */
				.tdm-btn-sm {
				    @button_small_font
				}
				/* @button_medium_font */
				.tdm-btn-md {
				    @button_medium_font
				}
				/* @button_large_font */
				.tdm-btn-lg {
				    @button_large_font
				}
				/* @button_xlarge_font */
				.tdm-btn-xlg {
				    @button_xlarge_font
				}
				

				
				/* @main-menu-height */
                .tdm-menu-active-style2 .tdm-header ul.sf-menu > .td-menu-item,
                .tdm-menu-active-style4 .tdm-header ul.sf-menu > .td-menu-item,
                .tdm-header .tdm-header-menu-btns,
                .tdm-header-style-1 .td-main-menu-logo a,
                .tdm-header-style-2 .td-main-menu-logo a,
                .tdm-header-style-3 .td-main-menu-logo a {
                    line-height: @main-menu-height;
                }
                .tdm-header-style-1 .td-main-menu-logo,
                .tdm-header-style-2 .td-main-menu-logo,
                .tdm-header-style-3 .td-main-menu-logo {
                    height: @main-menu-height;
                }
                @media (min-width: 767px) {
                    .tdm-header-style-1 .td-main-menu-logo img, 
                    .tdm-header-style-2 .td-main-menu-logo img, 
                    .tdm-header-style-3 .td-main-menu-logo img {
                        max-height: @main-menu-height;
                    }
                }
                
                /* @tdm_btn_radius */
				.tdm-btn,
				 .tdm-btn:before {
				    border-radius:  @tdm_btn_radius;
				}              
                
                /* @tdm_bordered_website */
                @media (min-width: 1141px) {
                    #td-outer-wrap {
                        margin: @tdm_bordered_website;
                        position: relative;
                    }
                    .td-boxed-layout .td-container-wrap {
                        width: auto;
                    }
                    .td-theme-wrap .td-header-menu-wrap.td-affix {
                        width: calc(100% - @tdm_bordered_website * 2) !important;
                    }
                }

			</style>";

		$td_css_compiler = new td_css_compiler( $raw_css );
        $td_css_compiler->load_setting('theme_color');
        $td_css_compiler->load_setting('top_menu_color');
        $td_css_compiler->load_setting('submenu_hover_color');
        $td_css_compiler->load_setting('sticky_submenu_hover_color');
        $td_css_compiler->load_setting_raw( 'tdm_bordered_website', td_util::get_option('tdm_bordered_website') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn1_base_color', td_util::get_option('tdm_menu_btn1_base_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn1_text_color', td_util::get_option('tdm_menu_btn1_text_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn1_base_hover_color', td_util::get_option('tdm_menu_btn1_base_hover_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn1_text_hover_color', td_util::get_option('tdm_menu_btn1_text_hover_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn2_base_color', td_util::get_option('tdm_menu_btn2_base_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn2_text_color', td_util::get_option('tdm_menu_btn2_text_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn2_base_hover_color', td_util::get_option('tdm_menu_btn2_base_hover_color') );
        $td_css_compiler->load_setting_raw( 'tdm_menu_btn2_text_hover_color', td_util::get_option('tdm_menu_btn2_text_hover_color') );
		$td_css_compiler->load_setting_raw( 'tdm_btn_base_color', td_util::get_option('tdm_btn_base_color') );
        $td_css_compiler->load_setting_raw( 'tdm_btn_text_color', td_util::get_option('tdm_btn_text_color') );
        $td_css_compiler->load_setting_raw( 'tdm_btn_icon_color', td_util::get_option('tdm_btn_icon_color') );
        $td_css_compiler->load_setting_raw( 'tdm_btn_base_hover_color', td_util::get_option('tdm_btn_base_hover_color') );
        $td_css_compiler->load_setting_raw( 'tdm_btn_text_hover_color', td_util::get_option('tdm_btn_text_hover_color') );
        $td_css_compiler->load_setting_raw( 'tdm_btn_icon_hover_color', td_util::get_option('tdm_btn_icon_hover_color') );
        $td_css_compiler->load_setting_raw( 'tdm_btn_radius', td_util::get_option('tdm_btn_radius') );

        // button radius
        $tdm_bordered_website = td_util::get_option('tdm_bordered_website');
        if( !empty( $tdm_bordered_website ) ) {
            if ( is_numeric( $tdm_bordered_website ) ) {
                $td_css_compiler->load_setting_raw( 'tdm_bordered_website', $tdm_bordered_website . 'px' );
            }
        }

        // button radius
        $td_button_radius = td_util::get_option('tdm_btn_radius');
        if( !empty( $td_button_radius ) ) {
            if ( is_numeric( $td_button_radius ) ) {
                $td_css_compiler->load_setting_raw( 'tdm_btn_radius', $td_button_radius . 'px' );
            }
        }

        //get $typography array from db and added to generated css
        $td_typography_array = td_fonts::td_get_typography_sections_from_db();
        if(is_array($td_typography_array) and !empty($td_typography_array)) {

            foreach ($td_typography_array as $section_id => $section_css_array) {
                $td_css_compiler->load_setting_array(array($section_id => $section_css_array));
            }
        }

        // read line-height for the main-menu to align the logo in menu
        $td_menu_height = td_options::get_array('td_fonts');
        if (!empty($td_menu_height['main_menu']['line_height'])) {
            $td_css_compiler->load_setting_raw('main-menu-height', $td_menu_height['main_menu']['line_height']);
        }

		$compiled_css    = $td_css_compiler->compile_css();

		$buffer = "\n<!-- Button style compiled by theme -->" . "\n\n<style>\n    " . $compiled_css . "\n</style>\n\n";
		echo $buffer; // echo out the buffer
	}


    static function set_typography_list()  {
        /**
         * The typography settings for the panel and css compiler
         */
        self::$typography_settings_list = array(
            'mp_Titles' => array(
                'title_xxsmall_font' => array(
                    'text' => 'XXSmall',
                    'type' => 'default',
                ),
                'title_xsmall_font' => array(
                    'text' => 'XSmall uppercase',
                    'type' => 'default',
                ),
                'title_small_font' => array(
                    'text' => 'Small',
                    'type' => 'default',
                ),
                'title_medium_font' => array(
                    'text' => 'Medium',
                    'type' => 'default',
                ),
                'title_big_font' => array(
                    'text' => 'Big',
                    'type' => 'default',
                ),
                'title_sub_font' => array(
                    'text' => 'Subtitle',
                    'type' => 'default',
                ),
                'client_title_font' => array(
                    'text' => 'Client',
                    'type' => 'default',
                ),
                'food_menu_title_font' => array(
                    'text' => 'Food menu',
                    'type' => 'default',
                ),
                'fancy_text_title_font' => array(
                    'text' => 'Fancy text with image',
                    'type' => 'default',
                ),
                'counter_title_font' => array(
                    'text' => 'Numbered counter',
                    'type' => 'default',
                ),
                'progress_bar_title_font' => array(
                    'text' => 'Progress bar',
                    'type' => 'default',
                ),
                'team_member_title_font' => array(
                    'text' => 'Team member',
                    'type' => 'default',
                ),
                'testimonial_title_font' => array(
                    'text' => 'Testimonial ',
                    'type' => 'default',
                )
            ),
            'mp_Descriptions' => array(
                'call_to_action_description_font' => array(
                    'text' => 'Call to action',
                    'type' => 'default',
                ),
                'column_content_description_font' => array(
                    'text' => 'Column content',
                    'type' => 'default',
                ),
                'fancy_text_image_description_font' => array(
                    'text' => 'Fancy text with image',
                    'type' => 'default',
                ),
                'food_menu_description_font' => array(
                    'text' => 'Food menu product',
                    'type' => 'default',
                ),
                'hero_description_font' => array(
                    'text' => 'Hero',
                    'type' => 'default',
                ),
                'icon_box_description_font' => array(
                    'text' => 'Icon box',
                    'type' => 'default',
                ),
                'image_info_description_font' => array(
                    'text' => 'Image info box',
                    'type' => 'default',
                ),
                'inline_text_description_font' => array(
                    'text' => 'Inline text',
                    'type' => 'default',
                ),
                'pricing_table_description_font' => array(
                    'text' => 'Pricing table',
                    'type' => 'default',
                ),
                'team_member_description_font' => array(
                    'text' => 'Team member',
                    'type' => 'default',
                ),
                'testimonial_description_font' => array(
                    'text' => 'Testimonial',
                    'type' => 'default',
                ),
                'text_image_description_font' => array(
                    'text' => 'Text with image',
                    'type' => 'default',
                ),
                'text_list_description_font' => array(
                    'text' => 'List',
                    'type' => 'default',
                ),
            ),
            'mp_Buttons' => array(
                'button_small_font' => array(
                    'text' => 'Small',
                    'type' => 'default',
                ),
                'button_medium_font' => array(
                    'text' => 'Medium',
                    'type' => 'default',
                ),
                'button_large_font' => array(
                    'text' => 'Large',
                    'type' => 'default',
                ),
                'button_xlarge_font' => array(
                    'text' => 'Extra large',
                    'type' => 'default',
                ),
            )
        );

	    td_global::$typography_settings_list = array_merge(
		    td_global::$typography_settings_list,
		    self::$typography_settings_list
	    );
    }


    /**
     * @since 25.5.2018 - updated to work with the placeholder list located in config
     * @see tdc_config::$default_placeholder_images
     * @param $placeholder_id
     * @return null|string
     */
	private static function tdm_get_image( $placeholder_id ) {
 	    if (!isset(tdc_config::$default_placeholder_images[$placeholder_id])) {
 	        return null; // the old function returned null.. ;-/
        }
 	    return TDC_URL . tdc_config::$default_placeholder_images[$placeholder_id];
 	}


    function tdm_on_register_shortcodes() { //add the api code inside this function

        $this->group_params = array(
            'title' => array(
                array(
                    'param_name' => 'title_text',
                    'type' => 'textarea_raw_html',
                    'value' => '',
                    'heading' => 'Title text',
                    'description' => '',
                    'class' => 'tdc-textarea-extrasmall',
                ),
                array(
                    "param_name" => "title_tag",
                    "type" => "dropdown",
                    "value" => array(
                        'H1' => 'h1',
                        'H2' => 'h2',
                        'H3 - Default' => 'h3',
                        'H4' => 'h4',
                    ),
                    "heading" => 'Title tag (SEO)',
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
                array(
                    "param_name" => "title_size",
                    "type" => "dropdown",
                    "value" => array(
                        'XXSmall' => 'tdm-title-xxsm',
                        'XSmall uppercase' => 'tdm-title-xsm',
                        'Small' => 'tdm-title-sm',
                        'Medium' => 'tdm-title-md',
                        'Big' => 'tdm-title-bg',
                    ),
                    "heading" => __( 'Title size', 'td_composer' ),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
            ),
            'button' => array(
                array(
                    'param_name' => 'button_text',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Button text',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'button_url',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Button url',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig'
                ),
                array(
                    "param_name" => "button_open_in_new_window",
                    "type" => "checkbox",
                    "value" => '',
                    "heading" => "Open in new window",
                    "description" => "",
                    "holder" => "div",
                    "class" => ""
                ),
                array(
                    'param_name' => 'button_tdicon',
                    'type' => 'icon',
                    'heading' => 'Button icon',
                    'class' => 'tdc-textfield-small',
                    'value' => '',
                ),
                array(
                    'param_name' => 'button_icon_size',
                    'type' => 'textfield-responsive',
                    'value' => '',
                    'heading' => 'Button icon size',
                    'description' => '',
                    'class' => 'tdc-textfield-small',
                ),
                array(
                    "param_name" => "button_icon_position",
                    "type" => "dropdown",
                    "value" => array(
                        'After text' => '',
                        'Before text' => 'icon-before',
                    ),
                    "heading" => __( 'Button icon position', 'td_composer' ),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
                array(
                    'param_name' => 'button_icon_space',
                    'type' => 'range-responsive',
                    'value' => '14',
                    'heading' => 'Icon space',
                    'description' => '',
                    'range_min' => '0',
                    'range_max' => '50',
                    'range_step' => '1',
                    'class' => 'tdc-textfield-small',
                ),
                array(
                    "param_name" => "button_size",
                    "type" => "dropdown",
                    "value" => array(
                        'Small' => 'tdm-btn-sm',
                        'Medium' => 'tdm-btn-md',
                        'Large' => 'tdm-btn-lg',
                        'XLarge' => 'tdm-btn-xlg',
                    ),
                    "heading" => __( 'Button size', 'td_composer' ),
                    "description" => "Button size",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
                array(
                    'param_name' => 'button_width',
                    'type' => 'textfield-responsive',
                    'value' => '',
                    'heading' => 'Button min-width',
                    'description' => 'Button width',
                    'class' => 'tdc-textfield-small',
                ),
                array(
                    "param_name" => "group_button_separator",
                    "type" => "text_separator",
                    'heading' => 'Button style',
                    "value" => "",
                    "class" => "",
                    "group" => "Style",
                ),
                array(
                    "param_name" => "tds_button",
                    "type" => "dropdown",
                    "value" => array(
                        'callback' => 'td_api_style::get_styles_for_mapping',
                        'params' => array( 'tds_button')
                    ),
                    "heading" => 'Button style',
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                    "group" => 'Style',
                ),
			),
            'image' => array(
                array(
                    "param_name" => "image",
                    "type" => "attach_image",
                    "value" => '',
                    "heading" => __( "Image", 'td_composer' ),
                    "description" => "",
                    "holder" => "div",
                    "class" => "",
                ),
                array(
                    "param_name" => "image_repeat",
                    "type" => "dropdown",
                    "value" => array(
                        'No Repeat' => '',
                        'Tile' => 'repeat',
                        'Tile Horizontally' => 'repeat-x',
                        'Tile Vertically' => 'repeat-y'
                    ),
                    "heading" => __( 'Image repeat', 'td_composer' ),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
                array(
                    "param_name" => "image_size",
                    "type" => "dropdown",
                    "value" => array(
                        'Cover' => '',
                        'Full Width' => '100% auto',
                        'Full Height' => 'auto 100%',
                        'Auto' => 'auto',
                        'Contain' => 'contain'
                    ),
                    "heading" => __( 'Image size', 'td_composer' ),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
                array(
                    "param_name" => "image_alignment",
                    "type" => "dropdown",
                    "value" => array(
                        'Top' => 'top',
                        'Center' => 'center',
                        'Bottom' => 'bottom'
                    ),
                    "heading" => __( 'Image alignment', 'td_composer' ),
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                ),
            ),
            'social_icons' => array(
                array(
                    'param_name' => 'icons_size',
                    'type' => 'range-responsive',
                    'value' => '14',
                    'heading' => 'Icons size',
                    'description' => '',
                    'class' => 'tdc-textfield-small',
                    'range_min' => '8',
                    'range_max' => '50',
                    'range_step' => '1',
                ),
                array(
                    'param_name' => 'icons_padding',
                    'type' => 'range-responsive',
                    'value' => '2.5',
                    'heading' => 'Padding around icons',
                    'description' => '',
                    'class' => 'tdc-textfield-small',
                    'range_min' => '1',
                    'range_max' => '3',
                    'range_step' => '0.1',
                ),
                array(
                    'param_name' => 'icons_spacing',
                    'type' => 'textfield-responsive',
                    'value' => '',
                    'heading' => 'Spacing around icons',
                    'description' => '',
                    'class' => 'tdc-textfield-small',
                    'placeholder' => '10',
                ),
                array(
                    "param_name" => "open_in_new_window",
                    "type" => "checkbox",
                    "value" => '',
                    "heading" => "Open in new window",
                    "description" => "",
                    "holder" => "div",
                    "class" => "",
                ),
                array(
                    'param_name' => 'behance',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Behance',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'blogger',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Blogger',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'dribbble',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Dribbble',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'facebook',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Facebook',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig tdm-social-facebook',
                ),
                array(
                    'param_name' => 'flickr',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Flickr',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'googleplus',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Google+',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'instagram',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Instagram',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'lastfm',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Lastfm',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'linkedin',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'LinkedIn',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'pinterest',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Pinterest',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'rss',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'RSS',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'soundcloud',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Soundcloud',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'tumblr',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Tumblr',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'twitter',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Twitter',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'vimeo',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'Vimeo',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    'param_name' => 'youtube',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'YouTube',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig tdm-social-youtube',
                ),
                array(
                    'param_name' => 'vk',
                    'type' => 'textfield',
                    'value' => '',
                    'heading' => 'VKontakte',
                    'description' => '',
                    'class' => 'tdc-textfield-extrabig',
                ),
                array(
                    "param_name" => "group_social_separator",
                    "type" => "text_separator",
                    'heading' => 'Social style',
                    "value" => "",
                    "class" => "",
                    "group" => "Style"
                ),
                array(
                    "param_name" => "tds_social",
                    "type" => "dropdown",
                    "value" => array(
                        'callback' => 'td_api_style::get_styles_for_mapping',
                        'params' => array( 'tds_social', false )
                    ),
                    "heading" => 'Social style',
                    "description" => "",
                    "holder" => "div",
                    "class" => "tdc-dropdown-big",
                    "group" => "Style"
                ),
            ),
		);

	    if (defined('TD_DEPLOY_MODE') && TD_DEPLOY_MODE === 'dev') {
			$unique_param_names = array();
			foreach ( $this->group_params as $group_param_id => $group_params ) {
				foreach ( $group_params as $param ) {
					if ( array_key_exists( $param['param_name'], $unique_param_names ) ) {
						td_util::error(__FILE__, get_class($this) . '->set_group_params() Internal error: The "' . $param['param_name'] . '" group key is already defined by "' . $unique_param_names[ $param['param_name'] ] . '" group. You try to add it to "' . $group_param_id . '" group")');
						die;
					}
					$unique_param_names[$param['param_name']] = $group_param_id;
				}
			}
		}


		$this->register_styles();

		// Update values of the group params - those with callback - that needs values from registered styles
		foreach ( $this->group_params as $group_param_id => &$params ) {
			foreach ( $params as &$param ) {

				if ( 0 === strpos( $param['param_name'], 'tds_') && is_array( $param['value'] ) && isset( $param['value']['callback'] ) ) {

					$callback = $param['value']['callback'];
					$callback_params = array();

					if ( isset( $param['value']['params'] ) ) {
						$callback_params = $param['value']['params'];
					}

					$param['value'] = call_user_func_array( $callback, $callback_params );
				}
			}
		}

	    /**
         * top bars
         */
        td_api_top_bar_template::add('tdm_top_bar_template_1',
            array(
                'img' => $this->plugin_url . '/images/panel/top_bar_templates/icon-top-bar-mp1.png',
                'file' => $this->plugin_path . '/header/tdm_top_bar_template_1.php',
                'text' => 'Style 1 - Multipurpose'
            )
        );


        /**
         * headers
         */
        td_api_header_style::add('tdm_header_style_1',
            array(
                'text' => '<strong>Style 1 - Multipurpose</strong>',
                'file' => $this->plugin_path . '/header/tdm-header-style-1.php',
                'img' => $this->plugin_url . '/images/panel/menu/icon-menu-mp1.png'
            )
        );
        td_api_header_style::add('tdm_header_style_2',
            array(
                'text' => '<strong>Style 2 - Multipurpose</strong>',
                'file' => $this->plugin_path . '/header/tdm-header-style-2.php',
                'img' => $this->plugin_url . '/images/panel/menu/icon-menu-mp2.png'
            )
        );
        td_api_header_style::add('tdm_header_style_3',
            array(
                'text' => '<strong>Style 3 - Multipurpose</strong>',
                'file' => $this->plugin_path . '/header/tdm-header-style-3.php',
                'img' => $this->plugin_url . '/images/panel/menu/icon-menu-mp3.png'
            )
        );


        /**
         * the td_api_sub_footer
         */
        td_api_sub_footer_template::add('tdm_sub_footer_template_1',
            array(
                'img' => $this->plugin_url . '/images/panel/sub_footer_templates/icon-sub-footer-1.png',
                'file' => $this->plugin_path . '/footer/tdm_sub_footer_template_1.php',
                'text' => 'Style 1 - Multipurpose'

            )
        );

	    $image_params = array(
            array(
                "param_name" => "image",
                "type" => "attach_image",
                "value" => '',
                "heading" => __( "Image", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "",
            ),
			array(
                "param_name" => "image_url",
                "type" => "textfield",
                "value" => '',
                "heading" => __( "Image link", 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-textfield-extrabig"
            ),
			array(
                "param_name" => "open_in_new_window",
                "type" => "checkbox",
                "value" => '',
                "heading" => __( "Open in new window",  'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "",
            ),
            array(
                "param_name" => "image_repeat",
                "type" => "dropdown",
                "value" => array(
                    'No Repeat' => '',
                    'Tile' => 'repeat',
                    'Tile Horizontally' => 'repeat-x',
                    'Tile Vertically' => 'repeat-y'
                ),
                "heading" => __( 'Image repeat', 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
            ),
            array(
                "param_name" => "image_size",
                "type" => "dropdown",
                "value" => array(
                    'Cover' => '',
                    'Full Width' => '100% auto',
                    'Full Height' => 'auto 100%',
                    'Auto' => 'auto',
                    'Contain' => 'contain'
                ),
                "heading" => __( 'Image size', 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
            ),
            array(
                "param_name" => "image_alignment",
                "type" => "dropdown",
                "value" => array(
                    'Top' => 'top',
                    'Center' => '',
                    'Bottom' => 'bottom'
                ),
                "heading" => __( 'Image alignment', 'td_composer' ),
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
            ),
        );

	    $align_params = array(
            array(
                "param_name" => "content_align_horizontal",
                "type" => "dropdown",
                "value" => array(
                    'Left' => 'content-horiz-left',
                    'Center' => 'content-horiz-center',
                    'Right' => 'content-horiz-right'
                ),
                "heading" => 'Horizontal align',
                "description" => "",
                "holder" => "div",
                'tdc_dropdown_images' => true,
                "class" => "tdc-visual-selector tdc-add-class",
            ),
            array(
                "param_name" => "content_align_vertical",
                "type" => "dropdown",
                "value" => array(
                    'Top' => 'content-vert-top',
                    'Center' => 'content-vert-center',
                    'Bottom' => 'content-vert-bottom'
                ),
                "heading" => 'Vertical align',
                "description" => "",
                "holder" => "div",
                'tdc_dropdown_images' => true,
                "class" => "tdc-visual-selector tdc-add-class",
            ),
        );

        $css_tabs_params = array (
            array(
                "param_name" => "separator",
                "type" => "horizontal_separator",
                "value" => "",
                "class" => ""
            ),
            array(
                'param_name' => 'el_class',
                'type' => 'textfield',
                'value' => '',
                'heading' => 'Extra class',
                'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS',
                'class' => 'tdc-textfield-extrabig',
            ),
            array (
                'param_name' => 'css',
                'value' => '',
                'type' => 'css_editor',
                'heading' => 'Css',
                'group' => 'Design options',
            ),
            array (
                'param_name' => 'tdc_css',
                'value' => '',
                'type' => 'tdc_css_editor',
                'heading' => '',
                'group' => 'Design options',
            ),
        );

	    // Blocks list
        td_api_block::add('tdm_block_text_image',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_text_image",
                'name' => __( 'Text with image', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
	            'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_text_image.php',
                'tdc_style_params' => array(
                    'title_text',
                    'description',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'image',
                    'el_class'
                ),
	            'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Text with image' ),
                                'title_tag' => 'h3',
                                'title_size' => 'tdm-title-md',
                                'description' => base64_encode( 'Each element can be added and moved around within any page effortlessly. All the features you need are just one click away.' ),
                                'button_text' => 'View all elements',
                                'button_tdicon' => 'tdc-font-fa tdc-font-fa-chevron-right',
                                'button_size'  => 'tdm-btn-lg',
                                'image' => self::tdm_get_image( 'tdm_pic_1' ),
                                'content_align_vertical' => 'content-vert-center',
                            )
                        )
                    )
                ),
                "params" =>
	                array_merge(
                        $this->get_group_params('title'),
                        array(
                            array(
                                'param_name' => 'description',
                                'type' => 'textarea_raw_html',
                                'value' => '',
                                'heading' => 'Description',
                                'description' => '',
                                'class' => 'tdc-textarea-small',
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                'heading' => 'General style',
                                "value" => "",
                                "class" => "",
                                "group" => "Style",
                            ),
                            array(
                                "type" => "colorpicker",
                                "holder" => "div",
                                "class" => "",
                                "heading" => 'Description text color',
                                "param_name" => "description_color",
                                "value" => '',
                                "description" => '',
                                "group" => "Style",
                            ),
                            array(
                                "type" => "colorpicker",
                                "holder" => "div",
                                "class" => "",
                                "heading" => 'Links color',
                                "param_name" => "links_color",
                                "value" => '',
                                "description" => '',
                                "group" => "Style",
                            ),
                        ),
                        td_config_helper::get_map_block_font_array( 'f_descr', true, 'Description text', 'Style' ),
                        array(
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                'heading' => 'Title style',
                                "value" => "",
                                "class" => "",
                                "group" => "Style",
                            ),
                            array(
                                "param_name" => "tds_title",
                                "type" => "dropdown",
                                "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                                "heading" => 'Title style',
                                "description" => "",
                                "holder" => "div",
                                "class" => "tdc-dropdown-big",
                                "group" => "Style",
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                'heading' => 'Button',
                                "value" => "",
                                "class" => "",
                            ),
                        ),
                        $this->get_group_params('button'),
                        array(
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                'heading' => 'Image',
                                "value" => "",
                                "class" => "",
                            ),
                            array(
                                "param_name" => "image",
                                "type" => "attach_image",
                                "value" => '',
                                "heading" => "Image",
                                "description" => "",
                                "holder" => "div",
                                "class" => "",
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                'heading' => 'Layout',
                                "value" => "",
                                "class" => "",
                            ),
                            array(
                                "param_name" => "layout",
                                "type" => "dropdown",
                                "value" => array(
                                    '1/2 - 1/2' => 'layout-12-12',
                                    '1/3 + 2/3' => 'layout-13-23',
                                    '2/3 + 1/3' => 'layout-23-13'
                                ),
                                "heading" => 'Layout',
                                "description" => "",
                                "holder" => "div",
                                'tdc_dropdown_images' => true,
                                "class" => "tdc-visual-selector tdc-add-class",
                            ),
                            array(
                                "param_name" => "extend_image",
                                "type" => "checkbox",
                                "value" => '',
                                "heading" => 'Extend image',
                                "description" => "",
                                "holder" => "div",
                                "class" => "",
                            ),
                            array(
                                "param_name" => "flip_content",
                                "type" => "checkbox",
                                "value" => '',
                                "heading" => 'Flip content',
                                "description" => "",
                                "holder" => "div",
                                "class" => "",
                            ),
                        ),
                        $align_params,
                        array(
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                "heading" => 'Google analytics',
                                "value" => "",
                                "class" => "",
                                "group" => 'Tracking'
                            ),
                            array(
                                'param_name' => 'ga_event_action',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'GA Event Action',
                                "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                'param_name' => 'ga_event_category',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'GA Event Category',
                                "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                'param_name' => 'ga_event_label',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'GA Event Label',
                                "description" => "The Google Analytics Event Label. This setting is optional.",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                "heading" => 'Facebook pixel',
                                "value" => "",
                                "class" => "",
                                "group" => 'Tracking'
                            ),
                            array(
                                'param_name' => 'fb_pixel_event_name',
                                "type" => "dropdown",
                                "value" => array(
                                    'Select Event' => '',
                                    'Lead' => 'Lead',
                                    'View Content' => 'ViewContent',
                                ),
                                "heading" => 'Events',
                                "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                                "holder" => "div",
                                'class' => 'tdc-dropdown-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                'param_name' => 'fb_pixel_event_content_name',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'Content Name',
                                "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                        ),
                        $css_tabs_params
	                ),
            )
        );

	    td_api_block::add('tdm_block_hero',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_hero",
                'name' => __( 'Hero', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
	            'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_hero.php',
                'tdc_in_row' => true,
	            'tdc_row_start_values' => base64_encode(
	                json_encode(
                    array(
                            'full_width'  => 'stretch_row_content td-stretch-content',
                        )
	                )
	            ),
	            'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode('Hero' ),
                                'title_size' => 'tdm-title-bg',
                                'description'  => base64_encode( 'Welcome to the future of building with WordPress. The elegant description could be the support for your call to action or just an attention-catching anchor. Whatever your plan is, our theme makes it simple to combine, rearrange and customize elements as you desire.' ),
                                'image' => self::tdm_get_image( 'tdm_pic_1' ),
                                'button_text'  => 'View all elements',
                                'button_tdicon' => 'tdc-font-fa tdc-font-fa-chevron-right',
                                'button_url' => '#',
                                'tds_button' => 'tds_button3',
                                'button_size'  => 'tdm-btn-lg',
                                'button_text-1'  => 'Explore features',
                                'button_tdicon-1' => 'tdc-font-fa tdc-font-fa-search',
                                'button_url-1' => '#',
                                'tds_button-1' => 'tds_button3',
                                'button_size-1' => 'tdm-btn-lg',
                                'block_width' => '1200',
                                'content_align_horizontal' => 'content-horiz-center',
                                'content_align_vertical' => 'content-vert-center',
                                'background' => 'eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiJyZ2JhKDIyLDExMiwxOTEsMC44NSkiLCJjb2xvcjIiOiJyZ2JhKDAsMCwwLDAuODUpIiwibWl4ZWRDb2xvcnMiOltdLCJjc3MiOiJiYWNrZ3JvdW5kOiAtd2Via2l0LWxpbmVhci1ncmFkaWVudCgwZGVnLHJnYmEoMCwwLDAsMC44NSkscmdiYSgyMiwxMTIsMTkxLDAuODUpKTtiYWNrZ3JvdW5kOiBsaW5lYXItZ3JhZGllbnQoMGRlZyxyZ2JhKDAsMCwwLDAuODUpLHJnYmEoMjIsMTEyLDE5MSwwLjg1KSk7IiwiY3NzUGFyYW1zIjoiMGRlZyxyZ2JhKDAsMCwwLDAuODUpLHJnYmEoMjIsMTEyLDE5MSwwLjg1KSJ9'
                            )
                        )
                    )
                ),
                'tdc_style_params' => array(
                    'title_text',
                    'description',
                    'image',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'button_text-1',
                    'button_url-1',
                    'button_tdicon-1',
                    'el_class'
                ),
                "params" => array_merge(
                    $this->get_group_params('title'),
                    array(
	                    array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-small',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => "Image",
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    $this->get_group_params('image'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => "General style",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "background",
		                    "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Color overlay",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description text color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Description text', 'Style' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Title style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_title",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                            "heading" => 'Title style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => "Buttons",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'button_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Buttons width',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                        ),
                    ),
                    $this->get_group_params('button'),
                    $this->get_group_params('button', 1),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => "Layout",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "block_width",
                            "type" => "dropdown-responsive",
                            "value" => array(
                                '1068px - Main grid width' => '1068',
                                '1200px' => '1200',
                                '1400px' => '1400',
                                '1600px' => '1600',
                                '1800px' => '1800',
                                'Full width' => '100%',
                            ),
                            "heading" => __( 'Content width', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'block_height',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Height',
                            'description' => '',
                            'class' => 'tdc-textfield-big',
                            'placeholder' => '600',
                        ),
                        array(
                            "param_name" => "block_full_height",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Full height",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                    ),
                    $align_params,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_fancy_text_image',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_fancy_text_image",
                'name' => __( 'Fancy text with image', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
	            'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_fancy_text_image.php',
                'tdc_in_row' => true,
	            'tdc_row_start_values' => base64_encode(
	                json_encode(
                        array(
                            'full_width'  => 'stretch_row_1200 td-stretch-content',
                        )
	                )
	            ),
	            'tdc_start_values' => base64_encode(
                    json_encode(
                        array (
                            array(
                                'image' => self::tdm_get_image( 'tdm_pic_2' ),
                                'tds_button' => 'tds_button3',
                                'button_size' => 'tdm-btn-lg',
                                'title1' => 'Fancy',
                                'title2' => 'elements',
                                'title_tag' => 'h3',
                                'button_text' => 'View all elements',
                                'description' => base64_encode( 'Welcome to the future of building with WordPress. The elegant description could be the support for your call to action or just an attention-catching anchor. Whatever your plan is, our theme makes it simple to combine, rearrange and customize elements as you desire.' ),
                            )
                        )
                    )
                ),
                'tdc_style_params' => array(
                    'title1',
                    'title2',
                    'description',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'image',
                    'el_class'
                ),
                "params" =>
                    array_merge(
                        array(
                            array(
                                'param_name' => 'title1',
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Title line 1',
                                'description' => '',
                                'class' => 'tdc-textfield-extrabig',
                            ),
                            array(
                                'param_name' => 'title2',
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Title line 2',
                                'description' => '',
                                'class' => 'tdc-textfield-extrabig',
                            ),
                            array(
                                "param_name" => "title_tag",
                                "type" => "dropdown",
                                "value" => array(
                                    'H1' => 'h1',
                                    'H2' => 'h2',
                                    'H3 - Default' => 'h3',
                                    'H4' => 'h4',
                                ),
                                "heading" => 'Title tag (SEO)',
                                "description" => "",
                                "holder" => "div",
                                "class" => "tdc-dropdown-big",
                            ),
                            array(
                                'param_name' => 'description',
                                'type' => 'textarea_raw_html',
                                'value' => '',
                                'heading' => 'Description',
                                'description' => '',
                                'class' => 'tdc-textarea-small',
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                'heading' => 'General style',
                                "value" => "",
                                "class" => "",
                                "group" => "Style",
                            ),
                            array(
                                "type" => "gradient",
                                "holder" => "div",
                                "class" => "",
                                "heading" => 'Title line 1 color',
                                "param_name" => "text1_color",
                                "value" => '',
                                "description" => '',
                                "group" => "Style",
                            ),
                            array(
                                "type" => "gradient",
                                "holder" => "div",
                                "class" => "",
                                "heading" => 'Title line 2 color',
                                "param_name" => "text2_color",
                                "value" => '',
                                "description" => '',
                                "group" => "Style",
                            ),
                            array(
                                "type" => "colorpicker",
                                "holder" => "div",
                                "class" => "",
                                "heading" => 'Description color',
                                "param_name" => "description_color",
                                "value" => '',
                                "description" => '',
                                "group" => "Style",
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "horizontal_separator",
                                "value" => "",
                                "class" => "",
                                "group" => "Style",
                            ),
                        ),
                        td_config_helper::get_map_block_font_array( 'f_title1', true, 'Title 1 text', 'Style' ),
                        td_config_helper::get_map_block_font_array( 'f_title2', false, 'Title 2 text', 'Style' ),
                        td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' ),
                        $this->get_group_params('button'),
                        array(
                            array(
                                "param_name" => "separator",
                                "type" => "horizontal_separator",
                                "value" => "",
                                "class" => ""
                            ),
                            array(
                                "param_name" => "image",
                                "type" => "attach_image",
                                "value" => '',
                                "heading" => "Image",
                                "description" => "",
                                "holder" => "div",
                                "class" => "",
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "horizontal_separator",
                                "value" => "",
                                "class" => ""
                            ),
                            array(
                                "param_name" => "layout",
                                "type" => "dropdown",
                                "value" => array(
                                    'Default' => 'layout-default',
                                    '1/2 - 1/2' => 'layout-12-12',
                                    '1/3 + 2/3' => 'layout-13-23',
                                    '2/3 + 1/3' => 'layout-23-13'
                                ),
                                "heading" => 'Layout',
                                "description" => "",
                                "holder" => "div",
                                'tdc_dropdown_images' => true,
                                "class" => "tdc-visual-selector tdc-add-class",
                            ),
                            array(
                                "param_name" => "flip_content",
                                "type" => "checkbox",
                                "value" => '',
                                "heading" => 'Flip content',
                                "description" => "",
                                "holder" => "div",
                                "class" => "",
                            ),
                        ),
                        $align_params,
                        array(
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                "heading" => 'Google analytics',
                                "value" => "",
                                "class" => "",
                                "group" => 'Tracking'
                            ),
                            array(
                                'param_name' => 'ga_event_action',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'GA Event Action',
                                "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                'param_name' => 'ga_event_category',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'GA Event Category',
                                "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                'param_name' => 'ga_event_label',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'GA Event Label',
                                "description" => "The Google Analytics Event Label. This setting is optional.",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                "param_name" => "separator",
                                "type" => "text_separator",
                                "heading" => 'Facebook pixel',
                                "value" => "",
                                "class" => "",
                                "group" => 'Tracking'
                            ),
                            array(
                                'param_name' => 'fb_pixel_event_name',
                                "type" => "dropdown",
                                "value" => array(
                                    'Select Event' => '',
                                    'Lead' => 'Lead',
                                    'View Content' => 'ViewContent',
                                ),
                                "heading" => 'Events',
                                "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                                "holder" => "div",
                                'class' => 'tdc-dropdown-big',
                                'group' => 'Tracking',
                            ),
                            array(
                                'param_name' => 'fb_pixel_event_content_name',
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'Content Name',
                                "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                                'class' => 'tdc-textfield-big',
                                'group' => 'Tracking',
                            ),
                        ),
                        $css_tabs_params
                    ),
            )
        );

        td_api_block::add('tdm_block_column_content',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_column_content",
                'name' => __( 'Column content', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_column_content.php',
                'tdc_style_params' => array(
                    'title_text',
                    'url',
                    'description',
                    'image1',
                    'image2',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Column content' ),
                                'title_tag' => 'h3',
                                'title_size' => 'tdm-title-md',
                                'url' => '#',
                                'open_in_new_window' => 'yes',
                                'image1' => self::tdm_get_image( 'tdm_pic_1' ),
                                'image2' => self::tdm_get_image( 'tdm_pic_2' ),
                                'description' => base64_encode( 'Each template in our ever growing studio library can be added and moved around within any page effortlessly with one click.' ),
                            ),
                            array(
                                'tdc_preset_name' => 'Centered narrow image',
                                'title_text' => base64_encode( 'Column content title' ),
                                'description' => base64_encode( 'Each template in our ever growing studio library can be added and moved around within any page effortlessly with one click.' ),
                                "title_tag" => "h3",
                                "title_size" => "tdm-title-md",
                                "url" => "#",
                                "open_in_new_window" => "yes",
                                "images_height1" => "0%",
                                "images_height" => "eyJhbGwiOiI1MCUiLCJwaG9uZSI6IjEwMCUifQ==",
                                "button_text" => "Read more",
                                "button_size" => "tdm-btn-md",
                                "tdc_css" => "eyJhbGwiOnsiZGlzcGxheSI6ImlubGluZS1ibG9jayJ9LCJwaG9uZSI6eyJwYWRkaW5nLWJvdHRvbSI6IjYwIiwiZGlzcGxheSI6IiJ9LCJwaG9uZV9tYXhfd2lkdGgiOjc2N30=",
                                "f_descr_font_size" => "eyJhbGwiOiIxNiIsInBob25lIjoiMTQifQ==",
                                "tds_title1-f_title_font_weight" => "300",
                                "image_height" => "723",
                                "image_width" => "1068",
                                "f_descr_font_line_height" => "eyJhbGwiOiIxLjUiLCJwaG9uZSI6IjEuNyJ9",
                                "tds_title1-f_title_font_size" => "eyJhbGwiOiIzNiIsInBob25lIjoiMzIifQ==",
                                "tds_button1-border_radius" => "50",
                                "tds_title1-f_title_font_family" => "",
                                "tds_button1-f_btn_text_font_transform" => "uppercase",
                                "tds_title1-f_title_font_line_height" => "eyJhbGwiOiIxLjIiLCJwaG9uZSI6IjEuMiJ9",
                                "content_align_horizontal" => "content-horiz-center",
                                "f_descr_font_weight" => "300",
                                'image1' => self::tdm_get_image( 'tdm_pic_1' ),
                                'image2' => self::tdm_get_image( 'tdm_pic_2' ),
                            ),
                            array(
                                'tdc_preset_name' => 'Side tall image',
                                'title_text' => base64_encode( 'Column content title' ),
                                'description' => base64_encode( 'Each template in our ever growing studio library can be added and moved around within any page effortlessly with one click.' ),
                                "title_tag" => "h3",
                                "title_size" => "tdm-title-md",
                                "url" => "#",
                                "open_in_new_window" => "yes",
                                "images_height" => "100%",
                                "button_text" => "Read more",
                                "f_descr_font_size" => "14",
                                "f_descr_font_line_height" => "1.5",
                                "f_descr_font_weight" => "",
                                "tds_title1-f_title_font_transform" => "uppercase",
                                "tds_title1-f_title_font_weight" => "700",
                                'image1' => self::tdm_get_image( 'tdm_pic_1' ),
                                'image2' => self::tdm_get_image( 'tdm_pic_2' ),
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    $this->get_group_params('title'),
                    array(
                        array(
                            'param_name' => 'url',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Url',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            'param_name' => 'descr_padding',
                            'type' => 'textfield-responsive',
                            'placeholder' => '0px 0px 0px 0px',
                            'value' => '',
                            'heading' => 'Description padding',
                            'description' => '',
                            'class' => 'tdc-textfield-big',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "image1",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => __( "Image", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "image2",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => __( "Image on hover", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'images_height',
                            'type' => 'range_multiple-responsive',
                            'heading' => 'Image height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'value' => '',
                            'tdc_values' => array(
                                'percent' => array(
                                    'unit' => '%',
                                    'value' => '70',
                                    'range_min' => '0',
                                    'range_max' => '100',
                                    'range_step' => '1',
                                ),
                                'px' => array(
                                    'unit' => 'px',
                                    'value' => '250',
                                    'range_min' => '0',
                                    'range_max' => '1000',
                                    'range_step' => '10',
                                )
                            ),
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'General style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Description text', 'Style' ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Title style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_title",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                            "heading" => 'Title style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    $this->get_group_params('button'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                    ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_inline_text',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_inline_text",
                'name' => __( 'Inline text', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_inline_text.php',
                'tdc_style_params' => array(
                    'description',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'description' => base64_encode( 'Each template in our ever growing studio library can be added and moved around within any page effortlessly with one click. Combine them, rearrange them and customize them further as much as you desire. Welcome to the future of building with WordPress.' ),
                                'display_inline' => 'yes',
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-small',
                        ),
                        array(
                            "param_name" => "display_inline",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Display inline",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'General style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Links color',
                            "param_name" => "links_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Links hover color',
                            "param_name" => "links_color_h",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Description text' ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_inline_image',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_inline_image",
                'name' => __( 'Inline single image', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_inline_image.php',
                'tdc_style_params' => array(
                    'image',
                    'caption_text',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'image' => self::tdm_get_image( 'tdm_pic_7' ),
                                'display_inline' => 'yes',
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            "param_name" => "image",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => "Image",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'caption_text',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Caption text',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "caption_position",
                            "type" => "dropdown",
                            "value" => array(
                                'Below image' => '',
                                'Over the image' => 'over-image',
                            ),
                            "heading" => 'Caption position',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'img_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image width',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => 'auto',
                        ),
                        array(
                            "param_name" => "modal_image",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Modal image",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "display_inline",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Display inline",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Caption text color',
                            "param_name" => "caption_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "caption_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Caption background color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "overlay_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Image overlay color",
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 0 ),
                    array(
	                    array(
		                    'param_name' => 'fe_brightness',
		                    'type' => 'range',
		                    'value' => '1',
		                    'heading' => 'Brightness',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '3',
		                    'range_step' => '0.1',
		                    'group' => 'Effects',
	                    ),
	                    array(
		                    'param_name' => 'fe_contrast',
		                    'type' => 'range',
		                    'value' => '1',
		                    'heading' => 'Contrast',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '3',
		                    'range_step' => '0.1',
		                    'group' => 'Effects',
	                    ),
	                    array(
		                    'param_name' => 'fe_grayscale',
		                    'type' => 'range',
		                    'value' => '0',
		                    'heading' => 'Grayscale',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '1',
		                    'range_step' => '0.1',
		                    'group' => 'Effects',
	                    ),
	                    array(
		                    'param_name' => 'fe_hue_rotate',
		                    'type' => 'range',
		                    'value' => '0',
		                    'heading' => 'Hue rotate',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '-360',
		                    'range_max' => '360',
		                    'range_step' => '10',
		                    'group' => 'Effects',
	                    ),
	                    array(
		                    'param_name' => 'fe_saturate',
		                    'type' => 'range',
		                    'value' => '1',
		                    'heading' => 'Saturate',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '3',
		                    'range_step' => '0.1',
		                    'group' => 'Effects',
	                    ),
	                    array(
		                    'param_name' => 'fe_sepia',
		                    'type' => 'range',
		                    'value' => '0',
		                    'heading' => 'Sepia',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '1',
		                    'range_step' => '0.1',
		                    'group' => 'Effects',
	                    ),
	                    array(
		                    'param_name' => 'fe_blur',
		                    'type' => 'range',
		                    'value' => '0',
		                    'heading' => 'Blur',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '30',
		                    'range_step' => '1',
		                    'group' => 'Effects',
	                    ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_caption', true, 'Caption text' ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_image_info_box',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_image_info_box",
                'name' => __( 'Image info box', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_image_info_box.php',
                'tdc_style_params' => array(
                    'box_image',
                    'box_title',
                    'box_description',
                    'box_custom_url',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'box_style' => 'style-2',
                                'box_image' => self::tdm_get_image( 'tdm_pic_1' ),
                                'box_title' => 'Title image box',
                                'box_description' => base64_encode( 'Add an Introductory Description to make your audience curious by simply setting an Excerpt on this section' ),
                                'box_overlay' => 'eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiJyZ2JhKDMwLDExNSwxOTAsMC43KSIsImNvbG9yMiI6InJnYmEoMCwxOSwzOCwwLjgpIiwibWl4ZWRDb2xvcnMiOltdLCJkZWdyZWUiOiIzMCIsImNzcyI6ImJhY2tncm91bmQ6IC13ZWJraXQtbGluZWFyLWdyYWRpZW50KDMwZGVnLHJnYmEoMCwxOSwzOCwwLjgpLHJnYmEoMzAsMTE1LDE5MCwwLjcpKTtiYWNrZ3JvdW5kOiBsaW5lYXItZ3JhZGllbnQoMzBkZWcscmdiYSgwLDE5LDM4LDAuOCkscmdiYSgzMCwxMTUsMTkwLDAuNykpOyIsImNzc1BhcmFtcyI6IjMwZGVnLHJnYmEoMCwxOSwzOCwwLjgpLHJnYmEoMzAsMTE1LDE5MCwwLjcpIn0=',
                                'tds_button' => 'tds_button3',
                                'button_size' => 'tdm-btn-md',
                                'button_text' => 'LEARN MORE',
                                'button_icon_size' => '18',
                                'button_url' => '#',
                                'button_tdicon' => 'tdc-font-fa tdc-font-fa-graduation-cap',
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            "param_name" => "box_image",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => "Image",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'box_height',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '300',
                        ),
                        array(
                            'param_name' => 'box_title',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Title',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            'param_name' => 'box_description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "box_custom_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => "Image url",
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig",
                        ),
                        array(
                            "param_name" => "box_open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "box_style",
                            "type" => "dropdown",
                            "value" => array(
                                '1 - Default' => '',
                                '2 - Animated' => 'style-2'
                            ),
                            "heading" => 'Box style',
                            "description" => "Block images box style",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Box color overlay',
                            "param_name" => "box_overlay",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "box_title_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border bottom color',
                            "param_name" => "box_border",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover box color overlay',
                            "param_name" => "hover_box_overlay",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover title color',
                            "param_name" => "hover_box_title_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover description color',
                            "param_name" => "hover_box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover border color',
                            "param_name" => "hover_box_border",
                            "value" => '',
                            "description" => '',
                            "group" => 'Style'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => 'Style'
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' ),
                    $this->get_group_params('button'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "box_content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "box_content_align_vertical",
                            "type" => "dropdown",
                            "value" => array(
                                'Top' => 'content-vert-top',
                                'Center' => 'content-vert-center',
                                'Bottom' => 'content-vert-bottom'
                            ),
                            "heading" => 'Vertical align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                    ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_button',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_button",
                'name' => __( 'Button', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_button.php',
                'tdc_style_params' => array(
                	'button_text',
                    'button_url',
                    'button_tdicon',
                    'icon_video_url',
                    'scroll_to_class',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'button_text' => 'Button text',
                                'button_size'  => 'tdm-btn-lg',
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Blue',
                                'button_text' => 'Sign up for 7-day trial now',
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button3",
                                "tds_button3-border_radius" => "3",
                                "tds_button3-shadow_offset_vertical" => "8",
                                "tds_button3-text_color" => "#ffffff",
                                "tds_button3-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjNTYzOWU1IiwiY29sb3IyIjoiIzQ0ODFmYyIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NDgxZmMsIzU2MzllNSk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUifQ==",
                                "tds_button3-background_hover_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjM2M1YWYyIiwiY29sb3IyIjoiIzQ0YThmZiIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NGE4ZmYsIzNjNWFmMik7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDRhOGZmLCMzYzVhZjIpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDRhOGZmLCMzYzVhZjIifQ==",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Orange',
                                'button_text' => 'Start trial now',
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button3",
                                "tds_button3-shadow_offset_vertical" => "8",
                                "tds_button3-border_radius" => "3",
                                "tds_button3-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjZjdhMDA5IiwiY29sb3IyIjoiI2Y2NzY3ZiIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiLTYwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoLTYwZGVnLCNmNjc2N2YsI2Y3YTAwOSk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KC02MGRlZywjZjY3NjdmLCNmN2EwMDkpOyIsImNzc1BhcmFtcyI6Ii02MGRlZywjZjY3NjdmLCNmN2EwMDkifQ==",
                                "tds_button3-text_color" => "#ffffff",
                                "tds_button3-background_hover_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjZjc5YzAwIiwiY29sb3IyIjoiI2Y0NTU2MCIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiLTYwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoLTYwZGVnLCNmNDU1NjAsI2Y3OWMwMCk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KC02MGRlZywjZjQ1NTYwLCNmNzljMDApOyIsImNzc1BhcmFtcyI6Ii02MGRlZywjZjQ1NTYwLCNmNzljMDAifQ==",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Black',
                                'button_text' => 'Video tutorials',
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button3",
                                "tds_button3-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjMzUzNTM1IiwiY29sb3IyIjoiIzRjNGM0YyIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0YzRjNGMsIzM1MzUzNSk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNGM0YzRjLCMzNTM1MzUpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNGM0YzRjLCMzNTM1MzUifQ==",
                                "tds_button3-text_color" => "#ffffff",
                                "tds_button3-shadow_offset_vertical" => "8",
                                "tds_button3-border_radius" => "3",
                                "tds_button3-background_hover_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjZjc5YzAwIiwiY29sb3IyIjoiI2Y0NTU2MCIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiLTYwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoLTYwZGVnLCNmNDU1NjAsI2Y3OWMwMCk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KC02MGRlZywjZjQ1NTYwLCNmNzljMDApOyIsImNzc1BhcmFtcyI6Ii02MGRlZywjZjQ1NTYwLCNmNzljMDAifQ==",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Gray Border',
                                'button_text' => 'Request a demo showing',
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button2",
                                "tds_button2-border_radius" => "3",
                                "tds_button2-text_color" => "#d6d6d6",
                                "tds_button2-border_color" => "#d6d6d6",
                                "tds_button2-text_hover_color" => "#d6d6d6",
                                "tds_button2-border_hover_color" => "#ea2f53",
                            ),
                            array(
                                'tdc_preset_name' => 'Technology Hub - Big Blue Outline',
                                "button_size" => "tdm-btn-xlg",
                                "tds_button" => "tds_button2",
                                "tds_button2-border_radius" => "50",
                                "button_text" => "Sign up for your free kit",
                                "tds_button2-text_color" => "#22a0d6",
                                "tds_button2-border_color" => "#22a0d6",
                                "tds_button2-border_size" => "3",
                                "tds_button2-text_hover_color" => "#444444",
                                "tds_button2-border_hover_color" => "#444444",
                                "tds_button2-f_btn_text_font_transform" => "uppercase",
                            ),
                            array(
                                'tdc_preset_name' => 'Dental Studio - Blue Marine',
                                'button_text' => 'Make an appointment',
                                "button_size" => "tdm-btn-md",
                                "tds_button" => "tds_button1",
                                "tds_button1-border_radius" => "100",
                                "tds_button1-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjMjJhM2Q2IiwiY29sb3IyIjoiIzM5ZTVkNCIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMjAwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMjAwZGVnLCMzOWU1ZDQsIzIyYTNkNik7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDIwMGRlZywjMzllNWQ0LCMyMmEzZDYpOyIsImNzc1BhcmFtcyI6IjIwMGRlZywjMzllNWQ0LCMyMmEzZDYifQ==",
                                "tds_button1-text_color" => "#ffffff",
                                "tds_button1-background_hover_color" => "#444444",
                                "tds_button1-text_hover_color" => "#ffffff",
                                "tds_button1-f_btn_text_font_transform" => "uppercase",
                            ),
                            array(
                                'tdc_preset_name' => 'Law Firm - Brown',
                                'button_text' => 'Contact us',
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button6",
                                "tds_button6-border_hover_color" => "#000000",
                                "tds_button6-text_color" => "#000000",
                                "tds_button6-border_color" => "#c6ac3f",
                                "tds_button6-shadow_color" => "rgba(198,172,63,0.14)",
                                "tds_button6-f_btn_text_font_transform" => "uppercase",
                            ),
                            array(
                                'tdc_preset_name' => 'Spa Heaven - Simple Pink',
                                "button_text" => "VIEW ALL SERVICES",
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button3",
                                "tds_button3-background_color" => "#ea967c",
                                "tds_button3-text_color" => "#ffffff",
                                "tds_button3-background_hover_color" => "#ea967c",
                                "tds_button3-text_hover_color" => "#ffffff",
                                "tds_button3-shadow_size" => "16",
                                "tds_button3-shadow_offset_vertical" => "2",
                                "tds_button3-shadow_hover_size" => "26",
                                "tds_button3-shadow_hover_offset_vertical" => "2",
                                "tds_button3-shadow_hover_color" => "rgba(0,0,0,0.1)",
                                "tds_button3-shadow_color" => "rgba(0,0,0,0.12)",
                                "tds_button3-shadow_shadow_color" => "rgba(0,0,0,0.1)",
                                "tds_button3-shadow_hover_shadow_color" => "rgba(0,0,0,0.2)",
                                "tds_button3-f_btn_text_font_size" => "13",
                                "tds_button3-f_btn_text_font_transform" => "uppercase",
                            ),
                            array(
                                'tdc_preset_name' => 'Nature Love - Simple Outline',
                                "button_text" => "BECOME A VOLUNTEER",
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button2",
                                "tds_button2-border_color" => "#444444",
                                "tds_button2-text_color" => "#444444",
                                "tds_button2-text_hover_color" => "#81c132",
                                "tds_button2-border_hover_color" => "#81c132",
                                "tds_button2-f_btn_text_font_size" => "15",
                                "tds_button3-f_btn_text_font_weight" => "500",
                                "tds_button3-f_btn_text_font_transform" => "uppercase",
                            ),
                            array(
                                'tdc_preset_name' => 'Raw & Wild - Rounded Orange',
                                "button_text" => "Explore Trips",
                                "button_size" => "tdm-btn-md",
                                "tds_button1-border_radius" => "50",
                                "tds_button" => "tds_button1",
                                "tds_button1-background_color" => "#dd9933",
                                "tds_button1-text_color" => "#ffffff",
                                "tds_button1-icon_color" => "#ffffff",
                                "tds_button1-background_hover_color" => "#444444",
                                "tds_button1-text_hover_color" => "#ffffff",
                                "tds_button1-icon_hover_color" => "#ffffff",
                                "tds_button1-f_btn_text_font_size" => "13",
                                "tds_button1-f_btn_text_font_transform" => "uppercase",
                                "button_tdicon" => "tdc-font-tdmp tdc-font-tdmp-arrow-right",
                                "button_icon_space" => "8",
                            ),
                            array(
                                'tdc_preset_name' => 'Wine Aroma - Arrow Before',
                                "button_text" => "Show more",
                                "button_size" => "tdm-btn-md",
                                "tds_button" => "tds_button5",
                                "tds_button5-text_color" => "#ccb930",
                                "tds_button5-icon_color" => "#ccb930",
                                "tds_button5-text_hover_color" => "#444",
                                "tds_button5-icon_hover_color" => "#444",
                                "f_btn_text_font_size" => "14",
                                "f_btn_text_font_weight" => "600",
                                "f_btn_text_font_family" => "438",
                                "button_icon" => "tdc-font-tdmp tdc-font-tdmp-arrow-right",
                                "button_icon_position" => "icon-before",
                                "button_icon_size" => "32",
                                "button_icon_space" => "20",
                                "f_btn_text_font_spacing" => "2",
                                "f_btn_text_font_line_height" => "1",
                                "button_tdicon" => "tdc-font-tdmp tdc-font-tdmp-arrow-right",
                                "tds_button5-f_btn_text_font_size" => "14",
                                "tds_button5-f_btn_text_font_transform" => "uppercase",
                            ),
                            array(
                                'tdc_preset_name' => 'Coffee Blog - Thin Gray',
                                "button_text" => "Read more",
                                "button_size" => "tdm-btn-lg",
                                "tds_button" => "tds_button2",
                                "tds_button2-border_color" => "#888888",
                                "tds_button2-text_color" => "#888888",
                                "tds_button2-f_btn_text_font_size" => "15",
                                "tds_button2-f_btn_text_font_weight" => "300",
                                "tds_button2-f_btn_text_font_line_height" => "3",
                                "button_icon_space" => "10",
                                "button_icon_size" => "12",
                                "tds_button2-border_size" => "1",
                                "tds_button2-border_radius" => "50",
                                "tds_button2-icon_color" => "#222222",
                                "tds_button2-border_hover_color" => "#222222",
                                "tds_button2-text_hover_color" => "#888888",
                                "tds_button2-icon_hover_color" => "#222222",
                                "button_tdicon" => "tdc-font-tdmp tdc-font-tdmp-arrow-small-right",
                            ),

                        )
                    )
                ),
                "params" => array_merge(
                    $this->get_group_params('button'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'icon_video_url',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Video popup',
                            'description' => 'Youtube or Vimeo video url',
                            'class' => 'tdc-textfield-extrabig'
                        ),
                        array(
                            'param_name' => 'scroll_to_class',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Scroll to class',
                            'description' => 'On click will scroll to an element with this class',
                            'class' => 'tdc-textfield-extrabig'
                        ),
                        array(
                            'type' => 'range',
                            'param_name' => 'scroll_offset',
                            'value' => '0',
                            'heading' => 'Scroll offset',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-100',
                            'range_max' => '100',
                            'range_step' => '1'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "button_display",
                            "type" => "dropdown",
                            "value" => array(
                                'Default' => '',
                                'Inline' => 'tdm-block-button-inline',
                                'Full width' => 'tdm-block-button-full',
                            ),
                            "heading" => __( 'Button display', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big"
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class"
                        ),
                    ),
                    $css_tabs_params,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    )
                )
            )
        );

	    td_api_block::add('tdm_block_column_title',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_column_title",
                'name' => __( 'Column title', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_column_title.php',
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Custom title' ),
                                'title_tag' => 'h3',
                                'title_size' => 'tdm-title-md',
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    $this->get_group_params('title'),
                    array(
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "tds_title",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                            "heading" => 'Title style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_team_member',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_team_member",
                'name' => __( 'Team member', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_team_member.php',
                'tdc_style_params' => array(
                    'name',
                    'job_title',
                    'description',
                    'image',
                    'behance',
                    'blogger',
                    'dribbble',
                    'facebook',
                    'flickr',
                    'googleplus',
                    'instagram',
                    'lastfm',
                    'linkedin',
                    'pinterest',
                    'rss',
                    'soundcloud',
                    'tumblr',
                    'twitter',
                    'vimeo',
                    'youtube',
                    'vk',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'image' => self::tdm_get_image( 'tdm_pic_9' ),
                                'name' => 'John Doe',
                                'job_title' => 'Manager',
                                'description' => base64_encode( 'Each element can be added and moved around within any page effortlessly. All the features you need are just one click away.' ),
                                'tds_social' => 'tds_social3',
                                'facebook' => '#',
                                'twitter' => '#',
                                'instagram' => '#',
                                'tds_team_member2-description_align_vertical' => 'content-vert-center',
                            ),
                            array(
                                'tdc_preset_name' => 'Simple white with shadow',
                                'image' => self::tdm_get_image( 'tdm_pic_9' ),
                                "name" => "Martin Smith",
                                "job_title" => "Blogger",
                                "description" => base64_encode( 'Each element can be added and moved around within any page effortlessly. All the features you need are just one click away.' ),
                                "tds_social" => "tds_social3",
                                "facebook" => "#",
                                "twitter" => "#",
                                "instagram" => "#",
                                "tds_team_member" => "tds_team_member1",
                                "content_align_horizontal" => "content-horiz-center",
                                "image_border_radius" => "50%",
                                "img_height" => "100%",
                                "tds_team_member1-image_width" => "90%",
                                "tds_team_member1-f_title_font_size" => "eyJhbGwiOiIyNSIsInBvcnRyYWl0IjoiMjIifQ==",
                                "tds_team_member1-f_title_font_family" => "523",
                                "tds_team_member1-f_title_font_weight" => "",
                                "tds_team_member1-f_title_font_transform" => "",
                                "tds_social3-border_radius" => "50%",
                                "icons_size" => "15",
                                "icons_spacing" => "15",
                                "tds_team_member1-f_title_font_line_height" => "1.3",
                                "tds_team_member1-f_job_title_font_weight" => "",
                                "tds_team_member1-f_job_title_font_transform" => "uppercase",
                                "tds_team_member1-f_descr_font_size" => "eyJhbGwiOiIxNCIsInBvcnRyYWl0IjoiMTMifQ==",
                                "tds_team_member1-f_descr_font_line_height" => "1.7",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy10b3AiOiI0MCIsInBhZGRpbmctcmlnaHQiOiIxMCIsInBhZGRpbmctYm90dG9tIjoiMzUiLCJwYWRkaW5nLWxlZnQiOiIxMCIsInNoYWRvdy1zaXplIjoiMjAiLCJzaGFkb3ctY29sb3IiOiJyZ2JhKDAsMCwwLDAuMSkiLCJkaXNwbGF5IjoiIn0sInBob25lIjp7ImRpc3BsYXkiOiIifSwicGhvbmVfbWF4X3dpZHRoIjo3NjcsInBvcnRyYWl0Ijp7InBhZGRpbmctdG9wIjoiMjAiLCJwYWRkaW5nLWJvdHRvbSI6IjE1IiwiZGlzcGxheSI6IiJ9LCJwb3J0cmFpdF9tYXhfd2lkdGgiOjEwMTgsInBvcnRyYWl0X21pbl93aWR0aCI6NzY4fQ==",
                                "tds_social3-icons_background_color" => "#444444",
                                "social_icons_space" => "-5",
                            ),
                            array(
                                'tdc_preset_name' => 'Simple white side image',
                                'image' => self::tdm_get_image( 'tdm_pic_9' ),
                                "name" => "Martin Smith",
                                "job_title" => "Blogger",
                                "description" => base64_encode( 'Each element can be added and moved around within any page effortlessly.' ),
                                "tds_social" => "tds_social2",
                                "facebook" => "#",
                                "twitter" => "#",
                                "instagram" => "#",
                                "tds_team_member" => "tds_team_member3",
                                "img_height" => "100%",
                                "tds_team_member3-image_space" => "20",
                                "tds_team_member3-f_title_font_size" => "24",
                                "tds_team_member3-f_descr_font_size" => "13",
                                "tds_team_member3-f_descr_font_line_height" => "1.5",
                                "tds_team_member3-f_job_title_font_size" => "13",
                                "tds_team_member3-f_title_font_family" => "438",
                                "tds_team_member3-f_job_title_font_family" => "",
                                "tds_team_member3-f_descr_font_family" => "",
                                "social_icons_space" => "-15",
                                "icons_padding" => "1",
                                "icons_spacing" => "20",
                                "tds_team_member3-f_title_font_line_height" => "1.3",
                                "tds_team_member3-f_job_title_font_line_height" => "2",
                                "tds_team_member3-image_width" => "eyJwb3J0cmFpdCI6IjQwJSJ9",
                                "tds_team_member3-content_align_vertical" => "content-vert-top",
                            ),
                            array(
                                'tdc_preset_name' => 'Calligraphic with background',
                                'image' => self::tdm_get_image( 'tdm_pic_9' ),
                                "name" => "Martin Smith",
                                "job_title" => "Blogger",
                                "description" => base64_encode( 'Each element can be added and moved around within any page effortlessly. All the features you need are just one click away.' ),
                                "tds_social" => "tds_social5",
                                "facebook" => "#",
                                "twitter" => "#",
                                "instagram" => "#",
                                "tds_team_member" => "tds_team_member1",
                                "content_align_horizontal" => "content-horiz-center",
                                "img_height" => "100%",
                                "tds_team_member1-f_title_font_size" => "eyJhbGwiOiIyOCIsInBvcnRyYWl0IjoiMjIifQ==",
                                "tds_team_member1-f_title_font_family" => "458",
                                "tds_team_member1-f_title_font_weight" => "",
                                "tds_team_member1-f_title_font_transform" => "",
                                "icons_spacing" => "15",
                                "tds_team_member1-f_title_font_line_height" => "1.4",
                                "tds_team_member1-f_job_title_font_weight" => "600",
                                "tds_team_member1-f_job_title_font_transform" => "",
                                "tds_team_member1-f_descr_font_size" => "eyJhbGwiOiIxNCIsInBvcnRyYWl0IjoiMTMifQ==",
                                "tds_team_member1-f_descr_font_line_height" => "1.7",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy10b3AiOiIyMCIsInBhZGRpbmctcmlnaHQiOiIyMCIsInBhZGRpbmctYm90dG9tIjoiMjAiLCJwYWRkaW5nLWxlZnQiOiIyMCIsImJhY2tncm91bmQtY29sb3IiOiIjZmZmNWU1IiwiZGlzcGxheSI6IiJ9LCJwaG9uZSI6eyJkaXNwbGF5IjoiIn0sInBob25lX21heF93aWR0aCI6NzY3LCJwb3J0cmFpdCI6eyJwYWRkaW5nLXRvcCI6IjEwIiwicGFkZGluZy1yaWdodCI6IjEwIiwicGFkZGluZy1ib3R0b20iOiIxMCIsInBhZGRpbmctbGVmdCI6IjEwIiwiZGlzcGxheSI6IiJ9LCJwb3J0cmFpdF9tYXhfd2lkdGgiOjEwMTgsInBvcnRyYWl0X21pbl93aWR0aCI6NzY4fQ==",
                                "tds_social5-icons_color" => "#064082",
                                "tds_social5-shadow_shadow_color" => "rgba(0,0,0,0.08)",
                                "social_icons_space" => "eyJhbGwiOi01LCJwb3J0cmFpdCI6Ii0xNSJ9",
                                "tds_team_member1-f_job_title_font_size" => "eyJhbGwiOiIxNiIsInBvcnRyYWl0IjoiMTQifQ==",
                                "tds_team_member1-f_job_title_font_line_height" => "1.7",
                                "tds_team_member1-description_color" => "rgba(0,0,0,0.7)",
                                "tds_team_member1-title_color" => "rgba(6,64,130,0.8)",
                                "tds_team_member1-name_color" => "#064082",
                                "tds_social5-icons_background_color" => "rgba(255,255,255,0.5)",
                                "tds_social5-icons_background_hover_color" => "rgba(255,255,255,0.8)",
                                "tds_team_member1-f_job_title_font_family" => "438",
                                "tds_social5-border_radius" => "4",
                                "icons_size" => "eyJhbGwiOjE0LCJwb3J0cmFpdCI6IjEyIn0=",
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'name',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Name',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            "param_name" => "name_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H3 - Default' => '',
                                'H4' => 'h4',
                            ),
                            "heading" => 'Name tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'job_title',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Job title',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Image',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "image",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => __( "Image", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "image_repeat",
                            "type" => "dropdown",
                            "value" => array(
                                'No Repeat' => '',
                                'Tile' => 'repeat',
                                'Tile Horizontally' => 'repeat-x',
                                'Tile Vertically' => 'repeat-y'
                            ),
                            "heading" => __( 'Image repeat', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            "param_name" => "image_size",
                            "type" => "dropdown",
                            "value" => array(
                                'Cover' => '',
                                'Full Width' => '100% auto',
                                'Full Height' => 'auto 100%',
                                'Auto' => 'auto',
                                'Contain' => 'contain'
                            ),
                            "heading" => __( 'Image size', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            "param_name" => "image_alignment",
                            "type" => "dropdown",
                            "value" => array(
                                'Top' => 'top',
                                'Center' => '',
                                'Bottom' => 'bottom'
                            ),
                            "heading" => __( 'Image alignment', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'img_height',
                            'type' => 'range_multiple-responsive',
                            'heading' => 'Image height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'value' => '',
                            'tdc_values' => array(
                                'percent' => array(
                                    'unit' => '%',
                                    'value' => '100',
                                    'range_min' => '0',
                                    'range_max' => '300',
                                    'range_step' => '1',
                                ),
                                'px' => array(
                                    'unit' => 'px',
                                    'value' => '250',
                                    'range_min' => '0',
                                    'range_max' => '1000',
                                    'range_step' => '10',
                                )
                            ),
                        ),
	                    array(
		                    "param_name" => "img_margin",
		                    "type" => "textfield-responsive",
		                    "value" => '',
		                    "heading" => 'Image margins',
		                    "description" => "",
		                    "placeholder" => "0 0 16px 0",
		                    "holder" => "div",
		                    "class" => "tdc-textfield-big"
	                    ),
                        array(
                            'param_name' => 'image_border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'General style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_team_member",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping('tds_team_member', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Social icons',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'social_icons_space',
                            'type' => 'range-responsive',
                            'value' => '0',
                            'heading' => 'Space above icons',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-100',
                            'range_max' => '100',
                            'range_step' => '1',
                        ),
                    ),
                    $this->get_group_params('social_icons'),
                    array(
                        array(
                            "param_name" => "show_names",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Show social network name",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'name_space_left',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Social network name left space',
                            'description' => '',
                            'placeholder' => '2',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            'param_name' => 'name_space_right',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Social network name right space',
                            'description' => '',
                            'placeholder' => '18',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Layout',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_testimonial',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_testimonial",
                'name' => __( 'Testimonial', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_testimonial.php',
                'tdc_style_params' => array(
                    'name',
                    'job_title',
                    'description',
                    'image',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'image' => self::tdm_get_image( 'tdm_pic_9' ),
                                'name' => 'John Doe',
                                'job_title' => 'Manager',
                                'description' => base64_encode( 'Each element can be added and moved around within any page effortlessly. All the features you need are just one click away.' ),
                            ),
                            array(
                                'tdc_preset_name' => 'Dental Studio',
                                'image' => self::tdm_get_image( 'tdm_pic_9' ),
                                'name' => 'Kevin Muller',
                                'job_title' => 'Patient',
                                'description' => base64_encode( 'Every time I visit Dental Studio, I get a warm cozy feeling of familiarity and friendship. I always feel safe during all my interventions here!' ),
                                "image_height" => "100",
                                "image_width" => "100",
                                "image_border_radius" => "50",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_testimonial" => "tds_testimonial3",
                                "image_size" => "60",
                                "tds_testimonial3-title_color" => "#aaaaaa",
                                "tds_testimonial3-description_color" => "#ffffff",
                                "tds_testimonial3-background_color" => "#30a7d6",
                                "tds_testimonial3-desc_radius" => "eyJhbGwiOiIxMHB4IiwibGFuZHNjYXBlIjoiMjBweCJ9",
                                "tds_testimonial3-arrow_size" => "7",
                                "tds_testimonial3-arrow_pos" => "23",
                                "tds_testimonial3-f_descr_font_size" => "13",
                                "tds_testimonial3-f_descr_font_line_height" => "22px",
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'name',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Name',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            "param_name" => "name_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H3 - Default' => '',
                                'H4' => 'h4',
                            ),
                            "heading" => 'Name tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'job_title',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Job title',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Testimonial text',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "image",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => __( "Image", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'image_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '52',
                        ),
                        array(
                            'param_name' => 'image_space',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '15',
                        ),
                        array(
                            'param_name' => 'image_border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "tds_testimonial",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping('tds_testimonial', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-extrabig",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_client',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_client",
                'name' => __( 'Client', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_client.php',
                'tdc_style_params' => array(
                    'name',
                    'url',
                    'image',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'name' => 'Client name',
                                'url' => '#',
                                'open_in_new_window' => 'yes',
                                'image' => self::tdm_get_image( 'tdm_pic_6' ),
                                'content_align_horizontal' => 'content-horiz-center',
                            ),
                            array(
                                'tdc_preset_name' => 'Dental Studio',
                                'image' => self::tdm_get_image( 'tdm_pic_6' ),
                                "display_inline" => "yes",
                                "initial_opacity" => "1",
                                "name" => "",
                                "tdc_css" => "eyJhbGwiOnsibWFyZ2luLXJpZ2h0IjoiMjAiLCJtYXJnaW4tbGVmdCI6IjIwIiwiYm9yZGVyLWJvdHRvbS13aWR0aCI6IjMiLCJwYWRkaW5nLXRvcCI6IjIwIiwicGFkZGluZy1yaWdodCI6IjMwIiwicGFkZGluZy1ib3R0b20iOiIyMCIsInBhZGRpbmctbGVmdCI6IjMwIiwiYm9yZGVyLWNvbG9yIjoiIzFkYjRjMSIsIndpZHRoIjoiMjAwIiwic2hhZG93LXNpemUiOiIyMCIsInNoYWRvdy1jb2xvciI6InJnYmEoMCwwLDAsMC4xKSIsInNoYWRvdy1vZmZzZXQtdiI6IjUiLCJiYWNrZ3JvdW5kLWNvbG9yIjoiI2ZmZmZmZiIsImRpc3BsYXkiOiIifSwicGhvbmUiOnsibWFyZ2luLXJpZ2h0IjoiNDAiLCJtYXJnaW4tbGVmdCI6IjQwIiwid2lkdGgiOiJhdXRvIiwiZGlzcGxheSI6IiJ9LCJwaG9uZV9tYXhfd2lkdGgiOjc2N30=",
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'name',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Name',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            "param_name" => "name_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H3 - Default' => '',
                                'H4' => 'h4',
                            ),
                            "heading" => 'Name tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big"
                        ),
                        array(
                            'param_name' => 'url',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Custom url',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig'
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "image",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => __( "Image", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => ""
                        ),
                        array(
                            'param_name' => 'initial_opacity',
                            'type' => 'range-responsive',
                            'value' => '0.5',
                            'heading' => 'Opacity',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '1',
                            'range_step' => '0.02',
                        ),
                        array(
                            'param_name' => 'hover_opacity',
                            'type' => 'range-responsive',
                            'value' => '1',
                            'heading' => 'Opacity hover',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '1',
                            'range_step' => '0.02',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "display_inline",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Display inline",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'block_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Block width',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => 'auto',
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text' ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_call_to_action',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_call_to_action",
                'name' => __( 'Call to action', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_call_to_action.php',
                //'tdc_in_row' => true,
                //'tdc_row_start_values' => base64_encode(
                //json_encode(
                //  array(
                //      array(
                //          'full_width'  => 'stretch_row_1400 td-stretch-content',
                //          )
                //      )
                //  )
                //),
                'tdc_style_params' => array(
                    'title_text',
                    'description',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Call to action' ),
                                'title_size' => 'tdm-title-md',
                                'description' => base64_encode( 'Each element can be added and moved around within any page effortlessly. All the features you need are just one click away.' ),
                                'button_text' => 'View all elements',
                                'button_url' => '#',
                                'button_tdicon' => 'tdc-font-fa tdc-font-fa-chevron-right',
                                'button_size' => 'tdm-btn-md',
                                'content_align_vertical' => 'content-vert-center',
                            ),

                            array(
                                'tdc_preset_name' => 'With background',
                                "tds_pricing" => "tds_pricing1",
                                "title_text" => base64_encode( 'Explore the miracle' ),
                                "title_size" => "tdm-title-md",
                                "description" => base64_encode( 'Each element can be added and moved around!' ),
                                "button_text" => "Start Now",
                                "button_url" => "#",
                                "button_size" => "tdm-btn-lg",
                                "content_align_vertical" => "content-vert-center",
                                "tds_title" => "tds_title2",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy10b3AiOiIzMCIsInBhZGRpbmctcmlnaHQiOiI1MCIsInBhZGRpbmctYm90dG9tIjoiMzAiLCJwYWRkaW5nLWxlZnQiOiI1MCIsImJhY2tncm91bmQtaW1hZ2UiOiJ1cmwoXCJodHRwOi8vMTkyLjE2OC4wLjEyMC93cF8wMTFfdGVzdC93cC1jb250ZW50L3VwbG9hZHMvMjAxOC8wMy83LmpwZ1wiKSIsImJhY2tncm91bmQtcG9zaXRpb24iOiJjZW50ZXIgY2VudGVyIiwiY29sb3ItMS1vdmVybGF5IjoicmdiYSgwLDAsMCwwLjcpIiwiZGlzcGxheSI6IiJ9LCJwaG9uZSI6eyJwYWRkaW5nLXRvcCI6IjIwIiwicGFkZGluZy1yaWdodCI6IjMwIiwicGFkZGluZy1sZWZ0IjoiMzAiLCJkaXNwbGF5IjoiIn0sInBob25lX21heF93aWR0aCI6NzY3fQ==",
                                "tds_title2-line_width" => "60",
                                "tds_title2-line_height" => "3",
                                "tds_title2-line_space" => "30",
                                "tds_title2-line_alignment" => "0",
                                "tds_button" => "tds_button2",
                                "tds_call_to_action1-description_color" => "rgba(255,255,255,0.8)",
                                "tds_title2-title_color" => "#ffffff",
                                "tds_title2-line_color" => "rgba(255,255,255,0.5)",
                                "tds_button2-text_color" => "#ffffff",
                                "tds_button2-icon_color" => "#ffffff",
                                "tds_button2-border_color" => "#ffffff",
                                "tds_button2-text_hover_color" => "rgba(255,255,255,0.8)",
                                "tds_button2-icon_hover_color" => "rgba(255,255,255,0.8)",
                                "tds_button2-border_hover_color" => "rgba(255,255,255,0.8)",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_title2-f_title_font_family" => "438",
                                "tds_title2-f_title_font_weight" => "600",
                                "tds_title2-f_title_font_size" => "eyJhbGwiOiIzMCIsInBob25lIjoiMjgiLCJwb3J0cmFpdCI6IjI4In0=",
                                "tds_title2-f_title_font_line_height" => "eyJwaG9uZSI6IjEuMiIsInBvcnRyYWl0IjoiMSJ9",
                            ),

                            array(
                                'tdc_preset_name' => 'White with shadow',
                                "title_text" => base64_encode( 'Banner Title Sample' ),
                                "title_size" => "tdm-title-md",
                                "description" => base64_encode( 'Each element can be added and moved around. Check it out!' ),
                                "button_text" => "Read More",
                                "button_url" => "#",
                                "button_size" => "tdm-btn-lg",
                                "content_align_vertical" => "content-vert-center",
                                "tds_title" => "tds_title1",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy10b3AiOiIzMCIsInBhZGRpbmctcmlnaHQiOiI1MCIsInBhZGRpbmctYm90dG9tIjoiMzAiLCJwYWRkaW5nLWxlZnQiOiI1MCIsInNoYWRvdy1vZmZzZXQtdiI6IjQiLCJiYWNrZ3JvdW5kLXBvc2l0aW9uIjoiY2VudGVyIGNlbnRlciIsImRpc3BsYXkiOiIifSwicGhvbmUiOnsicGFkZGluZy10b3AiOiIyMCIsInBhZGRpbmctcmlnaHQiOiIzMCIsInBhZGRpbmctbGVmdCI6IjMwIiwiZGlzcGxheSI6IiJ9LCJwaG9uZV9tYXhfd2lkdGgiOjc2N30=",
                                "tds_title1-line_width" => "60",
                                "tds_title1-line_height" => "3",
                                "tds_title1-line_space" => "30",
                                "tds_title1-line_alignment" => "0",
                                "tds_button" => "tds_button1",
                                "tds_call_to_action1-description_color" => "rgba(0,0,0,0.7)",
                                "tds_title2-title_color" => "#333333",
                                "tds_title2-line_color" => "rgba(130,36,227,0.7)",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_title1-f_title_font_family" => "438",
                                "tds_title1-f_title_font_weight" => "400",
                                "tds_title1-f_title_font_size" => "eyJhbGwiOiIzNiIsInBob25lIjoiMjgiLCJwb3J0cmFpdCI6IjI4In0=",
                                "tds_title1-f_title_font_line_height" => "eyJwaG9uZSI6IjEuMiIsInBvcnRyYWl0IjoiMSJ9",
                                "tds_call_to_action1-shadow_shadow_color" => "rgba(130,36,227,0.4)",
                                "tds_call_to_action1-shadow_shadow_size" => "30",
                                "tds_call_to_action1-shadow_shadow_offset_vertical" => "4",
                                "tds_button1-border_radius" => "50",
                                "tds_button1-f_btn_text_font_weight" => "400",
                                "tds_button1-f_btn_text_font_transform" => "uppercase",
                                "tds_button1-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjOTMzNGU1IiwiY29sb3IyIjoiIzI2ZGVlZiIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiLTE1MCIsImNzcyI6ImJhY2tncm91bmQ6IC13ZWJraXQtbGluZWFyLWdyYWRpZW50KC0xNTBkZWcsIzI2ZGVlZiwjOTMzNGU1KTtiYWNrZ3JvdW5kOiBsaW5lYXItZ3JhZGllbnQoLTE1MGRlZywjMjZkZWVmLCM5MzM0ZTUpOyIsImNzc1BhcmFtcyI6Ii0xNTBkZWcsIzI2ZGVlZiwjOTMzNGU1In0=",
                                "tds_title2-f_title_font_style" => "",
                                "tds_call_to_action1-f_descr_font_style" => "italic",
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    $this->get_group_params('title'),
                    array(
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-small',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'General style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_call_to_action",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_call_to_action', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-extrabig",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Title style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_title",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                            "heading" => 'Title style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Button',
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    $this->get_group_params('button'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Layout',
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    $align_params,
                    array(
                        array(
                            "param_name" => "flip_content",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => 'Flip content',
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_pricing',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_pricing",
                'name' => __( 'Pricing table', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_pricing.php',
                'tdc_style_params' => array(
                    'title_text',
                    'initial_price',
                    'new_price',
                    'currency',
                    'period',
                    'ribbon_text',
                    'description',
                    'features',
                    'features_tdicon',
                    'features_non_tdicon',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Product name' ),
                                'title_tag' => 'h3',
                                'title_size' => 'tdm-title-sm',
                                'initial_price' => '10',
                                'new_price' => '5',
                                'currency' => '$',
                                'period' => '/mo',
                                'ribbon_text' => '-50%',
                                'description' => base64_encode( 'Add an Introductory Description to make your audience curious by simply setting an Excerpt on this section.' ),
                                'features' => base64_encode('Feature 1%0AFeature 2%0Ax- Feature 3'),
                                'features_tdicon' => 'tdc-font-fa tdc-font-fa-check',
                                'features_non_tdicon' => 'tdc-font-fa tdc-font-fa-remove-close-times',
                                'button_text'  => 'Purchase',
                                'button_tdicon'  => 'tdc-font-fa tdc-font-fa-shopping-cart',
                                'button_size'  => 'tdm-btn-md',
                                'content_align_horizontal' => 'content-horiz-center',
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Free plan',
                                "tds_pricing" => "tds_pricing1",
                                "title_text" => base64_encode( 'ANDROID Standard' ),
                                "title_size" => "tdm-title-sm",
                                "currency" => "",
                                'features' => base64_encode('1 Progressive Web App %0A1 Native App for Android %0APersonalized domain name %0ASSL security included %0AUnlimited traffic %0AUnlimited downloads'),
                                "features_tdicon" => "tdc-font-fa tdc-font-fa-check",
                                "features_non_tdicon" => "tdc-font-fa tdc-font-fa-remove-close-times",
                                "button_size" => "tdm-btn-lg",
                                "content_align_horizontal" => "content-horiz-center",
                                "tds_pricing1-icon_color" => "#1e73be",
                                "tds_title" => "tds_title1",
                                "tds_button" => "tds_button3",
                                'button_text'  => 'Create my App',
                                "tds_button3-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjNTYzOWU1IiwiY29sb3IyIjoiIzQ0ODFmYyIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NDgxZmMsIzU2MzllNSk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUifQ==",
                                "icon_space" => "15",
                                "button_icon_size" => "30",
                                "button_tdicon" => "tdc-font-tdmp tdc-font-tdmp-parcel",
                                "tds_button3-text_color" => "#ffffff",
                                "tds_button3-border_radius" => "3",
                                "tds_button3-background_hover_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjM2M1YWYyIiwiY29sb3IyIjoiIzQ0YThmZiIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NGE4ZmYsIzNjNWFmMik7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDRhOGZmLCMzYzVhZjIpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDRhOGZmLCMzYzVhZjIifQ==",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy10b3AiOiIyMCIsInBhZGRpbmctYm90dG9tIjoiNDAiLCJzaGFkb3ctc2l6ZSI6IjIwIiwic2hhZG93LWNvbG9yIjoicmdiYSgwLDAsMCwwLjA1KSIsImJhY2tncm91bmQtY29sb3IiOiIjZmZmZmZmIiwiZGlzcGxheSI6IiJ9LCJwaG9uZSI6eyJtYXJnaW4tYm90dG9tIjoiMCIsInotaW5kZXgiOiIzIiwiZGlzcGxheSI6IiJ9LCJwaG9uZV9tYXhfd2lkdGgiOjc2N30=",
                                "initial_price" => "FREE",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Premium plan',
                                "title_text" => base64_encode( 'IOS Premium' ),
                                "title_size" => "tdm-title-sm",
                                "currency" => "$",
                                "period" => "/month",
                                "features" => base64_encode('1 Progressive Web App %0A1 Native App for Android %0A1 Native App for iOS %0APersonalized domain name %0ASSL security included %0AUnlimited traffic %0AUnlimited downloads %0AAdvanced add-ons'),
                                "features_tdicon" => "tdc-font-fa tdc-font-fa-check",
                                "features_non_tdicon" => "tdc-font-fa tdc-font-fa-remove-close-times",
                                "button_tdicon" => "tdc-font-tdmp tdc-font-tdmp-parcel",
                                "button_size" => "tdm-btn-lg",
                                "content_align_horizontal" => "content-horiz-center",
                                "initial_price" => "48",
                                "tds_pricing1-icon_color" => "#1e73be",
                                "tds_title" => "tds_title1",
                                "tds_button" => "tds_button3",
                                'button_text'  => 'Buy now',
                                "tds_button3-background_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjNTYzOWU1IiwiY29sb3IyIjoiIzQ0ODFmYyIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NDgxZmMsIzU2MzllNSk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUifQ==",
                                "icon_space" => "15",
                                "button_icon_size" => "30",
                                "tds_button3-text_color" => "#ffffff",
                                "tds_button3-border_radius" => "3",
                                "tds_button3-background_hover_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjM2M1YWYyIiwiY29sb3IyIjoiIzQ0YThmZiIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NGE4ZmYsIzNjNWFmMik7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDRhOGZmLCMzYzVhZjIpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDRhOGZmLCMzYzVhZjIifQ==",
                                "button_position" => "",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy10b3AiOiIyMCIsInBhZGRpbmctYm90dG9tIjoiNDAiLCJzaGFkb3ctc2l6ZSI6IjIwIiwic2hhZG93LWNvbG9yIjoicmdiYSgwLDAsMCwwLjA1KSIsImJhY2tncm91bmQtY29sb3IiOiIjZmZmZmZmIiwiei1pbmRleCI6IjEiLCJkaXNwbGF5IjoiIn0sInBob25lIjp7Im1hcmdpbi1ib3R0b20iOiIwIiwiei1pbmRleCI6IjIiLCJkaXNwbGF5IjoiIn0sInBob25lX21heF93aWR0aCI6NzY3fQ==",
                                "ribbon_text" => "BEST",
                                "tds_pricing1-ribbon_background_color" => "#1e73be",
                                "tds_pricing" => "tds_pricing1",
                            ),
                            array(
                                'tdc_preset_name' => 'Technology - Free plan',
                                "title_text" => base64_encode( 'BASIC' ),
                                "title_size" => "tdm-title-md",
                                "description" => base64_encode( 'Basic features available for free.' ),
                                "button_text" => "CHOOSE",
                                "button_size" => "tdm-btn-md",
                                "button_tdicon" => "",
                                "content_align_horizontal" => "content-horiz-center",
                                "tdc_css" => "eyJhbGwiOnsibWFyZ2luLXJpZ2h0IjoiMTUiLCJtYXJnaW4tbGVmdCI6IjE1IiwicGFkZGluZy10b3AiOiI0MCIsInBhZGRpbmctcmlnaHQiOiIzMCIsInBhZGRpbmctYm90dG9tIjoiNjAiLCJwYWRkaW5nLWxlZnQiOiIzMCIsImJvcmRlci1jb2xvciI6InJnYmEoMjU1LDI1NSwyNTUsMCkiLCJ3aWR0aCI6IjMyOCIsInNoYWRvdy1jb2xvciI6InJnYmEoMCwwLDAsMC4xKSIsImJhY2tncm91bmQtY29sb3IiOiIjZmZmZmZmIiwiZGlzcGxheSI6ImlubGluZS1ibG9jayJ9LCJsYW5kc2NhcGUiOnsibWFyZ2luLXJpZ2h0IjoiMTAiLCJtYXJnaW4tbGVmdCI6IjAiLCJwYWRkaW5nLXJpZ2h0IjoiMTAiLCJwYWRkaW5nLWJvdHRvbSI6IjQwIiwicGFkZGluZy1sZWZ0IjoiMTAiLCJ3aWR0aCI6IjIyMCIsImRpc3BsYXkiOiJpbmxpbmUtYmxvY2sifSwibGFuZHNjYXBlX21heF93aWR0aCI6MTE0MCwibGFuZHNjYXBlX21pbl93aWR0aCI6MTAxOSwicG9ydHJhaXQiOnsibWFyZ2luLXJpZ2h0IjoiNSIsIm1hcmdpbi1sZWZ0IjoiMCIsInBhZGRpbmctdG9wIjoiMjAiLCJwYWRkaW5nLXJpZ2h0IjoiNSIsInBhZGRpbmctYm90dG9tIjoiMzAiLCJwYWRkaW5nLWxlZnQiOiI1Iiwid2lkdGgiOiIxNzAiLCJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sInBvcnRyYWl0X21heF93aWR0aCI6MTAxOCwicG9ydHJhaXRfbWluX3dpZHRoIjo3NjgsInBob25lIjp7Im1hcmdpbi1yaWdodCI6IjAiLCJtYXJnaW4tbGVmdCI6IjAiLCJ3aWR0aCI6ImF1dG8iLCJkaXNwbGF5IjoiIn0sInBob25lX21heF93aWR0aCI6NzY3fQ==",
                                "tds_pricing1-shadow_color" => "rgba(0,0,0,0.16)",
                                "tds_pricing1-shadow_offset_vertical" => "5",
                                "tds_pricing1-shadow_size" => "30",
                                "features" => "T25lJTIwZ2xvYmFsJTIwbG9jYXRpb24lMEFQZXJmb3JtYW5jZSUyMHJlcG9ydCUyMCUwQUVtYWlsJTIwbm90aWZpY2F0aW9ucyUwQXgtJTIwQ29udGlub3VzJTIwaW1wb3J0JTBBeC0lMjBBUEklMjBpbnRlZ3JhdGlvbiUwQXgtJTIwQ3VzdG9tJTIwbGlicmFyaWVzJTBBeC0lMjBSZXVzYWJsZSUyMHNuaXBwZXRzJTBBeC0lMjBTdGFuZGFyZCUyMHN1cHBvcnQ=",
                                "icon_size" => "12",
                                "icon_space" => "10",
                                "tds_pricing" => "",
                                "tds_pricing1-price_color" => "#444444",
                                "button_position" => "button_position_above",
                                "initial_price" => "Free",
                                "button_icon_position" => "",
                                "tds_button" => "tds_button2",
                                "tds_button2-border_radius" => "50",
                                "tds_button2-text_hover_color" => "#444444",
                                "tds_button2-border_hover_color" => "#444444",
                                "tds_pricing1-description_color" => "#888888",
                                "button_width" => "90%",
                                "tds_pricing1-shadow_shadow_size" => "30",
                                "tds_pricing1-shadow_shadow_color" => "rgba(0,0,0,0.16)",
                                "features_tdicon" => "tdc-font-fa tdc-font-fa-check",
                                "features_non_tdicon" => "tdc-font-fa tdc-font-fa-remove-close-times",
                                "tds_title1-f_title_font_style" => "",
                                "tds_title1-f_title_font_weight" => "300",
                                "tds_button2-icon_hover_color" => "#444444",
                                "tds_button2-text_color" => "#22a0d6",
                                "tds_button2-icon_color" => "#22a0d6",
                                "tds_button2-border_color" => "#22a0d6",
                                "tds_pricing1-icon_color" => "#22a0d6",
                                "tds_pricing1-f_features_font_weight" => "",
                            ),

                            array(
                                'tdc_preset_name' => 'Technology - Premium plan',
                                "title_text" => base64_encode( 'PREMIUM' ),
                                "title_size" => "tdm-title-md",
                                "description" => base64_encode( 'Recommended robust work management with customization & exec reporting.' ),
                                "button_text" => "PURCHASE",
                                "button_size" => "tdm-btn-md",
                                "currency" => "$",
                                "content_align_horizontal" => "content-horiz-center",
                                "tdc_css" => "eyJhbGwiOnsibWFyZ2luLXJpZ2h0IjoiMTUiLCJtYXJnaW4tbGVmdCI6IjE1IiwicGFkZGluZy10b3AiOiI0MCIsInBhZGRpbmctcmlnaHQiOiIzMCIsInBhZGRpbmctYm90dG9tIjoiNjAiLCJwYWRkaW5nLWxlZnQiOiIzMCIsImJvcmRlci1jb2xvciI6InJnYmEoMjU1LDI1NSwyNTUsMCkiLCJ3aWR0aCI6IjMyOCIsInNoYWRvdy1jb2xvciI6InJnYmEoMCwwLDAsMC4xKSIsImJhY2tncm91bmQtY29sb3IiOiIjZmZmZmZmIiwiZGlzcGxheSI6ImlubGluZS1ibG9jayJ9LCJsYW5kc2NhcGUiOnsibWFyZ2luLXJpZ2h0IjoiMTAiLCJtYXJnaW4tbGVmdCI6IjAiLCJwYWRkaW5nLXJpZ2h0IjoiMTAiLCJwYWRkaW5nLWJvdHRvbSI6IjQwIiwicGFkZGluZy1sZWZ0IjoiMTAiLCJ3aWR0aCI6IjIyMCIsImRpc3BsYXkiOiJpbmxpbmUtYmxvY2sifSwibGFuZHNjYXBlX21heF93aWR0aCI6MTE0MCwibGFuZHNjYXBlX21pbl93aWR0aCI6MTAxOSwicG9ydHJhaXQiOnsibWFyZ2luLXJpZ2h0IjoiNSIsIm1hcmdpbi1sZWZ0IjoiMCIsInBhZGRpbmctdG9wIjoiMjAiLCJwYWRkaW5nLXJpZ2h0IjoiNSIsInBhZGRpbmctYm90dG9tIjoiMzAiLCJwYWRkaW5nLWxlZnQiOiI1Iiwid2lkdGgiOiIxNzAiLCJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sInBvcnRyYWl0X21heF93aWR0aCI6MTAxOCwicG9ydHJhaXRfbWluX3dpZHRoIjo3NjgsInBob25lIjp7Im1hcmdpbi1yaWdodCI6IjAiLCJtYXJnaW4tbGVmdCI6IjAiLCJ3aWR0aCI6ImF1dG8iLCJkaXNwbGF5IjoiIn0sInBob25lX21heF93aWR0aCI6NzY3fQ==",
                                "tds_pricing1-shadow_color" => "rgba(0,0,0,0.16)",
                                "tds_pricing1-shadow_offset_vertical" => "5",
                                "tds_pricing1-shadow_size" => "30",
                                "features" => "MjAlMjBnbG9iYWwlMjBsb2NhdGlvbnMlMEFQZXJmb3JtYW5jZSUyMHJlcG9ydCUyMCUwQUVtYWlsJTIwbm90aWZpY2F0aW9ucyUwQUNvbnRpbm91cyUyMGltcG9ydCUwQUFQSSUyMGludGVncmF0aW9uJTBBQ3VzdG9tJTIwbGlicmFyaWVzJTBBUmV1c2FibGUlMjBzbmlwcGV0cyUwQVByZW1pdW0lMjBzdXBwb3J0",
                                "icon_size" => "12",
                                "icon_space" => "10",
                                "tds_pricing" => "",
                                "period" => "/mo",
                                "ribbon_text" => "BEST",
                                "tds_pricing1-ribbon_text_color" => "#ffffff",
                                "tds_pricing1-ribbon_background_color" => "#22a0d6",
                                "tds_pricing1-price_color" => "#444444",
                                "button_position" => "button_position_above",
                                "initial_price" => "190",
                                "button_icon_position" => "",
                                "tds_button" => "tds_button1",
                                "tds_pricing1-description_color" => "#888888",
                                "button_width" => "90%",
                                "tds_pricing1-shadow_shadow_size" => "30",
                                "tds_pricing1-shadow_shadow_color" => "rgba(0,0,0,0.16)",
                                "features_tdicon" => "tdc-font-fa tdc-font-fa-check",
                                "features_non_tdicon" => "tdc-font-fa tdc-font-fa-remove-close-times",
                                "tds_title1-f_title_font_style" => "",
                                "tds_title1-f_title_font_weight" => "300",
                                "tds_pricing1-icon_color" => "#22a0d6",
                                "tds_pricing1-f_features_font_weight" => "",
                                "tds_button1-border_radius" => "50",
                                "tds_button1-background_color" => "#22a0d6",
                                "tds_button1-text_color" => "#ffffff",
                                "tds_button1-icon_color" => "#ffffff",
                                "tds_button1-background_hover_color" => "#444444",
                                "tds_button1-text_hover_color" => "#ffffff",
                                "tds_button1-icon_hover_color" => "#ffffff",
                            ),
                        )
                    )
                ),
                "params" => array_merge(
                    $this->get_group_params('title'),
                    array(
                        array(
                            'param_name' => 'initial_price',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Initial price',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            'param_name' => 'new_price',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'New price',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            'param_name' => 'currency',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Currency',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            'param_name' => 'period',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Charging period',
                            'description' => '',
                            'class' => 'tdc-textfield-big',
                        ),
                        array(
                            'param_name' => 'ribbon_text',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Ribbon text',
                            'description' => '',
                            'class' => 'tdc-textfield-big',
                        ),
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            'param_name' => 'features',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Features',
                            'description' => '',
                            'class' => 'tdc-textarea-small'
                        ),
                        array(
                            'param_name' => 'features_tdicon',
                            'type' => 'icon',
                            'heading' => 'Features icon',
                            'class' => 'tdc-textfield-small',
                            'value' => '',
                        ),
                        array(
                            'param_name' => 'features_non_tdicon',
                            'type' => 'icon',
                            'heading' => 'Missing features icon',
                            'class' => 'tdc-textfield-small',
                            'value' => '',
                        ),
                        array(
                            'param_name' => 'icon_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Icon size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '15',
                        ),
                        array(
                            'param_name' => 'icon_space',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Space between text and icon',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '11',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'General style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_pricing",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_pricing', false ),
                            "heading" => 'Pricing style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Title style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_title",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                            "heading" => 'Title style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => "Button",
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    $this->get_group_params('button'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => "Layout",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "featured",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Featured table",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "button_position",
                            "type" => "dropdown",
                            "value" => array(
                                'Below features' => '',
                                'Above features' => 'button_position_above',
                                'Both' => 'button_position_both',
                            ),
                            "heading" => 'Button position',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                    ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_list',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_list",
                'name' => __( 'List', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_list.php',
                'tdc_style_params' => array(
                    'items',
                    'tdicon',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
	                    array(
	                        array(
								'items' => base64_encode('List item 1%0AList item 2%0AList item 3'),
		                        'tdicon' => 'tdc-font-fa tdc-font-fa-star',
		                        'content_align_horizontal' => 'content-horiz-left',
	                        ),
	                    )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'items',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'List items',
                            'description' => '',
                            'class' => 'tdc-textarea-small',
                        ),
                        array(
                            'param_name' => 'tdicon',
                            'type' => 'icon',
                            'heading' => 'List items icon',
                            'class' => 'tdc-textfield-small',
                            'value' => '',
                        ),
                        array(
                            'param_name' => 'icon_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Icon size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '15',
                        ),
                        array(
                            'param_name' => 'icon_align',
                            'type' => 'range-responsive',
                            'value' => '0',
                            'heading' => 'Icon align',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-50',
                            'range_max' => '50',
                            'range_step' => '1',
                        ),
                        array(
                            'param_name' => 'icon_space',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Space between text and icon',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '11',
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover text color',
                            "param_name" => "hover_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover icon color',
                            "param_name" => "hover_icon_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_list', true, 'List text' ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_icon',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_icon",
                'name' => __( 'Icon', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-icon',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_icon.php',
                'tdc_style_params' => array(
                    'tdicon_id',
                    'icon_url',
                    'icon_video_url',
                    'scroll_to_class',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'tdicon_id' => 'tdc-font-fa tdc-font-fa-star-o',
                                'icon_size' => '50',
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Red',
	                            'tdicon_id' => 'tds-icon tdc-font-fa tdc-font-fa-star-o',
                                "icon_size" => "50",
                                "tds_icon1-color" => "#ffffff",
                                "tds_icon1-bg_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjZGMzZjRmIiwiY29sb3IyIjoiI2Y0NzY4YSIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCNmNDc2OGEsI2RjM2Y0Zik7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjZjQ3NjhhLCNkYzNmNGYpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjZjQ3NjhhLCNkYzNmNGYifQ==",
                                "tds_icon1-border_radius" => "50",
                                "tds_icon1-hover_border_radius" => "50",
                                "tds_icon1-hover_shadow_color" => "rgba(221,102,102,0.6)",
                                "tds_icon1-hover_shadow_size" => "20",
                                "tds_icon1-shadow_size" => "10",
                                "tds_icon1-shadow_color" => "rgba(221,102,102,0.6)",
                                "tds_icon1-shadow_offset_vertical" => "3",
                                "tds_icon1-hover_shadow_offset_vertical" => "6",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Blue',
                                'tdicon_id' => 'tds-icon tdc-font-fa tdc-font-fa-wordpress',
                                "icon_size" => "50",
                                "tds_icon1-color" => "#ffffff",
                                "tds_icon1-bg_color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjNTYzOWU1IiwiY29sb3IyIjoiIzQ0ODFmYyIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiMTgwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoMTgwZGVnLCM0NDgxZmMsIzU2MzllNSk7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUpOyIsImNzc1BhcmFtcyI6IjE4MGRlZywjNDQ4MWZjLCM1NjM5ZTUifQ==",
                                "tds_icon1-border_radius" => "50",
                                "tds_icon1-hover_border_radius" => "50",
                                "tds_icon1-shadow_size" => "10",
                                "tds_icon1-shadow_color" => "rgba(30,115,190,0.6)",
                                "tds_icon1-shadow_offset_vertical" => "3",
                                "tds_icon1-hover_shadow_size" => "20",
                                "tds_icon1-hover_shadow_color" => "rgba(30,115,190,0.6)",
                                "tds_icon1-hover_shadow_offset_vertical" => "6",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Pink',
                                "tdicon_id" => "tdc-font-fa tdc-font-fa-connectdevelop",
                                "icon_size" => "40",
                                "tds_icon1-color" => "#ffffff",
                                "tds_icon1-bg_color" => "#dd2380",
                                "tds_icon1-border_radius" => "50",
                                "tds_icon1-hover_border_radius" => "50",
                                "tds_icon1-shadow_size" => "10",
                                "tds_icon1-shadow_color" => "rgba(221,35,128,0.6)",
                                "tds_icon1-shadow_offset_vertical" => "3",
                                "tds_icon1-hover_shadow_size" => "20",
                                "tds_icon1-hover_shadow_color" => "rgba(221,35,128,0.6)",
                                "tds_icon1-hover_shadow_offset_vertical" => "6",
                                "icon_spacing" => "1.8",
                            ),
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'tdicon_id',
                            'type' => 'icon',
                            'heading' => 'Icon',
                            'class' => 'tdc-textfield-small',
                            'value' => ''
                        ),
                        array(
                            'type' => 'range-responsive',
                            'param_name' => 'icon_size',
                            'value' => '20',
                            'heading' => 'Icon size (px)',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '10',
                            'range_max' => '150',
                            'range_step' => '5',
                        ),
                        array(
                            'param_name' => 'icon_spacing',
                            'type' => 'range-responsive',
                            'value' => '1.6',
                            'heading' => 'Icon spacing',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '1',
                            'range_max' => '3',
                            'range_step' => '0.1',
                        ),
                        array(
                            "param_name" => "icon_display",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Show inline",
                            "description" => "",
                            "holder" => "div",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "icon_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => __( "Icon link", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig"
                        ),
                        array(
                            "param_name" => "icon_open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => __( "Open in new window",  'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            'param_name' => 'icon_video_url',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Video popup',
                            'description' => 'Youtube or Vimeo video url',
                            'class' => 'tdc-textfield-extrabig'
                        ),
                        array(
                            'param_name' => 'scroll_to_class',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Scroll to class',
                            'description' => 'On click will scroll to an element with this class',
                            'class' => 'tdc-textfield-extrabig'
                        ),
	                    array(
                            'type' => 'range-responsive',
                            'param_name' => 'scroll_offset',
                            'value' => '0',
                            'heading' => 'Scroll offset',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-100',
                            'range_max' => '100',
                            'range_step' => '1'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Icon style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_icon",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_icon', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                            'tdc_min_options' => 2,
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_icon_box',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_icon_box",
                'name' => __( 'Icon box', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-icon',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_icon_box.php',
                'tdc_style_params' => array(
                    'tdicon_id',
                    'icon_url',
                    'title_text',
                    'description',
                    'button_text',
                    'button_url',
                    'button_tdicon',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-bulb-idea",
                                'icon_size' => '80',
                                'icon_padding' => '1',
                                'title_text' => base64_encode( 'Icon box title' ),
                                'title_tag' => 'h3',
                                'title_size' => 'tdm-title-md',
                                'description'  => base64_encode( 'Whatever your plan is, our theme makes it simple to combine, rearrange and customize elements as you desire.' ),
                                'button_text'  => 'Read more',
                                'button_size'  => 'tdm-btn-md',
                                'button_tdicon'  => 'tdc-font-fa tdc-font-fa-long-arrow-right',
                                'tds_button' => 'tds_button3',
                                'content_align_horizontal' => 'content-horiz-center',
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Big white spot',
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-sattelite",
                                "icon_size" => "80",
                                'title_text' => base64_encode( 'Protect your company' ),
                                "title_size" => "tdm-title-md",
                                'description'  => base64_encode( 'Whatever your plan is, our theme makes it simple to combine, rearrange and customize elements as you desire.' ),
                                "button_text" => "Read more",
                                "button_size" => "tdm-btn-lg",
                                "button_tdicon" => "tdc-font-fa tdc-font-fa-long-arrow-right",
                                "tds_button" => "tds_button5",
                                "content_align_horizontal" => "content-horiz-center",
                                "tds_icon1-color" => "eyJ0eXBlIjoiZ3JhZGllbnQiLCJjb2xvcjEiOiIjZjU3YThiIiwiY29sb3IyIjoiI2Y5YjkxYyIsIm1peGVkQ29sb3JzIjpbXSwiZGVncmVlIjoiLTkwIiwiY3NzIjoiYmFja2dyb3VuZDogLXdlYmtpdC1saW5lYXItZ3JhZGllbnQoLTkwZGVnLCNmOWI5MWMsI2Y1N2E4Yik7YmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KC05MGRlZywjZjliOTFjLCNmNTdhOGIpOyIsImNzc1BhcmFtcyI6Ii05MGRlZywjZjliOTFjLCNmNTdhOGIifQ==",
                                "tds_icon_box" => "tds_icon_box1",
                                "tds_icon1-shadow_shadow_color" => "rgba(33,185,209,0.1)",
                                "tds_icon1-shadow_size" => "40",
                                "icon_padding" => "2",
                                "tds_icon1-shadow_offset_vertical" => "14",
                                "tds_title1-hover_title_color" => "#1e73be",
                                "tds_icon1-shadow_shadow_size" => "40",
                                "tds_icon1-shadow_shadow_offset_vertical" => "14",
                                "tds_icon1-border_radius" => "50%",
                                "tds_icon1-hover_border_radius" => "50%",
                                "tds_button5-text_hover_color" => "#1e73be",
                            ),
                            array(
                                'tdc_preset_name' => 'Smart App - Small white spot',
                                "tdicon_id" => "tdc-font-fa tdc-font-fa-keyboard-o",
                                "icon_size" => "42",
                                "icon_padding" => "1.8",
                                'title_text' => base64_encode( 'Goodbye, human error' ),
                                "title_size" => "tdm-title-md",
                                'description'  => base64_encode( 'Browse an extensive selection of SmartApps in the Store. Can’t find what you’re looking for? Post a request for an app in the AppNetwork. Become an AppMerchant builder for FREE and start selling your Smart App today.' ),
                                "tds_icon_box1-f_descr_font_size" => "13",
                                "tds_icon_box1-icon_box_description_color" => "#666666",
                                "tds_icon_box1-f_descr_font_line_height" => "22px",
                                "button_text" => "Read more",
                                "button_size" => "tdm-btn-xlg",
                                "button_tdicon" => "tdc-font-fa tdc-font-fa-long-arrow-right",
                                "tds_button" => "tds_button5",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_icon_box" => "tds_icon_box1",
                                "tds_button5-text_color" => "#1e73be",
                                "tds_button5-text_hover_color" => "#000000",
                                "tds_icon1-bg_color" => "#ffffff",
                                "tds_icon1-shadow_shadow_offset_vertical" => "3",
                                "tds_icon1-shadow_shadow_size" => "14",
                                "tds_icon1-border_radius" => "50",
                                "tds_icon1-hover_border_radius" => "50",
                                "tds_icon1-shadow_shadow_color" => "rgba(10,10,10,0.06)",
                                "tds_icon_box1-title_top_space" => "30",
                                "tds_icon_box1-title_bottom_space" => "0",
                            ),
                            array(
                                'tdc_preset_name' => 'Heaven Spa - Round border',
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-bamboo",
                                "icon_size" => "50",
                                "icon_padding" => "1.4",
                                'title_text' => base64_encode( 'All natural' ),
                                "title_size" => "tdm-title-xsm",
                                'description'  => base64_encode( 'Embracing all that is given by mother nature will make you feel deeply relaxed and very happy' ),
                                "button_size" => "tdm-btn-md",
                                "content_align_horizontal" => "content-horiz-center",
                                "tds_icon_box1-title_top_space" => "10",
                                "tds_icon_box1-description_bottom_space" => "20",
                                "tds_icon_box1-icon_box_description_color" => "#aaaaaa",
                                "tds_title1-title_color" => "#444444",
                                "tds_title" => "tds_title1",
                                "tds_icon1-border_size" => "1",
                                "tds_icon1-border_radius" => "50",
                                "tds_icon1-hover_border_radius" => "50",
                                "tds_icon1-color" => "#ea967c",
                                "tds_icon1-border_color" => "#ea967c",
                                "tds_icon1-hover_border_color" => "#ea967c",
                                "tds_icon1-hover_shadow_shadow_size" => "10",
                                "tds_icon1-hover_shadow_shadow_offset_vertical" => "3",
                                "tds_icon1-hover_shadow_shadow_color" => "rgba(0,0,0,0.1)",
                                "tds_button" => "tds_button1",
                                "tds_button1-background_color" => "#ea967c",
                                "tds_icon1-all_border_size" => "1",
                                "tds_icon1-all_border_color" => "#ea967c",
                                "tds_icon1-shadow_hover_shadow_size" => "10",
                                "tds_icon1-shadow_hover_shadow_offset_vertical" => "3",
                                "tds_icon1-shadow_hover_shadow_color" => "rgba(0,0,0,0.1)",
                                "tds_icon_box1-f_descr_font_size" => "13",
                            ),
                            array(
                                'tdc_preset_name' => 'Nature Love - Simple icon',
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-mountains",
                                "title_text" =>  base64_encode( 'Discover' ),
                                "description" => "",
                                "button_text" => "",
                                "icon_padding" => "1",
                                "title_size" => "tdm-title-sm",
                                "button_size" => "tdm-btn-md",
                                "tds_button" => "tds_button2",
                                "content_align_horizontal" => "content-horiz-center",
                                "tdc_css" => "eyJhbGwiOnsiZGlzcGxheSI6ImlubGluZS1ibG9jayJ9LCJsYW5kc2NhcGUiOnsiZGlzcGxheSI6ImlubGluZS1ibG9jayJ9LCJsYW5kc2NhcGVfbWF4X3dpZHRoIjoxMTQwLCJsYW5kc2NhcGVfbWluX3dpZHRoIjoxMDE5LCJwb3J0cmFpdCI6eyJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sInBvcnRyYWl0X21heF93aWR0aCI6MTAxOCwicG9ydHJhaXRfbWluX3dpZHRoIjo3NjgsInBob25lIjp7Im1hcmdpbi1ib3R0b20iOiI2MCIsIndpZHRoIjoiYXV0byIsImRpc3BsYXkiOiIifSwicGhvbmVfbWF4X3dpZHRoIjo3Njd9",
                                "button_icon_space" => "0",
                                "tds_icon_box1-title_top_space" => "5",
                                "icon_size" => "70",
                                "tds_icon_box1-description_bottom_space" => "25",
                                "tds_icon_box1-title_bottom_space" => "10",
                                "tds_icon1-hover_color" => "#81c132",
                                "tds_title1-f_title_font_transform" => "uppercase",
                                "tds_title1-f_title_font_weight" => "300",
                                "tds_title1-f_title_font_family" => "507",
                                "tds_button2-border_size" => "1",
                                "tds_button2-f_btn_text_font_transform" => "uppercase",
                                "tds_button2-text_color" => "#444444",
                                "tds_button2-border_color" => "#444444",
                                "tds_icon1-color" => "#444444",
                                "tds_title1-f_title_font_size" => "24",
                                "tds_title1-title_color" => "#444444",
                                "tds_button2-text_hover_color" => "#81c132",
                                "tds_icon_box1-f_descr_font_size" => "13",
                                "tds_icon_box1-f_descr_font_line_height" => "1.8",
                            ),
                            array(
                                'tdc_preset_name' => 'Raw & Wild - Contact information',
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-location",
                                "icon_size" => "30",
                                "icon_padding" => "1",
                                "title_text" =>  base64_encode( '27 Queen Street, Atlanta' ),
                                "title_size" => "tdm-title-xxsm",
                                "description" => "",
                                "button_text" => "",
                                "button_size" => "tdm-btn-md",
                                "button_tdicon" => "tdc-font-fa tdc-font-fa-long-arrow-right",
                                "tds_button" => "tds_button3",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_icon_box" => "tds_icon_box2",
                                "button_icon_space" => "0",
                                "tds_icon_box2-icon_right_space" => "10",
                                "tds_icon_box2-title_top_space" => "-2",
                                "tds_icon_box2-title_bottom_space" => "-40",
                                "tds_icon_box2-description_bottom_space" => "0",
                                "tdc_css" => "eyJhbGwiOnsibWFyZ2luLWJvdHRvbSI6IjIwIiwiZGlzcGxheSI6IiJ9fQ==",
                                "tds_icon1-color" => "#000",
                                "tds_icon1-hover_color" => "#000",
                                "tds_title1-title_color" => "#000",
                                "tds_title1-hover_title_color" => "#000",
                                "tds_title1-f_title_font_weight" => "400",
                            ),
                            array(
                                'tdc_preset_name' => 'Nature Love - Contact information',
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-mobile",
                                "title_text" =>  base64_encode( 'Telephone' ),
                                "description" =>  base64_encode( '1-800-566-455 <br>1-800-566-456' ),
                                "title_size" => "tdm-title-sm",
                                "tds_icon_box" => "tds_icon_box2",
                                "tds_icon_box2-title_top_space" => "6",
                                "tds_title" => "",
                                "tds_icon_box2-title_bottom_space" => "0",
                                "tds_icon_box2-description_bottom_space" => "0",
                                "tds_icon1-color" => "#81c132",
                                "tds_icon_box2-icon_right_space" => "11",
                                "icon_size" => "60",
                                "icon_padding" => "1",
                                "button_text" => "",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_title1-f_title_font_family" => "507",
                                "tds_title1-f_title_font_size" => "24",
                                "tds_title1-f_title_font_line_height" => "30px",
                            ),
                            array(
                                'tdc_preset_name' => 'Wine Aroma - Bold fonts',
                                "tdicon_id" => "tdc-font-tdmp tdc-font-tdmp-bottle",
                                "icon_size" => "95",
                                "icon_padding" => "1",
                                "title_text" =>  base64_encode( 'Wine Selection' ),
                                "title_size" => "tdm-title-md",
                                'description'  => base64_encode( 'Explore a vast selection of  carefully crafted wines, from amazing Chardonnays, to spicy Pinot Noirs and other exclusive bottlings' ),
                                "button_text" => "",
                                "button_size" => "tdm-btn-md",
                                "button_tdicon" => "tdc-font-tdmp tdc-font-tdmp-arrow-right",
                                "tds_button" => "tds_button5",
                                "content_align_horizontal" => "content-horiz-center",
                                "tds_icon1-color" => "#ccb930",
                                "tds_title1-title_color" => "#222222",
                                "tds_title1-f_title_font_family" => "479",
                                "tds_title1-f_title_font_weight" => "600",
                                "tds_title1-f_title_font_size" => "24",
                                "tds_button5-f_btn_text_font_weight" => "600",
                                "tds_button5-f_btn_text_font_size" => "14",
                                "button_icon_space" => "10",
                                "button_icon_size" => "24",
                                "tds_title1-f_title_font_line_height" => "1",
                                "tds_button5-f_btn_text_font_line_height" => "1",
                            ),
                        )
                    )
                ),
                "params" => array_merge(
                    array(
	                    array(
                            'param_name' => 'tdicon_id',
                            'type' => 'icon',
                            'heading' => 'Icon',
                            'class' => 'tdc-textfield-small',
                            'value' => ''
                        ),
                        array(
                            'type' => 'range-responsive',
                            'param_name' => 'icon_size',
                            'value' => '50',
                            'heading' => 'Size (px)',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '10',
                            'range_max' => '100',
                            'range_step' => '1',
                        ),
                        array(
                            'param_name' => 'icon_padding',
                            'type' => 'range-responsive',
                            'value' => '1',
                            'heading' => 'Spacing',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '1',
                            'range_max' => '3',
                            'range_step' => '0.1',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            'param_name' => 'title_text',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Title text',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall'
                        ),
                        array(
                            "param_name" => "title_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H3 - Default' => 'h3',
                                'H4' => 'h4',
                            ),
                            "heading" => 'Title tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big"
                        ),
                        array(
                            "param_name" => "title_size",
                            "type" => "dropdown",
                            "value" => array(
                                'XXSmall' => 'tdm-title-xxsm',
                                'XSmall uppercase' => 'tdm-title-xsm',
                                'Small' => 'tdm-title-sm',
                                'Medium' => 'tdm-title-md',
                                'Big' => 'tdm-title-bg',
                            ),
                            "heading" => __( 'Title size', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall'
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        //icon box style
                        array(
                            "param_name" => "tds_icon_box",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_icon_box', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Icon style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_icon",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_icon', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                            'tdc_min_options' => 2,
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Title style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_title",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title', false ),
                            "heading" => 'Title style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                    ),
                    $this->get_group_params('button'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                    ),
                    $css_tabs_params,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Google analytics',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'ga_event_action',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Action',
                            "description" => "The Google Analytics Event Action. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_category',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Category',
                            "description" => "The Google Analytics Event Category. This setting is required in order to send tracking data to Google Analytics.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'ga_event_label',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'GA Event Label',
                            "description" => "The Google Analytics Event Label. This setting is optional.",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            "heading" => 'Facebook pixel',
                            "value" => "",
                            "class" => "",
                            "group" => 'Tracking'
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_name',
                            "type" => "dropdown",
                            "value" => array(
                                'Select Event' => '',
                                'Lead' => 'Lead',
                                'View Content' => 'ViewContent',
                            ),
                            "heading" => 'Events',
                            "description" => "The Facebook Pixel Event Name. This setting is required in order to send tracking data to Facebook Pixel.",
                            "holder" => "div",
                            'class' => 'tdc-dropdown-big',
                            'group' => 'Tracking',
                        ),
                        array(
                            'param_name' => 'fb_pixel_event_content_name',
                            "type" => "textfield",
                            "value" => '',
                            "heading" => 'Content Name',
                            "description" => "The Facebook Pixel Event Content Name. Using this input you can specify a name for your content when sending the event to Facebook ( this is an optional setting ).",
                            'class' => 'tdc-textfield-big',
                            'group' => 'Tracking',
                        ),
                    )
                )
            )
        );

        td_api_block::add('tdm_block_socials',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_socials",
                'name' => __( 'Social icons', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_socials.php',
                'tdc_style_params' => array(
                    'behance',
                    'blogger',
                    'dribbble',
                    'facebook',
                    'flickr',
                    'googleplus',
                    'instagram',
                    'lastfm',
                    'linkedin',
                    'pinterest',
                    'rss',
                    'soundcloud',
                    'tumblr',
                    'twitter',
                    'vimeo',
                    'youtube',
                    'vk',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'facebook' => '#',
                                'twitter' => '#',
                                'instagram' => '#'
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    $this->get_group_params('social_icons'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Layout',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "display_inline",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Display inline",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "show_names",
                            "type" => "dropdown-responsive",
                            "value" => array(
                                'Hide' => 'none',
                                'Show' => 'inline-block'
                            ),
                            "heading" => 'Social network name',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'name_space_left',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Social network name left space',
                            'description' => '',
                            'placeholder' => '2',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            'param_name' => 'name_space_right',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Social network name right space',
                            'description' => '',
                            'placeholder' => '18',
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_progress_bar',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_progress_bar",
                'name' => __( 'Progress bar', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_progress_bar.php',
                'tdc_style_params' => array(
                    'progress_title',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'progress_title' => 'Skill name',
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'progress_title',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Title',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            'param_name' => 'progress_percentage',
                            'type' => 'range',
                            'value' => '100',
                            'heading' => 'Percentage',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '100',
                            'range_step' => '1',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "tds_progress_bar",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping('tds_progress_bar', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-extrabig",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_counter',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_counter",
                'name' => __( 'Numbered counter', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_counter.php',
                'tdc_style_params' => array(
                    'counter_number',
                    'counter_title',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'counter_title' => 'Awards',
                                'counter_number' => '50',
                                'content_align_horizontal' => 'content-horiz-center',
                            ),
                            array(
                                'tdc_preset_name' => 'Thin fonts centered',
                                'counter_title' => 'Years',
                                'counter_number' => '17',
                                'content_align_horizontal' => 'content-horiz-center',
                                "tds_counter1-f_value_font_family" => "507",
                                "tds_counter1-f_value_font_size" => "eyJhbGwiOiIxMDAiLCJsYW5kc2NhcGUiOiI4MCJ9",
                                "tds_counter1-f_value_font_line_height" => "1.2",
                                "tds_counter1-f_value_font_weight" => "100",
                                "tds_counter1-f_title_font_transform" => "uppercase",
                                "tds_counter1-f_title_font_weight" => "400",
                                "tds_counter1-f_title_font_size" => "16",
                                "tds_counter1-f_title_font_line_height" => "1",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy1yaWdodCI6IjIwIiwicGFkZGluZy1sZWZ0IjoiMjAiLCJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sImxhbmRzY2FwZSI6eyJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sImxhbmRzY2FwZV9tYXhfd2lkdGgiOjExNDAsImxhbmRzY2FwZV9taW5fd2lkdGgiOjEwMTksInBvcnRyYWl0Ijp7IndpZHRoIjoiMzMuMyUiLCJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sInBvcnRyYWl0X21heF93aWR0aCI6MTAxOCwicG9ydHJhaXRfbWluX3dpZHRoIjo3NjgsInBob25lIjp7InBhZGRpbmctcmlnaHQiOiIwIiwicGFkZGluZy1sZWZ0IjoiMCIsIndpZHRoIjoiMTAwJSIsImRpc3BsYXkiOiIifSwicGhvbmVfbWF4X3dpZHRoIjo3Njd9",
                            ),
                            array(
                                'tdc_preset_name' => 'Bold serif left aligned',
                                "counter_title" => "clients",
                                "counter_number" => "5k",
                                "content_align_horizontal" => "content-horiz-left",
                                "tds_counter1-f_value_font_family" => "638",
                                "tds_counter1-f_value_font_size" => "eyJhbGwiOiI4MCIsImxhbmRzY2FwZSI6IjgwIn0=",
                                "tds_counter1-f_value_font_line_height" => "1",
                                "tds_counter1-f_value_font_weight" => "",
                                "tds_counter1-f_title_font_transform" => "uppercase",
                                "tds_counter1-f_title_font_weight" => "700",
                                "tds_counter1-f_title_font_size" => "20",
                                "tds_counter1-f_title_font_line_height" => "1",
                                "tdc_css" => "eyJhbGwiOnsicGFkZGluZy1yaWdodCI6IjIwIiwicGFkZGluZy1sZWZ0IjoiMjAiLCJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sImxhbmRzY2FwZSI6eyJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sImxhbmRzY2FwZV9tYXhfd2lkdGgiOjExNDAsImxhbmRzY2FwZV9taW5fd2lkdGgiOjEwMTksInBvcnRyYWl0Ijp7IndpZHRoIjoiMzMuMyUiLCJkaXNwbGF5IjoiaW5saW5lLWJsb2NrIn0sInBvcnRyYWl0X21heF93aWR0aCI6MTAxOCwicG9ydHJhaXRfbWluX3dpZHRoIjo3NjgsInBob25lIjp7InBhZGRpbmctcmlnaHQiOiIwIiwicGFkZGluZy1sZWZ0IjoiMCIsIndpZHRoIjoiMTAwJSIsImRpc3BsYXkiOiIifSwicGhvbmVfbWF4X3dpZHRoIjo3Njd9",
                                "tds_counter1-f_title_font_style" => "",
                                "tds_counter1-title_color" => "#000000",
                            )
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'counter_number',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Value',
                            'description' => '',
                            'class' => 'tdc-textfield-big',
                        ),
                        array(
                            'param_name' => 'counter_title',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Title',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "tds_counter",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping('tds_counter', false ),
                            "heading" => 'Style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-extrabig",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_food_menu',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_food_menu",
                'name' => __( 'Menu product', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_food_menu.php',
                'tdc_style_params' => array(
                    'title_text',
                    'price',
                    'description',
                    'image',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Pizza Super Deluxe' ),
                                'title_tag' => 'h3',
                                'price' => '$29,95',
                                'image' => self::tdm_get_image( 'tdm_pic_5' ),
                                'description' => base64_encode( 'Salsa di pomodoro, extra mozzarella, salami, ham, cabbage, mushrooms, onions, bell peppers, corn.' ),
                                'content_align_vertical' => 'middle',
                            ),
                            array(
                                'tdc_preset_name' => 'Big square image',
                                'title_text' => base64_encode( 'Pizza Super Deluxe' ),
                                'description' => base64_encode( 'Salsa di pomodoro, extra mozzarella, salami, ham, cabbage, mushrooms, onions, bell peppers, corn.' ),
                                "title_tag" => "h3",
                                "price" => "$29,95",
                                "image" => self::tdm_get_image( 'tdm_pic_1' ),
                                "content_align_vertical" => "middle",
                                "image_height" => "800",
                                "image_width" => "533",
                                "image_size" => "100",
                                "image_space" => "25",
                                "tds_food_menu1-f_price_font_weight" => "400",
                                "tds_food_menu1-f_price_font_family" => "438",
                                "tds_food_menu1-f_title_font_size" => "24",
                                "tds_food_menu1-f_title_font_weight" => "400",
                                "tds_food_menu1-f_title_font_family" => "438",
                                "tds_food_menu1-f_title_font_line_height" => "1.2",
                                "tds_food_menu1-f_descr_font_size" => "14",
                                "tds_food_menu1-f_descr_font_weight" => "300",
                                "tds_food_menu1-f_descr_font_transform" => "",
                                "image_border_radius" => "0%",
                                "tds_food_menu1-f_descr_font_line_height" => "1.5",
                            ),
                            array(
                                'tdc_preset_name' => 'Small round image',
                                'title_text' => base64_encode( 'Pizza Super Deluxe' ),
                                'description' => base64_encode( 'Salsa di pomodoro, extra mozzarella, salami, ham, cabbage, mushrooms, onions, bell peppers, corn.' ),
                                "title_tag" => "h3",
                                "price" => "$9,50",
                                "image" => self::tdm_get_image( 'tdm_pic_1' ),
                                "content_align_vertical" => "middle",
                                "image_height" => "900",
                                "image_width" => "600",
                                "image_border_radius" => "50%",
                                "image_size" => "80",
                                "tds_food_menu1-f_title_font_size" => "16",
                                "tds_food_menu1-f_title_font_transform" => "uppercase",
                                "tds_food_menu1-f_title_font_weight" => "800",
                                "tds_food_menu1-f_price_font_size" => "16",
                                "tds_food_menu1-f_price_font_family" => "521",
                                "tds_food_menu1-f_title_font_line_height" => "1.5",
                                "tds_food_menu1-f_price_font_line_height" => "1.5",
                                "tds_food_menu1-f_descr_font_size" => "14",
                                "tds_food_menu1-f_descr_font_line_height" => "1.3",
                                "tds_food_menu1-f_descr_font_weight" => "",
                                "image_space" => "20",
                                "tds_food_menu1-description_color" => "rgba(0,0,0,0.8)",
                            ),
                            array(
                                'tdc_preset_name' => 'No image, brown fonts',
                                'title_text' => base64_encode( 'Pizza Super Deluxe' ),
                                'description' => base64_encode( 'Salsa di pomodoro, extra mozzarella, salami, ham, cabbage, mushrooms, onions, bell peppers, corn.' ),
                                "title_tag" => "h3",
                                "price" => "12",
                                "content_align_vertical" => "top",
                                "tds_food_menu1-f_title_font_family" => "456",
                                "tds_food_menu1-f_price_font_family" => "456",
                                "tds_food_menu1-f_title_font_size" => "26",
                                "tds_food_menu1-f_price_font_size" => "24",
                                "tds_food_menu1-f_title_font_weight" => "400",
                                "tds_food_menu1-f_title_font_transform" => "",
                                "tds_food_menu1-f_price_font_weight" => "400",
                                "tds_food_menu1-f_descr_font_family" => "507",
                                "tds_food_menu1-f_descr_font_weight" => "400",
                                "tds_food_menu1-f_descr_font_size" => "14",
                                "tds_food_menu1-f_descr_font_line_height" => "1.5",
                                "tds_food_menu1-f_title_font_line_height" => "1.5",
                                "tds_food_menu1-f_price_font_line_height" => "1.5",
                                "tds_food_menu1-title_color" => "#725601",
                                "tds_food_menu1-price_color" => "#725601",
                                "tds_food_menu1-description_color" => "#cebc6b",
                            ),
                            array(
                                'tdc_preset_name' => 'No image, calligraphic fonts',
                                'title_text' => base64_encode( 'Pizza Super Deluxe' ),
                                'description' => base64_encode( 'Salsa di pomodoro, extra mozzarella, salami, ham, cabbage, mushrooms, onions, bell peppers, corn.' ),
                                "title_tag" => "h3",
                                "price" => "$15",
                                "content_align_vertical" => "top",
                                "tds_food_menu1-f_title_font_family" => "161",
                                "tds_food_menu1-f_price_font_family" => "507",
                                "tds_food_menu1-f_title_font_size" => "eyJhbGwiOiIzMiIsInBvcnRyYWl0IjoiMjgifQ==",
                                "tds_food_menu1-f_price_font_size" => "eyJhbGwiOiIyMCIsInBvcnRyYWl0IjoiMTgifQ==",
                                "tds_food_menu1-f_title_font_weight" => "600",
                                "tds_food_menu1-f_title_font_transform" => "",
                                "tds_food_menu1-f_price_font_weight" => "600",
                                "tds_food_menu1-f_descr_font_family" => "507",
                                "tds_food_menu1-f_descr_font_weight" => "400",
                                "tds_food_menu1-f_descr_font_size" => "eyJhbGwiOiIxNCIsInBvcnRyYWl0IjoiMTIifQ==",
                                "tds_food_menu1-f_descr_font_line_height" => "eyJhbGwiOiIxLjciLCJwb3J0cmFpdCI6IjEuNSJ9",
                                "tds_food_menu1-f_title_font_line_height" => "1.5",
                                "tds_food_menu1-f_price_font_line_height" => "1.5",
                                "tds_food_menu1-description_color" => "rgba(0,0,0,0.7)",
                                "tds_food_menu1-f_descr_font_style" => "italic",
                                "tds_food_menu1-f_descr_font_transform" => "uppercase",
                                "tds_food_menu1-f_price_font_style" => "italic",
                            )
                        )
                    )
                ),

                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'title_text',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Title text',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "title_tag",
                            "type" => "dropdown",
                            "value" => array(
                                'H1' => 'h1',
                                'H2' => 'h2',
                                'H3 - Default' => 'h3',
                                'H4' => 'h4',
                            ),
                            "heading" => 'Title tag (SEO)',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'price',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Price',
                            'description' => '',
                            'class' => 'tdc-textfield-big',
                        ),
                        array(
                            'param_name' => 'description',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Description',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                        array(
                            "param_name" => "image",
                            "type" => "attach_image",
                            "value" => '',
                            "heading" => __( "Image", 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'image_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '75',
                        ),
                        array(
                            'param_name' => 'image_space',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '22',
                        ),
                        array(
                            'param_name' => 'image_border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '50%',
                        ),
                        array(
                            "param_name" => "content_align_vertical",
                            "type" => "dropdown",
                            "value" => array(
                                'Top' => 'top',
                                'Center' => 'middle',
                                'Bottom' => 'bottom'
                            ),
                            "heading" => 'Vertical align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Style',
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "tds_food_menu",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_food_menu', false ),
                            "heading" => 'Menu item style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            'tdc_min_options' => 1,
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );

        td_api_block::add('tdm_block_title_over_image',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdm_block_title_over_image",
                'name' => __( 'Title over image', 'td_composer' ),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'Multipurpose',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdm_block_title_over_image.php',
                'tdc_style_params' => array(
                    'title_text',
                    'subtitle_text',
                    'url',
                    'image',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => base64_encode( 'Title over image' ),
                                'title_size' => 'tdm-title-md',
                                'subtitle_text' => 'Subtitle',
                                'url' => '#',
                                'open_in_new_window' => 'yes',
                                'image' => self::tdm_get_image( 'tdm_pic_8' ),
                                'image_alignment' => 'center',
                            ),
                        )
                    )
                ),
                "params" => array_merge(
                    array(
                        array(
                            'param_name' => 'title_text',
                            'type' => 'textarea_raw_html',
                            'value' => '',
                            'heading' => 'Title text',
                            'description' => '',
                            'class' => 'tdc-textarea-extrasmall',
                        ),
                        array(
                            "param_name" => "title_size",
                            "type" => "dropdown",
                            "value" => array(
                                'XXSmall' => 'tdm-title-xxsm',
                                'XSmall uppercase' => 'tdm-title-xsm',
                                'Small' => 'tdm-title-sm',
                                'Medium' => 'tdm-title-md',
                                'Big' => 'tdm-title-bg',
                            ),
                            "heading" => __( 'Title size', 'td_composer' ),
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            'param_name' => 'subtitle_text',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Subtitle text',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            'param_name' => 'url',
                            'type' => 'textfield',
                            'value' => '',
                            'heading' => 'Url',
                            'description' => '',
                            'class' => 'tdc-textfield-extrabig',
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                        ),
                    ),
                    $this->get_group_params('image'),
                    array(
                        array(
                            'type' => 'range-responsive',
                            'param_name' => 'image_opacity',
                            'value' => '1',
                            'heading' => 'Image opacity',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '1',
                            'range_step' => '0.1',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                        ),
                        array(
                            'param_name' => 'block_height',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Block height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => 400,
                        ),
                        array(
                            "param_name" => "show_title",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Show title only on hover",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "content_align_horizontal",
                            "type" => "dropdown",
                            "value" => array(
                                'Left' => 'content-horiz-left',
                                'Center' => 'content-horiz-center',
                                'Right' => 'content-horiz-right'
                            ),
                            "heading" => 'Horizontal align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "content_align_vertical",
                            "type" => "dropdown",
                            "value" => array(
                                'Top' => 'content-vert-top',
                                'Center' => 'content-vert-center',
                                'Bottom' => 'content-vert-bottom'
                            ),
                            "heading" => 'Vertical align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'General style',
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "tds_title_over_image",
                            "type" => "dropdown",
                            "value" => td_api_style::get_styles_for_mapping( 'tds_title_over_image', false ),
                            "heading" => 'Title over image style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                    ),
                    $css_tabs_params
                )
            )
        );
    }

	static function get_mapped_atts( $class_name ) {

		$mapped_atts = array();
		$api_block_settings = td_api_block::get_all();
		$mapped_params = $api_block_settings[ $class_name ]['params'];

		foreach ( $mapped_params as $mapped_param ) {
			$value = $mapped_param['value'];
			if ( is_array( $value ) ) {
				foreach ( $value as $key => $val ) {
					$value = $val;
					break;
				}
			}
			$mapped_atts[$mapped_param['param_name']] = $value;
		}
		return $mapped_atts;
	}




	function register_styles() {

        // Title style
		td_api_style::add( 'tds_title1', array(
				'group' => 'tds_title',
				'title' => 'Style 1 - Default',
				'file' => $this->plugin_path . '/styles/tds_title/tds_title1.php',
		        'params' => array_merge( array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover title color',
                            "param_name" => "hover_title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text', 'Style' )
		        ),
			)
		);

		td_api_style::add( 'tds_title2', array(
				'group' => 'tds_title',
				'title' => 'Style 2 - With line',
				'file' => $this->plugin_path . '/styles/tds_title/tds_title2.php',
		        'params' => array_merge( array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "line_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Line color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'line_width',
                            "value" => '',
                            "heading" => 'Line width',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '180',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'line_height',
                            "value" => '',
                            "heading" => 'Line height',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '2',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'line_space',
                            "value" => '',
                            "heading" => 'Line space',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '49',
                        ),
                        array(
                            'type' => 'range-responsive',
                            'param_name' => 'line_alignment',
                            'value' => '40',
                            'heading' => 'Line alignment',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-100',
                            'range_max' => '100',
                            'range_step' => '10',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover title color',
                            "param_name" => "hover_title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "hover_line_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Hover line color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'hover_line_width',
                            "value" => '',
                            "heading" => 'Hover line width',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text', 'Style' )
		        ),
		    )
		);

        td_api_style::add( 'tds_title3', array(
                'group' => 'tds_title',
                'title' => 'Style 3 - With subtitle',
                'file' => $this->plugin_path . '/styles/tds_title/tds_title3.php',
                'params' => array_merge( array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "line_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Line color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'line_width',
                            "value" => '',
                            "heading" => 'Line width',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '120',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'line_height',
                            "value" => '',
                            "heading" => 'Line height',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '1',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'line_space',
                            "value" => '',
                            "heading" => 'Line space',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '20',
                        ),
                        array(
                            'type' => 'range-responsive',
                            'param_name' => 'line_alignment',
                            'value' => '0',
                            'heading' => 'Line alignment',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-100',
                            'range_max' => '100',
                            'range_step' => '10',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "subtitle_position",
                            "type" => "dropdown",
                            "value" => array(
                                'Below text' => '',
                                'Above text' => 'above',
                            ),
                            "heading" => 'Subtitle position',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                        ),
                        array(
                            "type" => 'textfield',
                            "param_name" => 'subtitle_text',
                            "value" => 'Subtitle text',
                            "heading" => 'Subtitle text',
                            "class" => 'tdc-textfield-extrabig',
                            "description" => '',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'subtitle_space',
                            "value" => '',
                            "heading" => 'Subtitle space',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '12',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Subtitle text color',
                            "param_name" => "subtitle_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover title color',
                            "param_name" => "hover_title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "hover_line_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Hover line color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover subtitle color',
                            "param_name" => "hover_subtitle_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'hover_line_width',
                            "value" => '',
                            "heading" => 'Hover line width',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_subtitle', false, 'Subtitle text', 'Style' )
                ),
            )
        );


        // Social style
        td_api_style::add( 'tds_social1', array(
                'group' => 'tds_social',
                'title' => 'Style 1 - Simple',
                'file' => $this->plugin_path . '/styles/tds_social/tds_social1.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icons_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon hover color',
                            "param_name" => "icons_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name hover color',
                            "param_name" => "name_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Social network name', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_social2', array(
                'group' => 'tds_social',
                'title' => 'Style 2 - Simple black',
                'file' => $this->plugin_path . '/styles/tds_social/tds_social2.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icons_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon hover color',
                            "param_name" => "icons_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name hover color',
                            "param_name" => "name_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Social network name', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_social3', array(
                'group' => 'tds_social',
                'title' => 'Style 3 - With background',
                'file' => $this->plugin_path . '/styles/tds_social/tds_social3.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icons_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "icons_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Icon background color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            'param_name' => 'border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Icon border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                            'group' => 'Style',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon hover color',
                            "param_name" => "icons_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "icons_background_hover_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Icon background hover color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name hover color',
                            "param_name" => "name_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Social network name', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_social4', array(
                'group' => 'tds_social',
                'title' => 'Style 4 - Bordered',
                'file' => $this->plugin_path . '/styles/tds_social/tds_social4.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icons_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "icons_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Icon background color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon hover color',
                            "param_name" => "icons_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "icons_background_hover_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Icon background hover color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name hover color',
                            "param_name" => "name_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border settings',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'all_border_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border width',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '1',
                            'group' => 'Style',
                        ),
                        array(
                            "param_name" => "all_border_style",
                            "type" => "dropdown-responsive",
                            "value" => array(
                                'Solid' => '',
                                'Dashed' => 'dashed',
                                'Dotted' => 'dotted',
                                'Double' => 'double',
                            ),
                            "heading" => 'Border style',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "#ededed",
                            "heading" => 'Border color',
                            "param_name" => "all_icons_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border hover color',
                            "param_name" => "icons_border_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            'param_name' => 'border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                            'group' => 'Style',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Social network name', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_social5', array(
                'group' => 'tds_social',
                'title' => 'Style 5 - With shadow',
                'file' => $this->plugin_path . '/styles/tds_social/tds_social5.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icons_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "icons_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Icon background color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            'param_name' => 'border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Icon border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                            'group' => 'Style',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon hover color',
                            "param_name" => "icons_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "icons_background_hover_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Icon background hover color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name hover color',
                            "param_name" => "name_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 10, 0, 2, 'Style'),
                    td_config_helper::get_map_block_shadow_array('shadow_hover', 'Shadow hover', 16, 0, 2, 'Style', 0, false),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Social network name', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_social6', array(
                'group' => 'tds_social',
                'title' => 'Style 6 - Columns',
                'file' => $this->plugin_path . '/styles/tds_social/tds_social6.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name"  => "columns",
                            "type"        => "dropdown-responsive",
                            "value"       => array(
                                '1'  => '100%',
                                '2'  => '50%',
                                '3'  => '33.33333333%',
                                '4'  => '25%',
                                '5'  => '20%',
                                '6'  => '16.66666667%',
                            ),
                            "heading"     => 'Columns',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-dropdown-small",
                            "group"       => "Layout",
                        ),
                        array(
                            "param_name"  => "columns_gap",
                            "type"        => "textfield-responsive",
                            "value"       => '',
                            "heading"     => 'Columns gap',
                            "description" => "",
                            "holder"      => "div",
                            "class"       => "tdc-textfield-small",
                            "placeholder" => "30",
                            "group"       => "Layout",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icons_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon hover color',
                            "param_name" => "icons_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Social network name hover color',
                            "param_name" => "name_color_h",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Social network name', 'Style' )
                )
            )
        );


        // Team member style
        td_api_style::add( 'tds_team_member1', array(
                'group' => 'tds_team_member',
                'title' => 'Style 1 - Default',
                'file' => $this->plugin_path . '/styles/tds_team_member/tds_team_member1.php',
                'params' => array_merge(
                    array(
                        array(
                            'param_name' => 'image_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image width',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Name text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_team_member2', array(
                'group' => 'tds_team_member',
                'title' => 'Style 2 - Info on hover',
                'file' => $this->plugin_path . '/styles/tds_team_member/tds_team_member2.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "description_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Description background color",
                            "value" => "",
                            "class" => "",
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "description_align_vertical",
                            "type" => "dropdown",
                            "value" => array(
                                'Top' => 'content-vert-top',
                                'Center' => 'content-vert-center',
                                'Bottom' => 'content-vert-bottom'
                            ),
                            "heading" => 'Descr. vertical align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Name text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_team_member3', array(
                'group' => 'tds_team_member',
                'title' => 'Style 3 - Columns',
                'file' => $this->plugin_path . '/styles/tds_team_member/tds_team_member3.php',
                'params' => array_merge(
                    array(
                        array(
                            'param_name' => 'image_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image width',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '',
                        ),
                        array(
                            'param_name' => 'image_space',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Image space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '28',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "content_align_vertical",
                            "type" => "dropdown",
                            "value" => array(
                                'Top' => 'content-vert-top',
                                'Center' => 'content-vert-center',
                                'Bottom' => 'content-vert-bottom'
                            ),
                            "heading" => 'Vertical align',
                            "description" => "",
                            "holder" => "div",
                            'tdc_dropdown_images' => true,
                            "class" => "tdc-visual-selector tdc-add-class",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Name text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' )
                ),
            )
        );


        // Progress bar style
        td_api_style::add( 'tds_progress_bar1', array(
                'group' => 'tds_progress_bar',
                'title' => 'Style 1 - Horizontal',
                'file' => $this->plugin_path . '/styles/tds_progress_bar/tds_progress_bar1.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Percentage text color',
                            "param_name" => "percentage_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "percentage_bar_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Percentage bar color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "percentage_bar_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Percentage bar background color",
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text' ),
                    td_config_helper::get_map_block_font_array( 'f_percentage', false, 'Percentage text' )
                ),
            )
        );

        td_api_style::add( 'tds_progress_bar2', array(
                'group' => 'tds_progress_bar',
                'title' => 'Style 2 - Vertical',
                'file' => $this->plugin_path . '/styles/tds_progress_bar/tds_progress_bar2.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Percentage text color',
                            "param_name" => "percentage_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            'param_name' => 'percentage_bar_height',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Percentage bar height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '200',
                        ),
                        array(
                            "param_name" => "percentage_bar_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Percentage bar color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "percentage_bar_background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Percentage bar background color",
                            "value" => "",
                            "class" => "",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text' ),
                    td_config_helper::get_map_block_font_array( 'f_percentage', false, 'Percentage text' )
                ),
            )
        );

        td_api_style::add( 'tds_progress_bar3', array(
                'group' => 'tds_progress_bar',
                'title' => 'Style 3 - Half circle',
                'file' => $this->plugin_path . '/styles/tds_progress_bar/tds_progress_bar3.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Percentage text color',
                            "param_name" => "percentage_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            'param_name' => 'percentage_bar_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Percentage bar size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Percentage bar color',
                            "param_name" => "percentage_bar_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Percentage bar background color',
                            "param_name" => "percentage_bar_background_color",
                            "value" => '',
                            "description" => '',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text' ),
                    td_config_helper::get_map_block_font_array( 'f_percentage', false, 'Percentage text' )
                ),
            )
        );



        // Counter style
        td_api_style::add( 'tds_counter1', array(
                'group' => 'tds_counter',
                'title' => 'Style 1 - Simple',
                'file' => $this->plugin_path . '/styles/tds_counter/tds_counter1.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Counter color',
                            "param_name" => "counter_number_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => ""
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_value', true, 'Value text' ),
                    td_config_helper::get_map_block_font_array( 'f_title', false, 'Title text' )
                ),
            )
        );


        // Pricing style
        td_api_style::add( 'tds_pricing1', array(
                'group' => 'tds_pricing',
                'title' => 'Style 1 - Default',
                'file' => $this->plugin_path . '/styles/tds_pricing/tds_pricing1.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Price color',
                            "param_name" => "price_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Old price color',
                            "param_name" => "old_price_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Ribbon text color',
                            "param_name" => "ribbon_text_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Ribbon background color',
                            "param_name" => "ribbon_background_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Features text color',
                            "param_name" => "features_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Missing features text color',
                            "param_name" => "features_non_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Features icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Missing features icon color',
                            "param_name" => "icon_non_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Featured border settings',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'border_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Featured border size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '3',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "border_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Featured border color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 8, 'Style'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_price', true, 'Price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_old_price', false, 'Old price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_currency', false, 'Currency text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_old_currency', false, 'Old currency text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_period', false, 'Charging period text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_ribbon', false, 'Ribbon text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_features', false, 'Features text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_pricing2', array(
                'group' => 'tds_pricing',
                'title' => 'Style 2 - Header background',
                'file' => $this->plugin_path . '/styles/tds_pricing/tds_pricing2.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "header_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Header background color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "header_featured_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Header featured background color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Price color',
                            "param_name" => "price_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Old price color',
                            "param_name" => "old_price_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Ribbon text color',
                            "param_name" => "ribbon_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Ribbon background color',
                            "param_name" => "ribbon_background_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Features text color',
                            "param_name" => "features_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Missing features text color',
                            "param_name" => "features_non_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Features icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Missing features icon color',
                            "param_name" => "icon_non_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 8, 'Style'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_price', true, 'Price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_old_price', false, 'Old price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_currency', false, 'Currency text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_old_currency', false, 'Old currency text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_period', false, 'Charging period text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_ribbon', false, 'Ribbon text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_features', false, 'Features text', 'Style' )

                ),
            )
        );

        td_api_style::add( 'tds_pricing3', array(
                'group' => 'tds_pricing',
                'title' => 'Style 3 - With shadow',
                'file' => $this->plugin_path . '/styles/tds_pricing/tds_pricing3.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Price color',
                            "param_name" => "price_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Old price color',
                            "param_name" => "old_price_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Ribbon text color',
                            "param_name" => "ribbon_text_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Ribbon background color',
                            "param_name" => "ribbon_background_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Features text color',
                            "param_name" => "features_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Missing features text color',
                            "param_name" => "features_non_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Features icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Missing features icon color',
                            "param_name" => "icon_non_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Featured border settings',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'border_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Featured border size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '3',
                        ),
                        array(
                            "param_name" => "border_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Featured border color",
                            "value" => "",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 25, 0, 8, 'Style'),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_price', true, 'Price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_old_price', false, 'Old price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_currency', false, 'Currency text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_old_currency', false, 'Old currency text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_period', false, 'Charging period text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_ribbon', false, 'Ribbon text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_features', false, 'Features text', 'Style' )
                ),
            )
        );


        // Food menu style
        td_api_style::add( 'tds_food_menu1', array(
                'group' => 'tds_food_menu',
                'title' => 'Style 1 - Default',
                'file' => $this->plugin_path . '/styles/tds_food_menu/tds_food_menu1.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "title_color",
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "price_color",
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Price color',
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "description_color",
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_price', false, 'Price text', 'Style' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' )
                ),
            )
        );


        // Call to action style
        td_api_style::add( 'tds_call_to_action1', array(
                'group' => 'tds_call_to_action',
                'title' => 'Style 1 - Simple',
                'file' => $this->plugin_path . '/styles/tds_call_to_action/tds_call_to_action1.php',
                'params' => array_merge(
	                array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 8),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Description text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_call_to_action2', array(
                'group' => 'tds_call_to_action',
                'title' => 'Style 2 - With shadow',
                'file' => $this->plugin_path . '/styles/tds_call_to_action/tds_call_to_action2.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 25, 0, 8),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Description text', 'Style' )
                ),
            )
        );


        // Testimonial style
        td_api_style::add( 'tds_testimonial1', array(
                'group' => 'tds_testimonial',
                'title' => 'Style 1 - Quote above text',
                'file' => $this->plugin_path . '/styles/tds_testimonial/tds_testimonial1.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Quote icon color',
                            "param_name" => "quote_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Name text' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text' )
                ),
            )
        );

        td_api_style::add( 'tds_testimonial2', array(
                'group' => 'tds_testimonial',
                'title' => 'Style 2 - Quote behind text',
                'file' => $this->plugin_path . '/styles/tds_testimonial/tds_testimonial2.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Quote icon color',
                            "param_name" => "quote_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Name text' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text' )
                ),
            )
        );

        td_api_style::add( 'tds_testimonial3', array(
                'group' => 'tds_testimonial',
                'title' => 'Style 3 - With background',
                'file' => $this->plugin_path . '/styles/tds_testimonial/tds_testimonial3.php',
                'params' => array_merge(
                    array(
	                    array(
		                    'param_name' => 'desc_radius',
		                    'type' => 'range_multiple-responsive',
		                    'heading' => 'Testimonial radius',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'value' => '',
		                    'tdc_values' => array(
			                    'percent' => array(
				                    'unit' => '%',
				                    'value' => '0',
				                    'range_min' => '0',
				                    'range_max' => '50',
				                    'range_step' => '1',
			                    ),
			                    'px' => array(
				                    'unit' => 'px',
				                    'value' => '0',
				                    'range_min' => '0',
				                    'range_max' => '100',
				                    'range_step' => '1',
			                    )
		                    ),
	                    ),
	                    array(
		                    'param_name' => 'arrow_size',
		                    'type' => 'range-responsive',
		                    'value' => '14',
		                    'heading' => 'Arrow size',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '30',
		                    'range_step' => '1',
	                    ),
	                    array(
		                    'param_name' => 'arrow_pos',
		                    'type' => 'range-responsive',
		                    'value' => '12',
		                    'heading' => 'Arrow position',
		                    'description' => '',
		                    'class' => 'tdc-textfield-small',
		                    'range_min' => '0',
		                    'range_max' => '100',
		                    'range_step' => '1',
	                    ),
	                    array(
		                    "param_name" => "separator",
		                    "type" => "horizontal_separator",
		                    "value" => "",
		                    "class" => "tdc-separator-small"
	                    ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text background color',
                            "param_name" => "background_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Name text' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text' )
                ),
            )
        );

        td_api_style::add( 'tds_testimonial4', array(
                'group' => 'tds_testimonial',
                'title' => 'Style 4 - Quote above text',
                'file' => $this->plugin_path . '/styles/tds_testimonial/tds_testimonial4.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Name color',
                            "param_name" => "name_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Job title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "description_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            'param_name' => 'all_border_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '1',
                        ),
                        array(
                            "param_name" => "all_border_style",
                            "type" => "dropdown-responsive",
                            "value" => array(
                                'Solid - default' => '',
                                'Dashed' => 'dashed',
                                'Dotted' => 'dotted',
                                'Double' => 'double',
                            ),
                            "heading" => 'Border style',
                            "description" => "Optional - Choose a custom border type for the button",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "all_border_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            'param_name' => 'border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '5',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_name', true, 'Name text' ),
                    td_config_helper::get_map_block_font_array( 'f_job_title', false, 'Job title text' ),
                    td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text' )
                ),
            )
        );


        // Button style
        td_api_style::add( 'tds_button1', array(
                'group' => 'tds_button',
                'title' => 'Style 1 - Solid',
                'file' => $this->plugin_path . '/styles/tds_button/tds_button1.php',
                'params' => array_merge( array(
                        array(
                            "param_name" => "background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Background color",
                            "value" => "",
                            "description" => 'Optional - Choose a custom background color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "background_hover_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Hover background color",
                            "value" => "",
                            "description" => 'Optional - Choose a custom background hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover text color',
                            "param_name" => "text_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover icon color',
                            "param_name" => "icon_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'border_radius',
                            "value" => '',
                            "heading" => 'Border radius',
                            "class" => 'tdc-textfield-small',
                            "description" => 'Optional - Choose a custom border radius for the button',
                            "placeholder" => "0",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn_text', true, 'Button text', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_button2', array(
                'group' => 'tds_button',
                'title' => 'Style 2 - Bordered',
                'file' => $this->plugin_path . '/styles/tds_button/tds_button2.php',
                'params' => array_merge(
	                array(
	                    array(
	                        "type" => "gradient",
	                        "holder" => "div",
	                        "class" => "",
	                        "heading" => 'Text color',
	                        "param_name" => "text_color",
	                        "value" => '',
	                        "description" => 'Optional - Choose a custom text color for the button',
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => "gradient",
	                        "holder" => "div",
	                        "class" => "",
	                        "heading" => 'Icon color',
	                        "param_name" => "icon_color",
	                        "value" => '',
	                        "description" => 'Optional - Choose a custom icon color for the button',
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => 'textfield-responsive',
	                        "param_name" => 'border_size',
	                        "value" => '',
	                        "heading" => 'Border size',
	                        "class" => 'tdc-textfield-small',
	                        "description" => 'Optional - Choose a custom border size for the button',
	                        "placeholder" => "2",
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => "gradient",
	                        "holder" => "div",
	                        "class" => "",
	                        "heading" => 'Border color',
	                        "param_name" => "border_color",
	                        "value" => '',
	                        "description" => 'Optional - Choose a custom border color for the button',
	                        "group" => "Style",
	                    ),
	                    array(
	                        "param_name" => "border_style",
	                        "type" => "dropdown",
	                        "value" => array(
	                            'Solid - default' => '',
	                            'Dashed' => 'dashed',
	                            'Dotted' => 'dotted',
	                            'Double' => 'double',
	                        ),
	                        "heading" => 'Border style',
	                        "description" => "Optional - Choose a custom border type for the button",
	                        "holder" => "div",
	                        "class" => "tdc-dropdown-big",
	                        "group" => "Style",
	                    ),
	                    array(
	                        "param_name" => "separator",
	                        "type" => "horizontal_separator",
	                        "value" => "",
	                        "class" => "tdc-separator-small",
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => "colorpicker",
	                        "holder" => "div",
	                        "class" => "",
	                        "heading" => 'Hover text color',
	                        "param_name" => "text_hover_color",
	                        "value" => '',
	                        "description" => 'Optional - Choose a custom text hover color for the button',
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => "colorpicker",
	                        "holder" => "div",
	                        "class" => "",
	                        "heading" => 'Hover icon color',
	                        "param_name" => "icon_hover_color",
	                        "value" => '',
	                        "description" => 'Optional - Choose a custom icon hover color for the button',
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => "colorpicker",
	                        "holder" => "div",
	                        "class" => "",
	                        "heading" => 'Hover border color',
	                        "param_name" => "border_hover_color",
	                        "value" => '',
	                        "description" => 'Optional - Choose a custom border hover color for the button',
	                        "group" => "Style",
	                    ),
	                    array(
	                        "param_name" => "separator",
	                        "type" => "horizontal_separator",
	                        "value" => "",
	                        "class" => "tdc-separator-small",
	                        "group" => "Style",
	                    ),
	                    array(
	                        "type" => 'textfield-responsive',
	                        "param_name" => 'border_radius',
	                        "value" => '',
	                        "heading" => 'Border radius',
	                        "class" => 'tdc-textfield-small',
	                        "description" => 'Optional - Choose a custom border radius for the button',
	                        "placeholder" => "0",
	                        "group" => "Style",
	                    ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
	                ),
	                td_config_helper::get_map_block_font_array( 'f_btn_text', true, 'Button text', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_button3', array(
                'group' => 'tds_button',
                'title' => 'Style 3 - With shadow',
                'file' => $this->plugin_path . '/styles/tds_button/tds_button3.php',
                'params' => array_merge(array(
                        array(
                            "param_name" => "background_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Background color",
                            "value" => "",
                            "description" => 'Optional - Choose a custom background color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "background_hover_color",
                            "holder" => "div",
                            "type" => "gradient",
                            'heading' => "Hover background color",
                            "value" => "",
                            "description" => 'Optional - Choose a custom background hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover text color',
                            "param_name" => "text_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover icon color',
                            "param_name" => "icon_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 16, 0, 2),
                    td_config_helper::get_map_block_shadow_array('shadow_hover', 'Hover shadow', 26, 0, 2, '', '', 0, false),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'border_radius',
                            "value" => '',
                            "heading" => 'Border radius',
                            "class" => 'tdc-textfield-small',
                            "description" => 'Optional - Choose a custom border radius for the button',
                            'placeholder' => '0',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn_text', true, 'Button text', 'Style' )
                )
            )
        );

        td_api_style::add( 'tds_button4', array(
                'group' => 'tds_button',
                'title' => 'Style 4 - 3D cube',
                'file' => $this->plugin_path . '/styles/tds_button/tds_button4.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Background color',
                            "param_name" => "background_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom background color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover background color',
                            "param_name" => "background_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom background hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover text color',
                            "param_name" => "text_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover icon color',
                            "param_name" => "icon_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => 'textfield',
                            "param_name" => 'text_other',
                            "value" => '',
                            "heading" => 'Other text on hover',
                            "class" => 'tdc-textfield-big',
                            "description" => 'Optional - Choose a custom text button on hover',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 2),
                    td_config_helper::get_map_block_shadow_array('shadow_hover', 'Hover shadow', 0, 0, 2, '', '', 0, false),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn_text', true, 'Button text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_button5', array(
                'group' => 'tds_button',
                'title' => 'Style 5 - Text',
                'file' => $this->plugin_path . '/styles/tds_button/tds_button5.php',
                'params' => array_merge( array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover text color',
                            "param_name" => "text_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover icon color',
                            "param_name" => "icon_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon hover color for the button',
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn_text', true, 'Button text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_button6', array(
                'group' => 'tds_button',
                'title' => 'Style 6 - Bordered with shadow',
                'file' => $this->plugin_path . '/styles/tds_button/tds_button6.php',
                'params' => array_merge( array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Text color',
                            "param_name" => "text_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'border_size',
                            "value" => '',
                            "heading" => 'Border size',
                            "class" => 'tdc-textfield-small',
                            "description" => 'Optional - Choose a custom border size for the button',
                            "placeholder" => "1",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "border_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom border color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "border_style",
                            "type" => "dropdown",
                            "value" => array(
                                'Solid - default' => '',
                                'Dashed' => 'dashed',
                                'Dotted' => 'dotted',
                                'Double' => 'double',
                            ),
                            "heading" => 'Border style',
                            "description" => "Optional - Choose a custom border type for the button",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'shadow_offset',
                            'type' => 'range-responsive',
                            'value' => '4',
                            'heading' => 'Shadow offset',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Shadow color',
                            "param_name" => "shadow_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover text color',
                            "param_name" => "text_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom text hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover icon color',
                            "param_name" => "icon_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom icon hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover border color',
                            "param_name" => "border_hover_color",
                            "value" => '',
                            "description" => 'Optional - Choose a custom border hover color for the button',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'shadow_hover_offset',
                            'type' => 'range-responsive',
                            'value' => '0',
                            'heading' => 'Shadow hover offset',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Shadow hover color',
                            "param_name" => "shadow_hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'border_radius',
                            "value" => '',
                            "heading" => 'Border radius',
                            "class" => 'tdc-textfield-small',
                            "description" => 'Optional - Choose a custom border radius for the button',
                            "placeholder" => "0",
                            "group" => "Type",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_btn_text', true, 'Button text', 'Style' )
                ),
            )
        );

        td_api_style::add( 'tds_icon1', array(
                'group' => 'tds_icon',
                'title' => 'Style 1 - Default',
                'file' => $this->plugin_path . '/styles/tds_icon/tds_icon1.php',
                'params' => array_merge(
                    array(
                    array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Color',
                            "param_name" => "color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Background color',
                            "param_name" => "bg_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover color',
                            "param_name" => "hover_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover bg color',
                            "param_name" => "hover_bg_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 0, 'Style' ),
                    td_config_helper::get_map_block_shadow_array('shadow_hover', 'Hover shadow', 0, 0, 0, 'Style', '', 0, false ),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border settings',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'all_border_size',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "all_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => 'all_border_style',
                            "type" => "dropdown-responsive",
                            "value" => array(
                                'Solid' => '',
                                'Dashed' => 'dashed',
                                'Dotted' => 'dotted',
                            ),
                            "heading" => 'Border type',
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-dropdown-big",
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover border color',
                            "param_name" => "hover_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'hover_border_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Hover border radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '',
                            "group" => "Style",
                        ),
                    )
                ),
            )
        );
        //icon box
        td_api_style::add( 'tds_icon_box1', array(
                'group' => 'tds_icon_box',
                'title' => 'Style 1 - Default',
                'file' => $this->plugin_path . '/styles/tds_icon_box/tds_icon_box1.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "icon_box_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => "Icon box link",
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig"
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'title_top_space',
                            'type' => 'range-responsive',
                            'value' => '20',
                            'heading' => 'Title top space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-20',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '-10',
                            'heading' => 'Title bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'description_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '30',
                            'heading' => 'Description bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "icon_box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover description color',
                            "param_name" => "icon_box_hover_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Descrption text' )
                ),
            )
        );
        td_api_style::add( 'tds_icon_box2', array(
                'group' => 'tds_icon_box',
                'title' => 'Style 2 - Columns',
                'file' => $this->plugin_path . '/styles/tds_icon_box/tds_icon_box2.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "icon_box_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => "Icon box link",
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig"
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            "param_name" => "icon_right",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Place icon right",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'icon_right_space',
                            'type' => 'range-responsive',
                            'value' => '15',
                            'heading' => 'Icon right space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_top_space',
                            'type' => 'range-responsive',
                            'value' => '10',
                            'heading' => 'Title top space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-20',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '-10',
                            'heading' => 'Title bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'description_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '30',
                            'heading' => 'Description bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "icon_box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover description color',
                            "param_name" => "icon_box_hover_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Descrption text' )
                ),
            )
        );

        td_api_style::add( 'tds_icon_box3', array(
                'group' => 'tds_icon_box',
                'title' => 'Style 3 - Under',
                'file' => $this->plugin_path . '/styles/tds_icon_box/tds_icon_box3.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "icon_box_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => "Icon box link",
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig"
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'icon_vertical_space',
                            'type' => 'range-responsive',
                            'value' => '-10',
                            'heading' => 'Icon vertical',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'icon_horizontal_space',
                            'type' => 'range-responsive',
                            'value' => '-20',
                            'heading' => 'Icon horizontal',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '-10',
                            'heading' => 'Title bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'description_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '30',
                            'heading' => 'Description bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "icon_box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover description color',
                            "param_name" => "icon_box_hover_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Descrption text' )
                ),
            )
        );

        td_api_style::add( 'tds_icon_box4', array(
                'group' => 'tds_icon_box',
                'title' => 'Style 4 - Shadow',
                'file' => $this->plugin_path . '/styles/tds_icon_box/tds_icon_box4.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "icon_box_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => "Icon box link",
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig"
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'icon_box_container_height',
                            'type' => 'range-responsive',
                            'value' => '330',
                            'heading' => 'Container height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '200',
                            'range_max' => '500',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_top_space',
                            'type' => 'range-responsive',
                            'value' => '0',
                            'heading' => 'Title top space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-20',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '-10',
                            'heading' => 'Title bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-40',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'description_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '30',
                            'heading' => 'Description bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "icon_box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover description color',
                            "param_name" => "icon_box_hover_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'icon_box_line_thick',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Line thickness',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '3',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Line color',
                            "param_name" => "icon_box_line_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Background color',
                            "param_name" => "icon_box_wrap_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover line color',
                            "param_name" => "icon_box_hover_line_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover background color',
                            "param_name" => "icon_box_hover_wrap_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        )
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 0, 'Style'),
                    td_config_helper::get_map_block_shadow_array('shadow_hover', 'Shadow hover', 0, 0, 0, 'Style', '', 0, false),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        )
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Descrption text', 'Style' )
                ),
            )
        );
        td_api_style::add( 'tds_icon_box5', array(
                'group' => 'tds_icon_box',
                'title' => 'Style 5 - Animated',
                'file' => $this->plugin_path . '/styles/tds_icon_box/tds_icon_box5.php',
                'params' => array_merge(
                    array(
                        array(
                            "param_name" => "icon_box_url",
                            "type" => "textfield",
                            "value" => '',
                            "heading" => "Icon box link",
                            "description" => "",
                            "holder" => "div",
                            "class" => "tdc-textfield-extrabig"
                        ),
                        array(
                            "param_name" => "open_in_new_window",
                            "type" => "checkbox",
                            "value" => '',
                            "heading" => "Open in new window",
                            "description" => "",
                            "holder" => "div",
                            "class" => "",
                        ),
                        array(
                            'param_name' => 'icon_box_container_height',
                            'type' => 'range-responsive',
                            'value' => '330',
                            'heading' => 'Container height',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '260',
                            'range_max' => '400',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'elements_top_slide',
                            'type' => 'range-responsive',
                            'value' => '50',
                            'heading' => 'Elements top slide',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '20',
                            'range_max' => '80',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'title_top_space',
                            'type' => 'range-responsive',
                            'value' => '0',
                            'heading' => 'Title top space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '-20',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'icon_box_meta_position',
                            'type' => 'range-responsive',
                            'value' => '40',
                            'heading' => 'Meta position',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '100',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            'param_name' => 'description_bottom_space',
                            'type' => 'range-responsive',
                            'value' => '20',
                            'heading' => 'Description bottom space',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '0',
                            'range_max' => '40',
                            'range_step' => '1',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Description color',
                            "param_name" => "icon_box_description_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Background color',
                            "param_name" => "icon_box_wrap_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover background color',
                            "param_name" => "icon_box_hover_wrap_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style",
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        )
                    ),
                    td_config_helper::get_map_block_shadow_array('shadow', 'Shadow', 0, 0, 0, 'Style'),
                    td_config_helper::get_map_block_shadow_array('shadow_hover', 'Shadow hover', 0, 0, 0, 'Style', '', 0, false),
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "horizontal_separator",
                            "value" => "",
                            "class" => "",
                            "group" => "Style",
                        )
                    ),
                    td_config_helper::get_map_block_font_array( 'f_descr', true, 'Descrption text', 'Style' )
                ),
            )
        );


        // Title over image styles
        td_api_style::add( 'tds_title_over_image1', array(
                'group' => 'tds_title_over_image',
                'title' => 'Style 1 - Default',
                'file' => $this->plugin_path . '/styles/tds_title_over_image/tds_title_over_image1.php',
                'params' => array_merge(
                    array(
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Title color',
                            "param_name" => "title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover title color',
                            "param_name" => "hover_title_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Subtitle color',
                            "param_name" => "subtitle_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => 'textfield-responsive',
                            "param_name" => 'subtitle_space',
                            "value" => '',
                            "heading" => 'Subtitle top space',
                            "class" => 'tdc-textfield-small',
                            "description" => '',
                            "placeholder" => '0',
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Background color',
                            "param_name" => "background_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Overlay color',
                            "param_name" => "overlay_color",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "gradient",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Hover overlay color',
                            "param_name" => "overlay_hover_color",
                            "value" => '',
                            "description" => '',
                        ),
                    ),
                    td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text' ),
                    td_config_helper::get_map_block_font_array( 'f_subtitle', false, 'Subtitle text' )
                ),
            )
        );
	}
}

