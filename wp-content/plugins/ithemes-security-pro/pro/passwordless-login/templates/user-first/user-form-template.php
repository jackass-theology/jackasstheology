<script type="text/template" id="tmpl-itsec-pwls-login-user-form">
	<form id="itsec-pwls-login-user-form">
		<p>
			<label for="itsec-pwls-login-user-form__username"><?php echo $user_lookup_fields_label; ?><br>
				<input type="text" name="log" id="itsec-pwls-login-user-form__username" class="input" value="" size="20" autocapitalize="off">
			</label>
		</p>

		<p class="submit">
			<input type="submit" id="itsec-pwls-login-user-form__continue" class="button button-primary button-large" value="<?php esc_attr_e( 'Continue', 'it-l10n-ithemes-security-pro' ) ?>">
		</p>
	</form>
</script>
