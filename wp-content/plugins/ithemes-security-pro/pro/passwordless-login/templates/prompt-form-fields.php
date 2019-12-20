<img class="itsec-pwls-login__logo" height="116" src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . 'img/icon.svg' ); ?>" alt="">
<p class="itsec-pwls-login__title"><?php esc_html_e( 'Want an easier way to login?', 'it-l10n-ithemes-security-pro' ); ?></p>
<p class="itsec-pwls-login__description"><?php esc_html_e( 'Get a magic link sent to your email that will sign you in instantly!', 'it-l10n-ithemes-security-pro' ); ?></p>

<div class="itsec-pwls-login__fields">
	<?php if ( ! empty( $username ) ): ?>
		<input type="hidden" name="itsec_magic_link_username" value="<?php echo esc_attr( $username ); ?>">
	<?php else: ?>
		<label for="itsec_magic_link_username"><?php echo $user_lookup_fields_label; ?><br/>
			<input type="text" name="itsec_magic_link_username" id="itsec_magic_link_username" class="input" size="20" autocapitalize="off"/>
		</label>
	<?php endif; ?>
	<?php if ( empty( $use_prompt_link ) ) : ?>
		<button class="itsec-pwls-login__submit" name="itsec_magic_link_login">
			<?php esc_html_e( 'Send', 'it-l10n-ithemes-security-pro' ); ?>
		</button>
	<?php else: ?>
		<?php require( __DIR__ . '/prompt-link.php' ); ?>
	<?php endif; ?>
</div>
