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


 ?>


<div id="sys-dev">

  <div id="toggle-sys" class="highlight" style="margin-top: 1em; margin-bottom: 1em; display: none;">
    <h3>Debugger - System Info</h3>
    <pre><code><?php

  global $wpdb;
  $theme_data = wp_get_theme();
  $theme      = $theme_data->Name . ' ' . $theme_data->Version;

  // Site Info
  $return = '== Site Info' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'Site URL:                 ' . site_url() . "\n";
  $return .= 'Home URL:                 ' . home_url() . "\n";
  $return .= 'Multisite:                ' . ( is_multisite() ? 'Yes' : 'No' ) . "\n";


  // WP Configuration
  $return .= "\n" . '== WP Configuration' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'Version:                  ' . get_bloginfo( 'version' ) . "\n";
  $return .= 'Language:                 ' . ( defined( 'WPLANG' ) && WPLANG ? WPLANG : 'en_US' ) . "\n";
  $return .= 'Permalink Structure:      ' . ( get_option( 'permalink_structure' ) ? get_option( 'permalink_structure' ) : 'Default' ) . "\n";
  $return .= 'Active Theme:             ' . $theme . "\n";
  $return .= 'Show On Front:            ' . get_option( 'show_on_front' ) . "\n";


  // WP  Frontpage
  $return .= "\n" . '== WP  Frontpage' . "\n";
  $return .= '================================================' . "\n";

    $front_page_id = get_option( 'page_on_front' );
    $blog_page_id = get_option( 'page_for_posts' );

    $return .= 'Page On Front:            ' . ( $front_page_id != 0 ? get_the_title( $front_page_id ) . ' (#' . $front_page_id . ')' : 'Unset' ) . "\n";
    $return .= 'Page For Posts:           ' . ( $blog_page_id != 0 ? get_the_title( $blog_page_id ) . ' (#' . $blog_page_id . ')' : 'Unset' ) . "\n";

  $return .= 'ABSPATH:                  ' . ABSPATH . "\n";


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
  if( count( $muplugins > 0 ) ) {
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
  $return .= 'Display Errors:           ' . ( ini_get( 'display_errors' ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A' ) . "\n";
  if ( strtok(phpversion(),'.') >= 5.3) {
    // php >= 5
    $return .= 'Host:                     ' . gethostname() . "\n";
  }
  $return .= 'HHost:                    ' . $_SERVER['HTTP_HOST'] . "\n";
  $return .= 'SName:                    ' . $_SERVER['SERVER_NAME'] . "\n";
  $return .= 'allow_url_fopen:          ' . ini_get( 'allow_url_fopen' ) . "\n";
  // $return .= 'Host by IP:               ' . gethostbyaddr() . "\n";



  // PHP extensions and etc
  $return .= "\n" . '== PHP Extensions' . "\n";
  $return .= '================================================' . "\n";
  $return .= 'cURL:                     ' . ( function_exists( 'curl_init' ) ? 'Supported' : 'Not Supported' ) . "\n";
  $return .= 'fsockopen:                ' . ( function_exists( 'fsockopen' ) ? 'Supported' : 'Not Supported' ) . "\n";
  $return .= 'SOAP Client:              ' . ( class_exists( 'SoapClient' ) ? 'Installed' : 'Not Installed' ) . "\n";
  $return .= 'Suhosin:                  ' . ( extension_loaded( 'suhosin' ) ? 'Installed' : 'Not Installed' ) . "\n";

  // $return .= "\n\n" . '###### End System Info ######';
  echo $return;

 ?></code></pre>


  </div>

</div>



<style type="text/css">
  .highlight {
    color: #999;
    padding: 9px 20px;
    margin-bottom: 14px;
    background-color: #fafafc;
    border: 1px solid #e1e1e8;
    border-radius: 4px;
  }

  .highlight,
  pre,
  pre code {
    font-family: Menlo,Monaco,Consolas,"Courier New",monospace;
  }


  pre code {
    padding: 2px 4px;
    font-size: 90%;
    color: #c7254e;
    background-color: #f9f2f4;
    word-break: normal;
    white-space: pre-wrap;
    line-height: 1.42857143;
}
</style>

