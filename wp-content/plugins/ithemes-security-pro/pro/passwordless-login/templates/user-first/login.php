<div class="itsec-pwls-login-wrap">
	<?php if ( $is_available ) : $use_prompt_link = true; ?>
		<?php require( __DIR__ . '/../prompt-form-fields.php' ); ?>
		<?php require( __DIR__ . '/../or.php' ); ?>
	<?php endif; ?>
</div>
<input type="hidden" name="log" value="<?php echo esc_attr( $username ) ?>">
