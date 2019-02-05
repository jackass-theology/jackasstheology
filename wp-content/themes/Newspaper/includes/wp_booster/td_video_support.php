<?php
/**
 * Class td_video_support - tagDiv video support V 2.0 @since 4 nov 2015
 * downloads the video thumbnail and puts it asa a featured image to the post
 */
class td_video_support{

	private static $on_save_post_post_id; // here we keep the post_id when the save_post hook runs. We need the post_id to pass it to the other hook @see on_add_attachment_set_featured_image
	private static $fb_access_token = 'EAAC0twN8wjQBAPOUhZAWJohvqwr4iEeGooiNEKoRkkJ0KMik9nSX6xiiMZCZBSgRRai8ZAHjZCzniq36dZBgbJw93Vsom56qBi24CqesirT2sNZBvN6yTylhjDED9ri4iShPON3grZAF0fpUijQTSmzxOO71h70fN7lFpN0YLhV3Ugs2ZCaZAdvfZAd';

	private static $caching_time = 10800; //seconds -> 3 hours

	/**
	 * Render a video on the fornt end from URL
	 * @param $videoUrl - the video url that we want to render
	 *
	 * @return string - the player HTML
	 */
	static function render_video($videoUrl) {
		$buffy = '';
		switch (self::detect_video_service($videoUrl)) {
			case 'youtube':
				$buffy .= '
                <div class="wpb_video_wrapper">
                    <iframe id="td_youtube_player" width="600" height="560" src="' . 'https://www.youtube.com/embed/' . self::get_youtube_id($videoUrl) . '?enablejsapi=1&feature=oembed&wmode=opaque&vq=hd720' . self::get_youtube_time_param($videoUrl) . '" frameborder="0" allowfullscreen=""></iframe>
                    <script type="text/javascript">
						var tag = document.createElement("script");
						tag.src = "https://www.youtube.com/iframe_api";

						var firstScriptTag = document.getElementsByTagName("script")[0];
						firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

						var player;

						function onYouTubeIframeAPIReady() {
							player = new YT.Player("td_youtube_player", {
								height: "720",
								width: "960",
								events: {
									"onReady": onPlayerReady
								}
							});
						}

						function onPlayerReady(event) {
							player.setPlaybackQuality("hd720");
						}
					</script>

                </div>

                ';

				break;
			case 'dailymotion':
				$buffy .= '
                    <div class="wpb_video_wrapper">
                        <iframe frameborder="0" width="600" height="560" src="' . td_global::$http_or_https . '://www.dailymotion.com/embed/video/' . self::get_dailymotion_id($videoUrl) . '"></iframe>
                    </div>
                ';
				break;
			case 'vimeo':
				$buffy = '
                <div class="wpb_video_wrapper">
                    <iframe src="' . td_global::$http_or_https . '://player.vimeo.com/video/' . self::get_vimeo_id($videoUrl) . '" width="500" height="212" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </div>
                ';
				break;
			case 'facebook':
				/* $buffy = '
				<div class="wpb_video_wrapper td-facebook-video">
					<iframe src="' . td_global::$http_or_https . '://www.facebook.com/plugins/video.php?href=' . urlencode($videoUrl) . '&show_text=0" width="' . $width . '" height="' . $height . '" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true" ></iframe>
				</div>
				';
				*/

				/**
				 * cache & oembed implementation
				 */
				$cache_key = self::get_facebook_id($videoUrl);
				$group = 'td_facebook_video';

				if (td_remote_cache::is_expired($group, $cache_key) === true) {

					// cache is expired - do a request
					$facebook_api_json = td_remote_http::get_page('https://www.facebook.com/plugins/video/oembed.json/?url=' . urlencode($videoUrl) , __CLASS__);

					if ($facebook_api_json !== false) {
						$facebook_api = @json_decode($facebook_api_json);

						//json data decode
						if ($facebook_api === null and json_last_error() !== JSON_ERROR_NONE) {
							td_log::log(__FILE__, __FUNCTION__, 'json decode failed for facebook video embed api', $videoUrl);
						}

						if (is_object($facebook_api) and !empty($facebook_api->html)) {

							//add the html to the buffer
							$buffy = '<div class="wpb_video_wrapper">' . $facebook_api->html . '</div>';

							//set the cache
							td_remote_cache::set($group, $cache_key, $facebook_api->html, self::$caching_time);
						}

					} else {
						td_log::log(__FILE__, __FUNCTION__, 'facebook api html data cannot be retrieved/json request failed', $videoUrl);
					}

				} else {
					// cache is valid
					$api_html_embed_data = td_remote_cache::get($group, $cache_key);
					$buffy = '<div class="wpb_video_wrapper">' . $api_html_embed_data . '</div>';
				}
				break;
			case 'twitter':

				/**
				 * cache & oembed implementation
				 */

				$cache_key = self::get_twitter_id($videoUrl);
				$group = 'td_twitter_video';


				if (td_remote_cache::is_expired($group, $cache_key) === true) {

					// cache is expired - do a request
					$twitter_json = td_remote_http::get_page('https://publish.twitter.com/oembed?url=' . urlencode($videoUrl) . '&widget_type=video&align=center' , __CLASS__);

					if ($twitter_json !== false) {
					$twitter_api = @json_decode($twitter_json);

						//json data decode
						if ($twitter_api === null and json_last_error() !== JSON_ERROR_NONE) {
							td_log::log(__FILE__, __FUNCTION__, 'json decode failed for twitter video embed api', $videoUrl);
						}

						if (is_object($twitter_api) and !empty($twitter_api->html)) {

							//add the html to the buffer
							$buffy = '<div class="wpb_video_wrapper">' . $twitter_api->html . '</div>';

							//set the cache
							td_remote_cache::set($group, $cache_key, $twitter_api->html, self::$caching_time);
						}

					} else {
						td_log::log(__FILE__, __FUNCTION__, 'twitter api html data cannot be retrieved/json request failed', $videoUrl);
					}

				} else {
					// cache is valid
					$api_html_embed_data = td_remote_cache::get($group, $cache_key);
					$buffy = '<div class="wpb_video_wrapper">' . $api_html_embed_data . '</div>';
				}

				break;
		}
		return $buffy;
	}


	/**
	 * Downloads the video thumb on the save_post hook
	 * @param $post_id
	 */
	static function on_save_post_get_video_thumb($post_id) {

		//verify post is not a revision
		if ( !wp_is_post_revision( $post_id ) ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			$td_post_video = td_util::get_post_meta_array($post_id, 'td_post_video');

			//check to see if the url is valid
			if (empty($td_post_video['td_video']) or self::validate_video_url($td_post_video['td_video']) === false) {
				return;
			}

			if (!empty($td_post_video['td_last_video']) and $td_post_video['td_last_video'] == $td_post_video['td_video']) {
				//we did not update the url
				return;
			}

			$videoThumbUrl = self::get_thumb_url($td_post_video['td_video']);

			if (!empty($videoThumbUrl)) {
				self::$on_save_post_post_id = $post_id;

				// add the function above to catch the attachments creation
				add_action('add_attachment', array(__CLASS__, 'on_add_attachment_set_featured_image'));

				// load the attachment from the URL
				media_sideload_image($videoThumbUrl, $post_id, $post_id);

				// we have the Image now, and the function above will have fired too setting the thumbnail ID in the process, so lets remove the hook so we don't cause any more trouble
				remove_action('add_attachment', array(__CLASS__, 'on_add_attachment_set_featured_image'));
			}
		}
	}


	/**
	 * set the last uploaded image as a featured image. We 'upload' the video thumb via the media_sideload_image call from above
	 * @internal
	 */
	static function on_add_attachment_set_featured_image($att_id){
		update_post_meta(self::$on_save_post_post_id, '_thumbnail_id', $att_id);
	}


	/**
	 * detects if we have a recognized video service and makes sure that it's a valid url
	 * @param $videoUrl
	 * @return bool
	 */
	private static function validate_video_url($videoUrl) {
		if (self::detect_video_service($videoUrl) === false) {
			return false;
		}
		if (!preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $videoUrl)) {
			return false;
		}
		return true;
	}


	/**
	 * Returns the video thumb url from the video URL
	 * @param $videoUrl
	 * @return string
	 */
	private static function get_thumb_url($videoUrl) {

		switch (self::detect_video_service($videoUrl)) {
			case 'youtube':
				$yt_1920_url = td_global::$http_or_https . '://img.youtube.com/vi/' . self::get_youtube_id($videoUrl) . '/maxresdefault.jpg';
				$yt_640_url  = td_global::$http_or_https . '://img.youtube.com/vi/' . self::get_youtube_id($videoUrl) . '/sddefault.jpg';
				$yt_480_url  = td_global::$http_or_https . '://img.youtube.com/vi/' . self::get_youtube_id($videoUrl) . '/hqdefault.jpg';

				if (!self::is_404($yt_1920_url)) {
					return $yt_1920_url;
				}

				elseif (!self::is_404($yt_640_url)) {
					return $yt_640_url;
				}

				elseif (!self::is_404($yt_480_url)) {
					return $yt_480_url;
				}

				else {
					td_log::log(__FILE__, __FUNCTION__, 'No suitable thumb found for youtube.', $videoUrl);
				}
				break;

			case 'dailymotion':
				$dailymotion_api_json = td_remote_http::get_page('https://api.dailymotion.com/video/' . self::get_dailymotion_id($videoUrl) . '?fields=thumbnail_url', __CLASS__);
				if ($dailymotion_api_json !== false) {
					$dailymotion_api = @json_decode($dailymotion_api_json);
					if ($dailymotion_api === null and json_last_error() !== JSON_ERROR_NONE) {
						td_log::log(__FILE__, __FUNCTION__, 'json decaode failed for daily motion api', $videoUrl);
						return '';
					}

					if (!empty($dailymotion_api) and !empty($dailymotion_api->thumbnail_url)) {
						return $dailymotion_api->thumbnail_url;
					}
				}
				break;

			case 'vimeo':
				$url = 'http://vimeo.com/api/oembed.json?url=https://vimeo.com/' . self::get_vimeo_id($videoUrl);

				$response = wp_remote_get($url, array(
					'timeout' => 10,
					'sslverify' => false,
					'user-agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0'
				));

				if (!is_wp_error($response)) {
					$td_result = @json_decode(wp_remote_retrieve_body($response));
					$result = $td_result->thumbnail_url;
					$result = preg_replace("#_[0-9]+(x)?[0-9]+\.jpg#", '.jpg', $result);

					return $result;
				}
				break;

			case 'facebook':
				$facebook_api_json = td_remote_http::get_page('https://graph.facebook.com/v2.7/' . self::get_facebook_id($videoUrl) . '/thumbnails?access_token=' . self::$fb_access_token , __CLASS__);

                if ( $facebook_api_json !== false ) {
					$facebook_api = @json_decode($facebook_api_json);
					if ($facebook_api === null and json_last_error() !== JSON_ERROR_NONE) {
						td_log::log(__FILE__, __FUNCTION__, 'json decode failed for facebook api', $videoUrl);
						return '';
					}

					if (is_object($facebook_api) and !empty($facebook_api)) {
						foreach ($facebook_api->data as $result) {
							if ($result->is_preferred !== false) {
								return ($result->uri);
							}
						}

					}
				}
				break;

			case 'twitter':
			if (!class_exists('TwitterApiClient')) {
				require_once 'wp-admin/external/twitter-client.php';
				$Client = new TwitterApiClient;
				$Client->set_oauth (YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, SOME_ACCESS_KEY, SOME_ACCESS_SECRET);
				try {
					$path = 'statuses/show';
					$args = array (
						'id' => self::get_twitter_id($videoUrl),
						'include_entities' => true
					);
					$data = @$Client->call( $path, $args, 'GET' );

					//json data decode
					if ($data === null) {
						td_log::log(__FILE__, __FUNCTION__, 'api call failed for twitter video thumbnail request api', $videoUrl);
					}

					if (empty($data['entities']['media'])){
						add_filter( 'redirect_post_location', array( __CLASS__, 'td_twitter_notice_on_redirect_post_location' ), 99 );

					} else  {
						return $data['entities']['media'][0]['media_url'] . ':large';
					}
				}
				catch( TwitterApiException $Ex ){
					//twitter rate limit will show here
					//echo 'Caught exception: ',  $Ex->getMessage();
					//print_r($Ex);
				}
			} else {
				add_filter( 'redirect_post_location', array( __CLASS__, 'td_twitter_class_notice_on_redirect_post_location' ), 99 );
			}
		}
		return '';
	}


	/*
	 * youtube
	 */
    private static function get_youtube_id($videoUrl) {
        $query_string = array();
        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);

        if (empty($query_string["v"])) {
            //explode at ? mark
            $yt_short_link_parts_explode1 = explode('?', $videoUrl);

            //short link: http://youtu.be/AgFeZr5ptV8
            $yt_short_link_parts = explode('/', $yt_short_link_parts_explode1[0]);
            if (!empty($yt_short_link_parts[3])) {
                return $yt_short_link_parts[3];
            }

            return $yt_short_link_parts[0];
        } else {
            return $query_string["v"];
        }
    }

    /*
     * youtube t param from url (ex: http://youtu.be/AgFeZr5ptV8?t=5s)
     */
    private static function get_youtube_time_param($videoUrl) {
        $query_string = array();
        parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query_string);
        if (!empty($query_string["t"])) {

            if (strpos($query_string["t"], 'm')) {
                //take minutes
                $explode_for_minutes = explode('m', $query_string["t"]);
                $minutes = trim($explode_for_minutes[0]);

                //take seconds
                $explode_for_seconds = explode('s', $explode_for_minutes[1]);
                $seconds = trim($explode_for_seconds[0]);

                $startTime = ($minutes * 60) + $seconds;
            } else {
                //take seconds
                $explode_for_seconds = explode('s', $query_string["t"]);
                $seconds = trim($explode_for_seconds[0]);

                $startTime = $seconds;
            }

            return '&start=' . $startTime;
        } else {
            return '';
        }
    }

    /*
     * Vimeo id
     */
    private static function get_vimeo_id($videoUrl) {
        sscanf(parse_url($videoUrl, PHP_URL_PATH), '/%d', $video_id);
        return $video_id;
    }

    /*
     * Dailymotion
     */
    private static function get_dailymotion_id($videoUrl) {
        $id = strtok(basename($videoUrl), '_');
        if (strpos($id,'#video=') !== false) {
            $videoParts = explode('#video=', $id);
            if (!empty($videoParts[1])) {
                return $videoParts[1];
            }
        } else {
            return $id;
        }
		return '';
    }

	/**
	 * Facebook
	 * @param $videoUrl
	 * @return string - the fb video id
	 */
	private static function get_facebook_id($videoUrl) {

		/**
		 * https://www.facebook.com/{page-name}/videos/{video-id}/
		 * https://www.facebook.com/{username}/videos/{video-id}/ - user's video must be public
		 * https://www.facebook.com/video.php?v={video-id}
		 * https://www.facebook.com/video.php?id={video-id} - this video url does not work in this format
		 */

		if (strpos($videoUrl, '//www.facebook.com') !== false) {

			$id = basename($videoUrl);
			if (strpos($id,'video.php?v=') !== false) {
				$query = parse_url($videoUrl, PHP_URL_QUERY);
				parse_str($query, $vars);
				return $vars['v'];
			} else {
				return $id;
			}
		}
		return '';
	}

	/**
	 * Twitter
	 * @param $videoUrl
	 * @return string - the tweet id
	 */
	private static function get_twitter_id($videoUrl) {

		/**
		 * https://twitter.com/video/status/760619209114071040
		 */

		if (strpos($videoUrl, 'twitter.com') !== false) {
			$id = basename($videoUrl);
			return $id;
		}
		return '';
	}

	/**
	 * appends a query variable to the URL query, to show the 'non supported embeddable twitter videos' notice, on the redirect_post_location hook
	 * @param $location - the destination URL
	 * @return mixed
	 */
	static function td_twitter_notice_on_redirect_post_location( $location ) {
		remove_filter( 'redirect_post_location', array( __CLASS__, 'td_twitter_notice_on_redirect_post_location' ), 99 );
		return add_query_arg( 'td_twitter_video', 'error_notice', $location );
	}

	/**
	 * the twitter video notice for non supported embeddable twitter videos
	 */
	static function td_twitter_on_admin_notices() {
		if ( ! isset( $_GET['td_twitter_video'] ) ) {
			return;
		}

		?>
		<div class="notice notice-error is-dismissible">
			<p>Sorry, but the twitter video you have used is not supported by twitter api, so the video thumb image cannot be retrieved!<br>
			Some twitter videos, like Vine and Amplify or other content videos are not available through the twitter API therefore resources, like video thumb images, are not available.</p>
		</div>
		<?php
	}

	/**
	 * appends a query variable to the URL query, to show the 'class already defined' notice, on the redirect_post_location hook
	 * @param $location - the destination URL
	 * @return mixed
	 */
	static function td_twitter_class_notice_on_redirect_post_location( $location ) {
		remove_filter( 'redirect_post_location', array( __CLASS__, 'td_twitter_class_notice_on_redirect_post_location' ), 99 );
		return add_query_arg( 'td_twitter_video_class', 'class_notice', $location );
	}

	/**
	 * the twitter video notice for class already defined
	 */
	static function td_twitter_class_on_admin_notices() {
		if ( ! isset( $_GET['td_twitter_video_class'] ) ) {
			return;
		}

		?>
		<div class="notice notice-error">
			<p>The twitter api class is already defined! It might have been already defined by one of your plugins so please try without having any plugins active!</p>
		</div>
		<?php
	}

    /*
     * Detect the video service from url
     */
    private static function detect_video_service($videoUrl) {
        $videoUrl = strtolower($videoUrl);
        if (strpos($videoUrl,'youtube.com') !== false or strpos($videoUrl,'youtu.be') !== false) {
            return 'youtube';
        }
        if (strpos($videoUrl,'dailymotion.com') !== false) {
            return 'dailymotion';
        }
        if (strpos($videoUrl,'vimeo.com') !== false) {
            return 'vimeo';
        }
		if (strpos($videoUrl,'facebook.com') !== false) {
			return 'facebook';
		}

		if (strpos($videoUrl,'twitter.com') !== false) {
			return 'twitter';
		}

		return false;
    }

	/**
	 * detect a 404 page
	 * @param $url
	 * @return bool
	 */
    private static function is_404($url) {
        $headers = @get_headers($url);
	    if (!empty($headers[0]) and strpos($headers[0],'404') !== false) {
		    return true;
	    }
	    return false;
    }


}

