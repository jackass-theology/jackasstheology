<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_newsletter3 extends td_style {

    private $unique_style_class;
    private $unique_block_class;
    private $atts = array();
    private $index_style;

    function __construct( $atts, $unique_block_class = '', $index_style = '') {
        $this->atts = $atts;
        $this->unique_block_class = $unique_block_class;
        $this->index_style = $index_style;
    }

    private function get_css() {

        $compiled_css = '';

        $unique_style_class = $this->unique_style_class;

        $unique_block_class = '';
        if ( !empty( $this->unique_block_class ) ) {
            $unique_block_class = '.' . $this->unique_block_class;
        }

        $raw_css =
            "<style>

                /* @title_color */
                .$unique_style_class .tdn-title {
                    color: @title_color;
                }
                /* @description_color*/
                .$unique_style_class .tdn-descr {
                    color: @description_color;
                }
                /* @disclaimer_color */
                .$unique_style_class .tdn-disclaimer1 {
                    color: @disclaimer_color;
                }
                /* @disclaimer2_color */
                .$unique_style_class .tdn-disclaimer2 {
                    color: @disclaimer2_color;
                }
                

                /* @all_border_width */
                $unique_block_class {
                    border: @all_border_width @all_border_style @all_border_color;
                }
                /* @border_radius */
                $unique_block_class {
                    border-radius: @border_radius;
                }
                

                /* @input_text_color */
                .$unique_style_class input {
                    color: @input_text_color;
                }
                /* @input_placeholder_color */
                .$unique_style_class input::placeholder {
                    color: @input_placeholder_color;
                }
                .$unique_style_class input:-ms-input-placeholder {
                    color: @input_placeholder_color !important;
                }
                /* @input_bg_color */
                .$unique_style_class input {
                    background-color: @input_bg_color;
                }
                /* @input_border_color */
                .$unique_style_class input {
                    border-color: @input_border_color;
                }
                /* @input_border_color_active */
                .$unique_style_class input:focus {
                    border-color: @input_border_color_active !important;
                }
                
                
                /* @btn_text_color */
                .$unique_style_class button {
                    color: @btn_text_color;
                }
                /* @btn_bg_color */
                .$unique_style_class button {
                    background-color: @btn_bg_color;
                }
                /* @btn_text_color_hover */
                .$unique_style_class button:hover {
                   color: @btn_text_color_hover;
                }
                /* @btn_bg_color_hover */
                .$unique_style_class button:hover {
                    background-color: @btn_bg_color_hover;
                }
                
                
                /* @input_bar_border_radius */
                .$unique_style_class.tdn-input-bar-display-column input {
                    border-top-left-radius: @input_bar_border_radius;
                    border-bottom-left-radius: @input_bar_border_radius;
                }
                .$unique_style_class.tdn-input-bar-display-column button {
                    border-top-right-radius: @input_bar_border_radius;
                    border-bottom-right-radius: @input_bar_border_radius;
                }
                .$unique_style_class.tdn-input-bar-display-row input {
                    border-radius: @input_bar_border_radius;
                }
                .$unique_style_class.tdn-input-bar-display-row button {
                    border-radius: @input_bar_border_radius;
                }
                
                
                /* @check_size */
                .$unique_style_class .av-checkbox+label .tdn-check {
                    width: @check_size;
                    height: @check_size;
                }
                .$unique_style_class .av-checkbox+label .tdn-check:after {
                    width: calc(@check_size - 10px);
                    height: calc(@check_size - 10px);
                }
                /* @check_space */
                .$unique_style_class .tdn-checkbox {
                    margin-bottom: @check_space;
                }
                /* @check_label_space */
                .$unique_style_class .av-checkbox+label .tdn-check-title {
                    margin-left: @check_label_space;
                }
                /* @check_border */
                .$unique_style_class .av-checkbox+label .tdn-check {
                    border-color: @check_border;
                }
                /* @check_accent */
                .$unique_style_class .av-checkbox+label .tdn-check:after {
                    background-color: @check_accent;
                }
                /* @check_label */
                .$unique_style_class .av-checkbox+label .tdn-check-title {
                    color: @check_label;
                }



				/* @f_title */
				.$unique_style_class .tdn-title {
					@f_title
				}
				/* @f_descr */
				.$unique_style_class .tdn-descr {
					@f_descr
				}
				/* @f_disclaimer */
				.$unique_style_class .tdn-disclaimer1 {
					@f_disclaimer
				}
				/* @f_disclaimer2 */
				.$unique_style_class .tdn-disclaimer2 {
					@f_disclaimer2
				}
				/* @f_input */
				.$unique_style_class input[type=email],
				.$unique_style_class button {
					@f_input
				}
				/* @f_btn */
				.$unique_style_class button {
					@f_btn
				}
				/* @f_check */
				.$unique_style_class .av-checkbox+label .tdn-check-title {
					@f_check
				}
				

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts);

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    /**
     * Callback pe media
     *
     * @param $res_ctx - $responsive_context td_res_context
     */
    static function cssMedia( $res_ctx ) {

        /*-- BORDER -- */
        // border width
        $border_width = $res_ctx->get_style_att( 'all_border_width', __CLASS__ );
        $res_ctx->load_settings_raw( 'all_border_width', '1px' );
        if( $border_width != '' ) {
            if( is_numeric( $border_width ) ) {
                $res_ctx->load_settings_raw( 'all_border_width', $border_width . 'px' );
            }
        }
        // border style
        $border_style = $res_ctx->get_style_att( 'all_border_style', __CLASS__ );
        $res_ctx->load_settings_raw( 'all_border_style', 'solid' );
        if( $border_style != '' ) {
            $res_ctx->load_settings_raw( 'all_border_style', $border_style );
        }
        // border color
        $border_color = $res_ctx->get_style_att( 'all_border_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'all_border_color', '#eee' );
        if( $border_color != '' ) {
            $res_ctx->load_settings_raw( 'all_border_color', $border_color );
        }
        // border radius
        $border_radius = $res_ctx->get_style_att( 'border_radius', __CLASS__  );
        $res_ctx->load_settings_raw( 'border_radius', $border_radius );
        if( $border_radius != '' ) {
            if( is_numeric( $border_radius ) ) {
                $res_ctx->load_settings_raw( 'border_radius', $border_radius . 'px' );
            }
        }



        /*-- TEXT -- */
        // title color
        $res_ctx->load_settings_raw( 'title_color', $res_ctx->get_style_att( 'title_color', __CLASS__ ) );
        // description color
        $res_ctx->load_settings_raw( 'description_color', $res_ctx->get_style_att( 'description_color', __CLASS__ ) );
        // disclaimer color
        $res_ctx->load_settings_raw( 'disclaimer_color', $res_ctx->get_style_att( 'disclaimer_color', __CLASS__ ) );
        // disclaimer 2 color
        $res_ctx->load_settings_raw( 'disclaimer2_color', $res_ctx->get_style_att( 'disclaimer2_color', __CLASS__ ) );



        /*-- EMAIL INPUT BAR -- */
        // input text color
        $res_ctx->load_settings_raw( 'input_text_color', $res_ctx->get_style_att( 'input_text_color', __CLASS__ ) );
        // input placeholder color
        $res_ctx->load_settings_raw( 'input_placeholder_color', $res_ctx->get_style_att( 'input_placeholder_color', __CLASS__ ) );
        // input background color
        $res_ctx->load_settings_raw( 'input_bg_color', $res_ctx->get_style_att( 'input_bg_color', __CLASS__ ) );
        // input border color
        $res_ctx->load_settings_raw( 'input_border_color', $res_ctx->get_style_att( 'input_border_color', __CLASS__ ) );
        // input border actve color
        $res_ctx->load_settings_raw( 'input_border_color_active', $res_ctx->get_style_att( 'input_border_color_active', __CLASS__ ) );
        // input bar border radius
        $input_bar_border_radius = $res_ctx->get_style_att('input_bar_border_radius', __CLASS__);
        $res_ctx->load_settings_raw( 'input_bar_border_radius', $input_bar_border_radius );
        if( $input_bar_border_radius != '' ) {
            if( is_numeric( $input_bar_border_radius ) ) {
                $res_ctx->load_settings_raw( 'input_bar_border_radius', $input_bar_border_radius . 'px' );
            }
        }



        /*-- CHECKBOX -- */
        // checkbox size
        $check_size = $res_ctx->get_style_att( 'check_size', __CLASS__ );
        if( $check_size != '' && is_numeric( $check_size ) ) {
            $res_ctx->load_settings_raw( 'check_size', $check_size . 'px' );
        }
        // checkbox space
        $check_space = $res_ctx->get_style_att( 'check_space', __CLASS__ );
        if( $check_space != '' && is_numeric( $check_space ) ) {
            $res_ctx->load_settings_raw( 'check_space', $check_space . 'px' );
        }
        // checkbox label space
        $check_label_space = $res_ctx->get_style_att( 'check_label_space', __CLASS__ );
        if( $check_label_space != '' && is_numeric( $check_label_space ) ) {
            $res_ctx->load_settings_raw( 'check_label_space', $check_label_space . 'px' );
        }
        // checkbox border color
        $res_ctx->load_settings_raw( 'check_border', $res_ctx->get_style_att( 'check_border', __CLASS__ ) );
        // checkbox active accent color
        $res_ctx->load_settings_raw( 'check_accent', $res_ctx->get_style_att( 'check_accent', __CLASS__ ) );
        // checkbox label text color
        $res_ctx->load_settings_raw( 'check_label', $res_ctx->get_style_att( 'check_label', __CLASS__ ) );



        /*-- BUTTON -- */
        // button text color
        $res_ctx->load_settings_raw( 'btn_text_color', $res_ctx->get_style_att( 'btn_text_color', __CLASS__ ) );
        // button hover text color
        $res_ctx->load_settings_raw( 'btn_text_color_hover', $res_ctx->get_style_att( 'btn_text_color_hover', __CLASS__ ) );
        // button background color
        $res_ctx->load_settings_raw( 'btn_bg_color', $res_ctx->get_style_att( 'btn_bg_color', __CLASS__ ) );
        // button hover background color
        $res_ctx->load_settings_raw( 'btn_bg_color_hover', $res_ctx->get_style_att( 'btn_bg_color_hover', __CLASS__ ) );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title', __CLASS__ );
        $res_ctx->load_font_settings( 'f_descr', __CLASS__ );
        $res_ctx->load_font_settings( 'f_disclaimer', __CLASS__ );
        $res_ctx->load_font_settings( 'f_disclaimer2', __CLASS__ );
        $res_ctx->load_font_settings( 'f_input', __CLASS__ );
        $res_ctx->load_font_settings( 'f_btn', __CLASS__ );
        $res_ctx->load_font_settings( 'f_check', __CLASS__ );

    }

    function render( $index_style = '' ) {

        if ( ! empty( $index_style ) ) {
            $this->index_style = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        $title_text = $this->get_shortcode_att( 'title_text', $this->index_style);
        $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'description', $this->index_style ) ) ) );
        $disclaimer = $this->get_shortcode_att( 'disclaimer', $this->index_style);
        $disclaimer2 = $this->get_shortcode_att( 'disclaimer2', $this->index_style);
        $input_placeholder = $this->get_shortcode_att('input_placeholder', $this->index_style);
        $btn_text = $this->get_shortcode_att('btn_text', $this->index_style);

        $embedded_form_type = $this->get_shortcode_att( 'embedded_form_type', $this->index_style );
        $embedded_form_code = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att( 'embedded_form_code', $this->index_style ) ) ) );

        $input_bar_display = $this->get_style_att( 'input_bar_display' );
        $input_bar_display_class = 'tdn-input-bar-display-';
        if( empty( $input_bar_display ) ) {
            $input_bar_display_class .=  'column';
        } else {
            $input_bar_display_class .= $input_bar_display;
        }

        $buffy = '';

        if ( ! empty($embedded_form_code) ) {

            $newsletter_data = $this->get_newsletter_action_att($embedded_form_code, $embedded_form_type);

            if ( $newsletter_data === false ) {
                $buffy .= td_util::get_block_error('Newsletter', '<strong>' . $embedded_form_type . ' > <em>embedded form code</em></strong> configuration is not correct.');
            } else {
                $buffy .= PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';
                $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . ' ' . $input_bar_display_class . ' tdn-style-bordered td-fix-index">';

                    $buffy .= '<div class="tdn-info-wrap">';

                        if( $title_text != '' || $description != '' ) {
                            $buffy .= '<div class="tdn-info">';
                            if( $title_text != '' ) {
                                $buffy .= '<h3 class="tdn-title">' . $title_text . '</h3>';
                            }

                            if( $description != '' ) {
                                $buffy .= '<p class="tdn-descr">' . $description . '</p>';
                            }
                            $buffy .= "</div>";
                        }

                        if (!empty ($embedded_form_type) && $embedded_form_type == 'mailchimp') {
                            $buffy .= '<form class="tdn-form" action="' . $newsletter_data['url'] . '" method="post" name="mc-embedded-subscribe-form" target="_blank">';
                                $buffy .= '<div class="tdn-email-bar">';
                                    $buffy .= '<div class="tdn-input-wrap">';
                                        $buffy .= '<input type="email" name="EMAIL" placeholder="' . $input_placeholder . '">';
                                    $buffy .= "</div>";

                                    $buffy .= '<div class="tdn-btn-wrap">';
                                        $buffy .= '<button type="submit" name="subscribe">' . $btn_text . '</button>';
                                    $buffy .= "</div>";
                                $buffy .= "</div>";

                                if( $disclaimer != '' ) {
                                    $buffy .= '<div class="tdn-disclaimer tdn-disclaimer1">' . $disclaimer . '</div>';
                                }

                                //gdpr checkboxes
                                if ( !empty ($newsletter_data['item_array']) && is_array($newsletter_data['item_array']) ) {
                                    $buffy .= '<div class="tdn-checkbox-wrap">';
                                    foreach ( $newsletter_data['item_array'] as $id => $name ) {
                                        $buffy .= '<div class="tdn-checkbox">';
                                        $buffy .= '<input id="gdpr_' . $id . '" class="av-checkbox " name="gdpr[' . $id . ']" value="Y" type="checkbox">';
                                        $buffy .= '<label class="checkbox subfield" for="gdpr_' . $id . '">';
                                        $buffy .= '<span class="tdn-check"></span>';
                                        $buffy .= '<span class="tdn-check-title">' . $name . '</span>';
                                        $buffy .= '</label>';
                                        $buffy .= '</div>';
                                    };
                                    $buffy .= '</div>';
                                }
                            $buffy .= "</form>";
                        } elseif (!empty ($embedded_form_type) && $embedded_form_type == 'mailerlite') {
                            $buffy .= '<form class="tdn-form" action="' . $newsletter_data['url'] . '" data-code="' . $newsletter_data['code'] . '" method="post" target="_blank">';
                                $buffy .= '<input type="hidden" name="ml-submit" value="1" />';

                                $buffy .= '<div class="tdn-email-bar">';
                                    $buffy .= '<div class="tdn-input-wrap">';
                                        $buffy .= '<input type="email" name="fields[email]" placeholder="' . $input_placeholder . '" value="" autocomplete="email" x-autocompletetype="email" spellcheck="false" autocapitalize="off" autocorrect="off">';
                                    $buffy .= "</div>";

                                    $buffy .= '<div class="tdn-btn-wrap">';
                                        $buffy .= '<button type="submit" name="subscribe">' . $btn_text . '</button>';
                                    $buffy .= "</div>";
                                $buffy .= "</div>";

                                if( $disclaimer != '' ) {
                                    $buffy .= '<div class="tdn-disclaimer tdn-disclaimer1">' . $disclaimer . '</div>';
                                }
                            $buffy .= "</form>";
                        } elseif (!empty ($embedded_form_type) && $embedded_form_type == 'feedburner') {
                            $buffy .= '<form class="tdn-form" action="//feedburner.google.com/fb/a/mailverify" method="post" target="_blank">';
                                $buffy .= '<input type="hidden" name="uri" value="' . $newsletter_data['id'] . '" />';
                                $buffy .= '<input type="hidden" name="loc" value="' . get_locale() . '" />';

                                $buffy .= '<div class="tdn-email-bar">';
                                    $buffy .= '<div class="tdn-input-wrap">';
                                        $buffy .= '<input type="email" name="email" autocomplete="email" x-autocompletetype="email" spellcheck="false" autocapitalize="off" autocorrect="off" id="feedburner-email" placeholder="' . $input_placeholder . '">';
                                    $buffy .= "</div>";

                                    $buffy .= '<div class="tdn-btn-wrap">';
                                        $buffy .= '<button type="submit" name="subscribe">' . $btn_text . '</button>';
                                    $buffy .= "</div>";
                                $buffy .= "</div>";

                                if( $disclaimer != '' ) {
                                    $buffy .= '<div class="tdn-disclaimer tdn-disclaimer1">' . $disclaimer . '</div>';
                                }
                            $buffy .= "</form>";
                        }

                        if( $disclaimer2 != '' ) {
                            $buffy .= '<div class="tdn-disclaimer tdn-disclaimer2">' . $disclaimer2 . '</div>';
                        }

                    $buffy .= '</div>';

                $buffy .= '</div>';
            }

        } else {
            $buffy .= td_util::get_block_error('Newsletter', '<strong><em>form code</em></strong> is empty. Please configure this block/widget by entering a <em>form code</em>');
        }

        return $buffy;
    }

    function get_newsletter_action_att( $newsletter_form_data, $newsletter_provider ) {

        switch ($newsletter_provider) {
            case 'mailchimp':

                $newsletter_data = array();

                preg_match( '/action="([^"]*?)"/i', $newsletter_form_data, $matched );

                if ( ! empty( $matched[1] ) && strpos( $newsletter_form_data, 'list-manage.com/subscribe') !== false ) {

                    $newsletter_data['url'] = $matched[1];

                    //get gdpr checkbox from mailchimp code
                    preg_match_all( '/id="gdpr_([^"]*)[^>]*>[^<]*<span[^>]*>([^<]*)/', $newsletter_form_data, $matched );
                    //run only if gdpr fields are enabled
                    if (! empty( $matched[1])) {

                        //arrays for ids and field name
                        $ids = $matched[1];
                        $id_names = $matched[2];

                        //count gdpr fields
                        foreach($matched[1] as $index=>$match) {
                            $newsletter_data['item_array'][$ids[$index]] = $id_names[$index];
                        }

                        return $newsletter_data;

                    }

                    return $newsletter_data;
                }

                return false;

                break;

            /*
            case 'aweber':
                return $newsletter_provider;
                break;
            */

            case 'mailerlite':

                $newsletter_data = array();

                preg_match( '/action="([^"]*?)"/i', $newsletter_form_data, $matched );

                if ( ! empty( $matched[1] ) && strpos( $matched[1], 'app.mailerlite.com/webforms') !== false ) {

                    $newsletter_data['url'] = $matched[1];

                        preg_match( '/data-code="([^"]*?)"/i', $newsletter_form_data, $matched );

                        if ( ! empty( $matched[1] ) ) {

                            $newsletter_data['code'] = $matched[1];

                            return $newsletter_data;
                        }
                   
                    return false;
                }
                return false;

                break;

            case 'feedburner':

                $newsletter_data = array();

                if( ctype_alnum ($newsletter_form_data) ) {
                    // valid username, alphanumeric
                    $newsletter_data['id'] = $newsletter_form_data;

                    return $newsletter_data;
                }

                return false;

                break;
        }



        return '';
    }

    function get_style_att( $att_name ) {
        return $this->get_att( $att_name ,__CLASS__, $this->index_style );
    }

    function get_atts() {
        return $this->atts;
    }
}