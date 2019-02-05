<!-- MOBILE MENU BACKGROUND -->
<?php echo td_panel_generator::box_start('Fonts', false); ?>

    <!-- FONT SETTINGS -->
    <div class="td-section-separator">Font Settings</div>
    <?php
    foreach (td_api_multi_purpose::$typography_settings_list as $panel_section => $font_settings_array) {
	    $panel_section_name = str_replace('mp_', '', $panel_section);

	    echo td_panel_generator::ajax_box($panel_section_name,
            array(
                'td_ajax_calling_file' => 'td_panel_theme_fonts',
                'td_ajax_box_id' => 'td_get_font_section_by_section_id',
                'section_name' => $panel_section,
                'td_ajax_view' => 'td_theme_fonts',
	            'type' => 'in_theme',
            )
        );
    }
    ?>

<?php echo td_panel_generator::box_end();?>