<?php
class td_block_ad_box extends td_block {

	private $atts = array();

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @ad_title_color */
				.$unique_block_class .td-adspot-title {
					color: @ad_title_color;
				}
				


				/* @f_title */
				.$unique_block_class .td-adspot-title {
					@f_title
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // ad title color
        $res_ctx->load_settings_raw( 'ad_title_color', $res_ctx->get_shortcode_att('ad_title_color') );


        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_title' );

    }


	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}


    function render($atts, $content = null) {
	    parent::render($atts);

	    $this->atts = shortcode_atts(
            array(
                'spot_id' => '', //header / sidebar etc
                'align' => '', //align left or right in inline content,
	            'spot_title' => '',
                'custom_title' => '',
	            'el_class' => '',
            ), $atts);

	    $spot_id        = $this->atts['spot_id'];
	    $custom_title   = $this->atts['custom_title'];
	    $spot_title     = $this->atts['spot_title'];

        // rec title
        $rec_title = '';
        if(!empty($custom_title)) {
            $rec_title .= '<div class="td-block-title-wrap">';
		        $rec_title .= $this->get_block_title();
		        $rec_title .= $this->get_pull_down_filter();
	        $rec_title .= '</div>';
        }

	    if(!empty($spot_title)) {
            $rec_title .= '<span class="td-adspot-title">' . $spot_title . '</span>';
        }

	    // For tagDiv composer add a placeholder element
        if (td_util::tdc_is_live_editor_iframe() || td_util::tdc_is_live_editor_ajax()) {

	        $ad_array = td_util::get_td_ads($spot_id);

	        // return if the ad for a specific spot id is empty
	        if (($spot_id === 'header' || $spot_id === 'footer_top') && empty($ad_array[$spot_id]['ad_code'])) {
		        return;
	        }

            // 'td_block_wrap' is to identify a tagDiv composer element at binding
            // 'tdc-placeholder-title' is to style de placeholder
            // block_uid is necessary to have a unique html template returned to the composer (without it the html change event doesn't trigger, and because of this the loader image is still preset)

	        $block_template_id = $this->get_att('block_template_id');

	        if (empty($block_template_id)) {
			    $block_template_id = td_options::get('tds_global_block_template', 'td_block_template_1');
		    }

	        $ad_classes = $block_template_id . ' td-spot-id-' . $spot_id . ' ' . $this->block_uid . '_rand';
	        //$ad_classes = ' td-spot-id-' . $spot_id . ' ' . $this->block_uid . '_rand';
            //if ( empty( $spot_id ) || in_array( $spot_id, array( 'sidebar', 'custom_ad_1', 'custom_ad_2', 'custom_ad_3', 'custom_ad_4', 'custom_ad_5' ) ) ) {
	            $ad_classes .= ' td_block_wrap';
            //}
            return  '<div class="' . $ad_classes . '">' . $this->get_block_css() . $rec_title . '<div class="tdc-placeholder-title"></div></div>';
        }

        if (empty($spot_id)) {
            return;
        }

        $ad_array = td_util::get_td_ads($spot_id);

		// return if the ad for a specific spot id is empty
	    if (empty($ad_array[$spot_id]['ad_code'])) {
		    return;
	    }


	    $buffy = '';

        if (!empty($ad_array[$spot_id]['current_ad_type'])) {

            switch ($ad_array[$spot_id]['current_ad_type']) {

                case 'other':
                    //render the normal ads
                    $buffy .= $this->render_ads($ad_array[$spot_id], $atts);
                    break;

                case 'google':
                    //render the magic google ads :)
                    $buffy .= $this->render_google_ads($ad_array[$spot_id], $atts);
                    break;
            }
        }

        //print_r($ad_array);

        return $buffy;
    }




    /**
     * This function renders and returns a google ad.
     * @param $ad_array - uses an ad array of the form:
        - current_ad_type - google or other
        - ad_code - the full ad code as entered by the user
        - disable_m - disable on monitor
        - disable_tp - disable on tablet p
        - disable_p - disable on phones
        - g_data_ad_client - the google ad client id (ca-pub-etc)
        - g_data_ad_slot - the google ad slot id
     * 'm_w' => '',  // big monitor - width
    'm_h' => '',  // big monitor - height
    'tp_w' => '', // tablet_portrait width
    'tp_h' => '', // tablet_portrait height
    'p_w' => '',  // phone width
    'p_h' => ''   // phone height
     * @param $atts array of atts
     * @return string HTML the full rendered ad
     */
    // tagDiv google responsive renderer
    // copyright 2014 tagDiv
    function render_google_ads($ad_array, $atts) {


        $this->atts = shortcode_atts(
            array(
                'spot_id' => '', //header / sidebar etc
                'align' => '', //align left or right in inline content
                'spot_title' => '',
                'custom_title' => '',
	            'el_class' => '',
            ), $atts);

	    $spot_id        = $this->atts['spot_id'];
	    $align          = $this->atts['align'];
	    $custom_title   = $this->atts['custom_title'];
	    $spot_title     = $this->atts['spot_title'];
	    $el_class       = $this->atts['el_class'];

        // rec title
        $rec_title = '';
        if(!empty($custom_title)) {
            $rec_title .= '<div class="td-block-title-wrap">';
		        $rec_title .= $this->get_block_title();
		        $rec_title .= $this->get_pull_down_filter();
	        $rec_title .= '</div>';
        }
        if(!empty($spot_title)) {
            $rec_title .= '<span class="td-adspot-title">' . $spot_title . '</span>';
        }


        //echo ($p_w);

        //print_r($ad_array);

        $default_ad_sizes = array (
            'header' => array (
                'm_w' => '728',  // big monitor - width
                'm_h' => '90',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '320',  // phone width
                'p_h' => '50'   // phone height
            ),
            'sidebar' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '300', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),


            'content_inline' => array (
                'm_w' => '468',  // big monitor - width
                'm_h' => '60',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '320',  // phone width
                'p_h' => '50'   // phone height
            ),

            'content_top' => array (
                'm_w' => '468',  // big monitor - width
                'm_h' => '60',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'content_bottom' => array (
                'm_w' => '468',  // big monitor - width
                'm_h' => '60',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '468', // tablet_portrait width
                'tp_h' => '60', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'post_style_1' => array (
	            'm_w' => '300',  // big monitor - width
	            'm_h' => '250',  // big monitor - height

	            'tl_w' => '300', // tablet_landscape width
	            'tl_h' => '250', // tablet_landscape height

	            'tp_w' => '200', // tablet_portrait width
	            'tp_h' => '200', // tablet_portrait height

	            'p_w' => '300',  // phone width
	            'p_h' => '250'   // phone height
            ),

            'post_style_11' => array (
	            'm_w' => '300',  // big monitor - width
	            'm_h' => '250',  // big monitor - height

	            'tl_w' => '300', // tablet_landscape width
	            'tl_h' => '250', // tablet_landscape height

	            'tp_w' => '320', // tablet_portrait width
	            'tp_h' => '50', // tablet_portrait height

	            'p_w' => '300',  // phone width
	            'p_h' => '250'   // phone height
            ),

            'post_style_12' => array (
                'm_w' => '728',  // big monitor - width
                'm_h' => '90',  // big monitor - height

                'tl_w' => '728', // tablet_landscape width
                'tl_h' => '90', // tablet_landscape height

                'tp_w' => '728', // tablet_portrait width
                'tp_h' => '90', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'smart_list_6' => array (
                'm_w' => '468',  // big monitor - width
                'm_h' => '60',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '300', // tablet_portrait width
                'tp_h' => '250', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'smart_list_7' => array (
                'm_w' => '468',  // big monitor - width
                'm_h' => '60',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '300', // tablet_portrait width
                'tp_h' => '250', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'smart_list_8' => array (
                'm_w' => '468',  // big monitor - width
                'm_h' => '60',  // big monitor - height

                'tl_w' => '468', // tablet_landscape width
                'tl_h' => '60', // tablet_landscape height

                'tp_w' => '300', // tablet_portrait width
                'tp_h' => '250', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'footer_top' => array (
	            'm_w' => '728',  // big monitor - width
	            'm_h' => '90',  // big monitor - height

	            'tl_w' => '728', // tablet_landscape width
	            'tl_h' => '90', // tablet_landscape height

	            'tp_w' => '728', // tablet_portrait width
	            'tp_h' => '90', // tablet_portrait height

	            'p_w' => '300',  // phone width
	            'p_h' => '250'   // phone height
            ),

            'custom_ad_1' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '300', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'custom_ad_2' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '300', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'custom_ad_3' => array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '300', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            ),

            'custom_ad_4' => array (
	            'm_w' => '300',  // big monitor - width
	            'm_h' => '250',  // big monitor - height

	            'tl_w' => '300', // tablet_landscape width
	            'tl_h' => '250', // tablet_landscape height

	            'tp_w' => '200', // tablet_portrait width
	            'tp_h' => '200', // tablet_portrait height

	            'p_w' => '300',  // phone width
	            'p_h' => '250'   // phone height
            ),

            'custom_ad_5' => array (
	            'm_w' => '300',  // big monitor - width
	            'm_h' => '250',  // big monitor - height

	            'tl_w' => '300', // tablet_landscape width
	            'tl_h' => '250', // tablet_landscape height

	            'tp_w' => '200', // tablet_portrait width
	            'tp_h' => '200', // tablet_portrait height

	            'p_w' => '300',  // phone width
	            'p_h' => '250'   // phone height
            )
        );


        if ($align == 'left') {
            $default_ad_sizes['content_inline'] = array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '300', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            );
        }
        elseif ($align == 'right') {
            $default_ad_sizes['content_inline'] = array (
                'm_w' => '300',  // big monitor - width
                'm_h' => '250',  // big monitor - height

                'tl_w' => '300', // tablet_landscape width
                'tl_h' => '250', // tablet_landscape height

                'tp_w' => '200', // tablet_portrait width
                'tp_h' => '200', // tablet_portrait height

                'p_w' => '300',  // phone width
                'p_h' => '250'   // phone height
            );
        }







        //overwrite the default values if we have some

        //monitor big ad
        if (!empty($ad_array['m_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['m_size']);
            $default_ad_sizes[$spot_id]['m_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['m_h'] = $ad_size_parts[1];
        }


	    //tablet landscape
	    if (!empty($ad_array['tl_size'])) {
		    $ad_size_parts = explode(' x ', $ad_array['tl_size']);
		    $default_ad_sizes[$spot_id]['tl_w'] = $ad_size_parts[0];
		    $default_ad_sizes[$spot_id]['tl_h'] = $ad_size_parts[1];
	    }


        //tablet portrait
        if (!empty($ad_array['tp_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['tp_size']);
            $default_ad_sizes[$spot_id]['tp_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['tp_h'] = $ad_size_parts[1];
        }


        //phone
        if (!empty($ad_array['p_size'])) {
            $ad_size_parts = explode(' x ', $ad_array['p_size']);
            $default_ad_sizes[$spot_id]['p_w'] = $ad_size_parts[0];
            $default_ad_sizes[$spot_id]['p_h'] = $ad_size_parts[1];
        }





        //init the disable variables
        if (!empty($ad_array['disable_m']) and $ad_array['disable_m'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_m'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_m'] = false;
        }

	    if (!empty($ad_array['disable_tl']) and $ad_array['disable_tl'] == 'yes') {
		    $default_ad_sizes[$spot_id]['disable_tl'] = true;
	    } else {
		    $default_ad_sizes[$spot_id]['disable_tl'] = false;
	    }

        if (!empty($ad_array['disable_tp']) and $ad_array['disable_tp'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_tp'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_tp'] = false;
        }

        if (!empty($ad_array['disable_p']) and $ad_array['disable_p'] == 'yes') {
            $default_ad_sizes[$spot_id]['disable_p'] = true;
        } else {
            $default_ad_sizes[$spot_id]['disable_p'] = false;
        }




        $buffy = "\n <!-- A generated by theme --> \n\n";

        //google async script
        $buffy .= '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';




	    $buffy .= '<div class="td-g-rec td-g-rec-id-' . $spot_id . $align . ' ' . $this->get_ad_css_class($atts) . ' ' . $el_class . '">' . "\n";

		    //get the block js
		    $buffy .= $this->get_block_css();

            $buffy .= '<script type="text/javascript">' . "\n";


            //$buffy .= 'var td_a_g_custom_size = ' . json_encode($default_ad_sizes[$spot_id]) . ';' . "\n";

            //$buffy .= 'var td_screen_width = document.body.clientWidth;' . "\n";

            //fix for adsense custom ad size settings not loading right when having the speedbooster active
            $buffy .= 'var td_screen_width = window.innerWidth;' . "\n";


            if ($default_ad_sizes[$spot_id]['disable_m'] == false and !empty($default_ad_sizes[$spot_id]['m_w']) and !empty($default_ad_sizes[$spot_id]['m_h'])) {
                $buffy .= '
                    if ( td_screen_width >= 1140 ) {
                        /* large monitors */
                        document.write(\'' . $rec_title . '<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['m_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['m_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
            ';
            }


		    if ($default_ad_sizes[$spot_id]['disable_tl'] == false and !empty($default_ad_sizes[$spot_id]['tl_w']) and !empty($default_ad_sizes[$spot_id]['tl_h'])) {
			    $buffy .= '
	                    if ( td_screen_width >= 1019  && td_screen_width < 1140 ) {
	                        /* landscape tablets */
                        document.write(\'' . $rec_title . '<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['tl_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['tl_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
	                        (adsbygoogle = window.adsbygoogle || []).push({});
	                    }
	                ';
		    }


            if ($default_ad_sizes[$spot_id]['disable_tp'] == false and !empty($default_ad_sizes[$spot_id]['tp_w']) and !empty($default_ad_sizes[$spot_id]['tp_h'])) {
                $buffy .= '
                    if ( td_screen_width >= 768  && td_screen_width < 1019 ) {
                        /* portrait tablets */
                        document.write(\'' . $rec_title . '<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['tp_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['tp_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
                ';
            }

            if ($default_ad_sizes[$spot_id]['disable_p'] == false and !empty($default_ad_sizes[$spot_id]['p_w']) and !empty($default_ad_sizes[$spot_id]['p_h'])) {
                $buffy .= '
                    if ( td_screen_width < 768 ) {
                        /* Phones */
                        document.write(\'' . $rec_title . '<ins class="adsbygoogle" style="display:inline-block;width:' . $default_ad_sizes[$spot_id]['p_w'] . 'px;height:' . $default_ad_sizes[$spot_id]['p_h'] . 'px" data-ad-client="' . $ad_array['g_data_ad_client'] . '" data-ad-slot="' . $ad_array['g_data_ad_slot'] . '"></ins>\');
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    }
                ';
            }


            //$buffy .= 'console.log(td_a_g_custom_size)';

            $buffy .= '</script>' . "\n";

        $buffy .= '</div>' . "\n";
        $buffy .= "\n <!-- end A --> \n\n";
        return $buffy;
    }



    /**
     * This function renders and returns a normal ad.
     * @param $ad_array - uses an ad array of the form:
    - current_ad_type - google or other
    - ad_code - the full ad code as entered by the user
    - disable_m - disable on monitor
    - disable_tp - disable on tablet p
    - disable_p - disable on phones
    - g_data_ad_client - the google ad client id (ca-pub-etc)
    - g_data_ad_slot - the google ad slot id
     *
     * @return string HTML the full rendered ad
     */
    function render_ads($ad_array, $atts) {

        $this->atts = shortcode_atts(
            array(
                'spot_id' => '', //header / sidebar etc
                'align' => '', //align left or right in inline content
                'spot_title' => '',
                'custom_title' => '',
	            'el_class' => '',
            ), $atts);

	    $spot_id        = $this->atts['spot_id'];
	    $align          = $this->atts['align'];
	    $custom_title   = $this->atts['custom_title'];
	    $spot_title     = $this->atts['spot_title'];
	    $el_class       = $this->atts['el_class'];

	    // rec title
        $rec_title = '';
        if(!empty($custom_title)) {
            $rec_title .= '<div class="td-block-title-wrap">';
		        $rec_title .= $this->get_block_title();
		        $rec_title .= $this->get_pull_down_filter();
	        $rec_title .= '</div>';
        }
        if(!empty($spot_title)) {
            $rec_title .= '<span class="td-adspot-title">' . $spot_title . '</span>';
        }


        $buffy = '';

	    $buffy .= '<div class="td-a-rec td-a-rec-id-' . $spot_id . $align . ' '
            . ((!empty($ad_array['disable_m'])) ? ' td-rec-hide-on-m' : '')
            . ((!empty($ad_array['disable_tl'])) ? ' td-rec-hide-on-tl' : '')
            . ((!empty($ad_array['disable_tp'])) ? ' td-rec-hide-on-tp' : '')
            . ((!empty($ad_array['disable_p'])) ? ' td-rec-hide-on-p' : '')
            . ' ' . $this->get_ad_css_class( $atts ) . '">';

            //get the block css
            $buffy .= $this->get_block_css();

            $buffy .= $rec_title;

            $buffy .= do_shortcode(stripslashes($ad_array['ad_code']));
        $buffy .= '</div>';


        //print_r($ad_array);
        return $buffy;
    }





	/**
	 * Custom function to get the classes for the ad_box. We can't use the main one due to adblock detecting our standard classes as ads
	 * parse the css att and get the vc_custom class
	 * @param $atts
	 *
	 * @return string
	 */
	private function get_ad_css_class($atts) {

		$block_classes  = array();




		// get the design tab css classes
		if (!empty($atts['css'])) {
			$css_classes_array = $this->parse_css_att($atts['css']);
			if ( $css_classes_array !== false ) {
				$block_classes = $css_classes_array;
			}
		}



		// get the custom el_class
		if (!empty($atts['el_class'])) {
			$el_class_array = explode(' ', $atts['el_class']);
			$block_classes = array_merge (
				$block_classes,
				$el_class_array
			);
		}

		$block_classes[] = $this->block_uid . '_rand';

		$block_template_id = $this->get_att('block_template_id');

        if (empty($block_template_id)) {
		    $block_classes[] = td_options::get('tds_global_block_template', 'td_block_template_1');
	    } else {
	        $block_classes[] = $block_template_id;
        }


		//remove duplicates
		$block_classes = array_unique($block_classes);



		return implode(' ', $block_classes);
	}

}