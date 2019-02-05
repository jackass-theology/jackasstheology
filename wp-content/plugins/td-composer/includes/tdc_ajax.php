<?php
/**
 * Created by ra.
 * Date: 3/4/2016
 */


// ajax: save post hook
//add_action('wp_ajax_tdc_ajax_save_post',        array('tdc_ajax', 'on_ajax_save_post'));


add_action( 'rest_api_init', 'tdc_register_api_routes');
function tdc_register_api_routes() {
	$namespace = 'td-composer';

	register_rest_route($namespace, '/do_job/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_render_shortcode'),
	));


	register_rest_route($namespace, '/save_post/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_save_post'),
	));



	register_rest_route($namespace, '/decode_html_content/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_decode_html_content'),
	));

	register_rest_route($namespace, '/get_image_url/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_get_image_url'),
	));



	register_rest_route($namespace, '/get_image_id/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_get_image_id'),
	));

	register_rest_route($namespace, '/save_parts/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_save_parts'),
	));

	register_rest_route($namespace, '/change_template_name/', array(
		'methods'  => 'POST',
		'callback' => array ('tdc_ajax', 'on_ajax_change_template_name'),
	));
}

/**
 * Add the 'tdc_dirty_content' flag
 * 1 - when the post content is altered from wp-admin
 * 0 - when the post content is set by tagDiv Composer
 */
add_action( 'save_post', 'tdc_on_save_post', 10, 3 );
function tdc_on_save_post( $post_id, $post, $update) {

	// Do nothing for newly created posts
	$post_status = get_post_status( $post_id );
	if ( 'auto-draft' === $post_status || 'heartbeat' === @$_POST[ 'action' ] ) {
		return;
	}

	// Set the 'tdc_dirty_content' flag
	if ($update === false) {
		update_post_meta( $post_id, 'tdc_dirty_content', 1 );
	} else {
		$tdcContent = get_post_meta($post_id, 'tdc_content', true);
		if ( $tdcContent !== $post->post_content) {
			update_post_meta($post_id, 'tdc_dirty_content', 1 );
		}
	}

	// Set icon fonts used in post
	$icon_font_list = tdc_util::get_required_icon_fonts_ids( $post_id );
	update_post_meta( $post_id, 'tdc_icon_fonts', $icon_font_list );

	// Set icon fonts used in post
	$google_font_list = tdc_util::get_required_google_fonts_ids( $post_id );
	update_post_meta( $post_id, 'tdc_google_fonts', $google_font_list );
}


add_action( 'current_screen', 'tdc_on_current_screen' );
function tdc_on_current_screen() {

	$current_screen = get_current_screen();

	if ($current_screen->post_type === 'page' && isset($_GET['post'])) {

		$isTdcDirtyContent = get_post_meta($_GET['post'], 'tdc_dirty_content', true);

		if (isset($isTdcDirtyContent) && $isTdcDirtyContent === '0') {

			function tdc_on_admin_notices() {
				?>
				<div class="notice notice-success is-dismissible">
					<p><?php _e( 'Content compatible with TagDiv Composer. Modify it carefully!', 'td_composer' ); ?></p>
				</div>
			<?php
			}

			add_action( 'admin_notices', 'tdc_on_admin_notices' );
		}
	}
}



class tdc_ajax {
	static $_td_block__get_block_js_buffer = '';
	static $_td_block__get_block_uid = '';

	static function on_ajax_render_shortcode( WP_REST_Request $request ) {

		//sleep(5);


		if ( ! current_user_can( 'edit_pages' ) ) {
			//@todo - ceva eroare sa afisam aici
			echo 'no permission';
			die;
		}

		// change the main state
		//tdc_state::set_is_live_editor_ajax(true);


		// get the $_POST parameters only
		$parameters = $request->get_body_params();



		td_global::vc_set_custom_column_number( $request->get_param( 'columns' ) );


		/**
		 * Hook to set param blockUid.
		 * It's called by those shortcodes who needs an unique id in DOM, but without any other block settings (ex. rows, inner rows). Usually these shortcodes does not call 'td_block__get_block_js' hook
		 */
		add_action( 'td_block_set_unique_id', 'tdc_on_td_block_set_unique_id', 10, 1 );
		function tdc_on_td_block_set_unique_id( $by_ref_block_obj ) {
			tdc_ajax::$_td_block__get_block_uid = $by_ref_block_obj->block_uid;
		}


		/**
		 * hook td_block__get_block_js so we can receive the JS for EVAL form the block when do_shortcode is called below
		 */
		add_action( 'td_block__get_block_js', 'tdc_on_td_block__get_block_js', 10, 1 );
		/** @param $by_ref_block_obj td_block */
		function tdc_on_td_block__get_block_js( $by_ref_block_obj ) {
			// APPEND to the buffer for eval(). We may do eval on multiple shortcodes and we must gather all the js form all the blocks
			tdc_ajax::$_td_block__get_block_js_buffer .= $by_ref_block_obj->js_tdc_callback_ajax();
			tdc_ajax::$_td_block__get_block_uid = $by_ref_block_obj->block_uid;
		}


		/*
		 * DEPRECATED, WE FIXED THE BLOCKS!!!
			- we need to call the shortcode with output buffering because our style generator from our blocks just echoes it's generated
				style. No bueno :(
			- when the do_shortcode runs, our blocks usually call @see td_block->get_block_js(). get_block_js() calls the do_action for td_block__get_block_js hook.
				we hook td_block__get_block_js above to read that reply
			- that reply contains the JS for EVAL
		*/
//		ob_start();
//		echo do_shortcode(stripslashes($request->get_param('shortcode')));  // do shortcode usually renders with the blocks td_block->render method
//		$reply_html = ob_get_clean();

		//tdc_map_not_registered_shortcodes($request->get_param('postId'));

		//$reply_html = do_shortcode( stripslashes( $request->get_param( 'shortcode' ) ) );
		$reply_html = do_shortcode( $request->get_param( 'shortcode' ) );


		// read the buffer that was set by the 'td_block__get_block_js' hook above
		if ( ! empty( self::$_td_block__get_block_js_buffer ) ) {
			$parameters['replyJsForEval'] = self::$_td_block__get_block_js_buffer;
		}

		$parameters['blockUid'] = self::$_td_block__get_block_uid;


		$parameters['replyHtml'] = $reply_html;



		//sleep(rand(0, 1));


//		if (rand(0,1)) {
//			echo 'fuckshit';
//			die;
//		}

		//print_r($request);
		//die;

		die( json_encode( $parameters ) );
	}




	static function on_ajax_save_post( WP_REST_Request $request ) {
		if ( ! current_user_can( 'edit_pages' ) ) {
			//@todo - ceva eroare sa afisam aici
			echo 'no permission';
			die;
		}

		$parameters = array();

		// get the $_POST parameters only
		//$parameters = $request->get_body_params();


		//print_r($request);

		$action       = $_POST['tdc_action'];
		$post_id      = $_POST['tdc_post_id'];
		$post_content = $_POST['tdc_content'];

		$meta = $_POST['tdc_customized'];

		if ( ! isset( $action ) || 'tdc_ajax_save_post' !== $action || ! isset( $post_id ) || ! isset( $post_content ) ) {

			$parameters['errors'][] = 'Invalid data';

		} else {
			$data_post = array(
				'ID'           => $post_id,
				'post_content' => $post_content
			);

			$post_id = wp_update_post( $data_post, true );
			if ( is_wp_error( $post_id ) ) {
				$errors = $post_id->get_error_messages();

				$parameters['errors'] = array();
				foreach ( $errors as $error ) {
					$parameters['errors'][] = $error;
				}
			} else {
				update_post_meta( $post_id, 'tdc_dirty_content', 0 );
				update_post_meta( $post_id, 'tdc_content', $post_content );

				$td_homepage_loop = get_post_meta( $post_id, 'td_homepage_loop', true );
				$td_page = get_post_meta( $post_id, 'td_page', true );

				if ( isset( $meta ) ) {
					$decoded_meta = json_decode( wp_unslash( $meta ), true );

					if ( is_array( $decoded_meta ) && isset( $decoded_meta['page_settings'] ) ) {
						$decoded_page_settings = json_decode( wp_unslash( $decoded_meta['page_settings'] ), true );

						if ( is_array( $decoded_page_settings ) ) {

							if ( isset( $decoded_page_settings['td_homepage_loop'] ) ) {
                                $td_homepage_loop = array();
                                $td_homepage_loop[0] = array();

								foreach ( $decoded_page_settings['td_homepage_loop'] as $key => $val ) {
									$td_homepage_loop[0][ $key ] = $val;
								}

								update_post_meta( $post_id, 'td_homepage_loop', $td_homepage_loop[0] );
							}

							if ( isset( $decoded_page_settings['td_page'] ) ) {
                                $td_page = array();
                                $td_page[0] = array();

								foreach ( $decoded_page_settings['td_page'] as $key => $val ) {
									$td_page[0][ $key ] = $val;
								}

								update_post_meta( $post_id, 'td_page', $td_page[0] );
							}

							if ( isset( $decoded_page_settings['page_template'] ) ) {
								update_post_meta( $post_id, '_wp_page_template', $decoded_page_settings['page_template'] );
							}
						}
					}
				}

				// Reset the vc status
				update_post_meta( $post_id, '_wpb_vc_js_status', false );

				delete_post_meta( $post_id, 'tdb_installed_images' );
				delete_post_meta( $post_id, 'tdb_install_uid' );

				// Update the live panel settings
				td_panel_data_source::update();

				// Extensions do their own savings
				do_action( 'tdc_extension_save', $request );
			}
		}
		die( json_encode( $parameters ) );
	}





	static function on_ajax_decode_html_content( WP_REST_Request $request ) {
		if ( ! current_user_can( 'edit_pages' ) ) {
			//@todo - ceva eroare sa afisam aici
			echo 'no permission';
			die;
		}

		$parameters = array();

		$action  = $_POST['action'];
		$post_id = $_POST['post_id'];
		$content = $_POST['content'];

		if ( ! isset( $action ) || 'tdc_ajax_decode_html_content' !== $action || ! isset( $post_id ) || ! isset( $content ) ) {
			$parameters['errors'][] = 'Invalid data';

		} else {
			$parameters['parsed_content'] = htmlentities( rawurldecode( base64_decode( $content ) ), ENT_QUOTES, "UTF-8" );
		}
		die( json_encode( $parameters ) );
	}


    /**
     * the $_POST['image_id'] can be either an image ID from the media library OR a url for one of the default placeholder images.
     * This is done to allow the multipurpose plugin to load shortcodes with url placeholders instead of image IDs so we don't have to load them in the media gallery
     * @see tdc_config::$default_placeholder_images
     * @param WP_REST_Request $request
     */
	static function on_ajax_get_image_url( WP_REST_Request $request ) {
		if ( ! current_user_can( 'edit_pages' ) ) {
			//@todo - ceva eroare sa afisam aici
			echo 'no permission';
			die;
		}

		$parameters = array();

		$action  = $_POST['action'];
		$image_id = $_POST['image_id'];

		if ( ! isset( $action ) || 'tdc_ajax_get_image_url' !== $action || ! isset( $image_id ) ) {
			$parameters['errors'][] = 'Invalid data';

		} else {
		        // if it's a picture id, try to get the attachement url
		    if (is_numeric($image_id)) {
                $parameters['image_url'] = wp_get_attachment_url($image_id);
            } else {
		        // if it's not numeric, probably it's a url :)
                $parameters['image_url'] = $image_id;
            }
		}

		die( json_encode( $parameters ) );
	}





	static function on_ajax_get_image_id( WP_REST_Request $request ) {
		if ( ! current_user_can( 'edit_pages' ) ) {
			//@todo - ceva eroare sa afisam aici
			echo 'no permission';
			die;
		}

		$parameters = array();

		$action  = $_POST['action'];
		$image_class = $_POST['image_class'];

		if ( ! isset( $action ) || 'tdc_ajax_get_image_id' !== $action || ! isset( $image_class ) ) {
			$parameters['errors'][] = 'Invalid data';

		} else {
			if (preg_match( '/wp-image-([0-9]+)/i', $image_class, $class_id ) && ( $attachment_id = absint( $class_id[1] ) ) ) {

				if (wp_get_attachment_image($attachment_id) !== '') {
					$parameters['image_id'] = $attachment_id;
				}
			}

		}

		die( json_encode( $parameters ) );
	}


	static function on_ajax_save_parts( WP_REST_Request $request ) {
		if ( ! current_user_can( 'edit_pages' ) ) {
			//@todo - ceva eroare sa afisam aici
			echo 'no permission';
			die;
		}

		$parameters = array();

		$action  = $_POST['action'];
		$tdc_savings = @$_POST['tdc_savings'];

		if ( ! isset( $action ) || 'tdc_ajax_save_parts' !== $action ) {
			$parameters['errors'][] = 'Invalid data';

		} else {
			if ( isset( $tdc_savings ) ) {
				$parameters['tdc_savings'] = td_util::update_option( 'tdc_savings', $tdc_savings );
			} else {
				$parameters['tdc_savings'] = td_util::update_option( 'tdc_savings', '' );
			}
		}

		die( json_encode( $parameters ) );
	}

	static function on_ajax_change_template_name ( WP_REST_Request $request ) {

        // permission check
        if ( ! current_user_can( 'edit_pages' ) ) {
            $reply['error'] = 'no permission';
            die( json_encode( $reply ) );
        }

        // no empty title templates
        $template_title = wp_strip_all_tags( $request->get_param( 'newTemplateName' ) );
        if ( empty( $template_title ) ) {
            $reply['error'] = 'Please enter a title for your template.';
            die( json_encode( $reply ) );
        }

        // check the template type
        $template_type = $request->get_param('templateType');
        $template_types = array(
            'single', 'category', 'author', 'search', 'date', 'tag', 'attachment', '404', 'page'
        );

        if ( in_array( $template_type, $template_types) === false ) {
            $reply['error'] = 'Invalid template type! Please make sure your are editing a supported template type title.';
            die( json_encode( $reply ) );
        }

        $post_type = 'page' === $template_type ? 'page' : 'tdb_templates';

        $posts = get_posts(
            array(
                'post_status' => 'publish',
                'post_type' => $post_type,
                'numberposts' => -1
            )
        );

        foreach ( $posts as $post ) {
            if ( $post->post_title === $template_title ) {
                $reply['error'] = 'This ' . $template_type . ' template title is already used!';
                die( json_encode( $reply ) );
            }
        }

        // check the template id
        $template_id = $request->get_param( 'templateID' );
        if ( empty( $template_id ) ) {
            $reply['error'] = 'The template/page id is missing!';
            die( json_encode( $reply ) );
        }

        // update post
        $post_id = wp_update_post( array(
            'ID'           => $template_id,
            'post_title'   => $template_title,
        ));

        // treat errors
        if ( is_wp_error( $post_id ) ) {
            $errors = $post_id->get_error_messages();
            $reply['error'] = array(
                   'Post update error!'
            );
            foreach ( $errors as $error ) {
                $reply['error'][] = $error;
            }
            die( json_encode( $reply ) );
        }

        $reply['template_title'] = $template_title;
        $reply['template_type']  = $template_type;
        $reply['template_id']    = $template_id;

        die( json_encode( $reply ) );
    }
}
