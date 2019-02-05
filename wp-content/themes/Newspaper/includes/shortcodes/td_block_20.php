<?php

/**
 * uses module mx3
 * Class td_block_20
 */
class td_block_20 extends td_block {

    static function cssMedia( $res_ctx ) {

        // fonts
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_ajax' );
        $res_ctx->load_font_settings( 'f_more' );

        // module mx3 fonts
        $res_ctx->load_font_settings( 'mx3f_title' );
        $res_ctx->load_font_settings( 'mx3f_cat' );
        $res_ctx->load_font_settings( 'mx3f_meta' );
        // module 14 fonts
        $res_ctx->load_font_settings( 'm14f_title' );
        $res_ctx->load_font_settings( 'm14f_cat' );
        $res_ctx->load_font_settings( 'm14f_meta' );
        $res_ctx->load_font_settings( 'm14f_ex' );
        $res_ctx->load_font_settings( 'm14f_btn' );

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
				/* @mx3f_title */
				.$unique_block_class .td_module_mx3 .entry-title {
					@mx3f_title
				}
				/* @mx3f_cat */
				.$unique_block_class .td_module_mx3 .td-post-category {
					@mx3f_cat
				}
				/* @mx3f_meta */
				.$unique_block_class .td_module_mx3 .td-module-meta-info,
				.$unique_block_class .td_module_mx3 .td-module-comments a {
					@m4f_meta
				}
				/* @m14f_title */
				.$unique_block_class .td_module_14 .entry-title {
					@m14f_title
				}
				/* @m14f_cat */
				.$unique_block_class .td_module_14 .td-post-category {
					@m14f_cat
				}
				/* @m14f_meta */
				.$unique_block_class .td_module_14 .td-module-meta-info,
				.$unique_block_class .td_module_14 .td-module-comments a {
					@m14f_meta
				}
				/* @m14f_ex */
				.$unique_block_class .td_module_14 .td-excerpt {
					@m14f_ex
				}
				/* @m14f_btn */
				.$unique_block_class .td_module_14 .td-read-more a {
					@m14f_btn
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
                $buffy .= $this->inner($this->td_query->posts, $td_column_number); //inner content of the block
            $buffy .= '</div>';

            //get the ajax pagination for this block
            $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';

        if (!empty($posts)) {
            foreach ($posts as $post) {

                $td_module_mx3 = new td_module_mx3($post, $this->get_all_atts());
                $td_module_14 = new td_module_14($post, $this->get_all_atts());

                switch ($td_column_number) {
                    case '1':
                        $buffy .= $td_module_mx3->render($post);
                        break;

                    case '2':
                        $buffy .= $td_module_14->render($post);
                        break;

                    case '3':
                        //we use module 14 - maybe use a full screen one?
                        $buffy .= $td_module_14->render($post);
                        break;
                }
            }
        }
        return $buffy;
    }
}
