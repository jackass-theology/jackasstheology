<?php

/**
 * Class tdb_category_grid
 */

class tdb_category_grid_5 extends td_block {

    const POST_LIMIT = 4;

    static function cssMedia( $res_ctx ) {

        // modules gap
        $modules_gap = $res_ctx->get_shortcode_att('modules_gap');
        $res_ctx->load_settings_raw( 'modules_gap', $modules_gap );
        $res_ctx->load_settings_raw( 'modules_gap_mob', $modules_gap );
        if ( $modules_gap == '' ) {
            $res_ctx->load_settings_raw( 'modules_gap', '2px');
            $res_ctx->load_settings_raw( 'modules_gap_mob', '4px');
        } else if ( is_numeric( $modules_gap ) ) {
            $res_ctx->load_settings_raw( 'modules_gap', $modules_gap / 2 .'px' );
            $res_ctx->load_settings_raw( 'modules_gap_mob', $modules_gap .'px' );
        }

        // meta info horizontal align
        $meta_info_horiz = $res_ctx->get_shortcode_att('meta_info_horiz');
        if( $meta_info_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_info_horiz_center', 1 );
        }
        if( $meta_info_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_info_horiz_right', 1 );
        }

        // meta info vertical align
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

        // image alignment 1
        $res_ctx->load_settings_raw( 'image_alignment1', $res_ctx->get_shortcode_att('image_alignment1') . '%' );
        // image alignment 2
        $res_ctx->load_settings_raw( 'image_alignment2', $res_ctx->get_shortcode_att('image_alignment2') . '%' );
        // image alignment 3
        $res_ctx->load_settings_raw( 'image_alignment3', $res_ctx->get_shortcode_att('image_alignment3') . '%' );

        // image height 1
        $image_height1 = $res_ctx->get_shortcode_att('image_height1');
        if ( is_numeric( $image_height1 ) ) {
            $res_ctx->load_settings_raw( 'image_height1', $image_height1 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height1', $image_height1 );
        }
        // image height 2
        $image_height2 = $res_ctx->get_shortcode_att('image_height2');
        if ( is_numeric( $image_height2 ) ) {
            $res_ctx->load_settings_raw( 'image_height2', $image_height2 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height2', $image_height2 );
        }
        // image height 3
        $image_height3 = $res_ctx->get_shortcode_att('image_height3');
        if ( is_numeric( $image_height3 ) ) {
            $res_ctx->load_settings_raw( 'image_height3', $image_height3 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height3', $image_height3 );
        }

        // image width 1
        $image_width1 = $res_ctx->get_shortcode_att('image_width1');
        if ( is_numeric( $image_width1 ) ) {
            $res_ctx->load_settings_raw( 'image_width1', $image_width1 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_width1', $image_width1 );
        }
        // image width 2
        $image_width2 = $res_ctx->get_shortcode_att('image_width2');
        if ( is_numeric( $image_width2 ) ) {
            $res_ctx->load_settings_raw( 'image_width2', $image_width2 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_width2', $image_width2 );
        }
        // image width 3
        $image_width3 = $res_ctx->get_shortcode_att('image_width3');
        if ( is_numeric( $image_width3 ) ) {
            $res_ctx->load_settings_raw( 'image_width3', $image_width3 . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_width3', $image_width3 );
        }

        // image zoom effect on hover
        $res_ctx->load_settings_raw( 'image_zoom', $res_ctx->get_shortcode_att('image_zoom') );

        // meta info width 1
        $meta_info_width1 = $res_ctx->get_shortcode_att('meta_width1');
        $res_ctx->load_settings_raw( 'meta_width1', $meta_info_width1 );
        if( $meta_info_width1 != '' && is_numeric( $meta_info_width1 ) ) {
            $res_ctx->load_settings_raw( 'meta_width1', $meta_info_width1 . 'px' );
        }
        // meta info width 2
        $meta_info_width2 = $res_ctx->get_shortcode_att('meta_width2');
        $res_ctx->load_settings_raw( 'meta_width2', $meta_info_width2 );
        if( $meta_info_width2 != '' && is_numeric( $meta_info_width2 ) ) {
            $res_ctx->load_settings_raw( 'meta_width2', $meta_info_width2 . 'px' );
        }
        // meta info width 3
        $meta_info_width3 = $res_ctx->get_shortcode_att('meta_width3');
        $res_ctx->load_settings_raw( 'meta_width3', $meta_info_width3 );
        if( $meta_info_width3 != '' && is_numeric( $meta_info_width3 ) ) {
            $res_ctx->load_settings_raw( 'meta_width3', $meta_info_width3 . 'px' );
        }

        // meta info margin 1
        $meta_margin1 = $res_ctx->get_shortcode_att('meta_margin1');
        $res_ctx->load_settings_raw( 'meta_margin1', $meta_margin1 );
        if ( is_numeric( $meta_margin1 ) ) {
            $res_ctx->load_settings_raw( 'meta_margin1', $meta_margin1 . 'px' );
        }
        // meta info margin 2
        $meta_margin2 = $res_ctx->get_shortcode_att('meta_margin2');
        $res_ctx->load_settings_raw( 'meta_margin2', $meta_margin2 );
        if ( is_numeric( $meta_margin2 ) ) {
            $res_ctx->load_settings_raw( 'meta_margin2', $meta_margin2 . 'px' );
        }
        // meta info margin 3
        $meta_margin3 = $res_ctx->get_shortcode_att('meta_margin3');
        $res_ctx->load_settings_raw( 'meta_margin3', $meta_margin3 );
        if ( is_numeric( $meta_margin3 ) ) {
            $res_ctx->load_settings_raw( 'meta_margin3', $meta_margin3 . 'px' );
        }

        // meta info padding 1
        $meta_padding1 = $res_ctx->get_shortcode_att('meta_padding1');
        $res_ctx->load_settings_raw( 'meta_padding1', $meta_padding1 );
        if ( is_numeric( $meta_padding1 ) ) {
            $res_ctx->load_settings_raw( 'meta_padding1', $meta_padding1 . 'px' );
        }
        // meta info padding 2
        $meta_padding2 = $res_ctx->get_shortcode_att('meta_padding2');
        $res_ctx->load_settings_raw( 'meta_padding2', $meta_padding2 );
        if ( is_numeric( $meta_padding2 ) ) {
            $res_ctx->load_settings_raw( 'meta_padding2', $meta_padding2 . 'px' );
        }
        // meta info padding 3
        $meta_padding3 = $res_ctx->get_shortcode_att('meta_padding3');
        $res_ctx->load_settings_raw( 'meta_padding3', $meta_padding3 );
        if ( is_numeric( $meta_padding3 ) ) {
            $res_ctx->load_settings_raw( 'meta_padding3', $meta_padding3 . 'px' );
        }

        // article title space 1
        $art_title1 = $res_ctx->get_shortcode_att('art_title1');
        $res_ctx->load_settings_raw( 'art_title1', $art_title1 );
        if ( is_numeric( $art_title1 ) ) {
            $res_ctx->load_settings_raw( 'art_title1', $art_title1 . 'px' );
        }
        // article title space 2
        $art_title2 = $res_ctx->get_shortcode_att('art_title2');
        $res_ctx->load_settings_raw( 'art_title2', $art_title2 );
        if ( is_numeric( $art_title2 ) ) {
            $res_ctx->load_settings_raw( 'art_title2', $art_title2 . 'px' );
        }
        // article title space 3
        $art_title3 = $res_ctx->get_shortcode_att('art_title3');
        $res_ctx->load_settings_raw( 'art_title3', $art_title3 );
        if ( is_numeric( $art_title3 ) ) {
            $res_ctx->load_settings_raw( 'art_title3', $art_title3 . 'px' );
        }

        // article title padding 1
        $art_title_padd1 = $res_ctx->get_shortcode_att('art_title_padd1');
        $res_ctx->load_settings_raw( 'art_title_padd1', $art_title_padd1 );
        if ( is_numeric( $art_title_padd1 ) ) {
            $res_ctx->load_settings_raw( 'art_title_padd1', $art_title_padd1 . 'px' );
        }
        // article title padding 2
        $art_title_padd2 = $res_ctx->get_shortcode_att('art_title_padd2');
        $res_ctx->load_settings_raw( 'art_title_padd2', $art_title_padd2 );
        if ( is_numeric( $art_title_padd2 ) ) {
            $res_ctx->load_settings_raw( 'art_title_padd2', $art_title_padd2 . 'px' );
        }
        // article title padding 3
        $art_title_padd3 = $res_ctx->get_shortcode_att('art_title_padd3');
        $res_ctx->load_settings_raw( 'art_title_padd3', $art_title_padd3 );
        if ( is_numeric( $art_title_padd3 ) ) {
            $res_ctx->load_settings_raw( 'art_title_padd3', $art_title_padd3 . 'px' );
        }

        // author & date padding 1
        $auth_date_padd1 = $res_ctx->get_shortcode_att('auth_date_padding1');
        $res_ctx->load_settings_raw( 'auth_date_padding1', $auth_date_padd1 );
        if ( is_numeric( $auth_date_padd1 ) ) {
            $res_ctx->load_settings_raw( 'auth_date_padding1', $auth_date_padd1 . 'px' );
        }
        // author & date padding 2
        $auth_date_padd2 = $res_ctx->get_shortcode_att('auth_date_padding2');
        $res_ctx->load_settings_raw( 'auth_date_padding2', $auth_date_padd2 );
        if ( is_numeric( $auth_date_padd2 ) ) {
            $res_ctx->load_settings_raw( 'auth_date_padding2', $auth_date_padd2 . 'px' );
        }
        // author & date padding 3
        $auth_date_padd3 = $res_ctx->get_shortcode_att('auth_date_padding3');
        $res_ctx->load_settings_raw( 'auth_date_padding3', $auth_date_padd3 );
        if ( is_numeric( $auth_date_padd3 ) ) {
            $res_ctx->load_settings_raw( 'auth_date_padding3', $auth_date_padd3 . 'px' );
        }

        // category tag margin 1
        $modules_category_margin1 = $res_ctx->get_shortcode_att('modules_category_margin1');
        $res_ctx->load_settings_raw( 'modules_category_margin1', $modules_category_margin1 );
        if( $modules_category_margin1 != '' ) {
            if( is_numeric( $modules_category_margin1 ) ) {
                $res_ctx->load_settings_raw( 'modules_category_margin1', $modules_category_margin1 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'modules_category_margin1', '0 0 5px' );
        }
        // category tag margin 2
        $modules_category_margin2 = $res_ctx->get_shortcode_att('modules_category_margin2');
        $res_ctx->load_settings_raw( 'modules_category_margin2', $modules_category_margin2 );
        if( $modules_category_margin2 != '' ) {
            if( is_numeric( $modules_category_margin2 ) ) {
                $res_ctx->load_settings_raw( 'modules_category_margin2', $modules_category_margin2 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'modules_category_margin2', '0 0 5px' );
        }
        // category tag margin 3
        $modules_category_margin3 = $res_ctx->get_shortcode_att('modules_category_margin3');
        $res_ctx->load_settings_raw( 'modules_category_margin3', $modules_category_margin3 );
        if( $modules_category_margin3 != '' ) {
            if( is_numeric( $modules_category_margin3 ) ) {
                $res_ctx->load_settings_raw( 'modules_category_margin3', $modules_category_margin3 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'modules_category_margin3', '0 0 7px' );
        }

        // category tag padding 1
        $modules_category_padding1 = $res_ctx->get_shortcode_att('modules_category_padding1');
        $res_ctx->load_settings_raw( 'modules_category_padding1', $modules_category_padding1 );
        if( $modules_category_padding1 != '' && is_numeric( $modules_category_padding1 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding1', $modules_category_padding1 . 'px' );
        }
        // category tag padding 2
        $modules_category_padding2 = $res_ctx->get_shortcode_att('modules_category_padding2');
        $res_ctx->load_settings_raw( 'modules_category_padding2', $modules_category_padding2 );
        if( $modules_category_padding2 != '' && is_numeric( $modules_category_padding2 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding2', $modules_category_padding2 . 'px' );
        }
        // category tag padding 3
        $modules_category_padding3 = $res_ctx->get_shortcode_att('modules_category_padding3');
        $res_ctx->load_settings_raw( 'modules_category_padding3', $modules_category_padding3 );
        if( $modules_category_padding3 != '' && is_numeric( $modules_category_padding3 ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding3', $modules_category_padding3 . 'px' );
        }

        // show meta info details
        $res_ctx->load_settings_raw( 'show_cat1', $res_ctx->get_shortcode_att('show_cat1') );
        $res_ctx->load_settings_raw( 'show_cat2', $res_ctx->get_shortcode_att('show_cat2') );
        $res_ctx->load_settings_raw( 'show_cat3', $res_ctx->get_shortcode_att('show_cat3') );

        $show_author1 = $res_ctx->get_shortcode_att('show_author1');
        $show_date1 = $res_ctx->get_shortcode_att('show_date1');
        if( $show_author1 == 'none' && $show_date1 == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date1', 'none' );
        } else {
            $res_ctx->load_settings_raw( 'hide_author_date1', 'inline-block' );
        }
        $res_ctx->load_settings_raw( 'show_author1', $show_author1 );
        $res_ctx->load_settings_raw( 'show_date1', $show_date1 );

        $show_author2 = $res_ctx->get_shortcode_att('show_author2');
        $show_date2 = $res_ctx->get_shortcode_att('show_date2');
        if( $show_author2 == 'none' && $show_date2 == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date2', 'none' );
        } else {
            $res_ctx->load_settings_raw( 'hide_author_date2', 'inline-block' );
        }
        $res_ctx->load_settings_raw( 'show_author2', $show_author2 );
        $res_ctx->load_settings_raw( 'show_date2', $show_date2 );

        $show_author3 = $res_ctx->get_shortcode_att('show_author3');
        $show_date3 = $res_ctx->get_shortcode_att('show_date3');
        if( $show_author3 == 'none' && $show_date3 == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date3', 1 );
        }
        $res_ctx->load_settings_raw( 'show_author3', $show_author3 );
        $res_ctx->load_settings_raw( 'show_date3', $show_date3 );


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


        // fonts
        $res_ctx->load_font_settings( 'f_title1' );
        $res_ctx->load_font_settings( 'f_cat1' );
        $res_ctx->load_font_settings( 'f_meta1' );
        $res_ctx->load_settings_raw( 'f_meta1_fw', $res_ctx->get_shortcode_att('f_meta1_font_weight') );
        $res_ctx->load_font_settings( 'f_title2' );
        $res_ctx->load_font_settings( 'f_cat2' );
        $res_ctx->load_font_settings( 'f_meta2' );
        $res_ctx->load_settings_raw( 'f_meta2_fw', $res_ctx->get_shortcode_att('f_meta2_font_weight') );
        $res_ctx->load_font_settings( 'f_title3' );
        $res_ctx->load_font_settings( 'f_cat3' );
        $res_ctx->load_font_settings( 'f_meta3' );
        $res_ctx->load_settings_raw( 'f_meta3_fw', $res_ctx->get_shortcode_att('f_meta3_font_weight') );


    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @modules_gap */
				@media (min-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post {
                        border-width: 0 @modules_gap;
                        border-style: solid;
                        border-color: transparent;
                    }
                    .$unique_block_class .tdb-block-inner {
                        margin-left: -@modules_gap;
                        margin-right: -@modules_gap;
                    }
                }
				/* @modules_gap_mob */
				@media (min-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post-1 {
                        margin-bottom: @modules_gap_mob;
                    }
                }
                @media (max-width: 767px) {
                    .$unique_block_class .tdb-cat-grid-post-0 {
                        margin-bottom: @modules_gap_mob;
                    }
                    .$unique_block_class .tdb-cat-grid-scroll-holder .tdb-cat-grid-post {
                        margin-right: @modules_gap_mob;
                    }
                    .$unique_block_class .tdb-cat-grid-scroll-holder .tdb-cat-grid-post:last-child {
                        margin-right: 0;
                    }
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
                
				/* @image_alignment1 */
				.$unique_block_class .tdb_module_cat_grid_1 .entry-thumb {
					background-position: center @image_alignment1;
				}
				/* @image_alignment2 */
				.$unique_block_class .tdb_module_cat_grid_2 .entry-thumb {
					background-position: center @image_alignment2;
				}
				/* @image_alignment3 */
				.$unique_block_class .tdb_module_cat_grid_3 .entry-thumb {
					background-position: center @image_alignment3;
				}
				
				/* @image_height1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-image-wrap {
					padding-bottom: @image_height1;
				}
				/* @image_height2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-image-wrap {
					padding-bottom: @image_height2;
				}
				/* @image_height3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-image-wrap {
					padding-bottom: @image_height3;
				}
				
				/* @image_width1 */
				.$unique_block_class .tdb_module_cat_grid_1 {
					width: @image_width1;
				}
				/* @image_width2 */
				.$unique_block_class .tdb_module_cat_grid_2 {
					width: @image_width2;
				}
				/* @image_width3 */
				.$unique_block_class .tdb_module_cat_grid_3 {
					width: @image_width3;
				}
				
				/* @meta_width1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-module-meta-info {
					width: @meta_width1;
				}
				/* @meta_width2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-module-meta-info {
					width: @meta_width2;
				}
				/* @meta_width3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-module-meta-info {
					width: @meta_width3;
				}
				
				/* @meta_margin1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-module-meta-info {
					margin: @meta_margin1;
				}
				/* @meta_margin2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-module-meta-info {
					margin: @meta_margin2;
				}
				/* @meta_margin3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-module-meta-info {
					margin: @meta_margin3;
				}
				
				/* @meta_padding1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-module-meta-info {
					padding: @meta_padding1;
				}
				/* @meta_padding2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-module-meta-info {
					padding: @meta_padding2;
				}
				/* @meta_padding3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-module-meta-info {
					padding: @meta_padding3;
				}
				
				/* @art_title1 */
				.$unique_block_class .tdb_module_cat_grid_1 .tdb-module-title-wrap {
					margin: @art_title1;
				}
				/* @art_title2 */
				.$unique_block_class .tdb_module_cat_grid_2 .tdb-module-title-wrap {
					margin: @art_title2;
				}
				/* @art_title3 */
				.$unique_block_class .tdb_module_cat_grid_3 .tdb-module-title-wrap {
					margin: @art_title3;
				}
				
				/* @art_title_padd1 */
				.$unique_block_class .tdb_module_cat_grid_1 .entry-title {
					padding: @art_title_padd1;
				}
				/* @art_title_padd2 */
				.$unique_block_class .tdb_module_cat_grid_2 .entry-title {
					padding: @art_title_padd2;
				}
				/* @art_title_padd3 */
				.$unique_block_class .tdb_module_cat_grid_3 .entry-title {
					padding: @art_title_padd3;
				}
				
				/* @auth_date_padding1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-editor-date {
					padding: @auth_date_padding1;
				}
				/* @auth_date_padding2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-editor-date {
					padding: @auth_date_padding2;
				}
				/* @auth_date_padding3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-editor-date {
					padding: @auth_date_padding3;
				}
				
				/* @modules_category_margin1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-category {
					margin: @modules_category_margin1;
				}
				/* @modules_category_margin2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-category {
					margin: @modules_category_margin2;
				}
				/* @modules_category_margin3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-category {
					margin: @modules_category_margin3;
				}
				
				/* @modules_category_padding1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-category {
					padding: @modules_category_padding1;
				}
				/* @modules_category_padding2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-category {
					padding: @modules_category_padding2;
				}
				/* @modules_category_padding3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-category {
					padding: @modules_category_padding3;
				}
				
				/* @show_cat1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-category {
					display: @show_cat1;
				}
				/* @show_cat2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-category {
					display: @show_cat2;
				}
				/* @show_cat3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-category {
					display: @show_cat3;
				}
				
				/* @hide_author_date1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-editor-date {
					display: @hide_author_date1;
				}
				/* @hide_author_date2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-editor-date {
					display: @hide_author_date2;
				}
				/* @hide_author_date3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-editor-date {
					display: none;
				}
				
				/* @show_author1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-author-name {
					display: @show_author1;
				}
				/* @show_author2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-author-name {
					display: @show_author2;
				}
				/* @show_author3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-author-name {
					display: @show_author3;
				}
				
				/* @show_date1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-date,
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-author-name span {
					display: @show_date1;
				}
				/* @show_date2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-date,
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-author-name span {
					display: @show_date2;
				}
				/* @show_date3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-date,
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-author-name span {
					display: @show_date3;
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
				/* @overlay_1 */
				.$unique_block_class .tdb-cat-grid-post-0 .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_1;
				}
				/* @overlay_1_gradient */
				.$unique_block_class .tdb-cat-grid-post-0 .td-image-wrap:before {
				    content: '';
				    @overlay_1_gradient
				}
				/* @overlay_2 */
				.$unique_block_class .tdb-cat-grid-post-1 .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_2;
				}
				/* @overlay_2_gradient */
				.$unique_block_class .tdb-cat-grid-post-1 .td-image-wrap:before {
				    content: '';
				    @overlay_2_gradient
				}
				/* @overlay_3 */
				.$unique_block_class .tdb-cat-grid-post-2 .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_3;
				}
				/* @overlay_3_gradient */
				.$unique_block_class .tdb-cat-grid-post-2 .td-image-wrap:before {
				    content: '';
				    @overlay_3_gradient
				}
				/* @overlay_4 */
				.$unique_block_class .tdb-cat-grid-post-3 .td-image-wrap:before {
				    content: '';
				    background-color: @overlay_4;
				}
				/* @overlay_4_gradient */
				.$unique_block_class .tdb-cat-grid-post-3 .td-image-wrap:before {
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
					-webkit-text-fill-color: initial;
					background: @title_bg;
					-webkit-box-decoration-break: clone;
					box-decoration-break: clone;
					display: inline;
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
				
			
				/* @f_title1 */
				.$unique_block_class .tdb_module_cat_grid_1 .entry-title {
					@f_title1
				}
				/* @f_title2 */
				.$unique_block_class .tdb_module_cat_grid_2 .entry-title {
					@f_title2
				}
				/* @f_title3 */
				.$unique_block_class .tdb_module_cat_grid_3 .entry-title {
					@f_title3
				}
				
				/* @f_cat1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-category {
					@f_cat1
				}
				/* @f_cat2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-category {
					@f_cat2
				}
				/* @f_cat3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-category {
					@f_cat3
				}
				
				/* @f_meta1 */
				.$unique_block_class .tdb_module_cat_grid_1 .td-editor-date,
				.$unique_block_class .tdb_module_cat_grid_1 .td-module-comments a {
					@f_meta1
				}
				/* @f_meta2 */
				.$unique_block_class .tdb_module_cat_grid_2 .td-editor-date,
				.$unique_block_class .tdb_module_cat_grid_2 .td-module-comments a {
					@f_meta2
				}
				/* @f_meta3 */
				.$unique_block_class .tdb_module_cat_grid_3 .td-editor-date,
				.$unique_block_class .tdb_module_cat_grid_3 .td-module-comments a {
					@f_meta3
				}
				
				/* @f_meta1_fw */
				.$unique_block_class .tdb_module_cat_grid_1 .td-post-author-name {
				    font-weight: @f_meta1_fw;
				}
				/* @f_meta2_fw */
				.$unique_block_class .tdb_module_cat_grid_2 .td-post-author-name {
				    font-weight: @f_meta2_fw;
				}
				/* @f_meta3_fw */
				.$unique_block_class .tdb_module_cat_grid_3 .td-post-author-name {
				    font-weight: @f_meta3_fw;
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

        $atts['tdb_grid_limit'] = self::POST_LIMIT;

        global $tdb_state_category;
        $category_grid_data = $tdb_state_category->category_grid->__invoke( $atts );

        $additional_classes = array();

        if( $this->get_att( 'lightsky' ) != '' ) {
            $additional_classes[] = 'tdb-cat-grid-lightsky';
        }

        $buffy = '';

        $buffy .= '<div class="tdb-category-grids tdb-cat-grid-scroll ' . $this->get_block_classes($additional_classes) . ' tdb-category-grid-posts" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div  id=' . $this->block_uid . ' class="td_block_inner tdb-block-inner td-fix-index">';
                $buffy .= $this->inner( $category_grid_data['grid_posts'], $this->get_att('td_column_number') );  //inner content of the block
            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

    function inner( $posts, $td_column_number ) {

        $buffy = '';
        if ( !empty( $posts )) {
            $post_count = 0;

            foreach ( $posts as $post ) {
                if ($post_count == 0) {
                    $tdb_module_cat = new tdb_module_cat_grid_1($post, $this->get_all_atts());
                    $buffy .= $tdb_module_cat->render($post_count);

                    $buffy .= '<div class="tdb-cat-grid-scroll-holder">';

                    $post_count++;
                    continue;
                }

                if ($post_count == 1) {
                    $tdb_module_cat = new tdb_module_cat_grid_2($post, $this->get_all_atts());
                    $buffy .= $tdb_module_cat->render($post_count);

                    $post_count++;
                    continue;
                }

                $tdb_module_cat_2 = new tdb_module_cat_grid_3($post, $this->get_all_atts());
                $buffy .= $tdb_module_cat_2->render($post_count);

                $post_count++;
            }

            if ($post_count < self::POST_LIMIT) {
                for ($i = $post_count; $i < self::POST_LIMIT; $i++) {
                    if ($post_count == 0) {
                        $tdb_module_cat = new tdb_module_cat_grid_1_empty($post, $this->get_all_atts());
                        $buffy .= $tdb_module_cat->render($i, 'tdb_module_cat_grid_1');

                        $buffy .= '<div class="tdb-cat-grid-scroll-holder">';

                        $post_count++;
                        continue;
                    }

                    if ($post_count == 1) {
                        $tdb_module_cat = new tdb_module_cat_grid_2_empty($post, $this->get_all_atts());
                        $buffy .= $tdb_module_cat->render($i, 'tdb_module_cat_grid_2');

                        $post_count++;
                        continue;
                    }

                    $tdb_module_cat_2 = new tdb_module_cat_grid_3_empty($post, $this->get_all_atts());
                    $buffy .= $tdb_module_cat_2->render($i, 'tdb_module_cat_grid_3');

                    $post_count++;
                }
            }

            $buffy .= '</div>';  // close td-big-grid-scroll
        }

        return $buffy;

    }

}

