<?php

/**
 * Class td_single_date
 */

class tdb_header_categories extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
                
                /* @disable_hover */
                .$unique_block_class:not(.tdc-element-selected) .tdb-head-cat-list {
                    visibility: hidden !important;
                    opacity: 0 !important;
                    transform: translate3d(0, 20px, 0);
                    -webkit-transform: translate3d(0, 20px, 0);
                    -moz-transform: translate3d(0, 20px, 0);
                }
                /* @show_list */
                .$unique_block_class.tdc-element-selected .tdb-head-cat-list {
                    visibility: visible;
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                    -webkit-transform: translate3d(0, 0, 0);
                    -moz-transform: translate3d(0, 0, 0);
                }
                /* @inline */
                .$unique_block_class {
                    display: inline-block;
                }
                /* @float_right */
                .$unique_block_class {
                    float: right;
                }
                /* @align_horiz_center */
                .$unique_block_class .tdb-head-cat-list,
                .$unique_block_class:not(.tdc-element-selected) .tdb-head-cat-list {
                    left: 50%;
                    transform: translate3d(-50%, 20px, 0);
                    -webkit-transform: translate3d(-50%, 20px, 0);
                    -moz-transform: translate3d(-50%, 20px, 0);
                }
                .$unique_block_class .tdb-block-inner:hover .tdb-head-cat-list,
                .$unique_block_class.tdc-element-selected .tdb-head-cat-list {
                    transform: translate3d(-50%, 0, 0);
                    -webkit-transform: translate3d(-50%, 0, 0);
                    -moz-transform: translate3d(-50%, 0, 0);
                }
                /* @align_horiz_right */
                .$unique_block_class .tdb-head-cat-list {
                    left: auto;
                    right: 0;
                }
                
                
                /* @icon_size */
                .$unique_block_class .tdb-head-cat-toggle {
                    font-size: @icon_size;
                }
                /* @icon_padding */
                .$unique_block_class .tdb-head-cat-toggle {
                    width: @icon_padding;
					height: @icon_padding;
					line-height:  @icon_padding;
                }
                
                
                /* @width */
                .$unique_block_class .tdb-head-cat-list {
                    width: @width;
                }
                
                /* @el_border_size */
                .$unique_block_class .tdb-head-cat-item a {
                    border-width: @el_border_size;
                    border-style: solid;
                    border-color: #000;
                }
                
                /* @el_border_radius */
                .$unique_block_class .tdb-head-cat-item a {
                    border-radius: @el_border_radius;
                }
                
                /* @columns */
                .$unique_block_class .tdb-head-cat-item {
                    width: @columns;
                }
                
                /* @gap */
                .$unique_block_class .tdb-head-cat-item {
                    padding-left: @gap;
                    padding-right: @gap;
                }
                .$unique_block_class .tdb-head-cat-list-inner {
                    margin-right: -@gap;
                    margin-left: -@gap;
                }
                
                /* @padding */
                .$unique_block_class .tdb-head-cat-list {
                    padding: @padding;
                }
                
                /* @el_margin */
                .$unique_block_class .tdb-head-cat-item a {
                    margin-bottom: @el_margin;
                }
                /* @no_el_margin */
                .$unique_block_class .tdb-head-cat-item:nth-last-child(@no_el_margin) a {
                    margin-bottom: 0;
                }
                
                /* @el_padding */
                .$unique_block_class .tdb-head-cat-item a {
                    padding: @el_padding;
                }
                
                /* @el_horiz_align_center */
                .$unique_block_class .tdb-head-cat-item a {
                    text-align: center;
                }
                /* @el_horiz_align_right */
                .$unique_block_class .tdb-head-cat-item a {
                    text-align: right;
                }
                
                
                /* @icon_color */
                .$unique_block_class .tdb-head-cat-toggle {
                    color: @icon_color;
                }
                /* @icon_color_h */
                .$unique_block_class .tdb-block-inner:hover .tdb-head-cat-toggle {
                    color: @icon_color_h;
                }
                
                /* @bg_color */
                .$unique_block_class .tdb-head-cat-list {
                    background-color: @bg_color;
                }
                /* @shadow */
                .$unique_block_class .tdb-head-cat-list {
                    box-shadow: @shadow;
                }
                
                /* @elem_text_color */
                .$unique_block_class .tdb-head-cat-item a {
                    color: @elem_text_color;
                }
                /* @elem_text_color_h */
                .$unique_block_class .tdb-head-cat-item a:hover {
                    color: @elem_text_color_h;
                }
                
                /* @overlay */
                .$unique_block_class .tdb-head-cat-item a:before {
                    content: '';
                    background-color: @overlay;
                }
                .$unique_block_class .tdb-head-cat-overlay {
                    display: none;
                }
                /* @overlay_gradient */
                .$unique_block_class .tdb-head-cat-item a:before {
                    content: '';
                    @overlay_gradient
                }
                .$unique_block_class .tdb-head-cat-overlay {
                    display: none;
                }
                /* @overlay_h */
                .$unique_block_class .tdb-head-cat-item a:hover:before {
                    content: '';
                    background-color: @overlay_h;
                }
                .$unique_block_class .tdb-head-cat-item a:hover .tdb-head-cat-overlay {
                    display: none;
                }
                /* @overlay_gradient_h */
                .$unique_block_class .tdb-head-cat-item a:hover:before {
                    content: '';
                    @overlay_gradient_h
                }
                .$unique_block_class .tdb-head-cat-item a:hover .tdb-head-cat-overlay {
                    display: none;
                }
                
                /* @elem_border_color */
                .$unique_block_class .tdb-head-cat-item a {
                    border-color: @elem_border_color;
                }
                /* @elem_border_color_h */
                .$unique_block_class .tdb-head-cat-item a:hover {
                    border-color: @elem_border_color_h;
                }
                
                
                
                /* @f_elem */
                .$unique_block_class .tdb-head-cat-item {
                    @f_elem
                }
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // show list
        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
            $res_ctx->load_settings_raw('disable_hover', 1);
            $res_ctx->load_settings_raw('show_list', $res_ctx->get_shortcode_att('show_list'));
        }
        // make inline
        $res_ctx->load_settings_raw('inline', $res_ctx->get_shortcode_att('inline'));
        // align to right
        $res_ctx->load_settings_raw('float_right', $res_ctx->get_shortcode_att('float_right'));
        // horizontal align
        $align_horiz = $res_ctx->get_shortcode_att('align_horiz');
        if( $align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw('align_horiz_center', 1);
        } else if( $align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw('align_horiz_right', 1);
        }



        /*-- ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        $res_ctx->load_settings_raw('icon_size', $icon_size . 'px');
        // icon padding
        $res_ctx->load_settings_raw('icon_padding', $icon_size * $res_ctx->get_shortcode_att('icon_padding') . 'px');



        /*-- CATEGORIES LIST -- */
        // padding
        $width = $res_ctx->get_shortcode_att('width');
        $res_ctx->load_settings_raw('width', $width);
        if( $width != '' && is_numeric($width) ) {
            $res_ctx->load_settings_raw('width', $width . 'px');
        }

        // columns
        $columns = $res_ctx->get_shortcode_att('columns');
        if( $columns == '' ) {
            $columns = '100%';
        }
        $res_ctx->load_settings_raw('columns', $columns);

        switch ($columns) {
            case '100%':
                $res_ctx->load_settings_raw('no_el_margin', '1');
                break;
            case '50%':
                $res_ctx->load_settings_raw('no_el_margin', '-n+2');
                break;
            case '33.33333333%':
                $res_ctx->load_settings_raw('no_el_margin', '-n+3');
                break;
            case '25%':
                $res_ctx->load_settings_raw('no_el_margin', '-n+4');
                break;
        }

        // gap
        $gap = $res_ctx->get_shortcode_att('gap');
        if( $gap != '' && is_numeric($gap) ) {
            $res_ctx->load_settings_raw('gap', $gap / 2 . 'px');
        }

        // padding
        $padding = $res_ctx->get_shortcode_att('padding');
        $res_ctx->load_settings_raw('padding', $padding);
        if( $padding != '' && is_numeric($padding) ) {
            $res_ctx->load_settings_raw('padding', $padding . 'px');
        }

        // margin
        $el_margin = $res_ctx->get_shortcode_att('el_margin');
        $res_ctx->load_settings_raw('el_margin', $el_margin);
        if( $el_margin != '' && is_numeric($el_margin) ) {
            $res_ctx->load_settings_raw('el_margin', $el_margin . 'px');
        }

        // elements padding
        $el_padding = $res_ctx->get_shortcode_att('el_padding');
        $res_ctx->load_settings_raw('el_padding', $el_padding);
        if( $el_padding != '' && is_numeric($el_padding) ) {
            $res_ctx->load_settings_raw('el_padding', $el_padding . 'px');
        }

        // elements border size
        $el_border_size = $res_ctx->get_shortcode_att('el_border_size');
        if( $el_border_size != '' && is_numeric($el_border_size) ) {
            $res_ctx->load_settings_raw('el_border_size', $el_border_size . 'px');
        }

        // elements border radius
        $el_border_radius = $res_ctx->get_shortcode_att('el_border_radius');
        $res_ctx->load_settings_raw('el_border_radius', $el_border_radius);
        if( $el_border_radius != '' && is_numeric($el_border_radius) ) {
            $res_ctx->load_settings_raw('el_border_radius', $el_border_radius . 'px');
        }

        // elements horizontal align
        $el_align_horiz = $res_ctx->get_shortcode_att('el_align_horiz');
        if( $el_align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw('el_horiz_align_center', 1);
        } else if( $el_align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw('el_horiz_align_right', 1);
        }



        /*-- COLORS -- */
        $res_ctx->load_settings_raw('icon_color', $res_ctx->get_shortcode_att('icon_color'));
        $res_ctx->load_settings_raw('icon_color_h', $res_ctx->get_shortcode_att('icon_color_h'));

        $res_ctx->load_settings_raw('bg_color', $res_ctx->get_shortcode_att('bg_color'));
        $res_ctx->load_shadow_settings( 6, 0, 2, 0,  'rgba(0, 0, 0, 0.2)', 'shadow' );
        $res_ctx->load_settings_raw('elem_text_color', $res_ctx->get_shortcode_att('elem_text_color'));
        $res_ctx->load_settings_raw('elem_text_color_h', $res_ctx->get_shortcode_att('elem_text_color_h'));
        $res_ctx->load_color_settings( 'overlay_color', 'overlay', 'overlay_gradient', '', '' );
        $res_ctx->load_color_settings( 'overlay_color_h', 'overlay_h', 'overlay_gradient_h', '', '' );
        $res_ctx->load_settings_raw('elem_border_color', $res_ctx->get_shortcode_att('elem_border_color'));
        $res_ctx->load_settings_raw('elem_border_color_h', $res_ctx->get_shortcode_att('elem_border_color_h'));



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_elem' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        // toggle icon
        $toggle_icon = $this->get_att('tdicon');
        if( $toggle_icon == '' ) {
            $toggle_icon = 'td-icon-mobile';
        }


        // declare list of arguments
        $args = array(
            'hide_empty' => 0,
            'number' => 6,
            'exclude' => '',
            'include' => ''
        );

        // ids of categories to exclude
        $args['exclude'] = $this->get_att('exclude');
        // ids of categories to include
        $args['include']  = $this->get_att('include');
        // limit categories
        $limit = $this->get_att('limit');
        if( $limit != '' ) {
            $args['number']  = $this->get_att('limit');
        }

        // get list of categories
        $categories = get_categories($args);

        // show backgrounds of categories
        $show_bg = $this->get_att('show_bg');

        // category specific overlays
        $show_overlay = $this->get_att('show_overlay');


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<i class="tdb-head-cat-toggle ' . $toggle_icon . '"></i>';

                $buffy .= '<div class="tdb-head-cat-list">';
                    $buffy .= '<div class="tdb-head-cat-list-inner">';
                        foreach ( $categories as $category ) {
                            // background image
                            $cat_bg_img_html = '';

                            if( $show_bg != '' ) {
                                $cat_bg_img = td_util::get_category_option( $category->term_id, 'tdc_image' );
                                if( $cat_bg_img != '' ) {
                                    $cat_bg_img_html = ' style="background-image: url(' . $cat_bg_img . '"';
                                }
                            }

                            // overlay
                            $cat_overlay = '';
                            if( $show_overlay != '' ) {
                                $cat_color = td_util::get_category_option( $category->term_id, 'tdc_bg_color' );

                                if( $cat_color != '' ) {
                                    $cat_overlay_1 = td_util::hex2rgba( td_util::adjustBrightness( $cat_color, -190), 0.8 );
                                    $cat_overlay_2 = td_util::hex2rgba( $cat_color, 0.4 );
                                } else {
                                    $cat_overlay_1 = 'rgba(0, 0, 0, 0.8)';
                                    $cat_overlay_2 = 'rgba(0, 0, 0, 0)';
                                }

                                $cat_overlay = '<span class="tdb-head-cat-overlay" style="background: linear-gradient(-30deg, ' . $cat_overlay_1 . ', ' . $cat_overlay_2 . ')"></span>';
                            }


                            $buffy .= '<div class="tdb-head-cat-item">';
                                $buffy .= '<a href="' . get_category_link($category->term_id) .'"' . $cat_bg_img_html . '>';
                                    $buffy .= $cat_overlay;
                                    $buffy .= '<span class="tdb-head-cat-txt">' . $category->name . '</span>';
                                $buffy .= '</a>';
                            $buffy .= '</div>';
                        }
                    $buffy .= '</div>';
                $buffy .= '</div>';

            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

}