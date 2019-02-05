<?php

/**
 * Class tdb_attachment_image
 */

class tdb_attachment_img extends td_block {

    // disable loop block features. This block does not use a loop and it doesn't need to run a query.
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts );

        global $tdb_state_attachment;
        $attachment_img_data = $tdb_state_attachment->attachment_image->__invoke( $atts );

        $buffy = '';

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();

        //get the js for this block
        $buffy .= $this->get_block_js();


        $buffy .= '<div class="tdb-block-inner td-fix-index">';

        if ( $attachment_img_data['is_image'] === true ) {
            $buffy .= '<a href="' . $attachment_img_data['att_url'] . '" title="' . $attachment_img_data['att_title'] . '" rel="attachment">';
                $buffy.= '<img class="td-attachment-page-image" src="' . $attachment_img_data['src'] . '" alt="' . $attachment_img_data['alt'] . '" />';
            $buffy .= '</a>';
        }

        $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }



}