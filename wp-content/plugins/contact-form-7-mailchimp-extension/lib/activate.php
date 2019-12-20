<?php
/*  Copyright 2013-2019 Renzo Johnson (email: renzojohnson at gmail.com)

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

    $respanalitc = vc_ga_send_event('Mailchimp Extension', 'ACTIVATED', 'No Installed CF7') ;

		include SPARTAN_MCE_PLUGIN_DIR . '/lib/action.php' ;
		//plugin_activation('contact-form-7/wp-contact-form-7.php');
		wp_cache_flush();

		/*
    deactivate_plugins( plugin_basename( WP_PLUGIN_DIR.'/contact-form-7-mailchimp-extension/cf7-mch-ext.php' ) );

    $mce_error_out = '<div id="message" class="error is-dismissible"><p>';
    $mce_error_out .= __('The Contact Form 7 plugin must be installed for the <b>MailChimp Extension</b> to work. <b><a href="'.admin_url('plugin-install.php?tab=plugin-information&plugin=contact-form-7&from=plugins&TB_iframe=true&width=600&height=550').'" class="thickbox" title="Contact Form 7">Install Contact Form 7  Now.</a></b>', 'mce_error');
    $mce_error_out .= '</p></div>';
    echo $mce_error_out; */

  } else if ( !class_exists( 'WPCF7') ) {
    //__FILE__

    plugin_activation('contact-form-7/wp-contact-form-7.php');

    $respanalitc = vc_ga_send_event('Mailchimp Extension', 'ACTIVATED', 'Full Activated');

    //deactivate_plugins( plugin_basename( WP_PLUGIN_DIR.'/contact-form-7-mailchimp-extension/cf7-mch-ext.php' ) );
   /* $mce_error_out = '<div id="message" class="error is-dismissible"><p>';
    $mce_error_out .= __('The Contact Form 7 is installed, but <strong>you must activate Contact Form 7  </strong> below for the <b>MailChimp Extension</b> to work. ','mce_error');
    $mce_error_out .= '</p></div>';
    echo $mce_error_out; */

  }

}
add_action('admin_notices', 'mce_error');


function mce_act_redirect( $plugin ) {

    if ( !class_exists( 'WPCF7') ) {

     }
    else {
        if( $plugin == SPARTAN_MCE_PLUGIN_BASENAME ) {
            $respanalitc = vc_ga_send_event('Mailchimp Extension', 'ACTIVATED', 'Full Activated');
            mce_save_date_activation();
            mce_save_plugginid () ;

         }
    }


   // $resppageview = wpcf7_mce_ga_pageview ();

}
//add_action( 'activated_plugin', 'mce_act_redirect' );


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


function mce_save_plugginid () {

  $prefij = 'mce_' . get_bloginfo( 'version' ) . '_'. ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) .'-St-'.get_option( 'mce_sent', 0 ).'-';

  $plugginid =  uniqid($prefij,true) ;

  if ( get_option( 'wpcf7-mailchimp_ffcpplugginid' ) !== false ) {
      $plugginid = get_option( 'wpcf7-mailchimp_ffcpplugginid','No found' ) ;
	} else {
		$deprecated = null;
		$autoload = 'no';
		add_option( 'wpcf7-mailchimp_ffcpplugginid',$plugginid, $deprecated, $autoload );
	}
  $resp = mce_post_systeminfo ( $plugginid,2 ) ;

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

function mce_diferdays_dateact_date() {
  $option_name = 'mce_loyalty' ;
  $today = getdate() ;
  mce_save_date_activation();

  $date_act = get_option( $option_name );

  $datetime_ini = new DateTime("now");
  $datetime_fin = new DateTime($date_act['year'].'-'.$date_act['mon'].'-'.$date_act['wday']);

  $fechaF = date_diff($datetime_ini,$datetime_fin);

  $resultf = $fechaF->format('%a');
  return $resultf;
}




if (get_site_option('mce_show_notice') == 1) {

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

    if( is_multisite() ){

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


function mce_news_notices () {

  $class = 'notice is-dismissible vc-notice welcome-panel';
  $check = 0 ;
  $tittle = '' ;
  //$message = mce_get_postnotice ($check,$tittle ) ;

    $Defaulttittle = 'ChimpMatic Lite is now 0.5!' ;
    $Defaultpanel = '<p class="about-description">Easier setup to get you up and running in no time. Please <a href="https://renzojohnson.com/contact" target="_blank" rel="noopener noreferrer">lets us know</a> what kind of features you would like to see added <a href="https://renzojohnson.com/contact" target="_blank" rel="noopener noreferrer">HERE</a></p>
<div class="welcome-panel-column-container">
<div class="welcome-panel-column">
<h3>Get Started</h3>
<p>Make sure it works as you expect <br><a class="button button-primary button-hero load-customize" href="/wp-admin/admin.php?page=wpcf7&amp;post=8&amp;active-tab=4">Review your settings <span alt="f111" class="dashicons dashicons-admin-generic" style="font-size: 17px;vertical-align: middle;"> </span> </a></p>
</div>
<div class="welcome-panel-column">
<h3>Next Steps</h3>
<p>Help me develop the plugin and provide support by <br><a class="donate button button-primary button-hero load-customize" href="https://www.paypal.me/renzojohnson" target="_blank" rel="noopener noreferrer">Donating even a small sum <span alt="f524" class="dashicons dashicons-tickets-alt"> </span></a></p>
</div>
</div>' ;

  $banner = $Defaultpanel ;
  $tittle = $Defaulttittle ;
   //delete_site_option('mce_conten_panel_lateralbanner');

   if ( get_site_option('mce_conten_panel_master') == null  ) {
      add_site_option( 'mce_conten_panel_master', $Defaultpanel ) ;
      add_site_option( 'mce_conten_tittle_master', $Defaulttittle ) ;
      $banner = $Defaultpanel ;
      $tittle = $Defaulttittle ;
   }
    else  {
      $grabbanner = trim( get_site_option('mce_conten_panel_master') ) ;
      $grabtittle = trim( get_site_option('mce_conten_tittle_master') ) ;

      $banner = ( $grabbanner  == ''  ) ? $Defaultpanel : $grabbanner ;
      $tittle = ( $grabtittle  == ''  ) ? $Defaulttittle : $grabtittle ;

    }


  $tittle2 = '<h2>'.$tittle.'</h2>';
  $message2 = $tittle2.$banner ;

  echo '<div id="mce-notice" class="'.$class.'"><div class="welcome-panel-content">'.$message2.'</div></div>';

  echo "<script>
        function mce_dismiss_update_news(){
          var data = {
          'action': 'mce_dismiss_update_news',
          };

          jQuery.post(ajaxurl, data, function(response) {
            jQuery('#mce-notice').hide();
          });
        }

        jQuery(document).ready(function(){
          jQuery('body').on('click', '.notice-dismiss', function(){

            mce_dismiss_update_news();
          });
        });
        </script>";

}


function mce_dismiss_update_news() {

  $result = update_site_option('mce_show_update_news', 0);

  wp_die();

}
add_action( 'wp_ajax_mce_dismiss_update_news', 'mce_dismiss_update_news' );


if (  (  get_site_option('mce_show_update_news') == null )  or get_site_option('mce_show_update_news') == 1 ){

    if (   get_site_option('mce_show_update_news') == null  ) add_site_option( 'mce_show_update_news', 1 ) ;

    if( is_multisite() ){

          add_action( 'network_admin_notices', 'mce_news_notices' );
        } else {

          add_action( 'admin_notices', 'mce_news_notices' );
        }

}



function mce_get_postnotice (&$check,&$tittle) {

    $check = 0 ;
    $response = wp_remote_get( 'https://renzojohnson.com/wp-json/wp/v2/posts?categories=15&orderby=modified&order=desc' );

    if ( is_wp_error( $response ) ) {
      $check = -1;
      return '';
    }

    $posts = json_decode( wp_remote_retrieve_body( $response ) );

    if ( empty( $posts ) or is_null ( $posts  ) ) {
        $check = -2;
		    return ''  ;
	  }

  if ( $response["response"]["code"] != 200 ) {
      $check = -3;
		  return ''  ;
  }


	if ( ! empty( $posts ) ) {
		  foreach ( $posts as $post ) {
			    $fordate =  $post->modified  ;

          $post_id = get_option( 'wpcf7-mce-post-id',0 )   ;
          $post_update =  get_option( 'wpcf7-mce-post-update',0 ) ;

          if ( get_option( 'wpcf7-mce-post-id' ) == false ) {
            $deprecated = null;
            $autoload = 'no';
            add_option( 'wpcf7-mce-post-id',$post->id, $deprecated, $autoload );
          } else update_option( 'wpcf7-mce-post-id', $post->id );

          if ( get_option( 'wpcf7-mce-post-update' ) !== false ) {
	             update_option( 'wpcf7-mce-post-update', $fordate );

          } else {
            $deprecated = null;
            $autoload = 'no';
            add_option( 'wpcf7-mce-post-update',$fordate , $deprecated, $autoload );
          }

          if ( $post_id == 0 )  {
              $check = 1 ;

             }
          else {
              if ( $post->id == $post_id  ) {
                    if ( $fordate !== $post_update )  {
                        $check = 1 ;

                     }
                    else {
                         $check = 0 ;

                    }
              } else {
                 $check = 1 ;

              }
          }

        $tittle = $post->title->rendered ;
        return $post->content->rendered ;

		  }
	}

}




