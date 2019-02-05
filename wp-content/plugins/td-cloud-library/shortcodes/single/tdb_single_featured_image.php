<?php

/**
 * Class td_single_featured_image
 */


class tdb_single_featured_image extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>
    
                    /* @hide_img */
                    .$unique_block_class {
                        display: none;
                    }
    
                    /* @overlay_color */
                    .$unique_block_class:after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: @overlay_color;
                        pointer-events: none;
                    }
                    /* @overlay_gradient */
                    .$unique_block_class:after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        @overlay_gradient
                        pointer-events: none;
                    }
                    /* @caption_margin */
                    .$unique_block_class .tdb-caption-text {
                        margin: @caption_margin;
                    }
                    /* @caption_padding */
                    .$unique_block_class .tdb-caption-text {
                        padding: @caption_padding;
                    }
                    /* @caption_pos */
                    .$unique_block_class .tdb-caption-text {
                        position: absolute;
                        bottom: 0;
                        left: 0;
                    }
                    /* @caption_color */
                    .$unique_block_class .tdb-caption-text {
                        color: @caption_color;
                    }
                    /* @caption_bg */
                    .$unique_block_class .tdb-caption-text {
                        background-color: @caption_bg;
                    }
                    /* @caption_bg_gradient */
                    .$unique_block_class .tdb-caption-text {
                        @caption_bg_gradient
                    }
                    /* @hide_caption */
                    .$unique_block_class .tdb-caption-text {
                        display: none;
                    }
                    
                    
                    /* @f_caption */
                    .$unique_block_class .tdb-caption-text {
                        @f_caption
                    }
                    /* @effect_on */
                    .$unique_block_class .entry-thumb {
                        filter: @fe_brightness @fe_contrast @fe_grayscale @fe_hue_rotate @fe_saturate @fe_sepia @fe_blur;
                    }
                    
                </style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {


        global $tdb_state_single;
        $post_featured_image_data = $tdb_state_single->post_featured_image->__invoke( $res_ctx->get_atts() );
        if ( $res_ctx->get_shortcode_att('hide_img') == 'yes' && ( $post_featured_image_data['featured_image_info']['src'] == '' && ( !isset( $post_featured_image_data['video'] ) || empty( $post_featured_image_data['video'] ) ) ) ) {
            $res_ctx->load_settings_raw('hide_img', 1);
        }

        // overlay color
        $res_ctx->load_color_settings( 'overlay', 'overlay_color', 'overlay_gradient', '', '' );


        if( $post_featured_image_data['featured_image_info']['src'] != '' ) {
            /*-- CAPTION -- */
            // caption margin
            $caption_margin = $res_ctx->get_shortcode_att( 'caption_margin' );
            $res_ctx->load_settings_raw( 'caption_margin', $caption_margin );
            if( $caption_margin != '' ) {
                if( is_numeric( $caption_margin ) ) {
                    $res_ctx->load_settings_raw( 'caption_margin', $caption_margin . 'px' );
                }
            } else {
                $res_ctx->load_settings_raw( 'caption_margin', '6px 0 0' );
            }

            // caption padding
            $caption_padding = $res_ctx->get_shortcode_att( 'caption_padding' );
            $res_ctx->load_settings_raw( 'caption_padding', $caption_padding );
            if( $caption_padding != '' && is_numeric( $caption_padding ) ) {
                $res_ctx->load_settings_raw( 'caption_padding', $caption_padding . 'px' );
            }

            // caption color
            $res_ctx->load_settings_raw( 'caption_color', $res_ctx->get_shortcode_att( 'caption_color' ) );

            // caption background color
            $res_ctx->load_color_settings( 'caption_bg', 'caption_bg', 'caption_bg_gradient', '', '' );

            // hide caption
            $res_ctx->load_settings_raw( 'hide_caption', $res_ctx->get_shortcode_att( 'hide_caption' ) );


            // effects
            $res_ctx->load_settings_raw( 'fe_brightness', '');
            $res_ctx->load_settings_raw( 'fe_contrast', '');
            $res_ctx->load_settings_raw( 'fe_grayscale', '');
            $res_ctx->load_settings_raw( 'fe_hue_rotate', '');
            $res_ctx->load_settings_raw( 'fe_saturate', '');
            $res_ctx->load_settings_raw( 'fe_sepia', '');
            $res_ctx->load_settings_raw( 'fe_blur', '');

            $fe_brightness = $res_ctx->get_shortcode_att( 'fe_brightness' );
            if ( $fe_brightness != '1' ) {
                $res_ctx->load_settings_raw( 'fe_brightness', 'brightness('. $fe_brightness . ')');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }
            $fe_contrast = $res_ctx->get_shortcode_att( 'fe_contrast' );
            if ( $fe_contrast != '1' ) {
                $res_ctx->load_settings_raw( 'fe_contrast', 'contrast('. $fe_contrast . ')');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }
            $fe_grayscale = $res_ctx->get_shortcode_att( 'fe_grayscale' );
            if ( $fe_grayscale != '0' ) {
                $res_ctx->load_settings_raw( 'fe_grayscale', 'grayscale('. $fe_grayscale . ')');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }
            $fe_hue_rotate = $res_ctx->get_shortcode_att( 'fe_hue_rotate' );
            if ( $fe_hue_rotate != '0' ) {
                $res_ctx->load_settings_raw( 'fe_hue_rotate', 'hue-rotate('. $fe_hue_rotate . 'deg)');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }
            $fe_saturate = $res_ctx->get_shortcode_att( 'fe_saturate' );
            if ( $fe_saturate != '1' ) {
                $res_ctx->load_settings_raw( 'fe_saturate', 'saturate('. $fe_saturate . ')');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }
            $fe_sepia = $res_ctx->get_shortcode_att( 'fe_sepia' );
            if ( $fe_sepia != '0' ) {
                $res_ctx->load_settings_raw( 'fe_sepia', 'sepia('. $fe_sepia . ')');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }
            $fe_blur = $res_ctx->get_shortcode_att( 'fe_blur' );
            if ( $fe_blur != '0' ) {
                $res_ctx->load_settings_raw( 'fe_blur', 'blur('. $fe_blur . 'px)');
                $res_ctx->load_settings_raw( 'effect_on', 1 );
            }

            /*-- FONTS -- */
            $res_ctx->load_font_settings( 'f_caption' );
        }
    }

    /**
     * Disable loop block features. This block does not use a loop and it doesn't need to run a query.
     */
    function __construct() {
        parent::disable_loop_block_features();
    }


    function render( $atts, $content = null ) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        global $tdb_state_single;
        $post_featured_image_data = $tdb_state_single->post_featured_image->__invoke( $this->get_all_atts() );


        $additional_classes = array();

        // content align horizontal
        $content_align_horizontal = $this->get_att( 'caption_align_horiz' );
        if( !empty( $content_align_horizontal ) ) {
            $additional_classes[] = 'tdb-' . $content_align_horizontal;
        }

        $buffy = ''; //output buffer


        $buffy .= '<div class="' . $this->get_block_classes( $additional_classes ) . '" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $buffy .= '<div class="tdb-block-inner td-fix-index">';
                if( $post_featured_image_data['featured_image_info']['src'] != '' ) {

                    if ( isset( $post_featured_image_data['video'] ) and !empty( $post_featured_image_data['video'] ) ) {
                        $buffy .= $post_featured_image_data['video'];
                    } else {
                        $show_td_modal_image = $this->get_att( 'lightbox' );
                        $post_featured_image_info = $post_featured_image_data['featured_image_info'];

                        $post_featured_image_full_size_src = '';

                        if ( !empty( $post_featured_image_data['featured_image_full_size_src'] ) and is_array( $post_featured_image_data['featured_image_full_size_src'] ) ) {
                            $post_featured_image_full_size_src = $post_featured_image_data['featured_image_full_size_src']['src'];
                        }

                        if ( $show_td_modal_image === 'yes' ) {
                            $image_html = '
                                    <a 
                                        href="' . $post_featured_image_full_size_src . '" 
                                        data-caption="' . esc_attr( $post_featured_image_info['caption'], ENT_QUOTES) . '"
                                    >
                                    ';

                            $image_html .= '
                                    <img 
                                        width="' . $post_featured_image_info['width'] . '" 
                                        height="' . $post_featured_image_info['height'] . '" 
                                        class="entry-thumb td-modal-image" 
                                        src="' . $post_featured_image_info['src'] . '"' . $post_featured_image_data['srcset_sizes'] . ' 
                                        alt="' . $post_featured_image_info['alt']  . '" 
                                        title="' . $post_featured_image_info['title'] . '"
                                    />
                                    ';

                            $image_html .= '</a>';
                        } else {
                            $image_html = '
                                    <img 
                                        width="' . $post_featured_image_info['width'] . '" 
                                        height="' . $post_featured_image_info['height'] . '" 
                                        class="entry-thumb" 
                                        src="' . $post_featured_image_info['src'] . '"' .  $post_featured_image_data['srcset_sizes'] . ' 
                                        alt="' . $post_featured_image_info['alt']  . '" 
                                        title="' . $post_featured_image_info['title'] . '"
                                    />
                                    ';
                        }

                        // caption - put html5 wrapper on when we have a caption
                        if ( !empty( $post_featured_image_info['caption'] ) ) {
                            $buffy .= '<figure>';
                            $buffy .= $image_html;

                            $buffy .= '<figcaption class="tdb-caption-text">' . $post_featured_image_info['caption'] . '</figcaption>';
                            $buffy .= '</figure>';
                        } else {
                            $buffy .= $image_html;
                        }
                    }
                } else if ( isset( $post_featured_image_data['video'] ) and !empty( $post_featured_image_data['video'] ) ) {
                	    $buffy .= $post_featured_image_data['video'];
                } else {
                    $buffy .= '<div class="tdb-no-featured-img"></div>';
                }
            $buffy .= '</div>';
        $buffy .= '</div>';

        return $buffy;

    }

}