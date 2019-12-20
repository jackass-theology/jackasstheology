<?php

use iThemesSecurity\Lib\Lockout\Host_Context;
use ITSEC_Passwordless_Login_Interstitial as Interstitial;
use ITSEC_Passwordless_Login_2fa_Setting_Interstitial as Setting_Interstitial;

class ITSEC_Passwordless_Login_Utilities {

	const META_ENABLED = '_itsec_passwordless_login_enabled';
	const META_USE_2FA = '_itsec_passwordless_login_use_2fa';
	const META_REMIND_2FA = '_itsec_passwordless_login_remind_2fa';
	const META_USES = '_itsec_passwordless_login_uses';

	/**
	 * Can the given user use Magic Login.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function can_user_use( WP_User $user ) {
		if ( ! self::is_enabled_for_user( $user ) ) {
			return false;
		}

		return self::is_available_for_user( $user );
	}

	/**
	 * Is magic login available for the user.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function is_available_for_user( WP_User $user ) {
		switch ( ITSEC_Modules::get_setting( 'passwordless-login', 'login' ) ) {
			case 'all':
				return true;
			case 'disabled':
				return false;
			case 'non_privileged':
				ITSEC_Lib::load( 'canonical-roles' );

				return ! ITSEC_Lib_Canonical_Roles::is_user_at_least( 'contributor', $user );
			case 'custom':
				foreach ( ITSEC_Modules::get_setting( 'passwordless-login', 'roles' ) as $role ) {
					if ( in_array( $role, $user->roles, true ) ) {
						return true;
					}
				}

				return false;
			default:
				return false;
		}
	}

	/**
	 * Does the user still have to complete Two Factor when using Magic Login.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function is_2fa_used_by_user( WP_User $user ) {
		if ( self::is_2fa_enforced_for_user( $user ) ) {
			return true;
		}

		if ( self::is_2fa_enabled_for_user( $user ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Is using 2fa during a magic login enforced for the user due to the ITSEC settings.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function is_2fa_enforced_for_user( WP_User $user ) {
		switch ( ITSEC_Modules::get_setting( 'passwordless-login', '2fa_bypass' ) ) {
			case 'all':
				return false;
			case 'non_privileged':
				ITSEC_Lib::load( 'canonical-roles' );

				return ITSEC_Lib_Canonical_Roles::is_user_at_least( 'contributor', $user );
			case 'custom':
				$bypass_roles = ITSEC_Modules::get_setting( 'passwordless-login', '2fa_bypass_roles' );

				foreach ( $user->roles as $role ) {
					if ( ! in_array( $role, $bypass_roles, true ) ) {
						return true;
					}
				}

				return false;
			case 'none':
			default:
				return true;
		}
	}

	/**
	 * Is magic login enabled for the user.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function is_enabled_for_user( WP_User $user ) {
		switch ( get_user_meta( $user->ID, self::META_ENABLED, true ) ) {
			case 'enabled':
				return true;
			case 'disabled':
				return false;
			default:
				return 'enabled' === ITSEC_Modules::get_setting( 'passwordless-login', 'availability' );
		}
	}

	/**
	 * Set whether magic login is enabled for the user.
	 *
	 * @param WP_User $user
	 * @param bool    $enabled
	 */
	public static function set_enabled_for_user( WP_User $user, $enabled ) {
		update_user_meta( $user->ID, self::META_ENABLED, $enabled ? 'enabled' : 'disabled' );
	}

	/**
	 * Is magic login 2fa enabled for the user.
	 *
	 * A user can specifically opt-out of 2fa if it isn't required for their account.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function is_2fa_enabled_for_user( WP_User $user ) {
		return 'disabled' !== get_user_meta( $user->ID, self::META_USE_2FA, true );
	}

	/**
	 * Set whether magic login 2fa is enabled for the user.
	 *
	 * @param WP_User $user
	 * @param bool    $enabled
	 */
	public static function set_2fa_enabled_for_user( WP_User $user, $enabled ) {
		update_user_meta( $user->ID, self::META_USE_2FA, $enabled ? 'enabled' : 'disabled' );
	}

	/**
	 * Should a user be reminded about configuring whether they want to use 2fa during a magic login.
	 *
	 * @param WP_User $user
	 *
	 * @return bool
	 */
	public static function should_remind_user_about_2fa( WP_User $user ) {
		if ( self::is_2fa_enforced_for_user( $user ) ) {
			return false;
		}

		return (bool) get_user_meta( $user->ID, self::META_REMIND_2FA, true );
	}

	/**
	 * Set whether to remind a user about configuring 2fa.
	 *
	 * @param WP_User $user
	 * @param bool    $remind
	 */
	public static function set_remind_user_about_2fa( WP_User $user, $remind ) {
		if ( $remind ) {
			update_user_meta( $user->ID, self::META_REMIND_2FA, true );
		} else {
			delete_user_meta( $user->ID, self::META_REMIND_2FA );
		}
	}

	/**
	 * Record that magic login has been used by a user.
	 *
	 * @param WP_User $user
	 */
	public static function record_use( WP_User $user ) {
		// I don't care about this possible race condition
		$uses = self::get_uses( $user );
		$uses ++;

		if ( 1 === $uses ) {
			self::set_remind_user_about_2fa( $user, true );
		}

		update_user_meta( $user->ID, self::META_USES, $uses );
	}

	/**
	 * Get the number of times a magic login has been used.
	 *
	 * @param WP_User $user
	 *
	 * @return int
	 */
	public static function get_uses( WP_User $user ) {
		return (int) get_user_meta( $user->ID, self::META_USES, true );
	}

	/**
	 * Enqueue the scripts needed for powering the login modal.
	 */
	public static function enqueue_modal_scripts() {
		wp_enqueue_script( 'itsec-pwls-login-modal' );
		wp_enqueue_style( 'itsec-pwls-login-modal' );
	}

	/**
	 * Render the link to launch the Passwordless Login modal.
	 *
	 * @param string $redirect_to
	 *
	 * @return string
	 */
	public static function render_modal_link( $redirect_to = '' ) {
		if ( ! $redirect_to ) {
			$redirect_to = get_permalink();
		}

		$login_url   = wp_login_url( $redirect_to );
		$interim_url = add_query_arg( array( 'interim-login' => 1, ITSEC_Passwordless_Login::MODAL_LOGIN => 1 ), $login_url );

		$current_domain = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'];
		$same_domain    = ( strpos( $login_url, $current_domain ) === 0 );
		$same_domain    = apply_filters( 'wp_auth_check_same_domain', $same_domain );
		$class          = $same_domain ? 'itsec-pwls-login-modal-prompt' : 'itsec-pwls-login-prompt';

		self::enqueue_modal_scripts();
		ob_start();
		?>
		<a href="<?php echo esc_url( $login_url ); ?>" data-interim="<?php echo esc_url( $interim_url ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php esc_html_e( 'Login Without Password', 'it-l10n-ithemes-security-pro' ); ?>
		</a>
		<?php
		return ob_get_clean();
	}

	/**
	 * Whether recaptcha should be used in the Passwordless Login form.
	 *
	 * @return bool
	 */
	public static function use_recaptcha() {
		return ITSEC_Modules::is_active( 'recaptcha' ) && ITSEC_Modules::get_setting( 'recaptcha', 'login' );
	}

	/**
	 * Handle the login request.
	 *
	 * @param string $identifier Username or Email.
	 *
	 * @return ITSEC_Login_Interstitial_Session|WP_Error
	 */
	public static function handle_login_request( $identifier ) {
		/** @var ITSEC_Lockout $itsec_lockout */
		global $itsec_lockout;

		$error = new WP_Error();

		$fields = ITSEC_Lib_Login::get_user_lookup_fields();
		$user   = ITSEC_Lib_Login::get_user( $identifier );

		if ( self::use_recaptcha() ) {
			$args = array(
				'action' => ITSEC_Recaptcha::A_LOGIN,
			);

			if ( $user ) {
				$args['user'] = $user->ID;
			} else {
				$args['username'] = $identifier;
			}

			$valid = ITSEC_Recaptcha_API::validate( $args );

			if ( is_wp_error( $valid ) ) {
				ITSEC_Lib::add_to_wp_error( $error, $valid );

				return $error;
			}
		}

		if ( ! $user ) {
			$context = new Host_Context( 'brute_force' );
			$context->set_login_username( $_POST['log'] );
			$itsec_lockout->do_lockout( $context );

			if ( array( 'email' ) === $fields || ( in_array( 'email', $fields, true ) && is_email( $identifier ) ) ) {
				$error->add( 'invalid_email', __( '<strong>ERROR</strong>: Invalid email address.' ) );
			} else {
				$error->add( 'invalid_username', __( '<strong>ERROR</strong>: Invalid username.' ) );
			}

			return $error;
		}

		if ( ! self::can_user_use( $user ) ) {
			$error->add(
				'itsec-passwordless-login-not-allowed',
				__( 'Passwordless Login is not enabled for your account. Please login with your username and password.', 'it-l10n-ithemes-security-pro' )
			);

			return $error;
		}

		$session = ITSEC_Login_Interstitial_Session::create( $user, Interstitial::SLUG );

		if ( is_wp_error( $session ) ) {
			return $session;
		}

		$session->initialize_from_global_state();
		$session->add_show_after( Interstitial::SLUG );

		if ( ! self::is_2fa_used_by_user( $user ) ) {
			$session->add_completed_interstitial( '2fa' );
		}

		$session->save();

		if ( ! self::send_email( $session ) ) {
			$session->delete();
			$error->add( 'mail_failed', __( 'The email could not be sent. Possible reason: your host may have disabled the mail() function.', 'it-l10n-ithemes-security-pro' ) );

			return $error;
		}

		return $session;
	}

	/**
	 * Send the magic login link to the user.
	 *
	 * @param ITSEC_Login_Interstitial_Session $session
	 *
	 * @return bool
	 */
	private static function send_email( ITSEC_Login_Interstitial_Session $session ) {

		$user = $session->get_user();
		$link = ITSEC_Core::get_login_interstitial()->get_async_action_url( $session, Interstitial::ASYNC_ACTION );
		$nc   = ITSEC_Core::get_notification_center();

		$mail = $nc->mail();
		$mail->set_recipients( array( $user->user_email ) );

		$mail->add_header(
			esc_html__( 'Your Passwordless Login Link is Here', 'it-l10n-ithemes-security-pro' ),
			sprintf( esc_html__( 'Passwordless login link for %s', 'it-l10n-ithemes-security-pro' ), '<b>' . get_bloginfo( 'name', 'display' ) . '</b>' ),
			true
		);

		$mail->add_text( ITSEC_Lib::replace_tags( $nc->get_message( ITSEC_Passwordless_Login::NOTIFICATION ), array(
			'username'     => $user->user_login,
			'display_name' => $user->display_name,
			'login_url'    => $link,
			'site_title'   => get_bloginfo( 'name', 'display' ),
			'site_url'     => $mail->get_display_url(),
		) ) );
		$mail->add_button( esc_html__( 'Login Now →', 'it-l10n-ithemes-security-pro' ), $link );

		$mail->add_image( plugin_dir_url( __FILE__ ) . 'img/icon.png', 163 );
		$mail->add_user_footer();

		return $nc->send( ITSEC_Passwordless_Login::NOTIFICATION, $mail );
	}
}
