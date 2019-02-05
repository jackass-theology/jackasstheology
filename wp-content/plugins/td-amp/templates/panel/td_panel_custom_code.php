<?php echo td_panel_generator::box_start('Custom code', false); ?>

<!-- Custom CSS -->
<div class="td-box-row">
    <div class="td-box-description td-box-full">
        <span class="td-box-title">WRITE YOUR OWN CSS HERE</span>
        <p>The css from this box will load on all amp single post pages. Press <strong>ctrl + space</strong> while editing to bring up a suggestion box.</p>
    </div>
</div>

<div class="td-box-row-margin-bottom">
    <?php
    echo td_panel_generator::css_editor(array(
        'ds' => 'td_option',
        'option_id' => 'tds_custom_css_amp',
    ));
    ?>
</div>

<?php echo td_panel_generator::box_end(); ?>