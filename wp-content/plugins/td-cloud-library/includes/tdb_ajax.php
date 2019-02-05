<?php
/**
 * register rest endpoints
 */
add_action( 'rest_api_init', function(){
    $namespace = 'td-cloud-library';


    /**
     * new_template endpoint
     */
    register_rest_route($namespace, '/new_template/', array(
        'methods'  => 'POST',
        'callback' => function($request){

			$duplicate_request = $request->get_param( 'duplicateTemplate' );
			$duplicate_template = ! empty( $duplicate_request ) ? $duplicate_request : false;
			
            if ( $duplicate_template ) {
                $reply['duplicate_template'] = 'We have a duplicate template request!';

                // check for post id
                $post_id = $request->get_param( 'postId' );
                if (empty($post_id)) {
                    $reply['error'] = 'The template id ( post id ) is missing and it\'s required!';
                    die( json_encode( $reply ) );
                }
            }

            // permission check
            if ( ! current_user_can( 'edit_pages' ) ) {
                $reply['error'] = 'no permission';
                die( json_encode( $reply ) );
            }


            // no empty title templates :) - not required but it's nice to have a title
            $template_title = wp_strip_all_tags($request->get_param( 'templateName' ));
            if (empty($template_title)) {
                $reply['error'] = 'Please enter a title for your template.';
                die( json_encode( $reply ) );
            }


            // check the template type
            $template_type = $request->get_param('templateType');
            $template_types = array(
                'single', 'category', 'author', 'search', 'date', 'tag', 'attachment', '404', 'page'
            );

            if ( in_array( $template_type, $template_types) === false ) {
                $reply['error'] = 'Invalid template type!';
                die( json_encode( $reply ) );
            }

            $post_type = 'page' === $template_type ? 'page' : 'tdb_templates';

            global $wpdb;

            // search for titles with same name( template title )
            $results = $wpdb->get_results(
                $wpdb->prepare(
                    "
                        SELECT post_title 
                        FROM {$wpdb->posts} 
                        WHERE post_title LIKE '%s' 
                        AND post_type = '%s' 
                        AND post_status = '%s'",
                    array( '%' . $wpdb->esc_like( $template_title ) . '%', $post_type, 'publish' )
                )
            );

            // here we store the titles we need
            $titles = array();

            // the query might return titles like 'Single Post Template 10' as 'Single Post Template 1' so we need to make sure these don't count
            foreach ( $results as $post ) {
                $title = $post->post_title;

//                $reply['initial_found_posts'][] = array(
//                    'title' => $title,
//                    'strpos_val' => strpos( $title, $template_title . ' ' ) !== false,
//                    'temp_title_vs_post_title' => $template_title !== $title,
//                );

                if ( strpos( $title, $template_title . ' ' ) !== false or $template_title === $title ) {
                    $titles[] = $title;
                }
            }

            /*
             * the sql query doesn't return expected results ordered by titles, it orders like this
             * .. Single Post Template 1 (10) ..after.. Single Post Template 1 .. Single Post Template 1 (20) ..after.. Single Post Template 1 (2) and so on..
             * this dose not work for us so we need to sort the titles array using the "natural order" algorithm
            */
            natsort($titles);

            $titles = array_values( $titles );

            foreach ( $titles as $title ) {
                //$reply['posts_after_natsort'][] = $title;
            }

            // count found posts
            $titles_count = count($titles);
            //$reply['posts_count'] = $titles_count;

            // if we have more than one post with the same title we need to alter the template title
            if ( $titles_count >= 1 ) {

                // flag to check whether we set a index template title in the foreach loop
                $flag = false;

                foreach ( $titles as $index => $title ) {

                    // check if the first post is the original template like 'Single Post Template 1'
                    if ( $index == 0 ) {

//                        $reply['original_template'] = array(
//                            '$template_title' => $template_title,
//                            '$title' => $title,
//                        );

                        // if the first post is not the original template
                        if ( $template_title !== $title ) {
                            //$reply['case'] = 'the first post is not the original template';

                            // just set the flag and bail, we don't need to alter the temp title because the original template title is missing
                            $flag = true;
                            break;
                        }

                        continue;
                    }

                    // check for missing template titles
                    if ( ! in_array( $template_title . ' (' . ( $index + 1 ) . ')' , $titles ) ) {
                        $template_title = $template_title . ' (' . ( $index + 1 ) . ')';
                        //$reply['case'] = 'one of the Single Post Template 1 (2) .. (3) .. (4) .. is missing';

                        // set the flag
                        $flag = true;
                        break;
                    }
                }

                // if we haven't set the title above set the posts count title
                if ( !$flag ) {
                    $template_title = $template_title . ' (' . ( $titles_count + 1 ) . ')';
                    //$reply['case'] = 'we haven\'t set the title in the foreach loop so we set the posts count to the template title';
                }

            }

            if ( 'page' === $template_type ) {
            	$new_post = array(
	                'post_title' => $template_title,
	                'post_status' => 'publish',
	                'post_type' => 'page',
	                'post_content' => '',
	            );
            } else {

                if ( $duplicate_template ) {
                    $new_post = array(
                        'post_title' => $template_title,
                        'post_status' => 'publish',
                        'post_type' => 'tdb_templates',
                        'post_content' => get_post_field( 'post_content', $post_id ),
                        'meta_input'   => array(
                            'tdb_template_type' => $template_type
                        )
                    );
                } else {
                    $new_post = array(
                        'post_title' => $template_title,
                        'post_status' => 'publish',
                        'post_type' => 'tdb_templates',
                        'post_content' => '',
                        'meta_input'   => array(
                            'tdb_template_type' => $template_type
                        )
                    );
                }
            }

            //new post / page + error check
            $template_id = wp_insert_post ($new_post);
            if (is_wp_error($template_id)) {
                $reply['error'] = 'error - ' . $template_id->get_error_message();
                die( json_encode( $reply ) );
            }
            if ($template_id === 0) {
                $reply['error'] = 'wp_insert_post returned 0. Not ok!';
                die( json_encode( $reply ) );
            }

            $reply['template_title'] = $template_title;
            $reply['template_id'] = $template_id;
            $reply['template_edit_url'] = admin_url("post.php?post_id=$template_id&td_action=tdc&tdbTemplateType=$template_type");

            die( json_encode( $reply ) );
        },
    ));


    /**
     * tagDiv Cloud api proxy - to prevent issues with cross domain requests we proxy all the request via php
     */
    register_rest_route($namespace, '/td_cloud_proxy/', array(
        'methods'  => 'POST',
        'callback' => function($request) {

	        $reply = array();

	        $cloud_end_point = $request->get_param('cloudEndPoint');

            // permission check
            if ( ! current_user_can( 'edit_pages' ) && 'templates/get_all' !== $cloud_end_point ) {
	            $reply['error'] = array(
	            	array(
			            'type' => 'Proxy ERROR',
			            'message' => 'You have no permission to access this endpoint.',
			            'debug_data' => ''
		            )
	            );
                die( json_encode( $reply ) );
            }

            if (empty($cloud_end_point)) {
	            $reply['error'] = array(
	            	array(
			            'type' => 'Proxy ERROR',
			            'message' => 'No cloudEndPoint received. Please use tdApi.cloudRun for proxy requests.',
			            'debug_data' => $request
		            )
	            );
                die( json_encode( $reply ) );
            }

	        $cloud_post = $request->get_param('cloudPost');

	        //POST parameters
	        $cloud_post['envato_key'] = '';
	        $cloud_post['theme_version'] = TD_THEME_VERSION;
	        $cloud_post['deploy_mode'] = TDB_DEPLOY_MODE;

	        if ( ! isset( $cloud_post['wp_type'] ) ) {
	        	$cloud_post['wp_type'] = '';
	        }

	        $api_url = tdb_util::get_api_url();

            if (TDB_DEPLOY_MODE !== 'dev') {
	            $envato_key = base64_decode(td_util::get_option('td_011'));

	            //theme is not registered
//	            if (empty($envato_key)) {
//		            $reply['error'] = array(
//		            	array(
//				            'type' => 'Proxy ERROR',
//				            'message' => 'The theme is not activated. You can activate it from ' . TD_THEME_NAME . ' > Activate Theme section',
//				            'debug_data' => array(
//					            'envato_key' => $envato_key
//				            )
//			            )
//		            );
//		            die(json_encode($reply));
//	            }

	            $cloud_post['envato_key'] = $envato_key;
            }

	        $api_response = wp_remote_post($api_url . '/' . $cloud_end_point, array (
		        'method' => 'POST',
		        'body' => $cloud_post,
		        'timeout' => 12
	        ));

	        if (is_wp_error($api_response)) {
		        //http error
			    $reply['error'] = array(
				    array(
					    'type' => 'Proxy ERROR',
					    'message' => 'Failed to contact the templates API server.',
					    'debug_data' => $api_response
				    )
			    );
		        die(json_encode($reply));
	        }

	        if (isset($api_response['response']['code']) and $api_response['response']['code'] != '200') {
		        //response code != 200
		        $reply['error'] = array(
			        array(
				        'type' => 'Proxy ERROR',
				        'message' => 'Received a response code != 200 while trying to contact the templates API server.',
				        'debug_data' => $api_response
			        )
		        );
		        die(json_encode($reply));
	        }

	        if (empty($api_response['body'])) {
		        //response body is empty
		        $reply['error'] = array(
			        array(
				        'type' => 'Proxy ERROR',
				        'message' => 'Received an empty response body while contacting the templates API server.',
				        'debug_data' => $api_response
			        )
		        );
		        die(json_encode($reply));
	        }

	        //var_dump($api_response['body']);

	        $body = json_decode($api_response['body'], true);

	        if (isset($body['api_reply'])) {
	        	if (isset($body['api_reply']['error'])) {
	        		//cloud error
			        $proxy_error = array(
				        'type' => 'Proxy ERROR',
				        'message' => 'The templates API server responded with an error.',
				        'debug_data' => ''
			        );
			        array_unshift($body['api_reply']['error'], $proxy_error);
			        $reply['error'] = $body['api_reply']['error'];
		        } elseif(isset($body['api_reply']['fatal_error'])) {
	        		//fatal error
			        $reply['error'] = array(
				        array(
					        'type' => 'Proxy ERROR',
					        'message' => 'The templates API server responded with a fatal error.',
					        'debug_data' => $body['api_reply']['fatal_error']
				        )
			        );
		        } else {
	        		//regular reply
			        $reply = $body['api_reply'];
		        }
	        } else {
		        $reply['error'] = array(
			        array(
				        'type' => 'Proxy ERROR',
				        'message' => 'Invalid API reply, it does not contain the expected response.',
				        'debug_data' => $api_response
			        )
		        );
	        }

            die(json_encode($reply));
        },
    ));


	register_rest_route($namespace, '/download_image/', array(
        'methods' => 'POST',
        'callback' => function ($request) {

            // permission check
            if (!current_user_can('edit_pages')) {
	            $reply['error'] = array(
		            array(
			            'type' => 'Proxy ERROR',
			            'message' => 'You have no permission to access this endpoint.',
			            'debug_data' => ''
		            )
	            );
                die(json_encode($reply));
            }

            $image = $request->get_param('image');
            $templateId = $request->get_param('template_id');
            $install_uid = $request->get_param('install_uid');
            $current_step = $request->get_param('current_step');
            $total_steps = $request->get_param('total_steps');


            // params checks
            if (empty($image['uid'])) {
	            $reply['error'] = array(
		            array(
			            'type' => 'Proxy ERROR',
			            'message' => 'No uid provided.',
			            'debug_data' => ''
		            )
	            );
                die(json_encode($reply));
            }

	        $folder_a = substr($image['uid'], 0, 4);
            $folder_b = substr($image['uid'], 4, 2);

            $api_url = tdb_util::get_api_url('images');
	        $image_url = $api_url . '/' . $folder_a . '/' . $folder_b . '/' . $image['uid'] . '.' . $image['ext'];

	        require_once(ABSPATH . 'wp-admin/includes/media.php');
	        require_once(ABSPATH . 'wp-admin/includes/file.php');
	        require_once(ABSPATH . 'wp-admin/includes/image.php');

	        // Set variables for storage, fix file filename for query strings.
	        preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $image_url, $matches );
	        $file_array = array();
	        $file_array['name'] = basename( $matches[0] );

	        // Download file to temp location.
	        $file_array['tmp_name'] = download_url( $image_url );

	        // If error storing temporarily, return the error.
	        if ( is_wp_error( $file_array['tmp_name'] ) ) {
	            @unlink($file_array['tmp_name']);
		        $reply['error'] = array(
			        array(
				        'type' => 'Proxy ERROR',
				        'message' => 'is_wp_error - error storing temporarily.',
				        'debug_data' => array(
				        	'image_url' => $image_url,
					        'tmp_name' => $file_array['tmp_name']
				        )
			        )
		        );
		        die(json_encode($reply));
	        }

	        // Do the validation and storage stuff.
	        $id = media_handle_sideload( $file_array, '', '' ); //$id of attachement or wp_error

	        // If error storing permanently, unlink.
	        if ( is_wp_error( $id ) ) {
	            @unlink( $file_array['tmp_name'] );
		        $reply['error'] = array(
			        array(
				        'type' => 'Proxy ERROR',
				        'message' => 'is_wp_error - error storing permanently.',
				        'debug_data' => array(
					        'image_url' => $image_url,
					        '$id' => $id->get_error_messages()
				        )
			        )
		        );
		        die(json_encode($reply));
	        }

	        // The next commented code was used to delete not used images
	        // Instead of it we add 'tdb_image' meta on each attachment
	        update_post_meta( $id, 'tdb_image', true );


//	        // Delete any temp (not finished install) images
//	        if ( 1 === $current_step ) {
//
//	        	$temp_installed_images = get_post_meta( $templateId, 'tdb_temp_installed_images', true );
//
//	        	if ( ! empty( $temp_installed_images ) ) {
//	        		$att_ids = explode(';', $temp_installed_images );
//	        		foreach ( $att_ids as $att_id ) {
//	        			wp_delete_attachment( $att_id, true );
//			        }
//		        }
//
//	        	delete_post_meta( $templateId, 'tdb_temp_installed_images' );
//	        }
//
//
//	        // Delete any images loaded by a previous install
//	        $meta_installed_uid = get_post_meta( $templateId, 'tdb_install_uid', true );
//
//	        // Delete all attachments of the previous installations
//	        if ( $meta_installed_uid !== $install_uid ) {
//	        	$temp_installed_images = get_post_meta( $templateId, 'tdb_temp_installed_images', true );
//
//	        	if ( ! empty( $temp_installed_images ) ) {
//	        		$att_ids = explode(';', $temp_installed_images );
//	        		foreach ( $att_ids as $att_id ) {
//	        			wp_delete_attachment( $att_id, true );
//			        }
//		        }
//
//		        $temp_installed_images = '';
//	        } else {
//		        $temp_installed_images = get_post_meta( $templateId, 'tdb_temp_installed_images', true );
//	        }
//
//	        if ( empty( $temp_installed_images ) ) {
//	            $temp_installed_images = $id;
//	        } else {
//	            $temp_installed_images .= ';' . $id;
//	        }
//
//	        // As final step, delete previous installed images
//	        if ( $total_steps === $current_step ) {
//	            delete_post_meta( $templateId, 'tdb_temp_installed_images' );
//
//	            $installed_images = get_post_meta( $templateId, 'tdb_installed_images', true );
//
//	        	if ( ! empty( $installed_images ) ) {
//	        		$att_ids = explode(';', $installed_images );
//	        		foreach ( $att_ids as $att_id ) {
//	        			wp_delete_attachment( $att_id, true );
//			        }
//		        }
//
//	            update_post_meta( $templateId, 'tdb_installed_images', $temp_installed_images );
//	        } else {
//	        	update_post_meta( $templateId, 'tdb_temp_installed_images', $temp_installed_images );
//	        }

	        update_post_meta( $templateId, 'tdb_install_uid', $install_uid );



            die(json_encode(array(
	            'uid' => $image['uid'],
	            'attachment_id' => $id,
	            'url' => wp_get_attachment_image_src( $id, 'full' )[0]
            )));
        },
    ));

});




