<?php

/**
 * Class tdb_category_grid
 */

class tdb_category_grid_1 extends td_block {

    static function cssMedia( $res_ctx ) {

        // container_width
        $container_width = $res_ctx->get_shortcode_att('container_width');
        if ( is_numeric( $container_width ) ) {
            $res_ctx->load_settings_raw( 'container_width', $container_width . '%' );
        } else {
            $res_ctx->load_settings_raw( 'container_width', $container_width );
        }

        //image alignment
        $res_ctx->load_settings_raw( 'image_alignment', $res_ctx->get_shortcode_att('image_alignment') . '%' );

        // image_height
        $image_height = $res_ctx->get_shortcode_att('image_height');
        if ( is_numeric( $image_height ) ) {
            $res_ctx->load_settings_raw( 'image_height', $image_height . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height', $image_height );
        }

        // image zoom effect on hover
        $res_ctx->load_settings_raw( 'image_zoom', $res_ctx->get_shortcode_att('image_zoom') );

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
        if( $meta_info_vert == 'content-vert-bottom' ) {
            $res_ctx->load_settings_raw( 'meta_info_vert_bottom', 1 );
        }

        // meta info width
        $meta_info_width = $res_ctx->get_shortcode_att('meta_width');
        $res_ctx->load_settings_raw( 'meta_width', $meta_info_width );
        if( $meta_info_width != '' && is_numeric( $meta_info_width ) ) {
            $res_ctx->load_settings_raw( 'meta_width', $meta_info_width . 'px' );
        }

        // modules per row
        $grid_layout = $res_ctx->get_shortcode_att('grid_layout');
        if ( $grid_layout == '' ) {
            $grid_layout = 1;
            $res_ctx->load_settings_raw( 'modules_on_row', '100%' );
        }

        // modules clearfix
        $clearfix = 'clearfix';
        $padding = 'padding';
        if ( $res_ctx->is( 'all' ) ) {
            $clearfix = 'clearfix_desktop';
            $padding = 'padding_desktop';
        }
        switch ($grid_layout) {
            case '1':
                $res_ctx->load_settings_raw( $padding,  '1' );
                $res_ctx->load_settings_raw( 'modules_on_row', '100%' );
                break;
            case '2':
                $res_ctx->load_settings_raw( $clearfix,  '2n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+2' );
                $res_ctx->load_settings_raw( 'modules_on_row', '50%' );
                break;
            case '3':
                $res_ctx->load_settings_raw( $clearfix,  '3n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+3' );
                $res_ctx->load_settings_raw( 'modules_on_row', '33.33333333%' );
                break;
            case '4':
                $res_ctx->load_settings_raw( $clearfix,  '4n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+4' );
                $res_ctx->load_settings_raw( 'modules_on_row', '25%' );
                break;
            case '5':
                $res_ctx->load_settings_raw( $clearfix,  '5n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+4' );
                $res_ctx->load_settings_raw( 'modules_on_row', '20%' );
                break;
        }

        // modules gap
        $modules_gap = $res_ctx->get_shortcode_att('modules_gap');
        $res_ctx->load_settings_raw( 'modules_gap', $modules_gap );
        $res_ctx->load_settings_raw( 'modules_gap_mob', $modules_gap );
        if ( $modules_gap == '' ) {
            $res_ctx->load_settings_raw( 'modules_gap', '24px');
            $res_ctx->load_settings_raw( 'modules_gap_mob', '48px');
        } else if ( is_numeric( $modules_gap ) ) {
            $res_ctx->load_settings_raw( 'modules_gap', $modules_gap / 2 .'px' );
            $res_ctx->load_settings_raw( 'modules_gap_mob', $modules_gap .'px' );
        }

        // article title space
        $art_title = $res_ctx->get_shortcode_att('art_title');
        $res_ctx->load_settings_raw( 'art_title', $art_title );
        if ( is_numeric( $art_title ) ) {
            $res_ctx->load_settings_raw( 'art_title', $art_title . 'px' );
        }
        // article title padding
        $art_title_padd = $res_ctx->get_shortcode_att('art_title_padd');
        $res_ctx->load_settings_raw( 'art_title_padd', $art_title_padd );
        if ( is_numeric( $art_title_padd ) ) {
            $res_ctx->load_settings_raw( 'art_title_padd', $art_title_padd . 'px' );
        }

        // author & date padding
        $auth_date_padd = $res_ctx->get_shortcode_att('auth_date_padding');
        $res_ctx->load_settings_raw( 'auth_date_padd', $auth_date_padd );
        if ( is_numeric( $auth_date_padd ) ) {
            $res_ctx->load_settings_raw( 'auth_date_padd', $auth_date_padd . 'px' );
        }

        // category tag margin
        $modules_category_margin = $res_ctx->get_shortcode_att('modules_category_margin');
        $res_ctx->load_settings_raw( 'modules_category_margin', $modules_category_margin );
        if( $modules_category_margin != '' ) {
            if( is_numeric( $modules_category_margin ) ) {
                $res_ctx->load_settings_raw( 'modules_category_margin', $modules_category_margin . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'modules_category_margin', '0 0 5px' );
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
        $show_author = $res_ctx->get_shortcode_att('show_author');
        $show_date = $res_ctx->get_shortcode_att('show_date');
        if( $show_author == 'none' && $show_date == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date', 1 );
        }
        $res_ctx->load_settings_raw( 'show_author', $show_author );
        $res_ctx->load_settings_raw( 'show_date', $show_date );

        // colors
        $res_ctx->load_color_settings( 'overlay_general', 'overlay_general', 'overlay_general_gradient', '', '' );
        $res_ctx->load_color_settings( 'overlay_h_general', 'overlay_h_general', 'overlay_general_h_gradient', '', '' );
        $res_ctx->load_color_settings( 'overlay_1', 'overlay_1', 'overlay_1_gradient', '', '' );
        $res_ctx->load_color_settings( 'overlay_2', 'overlay_2', 'overlay_2_gradient', '', '' );
        $res_ctx->load_color_settings( 'overlay_3', 'overlay_3', 'overlay_3_gradient', '', '' );
        $res_ctx->load_color_settings( 'overlay_4', 'overlay_4', 'overlay_4_gradient', '', '' );
        $res_ctx->load_settings_raw( 'meta_bg', $res_ctx->get_shortcode_att('meta_bg') );
        $res_ctx->load_settings_raw( 'cat_bg', $res_ctx->get_shortcode_att('cat_bg') );
        $res_ctx->load_settings_raw( 'cat_txt', $res_ctx->get_shortcode_att('cat_txt') );
        $res_ctx->load_settings_raw( 'cat_bg_hover', $res_ctx->get_shortcode_att('cat_bg_hover') );
        $res_ctx->load_settings_raw( 'cat_txt_hover', $res_ctx->get_shortcode_att('cat_txt_hover') );
        $res_ctx->load_settings_raw( 'title_txt', $res_ctx->get_shortcode_att('title_txt') );
        $res_ctx->load_settings_raw( 'title_txt_hover', $res_ctx->get_shortcode_att('title_txt_hover') );
        $res_ctx->load_settings_raw( 'title_bg', $res_ctx->get_shortcode_att('title_bg') );
        $res_ctx->load_settings_raw( 'author_txt', $res_ctx->get_shortcode_att('author_txt') );
        $res_ctx->load_settings_raw( 'author_txt_hover', $res_ctx->get_shortcode_att('author_txt_hover') );
        $res_ctx->load_settings_raw( 'date_txt', $res_ctx->get_shortcode_att('date_txt') );
        $res_ctx->load_settings_raw( 'auth_date_bg', $res_ctx->get_shortcode_att('auth_date_bg') );
        $res_ctx->load_settings_raw( 'com_bg', $res_ctx->get_shortcode_att('com_bg') );
        $res_ctx->load_settings_raw( 'com_txt', $res_ctx->get_shortcode_att('com_txt') );


        // fonts
        $res_ctx->load_font_settings( 'f_title' );
        $res_ctx->load_font_settings( 'f_cat' );
        $res_ctx->load_font_settings( 'f_meta' );
        $res_ctx->load_settings_raw( 'f_meta_fw', $res_ctx->get_shortcode_att('f_meta_font_weight') );

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @container_width */
				.$unique_block_class {
					width: @container_width; float: left;
				}
				/* @image_alignment */
				.$unique_block_class .entry-thumb {
					background-position: center @image_alignment;
				}
				/* @image_height */
				.$unique_block_class .td-image-wrap {
					padding-bottom: @image_height;
				}
				/* @image_zoom */
				@media (min-width: 767px) {
                    .$unique_block_class .td-module-container:hover .td-thumb-css {
                        transform: scale3d(1.1, 1.1, 1);
                        -webkit-transform: scale3d(1.1, 1.1, 1);
                        -moz-transform: scale3d(1.1, 1.1, 1);
                        -ms-transform: scale3d(1.1, 1.1, 1);
                        -o-transform: scale3d(1.1, 1.1, 1);
                    }
                }
				/* @image_width */
				.$unique_block_class .td-image-container {
				 	flex: 0 0 @image_width;
				 	width: @image_width;
			    }
				/* @no_float */
				.$unique_block_class .td-module-container {
					flex-direction: column;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 0;
                }
				/* @float_left */
				.$unique_block_class .td-module-container {
					flex-direction: row;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 0;
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
				
				/* @meta_info_horiz_center */
				.$unique_block_class .td-module-meta-info {
					text-align: center;
				}
				/* @meta_info_horiz_right */
				.$unique_block_class .td-module-meta-info {
					text-align: right;
				}
			
				/* @meta_info_vert_top */
				.$unique_block_class .td-module-meta-info {
					top: 0;
				}
				/* @meta_info_vert_center */
				.$unique_block_class .td-module-meta-info {
					top: 50%;
					transform: translateY(-50%);
				}
				/* @meta_info_vert_bottom */
				.$unique_block_class .td-module-meta-info {
					bottom: 0;
				}
				
				/* @meta_width */
				.$unique_block_class .td-module-meta-info {
					width: @meta_width;
				}
				/* @meta_margin */
				.$unique_block_class .td-module-meta-info {
					margin: @meta_margin;
				}
				/* @meta_padding */
				.$unique_block_class .td-module-meta-info {
					padding: @meta_padding;
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
				/* @modules_on_row */
				@media (min-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post {
                        width: @modules_on_row;
                    }
                }
				/* @modules_gap */
				@media (min-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post {
                        padding-left: @modules_gap;
                        padding-right: @modules_gap;
                    }
                    .$unique_block_class .tdb-block-inner {
                        margin-left: -@modules_gap;
                        margin-right: -@modules_gap;
                    }
                }
				/* @modules_gap_mob */
                @media (max-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post {
                        margin-bottom: @modules_gap_mob;
                    }
                    .$unique_block_class .tdb-cat-grid-post:last-child {
                        margin-bottom: 0;
                    }
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
				/* @image_radius */
				.$unique_block_class .entry-thumb {
					border-radius: @image_radius;
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
				.$unique_block_class .td-editor-date {
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
				/* @show_com */
				.$unique_block_class .td-module-comments {
					display: @show_com;
				}
				/* @clearfix_desktop */
				.$unique_block_class .tdb-cat-grid-post:nth-child(@clearfix_desktop) {
					clear: both;
				}
				/* @clearfix */
				.$unique_block_class .tdb-cat-grid-post {
					clear: none !important;
				}
				.$unique_block_class .tdb-cat-grid-post:nth-child(@clearfix) {
					clear: both !important;
				}
				/* @padding_desktop */
				@media (min-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post:nth-last-child(@padding_desktop) {
                        margin-bottom: 0;
                        padding-bottom: 0;
                    }
                    .$unique_block_class .tdb-cat-grid-post:nth-last-child(@padding_desktop) .td-module-container:before {
                        display: none;
                    }
                    .$unique_block_class .tdb-cat-grid-post:nth-last-child(@padding) {
                        margin-bottom: 0 !important;
                        padding-bottom: 0 !important;
                    }
                    .$unique_block_class .tdb-cat-grid-post .td-module-container:before {
                        display: block !important;
                    }
                    .$unique_block_class .tdb-cat-grid-post:nth-last-child(@padding) .td-module-container:before {
                        display: none !important;
                    }
                }
				/* @m_bg */
				.$unique_block_class .td-module-container {
					background-color: @m_bg;
				}
				
				
				/* @overlay_general */
				.$unique_block_class .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_general;
				}
				/* @overlay_h_general */
				.$unique_block_class .td-module-thumb:after {
				    content: '';
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
				    background-color: @overlay_h_general;
				    opacity: 0;
				    z-index: 1;
                    -webkit-transition: opacity 0.4s ease 0.2s;
                    -moz-transition: opacity 0.4s ease 0.2s;
                    -o-transition: opacity 0.4s ease 0.2s;
                    transition: opacity 0.4s ease 0.2s;
                    pointer-events: none;
				}
				.$unique_block_class .td-module-container:hover .td-module-thumb:after {
				    opacity: 1;
				}
				/* @overlay_general_gradient */
				.$unique_block_class .td-image-wrap:before {
				    content: '';
				    @overlay_general_gradient
				}
				/* @overlay_general_h_gradient */
				.$unique_block_class .td-module-thumb:after {
				    content: '';
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
				    background-color: @overlay_general_h_gradient;
				    opacity: 0;
				    z-index: 1;
                    -webkit-transition: opacity 0.4s ease 0.2s;
                    -moz-transition: opacity 0.4s ease 0.2s;
                    -o-transition: opacity 0.4s ease 0.2s;
                    transition: opacity 0.4s ease 0.2s;
                    pointer-events: none;
				}
				.$unique_block_class .td-module-container:hover .td-module-thumb:after {
				    opacity: 1;
				}
				/* @overlay_1 */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+1) .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_1;
				}
				/* @overlay_1_gradient */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+1) .td-image-wrap:before {
				    content: '';
				    @overlay_1_gradient
				}
				/* @overlay_2 */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+2) .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_2;
				}
				/* @overlay_2_gradient */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+2) .td-image-wrap:before {
				    content: '';
				    @overlay_2_gradient
				}
				/* @overlay_3 */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+3) .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_3;
				}
				/* @overlay_3_gradient */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+3) .td-image-wrap:before {
				    content: '';
				    @overlay_3_gradient
				}
				/* @overlay_4 */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+4) .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_4;
				}
				/* @overlay_4_gradient */
				.$unique_block_class .tdb-cat-grid-post:nth-child(4n+4) .td-image-wrap:before {
				    content: '';
				    @overlay_4_gradient
				}
				
				
				/* @meta_bg */
				.$unique_block_class .td-module-meta-info {
					background-color: @meta_bg;
				}
				/* @cat_bg */
				.$unique_block_class .td-post-category {
					background-color: @cat_bg;
				}
				/* @cat_bg_hover */
				.$unique_block_class .td-module-container:hover .td-post-category {
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
				.$unique_block_class .tdb-cat-grid-post:hover .td-module-title a {
					color: @title_txt_hover;
				}
				/* @title_bg */
				.$unique_block_class .td-module-title {
					background-color: @title_bg;
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
				/* @auth_date_bg */
				.$unique_block_class .td-editor-date {
					background-color: @auth_date_bg;
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
				/* @art_title */
				.$unique_block_class .entry-title {
					margin: @art_title;
				}
				/* @art_title_padd */
				.$unique_block_class .entry-title {
					padding: @art_title_padd;
				}
				/* @auth_date_padd */
				.$unique_block_class .td-editor-date {
					padding: @auth_date_padd;
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
				/* @f_pag */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a i,
				.$unique_block_class .page-nav a,
				.$unique_block_class .page-nav span,
				.$unique_block_class .td-load-more-wrap a {
					@f_pag
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
				.$unique_block_class .td-module-comments a {
					@f_meta
				}
				/* @f_meta_fw */
				.$unique_block_class .td-post-author-name {
				    font-weight: @f_meta_fw;
				}
				/* @f_ex */
				.$unique_block_class .td-excerpt {
					@f_ex
				}
				/* @f_btn */
				.$unique_block_class .td-read-more a {
					@f_btn
				}
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();

        return $compiled_css;
    }


    // disable loop block features, this block does not use a loop and it doesn't need to run a query
    function __construct() {
        parent::disable_loop_block_features();
    }

    function render( $atts, $content = null ) {
        parent::render( $atts );

        $atts['tdb_grid_limit'] = $this->get_att( 'grid_layout' );

        global $tdb_state_category;
        $category_grid_data = $tdb_state_category->category_grid->__invoke( $atts );

        $additional_classes = array();

        if( $this->get_att( 'lightsky' ) != '' ) {
            $additional_classes[] = 'tdb-cat-grid-lightsky';
        }

        $buffy = '';

        $buffy .= '<div class="tdb-category-grids ' . $this->get_block_classes($additional_classes) . ' tdb-category-grid-posts" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();

            $buffy .= '<div  id=' . $this->block_uid . ' class="td_block_inner tdb-block-inner td-fix-index">';
                $buffy .= $this->inner( $category_grid_data['grid_posts'], $this->get_att( 'grid_layout' ), $this->get_att('td_column_number') );  //inner content of the block
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

    function inner( $posts, $post_limit, $td_column_number ) {

        $buffy = '';
        if ( !empty( $posts )) {
            $post_count = 0;

            foreach ( $posts as $post ) {
                $tdb_module_cat = new tdb_module_cat_grid_1( $post, $this->get_all_atts() );
                $buffy .= $tdb_module_cat->render( $post_count );

                $post_count++;
            }

            if ($post_count < $post_limit) {
                for ($i = $post_count; $i < $post_limit; $i++) {
                    $tdb_module_cat = new tdb_module_cat_grid_1_empty( $post, $this->get_all_atts() );
                    $buffy .= $tdb_module_cat->render($i, 'tdb_module_cat_grid_1');

                    $post_count++;
                }
            }
        }

        return $buffy;

    }

}

