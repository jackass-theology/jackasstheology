<?php



class tdb_util {

    /**
     * debug kill that prints the calling function + class
     * @param string $message
     * @param array $debug_backtrace result of debug_backtrace()
     * @param string $get_called_class result of $get_called_class
     */
    static function kill ($message, $debug_backtrace = array(), $get_called_class = '') {


        echo $get_called_class . ' - : ' . $message . "\n";

        if (isset($debug_backtrace[0])) {

            if (isset($debug_backtrace[0]['file']) && isset($debug_backtrace[0]['line']) ) {
                echo 'File: ' . $debug_backtrace[0]['file'] . "\n";
                echo 'Line: ' . $debug_backtrace[0]['line'] . "\n";
            } else {
                print_r($debug_backtrace[0]);
            }


        } else {
            echo 'No debug_backtrace :( ';
        }
    }


    static function get_get_val($_get_name) {
        if (isset($_GET[$_get_name])) {
            return esc_html($_GET[$_get_name]); // xss - no html in get
        }

        return false;
    }


    static function get_shortcode_att( $content, $shortcode, $att ) {

        // parse content shortcode
        preg_match_all( '/\[(.*?)\]/', $content, $matches );

        // search for the shortcode
        if ( !empty( $matches[0] ) and is_array( $matches[0] ) ) {
            foreach ( $matches[0] as $match ) {
                if ( strpos( $match, $shortcode ) !== false ) {
                    $shortcode = $match;
                }
            }
        }

        // get the shortcode att if we have a shortcode match
        if ( !empty( $shortcode ) ) {
            $shortcode = str_replace( array( '[',']' ), '', $shortcode );
            $shortcode_atts = shortcode_parse_atts( $shortcode );

            if ( isset( $shortcode_atts[$att] ) ){
                return $shortcode_atts[$att];
            }
        }

        return '';
    }


    static function get_api_url($ext = 'api') {
    	$api_url = '';

	    if (TDB_CLOUD_LOCATION === 'local') {
		    $api_url = 'http://' . $_SERVER['SERVER_ADDR'] . '/td_cloud/' . $ext;
	    } else {
		    $api_url = 'https://cloud.tagdiv.com/' . $ext;
	    }

	    return $api_url;
    }


	static function enqueue_js_files_array($js_files_array, $dependency_array) {
		$last_js_file_id = '';
		foreach ($js_files_array as $js_file_id => $js_file) {
			if ($last_js_file_id == '') {
				wp_enqueue_script($js_file_id, TDB_URL . $js_file, $dependency_array, TD_CLOUD_LIBRARY, true); //first, load it with jQuery dependency
			} else {
				wp_enqueue_script($js_file_id, TDB_URL . $js_file, array($last_js_file_id), TD_CLOUD_LIBRARY, true);  //not first - load with the last file dependency
			}
			$last_js_file_id = $js_file_id;
		}
	}


}