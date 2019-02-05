<?php

class td_block_18 extends td_block {

    static function cssMedia( $res_ctx ) {

        // fonts
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );

        // module mx8 fonts
        $res_ctx->load_font_settings( 'mx8f_title' );
        $res_ctx->load_font_settings( 'mx8f_cat' );
        $res_ctx->load_font_settings( 'mx8f_meta' );
        // module 10 fonts
        $res_ctx->load_font_settings( 'm10f_title' );
        $res_ctx->load_font_settings( 'm10f_cat' );
        $res_ctx->load_font_settings( 'm10f_meta' );
        $res_ctx->load_font_settings( 'm10f_ex' );
        // module mx2 fonts
        $res_ctx->load_font_settings( 'mx2f_title' );
        $res_ctx->load_font_settings( 'mx2f_cat' );
        $res_ctx->load_font_settings( 'mx2f_meta' );

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
				/* @mx8f_title */
				.$unique_block_class .td_module_mx8 .entry-title {
					@mx8f_title
				}
				/* @mx8f_cat */
				.$unique_block_class .td_module_mx8 .td-post-category {
					@mx8f_cat
				}
				/* @mx8f_meta */
				.$unique_block_class .td_module_mx8 .td-author-date {
					@mx8f_meta
				}
				/* @m10f_title */
				.$unique_block_class .td_module_10 .entry-title {
					@m10f_title
				}
				/* @m10f_cat */
				.$unique_block_class .td_module_10 .td-post-category {
					@m10f_cat
				}
				/* @m10f_meta */
				.$unique_block_class .td_module_10 .td-module-meta-info,
				.$unique_block_class .td_module_10 .td-module-comments a {
					@m10f_meta
				}
				/* @m10f_ex */
				.$unique_block_class .td_module_10 .td-excerpt {
					@m10f_ex
				}
				/* @mx2f_title */
				.$unique_block_class .td_module_mx2 .entry-title {
					@mx2f_title
				}
				/* @mx2f_cat */
				.$unique_block_class .td_module_mx2 .td-post-category {
					@mx2f_cat
				}
				/* @mx2f_meta */
				.$unique_block_class .td_module_mx2 .td-module-meta-info,
				.$unique_block_class .td_module_mx2 .td-module-comments a {
					@mx2f_meta
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

	        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-column-' . $td_column_number . '">';
	        $buffy .= $this->inner($this->td_query->posts, $td_column_number);//inner content of the block
	        $buffy .= '</div>';

	        //get the ajax pagination for this block
	        $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';
        $td_post_count = 0; // the number of posts rendered
        $td_current_column = 1; //the current column

        if (!empty($posts)) {
            foreach ($posts as $post) {

                $td_module_mx8 = new td_module_mx8($post, $this->get_all_atts());
                $td_module_10 = new td_module_10($post, $this->get_all_atts());
                $td_module_mx2 = new td_module_mx2($post, $this->get_all_atts());

                switch ($td_column_number) {

                    case '1': //one column layout
                        if ($td_post_count == 0) { //first post
                            $buffy .= $td_module_mx8->render();
                        } else {
                            $buffy .= $td_module_mx2->render();
                        }
                        break;

                    case '2': //two column layout

                        if ($td_post_count == 0) { // big posts
                            $buffy .= $td_module_mx8->render();
                        } else {
                            $buffy .= $td_module_10->render();
                        }
                        break;

                    case '3': //three column layout
	                    if ($td_post_count == 0) { // big posts
		                    $buffy .= $td_module_mx8->render();
	                    } else {
		                    $buffy .= $td_module_10->render();
	                    }
                        break;
                }

                //current column
                if ($td_current_column == $td_column_number) {
                    $td_current_column = 1;
                } else {
                    $td_current_column++;
                }

                $td_post_count++;
            }
        }
        return $buffy;
    }
}