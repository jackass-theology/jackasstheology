<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 10/16/2018
 * Time: 9:06 AM
 */

class tdb_header_menu extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @disable_hover */
                .$unique_block_class:not(.tdc-element-selected) .sub-menu,
                .$unique_block_class:not(.tdc-element-selected) .td-pulldown-filter-list {
                    visibility: hidden !important;
                }
                /* @show_subcat */
                .$unique_block_class .tdb-first-submenu > ul {
                    display: block !important;
                    top: auto;
                }
                /* @show_mega */
                .$unique_block_class .tdb-mega-menu-first > ul {
                    display: block !important;
                    top: auto;
                }
                /* @show_mega_cats */
                .$unique_block_class .tdb-mega-menu-cats-first > ul {
                    display: block !important;
                    top: auto;
                }
                
                
                /* @width */
                .$unique_block_class {
                    max-width: @width;
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
                .$unique_block_class .td_block_inner > div {
                    text-align: center;
                }
                /* @align_horiz_right */
                .$unique_block_class .td_block_inner > div {
                    text-align: right;
                }
                
                /* @elem_space */
                .$unique_block_class .tdb-menu > li {
                    margin-right: @elem_space;
                }
                .$unique_block_class .tdb-menu > li:last-child {
                    margin-right: 0;
                }
                
                /* @elem_padd */
                .$unique_block_class .tdb-menu > li > a,
                .$unique_block_class .td-subcat-more {
                    padding: @elem_padd;
                }
                
                /* @sep_icon_size */
                .$unique_block_class .tdb-menu > li .tdb-menu-sep,
                .$unique_block_class .tdb-menu-items-dropdown .tdb-menu-sep {
                    font-size: @sep_icon_size;
                }
                /* @sep_icon_space */
                .$unique_block_class .tdb-menu > li .tdb-menu-sep,
                .$unique_block_class .tdb-menu-items-dropdown .tdb-menu-sep {
                    margin: 0 @sep_icon_space;
                }
                /* @sep_icon_align */
                .$unique_block_class .tdb-menu > li .tdb-menu-sep,
                .$unique_block_class .tdb-menu-items-dropdown .tdb-menu-sep {
                    top: @sep_icon_align;
                }
                
                /* @main_sub_icon_size */
                .$unique_block_class .tdb-menu > li > a .tdb-sub-menu-icon,
                .$unique_block_class .td-subcat-more .tdb-menu-more-icon {
                    font-size: @main_sub_icon_size;
                }
                /* @main_sub_icon_space */
                .$unique_block_class .tdb-menu > li > a .tdb-sub-menu-icon,
                .$unique_block_class .td-subcat-more .tdb-menu-more-icon {
                    margin-left: @main_sub_icon_space;
                }
                /* @main_sub_icon_align */
                .$unique_block_class .tdb-menu > li > a .tdb-sub-menu-icon,
                .$unique_block_class .td-subcat-more .tdb-menu-more-icon {
                    top: @main_sub_icon_align;
                }
                
                /* @text_color */
                .$unique_block_class .tdb-menu > li > a,
                .$unique_block_class .td-subcat-more {
                    color: @text_color;
                }
                /* @main_sub_color */
                .$unique_block_class .tdb-menu > li > a .tdb-sub-menu-icon,
                .$unique_block_class .td-subcat-more .tdb-menu-more-icon {
                    color: @main_sub_color;
                }
                /* @sep_color */
                .$unique_block_class .tdb-menu > li .tdb-menu-sep,
                .$unique_block_class .tdb-menu-items-dropdown .tdb-menu-sep {
                    color: @sep_color;
                }
                
                /* @f_elem */
                .$unique_block_class .tdb-menu > li > a,
                .$unique_block_class .td-subcat-more {
                    @f_elem
                }
                
                
                /* @sub_width */
                .$unique_block_class .tdb-normal-menu ul.sub-menu,
                .$unique_block_class .td-pulldown-filter-list {
                    width: @sub_width !important;
                }
                /* @sub_first_left */
                .$unique_block_class .tdb-normal-menu > ul,
                .$unique_block_class .td-pulldown-filter-list {
                    left: @sub_first_left;
                }
                @media (max-width: 1018px) {
                    .$unique_block_class .td-pulldown-filter-list {
                        left: auto;
                        right: @sub_first_left;
                    }
                }
                /* @sub_rest_top */
                .$unique_block_class .tdb-normal-menu ul ul {
                    margin-top: @sub_rest_top;
                }
                /* @sub_padd */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul,
                .$unique_block_class .td-pulldown-filter-list {
                    padding: @sub_padd;
                }
                /* @sub_align_horiz_center */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul,
                .$unique_block_class .td-pulldown-filter-list {
                    text-align: center;
                }
                /* @sub_align_horiz_right */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul,
                .$unique_block_class .td-pulldown-filter-list {
                    text-align: right;
                }
                
                /* @sub_elem_space_right */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a,
                .$unique_block_class .td-pulldown-filter-list li a {
                    margin-right: @sub_elem_space_right;
                }
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item:last-child > a,
                .$unique_block_class .td-pulldown-filter-list li:last-child a {
                    margin-right: 0;
                }
                /* @sub_elem_space_bot */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a,
                .$unique_block_class .td-pulldown-filter-list li a {
                    margin-bottom: @sub_elem_space_bot;
                }
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item:last-child > a,
                .$unique_block_class .td-pulldown-filter-list li:last-child a {
                    margin-bottom: 0;
                }
                /* @sub_elem_padd */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a,
                .$unique_block_class .td-pulldown-filter-list li a {
                    padding: @sub_elem_padd;
                }
                
                /* @sub_icon_size */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-sub-menu-icon {
                    font-size: @sub_icon_size;
                }
                /* @sub_icon_space */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-sub-menu-icon {
                    margin-left: @sub_icon_space;
                }
                /* @sub_icon_align */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-sub-menu-icon {
                    top: @sub_icon_align;
                }
                
                /* @sub_bg_color */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul,
                .$unique_block_class .td-pulldown-filter-list {
                    background-color: @sub_bg_color;
                }
                /* @sub_elem_bg_color */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a,
                .$unique_block_class .td-pulldown-filter-list li a {
                    background-color: @sub_elem_bg_color;
                }
                /* @sub_text_color */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a,
                .$unique_block_class .td-pulldown-filter-list li a {
                    color: @sub_text_color;
                }
                /* @sub_color */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a .tdb-sub-menu-icon {
                    color: @sub_color;
                }
                /* @sub_shadow */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul,
                .$unique_block_class .td-pulldown-filter-list {
                    box-shadow: @sub_shadow;
                }
                
                /* @f_sub_elem */
                .$unique_block_class .tdb-menu .tdb-normal-menu ul .tdb-menu-item > a,
                .$unique_block_class .td-pulldown-filter-list li a {
                    @f_sub_elem
                }
                
                
                /* @mm_width */
                .$unique_block_class .tdb-mega-menu ul li {
                    width: @mm_width !important;
                }
                /* @mm_width_with_ul */
                .$unique_block_class .tdb-mega-menu ul,
                .$unique_block_class .tdb-mega-menu ul li {
                    width: @mm_width_with_ul !important;
                }
                /* @mm_content_width */
                .$unique_block_class .tdb-mega-menu .tdb_header_mega_menu {
                    max-width: @mm_content_width;
                    margin: 0 auto;
                }
                
                /* @mm_align_horiz_align_left */
                .$unique_block_class .tdb-mega-menu ul {
                    left: 0;
                    transform: none;
                    -webkit-transform: none;
                    -moz-transform: none;
                }
                /* @mm_align_horiz_align_right */
                .$unique_block_class .tdb-mega-menu ul {
                    left: auto;
                    right: 0;
                    transform: none;
                    -webkit-transform: none;
                    -moz-transform: none;
                }
                /* @mm_align_horiz_align_left2 */
                .$unique_block_class .tdb-mega-menu .tdb_header_mega_menu {
                    margin-left: 0;
                }
                /* @mm_align_horiz_align_right2 */
                .$unique_block_class .tdb-mega-menu .tdb_header_mega_menu {
                    margin-right: 0;
                }
                
                /* @mm_offset */
                .$unique_block_class .tdb-mega-menu ul li {
                    margin-left: @mm_offset;
                }
                
				/* @mm_bg */
				.$unique_block_class .tdb-menu .tdb-mega-menu ul li {
					background-color: @mm_bg;
				}
				/* @mm_border_color */
				.$unique_block_class .tdb-menu .tdb-mega-menu ul li {
					border-color: @mm_border_color;
				}
				/* @mm_shadow */
				.$unique_block_class .tdb-menu .tdb-mega-menu ul li {
					box-shadow: @mm_shadow;
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
            $res_ctx->load_settings_raw('disable_hover', 1);
            $res_ctx->load_settings_raw('show_subcat', $res_ctx->get_shortcode_att('show_subcat'));
            $res_ctx->load_settings_raw('show_mega', $res_ctx->get_shortcode_att('show_mega'));
            $res_ctx->load_settings_raw('show_mega_cats', $res_ctx->get_shortcode_att('show_mega_cats'));
        }


        /*-- MAIN MENU -- */
        // width
        $width = $res_ctx->get_shortcode_att('width');
        $res_ctx->load_settings_raw( 'width', $width );
        if( $width != '' && is_numeric($width) ) {
            $res_ctx->load_settings_raw( 'width', $width . 'px' );
        }
        // inline
        $res_ctx->load_settings_raw( 'inline', $res_ctx->get_shortcode_att('inline') );
        // float right
        $res_ctx->load_settings_raw( 'float_right', $res_ctx->get_shortcode_att('float_right') );
        // horizontal align
        $align_horiz = $res_ctx->get_shortcode_att('align_horiz');
        if( $align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_horiz_center', 1 );
        } else if ( $align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_horiz_right', 1 );
        }

        // elements space
        $elem_space = $res_ctx->get_shortcode_att('elem_space');
        if( $elem_space != '' && is_numeric( $elem_space ) ) {
            $res_ctx->load_settings_raw( 'elem_space', $elem_space . 'px' );
        }
        // elements padding
        $elem_padd = $res_ctx->get_shortcode_att('elem_padd');
        $res_ctx->load_settings_raw( 'elem_padd', $elem_padd );
        if( $elem_padd != '' && is_numeric( $elem_padd ) ) {
            $res_ctx->load_settings_raw( 'elem_padd', $elem_padd . 'px' );
        }
        // separator icon size
        $sep_icon_size = $res_ctx->get_shortcode_att('sep_icon_size');
        $res_ctx->load_settings_raw( 'sep_icon_size', $sep_icon_size );
        if( $sep_icon_size != '' && is_numeric( $sep_icon_size ) ) {
            $res_ctx->load_settings_raw( 'sep_icon_size', $sep_icon_size . 'px' );
        }
        // separator icon space
        $sep_icon_space = $res_ctx->get_shortcode_att('sep_icon_space');
        if( $sep_icon_space != '' && is_numeric( $sep_icon_space ) ) {
            $res_ctx->load_settings_raw( 'sep_icon_space', ($sep_icon_space / 2) . 'px' );
        }
        // separator icon alignment
        $res_ctx->load_settings_raw( 'sep_icon_align', $res_ctx->get_shortcode_att('sep_icon_align') . 'px' );

        // main sub menu icon size
        $main_sub_icon_size = $res_ctx->get_shortcode_att('main_sub_icon_size');
        $res_ctx->load_settings_raw( 'main_sub_icon_size', $main_sub_icon_size );
        if( $main_sub_icon_size != '' && is_numeric( $main_sub_icon_size ) ) {
            $res_ctx->load_settings_raw( 'main_sub_icon_size', $main_sub_icon_size . 'px' );
        }
        // main sub menu icon space
        $main_sub_icon_space = $res_ctx->get_shortcode_att('main_sub_icon_space');
        if( $main_sub_icon_space != '' && is_numeric( $main_sub_icon_space ) ) {
            $res_ctx->load_settings_raw( 'main_sub_icon_space', $main_sub_icon_space . 'px' );
        }
        // main sub menu icon alignment
        $res_ctx->load_settings_raw( 'main_sub_icon_align', $res_ctx->get_shortcode_att('main_sub_icon_align') . 'px' );

        // colors
        $res_ctx->load_settings_raw( 'text_color', $res_ctx->get_shortcode_att('text_color') );
        $res_ctx->load_settings_raw( 'main_sub_color', $res_ctx->get_shortcode_att('main_sub_color') );
        $res_ctx->load_settings_raw( 'sep_color', $res_ctx->get_shortcode_att('sep_color') );

        // fonts
        $res_ctx->load_font_settings( 'f_elem' );



        /*-- SUB MENU -- */
        // first level left position
        $sub_width = $res_ctx->get_shortcode_att('sub_width');
        $res_ctx->load_settings_raw( 'sub_width', $sub_width );
        if( $sub_width != '' && is_numeric( $sub_width ) ) {
            $res_ctx->load_settings_raw( 'sub_width', $sub_width . 'px' );
        }
        // first level left position
        $sub_first_left = $res_ctx->get_shortcode_att('sub_first_left');
        if( $sub_first_left != '' && is_numeric( $sub_first_left ) ) {
            $res_ctx->load_settings_raw( 'sub_first_left', $sub_first_left . 'px' );
        }
        // subsequent levels top position
        $sub_rest_top = $res_ctx->get_shortcode_att('sub_rest_top');
        if( $sub_rest_top != '' && is_numeric( $sub_rest_top ) ) {
            $res_ctx->load_settings_raw( 'sub_rest_top', $sub_rest_top . 'px' );
        }
        // sub menu padding
        $sub_padd = $res_ctx->get_shortcode_att('sub_padd');
        $res_ctx->load_settings_raw( 'sub_padd', $sub_padd );
        if( $sub_padd != '' && is_numeric( $sub_padd ) ) {
            $res_ctx->load_settings_raw( 'sub_padd', $sub_padd . 'px' );
        }
        // sub menu horizontal align
        $sub_align_horiz = $res_ctx->get_shortcode_att('sub_align_horiz');
        if( $sub_align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'sub_align_horiz_center', 1 );
        } else if ( $sub_align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'sub_align_horiz_right', 1 );
        }

        // sub menu elements inline
        $sub_elem_inline = $res_ctx->get_shortcode_att('sub_elem_inline');
        $res_ctx->load_settings_raw( 'sub_elem_inline', $sub_elem_inline );
        // sub menu elements space
        $sub_elem_space = $res_ctx->get_shortcode_att('sub_elem_space');
        if( $sub_elem_space != '' && is_numeric( $sub_elem_space ) ) {
            if( $sub_elem_inline == 'yes' ) {
                $res_ctx->load_settings_raw( 'sub_elem_space_right', $sub_elem_space . 'px' );
            } else {
                $res_ctx->load_settings_raw( 'sub_elem_space_bot', $sub_elem_space . 'px' );
            }
        }
        // sub menu elements padding
        $sub_elem_padd = $res_ctx->get_shortcode_att('sub_elem_padd');
        $res_ctx->load_settings_raw( 'sub_elem_padd', $sub_elem_padd );
        if( $sub_elem_padd != '' && is_numeric( $sub_elem_padd ) ) {
            $res_ctx->load_settings_raw( 'sub_elem_padd', $sub_elem_padd . 'px' );
        }

        // sub menu icon size
        $sub_icon_size = $res_ctx->get_shortcode_att('sub_icon_size');
        $res_ctx->load_settings_raw( 'sub_icon_size', $sub_icon_size );
        if( $sub_icon_size != '' && is_numeric( $sub_icon_size ) ) {
            $res_ctx->load_settings_raw( 'sub_icon_size', $sub_icon_size . 'px' );
        }
        // sub menu icon space
        $sub_icon_space = $res_ctx->get_shortcode_att('sub_icon_space');
        if( $sub_icon_space != '' && is_numeric( $sub_icon_space ) ) {
            $res_ctx->load_settings_raw( 'sub_icon_space', $sub_icon_space . 'px' );
        }
        // sub menu icon space
        $res_ctx->load_settings_raw( 'sub_icon_align', $res_ctx->get_shortcode_att('sub_icon_align') . 'px' );

        // colors
        $res_ctx->load_settings_raw( 'sub_bg_color', $res_ctx->get_shortcode_att('sub_bg_color') );
        $res_ctx->load_settings_raw( 'sub_elem_bg_color', $res_ctx->get_shortcode_att('sub_elem_bg_color') );
        $res_ctx->load_settings_raw( 'sub_text_color', $res_ctx->get_shortcode_att('sub_text_color') );
        $res_ctx->load_settings_raw( 'sub_color', $res_ctx->get_shortcode_att('sub_color') );
        $res_ctx->load_shadow_settings( 4, 1, 1, 0, 'rgba(0, 0, 0, 0.15)', 'sub_shadow' );

        // fonts
        $res_ctx->load_font_settings( 'f_sub_elem' );



        /*-- MEGA MENU -- */
        // mega menu width
        $mm_width = $res_ctx->get_shortcode_att('mm_width');
        $mm_align_screen = $res_ctx->get_shortcode_att('mm_align_screen');
        if( $mm_align_screen != '' ) {
            $res_ctx->load_settings_raw( 'mm_width', $mm_width );
            if( $mm_width != '' && is_numeric( $mm_width ) ) {
                $res_ctx->load_settings_raw( 'mm_width', $mm_width . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'mm_width_with_ul', $mm_width );
            if( $mm_width != '' && is_numeric( $mm_width ) ) {
                $res_ctx->load_settings_raw( 'mm_width_with_ul', $mm_width . 'px' );
            }
        }

        // mega menu width
        $mm_content_width = $res_ctx->get_shortcode_att('mm_content_width');
        $res_ctx->load_settings_raw( 'mm_content_width', $mm_content_width );
        if( $mm_content_width != '' && is_numeric( $mm_content_width ) ) {
            $res_ctx->load_settings_raw( 'mm_content_width', $mm_content_width . 'px' );
        }

        // mega menu horizontal align
        $mm_align_screen = $res_ctx->get_shortcode_att('mm_align_screen');
        $mm_align_horiz = $res_ctx->get_shortcode_att('mm_align_horiz');
        if( $mm_align_screen == '' ) {
            if ( $mm_align_horiz == 'content-horiz-left' ) {
                $res_ctx->load_settings_raw( 'mm_align_horiz_align_left', 1 );
            } else if ( $mm_align_horiz == 'content-horiz-right' ) {
                $res_ctx->load_settings_raw( 'mm_align_horiz_align_right', 1 );
            }
        } else {
            if ( $mm_align_horiz == 'content-horiz-left' ) {
                $res_ctx->load_settings_raw( 'mm_align_horiz_align_left2', 1 );
            } else if ( $mm_align_horiz == 'content-horiz-right' ) {
                $res_ctx->load_settings_raw( 'mm_align_horiz_align_right2', 1 );
            }
        }

        // mega menu offset
        $mm_offset = $res_ctx->get_shortcode_att('mm_offset');
        if( $mm_offset != '' && is_numeric( $mm_offset ) ) {
            $res_ctx->load_settings_raw( 'mm_offset', $mm_offset . 'px' );
        }


        // colors
        $res_ctx->load_settings_raw( 'mm_bg', $res_ctx->get_shortcode_att('mm_bg') );
        $res_ctx->load_settings_raw( 'mm_border_color', $res_ctx->get_shortcode_att('mm_border_color') );
        $res_ctx->load_shadow_settings( 6, 0, 2, 0, 'rgba(0, 0, 0, 0.1)', 'mm_shadow' );

    }

    function render($atts, $content = null) {

        self::disable_loop_block_features();

        parent::render($atts);

        global $tdb_state_single, $tdb_state_category;

        switch( tdb_state_template::get_template_type() ) {
            case 'single':
                $state_menu = $tdb_state_single->menu->__invoke( $this->get_all_atts() );
                break;

            case 'category':
                $state_menu = $tdb_state_category->menu->__invoke( $this->get_all_atts() );
                break;
        }

        // id we're on td composer
        if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ){
//            echo '<pre>';
//            print_r();
//            echo '</pre>';
        }

        // if we're on the front end
        if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
//            echo PHP_EOL .'<pre> tdb_block_menu atts: </pre>';
//            echo '<pre>';
//            print_r($atts);
//            echo '</pre>';
        }

        $this->unique_block_class = $this->block_uid . '_rand';

        $this->shortcode_atts = shortcode_atts(
            array_merge(
                td_api_style::get_style_group_params( 'tds_menu_active' ),
                td_api_style::get_style_group_params( 'tds_menu_sub_active' )
            ), $atts );

        // additional classes
        $additional_classes = array();

        $tds_menu_active = $this->get_att('tds_menu_active');
        if( $tds_menu_active != '' ) {
            $additional_classes[] = $tds_menu_active;
        }
        $sub_elem_inline = $this->get_att('sub_elem_inline');
        if( $sub_elem_inline != '' ) {
            $additional_classes[] = 'tdb-menu-sub-inline';
        }
        $make_inline = $this->get_att('inline');
        if( $make_inline != '' ) {
            $additional_classes[] = 'tdb-head-menu-inline';
        }
        $menu_items_in_more = $this->get_att('more');
        if( $menu_items_in_more != '' ) {
            $additional_classes[] = 'tdb-menu-items-in-more';
        }
        $mm_align_screen = $this->get_att('mm_align_screen');
        if( $mm_align_screen != '' ) {
            $additional_classes[] = 'tdb-mm-align-screen';
        }

        $buffy = '';
        $buffy .= $this->get_block_js();

        // menu id
        $menu_id = $this->get_att('menu_id');
        if( $menu_id == '' ) {
            $menu_id = get_theme_mod('nav_menu_locations')['header-menu'];
        }

        $buffy .= '<div class="' . $this->get_block_classes( $additional_classes ) . '" ' . $this->get_block_html_atts() . ' style=" z-index: 999;">';

        //get the block css
        $buffy .= $this->get_block_css();

        // Get tds_menu_active style
        $tds_menu_active = $this->get_att('tds_menu_active');
        if ( empty( $tds_menu_active ) ) {
            $tds_menu_active = td_util::get_option( 'tds_menu_active', 'tds_menu_active1' );
        }
        $tds_menu_active_instance = new $tds_menu_active( $this->shortcode_atts, $this->unique_block_class );
        $buffy .= $tds_menu_active_instance->render();

        // Get tds_menu_sub_active style
        $tds_menu_sub_active = $this->get_att('tds_menu_sub_active');
        if ( empty( $tds_menu_sub_active ) ) {
            $tds_menu_sub_active = td_util::get_option( 'tds_menu_sub_active', 'tds_menu_sub_active1' );
        }
        $tds_menu_sub_active_instance = new $tds_menu_sub_active( $this->shortcode_atts, $this->unique_block_class );
        $buffy .= $tds_menu_sub_active_instance->render();

            if ( empty( $menu_id ) ) {

                $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-fix-index">';
                    $buffy .= td_util::get_block_error( 'Header Main Menu', 'Render failed - please select a menu' );
                $buffy .= '</div>';

                $buffy .= '</div>';

                return $buffy;
            }

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-fix-index">';

                // if the menu was built and comes from a state and we just need to add it to the buffer
                if ( !empty( $state_menu ) ) {
                    $buffy .= $this->inner( $state_menu, 'state_menu' );

                // otherwise we use the menu id and call the wp_nav_menu @see $this->inner()
                } else {
                    $buffy .= $this->inner( $menu_id );
                }

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

    function inner( $menu, $menu_type = '' ) {

        $buffy = '';
        $td_block_layout = new td_block_layout();

        $main_sub_icon = $this->get_att('main_sub_tdicon');
        $sep_icon = $this->get_att('sep_tdicon');

        // menu pulldown
        $pulldown = ( $this->get_att('more') != '' ) ? true : false;

        // the menu was already built in the state
        if ( $menu_type == 'state_menu' ) {

            if ( $pulldown ) {
                $buffy .= '<div class="tdb-menu-items-pulldown">';

                $buffy .= $menu;

                    // menu items dropdown list
                    $buffy .= '<div class="tdb-menu-items-dropdown">';

                        if( $sep_icon != '' ) {
                            $buffy .= '<i class="tdb-menu-sep ' . $sep_icon . '"></i>';
                        }
                        $buffy .= '<div class="td-subcat-more">';
                            $buffy .= '<span class="tdb-menu-item-text">More</span>';
                            if( $main_sub_icon != '' ) {
                                $buffy .= '<i class="tdb-menu-more-icon ' . $main_sub_icon . '"></i>';
                            }

                            $buffy .= '<ul class="td-pulldown-filter-list"></ul>';
                        $buffy .= '</div>';

                    $buffy .= '</div>'; // ./tdb-menu-items-dropdown
                $buffy .= '</div>'; // ./tdb-menu-items-pulldown
            } else {
                $buffy .= $menu;
            }

            ob_start();
            ?>
            <script>
                /* global jQuery:{} */
                jQuery().ready(function () {
                    var tdbMenuItem = new tdbMenu.item();
                    tdbMenuItem.blockUid = '<?php echo $this->block_uid; ?>';
                    tdbMenuItem.jqueryObj = jQuery('.<?php echo $this->block_uid ?>_rand');
                    tdbMenu.addItem(tdbMenuItem);

                    <?php if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) { ; ?>
                        setInterval(function () {
                            tdbMenu.megaMenuFull( tdbMenuItem );
                        }, 1000);
                    <?php } else { ?>
                        tdbMenu.megaMenuFull( tdbMenuItem );
                    <?php } ?>

                });
            </script>
            <?php
            td_js_buffer::add_to_footer( "\n" . td_util::remove_script_tag( ob_get_clean() ) );

        // built the menu here using its id
        } else {
            $tdb_menu_instance = tdb_menu::get_instance( $this->get_all_atts() );

            add_filter( 'wp_nav_menu_objects', array( $tdb_menu_instance, 'hook_wp_nav_menu_objects' ), 10, 2 );

            ob_start();

            wp_nav_menu(
                array(
                    'menu' => $menu,
                    'menu_id'=> 'tdb-block-menu',
                    'container' => false,
                    'menu_class'=> 'tdb-menu tdb-menu-items-visible',
                    'walker' => new tdb_tagdiv_walker_nav_menu($this->get_all_atts())
                )
            );

            remove_filter( 'wp_nav_menu_objects', array( $tdb_menu_instance, 'hook_wp_nav_menu_objects' ) );

            if ( $pulldown ) {
                $buffy .= '<div class="tdb-menu-items-pulldown">';

                    $buffy .= ob_get_clean();

                    // menu items dropdown list
                    $buffy .= '<div class="tdb-menu-items-dropdown">';

                        if( $sep_icon != '' ) {
                            $buffy .= '<i class="tdb-menu-sep ' . $sep_icon . '"></i>';
                        }
                        $buffy .= '<div class="td-subcat-more">';
                            $buffy .= '<span class="tdb-menu-item-text">More</span>';
                            if( $main_sub_icon != '' ) {
                                $buffy .= '<i class="tdb-menu-more-icon ' . $main_sub_icon . '"></i>';
                            }

                            $buffy .= '<ul class="td-pulldown-filter-list"></ul>';
                        $buffy .= '</div>';

                    $buffy .= '</div>'; // ./tdb-menu-items-dropdown
                $buffy .= '</div>'; // ./tdb-menu-items-pulldown
            } else {
                $buffy .= ob_get_clean();
            }

            ob_start();

            ?>
            <script>
                /* global jQuery:{} */
                jQuery(window).load(function () {
                    var tdbMenuItem = new tdbMenu.item();
                    tdbMenuItem.blockUid = '<?php echo $this->block_uid; ?>';
                    tdbMenuItem.jqueryObj = jQuery('.<?php echo $this->block_uid ?>_rand');
                    tdbMenu.addItem( tdbMenuItem );

                    <?php if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) { ; ?>
                        setInterval(function () {
                            tdbMenu.megaMenuFull( tdbMenuItem );
                        }, 1000);
                    <?php } else { ?>
                        tdbMenu.megaMenuFull( tdbMenuItem );
                    <?php } ?>

                });
            </script>
            <?php

            td_js_buffer::add_to_footer( "\n" . td_util::remove_script_tag( ob_get_clean() ) );

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
            /* global jQuery:{} */
            (function () {
                var tdbMenuItem = new tdbMenu.item();
                tdbMenuItem.blockUid = '<?php echo $this->block_uid; ?>';
                tdbMenuItem.jqueryObj = jQuery('.<?php echo $this->block_uid ?>_rand');
                tdbMenu.addItem( tdbMenuItem );

                <?php if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) { ; ?>
                    setInterval(function () {
                        tdbMenu.megaMenuFull( tdbMenuItem );
                    }, 1000);
                <?php } else { ?>
                    tdbMenu.megaMenuFull( tdbMenuItem );
                <?php } ?>

                var jquery_object_container = jQuery('.<?php echo $this->block_uid ?>_rand');

                if ( jquery_object_container.length && jquery_object_container.hasClass('tdb-menu-items-in-more') ) {

                    var blockUid = jquery_object_container.data('td-block-uid');
                    var blockMenu = jQuery( '.' + blockUid + '_rand');
                    var horizontalMaxWidth = '';

                    // if we have fixed width set for the block send that width as horizontal list max width
                    if ( blockMenu.css('max-width') !== 'none' ) {
                        horizontalMaxWidth = blockMenu.css('max-width');
                    }

                    var horizontal_jquery_obj = jquery_object_container.find('.tdb-menu:first');

                    var container_jquery_obj = horizontal_jquery_obj.parents('.tdb-menu-items-pulldown:first');
                    var excluded_jquery_elements = [];

                    // add the `more` dropdown element to the exclude elements array
                    //excluded_jquery_elements.push( container_jquery_obj.find('.tdb-menu-items-dropdown') );

                    // if we have an inline display for the menu we need consider it
                    if ( blockMenu.css('display') !== undefined && blockMenu.css('display') === 'inline-block' ) {

                        // the column we operate on
                        var column = blockMenu.closest('.vc_column_container');

                        // set the container to the column
                        container_jquery_obj = column;

                        // column blocks selector
                        var a = '';
                        if ( column.find('.tdc-elements').length !== 0 ) {
                            a = '.tdc-elements';
                        } else {
                            a = '.wpb_wrapper';
                        }

                        // find all blocks from this column
                        column.find( a + ' > .td_block_wrap' ).each( function (index,element) {

                            // calculate the percent from column's width
                            var percentOfColumnWidth = ( 90/100 ) * column.outerWidth( true );

                            // the block element width
                            var elementWidth = jQuery(this).outerWidth( true );

                            // we exclude the menu block
                            if ( jQuery(this).data('td-block-uid') !== blockUid ) {

                                // if the block takes more than 90% of column's width we don't consider it
                                if ( elementWidth < percentOfColumnWidth ) {
                                    excluded_jquery_elements.push(jQuery(this));
                                } else {
                                    return false;
                                }
                            }
                        });
                    }

                    if ( horizontal_jquery_obj.length ) {
                        var pulldown_item_obj = new tdPullDown.item();

                        pulldown_item_obj.blockUid = blockUid;
                        pulldown_item_obj.horizontal_jquery_obj = horizontal_jquery_obj;
                        pulldown_item_obj.vertical_jquery_obj = jquery_object_container.find('.tdb-menu-items-dropdown:first');
                        pulldown_item_obj.horizontal_element_css_class = 'tdb-menu-item-button';
                        pulldown_item_obj.horizontal_no_items_css_class = 'tdb-menu-items-empty';
                        pulldown_item_obj.container_jquery_obj = container_jquery_obj;
                        pulldown_item_obj.horizontal_no_items_css_class = 'tdb-menu-noitems';
                        pulldown_item_obj.horizontal_max_width = horizontalMaxWidth;

                        // the excluded elements
                        pulldown_item_obj.excluded_jquery_elements = excluded_jquery_elements;

                        tdPullDown.add_item(pulldown_item_obj);
                    }
                }

            })();


        </script>
        <?php

        return $buffy . td_util::remove_script_tag( ob_get_clean() );
    }

}