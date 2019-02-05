<?php

/**
 *
 * Class td_block_big_grid_9
 */
class td_block_big_grid_9 extends td_block {

    const POST_LIMIT = 4;

    static function cssMedia( $res_ctx ) {

        // module mx15 fonts
        $res_ctx->load_font_settings( 'mx15f_title' );
        $res_ctx->load_font_settings( 'mx15f_cat' );
        $res_ctx->load_font_settings( 'mx15f_meta' );
    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @mx15f_title */
				.$unique_block_class .td_block_inner .td_module_mx15 .entry-title {
					@mx15f_title
				}
				/* @mx15f_cat */
				.$unique_block_class .td_module_mx15 .td-post-category {
					@mx15f_cat
				}
				/* @mx15f_meta */
				.$unique_block_class .td_module_mx15 .td-module-meta-info {
					@mx15f_meta
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

        $buffy .= '<div class="' . $this->get_block_classes(array($td_grid_style, 'td-hover-1 td-big-grids')) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block css
		    $buffy .= $this->get_block_css();

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
                $buffy .= $this->inner($this->td_query->posts, $this->get_att('td_column_number')); //inner content of the block
                $buffy .= '<div class="clearfix"></div>';
            $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';


        if (!empty($posts)) {

            if ($td_column_number==1 || $td_column_number==2) {
                $buffy .= td_util::get_block_error('Big grid 9', 'Please move this shortcode on a full row in order for it to work.');
            } else {
                $buffy .= '<div class="td-big-grid-wrapper">';

                $post_count = 0;

                foreach ($posts as $post) {

                    $td_module_mx15 = new td_module_mx15($post, $this->get_all_atts());
                    $buffy .= $td_module_mx15->render($post_count);

                    $post_count++;
                }

                if ($post_count < self::POST_LIMIT) {

                    for ($i = $post_count; $i < self::POST_LIMIT; $i++) {

                        $td_module_mx_empty = new td_module_mx_empty();
                        $buffy .= $td_module_mx_empty->render($i, 'td_module_mx15');
                    }
                }

                $buffy .= '</div>';
            }
        }

        return $buffy;
    }
}