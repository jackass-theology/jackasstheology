<!-- PLUGIN SETTINGS -->
<?php echo td_panel_generator::box_start('Template builder settings', true); ?>

    <!-- post template - page id -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class=" td-box-title">Post template Page ID</span>
            <p>One page ID to use for posts ()</p>
        </div>
        <div class="td-box-control-full" style="padding-top: 20px;">
            <?php
            echo td_panel_generator::input(array(
                'ds' => 'td_option',
                'option_id' => 'td_template_builder_page_id',
            ));
            ?>
        </div>
    </div>




<?php echo td_panel_generator::box_end();?>
