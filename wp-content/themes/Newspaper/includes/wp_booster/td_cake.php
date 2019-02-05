<?php

// - to reset the counter uncomment the 3 lines :
//td_util::update_option('td_cake_status_time', '');
//td_util::update_option('td_cake_status', '');
//td_util::update_option('td_cake_lp_status', '');
//die;

//echo td_util::get_option('td_cake_status');

/**
 * Class td_cake
 */

define ('TD_CAKE_THEME_VERSION_URL', 'http://td_cake.themesafe.com/td_cake/version.php');

class td_cake {


    /**
     * is running on each page load
     * || td_api_features::is_enabled('require_activation') === false
     */
    function __construct() {
        // not admin
        if ( !is_admin()) {
            return;
        }

        $td_cake_status_time = td_util::get_option_('td_cake_status_time');    // last time the status changed
        $td_cake_status = td_util::get_option_('td_cake_status');              // the current status time
        $td_cake_lp_status = td_util::get_option_('td_cake_lp_status');

        // verify if we have a status time, if we don't have one, the theme did not changed the status ever
        if (!empty($td_cake_status_time)) {


            // the time since the last status change
            $status_time_delta = time() - $td_cake_status_time;

            // late version check after 30
            if (TD_DEPLOY_MODE == 'dev') {
                $delta_max = 40;
            } else {
                $delta_max = 2592000;
            }

            if ($status_time_delta > $delta_max and $td_cake_lp_status != 'lp_sent') {
                td_util::update_option_('td_cake_lp_status', 'lp_sent');
                //$td_theme_version = @wp_remote_get(TD_CAKE_THEME_VERSION_URL . '?cs=' . $td_cake_status . '&lp=true&v=' . TD_THEME_VERSION . '&n=' . TD_THEME_NAME, array('blocking' => false));
                return;
            }

            // the theme is registered, return
            if ($td_cake_status == 2) {
                return;
            }

            // add the menu
            add_action('admin_menu', array($this, 'td_cake_register_panel'), 11);


            if (TD_DEPLOY_MODE == 'dev') {
                $delta_max = 40;
            } else {
                $delta_max = 1209600; // 14 days
            }
            if ($status_time_delta > $delta_max) {
                add_action( 'admin_notices', array($this, 'td_cake_msg_2') );
                if ($td_cake_status != '4') {
                    td_util::update_option_('td_cake_status', '4');
                }
                return;
            }

            if (TD_DEPLOY_MODE == 'dev') {
                $delta_max = 20;
            } else {
                $delta_max = 604800; // 7 days
            }
            if ($status_time_delta > $delta_max) {
                add_action( 'admin_notices', array($this, 'td_cake_msg') );
                if ($td_cake_status != '3') {
                    td_util::update_option_('td_cake_status', '3');
                }
                return;
            }

            // if some time passed and status is empty - do ping
            if ($status_time_delta > 0 and empty($td_cake_status)) {
                td_util::update_option_('td_cake_status_time', time());
                td_util::update_option_('td_cake_status', '1');
                //$td_theme_version = @wp_remote_get(TD_CAKE_THEME_VERSION_URL . '?v=' . TD_THEME_VERSION . '&n=' . TD_THEME_NAME, array('blocking' => false)); // check for updates
                return;
            }

        } else {
            // update the status time first time - we do nothing
            td_util::update_option_('td_cake_status_time', time());
            // add the menu
            add_action('admin_menu', array($this, 'td_cake_register_panel'), 11);
        }

    }

    function td_footer_manual_activation($text) {
        //add manual activation button
        $text .= '<a href="#" class="td-manual-activation-btn">Activate the theme manually</a>';
        //add auto activation button
        $text .= '<a href="#" class="td-auto-activation-btn" style="display: none;">Back to automatic activation</a>';
        //button script
        $text .= '<script type="text/javascript">
                    //manual activation
                    jQuery(\'.td-manual-activation-btn\').click(function(event){
                        event.preventDefault();
                        jQuery(\'.td-manual-activation\').css(\'display\', \'block\');
                        //hide manual activation button
                        jQuery(this).hide();
                        //hide auto activation panel
                        jQuery(\'.td-auto-activation\').hide();
                        //display back to automatic activation button
                        jQuery(\'.td-auto-activation-btn\').show();
                    });
                        
                    //automatic activation
                    jQuery(\'.td-auto-activation-btn\').click(function(event){
                        event.preventDefault();
                        jQuery(\'.td-manual-activation\').css(\'display\', \'none\');
                        //hide back to automatic activation button
                        jQuery(this).hide();
                        //show auto activation panel
                        jQuery(\'.td-auto-activation\').show();
                        //display manual activation button
                        jQuery(\'.td-manual-activation-btn\').show();
                    });
                 </script>';
        echo $text;
    }

    private function td_cake_server_id() {
        ob_start();
        phpinfo(INFO_GENERAL);
        echo TD_THEME_NAME;
        return md5(ob_get_clean());
    }

    private function syntax_check() {
        $key = td_util::get_option('envato_key');
        $key = preg_replace('#([a-z0-9]{8})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{4})-?([a-z0-9]{12})#','$1-$2-$3-$4-$5',strtolower($key));
        if (strlen($key) == 36){
            return true;
        }
        return false;
    }


    private function td_cake_manual($s_id, $e_id, $t_id) {
        if (md5($s_id . $e_id) == $t_id) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * the cake panel t
     */

    function td_cake_register_panel() {
        if (td_api_features::is_enabled('require_activation') === true) {
            add_submenu_page( "td_theme_welcome", 'Activate theme', 'Activate theme', "edit_posts", 'td_cake_panel', array(
                $this,
                'td_cake_panel'
            ), null );
        }

    }

	/**
	 * show the activate theme panel
	 */
    function td_cake_panel() {

        // add manual activation link (visible only on this page)
        add_filter('admin_footer_text', array($this, 'td_footer_manual_activation'));

        ?>
        <style type="text/css">
            .updated, .error {
                display: none !important;
            }
        </style>

        <div class="td-activate-page-wrap">

            <?php require_once "wp-admin/panel/td_view_header.php"; ?>

            <div class="about-wrap td-admin-wrap">

                <div class="td-activate-wrap">
                    <!-- Auto activation -->
                    <div class="td-auto-activation">

                        <!-- Step 1 - Envato Code -->
                        <div class="td-activate-section td-activate-envato-code">

                            <div class="td-activate-subtitle">Activate <?php echo TD_THEME_NAME ?></div>

                            <p class="td-activate-description">
                                Activate <?php echo TD_THEME_NAME ?> WordPress Theme to enjoy the full benefits of a great product. Add your code to get access to the knowledge base, video tutorials, a community of amazing people passionate about WordPress and our outstanding customer support center.
                            </p>

                            <div class="td-activate-input-wrap td-envato-code">
                                <div class="td-input-title">Envato purchase code:</div>
                                <input type="text" name="td-envato-code" value="" placeholder="Your Envato code"/>
                                <span class="td-activate-input-bar"></span>
                                <span class="td-activate-err td-envato-missing" style="display:none;">Code is required</span>
                                <span class="td-activate-err td-envato-length" style="display:none;">Code is too short</span>
                                <span class="td-activate-err td-envato-invalid" style="display:none;">Code is not valid</span>
                                <span class="td-activate-err td-envato-check-error" style="display:none;">Envato API is down, please try again later or use the manual registration.</span>
                            </div>


                            <button class="td-activate-button td-envato-code-button">Activate</button>
                            <div class="td-envato-code-info"><a href="http://forum.tagdiv.com/how-to-find-your-envato-purchase-code/" target="_blank">Find your Envato code</a></div>
                        </div>

                        <!-- Step 2 - Forum Registration -->
                        <div class="td-activate-section td-activate-registration" style="display: none;">

                            <div class="td-activate-subtitle">Create your Forum Support Account</div>

                            <p class="td-activate-description">
                                You’re almost there! Fill the form to create your forum account, and you are ready to access a community of amazing people passionate about WordPress and our outstanding customer support center.
                            </p>

                            <div class="td-registration-err td-forum-connection-failed" style="display:none;">Forum connection failed, please try again.</div>

                            <!-- Username -->
                            <div class="td-activate-input-wrap td-activate-username">
                                <div class="td-input-title">Username:</div>
                                <input type="text" name="td-activate-username" value="" placeholder="Username" />
                                <span class="td-activate-input-bar"></span>
                                <span class="td-activate-err td-activate-username-missing" style="display:none;">Username is required</span>
                                <span class="td-activate-err td-activate-username-used" style="display:none;">Current username is already used, try another one</span>
                            </div>

                            <!-- Email -->
                            <div class="td-activate-input-wrap td-activate-email">
                                <div class="td-input-title">Your Email:</div>
                                <input type="text" name="td-activate-email" value="" placeholder="Email" />
                                <span class="td-activate-input-bar"></span>
                                <span class="td-activate-err td-activate-email-missing" style="display:none;">Email is required</span>
                                <span class="td-activate-err td-activate-email-syntax" style="display:none;">Email syntax is incorrect</span>
                                <span class="td-activate-err td-activate-email-used" style="display:none;">Current email is registered with another account</span>
                                <div class="td-small-bottom">The email is private and we will not share it with anyone.</div>
                            </div>

                            <!-- Password -->
                            <div class="td-activate-input-wrap td-activate-password">
                                <div class="td-input-title">Password:</div>
                                <input type="password" name="td-activate-password" autocomplete="off" value="" placeholder="Password" />
                                <span class="td-activate-input-bar"></span>
                                <span class="td-activate-err td-activate-password-missing" style="display:none;">Password is required</span>
                                <span class="td-activate-err td-activate-password-length" style="display:none;">Minimum password length is 6 characters</span>
                            </div>

                            <!-- Password Confirmation -->
                            <div class="td-activate-input-wrap td-activate-password-confirmation">
                                <div class="td-input-title">Password confirmation:</div>
                                <input type="password" name="td-activate-password-confirmation" autocomplete="off" value="" placeholder="Password confirmation" />
                                <span class="td-activate-input-bar"></span>
                                <span class="td-activate-err td-activate-password-confirmation-missing" style="display:none;">Password confirmation is required</span>
                                <span class="td-activate-err td-activate-password-mismatch" style="display:none;">Password and password confirmation don't match</span>
                            </div>

                            <button class="td-activate-button td-registration-button">Create Account</button>
                            <div class="td-activate-info"><a href="http://forum.tagdiv.com/privacy-policy-2/" target="_blank">Privacy policy</a></div>
                        </div>
                    </div>


                    <!-- Manual activation -->
                    <div class="td-manual-activation">
                        <div class="td-activate-subtitle">Manual activation</div>

                        <div class="td-registration-err td-manual-activation-failed" style="display:none;">Manual activation failed, check each field and try again.</div>

                        <div class="td-manual-info">
                            <ol>
                                <li>Go to our <a href="http://tagdiv.com/td_cake/manual.php" target="_blank">manual activation page</a></li>
                                <li>Paste your <em>Server ID</em> there and the <a href="http://forum.tagdiv.com/how-to-find-your-envato-purchase-code/" target="_blank">Envato purchase code</a></li>
                                <li>Return with the <a href="http://forum.tagdiv.com/wp-content/uploads/2014/09/2014-09-09_1458.png" target="_blank">activation key</a> and paste it in this form</li>
                            </ol>
                        </div>


                        <!-- Your server ID -->
                        <div class="td-activate-input-wrap td-manual-server-id">
                            <div class="td-input-title">Your server ID:</div>
                            <input type="text" name="td-manual-server-id" value="<?php echo $this->td_cake_server_id();?>" readonly/>
                            <span class="td-activate-input-bar"></span>
                            <div class="td-small-bottom">Copy this id and paste it in our manual activation page</div>
                        </div>

                        <!-- Envato code -->
                        <div class="td-activate-input-wrap td-manual-envato-code">
                            <div class="td-input-title">Envato purchase code:</div>
                            <input type="text" name="td-manual-envato-code" value="" placeholder="Envato purcahse code" />
                            <span class="td-activate-input-bar"></span>
                            <span class="td-activate-err td-manual-envato-code-missing" style="display:none;">Envato code is required</span>
                        </div>

                        <!-- Activation key -->
                        <div class="td-activate-input-wrap td-manual-activation-key">
                            <div class="td-input-title">tagDiv activation key:</div>
                            <input type="text" name="td-manual-activation-key" value="" placeholder="Activation key" />
                            <span class="td-activate-input-bar"></span>
                            <span class="td-activate-err td-manual-activation-key-missing" style="display:none;">Activation key is required</span>
                        </div>

                        <button class="td-activate-button td-manual-activate-button">Activate</button>

                    </div>

                </div>



                <!--            <form method="post" action="admin.php?page=td_cake_panel">-->
                <!---->
                <!--	            <input type="hidden" name="td_magic_token" value="--><?php //echo wp_create_nonce("td-validate-license") ?><!--"/>-->
                <!---->
                <!--                <table class="form-table">-->
                <!--                    <tr valign="top">-->
                <!--                        <th scope="row">Envato purchase code:</th>-->
                <!--                        <td>-->
                <!--                            <input style="width: 400px" type="text" name="td_envato_code" value="--><?php //echo $td_envato_code; ?><!--" />-->
                <!--                            <br/>-->
                <!--                            <div class="td-small-bottom"><a href="http://forum.tagdiv.com/how-to-find-your-envato-purchase-code/" target="_blank">Where to find your purchase code ?</a></div>-->
                <!--                        </td>-->
                <!--                    </tr>-->
                <!---->
                <!---->
                <!---->
                <!--                </table>-->
                <!---->
                <!--                <input type="hidden" name="td_active" value="auto">-->
                <!--                --><?php //submit_button('Activate theme'); ?>
                <!---->
                <!--            </form>-->

            </div>
        </div>


    <?php
    }


    // all admin pages that begin with td_ do now show the message
    private function check_if_is_our_page() {
        if (isset($_GET['page']) and substr($_GET['page'], 0, 3) == 'td_') {
            return true;
        }
        return false;
    }



    function td_cake_msg() {
        if ($this->check_if_is_our_page() === true || td_api_features::is_enabled('require_activation') === false) {
            return;
        }
        ?>
        <div class="error">
            <p><?php echo '<strong style="color:red"> Please activate the theme! </strong> - <a href="' . wp_nonce_url( admin_url( 'admin.php?page=td_cake_panel' ) ) . '">Click here to enter your code</a> - if this is an error please contact us at contact@tagdiv.com - <a href="http://forum.tagdiv.com/how-to-activate-the-theme/">How to activate the theme</a>'; ?></p>
        </div>
    <?php
    }


    function td_cake_msg_2() {
        if ($this->check_if_is_our_page() === true || td_api_features::is_enabled('require_activation') === false) {
            return;
        }
        ?>
        <div class="error">
            <p>
                Activate <?php echo TD_THEME_NAME ?> to enjoy the full benefits of the theme. We're sorry about this extra step but we built the activation system to prevent
                mass piracy of our themes, this allows us to better serve our paying customers.

                <strong>An active theme comes with free updates, top notch support, guaranteed latest WordPress support</strong>.

            </p>
            <p><?php echo '<strong style="color:red"> Please activate the theme! </strong> - <a href="' . wp_nonce_url( admin_url( 'admin.php?page=td_cake_panel' ) ) . '">Click here to enter your code</a> - if this is an error please contact us at contact@tagdiv.com - <a href="http://forum.tagdiv.com/how-to-activate-the-theme/">How to activate the theme</a>'; ?></p>
        </div>
    <?php
    }
}



class td_check_version {
	private $cron_task_name = 'td_check_version';


	function __construct()
    {
        add_action('td_wp_booster_loaded', array($this, '_compare_theme_versions'));

        add_action($this->cron_task_name, array($this, '_check_for_updates'));

        add_filter( 'cron_schedules', array($this, '_schedule_modify_add_three_days') );

        if (wp_next_scheduled($this->cron_task_name) === false) {
            wp_schedule_event(time(), 'three_days', $this->cron_task_name);
        }

        add_action('switch_theme', array($this, 'on_switch_theme_remove_cron'));

    }


    /**
     * connect to api server and check if a new version is available
     */
	function _check_for_updates() {
        // default base currency is eur and it returns all rates
        $api_url = 'http://td_cake.tagdiv.com/td_cake/get_current_version.php?n=' . TD_THEME_NAME . '&v=' . TD_THEME_VERSION;
        $json_api_response = td_remote_http::get_page($api_url, __CLASS__);

        // check for a response
        if ($json_api_response === false) {
            td_log::log(__FILE__, __FUNCTION__, 'Api call failed', $api_url);
        }

        // try to decode the json
        $api_response = @json_decode($json_api_response, true);
        if ($api_response === null and json_last_error() !== JSON_ERROR_NONE) {
            td_log::log(__FILE__, __FUNCTION__, 'Error decoding the json', $api_response);
        }

	    //valid response
        if (!empty($api_response['version']) && !empty($api_response['update_url'])) {
            td_util::update_option('td_latest_version', $api_response['version']);
            td_util::update_option('td_update_url', $api_response['update_url']);
        }
	}


    /**
     * compare current version with latest version
     */
	function _compare_theme_versions() {
        $td_theme_version = TD_THEME_VERSION;

        //don't run on deploy
        if ($td_theme_version == '__td_deploy_version__') {
            return;
        }

	    $td_latest_version = td_util::get_option('td_latest_version');
        //latest version is not set
        if (empty($td_latest_version)) {
            return;
        }

        $td_update_url = td_util::get_option('td_update_url');
        //update url is not set
        if (empty($td_update_url)) {
            return;
        }

        //compare theme's current version with the official version
        $compare_versions = version_compare($td_theme_version, $td_latest_version, '<');

        if ($compare_versions === true) {
            //update is available - add variables used by td_theme_update js function
            td_js_buffer::add_to_wp_admin_footer('var tdUpdateAvailable = "' . $td_latest_version . '";');
            td_js_buffer::add_to_wp_admin_footer('var tdUpdateUrl = "' . $td_update_url . '";');
        }
    }


    /**
     * on switch theme remove wp cron task
     */
    function on_switch_theme_remove_cron() {
        wp_clear_scheduled_hook($this->cron_task_name);
    }


    /**
     * @param $schedules
     * @return mixed
     */
	function _schedule_modify_add_three_days( $schedules ) {
		$schedules['three_days'] = array(
			'interval' => 259200, // 3 days in seconds
			'display' => 'three_days'
		);
		return $schedules;

	}
}

//execute only if the updates flag is enabled
if (td_api_features::is_enabled('check_for_updates')) {
    //new td_check_version();
}

//new td_cake();
