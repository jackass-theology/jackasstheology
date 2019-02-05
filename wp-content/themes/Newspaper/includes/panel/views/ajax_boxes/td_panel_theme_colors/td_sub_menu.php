
<!-- Sub-menu background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SUB-MENU BACKGROUND COLOR</span>
        <p>Select sub-menu background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_sub_menu_background',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<!-- Sub-menu text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SUB-MENU TEXT COLOR</span>
        <p>Select sub-menu text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_sub_menu_text_color',
            'default_color' => '#111111'
        ));
        ?>
    </div>
</div>

<!-- Sub-menu Hover background -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SUB-MENU ACTIVE & HOVER BACKGROUND</span>
        <p>Active and hover background color for sub-menus</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_sub_menu_hover_background',
            'default_color' => ''
        ));
        ?>
    </div>
</div>

<!-- Sub-menu Hover text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SUB-MENU ACTIVE & HOVER TEXT COLOR</span>
        <p>Active and hover text color for sub-menus</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_sub_menu_hover_color',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>
</div>