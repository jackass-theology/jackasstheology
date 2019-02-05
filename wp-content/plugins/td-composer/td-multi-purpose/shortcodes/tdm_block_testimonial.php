<?php
class tdm_block_testimonial extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_testimonial' ))
			, $atts);

	    $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );

        $additional_classes = array();

        // content align horizontal
        if ( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }


        $buffy = '';

        $buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // Get progress_bar_style_id
            $tds_testimonial = $this->get_shortcode_att('tds_testimonial');
            if ( empty( $tds_testimonial ) ) {
                $tds_testimonial = td_util::get_option( 'tds_testimonial', 'tds_testimonial1');
            }
            $tds_testimonial_instance = new $tds_testimonial( $this->shortcode_atts );
            $buffy .= $tds_testimonial_instance->render();

        $buffy .= '</div>';


        return $buffy;
    }
}