<?php

class td_block_25 extends td_block {

    static function cssMedia( $res_ctx ) {

        // fonts
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );

        // module mx17 fonts
        $res_ctx->load_font_settings( 'mx17f_title' );
        $res_ctx->load_font_settings( 'mx17f_cat' );
        $res_ctx->load_font_settings( 'mx17f_meta' );
        // module 6 fonts
        $res_ctx->load_font_settings( 'm6f_title' );
        $res_ctx->load_font_settings( 'm6f_cat' );
        $res_ctx->load_font_settings( 'm6f_meta' );

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_ajax */
				.$unique_block_class .td-subcat-list a,
				.$unique_block_class .td-subcat-dropdown span,
				.$unique_block_class .td-subcat-dropdown a {
					@f_ajax
				}
				/* @f_more */
				.$unique_block_class .td-load-more-wrap a {
					@f_more
				}
				/* @mx17f_title */
				.$unique_block_class .td_module_mx17 .entry-title {
					@mx17f_title
				}
				/* @mx17f_cat */
				.$unique_block_class .td_module_mx17 .td-post-category {
					@mx17f_cat
				}
				/* @mx17f_meta */
				.$unique_block_class .td_module_mx17 .td-post-author-name,
				.$unique_block_class .td_module_mx17 .td-post-date,
				.$unique_block_class .td_module_mx17 .td-module-comments a {
					@mx17f_meta
				}
				/* @m6f_title */
				.$unique_block_class .td_module_6 .entry-title {
					@m6f_title
				}
				/* @m6f_cat */
				.$unique_block_class .td_module_6 .td-post-category {
					@m6f_cat
				}
				/* @m6f_meta */
				.$unique_block_class .td_module_6 .td-module-meta-info,
				.$unique_block_class .td_module_6 .td-module-comments a {
					@m6f_meta
				}
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();

        return $compiled_css;
    }

    function render($atts, $content = null) {

        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes() . ' td-column-' . $td_column_number . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

		    //get the js for this block
		    $buffy .= $this->get_block_js();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title(); //get the block title
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

	        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
	        $buffy .= $this->inner($this->td_query->posts);//inner content of the block
	        $buffy .= '</div>';

	        //get the ajax pagination for this block
	        $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';

        $td_block_layout = new td_block_layout();

        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }


        $td_post_count = 0; // the number of posts rendered

        if (!empty($posts)) {
            foreach ($posts as $post) {
                $td_module_mx17 = new td_module_mx17($post, $this->get_all_atts());
                $td_module_6 = new td_module_6($post, $this->get_all_atts());

                switch ($td_column_number) {

                    case '1': //one column layout
                        $buffy .= $td_block_layout->open12(); //added in 010 theme - span 12 doesn't use rows
                        if ($td_post_count == 0) { //first post
                            $buffy .= $td_module_mx17->render();
                        } else {
                            $buffy .= $td_module_6->render();
                        }
                        $buffy .= $td_block_layout->close12();
                        break;

                    case '2': //two column layout
                        $buffy .= $td_block_layout->open_row();
                        if ($td_post_count == 0) { //first post
                            $buffy .= $td_block_layout->open6();
                            $buffy .= $td_module_mx17->render();
                            $buffy .= $td_block_layout->close6();
                        } else { //the rest
                            $buffy .= $td_block_layout->open6();
                            $buffy .= $td_module_6->render();
                        }
                        break;

                    case '3': //three column layout
                        $buffy .= $td_block_layout->open_row();
                        if ($td_post_count <= 1) { //first post
                            $buffy .= $td_block_layout->open4();
                            $buffy .= $td_module_mx17->render();
                            $buffy .= $td_block_layout->close4();
                        } else { //2-3 cols
                            $buffy .= $td_block_layout->open4();
                            $buffy .= $td_module_6->render();
                        }
                        break;
                }
                $td_post_count++;
            }

        }
        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }
}