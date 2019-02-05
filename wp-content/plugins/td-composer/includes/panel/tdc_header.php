<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 20.07.2016
 * Time: 16:21
 */

/*
 * At runtime:
 * - the 'action' of the 'tdc-live-panel' frame is set to the tdcAdminIFrameUI._$liveIframe url parameter
 * - the 'tdc_content' hidden param is set to the current content (the content generated from the backbone structure)
 */

?>




<form id="tdc-live-panel" method="post">

	<input type="hidden" name="td_magic_token" value="<?php echo wp_create_nonce("td-update-panel") ?>"/>

	<?php
		// - 'tdc_action' hidden field can have one of the values: 'tdc_ajax_save_post' or 'preview'
		// - at 'preview' nothing is saved to the database
		// - at 'tdc_ajax_save_post' the content and the live panel settings are saved to the database
	?>

	<input type="hidden" id="tdc_action" name="tdc_action" value="tdc_ajax_save_post">
	<input type="hidden" id="tdc_post_id" name="tdc_post_id" value="<?php echo $post->ID ?>">

	<?php
		// - 'tdc_content' hidden field is the shortcode of the new content
	?>

	<input type="hidden" id="tdc_content" name="tdc_content" value="">
	<input type="hidden" id="tdc_customized" name="tdc_customized" value="">

	<?php if (current_user_can("switch_themes")) { ?>
	<!-- HEADER STYLE -->
	<?php echo td_panel_generator::box_start('Header Style', false); ?>

	<!-- HEADER STYLE -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">HEADER STYLE</span>
			<p>Select the order in which the header elements will be arranged</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::visual_select_o(array(
				'ds' => 'td_option',
				'option_id' => 'tds_header_style',
				'values' => td_api_header_style::_helper_generate_tds_header_style()
			));
			?>
		</div>
	</div>

	<?php echo td_panel_generator::box_end();?>

	<!-- WP SETTINGS -->
	<?php echo td_panel_generator::box_start('Menu Settings', false); ?>

	<?php

	// Get menus
	$menus = wp_get_nav_menus();

	$buffer = '<ul>';
	foreach ( $menus as $menu ) {
		$buffer .= '<li class="tdc-panel-menu" data-menu_id="' . $menu->term_id . '" data-menu_name="' . esc_html( $menu->name ) . '">' . esc_html( $menu->name ) . '</li>';
	}
	$buffer .= '</ul>';

	echo $buffer;

	?>
	
	<?php echo td_panel_generator::box_end();?>


	<!-- PAGE SETTINGS -->
	<?php echo td_panel_generator::box_start('Page Settings', false); ?>
		<a href="#" class="tdc-page-settings"> </a>
	<?php echo td_panel_generator::box_end();?>

    <?php } ?>

	<?php

		// Extensions add their content in 'tdc-live-panel' (usually their own hidden input fields that will be saved by composer - see 'tdc_extension_save' action)
		do_action( 'tdc_extension_settings' );

	?>

</form>

