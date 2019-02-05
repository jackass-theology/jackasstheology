<?php
if (!class_exists('Magazine_7_Products_List')) :
    /**
     * Adds Magazine_7_Products_List widget.
     */
    class Magazine_7_Products_List extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('m7-posts-slider-title', 'm7-posts-slider-subtitle', 'm7-posts-slider-number');
            $this->select_fields = array('m7-select-category');

            $widget_ops = array(
                'classname' => 'magazine_7_products_list_widget',
                'description' => __('Displays products from selected category.', 'magazine-7'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('Magazine_7_Products_List', __('M7 Products', 'magazine-7'), $widget_ops);
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
            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['m7-posts-slider-title'], $instance, $this->id_base);
            $subtitle = isset($instance['m7-posts-slider-subtitle']) ? $instance['m7-posts-slider-subtitle'] : '';
            $category = isset($instance['m7-select-category']) ? $instance['m7-select-category'] : '0';
            $number_of_posts = 3;
            $all_products = magazine_7_get_products($number_of_posts, $category, '');


            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title) || !empty($subtitle)): ?>
            <div class="em-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h2 class="widget-title">
                        <span><?php echo esc_html($title); ?></span>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($subtitle)): ?>
                    <p class="em-widget-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
            <?php
            if (absint($number_of_posts) > 0): ?>
                <div class="magazine-7-products-list">
                    <div class="banner-half woocommerce">
                        <ul>
                        <div class="row">    
                            <?php if (class_exists('WooCommerce')): ?>
                            <?php while ($all_products->have_posts()):
                                $all_products->the_post();
                                ?>
                                <li <?php post_class('col-sm-4'); ?> data-mh="aft-product-grid">
                                    <div class="af-grid-li">
                                        <?php magazine_7_get_block('product-grid'); ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </div>    
                        </ul>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                </div>
            <?php endif; ?>

            <?php
            //print_pre($all_posts);

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
            $categories = magazine_7_get_terms(0, 'product_cat');
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::m7_generate_text_input('m7-posts-slider-title', 'Title', 'M7 Products');
                echo parent::m7_generate_text_input('m7-posts-slider-subtitle', 'Subtitle', 'M7 Products Subtitle');
                echo parent::m7_generate_select_options('m7-select-category', __('Select Product Category', 'magazine-7'), $categories);

            }
        }
    }
endif;