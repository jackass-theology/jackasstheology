<?php

/**
 *
 * Class td_block_big_grid_fl_10
 */
class td_block_big_grid_fl_10 extends td_block {

    const POST_LIMIT = 5;

    static function cssMedia( $res_ctx ) {

        // module mx25 fonts
        $res_ctx->load_font_settings( 'mx25f_title' );
        $res_ctx->load_font_settings( 'mx25f_cat' );
        // module mx19 fonts
        $res_ctx->load_font_settings( 'mx19f_title' );
        $res_ctx->load_font_settings( 'mx19f_cat' );
        $res_ctx->load_font_settings( 'mx19f_meta' );

        if ( $res_ctx->is( 'phone' ) ) {
            $res_ctx->load_settings_raw( 'big_grid_group',  '1' );
            $res_ctx->load_settings_raw( 'big_grid_scroll_title',  '1' );
        }

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @mx25f_title */
				.$unique_block_class .td_block_inner .td_module_mx25 .td-big-grid-meta .entry-title {
					@mx25f_title
				}
				/* @mx25f_cat */
				.$unique_block_class .td_module_mx25 .td-post-category {
					@mx25f_cat
				}
                /* @mx19f_title */
				.$unique_block_class .td_block_inner .td_module_mx19 .entry-title {
					@mx19f_title
				}
				/* @mx19f_cat */
				.$unique_block_class .td_module_mx19 .td-post-category {
					@mx19f_cat
				}
				/* @mx19f_meta */
				.$unique_block_class .td_module_mx19 .td-module-meta-info {
					@mx19f_meta
				}

				/* @big_grid_group */
				body .$unique_block_class .td_block_inner .td-big-grid-column .td-big-grid-meta .entry-title {
					@mx25f_title
				}
				.$unique_block_class .td-big-grid-column .td-post-category {
					@mx25f_cat
				}
				/* @big_grid_scroll_title */
				body .$unique_block_class .td_block_inner .td-big-grid-scroll .td-big-grid-meta .entry-title {
					@mx19f_title
				}
				.$unique_block_class .td-big-grid-scroll .td-post-category {
					@mx19f_cat
				}
				.$unique_block_class .td-big-grid-scroll .td-module-meta-info {
					@mx19f_meta
				}

			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();

        return $compiled_css;
    }

    function render($atts, $content = null){

        // for big grids, extract the td_grid_style
        extract(shortcode_atts(
            array(
                'td_grid_style' => 'td-grid-style-1'
            ), $atts));

		if ( empty( $atts ) ) {
			$atts = array();
		}
        $atts['limit'] = self::POST_LIMIT;

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)


        $buffy = '';

        $buffy .= '<div class="' . $this->get_block_classes(array($td_grid_style, 'td-hover-1 td-big-grids-fl td-big-grids-scroll td-big-grids-margin')) . '" ' . $this->get_block_html_atts() . '>';
            //get the block css
            $buffy .= $this->get_block_css();

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
                $buffy .= $this->inner($this->td_query->posts, $this->get_att('td_column_number')); //inner content of the block
            $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';


        $td_block_layout = new td_block_layout();

        if (!empty($posts)) {

            if ($td_column_number==1 || $td_column_number==2) {
                $buffy .= td_util::get_block_error('Big grid full 10', 'Please move this shortcode on a full row in order for it to work.');
            } else {

                $td_count_posts = count($posts); // post count number

                $buffy .= '<div class="td-big-grid-wrapper td-posts-' . $td_count_posts . '">';

                $post_count = 0;

                // when 3 posts make post scroll full
                $td_scroll_posts = '';
                if (count($posts) == 3) {
                    $td_scroll_posts = ' td-scroll-full';
                }

                foreach ($posts as $post) {

                    if ($post_count == 0) {
                        $buffy .= '<span class="td-big-grid-column">';
                    }

                    if ($post_count < 2) {
                        $td_module_mx25 = new td_module_mx25($post, $this->get_all_atts());
                        $buffy .= $td_module_mx25->render($post_count);

                        $post_count++;
                        continue;
                    }

                    if ($post_count == 2) {
                        $buffy .= '<div class="clearfix"></div>';
                        $buffy .= '</span>';
                        $buffy .= '<div class="td-big-grid-scroll' . $td_scroll_posts . '">';
                    }

                    if ($post_count == 2) {
                        $td_module_mx19 = new td_module_mx19($post, $this->get_all_atts());
                        $buffy .= $td_module_mx19->render($post_count);
                        $post_count++;
                        continue;
                    }

                    if ($post_count == 3) {
                        $td_module_mx25 = new td_module_mx25($post, $this->get_all_atts());
                        $buffy .= $td_module_mx25->render($post_count);

                        $post_count++;
                        continue;
                    }

                    if ($post_count == 4) {
                        $td_module_mx25 = new td_module_mx25($post, $this->get_all_atts());
                        $buffy .= $td_module_mx25->render($post_count);

                        $post_count++;
                        continue;
                    }

                    $post_count++;
                }

                if ($post_count < self::POST_LIMIT) {

                    for ($i = $post_count; $i < self::POST_LIMIT; $i++) {

                        if ($post_count == 0) {
                            $buffy .= '<span>';
                        }

                        if ($post_count < 2) {
                            $td_module_mx_empty = new td_module_mx_empty();
                            $buffy .= $td_module_mx_empty->render($i, 'td_module_mx25');

                            $post_count++;
                            continue;
                        }

                        if ($post_count == 2) {
                            $buffy .= '<div class="clearfix"></div>';
                            $buffy .= '</span>';
                            $buffy .= '<div class="td-big-grid-scroll' . $td_scroll_posts . '">';
                        }

                        if ($post_count == 2) {
                            $td_module_mx_empty = new td_module_mx_empty();
                            $buffy .= $td_module_mx_empty->render($i, 'td_module_mx19');
                            $post_count++;
                            continue;
                        }

                        if ($post_count == 3) {
                            $td_module_mx_empty = new td_module_mx_empty();
                            $buffy .= $td_module_mx_empty->render($i, 'td_module_mx25');

                            $post_count++;
                            continue;
                        }

                        if ($post_count == 4) {
                            $td_module_mx_empty = new td_module_mx_empty();
                            $buffy .= $td_module_mx_empty->render($i, 'td_module_mx25');

                            $post_count++;
                            continue;
                        }

                        $post_count++;
                    }
                }

                $buffy .= '</div>';  // close td-big-grid-scroll
                $buffy .= '<div class="clearfix"></div>';
                $buffy .= '</div>'; // close td-big-grid-wrapper
            }
        }

        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }
}