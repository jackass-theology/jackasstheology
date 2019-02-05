<?php
///**
// * Created by PhpStorm.
// * User: andromeda
// * Date: 1/17/2017
// * Time: 1:25 PM
// */

class td_block_template {
    /**
     * @var string the template data, it's set on construct
     */
    private $template_data_array = '';

    /**
     * @param $template_data_array array - all the data for the template
     *
                 array(
                    'atts' => $atts,
                    'block_uid' => $this->block_uid,
                    'unique_block_class' => $unique_block_class,
                    'td_pull_down_items' => $td_pull_down_items,
                )
     */
    function __construct($template_data_array) {
        $this->template_data_array = $template_data_array;
    }



    protected function get_att($att_name) {
        if (!empty($this->template_data_array['atts'][$att_name])) {
            return $this->template_data_array['atts'][$att_name];
        }

        return '';
    }



    protected function get_block_uid() {
        return $this->template_data_array['block_uid'];
    }

    protected function get_unique_block_class() {
        return $this->template_data_array['unique_block_class'];
    }

    /**
     * @return bool|mixed returns false if there are no pull down items, if items are available it will return the items array
     * we need to return false because empty() does not work in php prior to 5.5 on functions :(
     */
    protected function get_td_pull_down_items() {
        if (empty($this->template_data_array['td_pull_down_items'])) {
            return false;
        }
        return $this->template_data_array['td_pull_down_items'];
    }




    protected function get_td_pull_down_item($index) {
        if (empty($this->template_data_array['td_pull_down_items'][$index])) {
            return false;
        }

        return $this->template_data_array['td_pull_down_items'][$index];
    }



}