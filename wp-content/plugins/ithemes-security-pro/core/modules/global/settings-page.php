<?php

final class ITSEC_Global_Settings_Page extends ITSEC_Module_Settings_Page {
	private $version = 4;

	public function __construct() {
		$this->id          = 'global';
		$this->title       = __( 'Global Settings', 'it-l10n-ithemes-security-pro' );
		$this->description = __( 'Configure basic settings that control how iThemes Security functions.', 'it-l10n-ithemes-security-pro' );
		$this->type        = 'recommended';

		parent::__construct();

		add_filter( 'admin_body_class', array( $this, 'filter_body_classes' ) );
	}

	public function filter_body_classes( $classes ) {
		if ( ITSEC_Modules::get_setting( 'global', 'show_error_codes' ) ) {
			$classes .= ' itsec-show-error-codes';
		}

		if ( ITSEC_Modules::get_setting( 'global', 'write_files' ) ) {
			$classes .= ' itsec-write-files-enabled';
		} else {
			$classes .= ' itsec-write-files-disabled';
		}

		$classes = trim( $classes );

		return $classes;
	}

	public function enqueue_scripts_and_styles() {
		$vars = array(
			'ip'           => ITSEC_Lib::get_ip(),
			'log_location' => ITSEC_Modules::get_default( $this->id, 'log_location' ),
			'l10n'         => array(
				'loading' => esc_html__( 'Loading...', 'it-l10n-ithemes-security-pro' ),
			)
		);

		wp_enqueue_script( 'itsec-global-settings-page-script', plugins_url( 'js/settings-page.js', __FILE__ ), array( 'jquery', 'itsec-settings-page-script', 'itsec-util' ), $this->version, true );
		wp_localize_script( 'itsec-global-settings-page-script', 'itsec_global_settings_page', $vars );
		wp_enqueue_style( 'itsec-global-settings', plugins_url( 'css/settings-page.css', __FILE__ ), array(), $this->version );
	}

	public function handle_form_post( $data ) {
		$retval = ITSEC_Modules::set_settings( $this->id, $data );

		if ( $retval['saved'] ) {
			if ( $retval['old_settings']['show_error_codes'] !== $retval['new_settings']['show_error_codes'] ) {
				ITSEC_Response::add_js_function_call( 'itsec_change_show_error_codes', array( (bool) $retval['new_settings']['show_error_codes'] ) );
			}

			if ( $retval['old_settings']['write_files'] !== $retval['new_settings']['write_files'] ) {
				ITSEC_Response::add_js_function_call( 'itsec_change_write_files', array( (bool) $retval['new_settings']['write_files'] ) );
			}
		}
	}

	public function handle_ajax_request( $data ) {
		$method = empty( $data['method'] ) ? '' : $data['method'];

		switch ( $method ) {
			case 'get-ip':
				ITSEC_Lib::load( 'ip-detector' );
				$detector = ITSEC_Lib_IP_Detector::build_for_type( $data['proxy'], isset( $data['args'] ) ? $data['args'] : array() );
				$ip       = $detector->get();

				return array(
					'ip'      => $ip,
					'ip_l10n' => sprintf( __( 'Detected IP: %s', 'it-l10n-ithemes-security-pro' ), $ip ),
				);
			case 'scan-ip':
				if ( ! ITSEC_Modules::is_active( 'security-check-pro' ) ) {
					ITSEC_Modules::activate( 'security-check-pro' );
					ITSEC_Modules::load_module_file( 'active.php', 'security-check-pro' );
				}

				ITSEC_Modules::load_module_file( 'feedback.php', 'security-check' );
				ITSEC_Modules::load_module_file( 'utility.php', 'security-check-pro' );
				$scan = ITSEC_Security_Check_Pro_Utility::get_server_response();

				if ( is_wp_error( $scan ) ) {
					ITSEC_Response::add_error( $scan );
				} elseif ( empty( $scan['remote_ip'] ) ) {
					ITSEC_Response::add_error( __( 'Could not detect IP header.', 'it-l10n-ithemes-security-pro' ) );
				} else {
					ITSEC_Lib::load( 'ip-detector' );
					$detector = ITSEC_Lib_IP_Detector::build_for_type( 'security-check' );
					$ip       = $detector->get();

					if ( ! $ip ) {
						ITSEC_Response::add_error( __( 'Identified IP was invalid.', 'it-l10n-ithemes-security-pro' ) );

						return null;
					}

					return array(
						'ip'      => $ip,
						'ip_l10n' => sprintf( __( 'Detected IP: %s', 'it-l10n-ithemes-security-pro' ), $ip ),
					);
				}

				return null;
			default:
				return null;
		}
	}

	protected function render_description( $form ) {
		?>
		<p><?php _e( 'The following settings modify the behavior of many of the features offered by iThemes Security.', 'it-l10n-ithemes-security-pro' ); ?></p>
		<?php
	}

	protected function render_settings( $form ) {
		/** @var ITSEC_Global_Validator $validator */
		$validator = ITSEC_Modules::get_validator( $this->id );

		$log_types = $validator->get_valid_log_types();

		$show_error_codes_options = array(
			false => __( 'No (default)' ),
			true  => __( 'Yes' ),
		);

		$enable_grade_report_options = array(
			false => __( 'No (default)' ),
			true  => __( 'Yes' ),
		);

		$proxy = array( 'value' => $validator->get_proxy_types() );

		$proxy_header_opt = $validator->get_proxy_header_options();

		?>
		<table class="form-table itsec-settings-section">
			<tr>
				<th scope="row"><label for="itsec-global-write_files"><?php _e( 'Write to Files', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_checkbox( 'write_files' ); ?>
					<label for="itsec-global-write_files"><?php _e( 'Allow iThemes Security to write to wp-config.php and .htaccess.', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'Whether or not iThemes Security should be allowed to write to wp-config.php and .htaccess automatically. If disabled you will need to manually place configuration options in those files.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-lockout_message"><?php _e( 'Host Lockout Message', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_textarea( 'lockout_message', array( 'class' => 'widefat' ) ); ?>
					<p class="description"><?php _e( 'The message to display when a computer (host) has been locked out.', 'it-l10n-ithemes-security-pro' ); ?></p>
					<p class="description"><?php _e( 'You can use HTML in your message. Allowed tags include: a, br, em, strong, h1, h2, h3, h4, h5, h6, div.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-user_lockout_message"><?php _e( 'User Lockout Message', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_textarea( 'user_lockout_message', array( 'class' => 'widefat' ) ); ?>
					<p class="description"><?php _e( 'The message to display to a user when their account has been locked out.', 'it-l10n-ithemes-security-pro' ); ?></p>
					<p class="description"><?php _e( 'You can use HTML in your message. Allowed tags include: a, br, em, strong, h1, h2, h3, h4, h5, h6, div.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-community_lockout_message"><?php _e( 'Community Lockout Message', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_textarea( 'community_lockout_message', array( 'class' => 'widefat' ) ); ?>
					<p class="description"><?php _e( 'The message to display to a user when their IP has been flagged as bad by the iThemes network.', 'it-l10n-ithemes-security-pro' ); ?></p>
					<p class="description"><?php _e( 'You can use HTML in your message. Allowed tags include: a, br, em, strong, h1, h2, h3, h4, h5, h6, div.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-blacklist"><?php _e( 'Blacklist Repeat Offender', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_checkbox( 'blacklist' ); ?>
					<label for="itsec-global-blacklist"><?php _e( 'Enable Blacklist Repeat Offender', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'If this box is checked the IP address of the offending computer will be added to the "Ban Users" blacklist after reaching the number of lockouts listed below.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-blacklist_count"><?php _e( 'Blacklist Threshold', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_text( 'blacklist_count', array( 'class' => 'small-text' ) ); ?>
					<label for="itsec-global-blacklist_count"><?php _e( 'Lockouts', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'The number of lockouts per IP before the host is banned permanently from this site.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-blacklist_period"><?php _e( 'Blacklist Lookback Period', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_text( 'blacklist_period', array( 'class' => 'small-text' ) ); ?>
					<label for="itsec-global-blacklist_period"><?php _e( 'Days', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'How many days should a lockout be remembered to meet the blacklist count above.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-lockout_period"><?php _e( 'Lockout Period', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_text( 'lockout_period', array( 'class' => 'small-text' ) ); ?>
					<label for="itsec-global-lockout_period"><?php _e( 'Minutes', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'The length of time a host or user will be banned from this site after hitting the limit of bad logins. The default setting of 15 minutes is recommended as increasing it could prevent attacking IP addresses from being added to the blacklist.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-lockout_white_list"><?php _e( 'Lockout White List', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_textarea( 'lockout_white_list' ); ?>
					<p><?php $form->add_button( 'add-to-whitelist', array( 'value' => __( 'Add my current IP to the White List', 'it-l10n-ithemes-security-pro' ), 'class' => 'button-primary' ) ); ?></p>
					<p class="description"><?php _e( 'Use the guidelines below to enter hosts that will not be locked out from your site. This will keep you from locking yourself out of any features if you should trigger a lockout. Please note this does not override away mode and will only prevent a temporary ban. Should a permanent ban be triggered you will still be added to the "Ban Users" list unless the IP address is also white listed in that section.', 'it-l10n-ithemes-security-pro' ); ?></p>
					<ul>
						<li>
							<?php _e( 'You may white list users by individual IP address or IP address range using wildcards or CIDR notation.', 'it-l10n-ithemes-security-pro' ); ?>
							<ul>
								<li><?php _e( 'Individual IP addresses must be in IPv4 or IPv6 standard format (###.###.###.### or ####:####:####:####:####:####:####:####).', 'it-l10n-ithemes-security-pro' ); ?></li>
								<li><?php _e( 'CIDR notation is allowed to specify a range of IP addresses (###.###.###.###/## or ####:####:####:####:####:####:####:####/###).', 'it-l10n-ithemes-security-pro' ); ?></li>
								<li><?php _e( 'Wildcards are also supported with some limitations. If using wildcards (*), you must start with the right-most chunk in the IP address. For example ###.###.###.* and ###.###.*.* are permitted but ###.###.*.### is not. Wildcards are only for convenient entering of IP addresses, and will be automatically converted to their appropriate CIDR notation format on save.', 'it-l10n-ithemes-security-pro' ); ?></li>
							</ul>
						</li>
						<li><?php _e( 'Enter only 1 IP address or 1 IP address range per line.', 'it-l10n-ithemes-security-pro' ); ?></li>
					</ul>
					<p><a href="<?php echo esc_url( ITSEC_Lib::get_trace_ip_link() ); ?>" target="_blank" rel="noopener noreferrer"><?php _e( 'Lookup IP Address.', 'it-l10n-ithemes-security-pro' ); ?></a></p>
					<p class="description">
						<strong><?php _e( 'This white list will prevent any IP listed from triggering an automatic lockout. You can still block the IP address manually in the banned users settings.', 'it-l10n-ithemes-security-pro' ); ?></strong>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-log_type"><?php _e( 'Log Type', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_select( 'log_type', $log_types ); ?>
					<label for="itsec-global-log_type"><?php _e( 'How should event logs be kept', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'iThemes Security can log events in multiple ways, each with advantages and disadvantages. Database Only puts all events in the database with your posts and other WordPress data. This makes it easy to retrieve and process but can be slower if the database table gets very large. File Only is very fast but the plugin does not process the logs itself as that would take far more resources. For most users or smaller sites Database Only should be fine. If you have a very large site or a log processing software then File Only might be a better option.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-log_rotation"><?php _e( 'Days to Keep Database Logs', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_text( 'log_rotation', array( 'class' => 'small-text' ) ); ?>
					<label for="itsec-global-log_rotation"><?php _e( 'Days', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'The number of days database logs should be kept.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-file_log_rotation"><?php _e( 'Days to Keep File Logs', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_text( 'file_log_rotation', array( 'class' => 'small-text' ) ); ?>
					<label for="itsec-global-log_rotation"><?php _e( 'Days', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php _e( 'The number of days file logs should be kept. File logs will additionally be rotated once the file hits 10MB. Set to 0 to only use log rotation.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-log_location"><?php _e( 'Path to Log Files', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_text( 'log_location', array( 'class' => 'large-text code' ) ); ?>
					<p><label for="itsec-global-log_location"><?php _e( 'The path on your server where log files should be stored.', 'it-l10n-ithemes-security-pro' ); ?></label></p>
					<p class="description"><?php _e( 'This path must be writable by your website. For added security, it is recommended you do not include it in your website root folder.', 'it-l10n-ithemes-security-pro' ); ?></p>
					<p><?php $form->add_button( 'reset-log-location', array( 'value' => __( 'Restore Default Log File Path', 'it-l10n-ithemes-security-pro' ), 'class' => 'button-secondary' ) ); ?></p>
				</td>
			</tr>
			<?php if ( is_dir( WP_PLUGIN_DIR . '/iwp-client' ) ) : ?>
				<tr>
					<th scope="row"><label for="itsec-global-infinitewp_compatibility"><?php _e( 'Add InfiniteWP Compatibility', 'it-l10n-ithemes-security-pro' ); ?></label></th>
					<td>
						<?php $form->add_checkbox( 'infinitewp_compatibility' ); ?>
						<label for="itsec-global-infinitewp_compatibility"><?php _e( 'Enable InfiniteWP Compatibility', 'it-l10n-ithemes-security-pro' ); ?></label>
						<p class="description"><?php printf( __( 'Turning this feature on will enable compatibility with <a href="%s" target="_blank" rel="noopener noreferrer">InfiniteWP</a>. Do not turn it on unless you use the InfiniteWP service.', 'it-l10n-ithemes-security-pro' ), 'http://infinitewp.com' ); ?></p>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<th scope="row"><label for="itsec-global-allow_tracking"><?php _e( 'Allow Data Tracking', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_checkbox( 'allow_tracking' ); ?>
					<label for="itsec-global-allow_tracking"><?php _e( 'Allow iThemes to track plugin usage via anonymous data.', 'it-l10n-ithemes-security-pro' ); ?></label>
				</td>
			</tr>
			<?php if ( 'nginx' === ITSEC_Lib::get_server() ) : ?>
				<tr>
					<th scope="row"><label for="itsec-global-nginx_file"><?php _e( 'NGINX Conf File', 'it-l10n-ithemes-security-pro' ); ?></label></th>
					<td>
						<?php $form->add_text( 'nginx_file', array( 'class' => 'large-text code' ) ); ?>
						<p><label for="itsec-global-nginx_file"><?php _e( 'The path on your server where the nginx config file is located.', 'it-l10n-ithemes-security-pro' ); ?></label></p>
						<p class="description"><?php _e( 'This path must be writable by your website. For added security, it is recommended you do not include it in your website root folder.', 'it-l10n-ithemes-security-pro' ); ?></p>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<th scope="row"><label for="itsec-global-proxy"><?php esc_html_e( 'Proxy Detection', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<div class="itsec-global-proxy-wrapper">
						<?php $form->add_select( 'proxy', $proxy ); ?>
						<?php $form->add_button( 'ip-scan', array( 'value' => esc_html__( 'Run Security Check Scan Now', 'it-l10n-ithemes-security-pro' ), 'class' => 'button' ) ); ?>
					</div>
					<p class="itsec-global-detected-ip"><?php printf( __( 'Detected IP: %s', 'it-l10n-ithemes-security-pro' ), ITSEC_Lib::get_ip() ) ?></p>
					<p class="description"><?php esc_html_e( 'Choose how iThemes Security determines your visitor\'s IP addresses. Incorrectly configuring this setting may lead to attackers bypassing lockouts or bans.', 'it-l10n-ithemes-security-pro' ); ?></p>
					<ul>
						<?php if ( isset( $proxy['value']['security-check'] ) ): ?>
							<li>
								<?php printf(
									esc_html__( 'Security Check Scan – (Recommended) Security Check will connect to the iThemes.com servers to accurately identify your server configuration. %1$sRead our Privacy Policy%2$s. Security Check will correctly identify remote IP addresses and ensure your site is using the recommended features.', 'it-l10n-ithemes-security-pro' ),
									'<a href="https://ithemes.com/privacy-policy/" target="_blank">',
									'</a>'
								); ?>
							</li>
						<?php endif; ?>
						<li><?php esc_html_e( 'Automatic – (Not Recommended) iThemes Security will try to find the correct proxy header to use automatically.', 'it-l10n-ithemes-security-pro' ); ?></li>
						<li><?php esc_html_e( 'Manual – Manually select the header your proxy uses.', 'it-l10n-ithemes-security-pro' ); ?></li>
						<li><?php esc_html_e( 'Disabled – Do not use Proxy Detection if your website isn\'t behind a proxy.', 'it-l10n-ithemes-security-pro' ); ?></li>
					</ul>
				</td>
			</tr>
			<tr class="itsec-global-proxy_header-container">
				<th scope="row"><label for="itsec-global-proxy_header"><?php esc_html_e( 'Proxy Header', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_select( 'proxy_header', $proxy_header_opt ); ?>
					<p class="description">
						<?php printf(
							esc_html__( 'Select the header your Proxy Server uses to forward the client IP address. If you don\'t know the header, you can contact your hosting provider or select the header that has your %1$sIP Address%2$s.', 'it-l10n-ithemes-security-pro' ),
							'<a href="https://whatismyipaddress.com">', '</a>'
						); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-hide_admin_bar"><?php _e( 'Hide Security Menu in Admin Bar', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_checkbox( 'hide_admin_bar' ); ?>
					<label for="itsec-global-hide_admin_bar"><?php _e( 'Hide security menu in admin bar.', 'it-l10n-ithemes-security-pro' ); ?></label>
					<p class="description"><?php esc_html_e( 'Remove the Security Messages Menu from the admin bar and receive the messages as traditional WordPress Admin Notices.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="itsec-global-show_error_codes"><?php _e( 'Show Error Codes', 'it-l10n-ithemes-security-pro' ); ?></label></th>
				<td>
					<?php $form->add_select( 'show_error_codes', $show_error_codes_options ); ?>
					<p class="description"><?php _e( 'Each error message in iThemes Security has an associated error code that can help diagnose an issue. Changing this setting to "Yes" causes these codes to display. This setting should be left set to "No" unless iThemes Security support requests that you change it.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<?php if ( ITSEC_Core::is_pro() ) : ?>
				<tr>
					<th scope="row"><label for="itsec-global-enable_grade_report"><?php _e( 'Enable Grade Report', 'it-l10n-ithemes-security-pro' ); ?></label></th>
					<td>
						<?php $form->add_select( 'enable_grade_report', $enable_grade_report_options ); ?>
						<p class="description"><?php _e( 'The Grade Report feature can help you identify vulnerabilities on the site. Visit the Notification Center to select which users receive emails from this feature.', 'it-l10n-ithemes-security-pro' ); ?></p>
					</td>
				</tr>
			<?php endif; ?>
		</table>
		<?php

	}
}

new ITSEC_Global_Settings_Page();
