<?php
/*  Copyright 2013-2017 Renzo Johnson (email: renzojohnson at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


function mce_error() {

  if( !file_exists(WP_PLUGIN_DIR.'/contact-form-7/wp-contact-form-7.php') ) {

    $mce_error_out = '<div id="message" class="error is-dismissible"><p>';
    $mce_error_out .= __('The Contact Form 7 plugin must be installed for the <b>MailChimp Extension</b> to work. <b><a href="'.admin_url('plugin-install.php?tab=plugin-information&plugin=contact-form-7&from=plugins&TB_iframe=true&width=600&height=550').'" class="thickbox" title="Contact Form 7">Install Contact Form 7  Now.</a></b>', 'mce_error');
    $mce_error_out .= '</p></div>';
    echo $mce_error_out;

  } else if ( !class_exists( 'WPCF7') ) {

    $mce_error_out = '<div id="message" class="error is-dismissible"><p>';
    $mce_error_out .= __('The Contact Form 7 is installed, but <strong>you must activate Contact Form 7</strong> below for the <b>MailChimp Extension</b> to work.','mce_error');
    $mce_error_out .= '</p></div>';
    echo $mce_error_out;

  }

}
add_action('admin_notices', 'mce_error');


function mce_act_redirect( $plugin ) {

  if( $plugin == SPARTAN_MCE_PLUGIN_BASENAME ) {
    mce_save_date_activation();
    exit( wp_redirect( admin_url( 'admin.php?page=wpcf7&post='.mc_get_latest_item().'&active-tab=4' ) ) );

  }

}
add_action( 'activated_plugin', 'mce_act_redirect' );



function mce_save_date_activation() {
  $option_name = 'mce_loyalty' ;
  $new_value = getdate() ;

  $valorvar = get_option( $option_name );

  if ( $valorvar !== false ) {

    if (empty($valorvar)) {
        update_option( $option_name, $new_value );
    }

  } else {

      $deprecated = null;
      $autoload = 'no';
      add_option( $option_name, $new_value, $deprecated, $autoload );
  }

}



function mce_difer_dateact_date() {
  $option_name = 'mce_loyalty' ;
  $today = getdate() ;
  mce_save_date_activation();

  $date_act = get_option( $option_name );

  $datetime_ini = new DateTime("now");
  $datetime_fin = new DateTime($date_act['year'].'-'.$date_act['mon'].'-'.$date_act['wday']);

  $fechaF = date_diff($datetime_ini,$datetime_fin);


  if ($fechaF->y > 0 ) {
     if ($fechaF->m > 0 ) {
        $differenceFormat = '%y Years %m Months %d Days ';
     } else {
       $differenceFormat = '%y Years %d Days ';
     }
  } else {
    if ($fechaF->m > 0 ) {
        $differenceFormat = '%m Months %d Days ';
     } else {
       $differenceFormat = '%d Days ';
     }
  }

  $resultf = $fechaF->format($differenceFormat);


  return $resultf;

}



if (get_site_option('mce_show_notice') == 1){

  function mce_show_update_notice() {

    if(!current_user_can( 'manage_options')) return;

    $class = 'notice is-dismissible vc-notice welcome-panel';

    $message = '<h2>'.esc_html__('MailChimp Extension has been improved!', 'mail-chimp-extension').'</h2>';
    $message .= '<p class="about-description">'.esc_html__('We worked hard to make it more reliable, faster, and now with a better Debugger, and more help documents.', 'mail-chimp-extension').'</p>';


    $message .= sprintf(__('<div class="welcome-panel-column-container"><div class="welcome-panel-column"><h3>Get Started</h3><p>Make sure it works as you expect <br><a class="button button-primary button-hero load-customize" href="%s">Review your settings <span alt="f111" class="dashicons dashicons-admin-generic" style="font-size: 17px;vertical-align: middle;"> </span> </a>', 'mail-chimp-extension'), MCE_SETT ).'</p></div>';


    $message .= '<div class="welcome-panel-column"><h3>Next Steps</h3><p>'.__('Help me develop the plugin and provide support by <br><a class="donate button button-primary button-hero load-customize" href="' . MCE_DON . '" target="_blank">Donating even a small sum <span alt="f524" class="dashicons dashicons-tickets-alt"> </span></a>', 'mail-chimp-extension').'</p></div></div>';

    global $wp_version;

    if( version_compare($wp_version, '4.2') < 0 ){

      $message .= ' | <a id="mce-dismiss-notice" href="javascript:mce_dismiss_notice();">'.__('Dismiss this notice.').'</a>';

    }
    echo '<div id="mce-notice" class="'.$class.'"><div class="welcome-panel-content">'.$message. '</div></div>';
    echo "<script>
        function mce_dismiss_notice(){
          var data = {
          'action': 'mce_dismiss_notice',
          };

          jQuery.post(ajaxurl, data, function(response) {
            jQuery('#mce-notice').hide();
          });
        }

        jQuery(document).ready(function(){
          jQuery('body').on('click', '.notice-dismiss', function(){
            mce_dismiss_notice();
          });
        });
        </script>";
  }

  if(is_multisite()){

    add_action( 'network_admin_notices', 'mce_show_update_notice' );

  } else {

    add_action( 'admin_notices', 'mce_show_update_notice' );

  }
  add_action( 'wp_ajax_mce_dismiss_notice', 'mce_dismiss_notice' );

  function mce_dismiss_notice() {

    $result = update_site_option('mce_show_notice', 0);
    return $result;
    wp_die();
  }

}



function mce_help() {

  if (get_site_option('mce_show_notice') == NULL){
    update_site_option('mce_show_notice', true);
  }

}

