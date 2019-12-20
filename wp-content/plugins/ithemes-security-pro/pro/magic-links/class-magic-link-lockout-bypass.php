<?php

use \iThemesSecurity\Lib\Lockout;
use \iThemesSecurity\Lib\Lockout\Execute_Lock;

class ITSEC_Magic_Link_Lockout_Bypass {

	const ACTION = 'itsec-ml-lockout-bypass';
	const OT_LOCKOUT_BYPASS = 'ml-lockout-bypass'; // Opaque Token Type for Lockout Bypass
	const OT_PROMPT_LOCKOUT_BYPASS = 'ml-lockout-bypass-prompt'; // Opaque Token Type for requesting a Lockout Bypass.

	const EXPIRES = 1800; // 15 Minutes

	const TOKEN_VAR = 'itsec-ml-lockout-bypass';
	const COOKIE_VAR = 'itsec-ml-lockout-bypass';

	const E_MISSING = 'itsec-magic-links-missing-token';
	const E_MAIL_FAILED = 'itsec-magic-links-mail-failed';

	const NOTIFICATION = 'magic-link-login-page';

	/** @var WP_Error */
	private $error;

	/** @var string */
	private $info_message;

	/**
	 * ITSEC_Magic_Links constructor.
	 */
	public function __construct() {
		$this->error = new WP_Error();
	}

	/**
	 * Setup the magic links module.
	 */
	public function run() {
		add_filter( 'itsec_lockout_action_links', array( $this, 'include_action_link_on_lockout_page' ), 10, 2 );
		add_action( 'itsec_lockout_template_before_actions', array( $this, 'add_lockout_bypass_instructions_to_lockout_template' ) );
		add_action( 'login_form_' . self::ACTION, array( $this, 'trigger_send_lockout_bypass_email' ) );
		add_filter( 'itsec_do_lockout', array( $this, 'maybe_prevent_do_lockout' ), 10, 2 );
		add_filter( 'itsec_execute_lock', array( $this, 'maybe_prevent_execute_lock' ), 10, 2 );
		add_action( 'wp_login', array( $this, 'cleanup_on_login' ), 100, 2 );
		add_filter( 'wp_login_errors', array( $this, 'report_error_on_wp_login' ) );
		add_action( 'init', array( $this, 'set_cookie_for_magic_link' ) );
		add_filter( 'itsec_notifications', array( $this, 'register_notifications' ) );
		add_filter( 'itsec_' . self::NOTIFICATION . '_notification_strings', array( $this, 'notification_strings' ) );
	}

	/**
	 * Add additional instructions.
	 *
	 * @param array                $actions
	 * @param Execute_Lock\Context $context
	 *
	 * @return array
	 */
	public function include_action_link_on_lockout_page( $actions, $context ) {
		$user     = $this->get_user_from_context( $context );
		$username = $this->get_username_from_context( $context );
		$source   = $context->get_source();

		if ( ! $user && ! $username ) {
			return $actions;
		}

		ITSEC_Lib::load( 'opaque-tokens' );
		$token = ITSEC_Lib_Opaque_Tokens::create_token( self::OT_PROMPT_LOCKOUT_BYPASS, array(
			'user_id'    => $user ? $user->ID : 0,
			'username'   => $username,
			'lockout_id' => $source instanceof Lockout\Lockout ? $source->get_id() : 0,
		) );

		if ( is_wp_error( $token ) ) {
			return $actions;
		}

		$actions[] = array(
			'label' => __( 'Send Magic Link', 'it-l10n-ithemes-security-pro' ),
			'uri'   => add_query_arg( array(
				'action' => self::ACTION,
				'token'  => $token,
			), wp_login_url() )
		);

		return $actions;
	}

	/**
	 * Add instructions about how the lockout bypass works to the lockout template.
	 *
	 * @param Execute_Lock\Context $context
	 */
	public function add_lockout_bypass_instructions_to_lockout_template( $context ) {
		if ( ! $this->get_user_from_context( $context ) && ! $this->get_username_from_context( $context ) ) {
			return;
		}

		echo '<p>';
		echo __( 'If you are a verified user, click the button below and an email will be sent to you with a magic link to bypass the lock out and log into your site.', 'it-l10n-ithemes-security-pro' );
		echo '</p>';
	}

	/**
	 * When the login page is loaded with the send login page token action, attempt to send the email.
	 *
	 * Pretends the email was successfully even if the username does not exist to prevent trivial username disclosure.
	 */
	public function trigger_send_lockout_bypass_email() {
		/** @var ITSEC_Lockout $itsec_lockout */
		global $itsec_lockout;

		if ( empty( $_REQUEST['token'] ) ) {
			return;
		}

		$token = $_REQUEST['token'];

		ITSEC_Lib::load( 'opaque-tokens' );
		$data = ITSEC_Lib_Opaque_Tokens::verify_and_get_token_data( self::OT_PROMPT_LOCKOUT_BYPASS, $token, self::EXPIRES );

		if ( is_wp_error( $data ) ) {
			ITSEC_Lib::add_to_wp_error( $this->error, $data );

			return;
		}

		ITSEC_Lib_Opaque_Tokens::delete_token( $token );

		$user_id = $data['user_id'];

		try {
			$lockout = $data['lockout_id'] ? $itsec_lockout->get_lockout( $data['lockout_id'], OBJECT ) : false;
		} catch ( \Exception $e ) {
			wp_die();
		}

		$success    = ! $user_id || $this->send_lockout_bypass_email( $user_id, $data['lockout_id'] );
		$show_login = $lockout && ! $lockout->get_host();

		if ( $success ) {
			$this->info_message = esc_html__( 'Please check your email for an authorized login link.', 'it-l10n-ithemes-security-pro' );

			if ( ! $show_login ) {
				wp_die( $this->info_message, '', array( 'response' => 200 ) );
			}
		} else {
			$this->error->add( self::E_MAIL_FAILED, esc_html__( 'The email could not be sent.', 'it-l10n-ithemes-security-pro' ) );

			if ( ! $show_login ) {
				wp_die( $this->error );
			}
		}
	}

	/**
	 * Maybe prevent a lockout from occurring.
	 *
	 * @param bool            $do_lockout
	 * @param Lockout\Context $context
	 *
	 * @return bool True to do the lockout, false not to.
	 */
	public function maybe_prevent_do_lockout( $do_lockout, $context ) {
		$token_data = $this->verify_and_get_token_data();

		if ( is_wp_error( $token_data ) ) {
			return $do_lockout;
		}

		if ( $context instanceof Lockout\User_Context && $context->get_user_id() === $token_data['user'] ) {
			return false;
		}

		if (
			$context instanceof Lockout\Host_Context &&
			$context->get_host() === $token_data['host'] &&
			$context->get_login_user_id() === $token_data['user']
		) {
			return false;
		}

		return $do_lockout;
	}

	/**
	 * Prevent the user lockout from firing if the user has valid tokens.
	 *
	 * @param bool                 $execute
	 * @param Execute_Lock\Context $context
	 *
	 * @return bool True to execute the lock, false not to.
	 */
	public function maybe_prevent_execute_lock( $execute, $context ) {
		$is_login = isset( $GLOBALS['pagenow'] ) && 'wp-login.php' === $GLOBALS['pagenow'];

		if ( $is_login && isset( $_REQUEST['action'] ) && self::ACTION === $_REQUEST['action'] ) {
			return false;
		}

		$token_data = $this->verify_and_get_token_data();

		if ( is_wp_error( $token_data ) ) {
			if ( $token_data->get_error_code() !== self::E_MISSING ) {
				ITSEC_Lib::add_to_wp_error( $this->error, $token_data );
			}

			return $execute;
		}

		if ( $user = $this->get_user_from_context( $context ) ) {
			return $token_data['user'] === $user->ID ? false : $execute;
		}

		return $execute;
	}

	/**
	 * When a user logs in successfully, clear their magic link token and any host lockouts.
	 *
	 * @param string  $username
	 * @param WP_User $user
	 */
	public function cleanup_on_login( $username, $user ) {
		if ( ! $token = $this->extract_token_from_state() ) {
			return;
		}

		ITSEC_Lib::clear_cookie( self::COOKIE_VAR );

		ITSEC_Lib::load( 'opaque-tokens' );

		$data = ITSEC_Lib_Opaque_Tokens::verify_and_get_token_data( self::OT_LOCKOUT_BYPASS, $token, self::EXPIRES );
		ITSEC_Lib_Opaque_Tokens::delete_token( $token );

		if ( is_wp_error( $data ) ) {
			return;
		}

		if ( $data['user'] !== $user->ID ) {
			return;
		}
	}

	/**
	 * Set a cookie from the magic link URL vars.
	 */
	public function set_cookie_for_magic_link() {
		/** @var ITSEC_Lockout $itsec_lockout */
		global $itsec_lockout;

		if ( empty( $_REQUEST[ self::TOKEN_VAR ] ) ) {
			return;
		}

		ITSEC_Lib::load( 'opaque-tokens' );

		$data = ITSEC_Lib_Opaque_Tokens::verify_and_get_token_data( self::OT_LOCKOUT_BYPASS, $_REQUEST[ self::TOKEN_VAR ], self::EXPIRES );

		if ( is_wp_error( $data ) ) {
			ITSEC_Lib::add_to_wp_error( $this->error, $data );

			return;
		}

		ITSEC_Lib::set_cookie( self::COOKIE_VAR, $_REQUEST[ self::TOKEN_VAR ], array(
			'length' => self::EXPIRES,
		) );

		if ( ! empty( $data['lockout_id'] ) ) {
			$itsec_lockout->release_lockout( $data['lockout_id'] );
		}
	}

	/**
	 * Display an error if the email to send the login page link failed.
	 *
	 * @param WP_Error $errors
	 *
	 * @return WP_Error
	 */
	public function report_error_on_wp_login( $errors ) {

		if ( ! is_wp_error( $errors ) ) {
			$errors = new WP_Error();
		}

		ITSEC_Lib::add_to_wp_error( $this->error, $errors );

		if ( $this->info_message ) {
			$errors->add( 'sent', $this->info_message, 'message' );
		}

		return $errors;
	}

	/**
	 * Generate a link to the login page that will allow a user to login even if a brute force lockout exists.
	 *
	 * @param WP_User|int|string $user
	 * @param int                $lockout_id
	 *
	 * @return string|false
	 */
	public function generate_login_page_link( $user, $lockout_id = 0 ) {

		$user = ITSEC_Lib::get_user( $user );

		if ( ! $user ) {
			return false;
		}

		ITSEC_Lib::load( 'opaque-tokens' );
		$token = ITSEC_Lib_Opaque_Tokens::create_token( self::OT_LOCKOUT_BYPASS, array(
			'user'       => (int) $user->ID,
			'host'       => ITSEC_Lib::get_ip(),
			'lockout_id' => $lockout_id,
		) );

		if ( ! $token ) {
			return false;
		}

		return add_query_arg( self::TOKEN_VAR, $token, wp_login_url() );
	}

	/**
	 * Register the Magic Links notifications.
	 *
	 * @param array $notifications
	 *
	 * @return array
	 */
	public function register_notifications( $notifications ) {
		$notifications[ self::NOTIFICATION ] = array(
			'recipient'        => ITSEC_Notification_Center::R_USER,
			'schedule'         => ITSEC_Notification_Center::S_NONE,
			'subject_editable' => true,
			'message_editable' => true,
			'tags'             => array( 'username', 'display_name', 'login_url', 'site_title', 'site_url' ),
			'module'           => 'magic-links',
		);

		return $notifications;
	}

	/**
	 * Register strings for the Magic Links Lockout Bypass notification.
	 *
	 * @return array
	 */
	public function notification_strings() {
		return array(
			'label'       => esc_html__( 'Magic Links Lockout Bypass', 'it-l10n-ithemes-security-pro' ),
			'description' => sprintf( esc_html__( 'The %1$sMagic Links%2$s module sends an email with a Magic Link that bypasses a lockout. Note: the default email template already includes the %3$s tag.' ), '<a href="#" data-module-link="magic-links">', '</a>', '<code>login_url</code>' ),
			'tags'        => array(
				'username'     => esc_html__( "The recipient's WordPress username.", 'it-l10n-ithemes-security-pro' ),
				'display_name' => esc_html__( "The recipient's WordPress display name.", 'it-l10n-ithemes-security-pro' ),
				'login_url'    => esc_html__( 'The magic login link to continue logging in.', 'it-l10n-ithemes-security-pro' ),
				'site_title'   => esc_html__( 'The WordPress Site Title. Can be changed under Settings -> General -> Site Title', 'it-l10n-ithemes-security-pro' ),
				'site_url'     => esc_html__( 'The URL to your website.', 'it-l10n-ithemes-security-pro' ),
			),
			'subject'     => esc_html__( 'Login Link', 'it-l10n-ithemes-security-pro' ),
			'message'     => esc_html__( 'Hi {{ $display_name }},

For security purposes, please click the button below to login.

Regards,
All at {{ $site_title }}', 'it-l10n-ithemes-security-pro' ),
		);
	}

	/**
	 * Send the link to an unlocked login page to a given user.
	 *
	 * @param WP_User|int|string $user
	 * @param int                $lockout_id
	 *
	 * @return bool
	 */
	private function send_lockout_bypass_email( $user, $lockout_id = 0 ) {

		$user = ITSEC_Lib::get_user( $user );
		$link = $this->generate_login_page_link( $user, $lockout_id );

		if ( ! $link ) {
			return false;
		}

		$nc = ITSEC_Core::get_notification_center();

		$mail = $nc->mail();
		$mail->set_recipients( array( $user->user_email ) );

		$mail->add_header( esc_html__( 'Login Link', 'it-l10n-ithemes-security-pro' ), sprintf( esc_html__( 'Secure login link for %s', 'it-l10n-ithemes-security-pro' ), '<b>' . get_bloginfo( 'name', 'display' ) . '</b>' ), true );
		$mail->add_text( ITSEC_Lib::replace_tags( $nc->get_message( self::NOTIFICATION ), array(
			'username'     => $user->user_login,
			'display_name' => $user->display_name,
			'login_url'    => $link,
			'site_title'   => get_bloginfo( 'name', 'display' ),
			'site_url'     => $mail->get_display_url(),
		) ) );
		$mail->add_button( esc_html__( 'Continue Login', 'it-l10n-ithemes-security-pro' ), $link );
		$mail->add_user_footer();

		return $nc->send( self::NOTIFICATION, $mail );
	}

	/**
	 * Get the user from a lock context.
	 *
	 * @param Execute_Lock\Context $context
	 *
	 * @return WP_User|null
	 */
	private function get_user_from_context( Execute_Lock\Context $context ) {
		if ( $context instanceof Execute_Lock\User_Context ) {
			return get_userdata( $context->get_user_id() ) ?: null;
		}

		if ( $context instanceof Execute_Lock\Host_Context && $user_id = $context->get_login_user_id() ) {
			return get_userdata( $user_id ) ?: null;
		}

		$source = $context->get_source();

		if ( $source instanceof Lockout\Host_Context && $user_id = $source->get_login_user_id() ) {
			return get_userdata( $user_id ) ?: null;
		}

		return null;
	}

	/**
	 * Get the user from a lock context.
	 *
	 * @param Execute_Lock\Context $context
	 *
	 * @return string
	 */
	private function get_username_from_context( Execute_Lock\Context $context ) {
		if ( $context instanceof Execute_Lock\Username_Context ) {
			return $context->get_username();
		}

		if ( $context instanceof Execute_Lock\Host_Context && $username = $context->get_login_username() ) {
			return $username;
		}

		$source = $context->get_source();

		if ( $source instanceof Lockout\Host_Context && $username = $source->get_login_username() ) {
			return $username;
		}

		return null;
	}

	/**
	 * Check for valid magic link tokens.
	 *
	 * @return array|WP_Error
	 */
	private function verify_and_get_token_data() {
		$token = $this->extract_token_from_state();

		if ( ! $token ) {
			return new WP_Error( self::E_MISSING, esc_html__( 'No magic link token found.', 'it-l10n-ithemes-security-pro' ) );
		}

		ITSEC_Lib::load( 'opaque-tokens' );

		$data = ITSEC_Lib_Opaque_Tokens::verify_and_get_token_data( self::OT_LOCKOUT_BYPASS, $token, self::EXPIRES );

		if ( isset( $_COOKIE[ self::COOKIE_VAR ] ) && is_wp_error( $data ) ) {
			ITSEC_Lib::clear_cookie( self::COOKIE_VAR );
		}

		return $data;
	}

	/**
	 * Extract the token pair from the request state.
	 *
	 * @return string
	 */
	private function extract_token_from_state() {

		if ( ! empty( $_REQUEST[ self::TOKEN_VAR ] ) ) {
			return $_REQUEST[ self::TOKEN_VAR ];
		}

		if ( ! empty( $_COOKIE[ self::COOKIE_VAR ] ) ) {
			return $_COOKIE[ self::COOKIE_VAR ];

		}

		return '';
	}
}
