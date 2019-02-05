<?php
/**
 * Created by PhpStorm. tr
 * User: tagdiv
 * Date: 30.12.2014
 * Time: 13:27
 */


require_once(td_global::$get_template_directory . '/includes/wp_booster/td_video_playlist_render.php');


//class for vimeo playlist shortcode
class td_block_video_vimeo extends td_block {

//    public function get_custom_css() {
//        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
//        $unique_block_class = $this->block_uid . '_rand';
//
//        $compiled_css = '';
//
//        $raw_css =
//            "<style>
//
//				/* @f_vid */
//				.$unique_block_class .td_video_title_and_time .td_video_title {
//					@f_vid
//				}
//				/* @f_curr_vid */
//				.$unique_block_class .td_wrapper_video_playlist .td_video_title_playing {
//					@f_curr_vid
//				}
//				/* @f_timestamp */
//				.$unique_block_class .td_wrapper_video_playlist .td_video_time,
//				.$unique_block_class .td_wrapper_video_playlist .td_video_time_playing {
//					@f_timestamp
//				}
//
//			</style>";
//
//
//        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
//        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );
//
//        $compiled_css .= $td_css_res_compiler->compile_css();
//        return $compiled_css;
//    }
//
//    static function cssMedia( $res_ctx ) {
//
//        /*-- FONTS -- */
//        $res_ctx->load_font_settings( 'f_vid' );
//        $res_ctx->load_font_settings( 'f_curr_vid' );
//        $res_ctx->load_font_settings( 'f_timestamp' );
//
//    }

	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}



    function render($atts, $content = null) {

        //parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        // get the block css
        //$buffy = $this->get_block_css();

        // get the playlist
        //$buffy .= td_video_playlist_render::render_generic( $atts, 'vimeo', $this->block_uid . '_rand' );
        return td_video_playlist_render::render_generic( $atts, 'vimeo' );


        //return $buffy;
    }
}