<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 14.03.2017
 * Time: 16:40
 */

class td_live_css_composer {

	static function render_editor() {

		ob_start();
		?>

		<div class="tdc-sidebar-modal tdc-sidebar-modal-live-css" data-button_class="tdc-live-css">
			<div class="tdc-sidebar-modal-content">
				<?php tdc_on_live_css_inject_editor(); ?>
			</div>
		</div>

		<?php
		echo ob_get_clean();
	}
}