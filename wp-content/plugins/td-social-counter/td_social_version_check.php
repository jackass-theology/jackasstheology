<?php


/**
 * Latest plugins crash when used with older theme versions
 * Check for theme version and disable plugin functionality on old themes
 * Display an admin notice and inform the user to update the plugin
 * Introduced in Newspaper 8.7.5 and Newsmag 4.4
 */
class td_social_version_check {


	static $theme_versions = array (
		'Newspaper' => '8.7.5',
		'Newsmag' => '4.4'
	);


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


	static function on_admin_notice_theme_version() {
		?>
		<div class="notice notice-error td-plugins-deactivated-notice">
			<p><strong>tagDiv Social Counter</strong> - This plugin requires <strong><?php echo TD_THEME_NAME?> v<?php echo self::$theme_versions[TD_THEME_NAME] ?></strong> but the current installed version is <strong><?php echo TD_THEME_NAME?> v<?php echo TD_THEME_VERSION?></strong>. </p>

			<p>To fix this:</p>

			<ul>
				<li> - Delete the TD Social Counter plugin via wp-admin</li>
				<li> - Install the version that is bundeled with the theme from our Plugins Panel</li>
			</ul>
		</div>

		<?php
	}

}