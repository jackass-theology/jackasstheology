<?php echo td_panel_generator::box_start('Colors', false); ?>

<div class="td-box-section-title">Colors</div>

<!-- Colors -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">ACCENT COLOR</span>
        <p>Select amp template accent color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_theme_color_amp',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>
<div class="td-box-section-title">Menu</div>

<!-- Menu bg color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND COLOR</span>
        <p>Select menu bar background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_menu_background_amp',
            'default_color' => '#222'
        ));
        ?>
    </div>
</div>

<!-- Menu bar icons color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">ICONS COLOR</span>
        <p>Select menu and search icons color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_menu_icon_color_amp',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>
<div class="td-box-section-title">Footer</div>

<!-- Footer background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND COLOR</span>
        <p>Select footer background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_background_amp',
            'default_color' => '#222'
        ));
        ?>
    </div>
</div>

<!-- Footer text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">TEXT COLOR</span>
        <p>Select footer text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_footer_text_color_amp',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>
<div class="td-box-section-title">Sub-footer</div>

<!-- Sub-footer background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BACKGROUND COLOR</span>
        <p>Select sub-footer background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_sub_footer_background_amp',
            'default_color' => '#000'
        ));
        ?>
    </div>
</div>

<!-- Sub-footer text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">TEXT COLOR</span>
        <p>Select sub-footer text color(copyright).</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_sub_footer_text_color_amp',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>