<!-- Global block template -->
<?php echo td_panel_generator::box_start('Global Block Header Template', true); ?>

    <!-- text -->
    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <p>This header template will be applied to the whole site. The theme will also try to adjust the default widgets to look in the same style
            with the block template selected here.</p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

    <!-- GLOBAL BLOCK TEMPLATE SELECT -->
    <div class="td-box-row">
        <div class="td-box-description">
            <span class="td-box-title">BLOCK HEADER TEMPLATE</span>
            <p>You can overwrite the template on each block and widget.</p>
        </div>
        <div class="td-box-control-full">
            <?php
            echo td_panel_generator::visual_select_o(array(
                'ds' => 'td_option',
                'option_id' => 'tds_global_block_template',
                'values' => td_api_block_template::_helper_generate_block_templates()
            ));
            ?>
        </div>
    </div>
<?php echo td_panel_generator::box_end();?>




<!-- Thumbs on Modules/Blocks -->
<?php
    echo td_panel_generator::ajax_box('Thumbs on Modules/Blocks', array(
        'td_ajax_calling_file' => basename(__FILE__),
        'td_ajax_box_id' => 'td_thumbs_on_modules_and_blocks',
        ), '', 'td_panel_box_thumb_on_modules'
    );
?>





<!-- Category label on modules -->
<?php echo td_panel_generator::box_start('Category tag on Modules/Blocks', false); ?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">More information:</span>
            <p>From here you can show or hide the category tag from modules. <a target="_blank" href="http://forum.tagdiv.com/category-tag-on-modulesblocks/" >Read more about modules</a></p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>



    <?php
    foreach (td_api_module::get_all() as $td_module_class => $td_module_array) {
        if ($td_module_array['category_label'] === true) {
            ?>
            <!-- <?php echo $td_module_array['text'] ?> -->
            <div class="td-box-row">
                <div class="td-box-description">
                    <span class="td-box-title"><?php echo $td_module_array['text'] . td_panel_generator::helper_generate_used_on_block_list($td_module_array['used_on_blocks']) ?></span>
                    <p>Hide or show the category tag</p>
                </div>
                <div class="td-box-control-full">
                    <?php
                    echo td_panel_generator::checkbox(array(
                        'ds' => 'td_option',
                        'option_id' => 'tds_category_' . td_api_module::_helper_get_module_name_from_class($td_module_class),
                        'true_value' => 'yes',
                        'false_value' => ''
                    ));
                    ?>
                </div>
            </div>
            <?php
        }
    }

    ?>
<?php echo td_panel_generator::box_end();?>



<!-- Meta info on Modules/Blocks -->
<?php echo td_panel_generator::box_start('Meta info on Modules/Blocks', false); ?>

<!-- Show author name -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SHOW AUTHOR NAME</span>
        <p>Enable or disable the author name (on blocks and modules)</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_m_show_author_name',
            'true_value' => '',
            'false_value' => 'hide'
        ));
        ?>
    </div>
</div>

<!-- Show date -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SHOW DATE</span>
        <p>Enable or disable the post date (on blocks and modules)</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_m_show_date',
            'true_value' => '',
            'false_value' => 'hide'
        ));
        ?>
    </div>
</div>

<!-- SHow comment count -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SHOW COMMENT COUNT</span>
        <p>Enable or disable comment number (on blocks and modules)</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_m_show_comments',
            'true_value' => '',
            'false_value' => 'hide'
        ));
        ?>
    </div>
</div>

<!-- Show Reviews -->
<div class="td-box-row">
    <div class="td-box-description">
        <span class="td-box-title">SHOW REVIEW</span>
        <p>Enable or disable reviews (on blocks and modules)</p>
    </div>
    <div class="td-box-control-full">
        <?php
        echo td_panel_generator::checkbox(array(
            'ds' => 'td_option',
            'option_id' => 'tds_m_show_review',
            'true_value' => '',
            'false_value' => 'hide'
        ));
        ?>
    </div>
</div>
<?php echo td_panel_generator::box_end();?>



<!-- 7 days post sorting -->
<?php echo td_panel_generator::box_start('7 days post sorting', false); ?>


<!-- text -->
<div class="td-box-row">
	<div class="td-box-description td-box-full">
		<p>When you enable this option a new sorting option will work and it will be selectable on each block (7 days popular). This sorting option will pick posts that are popular in the last 7 days, ordered by page views. This option comes with a small performance penalty and it does not work well with caching plugins yet. When caching is enabled the sorting will be an estimation of the popularity in the last 7 days.</p>
	</div>
	<div class="td-box-row-margin-bottom"></div>
</div>

<!-- use 7 days post sorting -->
<div class="td-box-row">
	<div class="td-box-description">
		<span class="td-box-title">USE 7 DAYS POST SORTING</span>
		<p>Enable or disable the popular last 7 days.</p>
	</div>
	<div class="td-box-control-full">
		<?php
		echo td_panel_generator::checkbox(array(
			'ds' => 'td_option',
			'option_id' => 'tds_p_enable_7_days_count',
			'true_value' => 'enabled',
			'false_value' => ''
		));
		?>
	</div>
</div>
<?php echo td_panel_generator::box_end();?>






