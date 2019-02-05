<?php
/**
 * Created by ra on 5/15/2015.
 */

if (current_user_can( 'activate_plugins' )) {
	// deactivate a plugin from tgm
	if (isset($_GET['td_deactivate_plugin_slug'])) {

		if (empty($_GET['td_magic_token']) || wp_verify_nonce($_GET['td_magic_token'], 'td-panel-plugins') === false ) {
			echo 'Permission denied';
			die;
		}

		$td_deactivate_plugin_slug = $_GET['td_deactivate_plugin_slug'];
		if (!empty($td_deactivate_plugin_slug)) {
			$plugins = TGM_Plugin_Activation::$instance->plugins;
			foreach ($plugins as $plugin) {
				if ($plugin['slug'] == $td_deactivate_plugin_slug) {
					deactivate_plugins($plugin['file_path']);
					?>
                    <script type="text/javascript">
                        window.location = "admin.php?page=td_theme_plugins";
                    </script>
					<?php
					break;
				}
			}
		}
	}

	// Activate a plugin
	if (isset($_GET['td_activate_plugin_slug'])) {

		if (empty($_GET['td_magic_token']) || wp_verify_nonce($_GET['td_magic_token'], 'td-panel-plugins') === false) {
			echo 'Permission denied';
			die;
		}


		$td_activate_plugin_slug = $_GET['td_activate_plugin_slug'];
		if (!empty($td_activate_plugin_slug)) {
			$plugins = TGM_Plugin_Activation::$instance->plugins;

			foreach ($plugins as $plugin) {
				if ($plugin['slug'] == $td_activate_plugin_slug) {
					activate_plugins($plugin['file_path']);
					?>
                    <script type="text/javascript">
                        window.location = "admin.php?page=td_theme_plugins";
                    </script>
					<?php
					break;
				}
			}
		}
	}
}



require_once "td_view_header.php";


//print_r(get_plugins());





?>



<div class="td-admin-wrap about-wrap theme-browser td-admin-plugins">
    <h1>Install premium plugins</h1>
    <div class="about-text">
        <p>
            Install the included plugins with ease using this panel. All the plugins are well tested to work with the theme and we keep them up to date.
            The theme comes packed with the following premium plugins:
        </p>
    </div>


    <div class="td-admin-columns">


		<?php





		$wp_plugin_list = get_plugins();

		// Get plugins that require update
		$td_plugins_update_list = array();
		$plugins_path = ABSPATH . 'wp-content/plugins';

		foreach (td_global::get_td_plugins() as $constant => $version) {
			$plugin_name = strtolower(str_replace('_', '-', $constant));
			$plugin = $plugin_name . '/' . $plugin_name . '.php';

			//plugin exists and it's inactive
			if (is_plugin_inactive($plugin) && isset($wp_plugin_list[$plugin])) {

				//read plugin file
				$fp = fopen( $plugins_path . '/' . $plugin, 'r' );
				$file_data = fread( $fp, 8192 );
				fclose( $fp );

				preg_match('/define\(\'' . $constant . '\', \'(.*)\'\)/', $file_data, $matches);
				if (!isset($matches[1]) || $matches[1] !==  $version) {
					$td_plugins_update_list[] = $plugin;
				}
			}
		}

		//asort($theme_plugins);
		$td_tgm_theme_plugins = TGM_Plugin_Activation::$instance->plugins;

		$sorted_plugins = array();

		// sort theme plugins based on the config array
		foreach (td_global::$theme_plugins_list as $td_global_plugin) {
			foreach ($td_tgm_theme_plugins as $td_tgm_theme_plugin) {
				if ($td_global_plugin['name'] == $td_tgm_theme_plugin['name'] ) {
					$sorted_plugins[] = $td_tgm_theme_plugin;
				}
			}
		}

		$td_tgm_theme_plugins = array_merge($sorted_plugins, td_global::$theme_plugins_for_info_list);




		foreach ($td_tgm_theme_plugins as $td_tgm_theme_plugin) {

			$tmp_class = 'td-plugin-not-installed';
			$required_label = $td_tgm_theme_plugin['required_label'];
			$plugin_msg = '';

			if ( isset($td_tgm_theme_plugin['file_path'] ) ) {
				// file_path key is missing from elements that come from td_global::$theme_plugins_for_info_list
				if ( is_plugin_active( $td_tgm_theme_plugin['file_path'] ) ) {
					$tmp_class = 'td-plugin-active';
					$required_label = 'active';
				} else if ( isset( $wp_plugin_list[$td_tgm_theme_plugin['file_path']] ) && $td_tgm_theme_plugin['file_path'] === 'td-amp/td-amp.php' && is_plugin_active( 'amp/amp.php') ) {
					$plugin_msg = '<b>This plugin doesn\'t work while also using the default AMP plugin. </br> Please deactivate the AMP plugin then activate the tagDiv AMP plugin.</b>';
					$tmp_class  = 'td-plugin-no-install';
				} else if ( in_array ( $td_tgm_theme_plugin['file_path'],  $td_plugins_update_list) ) {
					$tmp_class = 'td-plugin-update';
				} else if ( isset( $wp_plugin_list[$td_tgm_theme_plugin['file_path']] ) ) {
					$tmp_class = 'td-plugin-inactive';
				}


			} else {
				// no install - usually plugins from td_global::$theme_plugins_for_info_list
				$tmp_class = 'td-plugin-no-install';
			}

//        echo '<br>' . $td_tgm_theme_plugin['file_path'] . ' ' . is_plugin_inactive( $td_tgm_theme_plugin['file_path'] ) . '<br>';

			?>

            <div class="td-wp-admin-plugin <?php echo $tmp_class ?>">

                <!-- Import content -->
                <div class="td-plugin-image">
                    <span class="td-plugin-required td-<?php echo $required_label; ?>"><?php echo $required_label; ?></span>
                    <img class="td-demo-thumb" src="<?php echo $td_tgm_theme_plugin['img'] ?>"/>

                    <div class="td-plugin-meta">
                        <h3 class="theme-name"><?php echo $td_tgm_theme_plugin['name'] ?></h3>
						<?php

						if ( $plugin_msg == '' ) {
							echo '<p>' . $td_tgm_theme_plugin['text'] . '</p>';
						} else {
							echo '<p class="td-plugin-notice">' . $plugin_msg . '</p><a href="' . admin_url( 'plugins.php' ) . '" target="_blank">Go to plugins</a>';
						}

						?>
                        <div class="td-plugin-buttons">
                            <a class="td-plugin-button td-button-install-plugin" href="<?php
							echo esc_url( wp_nonce_url(
								add_query_arg(
									array(
										'page'		  	=> urlencode(TGM_Plugin_Activation::$instance->menu),
										'plugin'		=> urlencode($td_tgm_theme_plugin['slug']),
										'plugin_name'   => urlencode($td_tgm_theme_plugin['name']),
										'plugin_source' => urlencode($td_tgm_theme_plugin['source']),
										'tgmpa-install' => 'install-plugin',
										'return_url' => 'td_theme_plugins'
									),
									admin_url('themes.php')
								),
								'tgmpa-install',
                                'tgmpa-nonce'
							));
							?>">Install</a>
                            <a class="td-plugin-button td-button-update-plugin" href="<?php
							echo esc_url( wp_nonce_url(
								add_query_arg(
									array(
										'page'		  	=> urlencode(TGM_Plugin_Activation::$instance->menu),
										'plugin'		=> urlencode($td_tgm_theme_plugin['slug']),
										'plugin_name'   => urlencode($td_tgm_theme_plugin['name']),
										'plugin_source' => urlencode($td_tgm_theme_plugin['source']),
										'tgmpa-update' => 'update-plugin',
										'return_url' => 'td_theme_plugins'
									),
									admin_url('themes.php')
								),
								'tgmpa-update',
								'tgmpa-nonce'
							));
							?>">Update</a>
                            <a class="td-plugin-button td-button-uninstall-plugin" href="<?php
							echo esc_url(
								add_query_arg(
									array(
										'page'		  	            => urlencode('td_theme_plugins'),
										'td_deactivate_plugin_slug'	=> urlencode($td_tgm_theme_plugin['slug']),
										'td_magic_token' => wp_create_nonce('td-panel-plugins')
									),
									admin_url('admin.php')
								));
							?>"">Deactivate</a>
                            <a class="td-plugin-button td-button-activate-plugin" href="<?php
							echo esc_url(
								add_query_arg(
									array(
										'page'		  	            => urlencode('td_theme_plugins'),
										'td_activate_plugin_slug'	=> urlencode($td_tgm_theme_plugin['slug']),
										'td_magic_token' => wp_create_nonce('td-panel-plugins')
									),
									admin_url('admin.php')
								));
							?>"">Activate</a>
                        </div>
                    </div>
                </div>
            </div>






			<?php
		}
		?>

    </div>
    <hr style="clear:left"/>
    <h3>Tested Plugins:</h3>
    <div class="about-text">
        <p>With each theme release we provide a list of fully suported plugins. In order to make the plugins look and work better, the theme may add custom stylesheets and hook custom code to them.
            We manually inspect each plugin periodically. If we missed something, feel free to contact us!</p>
    </div>

    <div class="td-supported-plugin-list">
		<?php echo td_api_text::get('supported_plugins_list') ?>
    </div>



</div>
