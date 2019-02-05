<?php
/**
 * Created by PhpStorm.
 * User: lucian
 * Date: 10/16/2018
 * Time: 9:06 AM
 */

class tdb_mobile_horiz_menu extends td_block {

    protected $shortcode_atts = array(); //the atts used for rendering the current block
    private $unique_block_class;

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @disable_hover */
                .$unique_block_class:not(.tdc-element-selected) .sub-menu {
                    visibility: hidden !important;
                }
                /* @show_subcat */
                .$unique_block_class .tdb-first-submenu > ul {
                    visibility: visible;
                    opacity: 1;
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
                .$unique_block_class .tdb-horiz-menu {
                    margin: 0 auto;
                }
                /* @align_horiz_right */
                .$unique_block_class .tdb-horiz-menu {
                    margin-left: auto;
                }
                
                /* @elem_space */
                .$unique_block_class .tdb-horiz-menu > li {
                    margin-right: @elem_space;
                }
                .$unique_block_class .tdb-horiz-menu > li:last-child {
                    margin-right: 0;
                }
                
                /* @elem_padd */
                .$unique_block_class .tdb-horiz-menu > li > a {
                    padding: @elem_padd;
                }
                
                /* @sep_icon_size */
                .$unique_block_class .tdb-horiz-menu > li .tdb-menu-sep {
                    font-size: @sep_icon_size;
                }
                /* @sep_icon_space */
                .$unique_block_class .tdb-horiz-menu > li .tdb-menu-sep {
                    margin: 0 @sep_icon_space;
                }
                /* @sep_icon_align */
                .$unique_block_class .tdb-horiz-menu > li .tdb-menu-sep {
                    top: @sep_icon_align;
                }
                
                /* @main_sub_icon_size */
                .$unique_block_class .tdb-horiz-menu > li > a  .tdb-sub-menu-icon {
                    font-size: @main_sub_icon_size;
                }
                /* @main_sub_icon_space */
                .$unique_block_class .tdb-horiz-menu > li > a .tdb-sub-menu-icon {
                    margin-left: @main_sub_icon_space;
                }
                /* @main_sub_icon_align */
                .$unique_block_class .tdb-horiz-menu > li > a  .tdb-sub-menu-icon {
                    top: @main_sub_icon_align;
                }
                
                /* @text_color */
                .$unique_block_class .tdb-horiz-menu > li > a {
                    color: @text_color;
                }
                /* @text_color_h */
                .$unique_block_class .tdb-horiz-menu > li.current-menu-item > a,
                .$unique_block_class .tdb-horiz-menu > li.current-menu-ancestor > a,
                .$unique_block_class .tdb-horiz-menu > li.current-category-ancestor > a,
                .$unique_block_class .tdb-horiz-menu > li:hover > a {
                    color: @text_color_h;
                }
                /* @main_sub_color */
                .$unique_block_class .tdb-horiz-menu > li > a .tdb-sub-menu-icon {
                    color: @main_sub_color;
                }
                /* @sep_color */
                .$unique_block_class .tdb-horiz-menu > li .tdb-menu-sep {
                    color: @sep_color;
                }
                /* @main_sub_color_h */
                .$unique_block_class .tdb-horiz-menu > li.current-menu-item > a .tdb-sub-menu-icon,
                .$unique_block_class .tdb-horiz-menu > li.current-menu-ancestor > a .tdb-sub-menu-icon,
                .$unique_block_class .tdb-horiz-menu > li.current-category-ancestor > a .tdb-sub-menu-icon,
                .$unique_block_class .tdb-horiz-menu > li:hover > a .tdb-sub-menu-icon {
                    color: @main_sub_color_h;
                }
                
                /* @f_elem */
                .$unique_block_class .tdb-horiz-menu > li > a {
                    @f_elem
                }
                
                
                /* @sub_left */
                .$unique_block_class .tdb-horiz-menu > ul {
                    left: @sub_left;
                }
                /* @sub_padd */
                .$unique_block_class .tdb-horiz-menu ul {
                    padding: @sub_padd;
                }
                /* @sub_align_horiz_center */
                .$unique_block_class .tdb-horiz-menu ul {
                    text-align: center;
                }
                /* @sub_align_horiz_right */
                .$unique_block_class .tdb-horiz-menu ul {
                    text-align: right;
                }
                
                /* @sub_elem_space_right */
                .$unique_block_class .tdb-horiz-menu ul li > a {
                    margin-right: @sub_elem_space_right;
                }
                .$unique_block_class .tdb-horiz-menu  ul li:last-child > a {
                    margin-right: 0;
                }
                /* @sub_elem_space_bot */
                .$unique_block_class .tdb-horiz-menu ul li > a {
                    margin-bottom: @sub_elem_space_bot;
                }
                .$unique_block_class .tdb-horiz-menu ul li:last-child > a {
                    margin-bottom: 0;
                }
                /* @sub_elem_padd */
                .$unique_block_class .tdb-horiz-menu ul li > a {
                    padding: @sub_elem_padd;
                }
                
                /* @sub_bg_color */
                .$unique_block_class .tdb-horiz-menu ul {
                    background-color: @sub_bg_color;
                }
                /* @sub_text_color */
                .$unique_block_class .tdb-horiz-menu ul li > a {
                    color: @sub_text_color;
                }
                /* @sub_text_color_h */
                .$unique_block_class .tdb-horiz-menu ul li.current-menu-item > a,
                .$unique_block_class .tdb-horiz-menu ul li.current-menu-ancestor > a,
                .$unique_block_class .tdb-horiz-menu ul li.current-category-ancestor > a,
                .$unique_block_class .tdb-horiz-menu ul li:hover > a {
                    color: @sub_text_color_h;
                }
                /* @sub_elem_bg_color */
                .$unique_block_class .tdb-horiz-menu ul li > a {
                    background-color: @sub_elem_bg_color;
                }
                /* @sub_elem_bg_color_h */
                .$unique_block_class .tdb-horiz-menu ul li.current-menu-item > a,
                .$unique_block_class .tdb-horiz-menu ul li.current-menu-ancestor > a,
                .$unique_block_class .tdb-horiz-menu ul li.current-category-ancestor > a,
                .$unique_block_class .tdb-horiz-menu ul li:hover > a {
                    background-color: @sub_elem_bg_color_h;
                }
                /* @sub_shadow */
                .$unique_block_class .tdb-horiz-menu ul {
                    box-shadow: @sub_shadow;
                }
                
                /* @f_sub_elem */
                .$unique_block_class .tdb-horiz-menu ul li > a {
                    @f_sub_elem
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
        }



        /*-- MAIN MENU -- */
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

        // colors
        $res_ctx->load_settings_raw( 'text_color', $res_ctx->get_shortcode_att('text_color') );
        $res_ctx->load_settings_raw( 'text_color_h', $res_ctx->get_shortcode_att('text_color_h') );
        $res_ctx->load_settings_raw( 'sep_color', $res_ctx->get_shortcode_att('sep_color') );

        // fonts
        $res_ctx->load_font_settings( 'f_elem' );



        /*-- SUB MENU -- */
        // first level left position
        $sub_first_left = $res_ctx->get_shortcode_att('sub_left');
        if( $sub_first_left != '' && is_numeric( $sub_first_left ) ) {
            $res_ctx->load_settings_raw( 'sub_left', $sub_first_left . 'px' );
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

        // colors
        $res_ctx->load_settings_raw( 'sub_bg_color', $res_ctx->get_shortcode_att('sub_bg_color') );
        $res_ctx->load_settings_raw( 'sub_text_color', $res_ctx->get_shortcode_att('sub_text_color') );
        $res_ctx->load_settings_raw( 'sub_text_color_h', $res_ctx->get_shortcode_att('sub_text_color_h') );
        $res_ctx->load_settings_raw( 'sub_elem_bg_color', $res_ctx->get_shortcode_att('sub_elem_bg_color') );
        $res_ctx->load_settings_raw( 'sub_elem_bg_color_h', $res_ctx->get_shortcode_att('sub_elem_bg_color_h') );
        $res_ctx->load_shadow_settings( 4, 1, 1, 0, 'rgba(0, 0, 0, 0.15)', 'sub_shadow' );

        // fonts
        $res_ctx->load_font_settings( 'f_sub_elem' );

    }

    function render($atts, $content = null) {

        self::disable_loop_block_features();

        parent::render($atts);

        $this->unique_block_class = $this->block_uid . '_rand';

        // additional classes
        $additional_classes = array();
        if( $this->get_att('single_line') != '' ) {
            $additional_classes[] = 'tdb-horiz-menu-singleline';
        }

        // menu id
        $menu_id = $this->get_att('menu_id');
        if( $menu_id == '' ) {
            $menu_id = get_theme_mod('nav_menu_locations')['header-menu'];
        }

        $buffy = '';

        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . ' style=" z-index: 999;">';

            $buffy .= $this->get_block_js();

            //get the block css
            $buffy .= $this->get_block_css();


            if (empty($menu_id)) {
                //td-fix-index class to fix background color z-index
                $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-fix-index">';
                    $buffy .= td_util::get_block_error('Mobile Horizontal Menu', 'Render failed - please select a menu' );
                $buffy .= '</div>';

                $buffy .= '</div>';

                return $buffy;
            }

            //td-fix-index class to fix background color z-index
            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-fix-index">';

                $buffy .= $this->inner($menu_id);  //inner content of the block

            $buffy .= '</div>';
        $buffy .= '</div>';
        return $buffy;
    }

    function inner($menu_id) {
        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (!empty($menu_id)) {
            ob_start();

            wp_nav_menu(
                array(
                    'menu' => $menu_id,
                    'menu_id' => 'tdb-horiz-menu',
                    'menu_class' => 'tdb-horiz-menu',
                    'depth' => 2,
                    'walker' => new tdb_tagdiv_walker_nav_menu($this->get_all_atts())
                )
            );

            $buffy .= ob_get_clean();

            ob_start();
            ?>
            <script>
                jQuery().ready(function () {

                    jQuery('.<?php echo $this->block_uid; ?>_rand.tdb-horiz-menu-singleline .menu-item-has-children').click(function (e) {
                        e.preventDefault();
                    })

                });
            </script>
            <?php
            td_js_buffer::add_to_footer("\n" . td_util::remove_script_tag(ob_get_clean()));
        }
        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }

}