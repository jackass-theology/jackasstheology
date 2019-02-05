<!-- Live search background color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">LIVE SEARCH BACKGROUND COLOR</span>
        <p>Select live search background color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_background',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<!-- Live search borders color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">LIVE SEARCH BORDERS COLOR</span>
        <p>Select live search borders color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_border_color',
            'default_color' => '#ededed'
        ));
        ?>
    </div>
</div>

<!-- Live search text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">LIVE SEARCH TEXT COLOR</span>
        <p>Select live search text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_text_color',
            'default_color' => '#111111'
        ));
        ?>
    </div>
</div>

<!-- Live search date text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">LIVE SEARCH DATE TEXT COLOR</span>
        <p>Select live search date text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_date_color',
            'default_color' => '#aaaaaa'
        ));
        ?>
    </div>
</div>

<!-- Live search button background and text color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">LIVE SEARCH BUTTON BACKGROUND/TEXT COLOR</span>
        <p>Select live search background/text color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_button_background',
            'default_color' => '#484848'
        ));
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_button_text_color',
            'default_color' => '#ffffff'
        ));
        ?>
    </div>
</div>

<!-- Live search accent color -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">LIVE SEARCH ACCENT COLOR</span>
        <p>Select live search accent color</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::color_picker(array(
            'ds' => 'td_option',
            'option_id' => 'tds_live_search_accent_color',
            'default_color' => '#4db2ec'
        ));
        ?>
    </div>
</div>