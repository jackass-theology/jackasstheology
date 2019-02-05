<?php

/**
 * Class tdb_attachment_title
 */

class tdb_attachment_title extends td_block {



    // disable loop block features. This block does not use a loop and it doesn't need to run a query.
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_attachment;
        $attachment_title_data = $tdb_state_attachment->title->__invoke( $atts );

//        $buffy = '<pre>';
//        $buffy .= print_r( $attachment_title_data['wp_query'], true);
//        $buffy .= '</pre>';

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

        //get the block css
        $buffy .= $this->get_block_css();

        //get the js for this block
        $buffy .= $this->get_block_js();


        $buffy .= '<div class="tdb-block-inner td-fix-index">';
        $buffy .= '<div class="td-page-header">';

        $buffy.= '<h1 class="entry-title td-page-title">';
        $buffy.= '<span>' . $attachment_title_data['title'] . '</span>';
        $buffy.= '</h1>';

        $buffy .= '</div>';
        $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }



}