<div class="itsec-pwls-login-fallback">
	<?php require( __DIR__ . '/or.php' ); ?>

	<p class="itsec-pwls-login-fallback__link-wrap itsec-pwls-login-fallback__link-wrap--type-wp">
		<a class="itsec-pwls-login-fallback__link" href="<?php echo esc_url( add_query_arg( ITSEC_Passwordless_Login::HIDE, 1, wp_login_url() ) ); ?>">
			<?php esc_html_e( 'Login with username and password', 'it-l10n-ithemes-security-pro' ); ?>
		</a>
	</p>

	<p class="itsec-pwls-login-fallback__link-wrap itsec-pwls-login-fallback__link-wrap--type-ml">
		<a class="itsec-pwls-login-fallback__link" href="<?php echo esc_url( wp_login_url() ); ?>">
			<?php esc_html_e( 'Login with a Magic Link', 'it-l10n-ithemes-security-pro' ); ?>
		</a>
	</p>
</div>
