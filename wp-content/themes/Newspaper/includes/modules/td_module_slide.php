<?php

class td_module_slide extends td_module {


    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function get_title_main() {
        $buffy = '';

        $buffy .= '<div class="td-sbig-title-wrap">';
        $buffy .='<a class="noSwipe" href="' . $this->href . '" rel="bookmark" title="' . $this->title_attribute . '">';
        $buffy .= $this->get_title();
        $buffy .='</a>';
        $buffy .= '</div>';

        return $buffy;
    }

    function render($td_column_number, $td_post_count, $td_unique_id_slide) {
        $image_size = $this->get_shortcode_att('image_size');

        $buffy = '';

        $buffy .= '<div id="' . $td_unique_id_slide . '_item_' . $td_post_count . '" class = "' . $this->get_module_classes(array("td-image-gradient")) . '">';

            if ( $image_size == '' ) {
                switch ($td_column_number) {
                    case '1': //one column layout
                        $buffy .= $this->get_image('td_324x400', true);
                        break;
                    case '2': //two column layout
                        $buffy .= $this->get_image('td_696x385', true);
                        break;
                    case '3': //three column layout
                        $buffy .= $this->get_image('td_1068x580', true);
                        break;
                    default:
                        $buffy .= $this->get_image('td_1068x580', true);
                        break;
                }
            } else {
                $buffy .= $this->get_image($image_size, true);
            }

            $buffy .= '<div class="td-slide-meta">';
                $buffy .= '<span class="slide-meta-cat">';
                    $buffy .= $this->get_category();
                $buffy .= '</span>';
                $buffy .=  $this->get_title();//$this->get_title_main();
                $buffy .= '<div class="td-module-meta-info">';
                    $buffy .= $this->get_author();
                    $buffy .= $this->get_date();
                    $buffy .= $this->get_comments();
                $buffy .= '</div>';
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

    function get_category() {
        $buffy = '';

        //read the post meta to get the custom primary category
        $td_post_theme_settings = td_util::get_post_meta_array($this->post->ID, 'td_post_theme_settings');
        if (!empty($td_post_theme_settings['td_primary_cat'])) {
            //we have a custom category selected
            $selected_category_obj = get_category($td_post_theme_settings['td_primary_cat']);
        } else {
            //get one auto
            $categories = get_the_category($this->post->ID);
            if (!empty($categories[0])) {
                if ($categories[0]->name === TD_FEATURED_CAT and !empty($categories[1])) {
                    $selected_category_obj = $categories[1];
                } else {
                    $selected_category_obj = $categories[0];
                }
            }
        }


        if (!empty($selected_category_obj)) { //@todo catch error here
            $buffy .= '<a href="' . get_category_link($selected_category_obj->cat_ID) . '">'  . $selected_category_obj->name . '</a>' ;
        }

        //return print_r($post, true);
        return $buffy;
    }


    //overwrite the default function from td_module.php
    function get_comments() {
        $buffy = '';
        if (td_util::get_option('tds_m_show_comments') != 'hide') {
            $buffy .= '<div class="td-post-comments"><i class="td-icon-comments"></i>';
            $buffy .= '<a href="' . get_comments_link($this->post->ID) . '">';
            $buffy .= get_comments_number($this->post->ID);
            $buffy .= '</a>';
            $buffy .= '</div>';
        }

        return $buffy;
    }
}
//td-icon-views