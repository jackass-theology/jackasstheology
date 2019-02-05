<?php

class td_flex_block_4 extends td_block {

    static function cssMedia( $res_ctx ) {

        // columns
        $columns = $res_ctx->get_shortcode_att('columns');
        $res_ctx->load_settings_raw( 'columns', $columns );

        switch ($columns) {
            case '50%':
                $res_ctx->load_settings_raw( 'modules_no_padding1', 1 );
                $res_ctx->load_settings_raw( 'clearfix', '2n+1' );
                break;
            case '33.33333333%':
                $res_ctx->load_settings_raw( 'modules_no_padding2', 1 );
                $res_ctx->load_settings_raw( 'clearfix', '3n+1' );
                break;
            case '25%':
                $res_ctx->load_settings_raw( 'modules_no_padding3', 1 );
                $res_ctx->load_settings_raw( 'clearfix', '4n+1' );
                break;
            case '20%':
                $res_ctx->load_settings_raw( 'modules_no_padding4', 1 );
                $res_ctx->load_settings_raw( 'clearfix', '5n+1' );
                break;
        }


        // columns gap
        $columns_gap = $res_ctx->get_shortcode_att('columns_gap');
        $res_ctx->load_settings_raw( 'columns_gap', $columns_gap );
        if ( $columns_gap == '' ) {
            $res_ctx->load_settings_raw( 'columns_gap', '24px');
        } else if ( is_numeric( $columns_gap ) ) {
            $res_ctx->load_settings_raw( 'columns_gap', $columns_gap / 2 .'px' );
        }


        // modules space
        $modules_space1 = $res_ctx->get_shortcode_att('modules_space1');
        $res_ctx->load_settings_raw( 'modules_space1', $modules_space1 );
        if ( $modules_space1 == '' ) {
            $res_ctx->load_settings_raw( 'modules_space1', '0');
        } else if ( is_numeric( $modules_space1 ) ) {
            $res_ctx->load_settings_raw( 'modules_space1', $modules_space1 / 2 .'px' );
        }
        $modules_space2 = $res_ctx->get_shortcode_att('modules_space2');
        $res_ctx->load_settings_raw( 'modules_space2', $modules_space2 );
        if ( $modules_space2 == '' ) {
            $res_ctx->load_settings_raw( 'modules_space2', '13px');
        } else if ( is_numeric( $modules_space1 ) ) {
            $res_ctx->load_settings_raw( 'modules_space2', $modules_space2 / 2 .'px' );
        }

        // modules divider
        $modules_divider1 = $res_ctx->get_shortcode_att('modules_divider1');
        $res_ctx->load_settings_raw( 'modules_divider1', $modules_divider1 );
        if( $modules_divider1 == '' ) {
            $res_ctx->load_settings_raw( 'modules_divider1', 'none' );
        }
        $modules_divider2 = $res_ctx->get_shortcode_att('modules_divider2');
        $res_ctx->load_settings_raw( 'modules_divider2', $modules_divider2 );
        if( $modules_divider2 == '' ) {
            $res_ctx->load_settings_raw( 'modules_divider2', 'none' );
        }
        // modules divider color
        $res_ctx->load_settings_raw( 'modules_divider_color1', $res_ctx->get_shortcode_att('modules_divider_color1') );
        $res_ctx->load_settings_raw( 'modules_divider_color2', $res_ctx->get_shortcode_att('modules_divider_color2') );



        /*-- ARTICLE IMAGE-- */
        //image alignment
        $res_ctx->load_settings_raw( 'image_alignment1', $res_ctx->get_shortcode_att('image_alignment1') . '%' );
        $res_ctx->load_settings_raw( 'image_alignment2', $res_ctx->get_shortcode_att('image_alignment2') . '%' );

        // image_width
        $image_width2 = $res_ctx->get_shortcode_att('image_width2');
        $res_ctx->load_settings_raw( 'image_width2', '30%' );
        if( $image_width2 != '' ) {
            if ( is_numeric( $image_width2 ) ) {
                $res_ctx->load_settings_raw( 'image_width2', $image_width2 . '%' );
            } else {
                $res_ctx->load_settings_raw( 'image_width2', $image_width2 );
            }
        }

	    // image_height
	    $image_height1 = $res_ctx->get_shortcode_att('image_height1');
	    if ( is_numeric( $image_height1 ) ) {
		    $res_ctx->load_settings_raw( 'image_height1', $image_height1 . '%' );
	    } else {
		    $res_ctx->load_settings_raw( 'image_height1', $image_height1 );
	    }
        $image_height2 = $res_ctx->get_shortcode_att('image_height2');
        if ( is_numeric( $image_height2 ) ) {
            $res_ctx->load_settings_raw( 'image_height2', $image_height2 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height2', $image_height2 );
        }

        // image radius
        $image_radius1 = $res_ctx->get_shortcode_att('image_radius1');
        $res_ctx->load_settings_raw( 'image_radius1', $image_radius1 );
        if ( is_numeric( $image_radius1 ) ) {
            $res_ctx->load_settings_raw( 'image_radius1', $image_radius1 . 'px' );
        }
        $image_radius2 = $res_ctx->get_shortcode_att('image_radius2');
        $res_ctx->load_settings_raw( 'image_radius2', $image_radius2 );
        if ( is_numeric( $image_radius2 ) ) {
            $res_ctx->load_settings_raw( 'image_radius2', $image_radius2 . 'px' );
        }



        /*-- META INFO -- */
        // meta info align
        $meta_info_align1 = $res_ctx->get_shortcode_att('meta_info_align1');
	    $res_ctx->load_settings_raw( 'meta_info_align1', $meta_info_align1 );
	    // meta info align to fix top when no float is selected
        if ( $meta_info_align1 == 'initial' ) {
	        $res_ctx->load_settings_raw( 'meta_info_align_top1',  1 );
        } else if( $meta_info_align1 == 'image' ) {
            $res_ctx->load_settings_raw( 'meta_info_align_image1',  1 );
        }
        // meta info align top/bottom - align category
        if ( $meta_info_align1 == 'initial' ) {
	        $res_ctx->load_settings_raw( 'align_category_top1',  1 );
        }

        // meta info horizontal align
        $content_align1 = $res_ctx->get_shortcode_att('meta_info_horiz1');
        if ( $content_align1 == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_center1', 1 );
        } else if ( $content_align1 == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_right1', 1 );
        }
        $content_align2 = $res_ctx->get_shortcode_att('meta_info_horiz2');
        if ( $content_align2 == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_center2', 1 );
        } else if ( $content_align2 == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_right2', 1 );
        }

        // meta info width
        $meta_info_width1 = $res_ctx->get_shortcode_att('meta_width1');
        $res_ctx->load_settings_raw( 'meta_width1', $meta_info_width1 );
        if( $meta_info_width1 != '' && is_numeric( $meta_info_width1 ) ) {
            $res_ctx->load_settings_raw( 'meta_width1', $meta_info_width1 . 'px' );
        }
        $meta_info_width2 = $res_ctx->get_shortcode_att('meta_width2');
        $res_ctx->load_settings_raw( 'meta_width2', $meta_info_width2 );
        if( $meta_info_width2 != '' && is_numeric( $meta_info_width2 ) ) {
            $res_ctx->load_settings_raw( 'meta_width2', $meta_info_width2 . 'px' );
        }

        // meta info margin
        $meta_margin1 = $res_ctx->get_shortcode_att('meta_margin1');
        $res_ctx->load_settings_raw( 'meta_margin1', $meta_margin1 );
        if ( is_numeric( $meta_margin1 ) ) {
            $res_ctx->load_settings_raw( 'meta_margin1', $meta_margin1 . 'px' );
        }
        $meta_margin2 = $res_ctx->get_shortcode_att('meta_margin2');
        $res_ctx->load_settings_raw( 'meta_margin2', $meta_margin2 );
        if ( is_numeric( $meta_margin2 ) ) {
            $res_ctx->load_settings_raw( 'meta_margin2', $meta_margin2 . 'px' );
        }

        // meta info padding
        $meta_padding1 = $res_ctx->get_shortcode_att('meta_padding1');
        $res_ctx->load_settings_raw( 'meta_padding1', $meta_padding1 );
        if ( is_numeric( $meta_padding1 ) ) {
            $res_ctx->load_settings_raw( 'meta_padding1', $meta_padding1 . 'px' );
        }
        $meta_padding2 = $res_ctx->get_shortcode_att('meta_padding2');
        $res_ctx->load_settings_raw( 'meta_padding2', $meta_padding2 );
        if ( is_numeric( $meta_padding2 ) ) {
            $res_ctx->load_settings_raw( 'meta_padding2', $meta_padding2 . 'px' );
        }

        // article title space
        $art_title1 = $res_ctx->get_shortcode_att('art_title1');
        $res_ctx->load_settings_raw( 'art_title1', $art_title1 );
        if ( is_numeric( $art_title1 ) ) {
            $res_ctx->load_settings_raw( 'art_title1', $art_title1 . 'px' );
        }
        $art_title2 = $res_ctx->get_shortcode_att('art_title2');
        $res_ctx->load_settings_raw( 'art_title2', $art_title2 );
        if ( is_numeric( $art_title2 ) ) {
            $res_ctx->load_settings_raw( 'art_title2', $art_title2 . 'px' );
        }

        // article excerpt space
        $art_excerpt1 = $res_ctx->get_shortcode_att('art_excerpt1');
        $res_ctx->load_settings_raw( 'art_excerpt1', $art_excerpt1 );
        if ( is_numeric( $art_excerpt1 ) ) {
            $res_ctx->load_settings_raw( 'art_excerpt1', $art_excerpt1 . 'px' );
        }
        $art_excerpt2 = $res_ctx->get_shortcode_att('art_excerpt2');
        $res_ctx->load_settings_raw( 'art_excerpt2', $art_excerpt2 );
        if ( is_numeric( $art_excerpt2 ) ) {
            $res_ctx->load_settings_raw( 'art_excerpt2', $art_excerpt2 . 'px' );
        }

        // category tag margin
        $modules_category_margin1 = $res_ctx->get_shortcode_att('modules_category_margin1');
        $res_ctx->load_settings_raw( 'modules_category_margin1', $modules_category_margin1 );
        if( $modules_category_margin1 != '' && is_numeric( $modules_category_margin1 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_margin1', $modules_category_margin1 . 'px' );
        }
        $modules_category_margin2 = $res_ctx->get_shortcode_att('modules_category_margin2');
        $res_ctx->load_settings_raw( 'modules_category_margin2', $modules_category_margin2 );
        if( $modules_category_margin2 != '' && is_numeric( $modules_category_margin2 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_margin2', $modules_category_margin2 . 'px' );
        }

        // category tag padding
        $modules_category_padding1 = $res_ctx->get_shortcode_att('modules_category_padding1');
        $res_ctx->load_settings_raw( 'modules_category_padding1', $modules_category_padding1 );
        if( $modules_category_padding1 != '' && is_numeric( $modules_category_padding1 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding1', $modules_category_padding1 . 'px' );
        }
        $modules_category_padding2 = $res_ctx->get_shortcode_att('modules_category_padding2');
        $res_ctx->load_settings_raw( 'modules_category_padding2', $modules_category_padding2 );
        if( $modules_category_padding2 != '' && is_numeric( $modules_category_padding2 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding2', $modules_category_padding2 . 'px' );
        }

        //category tag radius
        $modules_category_radius1 = $res_ctx->get_shortcode_att('modules_category_radius1');
        if ( $modules_category_radius1 != 0 || !empty($modules_category_radius1) ) {
            $res_ctx->load_settings_raw( 'modules_category_radius1', $modules_category_radius1 . 'px' );
        }
        $modules_category_radius2 = $res_ctx->get_shortcode_att('modules_category_radius2');
        if ( $modules_category_radius2 != 0 || !empty($modules_category_radius2) ) {
            $res_ctx->load_settings_raw( 'modules_category_radius2', $modules_category_radius2 . 'px' );
        }

        // author photo size
        $author_photo_size1 = $res_ctx->get_shortcode_att('author_photo_size1');
        $res_ctx->load_settings_raw( 'author_photo_size1', '20px' );
        if( $author_photo_size1 != '' && is_numeric( $author_photo_size1 ) ) {
            $res_ctx->load_settings_raw( 'author_photo_size1', $author_photo_size1 . 'px' );
        }
        $author_photo_size2 = $res_ctx->get_shortcode_att('author_photo_size2');
        $res_ctx->load_settings_raw( 'author_photo_size2', '20px' );
        if( $author_photo_size2 != '' && is_numeric( $author_photo_size2 ) ) {
            $res_ctx->load_settings_raw( 'author_photo_size2', $author_photo_size2 . 'px' );
        }

        // author photo space
        $author_photo_space1 = $res_ctx->get_shortcode_att('author_photo_space1');
        $res_ctx->load_settings_raw( 'author_photo_space1', '6px' );
        if( $author_photo_space1 != '' && is_numeric( $author_photo_space1 ) ) {
            $res_ctx->load_settings_raw( 'author_photo_space1', $author_photo_space1 . 'px' );
        }
        $author_photo_space2 = $res_ctx->get_shortcode_att('author_photo_space2');
        $res_ctx->load_settings_raw( 'author_photo_space2', '6px' );
        if( $author_photo_space2 != '' && is_numeric( $author_photo_space2 ) ) {
            $res_ctx->load_settings_raw( 'author_photo_space2', $author_photo_space2 . 'px' );
        }

        // author photo radius
        $author_photo_radius1 = $res_ctx->get_shortcode_att('author_photo_radius1');
        $res_ctx->load_settings_raw( 'author_photo_radius1', $author_photo_radius1 );
        if( $author_photo_radius1 != '' ) {
            if( is_numeric( $author_photo_radius1 ) ) {
                $res_ctx->load_settings_raw( 'author_photo_radius1', $author_photo_radius1 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'author_photo_radius1', '50%' );
        }
        $author_photo_radius2 = $res_ctx->get_shortcode_att('author_photo_radius2');
        $res_ctx->load_settings_raw( 'author_photo_radius2', $author_photo_radius2 );
        if( $author_photo_radius2 != '' ) {
            if( is_numeric( $author_photo_radius2 ) ) {
                $res_ctx->load_settings_raw( 'author_photo_radius2', $author_photo_radius2 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'author_photo_radius2', '50%' );
        }

        //show meta info details
        $res_ctx->load_settings_raw( 'show_cat1', $res_ctx->get_shortcode_att('show_cat1') );
        $res_ctx->load_settings_raw( 'show_cat2', $res_ctx->get_shortcode_att('show_cat2') );
        $res_ctx->load_settings_raw( 'show_excerpt1', $res_ctx->get_shortcode_att('show_excerpt1') );
        $res_ctx->load_settings_raw( 'show_excerpt2', $res_ctx->get_shortcode_att('show_excerpt2') );

        $show_author1 = $res_ctx->get_shortcode_att('show_author1');
        $show_date1 = $res_ctx->get_shortcode_att('show_date1');
        $show_review1 = $res_ctx->get_shortcode_att('show_review1');
        $show_com1 = $res_ctx->get_shortcode_att('show_com1');
        if( $show_author1 == 'none' && $show_date1 == 'none' && $show_com1 == 'none' && $show_review1 == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date1', 1 );
        }
        $res_ctx->load_settings_raw( 'show_author1', $show_author1 );
        $res_ctx->load_settings_raw( 'show_date1', $show_date1 );
        $res_ctx->load_settings_raw( 'show_review1', $show_review1 );
        $res_ctx->load_settings_raw( 'show_com1', $show_com1 );

        $show_author2 = $res_ctx->get_shortcode_att('show_author2');
        $show_date2 = $res_ctx->get_shortcode_att('show_date2');
        $show_review2 = $res_ctx->get_shortcode_att('show_review2');
        $show_com2 = $res_ctx->get_shortcode_att('show_com2');
        if( $show_author2 == 'none' && $show_date2 == 'none' && $show_com2 == 'none' && $show_review2 == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date2', 1 );
        }
        $res_ctx->load_settings_raw( 'show_author2', $show_author2 );
        $res_ctx->load_settings_raw( 'show_date2', $show_date2 );
        $res_ctx->load_settings_raw( 'show_review2', $show_review2 );
        $res_ctx->load_settings_raw( 'show_com2', $show_com2 );


	    // colors
        $res_ctx->load_color_settings( 'color_overlay', 'overlay', 'overlay_gradient', '', '' );

        $res_ctx->load_settings_raw( 'meta_bg', $res_ctx->get_shortcode_att('meta_bg') );
        $res_ctx->load_settings_raw( 'meta_bg2', $res_ctx->get_shortcode_att('meta_bg2') );

        $res_ctx->load_settings_raw( 'title_txt', $res_ctx->get_shortcode_att('title_txt') );
        $res_ctx->load_settings_raw( 'title_txt_hover', $res_ctx->get_shortcode_att('title_txt_hover') );
        $res_ctx->load_settings_raw( 'title_txt2', $res_ctx->get_shortcode_att('title_txt2') );
        $res_ctx->load_settings_raw( 'title_txt_hover2', $res_ctx->get_shortcode_att('title_txt_hover2') );

        $res_ctx->load_settings_raw( 'cat_bg', $res_ctx->get_shortcode_att('cat_bg') );
        $res_ctx->load_settings_raw( 'cat_bg2', $res_ctx->get_shortcode_att('cat_bg2') );
        $res_ctx->load_settings_raw( 'cat_txt', $res_ctx->get_shortcode_att('cat_txt') );
        $res_ctx->load_settings_raw( 'cat_txt2', $res_ctx->get_shortcode_att('cat_txt2') );
        $res_ctx->load_settings_raw( 'cat_bg_hover', $res_ctx->get_shortcode_att('cat_bg_hover') );
        $res_ctx->load_settings_raw( 'cat_bg_hover2', $res_ctx->get_shortcode_att('cat_bg_hover2') );
        $res_ctx->load_settings_raw( 'cat_txt_hover', $res_ctx->get_shortcode_att('cat_txt_hover') );
        $res_ctx->load_settings_raw( 'cat_txt_hover2', $res_ctx->get_shortcode_att('cat_txt_hover2') );

        $res_ctx->load_settings_raw( 'author_txt', $res_ctx->get_shortcode_att('author_txt') );
        $res_ctx->load_settings_raw( 'author_txt2', $res_ctx->get_shortcode_att('author_txt2') );
        $res_ctx->load_settings_raw( 'author_txt_hover', $res_ctx->get_shortcode_att('author_txt_hover') );
        $res_ctx->load_settings_raw( 'author_txt_hover2', $res_ctx->get_shortcode_att('author_txt_hover2') );

        $res_ctx->load_settings_raw( 'date_txt', $res_ctx->get_shortcode_att('date_txt') );
        $res_ctx->load_settings_raw( 'date_txt2', $res_ctx->get_shortcode_att('date_txt2') );

        $res_ctx->load_settings_raw( 'ex_txt', $res_ctx->get_shortcode_att('ex_txt') );
        $res_ctx->load_settings_raw( 'ex_txt2', $res_ctx->get_shortcode_att('ex_txt') );

        $res_ctx->load_settings_raw( 'com_bg', $res_ctx->get_shortcode_att('com_bg') );
        $res_ctx->load_settings_raw( 'com_bg2', $res_ctx->get_shortcode_att('com_bg2') );
        $res_ctx->load_settings_raw( 'com_txt', $res_ctx->get_shortcode_att('com_txt') );
        $res_ctx->load_settings_raw( 'com_txt2', $res_ctx->get_shortcode_att('com_txt2') );

        $res_ctx->load_settings_raw( 'pag_text', $res_ctx->get_shortcode_att('pag_text') );
        $res_ctx->load_settings_raw( 'pag_bg', $res_ctx->get_shortcode_att('pag_bg') );
        $res_ctx->load_settings_raw( 'pag_border', $res_ctx->get_shortcode_att('pag_border') );
        $res_ctx->load_settings_raw( 'pag_h_text', $res_ctx->get_shortcode_att('pag_h_text') );
        $res_ctx->load_settings_raw( 'pag_h_bg', $res_ctx->get_shortcode_att('pag_h_bg') );
        $res_ctx->load_settings_raw( 'pag_h_border', $res_ctx->get_shortcode_att('pag_h_border') );

        // shadow
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.08)', 'shadow' );


	    // fonts
	    $res_ctx->load_font_settings( 'f_header' );
	    $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );
        $res_ctx->load_font_settings( 'f_title1' );
        $res_ctx->load_font_settings( 'f_cat1' );
        $res_ctx->load_font_settings( 'f_meta1' );
        $res_ctx->load_font_settings( 'f_ex1' );
        $res_ctx->load_font_settings( 'f_title2' );
        $res_ctx->load_font_settings( 'f_cat2' );
        $res_ctx->load_font_settings( 'f_meta2' );
        $res_ctx->load_font_settings( 'f_ex2' );

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
            
                /* @columns */
				@media (min-width: 767px) {
                    .$unique_block_class .td_module_wrap {
                        width: @columns;
                        float: left;
                    }
                }
				/* @clearfix */
				@media (min-width: 767px) {
                    .$unique_block_class .td_module_wrap:nth-child(@clearfix) {
                        clear: both;
                    }
                }
				
            
                /* @columns_gap */
				.$unique_block_class .td_module_wrap {
					padding-left: @columns_gap;
					padding-right: @columns_gap;
				}
				.$unique_block_class .td_block_inner {
					margin-left: -@columns_gap;
					margin-right: -@columns_gap;
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
            
            
				/* @modules_space1 */
				.$unique_block_class .td_module_flex_1 {
					padding-bottom: @modules_space1;
					margin-bottom: @modules_space1;
				}
				.$unique_block_class .td_module_flex_1 .td-module-container:before {
					bottom: -@modules_space1;
				}
				/* @modules_space2 */
				.$unique_block_class .td_module_flex_4 {
					padding-bottom: @modules_space2;
					margin-bottom: @modules_space2;
				}
				.$unique_block_class .td_module_flex_4 .td-module-container:before {
					bottom: -@modules_space2;
				}
				.$unique_block_class .td_module_wrap:last-child {
				    margin-bottom: 0 !important;
					padding-bottom: 0 !important;
				}
				.$unique_block_class .td_module_wrap:last-child .td-module-container:before {
				    display: none;
				}
				/* @modules_no_padding1 */
				@media (min-width: 767px) {
                    .$unique_block_class .td_module_wrap:nth-last-child(2) {
                        margin-bottom: 0 !important;
                        padding-bottom: 0 !important;
                    }
                    .$unique_block_class .td_module_wrap:nth-last-child(2) .td-module-container:before {
                        display: none;
                    }
                }
				/* @modules_no_padding2 */
				@media (min-width: 767px) {
                    .$unique_block_class .td_module_wrap:nth-last-child(-n+3) {
                        margin-bottom: 0 !important;
                        padding-bottom: 0 !important;
                    }
                    .$unique_block_class .td_module_wrap:nth-last-child(-n+3) .td-module-container:before {
                        display: none;
                    }
                }
				/* @modules_no_padding3 */
				@media (min-width: 767px) {
                    .$unique_block_class .td_module_wrap:nth-last-child(-n+4) {
                        margin-bottom: 0 !important;
                        padding-bottom: 0 !important;
                    }
                    .$unique_block_class .td_module_wrap:nth-last-child(-n+4) .td-module-container:before {
                        display: none;
                    }
                }
				/* @modules_no_padding4 */
				@media (min-width: 767px) {
                    .$unique_block_class .td_module_wrap:nth-last-child(-n+5) {
                        margin-bottom: 0 !important;
                        padding-bottom: 0 !important;
                    }
                    .$unique_block_class .td_module_wrap:nth-last-child(-n+5) .td-module-container:before {
                        display: none;
                    }
                }
				/* @modules_divider1 */
				.$unique_block_class .td_module_flex_1 .td-module-container:before {
					border-width: 0 0 1px 0;
					border-style: @modules_divider1;
					border-color: #eaeaea;
				}
				/* @modules_divider2 */
				.$unique_block_class .td_module_flex_4 .td-module-container:before {
					border-width: 0 0 1px 0;
					border-style: @modules_divider2;
					border-color: #eaeaea;
				}
				/* @modules_divider_color1 */
				.$unique_block_class .td_module_flex_1 .td-module-container:before {
					border-color: @modules_divider_color1;
				}
				/* @modules_divider_color2 */
				.$unique_block_class .td_module_flex_4 .td-module-container:before {
					border-color: @modules_divider_color2;
				}
				


				/* @image_alignment1 */
				.$unique_block_class .td_module_flex_1 .entry-thumb {
					background-position: center @image_alignment1;
				}
				/* @image_alignment2 */
				.$unique_block_class .td_module_flex_4 .entry-thumb {
					background-position: center @image_alignment2;
				}

				/* @image_width2 */
				.$unique_block_class .td_module_flex_4 .td-image-container {
				 	flex: 0 0 @image_width2;
				 	width: @image_width2;
			    }
			    
			    /* @image_height1 */
				.$unique_block_class .td_module_flex_1 .td-image-wrap {
					padding-bottom: @image_height1;
				}
				.ie10 .$unique_block_class .td_module_flex_1 .td-image-container,
				.ie11 .$unique_block_class .td_module_flex_1 .td-image-container {
				 	flex: 0 0 auto;
			    }
			    /* @image_height2 */
				.$unique_block_class .td_module_flex_4 .td-image-wrap {
					padding-bottom: @image_height2;
				}
				.ie10 .$unique_block_class .td_module_flex_4 .td-image-container,
				.ie11 .$unique_block_class .td_module_flex_4 .td-image-container {
				 	flex: 0 0 auto;
			    }
			    
			    /* @image_radius1 */
				.$unique_block_class .td_module_flex_1 .entry-thumb {
					border-radius: @image_radius1;
				}
			    /* @image_radius2 */
				.$unique_block_class .td_module_flex_4 .entry-thumb {
					border-radius: @image_radius2;
				}
				
				/* @meta_info_align1 */
				.$unique_block_class .td_module_flex_1 .td-module-container {
					align-items: @meta_info_align1;
				}
				/* @meta_info_align_top1 */
				.$unique_block_class .td_module_flex_1 .td-image-container {
					order: 1;
				}
				/* @meta_info_align_image1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					position: absolute;
					bottom: 0;
					left: 0;
					width: 100%;
				}
				/* @align_category_top1 */
				.$unique_block_class .td_module_flex_1 .td-category-pos-image .td-post-category {
					top: 0;
					bottom: auto;
				}
				
				/* @meta_horiz_align_center1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					text-align: center;
				}
				.$unique_block_class .td_module_flex_1 .td-image-container {
					margin-left: auto;
                    margin-right: auto;
				}
				.$unique_block_class .td_module_flex_1 .td-category-pos-image .td-post-category {
					left: 50%;
					transform: translateX(-50%);
					-webkit-transform: translateX(-50%);
				}
				.$unique_block_class.td-h-effect-up-shadow .td_module_flex_1:hover .td-category-pos-image .td-post-category {
				    transform: translate(-50%, -2px);
					-webkit-transform: translate(-50%, -2px);
				}
				/* @meta_horiz_align_right1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					text-align: right;
				}
				/* @meta_horiz_align_center2 */
				.$unique_block_class .td_module_flex_4 .td-module-meta-info {
					text-align: center;
				}
				.$unique_block_class .td_module_flex_4 .td-image-container {
					margin-left: auto;
                    margin-right: auto;
				}
				.$unique_block_class .td_module_flex_4 .td-category-pos-image .td-post-category {
					left: 50%;
					transform: translateX(-50%);
					-webkit-transform: translateX(-50%);
				}
				.$unique_block_class.td-h-effect-up-shadow .td_module_flex_4:hover .td-category-pos-image .td-post-category {
				    transform: translate(-50%, -2px);
					-webkit-transform: translate(-50%, -2px);
				}
				/* @meta_horiz_align_right1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					text-align: right;
				}
				/* @meta_horiz_align_right2 */
				.$unique_block_class .td_module_flex_4 .td-module-meta-info {
					text-align: right;
				}
				
				/* @meta_width1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					max-width: @meta_width1;
				}
				/* @meta_width2 */
				.$unique_block_class .td_module_flex_4 .td-module-meta-info {
					max-width: @meta_width2;
				}
				
				/* @meta_margin1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					margin: @meta_margin1;
				}
				/* @meta_margin2 */
				.$unique_block_class .td_module_flex_4 .td-module-meta-info {
					margin: @meta_margin2;
				}
				
				/* @meta_padding1 */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					padding: @meta_padding1;
				}
				/* @meta_padding2 */
				.$unique_block_class .td_module_flex_4 .td-module-meta-info {
					padding: @meta_padding2;
				}
				
				/* @art_title1 */
				.$unique_block_class .td_module_flex_1 .entry-title {
					margin: @art_title1;
				}
				/* @art_title2 */
				.$unique_block_class .td_module_flex_4 .entry-title {
					margin: @art_title2;
				}
				
				/* @art_excerpt1 */
				.$unique_block_class .td_module_flex_1 .td-excerpt {
					margin: @art_excerpt1;
				}
				/* @art_excerpt2 */
				.$unique_block_class .td_module_flex_4 .td-excerpt {
					margin: @art_excerpt2;
				}
				
				/* @modules_category_margin1 */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					margin: @modules_category_margin1;
				}
				/* @modules_category_margin2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					margin: @modules_category_margin2;
				}
				
				/* @modules_category_padding1 */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					padding: @modules_category_padding1;
				}
				/* @modules_category_padding2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					padding: @modules_category_padding2;
				}
				
				/* @modules_category_radius1 */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					border-radius: @modules_category_radius1;
				}
				/* @modules_category_radius2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					border-radius: @modules_category_radius2;
				}
				
				/* @author_photo_size1 */
				.$unique_block_class .td_module_flex_1 .td-author-photo .avatar {
				    width: @author_photo_size1;
				    height: @author_photo_size1;
				}
				/* @author_photo_size2 */
				.$unique_block_class .td_module_flex_4 .td-author-photo .avatar {
				    width: @author_photo_size2;
				    height: @author_photo_size2;
				}
				
				/* @author_photo_space1 */
				.$unique_block_class .td_module_flex_1 .td-author-photo .avatar {
				    margin-right: @author_photo_space1;
				}
				/* @author_photo_space2 */
				.$unique_block_class .td_module_flex_4 .td-author-photo .avatar {
				    margin-right: @author_photo_space2;
				}
				
				/* @author_photo_radius1 */
				.$unique_block_class .td_module_flex_1 .td-author-photo .avatar {
				    border-radius: @author_photo_radius1;
				}
				/* @author_photo_radius2 */
				.$unique_block_class .td_module_flex_4 .td-author-photo .avatar {
				    border-radius: @author_photo_radius2;
				}
				
				/* @show_cat1 */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					display: @show_cat1;
				}
				/* @show_cat2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					display: @show_cat2;
				}
				
				/* @show_excerpt1 */
				.$unique_block_class .td_module_flex_1 .td-excerpt {
					display: @show_excerpt1;
				}
				/* @show_excerpt2 */
				.$unique_block_class .td_module_flex_4 .td-excerpt {
					display: @show_excerpt2;
				}
				
				/* @hide_author_date1 */
				.$unique_block_class .td_module_flex_1 .td-author-date {
					display: none;
				}
				/* @hide_author_date2 */
				.$unique_block_class .td_module_flex_4 .td-author-date {
					display: none;
				}
				
				/* @show_author1 */
				.$unique_block_class .td_module_flex_1 .td-post-author-name {
					display: @show_author1;
				}
				/* @show_author2 */
				.$unique_block_class .td_module_flex_4 .td-post-author-name {
					display: @show_author2;
				}
				
				/* @show_date1 */
				.$unique_block_class .td_module_flex_1 .td-post-date,
				.$unique_block_class .td_module_flex_1 .td-post-author-name span {
					display: @show_date1;
				}
				/* @show_date2 */
				.$unique_block_class .td_module_flex_4 .td-post-date,
				.$unique_block_class .td_module_flex_4 .td-post-author-name span {
					display: @show_date2;
				}
				
				/* @show_review1 */
				.$unique_block_class .td_module_flex_1 .entry-review-stars {
					display: @show_review1;
				}
				/* @show_review2 */
				.$unique_block_class .td_module_flex_4 .entry-review-stars {
					display: @show_review2;
				}
				
				/* @show_com1 */
				.$unique_block_class .td_module_flex_1 .td-module-comments {
					display: @show_com1;
				}
				/* @show_com2 */
				.$unique_block_class .td_module_flex_4 .td-module-comments {
					display: @show_com2;
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
				
				/* @align_category_bottom */
				.$unique_block_class .td-category-pos-image .td-post-category {
					top: auto;
				 	bottom: 0;
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
				
				
				/* @shadow */
				.$unique_block_class .td-module-container {
				    box-shadow: @shadow;
				}
				/* @meta_bg */
				.$unique_block_class .td_module_flex_1 .td-module-meta-info {
					background-color: @meta_bg;
				}
				/* @meta_bg2 */
				.$unique_block_class .td_module_flex_4 .td-module-meta-info {
					background-color: @meta_bg2;
				}
				
				/* @overlay */
				.$unique_block_class .td_module_flex_1 .td-module-thumb a:after {
				    content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					background: @overlay;
				}
				/* @overlay_gradient */
				.$unique_block_class .td_module_flex_1 .td-module-thumb a:after {
				    content: '';
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
					@overlay_gradient
				}
				
				/* @title_txt */
				.$unique_block_class .td_module_flex_1 .td-module-title a {
					color: @title_txt;
				}
				/* @title_txt_hover */
				.$unique_block_class .td_module_flex_1:hover .td-module-title a {
					color: @title_txt_hover !important;
				}
				/* @title_txt2 */
				.$unique_block_class .td_module_flex_4 .td-module-title a {
					color: @title_txt2;
				}
				/* @title_txt_hover */
				.$unique_block_class .td_module_flex_4:hover .td-module-title a {
					color: @title_txt_hover2 !important;
				}
				
				/* @cat_bg */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					background-color: @cat_bg;
				}
				/* @cat_bg2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					background-color: @cat_bg2;
				}
				/* @cat_bg_hover */
				.$unique_block_class .td_module_flex_1 .td-post-category:hover {
					background-color: @cat_bg_hover !important;
				}
				/* @cat_bg_hover2 */
				.$unique_block_class .td_module_flex_4 .td-post-category:hover {
					background-color: @cat_bg_hover2 !important;
				}
				/* @cat_txt */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					color: @cat_txt;
				}
				/* @cat_txt2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					color: @cat_txt2;
				}
				/* @cat_txt_hover */
				.$unique_block_class .td_module_flex_1 .td-post-category:hover {
					color: @cat_txt_hover;
				}
				/* @cat_txt_hover2 */
				.$unique_block_class .td_module_flex_4 .td-post-category:hover {
					color: @cat_txt_hover2;
				}
				
				/* @author_txt */
				.$unique_block_class .td_module_flex_1 .td-post-author-name a {
					color: @author_txt;
				}
				/* @author_txt2 */
				.$unique_block_class .td_module_flex_4 .td-post-author-name a {
					color: @author_txt2;
				}
				/* @author_txt_hover */
				.$unique_block_class .td_module_flex_1 .td-post-author-name:hover a {
					color: @author_txt_hover;
				}
				/* @author_txt_hover2 */
				.$unique_block_class .td_module_flex_4 .td-post-author-name:hover a {
					color: @author_txt_hover2;
				}
				
				/* @date_txt */
				.$unique_block_class .td_module_flex_1 .td-post-date,
				.$unique_block_class .td_module_flex_1 .td-post-author-name span {
					color: @date_txt;
				}
				/* @date_txt2 */
				.$unique_block_class .td_module_flex_4 .td-post-date,
				.$unique_block_class .td_module_flex_4 .td-post-author-name span {
					color: @date_txt2;
				}
				
				/* @ex_txt */
				.$unique_block_class .td_module_flex_1 .td-excerpt {
					color: @ex_txt;
				}
				/* @ex_txt2 */
				.$unique_block_class .td_module_flex_4 .td-excerpt {
					color: @ex_txt2;
				}
				
				/* @com_bg */
				.$unique_block_class .td_module_flex_1 .td-module-comments a {
					background-color: @com_bg;
				}
				.$unique_block_class .td_module_flex_1 .td-module-comments a:after {
					border-color: @com_bg transparent transparent transparent;
				}
				/* @com_bg2 */
				.$unique_block_class .td_module_flex_4 .td-module-comments a {
					background-color: @com_bg2;
				}
				.$unique_block_class .td_module_flex_4 .td-module-comments a:after {
					border-color: @com_bg2 transparent transparent transparent;
				}
				/* @com_txt */
				.$unique_block_class .td_module_flex_1 .td-module-comments a {
					color: @com_txt;
				}
				/* @com_txt2 */
				.$unique_block_class .td_module_flex_4 .td-module-comments a {
					color: @com_txt2;
				}
				
				
				/* @pag_text */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a,
				.$unique_block_class .td-load-more-wrap a {
					color: @pag_text;
				}
				/* @pag_bg */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a,
				.$unique_block_class .td-load-more-wrap a {    
					background-color: @pag_bg;
				}
				/* @pag_border */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a,
				.$unique_block_class .td-load-more-wrap a {
					border-color: @pag_border;
				}
				/* @pag_h_text */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover,
				.$unique_block_class .td-load-more-wrap a:hover {
					color: @pag_h_text;
				}
				/* @pag_h_bg */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover,
				.$unique_block_class .td-load-more-wrap a:hover {    
					background-color: @pag_h_bg !important;
					border-color: @pag_h_bg !important;
				}
				/* @pag_h_border */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover,
				.$unique_block_class .td-load-more-wrap a:hover {
					border-color: @pag_h_border !important;
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
				/* @f_title1 */
				.$unique_block_class .td_module_flex_1 .entry-title {
					@f_title1
				}
				/* @f_cat1 */
				.$unique_block_class .td_module_flex_1 .td-post-category {
					@f_cat1
				}
				/* @f_meta1 */
				.$unique_block_class .td_module_flex_1 .td-editor-date,
				.$unique_block_class .td_module_flex_1 .td-editor-date .td-post-author-name,
				.$unique_block_class .td_module_flex_1 .td-module-comments a {
					@f_meta1
				}
				/* @f_ex1 */
				.$unique_block_class .td_module_flex_1 .td-excerpt {
					@f_ex1
				}
				/* @f_title2 */
				.$unique_block_class .td_module_flex_4 .entry-title {
					@f_title2
				}
				/* @f_cat2 */
				.$unique_block_class .td_module_flex_4 .td-post-category {
					@f_cat2
				}
				/* @f_meta2 */
				.$unique_block_class .td_module_flex_4 .td-editor-date,
				.$unique_block_class .td_module_flex_4 .td-editor-date .td-post-author-name,
				.$unique_block_class .td_module_flex_4 .td-module-comments a {
					@f_meta2
				}
				/* @f_ex2 */
				.$unique_block_class .td_module_flex_4 .td-excerpt {
					@f_ex2
				}
				/* @f_more */
				.$unique_block_class .td-load-more-wrap a {
					@f_more
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

        // hover effect
        $h_effect = $this->get_att('h_effect');
        if( $h_effect != '' ) {
            $additional_classes[] = 'td-h-effect-' . $h_effect;
        }

        $td_column_number = $this->get_att('td_column_number');

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . ' td_flex_block" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

		    //get the js for this block
		    $buffy .= $this->get_block_js();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title(); //get the block title
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-mc1-wrap">';
	                $buffy .= $this->inner($this->td_query->posts, $td_column_number);//inner content of the block
            $buffy .= '</div>';

            //get the ajax pagination for this block
            $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';
        $td_block_layout = new td_block_layout();

        $columns = $this->get_att('columns');

        $td_post_count = 0;

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $td_module_flex_1 = new td_module_flex_1($post, $this->get_all_atts());
                $td_module_flex_4 = new td_module_flex_4($post, $this->get_all_atts());

                switch ($columns) {
                    case '100%':
                        if ($td_post_count == 0) {
                            $buffy .= $td_module_flex_1->render($post);
                        }
                        if ($td_post_count > 0) {
                            $buffy .= $td_module_flex_4->render($post);
                        }
                        break;
                    case '50%':
                        if ($td_post_count <= 1) {
                            $buffy .= $td_module_flex_1->render($post);
                        }
                        if ($td_post_count > 1) {
                            $buffy .= $td_module_flex_4->render($post);
                        }
                        break;
                    case '33.33333333%':
                        if ($td_post_count <= 2) {
                            $buffy .= $td_module_flex_1->render($post);
                        }
                        if ($td_post_count > 2) {
                            $buffy .= $td_module_flex_4->render($post);
                        }
                        break;
                    case '25%':
                        if ($td_post_count <= 3) {
                            $buffy .= $td_module_flex_1->render($post);
                        }
                        if ($td_post_count > 3) {
                            $buffy .= $td_module_flex_4->render($post);
                        }
                        break;
                    case '20%':
                        if ($td_post_count <= 4) {
                            $buffy .= $td_module_flex_1->render($post);
                        }
                        if ($td_post_count > 4) {
                            $buffy .= $td_module_flex_4->render($post);
                        }
                        break;
                }

                $td_post_count++;
            }
        }
        $buffy .= $td_block_layout->close_all_tags();

        return $buffy;
    }
}