<div class="itsec-pwls-login-wrap">
	<?php if ( $is_available ) : ?>
		<?php require( __DIR__ . '/../prompt-form-fields.php' ); ?>
		<?php require( __DIR__ . '/../fallback.php' ); ?>
	<?php endif; ?>
</div>
<input type="hidden" name="log" value="<?php echo esc_attr( $username ) ?>">
