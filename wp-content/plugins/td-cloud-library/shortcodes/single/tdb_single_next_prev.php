<?php

/**
 * Class td_single_next_prev
 */

class tdb_single_next_prev extends td_block {

	public function get_custom_css() {
		// $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
		$unique_block_class = $this->block_uid . '_rand';

		$compiled_css = '';

		$raw_css =
			"<style>

                /* @box_padding */
				.$unique_block_class .tdb-next-post {
					padding: @box_padding;
				}

				/* @align_center */
				.$unique_block_class .tdb-next-post {
					text-align: center;
				}
				/* @align_right */
				.$unique_block_class .tdb-next-post {
					text-align: right;
				}
				/* @align_left */
				.$unique_block_class .tdb-next-post {
					text-align: left;
				}
				/* @bg_color */
				.$unique_block_class .tdb-next-post-bg {
					background-color: @bg_color;
				}
				/* @post_color */
				.$unique_block_class .tdb-next-post a {
					color: @post_color;
				}
				/* @post_hover_color */
				.$unique_block_class .tdb-next-post:hover a {
					color: @post_hover_color;
				}
				/* @info_color */
				.$unique_block_class .tdb-next-post span {
					color: @info_color;
				}
				/* @f_art */
				.$unique_block_class .tdb-next-post a {
					@f_art
				}
				/* @f_inf */
				.$unique_block_class .tdb-next-post span {
					@f_inf
				}
				
			</style>";


		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

	static function cssMedia( $res_ctx ) {
	    $box_padding = $res_ctx->get_shortcode_att('box_padding');
        $res_ctx->load_settings_raw( 'box_padding', $box_padding );
        if( $box_padding != '' && is_numeric( $box_padding ) ) {
            $res_ctx->load_settings_raw( 'box_padding', $box_padding . 'px' );
        }

		/*-- COLORS -- */
        $res_ctx->load_settings_raw( 'bg_color', $res_ctx->get_shortcode_att('bg_color') );
		$res_ctx->load_settings_raw( 'post_color', $res_ctx->get_shortcode_att('post_color') );
		$res_ctx->load_settings_raw( 'post_hover_color', $res_ctx->get_shortcode_att('post_hover_color') );
		$res_ctx->load_settings_raw( 'info_color', $res_ctx->get_shortcode_att('info_color') );

		/*-- FONTS -- */
		$res_ctx->load_font_settings( 'f_art' );
		$res_ctx->load_font_settings( 'f_inf' );

		// content align
		$content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
		if ( $content_align == 'content-horiz-center' ) {
			$res_ctx->load_settings_raw( 'align_center', 1 );
		} else if ( $content_align == 'content-horiz-right' ) {
			$res_ctx->load_settings_raw( 'align_right', 1 );
		} else if ( $content_align == 'content-horiz-left' ) {
			$res_ctx->load_settings_raw( 'align_left', 1 );
		}
	}

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

	    global $tdb_state_single;
	    $post_next_prev_data = $tdb_state_single->post_next_prev->__invoke();

	    $prev_post = ( !empty( $post_next_prev_data['prev_post_url'] ) and !empty( $post_next_prev_data['prev_post_title'] ) ) ? true : false;
	    $next_post = ( !empty( $post_next_prev_data['next_post_url'] ) and !empty( $post_next_prev_data['next_post_title'] ) ) ? true : false;

        $buffy = '';


        if( $prev_post or $next_post ) {
            $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                if ( $prev_post ) {
                    $buffy .= '<div class="tdb-next-post tdb-next-post-bg tdb-post-prev">';
                    $buffy .= '<span>' . __td( 'Previous article', TD_THEME_NAME ) . '</span>';
                    $buffy .= '<a href="' . $post_next_prev_data['prev_post_url'] . '">' . $post_next_prev_data['prev_post_title'] . '</a>';
                    $buffy .= '</div>';
                } else {
                    $buffy .= '<div class="tdb-next-post tdb-post-prev"></div>';
                }
                if ( $next_post ) {
                    $buffy .= '<div class="tdb-next-post tdb-next-post-bg tdb-post-next">';
                    $buffy .= '<span>' . __td( 'Next article', TD_THEME_NAME ) . '</span>';
                    $buffy .= '<a href="' . $post_next_prev_data['next_post_url'] . '">' . $post_next_prev_data['next_post_title'] . '</a>';
                    $buffy .= '</div>';
                }
            $buffy .= '</div>';

            $buffy .= '</div>';
        }

        return $buffy;
    }
}