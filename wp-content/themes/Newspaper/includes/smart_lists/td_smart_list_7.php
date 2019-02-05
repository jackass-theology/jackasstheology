<?php


class td_smart_list_7 extends td_smart_list {

    protected $use_pagination = true; // set this to true to use rela pagination on this template


    protected function render_before_list_wrap() {
        if(td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
            $td_class_nr_of_columns = ' td-3-columns ';
        } else {
            $td_class_nr_of_columns = ' td-2-columns ';
        }

        $buffy = '';

        //wrapper with id for smart list wrapper type 7
        $buffy .= '<div class="td_smart_list_7' . $td_class_nr_of_columns . '">';

        return $buffy;
    }


    protected function render_list_item($item_array, $current_item_id, $current_item_number, $total_items_number) {
        //print_r($item_array);
        $buffy = '';

        // render the pagination
        $buffy .= $this->callback_render_pagination();

        //creating each slide
        $buffy .= '<div class="td-item">';
        $buffy .= '<h2><span class="td-sml-current-item-title">' . $current_item_number. '. ' . $item_array['title'] . '</span></h2>';

        //get image info
        $first_img_all_info = td_util::attachment_get_full_info($item_array['first_img_id']);

        //get image link target
        $first_img_link_target = $item_array['first_img_link_target'];

        //image caption
        $first_img_caption = $item_array['first_img_caption'];

        //adding description
        if(!empty($item_array['description'])) {
            $buffy .= '<span class="td-sml-description">' . $item_array['description'] . '</span>';
        }

        $tds_smart_list_7_title = td_util::get_option('tds_smart_list_7_title');

        // ad smart list 7
        $buffy .= td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'smart_list_7', 'spot_title' => $tds_smart_list_7_title));

        //image type and width - used to retrieve retina image
        $image_type = 'td_696x0';
        $image_width = '696';

        if(td_global::$cur_single_template_sidebar_pos == 'no_sidebar') {
            $first_img_info = wp_get_attachment_image_src($item_array['first_img_id'], 'td_1068x0');
            //change image type and width - used to retrieve retina image
            $image_type = 'td_1068x0';
            $image_width = '1068';
        } else {
            $first_img_info = wp_get_attachment_image_src($item_array['first_img_id'], 'td_696x0');
        }
        if (!empty($first_img_info[0])) {

            //retina image
            $srcset_sizes = td_util::get_srcset_sizes($item_array['first_img_id'], $image_type, $image_width, $first_img_info[0]);

            // class used by magnific popup
            $smart_list_lightbox = " td-lightbox-enabled";

            // if a custom link is set use it
            if (!empty($item_array['first_img_link']) && $first_img_all_info['src'] != $item_array['first_img_link']) {
                $first_img_all_info['src'] = $item_array['first_img_link'];

                // remove the magnific popup class for custom links
                $smart_list_lightbox = "";
            }

            $buffy .= '
                            <figure class="td-slide-smart-list-figure td-slide-smart-list-7' . $smart_list_lightbox . '">
                                <a class="td-sml-link-to-image" href="' . $first_img_all_info['src'] . '" data-caption="' . esc_attr($first_img_caption, ENT_QUOTES) . '" ' . $first_img_link_target . ' >
                                    <img src="' . $first_img_info[0] . '"' . $srcset_sizes . '/>
                                </a>
                            </figure>
                            <figcaption class="td-sml-caption"><div>' . $first_img_caption . '</div></figcaption>
                            ';
        }

        // render the pagination
        $buffy .= $this->callback_render_pagination();

        $buffy .= '</div>';

        return $buffy;
    }



    protected function render_after_list_wrap() {
        $buffy = '';
        $buffy .= '</div>'; // /.td_smart_list_7  wrapper with id

        return $buffy;
    }






}