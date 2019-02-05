<?php
class tdm_block_call_to_action extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

    function render($atts, $content = null) {
        parent::render($atts);

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $this->unique_block_class = $this->block_uid . '_rand';

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_call_to_action' ),
                td_api_style::get_style_group_params( 'tds_title' ),
                td_api_style::get_style_group_params( 'tds_button' ))
			, $atts);

        $class_style = $this->get_shortcode_att( 'tds_call_to_action' );
	    $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );
        $content_align_vertical = $this->get_shortcode_att('content_align_vertical');
        $flip_content = $this->get_shortcode_att( 'flip_content' );

        $additional_classes = array();

        // class style
        if ( !empty( $class_style ) ) {
            $additional_classes[] = $class_style;
        }

        // flip-content
        if ( !empty( $flip_content ) ) {
            $additional_classes[] = 'tdm-flip-' . $flip_content;
        }

        // content align horizontal
        if ( !empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        // text align vertical
        if ( !empty($content_align_vertical ) ) {
            $additional_classes[] = 'tdm-' . $content_align_vertical;
        }


        $buffy = '';

        $buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // Get tds_call_to_action
            $tds_call_to_action = $this->get_shortcode_att('tds_call_to_action');
            if ( empty( $tds_call_to_action ) ) {
                $tds_call_to_action = td_util::get_option( 'tds_call_to_action', 'tds_call_to_action1' );
            }
            $tds_call_to_action_instance = new $tds_call_to_action( $this->shortcode_atts, $this->unique_block_class );
            $buffy .= $tds_call_to_action_instance->render();

        $buffy .= '</div>';


        return $buffy;
    }
}