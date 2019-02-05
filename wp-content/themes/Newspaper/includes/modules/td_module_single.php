<?php

/**
 * Class td_module_single
 */

class td_module_single extends td_module_single_base {

    function get_social_sharing_top() {
        if (!$this->is_single) {
            return;
        }
        if (td_util::get_option('tds_top_social_show') == 'hide' and td_util::get_option('tds_top_like_show') != 'show') {
            return;
        }


        $buffy = '';
        // @todo single-post-thumbnail appears to not be in used! please check
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $this->post->ID ), 'single-post-thumbnail' );


        $buffy .= '<div class="td-post-sharing-top">';
            if( td_util::get_option('tds_top_like_show') == 'show'  && td_util::is_amp() === false ) {
                $buffy .= '<div class="td-post-sharing-classic">';
                    $buffy .= '<iframe frameBorder="0" src="' . td_global::$http_or_https . '://www.facebook.com/plugins/like.php?href=' . $this->href . '&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>';
                $buffy .= '</div>';
            }


            if (td_util::get_option('tds_top_social_show') != 'hide') {
                $share_text_show = false;
                if (td_util::get_option('tds_top_like_share_text_show') == 'show') {
                    $share_text_show = true;
                }

                if ( td_util::is_amp() ) {
                    $enabled_services = td_api_social_sharing_styles::_helper_get_enabled_socials();
                    $amp_services = array_slice( $enabled_services, 0, 5);

                    $buffy .= td_social_sharing::render_generic(array(
                        'services' => $amp_services,
                        'style' => 'style1',
                        'share_text_show' => false,
                        'el_class' => ''
                    ), 'td_social_sharing_article_top');
                } else {
                    $buffy .= td_social_sharing::render_generic(array(
                        'services' => td_api_social_sharing_styles::_helper_get_enabled_socials(),
                        'style' => td_options::get('tds_social_sharing_top_style', 'style1'),
                        'share_text_show' => $share_text_show,
                        'el_class' => ''
                    ), 'td_social_sharing_article_top');
                }
            }
        $buffy .= '</div>';


        return $buffy;
    }



    function get_social_sharing_bottom() {
        if (!$this->is_single) {
            return;
        }
        if (td_util::get_option('tds_bottom_social_show') == 'hide' and td_util::get_option('tds_bottom_like_show') == 'hide') {
            return;
        }


        $buffy = '';
        // @todo single-post-thumbnail appears to not be in used! please check
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $this->post->ID ), 'single-post-thumbnail' );

        $buffy .= '<div class="td-post-sharing-bottom">';

            if( td_util::get_option('tds_bottom_like_show') != 'hide' && td_util::is_amp() === false ) {
                $buffy .= '<div class="td-post-sharing-classic">';
                    $buffy .= '<iframe frameBorder="0" src="' . td_global::$http_or_https . '://www.facebook.com/plugins/like.php?href=' . $this->href . '&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>';
                $buffy .= '</div>';
            }


            if (td_util::get_option('tds_bottom_social_show') != 'hide') {
                $share_text_show = false;
                if( td_util::get_option('tds_bottom_like_share_text_show') == 'show' ) {
                    $share_text_show = true;
                }

                if ( td_util::is_amp() ) {
                    $enabled_services = td_api_social_sharing_styles::_helper_get_enabled_socials();
                    $amp_services = array_slice( $enabled_services, 0, 5);

                    $buffy .= td_social_sharing::render_generic(array(
                        'services' => $amp_services,
                        'style' => 'style1',
                        'share_text_show' => false,
                        'el_class' => ''
                    ), 'td_social_sharing_article_bottom');
                } else {
                    $buffy .= td_social_sharing::render_generic(array(
                        'services' => td_api_social_sharing_styles::_helper_get_enabled_socials(),
                        'style' => td_options::get('tds_social_sharing_bottom_style', 'style1'),
                        'share_text_show' => $share_text_show,
                        'el_class' => ''
                    ), 'td_social_sharing_article_bottom');
                }
            }

        $buffy .= '</div>';


        return $buffy;
    }

}