<?php
/**
 * Class tdb_search_form
 */

class tdb_search_form extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
				
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

				/* @align_center */
				.td-theme-wrap .$unique_block_class {
					text-align: center;
				}
				/* @align_right */
				.td-theme-wrap .$unique_block_class {
					text-align: right;
				}
				/* @align_left */
				.td-theme-wrap .$unique_block_class {
					text-align: left;
				}
				
				
				/* @placeholder_travel */
                .$unique_block_class .tdb-search-form-input:focus + .tdb-search-form-border + .tdb-search-form-placeholder {
                    top: -@placeholder_travel;
                    transform: translateY(0);
                }
                /* @input_padding */
                .$unique_block_class .tdb-search-form-input,
                .$unique_block_class .tdb-search-form-placeholder {
                    padding: @input_padding;
                }
				/* @border_size */
				.$unique_block_class .tdb-search-form-border {
					border-width: @border_size;
				}
				/* @border_radius */
				.$unique_block_class .tdb-search-form-inner {
					border-radius: @border_radius;
				}
				.$unique_block_class .tdb-search-form-border {
					border-radius: @border_radius;
				}
                .$unique_block_class .tdb-search-form-input {   
                    border-top-left-radius: @input_radius;
                    border-bottom-left-radius: @input_radius;
                }
				
				
				/* @btn_icon_size */
                .$unique_block_class .tdb-search-form-btn i {
                    font-size: @btn_icon_size;
                }
                /* @btn_icon_space_right */
                .$unique_block_class .tdb-search-form-btn i {
                    margin-right: @btn_icon_space_right;
                }
                /* @btn_icon_space_left */
                .$unique_block_class .tdb-search-form-btn i {
                    margin-left: @btn_icon_space_left;
                }
                /* @btn_icon_align */
                .$unique_block_class .tdb-search-form-btn i {
                    top: @btn_icon_align;
                }
                
                /* @btn_margin */
                .$unique_block_class .tdb-search-form-btn {
                    margin: @btn_margin;
                }
                /* @btn_padding */
                .$unique_block_class .tdb-search-form-btn {
                    padding: @btn_padding;
                }
				/* @btn_border_size */
				.$unique_block_class .tdb-search-form-btn {
					border-width: @btn_border_size;
					border-style: solid;
					border-color: #000;
				}
                /* @btn_radius */
                .$unique_block_class .tdb-search-form-btn {
                    border-radius: @btn_radius;
                }


				/* @msg_margin */
				.$unique_block_class .tdb-search-msg {
					margin-top: @msg_margin;
				}
				
				
				/* @input_text */
				.$unique_block_class .tdb-search-form-input {
					color: @input_text;
				}
				/* @placeholder_color */
                .$unique_block_class .tdb-search-form-placeholder {
                    color: @placeholder_color;
                }
                /* @placeholder_opacity */
                .$unique_block_class .tdb-search-form-input:focus + .tdb-search-form-placeholder {
                    opacity: @placeholder_opacity;
                }
				/* @input_bg */
				.$unique_block_class .tdb-search-form-inner {
					background-color: @input_bg;
				}
				/* @input_border */
				.$unique_block_class .tdb-search-form-border {
					border-color: @input_border;
				}
				/* @input_border_h */
				.$unique_block_class .tdb-search-form-input:focus + .tdb-search-form-placeholder + .tdb-search-form-border {
					border-color: @input_border_h !important;
				}
                /* @input_shadow */
                .$unique_block_class .tdb-search-form-inner {
                    box-shadow: @input_shadow;
                }
				
				/* @btn_text_color */
				.$unique_block_class .tdb-search-form-btn {
					color: @btn_text_color;
				}
				/* @btn_text_h */
				.$unique_block_class .tdb-search-form-btn:hover {
					color: @btn_text_h;
				}
                /* @btn_icon_color */
                .$unique_block_class .tdb-search-form-btn i {
                    color: @btn_icon_color;
                }
                /* @btn_icon_color_h */
                .$unique_block_class .tdb-search-form-btn:hover i {
                    color: @btn_icon_color_h;
                }
				/* @btn_bg */
				.$unique_block_class .tdb-search-form-btn {
					background-color: @btn_bg;
				}
				/* @btn_bg_h */
				.$unique_block_class .tdb-search-form-btn:hover {
					background-color: @btn_bg_h;
				}
				/* @btn_border */
				.$unique_block_class .tdb-search-form-btn {
					border-color: @btn_border;
				}
				/* @btn_border_h */
				.$unique_block_class .tdb-search-form-btn:hover {
					border-color: @btn_border_h;
				}
                /* @btn_shadow */
                .$unique_block_class .tdb-search-form-btn {
                    box-shadow: @btn_shadow;
                }
				
				/* @msg_color */
				.$unique_block_class .tdb-search-msg {
					color: @msg_color;
				}
				
				
				/* @f_input */
				.$unique_block_class .tdb-search-form-input {
				    @f_input
				}
                /* @f_placeholder */
                .$unique_block_class .tdb-search-form-placeholder {
                    @f_placeholder
                }
				/* @f_btn */
				.$unique_block_class .tdb-search-form-btn {
				    @f_btn
				}
				/* @f_msg */
				.$unique_block_class .tdb-search-msg {
				    @f_msg
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // block width
        $width = $res_ctx->get_shortcode_att('width');
        $res_ctx->load_settings_raw( 'width', $width );
        if( $width != '' && is_numeric( $width ) ) {
            $res_ctx->load_settings_raw( 'width', $width . 'px' );
        }
        // make inline
        $res_ctx->load_settings_raw( 'inline', $res_ctx->get_shortcode_att('inline') );
        // align to right
        $res_ctx->load_settings_raw( 'float_right', $res_ctx->get_shortcode_att('float_right') );
        // content align
        $content_align = $res_ctx->get_shortcode_att('content_align_horizontal');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'align_left', 1 );
        }


        /*-- INPUT -- */
        // placeholder travel
        $res_ctx->load_settings_raw('placeholder_travel', $res_ctx->get_shortcode_att('placeholder_travel') + 50 . '%');
        // input padding
        $input_padding = $res_ctx->get_shortcode_att('input_padding');
        $res_ctx->load_settings_raw('input_padding', $input_padding);
        if ($input_padding != '' && is_numeric($input_padding)) {
            $res_ctx->load_settings_raw('input_padding', $input_padding . 'px');
        }
        // border size
        $border_size = $res_ctx->get_shortcode_att('border_size');
        $res_ctx->load_settings_raw( 'border_size', $border_size );
        if( $border_size != '' && is_numeric( $border_size ) ) {
            $res_ctx->load_settings_raw( 'border_size', $border_size . 'px' );
        }
        // border radius
        $border_radius = $res_ctx->get_shortcode_att('border_radius');
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' && is_numeric( $border_radius ) ) {
            $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
        }



        /*-- BUTTON -- */
        // button icon size
        $btn_icon_size = $res_ctx->get_shortcode_att('btn_icon_size');
        $res_ctx->load_settings_raw('btn_icon_size', $btn_icon_size);
        if ($btn_icon_size != '' && is_numeric($btn_icon_size)) {
            $res_ctx->load_settings_raw('btn_icon_size', $btn_icon_size . 'px');
        }
        // button icon space
        $btn_icon_pos = $res_ctx->get_shortcode_att('btn_icon_pos');
        $btn_icon_space = $res_ctx->get_shortcode_att('btn_icon_space');
        if ($btn_icon_space != '' && is_numeric($btn_icon_space)) {
            if( $btn_icon_pos == '' ) {
                $res_ctx->load_settings_raw('btn_icon_space_right', $btn_icon_space . 'px');
            } else {
                $res_ctx->load_settings_raw('btn_icon_space_left', $btn_icon_space . 'px');
            }
        }
        // button icon align
        $res_ctx->load_settings_raw('btn_icon_align', $res_ctx->get_shortcode_att('btn_icon_align') . 'px');

        // button margin
        $btn_margin = $res_ctx->get_shortcode_att('btn_margin');
        $res_ctx->load_settings_raw('btn_margin', $btn_margin);
        if ($btn_margin != '' && is_numeric($btn_margin)) {
            $res_ctx->load_settings_raw('btn_margin', $btn_margin . 'px');
        }
        // button padding
        $btn_padding = $res_ctx->get_shortcode_att('btn_padding');
        $res_ctx->load_settings_raw('btn_padding', $btn_padding);
        if ($btn_padding != '' && is_numeric($btn_padding)) {
            $res_ctx->load_settings_raw('btn_padding', $btn_padding . 'px');
        }
        // button border size
        $btn_border_size = $res_ctx->get_shortcode_att('btn_border_size');
        $res_ctx->load_settings_raw( 'btn_border_size', $btn_border_size );
        if( $btn_border_size != '' && is_numeric( $btn_border_size ) ) {
            $res_ctx->load_settings_raw( 'btn_border_size', $btn_border_size . 'px' );
        }
        // button border radius
        $btn_radius = $res_ctx->get_shortcode_att('btn_radius');
        $res_ctx->load_settings_raw('btn_radius', $btn_radius);
        if ($btn_radius != '' && is_numeric($btn_radius)) {
            $res_ctx->load_settings_raw('btn_radius', $btn_radius . 'px');
        }



        /*-- RESULTS MESSAGE -- */
        // message top margin
        $msg_margin = $res_ctx->get_shortcode_att('msg_margin');
        if( $msg_margin != '' ) {
            if( is_numeric( $msg_margin ) ) {
                $res_ctx->load_settings_raw( 'msg_margin', $res_ctx->get_shortcode_att('msg_margin') . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'msg_margin', '11px' );
        }



        /*-- COLORS -- */
        $res_ctx->load_settings_raw( 'input_text', $res_ctx->get_shortcode_att('input_text') );
        $res_ctx->load_settings_raw( 'placeholder_color', $res_ctx->get_shortcode_att('placeholder_color') );
        $res_ctx->load_settings_raw( 'placeholder_opacity', $res_ctx->get_shortcode_att('placeholder_opacity') );
        $res_ctx->load_settings_raw( 'input_bg', $res_ctx->get_shortcode_att('input_bg') );
        $res_ctx->load_settings_raw( 'input_border', $res_ctx->get_shortcode_att('input_border') );
        $res_ctx->load_settings_raw( 'input_border_h', $res_ctx->get_shortcode_att('input_border_h') );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0,  'rgba(0, 0, 0, 0.2)', 'input_shadow' );

        $res_ctx->load_settings_raw( 'btn_icon_color', $res_ctx->get_shortcode_att('btn_icon_color') );
        $res_ctx->load_settings_raw( 'btn_icon_color_h', $res_ctx->get_shortcode_att('btn_icon_color_h') );
        $res_ctx->load_settings_raw( 'btn_text_color', $res_ctx->get_shortcode_att('btn_text_color') );
        $res_ctx->load_settings_raw( 'btn_text_h', $res_ctx->get_shortcode_att('btn_text_h') );
        $res_ctx->load_settings_raw( 'btn_bg', $res_ctx->get_shortcode_att('btn_bg') );
        $res_ctx->load_settings_raw( 'btn_bg_h', $res_ctx->get_shortcode_att('btn_bg_h') );
        $res_ctx->load_settings_raw( 'btn_border', $res_ctx->get_shortcode_att('btn_border') );
        $res_ctx->load_settings_raw( 'btn_border_h', $res_ctx->get_shortcode_att('btn_border_h') );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0,  'rgba(0, 0, 0, 0.2)', 'btn_shadow' );

        $res_ctx->load_settings_raw( 'msg_color', $res_ctx->get_shortcode_att('msg_color') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_input' );
        $res_ctx->load_font_settings( 'f_placeholder' );
        $res_ctx->load_font_settings( 'f_btn' );
        $res_ctx->load_font_settings( 'f_msg' );

    }

    // disable loop block features. This block does not use a loop and it doesn't need to run a query.
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts );

        global $tdb_state_search;
        $search_form_data = $tdb_state_search->search_form->__invoke( $atts );

        // input placeholder
        $input_placeholder = $this->get_att('input_placeholder');
        if( $input_placeholder != '' ) {
            $input_placeholder = '<div class="tdb-search-form-placeholder">' . $input_placeholder . '</div>';
        }

        // button text
        $btn_text = $this->get_att('btn_text');
        if( $btn_text != '' ) {
            $btn_text = '<span>' . $btn_text . '</span>';
        }

        // button icon
        $btn_icon_pos = $this->get_att('btn_icon_pos');
        $btn_icon = $this->get_att('btn_tdicon');
        if( $btn_icon != '' ) {
            $btn_icon = '<i class="' . $this->get_att('btn_tdicon') . '"></i>';
        }

        $message = $this->get_att( 'message' );


        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';

                $buffy .= '<form method="get" class="tdb-search-form" action="' . esc_url(home_url( '/' )) . '">';
                    $buffy .= '<div role="search" class="tdb-search-form-inner">';
                        $buffy .= '<input class="tdb-search-form-input" type="text" value="' . $search_form_data['search_query'] . '" name="s" id="s" />';
                        $buffy .= '<div class="tdb-search-form-border"></div>';
                        $buffy .= $input_placeholder;
                        $buffy .= '<button class="wpb_button wpb_btn-inverse tdb-search-form-btn" type="submit" id="searchsubmit">';
                            if( $btn_icon_pos == '' ) {
                                $buffy .= $btn_icon;
                            }
                            $buffy .= $btn_text;
                            if( $btn_icon_pos == 'after' ) {
                                $buffy .= $btn_icon;
                            }
                    $buffy .= '</div>';
                $buffy .= '</form>';

                if( $message != '' ) {
                    if( $search_form_data['results_msg'] ||
                        ( ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() )
                            && $this->get_att('show_message') == 'yes' ) ) {
                        $buffy .= '<div class="tdb-search-msg">';
                            $buffy .= rawurldecode( base64_decode( strip_tags( $message ) ) );
                        $buffy .= '</div>';
                    }
                }

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }


}