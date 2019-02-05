<div class="td-header-rec-wrap">
    <?php
    $tds_header_ad_title = td_util::get_option('tds_header_title');

    // show the header ad spot
    echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'header', 'spot_title' => $tds_header_ad_title)); ?>

</div>