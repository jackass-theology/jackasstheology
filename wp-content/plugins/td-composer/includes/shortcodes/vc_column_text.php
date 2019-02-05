<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 14:31
 */

class vc_column_text extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @f_post */
				.$unique_block_class,
                .$unique_block_class p {
			        @f_post
		        }
				/* @f_h1 */
				.$unique_block_class h1 {
			        @f_h1
		        }
				/* @f_h2 */
				.$unique_block_class h2 {
			        @f_h2
		        }
				/* @f_h3 */
				.$unique_block_class h3 {
			        @f_h3
		        }
				/* @f_h4 */
				.$unique_block_class h4 {
			        @f_h4
		        }
				/* @f_h5 */
				.$unique_block_class h5 {
			        @f_h5
		        }
				/* @f_h6 */
				.$unique_block_class h6 {
			        @f_h6
		        }
				/* @f_list */
				.$unique_block_class li {
			        @f_list
		        }
				/* @f_list_arrow */
				.$unique_block_class li:before {
				    margin-top: 1px;
			        line-height: @f_list_arrow !important;
		        }
				/* @f_bq */
				.$unique_block_class blockquote p {
			        @f_bq
		        }
		        
				/* @post_color */
				.$unique_block_class {
			        color: @post_color;
		        }
				/* @h_color */
				.$unique_block_class h1,
				.$unique_block_class h2,
				.$unique_block_class h3,
				.$unique_block_class h4,
				.$unique_block_class h5,
				.$unique_block_class h6 {
			        color: @h_color;
		        }
				/* @bq_color */
				.$unique_block_class blockquote p {
			        color: @bq_color;
		        }
				/* @a_color */
				.$unique_block_class a {
			        color: @a_color;
		        }
				/* @a_hover_color */
				.$unique_block_class a:hover {
			        color: @a_hover_color;
		        }

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- fonts -- */
        $res_ctx->load_font_settings( 'f_post' );
        $res_ctx->load_font_settings( 'f_h1' );
        $res_ctx->load_font_settings( 'f_h2' );
        $res_ctx->load_font_settings( 'f_h3' );
        $res_ctx->load_font_settings( 'f_h4' );
        $res_ctx->load_font_settings( 'f_h5' );
        $res_ctx->load_font_settings( 'f_h6' );
        $res_ctx->load_font_settings( 'f_list' );
        $f_list_size = $res_ctx->get_shortcode_att('f_list_font_size');
        $f_list_lh = $res_ctx->get_shortcode_att('f_list_font_line_height');
        if( $f_list_size != '' && $f_list_lh == '' ) {
            if( is_numeric( $f_list_size ) ) {
                $res_ctx->load_settings_raw( 'f_list_arrow', $f_list_size . 'px' );
            } else {
                $res_ctx->load_settings_raw( 'f_list_arrow', $f_list_size );
            }
        }
        if( $f_list_size == '' && $f_list_lh != '' ) {
            if( is_numeric( $f_list_lh ) ) {
                $res_ctx->load_settings_raw( 'f_list_arrow', 15 * $f_list_lh . 'px' );
            } else {
                $res_ctx->load_settings_raw( 'f_list_arrow', $f_list_lh );
            }
        }
        if( $f_list_size != '' && $f_list_lh != '' ) {
            if( is_numeric( $f_list_lh ) ) {
                $res_ctx->load_settings_raw( 'f_list_arrow', $f_list_size * $f_list_lh . 'px' );
            } else {
                $res_ctx->load_settings_raw( 'f_list_arrow', $f_list_lh );
            }
        }
        $res_ctx->load_font_settings( 'f_bq' );


        // colors
        $res_ctx->load_settings_raw( 'post_color', $res_ctx->get_shortcode_att('post_color') );
        $res_ctx->load_settings_raw( 'h_color', $res_ctx->get_shortcode_att('h_color') );
        $res_ctx->load_settings_raw( 'bq_color', $res_ctx->get_shortcode_att('bq_color') );
        $res_ctx->load_settings_raw( 'a_color', $res_ctx->get_shortcode_att('a_color') );
        $res_ctx->load_settings_raw( 'a_hover_color', $res_ctx->get_shortcode_att('a_hover_color') );

    }

	function render($atts, $content = null) {

		parent::render($atts);

		$atts = shortcode_atts(
			array(
				'content' => __('Html code here! Replace this with any non empty text and that\'s it.', 'td_composer' ),
				'el_class' => '',
			), $atts, 'vc_column_text' );

		if ( is_null( $content ) || empty( $content ) ) {
			$content = $atts[ 'content' ];
		}

		// As vc does
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );

//		if ( ! ( tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax() ) ) {
//			$content = do_shortcode( shortcode_unautop( $content ) );
//		}

        //fix render shortcode
        $content = do_shortcode( shortcode_unautop( $content ) );


        $buffy = '<div class="wpb_wrapper wpb_text_column td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'] ) ) . '" ' . $this->get_block_html_atts() . '">';

			//get the block css
		    $buffy .= $this->get_block_css();

			// block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title(); //get the block title
				$buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

		$buffy .= '<div class="td-fix-index">' . $content . '</div></div>';

		return $buffy;
	}
}