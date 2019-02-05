<?php

/**
 * Class td_single_date
 */

class tdb_header_user extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
                
                /* @inline */
                .$unique_block_class {
                    display: inline-block;
                }
                /* @float_right */
                .$unique_block_class {
                    float: right;
                }
                /* @align_horiz_center */
                .$unique_block_class .tdb-block-inner {
                    justify-content: center;
                }
                /* @align_horiz_right */
                .$unique_block_class .tdb-block-inner {
                    justify-content: flex-end;
                }
                
                /* @photo_size */
                .$unique_block_class .tdb-head-usr-avatar {
                    width: @photo_size;
                    padding-bottom: @photo_size;
                }
                /* @photo_space */
                .$unique_block_class .tdb-head-usr-avatar {
                    margin-right: @photo_space;
                }
                /* @photo_radius */
                .$unique_block_class .tdb-head-usr-avatar {
                    border-radius: @photo_radius;
                }
                
                /* @show_log */
                .$unique_block_class .tdb-head-usr-avatar,
                .$unique_block_class .tdb-head-usr-name {
                    display: none;
                }
                /* @links_space */
                .$unique_block_class .tdb-head-usr-name {
                    margin-right: @links_space;
                }
                
                /* @icon_size */
                .$unique_block_class .tdb-head-usr-log i {
                    font-size: @icon_size;
                }
                /* @icon_space_right */
                .$unique_block_class .tdb-head-usr-log i {
                    margin-right: @icon_space_right;
                }
                /* @icon_space_left */
                .$unique_block_class .tdb-head-usr-log i {
                    margin-left: @icon_space_left;
                }
                /* @icon_align */
                .$unique_block_class .tdb-head-usr-log i {
                    top: @icon_align;
                }
                
                
                /* @usr_color */
                .$unique_block_class .tdb-head-usr-name {
                    color: @usr_color;
                }
                /* @usr_color_h */
                .$unique_block_class .tdb-head-usr-name:hover {
                    color: @usr_color_h;
                }
                
                /* @log_color */
                .$unique_block_class .tdb-head-usr-log {
                    color: @log_color;
                }
                /* @log_color_h */
                .$unique_block_class .tdb-head-usr-log:hover {
                    color: @log_color_h;
                }
                /* @log_ico_color */
                .$unique_block_class .tdb-head-usr-log i {
                    color: @log_ico_color;
                }
                /* @log_ico_color_h */
                .$unique_block_class .tdb-head-usr-log:hover i {
                    color: @log_ico_color_h;
                }
                
                
                /* @f_usr */
                .$unique_block_class .tdb-head-usr-name {
                    @f_usr
                }
                /* @f_log */
                .$unique_block_class .tdb-head-usr-log {
                    @f_log
                }
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

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



        /*-- USER PHOTO -- */
        // photo size
        $photo_size = $res_ctx->get_shortcode_att('photo_size');
        $res_ctx->load_settings_raw('photo_size', $photo_size);
        if( $photo_size != '' && is_numeric( $photo_size ) ) {
            $res_ctx->load_settings_raw('photo_size', $photo_size . 'px');
        }
        // photo space
        $photo_space = $res_ctx->get_shortcode_att('photo_space');
        if( $photo_space != '' && is_numeric( $photo_space ) ) {
            $res_ctx->load_settings_raw('photo_space', $photo_space . 'px');
        }
        // photo space
        $photo_radius = $res_ctx->get_shortcode_att('photo_radius');
        $res_ctx->load_settings_raw('photo_radius', $photo_radius);
        if( $photo_radius != '' && is_numeric( $photo_radius ) ) {
            $res_ctx->load_settings_raw('photo_radius', $photo_radius . 'px');
        }



        /*-- LOGIN / LOGOUT LINKS -- */
        // show login or logout links
        $res_ctx->load_settings_raw('show_log', $res_ctx->get_shortcode_att('show_log'));
        // links space
        $links_space = $res_ctx->get_shortcode_att('links_space');
        if( $links_space != '' && is_numeric( $links_space ) ) {
            $res_ctx->load_settings_raw('links_space', $links_space . 'px');
        }

        // icons size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        $res_ctx->load_settings_raw('icon_size', $icon_size);
        if( $icon_size != '' && is_numeric( $icon_size ) ) {
            $res_ctx->load_settings_raw('icon_size', $icon_size . 'px');
        }
        // icons space
        $icon_pos = $res_ctx->get_shortcode_att('icon_pos');
        $icon_space = $res_ctx->get_shortcode_att('icon_space');
        $res_ctx->load_settings_raw('icon_space', $icon_space);
        if( $icon_space != '' ) {
            if( is_numeric( $icon_space ) ) {
                if( $icon_pos == '' ) {
                    $res_ctx->load_settings_raw('icon_space_right', $icon_space . 'px');
                } else {
                    $res_ctx->load_settings_raw('icon_space_left', $icon_space . 'px');
                }
            }
        } else {
            if( $icon_pos == '' ) {
                $res_ctx->load_settings_raw('icon_space_right', '2px');
            } else {
                $res_ctx->load_settings_raw('icon_space_left', '2px');
            }
        }
        // icons align
        $res_ctx->load_settings_raw('icon_align', $res_ctx->get_shortcode_att('icon_align') . 'px');



        /*-- COLORS -- */
        $res_ctx->load_settings_raw('usr_color', $res_ctx->get_shortcode_att('usr_color'));
        $res_ctx->load_settings_raw('usr_color_h', $res_ctx->get_shortcode_att('usr_color_h'));

        $res_ctx->load_settings_raw('log_color', $res_ctx->get_shortcode_att('log_color'));
        $res_ctx->load_settings_raw('log_color_h', $res_ctx->get_shortcode_att('log_color_h'));
        $res_ctx->load_settings_raw('log_ico_color', $res_ctx->get_shortcode_att('log_ico_color'));
        $res_ctx->load_settings_raw('log_ico_color_h', $res_ctx->get_shortcode_att('log_ico_color_h'));



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_usr' );
        $res_ctx->load_font_settings( 'f_log' );

    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            // show login or logout links
            $show_log = $this->get_att('show_log');

            // icons position
            $icon_pos = $this->get_att('icon_pos');

            // login text
            $login_text = $this->get_att('login_txt');
            if( $login_text == '' ) {
                $login_text = 'Sign in / Join';
            }
            // login icon
            $login_icon = $this->get_att('login_tdicon');
            $login_icon_html = '';
            if( $login_icon != '' ) {
                $login_icon_html = '<i class="' . $login_icon . '"></i>';
            }
            $login_html = '<a class="td-login-modal-js tdb-head-usr-item tdb-head-usr-log" href="#login-form" data-effect="mpf-td-login-effect">';
                if( $icon_pos == '' ) {
                    $login_html .= $login_icon_html;
                }
                $login_html .= '<span class="tdb-head-usr-log-txt">' . $login_text . '</span>';
                if( $icon_pos == 'after' ) {
                    $login_html .= $login_icon_html;
                }
            $login_html .= '</a>';

            // logout text
            $logout_txt = $this->get_att('logout_txt');
            if( $logout_txt == '' ) {
                $logout_txt = 'Logout';
            }
            // logout icon
            $logout_icon = $this->get_att('logout_tdicon');
            $logout_icon_html = '';
            if( $logout_icon != '' ) {
                $logout_icon_html = '<i class="' . $logout_icon . '"></i>';
            }
            $logout_html = '<a href="' . wp_logout_url(home_url( '/' )) . '" class="tdb-head-usr-item tdb-head-usr-log">';
                if( $icon_pos == '' ) {
                    $logout_html .= $logout_icon_html;
                }
                $logout_html .= '<span class="tdb-head-usr-log-txt">' . $logout_txt . '</span>';
                if( $icon_pos == 'after' ) {
                    $logout_html .= $logout_icon_html;
                }
            $logout_html .= '</a>';


            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                if ( is_user_logged_in() ) {
                    //get current loged in user data
                    global $current_user;

                    $buffy .= '<div class="tdb-head-usr-item tdb-head-usr-avatar" style="background-image: url(' . get_avatar_url($current_user->ID, ['size' => 90]) . ')"></div>';
                    $buffy .= '<a href="' . get_author_posts_url($current_user->ID) . '" class="tdb-head-usr-item tdb-head-usr-name">' . $current_user->display_name . '</a>';

                    if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
                        if( $show_log == '' ) {
                            $buffy .= $logout_html;
                        } else {
                            $buffy .= $login_html;
                        }
                    } else {
                        $buffy .= $logout_html;
                    }
                } else {
                    $buffy .= $login_html;
                }

            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

}