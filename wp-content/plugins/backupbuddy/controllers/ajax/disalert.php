<?php
/**
 * Dismissable alert saving. Currently framework does NOT auto-load this AJAX ability to save disalerts.
 *
 * @package BackupBuddy
 */

backupbuddy_core::verifyAjaxAccess();

$unique_id = pb_backupbuddy::_POST( 'unique_id' );

pb_backupbuddy::$options['disalerts'][ $unique_id ] = time();
pb_backupbuddy::save();

die( '1' );
