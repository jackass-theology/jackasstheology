<?php
if (!class_exists('Magazine_7_Tabbed_Posts')) :
    /**
     * Adds Magazine_7_Tabbed_Posts widget.
     */
    class Magazine_7_Tabbed_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('m7-tabbed-popular-posts-title', 'm7-tabbed-latest-posts-title', 'm7-tabbed-categorised-posts-title');

            $this->select_fields = array('m7-show-excerpt', 'm7-enable-categorised-tab', 'm7-select-category');

            $widget_ops = array(
                'classname' => 'magazine_7_tabbed_posts_widget',
                'description' => __('Displays tabbed posts lists from selected settings.', 'magazine-7'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('magazine_7_tabbed_posts', __('M7 Tabbed Posts', 'magazine-7'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::m7_sanitize_data($instance, $instance);
            $tab_id = 'tabbed-' . $this->number;


            /** This filter is documented in wp-includes/default-widgets.php */

            $show_excerpt = isset($instance['m7-show-excerpt']) ? $instance['m7-show-excerpt'] : 'false';
            $excerpt_length = 20;
            $number_of_posts = 5;


            $popular_title = isset($instance['m7-tabbed-popular-posts-title']) ? $instance['m7-tabbed-popular-posts-title'] : __('M7 Popular', 'magazine-7');
            $latest_title = isset($instance['m7-tabbed-latest-posts-title']) ? $instance['m7-tabbed-latest-posts-title'] : __('M7 Latest', 'magazine-7');


            $enable_categorised_tab = isset($instance['m7-enable-categorised-tab']) ? $instance['m7-enable-categorised-tab'] : 'true';
            $categorised_title = isset($instance['m7-tabbed-categorised-posts-title']) ? $instance['m7-tabbed-categorised-posts-title'] : __('Trending', 'magazine-7');
            $category = isset($instance['m7-select-category']) ? $instance['m7-select-category'] : '0';


            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tabbed-head">
                    <ul class="nav nav-tabs af-tabs" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_attr_e('Popular', 'magazine-7'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <?php echo esc_html($popular_title); ?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_attr_e('Recent', 'magazine-7'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <?php echo esc_html($latest_title); ?>
                            </a>
                        </li>
                        <?php if ($enable_categorised_tab == 'true'): ?>
                            <li class="tab tab-categorised">
                                <a href="#<?php echo esc_attr($tab_id); ?>-categorised"
                                   aria-controls="<?php esc_attr_e('Categorised', 'magazine-7'); ?>" role="tab"
                                   data-toggle="tab" class="font-family-1">
                                    <?php echo esc_html($categorised_title); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php
                        magazine_7_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php
                        magazine_7_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>
                    <?php if ($enable_categorised_tab == 'true'): ?>
                        <div id="<?php echo esc_attr($tab_id); ?>-categorised" role="tabpanel" class="tab-pane">
                            <?php
                            magazine_7_render_posts('categorised', $show_excerpt, $excerpt_length, $number_of_posts, $category);
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            $options = array(
                'true' => __('Yes', 'magazine-7'),
                'false' => __('No', 'magazine-7')

            );


            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry

            ?><h4><?php _e('Popular Posts', 'magazine-7'); ?></h4><?php
            echo parent::m7_generate_text_input('m7-tabbed-popular-posts-title', __('Title', 'magazine-7'), __('Popular', 'magazine-7'));

            ?><h4><?php _e('Latest Posts', 'magazine-7'); ?></h4><?php
            echo parent::m7_generate_text_input('m7-tabbed-latest-posts-title', __('Title', 'magazine-7'), __('Latest', 'magazine-7'));

            $categories = magazine_7_get_terms();
            if (isset($categories) && !empty($categories)) {
                ?><h4><?php _e('Categorised Posts', 'magazine-7'); ?></h4>
                <?php
                echo parent::m7_generate_select_options('m7-enable-categorised-tab', __('Select category', 'magazine-7'), $options);
                echo parent::m7_generate_text_input('m7-tabbed-categorised-posts-title', __('Title', 'magazine-7'), __('Trending', 'magazine-7'));
                echo parent::m7_generate_select_options('m7-select-category', __('Select category', 'magazine-7'), $categories);

            }
            ?><h4><?php _e('Settings for all tabs', 'magazine-7'); ?></h4><?php
            echo parent::m7_generate_select_options('m7-show-excerpt', __('Show excerpt', 'magazine-7'), $options);

        }
    }
endif;