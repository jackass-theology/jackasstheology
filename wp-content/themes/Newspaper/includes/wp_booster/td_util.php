<?php
class td_util {


    private static $authors_array_cache = ''; //cache the results from  create_array_authors

	private static $shortcodes_with_icons = null; //shortcodes with icon type params

	private static $check_installed_plugins = false;

    public static $e_keys = array('dGRfMDEx' => '', 'dGRfMDExXw==' => 2);

    //returns the $class if the variable is not empty or false
    static function if_show($variable, $class) {
        if ($variable !== false and !empty($variable)) {
            return ' ' . $class;
        } else {
            return '';
        }
    }

    //returns the class if the variable is empty or false
    static function if_not_show($variable, $class){
        if ($variable === false or empty($variable)) {
            return ' ' . $class;
        } else {
            return '';
        }
    }

	static function get_shortcodes_with_icons() {
		if ( is_null( self::$shortcodes_with_icons ) ) {
			self::$shortcodes_with_icons = array();

			if ( td_util::tdc_is_installed() ) {
				$mapped_shortcodes = tdc_mapper::get_mapped_shortcodes();
					foreach ( $mapped_shortcodes as $mapped_shortcode ) {
					if ( isset( $mapped_shortcode['params'] ) && isset( $mapped_shortcode['base'] ) ) {
						foreach ( $mapped_shortcode['params'] as $shortcode_param ) {
							if ( isset( $shortcode_param['type'] ) && 'icon' === $shortcode_param['type'] ) {
								self::$shortcodes_with_icons[$mapped_shortcode['base']] = $mapped_shortcode['params'];
								break;
							}
						}
					}
				}
			}
		}
		return self::$shortcodes_with_icons;
	}


    /**
     * gets a category option for a specific category id.
     * - We have no update method because the panel has it's own update
     *   implementation in @see td_panel_data_source::update_category
     * - the panel uses this function to read settings for specific categories
     * - it is used also in the entire theme
     * @param $category_id
     * @param $option_id
     * @return string
     */
    static function get_category_option($category_id, $option_id) {
    	$td_options = td_options::get_all();

        if (isset($td_options['category_options'][$category_id][$option_id])) {
            return $td_options['category_options'][$category_id][$option_id];
        } else {
            return '';
        }
    }



    /**
     * gets a custom post type option for a specific post type name.
     * - We have no update method because the panel has it's own update
     *   implementation in @see td_panel_data_source::update_td_cpt
     * - the panel uses this function to read settings for specific categories
     * - it is used also in the entire theme
     * @param $custom_post_type
     * @param $option_id
     * @return string
     */
    static function get_ctp_option($custom_post_type, $option_id) {
	    $td_options = td_options::get_all();

        if (isset($td_options['td_cpt'][$custom_post_type][$option_id])) {
            return $td_options['td_cpt'][$custom_post_type][$option_id];
        } else {
            return '';
        }
    }

    /**
     * gets a custom taxonomy option for a specific taxonomy.
     * - We have no update method because the panel has it's own update
     *   implementation in @see td_panel_data_source::update_td_taxonomy
     * - the panel uses this function to read settings for specific categories
     * - it is used also in the entire theme
     * @param $taxonomy_name
     * @param $option_id
     * @return string
     */
    static function get_taxonomy_option($taxonomy_name, $option_id) {
	    $td_options = td_options::get_all();

        if (isset($td_options['td_taxonomy'][$taxonomy_name][$option_id])) {
            return $td_options['td_taxonomy'][$taxonomy_name][$option_id];
        } else {
            return '';
        }
    }





    /**
     * reads an ad from our data
     * @param $ad_position_id - header / sidebar etc...
     * @return string
     */
    static function get_td_ads($ad_position_id) {
	    $td_options = td_options::get_all();

        //print_r(td_global::$td_options);
        if (isset($td_options['td_ads'][$ad_position_id])) {
            return $td_options['td_ads'];
        } else {
            return '';
        }
    }


    /**
     * Checks to see if a adspot is enabled (ex: it has ad code in it)
     * @param $ad_spot_id
     * @return bool
     */
    static function is_ad_spot_enabled($ad_spot_id) {
	    $td_options = td_options::get_all();

        if (empty($td_options['td_ads'][$ad_spot_id]['ad_code'])) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * reads a theme option from wp
     * @param $optionName
     * @param string $default_value
     * @return string|array
     */
    static function get_option($optionName, $default_value = '') {
    	return td_options::get($optionName, $default_value);
    }

    //updates a theme option @todo sa updateze globala td_util::$td_options
    static function update_option($optionName, $newValue) {
		td_options::update($optionName, $newValue);
    }




    /**
     * Used only on slide big to cut the title to make it wrap
     *
     * @param $cut_parms
     * @param $title
     * @return string
     */
    static function cut_title($cut_parms, $title) {
        //trim and get the excerpt
        $title = trim($title);
        $title = td_util::excerpt($title,$cut_parms['excerpt']);

        //get an array of chars
        $title_chars = str_split($title);
        //$title_chars = preg_split('/(?=(.{16})*$)/u', $title);

        $buffy = '';
        $current_char_on_line = 0;
        $has_to_cut = false; //when true, the string will be cut

        foreach ($title_chars as $title_char) {
            //check if we reached the limit
            if ($cut_parms['char_per_line'] == $current_char_on_line) {
                $has_to_cut = true;
                $current_char_on_line = 0;
            } else {
                $current_char_on_line++;
            }

            if ($title_char == ' ' and $has_to_cut === true) {
                //we have to cut, it's a white space so we ignore it (not added to buffy)
                $buffy .= $cut_parms['line_wrap_end'] . $cut_parms['line_wrap_start'];
                $has_to_cut = false;
            } else {
                //normal loop
                $buffy .= $title_char;
            }

        }

        //wrap the string
        return $cut_parms['line_wrap_start'] . $buffy . $cut_parms['line_wrap_end'];
    }


    /*
     * gets the blog page url (only if the blog page is configured in theme customizer)
     */
    static function get_home_url() {
        if( get_option('show_on_front') == 'page') {
            $posts_page_id = get_option( 'page_for_posts');
            return esc_url(get_permalink($posts_page_id));
        } else {
            return false;
        }
    }


    //gets the sidebar setting or default if no sidebar is selected for a specific setting id
    static function show_sidebar($template_id) {
        $tds_cur_sidebar = td_util::get_option('tds_' . $template_id . '_sidebar');
        if (!empty($tds_cur_sidebar)) {
            dynamic_sidebar($tds_cur_sidebar);
        } else {
            //show default
            if (!dynamic_sidebar(TD_THEME_NAME . ' default')) {
                ?>
                <!-- .no sidebar -->
                <?php
            }
        }
    }


    static function get_image_attachment_data($post_id, $size = 'td_180x135', $count = 1 ) {//'thumbnail'
        $objMeta = array();
        $meta = '';// (stdClass)
        $args = array(
            'numberposts' => $count,
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'nopaging' => false,
            'post_mime_type' => 'image',
            'order' => 'ASC', // change this to reverse the order
            'orderby' => 'menu_order ID', // select which type of sorting
            'post_status' => 'any'
        );

        $attachments = get_children($args);

        if ($attachments) {
            foreach ($attachments as $attachment) {
                $meta = new stdClass();
                $meta->ID = $attachment->ID;
                $meta->title = $attachment->post_title;
                $meta->caption = $attachment->post_excerpt;
                $meta->description = $attachment->post_content;
                $meta->alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

                // Image properties
                $props = wp_get_attachment_image_src( $attachment->ID, $size, false );

                $meta->properties['url'] = $props[0];
                $meta->properties['width'] = $props[1];
                $meta->properties['height'] = $props[2];

                $objMeta[] = $meta;
            }

            return ( count( $attachments ) == 1 ) ? $meta : $objMeta;
        }
    }


    //converts a sidebar name to an id that can be used by word press
    /**
     * @todo https://github.com/opradu/newspaper/issues/630
     * @todo the name has issues with multiple spaces, one after another:  "  " -> "--" wp has problems with -- in name
     * @param $sidebar_name
     * @return string
     */
    static function sidebar_name_to_id($sidebar_name) {
        $clean_name = str_replace(array(' '), '-', trim($sidebar_name));
        $clean_name = str_replace(array("'", '"'), '', trim($clean_name));
        return strtolower($clean_name);
    }


	/**
	 * used by the css compiler in /includes/app/td_css_generator.php on 010
	 * @param $hex
	 * @param $steps
	 *
	 * @return string
	 */
    static function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Format the hex color string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Get decimal values
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));

        // Adjust number of steps and keep it inside 0 to 255
        $r = max(0,min(255,$r + $steps));
        $g = max(0,min(255,$g + $steps));
        $b = max(0,min(255,$b + $steps));

        $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
        $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
        $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

        return '#'.$r_hex.$g_hex.$b_hex;
    }


	/**
	 * converts a hex to rgba. Used on 010
	 * @param $hex
	 * @param $opacity
	 *
	 * @return bool|string
	 */
    static function hex2rgba($hex, $opacity) {
        if ( $hex[0] == '#' ) {
            $hex = substr( $hex, 1 );
        }
        if ( strlen( $hex ) == 6 ) {
            list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[2] . $hex[3], $hex[4] . $hex[5] );
        } elseif ( strlen( $hex ) == 3 ) {
            list( $r, $g, $b ) = array( $hex[0] . $hex[0], $hex[1] . $hex[1], $hex[2] . $hex[2] );
        } else {
            return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return "rgba($r, $g, $b, $opacity)";
    }



	/**
	 * converts hex (html) to rga. Used on 010
	 * @param $htmlCode
	 *
	 * @return array
	 */
    static function html2rgb($htmlCode) {
        if($htmlCode[0] == '#') {
            $htmlCode = substr($htmlCode, 1);
        }

        if (strlen($htmlCode) == 3) {
            $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
        }

        $r = hexdec($htmlCode[0] . $htmlCode[1]);
        $g = hexdec($htmlCode[2] . $htmlCode[3]);
        $b = hexdec($htmlCode[4] . $htmlCode[5]);

        return array($r, $g, $b);
    }

	/**
	 * converts to rga to Hsl. Used on 010
	 * @param $r
	 * @param $g
	 * @param $b
	 *
	 * @return array
	 */
    static function rgb2Hsl( $r, $g, $b ) {
        $oldR = $r;
        $oldG = $g;
        $oldB = $b;

        $r /= 255;
        $g /= 255;
        $b /= 255;

        $max = max( $r, $g, $b );
        $min = min( $r, $g, $b );

        $h = '';
        $s = '';
        $l = ( $max + $min ) / 2;
        $d = $max - $min;

        if( $d == 0 ){
            $h = $s = 0; // achromatic
        } else {
            $s = $d / ( 1 - abs( 2 * $l - 1 ) );

            switch( $max ){
                case $r:
                    $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
                    if ($b > $g) {
                        $h += 360;
                    }
                    break;

                case $g:
                    $h = 60 * ( ( $b - $r ) / $d + 2 );
                    break;

                case $b:
                    $h = 60 * ( ( $r - $g ) / $d + 4 );
                    break;
            }
        }

        return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
    }

    /**
     * checks for rgba color values
     * @param $rgba
     *
     * @return bool
     */
    static function is_rgba ( $rgba ) {
        if ( strpos($rgba, 'rgba') !== false ) {
            return true;
        }
        return false;
    }

    /**
     * calculate the contrast of a color and return. Used by 011
     * @param $bg - string - background color (ex. #23f100)
     * @param $contrast_limit - integer - contrast limit (ex. 200)
     * @param $color_one - string - returned color (ex. #000)
     * @param $color_two - string - returned color (ex. #fff)
     * @return string - color one or two
     */
    static function readable_colour($bg, $contrast_limit, $color_one, $color_two){
        $r = hexdec(substr($bg,1,2));
        $g = hexdec(substr($bg,3,2));
        $b = hexdec(substr($bg,5,2));

        $contrast = sqrt(
            $r * $r * .241 +
            $g * $g * .691 +
            $b * $b * .068
        );

        if($contrast > $contrast_limit){
            return $color_one;
        }else{
            return $color_two;
        }
    }




    /**
     * create $td_authors array in format id_author => display_name_author
     * @return array id_author => display_name_author
     */
    static function create_array_authors() {

        if (is_admin()) {

            //return the cache if available
            if (self::$authors_array_cache != '') {
                return self::$authors_array_cache;
            }

            $td_authors = array();
            $td_return_obj_authors = get_users('role=Administrator');

            $td_authors[' - No author filter - '] = '';
            foreach($td_return_obj_authors as $obj_autor){
                $auth_id = $obj_autor->ID;
                $auth_name = $obj_autor->display_name;

                $td_authors[$auth_name] = $auth_id;
            }

            self::$authors_array_cache = $td_authors;

            //print_r($td_authors);
            return $td_authors;
        }
    }




    /**
     * returns a string containing the numbers of words or chars for the content
     *
     * @param $post_content - the content thats need to be cut
     * @param $limit        - limit to cut
     * @param string $show_shortcodes - if shortcodes
     * @return string
     */
    static function excerpt($post_content, $limit, $show_shortcodes = '') {
        //REMOVE shortscodes and tags
        if ($show_shortcodes == '') {
	        // strip_shortcodes(); this remove all shortcodes and we don't use it, is nor ok to remove all shortcodes like dropcaps
	        // this remove the caption from images
	        $post_content = preg_replace("/\[caption(.*)\[\/caption\]/i", '', $post_content);
            // this remove any script from raw html
            $post_content = preg_replace("/\[vc_raw_html\](.*)\[\/vc_raw_html\]/i",'',$post_content);
            // this remove the shortcodes but leave the text from shortcodes
            $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
        }

        $post_content = stripslashes(wp_filter_nohtml_kses($post_content));

        /*only for problems when you need to remove links from content; not 100% bullet prof
        $post_content = htmlentities($post_content, null, 'utf-8');
        $post_content = str_replace("&nbsp;", "", $post_content);
        $post_content = html_entity_decode($post_content, null, 'utf-8');

        //$post_content = preg_replace('(((ht|f)tp(s?)\://){1}\S+)','',$post_content);//Radu A
        $pattern = "/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i";//radu o
        $post_content = preg_replace($pattern,'',$post_content);*/

	    // remove the youtube link from excerpt
	    //$post_content = preg_replace('~(?:http|https|)(?::\/\/|)(?:www.|)(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/ytscreeningroom\?v=|\/feeds\/api\/videos\/|\/user\S*[^\w\-\s]|\S*[^\w\-\s]))([\w\-]{11})[a-z0-9;:@?&%=+\/\$_.-]*~i', '', $post_content);

        //excerpt for letters
        if (td_util::get_option('tds_excerpts_type') == 'letters') {

            $post_content = strip_tags( $post_content );

            $ret_excerpt = mb_substr($post_content, 0, $limit);
            if (mb_strlen($post_content)>=$limit) {
                $ret_excerpt = $ret_excerpt.'...';
            }

            //excerpt for words
        } else {
            /*removed and moved to check this first thing when reaches thsi function
             * if ($show_shortcodes == '') {
                $post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
            }

            $post_content = stripslashes(wp_filter_nohtml_kses($post_content));*/

            $excerpt = explode(' ', $post_content, $limit);




            if (count($excerpt)>=$limit) {
                array_pop($excerpt);
                $excerpt = implode(" ",$excerpt).'...';
            } else {
                $excerpt = implode(" ",$excerpt);
            }


            $excerpt = esc_attr(strip_tags($excerpt));



            if (trim($excerpt) == '...') {
                return '';
            }

            $ret_excerpt = $excerpt;
        }
        return $ret_excerpt;
    }


    /**
     * generates a category tree, only on /wp_admin/, uses a buffer
     * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
     * @return array
     */
    private static $td_category2id_array_walker_buffer = array();
    static function get_category2id_array($add_all_category = true) {

        if (is_admin() === false) {
            return array();
        }

        if (empty(self::$td_category2id_array_walker_buffer)) {
            $categories = get_categories(array(
                'hide_empty' => 0,
                'number' => 1500
            ));

            $td_category2id_array_walker = new td_category2id_array_walker;
            $td_category2id_array_walker->walk($categories, 4);
            self::$td_category2id_array_walker_buffer = $td_category2id_array_walker->td_array_buffer;
        }


        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                self::$td_category2id_array_walker_buffer
            );
        } else {
            return self::$td_category2id_array_walker_buffer;
        }
    }


	/**
	 * Get the block template ids
	 * @return array
	 */
	static function get_block_template_ids() {

		if (is_admin() === false) {
            return array();
        }

		$block_template_ids = array();

		foreach (td_api_block_template::get_all() as $block_template_id => $block_template_settings) {
            if (isset($block_template_settings['text'])) {
                $block_template_ids[$block_template_settings['text']] = $block_template_id;
            }
		}

		return array_merge( array( '- Global Header -' => ''), $block_template_ids );
	}


	/**
	 * safe way to call the tdc_state::is_live_editor_iframe() function
     * DO NOT USE THIS IN PLUGINS that are not hooked on wp_booster_loaded with a priority of 10002 or grater!
     * In other plugins we cannot accurately determine if the composer was loaded or not! Maybe the plugin loads before the composer.
	 * @return bool  Note that ajax requests do not toggle this to true
	 */
	static function tdc_is_live_editor_iframe() {
		if (class_exists('tdc_state', false) === true && method_exists('tdc_state', 'is_live_editor_iframe') === true) {
			return tdc_state::is_live_editor_iframe();
		}
		return false;
	}


	/**
     * DO NOT USE THIS IN PLUGINS that are not hooked on wp_booster_loaded with a priority of 10002 or grater!
     * In other plugins we cannot accurately determine if the composer was loaded or not! Maybe the plugin loads before the composer.
	 * @return bool returns true only when the pagebuilder makes an ajax request
	 */
	static function tdc_is_live_editor_ajax() {
		if (class_exists('tdc_state', false) === true && method_exists('tdc_state', 'is_live_editor_ajax') === true) {
			return tdc_state::is_live_editor_ajax();
		}
		return false;
	}


	/**
     * DO NOT USE THIS IN PLUGINS that are not hooked on wp_booster_loaded with a priority of 10002 or grater!
     * In other plugins we cannot accurately determine if the composer was loaded or not! Maybe the plugin loads before the composer.
	 * @return bool returns true if the TagDiv Composer is installed
	 */
	static function tdc_is_installed() {
		if (class_exists('tdc_state', false) === true ) {
			return true;
		}
		return false;
	}



	/**
	 * Checks if VC is installed
	 * @return bool true if visual composer is installed
	 */
	static function is_vc_installed() {
		if (defined('WPB_VC_VERSION')) {
			return true;
		}

		return false;
	}


	static function is_amp_plugin_installed() {
	    if (defined('TD_AMP__VERSION')) {
	        return true;
        }

        return false;
    }

	static function is_amp() {

	    if (self::is_amp_plugin_installed()) {
	        if (function_exists('is_amp_endpoint')) {
                return is_amp_endpoint();
            }
        }

        return false;
    }


	/**
	 * Checks a page content and tries to determin if a page was build with a pagebuilder (tdc or vc)
	 * @param $post WP_Post
	 * @return bool
	 */
	static function is_pagebuilder_content($post) {

		if ( td_util::tdc_is_live_editor_iframe() ) {
			return true;
		}

		if (empty($post->post_content)) {
			return false;
		}

		/**
		 * detect the page builder
         * check for the vc_row, evey pagebuilder page must have vc_row in it
		 */
		$matches = array();
		$preg_match_ret = preg_match('/\[.*vc_row.*\]/s', $post->post_content, $matches);
		if ($preg_match_ret !== 0 && $preg_match_ret !== false ) {
			return true;
		}

		return false;
	}



    /**
     * safe way to call visual composers function vc_is_inline (if we are in the live editor)
     * @deprecated 12/04/2016 by ra
     * @return bool|null
     */
    static function vc_is_inline() {
        if (function_exists('vc_is_inline')) {
            return vc_is_inline();
        } else {
            return false;
        }
    }





    /**
     * receives a VC_MAP array and it removes param_name's from it
     * @param $vc_map_array array contains a VC_MAP array - must have a ex: $vc_map_array[0]['param_name']
     * @param $param_names array of param_name's that we will cut from the VC_MAP array
     * @return array the cut VC_MAP array
     */
    static function vc_array_remove_params($vc_map_array, $param_names) {
        foreach ($vc_map_array as $vc_map_index => $vc_map) {
            if (in_array($vc_map['param_name'], $param_names)) {
	            unset($vc_map_array[$vc_map_index]);
            }
        }
	    // the array_merge is used to remove unset int keys and reindex the array for int keys, preserving string keys - Visual Composer needs this
        return array_merge($vc_map_array);
    }



    static function get_featured_image_src($post_id, $thumb_type) {
        $attachment_id = get_post_thumbnail_id($post_id);
        $td_temp_image_url = wp_get_attachment_image_src($attachment_id, $thumb_type);

        if (!empty($td_temp_image_url[0])) {
            return $td_temp_image_url[0];
        } else {
            return '';
        }
    }


    /**
     * get information about an attachment
     * @param $attachment_id
     * @param string $thumbType
     * @return array
     */
    static function attachment_get_full_info($attachment_id, $thumbType = 'full') {
        $attachment = get_post( $attachment_id );

        // make sure that we get a post
        if (is_null($attachment)) {
            return array (
                'alt' => '',
                'caption' => '',
                'description' => '',
                'href' => '',
                'src' => '',
                'title' => '',
                'width' => '',
                'height' => ''
            );
        }

        $image_src_array = self::attachment_get_src($attachment_id, $thumbType);

        //print_r($attachment);

        return array (
            'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => esc_url(get_permalink($attachment->ID)),
            'src' => $image_src_array['src'],
            'title' => $attachment->post_title,
            'width' => $image_src_array['width'],
            'height' => $image_src_array['height']
        );
    }


    /**
     * Safe way to get an attachment image src + width and height. It always returns the array
     * @param $attachment_id
     * @param string $thumbType
     * @return mixed
     */
    static function attachment_get_src($attachment_id, $thumbType = 'full') {
        $image_src_array = wp_get_attachment_image_src($attachment_id, $thumbType);
        $buffy = array();

        //init the variable returned from wp_get_attachment_image_src
        if (empty($image_src_array[0])) {
            $buffy['src'] = '';
        } else {
            $buffy['src'] = $image_src_array[0];
        }

        if (empty($image_src_array[1])) {
            $buffy['width'] = '';
        } else {
            $buffy['width'] = $image_src_array[1];
        }


        if (empty($image_src_array[2])) {
            $buffy['height'] = '';
        } else {
            $buffy['height'] = $image_src_array[2];
        }

        return $buffy;
    }


    static function strpos_array($haystack_string, $needle_array, $offset=0) {
        foreach($needle_array as $query) {
            if(strpos($haystack_string, $query, $offset) !== false) {
                return true; // stop on first true result
            }
        }
        return false;
    }





    /**
     * register the thumbs with WordPress only when the thumbs are enabled form the panel
     * @param $id
     * @param $x
     * @param $y
     * @param $crop
     */
    static function add_image_size_if_enabled($id, $x, $y, $crop) {
        if (td_util::get_option('tds_thumb_' . $id) != '') {
            add_image_size($id, $x, $y, $crop);
        }
    }






    /**
     * Shows a soft error. The site will run as usual if possible. If the user is logged in and has 'switch_themes'
     * privileges this will also output the caller file path
     * @param $file - The file should be __FILE__
     * @param $message
     */
    static function error($file, $message, $more_data = '') {
	    ob_start();


	    echo '<strong class="td-wp-booster-title">wp_booster error:</strong><br>';
        echo $message;

        echo '<br>' . $file;
        if (!empty($more_data)) {
            echo '<br><br><pre>';
            echo 'more data:' . PHP_EOL;
            print_r($more_data);
            echo '</pre>';
        }

	    $buffer = ob_get_clean();

        if (is_user_logged_in() and current_user_can('switch_themes')){




	        $error_uuid = td_global::td_generate_unique_id();
            ?>
                <style>

                    .td-wp-booster-title {
                        color: #ee5734;
                    }
                    .td-wp-booster-error {
                        background-color: #e4e4e4;
                        font-size:12px;
                        padding: 10px;
                    }
                    .td-wp-booster-error a {
                        background-color:#ee5734;
                        color:white;
                        font-size:12px;
                        padding: 5px 10px;
                        margin-top: 5px;
                        margin-bottom: 5px;
                        display: inline-block;
                    }
                    .td-wp-booster-error pre {
                        display:none;
                        font-size:12px;
                        line-height: 13px;
                    }
                    .td-wp-booster-error-show {
                        display: block !important;
                    }
                </style>


                <div class="td-wp-booster-error">



                    <?php echo $buffer; ?>

                    <div>
                        <a href="#" id="<?php echo $error_uuid . '_oc' ?>">Display backtrace</a>
                    </div>


                    <pre id="<?php echo $error_uuid . '_pre' ?>">
<?php print_r(@debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 7)); ?>
                    </pre>


                    <script>

                        (function () {
                            function hasClass(element, cls) {
                                return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
                            }


                            document.getElementById("<?php echo $error_uuid . '_oc' ?>").addEventListener("click", function() {
                                var preId = "<?php echo $error_uuid . '_pre' ?>";
                                if (hasClass(document.getElementById(preId), "td-wp-booster-error-show")) {
                                    document.getElementById(preId).className = "";
                                } else {
                                    document.getElementById(preId).className = "td-wp-booster-error-show";
                                }


                            }, false);
                        })();


                    </script>

                </div>
            <?php


        } else {
	        echo '
		    <!--
		        Error: ' . $buffer . ' (rara-error)
		    -->
		    ';
        }
    }


	static function set_check_installed_plugins() {
		self::$check_installed_plugins = true;
	}

	static function get_check_installed_plugins() {
		return self::$check_installed_plugins;
	}


    static function get_block_error($block_name, $message) {
        if (is_user_logged_in()){
            return '<div class="td-block-missing-settings"><span>' . $block_name . '</span>' . $message . '</div>';
        };

        return '';
    }


    static function get_block_lock() {
        if (td_api_features::is_enabled('has_premium_version') && TD_DEPLOY_IS_PREMIUM === false) {
            return '<div class="td-block-lock"><div class="td-lock-wrap"><span>Available only in the Premium version.</span><a class="td-lock-button" href="https://www.wpion.com/pricing/?utm_source=front_lock&utm_medium=wp_admin&utm_campaign=ionMag_free" target="_blank">UNLOCK NOW</a></div></div>';
        }

        return '';
    }


    static function get_template_lock() {
        if (td_api_features::is_enabled('has_premium_version') && TD_DEPLOY_IS_PREMIUM === false) {
            return '<div class="td-template-lock"><div class="td-lock-wrap"><span>Available only in the Premium version.</span><a class="td-lock-button" href="https://www.wpion.com/pricing/?utm_source=front_lock&utm_medium=wp_admin&utm_campaign=ionMag_free" target="_blank">UNLOCK NOW</a></div></div>';
        }

        return '';
    }


    static function get_free_tracking($utm_source = '') {
        if (td_api_features::is_enabled('has_premium_version') && TD_DEPLOY_IS_PREMIUM === false) {
            return "?utm_source={$utm_source}&utm_medium=wp_admin&utm_campaign=ionMag_free";
        }

        return '';
    }

    /**
     * makes sure that we return something even if the $_POST of that value is not defined
     * @param $post_variable
     * @return string
     */
    static function get_http_post_val($post_variable) {
        if (isset($_POST[$post_variable])) {
            return $_POST[$post_variable];
        } else {
            return '';
        }
    }


	/**
	 * replace script tag from the parameter $buffer   keywords: js javascript ob_start ob_get
	 * @param $buffer string
	 *
	 * @return string
	 */
	static function remove_script_tag($buffer) {
		return str_replace(array("<script>", "</script>", "<script type='text/javascript'>"), '', $buffer);
	}



    static function tooltip($content, $position = 'top') {
        echo '<a href="#" class="td-tooltip" data-position="' . $position . '" title="' . $content . '">?</a>';
    }

    static function tooltip_html($content, $position = 'top') {
        echo '<a href="#" class="td-tooltip" data-position="' . $position . '" data-content-as-html="true" title="' . esc_attr($content) . '">?</a>';
    }


	/**
	 * Checks if a demo is loaded. If one is loaded the function returns the demo NAME/ID. If no demo is loaded we get FALSE
	 * @see td_demo_state::update_state
	 * @return bool|string - false if no demo is loaded OR string - the demo id
	 */
	static function get_loaded_demo_id() {
		$demo_state = get_option(TD_THEME_NAME . '_demo_state');  // get the current loaded demo... from wp cache
		if (!empty($demo_state['demo_id'])) {
			return $demo_state['demo_id'];
		}

		return false;
	}

	/**
	 * Helper function used to check if the mobile theme is active.
	 * Important! On ajax requests from mobile theme, please consider that the main theme is only known in wp-admin. That's why for this case
	 * we check only for the 'td_mobile_theme' class existence.
	 *
	 * @return bool
	 */
	static function is_mobile_theme() {

		/**
		 * We can't use : global $wp_customize // The instance of WP_Customize_Manager
		 * because it's not initialized @see add_action( 'plugins_loaded', '_wp_customize_include' );
		 */

		if (defined('DOING_AJAX') && DOING_AJAX) {
			if (class_exists('td_mobile_theme', false)) {
				return true;
			}
		} else {
			$current_theme_name = get_template();

			if (empty($current_theme_name) and class_exists('td_mobile_theme', false)) {
				return true;
			}
		}
		return false;
	}


    /**
     * Returns the srcset and sizes parameters or an empty string
     * @param $thumb_id - thumbnail id
     * @param $thumb_type - thumbnail name/type (ex. td_356x220)
     * @param $thumb_width - thumbnail width
     * @param $thumb_url - thumbnail url
     * @return string
     */
	static function get_srcset_sizes($thumb_id, $thumb_type, $thumb_width, $thumb_url) {
        $return_buffer = '';
        //backwards compatibility - check if wp_get_attachment_image_srcset is defined, it was introduced only in WP 4.4
        if (function_exists('wp_get_attachment_image_srcset')) {
            //retina srcset and sizes
            if (td_util::get_option('tds_thumb_' . $thumb_type . '_retina') == 'yes' && !empty($thumb_width)) {
                $thumb_w = ' ' . $thumb_width . 'w';
                $retina_thumb_width = $thumb_width * 2;
                $retina_thumb_w = ' ' . $retina_thumb_width . 'w';
                //retrieve retina thumb url
                $retina_url =  wp_get_attachment_image_src($thumb_id, $thumb_type . '_retina');
                //srcset and sizes
                if ($retina_url !== false) {
                    $return_buffer .= ' srcset="' . esc_url( $thumb_url ) . $thumb_w . ', ' . esc_url( $retina_url[0] ) . $retina_thumb_w . '" sizes="(-webkit-min-device-pixel-ratio: 2) ' . $retina_thumb_width . 'px, (min-resolution: 192dpi) ' . $retina_thumb_width . 'px, ' . $thumb_width . 'px"';
                }

            //responsive srcset and sizes
            } else {
                $thumb_srcset = wp_get_attachment_image_srcset($thumb_id, $thumb_type);
                $thumb_sizes = wp_get_attachment_image_sizes($thumb_id, $thumb_type);
                if ($thumb_srcset !== false && $thumb_sizes !== false) {
                    $return_buffer .=  ' srcset="' . $thumb_srcset . '" sizes="' . $thumb_sizes . '"';
                }
            }
        }

        return $return_buffer;
    }

    /**
     * get the censored key (for display in theme System Status section)
     * @return mixed|string
     */
    static function get_registration() {
        $buffy = '<strong style="color: red;">Your theme is not registered!</strong><a class="td-button-system-status td-theme-activation" href="' . wp_nonce_url(admin_url('admin.php?page=td_cake_panel')) . '">Activate now</a>';
        $ks = array_keys(self::$e_keys);

        if ( self::get_option(td_handle::get_var($ks[1])) == 2 ) {
            $ek = self::get_option(td_handle::get_var($ks[0]));
            //censure key display (for safety)
            if (!empty($ek)) {
                $ek = td_handle::get_var($ek);
                $censored_area = substr($ek, 8, strlen($ek) - 20);
                $replacement = ' - **** - **** - **** - ';
                $buffy = str_replace($censored_area, $replacement, $ek);
                //add key reset button
                $buffy .= ' <a class="td-button-system-status td-action-alert td-reset-key" href="admin.php?page=td_system_status&reset_registration=1" data-action="reset the theme registration key">Reset key</a>';
            }
        }

        return $buffy;
    }



    /**
     * get theme version and update button (if an update is available)
     * @return string
     */
    static function get_theme_version() {
        $td_theme_version = TD_THEME_VERSION;

        //disable update on deploy
        if ($td_theme_version != '__td_deploy_version__' && td_api_features::is_enabled('check_for_updates')) {
            $td_latest_version = td_util::get_option('td_latest_version');
            $td_update_url = td_util::get_option('td_update_url');
            if (!empty($td_latest_version) && !empty($td_update_url)) {
                //compare theme's current version with latest version
                $compare_versions = version_compare($td_theme_version, $td_latest_version, '<');
                if ($compare_versions === true) {
                    $td_theme_version .= ' - <span class="td-theme-update-log">Version ' . $td_latest_version . ' is available</span><a target="_blank" class="td-button-system-status td-theme-update" href="' . $td_update_url . '">Update now</a>';
                }
            }
        }

        return $td_theme_version;
    }



    /**
     * @param $index
     * @param $value
     */
    private static function ajax_update($index, $value) {
        if (empty($index) || empty($value)) {
            return;
        }
        if (!defined( 'DOING_AJAX' ) || !DOING_AJAX) {
            return;
        }
        if (is_admin()) {
            self::update_option($index, $value);
        }
    }



    /**
     * return post meta array
     * if post meta doesn't contain an array return an empty array
     * @param $post_id
     * @param $key
     * @return array|mixed
     */
    static function get_post_meta_array($post_id, $key) {
        $post_meta = get_post_meta($post_id, $key, true);
        if (!is_array($post_meta)) {
            return array();
        }
        return $post_meta;
    }



    /**
     * @param $value_
     */
    static function ajax_handle($value_ = '') {
        if (is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX) {
            $count = 0;
            foreach (self::$e_keys as $index => $value) {
                if ($value_ == '') {
                    $value = '';
                } elseif (empty($value)) {
                    $value = $value_;
                }
                if ($count == 0) {
                    $value = td_handle::set_var($value);
                }
                self::ajax_update(td_handle::get_var($index), $value);
                $count++;
            }
        }
    }


    /**
     * @param $index
     * @param $value
     */
    static function update_option_($index, $value) {
        if (empty($index)) {
            return;
        }
        $ks = array_keys(self::$e_keys);
        $k = td_handle::get_var($ks[1]);

        if ($index == 'td_cake_status') {
            return self::update_option($k, $value);
        }
        if ($index == 'td_cake_status_time') {
            return self::update_option($k . 'tp', $value);
        }
        if ($index == 'td_cake_lp_status') {
            return self::update_option($k . 'ta', $value);
        }
    }


    /**
     * @param $index
     * @return array|string|void
     */
    static function get_option_($index) {
        if (empty($index)) {
            return;
        }
        $ks = array_keys(self::$e_keys);
        $k = td_handle::get_var($ks[1]);

        if ($index == 'td_cake_status') {
            return self::get_option($k);
        }
        if ($index == 'td_cake_status_time') {
            return self::get_option($k . 'tp');
        }
        if ($index == 'td_cake_lp_status') {
            return self::get_option($k . 'ta');
        }
    }

    static function reset_registration() {
        $ks = array_keys(self::$e_keys);
        $k = td_handle::get_var($ks[1]);
        self::update_option($k . 'tp', 0);
        self::update_option($k, 0);
        self::update_option($k . 'ta', '');
        self::update_option(td_handle::get_var($ks[0]), '');
    }


	static function get_font_family_list( $flip = true ) {
		$list = array(
			'' => 'Default font',
		);

		$td_options = td_options::get_all();

        //read the user fonts array
        if(!empty($td_options['td_fonts_user_inserted'])) {

            $user_fonts = $td_options['td_fonts_user_inserted'];


            //custom font links & typekit
            foreach($user_fonts as $key_font => $value_font){

                //look for the field number
                $revers_key_font = strrev($key_font);
                $explode_key_font = explode('_', $revers_key_font);
                $fld_number = intval($explode_key_font[0]);

                //add custom user fonts links    (numaratoare incepe de la 1)
                if(substr($key_font, 0, 10) == 'font_file_') {
                    $font_family_field_nr = 'font_family_' . $fld_number;

                    if(!empty($user_fonts['font_file_' . $fld_number]) and !empty($user_fonts[$font_family_field_nr])) {
                        $list[ 'file_' . $fld_number ] = $user_fonts[$font_family_field_nr];
                    }

                    //add tipekit fonts                  (numaratoare incepe de la 1)
                } elseif(substr($key_font, 0, 21) == 'type_kit_font_family_') {
                    $type_kit_font_family_field_nr = 'type_kit_font_family_' . $fld_number;

                    if(!empty($user_fonts[$type_kit_font_family_field_nr])) {
                        $list[ 'tk_' . $fld_number ] = $user_fonts[$type_kit_font_family_field_nr];
                    }
                }

            }
        }

		foreach ( td_fonts::$font_stack_list as $font_id => $font_name ) {
			$list[$font_id] = $font_name;
		}
		foreach ( td_fonts::$font_names_google_list as $font_id => $font_name ) {
			$list[$font_id] = $font_name;
		}
		if ( $flip ) {
			$list = array_flip( $list );
		}
		return $list;
	}

	static function get_font_style_list( $flip = true ) {
		$list = array();

		$list[''] = 'Def font style';
		$list['italic'] = 'Italic';
		$list['oblique'] = 'Oblique';
		$list['normal'] = 'Normal (Remove italic)';

		if ( $flip ) {
			$list = array_flip( $list );
		}
		return $list;
	}

	static function get_font_weight_list( $flip = true ) {
		$list = array();

		$list[''] = 'Def font weight';
		$list['100'] = '100 - Thin (Hairline)';
		$list['200'] = '200 - Extra light (Ultra light)';
		$list['300'] = '300 - Light';
		$list['400'] = '400 - Normal';
		$list['500'] = '500 - Medium';
		$list['600'] = '600 - Semi Bold (Demi bold)';
		$list['700'] = '700 - Bold';
		$list['800'] = '800 - Extra Bold (Ultra bold)';
		$list['900'] = '900 - Black (Heavy)';

		if ( $flip ) {
			$list = array_flip( $list );
		}
		return $list;
	}

	static function get_font_transform_list( $flip = true ) {
		$list = array();

		$list[''] = 'Def text transform';
		$list['uppercase'] = 'Uppercase';
		$list['capitalize'] = 'Capitalize';
		$list['lowercase'] = 'Lowercase';
		$list['none'] = 'None (normal text)';

		if ( $flip ) {
			$list = array_flip( $list );
		}
		return $list;
	}





	static function parse_footer_texts($in_text) {
        $replace_array = array (
            '##copy##' => '&copy;',
            '##privacy_policy##' => get_the_privacy_policy_link(),
            '##year##' => date('Y'),
            '##sitename##' => get_bloginfo('name'),
            '##siteurl##' => get_home_url(),
            '##sitelink##' => '<a href="' . get_home_url() . '">' . get_bloginfo('name') . '</a>'
        );

        foreach ($replace_array as $search_for => $replace_with) {
            $in_text = str_replace($search_for, $replace_with, $in_text);
        }

        return $in_text;
    }


}//end class td_util



class td_category2id_array_walker extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $td_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->td_array_buffer[str_repeat(' - ', $depth) .  $category->name . ' - [ id: ' . $category->term_id . ' ]' ] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}


/*  ----------------------------------------------------------------------------
    mbstring support - if missing from host
 */
if (!function_exists('mb_strlen')) {
    function mb_strlen ($string, $encoding = '') {
        return strlen($string);
    }
}
if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack,$needle,$offset=0) {
        return strpos($haystack,$needle,$offset);
    }
}
if (!function_exists('mb_strrpos')) {
    function mb_strrpos ($haystack,$needle,$offset=0) {
        return strrpos($haystack,$needle,$offset);
    }
}
if (!function_exists('mb_strtolower')) {
    function mb_strtolower($string) {
        return strtolower($string);
    }
}
if (!function_exists('mb_strtoupper')) {
    function mb_strtoupper($string){
        return strtoupper($string);
    }
}
if (!function_exists('mb_substr')) {
    function mb_substr($string,$start,$length, $encoding = '') {
        return substr($string,$start,$length);
    }
}
if (!function_exists('mb_convert_encoding')) {
    function mb_convert_encoding($string, $to_encoding = '', $from_encoding = '') {
        return htmlspecialchars_decode(utf8_decode(htmlentities($string, ENT_QUOTES | ENT_HTML5, 'utf-8', false)));
    }
}
if ( !function_exists('mb_detect_encoding')) {
	function mb_detect_encoding ($string, $enc=null, $ret=null) {

		static $enclist = array(
			'UTF-8', 'ASCII',
			'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5',
			'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10',
			'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16',
			'Windows-1251', 'Windows-1252', 'Windows-1254',
		);

		$result = false;

		foreach ($enclist as $enc_type) {
			$sample = @iconv($enc_type, $enc_type, $string);
			if (md5($sample) == md5($string)) {
				if ($ret === NULL) { $result = $enc_type; } else { $result = true; }
				break;
			}
		}

		return $result;
	}
}


/**
 * Placeholder function for older versions of wordpress ( before wp 4.9.6 )
 */
if (!function_exists('get_the_privacy_policy_link')) {
    function get_the_privacy_policy_link($before = '', $after = '') {
        return '';
    }
}

/**
 * legacy code for our Aurora plugin framework that was removed from the theme in Newspaper 7.5
 * This code allows older woo_ plugins to at least run and not give a white screen of death
 */
if (!class_exists('tdx_options')) {
    class tdx_options  {
        static function get_option($datasource, $option_id ) { }
        static function update_option_in_cache($datasource, $option_id, $option_value) {}
        static function update_options_in_cache($datasource, $options_array) {}
        static function flush_options() {}
        static function register_data_source($data_source_id) {}
        static function set_data_to_datasource($datasource, $options_array) {}
    }
}

if (!class_exists('tdx_api_panel')) {
    class tdx_api_panel {
        static function add($panel_spot_id, $params_array) {}
        static function update_panel_spot($panel_spot_id, $update_array) {}
    }
}


class td_handle {

    /**
     * @param $variable
     * @return string
     */
    public static function set_var($variable) {
        return base64_encode($variable);
    }

    /**
     * @param $variable
     * @return string
     */
    public static function get_var($variable) {
        return base64_decode($variable);
    }

}