<?php
class tdm_block_button extends td_block {

	protected $shortcode_atts = array(); //the atts used for rendering the current block

	function render($atts, $content = null) {
		parent::render($atts);

		$this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_button' ))
			, $atts);

		$additional_classes = array();

		// button display
		$button_display = $this->get_shortcode_att('button_display');
        $data_inline = '';
        if ( '' !== $button_display ) {
            $additional_classes[] = $button_display;

//            if ( 'tdm-block-button-inline' == $button_display ) {
//                $data_inline = " data-inline-block='1'";
//            }
        }

        // content align horizontal
		$content_align_horizontal = $this->get_shortcode_att('content_align_horizontal');
        if( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        $data_video_popup = '';
        $icon_video_url = $this->get_shortcode_att('icon_video_url');
        if ( ! empty( $icon_video_url ) ) {
            $data_video_popup = ' data-mfp-src="' . $icon_video_url . '" ';
        }

        $data_scroll_to_class = '';
        $scroll_to_class = $this->get_shortcode_att('scroll_to_class');
        if ( ! empty( $scroll_to_class ) ) {
            $data_scroll_to_class = ' data-scroll-to-class="' . $scroll_to_class . '" ';
        }

        $data_scroll_offset = '';
        $scroll_offset = $this->get_shortcode_att('scroll_offset');
        if ( ! empty( $scroll_offset ) ) {
            $data_scroll_offset = ' data-scroll-offset="' . $scroll_offset . '" ';
        }

		$buffy = '';

		$buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . ' ' . $data_inline . ' ' . $data_video_popup . ' ' . $data_scroll_to_class . ' ' . $data_scroll_offset . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // button
            $button_text = $this->get_shortcode_att('button_text');
            if ( ! empty( $button_text ) ) {
                $tds_button = $this->get_shortcode_att('tds_button');
                if ( empty( $tds_button ) ) {
                    $tds_button = td_util::get_option( 'tds_button', 'tds_button1' );
                }
                $tds_button_instance = new $tds_button( $this->shortcode_atts );
                $buffy .= $tds_button_instance->render();
            }

		$buffy .= '</div>';

		return $buffy;
	}
}