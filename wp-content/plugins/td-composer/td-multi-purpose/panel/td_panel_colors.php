<!-- MOBILE THEME COLORS -->
<?php echo td_panel_generator::box_start('Colors', false); ?>

<div class="td-box-section-title">Header</div>

<!-- Button background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BUTTON 1 BASE COLOR</span>
        <p>Base color for button 1</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_base_color',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>

    <div class="td-box-description">
        <span class="td-box-title">BUTTON 2 BASE COLOR</span>
        <p>Base color for button 2</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_base_color',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>
</div>

<!-- Button text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BUTTON 1 TEXT COLOR</span>
        <p>Text color for the button 1</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_text_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>

    <div class="td-box-description">
        <span class="td-box-title">BUTTON 2 TEXT COLOR</span>
        <p>Text color for button 2</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_text_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<!-- Button accent -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BUTTON 1 BASE HOVER COLOR</span>
        <p>Base hover color for button 1</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_base_hover_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>

    <div class="td-box-description">
        <span class="td-box-title">BUTTON 2 BASE HOVER COLOR</span>
        <p>Base hover color for button 2</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_base_hover_color',
            'default_color' => '#222222'
        ));
        ?>
    </div>
</div>

<!-- Button accent -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">BUTTON 1 TEXT HOVER COLOR</span>
        <p>Text hover color for button 1</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn1_text_hover_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>

    <div class="td-box-description">
        <span class="td-box-title">BUTTON 2 TEXT HOVER COLOR</span>
        <p>Text hover color for button 2</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_menu_btn2_text_hover_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>