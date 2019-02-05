<?php


class tdb_smart_list_1 extends td_smart_list {
    protected $atts = array();

    function __construct($atts) {
        $this->atts = $atts;
    }

    protected function render_before_list_wrap() {
        $buffy = '';

        //wrapper with id for smart list wrapper type 2
        $buffy .= '<div class="tdb_smart_list_1">';

        return $buffy;
    }


    protected function render_list_item($item_array, $current_item_id, $current_item_number, $total_items_number) {

        $buffy = '';

        //creating each slide
        $buffy .= '<div class="tdb-item">';

            //get the title
            $smart_list_1_title = '';
            if(!empty($item_array['title'])) {
                $smart_list_1_title = $item_array['title'];
            }

            $buffy .= '<div class="tdb-number-and-title">';
                $buffy .= '<h2>';
                    $buffy .= '<div class="tdb-sml-current-item-nr"><span>' . $current_item_number. '</span></div>';
                    $buffy .= '<span class="tdb-sml-current-item-title">' . $smart_list_1_title . '</span>';
                $buffy .= '</h2>';
            $buffy .= '</div>';


            //get image link target
            $first_img_link_target = $item_array['first_img_link_target'];

            //get image src
            $first_img_src = td_util::attachment_get_full_info($item_array['first_img_id'])['src'];

            //image type and width
            $first_image_size = 'td_1068x0';
            if( isset( $this->atts['first_image_size'] ) && $this->atts['first_image_size'] != '' ) {
                $first_image_size = $this->atts['first_image_size'];
            }

            $first_img_info = wp_get_attachment_image_src( $item_array['first_img_id'], $first_image_size );
            $image_type = $first_image_size;
            $image_width = $first_img_info[1];

            //image caption
            $first_img_caption = $item_array['first_img_caption'];


            if (!empty($first_img_info[0])) {

                //retina image
                $srcset_sizes = td_util::get_srcset_sizes($item_array['first_img_id'], $image_type, $image_width, $first_img_info[0]);

                // class used by magnific popup
                $smart_list_lightbox = " td-lightbox-enabled";

                // if a custom link is set use it
                if (!empty($item_array['first_img_link']) && $first_img_src != $item_array['first_img_link']) {
                    $first_img_src = $item_array['first_img_link'];

                    // remove the magnific popup class for custom links
                    $smart_list_lightbox = "";
                }

                $buffy .= '
                        <figure class="tdb-slide-smart-list-figure td-slide-smart-list-2' . $smart_list_lightbox . '">
                            <a class="td-sml-link-to-image" href="' . $first_img_src . '" data-caption="' . esc_attr($first_img_caption, ENT_QUOTES) . '" ' . $first_img_link_target .' >
                                <img src="' . $first_img_info[0] . '"' . $srcset_sizes . '/>
                            </a>
                        </figure>
                        <figcaption class="tdb-sml-caption"><div>' . $first_img_caption . '</div></figcaption>
                        ';
            }


            //adding description
            if(!empty($item_array['description'])) {
                $buffy .= '<span class="tdb-sml-description">' . $item_array['description'] . '</span>';
            }

        $buffy .= '</div>';

        return $buffy;
    }


    protected function render_after_list_wrap() {
        $buffy = '';
        $buffy .= '</div>'; // /.tdb_smart_list_1  wrapper with id

        return $buffy;
    }
}