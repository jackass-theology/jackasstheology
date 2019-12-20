<?php

final class ITSEC_Passwordless_Login_Settings_Page extends ITSEC_Module_Settings_Page {

	public function __construct() {
		$this->id          = 'passwordless-login';
		$this->title       = __( 'Passwordless Login', 'it-l10n-ithemes-security-pro' );
		$this->description = __( 'Enable logging in without a password.', 'it-l10n-ithemes-security-pro' );
		$this->pro         = true;

		parent::__construct();
	}

	public function enqueue_scripts_and_styles() {
		wp_enqueue_style( 'itsec-passwordless-login-settings-page', plugin_dir_url( __FILE__ ) . 'css/settings-page.css' );
		wp_enqueue_script( 'itsec-passwordless-login-settings-page', plugin_dir_url( __FILE__ ) . 'js/settings-page.js', array( 'jquery' ) );
	}

	protected function render_description( $form ) {
		echo '<p>';
		esc_html_e( 'Enable Passwordless Login to login bypassing the password and Two-Factor requirements. Request to receive an email with a special login link from the WordPress login page.', 'it-l10n-ithemes-security-pro' );
		echo '</p>';
	}

	/**
	 * @param ITSEC_Form $form
	 */
	protected function render_settings( $form ) {
		require_once( __DIR__ . '/class-passwordless-login-integrations.php' );

		/** @var ITSEC_Passwordless_Login_Validator $validator */
		$validator = ITSEC_Modules::get_validator( $this->id );

		$login_2fa_bypass_types = $validator->get_login_2fa_bypass_types();

		if ( ! ITSEC_Modules::get_setting( 'passwordless-login', '2fa_bypass' ) ) {
			$login_2fa_bypass_types = array_merge( array( '' => esc_html__( '- Select a Type -', 'it-l10n-ithemes-security-pro' ) ), $login_2fa_bypass_types );
		}
		?>
		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="itsec-passwordless-login-login">
						<?php esc_html_e( 'Enable For', 'it-l10n-ithemes-security-pro' ); ?>
					</label>
				</th>
				<td>
					<?php $form->add_select( 'login', $validator->get_login_user_types() ); ?>
					<p class="description"><?php esc_html_e( 'Send an email with a secure link that allows you to login without entering a password.', 'it-l10n-ithemes-security-pro' ); ?></p>
				</td>
			</tr>
			<tr class="itsec-passwordless-login-login--show-if-custom">
				<th scope="row"><label for="itsec-passwordless-login-roles"><?php esc_html_e( 'Passwordless Login Roles', 'it-l10n-ithemes-security-pro' ) ?></label></th>
				<td>
					<ul class="itsec-passwordless-login-roles-list">
						<?php foreach ( $validator->get_login_user_roles() as $role => $name ): ?>
							<li>
								<?php $form->add_multi_checkbox( 'roles', $role ); ?>
								<label for="<?php echo $form->get_clean_var( $role ); ?>">
									<?php echo esc_html( $name ); ?>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="itsec-passwordless-login-availability">
						<?php esc_html_e( 'Per-User Availability', 'it-l10n-ithemes-security-pro' ); ?>
					</label>
				</th>
				<td>
					<?php $form->add_select( 'availability', $validator->get_login_availability_types() ); ?>
					<p class="description">
						<?php esc_html_e( 'By default, all user roles selected above will be able to use Passwordless Login. Change to “Disabled” if you prefer to have users opt-in on their individual profiles.', 'it-l10n-ithemes-security-pro' ) ?>
					</p>
				</td>
			</tr>
			<?php if ( ITSEC_Modules::is_active( 'two-factor' ) ): ?>
				<tr>
					<th scope="row">
						<label for="itsec-passwordless-login-2fa_bypass">
							<?php esc_html_e( 'Allow Two-Factor Bypass for Passwordless Login', 'it-l10n-ithemes-security-pro' ) ?>
						</label>
					</th>
					<td>
						<?php $form->add_select( '2fa_bypass', $login_2fa_bypass_types ) ?>
						<p class="description">
							<?php esc_html_e( 'Add option in the WordPress user profile for selected users to bypass two-factor authentication when using passwordless login.', 'it-l10n-ithemes-security-pro' ); ?>
						</p>
					</td>
				</tr>
				<tr class="itsec-passwordless-login-2fa_bypass--show-if-custom">
					<th scope="row">
						<label for="itsec-passwordless-login-2fa_bypass_roles">
							<?php esc_html_e( 'Allow Two-Factor Bypass for Passwordless Login Roles', 'it-l10n-ithemes-security-pro' ); ?>
						</label>
					</th>
					<td>
						<ul class="itsec-passwordless-login-roles-list">
							<?php foreach ( $validator->get_login_user_roles() as $role => $name ): ?>
								<li>
									<?php $form->add_multi_checkbox( '2fa_bypass_roles', $role ); ?>
									<label for="<?php echo $form->get_clean_var( $role ); ?>">
										<?php echo esc_html( $name ); ?>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<th scope="row">
					<label for="itsec-passwordless-login-flow">
						<?php esc_html_e( 'Passwordless Login Flow', 'it-l10n-ithemes-security-pro' ) ?>
					</label>
				</th>
				<td>
					<?php $form->add_select( 'flow', $validator->get_flow_types() ); ?>
					<p>
						<?php printf( esc_html__( '%1$sMethod First%2$s - Choose between the traditional and Passwordless Login methods before entering a username or email address.', 'it-l10n-ithemes-security-pro' ), '<strong>', '</strong>' ); ?>
					</p>
					<p>
						<?php printf( esc_html__( '%1$sUsername First%2$s - Enter the username or email address first before selecting the login method.', 'it-l10n-ithemes-security-pro' ), '<strong>', '</strong>' ); ?>
					</p>
				</td>
			</tr>
		</table>
		<?php if ( $integrations = ITSEC_Passwordless_Login_Integrations::get_integrations() ): ?>
			<?php $form->add_input_group( 'integrations' ); ?>
			<h3><?php esc_html_e( 'Integrations', 'it-l10n-ithemes-security-pro' ); ?></h3>

			<table class="form-table">
				<?php foreach ( $integrations as $integration ): ?>
					<?php $form->add_input_group( $integration->get_slug() ); ?>
					<tr>
						<th scope="row">
							<label for="<?php echo $form->get_clean_var( 'enabled' ) ?>">
								<?php printf( esc_html__( 'Enable %s', 'it-l10n-ithemes-security-pro' ), $integration->get_name() ) ?>
							</label>
						</th>
						<td>
							<?php $form->add_checkbox( 'enabled' ); ?>
						</td>
					</tr>
					<?php $form->remove_input_group(); ?>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<?php
	}
}

new ITSEC_Passwordless_Login_Settings_Page();
