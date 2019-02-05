<?php echo td_panel_generator::box_start('Post Type Support', false); ?>

<!-- Show amp on pages -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class=" td-box-title">Post</span>
        <p>The AMP post support is enabled by default on single post pages.</p>
    </div>
    <div class="td-box-control-full td-amp-disabled-post">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_post_type_post',
            'true_value' => 'post',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<div class="td-box-row">
    <div class="td-box-description">
        <span class=" td-box-title">Page</span>
        <p>Enable/disable AMP support on pages</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_amp_post_type_page',
            'true_value' => 'page',
            'false_value' => ''
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end(); ?>