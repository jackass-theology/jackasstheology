<?php
class td_block_image_box extends td_block {

	private $atts = array(); //the atts used for rendering the current block

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

                /* @images_height */
				.$unique_block_class.td_block_image_box div .td-custom-image a {
					height: @images_height;
				}
				/* @images_gap */
				.$unique_block_class .td-image-box-row {
				    margin-left: -@images_gap;
				    margin-right: -@images_gap;
				}
				.$unique_block_class .td-image-box-span {
					padding-left: @images_gap;
					padding-right: @images_gap;
				}
				.$unique_block_class.td-box-vertical .td-image-box-span {
				    margin-bottom: @images_gap;
				}
				
				
				/* @custom_titles_color */
				.$unique_block_class .td-custom-title .entry-title a {
					color: @custom_titles_color;
				}
				/* @custom_titles_bg */
				.$unique_block_class.td-image-box-style-2 .td-custom-title .entry-title a {
					background-color: @custom_titles_bg;
				}
		
		

				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_titles */
				.$unique_block_class .entry-title {
					@f_titles
				}
				
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();
        return $compiled_css;
    }

    static function cssMedia( $res_ctx ) {

        /*-- SHORTCODE -- */
        // images height
        $images_height = $res_ctx->get_shortcode_att('height');
        if( $images_height != '' && is_numeric( $images_height ) ) {
            $res_ctx->load_settings_raw( 'images_height', $images_height . 'px' );
        }

        // images gap
        $images_gap = $res_ctx->get_shortcode_att('gap');
        if( $images_gap != '' && is_numeric( $images_gap ) ) {
            $res_ctx->load_settings_raw( 'images_gap', $images_gap . 'px' );
        }


        /*-- CUSTOM TITLES -- */
        // custom titles color
        $res_ctx->load_settings_raw( 'custom_titles_color', $res_ctx->get_shortcode_att('custom_titles_color') );
        // custom titles background color
        $res_ctx->load_settings_raw( 'custom_titles_bg', $res_ctx->get_shortcode_att('custom_titles_bg') );



        /*-- FONTS -- */
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_titles' );

    }

	function render($atts, $content = null) {
		parent::render($atts);

		$this->atts = shortcode_atts(
			array(
				'height' => '',
				'gap' => '',
				'display' => '',
				'alignment' => '',
				'style' => '',


				'image_title_item0' => '',
				'custom_url_item0' => '#',
				'open_in_new_window_item0' => '',
				'image_item0' => '',

				'image_title_item1' => '',
				'custom_url_item1' => '#',
				'open_in_new_window_item1' => '',
				'image_item1' => '',

				'image_title_item2' => '',
				'custom_url_item2' => '#',
				'open_in_new_window_item2' => '',
				'image_item2' => '',

				'image_title_item3' => '',
				'custom_url_item3' => '#',
				'open_in_new_window_item3' => '',
				'image_item3' => '',

			), $atts);

		$items = array();
		for ($i = 0; $i < 4; $i++ ) {
			if ( ! empty( $this->atts['image_item' . $i] ) ) {
				$items[] = array(
					'image_title' => $this->atts['image_title_item' . $i],
					'custom_url' => $this->atts['custom_url_item' . $i],
					'open_in_new_window' => $this->atts['open_in_new_window_item' . $i],
					'image' => $this->atts['image_item' . $i],
				);
			}
		}

		// additional classes
		$additional_classes = array();

		if(!empty($this->atts['display'])) {
			$additional_classes [] = 'td-box-vertical';
		}

		// alignment
		if(!empty($this->atts['alignment'])) {
			$additional_classes[] = 'td-image-box-' . $this->atts['alignment'];
		}

		// style
		if(!empty($this->atts['style'])) {
			$additional_classes[] = 'td-image-box-' . $this->atts['style'];
		}

		$buffy = '';
		$buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

		//get the block css
		$buffy .= $this->get_block_css();

		// block title wrap
		$buffy .= '<div class="td-block-title-wrap">';
			$buffy .= $this->get_block_title();
			$buffy .= $this->get_pull_down_filter(); //get the sub category filter for this block
		$buffy .= '</div>';

		switch(count($items)) {
			case 1: $css_class = 'td-big-image'; break;
			case 2: $css_class = 'td-medium-image'; break;
			case 3: $css_class = 'td-small-image'; break;
			case 4: $css_class = 'td-tiny-image'; break;
		}

		if ( isset($css_class) ) {

			$buffy .= '<div class="td-image-box-row ' . $css_class . '">';
				foreach($items as $item) {

					$buffy .= '<div class="td-image-box-span">';

					$target = '';
					$no_custom_url = '';

					if ( '' !== $item[ 'open_in_new_window' ] ) {
						$target = ' target="_blank" ';
					}

					if ( '#' == $item[ 'custom_url' ] ) {
						$no_custom_url = ' td-no-img-custom-url';
					}

					$buffy .= '<div class="td-custom">';
						$buffy .= '<div class="td-custom-image' . $no_custom_url . '">';
						$buffy .= '<a style="background-image: url(\'' . wp_get_attachment_url($item[ 'image' ]) . '\');" href="' . $item[ 'custom_url' ] . '" ' . $target . ' rel="bookmark" title="' . $item[ 'image_title' ] . '"></a>';
						$buffy .= '</div>';
						$buffy .= '<div class="td-custom-title">';
						$buffy .= '<h3 class="entry-title"><a href="' . $item[ 'custom_url' ] . '">' . $item[ 'image_title' ] . '</a></h3>';
						$buffy .= '</div>';
					$buffy .= '</div>';

					$buffy .= '</div>';
				}
			$buffy .= '</div>';

		} else {

			$buffy .= '<div class="td-image-box-row td-small-image">';

			$index = 0;
			while($index < 3) {
				$buffy .= '<div class="td-image-box-span">';
					$buffy .= '<div class="td-custom">';
						$buffy .= '<div class="td-custom-image td-no-img-custom-url">';
						$buffy .= '<a href="#" rel="bookmark" title="Custom title"></a>';
						$buffy .= '</div>';
						$buffy .= '<div class="td-custom-title">';
						$buffy .= '<h3 class="entry-title"><a href="#">Custom title</a></h3>';
						$buffy .= '</div>';
					$buffy .= '</div>';
				$buffy .= '</div>';

				$index++;
			}
			$buffy .= '</div>';
		}

		$buffy .= '</div>';


		return $buffy;
	}
}