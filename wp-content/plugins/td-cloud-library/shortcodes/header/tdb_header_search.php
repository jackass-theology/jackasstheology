<?php

/**
 * Class td_single_date
 */

class tdb_header_search extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
                
                /* @icon_size */
                .$unique_block_class #tdb-search-button i {
                    font-size: @icon_size;
                }
                /* @icon_padding */
                .$unique_block_class #tdb-search-button i {
                    width: @icon_padding;
					height: @icon_padding;
					line-height:  @icon_padding;
                }
                /* @inline */
                .$unique_block_class {
                    display: inline-block;
                }
                /* @float_block */
                .$unique_block_class {
                    float: right;
                }
                
                /* @show_form */
                .$unique_block_class.tdc-element-selected .tdb-drop-down-search {
                    visibility: visible;
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                    -webkit-transform: translate3d(0, 0, 0);
                    -moz-transform: translate3d(0, 0, 0);
                }
                .$unique_block_class.tdc-element-selected #tdb-search-button:after {
                    visibility: visible;
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                    -webkit-transform: translate3d(0, 0, 0);
                    -moz-transform: translate3d(0, 0, 0);
                }
                /* @form_width */
                .$unique_block_class .tdb-drop-down-search {
                    width: @form_width;
                }
                /* @form_padding */
                .$unique_block_class .tdb-search-form {
                    padding: @form_padding;
                }
                /* @form_border */
                .$unique_block_class .tdb-search-form {
                    border-width: @form_border;
                }
                /* @form_align_horiz_center */
                .$unique_block_class .tdb-block-inner .tdb-drop-down-search {
                    left: 50%;
                    transform: translate3d(-50%, 20px, 0);
                    -webkit-transform: translate3d(-50%, 20px, 0);
                    -moz-transform: translate3d(-50%, 20px, 0);
                }
                .$unique_block_class .tdb-block-inner .tdb-drop-down-search-open,
                .$unique_block_class.tdc-element-selected .tdb-drop-down-search {
                    transform: translate3d(-50%, 0, 0);
                    -webkit-transform: translate3d(-50%, 0, 0);
                    -moz-transform: translate3d(-50%, 0, 0);
                }
                /* @form_align_horiz_right */
                .$unique_block_class .tdb-drop-down-search {
                    left: auto;
                    right: 0;
                }
                
                /* @placeholder_travel */
                .$unique_block_class #tdb-head-search-input:focus + .tdb-head-search-placeholder {
                    top: -@placeholder_travel;
                    transform: translateY(0);
                }
                /* @input_padding */
                .$unique_block_class #tdb-head-search-input,
                .$unique_block_class .tdb-head-search-placeholder {
                    padding: @input_padding;
                }
                /* @input_border */
                .$unique_block_class .tdb-search-form-inner:after {
                    border-width: @input_border;
                }
                /* @input_radius */
                .$unique_block_class .tdb-search-form-inner {
                    border-radius: @input_radius;
                }
                .$unique_block_class .tdb-search-form-inner:after {
                    border-radius: @input_radius;
                }
                .$unique_block_class #tdb-head-search-input {   
                    border-top-left-radius: @input_radius;
                    border-bottom-left-radius: @input_radius;
                }
                
                /* @btn_icon_size */
                .$unique_block_class #tdb-head-search-button i {
                    font-size: @btn_icon_size;
                }
                /* @btn_icon_space_right */
                .$unique_block_class #tdb-head-search-button i {
                    margin-right: @btn_icon_space_right;
                }
                /* @btn_icon_space_left */
                .$unique_block_class #tdb-head-search-button i {
                    margin-left: @btn_icon_space_left;
                }
                /* @btn_icon_align */
                .$unique_block_class #tdb-head-search-button i {
                    top: @btn_icon_align;
                }
                
                /* @btn_margin */
                .$unique_block_class #tdb-head-search-button {
                    margin: @btn_margin;
                }
                /* @btn_padding */
                .$unique_block_class #tdb-head-search-button {
                    padding: @btn_padding;
                }
                /* @btn_border */
                .$unique_block_class #tdb-head-search-button {
                    border-width: @btn_border;
                    border-style: solid;
                    border-color: #000;
                }
                /* @btn_radius */
                .$unique_block_class #tdb-head-search-button {
                    border-radius: @btn_radius;
                }
                
                /* @results_padding */
                .$unique_block_class .tdb-aj-search-results {
                    padding: @results_padding;
                }
                /* @results_border */
                .$unique_block_class .tdb-aj-search-results {
                    border-width: @results_border;
                }
                /* @results_msg_padding */
                .$unique_block_class .result-msg {
                    padding: @results_msg_padding;
                }
                /* @results_msg_align_horiz_center */
                .$unique_block_class .result-msg {
                    text-align: center;
                }
                /* @results_msg_align_horiz_right */
                .$unique_block_class .result-msg {
                    text-align: right;
                }
                
                
                /* @icon_color */
                .$unique_block_class #tdb-search-button {
                    color: @icon_color;
                }
                /* @icon_color_h */
                .$unique_block_class #tdb-search-button:hover {
                    text-color: @icon_color_h;
                }
                
                /* @form_bg */
                .$unique_block_class .tdb-search-form:before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: @form_bg;
                }
                /* @form_border_color */
                .$unique_block_class .tdb-search-form  {
                    border-color: @form_border_color;
                }
                /* @arrow_color */
                .$unique_block_class #tdb-search-button:after {
                    border-bottom-color: @arrow_color;
                }
                /* @form_shadow */
                .$unique_block_class .tdb-drop-down-search {
                    box-shadow: @form_shadow;
                }
                
                /* @input_color */
                .$unique_block_class #tdb-head-search-input {
                    color: @input_color;
                }
                /* @placeholder_color */
                .$unique_block_class .tdb-head-search-placeholder {
                    color: @placeholder_color;
                }
                /* @placeholder_opacity */
                .$unique_block_class #tdb-head-search-input:focus + .tdb-head-search-placeholder {
                    opacity: @placeholder_opacity;
                }
                /* @input_bg */
                .$unique_block_class .tdb-search-form-inner {
                    background-color: @input_bg;
                }
                /* @input_border_color */
                .$unique_block_class .tdb-search-form-inner:after {
                    border-color: @input_border_color;
                }
                /* @input_shadow */
                .$unique_block_class .tdb-search-form-inner {
                    box-shadow: @input_shadow;
                }
                
                /* @btn_color */
                .$unique_block_class #tdb-head-search-button {
                    color: @btn_color;
                }
                /* @btn_color_h */
                .$unique_block_class #tdb-head-search-button:hover {
                    color: @btn_color_h;
                }
                /* @btn_icon_color */
                .$unique_block_class #tdb-head-search-button i {
                    color: @btn_icon_color;
                }
                /* @btn_icon_color_h */
                .$unique_block_class #tdb-head-search-button:hover i {
                    color: @btn_icon_color_h;
                }
                /* @btn_bg */
                .$unique_block_class #tdb-head-search-button {
                    background-color: @btn_bg;
                }
                /* @btn_bg_gradient */
                .$unique_block_class #tdb-head-search-button {
                    @btn_bg_gradient
                }
                /* @btn_bg_h */
                .$unique_block_class #tdb-head-search-button:hover {
                    background-color: @btn_bg_h;
                }
                /* @btn_bg_h_gradient */
                .$unique_block_class #tdb-head-search-button:hover {
                    @btn_bg_h_gradient
                }
                /* @btn_border_color */
                .$unique_block_class #tdb-head-search-button {
                    border-color: @btn_border_color;
                }
                /* @btn_border_color_h */
                .$unique_block_class #tdb-head-search-button:hover {
                    border-color: @btn_border_color_h;
                }
                /* @btn_shadow */
                .$unique_block_class #tdb-head-search-button {
                    box-shadow: @btn_shadow;
                }
                
                /* @results_bg */
                .$unique_block_class .tdb-aj-search-results {
                    background-color: @results_bg;
                }
                /* @results_border_color */
                .$unique_block_class .tdb-aj-search-results {
                    border-color: @results_border_color;
                }
                /* @results_msg_color */
                .$unique_block_class .result-msg,
                .$unique_block_class .result-msg a{
                    color: @results_msg_color;
                }
                /* @results_msg_color_h */
                .$unique_block_class .result-msg a:hover {
                    color: @results_msg_color_h;
                }
                /* @results_msg_bg */
                .$unique_block_class .result-msg {
                    background-color: @results_msg_bg;
                }
                
                
                
                /* @f_input */
                .$unique_block_class #tdb-head-search-input {
                    @f_input
                }
                /* @f_placeholder */
                .$unique_block_class .tdb-head-search-placeholder {
                    @f_placeholder
                }
                /* @f_btn */
                .$unique_block_class #tdb-head-search-button {
                    @f_btn
                }
                
                
                
                /* @m_padding */
				.$unique_block_class .td-module-container {
					padding: @m_padding;
				}
				/* @all_modules_space */
				.$unique_block_class .td_module_wrap {
					padding-bottom: @all_modules_space;
					margin-bottom: @all_modules_space;
				}
				.$unique_block_class .td-module-container:before {
					bottom: -@all_modules_space;
				}
				/* @modules_divider */
				.$unique_block_class .td-module-container:before {
					border-width: 0 0 1px 0;
					border-style: @modules_divider;
					border-color: #eaeaea;
				}
				/* @modules_divider_color */
				.$unique_block_class .td-module-container:before {
					border-color: @modules_divider_color;
				}
				
				/* @image_alignment */
				.$unique_block_class .entry-thumb {
					background-position: center @image_alignment;
				}
				/* @image_height */
				.$unique_block_class .td-image-wrap {
					padding-bottom: @image_height;
				}
				/* @image_width */
				.$unique_block_class .td-image-container {
				 	flex: 0 0 @image_width;
				 	width: @image_width;
			    }
				.ie10 .$unique_block_class .td-image-container,
				.ie11 .$unique_block_class .td-image-container {
				 	flex: 0 0 auto;
			    }
				/* @no_float */
				.$unique_block_class .td-module-container {
					flex-direction: column;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 0;
                }
                .ie10 .$unique_block_class .td-module-meta-info,
				.ie11 .$unique_block_class .td-module-meta-info {
				 	flex: auto;
			    }
			    /* @float_left */
				.$unique_block_class .td-module-container {
					flex-direction: row;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 0;
                }
                .ie10 .$unique_block_class .td-module-meta-info,
				.ie11 .$unique_block_class .td-module-meta-info {
				 	flex: 1;
			    }
				/* @float_right */
				.$unique_block_class .td-module-container {
					flex-direction: row;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 1;
                }
                .$unique_block_class .td-module-meta-info {
                	flex: 1;
                }
                /* @hide_desktop */
                .$unique_block_class .td-image-container {
                	display: none;
                }
                .$unique_block_class .entry-thumb {
                	background-image: none !important;
                }
				/* @hide */
				.$unique_block_class .td-image-container {
					display: none;
				}
				/* @image_radius */
				.$unique_block_class .entry-thumb {
					border-radius: @image_radius;
				}
				
				/* @meta_info_align */
				.$unique_block_class .td-module-container {
					align-items: @meta_info_align;
				}
				/* @meta_info_align_top */
				.$unique_block_class .td-image-container {
					order: 1;
				}
				/* @align_category_top */
				.$unique_block_class .td-category-pos-image .td-post-category {
					top: 0;
					bottom: auto;
				}
				/* @align_category_bottom */
				.$unique_block_class .td-category-pos-image .td-post-category {
					top: auto;
				 	bottom: 0;
			    }
			    /* @meta_horiz_align_center */
				.$unique_block_class .td-module-meta-info,
				.$unique_block_class .td-next-prev-wrap {
					text-align: center;
				}
				.$unique_block_class .td-image-container {
					margin-left: auto;
                    margin-right: auto;
				}
				.$unique_block_class .td-category-pos-image .td-post-category {
					left: 50%;
					transform: translateX(-50%);
					-webkit-transform: translateX(-50%);
				}
				/* @meta_horiz_align_right */
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
				/* @excerpt_col */
				.$unique_block_class .td-excerpt {
					column-count: @excerpt_col;
				}
				/* @excerpt_gap */
				.$unique_block_class .td-excerpt {
					column-gap: @excerpt_gap;
				}
				
				/* @meta_info_border_size */
				.$unique_block_class .td-module-meta-info {
					border-width: @meta_info_border_size;
				}
				/* @meta_info_border_style */
				.$unique_block_class .td-module-meta-info {
					border-style: @meta_info_border_style;
				}
				/* @meta_info_border_color */
				.$unique_block_class .td-module-meta-info {
					border-color: @meta_info_border_color;
				}
				
				/* @modules_category_margin */
				.$unique_block_class .td-post-category {
					margin: @modules_category_margin;
				}
				/* @modules_category_padding */
				.$unique_block_class .td-post-category {
					padding: @modules_category_padding;
				}
				/* @modules_category_radius */
				.$unique_block_class .td-post-category {
					border-radius: @modules_category_radius;
				}
                
                /* @show_cat */
				.$unique_block_class .td-post-category {
					display: @show_cat;
				}
				/* @show_excerpt */
				.$unique_block_class .td-excerpt {
					display: @show_excerpt;
				}
				/* @show_btn */
				.$unique_block_class .td-read-more {
					display: @show_btn;
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
				
				/* @author_photo_size */
				.$unique_block_class .tdb-author-photo .avatar {
				    width: @author_photo_size;
				    height: @author_photo_size;
				}
				/* @author_photo_space */
				.$unique_block_class .tdb-author-photo .avatar {
				    margin-right: @author_photo_space;
				}
				/* @author_photo_radius */
				.$unique_block_class .tdb-author-photo .avatar {
				    border-radius: @author_photo_radius;
				}
				
				/* @mm_bg */
				.$unique_block_class {
					background-color: @mm_bg;
				}
				/* @mm_shadow */
				.$unique_block_class {
					box-shadow: @mm_shadow;
				}
				
				/* @mm_subcats_bg */
				.$unique_block_class .block-mega-child-cats {
					background-color: @mm_subcats_bg;
				}
				/* @mm_subcats_border_color */
				.$unique_block_class .block-mega-child-cats:after {
					border-color: @mm_subcats_border_color;
				}
				
				/* @mm_elem_color */
				.$unique_block_class .block-mega-child-cats a {
					color: @mm_elem_color;
				}
				/* @mm_elem_bg */
				.$unique_block_class .block-mega-child-cats a {
					background-color: @mm_elem_bg;
				}
				/* @mm_elem_border_color */
				.$unique_block_class .block-mega-child-cats a {
					border-color: @mm_elem_border_color;
				}
				/* @mm_elem_color_a */
				.$unique_block_class .block-mega-child-cats .cur-sub-cat {
					color: @mm_elem_color_a;
				}
				/* @mm_elem_bg_a */
				.$unique_block_class .block-mega-child-cats .cur-sub-cat {
					background-color: @mm_elem_bg_a;
				}
				/* @mm_elem_border_color_a */
				.$unique_block_class .block-mega-child-cats .cur-sub-cat {
					border-color: @mm_elem_border_color_a;
				}
                
                
				/* @m_bg */
				.$unique_block_class .td-module-container {
					background-color: @m_bg;
				}
				/* @shadow_module */
				.$unique_block_class .td-module-container {
				    box-shadow: @shadow_module;
				}
				/* @shadow_meta */
				.$unique_block_class .td-module-meta-info {
				    box-shadow: @shadow_meta;
				}
				/* @meta_bg */
				.$unique_block_class .td-module-meta-info {
					background-color: @meta_bg;
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
				/* @cat_bg */
				.$unique_block_class .td-post-category {
					background-color: @cat_bg;
				}
				/* @cat_bg_hover */
				.$unique_block_class .td-post-category:hover {
					background-color: @cat_bg_hover !important;
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
				.td-theme-wrap .$unique_block_class .td_module_wrap:hover .td-module-title a,
				.$unique_block_class .td-aj-cur-element .entry-title a {
					color: @title_txt_hover !important;
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
				/* @rev_txt */
				.$unique_block_class .entry-review-stars {
					color: @rev_txt;
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
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx )
    {

        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        $res_ctx->load_settings_raw('icon_size', $icon_size . 'px');
        // icon padding
        $res_ctx->load_settings_raw('icon_padding', $icon_size * $res_ctx->get_shortcode_att('icon_padding') . 'px');
        // display inline
        $res_ctx->load_settings_raw( 'inline', $res_ctx->get_shortcode_att('inline') );
        // float right
        $res_ctx->load_settings_raw( 'float_block', $res_ctx->get_shortcode_att('float_block') );



        /*-- SEARCH FORM -- */
        // show form
        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
            $res_ctx->load_settings_raw('show_form', $res_ctx->get_shortcode_att('show_form'));
        }
        // form width
        $form_width = $res_ctx->get_shortcode_att('form_width');
        $res_ctx->load_settings_raw('form_width', $form_width);
        if ($form_width != '' && is_numeric($form_width)) {
            $res_ctx->load_settings_raw('form_width', $form_width . 'px');
        }
        // form padding
        $form_padding = $res_ctx->get_shortcode_att('form_padding');
        $res_ctx->load_settings_raw('form_padding', $form_padding);
        if ($form_padding != '' && is_numeric($form_padding)) {
            $res_ctx->load_settings_raw('form_padding', $form_padding . 'px');
        }
        // form border size
        $form_border = $res_ctx->get_shortcode_att('form_border');
        $res_ctx->load_settings_raw('form_border', $form_border);
        if ($form_border != '' && is_numeric($form_border)) {
            $res_ctx->load_settings_raw('form_border', $form_border . 'px');
        }
        // form align
        $form_align = $res_ctx->get_shortcode_att('form_align');
        if( $form_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw('form_align_horiz_center', 1);
        } else if( $form_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw('form_align_horiz_right', 1);
        }

        // placeholder travel
        $res_ctx->load_settings_raw('placeholder_travel', $res_ctx->get_shortcode_att('placeholder_travel') + 50 . '%');
        // input padding
        $input_padding = $res_ctx->get_shortcode_att('input_padding');
        $res_ctx->load_settings_raw('input_padding', $input_padding);
        if ($input_padding != '' && is_numeric($input_padding)) {
            $res_ctx->load_settings_raw('input_padding', $input_padding . 'px');
        }
        // input border size
        $input_border = $res_ctx->get_shortcode_att('input_border');
        $res_ctx->load_settings_raw('input_border', $input_border);
        if ($input_border != '' && is_numeric($input_border)) {
            $res_ctx->load_settings_raw('input_border', $input_border . 'px');
        }
        // input border radius
        $input_radius = $res_ctx->get_shortcode_att('input_radius');
        $res_ctx->load_settings_raw('input_radius', $input_radius);
        if ($input_radius != '' && is_numeric($input_radius)) {
            $res_ctx->load_settings_raw('input_radius', $input_radius . 'px');
        }

        // button icon size
        $btn_icon_size = $res_ctx->get_shortcode_att('btn_icon_size');
        $res_ctx->load_settings_raw('btn_icon_size', $btn_icon_size);
        if ($btn_icon_size != '' && is_numeric($btn_icon_size)) {
            $res_ctx->load_settings_raw('btn_icon_size', $btn_icon_size . 'px');
        }
        // button icon space
        $btn_icon_pos = $res_ctx->get_shortcode_att('btn_icon_pos');
        $btn_icon_space = $res_ctx->get_shortcode_att('btn_icon_space');
        if ($btn_icon_space != '' && is_numeric($btn_icon_space)) {
            if( $btn_icon_pos == '' ) {
                $res_ctx->load_settings_raw('btn_icon_space_right', $btn_icon_space . 'px');
            } else {
                $res_ctx->load_settings_raw('btn_icon_space_left', $btn_icon_space . 'px');
            }
        }
        // button icon align
        $res_ctx->load_settings_raw('btn_icon_align', $res_ctx->get_shortcode_att('btn_icon_align') . 'px');

        // button margin
        $btn_margin = $res_ctx->get_shortcode_att('btn_margin');
        $res_ctx->load_settings_raw('btn_margin', $btn_margin);
        if ($btn_margin != '' && is_numeric($btn_margin)) {
            $res_ctx->load_settings_raw('btn_margin', $btn_margin . 'px');
        }
        // button padding
        $btn_padding = $res_ctx->get_shortcode_att('btn_padding');
        $res_ctx->load_settings_raw('btn_padding', $btn_padding);
        if ($btn_padding != '' && is_numeric($btn_padding)) {
            $res_ctx->load_settings_raw('btn_padding', $btn_padding . 'px');
        }
        // button border size
        $btn_border = $res_ctx->get_shortcode_att('btn_border');
        $res_ctx->load_settings_raw('btn_border', $btn_border);
        if ($btn_border != '' && is_numeric($btn_border)) {
            $res_ctx->load_settings_raw('btn_border', $btn_border . 'px');
        }
        // button border radius
        $btn_radius = $res_ctx->get_shortcode_att('btn_radius');
        $res_ctx->load_settings_raw('btn_radius', $btn_radius);
        if ($btn_radius != '' && is_numeric($btn_radius)) {
            $res_ctx->load_settings_raw('btn_radius', $btn_radius . 'px');
        }



        /*-- SEARCH RESULTS BOX -- */
        // results padding
        $results_padding = $res_ctx->get_shortcode_att('results_padding');
        $res_ctx->load_settings_raw('results_padding', $results_padding);
        if ($results_padding != '' && is_numeric($results_padding)) {
            $res_ctx->load_settings_raw('results_padding', $results_padding . 'px');
        }
        // results border size
        $results_border = $res_ctx->get_shortcode_att('results_border');
        $res_ctx->load_settings_raw('results_border', $results_border);
        if ($results_border != '' && is_numeric($results_border)) {
            $res_ctx->load_settings_raw('results_border', $results_border . 'px');
        }
        // results message padding
        $results_msg_padding = $res_ctx->get_shortcode_att('results_msg_padding');
        $res_ctx->load_settings_raw('results_msg_padding', $results_msg_padding);
        if ($results_msg_padding != '' && is_numeric($results_msg_padding)) {
            $res_ctx->load_settings_raw('results_msg_padding', $results_msg_padding . 'px');
        }
        // results message align
        $results_msg_align = $res_ctx->get_shortcode_att('results_msg_align');
        if( $results_msg_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw('results_msg_align_horiz_center', 1);
        } else if( $results_msg_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw('results_msg_align_horiz_right', 1);
        }



        /*-- SEARCH RESULTS MODULE -- */
        // modules padding
        $m_padding = $res_ctx->get_shortcode_att('m_padding');
        $res_ctx->load_settings_raw( 'm_padding', $m_padding );
        if ( is_numeric( $m_padding ) ) {
            $res_ctx->load_settings_raw( 'm_padding', $m_padding . 'px' );
        }
        // modules space
        $modules_space = $res_ctx->get_shortcode_att('all_modules_space');
        $res_ctx->load_settings_raw( 'all_modules_space', $modules_space );
        if ( $modules_space == '' ) {
            $res_ctx->load_settings_raw( 'all_modules_space', '18px');
        } else if ( is_numeric( $modules_space ) ) {
            $res_ctx->load_settings_raw( 'all_modules_space', $modules_space / 2 .'px' );
        }

        // modules divider
        $res_ctx->load_settings_raw( 'modules_divider', $res_ctx->get_shortcode_att('modules_divider') );
        // modules divider color
        $res_ctx->load_settings_raw( 'modules_divider_color', $res_ctx->get_shortcode_att('modules_divider_color') );

        //image alignment
        $res_ctx->load_settings_raw( 'image_alignment', $res_ctx->get_shortcode_att('image_alignment') . '%' );
        // image_height
        $image_height = $res_ctx->get_shortcode_att('image_height');
        if ( is_numeric( $image_height ) ) {
            $res_ctx->load_settings_raw( 'image_height', $image_height . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height', $image_height );
        }
        // image_width
        $image_width = $res_ctx->get_shortcode_att('image_width');
        if ( is_numeric( $image_width ) ) {
            $res_ctx->load_settings_raw( 'image_width', $image_width . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_width', $image_width );
        }
        // image_floated
        $image_floated = $res_ctx->get_shortcode_att('image_floated');
        if ( $image_floated == '' ||  $image_floated == 'no_float' ) {
            $image_floated = 'no_float';
            $res_ctx->load_settings_raw( 'no_float',  1 );
        }
        if ( $image_floated == 'float_left' ) {
            $res_ctx->load_settings_raw( 'float_left',  1 );
        }
        if ( $image_floated == 'float_right' ) {
            $res_ctx->load_settings_raw( 'float_right',  1 );
        }
        if ( $image_floated == 'hidden' ) {
            if ( $res_ctx->is( 'all' ) && !$res_ctx->is_responsive_att( 'image_floated' ) ) {
                $res_ctx->load_settings_raw( 'hide_desktop',  1 );
            } else {
                $res_ctx->load_settings_raw( 'hide',  1 );
            }
        }
        // image radius
        $image_radius = $res_ctx->get_shortcode_att('image_radius');
        $res_ctx->load_settings_raw( 'image_radius', $image_radius );
        if ( is_numeric( $image_radius ) ) {
            $res_ctx->load_settings_raw( 'image_radius', $image_radius . 'px' );
        }

        // meta info align
        $meta_info_align = $res_ctx->get_shortcode_att('meta_info_align');
        $res_ctx->load_settings_raw( 'meta_info_align', $meta_info_align );
        // meta info align to fix top when no float is selected
        if ( $meta_info_align == 'initial' && $image_floated == 'no_float' ) {
            $res_ctx->load_settings_raw( 'meta_info_align_top',  1 );
        }
        // meta info align top/bottom - align category
        if ( $meta_info_align == 'initial' ) {
            $res_ctx->load_settings_raw( 'align_category_top',  1 );
        }
        if ( $meta_info_align == 'flex-end' ) {
            $res_ctx->load_settings_raw( 'align_category_bottom',  1 );
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
        if ( is_numeric( $meta_padding ) ) {
            $res_ctx->load_settings_raw( 'meta_padding', $meta_padding . 'px' );
        }

        // article title space
        $art_title = $res_ctx->get_shortcode_att('art_title');
        $res_ctx->load_settings_raw( 'art_title', $art_title );
        if ( is_numeric( $art_title ) ) {
            $res_ctx->load_settings_raw( 'art_title', $art_title . 'px' );
        }

        // article excerpt space
        $art_excerpt = $res_ctx->get_shortcode_att('art_excerpt');
        $res_ctx->load_settings_raw( 'art_excerpt', $art_excerpt );
        if ( is_numeric( $art_excerpt ) ) {
            $res_ctx->load_settings_raw( 'art_excerpt', $art_excerpt . 'px' );
        }
        // article excerpt columns
        $excerpt_col = $res_ctx->get_shortcode_att('excerpt_col');
        $res_ctx->load_settings_raw( 'excerpt_col', $excerpt_col );
        if ( $excerpt_col == '' ) {
            $res_ctx->load_settings_raw( 'excerpt_col', '1' );
        }
        // article excerpt space
        $excerpt_gap = $res_ctx->get_shortcode_att('excerpt_gap');
        $res_ctx->load_settings_raw( 'excerpt_gap', $excerpt_gap );
        if( $excerpt_gap != '' ) {
            if ( is_numeric( $excerpt_gap ) ) {
                $res_ctx->load_settings_raw( 'excerpt_gap', $excerpt_gap . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'excerpt_gap', '48px' );
        }

        // meta_info_border_size
        $meta_info_border_size = $res_ctx->get_shortcode_att('meta_info_border_size');
        $res_ctx->load_settings_raw( 'meta_info_border_size', $meta_info_border_size );
        if ( is_numeric( $meta_info_border_size ) ) {
            $res_ctx->load_settings_raw( 'meta_info_border_size', $meta_info_border_size . 'px' );
        }
        // meta info border style
        $res_ctx->load_settings_raw( 'meta_info_border_style', $res_ctx->get_shortcode_att('meta_info_border_style') );
        // meta info border color
        $res_ctx->load_settings_raw( 'meta_info_border_color', $res_ctx->get_shortcode_att('meta_info_border_color') );

        // category tag space
        $modules_category_margin = $res_ctx->get_shortcode_att('modules_category_margin');
        $res_ctx->load_settings_raw( 'modules_category_margin', $modules_category_margin );
        if( $modules_category_margin != '' && is_numeric( $modules_category_margin ) ) {
            $res_ctx->load_settings_raw( 'modules_category_margin', $modules_category_margin . 'px' );
        }
        // category tag padding
        $modules_category_padding = $res_ctx->get_shortcode_att('modules_category_padding');
        $res_ctx->load_settings_raw( 'modules_category_padding', $modules_category_padding );
        if( $modules_category_padding != '' && is_numeric( $modules_category_padding ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding', $modules_category_padding . 'px' );
        }
        //category tag radius
        $modules_category_radius = $res_ctx->get_shortcode_att('modules_category_radius');
        if ( $modules_category_radius != 0 || !empty($modules_category_radius) ) {
            $res_ctx->load_settings_raw( 'modules_category_radius', $modules_category_radius . 'px' );
        }

        // show meta info details
        $res_ctx->load_settings_raw( 'show_cat', $res_ctx->get_shortcode_att('show_cat') );
        $res_ctx->load_settings_raw( 'show_excerpt', $res_ctx->get_shortcode_att('show_excerpt') );
        $res_ctx->load_settings_raw( 'show_btn', $res_ctx->get_shortcode_att('show_btn') );

        // show meta info details
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

        // author photo size
        $author_photo_size = $res_ctx->get_shortcode_att('author_photo_size');
        $res_ctx->load_settings_raw( 'author_photo_size', '20px' );
        if( $author_photo_size != '' && is_numeric( $author_photo_size ) ) {
            $res_ctx->load_settings_raw( 'author_photo_size', $author_photo_size . 'px' );
        }
        // author photo space
        $author_photo_space = $res_ctx->get_shortcode_att('author_photo_space');
        $res_ctx->load_settings_raw( 'author_photo_space', '6px' );
        if( $author_photo_space != '' && is_numeric( $author_photo_space ) ) {
            $res_ctx->load_settings_raw( 'author_photo_space', $author_photo_space . 'px' );
        }
        // author photo radius
        $author_photo_radius = $res_ctx->get_shortcode_att('author_photo_radius');
        $res_ctx->load_settings_raw( 'author_photo_radius', $author_photo_radius );
        if( $author_photo_radius != '' ) {
            if( is_numeric( $author_photo_radius ) ) {
                $res_ctx->load_settings_raw( 'author_photo_radius', $author_photo_radius . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'author_photo_radius', '50%' );
        }



        /*-- COLORS -- */
        $res_ctx->load_settings_raw( 'icon_color', $res_ctx->get_shortcode_att('icon_color') );
        $res_ctx->load_settings_raw( 'icon_color_h', $res_ctx->get_shortcode_att('icon_color_h') );

        $res_ctx->load_settings_raw( 'form_bg', $res_ctx->get_shortcode_att('form_bg') );
        $res_ctx->load_settings_raw( 'form_border_color', $res_ctx->get_shortcode_att('form_border_color') );
        $res_ctx->load_settings_raw( 'arrow_color', $res_ctx->get_shortcode_att('arrow_color') );
        $res_ctx->load_shadow_settings( 6, 0, 2, 0,  'rgba(0, 0, 0, 0.2)', 'form_shadow' );

        $res_ctx->load_settings_raw( 'input_color', $res_ctx->get_shortcode_att('input_color') );
        $res_ctx->load_settings_raw( 'placeholder_color', $res_ctx->get_shortcode_att('placeholder_color') );
        $res_ctx->load_settings_raw( 'placeholder_opacity', $res_ctx->get_shortcode_att('placeholder_opacity') );
        $res_ctx->load_settings_raw( 'input_bg', $res_ctx->get_shortcode_att('input_bg') );
        $res_ctx->load_settings_raw( 'input_border_color', $res_ctx->get_shortcode_att('input_border_color') );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0,  'rgba(0, 0, 0, 0.2)', 'input_shadow' );

        $res_ctx->load_settings_raw( 'btn_icon_color', $res_ctx->get_shortcode_att('btn_icon_color') );
        $res_ctx->load_settings_raw( 'btn_icon_color_h', $res_ctx->get_shortcode_att('btn_icon_color_h') );
        $res_ctx->load_settings_raw( 'btn_color', $res_ctx->get_shortcode_att('btn_color') );
        $res_ctx->load_settings_raw( 'btn_color_h', $res_ctx->get_shortcode_att('btn_color_h') );
        $res_ctx->load_color_settings( 'btn_bg', 'btn_bg', 'btn_bg_gradient', '', '' );
        $res_ctx->load_color_settings( 'btn_bg_h', 'btn_bg_h', 'btn_bg_h_gradient', '', '' );
        $res_ctx->load_settings_raw( 'btn_border_color', $res_ctx->get_shortcode_att('btn_border_color') );
        $res_ctx->load_settings_raw( 'btn_border_color_h', $res_ctx->get_shortcode_att('btn_border_color_h') );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0,  'rgba(0, 0, 0, 0.2)', 'btn_shadow' );

        $res_ctx->load_settings_raw( 'results_bg', $res_ctx->get_shortcode_att('results_bg') );
        $res_ctx->load_settings_raw( 'results_border_color', $res_ctx->get_shortcode_att('results_border_color') );
        $res_ctx->load_settings_raw( 'results_msg_color', $res_ctx->get_shortcode_att('results_msg_color') );
        $res_ctx->load_settings_raw( 'results_msg_color_h', $res_ctx->get_shortcode_att('results_msg_color_h') );
        $res_ctx->load_settings_raw( 'results_msg_bg', $res_ctx->get_shortcode_att('results_msg_bg') );

        $res_ctx->load_color_settings( 'color_overlay', 'overlay', 'overlay_gradient', '', '' );
        $res_ctx->load_settings_raw( 'm_bg', $res_ctx->get_shortcode_att('m_bg') );
        $res_ctx->load_settings_raw( 'meta_bg', $res_ctx->get_shortcode_att('meta_bg') );
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
        $res_ctx->load_settings_raw( 'com_bg', $res_ctx->get_shortcode_att('com_bg') );
        $res_ctx->load_settings_raw( 'com_txt', $res_ctx->get_shortcode_att('com_txt') );
        $res_ctx->load_settings_raw( 'rev_txt', $res_ctx->get_shortcode_att('rev_txt') );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.08)', 'shadow_module' );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.08)', 'shadow_meta' );


        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_input' );
        $res_ctx->load_font_settings( 'f_placeholder' );
        $res_ctx->load_font_settings( 'f_btn' );
        $res_ctx->load_font_settings( 'f_title' );
        $res_ctx->load_font_settings( 'f_cat' );
        $res_ctx->load_font_settings( 'f_meta' );
        $res_ctx->load_font_settings( 'f_ex' );

    }

    function __construct() {
        parent::disable_loop_block_features();
    }

    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        $additional_classes = array();
        // hover effect
        $h_effect = $this->get_att('h_effect');
        if( $h_effect != '' ) {
            $additional_classes[] = 'td-h-effect-' . $h_effect;
        }

        // icon
        $icon = $this->get_att('tdicon');
        if( $icon == '' ) {
            $icon = 'td-icon-search';
        }

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            // input placeholder
            $input_placeholder = $this->get_att('input_placeholder');
            if( $input_placeholder != '' ) {
                $input_placeholder = '<div class="tdb-head-search-placeholder">' . $input_placeholder . '</div>';
            }

            // button text
            $btn_text = $this->get_att('btn_text');
            if( $btn_text != '' ) {
                $btn_text = '<span>' . $btn_text . '</span>';
            }

            // button icon
            $btn_icon_pos = $this->get_att('btn_icon_pos');
            $btn_icon = $this->get_att('btn_tdicon');
            if( $btn_icon != '' ) {
                $btn_icon = '<i class="' . $this->get_att('btn_tdicon') . '"></i>';
            }


            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();

            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= $this->inner();

                $buffy .= '<div class="tdb-drop-down-search" aria-labelledby="td-header-search-button">';
                    $buffy .= '<form method="get" class="tdb-search-form" action="' . esc_url(home_url( '/' )) . '" aria-labelledby="td-header-search-button">';
                        $buffy .= '<div class="tdb-search-form-inner">';
                            $buffy .= '<input id="tdb-head-search-input" type="text" value="' . get_search_query() . '" name="s" autocomplete="off" />';
                            $buffy .= $input_placeholder;
                            $buffy .= '<button class="wpb_button wpb_btn-inverse btn" type="submit" id="tdb-head-search-button">';
                                if( $btn_icon_pos == '' ) {
                                    $buffy .= $btn_icon;
                                }
                                $buffy .= $btn_text;
                                if( $btn_icon_pos == 'after' ) {
                                    $buffy .= $btn_icon;
                                }
                            $buffy .= '</button>';
                        $buffy .= '</div>';
                    $buffy .= '</form>';

                    $buffy .= '<div id="tdb-aj-search">';
                        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
                            $buffy .= '<div class="tdb-aj-search-results">';
                                $wp_fake_posts = array();

                                $args = array(
                                    'post_type' => 'post',
                                    'ignore_sticky_posts' => true,
                                    'post_status' => 'publish',
                                    'posts_per_page' => 4,
                                );
                                $wp_posts = new WP_Query($args);

                                if( $wp_posts->post_count == 4 ) {
                                    foreach ( $wp_posts->posts as $wp_post ) {
                                        $wp_fake_posts[] = array(
                                            'post_id' => $wp_post->ID,
                                            'post_type' => get_post_type( $wp_post->ID ),
                                            'has_post_thumbnail' => has_post_thumbnail( $wp_post->ID ),
                                            'post_thumbnail_id' => get_post_thumbnail_id( $wp_post->ID ),
                                            'post_link' => esc_url( get_permalink( $wp_post->ID ) ),
                                            'post_title' => get_the_title( $wp_post->ID ),
                                            'post_title_attribute' => esc_attr( strip_tags( get_the_title( $wp_post->ID ) ) ),
                                            'post_excerpt' => $wp_post->post_excerpt,
                                            'post_content' => $wp_post->post_content,
                                            'post_date_unix' =>  get_the_time( 'U', $wp_post->ID ),
                                            'post_date' => get_the_time( get_option( 'date_format' ), $wp_post->ID ),
                                            'post_author_url' => get_author_posts_url( $wp_post->post_author ),
                                            'post_author_name' => get_the_author_meta( 'display_name', $wp_post->post_author ),
                                            'post_author_email' => get_the_author_meta( 'email', $wp_post->post_author ),
                                            'post_comments_no' => get_comments_number( $wp_post->ID ),
                                            'post_comments_link' => get_comments_link( $wp_post->ID ),
                                            'post_theme_settings' => td_util::get_post_meta_array( $wp_post->ID, 'td_post_theme_settings' ),
                                        );
                                    }
                                } else {
                                    for( $i = 0; $i < 4; $i++ ) {
                                        $wp_fake_posts[] = array(
                                            'post_id' => '-' . $i, // negative post_id to avoid conflict with existent posts
                                            'post_type' => 'sample',
                                            'post_link' => '#',
                                            'post_title' => 'Sample post title ' . $i,
                                            'post_title_attribute' => esc_attr( 'Sample post title ' . $i ),
                                            'post_excerpt' => 'Sample post no ' . $i .  ' excerpt.',
                                            'post_content' => 'Sample post no ' . $i .  ' content.',
                                            'post_date_unix' =>  get_the_time( 'U' ),
                                            'post_date' => date( get_option( 'date_format' ), time() ),
                                            'post_author_url' => '#',
                                            'post_author_name' => 'Author name',
                                            'post_author_email' => get_the_author_meta( 'email', 1 ),
                                            'post_comments_no' => '11',
                                            'post_comments_link' => '#',
                                            'post_theme_settings' => array(
                                                'td_primary_cat' => '1'
                                            ),
                                        );
                                    }
                                }

                                foreach ( $wp_fake_posts as $wp_fake_post ) {
                                    $tdb_module_mm = new tdb_module_search($wp_fake_post, $this->get_all_atts());
                                    $buffy .= $tdb_module_mm->render($wp_fake_post);
                                }
                            $buffy .= '</div>';

                            $buffy .= '<div class="result-msg"><a href="#">View all results</a></div>';
                        }
                    $buffy .= '</div>';
                $buffy .= '</div>';

                $buffy .= '<a id="tdb-search-button" href="#" role="button" class="dropdown-toggle " data-toggle="dropdown"><i class="tdb-search-icon ' . $icon . '"></i></a>';

            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

    function inner() {
        $buffy = '';

        $td_block_layout = new td_block_layout();

        // render the JS
        ob_start();
        ?>
        <script>
            jQuery().ready(function () {

                var tdbSearchItem = new tdbSearch.item();

                //block unique ID
                tdbSearchItem.blockUid = '<?php echo $this->block_uid; ?>';
                tdbSearchItem.blockAtts = '<?php echo json_encode($this->get_all_atts(), JSON_UNESCAPED_SLASHES); ?>';
                tdbSearchItem.jqueryObj = jQuery('.<?php echo $this->block_uid ?>_rand');
                tdbSearchItem._openSearchFormClass = 'tdb-drop-down-search-open';

                tdbSearch.addItem( tdbSearchItem );

            });
        </script>
        <?php
        td_js_buffer::add_to_footer("\n" . td_util::remove_script_tag(ob_get_clean()));

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
            /* global jQuery:{} */
            (function () {
                var tdbSearchItem = new tdbSearch.item();

                //block unique ID
                tdbSearchItem.blockUid = '<?php echo $this->block_uid; ?>';
                tdbSearchItem.blockAtts = '<?php echo json_encode($this->get_all_atts(), JSON_UNESCAPED_SLASHES); ?>';
                tdbSearchItem.jqueryObj = jQuery('.<?php echo $this->block_uid ?>_rand');
                tdbSearchItem._openSearchFormClass = 'tdb-drop-down-search-open';

                tdbSearch.addItem( tdbSearchItem );
            })();
        </script>
        <?php

        return $buffy . td_util::remove_script_tag(ob_get_clean());
    }

}