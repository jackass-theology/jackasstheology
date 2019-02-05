<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 12/14/2017
 * Time: 5:29 PM
 */

require_once( 'td_amp_video_playlist_render.php' );

class td_block_video_vimeo_amp {

    function render( $atts ) {
        return td_amp_video_playlist_render::render_generic( $atts, 'vimeo' );
    }
}

