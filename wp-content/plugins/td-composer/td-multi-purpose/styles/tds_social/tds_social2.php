<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 13.07.2017
 * Time: 9:38
 */

class tds_social2 extends td_style {

    private $unique_style_class;
    private $atts = array();
    private $index_style;

    function __construct( $atts, $index_style = '') {
        $this->atts = $atts;
        $this->index_style = $index_style;
    }

	private function get_css() {

        $compiled_css = '';

        $unique_style_class = $this->unique_style_class;

		$raw_css =
			"<style>

                /* @icons_size */
				.$unique_style_class .tdm-social-item i {
					font-size: @icons_size;
					vertical-align: middle;
				}
				.$unique_style_class .tdm-social-item i.td-icon-twitter,
				.$unique_style_class .tdm-social-item i.td-icon-linkedin,
				.$unique_style_class .tdm-social-item i.td-icon-pinterest,
				.$unique_style_class .tdm-social-item i.td-icon-blogger,
				.$unique_style_class .tdm-social-item i.td-icon-vimeo {
					font-size: @icons_size_fix;
				}
				/* @icons_padding */
				.$unique_style_class .tdm-social-item {
					width: @icons_padding;
					height: @icons_padding;
				}
				.$unique_style_class .tdm-social-item i {
					line-height: @icons_padding;
				}
				/* @icons_margin_right */
				.$unique_style_class .tdm-social-item {
				    margin: @icons_margin_top_bottom @icons_margin_right @icons_margin_top_bottom 0;
				}
				/* @icon_last_margin_none */
				.$unique_style_class .tdm-social-item-wrap:last-child .tdm-social-item {
				    margin-right: 0 !important;
				}
                /* @icons_color */
				.$unique_style_class.tds-social2 .tdm-social-item i,
				.tds-team-member2 .$unique_style_class.tds-social2 .tdm-social-item i {
					color: @icons_color;
				}
				/* @icons_hover_color */
				.$unique_style_class.tds-social2 .tdm-social-item-wrap:hover i {
					color: @icons_hover_color;
				}
				
				
				/* @show_names */
				.$unique_style_class .tdm-social-text {
					display: @show_names;
				}
				
                /* @name_space_left */
				.$unique_style_class .tdm-social-text {
					margin-left: @name_space_left;
				}
                /* @name_space_right */
				.$unique_style_class .tdm-social-text {
					margin-right: @name_space_right;
				}
				
                /* @name_color */
				.$unique_style_class .tdm-social-text {
					color: @name_color;
				}
                /* @name_color_h */
				.$unique_style_class .tdm-social-item-wrap:hover .tdm-social-text {
					color: @name_color_h;
				}
				
				
				
                /* @f_name */
				.$unique_style_class .tdm-social-text{
				    @f_name
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
     * @param $responsive_context td_res_context
     * @param $atts
     */
    static function cssMedia( $res_ctx ) {

        /*-- ICON -- */
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
            $res_ctx->load_settings_raw( 'icons_margin_right', '10px' );
            $res_ctx->load_settings_raw( 'icons_margin_top_bottom', '5px' );
        }

        // icons color
        $res_ctx->load_settings_raw( 'icons_color', $res_ctx->get_style_att( 'icons_color', __CLASS__ ) );

        // icons hover color
        $res_ctx->load_settings_raw( 'icons_hover_color', $res_ctx->get_style_att( 'icons_hover_color', __CLASS__ ) );



        /*-- NAME -- */
        // show names
        $show_names = $res_ctx->get_shortcode_att('show_names');
        $res_ctx->load_settings_raw( 'show_names', $show_names );
        if( $show_names == '' || $show_names == 'none' ) {
            $res_ctx->load_settings_raw( 'icon_last_margin_none', 1 );
        }

        // name left space
        $name_space_left = $res_ctx->get_shortcode_att( 'name_space_left' );
        $res_ctx->load_settings_raw( 'name_space_left', $name_space_left );
        if( $name_space_left != '' ) {
            if( is_numeric( $name_space_left ) ) {
                $res_ctx->load_settings_raw( 'name_space_left', $name_space_left . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'name_space_left', '2px' );
        }

        // name right space
        $name_space_right = $res_ctx->get_shortcode_att( 'name_space_right' );
        $res_ctx->load_settings_raw( 'name_space_right', $name_space_right );
        if( $name_space_right != '' ) {
            if( is_numeric( $name_space_right ) ) {
                $res_ctx->load_settings_raw( 'name_space_right', $name_space_right . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'name_space_right', '18px' );
        }

        // name color
        $res_ctx->load_settings_raw( 'name_color', $res_ctx->get_style_att( 'name_color', __CLASS__ ) );

        // name hover color
        $res_ctx->load_settings_raw( 'name_color_h', $res_ctx->get_style_att( 'name_color_h', __CLASS__ ) );


        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_name', __CLASS__ );

    }

    function render( $index_style = '' ) {
        if ( ! empty( $index_style ) ) {
            $this->index_template = $index_style;
        }
        $this->unique_style_class = td_global::td_generate_unique_id();

        // social open in new window
        $target = '';
        if ( '' !== $this->get_shortcode_att( 'open_in_new_window' ) ) {
            $target = ' target="_blank" ';
        }


        $buffy = PHP_EOL . '<style>' . PHP_EOL . $this->get_css() . PHP_EOL . '</style>';

        $buffy .= '<div class="tdm-social-wrapper ' . self::get_class_style(__CLASS__) . ' ' . $this->unique_style_class . '">';
            $social_array = array();
            $social_array['behance']    = array( $this->get_shortcode_att( 'behance' ), 'Behance' );
            $social_array['blogger']    = array( $this->get_shortcode_att( 'blogger' ), 'Blogger' );
            $social_array['dribbble']   = array( $this->get_shortcode_att( 'dribbble' ), 'Dribbble' );
            $social_array['facebook']   = array( $this->get_shortcode_att( 'facebook' ), 'Facebook' );
            $social_array['flickr']     = array( $this->get_shortcode_att( 'flickr' ), 'Flickr' );
            $social_array['googleplus'] = array( $this->get_shortcode_att( 'googleplus' ), 'Google+' );
            $social_array['instagram']  = array( $this->get_shortcode_att( 'instagram' ), 'Instagram' );
            $social_array['lastfm']     = array( $this->get_shortcode_att( 'lastfm' ), 'Lastfm' );
            $social_array['linkedin']   = array( $this->get_shortcode_att( 'linkedin' ), 'LinkedIn' );
            $social_array['pinterest']  = array( $this->get_shortcode_att( 'pinterest' ), 'Pinterest' );
            $social_array['rss']        = array( $this->get_shortcode_att( 'rss' ), 'RSS' );
            $social_array['soundcloud'] = array( $this->get_shortcode_att( 'soundcloud' ), 'Soundcloud' );
            $social_array['tumblr']     = array( $this->get_shortcode_att( 'tumblr' ), 'Tumblr' );
            $social_array['twitter']    = array( $this->get_shortcode_att( 'twitter' ), 'Twitter' );
            $social_array['vimeo']      = array( $this->get_shortcode_att( 'vimeo' ), 'Vimeo' );
            $social_array['youtube']    = array( $this->get_shortcode_att( 'youtube' ), 'Youtube' );
            $social_array['vk']         = array( $this->get_shortcode_att( 'vk' ), 'VKontakte' );

            foreach ( $social_array as $social_key => $social_value ) {
                if( !empty( $social_value[0] ) ) {
                    $buffy .= '<div class="tdm-social-item-wrap">';
                        $buffy .= '<a href="' . $social_value[0] . '" ' . $target . 'class="tdm-social-item">';
                            $buffy .= '<i class="td-icon-font td-icon-' . $social_key . '"></i>';
                        $buffy .= '</a>';

                        $buffy .= '<a href="' . $social_value[0] . '" ' . $target . 'class="tdm-social-text">' . $social_value[1] . '</a>';
                    $buffy .= '</div>';
                }
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