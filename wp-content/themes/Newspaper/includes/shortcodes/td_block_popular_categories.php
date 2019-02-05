<?php

class td_block_popular_categories extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @category_color */
				.$unique_block_class .td-cat-name {
					color: @category_color;
				}
				/* @category_posts_color */
				.$unique_block_class .td-cat-no {
					color: @category_posts_color;
				}
				/* @category_color_h */
				.$unique_block_class li:hover .td-cat-name {
					color: @category_color_h;
				}
				/* @category_posts_color_h */
				.$unique_block_class li:hover .td-cat-no {
					color: @category_posts_color_h;
				}
				

                /* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_cat */
				.$unique_block_class .td-cat-name {
					@f_cat
				}
				/* @f_posts */
				.$unique_block_class .td-cat-no {
					@f_posts
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        // category name color
        $res_ctx->load_settings_raw( 'category_color', $res_ctx->get_shortcode_att('category_color') );

        // category posts count color
        $res_ctx->load_settings_raw( 'category_posts_color', $res_ctx->get_shortcode_att('category_posts_color') );

        // category name hover color
        $res_ctx->load_settings_raw( 'category_color_h', $res_ctx->get_shortcode_att('category_color_h') );

        // category posts count hover color
        $res_ctx->load_settings_raw( 'category_posts_color_h', $res_ctx->get_shortcode_att('category_posts_color_h') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_cat' );
        $res_ctx->load_font_settings( 'f_posts' );

    }


	/**
	 * Disable loop block features. This block does not use a loop and it dosn't need to run a query.
	 */
	function __construct() {
		parent::disable_loop_block_features();
	}



    function render($atts, $content = null){
        parent::render($atts);

        $buffy = '';

        extract(shortcode_atts(
            array(
                'limit' => '6', // show only 6 categories by default
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => ''
            ), $atts));

        $cat_args = array(
            'show_count' => true,
            'orderby' => 'count',
            'hide_empty' => false,
            'order' => 'DESC',
            'number' => $limit,
            'exclude' => get_cat_ID(TD_FEATURED_CAT)
        );


        // exclude categories from the demo
        if (TD_DEPLOY_MODE == 'demo' or TD_DEPLOY_MODE == 'dev') {
            $cat_args['exclude'] = '153, 154, 155, 156, 157, 158, 159, 90, 91, 92, 93 , 94, 95, 96, 97, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 82, 83, 84, 85, 86, 87, 88, 89, 98, ' . get_cat_ID(TD_FEATURED_CAT);
        }

        $categories = get_categories($cat_args); // has a limit of 6 by default

	    $buffy .= '<div class="' . $this->get_block_classes(array('widget', 'widget_categories')) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title();
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            if (!empty($categories)) {
                $buffy .= '<ul class="td-pb-padding-side">';
                    foreach ($categories as $category) {
                        if (strtolower($category->cat_name) != 'uncategorized') {
                            $buffy .= '<li><a href="' . get_category_link($category->cat_ID) . '"><span class="td-cat-name">' . $category->name . '</span><span class="td-cat-no">' . $category->count . '</span></a></li>';
                        }
                    }
                $buffy .= '</ul>';
            }
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

    }
}