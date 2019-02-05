<?php

/**
 * Class tdb_single_categories
 */


class tdb_single_categories extends td_block {

	public function get_custom_css() {
		// $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
		$unique_block_class = $this->block_uid . '_rand';

		$compiled_css = '';

		$raw_css =
			"<style>

                /* @cat_padding */
				.$unique_block_class .tdb-entry-category {
					padding: @cat_padding;
				}
                /* @cat_space */
				.$unique_block_class .tdb-entry-category {
					margin: @cat_space;
				}
                /* @cat_border */
				.$unique_block_class .tdb-cat-bg {
					border-width: @cat_border;
				}
				/* @cat_skew */
				.$unique_block_class .tdb-cat-bg {
					transform: skew(@cat_skew);
                    -webkit-transform: skew(@cat_skew);
				}

                /* @text_color */
				.$unique_block_class .tdb-entry-category {
					color: @text_color !important;
				}
                /* @bg_solid */
				.$unique_block_class .tdb-cat-bg {
					background-color: @bg_solid !important;
				}
                /* @bg_gradient */
				.$unique_block_class .tdb-cat-bg {
					@bg_gradient;
				}
				/* @bg_hover_solid */
				.$unique_block_class .tdb-cat-bg:before {
					background-color: @bg_hover_solid;
				}
				/* @bg_hover_gradient */
				.$unique_block_class .tdb-cat-bg:before {
					@bg_hover_gradient
				}
				.$unique_block_class .tdb-entry-category:hover .tdb-cat-bg:before {
					opacity: 1;
				}

				/* @text_hover_color */
				.$unique_block_class .tdb-entry-category:hover {
					color: @text_hover_color !important;
				}
				/* @border_color_solid */
				.$unique_block_class .tdb-cat-bg {
					border-color: @border_color_solid !important;
				}
				/* @border_color_params */
				.$unique_block_class .tdb-cat-bg {
				    border-image: linear-gradient(@border_color_params);
				    border-image: -webkit-linear-gradient(@border_color_params);
				    border-image-slice: 1;
				    transition: none;
				}
				.$unique_block_class .tdb-entry-category:hover .tdb-cat-bg {
				    border-image: linear-gradient(@border_hover_color, @border_hover_color);
				    border-image: -webkit-linear-gradient(@border_hover_color, @border_hover_color);
				    border-image-slice: 1;
				    transition: none;
				}
				/* @border_hover_color */
				.$unique_block_class .tdb-entry-category:hover .tdb-cat-bg {
					border-color: @border_hover_color !important;
				}

                /* @cat_radius */
				.$unique_block_class .tdb-cat-bg,
				.$unique_block_class .tdb-cat-bg:before {
					border-radius: @cat_radius;
				}
                /* @icon_size */
				.$unique_block_class .tdb-cat-sep {
					font-size: @icon_size;
				}
                /* @icon_space */
				.$unique_block_class .tdb-cat-sep {
					margin: 0 @icon_space;
				}
                /* @icon_align */
				.$unique_block_class .tdb-cat-sep {
					top: @icon_align;
				}
                /* @i_color */
				.$unique_block_class .tdb-cat-sep {
					color: @i_color;
				}
                /* @txt_color */
				.$unique_block_class .tdb-cat-text {
					color: @txt_color;
				}
                /* @add_space */
				.$unique_block_class .tdb-cat-text {
					margin-right: @add_space;
				}
				/* @align_center */
				.td-theme-wrap .$unique_block_class {
					text-align: center;
				}
				/* @align_right */
				.td-theme-wrap .$unique_block_class {
					text-align: right;
				}	
				/* @align_left */
				.td-theme-wrap .$unique_block_class {
					text-align: left;
				}
				/* @f_tags */
				.$unique_block_class .tdb-entry-category {
					@f_tags
				}
				/* @f_txt */
				.$unique_block_class .tdb-cat-text {
					@f_txt
				}

			</style>";


		$td_css_res_compiler = new td_css_res_compiler( $raw_css );
		$td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();
		return $compiled_css;
	}

	static function cssMedia( $res_ctx ) {

		// cat_padding
		$cat_padding = $res_ctx->get_shortcode_att('cat_padding');
		$res_ctx->load_settings_raw( 'cat_padding', $cat_padding );
		if ( is_numeric( $cat_padding ) ) {
			$res_ctx->load_settings_raw( 'cat_padding', $cat_padding . 'px' );
		}
		// cat_space
		$cat_space = $res_ctx->get_shortcode_att('cat_space');
		$res_ctx->load_settings_raw( 'cat_space', $cat_space );
		if ( is_numeric( $cat_space ) ) {
			$res_ctx->load_settings_raw( 'cat_space', $cat_space . 'px' );
		}

		// cat_skew
		$cat_skew = $res_ctx->get_shortcode_att('cat_skew');
		if ( $cat_skew != 0 || !empty($cat_skew) ) {
			$res_ctx->load_settings_raw( 'cat_skew', $cat_skew . 'deg' );
		}

		// cat_radius
		$cat_radius = $res_ctx->get_shortcode_att('cat_radius');
		if ( $cat_radius != 0 || !empty($cat_radius) ) {
			$res_ctx->load_settings_raw( 'cat_radius', $cat_radius . 'px' );
		}

		// icon_size
		$icon_size = $res_ctx->get_shortcode_att('icon_size');
		if ( $icon_size != 0 || !empty($icon_size) ) {
			$res_ctx->load_settings_raw( 'icon_size', $icon_size . 'px' );
		}
		// icon_space
		$icon_space = $res_ctx->get_shortcode_att('icon_space');
		if ( $icon_space != 0 || !empty($icon_space) ) {
			$res_ctx->load_settings_raw( 'icon_space', $icon_space . 'px' );
		}
		// icon_align
		$icon_align = $res_ctx->get_shortcode_att('icon_align');
		if ( $icon_align != 0 || !empty($icon_align) ) {
			$res_ctx->load_settings_raw( 'icon_align', $icon_align . 'px' );
		}
		// add_space
		$add_space = $res_ctx->get_shortcode_att('add_space');
		if ( $add_space != 0 || !empty($add_space) ) {
			$res_ctx->load_settings_raw( 'add_space', $add_space . 'px' );
		}

		// content align
		$content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
		if ( $content_align == 'content-horiz-center' ) {
			$res_ctx->load_settings_raw( 'align_center', 1 );
		} else if ( $content_align == 'content-horiz-right' ) {
			$res_ctx->load_settings_raw( 'align_right', 1 );
		} else if ( $content_align == 'content-horiz-left' ) {
			$res_ctx->load_settings_raw( 'align_left', 1 );
		}


		$res_ctx->load_settings_raw( 'cat_border', $res_ctx->get_shortcode_att('cat_border') . 'px' );

		// colors
		$res_ctx->load_settings_raw( 'text_color', $res_ctx->get_shortcode_att('text_color') );
		$res_ctx->load_color_settings( 'bg_color', 'bg_solid', 'bg_gradient', '', '' );
		$res_ctx->load_color_settings( 'border_color', 'border_color_solid', 'border_color_gradient', 'border_color_gradient_1', 'border_color_params', '' );
		$res_ctx->load_color_settings( 'bg_hover_color', 'bg_hover_solid', 'bg_hover_gradient', '', '', '' );
		$res_ctx->load_settings_raw( 'text_hover_color', $res_ctx->get_shortcode_att('text_hover_color') );
		$res_ctx->load_settings_raw( 'border_hover_color', $res_ctx->get_shortcode_att('border_hover_color') );
		$res_ctx->load_settings_raw( 'i_color', $res_ctx->get_shortcode_att('i_color') );
		$res_ctx->load_settings_raw( 'txt_color', $res_ctx->get_shortcode_att('txt_color') );

		/*-- fonts -- */
		$res_ctx->load_font_settings( 'f_tags' );
		$res_ctx->load_font_settings( 'f_txt' );

	}

	/**
	 * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}


	function render($atts, $content = null) {
		parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

		global $tdb_state_single;
		$post_categories_data = $tdb_state_single->post_categories->__invoke( $this->get_all_atts() );

		if ( empty( $post_categories_data ) or !is_array( $post_categories_data ) ) {
			return $post_categories_data;
		}

		// add_text
		$add_text = rawurldecode( base64_decode( strip_tags ( $this->get_att( 'add_text' ) ) ) );
		$add_text_html = '';
		if ( ! empty( $add_text ) ) {
			$add_text_html = '<div class="tdb-cat-text">' . $add_text . '</div>';
		}

		// cat_limit
		$cat_count = 0;
		$cat_limit = $this->get_att( 'cat_limit' );
		if( $cat_limit == '' || !is_numeric( $cat_limit ) ) {
			$cat_limit = 30;
		}

		// tdicon
		$tdicon_html = '';
		$tdicon = $this->get_att( 'tdicon' );
		if( $tdicon != '' ) {
			$tdicon_html = '<i class="' . $tdicon . ' tdb-cat-sep"></i>';
		}

		// cat_style
		$cat_text_color = '';
		$cat_style = $this->get_att( 'cat_style' );


		$buffy = ''; //output buffer

		$buffy .= '<div class="' . $this->get_block_classes() . ' ' . $cat_style . '"  ' . $this->get_block_html_atts() . '>';

			//get the block css
			$buffy .= $this->get_block_css();

			//get the js for this block
			$buffy .= $this->get_block_js();

			$buffy .= '<div class="tdb-category td-fix-index">';

				$buffy .= $add_text_html;

				foreach ( $post_categories_data as $category_name => $category_params ) {
					if ( $category_params['hide_on_post'] == 'hide' ) {
						continue;
					}
					$cat_count++;
					if( $cat_limit < $cat_count ) {
						break;
					}

					if ( ! empty( $category_params['color'] ) ) {
						// set title color based on background color contrast
						$td_cat_title_color = td_util::readable_colour( $category_params['color'], 200, 'rgba(0, 0, 0, 0.9)', '#fff' );
						$td_cat_bg = ' style="background-color:' . $category_params['color'] . '; border-color:' . $category_params['color']  . ';"';
						if ( $td_cat_title_color == '#fff' ) {
							$td_cat_color = '';
						} else {
							$td_cat_color = ' style="color:' . $td_cat_title_color . ';"';
						}
						if( $cat_style == 'tdb-cat-style2' ) {
							$td_cat_bg = ' style="background-color:' . td_util::hex2rgba($category_params['color'], 0.85) . '; border-color:' . $category_params['color'] . ';"';
						}
						if( $cat_style == 'tdb-cat-style3' ) {
							$td_cat_bg = ' style="background-color:' . td_util::hex2rgba($category_params['color'], 0.2) . '; border-color:' . td_util::hex2rgba($category_params['color'], 0.05) . ';"';
							$cat_text_color = ' style="color:' . $category_params['color'] . ';"';
						}
					} else {
						$td_cat_bg = '';
						$td_cat_color = '';
						$cat_text_color = '';
					}

					$buffy .= '<a class="tdb-entry-category"' . $td_cat_color . ' href="' . $category_params['link'] . '" ' . $cat_text_color . '><span class="tdb-cat-bg"' . $td_cat_bg . '></span>' . $category_name . '</a>' . $tdicon_html;
				}
			$buffy .= '</div>';

		$buffy .= '</div>';

		return $buffy;
	}
}