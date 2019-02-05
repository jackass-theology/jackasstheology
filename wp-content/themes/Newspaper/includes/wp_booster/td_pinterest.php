<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 2/21/2017
 * Time: 2:19 PM
 */

class td_pinterest {

    private static $caching_time = 10800;  // 3 hours

    public static function render_generic($atts) {

        // pinterest id is not set
        if (empty($atts['pinterest_id'])) {
            return td_util::get_block_error('Pinterest', 'pinterest data error: pinterest data is not set, please check the ID' );
        }


        if (preg_match('/.+\/.+/', $atts['pinterest_id']) === 0) {
            return td_util::get_block_error('Pinterest', 'pinterest data error: Please add the board name' );
        }


        // prepare the data
        $pinterest_data = array(
            'user_page_json' => '',
        );

        // get pinterest data
        $pinterest_data_status = self::get_pinterest_data($atts, $pinterest_data);

        // check if we have an error and return that
        if ($pinterest_data_status != 'pinterest_fail_cache' and $pinterest_data_status != 'pinterest_cache_updated' and $pinterest_data_status != 'pinterest_cache') {
            return $pinterest_data_status;
        }

        // render the HTML
        $buffy = '<!-- td pinterest source: ' . $pinterest_data_status . ' -->';

        // renders the block template
        $buffy .= self::render_block_template($atts, $pinterest_data);

        return $buffy;
    }

    private static function render_block_template($atts, $pinterest_data) {

        // stop render when no data is received
        if ($pinterest_data['user_page_json'] == '') {
            //return self::error('Render failed - no data is received, please check the ID: ' . $atts['pinterest_id']);
            return td_util::get_block_error('Pinterest', 'Render failed - no data is received, please check the ID: ' . $atts['pinterest_id']);
        }



        ob_start();

        //number of columns
        $board_columns_number = '';
        if (!empty($atts['pinterest_number_of_columns'])) {
            //the board column settings
            $board_columns_number = 'style="column-count:' . $atts['pinterest_number_of_columns'] . ';"';
        }

        //columns gap
        $board_columns_gap = '';
        if ( !empty($atts['pinterest_col_gap']) ) {
            $board_columns_gap = 'td-pinterest-gap-' . $atts['pinterest_col_gap'];
        }

        //user board height settings
        $board_inline_height = '';
        if ( !empty($atts['pinterest_board_height']) ) {
            if ( strpos($atts['pinterest_board_height'], 'px') !== false ) {
                $board_inline_height = 'style="overflow-y: scroll; height:' . $atts['pinterest_board_height'] . ';"';
            } else {
                $board_inline_height = 'style="overflow-y: scroll; height:' . $atts['pinterest_board_height'] . 'px;"';
            }
        }

        //user's pins limit
        $board_pins_total_number = 25;
        if ( !empty($atts['pins_limit']) ) {
            $board_pins_total_number = $atts['pins_limit'];
        }

        if (isset($pinterest_data['user_page_json'][0]['data'])) {

            //debugging
            //unset($pinterest_data['user_page_json']['sideEffects']);
            //unset($pinterest_data['user_page_json']['id']);
            //unset($pinterest_data['user_page_json']['options']);
            //unset($pinterest_data['user_page_json']['errorStrategy']);
            //unset($pinterest_data['user_page_json']['attributes']);
            //unset($pinterest_data['user_page_json']['extraData']);
            //unset($pinterest_data['user_page_json']['name']);

            //echo '<pre>';
            //print_r($pinterest_data['user_page_json']);
            //echo '</pre>';

            $pinterest_profile_picture = $pinterest_username = $pinterest_profile = $pinterest_board = $pinterest_board_url = '';

            if ( isset ($pinterest_data['user_page_json'][0]['data']['owner']) &&
                isset ($pinterest_data['user_page_json'][0]['data']['name']) &&
                isset ($pinterest_data['user_page_json'][0]['data']['url']) ) {
                $pinterest_profile_picture = $pinterest_data['user_page_json'][0]['data']['owner']['image_medium_url'];
                $pinterest_username        = $pinterest_data['user_page_json'][0]['data']['owner']['username'];
                $pinterest_profile         = $pinterest_data['user_page_json'][0]['data']['owner']['full_name'];
                $pinterest_board           = $pinterest_data['user_page_json'][0]['data']['name'];
                $pinterest_board_url       = $pinterest_data['user_page_json'][0]['data']['url'];
            }

            //check if board name is valid
            if ($pinterest_board == NULL) {
                return td_util::get_block_error('Pinterest', 'pinterest data error: Please check your board name' );
            }

            // pinterest followers
            $pinterest_followers = 0;
            if (isset($pinterest_data['user_page_json'][0]['data']['follower_count'])) {
                $pinterest_followers = $pinterest_data['user_page_json'][0]['data']['follower_count'];
            }

            // pinterest followers - check followers count data type
            $pinterest_followers_type = gettype($pinterest_followers);
            if ($pinterest_followers_type == 'string') {
                // retrieve number from string
                $number_from_string = self::get_number_from_string($pinterest_followers);
                if ($number_from_string !== false) {
                    $pinterest_followers = $number_from_string;
                } else {
                    td_log::log(__FILE__, __FUNCTION__, 'Pinterest data > followers is a string with no numbers included', $pinterest_followers);
                    $pinterest_followers = 0;
                }
            } elseif ($pinterest_followers_type == 'integer') {
                // do nothing, integer is ok
            } else {
                // for other types return 0
                td_log::log(__FILE__, __FUNCTION__, 'Pinterest data > followers has an unsupported type', $pinterest_followers);
                $pinterest_followers = 0;
            }

            // pinterest followers - format the followers number (the number is not rounded because it may return unrealistic values)
            if ($pinterest_followers >= 1000000) {
                // display 1.100.000 as 1.1m
                $pinterest_followers = number_format_i18n($pinterest_followers / 1000000, 1) . 'm';
            } elseif ($pinterest_followers >= 10000) {
                // display 10.100 as 10.1k
                $pinterest_followers = number_format_i18n($pinterest_followers / 1000, 1) . 'k';
            } else {
                // default
                $pinterest_followers = number_format_i18n($pinterest_followers);
            }


            ?>
            <!-- header section -->
            <?php

            if (empty($atts['pinterest_header'])) {
                ?>
                <div class="td-pinterest-header">
                    <div class="td-pinterest-profile-image"><img src="<?php echo $pinterest_profile_picture ?>"/></div>
                    <div class="td-pinterest-meta">
                        <div class="td-pinterest-user-meta">
                            <a href="https://www.pinterest.com/<?php echo $pinterest_username ?>" target="_blank" class="td-pinterest-user"><?php echo $pinterest_profile ?></a><a
                                href="https://www.pinterest.com<?php echo $pinterest_board_url ?>" target="_blank" class="td-pinterest-board"><?php echo $pinterest_board ?></a>
                        </div>
                        <div class="td-pinterest-followers"><span><?php echo $pinterest_followers . '</span> ' .  __td('Followers', TD_THEME_NAME); ?></div>
                        <!--<a class="td-pinterest-button" href="https://www.pinterest.com/<?php /*echo $pinterest_username */?>" target="_blank"><?php /*echo __td('Follow', TD_THEME_NAME); */?></a>-->                    <div class="clearfix"></div>
                    </div>
                </div>
                <?php
            }
            ?>

            <!-- user/board pins -->
            <div class="td-pinterest-main-wrap" <?php echo $board_inline_height ?>>
                <div class="td-pinterest-main <?php echo $board_columns_gap ?>" <?php echo $board_columns_number ?>>
                    <?php

                    if ( isset ($pinterest_data['user_page_json'][1]['data']["board_feed"]) ) {
                        //get the board pins feeds
                        $pinterest_board_feeds = $pinterest_data['user_page_json'][1]['data']["board_feed"];

                        if(!empty($pinterest_board_feeds) && is_array($pinterest_board_feeds)) {

                            //sort the feeds by date
                            usort($pinterest_board_feeds, 'td_pinterest::sort_pins_by_date' );

                            //reverse feeds array
                            $pinterest_board_feeds = array_reverse($pinterest_board_feeds);

                            //pins counter
                            $pins_count = 0;

                            foreach ($pinterest_board_feeds as $pin_data) {
                                if (isset($pin_data['images']) && isset($pin_data['id'])) {
                                    ?>
                                    <!-- pin no. <?php echo $pins_count+1; ?> -->
                                    <a class="td-pinterest-element" href="https://www.pinterest.com/pin/<?php echo $pin_data['id'] ?>/" target="_blank">
                                        <img class="td-pinterest-image" src="<?php echo $pin_data['images']['orig']['url'] ?>" height="<?php echo $pin_data['images']['orig']['height'] ?>" width="<?php echo $pin_data['images']['orig']['width'] ?>" />
                                    </a>
                                    <?php

                                    //number of pins to display
                                    $pins_count++;
                                    if ($pins_count == $board_pins_total_number) {
                                        break;
                                    }
                                }
                            }

                        } else {
                            return 'pinterest: no pins data or invalid data format';
                        }
                    }
                    ?>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php
        } else {
            return self::error('Render failed - the [user_page_json]>[data] array has not been received, please check the ID: ' . $atts['pinterest_id']);
//            echo'<pre>';
//            var_dump($pinterest_data['user_page_json'][0]['data']);
//            echo'</pre>';
        }

        return ob_get_clean();
    }

    /**
     * @param $str
     * @return bool|int
     * - bool: false - $str is not a string or we don't have a number
     * - integer - return the number
     */
    private static function get_number_from_string($str) {
        // no string received
        if (gettype($str) != 'string') {
            return false;
        }
        // retrieve the numbers
        $string_length = strlen($str);
        $id = '';
        for( $i = 0; $i <= $string_length; $i++ ) {
            $char = substr($str, $i, 1);
            if(is_numeric($char)) {
                $id .= $char;
            }
        }
        // we have a number
        if ($id != '') {
            return intval($id);
        }
        return false;
    }

    /**
     * @param $atts
     * @param $pinterest_data - the precomputed pinterest data
     * @return bool|string
     *  - bool:true - we have the $pinterest_data (from cache or from a real request)
     *  - string - error message
     */
    private static function get_pinterest_data($atts, &$pinterest_data) {

        $cache_key = 'td_pinterest_' . strtolower( $atts['pinterest_id'] );
        if ( td_remote_cache::is_expired(__CLASS__, $cache_key) === true ) {
            // cache is expired - do a request
            $pinterest_get_data = self::pinterest_get_html_data($atts, $pinterest_data);

            // check the call response
            if ($pinterest_get_data !== true) {
                // we have an error in the data retrieval process
                $pinterest_data = td_remote_cache::get(__CLASS__, $cache_key);
                if ($pinterest_data === false) {    // miss and io error... shit / die
                    //return self::error('pinterest data error: ' . $pinterest_get_data);
                    return td_util::get_block_error('Pinterest', 'pinterest data error: ' . $pinterest_get_data);
                }

                td_remote_cache::extend(__CLASS__, $cache_key, self::$caching_time);
                return 'pinterest_fail_cache';
            }

            //td_remote_cache::set(__CLASS__, $cache_key, $pinterest_data, self::$caching_time); //we have a reply and we set it
            return 'pinterest_cache_updated';

        } else {
            // cache is valid
            $pinterest_data = td_remote_cache::get(__CLASS__, $cache_key);
            return 'pinterest_cache';
        }
    }

    /**
     * @param $atts
     * @param $pinterest_data
     * @return bool|string
     * - bool: true on data retrieve success
     * - string - error message
     */
    private static function pinterest_get_html_data($atts, &$pinterest_data){

        $pinterest_html_data = self::get_pinterest_user_page_data($atts['pinterest_id']);

        if ($pinterest_html_data === false) {
            td_log::log(__FILE__, __FUNCTION__, 'pinterest html data cannot be retrieved', $atts['pinterest_id']);
            return 'pinterest html data cannot be retrieved';
        }

        $pinterest_json = json_decode($pinterest_html_data, true );
        if ($pinterest_json === null and json_last_error() !== JSON_ERROR_NONE) {
            td_log::log(__FILE__, __FUNCTION__, 'Error decoding the pinterest json', $pinterest_json);
            return 'Error decoding the pinterest json';
        }
//        echo '<pre>';
//        var_dump($pinterest_json);
//        echo '</pre>';
        // pinterest data is not set
        if (!isset($pinterest_json["resourceDataCache"][0]['data'])) {



            return 'pinterest data is not set, please check the ID';
        }

        if ( isset($pinterest_json["resourceDataCache"][0]['data']['type']) && $pinterest_json["resourceDataCache"][0]['data']['type'] !== 'board') {
            return 'Invalid pinterest data for  <code>' . $atts['pinterest_id'] . '</code> please check the <em>user/board_id</em>';
        }

        $pinterest_data['user_page_json'] = $pinterest_json["resourceDataCache"];

        return true;
    }

    /**
     * @param $pinterest_id
     * @return bool|string
     * - bool: false - no match was found, data not retrieved
     * - string - return the serialized data present in the page script
     */
    private static function get_pinterest_user_page_data($pinterest_id) {

        $data = td_remote_http::get_page('https://www.pinterest.com/' . $pinterest_id, __CLASS__);
        if ($data === false) {
            return false;
        }

        // get the serialized data string present in the page script
        $pattern = '/jsInit1\'>(.*)<\/script>/';

        preg_match_all($pattern, $data, $matches);


        if (!empty($matches[1]) && count($matches[1])) {
            return $matches[1][0];
        } else {
            return false;
        }

    }

    /**
     * Show an error if the user is logged in and is an admin
     * @param $msg
     * @return string
     */
    private static function error($msg) {

        //check for admin
        if (current_user_can( 'administrator' )) {
            // user is an admin
            if (is_user_logged_in()) {
                return $msg;
            }
        }
        return '';
    }

    /**
     * used by php's @usort() > @link http://php.net/manual/en/function.usort.php function to sort the pins array by date
     * usort() uses this information to sort the pins array.
     * @param $a - the pin record for comparison
     * @param $b - the pin record for comparison
     * @return int - 0 if both dates are equal,
     *             - a positive number if the first one ($a) is larger
     *             - or a negative value if the second argument ($b) is larger.
     */
    private static function sort_pins_by_date( $a, $b ) {
        return strtotime($a["created_at"]) - strtotime($b["created_at"]);
    }
}