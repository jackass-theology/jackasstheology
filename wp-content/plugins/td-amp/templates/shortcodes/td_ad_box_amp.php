<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 12/14/2017
 * Time: 5:29 PM
 */

class td_ad_box_amp {

    static function render( $atts ) {
        $buffy = '';

        if ( empty( $atts['spot_id'] ) ) {
            return '';
        }

        $amp_ad_type = esc_attr( td_util::get_option( $atts['spot_id'] . '_ad_type' ) ) == "custom-banner" ? "custom-banner" : "google-adsense";

        $amp_google_adsense_publisher_id = esc_attr( td_util::get_option($atts['spot_id'] . '_adsense_ad_publisher_id') );
        $amp_google_adsense_unit_id = esc_attr( td_util::get_option($atts['spot_id'] . '_adsense_ad_unit_id') );
        $amp_google_adsense_size = esc_attr( td_util::get_option($atts['spot_id'] . '_adsense_ad_size') );

        $ad_code = stripcslashes( td_util::get_option($atts['spot_id']) );

        if ( $amp_ad_type == "google-adsense"
            && !empty($amp_google_adsense_publisher_id)
            && !empty($amp_google_adsense_unit_id) ) {

            $buffy .= '<div class="td-a-rec td-a-rec-id-' . $atts['spot_id'] . ' ">';
            $buffy .= '<amp-ad';
            if ( $amp_google_adsense_size == "fixed-height" ) {
                $buffy .= ' layout="fixed-height" height="100"';
            } else {
                $buffy .= ' layout="responsive" width="300" height="250"';
            }
            $buffy .= ' type="adsense" data-ad-client="' . $amp_google_adsense_publisher_id . '" data-ad-slot="' . $amp_google_adsense_unit_id . '"></amp-ad>';
            $buffy .= '</div>';

        } else if ( !empty($ad_code) ) {
            $buffy .= '<div class="td-a-rec td-a-rec-id-' . $atts['spot_id'] . ' ">';
            $buffy .= $ad_code;
            $buffy .= '</div>';

            $buffy = td_sanitize_image( $buffy );

        }

        return $buffy;
    }
}