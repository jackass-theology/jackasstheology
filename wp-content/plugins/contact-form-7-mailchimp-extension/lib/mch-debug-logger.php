<?php
/**
 * Logs debug data for WordPress ChimpMail
 *
 * @author    Renzo Johnson (email: renzo.johnson at gmail.com)
 * @link      http://renzojohnson.com/
 * @copyright 2015 Renzo Johnson (email: renzo.johnson at gmail.com)
 *
 * @package Debug
 */

/**
 * Debug Class Doc Comment
 *
 * Endpoint Helper to retrieve application wide
 * URLs based on active webinstance.
 *
 * @category    Class
 * @package     Debug
 * @author      Renzo Johnson (email: renzo.johnson at gmail.com)
 * @copyright   Copyright 2015 Company, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        2015 Renzo Johnson (email: renzo.johnson at gmail.com)
 *
 * @since   1.0.1
 */
class mch_Debug_Logger
{
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $log_folder_path: Missing Document
	 */
	var $log_folder_path;
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $default_log_file: Missing Document
	 */
	var $default_log_file = 'log.txt';
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $default_log_file_cron: Missing Document
	 */
	var $default_log_file_cron = 'log-cron-job.txt';
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $debug_enabled: Missing Document
	 */
	var $debug_enabled = false;
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $debug_status: Missing Document
	 */
	var $debug_status = array( 'SUCCESS','STATUS','NOTICE','WARNING','FAILURE','CRITICAL' );
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $section_break_marker: Missing Document
	 */
	var $section_break_marker = "\n----------------------------------------------------------\n\n";
	/**
	 * Endpoint Helper to retrieve application wide
	 * @var string $log_reset_marker: Missing Document
	 */
	var $log_reset_marker = "-------- Log File Reset --------\n";

	/**
	 * Function Comment *
	 * @since   0.1
	 */
	function __construct() {

		$this->log_folder_path = SPARTAN_MCE_PLUGIN_DIR . '/logs';
		// Check config and if debug is enabled then set the enabled flag to true.
		// $options = get_option('mch_plugin_options');
		// if(!empty($options['enable_debug'])){ //Debugging is enabled.
			$this->debug_enabled = true;
		// }
	}

	/**
	 * Function Comment *
	 * @since   0.1
	 */
	function get_mch_debug_timestamp() {

		return '['.date( 'm/d/Y g:i A' ).'] - ';

	}

	/**
	 * Function Comment *
	 * @param string $level Missing parameter comment.
	 * @since   0.1
	 */
	function get_mch_debug_status( $level ) {
		$size = count( $this->debug_status );
		if ( $level >= $size ) {
			return 'UNKNOWN';
		} else {
			return $this->debug_status[ $level ];
		}
	}

	/**
	 * Function Comment *
	 * @param string $section_break Missing parameter comment.
	 * @since   0.1
	 */
	function get_mch_section_break( $section_break ) {
		if ( $section_break ) {
			return $this->section_break_marker;
		}
		return '';
	}

	/**
	 * Function Comment *
	 * @param string $file_name Missing parameter comment.
	 * @since   0.1
	 */
	function reset_mch_log_file( $file_name = '' ) {
		if ( empty( $file_name ) ) {
			$file_name = $this->default_log_file;
		}
		$debug_log_file = $this->log_folder_path.'/'.$file_name;
		$content = $this->get_mch_debug_timestamp().$this->log_reset_marker;
		$fp = fopen( $debug_log_file,'w' );
		fwrite( $fp, $content );
		fclose( $fp );
	}


	/**
	 * Function Comment *
	 * @param string $content Missing parameter comment.
	 * @param string $file_name Missing parameter comment.
	 * @since   0.1
	 */
	function append_mch_to_file( $content, $file_name ) {
		if ( empty( $file_name ) ) { $file_name = $this->default_log_file; }
		$debug_log_file = $this->log_folder_path.'/'.$file_name;
		$fp = fopen( $debug_log_file,'a' );
		fwrite( $fp, $content );
		fclose( $fp );
	}


	/**
	 * Function Comment *
	 * @param string $message Missing parameter comment.
	 * @param string $level Missing parameter comment.
	 * @param string $debug_enabledd parameter comment.
	 * @param string $section_break parameter comment.
	 * @param string $file_name parameter comment.
	 * @since   0.1
	 */
	function log_mch_debug( $message, $level = 0, $debug_enabledd = false, $section_break = false, $file_name = '' ) {
		if ( ! $debug_enabledd ) { return; }

		$content = $this->get_mch_debug_timestamp(); // Timestamp.
		$content .= $this->get_mch_debug_status( $level ); // Debug status.
		$content .= ' : ';
		$content .= $message . "\n";
		$content .= $this->get_mch_section_break( $section_break );
		$this->append_mch_to_file( $content, $file_name );
	}

	/**
	 * Function Comment *
	 * @param string $message Missing parameter comment.
	 * @param string $level Missing parameter comment.
	 * @param string $section_break parameter comment.
	 * @param string $debug_enabledd parameter comment.
	 * @since   0.1
	 */
	function log_mch_debug_cron( $message, $level = 0, $section_break = false, $debug_enabledd = false ) {
		if ( ! $debug_enabledd ) { return; }
		$content = $this->get_mch_debug_timestamp(); // Timestamp.
		$content .= $this->get_mch_debug_status( $level ); // Debug status.
		$content .= ' : ';
		$content .= $message . "\n";
		$content .= $this->get_mch_section_break( $section_break );
		// $file_name = $this->default_log_file_cron;
		$this->append_mch_to_file( $content, $this->default_log_file_cron );
	}

	/**
	 * Function Comment *
	 * @param string $message Missing parameter comment.
	 * @param string $level Missing parameter comment.
	 * @param string $section_break parameter comment.
	 * @param string $file_name parameter comment.
	 * @since   0.1
	 */
	static function log_mch_debug_st( $message, $level = 0, $section_break = false, $file_name = '' ) {

		$content = '['.date( 'm/d/Y g:i A' ).'] - STATUS : '. $message . "\n";
		$debug_log_file = WP_LICENSE_MANAGER_PATH . '/logs/log.txt';
		$fp = fopen( $debug_log_file,'a' );
		fwrite( $fp, $content );
		fclose( $fp );
	}
}
