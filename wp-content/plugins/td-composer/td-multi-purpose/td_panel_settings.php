<!-- PLUGIN SETTINGS -->
<?php

echo td_panel_generator::box_start('General settings', true);

if (defined('TD_DEPLOY_MODE') && TD_DEPLOY_MODE === 'dev') {

}
?>

<!-- BUTTONS STYLES -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Buttons style</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
            echo td_panel_generator::radio_button_control(array(
                'ds' => 'td_option',
                'option_id' => 'tds_button',
	            'values' => td_api_style::get_styles_for_panel ('tds_button', 'tds_button1')
            ));
        ?>
    </div>
</div>

<!-- BUTTONS RADIUS -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Buttons radius</span>
        <p>Enter the radius size in px ( ex. 3px )</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_btn_radius'
        ));
        ?>
    </div>
</div>

<!-- TITLES STYLES -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Titles style</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::radio_button_control(array(
            'ds' => 'td_option',
            'option_id' => 'tds_title',
            'values' => td_api_style::get_styles_for_panel ('tds_title', 'tds_title1')
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- PHONE NUMBER -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Phone number</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_phone_number'
        ));
        ?>
    </div>
</div>

<!-- EMAIL -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Email address</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_email'
        ));
        ?>
    </div>
</div>

<!-- EXTRA INFO -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Extra information</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_extra_info'
        ));
        ?>
    </div>
</div>

<!-- SHOW IN TOP BAR -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Show in top bar</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_info_show_top_bar',
            'true_value' => 'show',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<!-- SHOW IN SUB FOOTER -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Show in sub footer</span>
        <p></p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_info_show_sub_footer',
            'true_value' => 'show',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<div class="td-box-section-separator"></div>

<!-- BUTTONS RADIUS -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">Bordered website</span>
        <p>Enter the border size in px ( ex. 24px )</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'tdm_bordered_website'
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end();?>



<?php

// HEADER
require_once( 'panel/td_panel_header.php' );

// COLORS
require_once( 'panel/td_panel_colors.php' );

// FONTS
require_once( 'panel/td_panel_fonts.php' );

?>