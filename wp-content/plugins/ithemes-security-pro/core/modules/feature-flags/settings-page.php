<?php

class ITSEC_Feature_Flags_Settings_Page extends ITSEC_Module_Settings_Page {

	public function __construct() {
		parent::__construct();

		$this->id          = 'feature-flags';
		$this->title       = esc_html__( 'Feature Flags', 'it-l10n-ithemes-security-pro' );
		$this->description = esc_html__( 'Toggle feature flags.', 'it-l10n-ithemes-security-pro' );
		$this->type        = 'advanced';
	}

	public function register() {
		ITSEC_Lib::load( 'feature-flags' );

		if ( ITSEC_Lib_Feature_Flags::get_available_flags() ) {
			parent::register();
		}
	}

	protected function render_description( $form ) {
		echo '<p>';
		echo esc_html__( 'Toggle feature flags.', 'it-l10n-ithemes-security-pro' );
		echo '</p>';
	}

	protected function render_settings( $form ) {
		ITSEC_Lib::load( 'feature-flags' );

		foreach ( ITSEC_Lib_Feature_Flags::get_available_flags() as $flag => $config ) {
			if ( is_callable( $config['title'] ) ) {
				$title = call_user_func( $config['title'] );
			} elseif ( $config['title'] ) {
				$title = $config['title'];
			} else {
				$title = ucwords( str_replace( '_', ' ', $flag ) );
			}

			if ( is_callable( $config['description'] ) ) {
				$description = call_user_func( $config['description'] );
			} else {
				$description = $config['description'];
			}

			$form->set_option( $flag, ITSEC_Lib_Feature_Flags::is_enabled( $flag ) );

			$cb_opts = array();

			if ( defined( 'ITSEC_FF_' . $flag ) ) {
				$cb_opts['disabled'] = true;
			}
			?>
			<table class="form-table itsec-settings-section">
				<tbody>
				<tr>
					<th scope="row">
						<label for="itsec-feature-flags-<?php echo esc_attr( $flag ); ?>"><?php echo $title; ?></label>
					</th>
					<td>
						<?php $form->add_checkbox( $flag, $cb_opts ); ?>
						<?php if ( $description ): ?>
							<p class="description"><?php echo $description; ?></p>
						<?php endif; ?>
					</td>
				</tr>
				</tbody>
			</table>
			<?php
		}
	}

	public function handle_form_post( $data ) {
		ITSEC_Lib::load( 'feature-flags' );

		foreach ( $data as $flag => $enabled ) {
			if ( defined( 'ITSEC_FF_' . $flag ) ) {
				continue;
			}

			if ( $enabled ) {
				ITSEC_Lib_Feature_Flags::enable( $flag );
			} else {
				ITSEC_Lib_Feature_Flags::disable( $flag );
			}
		}
	}
}

new ITSEC_Feature_Flags_Settings_Page();
