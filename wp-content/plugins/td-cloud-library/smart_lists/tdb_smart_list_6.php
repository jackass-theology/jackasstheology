<?php


class tdb_smart_list_6 extends td_smart_list {
    protected $use_pagination = true; // set this to true to use rela pagination on this template
    protected $atts = array();

    function __construct($atts) {
        $this->atts = $atts;
    }


    protected function render_before_list_wrap() {
        $buffy = '';

        //wrapper with id for smart list wrapper type 2
        $buffy .= '<div class="tdb_smart_list_6">';

        return $buffy;
    }


    protected function render_list_item($item_array, $current_item_id, $current_item_number, $total_items_number) {

        $buffy = '';

        // render the pagination
        $buffy .= $this->callback_render_drop_down_pagination();

        // ad smart list
        $buffy .= $this->atts['sm_ad'];

        //creating each slide
        $buffy .= '<div class="tdb-item">';
            $buffy .= '<div class="tdb-number-and-title"><h2><span class="tdb-sml-current-item-title">' . $item_array['title'] . '</span></h2></div>';

            //adding description
            if(!empty($item_array['description'])) {
                $buffy .= '<span class="tdb-sml-description">' . $item_array['description'] . '</span>';
            }

        $buffy .= '</div>';

        // render the pagination
        $buffy .= $this->callback_render_drop_down_pagination();

        return $buffy;
    }



    protected function render_after_list_wrap() {
        $buffy = '';
        $buffy .= '</div>'; // /.tdb_smart_list_6  wrapper with id

        return $buffy;
    }






}