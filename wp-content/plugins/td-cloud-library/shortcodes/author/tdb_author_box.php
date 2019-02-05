<?php


/**
 * Class tdb_author_box
 */

class tdb_author_box extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @box_padding */
                .$unique_block_class {
                    padding: @box_padding;
                }
                /* @all_border_width */
                .$unique_block_class {
                    border: @all_border_width @all_border_style @all_border_color;
                }
                
                
                
                /* @count_color */
                .$unique_block_class .tdb-author-counters span {
                    color: @count_color;
                }
                /* @count_bg_color */
                .$unique_block_class .tdb-author-counters span {
                    background-color: @count_bg_color;
                }
                /* @counter_margin */
                .$unique_block_class .tdb-author-counters span {
                    margin: @counter_margin;
                }
                /* @counter_padding */
                .$unique_block_class .tdb-author-counters span {
                    padding: @counter_padding;
                }
                /* @url_color */
                .$unique_block_class .tdb-author-url {
                    color: @url_color;
                }
                /* @url_h_color */
                .$unique_block_class .tdb-author-url:hover {
                    color: @url_h_color;
                }
                /* @descr_color */
                .$unique_block_class .tdb-author-descr {
                    color: @descr_color;
                }
                /* @add_description_margin */
                .$unique_block_class .tdb-author-descr {
                    margin: @add_description_margin;
                }
                
                
                /* @photo_size */
                .$unique_block_class .tdb-author-photo {
                    width: @photo_size;
                }
                /* @photo_space */
                @media (min-width: 767px) {
                    .$unique_block_class .tdb-author-photo {
                        padding-right: @photo_space;
                    }
                }
                @media (max-width: 767px) {
                    .$unique_block_class .tdb-author-photo {
                        margin-bottom: @photo_space;
                    }
                }
                
                /* @photo_radius */
                .$unique_block_class .tdb-author-photo img {
                    border-radius: @photo_radius;
                }
                
                /* @icons_size */
				.$unique_block_class .tdb-social-item i {
					font-size: @icons_size;
					vertical-align: middle;
				}
				.$unique_block_class .tdb-social-item i.td-icon-twitter,
				.$unique_block_class .tdb-social-item i.td-icon-linkedin,
				.$unique_block_class .tdb-social-item i.td-icon-pinterest,
				.$unique_block_class .tdb-social-item i.td-icon-blogger,
				.$unique_block_class .tdb-social-item i.td-icon-vimeo {
					font-size: @icons_size_fix;
				}
				/* @icons_padding */
				.$unique_block_class .tdb-social-item {
					min-width: @icons_padding;
					height: @icons_padding;
				}
				.$unique_block_class .tdb-social-item i {
					line-height: @icons_padding;
				}
				/* @icons_margin_right */
				.$unique_block_class .tdb-social-item {
				    margin: @icons_margin_top_bottom @icons_margin_right @icons_margin_top_bottom 0;
				}
				
				/* @icons_color */
				.$unique_block_class .tdb-social-item i {
					color: @icons_color;
				}
				/* @icons_h_color */
				.$unique_block_class .tdb-social-item:hover i {
					color: @icons_h_color;
				}
				/* @icons_bg */
				.$unique_block_class .tdb-social-item {
					background-color: @icons_bg;
				}
				/* @icons_h_bg */
				.$unique_block_class .tdb-social-item:hover {
					background-color: @icons_h_bg;
				}
				
				/* @icons_border_radius */
				.$unique_block_class .tdb-social-item {
					border-radius: @icons_border_radius;
				}
				


				/* @f_count */
				.$unique_block_class .tdb-author-counters span {
					@f_count
				}
				/* @f_url */
				.$unique_block_class .tdb-author-url {
					@f_url
				}
				/* @f_descr */
				.$unique_block_class .tdb-author-descr {
					@f_descr
				}      
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // box padding
        $box_padding = $res_ctx->get_shortcode_att( 'box_padding' );
        $res_ctx->load_settings_raw( 'box_padding', $box_padding );
        if( $box_padding != '' && is_numeric( $box_padding )  ) {
            $res_ctx->load_settings_raw( 'box_padding', $box_padding . 'px' );
        } else {
            $res_ctx->load_settings_raw( 'box_padding', '21px' );
        }

        // author name color
        $res_ctx->load_settings_raw( 'count_color', $res_ctx->get_shortcode_att( 'count_color' ) );

        // author name hover color
        $res_ctx->load_settings_raw( 'count_bg_color', $res_ctx->get_shortcode_att( 'count_bg_color' ) );

        // author url color
        $res_ctx->load_settings_raw( 'url_color', $res_ctx->get_shortcode_att( 'url_color' ) );

        // author url hover color
        $res_ctx->load_settings_raw( 'url_h_color', $res_ctx->get_shortcode_att( 'url_h_color' ) );

        // author url hover color
        $res_ctx->load_settings_raw( 'descr_color', $res_ctx->get_shortcode_att( 'descr_color' ) );



        /*-- BOX BORDER -- */
        // border width
        $border_width = $res_ctx->get_shortcode_att( 'all_border_width' );
        $res_ctx->load_settings_raw( 'all_border_width', '1px' );
        if( $border_width != '' && is_numeric( $border_width ) ) {
            $res_ctx->load_settings_raw( 'all_border_width', $border_width . 'px' );
        }

        // border style
        $border_style = $res_ctx->get_shortcode_att( 'all_border_style' );
        $res_ctx->load_settings_raw( 'all_border_style', 'solid' );
        if( $border_style != '' ) {
            $res_ctx->load_settings_raw( 'all_border_style', $border_style );
        }

        // border color
        $border_color = $res_ctx->get_shortcode_att( 'all_border_color' );
        $res_ctx->load_settings_raw( 'all_border_color', '#ededed' );
        if( $border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $border_color );
        }



        /*-- AUTHOR PHOTO -- */
        // author photo size
        $photo_size = $res_ctx->get_shortcode_att( 'photo_size' );
        $res_ctx->load_settings_raw( 'photo_size', '96px' );
        if( $photo_size != '' && is_numeric( $photo_size ) ) {
            $res_ctx->load_settings_raw( 'photo_size', $photo_size . 'px' );
        }

        // author photo space
        $photo_space = $res_ctx->get_shortcode_att( 'photo_space' );
        $res_ctx->load_settings_raw( 'photo_space', '21px' );
        if( $photo_space != '' && is_numeric( $photo_space ) ) {
            $res_ctx->load_settings_raw( 'photo_space', $photo_space . 'px' );
        }

        //author photo border radius
        $photo_radius = $res_ctx->get_shortcode_att( 'photo_radius' );
        $res_ctx->load_settings_raw( 'photo_radius', $photo_radius );
        if( $photo_radius != '' && is_numeric( $photo_radius ) ) {
            $res_ctx->load_settings_raw( 'photo_radius', $photo_radius . 'px' );
        }

        /*-- NAME & DESCRIPTION MARGINS -- */
        // counters margin
        $counter_margin = $res_ctx->get_shortcode_att( 'counter_margin' );
        $res_ctx->load_settings_raw( 'counter_margin', $counter_margin );
        if( $counter_margin != '' && is_numeric( $counter_margin )  ) {
            $res_ctx->load_settings_raw( 'counter_margin', $counter_margin . 'px' );
        }

        // counters padding
        $counter_padding = $res_ctx->get_shortcode_att( 'counter_padding' );
        $res_ctx->load_settings_raw( 'counter_padding', $counter_padding );
        if( $counter_padding != '' && is_numeric( $counter_padding )  ) {
            $res_ctx->load_settings_raw( 'counter_padding', $counter_padding . 'px' );
        }

        // add description margin
        $add_description_margin = $res_ctx->get_shortcode_att( 'add_description_margin' );
        $res_ctx->load_settings_raw( 'add_description_margin', $add_description_margin );
        if( $add_description_margin != '' && is_numeric( $add_description_margin )  ) {
            $res_ctx->load_settings_raw( 'add_description_margin', $add_description_margin . 'px' );
        }

        /*-- SOCIAL ICONS -- */
        // icons size
        $icons_size = $res_ctx->get_shortcode_att( 'icons_size' );
        $res_ctx->load_settings_raw( 'icons_size',  $icons_size . 'px' );
        $res_ctx->load_settings_raw(  'icons_size_fix', $icons_size * 0.8  . 'px');

        // icons padding
        $res_ctx->load_settings_raw( 'icons_padding', $icons_size * $res_ctx->get_shortcode_att( 'icons_padding' ) . 'px' );

        // icons spacing
        $icons_spacing = $res_ctx->get_shortcode_att( 'icons_spacing' );
        if( $icons_spacing != '' ) {
            if ( is_numeric( $icons_spacing ) ) {
                $res_ctx->load_settings_raw( 'icons_margin_right',  $icons_spacing . 'px' );
                $res_ctx->load_settings_raw( 'icons_margin_top_bottom',  $icons_spacing / 2 . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icons_margin_right', '14px' );
            $res_ctx->load_settings_raw( 'icons_margin_top_bottom', '7px' );
        }

        //icons border radius
        $icons_border_radius = $res_ctx->get_shortcode_att( 'icons_border_radius' );
        $res_ctx->load_settings_raw( 'icons_border_radius', $icons_border_radius );
        if( $icons_border_radius != '' && is_numeric( $icons_border_radius ) ) {
            $res_ctx->load_settings_raw( 'icons_border_radius', $icons_border_radius . 'px' );
        }

        // icons color
        $res_ctx->load_settings_raw( 'icons_color', $res_ctx->get_shortcode_att( 'icons_color' ) );

        // icons background color
        $res_ctx->load_settings_raw( 'icons_bg', $res_ctx->get_shortcode_att( 'icons_bg' ) );

        // icons hover color
        $res_ctx->load_settings_raw( 'icons_h_color', $res_ctx->get_shortcode_att( 'icons_h_color' ) );

        // icons background hover color
        $res_ctx->load_settings_raw( 'icons_h_bg', $res_ctx->get_shortcode_att( 'icons_h_bg' ) );




        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_count' );
        $res_ctx->load_font_settings( 'f_url' );
        $res_ctx->load_font_settings( 'f_descr' );

    }


    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_author;
        $author_box_data = $tdb_state_author->box->__invoke( $atts );

        $additional_classes = array();

        // add target attribute if the block configuration is set to open in new window
        $td_target = '';
        $open_in_new_window = $this->get_att( 'open_in_new_window' );
        if ( !empty( $open_in_new_window ) ) {
            $td_target = ' target="_blank" ';
        }

        $content_align_vertical = $this->get_att('align_vert');
        if( !empty( $content_align_vertical ) ) {
            $additional_classes[] = 'tdb-' . $content_align_vertical;
        }

        $buffy = ''; //output buffer

        $buffy .= '<div class="tdb-author-box ' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                $buffy .= '<a href="' . $author_box_data['url'] . '" class="tdb-author-photo">' . $author_box_data['avatar'] . '</a>';

                $buffy .= '<div class="tdb-author-info">';
                    $buffy .= '<div class="tdb-author-counters">';
                        $buffy.= '<span class="tdb-author-post-count">' . $author_box_data['posts-count'] . ' '  . __td('POSTS', TD_THEME_NAME) . '</span>';
                        $buffy.= '<span class="tdb-author-comments-count">' . $author_box_data['comments-count'] . ' '  . __td('COMMENTS', TD_THEME_NAME) . '</span>';
                    $buffy .= '</div>';

                    if ( !empty( $author_box_data['url'] ) ) {
                        $buffy .= '<a href="' . $author_box_data['url'] . '" ' . $td_target . ' class="tdb-author-url">' . $author_box_data['url'] . '</a>';
                    }

                    $buffy .= '<div class="tdb-author-descr">' . $author_box_data['description'] . '</div>';

                    $buffy .= '<div class="tdb-author-social">';
                        if ( !empty( $author_box_data['social_icons'] ) ) {
                            foreach ( $author_box_data['social_icons'] as $td_social_icon ) {
                                $buffy .= '<a href="' . $td_social_icon['social_link'] . '" target="_blank" title="' . $td_social_icon['social_id'] . '" class="tdb-social-item">';
                                    $buffy .= '<i class="td-icon-font td-icon-' . $td_social_icon['social_id'] . '"></i>';
                                $buffy .= '</a>';
                            }
                        }
                    $buffy .= '</div>';
                $buffy .= '</div>';

            $buffy .= '</div>';

        $buffy .= '</div>';

        return $buffy;
    }

}