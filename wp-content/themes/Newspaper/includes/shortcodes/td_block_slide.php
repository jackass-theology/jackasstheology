<?php

class td_block_slide extends td_block {

    static function cssMedia( $res_ctx ) {

        // content width
        $content_width = $res_ctx->get_shortcode_att('content_width');
        if( $content_width != '' ) {
            $res_ctx->load_settings_raw( 'content_width', $content_width );
        } else {
            $res_ctx->load_settings_raw( 'content_width', '100%' );
        }

        // image alignment
        $res_ctx->load_settings_raw( 'image_alignment', $res_ctx->get_shortcode_att('image_alignment') . '%' );

        // image height
        $image_height = $res_ctx->get_shortcode_att('image_height');
        if( $image_height != '' && is_numeric($image_height) ) {
            $res_ctx->load_settings_raw( 'image_height', $image_height . 'px' );
        }



        // meta info horizontal align
        $meta_info_horiz = $res_ctx->get_shortcode_att('meta_info_horiz');
        if( $meta_info_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_info_horiz_center', 1 );
        }
        if( $meta_info_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_info_horiz_right', 1 );
        }

        // meta info horizontal align
        $meta_info_vert = $res_ctx->get_shortcode_att('meta_info_vert');
        if( $meta_info_vert == 'content-vert-top' ) {
            $res_ctx->load_settings_raw( 'meta_info_vert_top', 1 );
        }
        if( $meta_info_vert == 'content-vert-center' ) {
            $res_ctx->load_settings_raw( 'meta_info_vert_center', 1 );
        }

        // meta info padding
        $meta_padding = $res_ctx->get_shortcode_att('meta_padding');
        $res_ctx->load_settings_raw( 'meta_padding', $meta_padding );
        if( $meta_padding != '' && is_numeric( $meta_padding ) ) {
            $res_ctx->load_settings_raw( 'meta_padding', $meta_padding . 'px' );
        }

        // article title space
        $art_title_space = $res_ctx->get_shortcode_att('art_title_space');
        $res_ctx->load_settings_raw( 'art_title_space', $art_title_space );
        if ( is_numeric( $art_title_space ) ) {
            $res_ctx->load_settings_raw( 'art_title_space', $art_title_space . 'px' );
        }

        // category tag space
        $category_margin = $res_ctx->get_shortcode_att('category_margin');
        $res_ctx->load_settings_raw( 'category_margin', $category_margin );
        if( $category_margin != '' && is_numeric( $category_margin ) ) {
            $res_ctx->load_settings_raw( 'category_margin', $category_margin . 'px' );
        }
        // category tag padding
        $category_padding = $res_ctx->get_shortcode_att('category_padding');
        $res_ctx->load_settings_raw( 'category_padding', $category_padding );
        if( $category_padding != '' && is_numeric( $category_padding ) ) {
            $res_ctx->load_settings_raw( 'category_padding', $category_padding . 'px' );
        }
        //category tag radius
        $category_radius = $res_ctx->get_shortcode_att('category_radius');
        if ( $category_radius != 0 || !empty($category_radius) ) {
            $res_ctx->load_settings_raw( 'category_radius', $category_radius . 'px' );
        }

        // show meta info details
        $show_author = $res_ctx->get_shortcode_att('show_author');
        $show_date = $res_ctx->get_shortcode_att('show_date');
        $show_com = $res_ctx->get_shortcode_att('show_com');
        if( $show_author == 'none' && $show_date == 'none' && $show_com == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date', 1 );
        }
        $res_ctx->load_settings_raw( 'show_cat', $res_ctx->get_shortcode_att('show_cat') );
        $res_ctx->load_settings_raw( 'show_author', $show_author );
        $res_ctx->load_settings_raw( 'show_date', $show_date );
        $res_ctx->load_settings_raw( 'show_com', $show_com );


        // navigation icons size
        $res_ctx->load_settings_raw( 'nav_icon_size', $res_ctx->get_shortcode_att('nav_icon_size') . 'px' );


        // colors
        $res_ctx->load_color_settings( 'color_overlay', 'overlay', 'overlay_gradient', '', '' );
        $res_ctx->load_color_settings( 'color_overlay_h', 'overlay_h', 'overlay_gradient_h', '', '' );
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_shortcode_att('title_color') );
        $res_ctx->load_settings_raw( 'cat_bg', $res_ctx->get_shortcode_att('cat_bg') );
        $res_ctx->load_settings_raw( 'cat_txt', $res_ctx->get_shortcode_att('cat_txt') );
        $res_ctx->load_settings_raw( 'cat_bg_hover', $res_ctx->get_shortcode_att('cat_bg_hover') );
        $res_ctx->load_settings_raw( 'cat_txt_hover', $res_ctx->get_shortcode_att('cat_txt_hover') );
        $res_ctx->load_settings_raw( 'author_txt', $res_ctx->get_shortcode_att('author_txt') );
        $res_ctx->load_settings_raw( 'author_txt_hover', $res_ctx->get_shortcode_att('author_txt_hover') );
        $res_ctx->load_settings_raw( 'date_txt', $res_ctx->get_shortcode_att('date_txt') );
        $res_ctx->load_settings_raw( 'comm_txt', $res_ctx->get_shortcode_att('comm_txt') );
        $res_ctx->load_settings_raw( 'review_stars', $res_ctx->get_shortcode_att('review_stars') );
        $res_ctx->load_settings_raw( 'nav_icons_color', $res_ctx->get_shortcode_att('nav_icons_color') );


        // fonts
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );

        // module slide fonts
        $res_ctx->load_font_settings( 'msf_title' );
        $res_ctx->load_font_settings( 'msf_cat' );
        $res_ctx->load_font_settings( 'msf_meta' );

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @content_width */
                .$unique_block_class .td-slide-meta {
                    max-width: calc(@content_width + 44px);
                }
                @media (max-width: 767px) {
                    .$unique_block_class .td-slide-meta {
                        max-width: calc(@content_width + 24px);
                    }
                }
                
				/* @image_alignment */
				.$unique_block_class .entry-thumb {
				    background-position: center @image_alignment;
				}
				/* @image_height */
				.$unique_block_class .td_block_inner,
				.$unique_block_class .td-theme-slider,
				.$unique_block_class .td_module_slide {
				    height: @image_height !important;
				}
				
				/* @meta_info_horiz_center */
				.$unique_block_class .td-slide-meta {
					text-align: center;
				}
				/* @meta_info_horiz_right */
				.$unique_block_class .td-slide-meta {
					text-align: right;
				}
			
				/* @meta_info_vert_top */
				.$unique_block_class .td-slide-meta {
					top: 0;
					bottom: auto;
				}
				/* @meta_info_vert_center */
				.$unique_block_class .td-slide-meta {
					top: 50%;
					bottom: auto;
					transform: translateY(-50%);
				}
				/* @meta_info_vert_bottom */
				.$unique_block_class .td-slide-meta {
					bottom: 0;
				}
				
				/* @meta_padding */
				.$unique_block_class .td-slide-meta {
					padding: @meta_padding;
				}
				
				/* @art_title_space */
				.$unique_block_class .entry-title {
					margin: @art_title_space;
				}
				
				/* @category_margin */
				.$unique_block_class .slide-meta-cat a {
					margin: @category_margin;
				}
				/* @category_padding */
				.$unique_block_class .slide-meta-cat a {
					padding: @category_padding;
				}
				/* @category_radius */
				.$unique_block_class .slide-meta-cat a {
					border-radius: @category_radius;
				}
				
				/* @show_cat */
				.$unique_block_class .slide-meta-cat {
					display: @show_cat;
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
				/* @show_com */
				.$unique_block_class .td-post-comments {
					display: @show_com;
				}
				/* @hide_author_date */
				.$unique_block_class .td-module-meta-info {
					display: none;
				}
				
				
				/* @nav_icon_size */
				.$unique_block_class .td-slide-nav {
				    font-size: @nav_icon_size;
				}
				
				
				/* @overlay */
				.$unique_block_class .td-image-gradient:before {
					background: @overlay;
				}
				/* @overlay_gradient */
				.$unique_block_class .td-image-gradient:before {
					@overlay_gradient
				}
				/* @overlay_h */
				.$unique_block_class .td-image-gradient:hover:before {
					background: @overlay_h;
				}
				/* @overlay_gradient_h */
				.$unique_block_class .td-image-gradient:hover:before {
					@overlay_gradient_h
				}
				
				/* @title_color */
				.$unique_block_class .td-module-title a {
					color: @title_color;
				}
				
				/* @cat_bg */
				.$unique_block_class span.slide-meta-cat a {
					background-color: @cat_bg;
				}
				/* @cat_bg_hover */
				.$unique_block_class .td_module_slide:hover span.slide-meta-cat a {
					background-color: @cat_bg_hover;
				}
				/* @cat_txt */
				.$unique_block_class span.slide-meta-cat a {
					color: @cat_txt;
				}
				/* @cat_txt_hover */
				.$unique_block_class .td_module_slide:hover span.slide-meta-cat a {
					color: @cat_txt_hover;
				}
				
				
				/* @author_txt */
				.$unique_block_class .td-post-author-name a {
					color: @author_txt;
				}
				/* @author_txt_hover */
				.$unique_block_class .td_module_slide:hover .td-post-author-name a {
					color: @author_txt_hover;
				}
				/* @date_txt */
				.$unique_block_class span.td-post-date,
				.$unique_block_class .td-post-author-name span {
					color: @date_txt;
				}
				/* @comm_txt */
				.$unique_block_class .td-post-comments i,
				.$unique_block_class .td-post-comments a {
				    color: @comm_txt;
				}
				/* @review_stars */
				.$unique_block_class .entry-review-stars {
				    color: @review_stars;
				}
				
				/* @nav_icons_color */
				.$unique_block_class .td-slide-nav {
				    color: @nav_icons_color;
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
				/* @msf_title */
				.$unique_block_class .td_module_slide .entry-title {
					@msf_title
				}
				/* @msf_cat */
				.$unique_block_class .td_module_slide .slide-meta-cat a {
					@msf_cat
				}
				/* @msf_meta */
				.$unique_block_class .td_module_slide .td-module-meta-info,
				.$unique_block_class .td_module_slide .td-module-comments a {
					@msf_meta
				}
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();

        return $compiled_css;
    }


    function render($atts, $content = null){
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)


        extract(shortcode_atts(
            array(
                'autoplay' => ''
            ),$atts));

        $buffy = ''; //output buffer





        if ($this->td_query->have_posts() and $this->td_query->found_posts > 1 ) {

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

                $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
                    $buffy .= $this->inner($this->td_query->posts, '' , $autoplay);
                $buffy .= '</div>';
            $buffy .= '</div> <!-- ./block1 -->';

        } else if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
	        $buffy .= '<div class="td_block_wrap tdc-no-posts"><div class="td_block_inner"></div></div>';
        }
        return $buffy;
    }


    /**
     * @param $posts
     * @param string $td_column_number - get the column number
     * @param string $autoplay - not use via ajax
     * @param bool $is_ajax - if true the script will return the js inline, if not, it will use the td_js_buffer class
     * @return string
     */
    function inner($posts, $td_column_number = '', $autoplay = '', $is_ajax = false) {
        $buffy = '';

        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }

        $td_post_count = 0; // the number of posts rendered

        $td_unique_id_slide = td_global::td_generate_unique_id();

        $prev_icon = $this->get_att('prev_tdicon');
        if( $prev_icon == '' ) {
            $prev_icon = 'td-icon-left';
        }
        $next_icon = $this->get_att('next_tdicon');
        if( $next_icon == '' ) {
            $next_icon = 'td-icon-right';
        }

        //@generic class for sliders : td-theme-slider
        $buffy .= '<div id="' . $td_unique_id_slide . '" class="td-theme-slider iosSlider-col-' . $td_column_number . ' td_mod_wrap">';
            $buffy .= '<div class="td-slider ">';
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                        //$buffy .= td_modules::mod_slide_render($post, $td_column_number, $td_post_count);
                        $td_module_slide = new td_module_slide($post, $this->get_all_atts());
                        $buffy .= $td_module_slide->render($td_column_number, $td_post_count, $td_unique_id_slide);
                        $td_post_count++;

	                    // Show only the first frame in tagDiv composer
	                    if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
		                    break;
	                    }
                    }
                }
            $buffy .= '</div>'; //close slider

            $buffy .= '<i class = "td-slide-nav ' . $prev_icon . ' prevButton"></i>';
            $buffy .= '<i class = "td-slide-nav ' . $next_icon . ' nextButton"></i>';

        $buffy .= '</div>'; //close ios

	    // Suppress any iosSlider in tagDiv composer
	    if (td_util::tdc_is_live_editor_iframe() or td_util::tdc_is_live_editor_ajax()) {
		    return $buffy;
	    }

        if (!empty($autoplay)) {
            $autoplay_string =  '
            autoSlide: true,
            autoSlideTimer: ' . $autoplay * 1000 . ',
            ';
        } else {
            $autoplay_string = '';
        }

        //add resize events
        //$add_js_resize = '';
        //if($td_column_number > 1) {
            $add_js_resize = ',
                //onSliderLoaded : td_resize_normal_slide,
                //onSliderResize : td_resize_normal_slide_and_update';
        //}


        $slide_js = '
jQuery(document).ready(function() {
    jQuery("#' . $td_unique_id_slide . '").iosSlider({
        snapToChildren: true,
        desktopClickDrag: true,
        keyboardControls: false,
        responsiveSlideContainer: true,
        responsiveSlides: true,
        ' . $autoplay_string. '

        infiniteSlider: true,
        navPrevSelector: jQuery("#' . $td_unique_id_slide . ' .prevButton"),
        navNextSelector: jQuery("#' . $td_unique_id_slide . ' .nextButton")
        ' . $add_js_resize . '
    });
});
    ';

        if ($is_ajax) {
            $buffy .= '<script>' . $slide_js . '</script>';
        } else {
            td_js_buffer::add_to_footer($slide_js);
        }

        return $buffy;
    }
}