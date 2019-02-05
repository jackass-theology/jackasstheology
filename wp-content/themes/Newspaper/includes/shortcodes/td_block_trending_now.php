<?php
// v3 - for wp_010 from block 3

class td_block_trending_now extends td_block {

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @header_color */
				body .$unique_block_class .td-trending-now-title,
				.$unique_block_class .td-trending-now-wrapper:hover .td-trending-now-title {
					background-color: @header_color;
				}
				.$unique_block_class .td-next-prev-wrap a:hover {
				    color: #fff;
				}
                /* @header_text_color */
				.$unique_block_class .td-trending-now-title {
					color: @header_text_color;
				}
                /* @articles_color */
				.$unique_block_class .entry-title a {
					color: @articles_color;
				}
				/* @next_prev_color */
				.$unique_block_class .td-next-prev-wrap a {
					color: @next_prev_color;
				}
				/* @next_prev_border_color */
				.$unique_block_class .td-next-prev-wrap a {
					border-color: @next_prev_border_color;
				}

				/* @f_title */
				.$unique_block_class .td-trending-now-title {
					@f_title
				}
				/* @f_article */
				.$unique_block_class .entry-title a {
					@f_article
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

	    $res_ctx->load_settings_raw( 'header_color', $res_ctx->get_shortcode_att('header_color') );
	    $res_ctx->load_settings_raw( 'header_text_color', $res_ctx->get_shortcode_att('header_text_color') );
        // articles title color
        $res_ctx->load_settings_raw( 'articles_color', $res_ctx->get_shortcode_att('articles_color') );

        // next prev arrow color
        $res_ctx->load_settings_raw( 'next_prev_color', $res_ctx->get_shortcode_att('next_prev_color') );

        // next prev border color
        $res_ctx->load_settings_raw( 'next_prev_border_color', $res_ctx->get_shortcode_att('next_prev_border_color') );



        /*-- FONTS -- */
	    $res_ctx->load_font_settings( 'f_title' );
	    $res_ctx->load_font_settings( 'f_article' );
    }

    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        $buffy = ''; //output buffer


	    $additional_classes = array();


        // style 2
        if(!empty($atts['style'])) {
	        $additional_classes []= 'td-pb-full-cell';
	        $additional_classes []= 'td-trending-style2';
        }


        $buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

		    //get the block js
		    $buffy .= $this->get_block_css();

		    //get the js for this block
		    $buffy .= $this->get_block_js();

            //get the sub category filter for this block
            //$buffy .= $this->get_pull_down_filter();

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';

                $buffy .= $this->inner($this->td_query->posts, '' , $atts);  //inner content of the block

            $buffy .= '</div>';

            //get the ajax pagination for this block (not required - this block comes with it's own pagination)
            //$buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '', $atts = array()) {

        $buffy = '';
        $navigation = '';

        if (!empty($atts['navigation'])) {
            $navigation = $atts['navigation'];
        }

        $td_block_layout = new td_block_layout();

        if (!empty($posts)) {

            $buffy .= $td_block_layout->open_row();

            $buffy .= '<div class="td-trending-now-wrapper" id="' . $this->block_uid . '" data-start="' . esc_attr($navigation) . '">';
                $buffy .= '<div class="td-trending-now-title">' . __td('Trending Now', TD_THEME_NAME) . '</div><div class="td-trending-now-display-area">';

                foreach ($posts as $post_count => $post) {

                    $td_module_trending_now = new td_module_trending_now($post);

                    $buffy .= $td_module_trending_now->render($post_count);
                }

                $buffy .= '</div>';

                $buffy .= '<div class="td-next-prev-wrap">';
                    $buffy .= '<a href="#"
                                  class="td_ajax-prev-pagex td-trending-now-nav-left"
                                  data-block-id="' . $this->block_uid . '"
                                  data-moving="left"
                                  data-control-start="' . $navigation . '"><i class="td-icon-menu-left"></i></a>';

                    $buffy .= '<a href="#"
                                  class="td_ajax-next-pagex td-trending-now-nav-right"
                                  data-block-id="' . $this->block_uid . '"
                                  data-moving="right"
                                  data-control-start="' . $navigation . '"><i class="td-icon-menu-right"></i></a>';
                $buffy .= '</div>';
            $buffy .= '</div>';

            $buffy .= $td_block_layout->close_row();
        }

        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }

    /**
     * tagDiv composer specific code:
     *  - it's added to the end of the iFrame when the live editor is active (when @see td_util::tdc_is_live_editor_iframe()  === true)
     *  - it is injected int he iFrame and evaluated there in the global scoupe when a new block is added to the page via AJAX!
     * @return string the JS without <script> tags
     */
    function js_tdc_callback_ajax() {
        $buffy = '';

        // add a new composer block - that one has the delete callback
        $buffy .= $this->js_tdc_get_composer_block();

        ob_start();
        ?>
        <script>
            (function () {

                var item = new tdTrendingNow.item(),
                    autoStart = jQuery('#<?php echo $this->block_uid?>').data('start'),
                    iCont = 0;

                //block unique ID
                item.blockUid = '<?php echo $this->block_uid; ?>';
                //wrapper unique ID
                item.wrapperUid = jQuery('#<?php echo $this->block_uid?> .td-trending-now-wrapper').attr('id');

                //set trendingNowAutostart
                if (autoStart !== 'manual') {
                    item.trendingNowAutostart = autoStart;
                }

                //take the text from each post from current trending-now-wrapper
                jQuery('#' + item.blockUid + ' .td-trending-now-post').each(function() {
                    //trending_list_posts[i_cont] = jQuery(this)[0].outerHTML;
                    item.trendingNowPosts[iCont] = jQuery(this);
                    //increment the counter
                    iCont++;
                });

                /**
                 * if an item does not have posts no animation is required so no item is created
                 * @see tdTrendingNow.addItem
                 */
                if (typeof item.trendingNowPosts === 'undefined' || item.trendingNowPosts.length < 1) {
                    return;
                }

                //add the item
                tdTrendingNow.addItem(item);
                
            })();
        </script>
        <?php
        return $buffy . td_util::remove_script_tag(ob_get_clean());
    }
}