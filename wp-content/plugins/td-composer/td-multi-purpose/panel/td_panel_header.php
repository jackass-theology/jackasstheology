<!-- MOBILE THEME COLORS -->
<?php echo td_panel_generator::box_start('Header settings', false); ?>

<div class="td-box-section-title">Main menu</div>

<!-- MENU ACTIVE/HOVER STYLES -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Active/Hover styles</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::radio_button_control(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_active',
            'values' => array (
                array('text' => '<strong>Style 1</strong> - Theme default', 'val' => ''),
                array('text' => '<strong>Style 2</strong> - Underline', 'val' => 'tdm-menu-active-style2'),
                array('text' => '<strong>Style 3</strong> </strong>- Color on text', 'val' => 'tdm-menu-active-style3'),
                array('text' => '<strong>Style 4</strong> - Bordered', 'val' => 'tdm-menu-active-style4'),
                array('text' => '<strong>Style 5</strong> - Background', 'val' => 'tdm-menu-active-style5'),
            )
        ));
        ?>
    </div>
</div>

<!-- BUTTON 1 STYLE -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Button 1 style</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        $button_styles = array_merge(
	        array(
		        array('text' => '<strong>Style</strong> - Theme default', 'val' => '')
	        ),
	        td_api_style::get_styles_for_panel ('tds_button')
        );
        echo td_panel_generator::radio_button_control(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_style',
            'values' => $button_styles
        ));
        ?>
    </div>
</div>

<!-- BUTTON 1 TEXT -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Button 1 text</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_text'
        ));
        ?>
    </div>
</div>

<!-- BUTTON 1 URL -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Button 1 url</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_url'
        ));
        ?>
    </div>
</div>

<!-- BUTTON 1 OPEN IN NEW WINDOW -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Open in a new window</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_open_in_new_window',
            'true_value' => 'show',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<!-- BUTTON 2 STYLE -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Button 2 style</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        $button_styles = array_merge(
	        array(
		        array('text' => '<strong>Style</strong> - Theme default', 'val' => '')
	        ),
	        td_api_style::get_styles_for_panel ('tds_button')
        );
        echo td_panel_generator::radio_button_control(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_style',
            'values' => $button_styles
        ));
        ?>
    </div>
</div>

<!-- BUTTON 2 TEXT -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Button 2 text</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_text'
        ));
        ?>
    </div>
</div>

<!-- BUTTON 2 URL -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Button 2 url</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_url'
        ));
        ?>
    </div>
</div>

<!-- BUTTON 2 OPEN IN NEW WINDOW -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Open in a new window</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_open_in_new_window',
            'true_value' => 'show',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>