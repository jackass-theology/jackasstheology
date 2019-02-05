<!-- LOGIN MODAL -->
<?php


if (td_util::get_option('tds_login_sign_in_widget') == 'show') {

    //check if admin allow registration
    $users_can_register = get_option('users_can_register');


    //add the Register tab to the modal window if `Anyone can register` check
    $users_can_register_link = '';
    $users_can_register_form = '';
    if($users_can_register == 1){
        $users_can_register_link = '<a id="register-link">' . __td('Create an account', TD_THEME_NAME) . '</a>';
        $users_can_register_form = '
                <div id="td-register-div" class="td-login-form-div td-display-none">
                    <div class="td-login-panel-title">' . __td('Create an account', TD_THEME_NAME) . '</div>
                    <div class="td-login-panel-descr">' . __td('Welcome! Register for an account', TD_THEME_NAME) .'</div>
                    <div class="td_display_err"></div>
                    <div class="td-login-inputs"><input class="td-login-input" type="text" name="register_email" id="register_email" value="" required><label>' . __td('your email', TD_THEME_NAME) .'</label></div>
                    <div class="td-login-inputs"><input class="td-login-input" type="text" name="register_user" id="register_user" value="" required><label>' . __td('your username', TD_THEME_NAME) .'</label></div>
                    <input type="button" name="register_button" id="register_button" class="wpb_button btn td-login-button" value="' . __td('Register', TD_THEME_NAME) . '">
                    <div class="td-login-info-text">' . __td('A password will be e-mailed to you.', TD_THEME_NAME) . '</div>
                    ' . get_the_privacy_policy_link('<div class="td-login-info-text">', '</div>') . '
                </div>';
    }




    echo '
                <div  id="login-form" class="white-popup-block mfp-hide mfp-with-anim">
                    <div class="td-login-wrap">
                        <a href="#" class="td-back-button"><i class="td-icon-modal-back"></i></a>
                        <div id="td-login-div" class="td-login-form-div td-display-block">
                            <div class="td-login-panel-title">' . __td('Sign in', TD_THEME_NAME) . '</div>
                            <div class="td-login-panel-descr">' . __td('Welcome! Log into your account', TD_THEME_NAME) . '</div>
                            <div class="td_display_err"></div>
                            <div class="td-login-inputs"><input class="td-login-input" type="text" name="login_email" id="login_email" value="" required><label>' . __td('your username', TD_THEME_NAME) . '</label></div>
	                        <div class="td-login-inputs"><input class="td-login-input" type="password" name="login_pass" id="login_pass" value="" required><label>' . __td('your password', TD_THEME_NAME) . '</label></div>
                            <input type="button" name="login_button" id="login_button" class="wpb_button btn td-login-button" value="' . __td('Login', TD_THEME_NAME) . '">
                            <div class="td-login-info-text"><a href="#" id="forgot-pass-link">' . __td('Forgot your password? Get help', TD_THEME_NAME) . '</a></div>
                            
                            
                            ' . $users_can_register_link . '
                            ' . get_the_privacy_policy_link('<div class="td-login-info-text">', '</div>') . '
                        </div>

                        ' . $users_can_register_form . '

                         <div id="td-forgot-pass-div" class="td-login-form-div td-display-none">
                            <div class="td-login-panel-title">' . __td('Password recovery', TD_THEME_NAME) . '</div>
                            <div class="td-login-panel-descr">' . __td('Recover your password', TD_THEME_NAME) . '</div>
                            <div class="td_display_err"></div>
                            <div class="td-login-inputs"><input class="td-login-input" type="text" name="forgot_email" id="forgot_email" value="" required><label>' . __td('your email', TD_THEME_NAME) . '</label></div>
                            <input type="button" name="forgot_button" id="forgot_button" class="wpb_button btn td-login-button" value="' . __td('Send My Password', TD_THEME_NAME) . '">
                            <div class="td-login-info-text">' . __td('A password will be e-mailed to you.', TD_THEME_NAME) . '</div>
                        </div>
                        
                        
                    </div>
                </div>
                ';
}