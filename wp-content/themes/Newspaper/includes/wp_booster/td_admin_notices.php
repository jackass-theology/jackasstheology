<?php

/**
 * Class td_admin_notice
 * - it allows us to display dynamic messages on admin_notices
 */

class td_admin_notices {

	private $message;
	private $css_classes = array( 'notice' );

	public function __construct( $message, $css_classes ) {

		$this->message = $message;

		if( ! empty( $css_classes ) && is_array( $css_classes ) ) {
			$this->css_classes = array_merge( $this->css_classes, $css_classes );
		}

		add_action( 'admin_notices', array( $this, 'notice' ) );
	}

	public function notice() {
		?>
		<div class="<?php echo implode( ' ', $this->css_classes ); ?>">
			<p><?php echo $this->message; ?></p>
		</div>
		<?php
	}

}