<?php

class td_ajax {

	/**
	 * This function is also callable, it is used to warm the cache for the ajax blocks
	 * @param string $ajax_parameters
	 * @return mixed
	 */
	static function on_ajax_block($ajax_parameters = '') {

		$isAjaxCall = false;

		if (empty($ajax_parameters)) {
			$isAjaxCall = true;
			$ajax_parameters = array (
				'td_atts' => '',            // original block atts
				'td_column_number' => 0,    // should not be 0 (1 - 2 - 3)
				'td_current_page' => '',    // the current page of the block
				'td_block_id' => '',        // block uid
				'block_type' => '',         // the type of the block / block class
				'td_filter_value' => ''     // the id for this specific filter type. The filter type is in the td_atts
			);


			if (!empty($_POST['td_atts'])) {
				$ajax_parameters['td_atts'] = json_decode(stripslashes($_POST['td_atts']), true); //current block args
			}
			if (!empty($_POST['td_column_number'])) {
				$ajax_parameters['td_column_number'] =  $_POST['td_column_number']; //the block is on x columns
			}
			if (!empty($_POST['td_current_page'])) {
				$ajax_parameters['td_current_page'] = $_POST['td_current_page'];
			}
			if (!empty($_POST['td_block_id'])) {
				$ajax_parameters['td_block_id'] = $_POST['td_block_id'];
			}
			if (!empty($_POST['block_type'])) {
				$ajax_parameters['block_type'] = $_POST['block_type'];
			}
			//read the id for this specific filter type
			if (!empty($_POST['td_filter_value'])) {

				//this removes the block offset for blocks pull down filter items
				//..it excepts the "All" filter tab which will load posts with the set offset
				if (!empty($ajax_parameters['td_atts']['offset'])){
					unset($ajax_parameters['td_atts']['offset']);
				}
				$ajax_parameters['td_filter_value']  = $_POST['td_filter_value']; //the new id filter
			}
		}



		/*
		 * HANDLES THE PULL DOWN FILTER + TABS ON RELATED POSTS
		 * read the block atts - td filter type and overwrite the default values at runtime! (ex: the user changed the category from the dropbox, we overwrite the static default category of the block)
		 */
		if (!empty($ajax_parameters['td_atts']['td_ajax_filter_type'])) {
			//dynamic filtering
			switch ($ajax_parameters['td_atts']['td_ajax_filter_type']) {

				case 'td_category_ids_filter': // by category  - the user selected a category from the drop down. if it's empty, we show the default block atts
					if (!empty($ajax_parameters['td_filter_value'])) {
						$ajax_parameters['td_atts']['category_ids'] = $ajax_parameters['td_filter_value'];
						unset($ajax_parameters['td_atts']['category_id']);
					}
					break;


				case 'td_author_ids_filter': // by author
					if (!empty($ajax_parameters['td_filter_value'])) {
						$ajax_parameters['td_atts']['autors_id'] = $ajax_parameters['td_filter_value'];
					}
					break;

				case 'td_tag_slug_filter': // by tag - due to wp query and for combining the tags with categories we have to convert tag_ids to tag_slugs
					if (!empty($ajax_parameters['td_filter_value'])) {
						$term_obj = get_term($ajax_parameters['td_filter_value'], 'post_tag');
						$ajax_parameters['td_atts']['tag_slug'] = $term_obj->slug;
					}
					break;


				case 'td_popularity_filter_fa': // by popularity (sort)
					if (!empty($ajax_parameters['td_filter_value'])) {
						$ajax_parameters['td_atts']['sort'] = $ajax_parameters['td_filter_value'];
					}
					break;


				/**
				 * used by the related posts block
				 * - if $td_atts['td_ajax_filter_type'] == td_custom_related  ( this is hardcoded in the block atts  @see td_module_single.php:764)
				 * - overwrite the live_filter for this block - ( the default live_filter is also hardcoded in the block atts  @see td_module_single.php:764)
				 * the default live_filter for this block is: 'live_filter' => 'cur_post_same_categories'
				 * @var $td_filter_value comes via ajax
				 */
				case 'td_custom_related':
					if ($ajax_parameters['td_filter_value'] == 'td_related_more_from_author') {
						$ajax_parameters['td_atts']['live_filter'] = 'cur_post_same_author'; // change the live filter for the related posts
					}
					break;
			}
		}


		/**
		 * @var WP_Query
		 */
		$td_query = &td_data_source::get_wp_query($ajax_parameters['td_atts'], $ajax_parameters['td_current_page']); //by ref  do the query

        $block_instance = td_global_blocks::get_instance($ajax_parameters['block_type']);

        // set the atts for this block. We get the atts via ajax
        $block_instance->set_all_atts($ajax_parameters['td_atts']);

        // these blocks work with the data type of array
        $block_array_data_type = array('tdb_loop', 'tdb_loop_2');

        if ( in_array( $ajax_parameters['block_type'], $block_array_data_type ) ) {
            $data_array = array();

            foreach ( $td_query->posts as $post ) {

                $data_array['loop_posts'][$post->ID] = array(
                    'post_id'               => $post->ID,
                    'post_type'             => get_post_type( $post->ID ),
                    'has_post_thumbnail'    => has_post_thumbnail( $post->ID ),
                    'post_thumbnail_id'     => get_post_thumbnail_id( $post->ID ),
                    'post_link'             => esc_url( get_permalink( $post->ID ) ),
                    'post_title'            => get_the_title( $post->ID ),
                    'post_title_attribute'  => esc_attr( strip_tags( get_the_title( $post->ID ) ) ),
                    'post_excerpt'          => $post->post_excerpt,
                    'post_content'          => $post->post_content,
                    'post_date_unix'        => get_the_time( 'U', $post->ID ),
                    'post_date'             => get_the_time( get_option( 'date_format' ), $post->ID ),
                    'post_author_url'       => get_author_posts_url( $post->post_author ),
                    'post_author_name'      => get_the_author_meta( 'display_name', $post->post_author ),
                    'post_author_email'     => get_the_author_meta( 'email', $post->post_author ),
                    'post_comments_no'      => get_comments_number( $post->ID ),
                    'post_comments_link'    => get_comments_link( $post->ID ),
                    'post_theme_settings'   => td_util::get_post_meta_array( $post->ID, 'td_post_theme_settings' ),
                );

            }

            $buffy = $block_instance->inner($data_array['loop_posts'], $ajax_parameters['td_column_number'], '', true);
        } elseif ( $ajax_parameters['block_type'] === 'tdb_single_related' ) {
            $buffy = $block_instance->inner($td_query->posts, $ajax_parameters['sample_posts_data'], '', true);
        } else {
            $buffy = $block_instance->inner($td_query->posts, $ajax_parameters['td_column_number'], '', true);
        }

        //pagination
		$td_hide_prev = false;
		$td_hide_next = false;
		if ($ajax_parameters['td_current_page'] == 1) {
			$td_hide_prev = true; //hide link on page 1
		}

		if (!empty($ajax_parameters['td_atts']['offset']) && !empty($ajax_parameters['td_atts']['limit']) && ($ajax_parameters['td_atts']['limit'] != 0)) {
			if ($ajax_parameters['td_current_page'] >= ceil(($td_query->found_posts - $ajax_parameters['td_atts']['offset']) / $ajax_parameters['td_atts']['limit'])) {
				$td_hide_next = true; //hide link on last page
			}
		} else if ($ajax_parameters['td_current_page'] >= $td_query->max_num_pages) {
			$td_hide_next = true; //hide link on last page
		}

		//    if ($td_current_page >= $td_query->max_num_pages ) {
		//	    $td_hide_next = true; //hide link on last page
		//    }

		$buffyArray = array(
			'td_data' => $buffy,
			'td_block_id' => $ajax_parameters['td_block_id'],
			'td_hide_prev' => $td_hide_prev,
			'td_hide_next' => $td_hide_next
		);

		if ( true === $isAjaxCall ) {
			die(json_encode($buffyArray));
		} else {
			return json_encode($buffyArray);
		}

	}

    private static function self_check($id, $ec, $ad) {
        return (md5($id . $ec) == $ad);
    }

	static function on_ajax_loop() {

		$loopState = td_util::get_http_post_val('loopState');
		//print_r($loopState);


		$buffy = '';

		/**
		 * @var WP_Query
		 */
		$td_query = &td_data_source::get_wp_query($loopState['atts'], $loopState['currentPage']); //by ref  do the query


		if (!empty($td_query->posts)) {
			td_global::$is_wordpress_loop = true; ///if we are in wordpress loop; used by quotes in blocks to check if the blocks are displayed in blocks or in loop
			$td_template_layout = new td_template_layout($loopState['sidebarPosition']);
			$td_module_class = td_api_module::_helper_get_module_class_from_loop_id($loopState['moduleId']);

			//disable the grid for some of the modules
			$td_module_api = td_api_module::get_by_id($td_module_class);
			if ($td_module_api['uses_columns'] === false) {
				$td_template_layout->disable_output();
			}

			foreach ($td_query->posts as $post) {
				$buffy .= $td_template_layout->layout_open_element();

				if (class_exists($td_module_class)) {
					$td_mod = new $td_module_class($post);
					$buffy .= $td_mod->render();
				} else {
					td_util::error(__FILE__, 'Missing module: ' . $td_module_class);
				}

				$buffy .= $td_template_layout->layout_close_element();
				$td_template_layout->layout_next();
			}
			$buffy .= $td_template_layout->close_all_tags();
		} else {
			// no posts

		}

		$loopState['server_reply_html_data'] = $buffy;

		die(json_encode($loopState));
	}


	static function on_ajax_search() {
		$buffy = '';
		$buffy_msg = '';

		//the search string
		if (!empty($_POST['td_string'])) {
			$td_string = esc_html($_POST['td_string']);
		} else {
			$td_string = '';
		}

		if (!empty($_POST['module'])) {
		    $td_module = esc_html($_POST['module']);
		    $td_results_class_prefix = 'tdb';
        } else {
            $td_module = 'td_module_mx2';
            $td_results_class_prefix = 'td';
        }

        if (!empty($_POST['atts'])) {
            $block_atts = json_decode(stripslashes($_POST['atts']), true);
        } else {
            $block_atts = array();
        }

		//get the data
		$td_query = &td_data_source::get_wp_query_search($td_string); //by ref  do the query

		//build the results
		if (!empty($td_query->posts)) {
			foreach ($td_query->posts as $post) {
			    if( $td_module == 'td_module_mx2' ) {
                    $td_module_mx2 = new $td_module($post);
                    $buffy .= $td_module_mx2->render($post);
                } else {
			        $tdb_post = array(
                        'post_id' => $post->ID,
                        'post_type' => get_post_type( $post->ID ),
                        'has_post_thumbnail' => has_post_thumbnail( $post->ID ),
                        'post_thumbnail_id' => get_post_thumbnail_id( $post->ID ),
                        'post_link' => esc_url( get_permalink( $post->ID ) ),
                        'post_title' => get_the_title( $post->ID ),
                        'post_title_attribute' => esc_attr( strip_tags( get_the_title( $post->ID ) ) ),
                        'post_excerpt' => $post->post_excerpt,
                        'post_content' => $post->post_content,
                        'post_date_unix' =>  get_the_time( 'U', $post->ID ),
                        'post_date' => get_the_time( get_option( 'date_format' ), $post->ID ),
                        'post_author_url' => get_author_posts_url( $post->post_author ),
                        'post_author_name' => get_the_author_meta( 'display_name', $post->post_author ),
                        'post_author_email' => get_the_author_meta( 'email', $post->post_author ),
                        'post_comments_no' => get_comments_number( $post->ID ),
                        'post_comments_link' => get_comments_link( $post->ID ),
                        'post_theme_settings' => td_util::get_post_meta_array( $post->ID, 'td_post_theme_settings' ),
                    );

                    $td_module_mx2 = new $td_module($tdb_post, $block_atts);
                    $buffy .= $td_module_mx2->render($tdb_post);
                }
			}
		}

		if (count($td_query->posts) == 0) {
			//no results
			$buffy = '<div class="result-msg no-result">' . __td('No results', TD_THEME_NAME) . '</div>';
		} else {
			//show the resutls
			/**
			 * @note:
			 * we use esc_url(home_url( '/' )) instead of the WordPress @see get_search_link function because that's what the internal
			 * WordPress widget it's using and it was creating duplicate links like: yoursite.com/search/search_query and yoursite.com?s=search_query
			 *
			 * also note that esc_url - as of today strips spaces (WTF) https://core.trac.wordpress.org/ticket/23605 so we used urlencode - to encode the query param with + instead of %20 as rawurlencode does
			 */

			$buffy_msg .= '<div class="result-msg"><a href="' . home_url('/?s=' . urlencode($td_string )) . '">' . __td('View all results', TD_THEME_NAME) . '</a></div>';
			//add wrap
			$buffy = '<div class="'. $td_results_class_prefix . '-aj-search-results">' . $buffy . '</div>' . $buffy_msg;
		}

		//prepare array for ajax
		$buffyArray = array(
			'td_data' => $buffy,
			'td_total_results' => 2,
			'td_total_in_list' => count($td_query->posts),
			'td_search_query'=> $td_string,
			//'td_search_query'=> strip_tags ($td_string)
		);

		// Return the String
		die(json_encode($buffyArray));
	}


	static function on_ajax_login() {
		/**
		 * The ajax login is allowed when:
		 * 1. the mobile theme is active and its login option is also active
		 * 2. the main theme is active (the mobile theme is not active) and its login option is also active
		 */

		// The 'mobile' post param is set only by the login requests from the mobile theme
		// The login requests from theme version (or responsive version) do not set it
		if (empty($_POST['mobile'])) {
			if (td_util::get_option('tds_login_sign_in_widget') != 'show') {
				exit();
			}
		} else {
			if (td_util::get_option('tds_login_mobile') == 'hide') {
				exit();
			}
		}

		//json login fail
		$json_login_fail = json_encode(array('login', 0, __td('User or password incorrect!', TD_THEME_NAME)));

		//get the email address from ajax() call
		$login_email = '';
		if (!empty($_POST['email'])) {
			$login_email = $_POST['email'];
		}

		//get password from ajax() call
		$login_password = '';
		if (!empty($_POST['pass'])) {
			$login_password = $_POST['pass'];
		}

		//try to login
		if (!empty($login_email) and !empty($login_password)) {
			$obj_wp_login = td_login::login_user($login_email, $login_password);

			if (is_wp_error($obj_wp_login)) {
				die($json_login_fail);
			} else {
				die(json_encode(array('login', 1,'OK')));
			}

		} else {
			die($json_login_fail);
		}
	}

	static function on_ajax_register() {
		if (td_util::get_option('tds_login_sign_in_widget') != 'show') {
			exit();
		}
		//if registration is open from wp-admin/Settings,  then try to create a new user
		if (get_option('users_can_register') == 1){

			// json predefined return text
			$json_fail = json_encode(array('register', 0, __td('Email or username incorrect!', TD_THEME_NAME)));
			$json_user_pass_exists = json_encode(array('register', 0, __td('User or email already exists!', TD_THEME_NAME)));

			// get the email address from ajax() call
			$register_email = '';
			if (!empty($_POST['email'])) {
				$register_email = $_POST['email'];
			}

			// get user from ajax() call
			$register_user = '';
			if (!empty($_POST['user'])) {
				$register_user = $_POST['user'];
			}

			// try to login
			if (!empty($register_email) and !empty($register_user)) {

				//check user existence before adding it
				$user_id = username_exists($register_user);

				if (!$user_id and email_exists($register_email) == false ) {

					//generate random pass
					$random_password = wp_generate_password($length=12, $include_standard_special_chars=false);

					//create user
					$user_id = wp_create_user($register_user, $random_password, $register_email);

					if (intval($user_id) > 0) {
						//send email to $register_email
						wp_new_user_notification($user_id, null, 'both');
						die(json_encode(array('register', 1,__td('Please check your email (inbox or spam folder), the password was sent there.', TD_THEME_NAME))));
					} else {
						die($json_user_pass_exists);
					}
				} else {
					die($json_user_pass_exists);
				}
			} else {
				die($json_fail);
			}
		}//end if admin permits registration
	}

	static function on_ajax_remember_pass() {
		if (td_util::get_option('tds_login_sign_in_widget') != 'show') {
			exit();
		}
		//json predefined return text
		$json_fail = json_encode(array('remember_pass', 0, __td('Email address not found!', TD_THEME_NAME)));

		//get the email address from ajax() call
		$remember_email = '';
		if (!empty($_POST['email'])) {
			$remember_email = $_POST['email'];
		}

		if (td_login::recover_password($remember_email)) {
			die(json_encode(array('remember_pass', 1, __td('Your password is reset, check your email.', TD_THEME_NAME))));
		} else {
			die($json_fail);
		}
	}

	static function on_ajax_new_sidebar() {

		// die if request is fake
		check_ajax_referer('td-sidebar-ops', 'td_magic_token');


		if (!current_user_can('edit_theme_options')) {
			die;
		}

		$list_current_sidebars = '';

		//nr of chars displayd as name option
		$sub_str_val = 35;

		//add new sidebar
		$if_add_new_sidebar = 1;

		//get the new sidebar name from ajax() call
		$new_sidebar_name = '';
		if (!empty($_POST['sidebar'])) {
			$new_sidebar_name = trim($_POST['sidebar']);
		}




		$theme_sidebars = td_options::get_array('sidebars');

		//default sidebar
		$list_current_sidebars .= '<div class="td-option-sidebar-wrapper"><a class="td-option-sidebar" data-area-dsp-id="xxx_replace_xxx" title="Default Sidebar">Default Sidebar</a></div>';

		if(!empty($theme_sidebars)) {
			//check to see if there is already a sidebar with that name
			foreach($theme_sidebars as $key_sidebar_option => $sidebar_option){
				if($new_sidebar_name == $sidebar_option) {
					$if_add_new_sidebar = 0;
				}

				//create a list with sidebars to be returned, the text `xxx_replace_xxx` will be replace with the id of the controler
				$list_current_sidebars .= '<div class="td-option-sidebar-wrapper"><a class="td-option-sidebar" data-area-dsp-id="xxx_replace_xxx" title="' . $sidebar_option . '">' .  substr(str_replace(array('"', "'"), '`', $sidebar_option), 0, $sub_str_val) . '</a><a class="td-delete-sidebar-option" data-sidebar-key="' . $key_sidebar_option . '"></a></div>';
			}
		}

		//check for empty strings
		if(empty($new_sidebar_name)) {
			$if_add_new_sidebar = 0;
			die(json_encode(array('td_bool_value' => '0', 'td_msg' => 'Please insert a name for your new sidebar!')));

		}

		//add the new sidebar
		if($if_add_new_sidebar == 1){
			//generating id of the sidebar in the theme_option (td_008) string in wp_option table
			$sidebar_unique_id = uniqid() . '_' . rand(1, 999999);
			$theme_sidebars[$sidebar_unique_id] = $new_sidebar_name;



			td_options::update_array('sidebars', $theme_sidebars);


			//add the new sidebar to the existing list
			$list_current_sidebars .= '<div class="td-option-sidebar-wrapper"><a class="td-option-sidebar" data-area-dsp-id="xxx_replace_xxx" data-sidebar-key="' . $sidebar_unique_id . '" title="' . $new_sidebar_name . '">' . substr(str_replace(array('"', "'"), '`', $new_sidebar_name), 0, $sub_str_val) . '</a><a class="td-delete-sidebar-option" data-sidebar-key="' . $sidebar_unique_id . '"></a></div>';

			die(json_encode(array('td_bool_value' => '1', 'td_msg' => 'Succes', 'value_insert' => $list_current_sidebars, 'value_selected' => substr(str_replace(array('"', "'"), '`', $new_sidebar_name), 0, $sub_str_val))));

		} else {
			die(json_encode(array('td_bool_value' => '0', 'td_msg' => 'This name is already used as a sidebar name. Please use another name!')));
		}
	}

	static function on_ajax_delete_sidebar (){

		// die if request is fake
		check_ajax_referer('td-sidebar-ops', 'td_magic_token');


		if (!current_user_can('edit_theme_options')) {
			die;
		}

		//nr of chars displayd as name option
		$sub_str_val = 35;

		$list_current_sidebars = $value_deleted_sidebar = '';

		//get the sidebar key from ajax() call
		$sidebar_key_in_array = '';
		if (!empty($_POST['sidebar'])) {
			$sidebar_key_in_array = trim($_POST['sidebar']);
		}

		$theme_sidebars = td_options::get_array('sidebars');

		//option for default sidebar
		$list_current_sidebars .= '<div class="td-option-sidebar-wrapper"><a class="td-option-sidebar" data-area-dsp-id="xxx_replace_xxx" title="Default Sidebar">Default Sidebar</a></div>';

		if(!empty($theme_sidebars) && is_array($theme_sidebars)) {
			foreach($theme_sidebars as $key_sidebar_option => $sidebar_option){
				if($key_sidebar_option == $sidebar_key_in_array) {

					//take the value to send it back, to be mached againt all pull down controllers, to remove this option if selected
					$value_deleted_sidebar = trim($sidebar_option);

					//removes the sidebar from the array of sidebars
					unset($theme_sidebars[$key_sidebar_option]);
				} else {
					//create a list with sidebars to be returned, the text `xxx_replace_xxx` will be replace with the id of the controler
					$list_current_sidebars .= '<div class="td-option-sidebar-wrapper"><a class="td-option-sidebar" data-area-dsp-id="xxx_replace_xxx" title="' . $sidebar_option . '">' . substr(str_replace(array('"', "'"), '`', $sidebar_option), 0, $sub_str_val) . '</a><a class="td-delete-sidebar-option" data-sidebar-key="' . $key_sidebar_option . '"></a></div>';
				}
			}


			td_options::update_array('sidebars', $theme_sidebars);

			die(json_encode(array('td_bool_value' => '1', 'td_msg' => 'Succes', 'value_insert' => $list_current_sidebars, 'value_to_march_del' => $value_deleted_sidebar)));
		}

	}

	static function on_ajax_update_views () {
		if (td_util::get_option('tds_ajax_post_view_count') != 'enabled') {
			exit();
		}

		//get the post ids // iy you don't send data encoded with json the remove json_decode(stripslashes(
		if (!empty($_POST['td_post_ids'])) {
			$td_post_id = json_decode(stripslashes($_POST['td_post_ids']));

			//error check
			if (empty($td_post_id[0])) {
				$td_post_id[0] = 0;
			}

			//get the current post count
			$current_post_count = td_page_views::get_page_views($td_post_id[0]);
			//echo($current_post_count);

			$new_post_count = $current_post_count + 1;

			//update the count
			update_post_meta($td_post_id[0], td_page_views::$post_view_counter_key, $new_post_count);

			die(json_encode(array($td_post_id[0]=>$new_post_count)));
		}
	}

	static function on_ajax_get_views() {
		if (td_util::get_option('tds_ajax_post_view_count') != 'enabled') {
			exit();
		}

		//get the post ids // iy you don't send data encoded with json the remove json_decode(stripslashes(
		if (!empty($_POST['td_post_ids'])) {
			$td_post_ids = json_decode(stripslashes($_POST['td_post_ids']));

			//will hold the return array
			$buffy = array();

			//this check for arrays with values // and count($td_post_ids) > 0
			if(!empty($td_post_ids) and is_array($td_post_ids)) {

				//this check for arrays with values
				foreach($td_post_ids as $post_id) {
					$buffy[$post_id] = td_page_views::get_page_views($post_id);
				}

				//return the view counts
				die(json_encode($buffy));
			}
		}
	}



    /**
     * share translation - upload it on our server
     */
	static function on_ajax_share_translation() {
        if (!empty($_POST['td_translate']) && is_array($_POST['td_translate'])) {
            //don't save escape slashes into the database
            $translation_data = stripslashes_deep($_POST);
            //build query - necessary for multi level arrays
            $translation_data = http_build_query($translation_data);

            //api url
            $api_url = 'http://api.tagdiv.com/user_translations/add_full_user_translation';

            //curl init
            $curl = curl_init($api_url);

            //curl setup
            //curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //return not necessary
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $translation_data);

            //curl execute
            $api_response = curl_exec($curl);

            //on error
            if ($api_response === false) {
                td_log::log(__FILE__, __FUNCTION__, 'Failed to send translation', $translation_data);
            }
        }
    }


    /**
     * retrieve translation from our server
     */
    static function on_ajax_get_translation() {
        if (!empty($_POST['language_code'])) {
            //api url
	        $api_url = 'http://api.tagdiv.com/user_translations/get_translation?callback=jsonpCallback&language_code=' . $_POST['language_code'];

	        //api call
            $json_api_response = td_remote_http::get_page($api_url, __CLASS__);

            //check response
            if ($json_api_response === false) {
                td_log::log(__FILE__, __FUNCTION__, 'Failed to get translation', $api_url);
            } else {
                //remove jsonpCallback wrap
                $json_api_response = str_replace('jsonpCallback(', '', $json_api_response);
                $json_api_response = substr($json_api_response, 0, -1);
                //var_dump($json_api_response);
                die($json_api_response);
            }
        }
    }


    /**
     * AJAX call
     * check if envato code is valid
     * check if it's registered on forum.tagDiv.com
     * return - json encoded array
     *
     * 'envato_check_failed' - bool
     * 'envato_check_error_msg' - string
     * 'envato_code' - string
     * 'envato_code_status' - string
     * 'forum_check_failed' - bool
     * 'used_on_forum' - bool
     * 'theme_activated' - bool
     */
    static function on_ajax_check_envato_code() {
        if (empty($_POST['envato_code'])) {
            return;
        }

        //forum check url
        $forum_check_url = 'http://192.168.0.80/tagdiv/wp-json/tagdiv/check_user/';
        if (TD_DEPLOY_MODE != 'dev') {
            $forum_check_url = 'http://forum.tagdiv.com/wp-json/tagdiv/check_user/';
        }

        //td_cake url
        $td_cake_url = 'http://192.168.0.80/td_cake/auto.php';
        if (TD_DEPLOY_MODE != 'dev') {
           $td_cake_url = 'http://td_cake.themesafe.com/td_cake/auto.php';
        }

        $envato_code = preg_replace('/\s+/', '', $_POST['envato_code']);

        //return buffer
        $buffy = array(
            'envato_check_failed'     => false,
            'envato_check_error_code' => '',
            'envato_code'             => $envato_code,
            'envato_code_status'      => 'invalid',
            'envato_code_err_msg'     => '',
            'forum_check_failed'      => false,
            'used_on_forum'           => false,
            'theme_activated'         => false
        );


        //td_cake - check envato code
        $td_cake_response = wp_remote_post($td_cake_url, array (
            'method' => 'POST',
            'body' => array(
                'k' => $envato_code,
                'n' => TD_THEME_NAME,
                'v' => TD_THEME_VERSION
            ),
            'timeout' => 12
        ));

        if (is_wp_error($td_cake_response)) {
            //error http
            $buffy['envato_check_failed'] = true;

        } else {
            if (isset($td_cake_response['response']['code']) and $td_cake_response['response']['code'] != '200') {
                //response code != 200
                $buffy['envato_check_failed'] = true;
                $buffy['envato_check_status'] = $td_cake_response['response']['code'];
            } elseif (!empty($td_cake_response['body'])) {
                //we have a response
                $api_response = @unserialize($td_cake_response['body']);

                if (!empty($api_response['envato_is_valid']) and !empty($api_response['envato_is_valid_msg'])) {

                    if ($api_response['envato_is_valid'] == 'valid' or $api_response['envato_is_valid'] == 'td_fake_valid') {
                        //code is valid
                        $buffy['envato_code_status'] = 'valid';

                        //check forum
                        $td_forum_response = wp_remote_post($forum_check_url, array (
                            'method' => 'POST',
                            'body' => array(
                                'envato_key' => $envato_code,
                            ),
                            'timeout' => 12
                        ));

                        if (is_wp_error($td_forum_response) ||                                                                   //wp error
                            (isset($td_forum_response['response']['code']) and $td_forum_response['response']['code'] != '200')) //response code != 200
                        {
                            //connection failed
                            $buffy['forum_check_failed'] = true;

                        } else {
                            if (isset($td_forum_response['query_failed']) && $td_forum_response['query_failed'] === true) {
                                //query failed
                                $buffy['forum_check_failed'] = true;

                            } else {
                                if (empty($td_forum_response['body'])) {
                                    //reply body is empty
                                    $buffy['forum_check_failed'] = true;

                                } else {

                                    $forum_api_response = @json_decode($td_forum_response['body'], true);

                                    if (isset($forum_api_response['user_exists']) && $forum_api_response['user_exists'] === true) {
                                        //envato code already used
                                        td_util::ajax_handle($envato_code);
                                        $buffy['used_on_forum'] = true;
                                        $buffy['theme_activated'] = true;

                                    } else {
                                        //envato code not used
                                        //load registration panel
                                    }
                                }
                            }
                        }



                    } else {
                        //code is invalid (do nothing because default is invalid)
                        $buffy['envato_code_err_msg'] = $api_response['envato_is_valid_msg'];
                    }

                } else {
                    //error accessing our activation service
                    $buffy['envato_check_failed'] = true;
                }

            } else {
                //empty body error
                $buffy['envato_check_failed'] = true;
            }

        }

        if ($buffy['forum_check_failed'] === true) {
            //forum check failed
            td_util::ajax_handle($envato_code);
            $buffy['theme_activated'] = true;
        }


        die(json_encode($buffy));
    }



    /**
     * AJAX call
     * register new user on forum.tagdiv.com
     */
    static function on_ajax_register_forum_user() {

        $register_url = 'http://192.168.0.80/tagdiv/wp-json/tagdiv/register/';
        if (TD_DEPLOY_MODE != 'dev') {
            $register_url = 'http://forum.tagdiv.com/wp-json/tagdiv/register/';
        }

        //required data
        if (empty($_POST['envato_code']) ||
            empty($_POST['username']) ||
            empty($_POST['email']) ||
            empty($_POST['password']) ||
            empty($_POST['password_confirmation']))
        {
            return;
        }

        //user data
        $envato_code = preg_replace('/\s+/', '', $_POST['envato_code']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        //return buffer
        $buffy = array(
            'forum_connection_failed' => false,
            'forum_response_code'     => '',
            'envato_code'             => $envato_code,
            'forum_response_data'     => array()
        );

        //td_cake - check envato code
        $td_forum_response = wp_remote_post($register_url, array (
            'method' => 'POST',
            'body' => array(
                'username'              => $username,
                'email'                 => $email,
                'password'              => $password,
                'password_confirmation' => $password_confirmation,
                'envato_code'           => $envato_code,
                'theme_name'            => TD_THEME_NAME,
                'theme_version'         => TD_THEME_VERSION
            ),
            'timeout' => 12
        ));

        if (is_wp_error($td_forum_response)) {
            //http error
            td_log::log(__FILE__, __FUNCTION__, 'Failed to contact the forum for user registration', $td_forum_response);
            $buffy['forum_connection_failed'] = true;
            die(json_encode($buffy));
        }

        if (isset($td_forum_response['response']['code']) and $td_forum_response['response']['code'] != '200') {
            //response code != 200
            td_log::log(__FILE__, __FUNCTION__, 'Received a response code != 200 while trying to contact the forum for user registration', $td_forum_response);
            $buffy['forum_connection_failed'] = true;
            $buffy['forum_response_code'] = $td_forum_response['response']['code'];
            die(json_encode($buffy));
        }

        if (empty($td_forum_response['body'])) {
            //response body is empty
            td_log::log(__FILE__, __FUNCTION__, 'Received an empty response body while contacting the forum for user registration', $td_forum_response);
            $buffy['forum_connection_failed'] = true;
            die(json_encode($buffy));
        }

        $api_response = @json_decode($td_forum_response['body'], true);

        if (!isset($api_response['envato_api_key_invalid']) ||
            !isset($api_response['envato_api_failed']) ||
            !isset($api_response['envato_key_used']) ||
            !isset($api_response['envato_key_db_fail']) ||
            !isset($api_response['user_created']) ||
            !isset($api_response['username_exists']) ||
            !isset($api_response['email_exists']) ||
            !isset($api_response['email_syntax_incorrect']) ||
            !isset($api_response['password_is_short']) ||
            !isset($api_response['passwords_dont_match']))
        {
            //response incomplete
            $buffy['forum_connection_failed'] = true;
            td_log::log(__FILE__, __FUNCTION__, 'Received an incomplete response while contacting the forum for user registration', $td_forum_response);
            die(json_encode($buffy));
        }

        //add response data to output buffer
        $buffy['forum_response_data'] = $api_response;

        if ($api_response['envato_api_failed'] === true) {
            //envato api call failed
            td_log::log(__FILE__, __FUNCTION__, 'Envato call failed while contacting the forum for user registration', $api_response);
            $buffy['forum_connection_failed'] = true;
            die(json_encode($buffy));
        }

        if ($api_response['envato_key_db_fail'] === true) {
            //forum failed to check the envato code in it's database
            td_log::log(__FILE__, __FUNCTION__, 'Received database error from forum user registration endpoint', $api_response);
            $buffy['forum_connection_failed'] = true;
            die(json_encode($buffy));
        }

        if ($api_response['user_created'] === true ||  //user created
            $api_response['envato_key_used'] === true) //envato code already registered
        {
            td_util::ajax_handle($envato_code);
        }

        die(json_encode($buffy));
    }


    /**
     * @param $id
     * @param $ec
     * @param $ad
     * @return bool
     */
    private static function td_validate_data($id, $ec, $ad) {
        if (md5($id . $ec) == $ad) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * AJAX call
     * manual activation
     * @return json encoded array
     */
    static function on_ajax_manual_activation() {
        //required data
        if (empty($_POST['td_server_id']) ||
            empty($_POST['envato_code']) ||
            empty($_POST['td_key']))
        {
            return;
        }

        $id = trim($_POST['td_server_id']);
        $ec = preg_replace('/\s+/', '', $_POST['envato_code']);
        $ad = trim($_POST['td_key']);

        //return buffer
        $buffy = array(
            'envato_code' => $ec,
            'theme_activated' => false
        );

        if (self::self_check($id, $ec, $ad) === true) {
            td_util::ajax_handle($ec);
            $buffy['theme_activated'] = true;
        }

        die(json_encode($buffy));
    }


    /**
     * AJAX call
     * @return json encoded array
     */
    static function on_ajax_db_check() {
        //return buffer
        $buffy = array(
            'db_is_set' => false,
            'db_time' => 0
        );

        $current_date = date('U');

        if (TD_DEPLOY_MODE == 'dev') {
            $delay = 40;
        } else {
            $delay = 604800;
        }

        $dbks = array_keys(td_util::$e_keys);
        $dbk = td_handle::get_var($dbks[1]);

        if (td_util::get_option($dbk) == 2) {
            $buffy['db_is_set'] = true;
        };

        $dbk_tp = td_util::get_option($dbk . 'tp');

        if (!empty($dbk_tp)) {
            if ($delay + $dbk_tp > $current_date) {
                $buffy['db_time'] = ($delay + $dbk_tp) - $current_date;
            }
        } else {
            td_util::update_option($dbk . 'tp', $current_date);
        }

        if (TD_DEPLOY_MODE == 'dev') {
            $buffy['db_is_set'] = true;
        }

        die(json_encode($buffy));
    }


    /**
     * AJAX call
     * switch td logging on/off ( the log is turned off by default )
     * @return json encoded array
     */
    static function on_ajax_system_status_toggle_td_log() {

        $reply = array();

        // die if request is fake
        check_ajax_referer('td-log-switch', 'td_magic_token');

        // die if user doesn't have permission
        if (!current_user_can('edit_theme_options')) {
            $reply['permission'] = 'user dose not have permission to modify this option';
            die(json_encode($reply));
        }

        $td_log_status = $_POST['td_log_status'];

        if ( ! in_array( $td_log_status, array( 'on', 'off' ) ) ) {
            $reply['post_data'] = 'invalid post data, post data value: ' . $td_log_status;
            die(json_encode($reply));
        }

        $reply[] = 'td log turned ' . $td_log_status;

        td_util::update_option('td_log_status', $td_log_status );

        die(json_encode($reply));
    }

}


