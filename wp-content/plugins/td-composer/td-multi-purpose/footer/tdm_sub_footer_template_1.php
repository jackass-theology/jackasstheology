<?php if (td_util::get_option('tds_sub_footer') != 'no') { ?>
    <div class="td-sub-footer-container td-container-wrap <?php echo td_util::get_option('td_full_footer'); ?>">
    <div class="td-container">
        <div class="td-pb-row">
            <div class="td-pb-span td-sub-footer-menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'menu_class' => 'td-subfooter-menu',
                    'fallback_cb' => 'td_wp_footer_menu'
                ));

                //if no menu
                function td_wp_footer_menu()
                {
                    //do nothing?
                }

                ?>
            </div>

            <div class="td-pb-span td-sub-footer-copy">
                <?php
                $tds_footer_copyright = stripslashes(td_util::parse_footer_texts(td_util::get_option('tds_footer_copyright')));
                $tds_footer_copy_symbol = td_util::get_option('tds_footer_copy_symbol');

                //show copyright symbol
                if ($tds_footer_copy_symbol == '') {
                    echo '&copy; ';
                }

                echo $tds_footer_copyright;
                ?>
            </div>

            <?php
            if (td_util::get_option('tdm_info_show_sub_footer') == 'show') {

                if (td_util::get_option('tdm_phone_number') !== '') { ?>
                    <div class="td-pb-span tdm-sub-footer-phone">
                        <?php echo '<span>' . __td('Tel:', TD_THEME_NAME) . '</span> '  . '<a href="tel:' . td_util::get_option('tdm_phone_number')  . '">' . td_util::get_option('tdm_phone_number') . '</a>'; ?>
                    </div>
                <?php } ?>

                <?php if (td_util::get_option('tdm_email') !== '') { ?>
                    <div class="td-pb-span tdm-sub-footer-email">
                        <?php echo '<span>' . __td('Email:', TD_THEME_NAME) . '</span> ' . '<a href="mailto:' . td_util::get_option('tdm_email')  . '">' . td_util::get_option('tdm_email') . '</a>';  ?>
                    </div>
                <?php } ?>

                <?php if (td_util::get_option('tdm_extra_info') !== '') { ?>
                    <div class="td-pb-span tdm-sub-footer-info">
                        <?php echo td_util::get_option('tdm_extra_info'); ?>
                    </div>
                <?php }
            } ?>
            </div>
        </div>
    </div>
<?php } ?>