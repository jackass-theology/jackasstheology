<?php
class tdm_block_pricing extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

    function render($atts, $content = null) {
        parent::render($atts);

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $this->unique_block_class = $this->block_uid . '_rand';

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_pricing' ),
                td_api_style::get_style_group_params( 'tds_title' ),
                td_api_style::get_style_group_params( 'tds_button' ))
			, $atts);

        $featured = $this->get_shortcode_att( 'featured' );
        $style = $this->get_shortcode_att( 'tds_pricing' );
	    $content_align_horizontal = $this->get_shortcode_att( 'content_align_horizontal' );

        $additional_classes = array();

        // style
        $additional_classes[] = $style . '_block';

        // featured table
        if ( ! empty( $featured ) ) {
            $additional_classes[] = 'tdm-pricing-featured';
        }

        // content align horizontal
        if ( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdm-' . $content_align_horizontal;
        }

        $buffy = '';

        $buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();

            // Get tds_pricing
            $tds_pricing = $this->get_shortcode_att('tds_pricing');
            if ( empty( $tds_pricing ) ) {
                $tds_pricing = td_util::get_option( 'tds_pricing', 'tds_pricing1' );
            }
            $tds_pricing_instance = new $tds_pricing( $this->shortcode_atts, $this->unique_block_class );
            $buffy .= $tds_pricing_instance->render();

        $buffy .= '</div>';


        return $buffy;
    }
}