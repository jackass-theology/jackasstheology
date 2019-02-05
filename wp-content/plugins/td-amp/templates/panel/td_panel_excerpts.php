<?php echo td_panel_generator::box_start('Excerpts', false); ?>

<div class="td-box-section-title">Related Posts Module</div>

<!-- Title Length -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class=" td-box-title">Title Length</span>
        <p>This setting allows you to choose the words number of each title from the Related Posts feature.</p>
    </div>
    <div class="td-box-control-full" style="padding-top: 20px;">
        <?php
        echo td_panel_generator::input(array(
            'ds' => 'td_option',
            'option_id' => 'td_module_amp_1_title_excerpt',
        ));
        ?>
    </div>
</div>

<?php echo td_panel_generator::box_end(); ?>