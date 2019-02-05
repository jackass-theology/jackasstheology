<?php
class tdb_single_post_share extends td_block {

	public function get_custom_css() {
		// $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
		$unique_block_class = $this->block_uid . '_rand';

		$compiled_css = '';

		$raw_css =
			"<style>

				/* @align_center */
				.$unique_block_class .td-post-sharing,
				.$unique_block_class .tdb-share-classic {
					text-align: center;
				}
				/* @align_right */
				.$unique_block_class .td-post-sharing,
				.$unique_block_class .tdb-share-classic {
					text-align: right;
				}
				/* @f_share */
				.$unique_block_class .td-social-share-text {
					@f_share
				}
				/* @f_txt */
				.$unique_block_class .td-social-network {
					@f_txt
				}
				
				/* @share_i_color */
				.$unique_block_class .td-social-expand-tabs-icon,
				.$unique_block_class .td-icon-share {
					color: @share_i_color;
				}
				/* @share_color */
				.$unique_block_class .td-social-share-text .td-social-but-text {
					color: @share_color;
				}
				.$unique_block_class .td-social-handler .td-social-but-text:before {
					background-color: @share_color;
				}
				/* @share_bg_color */
				.$unique_block_class .td-social-share-text,
				.$unique_block_class .td-social-handler {
					background-color: @share_bg_color;
				}
				.$unique_block_class .td-social-share-text:after {
					border-color: transparent transparent transparent @share_bg_color;
				}
				/* @share_b_color */
				.$unique_block_class .td-social-handler {
					border-color: @share_b_color;
				}
				.$unique_block_class .td-social-share-text:before {
					border-color: transparent transparent transparent @share_b_color;
				}
				
				/* @btn_i_color */
				.$unique_block_class .td-social-network .td-social-but-icon i {
					color: @btn_i_color;
				}
				/* @btn_color */
				.$unique_block_class .td-social-network .td-social-but-text {
					color: @btn_color;
				}
				.$unique_block_class .td-social-network .td-social-but-text:before {
					background-color: @btn_color;
				}
				/* @btn_bg_color */
				.$unique_block_class .td-ps-bg .td-social-network div,
				.$unique_block_class .td-ps-icon-bg .td-social-network .td-social-but-icon,
				.$unique_block_class .td-ps-dark-bg .td-social-network div {
					background-color: @btn_bg_color;
				}
				.$unique_block_class .td-ps-icon-arrow .td-social-but-icon:after {
				    border-left-color: @btn_bg_color;
				}
				.$unique_block_class .td-ps-border-colored .td-social-but-text {
				    border-color: @btn_bg_color;
				}
			
				/* @btn_b_color */
				.$unique_block_class .td-ps-border-grey .td-social-but-icon,
				.$unique_block_class .td-ps-border-grey .td-social-but-text,
				.$unique_block_class .td-ps-border-grey .td-social-handler {
					border-color: @btn_b_color;
				}
				
			</style>";


		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

	static function cssMedia( $res_ctx ) {

		/*-- FONTS -- */
		$res_ctx->load_font_settings( 'f_share' );
		$res_ctx->load_font_settings( 'f_txt' );

		/*-- COLORS -- */
		$res_ctx->load_settings_raw( 'share_i_color', $res_ctx->get_shortcode_att('share_i_color') );
		$res_ctx->load_settings_raw( 'share_color', $res_ctx->get_shortcode_att('share_color') );
		$res_ctx->load_settings_raw( 'share_bg_color', $res_ctx->get_shortcode_att('share_bg_color') );
		$res_ctx->load_settings_raw( 'share_b_color', $res_ctx->get_shortcode_att('share_b_color') );

		$res_ctx->load_settings_raw( 'btn_i_color', $res_ctx->get_shortcode_att('btn_i_color') );
		$res_ctx->load_settings_raw( 'btn_color', $res_ctx->get_shortcode_att('btn_color') );
		$res_ctx->load_settings_raw( 'btn_bg_color', $res_ctx->get_shortcode_att('btn_bg_color') );
		$res_ctx->load_settings_raw( 'btn_b_color', $res_ctx->get_shortcode_att('btn_b_color') );

		// content align
		$content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
		if ( $content_align == 'content-horiz-center' ) {
			$res_ctx->load_settings_raw( 'align_center', 1 );
		} else if ( $content_align == 'content-horiz-right' ) {
			$res_ctx->load_settings_raw( 'align_right', 1 );
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
	    $post_socials_data = $tdb_state_single->post_socials->__invoke( $this->get_all_atts() );

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

	        //get the block css
	        $buffy .= $this->get_block_css();

	        //get the js for this block
	        $buffy .= $this->get_block_js();

		    if( $this->get_att( 'like' ) !== 'yes' and $post_socials_data['is_amp'] === false ) {

			    $buffy .= '<div class="tdb-share-classic">';
			        $buffy .= '<iframe frameBorder="0" src="' . td_global::$http_or_https . '://www.facebook.com/plugins/like.php?href=' . $post_socials_data['post_permalink'] . '&amp;layout=button_count&amp;show_faces=false&amp;width=105&amp;action=like&amp;colorscheme=light&amp;height=21" style="border:none; overflow:hidden; width:105px; height:21px; background-color:transparent;"></iframe>';
			    $buffy .= '</div>';
		    }
		    //$buffy .= td_social_sharing::render_generic( $post_socials_data, 'td_social_sharing_article');
		    $buffy .= td_social_sharing::render_generic( $post_socials_data, $this->block_uid );

	    $buffy .= '</div>';

        return $buffy;
    }
}