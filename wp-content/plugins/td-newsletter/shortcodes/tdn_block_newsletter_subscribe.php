<?php
class tdn_block_newsletter_subscribe extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

    function render($atts, $content = null) {
        parent::render($atts);

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $this->unique_block_class = $this->block_uid . '_rand';

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_newsletter::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_newsletter' ))
			, $atts);

        $additional_classes = array();

        // class style
        $class_style = $this->get_shortcode_att( 'tds_newsletter' );
        if ( !empty( $class_style ) ) {
            $additional_classes[] = $class_style . '_block';
        }

        // content align horizontal
        $content_align_horizontal = $this->get_shortcode_att('content_align_horizontal');
        if( ! empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdn-' . $content_align_horizontal;
        }


        $buffy = '';

        $buffy .= '<div class="tdm_block ' . $this->get_block_classes($additional_classes) . '  td-fix-index" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            // Get tds_newsletter
            $tds_newsletter = $this->get_shortcode_att('tds_newsletter');
            if ( empty( $tds_newsletter ) ) {
                $tds_newsletter = td_util::get_option( 'tds_newsletter', 'tds_newsletter1');
            }
            $tds_newsletter_instance = new $tds_newsletter( $this->shortcode_atts, $this->unique_block_class );
            $buffy .= $tds_newsletter_instance->render();

        $buffy .= '</div>';


        return $buffy;
    }
}