<?php

/**
* Class td_block_widget - used to create widgets from our blocks.
* AUTOLOAD STATUS: cannot be autoloaded because WordPress needs to know at all times what widgets are registered
*/
class td_block_widget extends WP_Widget {
	var $td_block_id = 0; // this is changed by td_block_widget class constructor

	private $map_array;
	private $map_param_default_array;

	/**
	 * overwrite the default WordPress constructor
	 * @param string $td_block_id
	 */
	function __construct( $td_block_id = '' ) {

		// $this->td_block_id on old theme versions is set by inherited classes. The check and the default value ('') are for old code that registers widgets using the old method.
		if ( ! empty( $td_block_id ) ) {
			$this->td_block_id = $td_block_id;
		}

		// read our map_array
		$this->map_array = td_api_block::get_by_id( $this->td_block_id );


	    $widget_ops = array('classname' => 'td_pb_widget', 'description' => '[tagDiv] ' . $this->map_array['name']);

	    /**
	    * overwrite the widget settings, we emulate the WordPress settings. Before WP 4.3 we called the old php4 constructor again :(
		* @see \WP_Widget::__construct
		*/
	    $id_base = $this->map_array['base'] . '_widget';
	    $name = '[tagDiv] ' . $this->map_array['name'];
	    $widget_options = $widget_ops;
	    $control_options = array();

	    $this->id_base = strtolower($id_base);
	    $this->name = $name;
	    $this->option_name = 'widget_' . $this->id_base;
	    $this->widget_options = wp_parse_args( $widget_options, array('classname' => $this->option_name) );
	    $this->control_options = wp_parse_args( $control_options, array('id_base' => $this->id_base) );

		// build the default values?
	    $this->map_param_default_array = $this->build_param_default_values();
	}


	/**
	* build the default values array
	* @return array
	*/
	private function build_param_default_values() {
	    $buffy_array = array();
	    if (!empty($this->map_array['params'])) {
	        foreach ($this->map_array['params'] as $param) {
	            if ($param['type'] == 'dropdown') {
	                $buffy_array[$param['param_name']] = '';
	            } else {
	                $buffy_array[$param['param_name']] = $param['value'];
	            }
	        }
	    }
	    return $buffy_array;
	}



	function _render_block_param($instance, $param, $show = false) {

		ob_start();

		switch ($param['type']) {

            case 'textarea_html':
                //print_r($param);

                ?>
                <p>
                    <label for="<?php echo $this->get_field_id($param['param_name']); ?>"><?php echo $param['heading']; ?></label>

                    <textarea  class="widefat" name="<?php echo $this->get_field_name($param['param_name']); ?>" id="<?php echo $this->get_field_id($param['param_name']); ?>" cols="30" rows="10"><?php echo esc_textarea($instance[$param['param_name']]); ?></textarea>


                    <div class="td-wpa-info">
                        <?php echo $param['description']; ?>
                    </div>

                </p>
                <?php
                break;

            case 'textfield':

				// we have to change custom_title to custom-title to have "-title" at the end. That's what
                // WordPress uses to put the title of the widget on post @see widgets.js
                // suggested at: http://forum.tagdiv.com/topic/please-add-block-title-to-backend-widget-title/#post-58087
                if ($param['param_name'] == 'custom_title') {
                    $field_id = $this->get_field_id('custom-title');
                } else {
                    $field_id = $this->get_field_id($param['param_name']);
                }

                ?>
                <p>
                    <label for="<?php echo $this->get_field_id($param['param_name']); ?>"><?php echo $param['heading']; ?></label>
                    <input class="widefat" id="<?php echo $field_id; ?>"
                           name="<?php echo $this->get_field_name($param['param_name']); ?>" type="text"
                           value="<?php echo $instance[$param['param_name']]; ?>" />

                    <div class="td-wpa-info">
                        <?php echo $param['description']; ?>
                    </div>

                </p>
                <?php
                break;



            case 'dropdown':
                ?>
                <p>
                    <label for="<?php echo $this->get_field_id($param['param_name']); ?>"><?php echo $param['heading']; ?></label>
                    <select name="<?php echo $this->get_field_name($param['param_name']); ?>" id="<?php echo $this->get_field_id($param['param_name']); ?>" class="widefat">
                        <?php
                        foreach ($param['value'] as $param_name => $param_value) {
                            ?>
                            <option value="<?php echo $param_value; ?>"<?php selected($instance[$param['param_name']], $param_value); ?>><?php echo $param_name; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <div class="td-wpa-info">
                        <?php echo $param['description']; ?>
                    </div>
                </p>
                <?php
                break;



            case 'colorpicker':
                $empty_color_fix = '#';
                if (!empty($instance[$param['param_name']])) {
                    $empty_color_fix = $instance[$param['param_name']];
                }


                $widget_color_picker_id = td_global::td_generate_unique_id();
                ?>
                <p>
                    <label for="<?php echo $this->get_field_id($param['param_name']); ?>"><?php echo $param['heading']; ?></label>
                    <input data-td-w-color="<?php echo $widget_color_picker_id?>" class="widefat td-color-picker-field" id="<?php echo $this->get_field_id($param['param_name']); ?>"
                           name="<?php echo $this->get_field_name($param['param_name']); ?>" type="text"
                           value="<?php echo $empty_color_fix; ?>" />
                    <div id="<?php echo $widget_color_picker_id?>" class="td-color-picker-widget" rel="<?php echo $this->get_field_id($param['param_name']); ?>"></div>
                </p>

                <div class="td-wpa-info">
                    <?php echo $param['description']; ?>
                </div>

                <script>
                    //td_widget_attach_color_picker();
                </script>

                <?php
                break;



			case 'attach_image':
				$backgroundImage = get_template_directory_uri() . '/includes/wp_booster/wp-admin/images/no_img.png';
				$hideRemoveButton = 'td-hidden-button';

				if ( ! empty( $instance[$param['param_name']] ) ) {
					$backgroundImage = wp_get_attachment_url($instance[$param['param_name']]);
					$hideRemoveButton = '';
				}


                ?>
                <div class="td-widget-attach-image-wrap">
                    <label for="<?php echo $this->get_field_id($param['param_name']); ?>"><?php echo $param['heading']; ?></label>
                    <div class="td-widget-attach-image" style="background-image: url('<?php echo $backgroundImage ?>')"></div>
                    <input type="hidden" name="<?php echo $this->get_field_name($param['param_name']); ?>" value="<?php echo $instance[$param['param_name']]; ?>" />

					<div class="td-widget-remove-image <?php echo $hideRemoveButton ?>">Remove</div>

                    <div class="td-wpa-info">
                        <?php echo $param['description']; ?>
                    </div>

                </div>
                <?php
				break;
        }

		$buffer = ob_get_clean();

		if ($show === true) {
			echo $buffer;
		} else {
            return $buffer;
        }
	}



	function form($instance) {

	    $instance = wp_parse_args((array) $instance, $this->map_param_default_array);

	    //print_r($instance);

	    if (!empty($this->map_array['params'])) {

		    $defaultTab = 'General';

			// step 1 - make the tabs
		    $allGroupNames = array();

		    foreach ($this->map_array['params'] as $param) {
			    $current_tab_name = $defaultTab;
			    if (!empty($param['group'])) {
				    $current_tab_name = $param['group'];
			    }
			    $allGroupNames[] = $current_tab_name;
		    }
		    $allGroupNames = array_unique($allGroupNames);
		    $newGroupNames = array();

		    foreach ($allGroupNames as $groupName) {

			    $newValue = array(
				    'mapped_name' => $groupName,
			    );

			    switch ($groupName) {
				    case 'Design options':

					    if ( td_util::tdc_is_installed()) {
						    $newValue['show_name'] = 'Css';
			            } else {
							unset($newValue);
					    }

					    break;
				    case 'Pagination':
					    $newValue['show_name'] = 'Extra';
					    break;
				    case 'Ajax filter':
					    $newValue['show_name'] = 'Ajax';
					    break;
				    default:
					    $newValue['show_name'] = $groupName;
			    }

			    if (isset($newValue)) {
					$newGroupNames[] = $newValue;
			    }
		    }

		    $buffer = '<div class="tdc-tabs-wrapper">';
		    $buffer .= '<div class="tdc-tabs">';


		    $class_tab_active = 'tdc-tab-active';

		    foreach ($newGroupNames as $groupName) {
			    $buffer .= '<a href="#" data-tab-id="tdc-tab-' . strtolower($groupName['show_name']) . '" class="' . $class_tab_active . '">' . $groupName['show_name'] . '</a>';
			    $class_tab_active = '';
		    }
	        $buffer .= '</div>';
		    $buffer .= '<div class="tdc-tab-content-wrap">';

		    $class_tab_content_visible = 'tdc-tab-content-visible';

		    foreach ($newGroupNames as $groupName) {

			    if ($groupName['show_name'] === 'Css') {

				    $tdc_css_value = '';

				    if (isset($instance['tdc_css'])) {
					    $tdc_css_value = $instance['tdc_css'];
				    }

				    $data_tdc_css = ' data-tdc_css="' . $tdc_css_value .'"';
				    $class_tab_design = 'tdc-tab-design';

			    } else {
				    $data_tdc_css = '';
				    $class_tab_design = '';
			    }

			    $buffer .= '<div class="tdc-tab-content tdc-tab-widget tdc-tab-' . strtolower($groupName['show_name']) . ' ' . $class_tab_content_visible . ' ' . $class_tab_design . '"' . $data_tdc_css . '>';
			    $class_tab_content_visible = '';

			    $block_template_id = $instance['block_template_id'];

			    if (empty($block_template_id)) {
					// global block template id
					$block_template_id = td_options::get('tds_global_block_template', 'td_block_template_1');
			    }

			    if ($groupName['show_name'] === 'General') {

				    $customTitleParam = null;
					$customUrlParam = null;
				    $blockTemplateIdParam = null;

				    $block_template_map_array = td_api_block_template::get_by_id($block_template_id);

				    $tdTypeParams = array();

				    foreach ($this->map_array['params'] as $param) {

					    if ((isset($param['group']) && $groupName['show_name'] !== $defaultTab && $groupName['mapped_name'] === $param['group']) ||
					        (!isset($param['group']) && $groupName['show_name'] === $defaultTab)){

				            if ($param['param_name'] === 'custom_title') {
							    $customTitleParam = $param;
							    continue;
						    } else if ($param['param_name'] === 'custom_url') {
							    $customUrlParam = $param;
							    continue;
						    } else if ($param['param_name'] === 'block_template_id') {
							    $blockTemplateIdParam = $param;
							    continue;
						    } else {
							    $tdTypeParams[] = $param;
						    }
					    }
				    }

				    // Render 'custom_title', 'custom_url' and 'block_template_id' params (IN THIS ORDER)
				    if (!is_null($customTitleParam)) {
					    $buffer .= $this->_render_block_param($instance, $customTitleParam);
				    }

				    if (!is_null($customUrlParam)) {
					    $buffer .= $this->_render_block_param($instance, $customUrlParam);
				    }

				    if (!is_null($blockTemplateIdParam)) {
					    $buffer .= $this->_render_block_param($instance, $blockTemplateIdParam);
				    }

				    foreach ($block_template_map_array['params'] as $block_template_param) {
					    $buffer .= $this->_render_block_param($instance, $block_template_param);
				    }

				    foreach ($tdTypeParams as $param) {
					    if (!isset($param['td_type'])) {
						    $buffer .= $this->_render_block_param( $instance, $param );
					    }
				    }

			    } else {

				    foreach ($this->map_array['params'] as $param) {

					    if ((isset($param['group']) && $groupName['show_name'] !== $defaultTab && $groupName['mapped_name'] === $param['group']) ||
					        (!isset($param['group']) && $groupName['show_name'] === $defaultTab)){

						    $buffer .= $this->_render_block_param($instance, $param);
					    }
				    }
			    }

			    $buffer .= '</div>';
		    }
		    $buffer .= '</div>';
			$buffer .= '</div>';

		    echo $buffer;
	    }
	}


	/**
	* Update the settings of the widget
	* @param array $new_instance
	* @param array $old_instance
	* @return array
    */
	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    foreach ($this->map_param_default_array as $param_name => $param_value) {
	        // we must check for isset, because otherwise we will end up with NULL if a field type is not declare above
		    // like the problem we had with the css att/field
		    if (isset($new_instance[$param_name])) {
			    $instance[$param_name] = $new_instance[$param_name];
		    }
	    }
	    return $instance;
	}


	/**
	* render the widget
	* @param array $args
	* @param array $instance
	*/
	function widget($args, $instance) {
	    /**
	      * add the td_block_widget class to the block via the short code atts, we can add td_block_widget multiple times because array_unique in  @see td_block::get_block_classes
	     */
	    if (!empty($instance['class'])) {
	        $instance['class'] =  $instance['class'] . ' td_block_widget';
	    } else {
	        $instance['class'] = 'td_block_widget';
	    }

	    if (!empty($instance['content'])) {
	        //render the instance - but also send the content parameter to the shortcode
	        echo td_global_blocks::get_instance($this->td_block_id)->render($instance, $instance['content']);
	    } else {
	        //render the instance without the content parameter
	        echo td_global_blocks::get_instance($this->td_block_id)->render($instance);
	    }


	}






}
