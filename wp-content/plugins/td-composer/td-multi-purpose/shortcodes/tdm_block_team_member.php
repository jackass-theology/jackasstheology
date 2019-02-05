<?php
class tdm_block_team_member extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block

	public function get_custom_css() {

		$compiled_css = '';
		$unique_block_class = $this->block_uid . '_rand';

		$raw_css =
			"<style>
				/* @img_margin */
				.$unique_block_class .tdm-member-image {
					margin: @img_margin;
				}
			</style>";


		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->shortcode_atts);

		$compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

	static function cssMedia( $res_ctx ) {
		// add description margin
		$img_margin = $res_ctx->get_shortcode_att( 'img_margin' );
		$res_ctx->load_settings_raw( 'img_margin', $img_margin );
		if( $img_margin != '' && is_numeric( $img_margin )  ) {
			$res_ctx->load_settings_raw( 'img_margin', $img_margin . 'px' );
		}
	}

    function render($atts, $content = null) {
        parent::render($atts);

        $this->shortcode_atts = shortcode_atts(
			array_merge(
				td_api_multi_purpose::get_mapped_atts( __CLASS__ ),
                td_api_style::get_style_group_params( 'tds_team_member' ),
                td_api_style::get_style_group_params( 'tds_social' ))
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

            // Get progress_bar_style_id
            $tds_team_member = $this->get_shortcode_att('tds_team_member');
            if ( empty( $tds_team_member ) ) {
                $tds_team_member = td_util::get_option( 'tds_team_member', 'tds_team_member1');
            }
            $tds_team_member_instance = new $tds_team_member( $this->shortcode_atts );
            $buffy .= $tds_team_member_instance->render();

        $buffy .= '</div>';


        return $buffy;
    }
}