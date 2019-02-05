<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 7/19/2017
 * Time: 3:22 PM
 */
class td_admin_popup {

    static function on_admin_footer() {
        if ( is_admin() ) {

            echo '
            <div id="td-admin-popup" class="">

                <button type="button" class="media-modal-close td-close-admin-popup-box">
                    <span class="media-modal-icon td-close-admin-popup-box"></span>
                </button>

                <p class="features-text">Need <br><b>More Features?</b></p>
                <p class="no-problem-text">No problem!</p>
                <p class="covered-text">We\'ve got you covered!</p>

                <a class="td-go-premium-button" href="https://www.wpion.com/pricing/?utm_source=corner_popup&utm_medium=wp_admin&utm_campaign=ionMag_free" target="_blank">GO Premium</a>
            </div>
            ';
        }
    }
}