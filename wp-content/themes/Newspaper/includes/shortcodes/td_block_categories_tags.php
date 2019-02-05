<?php

class td_block_categories_tags extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @inline */
				.$unique_block_class .td-ct-item {
					display: inline-block;
				}
				
				/* @item_space */
				.$unique_block_class .td-ct-item {
					margin: @item_space;
				}
				
				/* @item_space_right */
				.$unique_block_class .td-ct-item {
					margin-right: @item_space_right;
				}
				.$unique_block_class .td-ct-item:last-child {
					margin-right: 0;
				}
				/* @item_space_bottom */
				.$unique_block_class .td-ct-item {
					margin-bottom: @item_space_bottom;
				}
				.$unique_block_class .td-ct-item:last-child {
					margin-bottom: 0;
				}
				/* @item_horiz_align */
				.$unique_block_class .td-ct-wrap {
					text-align: @item_horiz_align;
				}
				
				
				/* @items_padding */
				.$unique_block_class .td-ct-item {
					padding: @items_padding;
				}
				/* @items_radius */
				.$unique_block_class .td-ct-item:before {
					border-radius: @items_radius;
				}
				/* @items_border */
				.$unique_block_class .td-ct-item:before {
					border-width: @items_border;
					border-style: solid;
				}
				/* @items_skew */
				.$unique_block_class .td-ct-item:before {
					transform: skew(@items_skew);
                    -webkit-transform: skew(@items_skew);
				}
				
                /* @icon_size */
				.$unique_block_class .td-ct-item-sep {
					font-size: @icon_size;
				}
                /* @icon_space */
				.$unique_block_class .td-ct-item-sep {
					margin: 0  @icon_space;
				}
                /* @icon_align */
				.$unique_block_class .td-ct-item-sep {
					top: @icon_align;
				}
				
				
				
                /* @bg_color */
				.$unique_block_class .td-ct-item:before {
					background-color: @bg_color;
				}
                /* @color */
				.$unique_block_class .td-ct-item-name {
					color: @color;
				}
				/* @posts_color */
				.$unique_block_class .td-ct-item-no {
					color: @posts_color;
				}
                /* @border_color */
				.$unique_block_class .td-ct-item:before {
					border-color: @border_color;
				}
                /* @i_color */
				.$unique_block_class .td-ct-item-sep {
					color: @i_color;
				}
                /* @bg_color_h */
				.$unique_block_class .td-ct-item:hover:before {
					background-color: @bg_color_h;
				}
				/* @color_h */
				.$unique_block_class .td-ct-item:hover .td-ct-item-name {
					color: @color_h;
				}
				/* @posts_color_h */
				.$unique_block_class .td-ct-item:hover .td-ct-item-no {
					color: @posts_color_h;
				}
                /* @border_hover_color */
				.$unique_block_class .td-ct-item:hover:before {
					border-color: @border_hover_color;
				}
				

                /* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_name */
				.$unique_block_class .td-ct-item-name {
					@f_name
				}
				/* @f_posts */
				.$unique_block_class .td-ct-item-no {
					@f_posts
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // inline list elements
        $res_ctx->load_settings_raw( 'inline', $res_ctx->get_shortcode_att('inline') );


        // list item space
        $item_space = $res_ctx->get_shortcode_att('item_space');
        $res_ctx->load_settings_raw( 'item_space', $item_space );
        if ( is_numeric( $item_space ) ) {
            $res_ctx->load_settings_raw( 'item_space', $item_space . 'px' );
        }
//        $item_space = $res_ctx->get_shortcode_att('item_space');
//        $display_inline = $res_ctx->get_shortcode_att('inline');
//        if( $display_inline == 'yes' ) {
//            $res_ctx->load_settings_raw( 'item_space_right', $item_space );
//            if( $item_space != '' && is_numeric( $item_space ) ) {
//                $res_ctx->load_settings_raw( 'item_space_right', $item_space  . 'px' );
//            }
//        } else {
//            $res_ctx->load_settings_raw( 'item_space_bottom', $item_space );
//            if( $item_space != '' && is_numeric( $item_space ) ) {
//                $res_ctx->load_settings_raw( 'item_space_bottom', $item_space . 'px' );
//            }
//        }
        // items padding
        $items_padding = $res_ctx->get_shortcode_att('items_padding');
        $res_ctx->load_settings_raw( 'items_padding', $items_padding );
        if ( is_numeric( $items_padding ) ) {
            $res_ctx->load_settings_raw( 'items_padding', $items_padding . 'px' );
        }
        // border size
        $items_border = $res_ctx->get_shortcode_att('items_border');
        $res_ctx->load_settings_raw( 'items_border', $items_border );
        if( $items_border != '' && is_numeric($items_border) ) {
            $res_ctx->load_settings_raw( 'items_border', $res_ctx->get_shortcode_att('items_border') . 'px' );
        }
        // border radius
        $items_radius = $res_ctx->get_shortcode_att('items_radius');
        if ( $items_radius != 0 || !empty($items_radius) ) {
            $res_ctx->load_settings_raw( 'items_radius', $items_radius . 'px' );
        }
        // items skew
        $items_skew = $res_ctx->get_shortcode_att('items_skew');
        if ( $items_skew != 0 || !empty($items_skew) ) {
            $res_ctx->load_settings_raw( 'items_skew', $items_skew . 'deg' );
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

        // menu list horizontal align
        $item_horiz_align = $res_ctx->get_shortcode_att('item_horiz_align');
        if( $item_horiz_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'item_horiz_align', 'center' );
        }
        if( $item_horiz_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'item_horiz_align', 'right' );
        }






        // colors
        $res_ctx->load_settings_raw( 'bg_color', $res_ctx->get_shortcode_att('bg_color') );
        $res_ctx->load_settings_raw( 'color', $res_ctx->get_shortcode_att('color') );
        $res_ctx->load_settings_raw( 'posts_color', $res_ctx->get_shortcode_att('posts_color') );
        $res_ctx->load_settings_raw( 'border_color', $res_ctx->get_shortcode_att('border_color') );
        $res_ctx->load_settings_raw( 'i_color', $res_ctx->get_shortcode_att('i_color') );
        $res_ctx->load_settings_raw( 'bg_color_h', $res_ctx->get_shortcode_att('bg_color_h') );
        $res_ctx->load_settings_raw( 'color_h', $res_ctx->get_shortcode_att('color_h') );
        $res_ctx->load_settings_raw( 'posts_color_h', $res_ctx->get_shortcode_att('posts_color_h') );
        $res_ctx->load_settings_raw( 'border_hover_color', $res_ctx->get_shortcode_att('border_hover_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_name' );
        $res_ctx->load_font_settings( 'f_posts' );

    }


	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}



    function render($atts, $content = null){
        parent::render($atts);

        $buffy = '';

        $id_filter = $this->get_att( 'id_filter' );
        $show_count = $this->get_att( 'post_count' );
        $show_inline = $this->get_att( 'inline' );

        // order ny args
        $order_by = $this->get_att( 'order_by' );
        $order_by_arg = 'name';
        $order_arg = 'ASC';
        if( $order_by == 'count' ) {
            $order_by_arg = 'count';
            $order_arg = 'DESC';
        }


        extract(shortcode_atts(
            array(
                'limit' => '6', // show only 6 categories by default
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => ''
            ), $atts));

        $item_args = array(
            'hide_empty' => false,
            'number' => $limit,
            'orderby' => $order_by_arg,
            'order' => $order_arg,
            'exclude' => '',
            'include' => $id_filter
        );


        $type = $this->get_att( 'type' );
        if( $type == '' ) {
            $item_args['exclude'] = get_cat_ID(TD_FEATURED_CAT);

            // exclude categories from the demo
            if (TD_DEPLOY_MODE == 'demo' or TD_DEPLOY_MODE == 'dev') {
                $item_args['exclude'] = '153, 154, 155, 156, 157, 158, 159, 90, 91, 92, 93 , 94, 95, 96, 97, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 82, 83, 84, 85, 86, 87, 88, 89, 98, ' . get_cat_ID(TD_FEATURED_CAT);
            }

            $items = get_categories($item_args);
        } else {
            $items = get_tags($item_args);
        }

        // text separator
        $text_sep_html = '';
        $text_sep = $this->get_att( 'sep_text' );
        if( $text_sep != '' ) {
            $text_sep_html = '<span class="td-ct-text-sep">' . $text_sep . '</span>';
        }

        // icon separator
        $tdicon_html = '';
        $tdicon = $this->get_att( 'tdicon' );
        if( $tdicon != '' ) {
            $tdicon_html = '<i class="' . $tdicon . ' td-ct-item-sep"></i>';
        }


	    $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title();
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            if (!empty($items)) {
                $buffy .= '<div class="td-ct-wrap">';
                    foreach ($items as $item) {
                        if (strtolower($item->name) != 'uncategorized') {
                            $buffy .= '<a href="' . get_category_link($item->term_id) . '" class="td-ct-item">';
                                $buffy .= '<span class="td-ct-item-name">' . $item->name . '</span>';

                                if( $show_count == 'yes' ) {
                                    if( $show_inline == 'yes' ) {
                                        $buffy .= '&nbsp;<span class="td-ct-item-no">(' . $item->count . ')</span>';
                                    } else {
                                        $buffy .= '<span class="td-ct-item-no">' . $item->count . '</span>';
                                    }
                                }
                            $buffy .= $text_sep_html . '</a>' . $tdicon_html;
                        }
                    }
                $buffy .= '</div>';
            }
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

    }
}