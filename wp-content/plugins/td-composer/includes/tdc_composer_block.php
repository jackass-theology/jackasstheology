<?php


class tdc_composer_block extends td_block {

	public $block_uid; // the block's unique ID. It is generated on each render
	private $atts;      // the block's atts

	function render ($atts, $content = null) {

		$this->block_uid = tdc_util::generate_unique_id();

		$this->atts = shortcode_atts ( // add defaults (if an att is not in this list, it will be removed!)
			array(
				'el_class' => '',
				'el_id' => '',
				'class' => '', // internal usage, from here we add the classes to the block, el_class is used for vc compatibility and it's content will be added to this att
				'css' => '',

				'tdc_css' => '',
				'tdc_css_class' => '',
				'tdc_css_class_style' => '',
			),
			$atts
		);

		$unique_block_class = td_global::td_generate_unique_id() . '_rand';
		$this->add_class($unique_block_class);
		$this->atts['tdc_css_class'] = $unique_block_class;

		 /** The _rand_style class is used by td-element-style to add style */
	    $unique_block_class_style = $this->block_uid . '_rand_style';
	    $this->atts['tdc_css_class_style'] = $unique_block_class_style;
	}


	// used on row and inner row for now...
	protected function get_block_dom_id() {
		$el_id = $this->get_att('el_id');
		if (!empty($el_id)) {
			$el_id = 'id="' . $el_id . '" ';
		}
		return $el_id;
	}



	protected function get_block_classes($additional_classes_array = array()) {
		$class = $this->get_att('class');



		$el_class = $this->get_att('el_class');

		// on live editor we replace the smart sidebar class for now, due to js issues
		if (tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe()) {
			$el_class = str_replace('td-ss-row', 'td-ss-row-tdc-placeholder', $el_class);
		}




		// add the vc el_class classes
		$class .= ' ' . $el_class;



		$block_classes = array(
			get_class($this)
		);


		// get the design tab css classes
		$css = $this->get_att('css');
		$css_classes_array = $this->parse_css_att($css);
		if ( $css_classes_array !== false ) {
			$block_classes = array_merge(
				$block_classes,
				$css_classes_array
			);
		}


		//add the classes that we receive via shortcode
		if (!empty($class)) {
			$class_array = explode(' ', $class);
			$block_classes = array_merge(
				$block_classes,
				$class_array
			);
		}


		//marge the additional classes received from blocks code
		if (!empty($additional_classes_array)) {
			$block_classes = array_merge(
				$block_classes,
				$additional_classes_array
			);
		}


		//remove duplicates
		$block_classes = array_unique($block_classes);

		return implode(' ', $block_classes);
	}


	protected function get_block_html_atts() {
		return ' data-td-block-uid="' . $this->block_uid . '" ';
	}


	/**
	 * Get the css from the 'css' ATT of the blocks
	 *
	 * @param bool $clearfixColumns - flag used to know outside if the '.clearfix' element is added as last child in vc_row and vc_row_inner
	 * @param bool $addElementStyle - flag used to know outside if 'div' element style has been added
	 *
	 * @return string
	 */
	protected function get_block_css( &$clearfixColumns = false, &$addElementStyle = false ) {
		$buffy = '';

		$css = $this->get_att('css');

		// VC adds the CSS att automatically so we don't have to do it
		if (!empty($css)) {
			$buffy .= PHP_EOL . '/* tdc_composer_block - inline css att */' . PHP_EOL . $css;
		}

		$custom_css = $this->get_custom_css();
		if (!empty($custom_css)) {
			$buffy .= PHP_EOL . '/* custom css */' . PHP_EOL . $custom_css;
		}

		$tdcCss = $this->get_att( 'tdc_css' );
		$cssOutput = '';
		$beforeCssOutput = '';
		$afterCssOutput = '';

		if (!empty($tdcCss)) {
			$buffy .= $this->generate_css( $tdcCss, $clearfixColumns, $cssOutput, $beforeCssOutput, $afterCssOutput );
		}

		if (!empty($buffy)) {
			/** scoped - @link http://www.w3schools.com/tags/att_style_scoped.asp */
			$buffy = PHP_EOL . '<style scoped>' . PHP_EOL . $buffy . PHP_EOL . '</style>';
		}

//		$tdcElementStyleCss = '';
//		if ( !empty($cssOutput) || !empty($beforeCssOutput) || !empty($afterCssOutput) ) {
//			$tdcElementStyleCss = PHP_EOL . '<div class="' . $this->get_att( 'tdc_css_class_style' ) . ' td-element-style"><style>' . $cssOutput . ' ' . $beforeCssOutput . ' ' . $afterCssOutput . '</style></div>';
//			$addElementStyle = true;
//		}

		$tdcElementStyleCss = '';
		if ( !empty($cssOutput) || !empty($beforeCssOutput) || !empty($afterCssOutput) ) {
			$beforeElement = '';
			if ( !empty($beforeCssOutput) ) {
				$beforeElement = '<div class="td-element-style-before"><style>' . $beforeCssOutput . '</style></div>';
			}
			$inline_style = '';



			if (class_exists('vc_row') && $this instanceof vc_row ) {
				$inline_style = 'style="opacity: 0; transition: opacity 1s;"';
			}




			$tdcElementStyleCss = PHP_EOL . '<div class="' . $this->get_att( 'tdc_css_class_style' ) . ' td-element-style" ' . $inline_style . '>' . $beforeElement . '<style>' . $cssOutput . ' ' . $afterCssOutput . '</style></div>';
			$addElementStyle = true;
		}

		if (!empty($buffy)) {

			if (!empty($tdcElementStyleCss)) {
				return $buffy . $tdcElementStyleCss;
			}
			return $buffy;

		} else if (!empty($tdcElementStyleCss)) {
			return $tdcElementStyleCss;
		}

		return '';
	}


	/**
	 * @param $content
	 *
	 * @return string
	 */
	protected function do_shortcode($content) {
		return do_shortcode( shortcode_unautop( $content ) );
	}


	/**
	 * Safe way to read $this->atts. It makes sure that you read them when they are ready and set!
	 * @param $att_name
	 * @return mixed
	 */
	protected function get_att($att_name) {
		if ( !isset( $this->atts ) ) {
		    echo 'tdc_composer_block - get_att() ' . $att_name . ' TD Composer Internal error: The atts are not set yet(AKA: the render method was not called yet and the system tried to read an att)';
			die;
		}

		if ( !isset( $this->atts[$att_name] ) ) {
			var_dump($this->atts);
            echo('TD Composer Internal error: The system tried to use an att that does not exists! class_name: tdc_composer_block  Att name: "' . $att_name . '" The list with available atts is in tdc_composer_block::render');
			die;
		}
		return $this->atts[$att_name];
	}



	private function add_class($raw_class_name) {
		if (!empty($this->atts['class'])) {
			$this->atts['class'] = $this->atts['class'] . ' ' . $raw_class_name;
		} else {
			$this->atts['class'] = $raw_class_name;
		}
	}




	/**
	 * parses a design panel generated css string and get's the classes and the
	 * this should be the same with @see td_block::parse_css_att from the main theme
	 * @param $user_css_att
	 *
	 * @return array|bool - array of results or false if no classes are available
	 */
	protected function parse_css_att($user_css_att) {
		if (empty($user_css_att)) {
			return false;
		}

		$matches = array();
		$preg_match_ret = preg_match_all ( '/\s*\.\s*([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $user_css_att, $matches);


		if ( $preg_match_ret === 0 || $preg_match_ret === false || empty($matches[1]) || empty($matches[2]) ) {
			return false;
		}

		// get only the selectors
		return $matches[1];
	}

}