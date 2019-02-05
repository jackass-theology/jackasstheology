<div class="td-footer-wrapper td-container-wrap <?php echo td_util::get_option('td_full_footer'); ?>">
    <div class="td-container">

	    <div class="td-pb-row">
		    <div class="td-pb-span12">
                <?php
                $tds_footer_top_title = td_util::get_option('tds_footer_top_title');
                // ad spot
                echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'footer_top', 'spot_title' => $tds_footer_top_title));
                ?>
		    </div>
	    </div>

        <div class="td-pb-row">

            <div class="td-pb-span12">
                <?php
                td_global::vc_set_custom_column_number(3);
                dynamic_sidebar('Footer 1');
                ?>
            </div>
        </div>
    </div>

    <div class="td-footer-bottom-full">
        <div class="td-container">
            <div class="td-pb-row">
                <?php locate_template('parts/footer/td_footer_extra_bottom.php', true); ?>
            </div>
        </div>
    </div>
</div>