<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 12/14/2017
 * Time: 5:29 PM
 */

class td_block_related_posts_amp extends td_block {

    var $post;

    function __construct($post) {
        $this->post = $post;
    }

    function render( $atts, $content = null ) {

        parent::render( $atts );

        if ($this->post->post_type != 'post') {
            return '';
        }

        if ( td_util::get_option( 'tds_similar_articles' ) == 'hide' ) {
            return '';
        }

        // we have no related posts to display
        if ( $this->td_query->post_count == 0 ) {
            return '';
        }

        $buffy = ''; //output buffer

        $buffy .= '<div class="td_block_related_posts_amp">';
        $buffy .= '<h4 class="td-related-title">' . __td( 'RELATED ARTICLES', TD_THEME_NAME ) . '</h4>';
        $buffy .= '<div class="td_block_inner">';
        $buffy .= $this->inner( $this->td_query->posts );  //inner content of the block
        $buffy .= '</div>';

        $buffy .= '</div>';

        $buffy = td_sanitize_image( $buffy );

        return $buffy;
    }

    function inner($posts) {
        $td_block_layout = new td_block_layout();
        $td_block_layout->row_class = 'td-related-row';
        $td_block_layout->span4_class = 'td-related-span4';

        $buffy = '';

        if (!empty($posts)) {
            foreach ($posts as $td_post_count => $post) {

                $td_module_related_posts = new td_module_amp_1($post);

                $buffy .= $td_block_layout->open_row();
                $buffy .= $td_block_layout->open4();
                $buffy .= $td_module_related_posts->render();
                $buffy .= $td_block_layout->close4();

            }
        }

        $buffy .= $td_block_layout->close_all_tags();

        return $buffy;
    }
}

