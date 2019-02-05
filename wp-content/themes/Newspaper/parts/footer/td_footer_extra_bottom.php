<?php
/*  ----------------------------------------------------------------------------
    footer extra bottom section FOOTER LOGO + DESCRIPTION + SOCIAL ICONS
 */

$td_footer_logo = td_util::get_option('tds_footer_logo_upload');
$td_footer_retina_logo = td_util::get_option('tds_footer_retina_logo_upload');
$td_top_logo = td_util::get_option('tds_logo_upload');
$td_top_retina_logo = td_util::get_option('tds_logo_upload_r');
$td_footer_text = td_util::parse_footer_texts(td_util::get_option('tds_footer_text'));
$td_footer_email = td_util::get_option('tds_footer_email');
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

$td_social_enabled = '';
if(td_util::get_option('tds_footer_social') != 'no') {
	$td_social_enabled = 'td-pb-span5';
} else {
	$td_social_enabled = 'td-pb-span9';
}

$retina_footer_logo_width = '';
if (!empty($td_footer_retina_logo)) {
    // retina logo width of the normal logo
    $retina_footer_logo_id = attachment_url_to_postid($td_footer_logo);
    if ($retina_footer_logo_id !== 0) {
        $img_properties = wp_get_attachment_image_src($retina_footer_logo_id, 'full');
        if ($img_properties !== false && !empty($img_properties[1])) {
            $retina_footer_logo_width = $img_properties[1];
        }
    }
}

$buffy = '';

// column 1 logo
$buffy .= '<div class="td-pb-span3"><aside class="footer-logo-wrap">';
    if (!empty($td_footer_logo)) { // if have footer logo
        if (empty($td_footer_retina_logo)) { // if don't have a retina footer logo load the normal logo
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img src="' . $td_footer_logo . '" alt="' . $td_footer_logo_alt . '" title="' . $td_footer_logo_title . '"/></a>';
        } else {
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img class="td-retina-data" src="' . $td_footer_logo . '" data-retina="' . esc_attr($td_footer_retina_logo) . '" alt="' . $td_footer_logo_alt . '" title="' . $td_footer_logo_title . '" width="' . esc_attr($retina_footer_logo_width) . '" /></a>';
        }
    } else { // if you don't have a footer logo load the top logo
	    if (empty($td_top_retina_logo)) {
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img src="' . $td_top_logo . '" alt="' . $td_logo_alt . '" title="' . $td_logo_title . '"/></a>';
        } else {
			$retina_top_logo_width = '';
		    $retina_top_logo_id = attachment_url_to_postid($td_top_logo);
		    if ( $retina_top_logo_width !== 0 ) {
			    $img_properties = wp_get_attachment_image_src($retina_top_logo_id, 'full');
		        if ($img_properties !== false && !empty($img_properties[1])) {
		            $retina_top_logo_width = $img_properties[1];
		        }
		    }
            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img class="td-retina-data" src="' . $td_top_logo . '" data-retina="' . esc_attr($td_top_retina_logo) . '" alt="' . $td_logo_alt . '" title="' . $td_logo_title . '" width="' . esc_attr($retina_top_logo_width) . '" /></a>';
        }
    }

$buffy .= '</aside></div>';

// column 2 description
$buffy .= '<div class="' . $td_social_enabled . '"><aside class="footer-text-wrap">';
    $buffy .= '<div class="block-title"><span>' . __td('ABOUT US', TD_THEME_NAME) . '</span></div>';
    $buffy .= stripcslashes($td_footer_text);

    if (!empty($td_footer_email)) {
        $buffy .= '<div class="footer-email-wrap">';
        $buffy .= __td('Contact us', TD_THEME_NAME) . ': <a href="mailto:' . $td_footer_email  . '">' . $td_footer_email . '</a>';
        $buffy .= '</div>';
    }
$buffy .= '</aside></div>';

// column 3 social icons
if(td_util::get_option('tds_footer_social') != 'no') {
	$buffy .= '<div class="td-pb-span4"><aside class="footer-social-wrap td-social-style-2">';
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