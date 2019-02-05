<?php
class tdm_block_counter extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
            array_merge(
                td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_counter' ))
            , $atts);

        $additional_classes = array();

        // content align horizontal
        $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );
        if( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        $buffy = '';

        $buffy .= '<div class="td_block_mp ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // Get tds_counter_style_id
            $tds_tds_counter = $this->get_shortcode_att('tds_counter');
            if ( empty( $tds_tds_counter ) ) {
                $tds_tds_counter = td_util::get_option( 'tds_counter', 'tds_counter1');
            }
            $tds_tds_counter_instance = new $tds_tds_counter( $this->shortcode_atts );
            $buffy .= $tds_tds_counter_instance->render();

        $buffy .= '</div>';

        return $buffy;
    }
}