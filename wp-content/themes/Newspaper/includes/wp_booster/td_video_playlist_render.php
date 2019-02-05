<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 30.12.2014
 * Time: 13:26
 */

class td_video_playlist_render {

	/**
	 * @param $atts the shortcode atts
	 * @param $list_type string youtube|vimeo
	 *
	 * @return string the playlist HTML
	 */
    static function render_generic($atts, $list_type, $block_uid = ''){
        if ( $block_uid == '' ) {
            $block_uid = td_global::td_generate_unique_id(); //update unique class on each render
        }
        $buffy = ''; //output buffer
        $el_class = '';
        if (!empty($atts['el_class'])) {
            $el_class = $atts['el_class'];
        }

        $buffy .= '<div class="td_block_wrap td_block_video_playlist ' . $el_class . '">';
	        $buffy .= '<div class="' . $block_uid . ' td_block_inner">';

	            if (empty($atts['playlist_v']) && empty($atts['playlist_yt']) ) {
                    $buffy .= td_util::get_block_error('Video playlist', '<strong>Video id field</strong> is empty. Configure this block/widget and enter a list of video id\'s');
		            //$buffy .= '<div class="td-block-missing-settings"><span>Video playlist</span> <strong>Video id field</strong> is empty. Configure this block/widget and enter a list of video id\'s</div>';
	            }
		        //inner content of the block
		        $buffy .= self::inner($atts, $list_type);
	        $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block_video_playlist -->';
        return $buffy;
    }




	private static function get_video_data($atts, $list_type) {
		global $post;

		// When the TagDiv composer is requesting by ajax, the $postId is set by the 'postId' param
		if ( td_util::tdc_is_live_editor_ajax() ) {
			$postId = $_POST['postId'];
		} else {
			$postId = $post->ID;
		}

		$atts_playlist_name = 'playlist_yt';
		$list_name = 'youtube_ids'; //array key for youtube in the pos meta db array

		if($list_type != 'youtube') {
			$atts_playlist_name = 'playlist_v';
			$list_name = 'vimeo_ids'; //array key for vimeo in the pos meta db array
		}

		// read the youtube and vimeo ids from the DB
		$td_playlist_videos = td_util::get_post_meta_array($postId, 'td_playlist_video');

		//print_r($td_playlist_videos);

		// read the video ids from the shortcode
		if ( !empty($atts[$atts_playlist_name]) ) {


			$video_ids = array_map('trim', explode(",", $atts[$atts_playlist_name]));

			// get the video id's that are not in the cache
			$uncached_ids = array();
			foreach ($video_ids as $video_id) {
				if (!isset($td_playlist_videos[$list_name][$video_id])) {
					$uncached_ids []= $video_id;
				}
			}


			// do we have ids that are not in the cache?
			if (!empty($uncached_ids)) {
				// request data for the id's that are not in the cache
				$uncached_videos = td_remote_video::api_get_videos_info($uncached_ids, $list_type);

				// update the cache
				if ($uncached_videos !== false) {
					if (empty($td_playlist_videos[$list_name])) {
						$td_playlist_videos[$list_name] = $uncached_videos;
					} else {
						// array_merge can't be used because it reindex integer indexes ( and youtube indexes are integers)
						$td_playlist_videos[$list_name] = $td_playlist_videos[$list_name] + $uncached_videos;
					}
//					var_dump( $post );
					update_post_meta($postId, 'td_playlist_video', $td_playlist_videos);
				}

			}


			// after we updated the cache with the missing videos (if any) we build our buffer of videos
			$buffy_array = array();
			foreach ($video_ids as $video_id) {
				if (!empty($td_playlist_videos[$list_name][$video_id])) {
					$buffy_array[$video_id] = $td_playlist_videos[$list_name][$video_id];
				}
			}

			return $buffy_array;
		}


		return false;
	}


	private static function inner ($atts, $list_type) {


        if(is_single() && 'tdb_templates' !== get_post_type()) {
            //get the column number on single post page
            if(td_global::$cur_single_template_sidebar_pos == 'no_sidebar'){
                $td_column_number = 3;
            } else {
                $td_column_number = 2;
            }
        } else {
            if (td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
                $td_column_number = 3;
            } else {
                //page
                $td_column_number = td_global::vc_get_column_number(); // get the column width of the block
            }
        }

        if($list_type == 'youtube') {
            //array key for youtube in the pos meta db array
            $list_name = 'youtube_ids';
        } else {
            //array key for vimeo in the pos meta db array
            $list_name = 'vimeo_ids';
        }


	    // read the youtube and vimeo ids
	    //$playlist_video_db = get_post_meta($post->ID, td_video_playlist_support::$td_playlist_video_key, true);

	    $videos_meta = self::get_video_data($atts, $list_type);

        if ( $videos_meta !== false ) {

            $first_video_id = '';
            $contor_first_video = 0;
            $js_object = '';
            $click_video_container = '';

			$js_variable = ';if (undefined === window.td_' . $list_type . '_list_ids) {window.td_' . $list_type . '_list_ids = {}};';

            foreach($videos_meta as $video_id => $video_data) {

                //take the id of first video
                if($contor_first_video == 0) {$first_video_id = $video_id;}
                $contor_first_video++;

                //add comma (,) for next value
                if(!empty($js_object)) {$js_object .= ',';}
                //$js_object .= "\n'td_".$video_id."':{";

                $video_data_propeties = '';

                //get thumb
                $playlist_structure_thumb = '';
                if(!empty($video_data['thumb'])){

                    //if on https & we do not have an https image set it on https
                    if ( td_global::$http_or_https === 'https' && strpos( $video_data['thumb'], 'https://' ) === false ) {
                        $video_data['thumb'] = str_replace( 'http://', 'https://', $video_data['thumb'] );
                    }

                    $playlist_structure_thumb = '<div class="td_video_thumb"><img src="' . $video_data['thumb'] . '" alt="" /></div>';
                    //$video_data_propeties .= 'thumb:"' . $video_data['thumb'] . '",';
                }

                //get title
                $playlist_structure_title = '<div class="td_video_title_and_time">';
                if(!empty($video_data['title'])){
                    $playlist_structure_title .= '<div class="td_video_title">' . mb_convert_encoding($video_data['title'], 'UTF-8') . '</div>';
                    $video_data_propeties .= 'title:"' . esc_attr(mb_convert_encoding($video_data['title'], 'UTF-8')) . '",';
                }

                //get time
                $playlist_structure_time = '';
                if(!empty($video_data['time'])){

                    $get_video_time = '';
                    if(substr($video_data['time'], 0, 3) == '00:') {
                        $get_video_time = substr($video_data['time'], 3);
                    } else {
                        $get_video_time = $video_data['time'];
                    }

                    $playlist_structure_title .= '<div class="td_video_time">' . $get_video_time . '</div>';
                    $video_data_propeties .= 'time:"' . $get_video_time . '"';
                }
                $playlist_structure_title .= '</div>';

                //creating click-able playlist video
				//$click_video_container .= '<a id="td_' . $video_id . '" class="td_click_video td_click_video_' . $list_type . '" data-video-id="' . $video_id . '"> ' . $playlist_structure_thumb . $playlist_structure_title . '</a>';
				$click_video_container .= '<a class="td_' . $video_id . ' td_click_video td_click_video_' . $list_type . '" data-video-id="' . $video_id . '"> ' . $playlist_structure_thumb . $playlist_structure_title . '</a>';

				//$js_object .= $video_data_propeties . "}";

				$js_variable .= 'window.td_' . $list_type . '_list_ids[\'td_' . $video_id . '\'] = {' . $video_data_propeties . '};';
			}



//            if(!empty($js_object)) {
//                $js_object = 'var td_' . $list_type . '_list_ids = {' .$js_object. '}';
//            }

            //creating column number classes
            $column_number_class = 'td_video_playlist_column_2';

            if($td_column_number == 1) {
                $column_number_class = 'td_video_playlist_column_1';
            }

            if($td_column_number == 3) {
                $column_number_class = 'td_video_playlist_column_3';
            }




            //autoplay
            $td_playlist_autoplay = 0;
            $td_class_autoplay_control = 'td-sp-video-play';


            if( !empty($atts['playlist_auto_play']) and $atts['playlist_auto_play'] == 1) {
                $td_playlist_autoplay = 1;

                //$td_class_autoplay_control = 'td-sp-video-pause';
            }

            //check how many video ids we have; if there are more then 5 then add a class that is used on chrome to add the playlist scroll bar
            $td_class_number_video_ids = '';
            $td_playlist_video_count = count($videos_meta);

            if(intval($td_playlist_video_count) > 4) {
                $td_class_number_video_ids = 'td_add_scrollbar_to_playlist_for_mobile';
            }

            if(intval($td_playlist_video_count) > 5) {
                $td_class_number_video_ids = 'td_add_scrollbar_to_playlist';
            }


			//creating title wrapper if any
			$td_video_title = '';
			if ( !empty($atts['playlist_title']) ) {
				$td_video_title = '<div class="td_video_playlist_title"><div class="td_video_title_text">' . $atts['playlist_title'] . '</div></div>';
			}

	        // When the tagDiv composer is not available, DO NOT add the css class ('td_wrapper_playlist_player_youtube' or 'td_wrapper_playlist_player_vimeo')
	        // They are used by the tdVideoPlaylist js script, as player selectors
	        $cssWrapperPlayer = 'td_wrapper_playlist_player_' . $list_type;
	        $playerPlaceholder = '';

	        if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
		        $cssWrapperPlayer = '';
		        $playerPlaceholder = "<div>$list_type placeholder</div>";
	        }

			//$js_object is there so we can take the string and parsit as json to create an object in jQuery
			return '<div class="' . $column_number_class . '">' . $td_video_title  . '<div class="td_wrapper_video_playlist"><div class="td_wrapper_player ' . $cssWrapperPlayer . '" data-first-video="' . esc_attr($first_video_id) . '" data-autoplay="' . $td_playlist_autoplay . '">
                            <div id="player_' . $list_type . '">' . $playerPlaceholder . '</div>
                       </div><div class="td_container_video_playlist " >
                                                <div class="td_video_controls_playlist_wrapper"><div class="td_video_stop_play_control"><a class="' . $td_class_autoplay_control . ' td-sp td_' . $list_type . '_control"></a></div><div class="td_current_video_play_title_' . $list_type . ' td_video_title_playing"></div><div class="td_current_video_play_time_' . $list_type . ' td_video_time_playing"></div></div>
                                                <div id="td_' . $list_type . '_playlist_video" class="td_playlist_clickable ' . $td_class_number_video_ids . '">' . $click_video_container . '</div>
                       </div>
                    </div>
                    </div>
                    <script>' . $js_variable . '</script>';
		}

		return '';
	}
}//end td_playlist_render