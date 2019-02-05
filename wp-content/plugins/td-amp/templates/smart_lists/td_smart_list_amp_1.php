<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 12/14/2017
 * Time: 5:29 PM
 */

class td_smart_list_amp_1 extends td_smart_list {

    protected function render_before_list_wrap() {
        $buffy = '';
        $buffy .= '<div class="td_smart_list_amp_1">';
        return $buffy;
    }


    protected function render_list_item($item_array, $current_item_id, $current_item_number, $total_items_number) {
        $buffy = '';

        // the tile
        $smart_list_4_title = '';
        if(!empty($item_array['title'])) {
            $smart_list_4_title = $item_array['title'];
        }

        // creating each sm item
        $buffy .= '<div class="td-item">';
        $buffy .= '
                        <div class="td-number-and-title">
                            <h2>
                                <span class="td-sml-current-item-nr">' . $current_item_number. '</span>
                                <span class="td-sml-current-item-title">' . $smart_list_4_title . '</span>
                            </h2>
                        </div>
        ';

            //get image info
            $first_img_all_info = td_util::attachment_get_full_info($item_array['first_img_id']);

            //get image link target
            $first_img_link_target = $item_array['first_img_link_target'];

            //image caption
            $first_img_caption = $item_array['first_img_caption'];

            $first_img_info = wp_get_attachment_image_src($item_array['first_img_id'], 'td_696x0');

                if (!empty($first_img_info[0])) {

                    // if a custom link is set use it
                    if (!empty($item_array['first_img_link']) && $first_img_all_info['src'] != $item_array['first_img_link']) {
                        $first_img_all_info['src'] = $item_array['first_img_link'];
                    }

                    $buffy .= '
                    <div class="td-sml-figure">
                        <figure class="td-slide-smart-list-figure">
                            <a class="td-sml-link-to-image" href="' . $first_img_all_info['src'] . '" data-caption="' . esc_attr($first_img_caption, ENT_QUOTES) . '" ' . $first_img_link_target . ' >
                                <img src="' . $first_img_info[0] . '"/>
                            </a>
                        </figure>';

                    if ( !empty($first_img_caption)) {
                        $buffy .= '<figcaption class="td-sml-caption"><div>' . $first_img_caption . '</div></figcaption>';
                    }
                    $buffy .= '</div>';
                }

                //adding description
                if(!empty($item_array['description'])) {
                    $buffy .= '<span class="td-sml-description">' . $item_array['description'] . '</span>';
                }

        $buffy .= '</div>';

        return $buffy;
    }


    protected function render_after_list_wrap() {
        $buffy = '';
        $buffy .= '</div>'; // /.td_smart_list_amp_1

        return $buffy;
    }
}