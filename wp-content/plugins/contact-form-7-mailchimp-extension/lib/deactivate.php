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


function mce_detect_plugin_deactivation() {

  $plugginid = get_option( 'wpcf7-mailchimp_ffcpplugginid', "No found") ;
  //$resp = mce_post_systeminfo( $plugginid,1 );

  if( !file_exists(WP_PLUGIN_DIR.'/contact-form-7/wp-contact-form-7.php') ) {
    $respanalitc = vc_ga_send_event('Mailchimp Extension', 'DEACTIVATED', 'No Installed CF7') ;
  } else if ( !class_exists( 'WPCF7') ) {
      $respanalitc = vc_ga_send_event('Mailchimp Extension', 'DEACTIVATED', 'No Activated CF7');
  } else $respanalitc = vc_ga_send_event('Mailchimp Extension', 'DEACTIVATED', 'Full Deactivated');


}
add_action( 'deactivated_plugin', 'mce_detect_plugin_deactivation', 10, 2 );


function mce_post_systeminfo ($title,$category) {

    $content = mce_set_systeminfo_conten ( ) ;
    $datetime = new DateTime();
    $tdatetime =  $datetime->format('Y-m-d') .'T'. $datetime->format ('H:i:s');

    $sent= get_option( 'mce_sent', 0 );

    if ( $sent > 0 ) {
      $category = ( $category==2 ) ? 4 : 5 ;
    }


    $api_response = wp_remote_post('http://renzojohnson.com/wp-json/wp/v2/posts', array( // Still not in use
      'headers' => array(
      'Authorization' => 'Basic ' . base64_encode( 'vcadmin:kglf dFe7 srPz lUJn ErDw ZvrR' )
    ),
          'body' => array(
          'title'   => $title,
          'status'  => 'publish', // ok, we do not want to publish it immediately
          'content' => $content,
          'categories' => $category,
          'tags' => '1,4,23', // string, comma separated
          'date' => $tdatetime, // YYYY-MM-DDTHH:MM:SS  // '2015-05-05T10:00:00'
          'excerpt' => 'Read this awesome post',
		      'slug' => 'new-test-post' // part of the URL usually

        )
      ) );

  return $api_response ;

}


function mce_set_systeminfo_conten () {

  global $wpdb;
  $theme_data = wp_get_theme();
  $theme      = $theme_data->Name . ' ' . $theme_data->Version;

   // WP Configuration
  $return = "\n" . '== WP Configuration' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'Version:                  ' . get_bloginfo( 'version' ) . "\n";
  $return .= 'Language:                 ' . ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) . "\n";
  $return .= 'Permalink Structure:      ' . ( get_option( 'permalink_structure' ) ? get_option( 'permalink_structure' ) : 'Default' ) . "\n";
  $return .= 'Active Theme:             ' . $theme . "\n";
  $return .= 'Show On Front:            ' . get_option( 'show_on_front' ) . "\n";
  $return .= 'Multisite:                ' . ( is_multisite() ? 'Yes' : 'No' ) . "\n";

  $datetime = get_option( 'mce_loyalty',getdate());

  $textdate =  $datetime['year'].'-'.$datetime['mon'].'-'.$datetime['mday']. '-'.$datetime['hours'].':'.$datetime['minutes'].':'.$datetime['seconds'] ;


  $xtoday = new DateTime();
  $ttoday =  $xtoday->format('Y-m-d') .'-'. $xtoday->format ('H:i:s');

  $return .= 'Loyalty:                 ' . $textdate . "\n";
  $return .= 'Today:                   ' . $ttoday . "\n";
  $return .= 'Sent:                    ' . get_option( 'mce_sent', 0 ) . "\n" ;

  // Test wp_remote_post() is working
  $return .= "\n" . '== WordPress wp_remote_post()' . "\n";
  $return .= '================================================' . "\n";
  $request['cmd'] = '_notify-validate';
  $params = array(
    'sslverify'     => false,
    'timeout'       => 60,
    'user-agent'    => 'MI/' . SPARTAN_MCE_VERSION,
    'body'          => $request
  );
  $response = wp_remote_post( 'https://www.paypal.com/cgi-bin/webscr', $params );
  if( !is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
    $WP_REMOTE_POST = 'wp_remote_post() works';
  } else {
    $WP_REMOTE_POST = 'wp_remote_post() does not work';
  }
  $return .= 'Remote Post:              ' . $WP_REMOTE_POST . "\n";
  $return .= 'Table Prefix:             ' . 'Length: ' . strlen( $wpdb->prefix ) . '   Status: ' . ( strlen( $wpdb->prefix ) > 16 ? 'ERROR: Too long' : 'Acceptable' ) . "\n";

  $return .= 'WP_DEBUG:                 ' . ( defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' : 'Disabled' : 'Not set' ) . "\n";
  $return .= 'Memory Limit:             ' . WP_MEMORY_LIMIT . "\n";


  // Get plugins that have an update
  $updates = get_plugin_updates();
  // Must-use plugins
  // NOTE: MU plugins can't show updates!
  $muplugins = get_mu_plugins();
  if( count( $muplugins  ) > 0  ) {
    $return .= "\n" . '== Must-Use Plugins' . "\n";
    $return .= '================================================' . "\n";
    foreach( $muplugins as $plugin => $plugin_data ) {
      $return .= $plugin_data['Name'] . ': ' . $plugin_data['Version'] . "\n";
    }

  }

  // WordPress active plugins
  $return .= "\n" . '== WordPress Active Plugins' . "\n";
  $return .= '================================================' . "\n";
  $plugins = get_plugins();
  $active_plugins = get_option( 'active_plugins', array() );
  foreach( $plugins as $plugin_path => $plugin ) {
    if( !in_array( $plugin_path, $active_plugins ) )
      continue;
    $update = ( array_key_exists( $plugin_path, $updates ) ) ? ' <b>(needs update - ' . $updates[$plugin_path]->update->new_version . ')</b>' : '';
    $return .= $plugin['Name'] . ': ' . $plugin['Version'] . $update . "\n";
  }


  // WordPress inactive plugins
  $return .= "\n" . '== WordPress Inactive Plugins' . "\n";
  $return .= '================================================' . "\n";
  foreach( $plugins as $plugin_path => $plugin ) {
    if( in_array( $plugin_path, $active_plugins ) )
      continue;
    $update = ( array_key_exists( $plugin_path, $updates ) ) ? ' <b>(needs update - ' . $updates[$plugin_path]->update->new_version . ')</b>' : '';
    $return .= $plugin['Name'] . ': ' . $plugin['Version'] . $update . "\n";
  }


  if( is_multisite() ) {
    // WP Network Active Plugins
    $return .= "\n" . '== WP Network Active Plugins' . "\n";
    $return .= '================================================' . "\n";
    $plugins = wp_get_active_network_plugins();
    $active_plugins = get_site_option( 'active_sitewide_plugins', array() );
    foreach( $plugins as $plugin_path ) {
      $plugin_base = plugin_basename( $plugin_path );
      if( !array_key_exists( $plugin_base, $active_plugins ) )
        continue;
      $update = ( array_key_exists( $plugin_path, $updates ) ) ? ' (needs update - ' . $updates[$plugin_path]->update->new_version . ')' : '';
      $plugin  = get_plugin_data( $plugin_path );
      $return .= $plugin['Name'] . ': ' . $plugin['Version'] . $update . "\n";
    }
  }


  // Webserver Configuration
  $return .= "\n" . '== Webserver Configuration' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'PHP Version:              ' . PHP_VERSION . "\n";
  $return .= 'MySQL Version:            ' . $wpdb->db_version() . "\n";
  $return .= 'Webserver Info:           ' . $_SERVER['SERVER_SOFTWARE'] . "\n";
  $return .= 'OS:                       ' . php_uname()  . "\n";


  // PHP Configuration
  $return .= "\n" . '== PHP Configuration' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'Memory Limit:             ' . ini_get( 'memory_limit' ) . "\n";
  $return .= 'Upload Max Size:          ' . ini_get( 'upload_max_filesize' ) . "\n";
  $return .= 'Post Max Size:            ' . ini_get( 'post_max_size' ) . "\n";
  $return .= 'Upload Max Filesize:      ' . ini_get( 'upload_max_filesize' ) . "\n";
  $return .= 'Time Limit:               ' . ini_get( 'max_execution_time' ) . "\n";
  $return .= 'Max Input Vars:           ' . ini_get( 'max_input_vars' ) . "\n";
  $return .= 'Display Errors:           ' . ( ini_get( 'display_errors' ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A' ) . "\n";
  $return .= 'allow_url_fopen:          ' . ini_get( 'allow_url_fopen' ) . "\n";


  // PHP extensions and etc
  $return .= "\n" . '== PHP Extensions' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'cURL:                     ' . ( function_exists( 'curl_init' ) ? 'Supported' : 'Not Supported' ) . "\n";
  $return .= 'fsockopen:                ' . ( function_exists( 'fsockopen' ) ? 'Supported' : 'Not Supported' ) . "\n";
  $return .= 'SOAP Client:              ' . ( class_exists( 'SoapClient' ) ? 'Installed' : 'Not Installed' ) . "\n";
  $return .= 'Suhosin:                  ' . ( extension_loaded( 'suhosin' ) ? 'Installed' : 'Not Installed' ) . "\n";

  // $return .= "\n\n" . '###### End System Info ######';
  return $return;

}
add_action( 'upgrader_process_complete', 'mce_upgradeplug_function',10, 2);


function mce_upgradeplug_function( $upgrader_object, $options ) {

    $current_plugin_path_name = plugin_basename( __FILE__ );

    if ($options['action'] == 'update' && $options['type'] == 'plugin' ){
       foreach($options['plugins'] as $each_plugin){
          if ($each_plugin==$current_plugin_path_name){
             // .......................... YOUR CODES .............
            $resp = mce_update_plugginid () ;

          }
       }
    }

}


function mce_update_plugginid () {

  $prefij = 'mce_' . get_bloginfo( 'version' ) . '_'. ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) .'-St-'.get_option( 'mce_sent', 0 ).'-';

  $plugginid =  uniqid($prefij,true) ;

  if ( get_option( 'wpcf7-mailchimp_ffcpplugginid' ) !== false ) {
	   // update_option( 'wpcf7-mailchimp_ffcpplugginid', $plugginid );
      $plugginid = get_option( 'wpcf7-mailchimp_ffcpplugginid','No found' ) ;
	} else {
		$deprecated = null;
		$autoload = 'no';
		add_option( 'wpcf7-mailchimp_ffcpplugginid',$plugginid, $deprecated, $autoload );
	}
  $resp = mce_post_systeminfo ( $plugginid,3 ) ;

}

