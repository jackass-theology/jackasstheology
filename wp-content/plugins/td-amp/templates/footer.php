<?php
/**
 * Footer template part.
 *
 */
?>

<?php if ( td_util::get_option( 'tds_footer' ) != 'no' ) { ?>

<div class="td-footer-wrap">
    <div class="td-container">
        <?php
        $td_footer_logo = td_util::get_option('tds_footer_logo_upload');
        $td_top_logo = td_util::get_option('tds_logo_upload');
        $td_footer_text = td_util::parse_footer_texts(td_util::get_option('tds_footer_text'));
        $td_footer_email = td_util::get_option('tds_footer_email');

        // read alt and title for the logo
        $td_logo_alt = td_util::get_option('tds_logo_alt');
        $td_footer_logo_alt = td_util::get_option('tds_footer_logo_alt');
        $td_logo_title = td_util::get_option('tds_logo_title');
        $td_footer_logo_title = td_util::get_option('tds_footer_logo_title');

        // if there's no footer logo alt set use the alt from the header logo
        if (empty($td_footer_logo_alt)) {
            $td_footer_logo_alt = $td_logo_alt;
        }
        
        // if there's no footer logo title set use the title from the header logo
        if (empty($td_footer_logo_title)) {
            $td_footer_logo_title = $td_logo_title;
        }

        $buffy = '';

        // logo
        $buffy .= '<div class="td-footer-component-wrap"><aside class="td-footer-logo">';
        if (!empty($td_footer_logo)) { // if have footer logo
            $logo_img_html = '<img src="' . $td_footer_logo . '" alt="' . $td_footer_logo_alt . '" title="' . $td_footer_logo_title . '"/>';
            $buffy .= '<a class="td-logo" href="' . esc_url(home_url( '/' )) . '">' . td_sanitize_image($logo_img_html) . '</a>';
        } else { // if you don't have a footer logo load the top logo
            $logo_img_html = '<img src="' . $td_top_logo . '" alt="' . $td_footer_logo_alt . '" title="' . $td_footer_logo_title . '"/>';
            $buffy .= '<a class="td-logo" href="' . esc_url(home_url( '/' )) . '">' . td_sanitize_image($logo_img_html) . '</a>';
        }
        $buffy .= '</aside></div>';

        // description
        $buffy .= '<div class="td-footer-component-wrap"><aside class="td-footer-description">';
        $buffy .= '<div class="block-title"><span>' . __td('ABOUT US', TD_THEME_NAME) . '</span></div>';
        $buffy .= td_sanitize_image( stripcslashes( $td_footer_text ) );

        if (!empty($td_footer_email)) {
            $buffy .= '<div class="footer-email-wrap">';
            $buffy .= __td('Contact us', TD_THEME_NAME) . ': <a href="mailto:' . $td_footer_email  . '">' . $td_footer_email . '</a>';
            $buffy .= '</div>';
        }
        $buffy .= '</aside></div>';

        // social icons
        if(td_util::get_option('tds_footer_social') != 'no') {
            $buffy .= '<div class="td-footer-component-wrap"><aside class="td-footer-social">';
            $buffy .= '<div class="block-title"><span>' . __td('FOLLOW US', TD_THEME_NAME) . '</span></div>';
            //get the socials that are set by user
            $td_get_social_network = td_options::get_array('td_social_networks');

            if(!empty($td_get_social_network)) {
                foreach($td_get_social_network as $social_id => $social_link) {
                    if(!empty($social_link)) {
                        $buffy .= td_social_icons::get_icon($social_link, $social_id, true);
                    }
                }
            }
            $buffy .= '</aside></div>';
        }


        echo $buffy;
        ?>
    </div><!-- close td-container -->
</div><!-- close footer -->
<?php } ?>
<!-- sub footer -->
<?php if (td_util::get_option('tds_sub_footer') != 'no') { ?>
    <div class="td-sub-footer-wrap">
        <div class="td-container">

            <div class="td-sub-footer-copy">
                <?php
                $tds_footer_copyright = stripslashes(td_util::parse_footer_texts(td_util::get_option('tds_footer_copyright')));
                $tds_footer_copy_symbol = td_util::get_option('tds_footer_copy_symbol');

                //show copyright symbol
                if ($tds_footer_copy_symbol == '') {
                    echo '&copy; ';
                }

                echo td_sanitize_image($tds_footer_copyright);
                ?>
            </div>

            <!-- scroll to top -->
            <div class="td-back-to-top">
                <a href="#top">
                    <i class="td-icon-menu-up"></i>
                </a>
            </div>

        </div>
    </div><!-- close sub footer -->
<?php } ?>

