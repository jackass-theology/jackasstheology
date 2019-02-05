<?php

//print_r($_POST);

class td_panel_data_source {



    /**
     * Reads an individual setting - only one setting!
     * @param $read_array -
     * 'ds' => 'data source ID',
      'item_id' = > 'the category id for example', - OPTIONAL category id or author id or page id
     * 'option_id' => 'the option id ex: background'
     * @return string returns the value of the setting
     */
    static function read($read_array) {
        switch ($read_array['ds']) {

            case 'td_taxonomy':
                return td_util::get_taxonomy_option($read_array['item_id'], $read_array['option_id']);
                break;

            case 'td_cpt':
                return td_util::get_ctp_option($read_array['item_id'], $read_array['option_id']);
                break;

            case 'td_category':
                return td_util::get_category_option($read_array['item_id'], $read_array['option_id']);
                break;

            case 'td_option':
                return td_util::get_option($read_array['option_id']);//htmlspecialchars()
                break;

            case 'wp_option': //@todo - se poate sa nu mai fie folosita
                return htmlspecialchars(get_option($read_array['option_id']));
                break;



            //author metadata
            case 'td_author': //@todo - se poate sa nu fie folosita
                return get_the_author_meta($read_array['option_id'], $read_array['item_id']);
                break;


            //wordpress theme mod datasource @todo - se poate a nu mai fie folosita
            case 'wp_theme_mod':
                return htmlspecialchars(get_theme_mod($read_array['option_id']));
                break;


            //wordpress usermenu to menu spot datasource
            case 'wp_theme_menu_spot':
                $menu_spots_array = get_theme_mod('nav_menu_locations');
                //check to see if there is a menu assigned to that particular option_id (menu id)
                if (isset($menu_spots_array[$read_array['option_id']])) {
                    return $menu_spots_array[$read_array['option_id']];
                } else {
                    return '';
                }
                break;


            //translation data source
            case 'td_translate':
                //get all the translations (they are stored in the td_008 variable)
                $translations = td_options::get_array('td_translation_map_user');
                if (!empty($translations[$read_array['option_id']])) {
                    return $translations[$read_array['option_id']];//htmlspecialchars()
                } else {
                    return '';
                }
                //return td_util::get_option($read_array['option_id']);
                break;


            //read the ads parameters
            //[ds] => td_ads [option_id] => current_ad_type [item_id] => header - has to become [item_id][option_id]
            case 'td_ads':
                //get all the ad spots (they are stored in the td_008 variable)
                $ads = td_options::get_array('td_ads');
                if (!empty($ads[$read_array['item_id']]) and !empty($ads[$read_array['item_id']][$read_array['option_id']])) {
                    return htmlspecialchars($ads[$read_array['item_id']][$read_array['option_id']]);
                } else {
                    return '';
                }
                break;


            //social networks
            case 'td_social_networks':
                $social_array = td_options::get_array('td_social_networks');
                if (!empty($social_array[$read_array['option_id']])) {
                    return $social_array[$read_array['option_id']];
                } else {
                    return '';
                }
                break;

            case 'td_fonts_user_insert':
                $fonts_user_inserted = td_options::get_array('td_fonts_user_inserted');
                if(!empty($fonts_user_inserted[$read_array['option_id']])) {
                    return $fonts_user_inserted[$read_array['option_id']];
                }
                break;


            case 'td_fonts':
                $fonts_user_inserted = td_options::get_array('td_fonts');
                if(!empty($fonts_user_inserted[$read_array['item_id']][$read_array['option_id']])) {
                    return $fonts_user_inserted[$read_array['item_id']][$read_array['option_id']];
                }
                break;


            case 'td_block_styles':
                //get the hole block style array
                $td_block_styles = td_options::get_array('td_block_styles');

                if(!empty($td_block_styles) and !empty($td_block_styles[$read_array['item_id']][$read_array['option_id']])) {
                    return $td_block_styles[$read_array['item_id']][$read_array['option_id']];
                }
                break;


            case 'td_social_drag_and_drop':
                return td_options::get_array('td_social_drag_and_drop');
                break;
        }

        return '';
    }




    static function preview_patch_options() {

	    // die if request is fake
	    check_ajax_referer('td-update-panel', 'td_magic_token');


	    //if user is logged in and can switch themes
	    if (!current_user_can('switch_themes')) {
		    die;
	    }


	    foreach ($_POST as $post_data_source => $post_value) {
		    switch ($post_data_source) {
			    case 'td_option':
				    self::update_td_option($post_value);
				    break;
		    }
	    }



	    //compile user css if any
	    //td_global::$td_options['tds_user_compile_css'] = td_css_generator();
    }



//* --------------------------------------------
//* This will be used by preview '.tdc-view-page'
//* --------------------------------------------
//	static function post_preview_patch_options( $post_id ) {
//
////	    // die if request is fake
////	    check_ajax_referer('td-update-panel', 'td_magic_token');
////
////
////	    //if user is logged in and can switch themes
////	    if (!current_user_can('switch_themes')) {
////		    die;
////	    }
//
//		$td_options = &td_options::get_all_by_ref();
//
//		$tdc_preview_options = get_post_meta( $post_id, 'tdc_preview_options', true );
//
//		//var_dump( $tdc_preview_options );
//
//	    foreach($tdc_preview_options as $options_id => $option_value) {
//
//        	$td_options[$options_id] = $option_value;
//		}
//    }


    /*
     * Updates all the settings for all of the types  [setting_type][etc]
     * this called at the end of this file
     * this function updates the form - first it reads all the settings from WordPress and then it saves them after the update
     * NOTICE! $_POST is altered by WordPress and it has slashes added to "
    */
    static function update() {

	    // die if request is fake
	    check_ajax_referer('td-update-panel', 'td_magic_token');

	    //if user is logged in and can switch themes
	    if (!current_user_can('switch_themes')) {
		    die;
	    }

	    /**
	     * @since 20 sept 2016
	     *  - we look in the $_POST variable and we save if we recognize the keys. Otherwise we ignore them (keys like td_magic_token, action etc are ignored)
	     *  - we removed the aurora hook
	     */
        foreach ($_POST as $post_data_source => $post_value) {
            switch ($post_data_source) {

                case 'td_taxonomy':
                    self::update_td_taxonomy($post_value);
                    break;


                case 'td_cpt':
                    self::update_td_cpt($post_value);
                    break;

                case 'td_category':
                    self::update_category($post_value);
                    break;

                case 'td_option':
                    self::update_td_option($post_value);
                    break;

	            // wp
                case 'wp_option': //@todo - se poate sa nu mai fie folosita
                    self::update_wp_option($post_value);
                    break;

                case 'td_homepage':
                    break;
	            case 'td_default': // here we store the default values. Each datasource that needs defaults, will parse the $_POST['td_default'] directly
		            break;

	            //wp
                case 'td_author': //@todo - se poate sa nu mai fie folosita
                    self::update_td_author($post_value);
                    break;

                case 'wp_theme_mod': //@todo - se poate sa nu mai fie folosita
                    self::update_wp_theme_mod($post_value);
                    break;

                case 'wp_theme_menu_spot':
                    self::update_wp_theme_menu_spot($post_value);
                    break;

                case 'td_translate':
                    self::update_td_translate($post_value);
                    break;

                case 'td_ads':
                    self::update_td_ads($post_value);
                    break;

                //social networks
                case 'td_social_networks':
                    self::update_td_social_networks($post_value);
                    break;

                case 'td_fonts_user_insert':
                    self::update_td_fonts_user_insert($post_value);
                    break;

                case 'td_fonts':
                    self::update_td_fonts($post_value);
                    break;

                case 'td_block_styles':
                    self::update_td_block_styles($post_value);
                    break;

                case 'td_social_drag_and_drop':
                    self::update_social_drag_and_drop($post_value);
                    break;

	            case 'tdb_author_templates':
		            self::update_tdb_author_templates($post_value);
		            break;

	            case 'tdb_404_template':
		            self::update_tdb_template($post_value, '404');
		            break;

	            case 'tdb_date_template':
		            self::update_tdb_template($post_value, 'date');
		            break;

	            case 'tdb_attachment_template':
		            self::update_tdb_template($post_value, 'attachment');
		            break;

	            case 'tdb_search_template':
		            self::update_tdb_template($post_value, 'search');
		            break;

	            case 'tdb_tag_template':
		            self::update_tdb_template($post_value, 'tag');
		            break;

	            case 'tdb_author_template':
		            self::update_tdb_template($post_value, 'author');
		            break;

                default:
	                // here we had aurora hooked - removed in 20 sep 2016
                    //tdx_options::set_data_to_datasource($post_data_source, $post_value);
                    break;
            }
        }

        //compile user css if any
	    td_options::update('tds_user_compile_css', td_css_generator());
        //td_global::$td_options['tds_user_compile_css'] = td_css_generator();

        /*
         * compile mobile theme user css only if the theme is installed
         * in wp-admin the main theme is loaded and the mobile theme functions are not included
         * td_css_generator_mob() - is loaded in functions.php
         * @todo - look for a more elegant solution
         */
        if (td_util::is_mobile_theme() && function_exists('td_css_generator_mob')){
	        td_options::update('tds_user_compile_css_mob', td_css_generator_mob());
            //td_global::$td_options['tds_user_compile_css_mob'] = td_css_generator_mob();
        }

        //save all the themes settings (td_options + td_category)
	    td_options::schedule_save();
	    //update_option( TD_THEME_OPTIONS_NAME, td_global::$td_options );
    }


    /*  ----------------------------------------------------------------------------
        The functions that update the options from the form on post
     */


    /**
     * Update the social networks
     * @param $td_social_dnd_values - array of selected social networks. Notice that networks that are not selected in panel will
     *                                  not appear in this array and we use $_POST['td_social_drag_and_drop_sort'] to sort the list - not nice
     */
    private static function update_social_drag_and_drop($td_social_dnd_values) {
        $new_social_dnd_values = array();

        // if we have some kind of error and the key it's missing, do not save anything in db
        if (!isset($_POST['td_social_drag_and_drop_sort'])) {
            return;
        }

        foreach ($_POST['td_social_drag_and_drop_sort'] as $social_network) {
            if (in_array($social_network, $td_social_dnd_values)) {
                $new_social_dnd_values[$social_network] = true;
            } else {
                $new_social_dnd_values[$social_network] = false;
            }

        }

        td_util::update_option('td_social_drag_and_drop', $new_social_dnd_values);
    }

    /**
     * update the custom post types data source cpt
     * @param $td_cpt_array
     */
    private static function update_td_cpt($td_cpt_array) {
        self::update_array_data_source($td_cpt_array, 'td_cpt');
    }


    /**
     * update the taxonomy data source
     * @param $td_taxonomy_array
     */
    private static function update_td_taxonomy($td_taxonomy_array) {
        self::update_array_data_source($td_taxonomy_array, 'td_taxonomy');
    }


    /**
     * updates a data source that it's stored as an array, as of 9 july 2015 only td_cpt and td_taxonomy use this
     * @param $post_values array - straight form the panel
     * @param $ds string - the data source that you want to update
     */
    private static function update_array_data_source($post_values, $ds) {
    	/** we schedule a save in @see td_panel_data_source::update() this function is used only there */
    	$td_options = &td_options::get_all_by_ref();

        foreach ($post_values as $item_id => $options) {
            foreach ($options as $option_id => $option_value) {
                if ($option_value != '') {
	                $td_options[$ds][$item_id][$option_id] = $option_value;
                } else {
                    //delete the option from the parent
                    unset($td_options[$ds][$item_id][$option_id]);

                    //also delete the parent if there are no more options
                    if (isset($td_options[$ds][$item_id]) and count($td_options[$ds][$item_id], COUNT_RECURSIVE) == 0) {
                        unset($td_options[$ds][$item_id]);
                    }
                }
            }
        }
    }

    /**
     * updates the ads
     * @param $wp_option_array
     */
    private static function update_td_ads($wp_option_array) {

        //pass tru the array, check what type it is, extract the info about it, if google ad
        foreach($wp_option_array as $box_add => $values){
            if(!empty($values['ad_code'])) {
                $ad_code = stripcslashes($values['ad_code']);

                //check to see if it is google ad
                if(preg_match('/googlesyndication.com/', $ad_code)){
                    $wp_option_array[$box_add]['current_ad_type'] = 'google';

                    //test to see if if google ad asincron
                    if(preg_match('/data-ad-client=/', $ad_code)){
                        //$wp_option_array[$box_add]['current_ad_type'] = 'google async';

                        //*** GOOGLE ASINCRON *************

                        //get g_data_ad_client
                        $explode_ad_code = explode('data-ad-client', $ad_code);
                        preg_match('/"([a-zA-Z0-9-\s]+)"/', $explode_ad_code[1], $matches_add_client);
                        $wp_option_array[$box_add]['g_data_ad_client'] = str_replace(array('"', ' '), array(''), $matches_add_client[1]);

                        //get g_data_ad_slot
                        $explode_ad_code = explode('data-ad-slot', $ad_code);
                        preg_match('/"([a-zA-Z0-9\s]+)"/', $explode_ad_code[1], $matches_add_slot);
                        $wp_option_array[$box_add]['g_data_ad_slot'] = str_replace(array('"', ' '), array(''), $matches_add_slot[1]);

                    } else {

                        //*** GOOGLE SINCRON *************

                        //get g_data_ad_client
                        $explode_ad_code = explode('google_ad_client', $ad_code);
                        preg_match('/"([a-zA-Z0-9-\s]+)"/', $explode_ad_code[1], $matches_add_client);
                        $wp_option_array[$box_add]['g_data_ad_client'] = str_replace(array('"', ' '), array(''), $matches_add_client[1]);

                        //get g_data_ad_slot
                        $explode_ad_code = explode('google_ad_slot', $ad_code);
                        preg_match('/"([a-zA-Z0-9\s]+)"/', $explode_ad_code[1], $matches_add_slot);
                        $wp_option_array[$box_add]['g_data_ad_slot'] = str_replace(array('"', ' '), array(''), $matches_add_slot[1]);
                    }

                } else {
                    $wp_option_array[$box_add]['current_ad_type'] = 'other';
                }
            }   // end ad_code if
        }       // end for each


	    /** we schedule a save in @see td_panel_data_source::update() this function is used only there */
	    $td_options = &td_options::get_all_by_ref();
        foreach($wp_option_array as $box_add => $values){
	        $td_options['td_ads'][$box_add] = $values;
        }

    }


    /**
     * Updates the td translation map array form td_008
     * @param $wp_option_array
     */
    private static function update_td_translate($wp_option_array) {
    	td_options::update_array('td_translation_map_user', $wp_option_array);
        //td_global::$td_options['td_translation_map_user'] = $wp_option_array;
    }



    /**
     * this function updates each menu spot to a user created menu.
     * @param $wp_option_array
     * Array ( [option_id] => options_value, [option_id] => options_value )
     */
    private static function update_wp_theme_menu_spot($wp_option_array) {
        $menu_spots_array = get_theme_mod('nav_menu_locations');

        foreach ($wp_option_array as $option_id => $option_value) {
            $menu_spots_array[$option_id] = $option_value;
        }

        set_theme_mod('nav_menu_locations', $menu_spots_array);
    }



    /**
     * updates all the thememods
     * @param $wp_option_array
     * Array ( [option_id] => options_value, [option_id] => options_value )
     */
    private static function update_wp_theme_mod($wp_option_array) {
        //get defaults array
        $default_array = $_POST['td_default'];

        foreach ($wp_option_array as $option_id => $option_value) {
            //check for default values
            if(!empty($default_array['td_option'][$option_id]) and strtolower($default_array['td_option'][$option_id]) == strtolower($option_value)) {
                $option_value = '';
            }

            set_theme_mod($option_id, $option_value);
        }
    }




    /**
     * @param $wp_option_array
     * Array ( [option_id] => options_value, [option_id] => options_value )
     */
    private static function update_wp_option($wp_option_array) {
        foreach ($wp_option_array as $option_id => $option_value) {
            update_option($option_id, $option_value);
        }
    }


    /**
     * @param $td_option_array
     * Array ( [option_id] => options_value, [option_id_2] => options_value )
     * Used to clean up default values, for example if the user submitted value is 5 and the default is 5, in the database we will
     * save ''
     */
    private static function update_td_option($td_option_array) {

	    /** we schedule a save in @see td_panel_data_source::update() this function is used only there */
    	$td_options = &td_options::get_all_by_ref();

        foreach($td_option_array as $options_id => $option_value) {

        	// search for the default value, only if we have at least one default. The live panel may not have defaults in testing
        	if (isset($_POST['td_default'])) {
		        //get defaults array
		        $default_array = $_POST['td_default'];

		        //check for default values
		        if(!empty($default_array['td_option'][$options_id]) and strtolower($default_array['td_option'][$options_id]) == strtolower($option_value)) {
			        $option_value = '';
		        }
	        }

	        $td_options[$options_id] = $option_value;
        }
    }


    /**
     * @param $td_author_array
     * Array (
     * [author_id] => Array (
     *  [option_id] => options_value),
     *  [option_id_2] => options_value)
     * ),
     * [author_id_2] => Array (
     *  [option_id] => options_value),
     *  [option_id_2] => options_value)
     * )
     */
    private static function update_td_author($td_author_array) {
        foreach ($td_author_array as $author_id => $author_options) {
            foreach ($author_options as $author_option => $author_option_value) {
                update_user_meta($author_id, $author_option, $author_option_value);
            }
        }

    }


    /**
     * @param $category_array
     * Array (
     * [category_id] => Array (
     *  [option_id] => options_value),
     *  [option_id_2] => options_value)
     * ),
     * [category_id_2] => Array (
     *  [option_id] => options_value),
     *  [option_id_2] => options_value)
     * )
     */
    private static function update_category($category_array) {
        //get defaults array
        $default_array = $_POST['td_default'];

        foreach ($category_array as $category_id => $category_options) {
            foreach ($category_options as $category_option_id => $category_option_value) {
                //check for default values

                if(!empty($default_array['td_category'][$category_id][$category_option_id]) and strtolower($default_array['td_category'][$category_id][$category_option_id]) == strtolower($category_option_value)) {
                    $category_option_value = '';
                }

                self::update_category_option($category_id, $category_option_id, $category_option_value);
            }
        }


        //print_r(td_options::$td_options);
    }



    //update a category setting - it deletes the settings if there are empty
    //it is also used by the import script
    public static function update_category_option($category_id, $option_id, $new_value) {

	    /** we schedule a save in @see td_panel_data_source::update() this function is used only there */
    	$td_options = &td_options::get_all_by_ref();
	    //print_r($td_options);

        if ($new_value != '') {
	        $td_options['category_options'][$category_id][$option_id] = $new_value;

        } else {


	        /**
	         * delete the option from the parent category
	         *  @23 may 2016 - we encountered an issue with unset on a string index - td_global::$td_options['category_options'][$category_id] was string
	         *  @see td_demo_installer::import_panel_settings() - category_options is updated to ''
	         *  - we must leave the isset check for backwards compatibility
	         */
	        if (isset($td_options['category_options'][$category_id][$option_id])) {
		        unset($td_options['category_options'][$category_id][$option_id]);
	        }


            //also delete the parent if there are no more options
            if (isset($td_options['category_options'][$category_id]) and count($td_options['category_options'][$category_id], COUNT_RECURSIVE) == 0) {
                unset($td_options['category_options'][$category_id]);
            }
        }


    }


    private static function update_td_social_networks($social_networks_array) {
        $save_social_networks = array();

        foreach ($social_networks_array as $social_net_id => $social_net_link) {
            if(!empty($social_networks_array[$social_net_id])) {
                $save_social_networks[$social_net_id] = $social_net_link;
            }
        }

        td_options::update_array('td_social_networks', $save_social_networks);
        //td_global::$td_options['td_social_networks'] = $save_social_networks;
    }



    /**
     * saves custom fonts settings
     * @param $td_option_array
     */
    private static function update_td_fonts_user_insert($td_option_array) {

        /** we schedule a save in @see td_panel_data_source::update() this function is used only there */
        $td_options = &td_options::get_all_by_ref();

        //get defaults array
        $default_array = $_POST['td_fonts_user_insert'];
        /*
        $js_buffer = used for fonts who use javascript to add @font-face (typekit.com)
        $css_buffer = used for font link to files
        */
        $js_buffer = $css_buffer = '';
        $google_subset_buffer = ''; //store google subset

        foreach ($default_array as $custom_font_option_id => $custom_font_option_value) {
            //save font settings in database
            $td_options['td_fonts_user_inserted'][$custom_font_option_id] = $custom_font_option_value;

            //set fonts js buffer
            if ($custom_font_option_id == 'typekit_js') {
                $js_buffer = $custom_font_option_value;
            }

            //explode font options into identifier and id - ex. g_21 is a google font with id 21
            $explode_font_option = explode('_', $custom_font_option_id);

            //set font css buffer
            if ($explode_font_option[1] == 'family' && !empty($custom_font_option_value)) {

                $font_file_link = $td_options['td_fonts_user_inserted']['font_file_' . $explode_font_option[2]];
                $font_file_family = $td_options['td_fonts_user_inserted']['font_family_' . $explode_font_option[2]];

                $css_buffer .= '
                                    @font-face {
                                      font-family: "' . $font_file_family . '";
                                      src: local("' . $font_file_family . '"), url("' . $font_file_link . '") format("woff");
                                    }
                                ';
            }


        }




        //add the font buffers to the option string that going to the database
        td_options::update('td_fonts_css_buffer', $css_buffer);
        td_options::update('td_fonts_js_buffer', $js_buffer);

    }

    /**
     * @used to save the fonts
     */
    private static function update_td_fonts($user_custom_fonts_array) {
        //get defaults array
        $default_array = $_POST['td_default'];


        //temporary store google font families string
        $temp_css_google_files = '';

        //collect all place_name arrays in this array
        $td_fonts_save = array();

        foreach ($user_custom_fonts_array as $font_place => $font_options) {

            $td_fonts_save[$font_place] = array();
            foreach ($font_options as $font_option_id => $font_option_value) {

                //if the $font_option_value is not empty then added to the place name font array
                if(!empty($font_option_value)) {
                    $td_fonts_save[$font_place][$font_option_id] = $font_option_value;
                }
                //@deprecated - check the color font option for non empty values
                if(!empty($default_array['td_fonts'][$font_place]['color'])) {
                    $td_fonts_save[$font_place]['color'] = $default_array['td_fonts'][$font_place]['color'];
                }
            }

            //if the array for the place name is empty then remove it from the td_fonts array
            if(empty($td_fonts_save[$font_place])){
                unset($td_fonts_save[$font_place]);
            }
        }

        //check sections from db and add them to the saving array if ar not set to empty by the user
        $font_sections_from_db = td_options::get_array('td_fonts');//get the fonts from db

        foreach (td_global::$typography_settings_list as $panel_section => $font_settings_array) {
            foreach ($font_settings_array as $font_setting_id => $font_setting_name) {

                //check each item from section, and delete the empty ones
                $typo_section = array();
                if (isset($user_custom_fonts_array[$font_setting_id]) and is_array($user_custom_fonts_array[$font_setting_id])) {
                    $typo_section = array_filter($user_custom_fonts_array[$font_setting_id]);
                }

                //if the section is set but empty, don't added to the  $td_fonts_save
                if (isset($user_custom_fonts_array[$font_setting_id]) and empty($typo_section)) {
                    //do nothing
                } else {
                    //if the section exists in the database but is not in the saving array, then added to the saving array
                    if (array_key_exists($font_setting_id, $font_sections_from_db) and !empty($font_sections_from_db[$font_setting_id]) and !array_key_exists($font_setting_id, $td_fonts_save)) {
                        $td_fonts_save[$font_setting_id] = $font_sections_from_db[$font_setting_id];
                    }
                }
            }
        }



        //add the user font settings to the option string that going to the database
	    td_options::update_array('td_fonts', $td_fonts_save);

    }


    /**
     * saves the td block style colors
     * @param $td_option_array
     *
     *
     Array (
            [style_1] => Array (
                    [tds_block_background_color] => #86ad34
                    [tds_block_drop_down_background_color] =>
                    [tds_block_drop_down_text_color] =>
                    [tds_block_module_post_title_color] =>
                    [tds_block_module_post_excerpt_color] =>
                    [tds_block_module_post_author_color] =>
                    [tds_block_module_post_date_color] =>
                    [tds_block_module_post_comments_color] =>
                    [tds_block_module_post_divider_color] =>
                    [tds_block_navigation_background_color] =>
                    [tds_block_navigation_text_color] =>
            )

           [style_2] => Array (
             ................
           )

          ..........
     )
     *
     *
     */
    private static function update_td_block_styles($td_option_array) {

	    /** we schedule a save in @see td_panel_data_source::update() this function is used only there */
    	$td_options = &td_options::get_all_by_ref();

        //get defaults array
        $default_array = $_POST['td_default'];

        foreach($td_option_array as $style_id => $array_style_options) {
            foreach($array_style_options as $option_id => $option_value) {
                //check for default values
                if(!empty($default_array['td_block_styles'][$style_id][$option_id]) and strtolower($default_array['td_block_styles'][$style_id][$option_id]) == strtolower($option_value)) {
                    $option_value = '';
                }

                //add or remove options for the block styles
                if($option_value == '') {
                    unset($td_options['td_block_styles'][$style_id][$option_id]);
                } else {
	                $td_options['td_block_styles'][$style_id][$option_id] = $option_value;
                }
            }
        }
    }

	private static function update_tdb_author_templates($td_option_array) {
		$td_options = &td_options::get_all_by_ref();

		foreach ($td_option_array as $author_id => $tdb_template_id) {
			$td_options['tdb_author_templates'][$author_id] = $tdb_template_id;
		}
	}

	private static function update_tdb_template($td_option, $template_type) {
		$td_options = &td_options::get_all_by_ref();
        $td_options['tdb_' . $template_type . '_template'] = $td_option;
	}








}//end class


//save the panel classical way
//td_panel_data_source::update();


//AJAX FORM SAVING
add_action( 'wp_ajax_td_ajax_update_panel', array('td_panel_data_source', 'update') );//print_r($_POST);


// patch td_global::$td_options for td composer preview
if ( isset($_GET['td_action']) &&  $_GET['td_action'] == 'tdc_edit' && isset($_POST['tdc_action']) && $_POST['tdc_action'] === 'preview' ) {
	td_panel_data_source::preview_patch_options();
}

