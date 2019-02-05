<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 16.02.2016
 * Time: 13:11
 */


class vc_row extends tdc_composer_block {

	private $atts;

	public function get_custom_css() {
		// $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
		$unique_block_class = $this->get_att('tdc_css_class');
		$unique_block_id = $this->block_uid;

        $compiled_css = '';

		$raw_css =
			"<style>
                /* @gap */
                @media (min-width: 768px) {
	                .$unique_block_class {
	                    margin-left: -@gap;
	                    margin-right: -@gap;
	                }
	                .$unique_block_class .vc_column {
	                    padding-left: @gap;
	                    padding-right: @gap;
	                }
                }

                /* @row_full_height */
                .$unique_block_class {
                    min-height: 100vh;
                }
                /* @row_auto_height */
                .$unique_block_class {
                    min-height: 0;
                }

                /* @row_fixed */
                @media (min-width: 768px) {
	                .$unique_block_class .td-element-style-before {
	                    background-attachment: fixed;
	                }
	                .tdc-row[class*='stretch_row'] > .$unique_block_class.td-pb-row > .td-element-style {
	                    left: calc((-100vw + 100%)/2) !important;
	                    transform: none !important;
	                }
                }
                
                /* @row_shadow */
                #$unique_block_id {
                    position: relative;
                }
                #$unique_block_id:before {
                    display: block;
                    width: 100vw;
                    height: 100%;
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                    box-shadow: @row_shadow;
                    z-index: 20;
                    pointer-events: none;
                }
                
                /* @stretch_off */
                #$unique_block_id.tdc-row[class*='stretch_row'] > .td-pb-row > .td-element-style {
                    width: 100% !important;
                }

                /* @content_align_vertical */
                .$unique_block_class.tdc-row-content-vert-center,
                .$unique_block_class.tdc-row-content-vert-center .tdc-columns {
                    display: flex;
                    align-items: center;
                    flex: 1;
                }
                .$unique_block_class.tdc-row-content-vert-bottom,
                .$unique_block_class.tdc-row-content-vert-bottom .tdc-columns {
                    display: flex;
                    align-items: flex-end;
                    flex: 1;
                }
                @media (max-width: 767px) {
	                .$unique_block_class,
	                .$unique_block_class .tdc-columns {
	                	flex-direction: column;
	                }
                }
                .$unique_block_class.tdc-row-content-vert-center .td_block_wrap {
                	vertical-align: middle;
                }
                .$unique_block_class.tdc-row-content-vert-bottom .td_block_wrap {
                	vertical-align: bottom;
                }
                
                /* @svg_z_index */
				.$unique_block_class .tdc-row-divider {
					z-index: @svg_z_index;
					pointer-events: none;
				}

                /* @shadow_top */
				.$unique_block_class .tdc-row-divider-top .tdm-svg {
					-webkit-filter: drop-shadow(@shadow_top);
					filter: drop-shadow(@shadow_top);
				}
				/* @row_divider_top */
				.$unique_block_class {
					position: relative;
				}
				.$unique_block_class .tdc-row-divider {
                    overflow: hidden;
                }
				/* @svg_height_top */
				.$unique_block_class .tdc-row-divider-top .tdm-svg {
					height: @svg_height_top;
				}
                /* @svg_width_top */
				.$unique_block_class .tdc-row-divider-top .tdm-svg {
					min-width: @svg_width_top;
				}
				/* @svg_flip_top */
				.$unique_block_class .tdc-row-divider-top .tdm-svg {
				    transform: translateX(-50%) rotateY(180deg);
				}
                /* @svg_background_color_top */
				.$unique_block_class .tdc-row-divider-top .tdm-svg {
					fill: @svg_background_color_top;
				}
				.$unique_block_class .tdc-row-divider-top .tdc-divider-space {
					background-color: @svg_background_color_top;
				}
                /* @space_top */
				.$unique_block_class .tdc-row-divider-top .tdc-divider-space {
					top: 100%;
				    height: @space_top;
				}
				.$unique_block_class .tdc-row-divider-top {
				    top: @space_top;
				}


				/* @shadow_bot */
				.$unique_block_class .tdc-row-divider-bottom .tdm-svg {
				    -webkit-filter: drop-shadow(@shadow_bot);
					filter: drop-shadow(@shadow_bot);
				}
				/* @row_divider_bottom */
				.$unique_block_class {
					position: relative;
				}
				.$unique_block_class .tdc-row-divider {
                    overflow: hidden;
                }
				/* @svg_height_bottom */
				.$unique_block_class .tdc-row-divider-bottom .tdm-svg {
					height: @svg_height_bottom;
				}
                /* @svg_width_bottom */
				.$unique_block_class .tdc-row-divider-bottom .tdm-svg {
					min-width: @svg_width_bottom;
				}
				/* @svg_flip_bottom */
				.$unique_block_class .tdc-row-divider-bottom .tdm-svg {
				    transform: translateX(-50%) rotateY(180deg);
				    top: 1px;
				}
                /* @svg_background_color_bottom */
				.$unique_block_class .tdc-row-divider-bottom .tdm-svg {
					fill: @svg_background_color_bottom;
				}
				.$unique_block_class .tdc-row-divider-bottom .tdc-divider-space {
					background-color: @svg_background_color_bottom;
				}
				/* @space_bottom */
				.$unique_block_class .tdc-row-divider-bottom .tdc-divider-space {
					top: 100%;
				    height: @space_bottom;
				}
				.$unique_block_class .tdc-row-divider-bottom {
				    bottom: @space_bottom;
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->atts );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
	}

    static function cssMedia( $res_ctx ) {

        // gap
        $gap = $res_ctx->get_shortcode_att('gap');
        $res_ctx->load_settings_raw( 'gap', $gap );
        if( $gap != '' && is_numeric( $gap ) ) {
            $res_ctx->load_settings_raw( 'gap', $gap . 'px' );
        }

        // content align vertical
        $content_align_vertical = $res_ctx->get_shortcode_att('content_align_vertical');
        if ( !empty($content_align_vertical) && 'content-vert-top' !== $res_ctx->get_shortcode_att('content_align_vertical') ) {
            $res_ctx->load_settings_raw('content_align_vertical', $content_align_vertical);
        }

        // full height
        $full_height = $res_ctx->get_shortcode_att('row_full_height');
        if( $full_height != '' ) {
            $res_ctx->load_settings_raw( 'row_full_height', 1 );
        } else {
            $res_ctx->load_settings_raw( 'row_auto_height', 1 );
        }

        // fixed background image
        $res_ctx->load_settings_raw( 'row_fixed', $res_ctx->get_shortcode_att('row_fixed') );

        // shadow
        $res_ctx->load_shadow_settings( 0, 6, 8, 0, 'rgba(0, 0, 0, 0.08)', 'row_shadow' );

        // stretch row off
        $res_ctx->load_settings_raw( 'stretch_off', $res_ctx->get_shortcode_att('stretch_off') );

	    // z-index
	    $res_ctx->load_settings_raw( 'svg_z_index', $res_ctx->get_shortcode_att('svg_z_index') );


        /*-- TOP DIVIDER -- */
        $row_divider_top = $res_ctx->get_shortcode_att( 'row_divider_top' );
        if ( !empty( $row_divider_top ) ) {
            $res_ctx->load_settings_raw( 'row_divider_top', $res_ctx->get_shortcode_att('row_divider_top') );

            // divider width
            $svg_width_top = $res_ctx->get_shortcode_att( 'svg_width_top' );
            $res_ctx->load_settings_raw( 'svg_width_top', $svg_width_top );
            if( $svg_width_top != '' && is_numeric( $svg_width_top ) ) {
                $res_ctx->load_settings_raw( 'svg_width_top', $svg_width_top . 'px' );
            }

            // divider height
            $svg_height_top = $res_ctx->get_shortcode_att( 'svg_height_top' );
            $res_ctx->load_settings_raw( 'svg_height_top', $svg_height_top );
            if( $svg_height_top != '' && is_numeric( $svg_height_top ) ) {
                $res_ctx->load_settings_raw( 'svg_height_top', $svg_height_top . 'px' );
            }

            // divider flip
            $res_ctx->load_settings_raw( 'svg_flip_top', $res_ctx->get_shortcode_att('svg_flip_top') );

            // divider space top
            $svg_space_top = $res_ctx->get_shortcode_att( 'space_top' );
            $res_ctx->load_settings_raw( 'space_top', $svg_space_top . 'px' );

            // divider background color
            $res_ctx->load_settings_raw( 'svg_background_color_top', $res_ctx->get_shortcode_att('svg_background_color_top') );

            // shadow
            $res_ctx->load_shadow_settings( 0, 0, 2, 0, 'rgba(0, 0, 0, 0.1)', 'shadow_top' );
        }



        /*-- BOTTOM DIVIDER -- */
        $row_divider_bottom = $res_ctx->get_shortcode_att( 'row_divider_bottom' );
        if ( !empty( $row_divider_bottom ) ) {
            $res_ctx->load_settings_raw( 'row_divider_bottom', $res_ctx->get_shortcode_att('row_divider_bottom') );

            // divider width
            $svg_width_bottom = $res_ctx->get_shortcode_att( 'svg_width_bottom' );
            $res_ctx->load_settings_raw( 'svg_width_bottom', $svg_width_bottom );
            if( $svg_width_bottom != '' && is_numeric( $svg_width_bottom ) ) {
                $res_ctx->load_settings_raw( 'svg_width_bottom', $svg_width_bottom . 'px' );
            }

            // divider height
            $svg_height_bottom = $res_ctx->get_shortcode_att( 'svg_height_bottom' );
            $res_ctx->load_settings_raw( 'svg_height_bottom', $svg_height_bottom );
            if( $svg_height_bottom != '' && is_numeric( $svg_height_bottom ) ) {
                $res_ctx->load_settings_raw( 'svg_height_bottom', $svg_height_bottom . 'px' );
            }

            // divider flip
            $res_ctx->load_settings_raw( 'svg_flip_bottom', $res_ctx->get_shortcode_att('svg_flip_bottom') );

            // divider space bottom
            $svg_space_top = $res_ctx->get_shortcode_att( 'space_bottom' );
            $res_ctx->load_settings_raw( 'space_bottom', $svg_space_top . 'px' );

            // divider background color
            $res_ctx->load_settings_raw( 'svg_background_color_bottom', $res_ctx->get_shortcode_att('svg_background_color_bottom') );

            // shadow
            $res_ctx->load_shadow_settings( 0, 0, 2, 0, 'rgba(0, 0, 0, 0.1)', 'shadow_bot' );
        }

    }


	function render($atts, $content = null) {
		parent::render($atts);

		$this->atts = shortcode_atts( array(

			'full_width' => '',
			'gap' => '',
			'row_full_height' => '',
			'row_hide_on_pagination' => '',
			'row_parallax' => '',
			'row_fixed' => '',
			'row_shadow_shadow_size' => '',
			'row_shadow_shadow_offset_horizontal' => '',
			'row_shadow_shadow_offset_vertical' => '',
			'row_shadow_shadow_spread' => '',
			'row_shadow_shadow_color' => '',
			'content_align_vertical' => '',
			'video_background' => '',
			'video_scale' => '',
			'video_opacity' => '',
			'stretch_off' => '',
			'row_divider_bottom' => '',
			'svg_height_bottom' => '',
			'svg_width_bottom' => '',
			'svg_flip_bottom' => '',
			'svg_background_color_bottom' => '',
            'shadow_bot_shadow_size' => '',
            'shadow_bot_shadow_color' => '',
            'shadow_bot_shadow_offset_horizontal' => '0',
            'shadow_bot_shadow_offset_vertical' => '2',
			'shadow_bot_shadow_spread' => '0',
			'row_divider_top' => '',
			'svg_height_top' => '',
			'svg_width_top' => '',
			'svg_flip_top' => '',
			'svg_background_color_top' => '',
			'shadow_top_shadow_size' => '',
			'shadow_top_shadow_color' => '',
			'shadow_top_shadow_offset_horizontal' => '0',
			'shadow_top_shadow_offset_vertical' => '2',
            'shadow_top_shadow_spread' => '0',
			'space_top' => '',
			'space_bottom' => '',
			'svg_z_index' => '',

		), $atts);

		td_global::set_in_row(true);

		$buffy = '';

		$block_classes = array('wpb_row', 'td-pb-row');

        if ( !tdc_state::is_live_editor_ajax() && !tdc_state::is_live_editor_iframe() ) {
            $is_paged = false;

            $queried_object = get_queried_object();

            // on page templates
            if ( $queried_object->post_type === 'page' ) {

                if ( is_paged() ) {
                    $is_paged = true;
                }

                // on cloud templates use the tdb_state_content
            } elseif ( $queried_object->post_type === 'tdb_templates' && class_exists('tdb_state_content') && tdb_state_content::has_wp_query() ) {

                $template_wp_query = tdb_state_content::get_wp_query();

                if ( $template_wp_query->is_paged() ) {
                    $is_paged = true;
                }
            }

            if ( !empty($this->atts['row_hide_on_pagination']) && $is_paged ) {
                return $buffy;
            }
        }

		$addElementStyle = false;
		$css_elements = $this->get_block_css($clearfixColumns, $addElementStyle);

		if ( $addElementStyle ) {
			$block_classes[] = 'tdc-element-style';
		}

		if ( !empty($this->atts['content_align_vertical']) && 'content-vert-top' !== $this->atts['content_align_vertical'] ) {
			$block_classes[] = 'tdc-row-' . $this->atts['content_align_vertical'];
		}

		$row_class = 'tdc-row';

		$buffy .= '<div ' . $this->get_block_dom_id() . 'class="' . $this->get_block_classes($block_classes) . '" >';
		//get the block css

		// Flag used to know outside if the '.clearfix' element is added as last child in vc_row and vc_row_inner
		// '.clearfix' was necessary to apply '::after' css settings from TagDiv Composer (the '::after' element comes with absolute position and at the same time a 'clear' is necessary)
		$clearfixColumns = false;

		if ( ! empty( $this->atts['video_background'] ) ) {

			$output = '';

			$videos_info = td_remote_video::api_get_videos_info( array( $this->atts['video_background'] ), 'youtube');

			if ( is_array( $videos_info ) && count( $videos_info ) ) {
				$row_class .= ' tdc-row-video-background';

				ob_start();
				?>

				<style>

					.tdc-row-video-background {
						position: relative;
					}
					.tdc-video-outer-wrapper {
						position: absolute;
						width: 100%;
						height: 100%;
						overflow: hidden;
						left: 0;
						right: 0;
						pointer-events: none;
						top: 0;
					}
					@media (max-width: 767px) {
						.tdc-video-outer-wrapper {
							width: 100vw;
							left: 50%;
							transform: translateX(-50%);
							-webkit-transform: translateX(-50%);
						}
					}

					.tdc-video-parallax-wrapper,
					.tdc-video-inner-wrapper {
						position: absolute;
						width: 100%;
						height: 100%;
						left: 0;
						right: 0;
					}

					.tdc-video-inner-wrapper iframe {
						opacity: 0;
						transition: opacity 0.4s;
						position: absolute;
						left: 50%;
						top: 50%;
						transform: translate3d(-50%, -50%, 0);
						-webkit-transform: translate3d(-50%, -50%, 0);
						-moz-transform: translate3d(-50%, -50%, 0);
						-ms-transform: translate3d(-50%, -50%, 0);
						-o-transform: translate3d(-50%, -50%, 0);
					}

					.tdc-video-inner-wrapper iframe.tdc-video-background-visible {
						opacity: 1 !important;
					}

					.tdc-row[class*="stretch_row"] .tdc-video-outer-wrapper {
						width: 100vw;
						left: 50%;
						transform: translateX(-50%);
						-webkit-transform: translateX(-50%);
						-moz-transform: translateX(-50%);
						-ms-transform: translateX(-50%);
						-o-transform: translateX(-50%);
					}

				</style>

				<?php
				$output = ob_get_clean();

				$output .= '<div class="tdc-video-outer-wrapper">';
				$output .= '<div class="tdc-video-parallax-wrapper">';
				$output .= '<div class="tdc-video-inner-wrapper" data-video-scale="' . $this->atts['video_scale'] . '" data-video-opacity="' . $this->atts['video_opacity'] . '">';

				foreach ( $videos_info as $video_id => $video_info ) {
					$output .= $videos_info[ $video_id ]['embedHtml'];
					break;
				}

				$output .= '</div>';
				$output .= '</div>';
				$output .= '</div>';

				ob_start();
				?>

				<script>

					jQuery(window).ready(function () {

						// We need timeout because the content must be rendered and interpreted on client
						setTimeout(function() {

							var $content = jQuery('body').find('#tdc-live-iframe'),
								refWindow = undefined;

							if ($content.length) {
								$content = $content.contents();
								refWindow = document.getElementById( 'tdc-live-iframe' ).contentWindow || document.getElementById( 'tdc-live-iframe' ).contentDocument;

							} else {
								$content = jQuery('body');
								refWindow = window;
							}

							var $tdcVideoInnerWrappers = $content.find('#<?php echo $this->block_uid ?> .tdc-video-inner-wrapper:first');



							$tdcVideoInnerWrappers.each(function() {
								var $wrapper = jQuery(this);

								var $iframe = $wrapper.find('iframe');

								if ('undefined' !== typeof $wrapper.data('video-scale')) {
									$wrapper.css({
										transform: 'scale(' + $wrapper.data('video-scale') + ')'
									});
								}
								if ('undefined' !== typeof $wrapper.data('video-opacity')) {
									$wrapper.css({
										opacity: $wrapper.data('video-opacity')
									});
								}

								if ( $iframe.length ) {

									if ('undefined' === typeof $iframe.data('src-src')) {
										$iframe.data('api-src', $iframe.attr('src'));
									}

									var iframeSettingsStr = '',
										iframeSettings = {
											autoplay: 1,
											loop: 1,
											mute: 1,
											showinfo: 0,
											controls: 0,
											start: 2,
											playlist: '<?php echo $this->atts['video_background'] ?>'
										};

									for (var prop in iframeSettings) {
										iframeSettingsStr += prop + '=' + iframeSettings[prop] + '&';
									}

									$iframe.attr('src', $iframe.data('api-src') + '?' + iframeSettingsStr);

									$iframe.load(function () {
										var $iframe = jQuery(this),
											iframeWidth = $iframe.width(),
											iframeHeight = $iframe.height(),
											iframeAspectRatio = iframeHeight / iframeWidth,
											wrapperWidth = $wrapper.width(),
											wrapperHeight = $wrapper.height(),
											wrapperAspectRatio = wrapperHeight / wrapperWidth;

										$iframe.attr( 'aspect-ratio', iframeAspectRatio );

										if (iframeAspectRatio < wrapperAspectRatio) {
											$iframe.css({
												width: wrapperHeight / iframeAspectRatio,
												height: wrapperHeight
											});
										} else if (iframeAspectRatio > wrapperAspectRatio) {
											$iframe.css({
												width: '100%',
												height: iframeAspectRatio * wrapperWidth
											});
										}

										setTimeout(function () {
											$iframe.addClass('tdc-video-background-visible');
										}, 100);

									});
								}

								return;
							});

						}, 200);
					});

				</script>

				<?php

				if ( defined( 'TD_SPEED_BOOSTER' ) ) {
					td_js_buffer::add_to_footer( td_util::remove_script_tag( ob_get_clean() ) );
				} else {
					$output .= ob_get_clean();
				}
			}

			$buffy .= $output;
		}

		$buffy .= $css_elements;

		// row divider
		$row_divider_bottom = $this->atts[ 'row_divider_bottom' ];
		$row_divider_top = $this->atts[ 'row_divider_top' ];

		if ( !empty( $row_divider_bottom ) || !empty( $row_divider_top ) ) {
			$svg_data = array(
				'tdc-divider1' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="tdm-svg1" d="M0,700V379.5s202.305-24.86,347.625-25.735C579.21,352.37,802.4,388.177,1028.62,388.177c267.7,0,688.66-114.675,971.38-113.177V700H0Z"/>
									<path class="tdm-svg2" d="M0,700V351s196.305-40.735,418.125-40.735c302.089,0,417.275,50.912,643.495,50.912C1329.32,361.177,1706.78,239,2000,239V700H0Z"/>
									<path class="tdm-svg3" d="M0,700V337.5s209.805-48.235,431.625-48.235c302.089,0,450.275,34.412,676.495,34.412C1375.82,323.677,1727.78,221,2000,221V700H0Z"/>
						            </svg>',
				'tdc-divider2' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,700V150L2000,390V700H0Z"/>
									</svg>',
				'tdc-divider3' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="tdm-svg1" d="M0,700V209L2000,389V700H0Z"/>
									<path class="tdm-svg2" d="M0,700V169L2000,389V700H0Z"/>
									<path class="tdm-svg3" d="M0,700V129L2000,389V700H0Z"/>
									</svg>',
				'tdc-divider4' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,700V194L1000,391,2000,194V700H0Z"/>
									</svg>',
				'tdc-divider5' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="tdm-svg1" d="M0,700V388L1000,275,2000,388V700H0Z"/>
									<path class="tdm-svg2" d="M0,700V358l1000-83,1000,83V700H0Z"/>
									<path class="tdm-svg3" d="M0,700V328l1000-53,1000,53V700H0Z"/>
									<path class="tdm-svg4" d="M0,700V298l1000-23,1000,23V700H0Z"/>
									</svg>',
				'tdc-divider6' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,700V278L390,395,2000,168V700H0Z"/>
									</svg>',
				'tdc-divider7' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="tdm-svg1" d="M0,700V339l390,47L2000,259V700H0Z"/>
									<path class="tdm-svg2" d="M0,700V309l390,77L2000,229V700H0Z"/>
									<path class="tdm-svg3" d="M0,700V279L390,386,2000,199V700H0Z"/>
									<path class="tdm-svg4" d="M0,700V249L390,386,2000,169V700H0Z"/>
									</svg>',
				'tdc-divider8' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,700V165.5c377.307,244.841,655.891-53.483,1028.62,8.677C1404.35,236.835,1508.11,549.106,2000,281V700H0Z"/>
									</svg>',
				'tdc-divider9' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,700V154L215,71,601,252l279-81,576,215,544-268V700H0Z"/>
									</svg>',
				'tdc-divider10' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="tdm-svg1" d="M0,520V196l215-83L601,264l279-51,576,175,544-228V520H0Z"/>
									<path class="tdm-svg2" d="M0,520V276L492,157,949,388l727-160,324,162V520H0Z"/>
									<path class="tdm-svg3" d="M0,520V150L305,63,641,344l489-171,326,265L2000,90V520H0Z"/>
									</svg>',
				'tdc-divider11' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,700V382H454c493.833,0,546-119.232,546-119.232S1050.67,382,1546,382h454V700H0Z"/>
									</svg>',
				'tdc-divider12' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="cls-1" d="M0,700V231S243,389,1000,389,2000,231,2000,231V700H0Z"/>
									</svg>',
				'tdc-divider13' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,470V227S81.891,385,620,385c757,0,1380-318,1380-318V470H0Z"/>
									</svg>',
				'tdc-divider14' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path class="tdm-svg1" d="M0,506V313s243,68,1000,68,1000-68,1000-68V506H0Z"/>
									<path class="tdm-svg2" d="M0,506V273s243,98,1000,98,1000-98,1000-98V506H0Z"/>
									<path class="tdm-svg3" d="M0,506V233S243,361,1000,361,2000,233,2000,233V506H0Z"/>
									</svg>',
				'tdc-divider15' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,510V350H963.645c32.258,0,35.855,29.987,35.855,29.987S1003.98,350,1036.16,350H2000V510H0Z"/>
									</svg>',
				'tdc-divider16' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,520V360H981.974l18.146,22.99L1018.93,360H2000V520H0Z"/>
									</svg>',
				'tdc-divider17' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,513V373l15.793,15.882L30.633,373l15.458,15.881L60.931,373,76.39,388.882,91.23,373l15.458,15.881L121.528,373l15.458,15.881L151.826,373l15.459,15.881L182.125,373l15.458,15.881L212.423,373l15.459,15.881L242.721,373l15.459,15.881L273.02,373l15.458,15.881L303.318,373l15.459,15.881L333.616,373l15.459,15.881L363.915,373l15.458,15.881L394.213,373l15.459,15.881L424.512,373l15.458,15.881L454.81,373l15.458,15.881L485.108,373l15.459,15.881L515.407,373l15.458,15.881L545.705,373l15.459,15.881L576,373l15.459,15.881L606.3,373l15.458,15.881L636.6,373l15.459,15.881L666.9,373l15.459,15.881L697.2,373l15.458,15.881L727.5,373l15.459,15.881L757.794,373l15.458,15.881L788.092,373l15.458,15.881L818.39,373l15.459,15.881L848.689,373l15.458,15.881L878.987,373l15.458,15.881L909.285,373l15.459,15.881L939.584,373l15.458,15.881L969.882,373l15.458,15.881L1000.18,373l15.46,15.881L1030.48,373l15.46,15.881L1060.78,373l15.46,15.881L1091.08,373l15.45,15.881L1121.37,373l15.46,15.881L1151.67,373l15.46,15.881L1181.97,373l15.46,15.881L1212.27,373l15.46,15.881L1242.57,373l15.46,15.881L1272.87,373l15.45,15.881L1303.16,373l15.46,15.881L1333.46,373l15.46,15.881L1363.76,373l15.46,15.881L1394.06,373l15.46,15.881L1424.36,373l15.46,15.881L1454.66,373l15.45,15.881L1484.95,373l15.46,15.881L1515.25,373l15.46,15.881L1545.55,373l15.46,15.881L1575.85,373l15.46,15.881L1606.15,373l15.46,15.881L1636.45,373l15.45,15.881L1666.74,373l15.46,15.881L1697.04,373l15.46,15.881L1727.34,373l15.46,15.881L1757.64,373l15.46,15.881L1787.94,373l15.46,15.881L1818.24,373l15.45,15.881L1848.53,373l15.46,15.881L1878.83,373l15.46,15.881L1909.13,373l15.46,15.881L1939.43,373l15.46,15.881L1969.73,373l15.46,15.881L2000,373V513H0Z"/>
									</svg>',
				'tdc-divider18' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M0,460V380l7.9,7.941,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94L257.7,380l7.73,7.94,7.42-7.94,7.729,7.94L288,380l7.729,7.94,7.42-7.94,7.729,7.94L318.3,380l7.729,7.94,7.42-7.94,7.729,7.94L348.6,380l7.73,7.94,7.42-7.94,7.729,7.94L378.9,380l7.729,7.94,7.42-7.94,7.729,7.94L409.2,380l7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.419-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94L863.67,380l7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94,7.42-7.94,7.729,7.94L1000,380l7.9,7.941,7.42-7.94,7.73,7.94,7.42-7.94,7.72,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.41-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94L1288,380l7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.72,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.72,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.72,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.72,7.94,7.42-7.94,7.73,7.94,7.42-7.94,7.73,7.94L2000,380v80H0Z"/>
									</svg>',
				'tdc-divider19' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M2000,510H0S-0.079,391.659-.079,352.791A80.746,80.746,0,0,1,32.5,346c29.656,0,55.416,15.8,68.446,39,10.6-16.449,27.22-31.234,48.244-41.287,20.74-9.917,42.37-13.6,61.631-11.707,13.805-38.933,61.041-66.769,112.568-64.083,47.118,2.456,83.1,29.666,90.44,64.7,27.083-15.876,63.74-25.051,102.3-23.453,21.837,0.9,41.773,5.163,58.725,11.926,22.1-43.427,67.837-72.161,117.067-68.847a108.732,108.732,0,0,1,60.16,22.879c52.658-45.88,148.65-60.211,239.889-30.58,53.817,17.477,96.307,47.115,122.337,81.48,27.71-11.093,60.34-16.563,94.07-14.3,56.8,3.81,102.16,28.566,122.12,62.079a132.87,132.87,0,0,1,61.86-9.319,127.066,127.066,0,0,1,33.57,7.565c18.5-47.424,71.46-79.58,128.43-74.565,26.57,2.339,49.92,12.409,67.7,27.5a133,133,0,0,1,54.3-6.5c32.97,2.9,60.98,17.7,79.54,39.224a102.2,102.2,0,0,1,70.88-20.337c29.83,2.619,54.42,17.789,68.2,39.142a103.263,103.263,0,0,1,31.8-2.142,99.217,99.217,0,0,1,22.82,4.711,100.627,100.627,0,0,1,50.51-23.763C2000.11,411.966,2000,510,2000,510Z"/>
									</svg>',
				'tdc-divider20' => '<svg class="tdm-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 400" preserveAspectRatio="none">
									<path d="M1919.16,381.161c-47.52.211-52.83,3.175-52.83,3.175s-8.27,1.9-8.27-4.446c-0.11-7.091,1.06-13.759-3.18-13.97s0.42,12.912-7.64,12.7c-14.75,0-.85-78.532-10.18-78.744s12.94,86.365-23.55,86.365c-12.63,0,1.27-20.321-8.92-20.321s1.17,19.792-7,22.861c-8.48,2.752-56.65,5.715-87.2-6.35s-41.37-18.2-75.1-16.511-27.16,9.525-44.56,8.89c-10.61-.423-0.21-31.752-7-31.752-5.73,0,2.54,23.5-12.09,23.5-25.25,0-2.55-71.124-15.92-71.124-8.7,0,9.18,77.474-19.73,77.474-32.88,0-10.39-55.248-21-55.248s13.03,43.817-25.01,43.817c-23.13,0-10.18-14.6-17.19-14.6s5.63,14.6-10.82,14.6c-18.03,0,.64-53.343-8.91-53.343s7.14,51.438-24.64,51.438c-21.74,0-2.12-64.773-12.09-64.773s5.41,72.394-12.09,72.394c-26.26,0-8.07-17.781-17.83-17.781s13.01,23.5-31,23.5c-18.25,0,2.12-74.3-10.18-74.3s15.48,90.175-29.92,90.175c-42.59,0-89.18-8.909-105.32-18.577-15.48-9.567,7.21-86.2-7.64-86.2s4.88,77.792-17.82,78.109c-16.55-.1-2.55-25.4-12.1-25.4s10.82,24.978-14,27.942c-12.94,1.481-12.09-12.7-51.56-12.7s-47.52,22.12-73.19,26.036c-28.12,3.916-61.214,2.011-73.838,0-14.321-3.175.849-24.131-8.911-24.131s6.153,20.956-8.911,20.956c-35.114,0-10.184-85.73-22.914-85.73s5.2,78.745-7.638,78.745c-13.9,0-1.91-12.066-9.548-12.066s4.486,17.781-5.092,17.781c-10.214,0-7-4.445-18.458-4.445s-6.789,11.431-17.186,11.431-3.606-3.811-22.914-3.811S823.207,394.5,795.625,394.5s-25.46-14.606-54.1-14.606-23.974,8.891-66.832,8.891c-45.4,0-17.61-90.175-29.916-90.175s8.063,74.3-10.184,74.3c-31.347,0-11.244-23.5-21-23.5s8.434,17.781-17.822,17.781c-17.5,0-2.122-72.394-12.094-72.394s9.654,64.773-12.093,64.773c-21.111,0-5.092-51.438-14.64-51.438s6.79,53.343-8.911,53.343c-16.442,0-3.819-14.6-10.82-14.6s5.941,14.6-17.186,14.6c-48.374,0-24.4-43.817-35.007-43.817s11.881,55.248-21,55.248c-28.907,0-11.032-77.474-19.731-77.474-13.367,0,9.335,71.124-15.913,71.124-14.639,0-6.365-23.5-12.093-23.5-6.789,0,3.607,31.329-7,31.752-17.4.635-10.82-7.2-44.555-8.89s-44.555,4.445-75.107,16.511-78.713,9.1-87.2,6.35c-8.168-3.069,3.182-22.861-7-22.861s3.713,20.321-8.911,20.321c-36.492,0-14.215-86.577-23.55-86.365s4.562,78.744-10.184,78.744c-8.062.212-3.395-12.912-7.638-12.7s-3.077,6.879-3.183,13.97c0,6.351-8.274,4.446-8.274,4.446s-5.3-2.964-52.829-3.175S17.5,386.082,0,391.321V458H2000V391.321C1982.5,386.082,1966.69,380.949,1919.16,381.161Z"/>
									</svg>',
			);

			$buffy .= '<div class="tdc-row-divider">';
			if ( !empty( $row_divider_top ) ) {
				$buffy .= '<div class="' . $row_divider_top . ' tdc-row-divider-top"><div class="tdc-divider-space"></div>' . $svg_data[ $row_divider_top ] . '</div>';
			}
			if ( !empty( $row_divider_bottom ) ) {
				$buffy .= '<div class="' . $row_divider_bottom . ' tdc-row-divider-bottom"><div class="tdc-divider-space"></div>' . $svg_data[ $row_divider_bottom ] . '</div>';
			}
			$buffy .= '</div>';
		}


		$buffy .= $this->do_shortcode($content);

		// Add '.clearfix' element as last child in vc_row and vc_row_inner
		if ($clearfixColumns) {
			$buffy .= PHP_EOL . '<span class="clearfix"></span>';
		}

		$buffy .= '</div>';

		$full_width = $this->atts[ 'full_width' ];

		if ( !empty( $full_width ) ) {
			$row_class .= ' ' . $full_width;
		}


		// The following commented code is for the new theme
		//if (tdc_state::is_live_editor_iframe() || tdc_state::is_live_editor_ajax()) {
		$buffy = '<div id="' . $this->block_uid . '" class="' . $row_class . '">' . $buffy . '</div>';
		//}


		ob_start();
		?>

		<script>

			jQuery(window).load(function () {
				jQuery('body').find('#<?php echo $this->block_uid ?> .td-element-style').each(function (index, element) {
					jQuery(element).css('opacity', 1);
					return;
				});
			});

		</script>

		<?php

		if ( defined( 'TD_SPEED_BOOSTER' ) ) {
			td_js_buffer::add_to_footer( td_util::remove_script_tag( ob_get_clean() ) );
		} else {
			$buffy .= ob_get_clean();
		}

		if ( !empty( $this->atts['row_parallax'] ) ) {

			ob_start();
			?>

			<script>

				jQuery(window).ready(function () {

					// We need timeout because the content must be rendered and interpreted on client
					setTimeout(function () {

						var $content = jQuery('body').find('#tdc-live-iframe'),
							refWindow = undefined;

						if ($content.length) {
							$content = $content.contents();
							refWindow = document.getElementById('tdc-live-iframe').contentWindow || document.getElementById('tdc-live-iframe').contentDocument;

						} else {
							$content = jQuery('body');
							refWindow = window;
						}

						$content.find('#<?php echo $this->block_uid ?> .td-element-style').each(function (index, element) {
							jQuery(element).css('opacity', 1);
							return;
						});

						$content.find('#<?php echo $this->block_uid ?> .td-element-style-before').each(function (index, element) {
							if ('undefined' !== typeof refWindow.td_compute_parallax_background) {
								refWindow.td_compute_parallax_background(element);
								return;
							}
						});

						$content.find('#<?php echo $this->block_uid ?> .tdc-video-parallax-wrapper').each(function (index, element) {
							if ( 'undefined' !== typeof refWindow.td_compute_parallax_background ) {
								refWindow.td_compute_parallax_background(element);
							}
						});


						if ('undefined' !== typeof refWindow.td_compute_parallax_background) {
							refWindow.tdAnimationScroll.compute_all_items();
						}
					});

				}, 200);
			</script>

			<?php

			if ( defined( 'TD_SPEED_BOOSTER' ) ) {
				td_js_buffer::add_to_footer( td_util::remove_script_tag( ob_get_clean() ) );
			} else {
				$buffy .= ob_get_clean();
			}

		} else {
			ob_start();
			?>

			<script>

				jQuery(window).ready(function () {

					// We need timeout because the content must be rendered and interpreted on client
					setTimeout(function () {

						var $content = jQuery('body').find('#tdc-live-iframe'),
							refWindow = undefined;

						if ($content.length) {
							$content = $content.contents();
							refWindow = document.getElementById('tdc-live-iframe').contentWindow || document.getElementById('tdc-live-iframe').contentDocument;

						} else {
							$content = jQuery('body');
							refWindow = window;
						}

						$content.find('#<?php echo $this->block_uid ?> .td-element-style').each(function (index, element) {
							jQuery(element).css('opacity', 1);
							return;
						});
					});

				}, 200);
			</script>

			<?php

			if ( defined( 'TD_SPEED_BOOSTER' ) ) {
				td_js_buffer::add_to_footer( td_util::remove_script_tag( ob_get_clean() ) );
			} else {
				$buffy .= ob_get_clean();
			}
		}

		td_global::set_in_row(false);

		// td-composer PLUGIN uses to add blockUid output param when this shortcode is retrieved with ajax (@see tdc_ajax)
		do_action( 'td_block_set_unique_id', array( &$this ) );

		return $buffy;
	}

	/**
	 * Safe way to read $this->atts. It makes sure that you read them when they are ready and set!
	 * @param $att_name
	 * @return mixed
	 */
	public function get_custom_att($att_name) {
		if ( !isset( $this->atts ) ) {
		    echo 'TD Composer Internal error: The atts are not set yet(AKA: the LOCAL render method was not called yet and the system tried to read an att)';
			die;
		}

		if ( !isset( $this->atts[$att_name] ) ) {
			var_dump($this->atts);
			echo 'TD Composer Internal error: The system tried to use an LOCAL att that does not exists! class_name: ' . get_class($this) . '  Att name: "' . $att_name . '" The list with available atts is in vc_row::render';
			die;
		}
		return $this->atts[$att_name];
	}

}