<?php

/**
 * uses module mx16
 * Class td_block_24
 */
class td_block_24 extends td_block {

    static function cssMedia( $res_ctx ) {

        // fonts
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );

        // module mx16 fonts
        $res_ctx->load_font_settings( 'mx16f_title' );
        $res_ctx->load_font_settings( 'mx16f_cat' );
        $res_ctx->load_font_settings( 'mx16f_meta' );
        $res_ctx->load_font_settings( 'mx16f_ex' );
        $res_ctx->load_font_settings( 'mx16f_btn' );
        // module 19 fonts
        $res_ctx->load_font_settings( 'm19f_title' );
        $res_ctx->load_font_settings( 'm19f_cat' );
        $res_ctx->load_font_settings( 'm19f_meta' );
        $res_ctx->load_font_settings( 'm19f_ex' );
        $res_ctx->load_font_settings( 'm19f_btn' );

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
				/* @mx16f_title */
				.$unique_block_class .td_module_mx16 .entry-title {
					@mx16f_title
				}
				/* @mx16f_cat */
				.$unique_block_class .td_module_mx16 .td-post-category {
					@mx16f_cat
				}
				/* @mx16f_meta */
				.$unique_block_class .td_module_mx16 .td-post-author-name,
				.$unique_block_class .td_module_mx16 .td-post-date,
				.$unique_block_class .td_module_mx16 .td-module-comments a {
					@mx16f_meta
				}
				/* @mx16f_ex */
				.$unique_block_class .td_module_mx16 .td-excerpt {
					@mx16f_ex
				}
				/* @mx16f_btn */
				.$unique_block_class .td_module_mx16 .td-read-more a {
					@mx16f_btn
				}
				/* @m19f_title */
				.$unique_block_class .td_module_19 .entry-title {
					@m19f_title
				}
				/* @m19f_cat */
				.$unique_block_class .td_module_19 .td-post-category {
					@m19f_cat
				}
				/* @m19f_meta */
				.$unique_block_class .td_module_19 .td-post-author-name,
				.$unique_block_class .td_module_19 .td-post-date,
				.$unique_block_class .td_module_19 .td-module-comments a {
					@m19f_meta
				}
				/* @m19f_ex */
				.$unique_block_class .td_module_19 .td-excerpt {
					@m19f_ex
				}
				/* @m19f_btn */
				.$unique_block_class .td_module_19 .td-read-more a {
					@m19f_btn
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


        $buffy .= '<div class="' . $this->get_block_classes() . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

		    //get the js for this block
		    $buffy .= $this->get_block_js();

            // block title wrap
            $buffy .= '<div class="td-block-title-wrap">';
                $buffy .= $this->get_block_title(); //get the block title
                $buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
            $buffy .= '</div>';

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner td-column-' . $td_column_number . ' td-opacity-author">';
                $buffy .= $this->inner($this->td_query->posts); //inner content of the block
            $buffy .= '</div>';

            //get the ajax pagination for this block
            $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';

        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }

        if (!empty($posts)) {
            foreach ($posts as $post) {

                $td_module_mx16 = new td_module_mx16($post, $this->get_all_atts());
                $td_module_19 = new td_module_19($post, $this->get_all_atts());

                switch ($td_column_number) {
                    case '1':
                        $buffy .= $td_module_mx16->render($post);
                        break;

                    case '2':
                        $buffy .= $td_module_19->render($post);
                        break;

                    case '3':
                        $buffy .= $td_module_19->render($post);
                        break;
                }
            }
        }

        return $buffy;
    }
}
