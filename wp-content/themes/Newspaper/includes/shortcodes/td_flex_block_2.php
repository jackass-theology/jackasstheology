<?php

class td_flex_block_2 extends td_block {

    static function cssMedia( $res_ctx ) {

        // forced
//        $image_margin_forced = $res_ctx->get_shortcode_att('image_margin_forced');
//        if( $image_margin_forced != '' && is_numeric( $image_margin_forced ) ) {
//            $res_ctx->load_settings_raw( 'image_margin_forced', 1 );
//        }

        // modules height
        $modules_height = $res_ctx->get_shortcode_att('modules_height');
        $res_ctx->load_settings_raw( 'modules_height', '460px' );
        if( $modules_height != '' && is_numeric( $modules_height ) ) {
            $res_ctx->load_settings_raw( 'modules_height', $modules_height . 'px' );
        }

        // image margin right
        $image_margin = $res_ctx->get_shortcode_att('image_margin');
        $image_margin_right = $res_ctx->get_shortcode_att('image_margin_right');
        if( $image_margin_right == '' ) {
            if( $image_margin != '' ) {
                if( is_numeric( $image_margin ) ) {
                    $res_ctx->load_settings_raw( 'image_margin_left', $image_margin . 'px' );
                }
            } else {
                $res_ctx->load_settings_raw( 'image_margin_left', '100px' );
            }
        } else {
            if( $image_margin != '' ) {
                if ( is_numeric($image_margin) ) {
                    $res_ctx->load_settings_raw('image_margin_right', $image_margin . 'px');
                }
            } else {
                $res_ctx->load_settings_raw( 'image_margin_right', '100px' );
            }
        }

        // modules bottom margin
        $modules_space = $res_ctx->get_shortcode_att('modules_space');
        $res_ctx->load_settings_raw( 'modules_space', '36px' );
        if( $modules_space != '' && is_numeric( $modules_space ) ) {
            $res_ctx->load_settings_raw( 'modules_space', $modules_space . 'px' );
        }

        // block title over image
        $res_ctx->load_settings_raw( 'block_title_over', $res_ctx->get_shortcode_att('block_title_over') );

        // block title space
        $block_title_space = $res_ctx->get_shortcode_att('block_title_space');
        $res_ctx->load_settings_raw( 'block_title_space', $block_title_space );
        if( $block_title_space != '' ) {
            if ( is_numeric( $block_title_space ) ) {
                $res_ctx->load_settings_raw( 'block_title_space', $block_title_space . 'px' );
            }
        }

        // next prev position
        $nextprev_position = $res_ctx->get_shortcode_att('nextprev_position');
        if( $nextprev_position == 'bottom' ) {
            $res_ctx->load_settings_raw( 'nextprev_position', 'bottom: 0;' );
        } else {
            $res_ctx->load_settings_raw( 'nextprev_position', 'top: 0;' );
        }

        // next prev space
        $nextprev = $res_ctx->get_shortcode_att('nextprev');
        $res_ctx->load_settings_raw( 'nextprev', $nextprev );
        if( $nextprev != '' ) {
            if ( is_numeric( $nextprev ) ) {
                $res_ctx->load_settings_raw( 'nextprev', $nextprev . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'nextprev', '20px 20px 0 0' );
        }



        /*-- IMAGE-- */
        //image alignment
        $res_ctx->load_settings_raw( 'image_alignment', $res_ctx->get_shortcode_att('image_alignment') . '%' );

        // image radius
        $image_radius = $res_ctx->get_shortcode_att('image_radius');
        $res_ctx->load_settings_raw( 'image_radius', $image_radius );
        if( $image_radius != '' ) {
            if( is_numeric( $image_radius ) ) {
                $res_ctx->load_settings_raw( 'image_radius', $image_radius . 'px' );
            }
        }



        /*-- META INFO-- */
        // meta info vertical align
        $meta_info_align = $res_ctx->get_shortcode_att('meta_info_align');
        if ( $meta_info_align == 'center' ) {
            $res_ctx->load_settings_raw( 'meta_vert_align_center', 1 );
        } else if ( $meta_info_align == 'bottom' ) {
            $res_ctx->load_settings_raw( 'meta_vert_align_bottom', 1 );
        }

        // meta info horizontal align
        $content_align = $res_ctx->get_shortcode_att('meta_info_horiz');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_right', 1 );
        }

        // meta info width
        $meta_info_width = $res_ctx->get_shortcode_att('meta_width');
        $res_ctx->load_settings_raw( 'meta_width', $meta_info_width );
        if( $meta_info_width != '' && is_numeric( $meta_info_width ) ) {
            $res_ctx->load_settings_raw( 'meta_width', $meta_info_width . 'px' );
        }

        // meta info margin
        $meta_margin = $res_ctx->get_shortcode_att('meta_margin');
        $res_ctx->load_settings_raw( 'meta_margin', $meta_margin );
        if ( is_numeric( $meta_margin ) ) {
            $res_ctx->load_settings_raw( 'meta_margin', $meta_margin . 'px' );
        }

        // meta info padding
        $meta_padding = $res_ctx->get_shortcode_att('meta_padding');
	    $res_ctx->load_settings_raw( 'meta_padding', $meta_padding );
	    if( $meta_padding != '' ) {
            if ( is_numeric( $meta_padding ) ) {
                $res_ctx->load_settings_raw( 'meta_padding', $meta_padding . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'meta_padding', '0 40px 40px 0' );
        }

        // article title space
	    $art_title = $res_ctx->get_shortcode_att('art_title');
	    $res_ctx->load_settings_raw( 'art_title', $art_title );
	    if( $art_title != '' ) {
            if ( is_numeric( $art_title ) ) {
                $res_ctx->load_settings_raw( 'art_title', $art_title . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'art_title', '0 0 8px 0' );
        }

	    // article excerpt space
	    $art_excerpt = $res_ctx->get_shortcode_att('art_excerpt');
	    $res_ctx->load_settings_raw( 'art_excerpt', $art_excerpt );
	    if( $art_excerpt != '' ) {
            if ( is_numeric( $art_excerpt ) ) {
                $res_ctx->load_settings_raw( 'art_excerpt', $art_excerpt . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'art_excerpt', '18px 0 0 0' );
        }

        // category tag space
        $modules_category_padding = $res_ctx->get_shortcode_att('modules_category_padding');
        $res_ctx->load_settings_raw( 'modules_category_padding', $modules_category_padding  );
	    if( $modules_category_padding != '' && is_numeric( $modules_category_padding ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding', $modules_category_padding . 'px' );
        }

	    // show meta info details
	    $res_ctx->load_settings_raw( 'show_cat', $res_ctx->get_shortcode_att('show_cat') );
	    $res_ctx->load_settings_raw( 'show_excerpt', $res_ctx->get_shortcode_att('show_excerpt') );
        $show_author = $res_ctx->get_shortcode_att('show_author');
        $show_date = $res_ctx->get_shortcode_att('show_date');
        $show_review = $res_ctx->get_shortcode_att('show_review');
        $show_com = $res_ctx->get_shortcode_att('show_com');
        if( $show_author == 'none' && $show_date == 'none' && $show_com == 'none' && $show_review == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date', 1 );
        }
        $res_ctx->load_settings_raw( 'show_author', $show_author );
        $res_ctx->load_settings_raw( 'show_date', $show_date );
        $res_ctx->load_settings_raw( 'show_review', $show_review );
        $res_ctx->load_settings_raw( 'show_com', $show_com );



        /*-- FONTS-- */
	    $res_ctx->load_font_settings( 'f_header' );
	    $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );
	    $res_ctx->load_font_settings( 'f_title' );
	    $res_ctx->load_font_settings( 'f_cat' );
	    $res_ctx->load_font_settings( 'f_meta' );
	    $res_ctx->load_font_settings( 'f_ex' );



        /*-- COLORS-- */
        $res_ctx->load_color_settings( 'color_overlay', 'overlay', 'overlay_gradient', '', '' );
        $res_ctx->load_settings_raw( 'color_overlay', $res_ctx->get_shortcode_att('color_overlay') );
	    $res_ctx->load_settings_raw( 'meta_bg', $res_ctx->get_shortcode_att('meta_bg') );
        $res_ctx->load_settings_raw( 'nextprev_icon', $res_ctx->get_shortcode_att('nextprev_icon') );
        $res_ctx->load_settings_raw( 'nextprev_bg', $res_ctx->get_shortcode_att('nextprev_bg') );
        $res_ctx->load_settings_raw( 'nextprev_icon_h', $res_ctx->get_shortcode_att('nextprev_icon_h') );
        $res_ctx->load_settings_raw( 'nextprev_bg_h', $res_ctx->get_shortcode_att('nextprev_bg_h') );
	    $res_ctx->load_settings_raw( 'cat_bg', $res_ctx->get_shortcode_att('cat_bg') );
	    $res_ctx->load_settings_raw( 'cat_txt', $res_ctx->get_shortcode_att('cat_txt') );
	    $res_ctx->load_settings_raw( 'cat_bg_hover', $res_ctx->get_shortcode_att('cat_bg_hover') );
	    $res_ctx->load_settings_raw( 'cat_txt_hover', $res_ctx->get_shortcode_att('cat_txt_hover') );
	    $res_ctx->load_settings_raw( 'title_txt', $res_ctx->get_shortcode_att('title_txt') );
	    $res_ctx->load_settings_raw( 'title_txt_hover', $res_ctx->get_shortcode_att('title_txt_hover') );
	    $res_ctx->load_settings_raw( 'author_txt', $res_ctx->get_shortcode_att('author_txt') );
	    $res_ctx->load_settings_raw( 'author_txt_hover', $res_ctx->get_shortcode_att('author_txt_hover') );
	    $res_ctx->load_settings_raw( 'date_txt', $res_ctx->get_shortcode_att('date_txt') );
	    $res_ctx->load_settings_raw( 'ex_txt', $res_ctx->get_shortcode_att('ex_txt') );
	    $res_ctx->load_settings_raw( 'com_txt', $res_ctx->get_shortcode_att('com_txt') );
        $res_ctx->load_settings_raw( 'com_icon', $res_ctx->get_shortcode_att('com_icon') );

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @modules_height */
				.$unique_block_class .td-module-thumb {
					height: @modules_height;
				}
                /* @image_margin_left */
				.$unique_block_class .td-module-thumb {
					margin-left: -@image_margin_left;
				}
				/* @image_margin_right */
				.$unique_block_class .td-module-thumb {
					margin-right: -@image_margin_right;
				}
				/* @modules_space */
				.$unique_block_class .td_module_wrap {
					margin-bottom: @modules_space;
				}
				.$unique_block_class .td_module_wrap:last-child {
				    margin-bottom: 0;
				}
				/* @block_title_over */
				.$unique_block_class .td-block-title-over {
				    position: absolute;
				    z-index: 10;
				}
				/* @block_title_space */
				.$unique_block_class .td-block-title-over {
				    padding: @block_title_space;
				}
				/* @nextprev_position */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap {
				    @nextprev_position
				}
				/* @nextprev */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap {
				    margin: @nextprev;
				}
				
				
				/* @image_alignment */
				.$unique_block_class .entry-thumb {
					background-position: center @image_alignment;
				}
				/* @image_radius */
				.$unique_block_class .td-module-thumb {
                    border-radius: @image_radius;
				}
				
				
				/* @meta_vert_align_center */
				.$unique_block_class .td-module-meta-info {
					top: 50%;
                    transform: translateY(-50%);
                    -webkit-transform: translateY(-50%);
                    -moz-transform: translateY(-50%);
                    -ms-transform: translateY(-50%);
                    -o-transform: translateY(-50%);
				}
				/* @meta_vert_align_bottom */
				.$unique_block_class .td-module-meta-info {
					top: auto;
                    bottom: 0;
				}
				/* @meta_horiz_align_center */
				.$unique_block_class .td-module-meta-info {
				    margin: 0 auto;
				}
				.$unique_block_class .td-module-meta-info,
				.$unique_block_class .td-next-prev-wrap {
					text-align: center;
				}
				.$unique_block_class .td-image-container {
					margin-left: auto;
                    margin-right: auto;
				}
				/* @meta_horiz_align_right */
				.$unique_block_class .td-module-meta-info {
				    left: auto;
				}
				.$unique_block_class .td-module-meta-info,
				.$unique_block_class .td-next-prev-wrap {
					text-align: right;
				}
				.$unique_block_class .td-ajax-next-page {
                    margin-right: 0;
                }   
                /* @meta_width */
				.$unique_block_class .td-module-meta-info {
					max-width: @meta_width;
				}
				/* @meta_margin */
				.$unique_block_class .td-module-meta-info {
					margin: @meta_margin;
				}
				/* @meta_padding */
				.$unique_block_class .td-module-meta-info {
					padding: @meta_padding;
				}
				/* @art_title */
				.$unique_block_class .entry-title {
					margin: @art_title;
				}
				/* @art_excerpt */
				.$unique_block_class .td-excerpt {
					margin: @art_excerpt;
				}
				/* @modules_category_padding */
				.$unique_block_class .td-post-category {
					margin: @modules_category_padding;
				}
				/* @show_cat */
				.$unique_block_class .td-post-category {
					display: @show_cat;
				}
				/* @show_excerpt */
				.$unique_block_class .td-excerpt {
					display: @show_excerpt;
				}
				/* @hide_author_date */
				.$unique_block_class .td-author-date {
					display: none;
				}
				/* @show_author */
				.$unique_block_class .td-post-author-name {
					display: @show_author;
				}
				/* @show_date */
				.$unique_block_class .td-post-date,
				.$unique_block_class .td-post-author-name span {
					display: @show_date;
				}
				/* @show_review */
				.$unique_block_class .entry-review-stars {
					display: @show_review;
				}
				/* @show_com */
				.$unique_block_class .td-module-comments {
					display: @show_com;
				}
				
				
				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_ajax */
				.$unique_block_class .td-subcat-list a,
				.$unique_block_class .td-subcat-dropdown span,
				.$unique_block_class .td-subcat-dropdown a {
					@f_ajax
				}
				/* @f_more */
				.$unique_block_class .td-load-more-wrap a {
					@f_more
				}
				/* @f_title */
				.$unique_block_class .entry-title {
					@f_title
				}
				/* @f_cat */
				.$unique_block_class .td-post-category {
					@f_cat
				}
				/* @f_meta */
				.$unique_block_class .td-editor-date,
				.$unique_block_class .td-editor-date .td-post-author-name,
				.$unique_block_class .td-module-comments a {
					@f_meta
				}
				/* @f_ex */
				.$unique_block_class .td-excerpt {
					@f_ex
				}
				
				
				/* @overlay */
				.$unique_block_class .td-module-thumb a:after {
				    content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background: @overlay;
				}
				/* @overlay_gradient */
				.$unique_block_class .td-module-thumb a:after {
				    content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					@overlay_gradient
				}
				/* @meta_bg */
				.$unique_block_class .td-module-meta-info {
					background-color: @meta_bg;
				}
				/* @nextprev_icon */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a {
					color: @nextprev_icon;
				}
				/* @nextprev_bg */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a {
					background-color: @nextprev_bg;
				}
				/* @nextprev_icon_h */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover {
					color: @nextprev_icon_h;
				}
				/* @nextprev_bg_h */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover {
					background-color: @nextprev_bg_h;
				}
				/* @cat_bg */
				.$unique_block_class .td-post-category {
					background-color: @cat_bg;
				}
				/* @cat_bg_hover */
				.$unique_block_class .td-post-category:hover {
					background-color: @cat_bg_hover;
				}
				/* @cat_txt */
				.$unique_block_class .td-post-category {
					color: @cat_txt;
				}
				/* @cat_txt_hover */
				.$unique_block_class .td-post-category:hover {
					color: @cat_txt_hover;
				}
				/* @title_txt */
				.$unique_block_class .td-module-title a {
					color: @title_txt;
				}
				/* @title_txt_hover */
				.$unique_block_class .td_module_wrap:hover .td-module-title a {
					color: @title_txt_hover;
				}
				/* @author_txt */
				.$unique_block_class .td-post-author-name a {
					color: @author_txt;
				}
				/* @author_txt_hover */
				.$unique_block_class .td-post-author-name:hover a {
					color: @author_txt_hover;
				}
				/* @date_txt */
				.$unique_block_class .td-post-date,
				.$unique_block_class .td-post-author-name span {
					color: @date_txt;
				}
				/* @ex_txt */
				.$unique_block_class .td-excerpt {
					color: @ex_txt;
				}
				/* @com_bg */
				.$unique_block_class .td-module-comments a {
					background-color: @com_bg;
				}
				.$unique_block_class .td-module-comments a:after {
					border-color: @com_bg transparent transparent transparent;
				}
				/* @com_txt */
				.$unique_block_class .td-module-comments a {
					color: @com_txt;
				}
				/* @com_icon */
				.$unique_block_class .td-module-comments a:before {
					color: @com_icon;
				}
				
			</style>";


	    $td_css_res_compiler = new td_css_res_compiler( $raw_css );
	    $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

		$compiled_css .= $td_css_res_compiler->compile_css();

		return $compiled_css;
    }

    function render($atts, $content = null) {

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        $additional_classes = array();

        // block align
        $block_align = $this->get_att( 'image_margin_right' );
        if( $block_align != '' ) {
            $additional_classes[] = 'td-flb-margin-right';
        } else {
            $additional_classes[] = 'td-flb-margin-left';
        }


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . ' td_flex_block" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

		    //get the js for this block
		    $buffy .= $this->get_block_js();

            // block title wrap
            $buffy .= '<div class="td-block-title-over">';
                $buffy .= '<div class="td-block-title-wrap">';
                    $buffy .= $this->get_block_title(); //get the block title
                    $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
                $buffy .= '</div>';
            $buffy .= '</div>';

            $buffy .= '<div class="td-block-inner-pagination">';
                $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-mc2-wrap">';
                    $buffy .= $this->inner($this->td_query->posts);//inner content of the block
                $buffy .= '</div>';

                //get the ajax pagination for this block
                $buffy .= $this->get_block_pagination();
            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts) {

        $buffy = '';
        $td_block_layout = new td_block_layout();

            if (!empty($posts)) {
                foreach ($posts as $post) {
                    $td_module_flex_2 = new td_module_flex_2($post, $this->get_all_atts());
                    $buffy .= $td_module_flex_2->render($post);
                }
            }
            $buffy .= $td_block_layout->close_all_tags();

        return $buffy;
    }










    function js_tdc_callback_ajax() {
        $buffy = '';

        // add a new composer block - that one has the delete callback
        $buffy .= $this->js_tdc_get_composer_block();

        ob_start();
        ?>
        <script>
            (function () {

                console.log("Hello");

            })();
        </script>
        <?php
        return $buffy . td_util::remove_script_tag(ob_get_clean());
    }
}