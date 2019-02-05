<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 07.09.2017
 * Time: 14:20
 */

class tdm_block_column_title extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

	function render($atts, $content = null) {
		parent::render($atts);

        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $this->unique_block_class = $this->block_uid . '_rand';

		$this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
				td_api_style::get_style_group_params( 'tds_title' ))

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

            $buffy .= '<div class="td-block-row">';
                $buffy .= '<div class="td-block-span12 tdm-col">';
                    // Get tds_title
                    $tds_title = $this->get_shortcode_att('tds_title');
                    if ( empty( $tds_title ) ) {
                        $tds_title = td_util::get_option( 'tds_title', 'tds_title1' );
                    }
                    $tds_title_instance = new $tds_title( $this->shortcode_atts, $this->unique_block_class );
                    $buffy .= $tds_title_instance->render();
                $buffy .= '</div>';
            $buffy .= '</div>';

		$buffy .= '</div>';

		return $buffy;
	}
}