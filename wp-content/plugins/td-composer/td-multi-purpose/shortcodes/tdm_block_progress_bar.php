<?php
class tdm_block_progress_bar extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
            array_merge(
                td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_progress_bar' ))
            , $atts);

	    $additional_classes = array();

        $buffy = '';

        $buffy .= '<div class="td_block_mp ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // Get progress_bar_style_id
            $tds_progress_bar = $this->get_shortcode_att('tds_progress_bar');
            if ( empty( $tds_progress_bar ) ) {
                $tds_progress_bar = td_util::get_option( 'tds_progress_bar', 'tds_progress_bar1');
            }
            $tds_progress_bar_instance = new $tds_progress_bar( $this->shortcode_atts );
            $buffy .= $tds_progress_bar_instance->render();

        $buffy .= '</div>';

        return $buffy;
    }
}