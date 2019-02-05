<!-- Gradient color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND GRADIENT COLOR</span>
        <p>Select login modal background gradient</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_gradient_one',
            'default_color' => 'rgba(0, 69, 130, 0.8)'
        ));
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_gradient_two',
            'default_color' => 'rgba(38, 134, 146, 0.8)'
        ));
        ?>
    </div>
</div>

<!-- Text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">TEXT/ICONS COLOR</span>
        <p>Select a text/icons color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_text_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<!-- Buttons color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BUTTONS BACKGROUND/TEXT COLOR</span>
        <p>Select background and text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_button_background',
            'default_color' => '#ffffff'
        ));
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_button_color',
            'default_color' => '#000000'
        ));
        ?>
    </div>
</div>

<!-- Buttons hoover color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BUTTONS HOVER BACKGROUND/TEXT COLOR</span>
        <p>Select button hover background and text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_hover_background',
            'default_color' => '#deea4b'
        ));
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_login_hover_color',
            'default_color' => '#000000'
        ));
        ?>
    </div>
</div>