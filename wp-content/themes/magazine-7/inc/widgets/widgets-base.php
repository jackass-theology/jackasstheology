<?php

/**
 * Base Widget Class
 */
class AFthemes_Widget_Base extends WP_Widget
{
    /**
     * @var Array of string
     */
    public $text_fields = array();

    /**
     * @var Array of string
     */
    public $url_fields = array();
    /**
     * @var Array of string
     */
    public $text_areas = array();
    /**
     * @var Array of string
     */
    public $checkboxes = array();
    /**
     * @var Array of string
     */
    public $select_fields = array();

    /**
     * @var form instance object
     */
    public $form_instance = '';

    /**
     * Register widget with WordPress.
     */
    function __construct($id, $name, $args = array(), $controls = array())
    {
        parent::__construct(
            $id, // Base ID
            $name, // Name
            $args, // Args
            $controls
        );
    }

    /**
     * Function to quick create form input field
     *
     * @param string $field widget field name
     * @param string $label
     * @param string $note field note to appear below
     */
    public function m7_generate_text_input($field, $label, $value, $type = 'text', $note = '', $class = '')
    {
        $instance = isset($this->form_instance[$field]) ? $this->form_instance[$field] : $value;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id($field)); ?>">
                <?php echo esc_html($label); ?>
            </label>
            <input class="widefat <?php echo $class; ?>"
                   id="<?php echo esc_attr($this->get_field_id($field)); ?>"
                   name="<?php echo esc_attr($this->get_field_name($field)); ?>"
                   type="<?php echo esc_attr($type); ?>"
                   value="<?php echo esc_attr($instance); ?>"/>
            <?php if (!empty($note)): ?>
                <small><?php echo esc_html($note); ?></small>
            <?php endif; ?>
        </p>
        <?php
    }

    /**
     * Function to quick create form input field
     *
     * @param string $field widget field name
     * @param string $label
     * @param string $note field note to appear below
     */
    public function m7_generate_textarea($field, $label, $note = '')
    {
        $instance = isset($this->form_instance[$field]) ? $this->form_instance[$field] : '';
        ?>
        <p>
            <label for="<?php echo $instance; ?>">
                <?php echo $label; ?>
            </label>
            <textarea class="widefat"
                      id="<?php echo esc_attr($instance); ?>"
                      name="<?php echo esc_attr($instance); ?>"><?php echo esc_html($instance); ?></textarea>
            <?php if (!empty($note)): ?>
                <small><?php echo esc_html($note); ?></small>
            <?php endif; ?>
        </p>
        <?php
    }

    /**
     * Generate checkbox input
     *
     * @param string $field widget field name
     * @param string $label
     * @param string $note field note to appear below
     * @param Object $instance widget instance
     * @param Array_A $elements
     */
    public function m7_generate_checkbox_input($field, $label, $elements, $note = '')
    {
        $instance = isset($this->form_instance[$field]) ? $this->form_instance[$field] : true;
        ?>
        <div class="magazine-7-multiple-check-form">
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($field)); ?>">
                    <?php echo esc_html($label); ?>
                </label>
            </p>
            <ul>
                <?php foreach ($elements as $key => $elem) : ?>
                    <li>
                        <input type="checkbox" value="<?php echo esc_attr($key); ?>"
                               id="<?php echo esc_attr($instance . '-' . $elem); ?>"
                               name="<?php echo esc_attr($instance); ?>[]" <?php checked(is_array($instance) && in_array($key, $instance)); ?> />
                        <label for="<?php echo esc_attr($instance . '-' . $elem); ?>">
                            <?php echo esc_html(ucfirst($elem)); ?>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (!empty($note)): ?>
                <p>
                    <small><?php echo esc_html($note); ?></small>
                </p>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Generate select input
     *
     * @param string $field widget field name
     * @param string $label
     * @param string $note field note to appear below
     * @param Array_A $elements
     */
    public function m7_generate_select_options($field, $label, $elements, $note = '')
    {
        $instance = isset($this->form_instance[$field]) ? $this->form_instance[$field] : $label;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id($field)); ?>">
                <?php echo esc_html($label); ?>
            </label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id($field)); ?>"
                    name="<?php echo esc_attr($this->get_field_name($field)); ?>" style="width:100%;">
                <?php foreach ($elements as $key => $elem) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($instance, $key); ?>><?php echo ucfirst($elem); ?></option>
                    </li>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($note)): ?>
                <small><?php echo esc_html($note); ?></small>
            <?php endif; ?>
        </p>
        <?php
    }


    public function m7_generate_image_upload($field, $label, $value, $note = '', $class = '')
    {
        $instance = isset($this->form_instance[$field]) ? $this->form_instance[$field] : '';
        ?>
        <div>
            <label for="<?php echo esc_attr($this->get_field_id($field)); ?>">
                <?php echo $label ; ?>
            </label>
            <!-- <br /> -->
            <input type="button" class="select-img button button-primary"
                   value="<?php esc_attr_e('Upload', 'magazine-7'); ?>"
                   data-uploader_title="<?php esc_attr_e('Select Image', 'magazine-7'); ?>"
                   data-uploader_button_text="<?php esc_attr_e('Choose Image', 'magazine-7'); ?>"/>
            <?php
            $image_status = false;
            if (!empty($instance)) {
                $image_status = true;
            }
            $remove_button_style = 'display:none;';
            if (true === $image_status) {
                $remove_button_style = 'display:inline-block;';
            }
            ?>
            <input type="button" value="<?php echo _x('X', 'Remove', 'magazine-7'); ?>"
                   class="button button-secondary btn-image-remove"
                   style="<?php echo esc_attr($remove_button_style); ?>"/>
            <input type="hidden" class="img" name="<?php echo esc_attr($this->get_field_name($field)); ?>"
                   id="<?php echo esc_attr($this->get_field_id($field)); ?>"
                   value="<?php echo esc_attr($instance); ?>"/>
            <div class="image-preview-wrap">
                <?php if (!empty($instance)) : ?>
                    <img src="<?php echo esc_attr($instance); ?>" alt=""/>
                <?php endif; ?>
            </div><!-- .image-preview-wrap -->
        </div>

        <?php
    }


    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance = $this->m7_sanitize_data($instance, $new_instance);
        return $instance;
    }

    public function m7_sanitize_data($instance, $new_instance)
    {
        if (is_array($this->text_fields)) {
            // update the text fields values
            foreach ($this->text_fields as $field) {
                $instance = array_merge($instance, $this->m7_update_text($field, $new_instance));
            }
        }

        if (is_array($this->url_fields)) {
            // update the text fields values
            foreach ($this->url_fields as $field) {
                $instance = array_merge($instance, $this->m7_update_url($field, $new_instance));
            }
        }

        if (is_array($this->text_areas)) {
            //update the textarea_values
            foreach ($this->text_areas as $field) {
                $instance = array_merge($instance, $this->m7_update_textarea($field, $new_instance));
            }
        }
        if (is_array($this->checkboxes)) {
            // update the checkbox fields values
            foreach ($this->checkboxes as $field) {
                $instance = array_merge($instance, $this->m7_update_checkbox($field, $new_instance));
            }
        }
        if (is_array($this->select_fields)) {
            // update the select fields values
            foreach ($this->select_fields as $field) {
                $instance = array_merge($instance, $this->m7_update_select($field, $new_instance));
            }
        }
        return $instance;
    }

    /**
     * Update and sanitize backend value of the text field
     *
     * @param string $name
     * @param object $new_instance
     * @return object validate new instance
     */
    public function m7_update_text($name, $new_instance)
    {
        $instance = array();
        $instance[$name] = (!empty($new_instance[$name])) ? sanitize_text_field($new_instance[$name]) : '';
        return $instance;
    }

    /**
     * Update and sanitize backend value of the text field
     *
     * @param string $name
     * @param object $new_instance
     * @return object validate new instance
     */
    public function m7_update_url($name, $new_instance)
    {
        $instance = array();
        $instance[$name] = (!empty($new_instance[$name])) ? esc_url_raw($new_instance[$name]) : '';
        return $instance;
    }

    /**
     * Update and sanitize backend value of the textarea
     *
     * @param string $name
     * @param object $new_instance
     * @return object validate new instance
     */
    public function m7_update_textarea($name, $new_instance)
    {
        $instance = array();
        $instance[$name] = (!empty($new_instance[$name])) ? sanitize_textarea_field($new_instance[$name]) : '';
        return $instance;
    }

    /**
     * Update and sanitize backend value of the checkbox field
     *
     * @param string $name
     * @param object $new_instance
     * @return object validate new instance
     */
    public function m7_update_checkbox($name, $new_instance)
    {
        $instance = array();
        // make sure any checkbox has been checked
        if (!empty($new_instance[$name])) {
            // if multiple checkboxes has been checked
            if (is_array($new_instance[$name])) {
                // iterate over multiple checkboxes
                foreach ($new_instance[$name] as $key => $value) {
                    $instance[$name][$key] = (!empty($new_instance[$name][$key])) ? esc_attr($value) : '';
                }
            } else {
                $instance[$name] = esc_attr($new_instance[$name]);
            }
        }
        return $instance;
    }

    /**
     * Update and sanitize backend value of the select field
     *
     * @param string $name
     * @param object $new_instance
     * @return object validate new instance
     */
    public function m7_update_select($name, $new_instance)
    {
        $instance = array();
        $instance[$name] = (!empty($new_instance[$name])) ? esc_attr($new_instance[$name]) : '';
        return $instance;
    }


}