<?php

/**
 * Class td_single_date
 */

class tdb_header_logo extends td_block {

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
                /* @display */
                .$unique_block_class .tdb-logo-a,
                .$unique_block_class h1 {
                    flex-direction: @display;
                }
                /* @float_right */
                .$unique_block_class {
                    float: right;
                }
                
                /* @align_vert_center */
                .$unique_block_class .tdb-logo-a,
                .$unique_block_class h1 {
                    align-items: center;
                }
                /* @align_vert_bottom */
                .$unique_block_class .tdb-logo-a,
                .$unique_block_class h1 {
                    align-items: flex-end;
                }
                /* @align_horiz_center */
                .$unique_block_class {
                    text-align: center;
                }
                .$unique_block_class .tdb-logo-a,
                .$unique_block_class h1 {
                    justify-content: center;
                }
                /* @align_horiz_right */
                .$unique_block_class {
                    text-align: right;
                }
                .$unique_block_class .tdb-logo-a,
                .$unique_block_class h1 {
                    justify-content: flex-end;
                }
                
                
                
                /* @image_width */
                .$unique_block_class .tdb-logo-img {
                    width: @image_width;
                }
                
                /* @img_space_right */
                .$unique_block_class .tdb-logo-img-wrap {
                    margin-right: @img_space_right;
                }
                .$unique_block_class .tdb-logo-img-wrap:last-child {
                    margin-right: 0;
                }
                /* @img_space_bottom */
                .$unique_block_class .tdb-logo-img-wrap {
                    margin-bottom: @img_space_bottom;
                }
                .$unique_block_class .tdb-logo-img-wrap:last-child {
                    margin-bottom: 0;
                }
                
                /* @show_image */
                .$unique_block_class .tdb-logo-img-wrap {
                    display: @show_image;
                }
                
                
                
                /* @ttl_tag_space */
                .$unique_block_class .tdb-logo-text-tagline {
                    margin-top: @ttl_tag_space;
                }
                
                /* @show_title */
                .$unique_block_class .tdb-logo-text-title {
                    display: @show_title;
                }
                /* @show_tagline */
                .$unique_block_class .tdb-logo-text-tagline {
                    display: @show_tagline;
                }
                
                /* @tagline_align_horiz_left */
                .$unique_block_class .tdb-logo-text-tagline {
                    text-align: left;
                }
                /* @tagline_align_horiz_center */
                .$unique_block_class .tdb-logo-text-tagline {
                    text-align: center;
                }
                /* @tagline_align_horiz_right */
                .$unique_block_class .tdb-logo-text-tagline {
                    text-align: right;
                }
                
                
                
                /* @icon_size */
                .$unique_block_class .tdb-logo-icon {
                    font-size: @icon_size;
                }
                
                /* @icon_space_right */
                .$unique_block_class .tdb-logo-icon {
                    margin-right: @icon_space_right;
                }
                .$unique_block_class .tdb-logo-icon:last-child {
                    margin-right: 0;
                }
                /* @icon_space_bottom */
                .$unique_block_class .tdb-logo-icon {
                    margin-bottom: @icon_space_bottom;
                }
                .$unique_block_class .tdb-logo-icon:last-child {
                    margin-bottom: 0;
                }
                
                /* @icon_align */
                .$unique_block_class .tdb-logo-icon {
                    top: @icon_align;
                }
                
                /* @show_icon */
                .$unique_block_class .tdb-logo-icon {
                    display: @show_icon;
                }
                
                
                
                /* @text_bg */
                .$unique_block_class .tdb-logo-text-title {
                    background-image: url(@text_bg);
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
                }
				.td-md-is-ios .$unique_block_class .tdb-logo-text-title {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-logo-text-title,
				.td-md-is-ios .$unique_block_class .tdb-logo-text-title {
				    background: none;
				}
                /* @text_bg_h */
                .$unique_block_class .tdb-logo-a:hover .tdb-logo-text-title {
                    background-image: url(@text_bg_h);
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
                }
				.td-md-is-ios .$unique_block_class .tdb-logo-a:hover .tdb-logo-text-title {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-logo-a:hover .tdb-logo-text-title,
				.td-md-is-ios .$unique_block_class .tdb-logo-text-title {
				    background: none;
				}
				
				/* @text_color_solid */
                .$unique_block_class .tdb-logo-text-title {
                    color: @text_color_solid;
                }
                /* @text_color_gradient */
                .$unique_block_class .tdb-logo-text-title {
                     @text_color_gradient;
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
                }
				.td-md-is-ios .$unique_block_class .tdb-logo-text-title {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-logo-text-title,
				.td-md-is-ios .$unique_block_class .tdb-logo-text-title {
				    background: none;
					color: @text_color_gradient_1;
				}
				/* @text_color_h */
                .$unique_block_class .tdb-logo-a:hover .tdb-logo-text-title {
                    color: @text_color_h;
                    background: none;
                    -webkit-text-fill-color: initial;
                    background-position: center center;
                }
				
                /* @tagline_color_solid */
                .$unique_block_class .tdb-logo-text-tagline {
                    color: @tagline_color_solid;
                }
                /* @tagline_color_gradient */
                .$unique_block_class .tdb-logo-text-tagline {
                     @tagline_color_gradient;
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
                }
				.td-md-is-ios .$unique_block_class .tdb-logo-text-tagline {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-logo-text-tagline,
				.td-md-is-ios .$unique_block_class .tdb-logo-text-tagline {
				    background: none;
					color: @tagline_color_gradient_1;
				}
				/* @tagline_color_h */
                .$unique_block_class .tdb-logo-a:hover .tdb-logo-text-tagline {
                    color: @tagline_color_h;
                    background: none;
                    -webkit-text-fill-color: initial;
                }
				
                /* @icon_color_solid */
                .$unique_block_class .tdb-logo-icon {
                    color: @icon_color_solid;
                }
                /* @icon_color_gradient */
                .$unique_block_class .tdb-logo-icon {
                     @icon_color_gradient;
					-webkit-background-clip: text;
					-webkit-text-fill-color: transparent;
                }
				.td-md-is-ios .$unique_block_class .tdb-logo-icon {
					-webkit-text-fill-color: initial;
				}
				html[class*='ie'] .$unique_block_class .tdb-logo-icon,
				.td-md-is-ios .$unique_block_class .tdb-logo-icon {
				    background: none;
					color: @icon_color_gradient_1;
				}
				/* @icon_color_h */
                .$unique_block_class .tdb-logo-a:hover .tdb-logo-icon {
                    color: @icon_color_h;
                    background: none;
                    -webkit-text-fill-color: initial;
                }
				
				
				
                /* @f_text */
                .$unique_block_class .tdb-logo-text-title {
                    @f_text;
                }
                /* @f_tagline */
                .$unique_block_class .tdb-logo-text-tagline {
                    @f_tagline;
                }
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // display inline
        $res_ctx->load_settings_raw( 'inline', $res_ctx->get_shortcode_att('inline') );
        // display
        $res_ctx->load_settings_raw( 'display', $res_ctx->get_shortcode_att('display') );
        // float right
        $res_ctx->load_settings_raw( 'float_right', $res_ctx->get_shortcode_att('float_right') );
        // vertical align
        $align_vert = $res_ctx->get_shortcode_att('align_vert');
        if( $align_vert == 'content-vert-center' ) {
            $res_ctx->load_settings_raw( 'align_vert_center', 1 );
        } else if ( $align_vert == 'content-vert-bottom' ) {
            $res_ctx->load_settings_raw( 'align_vert_bottom', 1 );
        }
        // horizontal align
        $align_horiz = $res_ctx->get_shortcode_att('align_horiz');
        if( $align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_horiz_center', 1 );
        } else if ( $align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_horiz_right', 1 );
        }



        /*-- LOGO IMAGE -- */
        // logo image width
        $image_width = $res_ctx->get_shortcode_att('image_width');
        $res_ctx->load_settings_raw( 'image_width', $image_width );
        if( $image_width != '' && is_numeric( $image_width ) ) {
            $res_ctx->load_settings_raw( 'image_width', $image_width . 'px' );
        }

        // logo image space
        $display = $res_ctx->get_shortcode_att('display');
        $img_txt_space = $res_ctx->get_shortcode_att('img_txt_space');
        if( $img_txt_space != '' && is_numeric( $img_txt_space ) ) {
            if( $display == 'row' || $display == '' ) {
                $res_ctx->load_settings_raw( 'img_space_right', $img_txt_space . 'px' );
                $res_ctx->load_settings_raw( 'img_space_bottom', '0px' );
            } else if ( $display == 'column' ) {
                $res_ctx->load_settings_raw( 'img_space_bottom', $img_txt_space . 'px' );
                $res_ctx->load_settings_raw( 'img_space_right', '0px' );
            }
        }

        // show / hide image
        $res_ctx->load_settings_raw( 'show_image', $res_ctx->get_shortcode_att('show_image') );



        /*-- LOGO TEXT -- */
        // space between title & tagline
        $ttl_tag_space = $res_ctx->get_shortcode_att('ttl_tag_space');
        if( $ttl_tag_space != '' && is_numeric( $ttl_tag_space ) ) {
            $res_ctx->load_settings_raw( 'ttl_tag_space', $ttl_tag_space . 'px' );
        }

        // show title
        $res_ctx->load_settings_raw( 'show_title', $res_ctx->get_shortcode_att('show_title') );
        // show tagline
        $res_ctx->load_settings_raw( 'show_tagline', $res_ctx->get_shortcode_att('show_tagline') );

        // tagline horizontal align
        $tagline_align_horiz = $res_ctx->get_shortcode_att('tagline_align_horiz');
        if( $tagline_align_horiz == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'tagline_align_horiz_left', 1 );
        } else if( $tagline_align_horiz == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'tagline_align_horiz_center', 1 );
        } else if ( $tagline_align_horiz == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'tagline_align_horiz_right', 1 );
        }



        /*-- LOGO ICON -- */
        // icon size
        $icon_size = $res_ctx->get_shortcode_att('icon_size');
        if( $icon_size != '' && is_numeric( $icon_size ) ) {
            $res_ctx->load_settings_raw( 'icon_size', $icon_size . 'px' );
        }

        // icon space
        $icon_space = $res_ctx->get_shortcode_att('icon_space');
        $res_ctx->load_settings_raw( 'icon_space', $icon_space );
        if( $icon_space != '' && is_numeric( $icon_space ) ) {
            if( $display == 'row' || $display == '' ) {
                $res_ctx->load_settings_raw( 'icon_space_right', $icon_space . 'px' );
                $res_ctx->load_settings_raw( 'icon_space_bottom', '0px' );
            } else if ( $display == 'column' ) {
                $res_ctx->load_settings_raw( 'icon_space_bottom', $icon_space . 'px' );
                $res_ctx->load_settings_raw( 'icon_space_right', '0px' );
            }
        }

        // icon align
        $res_ctx->load_settings_raw( 'icon_align', $res_ctx->get_shortcode_att('icon_align') . 'px' );

        // show icon
        $res_ctx->load_settings_raw( 'show_icon', $res_ctx->get_shortcode_att('show_icon') );




        /*-- COLORS -- */
        $res_ctx->load_color_settings( 'text_color', 'text_color_solid', 'text_color_gradient', 'text_color_gradient_1', '' );
        $res_ctx->load_settings_raw( 'text_bg', tdc_util::get_image_or_placeholder( $res_ctx->get_shortcode_att('text_bg') ) );
        $res_ctx->load_settings_raw( 'text_bg_h', tdc_util::get_image_or_placeholder( $res_ctx->get_shortcode_att('text_bg_h') ) );
        $res_ctx->load_settings_raw( 'text_color_h', $res_ctx->get_shortcode_att('text_color_h') );
        $res_ctx->load_color_settings( 'tagline_color', 'tagline_color_solid', 'tagline_color_gradient', 'tagline_color_gradient_1', '' );
        $res_ctx->load_settings_raw( 'tagline_color_h', $res_ctx->get_shortcode_att('tagline_color_h') );
        $res_ctx->load_color_settings( 'icon_color', 'icon_color_solid', 'icon_color_gradient', 'icon_color_gradient_1', '' );
        $res_ctx->load_settings_raw( 'icon_color_h', $res_ctx->get_shortcode_att('icon_color_h') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_text' );
        $res_ctx->load_font_settings( 'f_tagline' );

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

            $td_use_h1_logo = false;
            if (is_home()) {
                $td_use_h1_logo = true;
            } else if (is_page()) {
                global $post;
                $_wp_page_template = get_post_meta($post->ID, '_wp_page_template', true );

                if ( 'page-pagebuilder-latest.php' === $_wp_page_template || td_util::is_pagebuilder_content($post) ) {
                    $td_use_h1_logo = true;
                }
            }


            // logo image
            $logo_image = tdc_util::get_image_or_placeholder( $this->get_att('image') );
            if( $logo_image == '' ) {
                $logo_image = td_util::get_option('tds_logo_upload');
            }
            // logo retina image
            $logo_retina_image = tdc_util::get_image_or_placeholder( $this->get_att('image_retina') );
            if( $logo_retina_image == '' ) {
                $logo_retina_image = td_util::get_option('tds_logo_upload_r');
            }
            // alt atr
            $alt_atr = rawurldecode( base64_decode( strip_tags( $this->get_att('alt') ) ) );
            if( $alt_atr == '' ) {
                $alt_atr = td_util::get_option('tds_logo_alt');
            }
            // title atr
            $title_atr = rawurldecode( base64_decode( strip_tags( $this->get_att('title') ) ) );
            if( $title_atr == '' ) {
                $title_atr = td_util::get_option('tds_logo_title');
            }


            // logo text
            $logo_text = $this->get_att('text');
            if( $logo_text == '' ) {
                $logo_text = td_util::get_option('tds_logo_text');
            }
            // logo tagline
            $logo_tagline = rawurldecode( base64_decode( strip_tags( $this->get_att('tagline') ) ) );
            if( $logo_tagline == '' ) {
                $logo_tagline = td_util::get_option('tds_tagline_text');
            }


            // logo icon
            $logo_icon = $this->get_att('tdicon');


            // logo url
            $url = $this->get_att('url');
            if( $url == '' ) {
                $url = esc_url( home_url( '/' ) );
            }
            // open in new window
            $target = '';
            if ( $this->get_att( 'open_in_new_window' ) !== '' ) {
                $target = ' target="_blank"';
            }



            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
                if( $logo_image == '' && $logo_text == '' && $logo_tagline == '' ) {
                    $logo_image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAG0AAAAbBAMAAACErRy5AAAAKlBMVEWfn58AAACfn5+fn5+fn5+fn5+fn5+fn5+fn5+fn5+fn5+fn5+fn5+fn58wOh9aAAAADnRSTlNzADZUa0UhCA8uXBdkTapN5ToAAAIvSURBVDjLrZS5TxtBFMbH9toBZKQMBHsdC4mshJIojZ1DShNpkyJBSoMF4hKFuURBwyIXiAqDKOhsgaBCAhqQaHABNUdFZ4l/iHfMtVvzitn387xvZvab5xUQH6SJnYkw/+PY4efQ+/VFkz/6XTzORpC9jetuBMWM5iXmJ6byOFG2mdQNCA5P/bIhVPwkHFH0J6Ernuq6bII9xC2ho2Z1PGFn4pylVSzGdXT883kc04a/zsFwATSE1Dd6RwpXV8B8ms3wmpb3iGQdN4pkoQLPMVc3COlfvU+NuRd5OYcj1HsLat+sq7uGtI3JMCS/iXnK7+Al6FVkFxYwOrY5wz6GQuQs2zuqUtaArO7oKlBtVkhbtm+xYFYYcXQhnU6yBf1SgnMpqP+GUZXv4HTWv66jUwfh7sswY46R4t9MYeV1dPecbWvdWUyX51k/oYM+6uGsBb7Q+72xuvcwNmm2lPClC9XG2V49DgTBOOqGsdA423J0LW4vNqyHbiMfKXtTtMuYVCi2Hd26amDZYEdwrmZ0RezqSHVFxu2XIZzBfg75igepkfkgKe7aS+xWeOaMjhbCwtX9rmDLy/Tf7vgHgnQNxKnNE3xU2S1lWd3CP/e7wLqCJS+K6Up2osMHN3GPxzX0X8Z08lDnV+YDwNEfAZVCRX2dhM6vcJqOVAffMefbhLuq8qOM6bBwErOHplRROqXd2gpXQlzkE3VwoINdvQ0+r0obxcUgWLNYXgyOIur8F7Z8eft6u608AAAAAElFTkSuQmCC';
                }
            }

            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<a class="tdb-logo-a" href="' . $url . '"' . $target . '>';
                    if( $td_use_h1_logo ) {
                        $buffy .= '<h1>';
                    }

                    if( $logo_retina_image != '' || $logo_image != '' ) {
                        $buffy .= '<div class="tdb-logo-img-wrap">';
                            if( $logo_retina_image != '' ) {
                                $buffy .= '<img class="tdb-logo-img td-retina-data" data-retina="' . esc_attr($logo_retina_image) . '" src="' . $logo_image . '" alt="' . $alt_atr . '"  title="' . $title_atr . '" />';
                            } else if( $logo_image != '' ) {
                                $buffy .= '<img class="tdb-logo-img" src="' . $logo_image . '" alt="' . $alt_atr . '"  title="' . $title_atr . '" />';
                            }
                        $buffy .= '</div>';
                    }

                    if( $logo_icon != '' ) {
                        $buffy .= '<i class="tdb-logo-icon ' . $logo_icon . '"></i>';
                    }

                    if( $logo_text != '' || $logo_tagline != '' ) {
                        $buffy .= '<div class="tdb-logo-text-wrap">';
                            if( $logo_text != '' ) {
                                $buffy .= '<div class="tdb-logo-text-title">' . $logo_text . '</div>';
                            }
                            if( $logo_tagline != '' ) {
                                $buffy .= '<div class="tdb-logo-text-tagline">' . $logo_tagline . '</div>';
                            }
                        $buffy .= '</div>';
                    }

                    if( $td_use_h1_logo ) {
                        $buffy .= '</h1>';
                    }
                $buffy .= '</a>';

            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

}