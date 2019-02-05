<?php

class td_block_tags extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @inline */
				.$unique_block_class li {
					display: inline-block;
				}
				
				/* @list_padding */
				.$unique_block_class.widget ul {
					margin: @list_padding;
				}
				/* @item_space_right */
				.$unique_block_class ul li {
					margin-right: @item_space_right;
				}
				/* @item_space_bottom */
				.$unique_block_class ul li {
					margin-bottom: @item_space_bottom;
				}
				.$unique_block_class ul li:last-child {
					margin-right: 0;
				}
				/* @item_horiz_align */
				.$unique_block_class ul {
					text-align: @item_horiz_align;
				}
				
                /* @category_color */
				.$unique_block_class .td-cat-name {
					color: @category_color;
				}
				/* @category_posts_color */
				.$unique_block_class .td-cat-no {
					color: @category_posts_color;
				}
				/* @category_color_h */
				.$unique_block_class li:hover .td-cat-name {
					color: @category_color_h;
				}
				/* @category_posts_color_h */
				.$unique_block_class li:hover .td-cat-no {
					color: @category_posts_color_h;
				}
				

                /* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_cat */
				.$unique_block_class .td-cat-name {
					@f_cat
				}
				/* @f_posts */
				.$unique_block_class .td-cat-no {
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

        // list padding
        $padding = $res_ctx->get_shortcode_att('list_padding');
        $res_ctx->load_settings_raw( 'list_padding', $padding );
        if( $padding != '' && is_numeric( $padding ) ) {
            $res_ctx->load_settings_raw( 'list_padding', $padding . 'px' );
        }

        // list item space
        $item_space = $res_ctx->get_shortcode_att('item_space');
        $display_inline = $res_ctx->get_shortcode_att('inline');
        if( $display_inline == 'yes' ) {
            $res_ctx->load_settings_raw( 'item_space_right', $item_space );
            if( $item_space != '' && is_numeric( $item_space ) ) {
                $res_ctx->load_settings_raw( 'item_space_right', $item_space . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'item_space_bottom', $item_space );
            if( $item_space != '' && is_numeric( $item_space ) ) {
                $res_ctx->load_settings_raw( 'item_space_bottom', $item_space . 'px' );
            }
        }

        // menu list horizontal align
        $item_horiz_align = $res_ctx->get_shortcode_att('item_horiz_align');
        if( $item_horiz_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'item_horiz_align', 'center' );
        }
        if( $item_horiz_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'item_horiz_align', 'right' );
        }


        // category name color
        $res_ctx->load_settings_raw( 'category_color', $res_ctx->get_shortcode_att('category_color') );

        // category posts count color
        $res_ctx->load_settings_raw( 'category_posts_color', $res_ctx->get_shortcode_att('category_posts_color') );

        // category name hover color
        $res_ctx->load_settings_raw( 'category_color_h', $res_ctx->get_shortcode_att('category_color_h') );

        // category posts count hover color
        $res_ctx->load_settings_raw( 'category_posts_color_h', $res_ctx->get_shortcode_att('category_posts_color_h') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_cat' );
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

        $tag_id_filter = $this->get_att( 'tag_id_filter' );



        extract(shortcode_atts(
            array(
                'limit' => '6', // show only 6 categories by default
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => ''
            ), $atts));

        $tag_args = array(
            'hide_empty' => false,
            'number' => $limit,
            'include' => $tag_id_filter
        );


        $tags = get_tags($tag_args); // has a limit of 6 by default

	    $buffy .= '<div class="' . $this->get_block_classes(array('widget', 'widget_categories')) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title();
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            if (!empty($tags)) {
                $buffy .= '<ul class="td-pb-padding-side">';
                    foreach ($tags as $tag) {
                        $buffy .= '<li><a href="' . get_tag_link($tag->term_id) . '"><span class="td-cat-name">' . $tag->name . '</span></a></li>';
                    }
                $buffy .= '</ul>';
            }
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

    }
}