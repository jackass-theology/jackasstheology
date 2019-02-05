<?php
/*
Plugin Name: tagDiv Newsletter
Plugin URI: http://tagdiv.com
Description: tagDiv Newsletter plugin for WordPress, beautifully designed with over 8 styles
Author: tagDiv
Version: 1.2 | built on 12.12.2018 11:28
Author URI: http://tagdiv.com
*/


//hash
define('TD_NEWSLETTER', '232348d3a0f9212d8b06f8dfe5eb7ae4');

require_once('td_newsletter_version_check.php');

add_action('td_global_after', 'on_td_newsleter_td_global_after');
function on_td_newsleter_td_global_after() {

	//check theme version
	if (td_newsletter_version_check::is_theme_compatible() === false) {
		return;
	}

	add_action('tdc_init', 'on_tdc_init_newsletter');
	function on_tdc_init_newsletter() {
		new td_api_newsletter();
	}
}



class td_api_newsletter {
    var $plugin_url = '';
    var $plugin_path = '';

    var $group_params = array();

    static $typography_settings_list;

    function __construct() {
        $this->plugin_url = plugins_url('', __FILE__); // path used for elements like images, css, etc which are available on end user
        $this->plugin_path = dirname(__FILE__); // used for internal (server side) files

        add_action( 'tdc_loaded', array($this, 'tdn_on_load_images' ) ); // hook used to load default images
        add_action( 'tdc_loaded', array($this, 'tdn_on_register_shortcodes' ) ); // hook used to add or modify items via Api

        add_action( 'admin_enqueue_scripts', array('td_api_newsletter', 'tdn_plugin_wpadmin_css' ) ); // hook used to add custom css for wp-admin area
        add_action( 'wp_enqueue_scripts', array('td_api_newsletter', 'tdn_plugin_frontend_css' ) ); // hook used to add custom css used on frontend area
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


    static function tdn_plugin_wpadmin_css() {
        wp_enqueue_style('td-plugin-newsletter', plugins_url('', __FILE__) . '/style-admin.css', false, TD_THEME_VERSION); // backend css (admin_enqueue_scripts)
    }

    static function tdn_plugin_frontend_css() {
        wp_enqueue_style('td-plugin-newsletter', plugins_url('', __FILE__) . '/style.css', false, TD_THEME_VERSION); // frontend css (wp_enqueue_scripts)
    }


    function tdn_on_load_images() {

        $ref_path = plugin_dir_path( __FILE__ ) . 'images/';

        $image_settings = array(
            'tdn_pic_1' => 'thumb_01.png',
            'tdn_pic_2' => 'thumb_02.png',
            'tdn_pic_3' => 'thumb_03.png',
        );

        $upload_dir = wp_upload_dir();

        foreach ( $image_settings as $image_key => $image_name ) {
            $attaches = get_posts( array(
                'post_type' => 'attachment',
                'meta_key'   => 'tdn_pic',
                'meta_value' => $image_key,
            ) );

            if ( empty( $attaches ) || ! count( $attaches ) ) {
                preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $image_name, $matches );
                //var_dump($matches);

                $upload_image_path = $upload_dir['basedir'] . '/' . $image_key . '.' . $matches[1] ;

                if ( copy( $ref_path . $image_name, $upload_image_path ) ) {

                    // Check the type of file. We'll use this as the 'post_mime_type'.
                    $filetype = wp_check_filetype( basename( $upload_image_path ), null );

                    // Prepare an array of post data for the attachment.
                    $attachment = array(
                        'guid'           => $upload_dir['url'] . '/' . basename( $upload_image_path ),
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $upload_image_path ) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                        'meta_input' => array(
                            'tdn_pic' => $image_key
                        )
                    );

                    // Insert the attachment.
                    $attach_id = wp_insert_attachment( $attachment, $upload_image_path );

                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );

                    // Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload_image_path );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                }
            }
        }
    }


    static function tdn_get_image( $value ) {
        $attach_id = null;
        $attaches = get_posts( array(
            'post_type' => 'attachment',
            'meta_key'   => 'tdn_pic',
            'meta_value' => $value,
        ) );

        if ( ! empty( $attaches ) && is_array( $attaches ) && count( $attaches ) ) {
            $attach_id = $attaches[0]->ID;
        }
        return $attach_id;
    }


    function tdn_on_register_shortcodes() { //add the api code inside this function

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

        $css_tabs_params = array(
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
        );

        // Blocks list
        td_api_block::add('tdn_block_newsletter_subscribe',
            array(
                'map_in_visual_composer' => false,
                'map_in_td_composer' => true,
                "base" => "tdn_block_newsletter_subscribe",
                'name' => __('Newsletter', 'td_composer'),
                "class" => "",
                "controls" => "full",
                "category" => 'Blocks',
                'tdc_category' => 'External',
                'icon' => 'icon-pagebuilder-title',
                'file' => $this->plugin_path . '/shortcodes/tdn_block_newsletter_subscribe.php',
                'tdc_style_params' => array(
                    'title_text',
                    'description',
                    'disclaimer',
                    'embedded_form_code',
                    'input_placeholder',
                    'btn_text',
                    'tds_newsletter2-image',
                    'tds_newsletter4-image',
                    'tds_newsletter5-tdicon',
                    'tds_newsletter7-image',
                    'el_class'
                ),
                'tdc_start_values' => base64_encode(
                    json_encode(
                        array(
                            array(
                                'title_text' => 'Subscribe to our newsletter',
                                'description' => base64_encode( 'To be updated with all the latest news, offers and special announcements.' ),
                                'input_placeholder' => 'Your email address',
                                'btn_text' => 'Subscribe',

                                "tds_newsletter2-image" => self::tdn_get_image( 'tdn_pic_1' ),

                                "tds_newsletter2-image_bg_color" => "#c3ecff",
                                "tds_newsletter3-input_bar_display" => "row",

                                "tds_newsletter4-image" => self::tdn_get_image( 'tdn_pic_2' ),
                                "tds_newsletter4-image_bg_color" => "#fffbcf",
                                "tds_newsletter4-btn_bg_color" => "#f3b700",
                                "tds_newsletter4-check_accent" => "#f3b700",

                                "tds_newsletter5-tdicon" => "tdc-font-fa tdc-font-fa-envelope-o",
                                "tds_newsletter5-btn_bg_color" => "#000000",
                                "tds_newsletter5-btn_bg_color_hover" => "#4db2ec",
                                "tds_newsletter5-check_accent" => "#000000",

                                "tds_newsletter6-input_bar_display" => "row",
                                "tds_newsletter6-btn_bg_color" => "#da1414",
                                "tds_newsletter6-check_accent" => "#da1414",

                                "tds_newsletter7-image" => self::tdn_get_image( 'tdn_pic_3' ),
                                "tds_newsletter7-btn_bg_color" => "#1c69ad",
                                "tds_newsletter7-check_accent" => "#1c69ad",
                                "tds_newsletter7-f_title_font_size" => "20",
                                "tds_newsletter7-f_title_font_line_height" => "28px",

                                "tds_newsletter8-input_bar_display" => "row",
                                "tds_newsletter8-btn_bg_color" => "#00649e",
                                "tds_newsletter8-btn_bg_color_hover" => "#21709e",
                                "tds_newsletter8-check_accent" => "#00649e",
                            ),
                        )
                    )
                ),
                "params" =>
                    array_merge(
                        array(
                            array(
                                'param_name' => 'title_text',
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Title text',
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
                                'param_name' => 'disclaimer',
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Disclaimer 1',
                                'description' => '',
                                'class' => 'tdc-textfield-extrabig',
                            ),
                            array(
                                'param_name' => 'disclaimer2',
                                'type' => 'textfield',
                                'value' => '',
                                'heading' => 'Disclaimer 2',
                                'description' => '',
                                'class' => 'tdc-textfield-extrabig',
                            ),
                            array(
                                "param_name" => "embedded_form_type",
                                "type" => "dropdown",
                                "value" => array(
                                    'MailChimp '  => 'mailchimp',
//                                    'AWeber'      => 'aweber',
                                    'Mailer Lite' => 'mailerlite',
                                    'Feedburner'  => 'feedburner'
                                ),
                                "heading" => 'Newsletter Provider',
                                "description" => "Chose the Newsletter service provider that you are using.",
                                "holder" => "div",
                                "class" => "tdc-dropdown-big"
                            ),
                            array(
                                "param_name" => "embedded_form_code",
                                "type" => 'textarea_raw_html',
                                "value" => '',
                                "heading" => 'Embedded Form Code/Feedburner ID',
                                "description" => 'Paste embed code or Feedburner ID',
                                "class" => "tdc-textarea-small"
                            ),
                            array(
                                "param_name" => "input_placeholder",
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'Input placeholder',
                                "description" => "",
                                "holder" => "div",
                                "class" => "tdc-textfield-big"
                            ),
                            array(
                                "param_name" => "btn_text",
                                "type" => "textfield",
                                "value" => '',
                                "heading" => 'Button text',
                                "description" => "",
                                "holder" => "div",
                                "class" => "tdc-textfield-big"
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
                                "param_name" => "tds_newsletter",
                                "type" => "dropdown",
                                "value" => td_api_style::get_styles_for_mapping( 'tds_newsletter', false ),
                                "heading" => 'Style',
                                "description" => "",
                                "holder" => "div",
                                "class" => "tdc-dropdown-extrabig",
                                "group" => "Style",
                            ),
                        ),
                        $css_tabs_params
                    ),
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


    function tdn_on_td_wp_booster_loaded() {
        //include_once('widgets/td_block_widgets.php'); // widgets
    }




    function register_styles() {
        $general_style = array(
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Title color',
                "param_name" => "title_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Description color',
                "param_name" => "description_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Disclaimer 1 color',
                "param_name" => "disclaimer_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Disclaimer 2 color',
                "param_name" => "disclaimer2_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
        );

        $image_style = array(
            array(
                "param_name" => "image",
                "type" => "attach_image",
                "value" => '',
                "heading" => __("Image", 'td_composer'),
                "description" => "",
                "holder" => "div",
                "class" => "",
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Image background color',
                "param_name" => "image_bg_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
        );

        $input_bar_style = array(
            array(
                "param_name" => "separator",
                "type" => "text_separator",
                'heading' => 'Email input bar',
                "value" => "",
                "class" => "tdc-separator-small",
                "group" => 'Style',
            ),
            array(
                "param_name" => "input_bar_display",
                "type" => "dropdown-responsive",
                "value" => array(
                    'Columns' => '',
                    'Row' => 'row',
                ),
                "heading" => 'Email input bar display',
                "description" => "",
                "holder" => "div",
                "class" => "tdc-dropdown-big",
                "group" => 'Style',
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Input text color',
                "param_name" => "input_text_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Input placeholder color',
                "param_name" => "input_placeholder_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Input background color',
                "param_name" => "input_bg_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Input border color',
                "param_name" => "input_border_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Button text color',
                "param_name" => "btn_text_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Button background color',
                "param_name" => "btn_bg_color",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                'param_name' => 'input_bar_border_radius',
                'type' => 'textfield-responsive',
                'value' => '',
                'heading' => 'Input bar border radius',
                'description' => '',
                'placeholder' => 0,
                'class' => 'tdc-textfield-small',
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
                "heading" => 'Input active border color',
                "param_name" => "input_border_color_active",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Button hover text color',
                "param_name" => "btn_text_color_hover",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Button hover background color',
                "param_name" => "btn_bg_color_hover",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "param_name" => "separator",
                "type" => "horizontal_separator",
                "value" => "",
                "class" => "tdc-separator-small",
                "group" => "Style",
            ),
            array(
                'param_name' => 'check_size',
                'type' => 'textfield-responsive',
                'value' => '',
                'heading' => 'Checkbox size',
                'description' => '',
                'placeholder' => '18',
                'class' => 'tdc-textfield-small',
            ),
            array(
                'param_name' => 'check_space',
                'type' => 'textfield-responsive',
                'value' => '',
                'heading' => 'Checkbox bottom space',
                'description' => '',
                'placeholder' => '2',
                'class' => 'tdc-textfield-small',
            ),
            array(
                'param_name' => 'check_label_space',
                'type' => 'textfield-responsive',
                'value' => '',
                'heading' => 'Checkbox label left space',
                'description' => '',
                'placeholder' => '8',
                'class' => 'tdc-textfield-small',
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Checkbox border color',
                "param_name" => "check_border",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Checkbox active accent color',
                "param_name" => "check_accent",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => 'Checkbox label text color',
                "param_name" => "check_label",
                "value" => '',
                "description" => '',
                "group" => "style"
            ),
        );

        $fonts = array_merge(
            array(
                array(
                    "param_name" => "separator",
                    "type" => "text_separator",
                    'heading' => 'Fonts',
                    "value" => "",
                    "class" => "tdc-separator-small",
                    "group" => 'Style',
                )
            ),
            td_config_helper::get_map_block_font_array( 'f_title', true, 'Title text', 'Style' ),
            td_config_helper::get_map_block_font_array( 'f_descr', false, 'Description text', 'Style' ),
            td_config_helper::get_map_block_font_array( 'f_disclaimer', false, 'Disclaimer 1 text', 'Style' ),
            td_config_helper::get_map_block_font_array( 'f_disclaimer2', false, 'Disclaimer 2 text', 'Style' ),
            td_config_helper::get_map_block_font_array( 'f_input', false, 'Input bar text', 'Style' ),
            td_config_helper::get_map_block_font_array( 'f_btn', false, 'Button text', 'Style' ),
            td_config_helper::get_map_block_font_array( 'f_check', false, 'Checkbox label text', 'Style' )
        );


        // Newsletter styles
        td_api_style::add( 'tds_newsletter1', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 1 - Simple',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter1.php',
                'params' => array_merge(
                    $general_style,
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter2', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 2 - Simple with image',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter2.php',
                'params' => array_merge(
                    $general_style,
                    $image_style,
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter3', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 3 - Bordered',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter3.php',
                'params' => array_merge(
                    $general_style,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'all_border_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border size',
                            'description' => '',
                            'placeholder' => 1,
                            'class' => 'tdc-textfield-small',
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
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "all_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter4', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 4 - Bordered with image',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter4.php',
                'params' => array_merge(
                    $general_style,
                    $image_style,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'all_border_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border size',
                            'description' => '',
                            'placeholder' => 1,
                            'class' => 'tdc-textfield-small',
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
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "all_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter5', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 5 - Bordered with icon',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter5.php',
                'params' => array_merge(
                    $general_style,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Icon',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'tdicon',
                            'type' => 'icon',
                            'heading' => 'Icon',
                            'class' => 'tdc-textfield-small',
                            'value' => '',
                            'group' => 'Style',
                        ),
                        array(
                            'param_name' => 'icon_size',
                            'type' => 'range-responsive',
                            'value' => '42',
                            'heading' => 'Icon size',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '8',
                            'range_max' => '100',
                            'range_step' => '1',
                            "group" => "Style"
                        ),
                        array(
                            'param_name' => 'icon_padding',
                            'type' => 'range-responsive',
                            'value' => '1.6',
                            'heading' => 'Padding around icon',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'range_min' => '1',
                            'range_max' => '3',
                            'range_step' => '0.1',
                            "group" => "Style"
                        ),
                        array(
                            'param_name' => 'icon_position',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Position from top',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '-34',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon color',
                            "param_name" => "icon_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Icon background color',
                            "param_name" => "icon_bg_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            'param_name' => 'icon_bg_radius',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Icon background radius',
                            'description' => '',
                            'class' => 'tdc-textfield-small',
                            'placeholder' => '0',
                            "group" => "Style"
                        ),
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'all_border_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border size',
                            'description' => '',
                            'placeholder' => 1,
                            'class' => 'tdc-textfield-small',
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
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "all_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter6', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 6 - Bordered with top bar',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter6.php',
                'params' => array_merge(
                    $general_style,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            'param_name' => 'all_border_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Border size',
                            'description' => '',
                            'placeholder' => 1,
                            'class' => 'tdc-textfield-small',
                        ),
                        array(
                            'param_name' => 'border_top_width',
                            'type' => 'textfield-responsive',
                            'value' => '',
                            'heading' => 'Top bar size',
                            'description' => '',
                            'placeholder' => 4,
                            'class' => 'tdc-textfield-small',
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
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color',
                            "param_name" => "all_border_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Top bar color',
                            "param_name" => "border_top_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter7', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 7 - Multicolored border',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter7.php',
                'params' => array_merge(
                    $general_style,
                    $image_style,
                    array(
                        array(
                            "param_name" => "separator",
                            "type" => "text_separator",
                            'heading' => 'Border',
                            "value" => "",
                            "class" => "tdc-separator-small",
                            "group" => 'Style',
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color 1',
                            "param_name" => "border_color1",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Border color 2',
                            "param_name" => "border_color2",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    $input_bar_style,
                    $fonts
                )
            )
        );

        td_api_style::add( 'tds_newsletter8', array(
                'group' => 'tds_newsletter',
                'title' => 'Style 8 - Dark',
                'file' => $this->plugin_path . '/styles/tds_newsletter/tds_newsletter8.php',
                'params' => array_merge(
                    $general_style,
                    array(
                        array(
                            "type" => "colorpicker",
                            "holder" => "div",
                            "class" => "",
                            "heading" => 'Background color',
                            "param_name" => "bg_color",
                            "value" => '',
                            "description" => '',
                            "group" => "Style"
                        ),
                    ),
                    $input_bar_style,
                    $fonts
                )
            )
        );


    }
}

