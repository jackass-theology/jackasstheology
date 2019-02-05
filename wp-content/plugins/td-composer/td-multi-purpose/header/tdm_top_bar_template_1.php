<?php if (td_util::get_option('tds_top_bar') != 'hide_top_bar') { ?>

    <div class="top-bar-style-mp-1">
        <?php locate_template('parts/header/top-widget.php', true); ?>
        <?php locate_template('parts/header/top-menu.php', true); ?>



        <?php
        if(td_util::get_option('tdm_info_show_top_bar') == 'show' ) {
            if( td_util::get_option('tdm_phone_number') !== '' ) { ?>
                <div class="td-header-sp-phone">
                    <?php echo '<span>' . __td('Tel:', TD_THEME_NAME) . '</span> ' . '<a href="tel:' . td_util::get_option('tdm_phone_number')  . '">' . td_util::get_option('tdm_phone_number') . '</a>'; ?>
                </div>
            <?php } ?>

            <?php if( td_util::get_option('tdm_email') !== '' ) { ?>
                <div class="td-header-sp-email">
                    <?php echo '<span>' . __td('Email:', TD_THEME_NAME) . '</span> ' . '<a href="mailto:' . td_util::get_option('tdm_email')  . '">' . td_util::get_option('tdm_email') . '</a>'; ?>
                </div>
            <?php } ?>

            <?php if( td_util::get_option('tdm_extra_info') !== '' ) { ?>
                <div class="td-header-sp-info">
                    <?php echo td_util::get_option('tdm_extra_info'); ?>
                </div>
            <?php }
        } ?>
    </div>

<?php }
    locate_template('parts/header/td-login-modal.php', true);
?>