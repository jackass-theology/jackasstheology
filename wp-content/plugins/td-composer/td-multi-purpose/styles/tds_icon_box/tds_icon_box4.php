<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_icon_box4 extends td_style {

    public $icon_style;
    private $unique_block_class;
    private $unique_style_class;

    private $atts = array();
    private $index_style;

    function __construct( $atts, $unique_block_class = '', $index_style = '') {
        $this->atts = $atts;
        $this->unique_block_class = $unique_block_class;
        $this->index_style = $index_style;
    }

    private function get_css() {

        $compiled_css = '';

        $unique_block_class = $this->unique_block_class;
        $unique_style_class = $this->unique_style_class;

		$raw_css =
			"<style>

                /* @icon_box_container_height */
				.$unique_block_class {
				    height: @icon_box_container_height;
				}
			
                /* @title_top_space */
				.$unique_style_class .tds-title {
				    margin-top: @title_top_space;
				}
								
				/* @title_bottom_space */
				.$unique_style_class .tds-title {
				    margin-bottom: @title_bottom_space;
				}
				
				/* @description_bottom_space */
				.$unique_style_class .tdm-descr {
				    margin-bottom: @description_bottom_space;
				}
				
				/* @icon_box_description_color */
				.$unique_style_class .tdm-descr {
				    color: @icon_box_description_color;			  
				}
				
				/* @icon_box_hover_description_color */
				.$unique_block_class:hover .tdm-descr {
				    color: @icon_box_hover_description_color;			  
				}

				
				/* @icon_box_line_thick */
				.$unique_block_class:before {
				    height: @icon_box_line_thick;
				}
				
				/* @icon_box_wrap_color */
				.$unique_block_class:after {
				    background-color: @icon_box_wrap_color;
				}
				
				/* @icon_box_hover_wrap_color */
				.$unique_block_class:hover:after {
				    background-color: @icon_box_hover_wrap_color;
				}
				
				/* @icon_box_line_color */
				.$unique_block_class:before {
				    background-color: @icon_box_line_color;
				}
				
				/* @icon_box_hover_line_color */
				.$unique_block_class:hover:before {
				    background-color: @icon_box_hover_line_color;
				}
				
				/* @shadow */
				.$unique_block_class {                           
				    box-shadow: @shadow;
				}
				
				/* @shadow_hover */
				.$unique_block_class:hover {                    
				    box-shadow: @shadow_hover;
				}



				/* @f_descr */
				.$unique_block_class .tdm-descr {
					@f_descr
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
	}

    /**
     * Callback pe media
     *
     * @param $res_ctx td_res_context
     */
    static function cssMedia( $res_ctx ) {

        // container height
        $res_ctx->load_settings_raw( 'icon_box_container_height', $res_ctx->get_style_att( 'icon_box_container_height', __CLASS__ ) . 'px' );



        /*-- BACKGROUND -- */
        // background color
        $background_color = $res_ctx->get_style_att( 'icon_box_wrap_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'icon_box_wrap_color', '#dcf3f8' );
        if( $background_color != '' ) {
            $res_ctx->load_settings_raw( 'icon_box_wrap_color', $background_color );
        }

        // background hover color
        $res_ctx->load_settings_raw( 'icon_box_hover_wrap_color', $res_ctx->get_style_att( 'icon_box_hover_wrap_color', __CLASS__ ) );



        /*-- LINE -- */
        // line thikness
        $line_thikness = $res_ctx->get_style_att( 'icon_box_line_thick', __CLASS__ );
        $res_ctx->load_settings_raw( 'icon_box_line_thick', $line_thikness );
        if( $line_thikness != '' ) {
            if( is_numeric( $line_thikness ) ) {
                $res_ctx->load_settings_raw( 'icon_box_line_thick', $line_thikness . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'icon_box_line_thick', '3px' );
        }

        // line color
        $line_color = $res_ctx->get_style_att( 'icon_box_line_color', __CLASS__ );
        $res_ctx->load_settings_raw( 'icon_box_line_color', '#00d6ff' );
        if( $line_color != '' ) {
            $res_ctx->load_settings_raw( 'icon_box_line_color', $line_color );
        }

        // line hover color
        $res_ctx->load_settings_raw( 'icon_box_hover_line_color', $res_ctx->get_style_att( 'icon_box_hover_line_color', __CLASS__ ) );



        /*-- TITLE -- */
        // title top space
        $res_ctx->load_settings_raw( 'title_top_space', $res_ctx->get_style_att( 'title_top_space', __CLASS__ ) . 'px' );

        // title bottom space
        $res_ctx->load_settings_raw( 'title_bottom_space', $res_ctx->get_style_att( 'title_bottom_space', __CLASS__ ) . 'px' );



        /*-- DESCRIPTION -- */
        // description bottom space
        $res_ctx->load_settings_raw( 'description_bottom_space', $res_ctx->get_style_att( 'description_bottom_space', __CLASS__ ) . 'px' );

        // description color
        $res_ctx->load_settings_raw( 'icon_box_description_color', $res_ctx->get_style_att( 'icon_box_description_color', __CLASS__ ) );

        // description hover color
        $res_ctx->load_settings_raw( 'icon_box_hover_description_color', $res_ctx->get_style_att( 'icon_box_hover_description_color', __CLASS__ ) );



        /*-- SHADOW -- */
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.15)', 'shadow', __CLASS__ );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.15)', 'shadow_hover', __CLASS__ );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_descr', __CLASS__ );

    }

    function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_style = $index_style;
        }

        $this->unique_style_class = td_global::td_generate_unique_id();

        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="' . self::get_group_style( __CLASS__ ) . ' ' . self::get_class_style(__CLASS__) . ' ' . 'td-fix-index' . ' ' . $this->unique_style_class . '">';

            // Icon
            $tds_icon = $this->get_shortcode_att('tds_icon');
            if ( empty( $tds_icon ) ) {
                $tds_icon = td_util::get_option( 'tds_icon', 'tds_icon1');
            }
            $this->icon_style = new $tds_icon( $this->atts, $this->unique_block_class );
            $buffy .= $this->icon_style->render();

            // Title
            $tds_title = $this->get_shortcode_att('tds_title');
            if ( empty( $tds_title ) ) {
                $tds_title = td_util::get_option( 'tds_title', 'tds_title1');
            }
            $tds_title_instance = new $tds_title( $this->atts, $this->unique_block_class );
            $buffy .= $tds_title_instance->render();

            // Description
            $description = rawurldecode( base64_decode( strip_tags( $this->get_shortcode_att('description') ) ) );
            $buffy .= '<p class="tdm-descr">' . $description . '</p>';

            // Button
            $button_text = $this->get_shortcode_att('button_text');
            if ( !empty( $button_text ) ) {

                // Get button_style_id
                $tds_button = $this->get_shortcode_att('tds_button');
                if ( empty( $tds_button ) ) {
                    $tds_button = td_util::get_option( 'tds_button', 'tds_button1');
                }
                $tds_button_instance = new $tds_button( $this->atts );
                $buffy .= $tds_button_instance->render();
            }

            //url on icon box
	        $icon_box_url = $this->get_style_att( 'icon_box_url' );
            if ( !empty( $icon_box_url ) ) {

                /**
                 * Google Analytics tracking settings
                 */
                $data_ga_event_cat = '';
                $data_ga_event_action = '';
                $data_ga_event_label = '';

                // don't add tracking options in td composer
                if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
                    $ga_event_category = $this->get_shortcode_att('ga_event_category');
                    if ( ! empty( $ga_event_category ) ) {
                        $data_ga_event_cat = ' data-ga-event-cat="' . $ga_event_category . '" ';
                    }

                    $ga_event_action = $this->get_shortcode_att('ga_event_action');
                    if ( ! empty( $ga_event_action ) ) {
                        $data_ga_event_action = ' data-ga-event-action="' . $ga_event_action . '" ';
                    }

                    $ga_event_label = $this->get_shortcode_att('ga_event_label');
                    if ( ! empty( $ga_event_label ) ) {
                        $data_ga_event_label = ' data-ga-event-label="' . $ga_event_label . '" ';
                    }
                }

                /**
                 * FB Pixel tracking settings
                 */
                $data_fb_event_name = '';
                $data_fb_event_cotent_name = '';

                // don't add tracking options in td composer
                if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
                    $fb_event_name = $this->get_shortcode_att('fb_pixel_event_name');
                    if ( ! empty( $fb_event_name ) ) {
                        $data_fb_event_name = ' data-fb-event-name="' . $fb_event_name . '" ';
                    }
                    $fb_event_content_name = $this->get_shortcode_att('fb_pixel_event_content_name');
                    if ( ! empty( $fb_event_content_name ) ) {
                        $data_fb_event_cotent_name = ' data-fb-event-content-name="' . $fb_event_content_name . '" ';
                    }
                }

                // with link
                $target_blank = '';
	            $open_in_new_window = $this->get_style_att( 'open_in_new_window' );
                if  ( !empty( $open_in_new_window ) ) {
                    $target_blank = 'target="_blank"';
                }
                $buffy .= '<a href="' . $this->get_style_att( 'icon_box_url' ) . '" class="icon_box_url_wrap" ' . $target_blank . $data_ga_event_cat . $data_ga_event_action . $data_ga_event_label . $data_fb_event_name . $data_fb_event_cotent_name . '> </a>';
            }

        $buffy .= '</div>';

		return $buffy;
	}

    function get_style_att( $att_name ) {
        return $this->get_att( $att_name ,__CLASS__, $this->index_style );
    }

    function get_atts() {
        return $this->atts;
    }
}