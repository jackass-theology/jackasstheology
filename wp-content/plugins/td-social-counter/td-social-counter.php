<?php
/*
	Plugin Name: tagDiv Social Counter
	Plugin URI: http://tagdiv.com
	Description: Social counter for WordPress. Widget and visual composer block.
	Author: tagDiv
	Version: 4.5 | built on 12.12.2018 11:28
	Author URI: http://tagdiv.com
*/

//hash
define('TD_SOCIAL_COUNTER', 'f8ec95a11eea0df473c70c4c60491a5b');


//version check
require_once 'td_social_version_check.php';

// load the api
require_once 'td_social_api.php';



class td_social_counter_plugin {

    var $plugin_path = '';

    function __construct($load_before_theme = false, $siblings_priority_level = 0) {
        $this->plugin_path =  dirname(__FILE__);
        add_action('td_global_after', array($this, 'hook_td_global_after'));
    }

    function td_wp_booster_loaded() {
        require_once 'widget/td_block_social_counter_widget.php';
    }

    function hook_td_global_after() {
	    //check theme version
	    if (td_social_version_check::is_theme_compatible() === false) {
		    return;
	    }

        $block_id = 'td_block_social_counter';

		$td_theme_name = '';
		if (defined('TD_THEME_NAME')) {
			$td_theme_name = TD_THEME_NAME;
		}

		// Remove the 'Color presets' option on Newsmag
		$block_general_params_array = td_config::get_map_block_general_array();
		if ( $td_theme_name == 'Newsmag' ) {
			foreach ($block_general_params_array as $key => $block_general_param) {
				if ( 'color_preset' === $block_general_param['param_name']) {
					array_splice($block_general_params_array, $key, 1);
					break;
				}
			}
		}


		$block_settings = array(
            'map_in_visual_composer' => true,
            "name" => 'Social Counter',
            "base" => 'td_block_social_counter',
            "class" => 'td_block_social_counter',
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder-td_social_counter',
            'tdc_style_params' => array(
                'custom_title',
                'custom_url',
                'facebook',
                'twitter',
                'youtube',
                'googleplus',
                'instagram',
                'pinterest',
                'soundcloud',
                'rss',
                'rss_url',
                'el_class'
            ),
            "params" => array_merge(
                $block_general_params_array,
                array(
                    array(
                        "param_name" => "style",
                        "type" => "dropdown",
                        "value" => array('Default' => '', 'Style 1 - Default black' => 'style1', 'Style 2 - Default with border' => 'style2 td-social-font-icons', 'Style 3 - Default colored circle' => 'style3 td-social-colored', 'Style 4 - Default colored square' => 'style4 td-social-colored', 'Style 5 - Boxes with space' => 'style5 td-social-boxed', 'Style 6 - Full boxes' => 'style6 td-social-boxed', 'Style 7 - Black boxes' => 'style7 td-social-boxed', 'Style 8 - Boxes with border' => 'style8 td-social-boxed td-social-font-icons', 'Style 9 - Colored circles' => 'style9 td-social-boxed td-social-colored', 'Style 10 - Colored squares' => 'style10 td-social-boxed td-social-colored'),
                        "heading" => 'Style',
                        "description" => "Style of the Social Counter widget",
                        "holder" => "div",
                        "class" => "tdc-dropdown-extrabig"
                    ),
                ),
                td_config_helper::get_map_block_font_array( 'f_header', true, 'Block header'),
                array(
	                array(
	                    "param_name" => "separator",
	                    "type" => "horizontal_separator",
	                    "value" => "",
	                    "class" => ""
	                ),
	                array(
	                    "param_name" => "facebook",
	                    "type" => "textfield",
	                    "value" => "",
	                    "heading" => __("Facebook id", TD_THEME_NAME)/* . '&nbsp<a href="http://forum.tagdiv.com/tagdiv-social-counter-tutorial/" target="_blank">How to get the App Id and the Security Key</a>'*/,
	                    "description" => "",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "manual_count_facebook",
						"type" => "textfield",
						"value" => "",
						"heading" => __("Facebook fixed count", TD_THEME_NAME)/* . '&nbsp<a href="http://forum.tagdiv.com/tagdiv-social-counter-tutorial/" target="_blank">How to get the App Id and the Security Key</a>'*/,
						"description" => "Add a fixed likes count for facebook",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
//		            array(
//			            "param_name" => "facebook_app_id",
//			            "type" => "textfield",
//			            "value" => "",
//			            "heading" => __("Facebook App Id", TD_THEME_NAME),
//			            "description" => "",
//			            "holder" => "div",
//			            "class" => "tdc-textfield-big"
//		            ),
//		            array(
//			            "param_name" => "facebook_security_key",
//			            "type" => "textfield",
//			            "value" => "",
//			            "heading" => __("Facebook Security Key", TD_THEME_NAME),
//			            "description" => "",
//			            "holder" => "div",
//			            "class" => "tdc-textfield-big"
//		            ),
//		            array(
//			            "param_name" => "facebook_access_token",
//			            "type" => "textfield",
//			            "value" => "",
//			            "heading" => __("Facebook Access Token", TD_THEME_NAME) . '&nbsp;<a class="td_access_token facebook" href="#">Get Access Token</a><i class="td_access_token_info" style="display: none; color: #F00; margin-left: 10px">Please wait...</i>',
//			            "description" => "",
//			            "holder" => "div",
//			            "class" => "tdc-textfield-big"
//		            ),
	                array(
	                    "param_name" => "twitter",
	                    "type" => "textfield",
	                    "value" => "",
	                    "heading" => __("Twitter id", TD_THEME_NAME),
	                    "description" => "",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "manual_count_twitter",
						"type" => "textfield",
						"value" => "",
						"heading" => __("Twitter fixed count", TD_THEME_NAME),
						"description" => "Add a fixed followers count for twitter",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
	                array(
	                    "param_name" => "youtube",
	                    "type" => "textfield",
	                    "value" => "",
	                    "heading" => __("Youtube id", TD_THEME_NAME),
	                    "description" => "User: www.youtube.com/user/<b style='color: #000'>ENVATO</b><br/>Channel: www.youtube.com/ <b style='color: #000'>channel/UCJr72fY4cTaNZv7WPbvjaSw</b>",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "manual_count_youtube",
						"type" => "textfield",
						"value" => "",
						"heading" => __("Youtube fixed count", TD_THEME_NAME),
						"description" => "Add a fixed followers count for youtube",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
	//                array(
	//                    "param_name" => "vimeo",
	//                    "type" => "textfield",
	//                    "value" => "",
	//                    "heading" => __("Vimeo id", TD_THEME_NAME),
	//                    "description" => "",
	//                    "holder" => "div",
	//                    "class" => "tdc-textfield-big"
	//                ),
	                array(
	                    "param_name" => "googleplus",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Google Plus User", TD_THEME_NAME),
	                    "description" => "",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "manual_count_googleplus",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Google+ fixed count", TD_THEME_NAME),
						"description" => "Add a fixed followers count for google plus",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
	                array(
	                    "param_name" => "instagram",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Instagram User", TD_THEME_NAME),
	                    "description" => "",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "manual_count_instagram",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Instagram fixed count", TD_THEME_NAME),
						"description" => "Add a fixed followers count for instagram",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
					array(
						"param_name" => "pinterest",
						"type" => "textfield",
						"value" => "",
						"heading" => __("Pinterest id", TD_THEME_NAME),
						"description" => "",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
					array(
						"param_name" => "manual_count_pinterest",
						"type" => "textfield",
						"value" => "",
						"heading" => __("Pinterest fixed count", TD_THEME_NAME),
						"description" => "Add a fixed followers count for pinterest",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
	                array(
	                    "param_name" => "soundcloud",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Soundcloud User", TD_THEME_NAME),
	                    "description" => "",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "manual_count_soundcloud",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Soundcloud fixed count", TD_THEME_NAME),
						"description" => "Add a fixed followers count for soundcloud",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
	                array(
	                    "param_name" => "rss",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Feed subscriber count", TD_THEME_NAME),
	                    "description" => "Write the number of followers",
	                    "holder" => "div",
	                    "class" => "tdc-textfield-big"
	                ),
					array(
						"param_name" => "rss_url",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Feed custom url", TD_THEME_NAME),
						"description" => "Custom url if using a RSS plugin ",
						"holder" => "div",
						"class" => "tdc-textfield-big"
					),
	                array(
	                    "param_name" => "open_in_new_window",
	                    "type" => "dropdown",
	                    "value" => array('- Same window -' => '', 'New window' => 'y'),
	                    "heading" => __("Open in", TD_THEME_NAME),
	                    "description" => "",
	                    "holder" => "div",
	                    "class" => "tdc-dropdown-extrabig"
	                ),
					array(
						"param_name" => "social_rel",
						"type" => "dropdown",
						"value" => array(
							'Disable' => '',
							'Nofollow' => 'nofollow',
							'Noopener' => 'noopener',
							'Noreferrer' => 'noreferrer'
						),
						"heading" => "Set rel attribute",
						"description" => "",
						"holder" => "div",
						"class" => "tdc-dropdown-big"
					),
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
	                    'class' => 'tdc-textfield-extrabig'
	                ),
	                array(
	                    'param_name' => 'css',
	                    'value' => '',
	                    'type' => 'css_editor',
	                    'heading' => 'Css',
	                    'group' => 'Design options',
	                ),
		            array(
		                'param_name' => 'tdc_css',
		                'value' => '',
		                'type' => 'tdc_css_editor',
		                'heading' => '',
		                'group' => 'Design options',
		            ),
	            )
            )
        );

        $block_settings['file'] = $this->plugin_path . '/shortcode/td_block_social_counter.php';

        if ( $td_theme_name == 'Newsmag' ) {
            // on 010 add the border_top parameter
	        $block_settings['params'][] =
                array(
	                "param_name" => "border_top",
	                "type" => "dropdown",
	                "value" => array('- With border -' => '', 'no border' => 'no_border_top'),
	                "heading" => __("Border top:", TD_THEME_NAME),
	                "description" => "",
	                "holder" => "div",
	                "class" => ""
                );

        }


        td_api_block::add($block_id, $block_settings);

	    add_action('td_wp_booster_loaded', array($this, 'td_wp_booster_loaded'));

	    add_action('wp_ajax_vc_edit_form', 'td_vc_edit_form');
	    function td_vc_edit_form() {
		    echo '<script type="text/javascript" src="' . plugin_dir_url( __FILE__ ) . 'js/td_social_counter.js"></script>';
	    }

	    add_action('admin_enqueue_scripts', 'td_on_admin_enqueue_scripts');
	    function td_on_admin_enqueue_scripts($admin_page) {
		    wp_enqueue_script('td_social_counter', plugin_dir_url( __FILE__ ) . 'js/td_social_counter.js', array('jquery'), false, true);
	    }
    }
}

new td_social_counter_plugin();
