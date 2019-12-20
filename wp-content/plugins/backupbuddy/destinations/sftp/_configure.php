<?php

$default_name = NULL;
if ( 'add' == $mode ) {
	$default_name = 'My sFTP';
}
$settings_form->add_setting( array(
	'type'		=>		'text',
	'name'		=>		'title',
	'title'		=>		__( 'Destination name', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( 'Name of the new destination to create. This is for your convenience only.', 'it-l10n-backupbuddy' ),
	'rules'		=>		'required|string[1-45]',
	'default'	=>		$default_name,
) );

$settings_form->add_setting( array(
	'type'		=>		'text',
	'name'		=>		'address',
	'title'		=>		__( 'Server address', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( '[Example: ftp.foo.com] - FTP server address.  Do not include http:// or ftp:// or any other prefixes. You may specify an alternate port in the format of ftp_address:ip_address such as yourftp.com:21', 'it-l10n-backupbuddy' ),
	'rules'		=>		'required|string[0-500]',
) );

$settings_form->add_setting( array(
	'type'		=>		'text',
	'name'		=>		'username',
	'title'		=>		__( 'Username', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( '[Example: foo] - Username to use when connecting to the FTP server.', 'it-l10n-backupbuddy' ),
	'rules'		=>		'required|string[0-250]',
) );

$key_found = '';
$upload_dir = wp_upload_dir();
if ( file_exists( $upload_dir['basedir'] . '/backupbuddy-sftp-key-' . pb_backupbuddy::$options['log_serial'] . '.txt' ) ) {
	$key_found = ' (Key file found! Password setting, if set, will be used to unlock key file.)';
}
$settings_form->add_setting( array(
	'type'		=>		'password',
	'name'		=>		'password',
	'title'		=>		__( 'Password', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( '[Example: 1234xyz] - Password to use when connecting to the FTP server. If using sFTP key file then this setting is for unlocking a password-protected key file.', 'it-l10n-backupbuddy' ),
	'rules'		=>		'string[0-250]',
	'after'		=>		'<br>sFTP key file? Place at: /' . str_replace( ABSPATH, '', $upload_dir['basedir'] ) . '/backupbuddy-sftp-key-' . pb_backupbuddy::$options['log_serial'] . '.txt' . $key_found,
) );

$settings_form->add_setting( array(
	'type'		=>		'text',
	'name'		=>		'path',
	'title'		=>		__( 'Remote path (optional)', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( '[Example: /public_html/backups] - Remote path to place uploaded files into on the destination FTP server. Make sure this path is correct; if it does not exist BackupBuddy will attempt to create it. No trailing slash is needed.', 'it-l10n-backupbuddy' ),
	'rules'		=>		'string[0-500]',
) );



$default_url = '';
/*
if ( pb_backupbuddy::_GET('add') != '' ) { // set default only when adding.
	$default_url = rtrim( site_url(), '/\\' ) . '/';
} else {
	$default_url = '';
}
*/

$settings_form->add_setting( array(
	'type'		=>		'text',
	'name'		=>		'url',
	'title'		=>		__( 'Migration URL', 'it-l10n-backupbuddy' ) . '<br><span class="description">Optional, for migrations</span>',
	'tip'		=>		__( 'Enter the URL corresponding to the FTP destination path. This URL must lead to the location where files uploaded to this remote destination would end up. If the destination is in a subdirectory make sure to match it in the corresponding URL.', 'it-l10n-backupbuddy' ),
	'css'		=>		'width: 100%;',
	'default'	=>		$default_url,
	'rules'		=>		'string[0-100]',
) );





$settings_form->add_setting( array(
	'type'		=>		'text',
	'name'		=>		'archive_limit',
	'title'		=>		__( 'Archive limit', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( '[Example: 5] - Enter 0 for no limit. This is the maximum number of archives to be stored in this specific destination. If this limit is met the oldest backups will be deleted.', 'it-l10n-backupbuddy' ),
	'rules'		=>		'required|int[0-9999999]',
	'css'		=>		'width: 50px;',
	'after'		=>		' backups',
) );



$settings_form->add_setting( array(
	'type'		=>		'title',
	'name'		=>		'advanced_begin',
	'title'		=>		'<span class="dashicons dashicons-arrow-right"></span> ' . __( 'Advanced Options', 'it-l10n-backupbuddy' ),
	'row_class'	=>		'advanced-toggle-title',
) );



if ( ( $mode !== 'edit' ) || ( '0' == $destination_settings['disable_file_management'] ) ) {
	$settings_form->add_setting( array(
		'type'		=>		'checkbox',
		'name'		=>		'disable_file_management',
		'options'	=>		array( 'unchecked' => '0', 'checked' => '1' ),
		'title'		=>		__( 'Disable file management', 'it-l10n-backupbuddy' ),
		'tip'		=>		__( '[[Default: unchecked] - When checked, selecting this destination disables browsing or accessing files stored at this destination from within BackupBuddy. NOTE: Once enabled this cannot be disabled without deleting and re-creating this destination. NOTE: Once enabled this cannot be disabled without deleting and re-creating this destination.', 'it-l10n-backupbuddy' ),
		'css'		=>		'',
		'rules'		=>		'',
		'after'		=>		__( 'Once disabled you must recreate the destination to re-enable.', 'it-l10n-backupbuddy' ),
		'row_class'	=>		'advanced-toggle',
	) );
}
$settings_form->add_setting( array(
	'type'		=>		'checkbox',
	'name'		=>		'disabled',
	'options'	=>		array( 'unchecked' => '0', 'checked' => '1' ),
	'title'		=>		__( 'Disable destination', 'it-l10n-backupbuddy' ),
	'tip'		=>		__( '[Default: unchecked] - When checked, this destination will be disabled and unusable until re-enabled. Use this if you need to temporary turn a destination off but don\t want to delete it.', 'it-l10n-backupbuddy' ),
	'css'		=>		'',
	'after'		=>		'<span class="description"> ' . __('Check to disable this destination until re-enabled.', 'it-l10n-backupbuddy' ) . '</span>',
	'rules'		=>		'',
	'row_class'	=>		'advanced-toggle',
) );