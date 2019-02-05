<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 06.02.2017
 * Time: 16:24
 */

class vc_wp_recentcomments extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @com_margin */
				.$unique_block_class .recentcomments {
			        margin: @com_margin !important;
		        }
				/* @com_padding */
				.$unique_block_class .recentcomments {
			        padding: @com_padding !important;
		        }
		        
		        /* @com_divider */
				.$unique_block_class .recentcomments {
			        border-bottom: 1px @com_divider #f1f1f1;
		        }
		        /* @com_divider_color */
				.$unique_block_class .recentcomments {
			        border-bottom-color: @com_divider_color;
		        }

				/* @link_color */
				.$unique_block_class .recentcomments {
			        color: @link_color;
		        }
				/* @auth_color */
				.$unique_block_class .comment-author-link,
				.$unique_block_class .comment-author-link a {
			        color: @auth_color;
		        }
				/* @title_color */
				.$unique_block_class .recentcomments > a:last-child {
			        color: @title_color;
		        }
				/* @auth_h_color */
				.$unique_block_class .comment-author-link a:hover {
			        color: @auth_h_color;
		        }
				/* @title_h_color */
				.$unique_block_class .recentcomments > a:last-child:hover {
			        color: @title_h_color;
		        }
		        
		        
		        /* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
                /* @f_link */
				.$unique_block_class .recentcomments {
					@f_link
				}
                /* @f_auth */
				.$unique_block_class .comment-author-link a {
					@f_auth
				}
                /* @f_title */
				.$unique_block_class .recentcomments > a:last-child {
					@f_title
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // comments space
        $com_margin = $res_ctx->get_shortcode_att('com_margin');
        $res_ctx->load_settings_raw( 'com_margin', $com_margin );
        if( $com_margin != '' && is_numeric( $com_margin ) ) {
            $res_ctx->load_settings_raw( 'com_margin', $com_margin . 'px' );
        }
        // comments padding
        $com_padding = $res_ctx->get_shortcode_att('com_padding');
        $res_ctx->load_settings_raw( 'com_padding', $com_padding );
        if( $com_padding != '' && is_numeric( $com_padding ) ) {
            $res_ctx->load_settings_raw( 'com_padding', $com_padding . 'px' );
        }

        // comments divider
        $res_ctx->load_settings_raw( 'com_divider', $res_ctx->get_shortcode_att('com_divider') );

        // colors
        $res_ctx->load_settings_raw( 'com_divider_color', $res_ctx->get_shortcode_att('com_divider_color') );
        $res_ctx->load_settings_raw( 'link_color', $res_ctx->get_shortcode_att('link_color') );
        $res_ctx->load_settings_raw( 'auth_color', $res_ctx->get_shortcode_att('auth_color') );
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_shortcode_att('title_color') );
        $res_ctx->load_settings_raw( 'auth_h_color', $res_ctx->get_shortcode_att('auth_h_color') );
        $res_ctx->load_settings_raw( 'title_h_color', $res_ctx->get_shortcode_att('title_h_color') );

        /*-- fonts -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_link' );
        $res_ctx->load_font_settings( 'f_auth' );
        $res_ctx->load_font_settings( 'f_title' );

    }

	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}

	function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

		$td_column_number = $this->get_att('td_column_number');
		if (empty($td_column_number)) {
			$td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
		}

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

		    //get the js for this block
		    $buffy .= $this->get_block_js();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title(); //get the block title
				$buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            $buffy .= '<div id=' . $this->block_uid . ' class="td_wp_recentcomments td_block_inner td-column-' . $td_column_number . ' ">';
                $buffy .= $this->inner(get_comments($atts), $td_column_number);//inner content of the block
            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($comments, $td_column_number = '') {

        $buffy = '';

        $td_block_layout = new td_block_layout();

        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }


        $td_post_count = 0; // the number of posts rendered
	    $td_current_column = 1; //the current column

        if (!empty($comments)) {
            foreach ($comments as $comment) {

				if  ($comment->comment_approved == '1') {
					$comment_author_link = esc_url($comment->comment_author_url);
					if (empty($comment_author_link)) {
						$comment_author_link = $comment->comment_author;
					} else {
						$comment_author_link = '<a href="' . esc_url($comment->comment_author_url) . '">' . $comment->comment_author . '</a>';
					}

					$comment_link = get_comment_link($comment->comment_ID);

					switch ($td_column_number) {

						case '1': //one column layout
							$buffy .= $td_block_layout->open12(); //added in 010 theme - span 12 doesn't use rows
							$buffy .= '<span class="recentcomments"><span class="comment-author-link">' . $comment_author_link . '</span> on <a href="' . $comment_link . '">' . get_the_title($comment->comment_post_ID) . '</a></span>';
							$buffy .= $td_block_layout->close12();
							break;

						case '2': //two column layout
							$buffy .= $td_block_layout->open_row();

							$buffy .= $td_block_layout->open6(); //added in 010 theme - span 12 doesn't use rows
							$buffy .= '<span class="recentcomments"><span class="comment-author-link">' . $comment_author_link . '</span> on <a href="' . $comment_link . '">' . get_the_title($comment->comment_post_ID) . '</a></span>';
							$buffy .= $td_block_layout->close6();

							if ($td_current_column == 2) {
								$buffy .= $td_block_layout->close_row();
							}
							break;


						case '3': //three column layout
							$buffy .= $td_block_layout->open_row();

							$buffy .= $td_block_layout->open4();
							$buffy .= '<span class="recentcomments"><span class="comment-author-link">' . $comment_author_link . '</span> on <a href="' . $comment_link . '">' . get_the_title($comment->comment_post_ID) . '</a></span>';
							$buffy .= $td_block_layout->close4();

							if ($td_current_column == 3) {
								$buffy .= $td_block_layout->close_row();
							}
							break;
					}

					//current column
					if ($td_current_column == $td_column_number) {
						$td_current_column = 1;
					} else {
						$td_current_column++;
					}

					$td_post_count++;
				}
            }
        }
        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }

//	function render($atts, $content = null) {
//		parent::render($atts);
//
//		$atts = shortcode_atts(
//			array(
//				'title' => 'Recent comments',
//				'number' => '5',
//
//				'el_class' => '',
//			), $atts, 'vc_wp_recentcomments' );
//
//		$editing_class = '';
//		if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
//			$editing_class = 'tdc-editing-vc_wp_recentcomments';
//		}
//
//
//		$buffer = '<div class="wpb_wrapper td_block_wrap ' . $this->get_block_classes( array( $atts['el_class'], $editing_class ) ) . '">';
//		//$buffer .= '<span style="display: block; border-color:' . $atts['color'] . ';border-style:' . $atts['style'] . ';border-width:' . $atts['border_width'] . 'px;width:' . '"></span>';
//		$buffer .= $this->get_block_css() . '</div>';
//
//		return  $buffer;
//	}
}