<?php



/**
 * td_global_blocks.php
 * Here we store the global state of the theme. All globals are here (in theory)
 *  - no td_util loaded, no access to settings
 */

class td_global {

	// Flag set by vc_row template
	private static $in_row = false;

	// Flag set by vc_row_inner template
	private static $in_inner_row = false;

	// Flag set by vc_set_custom_column_number
	private static $in_custom_area = false;


	// The column number - default 1
	private static $column_number = 1;

	// The inner column number - default 1
	private static $inner_column_number = 1;


	// The column width - default 1/1 (full width)
	private static $column_width = '1/1';

	// The inner column width - default 1/1 (full width)
	private static $inner_column_width = '1/1';


	// set from td_util::is_pagebuilder_content($post);
	private static $is_page_builder_content;

	// Is 'tdb_templates' custom post type registered by template builder
	private static $is_tdb_registered;

	//theme plugins 'PLUGIN_CONSTANT' => 'hash'
	private static $td_plugins = array(
		'TD_COMPOSER' => '9b761fb88cde3d1bd90677504fc739fc',
		'TD_CLOUD_LIBRARY' => 'de57cf6ff5b3d9be0b6e25d187d8bc1a_fix',
		'TD_SOCIAL_COUNTER' => 'f8ec95a11eea0df473c70c4c60491a5b',
		'TD_NEWSLETTER' => '232348d3a0f9212d8b06f8dfe5eb7ae4',
		'TD_AMP' => '6de043d9616e6bbcdec60bb323147830',
		'TD_MOBILE_PLUGIN' => '3cd3ee6c6716dddec704114714e5fafa'
	);


	/**
	 * Get the $td_plugins hashes array
	 * @return array
	 */
	static function get_td_plugins() {
		return self::$td_plugins;
	}

	/**
	 * Set the $in_row
	 * Used in vc_row template
	 *
	 * @param $in_row
	 */
	static function set_in_row($in_row) {
		self::$in_row = $in_row;
	}

	/**
	 * Just get the $in_row flag
	 * @return bool
	 */
	static function get_in_row() {
		return self::$in_row;
	}

	/**
	 * Set the $in_inner_row flag
	 * Used in vc_row_inner template
	 *
	 * @param $in_inner_row
	 */
	static function set_in_inner_row($in_inner_row) {
		self::$in_inner_row = $in_inner_row;
	}

	/**
	 * Just get $in_inner_row
	 * @return bool
	 */
	static function get_in_inner_row() {
		return self::$in_inner_row;
	}


	/**
	 * Set $column_width and $column_number
	 * @param $column_width
	 */
	static function set_column_width($column_width) {
		self::$column_width = $column_width;

		$columns = 1;

		switch ($column_width) {
			case '1/1':
				$columns = 3;
				break;

			case '1/3':
				$columns = 1;
				break;

			case '2/3':
				$columns = 2;
				break;
		}


		/**
		 * For 'page-title-sidebar' current template (the version of page-pagebuilder-title.php file that still has sidebar)
		 * set properly the column number
		 */

		if (td_global::$current_template === 'page-title-sidebar') {
			global $post;

			$td_page = td_util::get_post_meta_array($post->ID, 'td_page');

			//check for this page sidebar position
			if (empty($td_page['td_sidebar_position'])) {
				$sidebar_position_pos = td_util::get_option('tds_page_sidebar_pos');
			} else {
				$sidebar_position_pos = $td_page['td_sidebar_position'];
			}

			if ($sidebar_position_pos !== 'no_sidebar' && $columns > 1) {
				--$columns;
			}
		}

		self::$column_number = $columns;
	}

	/**
	 * Just get $column_width
	 * @return string
	 */
	static function get_column_width() {
		return self::$column_width;
	}

	/**
	 * Set $inner_column_width and $inner_column_number
	 * @param $inner_column_width
	 */
	static function set_inner_column_width($inner_column_width) {
		self::$inner_column_width = $inner_column_width;

		$columns = 1;

		switch (self::$inner_column_width) {

			case '1/1':

				switch (self::$column_number) {
					case 2:
					case 3:
						$columns = self::$column_number;
						break;
				}
				break;

			case '2/3':

				switch (self::$column_number) {
					case 2:
					case 3:
						$columns = 2;
						break;
				}
				break;
		}

		self::$inner_column_number = $columns;
	}

	/**
	 * Just get $inner_column_width
	 * @return string
	 */
	static function get_inner_column_width() {
		return self::$inner_column_width;
	}


	/**
	 * Just get $is_page_builder_content
	 * It doesn't make sense to have a set, so function isn't in 'get' format
	 * @return mixed
	 */
	static function is_page_builder_content() {

		if (!isset(self::$is_page_builder_content)) {
			global $post;
			self::$is_page_builder_content = td_util::is_pagebuilder_content($post);
		}
		return self::$is_page_builder_content;
	}


	/**
	 * Used only in custom area templates (there where we aren't in row. For example: footer, sidebar, etc)
	 * Set $column_number to be later used by 'vc_get_column_number' (from block render)	 *
	 * @param $column_number
	 */
	static function vc_set_custom_column_number($column_number) {
		self::$in_custom_area = true;
		self::$column_number = $column_number;
	}

	static function vc_get_column_number() {

		if (self::$in_row || self::$in_custom_area) {
			if (self::$in_inner_row) {
				return self::$inner_column_number;
			}
			return self::$column_number;

		} else {

			// For special situations like sidebar, or any place outside of row or custom area, where 1 column should be.
			return 1;
		}
	}




	/**
	 * @deprecated
	 * @var :)
	 */
    //static $td_options; //here we store all the options of the theme will be used in td_first_install.php

    static $current_template = ''; //used by page-homepage-loop, 404

    static $current_author_obj; //set by the author page template, used by widgets

    static $cur_url_page_id; //the id of the main page (if we have loop in loop, it will return the id of the page that has the uri)

    static $load_sidebar_from_template; //used by some templates for custom sidebars (setted by page-homepage-loop.php etc)

    static $load_featured_img_from_template; //used by single.php to instruct td_module_single to load the full with thumb when necessary (ex. no sidebars)

    static $cur_single_template_sidebar_pos = ''; // set in single.php - used by the gallery short code to show appropriate images

    static $cur_single_template = ''; /** @var string set here: @see  */


    static $is_woocommerce_installed = false; // at the end of this file we check if woo commerce is installed
	static $is_bbpress_installed = false; // at the end of this file we check if bbpress is installed


    /**
     * @var stdClass holds the category object
     *      - it's set on pre_get_posts hook @see td_modify_main_query_for_category_page
     *      - WARNING: it can be null on category pages that request a category ID that dosn't exists
     */
    static $current_category_obj;

    //this is used to check for if we are in loop
    //also used for quotes in blocks - check isf the module is displayed on blocks or not
    static $is_wordpress_loop = '';

    static $custom_no_posts_message = '';  /** used to set a custom post message for the template. If this is set to false, the default message will not show @see td_page_generator::no_posts */


    /**
     * @var string used to store texts for: includes/wp_booster/wp-admin/content-metaboxes/td_set_video_meta.php
     * is set in td_config @see td_wp_booster_config::td_global_after
     */
    static $td_wp_admin_text_list = array();


    static $http_or_https = 'http'; //is set below with either http or https string  @see EOF


	//@todo refactor all code to use TEMPLATEPATH instead
    static $get_template_directory = '';  // here we store the value from get_template_directory(); - it looks like the wp function does a lot of stuff each time is called

	//@todo refactor all code to use STYLESHEETPATH instead
    static $get_template_directory_uri = ''; // here we store the value from get_template_directory_uri(); - it looks like the wp function does a lot of stuff each time is called


	static $td_viewport_intervals = array(); // the tdViewport intervals are stored


    /**
     * the js files that the theme uses on the front end (file_id - filename) @see td_wp_booster_config
     * @see td_wp_booster_hooks
     * @var array
     */
    static $js_files = array ();

	// the plugins that are installable via the theme > plugins panel & tgma
    static $theme_plugins_list = array();

	// the plugins that are just for information porpuses (the plugin cannot be installed with tgma, usually because the plugin is to big so we included it in the -tf/plugins folder)
	static $theme_plugins_for_info_list = array();

	static $td_animation_stack_effects = array();




    /**
     * the js files that are used in wp-admin
     * @var array
     */
    static $js_files_for_wp_admin = array (
        'td_wp_admin' => '/includes/wp_booster/wp-admin/js/td_wp_admin.js',
        'td_wp_admin_color_picker' => '/includes/wp_booster/wp-admin/js/td_wp_admin_color_picker.js',
        'td_wp_admin_panel' => '/includes/wp_booster/wp-admin/js/td_wp_admin_panel.js',
        'td_edit_page' => '/includes/wp_booster/wp-admin/js/td_edit_page.js',

        'tdDemoFullInstaller' => '/includes/wp_booster/wp-admin/js/tdDemoFullInstaller.js',
        'td_wp_admin_demos' => '/includes/wp_booster/wp-admin/js/td_wp_admin_demos.js',
        'tdDemoProgressBar' => '/includes/wp_booster/wp-admin/js/tdDemoProgressBar.js',

        'td_page_options' => '/includes/wp_booster/wp-admin/js/td_page_options.js',
        'td_tooltip' => '/includes/wp_booster/wp-admin/js/tooltip.js',
	    'td_confirm' => '/includes/wp_booster/wp-admin/js/tdConfirm.js',
	    'td_detect' => '/includes/wp_booster/js_dev/tdDetect.js'
    );


    // scripts that load only on our panel. This scripts are not minified because ace does not support that
    static $js_files_for_td_theme_panel = array (
        'td_ace' => '/includes/wp_booster/wp-admin/external/ace/ace.js',
        'td_ace_ext_language_tools' => '/includes/wp_booster/wp-admin/external/ace/ext-language_tools.js'
    );



    /**
     * @var array the tinyMCE style formats
     */
    static $tiny_mce_style_formats = array();


    /**
     * @var array
     *
     *  'td_full_width' => array(           - id used in the drop down in tinyMCE
     *      'text' => 'Full width',         - the text that will appear in the dropdown in tinyMCE
     *      'class' => 'td-post-image-full' - the class tha this image style will add to the image
     *  )
     *
     */
    static $tiny_mce_image_style_list = array();


    /**
     * here we store the fields form td-panel -> custom css
     * @var array
     */
    static $theme_panel_custom_css_fields_list = array();


    /**
     * the big grid styles used by the theme. This styles will show up in the panel @see td_panel_categories.php and on each big grid block
     */
    static $big_grid_styles_list = array();


    /**
     * @var array here we keep all the panels from the theme panel
     */
    static $all_theme_panels_list = array();



	static $viewport_settings = array();




    static $translate_languages_list = array(
        'en' => 'English (default)',
        'af' => 'Afrikaans',
        'sq' => 'Albanian',
        'ar' => 'Arabic',
        'hy' => 'Armenian',
        'az' => 'Azerbaijani',
        'eu' => 'Basque',
        'be' => 'Belarusian',
        'bn' => 'Bengali',
        'bs' => 'Bosnian',
        'bg' => 'Bulgarian',
        'ca' => 'Catalan',
        'ceb' => 'Cebuano',
        'ny' => 'Chichewa',
        'zh' => 'Chinese (Simplified)',
        'zh-TW' => 'Chinese (Traditional)',
        'hr' => 'Croatian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'nl' => 'Dutch',
        'eo' => 'Esperanto',
        'et' => 'Estonian',
        'tl' => 'Filipino',
        'fi' => 'Finnish',
        'fr' => 'French',
        'gl' => 'Galician',
        'ka' => 'Georgian',
        'de' => 'German',
        'el' => 'Greek',
        'gu' => 'Gujarati',
        'ht' => 'Haitian Creole',
        'ha' => 'Hausa',
        'iw' => 'Hebrew',
        'hi' => 'Hindi',
        'hmn' => 'Hmong',
        'hu' => 'Hungarian',
        'is' => 'Icelandic',
        'ig' => 'Igbo',
        'id' => 'Indonesian',
        'ga' => 'Irish',
        'it' => 'Italian',
        'ja' => 'Japanese',
        'jw' => 'Javanese',
        'kn' => 'Kannada',
        'kk' => 'Kazakh',
        'km' => 'Khmer',
        'ko' => 'Korean',
        'lo' => 'Lao',
        'la' => 'Latin',
        'lv' => 'Latvian',
        'lt' => 'Lithuanian',
        'mk' => 'Macedonian',
        'mg' => 'Malagasy',
        'ms' => 'Malay',
        'ml' => 'Malayalam',
        'mt' => 'Maltese',
        'mi' => 'Maori',
        'mr' => 'Marathi',
        'mn' => 'Mongolian',
        'my' => 'Myanmar (Burmese)',
        'ne' => 'Nepali',
        'no' => 'Norwegian',
        'fa' => 'Persian',
        'pl' => 'Polish',
        'pt' => 'Portuguese',
        'pa' => 'Punjabi',
        'ro' => 'Romanian',
        'ru' => 'Russian',
        'sr' => 'Serbian',
        'st' => 'Sesotho',
        'si' => 'Sinhala',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'so' => 'Somali',
        'es' => 'Spanish',
        'su' => 'Sundanese',
        'sw' => 'Swahili',
        'sv' => 'Swedish',
        'tg' => 'Tajik',
        'ta' => 'Tamil',
        'te' => 'Telugu',
        'th' => 'Thai',
        'tr' => 'Turkish',
        'uk' => 'Ukrainian',
        'ur' => 'Urdu',
        'uz' => 'Uzbek',
        'vi' => 'Vietnamese',
        'cy' => 'Welsh',
        'yi' => 'Yiddish',
        'yo' => 'Yoruba',
        'zu' => 'Zulu'
    );



    /**
     * stack_filename => stack_name
     * @var array
     */
    public static $demo_list = array ();


    /**
     * the list of fonts used by the theme by default
     * @var array
     */
    public static $default_google_fonts_list = array();


    /**
     * @var array string here we keep the typography settings from the THEME FONTS panel.
     * this is also used by the css compiler
     */
    public static $typography_settings_list = array ();


    /**
     * @var bool
     * set true in @see td_background::wp_head_hook_background_logic if a bg img or color is set
     */
    public static $is_boxed_layout = false;




    // @todo clean this up
    private static $post = '';
    private static $primary_category = '';


    static function load_single_post($post) {

            self::$post = $post;


        /*  ----------------------------------------------------------------------------
            update the primary category Only on single posts :0
         */
        if (is_single()) {
            //read the post setting
            $td_post_theme_settings = td_util::get_post_meta_array(self::$post->ID, 'td_post_theme_settings');
            if (!empty($td_post_theme_settings['td_primary_cat'])) {
                self::$primary_category = $td_post_theme_settings['td_primary_cat'];
                return;
            }

            $categories = get_the_category(self::$post->ID);
            foreach($categories as $category) {
                if ($category->name != TD_FEATURED_CAT) { //ignore the featured category name
                    self::$primary_category = $category->cat_ID;
                    break;
                }
            }
        }
    }


    //used on single posts
    static function get_primary_category_id() {
        if (empty(self::$post->ID)) {
            return get_queried_object_id();
        }
        return self::$primary_category;
    }


    //generate unique_ids
    private static $td_unique_counter = 0;

    static function td_generate_unique_id() {
        self::$td_unique_counter++;
        return 'td_uid_' . self::$td_unique_counter . '_' . uniqid();
    }


	//current ad in panel
	static $current_ad_id = '';


	/**
	 * Detect if 'tdb_templates' custom post type is registered by template builder
	 * @return bool
	 */
    static function is_tdb_registered() {
    	if ( isset( self::$is_tdb_registered ) ) {
    		return self::$is_tdb_registered;
	    }

	    global $wp_post_types;
    	self::$is_tdb_registered = in_array( 'tdb_templates', array_keys ( $wp_post_types ) );

        return self::$is_tdb_registered;
    }


    /**
     * determines if a single template id is a tdb template
     * @param $template_id
     * @param $and_exist
     * @return bool
     */
    static function is_tdb_template($template_id, $and_exist = false ) {
    	if ( substr( $template_id, 0, 4 ) == 'tdb_' ) {

    		if ( $and_exist ) {
			    $query = new WP_Query(
                    array(
                        'p' => self::tdb_get_template_id( $template_id ),
                        'post_type' => 'tdb_templates',
                    )
                );

			    return $query->have_posts();
	        }
	        return true;
	    }
    	return false;
    }


    /**
     * extract the template id from a api_single_template ID
     * @param $template_id
     * @return int
     */
    static function tdb_get_template_id($template_id) {
        return (int) str_replace('tdb_template_', '', $template_id);
    }
}


if (is_ssl()) {
    td_global::$http_or_https = 'https';
}


require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('woocommerce/woocommerce.php')) {
    td_global::$is_woocommerce_installed = true;
}

require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('bbpress/bbpress.php')) {
	td_global::$is_bbpress_installed = true;
}

/**
 * td_global::$get_template_directory must be used instead of get_template_directory()
 * td_global::$get_template_directory_uri must be used instead of get_template_directory_uri()
 *
 * They supplies the get_template_directory() and get_template_directory_uri() if the mobile theme is not activated (actually, the mobile plugin is not activated).
 *
 * If the mobile plugin is activated, they will return the same values, but for doing this it needs to consider the td_mobile_theme class who saves these values. In this case,
 * the get_template_directory() and get_template_directory_uri() returns values corresponding to the mobile theme, and not to the main theme.
 */

$current_theme_name = get_template();

if (empty($current_theme_name) and class_exists('td_mobile_theme')) {
	td_global::$get_template_directory = td_mobile_theme::$main_dir_path;
	td_global::$get_template_directory_uri = td_mobile_theme::$main_uri_path;
} else {
	td_global::$get_template_directory = get_template_directory();
	td_global::$get_template_directory_uri = get_template_directory_uri();
}

