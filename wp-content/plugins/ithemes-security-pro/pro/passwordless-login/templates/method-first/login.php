<div class="itsec-pwls-login-wrap">
	<img class="itsec-pwls-login__logo" height="116" src="<?php echo esc_url( plugin_dir_url( dirname( __DIR__ ) ) . 'img/icon.svg' ); ?>" alt="">
	<p class="itsec-pwls-login__title"><?php esc_html_e( 'Want an easier way to login?', 'it-l10n-ithemes-security-pro' ); ?></p>
	<p class="itsec-pwls-login__description"><?php esc_html_e( 'Get a magic link sent to your email that will sign you in instantly!', 'it-l10n-ithemes-security-pro' ); ?></p>

	<?php require( __DIR__ . '/../prompt-link.php' ); ?>

	<?php require( __DIR__ . '/../fallback.php' ); ?>
</div>
<script type="text/template" id="tmpl-itsec-pwls-login-prompt-form">
	<?php require( __DIR__ . '/../prompt-form-fields.php' ); ?>
</script>
