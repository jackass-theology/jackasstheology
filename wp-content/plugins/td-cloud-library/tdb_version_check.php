<?php

/**
 * Introduced in Newspaper 8.7.5 and Newsmag 4.4
 * - Check for PHP version, the plugin crashes on PHP 5.2.4 and lower
 * - Plugin crashes when used with older theme versions
 */
class tdb_version_check {


	static $php_version = '5.4';

	static $theme_versions = array (
		'Newspaper' => '8.7.5',
		'Newsmag' => '4.4'
	);


	/**
     * Check if the plugin is compatible with current version of PHP
	 * @return bool - on false display an admin_notice
	 */
	static function is_php_compatible() {
        if (version_compare(phpversion(), self::$php_version, '<')) {
	        add_action( 'admin_notices', array(__CLASS__, 'on_admin_notice_php_version'));
	        return false;
        }
		return true;
    }

	/**
     * Check if the plugin is compatible with the theme
	 * @return bool - on false display an admin_notice
	 */
	static function is_theme_compatible() {
		if (TD_THEME_VERSION === '__td_deploy_version__' || TD_DEPLOY_MODE === 'dev' || TD_DEPLOY_MODE === 'demo') {
			return true;
		}


		if (version_compare(TD_THEME_VERSION, self::$theme_versions[TD_THEME_NAME], '<')) {
			add_action( 'admin_notices', array(__CLASS__, 'on_admin_notice_theme_version'));
			return false;
		}
		return true;
	}

	/**
	 * Admin notice - the plugin is incompatible with current theme version
	 */
	static function on_admin_notice_theme_version() {
		?>
		<div class="notice notice-error td-plugins-deactivated-notice">
			<p><strong>TD Cloud Library</strong> - This plugin requires <strong><?php echo TD_THEME_NAME?> v<?php echo self::$theme_versions[TD_THEME_NAME] ?></strong> but the current installed version is <strong><?php echo TD_THEME_NAME?> v<?php echo TD_THEME_VERSION?></strong>. </p>

			<p>To fix this:</p>

			<ul>
				<li> - Delete the TD Cloud Library plugin via wp-admin</li>
				<li> - Install the version that is bundeled with the theme from our Plugins Panel</li>
			</ul>
		</div>

		<?php
	}

	/**
	 * Admin notice - the plugin is incompatible current version of PHP
	 */
	static function on_admin_notice_php_version() {
		?>
        <div class="notice notice-error td-plugins-deactivated-notice">
            <p><strong>TD Cloud Library</strong> - This plugin requires PHP v<?php echo self::$php_version ?> but the current PHP version is v<?php echo phpversion() ?>. </p>
        </div>

		<?php
	}

}
